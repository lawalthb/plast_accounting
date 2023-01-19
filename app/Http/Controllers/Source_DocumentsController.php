<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Source_DocumentsAddRequest;
use App\Http\Requests\Source_DocumentsEditRequest;
use App\Models\Source_Documents;
use Illuminate\Http\Request;
use Exception;
class Source_DocumentsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.source_documents.list";
		$query = Source_Documents::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Source_Documents::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "source_documents.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Source_Documents::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Source_Documents::query();
		$record = $query->findOrFail($rec_id, Source_Documents::viewFields());
		return $this->renderView("pages.source_documents.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.source_documents.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.source_documents.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Source_DocumentsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Source_Documents record
		$record = Source_Documents::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("source_documents", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Source_DocumentsEditRequest $request, $rec_id = null){
		$query = Source_Documents::query();
		$record = $query->findOrFail($rec_id, Source_Documents::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("source_documents", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.source_documents.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Source_Documents::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
}
