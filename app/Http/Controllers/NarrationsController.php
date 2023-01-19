<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\NarrationsAddRequest;
use App\Http\Requests\NarrationsEditRequest;
use App\Models\Narrations;
use Illuminate\Http\Request;
use Exception;
class NarrationsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.narrations.list";
		$query = Narrations::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Narrations::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "narrations.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Narrations::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Narrations::query();
		$record = $query->findOrFail($rec_id, Narrations::viewFields());
		return $this->renderView("pages.narrations.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.narrations.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(NarrationsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Narrations record
		$record = Narrations::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("narrations", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(NarrationsEditRequest $request, $rec_id = null){
		$query = Narrations::query();
		$record = $query->findOrFail($rec_id, Narrations::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("narrations", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.narrations.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Narrations::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
}
