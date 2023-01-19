<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Companies extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'companies';
	

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
		'name','slogan','com_phone','com_email','address','website','logo','favicon','signature'
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
				address LIKE ?  OR 
				logo LIKE ?  OR 
				website LIKE ?  OR 
				favicon LIKE ?  OR 
				com_email LIKE ?  OR 
				com_phone LIKE ?  OR 
				signature LIKE ?  OR 
				slogan LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"address",
			"logo",
			"website",
			"favicon",
			"com_email",
			"com_phone",
			"signature",
			"slogan" 
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
			"address",
			"logo",
			"website",
			"favicon",
			"com_email",
			"com_phone",
			"signature",
			"slogan" 
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
			"address",
			"logo",
			"website",
			"favicon",
			"com_email",
			"com_phone",
			"signature",
			"slogan" 
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
			"address",
			"logo",
			"website",
			"favicon",
			"com_email",
			"com_phone",
			"signature",
			"slogan" 
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
			"slogan",
			"com_phone",
			"com_email",
			"address",
			"website",
			"logo",
			"favicon",
			"signature",
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
			"id",
			"name",
			"address",
			"logo",
			"website",
			"favicon",
			"com_email",
			"com_phone",
			"signature",
			"slogan" 
		];
	}
	

	/**
     * return exportUserList page fields of the model.
     * 
     * @return array
     */
	public static function exportUserListFields(){
		return [ 
			"id",
			"name",
			"address",
			"logo",
			"website",
			"favicon",
			"com_email",
			"com_phone",
			"signature",
			"slogan" 
		];
	}
}
