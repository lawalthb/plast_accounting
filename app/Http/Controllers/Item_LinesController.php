<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item_LinesAddRequest;
use App\Http\Requests\Item_LinesEditRequest;
use App\Models\Item_Lines;
use Illuminate\Http\Request;
use Exception;
class Item_LinesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.item_lines.list";
		$query = Item_Lines::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Item_Lines::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "item_lines.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Item_Lines::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Item_Lines::query();
		$record = $query->findOrFail($rec_id, Item_Lines::viewFields());
		return $this->renderView("pages.item_lines.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return view("pages.item_lines.add");
	}
	

	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function store(Item_LinesAddRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		Item_Lines::insert($modeldata);
		return $this->redirect("item_lines", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Item_LinesEditRequest $request, $rec_id = null){
		$query = Item_Lines::query();
		$record = $query->findOrFail($rec_id, Item_Lines::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("item_lines", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.item_lines.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Item_Lines::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
}
