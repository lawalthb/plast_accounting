<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Ledgers extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'ledgers';
	

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
		'company_id','sub_account_group_id','ledger_name','marketer_id','address','email','phone','contact_person','is_active','user_id','credit_amount','debit_amount'
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
				ledger_name LIKE ?  OR 
				address LIKE ?  OR 
				email LIKE ?  OR 
				contact_person LIKE ?  OR 
				phone LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"ledger_name",
			"address",
			"email",
			"contact_person",
			"credit_amount",
			"debit_amount",
			"is_active" 
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
			"ledger_name",
			"address",
			"email",
			"contact_person",
			"credit_amount",
			"debit_amount",
			"is_active" 
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
			"sub_account_group_id",
			"ledger_name",
			"marketer_id",
			"address",
			"email",
			"phone",
			"contact_person",
			"is_active",
			"user_id",
			"reg_date",
			"credit_amount",
			"debit_amount" 
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
			"sub_account_group_id",
			"ledger_name",
			"marketer_id",
			"address",
			"email",
			"phone",
			"contact_person",
			"is_active",
			"user_id",
			"reg_date",
			"credit_amount",
			"debit_amount" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"company_id",
			"sub_account_group_id",
			"ledger_name",
			"marketer_id",
			"address",
			"email",
			"phone",
			"contact_person",
			"is_active",
			"user_id",
			"credit_amount",
			"debit_amount",
			"id" 
		];
	}
	

	/**
     * return customersList page fields of the model.
     * 
     * @return array
     */
	public static function customersListFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.address AS address",
			"ledgers.email AS email",
			"ledgers.contact_person AS contact_person",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			"ledgers.is_active AS is_active",
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return exportCustomersList page fields of the model.
     * 
     * @return array
     */
	public static function exportCustomersListFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.address AS address",
			"ledgers.email AS email",
			"ledgers.contact_person AS contact_person",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			"ledgers.is_active AS is_active",
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return customerEdit page fields of the model.
     * 
     * @return array
     */
	public static function customerEditFields(){
		return [ 
			"company_id",
			"sub_account_group_id",
			"ledger_name",
			"marketer_id",
			"address",
			"email",
			"phone",
			"contact_person",
			"is_active",
			"user_id",
			"id" 
		];
	}
	

	/**
     * return suppliersList page fields of the model.
     * 
     * @return array
     */
	public static function suppliersListFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.address AS address",
			"ledgers.email AS email",
			"ledgers.contact_person AS contact_person",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			"ledgers.is_active AS is_active",
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return exportSuppliersList page fields of the model.
     * 
     * @return array
     */
	public static function exportSuppliersListFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.address AS address",
			"ledgers.email AS email",
			"ledgers.contact_person AS contact_person",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			"ledgers.is_active AS is_active",
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return suppliersEdit page fields of the model.
     * 
     * @return array
     */
	public static function suppliersEditFields(){
		return [ 
			"company_id",
			"sub_account_group_id",
			"ledger_name",
			"marketer_id",
			"address",
			"email",
			"phone",
			"contact_person",
			"is_active",
			"user_id",
			"id" 
		];
	}
	

	/**
     * return anyList page fields of the model.
     * 
     * @return array
     */
	public static function anyListFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"sub_account_group.name AS sub_account_group_name",
			"ledgers.is_active AS is_active",
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return exportAnyList page fields of the model.
     * 
     * @return array
     */
	public static function exportAnyListFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"sub_account_group.name AS sub_account_group_name",
			"ledgers.is_active AS is_active",
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return anyEdit page fields of the model.
     * 
     * @return array
     */
	public static function anyEditFields(){
		return [ 
			"company_id",
			"sub_account_group_id",
			"ledger_name",
			"is_active",
			"user_id",
			"id" 
		];
	}
	

	/**
     * return customersStatement page fields of the model.
     * 
     * @return array
     */
	public static function customersStatementFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			DB::raw("ledgers.debit_amount -ledgers.credit_amount AS balance"),
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return exportCustomersStatement page fields of the model.
     * 
     * @return array
     */
	public static function exportCustomersStatementFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			DB::raw("ledgers.debit_amount -ledgers.credit_amount AS balance"),
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return suppliersStatement page fields of the model.
     * 
     * @return array
     */
	public static function suppliersStatementFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			DB::raw("ledgers.debit_amount -ledgers.credit_amount AS balance"),
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return exportSuppliersStatement page fields of the model.
     * 
     * @return array
     */
	public static function exportSuppliersStatementFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			DB::raw("ledgers.debit_amount -ledgers.credit_amount AS balance"),
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return anyStatement page fields of the model.
     * 
     * @return array
     */
	public static function anyStatementFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			DB::raw("ledgers.debit_amount -ledgers.credit_amount AS balance"),
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
	

	/**
     * return exportAnyStatement page fields of the model.
     * 
     * @return array
     */
	public static function exportAnyStatementFields(){
		return [ 
			"ledgers.id AS id",
			"ledgers.ledger_name AS ledger_name",
			"ledgers.credit_amount AS credit_amount",
			"ledgers.debit_amount AS debit_amount",
			DB::raw("ledgers.debit_amount -ledgers.credit_amount AS balance"),
			"sub_account_group.id AS sub_account_group_id" 
		];
	}
}
