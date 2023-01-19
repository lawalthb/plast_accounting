<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product_CategoriesAddRequest;
use App\Http\Requests\Product_CategoriesEditRequest;
use App\Models\Product_Categories;
use Illuminate\Http\Request;
use Exception;
class Product_CategoriesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.product_categories.list";
		$query = Product_Categories::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Product_Categories::search($query, $search); // search table records
		}
		$query->join("companies", "product_categories.company_id", "=", "companies.id");
		$orderby = $request->orderby ?? "product_categories.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Product_Categories::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Product_Categories::query();
		$record = $query->findOrFail($rec_id, Product_Categories::viewFields());
		return $this->renderView("pages.product_categories.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.product_categories.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.product_categories.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Product_CategoriesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Product_Categories record
		$record = Product_Categories::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("product_categories", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Product_CategoriesEditRequest $request, $rec_id = null){
		$query = Product_Categories::query();
		$record = $query->findOrFail($rec_id, Product_Categories::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("product_categories", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.product_categories.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Product_Categories::query();
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
	function comp_product_cat(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.product_categories.comp_product_cat";
		$query = Product_Categories::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Product_Categories::search($query, $search); // search table records
		}
		$query->join("companies", "product_categories.company_id", "=", "companies.id");
		$orderby = $request->orderby ?? "product_categories.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Product_Categories::compProductCatFields());
		return $this->renderView($view, compact("records"));
	}
}
