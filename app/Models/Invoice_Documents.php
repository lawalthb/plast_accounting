<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Invoice_Documents extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'invoice_documents';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'doc_date','doc_no','comment','doc_type','customer_legder_id','user_id','sales_ledger_id','company_id','status'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				doc_no LIKE ?  OR 
				comment LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"id",
			"doc_date",
			"doc_no",
			"comment",
			"doc_type",
			"user_id",
			"company_id",
			"status",
			"customer_legder_id",
			"sales_ledger_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"doc_date",
			"doc_no",
			"comment",
			"doc_type",
			"user_id",
			"company_id",
			"status",
			"customer_legder_id",
			"sales_ledger_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"doc_date",
			"doc_no",
			"comment",
			"doc_type",
			"user_id",
			"company_id",
			"status",
			"customer_legder_id",
			"sales_ledger_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"doc_date",
			"doc_no",
			"comment",
			"doc_type",
			"user_id",
			"company_id",
			"status",
			"customer_legder_id",
			"sales_ledger_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"doc_date",
			"doc_no",
			"comment",
			"doc_type",
			"customer_legder_id",
			"user_id",
			"sales_ledger_id",
			"company_id",
			"status",
			"id" 
		];
	}
}
