<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('companies/add', 'CompaniesController@add')->name('companies.add');
	Route::post('companies/add', 'CompaniesController@store')->name('companies.store');
		
	Route::get('auth/register', 'AuthController@register')->name('auth.register')->middleware(['redirect.to.home']);
	Route::post('auth/register', 'AuthController@register_store')->name('auth.register_store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	
	Route::get('auth/email/showverifyemail', 'AuthController@showVerifyEmail')->name('verification.notice');
	Route::get('auth/email/verify', 'AuthController@verifyEmail')->name('verification.verify');
	Route::get('auth/email/verified', 'AuthController@emailVerified')->name('verification.verified');
	Route::get('auth/email/resend', 'AuthController@resendVerifyEmail')->name('verification.resend');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth', 'verified'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Account_Groups Controller */	
	Route::get('account_groups', 'Account_GroupsController@index')->name('account_groups.index');
	Route::get('account_groups/index', 'Account_GroupsController@index')->name('account_groups.index');
	Route::get('account_groups/index/{filter?}/{filtervalue?}', 'Account_GroupsController@index')->name('account_groups.index');	
	Route::get('account_groups/view/{rec_id}', 'Account_GroupsController@view')->name('account_groups.view');
	Route::get('account_groups/masterdetail/{rec_id}', 'Account_GroupsController@masterDetail')->name('account_groups.masterdetail');	
	Route::get('account_groups/add', 'Account_GroupsController@add')->name('account_groups.add');
	Route::post('account_groups/add', 'Account_GroupsController@store')->name('account_groups.store');
		
	Route::any('account_groups/edit/{rec_id}', 'Account_GroupsController@edit')->name('account_groups.edit');	
	Route::get('account_groups/delete/{rec_id}', 'Account_GroupsController@delete');

/* routes for Companies Controller */	
	Route::get('companies', 'CompaniesController@index')->name('companies.index');
	Route::get('companies/index', 'CompaniesController@index')->name('companies.index');
	Route::get('companies/index/{filter?}/{filtervalue?}', 'CompaniesController@index')->name('companies.index');	
	Route::get('companies/view/{rec_id}', 'CompaniesController@view')->name('companies.view');
	Route::get('companies/masterdetail/{rec_id}', 'CompaniesController@masterDetail')->name('companies.masterdetail');	
	Route::any('companies/edit/{rec_id}', 'CompaniesController@edit')->name('companies.edit');	
	Route::get('companies/delete/{rec_id}', 'CompaniesController@delete');	
	Route::get('companies/user_list', 'CompaniesController@user_list');
	Route::get('companies/user_list/{filter?}/{filtervalue?}', 'CompaniesController@user_list');

/* routes for Invoice_Documents Controller */	
	Route::get('invoice_documents', 'Invoice_DocumentsController@index')->name('invoice_documents.index');
	Route::get('invoice_documents/index', 'Invoice_DocumentsController@index')->name('invoice_documents.index');
	Route::get('invoice_documents/index/{filter?}/{filtervalue?}', 'Invoice_DocumentsController@index')->name('invoice_documents.index');	
	Route::get('invoice_documents/view/{rec_id}', 'Invoice_DocumentsController@view')->name('invoice_documents.view');
	Route::get('invoice_documents/masterdetail/{rec_id}', 'Invoice_DocumentsController@masterDetail')->name('invoice_documents.masterdetail');	
	Route::get('invoice_documents/add', 'Invoice_DocumentsController@add')->name('invoice_documents.add');
	Route::post('invoice_documents/add', 'Invoice_DocumentsController@store')->name('invoice_documents.store');
		
	Route::any('invoice_documents/edit/{rec_id}', 'Invoice_DocumentsController@edit')->name('invoice_documents.edit');	
	Route::get('invoice_documents/delete/{rec_id}', 'Invoice_DocumentsController@delete');

/* routes for Item_Lines Controller */	
	Route::get('item_lines', 'Item_LinesController@index')->name('item_lines.index');
	Route::get('item_lines/index', 'Item_LinesController@index')->name('item_lines.index');
	Route::get('item_lines/index/{filter?}/{filtervalue?}', 'Item_LinesController@index')->name('item_lines.index');	
	Route::get('item_lines/view/{rec_id}', 'Item_LinesController@view')->name('item_lines.view');	
	Route::get('item_lines/add', 'Item_LinesController@add')->name('item_lines.add');
	Route::post('item_lines/add', 'Item_LinesController@store')->name('item_lines.store');
		
	Route::any('item_lines/edit/{rec_id}', 'Item_LinesController@edit')->name('item_lines.edit');	
	Route::get('item_lines/delete/{rec_id}', 'Item_LinesController@delete');

/* routes for Ledgers Controller */	
	Route::get('ledgers', 'LedgersController@index')->name('ledgers.index');
	Route::get('ledgers/index', 'LedgersController@index')->name('ledgers.index');
	Route::get('ledgers/index/{filter?}/{filtervalue?}', 'LedgersController@index')->name('ledgers.index');	
	Route::get('ledgers/view/{rec_id}', 'LedgersController@view')->name('ledgers.view');
	Route::get('ledgers/masterdetail/{rec_id}', 'LedgersController@masterDetail')->name('ledgers.masterdetail');	
	Route::get('ledgers/add', 'LedgersController@add')->name('ledgers.add');
	Route::post('ledgers/add', 'LedgersController@store')->name('ledgers.store');
		
	Route::any('ledgers/edit/{rec_id}', 'LedgersController@edit')->name('ledgers.edit');	
	Route::get('ledgers/delete/{rec_id}', 'LedgersController@delete');	
	Route::get('ledgers/customers_list', 'LedgersController@customers_list');
	Route::get('ledgers/customers_list/{filter?}/{filtervalue?}', 'LedgersController@customers_list');	
	Route::get('ledgers/customer_add', 'LedgersController@customer_add')->name('ledgers.customer_add');
	Route::post('ledgers/customer_add', 'LedgersController@customer_add_store')->name('ledgers.customer_add_store');
		
	Route::any('ledgers/customer_edit/{rec_id}', 'LedgersController@customer_edit')->name('ledgers.customer_edit');	
	Route::get('ledgers/suppliers_list', 'LedgersController@suppliers_list');
	Route::get('ledgers/suppliers_list/{filter?}/{filtervalue?}', 'LedgersController@suppliers_list');	
	Route::get('ledgers/suppliers_add', 'LedgersController@suppliers_add')->name('ledgers.suppliers_add');
	Route::post('ledgers/suppliers_add', 'LedgersController@suppliers_add_store')->name('ledgers.suppliers_add_store');
		
	Route::any('ledgers/suppliers_edit/{rec_id}', 'LedgersController@suppliers_edit')->name('ledgers.suppliers_edit');	
	Route::get('ledgers/any_add', 'LedgersController@any_add')->name('ledgers.any_add');
	Route::post('ledgers/any_add', 'LedgersController@any_add_store')->name('ledgers.any_add_store');
		
	Route::get('ledgers/any_list', 'LedgersController@any_list');
	Route::get('ledgers/any_list/{filter?}/{filtervalue?}', 'LedgersController@any_list');	
	Route::any('ledgers/any_edit/{rec_id}', 'LedgersController@any_edit')->name('ledgers.any_edit');	
	Route::get('ledgers/customers_statement', 'LedgersController@customers_statement');
	Route::get('ledgers/customers_statement/{filter?}/{filtervalue?}', 'LedgersController@customers_statement');	
	Route::get('ledgers/suppliers_statement', 'LedgersController@suppliers_statement');
	Route::get('ledgers/suppliers_statement/{filter?}/{filtervalue?}', 'LedgersController@suppliers_statement');	
	Route::get('ledgers/any_statement', 'LedgersController@any_statement');
	Route::get('ledgers/any_statement/{filter?}/{filtervalue?}', 'LedgersController@any_statement');

/* routes for Main_Documents Controller */	
	Route::get('main_documents', 'Main_DocumentsController@index')->name('main_documents.index');
	Route::get('main_documents/index', 'Main_DocumentsController@index')->name('main_documents.index');
	Route::get('main_documents/index/{filter?}/{filtervalue?}', 'Main_DocumentsController@index')->name('main_documents.index');	
	Route::get('main_documents/view/{rec_id}', 'Main_DocumentsController@view')->name('main_documents.view');
	Route::get('main_documents/masterdetail/{rec_id}', 'Main_DocumentsController@masterDetail')->name('main_documents.masterdetail');	
	Route::get('main_documents/add', 'Main_DocumentsController@add')->name('main_documents.add');
	Route::post('main_documents/add', 'Main_DocumentsController@store')->name('main_documents.store');
		
	Route::any('main_documents/edit/{rec_id}', 'Main_DocumentsController@edit')->name('main_documents.edit');	
	Route::get('main_documents/delete/{rec_id}', 'Main_DocumentsController@delete');

/* routes for Marketers Controller */	
	Route::get('marketers', 'MarketersController@index')->name('marketers.index');
	Route::get('marketers/index', 'MarketersController@index')->name('marketers.index');
	Route::get('marketers/index/{filter?}/{filtervalue?}', 'MarketersController@index')->name('marketers.index');	
	Route::get('marketers/view/{rec_id}', 'MarketersController@view')->name('marketers.view');	
	Route::get('marketers/add', 'MarketersController@add')->name('marketers.add');
	Route::post('marketers/add', 'MarketersController@store')->name('marketers.store');
		
	Route::any('marketers/edit/{rec_id}', 'MarketersController@edit')->name('marketers.edit');	
	Route::get('marketers/delete/{rec_id}', 'MarketersController@delete');	
	Route::get('marketers/marketers_list', 'MarketersController@marketers_list');
	Route::get('marketers/marketers_list/{filter?}/{filtervalue?}', 'MarketersController@marketers_list');	
	Route::get('marketers/marketer_add', 'MarketersController@marketer_add')->name('marketers.marketer_add');
	Route::post('marketers/marketer_add', 'MarketersController@marketer_add_store')->name('marketers.marketer_add_store');
		
	Route::any('marketers/marketer_edit/{rec_id}', 'MarketersController@marketer_edit')->name('marketers.marketer_edit');

/* routes for Narrations Controller */	
	Route::get('narrations', 'NarrationsController@index')->name('narrations.index');
	Route::get('narrations/index', 'NarrationsController@index')->name('narrations.index');
	Route::get('narrations/index/{filter?}/{filtervalue?}', 'NarrationsController@index')->name('narrations.index');	
	Route::get('narrations/view/{rec_id}', 'NarrationsController@view')->name('narrations.view');	
	Route::get('narrations/add', 'NarrationsController@add')->name('narrations.add');
	Route::post('narrations/add', 'NarrationsController@store')->name('narrations.store');
		
	Route::any('narrations/edit/{rec_id}', 'NarrationsController@edit')->name('narrations.edit');	
	Route::get('narrations/delete/{rec_id}', 'NarrationsController@delete');

/* routes for Options Controller */	
	Route::get('options', 'OptionsController@index')->name('options.index');
	Route::get('options/index', 'OptionsController@index')->name('options.index');
	Route::get('options/index/{filter?}/{filtervalue?}', 'OptionsController@index')->name('options.index');	
	Route::get('options/view/{rec_id}', 'OptionsController@view')->name('options.view');	
	Route::get('options/add', 'OptionsController@add')->name('options.add');
	Route::post('options/add', 'OptionsController@store')->name('options.store');
		
	Route::any('options/edit/{rec_id}', 'OptionsController@edit')->name('options.edit');	
	Route::get('options/delete/{rec_id}', 'OptionsController@delete');	
	Route::get('options/user_list', 'OptionsController@user_list');
	Route::get('options/user_list/{filter?}/{filtervalue?}', 'OptionsController@user_list');	
	Route::any('options/user_edit/{rec_id}', 'OptionsController@user_edit')->name('options.user_edit');

/* routes for Product_Categories Controller */	
	Route::get('product_categories', 'Product_CategoriesController@index')->name('product_categories.index');
	Route::get('product_categories/index', 'Product_CategoriesController@index')->name('product_categories.index');
	Route::get('product_categories/index/{filter?}/{filtervalue?}', 'Product_CategoriesController@index')->name('product_categories.index');	
	Route::get('product_categories/view/{rec_id}', 'Product_CategoriesController@view')->name('product_categories.view');
	Route::get('product_categories/masterdetail/{rec_id}', 'Product_CategoriesController@masterDetail')->name('product_categories.masterdetail');	
	Route::get('product_categories/add', 'Product_CategoriesController@add')->name('product_categories.add');
	Route::post('product_categories/add', 'Product_CategoriesController@store')->name('product_categories.store');
		
	Route::any('product_categories/edit/{rec_id}', 'Product_CategoriesController@edit')->name('product_categories.edit');	
	Route::get('product_categories/delete/{rec_id}', 'Product_CategoriesController@delete');	
	Route::get('product_categories/comp_product_cat', 'Product_CategoriesController@comp_product_cat');
	Route::get('product_categories/comp_product_cat/{filter?}/{filtervalue?}', 'Product_CategoriesController@comp_product_cat');	
	Route::get('product_categories/category_add', 'Product_CategoriesController@category_add')->name('product_categories.category_add');
	Route::post('product_categories/category_add', 'Product_CategoriesController@category_add_store')->name('product_categories.category_add_store');
		
	Route::get('product_categories/categories_list', 'Product_CategoriesController@categories_list');
	Route::get('product_categories/categories_list/{filter?}/{filtervalue?}', 'Product_CategoriesController@categories_list');	
	Route::any('product_categories/category_edit/{rec_id}', 'Product_CategoriesController@category_edit')->name('product_categories.category_edit');

/* routes for Products Controller */	
	Route::get('products', 'ProductsController@index')->name('products.index');
	Route::get('products/index', 'ProductsController@index')->name('products.index');
	Route::get('products/index/{filter?}/{filtervalue?}', 'ProductsController@index')->name('products.index');	
	Route::get('products/view/{rec_id}', 'ProductsController@view')->name('products.view');	
	Route::get('products/add', 'ProductsController@add')->name('products.add');
	Route::post('products/add', 'ProductsController@store')->name('products.store');
		
	Route::any('products/edit/{rec_id}', 'ProductsController@edit')->name('products.edit');	
	Route::get('products/delete/{rec_id}', 'ProductsController@delete');	
	Route::get('products/copm_products', 'ProductsController@copm_products');
	Route::get('products/copm_products/{filter?}/{filtervalue?}', 'ProductsController@copm_products');	
	Route::get('products/product_add1', 'ProductsController@product_add1')->name('products.product_add1');
	Route::post('products/product_add1', 'ProductsController@product_add1_store')->name('products.product_add1_store');
		
	Route::get('products/products_list', 'ProductsController@products_list');
	Route::get('products/products_list/{filter?}/{filtervalue?}', 'ProductsController@products_list');	
	Route::get('products/product_add', 'ProductsController@product_add')->name('products.product_add');
	Route::post('products/product_add', 'ProductsController@product_add_store')->name('products.product_add_store');
		
	Route::any('products/product_edit/{rec_id}', 'ProductsController@product_edit')->name('products.product_edit');	
	Route::get('products/product_view/{rec_id}', 'ProductsController@product_view')->name('products.product_view');	
	Route::get('products/product_delete/{rec_id}', 'ProductsController@product_delete');

/* routes for Source_Documents Controller */	
	Route::get('source_documents', 'Source_DocumentsController@index')->name('source_documents.index');
	Route::get('source_documents/index', 'Source_DocumentsController@index')->name('source_documents.index');
	Route::get('source_documents/index/{filter?}/{filtervalue?}', 'Source_DocumentsController@index')->name('source_documents.index');	
	Route::get('source_documents/view/{rec_id}', 'Source_DocumentsController@view')->name('source_documents.view');
	Route::get('source_documents/masterdetail/{rec_id}', 'Source_DocumentsController@masterDetail')->name('source_documents.masterdetail');	
	Route::get('source_documents/add', 'Source_DocumentsController@add')->name('source_documents.add');
	Route::post('source_documents/add', 'Source_DocumentsController@store')->name('source_documents.store');
		
	Route::any('source_documents/edit/{rec_id}', 'Source_DocumentsController@edit')->name('source_documents.edit');	
	Route::get('source_documents/delete/{rec_id}', 'Source_DocumentsController@delete');

/* routes for Stocks Controller */	
	Route::get('stocks', 'StocksController@index')->name('stocks.index');
	Route::get('stocks/index', 'StocksController@index')->name('stocks.index');
	Route::get('stocks/index/{filter?}/{filtervalue?}', 'StocksController@index')->name('stocks.index');	
	Route::get('stocks/view/{rec_id}', 'StocksController@view')->name('stocks.view');	
	Route::get('stocks/add', 'StocksController@add')->name('stocks.add');
	Route::post('stocks/add', 'StocksController@store')->name('stocks.store');
		
	Route::any('stocks/edit/{rec_id}', 'StocksController@edit')->name('stocks.edit');	
	Route::get('stocks/delete/{rec_id}', 'StocksController@delete');

/* routes for Sub_Account_Group Controller */	
	Route::get('sub_account_group', 'Sub_Account_GroupController@index')->name('sub_account_group.index');
	Route::get('sub_account_group/index', 'Sub_Account_GroupController@index')->name('sub_account_group.index');
	Route::get('sub_account_group/index/{filter?}/{filtervalue?}', 'Sub_Account_GroupController@index')->name('sub_account_group.index');	
	Route::get('sub_account_group/view/{rec_id}', 'Sub_Account_GroupController@view')->name('sub_account_group.view');
	Route::get('sub_account_group/masterdetail/{rec_id}', 'Sub_Account_GroupController@masterDetail')->name('sub_account_group.masterdetail');	
	Route::get('sub_account_group/add', 'Sub_Account_GroupController@add')->name('sub_account_group.add');
	Route::post('sub_account_group/add', 'Sub_Account_GroupController@store')->name('sub_account_group.store');
		
	Route::any('sub_account_group/edit/{rec_id}', 'Sub_Account_GroupController@edit')->name('sub_account_group.edit');	
	Route::get('sub_account_group/delete/{rec_id}', 'Sub_Account_GroupController@delete');

/* routes for Units Controller */	
	Route::get('units', 'UnitsController@index')->name('units.index');
	Route::get('units/index', 'UnitsController@index')->name('units.index');
	Route::get('units/index/{filter?}/{filtervalue?}', 'UnitsController@index')->name('units.index');	
	Route::get('units/view/{rec_id}', 'UnitsController@view')->name('units.view');
	Route::get('units/masterdetail/{rec_id}', 'UnitsController@masterDetail')->name('units.masterdetail');	
	Route::get('units/add', 'UnitsController@add')->name('units.add');
	Route::post('units/add', 'UnitsController@store')->name('units.store');
		
	Route::any('units/edit/{rec_id}', 'UnitsController@edit')->name('units.edit');	
	Route::get('units/delete/{rec_id}', 'UnitsController@delete');	
	Route::get('units/units_list', 'UnitsController@units_list');
	Route::get('units/units_list/{filter?}/{filtervalue?}', 'UnitsController@units_list');	
	Route::get('units/units_add', 'UnitsController@units_add')->name('units.units_add');
	Route::post('units/units_add', 'UnitsController@units_add_store')->name('units.units_add_store');
		
	Route::any('units/unit_edit/{rec_id}', 'UnitsController@unit_edit')->name('units.unit_edit');

/* routes for Users Controller */	
	Route::get('users', 'UsersController@index')->name('users.index');
	Route::get('users/index', 'UsersController@index')->name('users.index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('users.index');	
	Route::get('users/view/{rec_id}', 'UsersController@view')->name('users.view');
	Route::get('users/masterdetail/{rec_id}', 'UsersController@masterDetail')->name('users.masterdetail');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('users/add', 'UsersController@add')->name('users.add');
	Route::post('users/add', 'UsersController@store')->name('users.store');
		
	Route::any('users/edit/{rec_id}', 'UsersController@edit')->name('users.edit');	
	Route::get('users/delete/{rec_id}', 'UsersController@delete');	
	Route::get('users/usersincomp', 'UsersController@usersincomp');
	Route::get('users/usersincomp/{filter?}/{filtervalue?}', 'UsersController@usersincomp');	
	Route::get('users/userincomp_add', 'UsersController@userincomp_add')->name('users.userincomp_add');
	Route::post('users/userincomp_add', 'UsersController@userincomp_add_store')->name('users.userincomp_add_store');
		
	Route::any('users/user_edit/{rec_id}', 'UsersController@user_edit')->name('users.user_edit');
});


	
Route::get('componentsdata/companies_name_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->companies_name_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/doc_type_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->doc_type_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/customer_legder_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->customer_legder_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/user_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/sales_ledger_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->sales_ledger_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/company_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->company_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/product_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->product_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/marketer_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->marketer_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/sub_account_group_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->sub_account_group_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledgers_sub_account_group_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledgers_sub_account_group_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/affect_account_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->affect_account_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/category_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->category_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/unit_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->unit_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/document_type_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->document_type_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledger_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledger_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/account_group_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->account_group_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_email_value_exist($request);
	}
);
	
Route::get('componentsdata/users_username_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_username_value_exist($request);
	}
);
	
Route::get('componentsdata/user_role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_role_id_option_list($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');