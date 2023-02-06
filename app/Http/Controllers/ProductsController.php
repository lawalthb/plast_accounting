<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsAddRequest;
use App\Http\Requests\ProductsEditRequest;
use App\Http\Requests\ProductsProduct_add1Request;
use App\Http\Requests\Productsproduct_addRequest;
use App\Http\Requests\Productsproduct_editRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsProductsListExport;
use Exception;
class ProductsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.products.list";
		$query = Products::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Products::search($query, $search); // search table records
		}
		$query->join("product_categories", "products.category", "=", "product_categories.id");
		$query->join("users", "products.user_id", "=", "users.id");
		$query->join("units", "products.unit", "=", "units.id");
		$orderby = $request->orderby ?? "products.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Products::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Products::query();
		$record = $query->findOrFail($rec_id, Products::viewFields());
		return $this->renderView("pages.products.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.products.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ProductsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Products record
		$record = Products::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("products", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ProductsEditRequest $request, $rec_id = null){
		$query = Products::query();
		$record = $query->findOrFail($rec_id, Products::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("products", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.products.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Products::query();
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
	function copm_products(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.products.copm_products";
		$query = Products::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Products::search($query, $search); // search table records
		}
		$query->join("product_categories", "products.category", "=", "product_categories.id");
		$query->join("users", "products.user_id", "=", "users.id");
		$query->join("units", "products.unit", "=", "units.id");
		$orderby = $request->orderby ?? "products.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Products::copmProductsFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function product_add1(){
		return $this->renderView("pages.products.product_add1");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function product_add1_store(ProductsProduct_add1Request $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Products record
		$record = Products::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("products/product_add1", __('recordAddedSuccessfully'));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function products_list(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.products.products_list";
		$query = Products::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Products::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "products.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportProductsList($query); // export current query
		}
		$records = $query->paginate($limit, Products::productsListFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function product_add(){
		return $this->renderView("pages.products.product_add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function product_add_store(Productsproduct_addRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Products record
		$record = Products::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("products/products_list", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function product_edit(Productsproduct_editRequest $request, $rec_id = null){
		$query = Products::query();
		$record = $query->findOrFail($rec_id, Products::productEditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("products/products_list", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.products.product_edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function product_view($rec_id = null){
		$query = Products::query();
		$query->join("product_categories", "products.category", "=", "product_categories.id");
		$query->join("users", "products.user_id", "=", "users.id");
		$query->join("units", "products.unit", "=", "units.id");
		$record = $query->findOrFail($rec_id, Products::productViewFields());
		return $this->renderView("pages.products.product_view", ["data" => $record]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function product_delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Products::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? "products/products_list";
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportProductsList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ProductsListProductsReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Products::exportProductsListFields());
			return view("reports.products-products_list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Products::exportProductsListFields());
			$pdf = PDF::loadView("reports.products-products_list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new ProductsProductsListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new ProductsProductsListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
