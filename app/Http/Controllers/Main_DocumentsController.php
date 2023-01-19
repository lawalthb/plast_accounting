<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main_DocumentsAddRequest;
use App\Http\Requests\Main_DocumentsEditRequest;
use App\Models\Main_Documents;
use Illuminate\Http\Request;
use Exception;
class Main_DocumentsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.main_documents.list";
		$query = Main_Documents::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Main_Documents::search($query, $search); // search table records
		}
		$query->join("companies", "main_documents.company_id", "=", "companies.id");
		$orderby = $request->orderby ?? "main_documents.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Main_Documents::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Main_Documents::query();
		$query->join("companies", "main_documents.company_id", "=", "companies.id");
		$record = $query->findOrFail($rec_id, Main_Documents::viewFields());
		return $this->renderView("pages.main_documents.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.main_documents.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.main_documents.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Main_DocumentsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Main_Documents record
		$record = Main_Documents::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("main_documents", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Main_DocumentsEditRequest $request, $rec_id = null){
		$query = Main_Documents::query();
		$record = $query->findOrFail($rec_id, Main_Documents::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("main_documents", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.main_documents.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Main_Documents::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
}
