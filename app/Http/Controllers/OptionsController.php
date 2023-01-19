<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionsAddRequest;
use App\Http\Requests\OptionsEditRequest;
use App\Http\Requests\Optionsuser_editRequest;
use App\Models\Options;
use Illuminate\Http\Request;
use Exception;
class OptionsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.options.list";
		$query = Options::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Options::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "options.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Options::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Options::query();
		$record = $query->findOrFail($rec_id, Options::viewFields());
		return $this->renderView("pages.options.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.options.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(OptionsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Options record
		$record = Options::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("options", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(OptionsEditRequest $request, $rec_id = null){
		$query = Options::query();
		$record = $query->findOrFail($rec_id, Options::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("options", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.options.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Options::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function user_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.options.user_list";
		$query = Options::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Options::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "options.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Options::userListFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function user_edit(Optionsuser_editRequest $request, $rec_id = null){
		$query = Options::query();
		$record = $query->findOrFail($rec_id, Options::userEditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("options/user_list", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.options.user_edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}
