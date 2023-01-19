<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Options extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'options';
	

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
		'option_name','option_value'
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
				option_name LIKE ?  OR 
				option_value LIKE ? 
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
			"option_name",
			"option_value",
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
			"option_name",
			"option_value",
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
			"option_name",
			"option_value",
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
			"option_name",
			"option_value",
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
			"option_name",
			"option_value",
			"id" 
		];
	}
	

	/**
     * return userList page fields of the model.
     * 
     * @return array
     */
	public static function userListFields(){
		return [ 
			"option_name",
			"option_value",
			"id" 
		];
	}
	

	/**
     * return exportUserList page fields of the model.
     * 
     * @return array
     */
	public static function exportUserListFields(){
		return [ 
			"option_name",
			"option_value",
			"id" 
		];
	}
	

	/**
     * return userEdit page fields of the model.
     * 
     * @return array
     */
	public static function userEditFields(){
		return [ 
			"option_name",
			"option_value",
			"id" 
		];
	}
}
