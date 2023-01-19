<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account_GroupsAddRequest;
use App\Http\Requests\Account_GroupsEditRequest;
use App\Models\Account_Groups;
use Illuminate\Http\Request;
use Exception;
class Account_GroupsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.account_groups.list";
		$query = Account_Groups::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Account_Groups::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "account_groups.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Account_Groups::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Account_Groups::query();
		$record = $query->findOrFail($rec_id, Account_Groups::viewFields());
		return $this->renderView("pages.account_groups.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.account_groups.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.account_groups.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Account_GroupsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Account_Groups record
		$record = Account_Groups::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("account_groups", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Account_GroupsEditRequest $request, $rec_id = null){
		$query = Account_Groups::query();
		$record = $query->findOrFail($rec_id, Account_Groups::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("account_groups", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.account_groups.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Account_Groups::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
}
