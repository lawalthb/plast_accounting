<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LedgersAddRequest;
use App\Http\Requests\LedgersEditRequest;
use App\Http\Requests\Ledgerscustomer_addRequest;
use App\Http\Requests\Ledgerscustomer_editRequest;
use App\Http\Requests\Ledgerssuppliers_addRequest;
use App\Http\Requests\Ledgerssuppliers_editRequest;
use App\Http\Requests\Ledgersany_addRequest;
use App\Http\Requests\Ledgersany_editRequest;
use App\Models\Ledgers;
use Illuminate\Http\Request;
use Exception;
class LedgersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.list";
		$query = Ledgers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Ledgers::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Ledgers::query();
		$record = $query->findOrFail($rec_id, Ledgers::viewFields());
		return $this->renderView("pages.ledgers.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.ledgers.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(LedgersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Ledgers record
		$record = Ledgers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("ledgers", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(LedgersEditRequest $request, $rec_id = null){
		$query = Ledgers::query();
		$record = $query->findOrFail($rec_id, Ledgers::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("ledgers", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.ledgers.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Ledgers::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
	$this->sendMailOnRecordDelete();
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
	function customers_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.customers_list";
		$query = Ledgers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$query->join("sub_account_group", "ledgers.sub_account_group_id", "=", "sub_account_group.id");
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("ledgers.company_id", "=" , auth()->user()->company_id);
$query->where("sub_account_group.code", "=" , 2014);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Ledgers::customersListFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function customer_add(){
		return $this->renderView("pages.ledgers.customer_add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function customer_add_store(Ledgerscustomer_addRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Ledgers record
		$record = Ledgers::create($modeldata);
		$rec_id = $record->id;
	$this->sendMailOnRecordCustomerAdd($record);
		return $this->redirect("ledgers/customer_add", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function customer_edit(Ledgerscustomer_editRequest $request, $rec_id = null){
		$query = Ledgers::query();
		$record = $query->findOrFail($rec_id, Ledgers::customerEditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("ledgers/customers_list", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.ledgers.customer_edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function suppliers_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.suppliers_list";
		$query = Ledgers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$query->join("sub_account_group", "ledgers.sub_account_group_id", "=", "sub_account_group.id");
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("ledgers.company_id", "=" , auth()->user()->company_id);
$query->where("sub_account_group.code", "=" , 2013);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Ledgers::suppliersListFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function suppliers_add(){
		return $this->renderView("pages.ledgers.suppliers_add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function suppliers_add_store(Ledgerssuppliers_addRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Ledgers record
		$record = Ledgers::create($modeldata);
		$rec_id = $record->id;
	$this->sendMailOnRecordSuppliersAdd($record);
		return $this->redirect("ledgers/suppliers_add", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function suppliers_edit(Ledgerssuppliers_editRequest $request, $rec_id = null){
		$query = Ledgers::query();
		$record = $query->findOrFail($rec_id, Ledgers::suppliersEditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
	$this->sendMailOnRecordSuppliersEdit($record);
			return $this->redirect("ledgers/suppliers_list", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.ledgers.suppliers_edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function any_add(){
		return $this->renderView("pages.ledgers.any_add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function any_add_store(Ledgersany_addRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Ledgers record
		$record = Ledgers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("ledgers/any_list", __('recordAddedSuccessfully'));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function any_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.any_list";
		$query = Ledgers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$query->join("sub_account_group", "ledgers.sub_account_group_id", "=", "sub_account_group.id");
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("ledgers.company_id", "=" , auth()->user()->company_id);
$query->where("sub_account_group.code", "!=" , 2013);
$query->where("sub_account_group.code", "!=" , 2014);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Ledgers::anyListFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function any_edit(Ledgersany_editRequest $request, $rec_id = null){
		$query = Ledgers::query();
		$record = $query->findOrFail($rec_id, Ledgers::anyEditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
	$this->sendMailOnRecordAnyEdit($record);
			return $this->redirect("ledgers/any_list", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.ledgers.any_edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function customers_statement(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.customers_statement";
		$query = Ledgers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$query->join("sub_account_group", "ledgers.sub_account_group_id", "=", "sub_account_group.id");
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("ledgers.company_id", "=" , auth()->user()->company_id);
$query->where("sub_account_group.code", "=" , 2014);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Ledgers::customersStatementFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function suppliers_statement(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.suppliers_statement";
		$query = Ledgers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$query->join("sub_account_group", "ledgers.sub_account_group_id", "=", "sub_account_group.id");
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("ledgers.company_id", "=" , auth()->user()->company_id);
$query->where("sub_account_group.code", "=" , 2013);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Ledgers::suppliersStatementFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function any_statement(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.any_statement";
		$query = Ledgers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$query->join("sub_account_group", "ledgers.sub_account_group_id", "=", "sub_account_group.id");
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("ledgers.company_id", "=" , auth()->user()->company_id);
$query->where("sub_account_group.code", "!=" , 2013);
$query->where("sub_account_group.code", "!=" , 2014);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Ledgers::anyStatementFields());
		return $this->renderView($view, compact("records"));
	}
	private function sendMailOnRecordDelete(){
		try{
			$subject = "Ledgers Record Deleted";
			$message = "$record[ledger_name] record has been deleted .";	
			$receiver = "admin@plast_account.com";
			$this->sendRecordActionMail($receiver, $subject, $message);
		}
		catch(Exception $ex){
			throw $ex;
		}
	}
	private function sendMailOnRecordCustomerAdd($record = null){
		try{
			$subject = "New Customer Record Added";
			$message = "$record[ledger_name] record has been added.";	
			$receiver = "admin@plast_account.com";
			$recid = $record->id;
			$recordLink = url("ledgers/view/$recid");
			$this->sendRecordActionMail($receiver, $subject, $message, $recordLink);
		}
		catch(Exception $ex){
			throw $ex;
		}
	}
	private function sendMailOnRecordSuppliersAdd($record = null){
		try{
			$subject = "New Customer Record Added";
			$message = "$record[ledger_name] record has been added.";	
			$receiver = "admin@plast_account.com";
			$recid = $record->id;
			$recordLink = url("ledgers/view/$recid");
			$this->sendRecordActionMail($receiver, $subject, $message, $recordLink);
		}
		catch(Exception $ex){
			throw $ex;
		}
	}
	private function sendMailOnRecordSuppliersEdit($record = null){
		try{
			$subject = "Ledgers Record Updated";
			$message = "Ledgers record has been updated .";	
			$receiver = "admin@plast_account.com";
			$recid = $record->id;
			$recordLink = url("ledgers/view/$recid");
			$this->sendRecordActionMail($receiver, $subject, $message, $recordLink);
		}
		catch(Exception $ex){
			throw $ex;
		}
	}
	private function sendMailOnRecordAnyEdit($record = null){
		try{
			$subject = "Ledgers Record Updated";
			$message = "Ledgers record has been updated .";	
			$receiver = "admin@plast_account.com";
			$recid = $record->id;
			$recordLink = url("ledgers/view/$recid");
			$this->sendRecordActionMail($receiver, $subject, $message, $recordLink);
		}
		catch(Exception $ex){
			throw $ex;
		}
	}
}
