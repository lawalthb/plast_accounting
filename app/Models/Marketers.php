<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Marketers extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'marketers';
	

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
		'company_id','name','user_id','is_active'
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
				marketers.name LIKE ? 
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
			"marketers.id AS id",
			"marketers.company_id AS company_id",
			"companies.name AS companies_name",
			"marketers.name AS name",
			"marketers.user_id AS user_id",
			"users.username AS users_username",
			"marketers.is_active AS is_active" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"marketers.id AS id",
			"marketers.company_id AS company_id",
			"companies.name AS companies_name",
			"marketers.name AS name",
			"marketers.user_id AS user_id",
			"users.username AS users_username",
			"marketers.is_active AS is_active" 
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
			"user_id",
			"is_active" 
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
			"user_id",
			"is_active" 
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
			"id" 
		];
	}
	

	/**
     * return marketersList page fields of the model.
     * 
     * @return array
     */
	public static function marketersListFields(){
		return [ 
			"marketers.id AS id",
			"marketers.name AS name",
			"marketers.user_id AS user_id",
			"marketers.is_active AS is_active",
			"companies.name AS companies_name" 
		];
	}
	

	/**
     * return exportMarketersList page fields of the model.
     * 
     * @return array
     */
	public static function exportMarketersListFields(){
		return [ 
			"marketers.id AS id",
			"marketers.name AS name",
			"marketers.user_id AS user_id",
			"marketers.is_active AS is_active",
			"companies.name AS companies_name" 
		];
	}
	

	/**
     * return marketerEdit page fields of the model.
     * 
     * @return array
     */
	public static function marketerEditFields(){
		return [ 
			"name",
			"is_active",
			"id" 
		];
	}
}
