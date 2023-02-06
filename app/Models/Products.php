<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Products extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'products';
	

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
		'company_id','category','name','unit','qty','selling_price','purchase_price','dead_stock','is_active','user_id','exp_date','mfg_date','image'
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
				products.name LIKE ? 
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
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name",
			"products.id AS id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name",
			"products.id AS id" 
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
			"company_id",
			"name",
			"category",
			"image",
			"mfg_date",
			"exp_date",
			"qty",
			"selling_price",
			"purchase_price",
			"dead_stock",
			"is_active",
			"user_id",
			"unit" 
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
			"company_id",
			"name",
			"category",
			"image",
			"mfg_date",
			"exp_date",
			"qty",
			"selling_price",
			"purchase_price",
			"dead_stock",
			"is_active",
			"user_id",
			"unit" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"category",
			"name",
			"unit",
			"qty",
			"selling_price",
			"purchase_price",
			"dead_stock",
			"is_active",
			"user_id",
			"exp_date",
			"mfg_date",
			"image",
			"id" 
		];
	}
	

	/**
     * return copmProducts page fields of the model.
     * 
     * @return array
     */
	public static function copmProductsFields(){
		return [ 
			"products.id AS id",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name" 
		];
	}
	

	/**
     * return exportCopmProducts page fields of the model.
     * 
     * @return array
     */
	public static function exportCopmProductsFields(){
		return [ 
			"products.id AS id",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name" 
		];
	}
	

	/**
     * return productsList page fields of the model.
     * 
     * @return array
     */
	public static function productsListFields(){
		return [ 
			"name",
			"category",
			"qty",
			"selling_price",
			"purchase_price",
			"unit",
			"id" 
		];
	}
	

	/**
     * return exportProductsList page fields of the model.
     * 
     * @return array
     */
	public static function exportProductsListFields(){
		return [ 
			"name",
			"category",
			"qty",
			"selling_price",
			"purchase_price",
			"unit",
			"id" 
		];
	}
	

	/**
     * return productEdit page fields of the model.
     * 
     * @return array
     */
	public static function productEditFields(){
		return [ 
			"category",
			"name",
			"unit",
			"qty",
			"selling_price",
			"purchase_price",
			"dead_stock",
			"is_active",
			"user_id",
			"exp_date",
			"mfg_date",
			"image",
			"id" 
		];
	}
	

	/**
     * return productView page fields of the model.
     * 
     * @return array
     */
	public static function productViewFields(){
		return [ 
			"products.id AS id",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.image AS image",
			"products.mfg_date AS mfg_date",
			"products.exp_date AS exp_date",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.dead_stock AS dead_stock",
			"products.is_active AS is_active",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name",
			"products.company_id AS company_id" 
		];
	}
	

	/**
     * return exportProductView page fields of the model.
     * 
     * @return array
     */
	public static function exportProductViewFields(){
		return [ 
			"products.id AS id",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.image AS image",
			"products.mfg_date AS mfg_date",
			"products.exp_date AS exp_date",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.dead_stock AS dead_stock",
			"products.is_active AS is_active",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name",
			"products.company_id AS company_id" 
		];
	}
}
