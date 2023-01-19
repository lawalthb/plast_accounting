<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\MarketersAddRequest;
use App\Http\Requests\MarketersEditRequest;
use App\Http\Requests\Marketersmarketer_addRequest;
use App\Http\Requests\Marketersmarketer_editRequest;
use App\Models\Marketers;
use Illuminate\Http\Request;
use Exception;
class MarketersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.marketers.list";
		$query = Marketers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Marketers::search($query, $search); // search table records
		}
		$query->join("companies", "marketers.company_id", "=", "companies.id");
		$query->join("users", "marketers.user_id", "=", "users.id");
		$orderby = $request->orderby ?? "marketers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Marketers::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Marketers::query();
		$record = $query->findOrFail($rec_id, Marketers::viewFields());
		return $this->renderView("pages.marketers.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.marketers.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(MarketersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['company_id'] = auth()->user()->company_id;
		$modeldata['user_id'] = auth()->user()->id;
		
		//save Marketers record
		$record = Marketers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("marketers", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(MarketersEditRequest $request, $rec_id = null){
		$query = Marketers::query();
		$record = $query->findOrFail($rec_id, Marketers::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("marketers/marketers_list", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.marketers.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Marketers::query();
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
	function marketers_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.marketers.marketers_list";
		$query = Marketers::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Marketers::search($query, $search); // search table records
		}
		$query->join("companies", "marketers.company_id", "=", "companies.id");
		$orderby = $request->orderby ?? "marketers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id );
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Marketers::marketersListFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function marketer_add(){
		return $this->renderView("pages.marketers.marketer_add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function marketer_add_store(Marketersmarketer_addRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['company_id'] = auth()->user()->company_id;
		$modeldata['user_id'] = auth()->user()->id;
		
		//save Marketers record
		$record = Marketers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("marketers/marketers_list", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function marketer_edit(Marketersmarketer_editRequest $request, $rec_id = null){
		$query = Marketers::query();
		$record = $query->findOrFail($rec_id, Marketers::marketerEditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("marketers", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.marketers.marketer_edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}
