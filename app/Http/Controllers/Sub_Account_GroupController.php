<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sub_Account_GroupAddRequest;
use App\Http\Requests\Sub_Account_GroupEditRequest;
use App\Models\Sub_Account_Group;
use Illuminate\Http\Request;
use Exception;
class Sub_Account_GroupController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.sub_account_group.list";
		$query = Sub_Account_Group::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Sub_Account_Group::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "sub_account_group.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Sub_Account_Group::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Sub_Account_Group::query();
		$record = $query->findOrFail($rec_id, Sub_Account_Group::viewFields());
		return $this->renderView("pages.sub_account_group.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.sub_account_group.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.sub_account_group.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Sub_Account_GroupAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Sub_Account_Group record
		$record = Sub_Account_Group::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("sub_account_group", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Sub_Account_GroupEditRequest $request, $rec_id = null){
		$query = Sub_Account_Group::query();
		$record = $query->findOrFail($rec_id, Sub_Account_Group::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("sub_account_group", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.sub_account_group.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Sub_Account_Group::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
}
