<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Units extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'units';
	

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
		'name','symbol','status','company_id'
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
				name LIKE ?  OR 
				symbol LIKE ? 
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
			"name",
			"symbol",
			"status",
			"company_id" 
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
			"name",
			"symbol",
			"status",
			"company_id" 
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
			"symbol",
			"status",
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
			"symbol",
			"status",
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
			"symbol",
			"status",
			"id",
			"company_id" 
		];
	}
	

	/**
     * return unitsList page fields of the model.
     * 
     * @return array
     */
	public static function unitsListFields(){
		return [ 
			"name",
			"symbol",
			"status",
			"id" 
		];
	}
	

	/**
     * return exportUnitsList page fields of the model.
     * 
     * @return array
     */
	public static function exportUnitsListFields(){
		return [ 
			"name",
			"symbol",
			"status",
			"id" 
		];
	}
	

	/**
     * return unitEdit page fields of the model.
     * 
     * @return array
     */
	public static function unitEditFields(){
		return [ 
			"name",
			"symbol",
			"status",
			"company_id",
			"id" 
		];
	}
}
