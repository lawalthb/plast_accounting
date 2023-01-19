<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRegisterRequest;
use App\Http\Requests\UsersAccountEditRequest;
use App\Http\Requests\UsersAddRequest;
use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\Usersuserincomp_addRequest;
use App\Http\Requests\Usersuser_editRequest;
use App\Models\Users;
use Illuminate\Http\Request;
use Exception;
class UsersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.users.list";
		$query = Users::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Users::search($query, $search); // search table records
		}
		$query->join("companies", "users.company_id", "=", "companies.id");
		$orderby = $request->orderby ?? "users.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Users::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Users::query();
		$query->join("companies", "users.company_id", "=", "companies.id");
		$record = $query->findOrFail($rec_id, Users::viewFields());
		return $this->renderView("pages.users.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.users.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(UsersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Users record
		$record = Users::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("users", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(UsersEditRequest $request, $rec_id = null){
		$query = Users::query();
		$record = $query->findOrFail($rec_id, Users::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("users", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.users.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Users::query();
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
	function usersincomp(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.users.usersincomp";
		$query = Users::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Users::search($query, $search); // search table records
		}
		$query->join("companies", "users.company_id", "=", "companies.id");
		$orderby = $request->orderby ?? "users.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
$query->where("username", "!=" , auth()->user()->username);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Users::usersincompFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function userincomp_add(){
		return $this->renderView("pages.users.userincomp_add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function userincomp_add_store(Usersuserincomp_addRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Users record
		$record = Users::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("users/usersincomp", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function user_edit(Usersuser_editRequest $request, $rec_id = null){
		$query = Users::query();
		$record = $query->findOrFail($rec_id, Users::userEditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
	$this->sendMailOnRecordUserEdit($record);
			return $this->redirect("users/usersincomp", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.users.user_edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	private function sendMailOnRecordUserEdit($record = null){
		try{
			$subject = "Users Record Updated";
			$message = "Users record has been updated .";	
			$receiver = "$record[email]";
			$recid = $record->id;
			$recordLink = url("users/view/$recid");
			$this->sendRecordActionMail($receiver, $subject, $message, $recordLink);
		}
		catch(Exception $ex){
			throw $ex;
		}
	}
}
