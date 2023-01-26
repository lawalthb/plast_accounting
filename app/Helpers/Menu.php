
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => __('dashboard'), 
			'icon' => '<i class="material-icons ">dashboard</i>'
		],
		
		[
			'path' => '',
			'label' => __('customers'), 
			'icon' => '<i class="material-icons ">contacts</i>',
'submenu' => [
		[
			'path' => 'ledgers/customer_add',
			'label' => __('createNew'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'ledgers/customers_statement',
			'label' => __('statements'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'ledgers/customers_list',
			'label' => __('management'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'marketers/marketers_list',
			'label' => __('marketers'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('suppliers'), 
			'icon' => '<i class="material-icons ">person_add</i>',
'submenu' => [
		[
			'path' => 'ledgers/suppliers_add',
			'label' => __('createNew'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'ledgers/suppliers_statement',
			'label' => __('statements'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'ledgers/suppliers_list',
			'label' => __('management'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('allLedgers'), 
			'icon' => '<i class="material-icons ">local_library</i>',
'submenu' => [
		[
			'path' => 'ledgers/any_add',
			'label' => __('createNew'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'ledgers/any_statement',
			'label' => __('statement'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'ledgers/any_list',
			'label' => __('management'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('accountEntries'), 
			'icon' => '<i class="material-icons ">chrome_reader_mode</i>',
'submenu' => [
		[
			'path' => '',
			'label' => __('contralVoucher'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('paymentVoucher'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('receiptVoucher'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('journalVoucher'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('salesInvoice'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('purchaseInvoice'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('creditNote'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('debitNote'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('memos'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('products'), 
			'icon' => '<i class="material-icons ">settings_input_composite</i>',
'submenu' => [
		[
			'path' => 'products/product_add1',
			'label' => __('createNew'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'products/products_list',
			'label' => __('management'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'units/units_list',
			'label' => __('units'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'product_categories/categories_list',
			'label' => __('categories'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('locations'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => 'menu23',
			'label' => __('inventoryEntries'), 
			'icon' => '<i class="material-icons ">collections</i>',
'submenu' => [
		[
			'path' => 'menu23',
			'label' => __('stockJornal'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('customerLpo'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('quotationToCust'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'menu23',
			'label' => __('deliveryNote'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'menu23',
			'label' => __('grnReceiptNote'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'menu23',
			'label' => __('rejectedIn'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'menu23',
			'label' => __('rejectedOut'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'menu23',
			'label' => __('physicalStock'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('payroll'), 
			'icon' => '<i class="material-icons ">perm_contact_calendar</i>',
'submenu' => [
		[
			'path' => '',
			'label' => __('employees'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('advanceIou'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('loan'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('department'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('position'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('attendance'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('holiday'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('leaves'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('insurance'), 
			'icon' => '<i class="material-icons ">security</i>',
'submenu' => [
		[
			'path' => '',
			'label' => __('goodsInTransit'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('application'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('reports'), 
			'icon' => '<i class="material-icons ">assessment</i>',
'submenu' => [
		[
			'path' => '',
			'label' => __('dayBook'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('stockSummary'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('salesRegister'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('purchaseRegister'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('trialBalance'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('balanceSheet'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('profitLossAC'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('accordToEntries'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('chartOfAccounts'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('settings'), 
			'icon' => '<i class="material-icons ">settings</i>',
'submenu' => [
		[
			'path' => 'companies/user_list',
			'label' => __('company'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => 'options/user_list',
			'label' => __('options'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => '',
			'label' => __('manageAdmins'), 
			'icon' => '<i class="material-icons ">group</i>',
'submenu' => [
		[
			'path' => '/users/usersincomp',
			'label' => __('adminList'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('roles'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		],
		
		[
			'path' => '',
			'label' => __('permission'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_right</i>'
		]
	]
		],
		
		[
			'path' => 'auth/logout',
			'label' => __('logout'), 
			'icon' => '<i class="material-icons ">arrow_back</i>'
		]
	] ;
	}
	
		
	public static function is_active(){
		return [
		[
			'value' => 'Yes', 
			'label' => __('yes'), 
		],
		[
			'value' => 'No', 
			'label' => __('no'), 
		],] ;
	}
	
	public static function status(){
		return [
		[
			'value' => '1', 
			'label' => __('yes'), 
		],
		[
			'value' => '0', 
			'label' => __('no'), 
		],] ;
	}
	
	}
