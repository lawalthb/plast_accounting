<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Users extends Authenticatable implements MustVerifyEmail 
{
	use Notifiable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	protected $fillable = ['lastname','firstname','email','username','phone','photo','email_verified_at','company_id','role_id','user_type','is_active','password'];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				users.firstname LIKE ?  OR 
				users.lastname LIKE ?  OR 
				users.email LIKE ?  OR 
				users.username LIKE ?  OR 
				companies.name LIKE ?  OR 
				companies.address LIKE ?  OR 
				companies.logo LIKE ?  OR 
				companies.website LIKE ?  OR 
				companies.favicon LIKE ?  OR 
				companies.com_email LIKE ?  OR 
				companies.com_phone LIKE ?  OR 
				companies.signature LIKE ?  OR 
				companies.slogan LIKE ?  OR 
				users.phone LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.username AS username",
			"users.role_id AS role_id",
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
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.username AS username",
			"users.role_id AS role_id",
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
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.role_id AS role_id",
			"users.phone AS phone",
			"users.user_type AS user_type",
			"users.date_join AS date_join",
			"users.is_active AS is_active",
			"users.company_id AS company_id",
			"users.username AS username",
			"users.email_verified_at AS email_verified_at",
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
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.role_id AS role_id",
			"users.phone AS phone",
			"users.user_type AS user_type",
			"users.date_join AS date_join",
			"users.is_active AS is_active",
			"users.company_id AS company_id",
			"users.username AS username",
			"users.email_verified_at AS email_verified_at",
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
     * return accountedit page fields of the model.
     * 
     * @return array
     */
	public static function accounteditFields(){
		return [ 
			"firstname",
			"lastname",
			"role_id",
			"phone",
			"photo",
			"user_type",
			"is_active",
			"company_id",
			"username",
			"email_verified_at",
			"id" 
		];
	}
	

	/**
     * return accountview page fields of the model.
     * 
     * @return array
     */
	public static function accountviewFields(){
		return [ 
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.role_id AS role_id",
			"users.phone AS phone",
			"users.user_type AS user_type",
			"users.date_join AS date_join",
			"users.is_active AS is_active",
			"users.company_id AS company_id",
			"companies.name AS companies_name",
			"users.username AS username" 
		];
	}
	

	/**
     * return exportAccountview page fields of the model.
     * 
     * @return array
     */
	public static function exportAccountviewFields(){
		return [ 
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.role_id AS role_id",
			"users.phone AS phone",
			"users.user_type AS user_type",
			"users.date_join AS date_join",
			"users.is_active AS is_active",
			"users.company_id AS company_id",
			"companies.name AS companies_name",
			"users.username AS username" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"firstname",
			"lastname",
			"email",
			"username",
			"role_id",
			"phone",
			"photo",
			"user_type",
			"is_active",
			"company_id",
			"id" 
		];
	}
	

	/**
     * return usersincomp page fields of the model.
     * 
     * @return array
     */
	public static function usersincompFields(){
		return [ 
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.role_id AS role_id",
			"users.username AS username",
			"companies.id AS companies_id" 
		];
	}
	

	/**
     * return exportUsersincomp page fields of the model.
     * 
     * @return array
     */
	public static function exportUsersincompFields(){
		return [ 
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.role_id AS role_id",
			"users.username AS username",
			"companies.id AS companies_id" 
		];
	}
	

	/**
     * return userEdit page fields of the model.
     * 
     * @return array
     */
	public static function userEditFields(){
		return [ 
			"firstname",
			"lastname",
			"email",
			"username",
			"role_id",
			"phone",
			"photo",
			"user_type",
			"is_active",
			"company_id",
			"id" 
		];
	}
	

	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->username;
	}
	

	/**
     * Get current user id
     * @return string
     */
	public function UserId(){
		return $this->id;
	}
	public function UserEmail(){
		return $this->email;
	}
	public function UserPhoto(){
		return $this->photo;
	}
	

	/**
     * Send Password reset link to user email 
	 * @param string $token
     * @return string
     */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new \App\Notifications\ResetPassword($token));
	}
	

	/**
     * Send user account verification link to user email
     * @return string
     */
	public function sendEmailVerificationNotification()
	{
		$this->notify(new \App\Notifications\VerifyEmail);
	}
}
