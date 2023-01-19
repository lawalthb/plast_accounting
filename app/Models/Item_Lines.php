<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Item_Lines extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'item_lines';
	

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
		'product_id','doc_id','qty','s_price','amount','p_price','unit','comment','doc_no','company_id','user_id'
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
				unit LIKE ?  OR 
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
			"product_id",
			"doc_id",
			"qty",
			"s_price",
			"amount",
			"p_price",
			"unit",
			"comment",
			"doc_no",
			"company_id",
			"user_id" 
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
			"product_id",
			"doc_id",
			"qty",
			"s_price",
			"amount",
			"p_price",
			"unit",
			"comment",
			"doc_no",
			"company_id",
			"user_id" 
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
			"product_id",
			"doc_id",
			"qty",
			"s_price",
			"amount",
			"p_price",
			"unit",
			"comment",
			"doc_no",
			"company_id",
			"user_id" 
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
			"product_id",
			"doc_id",
			"qty",
			"s_price",
			"amount",
			"p_price",
			"unit",
			"comment",
			"doc_no",
			"company_id",
			"user_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"product_id",
			"doc_id",
			"qty",
			"s_price",
			"amount",
			"p_price",
			"unit",
			"comment",
			"doc_no",
			"company_id",
			"user_id",
			"id" 
		];
	}
}
