<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StocksAddRequest;
use App\Http\Requests\StocksEditRequest;
use App\Models\Stocks;
use Illuminate\Http\Request;
use Exception;
class StocksController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.stocks.list";
		$query = Stocks::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Stocks::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "stocks.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Stocks::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Stocks::query();
		$record = $query->findOrFail($rec_id, Stocks::viewFields());
		return $this->renderView("pages.stocks.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.stocks.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(StocksAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Stocks record
		$record = Stocks::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("stocks", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(StocksEditRequest $request, $rec_id = null){
		$query = Stocks::query();
		$record = $query->findOrFail($rec_id, Stocks::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("stocks", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.stocks.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Stocks::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
}
