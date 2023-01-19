<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product_Categories extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'product_categories';
	

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
		'name','is_active','company_id'
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
				product_categories.name LIKE ? 
		)';
		$search_params = [
			"%$text%"
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
			"product_categories.id AS id",
			"product_categories.name AS name",
			"product_categories.is_active AS is_active",
			"product_categories.company_id AS company_id",
			"companies.name AS companies_name" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"product_categories.id AS id",
			"product_categories.name AS name",
			"product_categories.is_active AS is_active",
			"product_categories.company_id AS company_id",
			"companies.name AS companies_name" 
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
			"name",
			"is_active",
			"company_id" 
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
			"name",
			"is_active",
			"company_id" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"name",
			"is_active",
			"company_id",
			"id" 
		];
	}
	

	/**
     * return compProductCat page fields of the model.
     * 
     * @return array
     */
	public static function compProductCatFields(){
		return [ 
			"product_categories.id AS id",
			"product_categories.name AS name",
			"product_categories.is_active AS is_active",
			"product_categories.company_id AS company_id",
			"companies.name AS companies_name" 
		];
	}
	

	/**
     * return exportCompProductCat page fields of the model.
     * 
     * @return array
     */
	public static function exportCompProductCatFields(){
		return [ 
			"product_categories.id AS id",
			"product_categories.name AS name",
			"product_categories.is_active AS is_active",
			"product_categories.company_id AS company_id",
			"companies.name AS companies_name" 
		];
	}
}
