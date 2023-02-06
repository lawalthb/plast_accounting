<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitsAddRequest;
use App\Http\Requests\UnitsEditRequest;
use App\Http\Requests\Unitsunits_addRequest;
use App\Http\Requests\Unitsunit_editRequest;
use App\Models\Units;
use Illuminate\Http\Request;
use Exception;
class UnitsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.units.list";
		$query = Units::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Units::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "units.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Units::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Units::query();
		$record = $query->findOrFail($rec_id, Units::viewFields());
		return $this->renderView("pages.units.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.units.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.units.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(UnitsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Units record
		$record = Units::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("units", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(UnitsEditRequest $request, $rec_id = null){
		$query = Units::query();
		$record = $query->findOrFail($rec_id, Units::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("units", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.units.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Units::query();
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
	function units_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.units.units_list";
		$query = Units::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Units::search($query, $search); // search table records
		}
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("units.name", "ASC");
		}
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Units::unitsListFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function units_add(){
		return $this->renderView("pages.units.units_add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function units_add_store(Unitsunits_addRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Units record
		$record = Units::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("units/units_list", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function unit_edit(Unitsunit_editRequest $request, $rec_id = null){
		$query = Units::query();
		$record = $query->findOrFail($rec_id, Units::unitEditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("units/units_list", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.units.unit_edit", ["data" => $record, "rec_id" => $rec_id]);
	}
}
