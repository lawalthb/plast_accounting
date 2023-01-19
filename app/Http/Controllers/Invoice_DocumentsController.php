<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice_DocumentsAddRequest;
use App\Http\Requests\Invoice_DocumentsEditRequest;
use App\Models\Invoice_Documents;
use Illuminate\Http\Request;
use Exception;
class Invoice_DocumentsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.invoice_documents.list";
		$query = Invoice_Documents::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Invoice_Documents::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "invoice_documents.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Invoice_Documents::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Invoice_Documents::query();
		$record = $query->findOrFail($rec_id, Invoice_Documents::viewFields());
		return $this->renderView("pages.invoice_documents.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.invoice_documents.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.invoice_documents.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Invoice_DocumentsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Item_Lines form data
		$itemLinesPostData = $request->item_lines;
		$itemLinesValidator = validator()->make($itemLinesPostData, ["*.product_id" => "required",
				"*.qty" => "required|numeric",
				"*.s_price" => "required|numeric",
				"*.amount" => "required|numeric",
				"*.p_price" => "required|numeric",
				"*.unit" => "nullable|string",
				"*.comment" => "nullable|string",
				"*.doc_no" => "nullable|numeric",
				"*.company_id" => "required",
				"*.user_id" => "required"]);
		if ($itemLinesValidator->fails()) {
			return $itemLinesValidator->errors();
		}
		$itemLinesValidData = $itemLinesValidator->valid();
		$itemLinesModeldata = array_values($itemLinesValidData);
		
		//save Invoice_Documents record
		$record = Invoice_Documents::create($modeldata);
		$rec_id = $record->id;
		
		// set item_lines.doc_id to invoice_documents $rec_id
		foreach ($itemLinesModeldata as &$data) {
			$data['doc_id'] = $rec_id;
		}
		
		//Save Item_Lines record
		\App\Models\Item_Lines::insert($itemLinesModeldata);
		return $this->redirect("invoice_documents", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Invoice_DocumentsEditRequest $request, $rec_id = null){
		$query = Invoice_Documents::query();
		$record = $query->findOrFail($rec_id, Invoice_Documents::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("invoice_documents", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.invoice_documents.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Invoice_Documents::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
}
