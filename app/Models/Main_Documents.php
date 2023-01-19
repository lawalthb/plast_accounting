<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Main_Documents extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'main_documents';
	

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
		'affect_account','name','total_amount','company_id'
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
				main_documents.name LIKE ?  OR 
				companies.name LIKE ?  OR 
				companies.address LIKE ?  OR 
				companies.logo LIKE ?  OR 
				companies.website LIKE ?  OR 
				companies.favicon LIKE ?  OR 
				companies.com_email LIKE ?  OR 
				companies.com_phone LIKE ?  OR 
				companies.signature LIKE ?  OR 
				companies.slogan LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"main_documents.id AS id",
			"main_documents.name AS name",
			"companies.name AS companies_name",
			"companies.id AS companies_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"main_documents.id AS id",
			"main_documents.name AS name",
			"companies.name AS companies_name",
			"companies.id AS companies_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"main_documents.id AS id",
			"main_documents.name AS name",
			"main_documents.affect_account AS affect_account",
			"main_documents.total_amount AS total_amount",
			"main_documents.company_id AS company_id",
			"companies.id AS companies_id",
			"companies.name AS companies_name",
			"companies.address AS companies_address",
			"companies.logo AS companies_logo",
			"companies.website AS companies_website",
			"companies.favicon AS companies_favicon",
			"companies.com_email AS companies_com_email",
			"companies.com_phone AS companies_com_phone",
			"companies.signature AS companies_signature",
			"companies.slogan AS companies_slogan" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"main_documents.id AS id",
			"main_documents.name AS name",
			"main_documents.affect_account AS affect_account",
			"main_documents.total_amount AS total_amount",
			"main_documents.company_id AS company_id",
			"companies.id AS companies_id",
			"companies.name AS companies_name",
			"companies.address AS companies_address",
			"companies.logo AS companies_logo",
			"companies.website AS companies_website",
			"companies.favicon AS companies_favicon",
			"companies.com_email AS companies_com_email",
			"companies.com_phone AS companies_com_phone",
			"companies.signature AS companies_signature",
			"companies.slogan AS companies_slogan" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"affect_account",
			"name",
			"total_amount",
			"company_id",
			"id" 
		];
	}
}
