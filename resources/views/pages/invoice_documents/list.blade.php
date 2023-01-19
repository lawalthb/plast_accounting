<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('invoiceDocuments'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="col col-md-auto  " >
                    <div class=" h5 font-weight-bold text-primary" >
                        {{ __('invoiceDocuments') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <a  class="btn btn-primary" href="<?php print_link("invoice_documents/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    {{ __('addNewInvoiceDocuments') }} 
                </a>
            </div>
            <div class="col-md-3  " >
                <!-- Page drop down search component -->
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="{{ __('search') }}" />
                        <button class="btn btn-primary"><i class="material-icons">search</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 comp-grid " >
                <?php Html::display_page_errors($errors); ?>
                <div  class=" page-content" >
                    <div id="invoice_documents-list-records">
                        <div class="row gutter-lg ">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">
                                    <?php Html::page_bread_crumb("/invoice_documents/", $field_name, $field_value); ?>
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header ">
                                            <tr>
                                                <th class="td-checkbox">
                                                <label class="form-check-label">
                                                <input class="toggle-check-all form-check-input" type="checkbox" />
                                                </label>
                                                </th>
                                                <th class="td-" > </th><th class="td-id" > {{ __('id') }}</th>
                                                <th class="td-doc_date" > {{ __('docDate') }}</th>
                                                <th class="td-doc_no" > {{ __('docNo') }}</th>
                                                <th class="td-comment" > {{ __('comment') }}</th>
                                                <th class="td-doc_type" > {{ __('docType') }}</th>
                                                <th class="td-user_id" > {{ __('userId') }}</th>
                                                <th class="td-company_id" > {{ __('companyId') }}</th>
                                                <th class="td-status" > {{ __('status') }}</th>
                                                <th class="td-customer_legder_id" > {{ __('customerLegderId') }}</th>
                                                <th class="td-sales_ledger_id" > {{ __('salesLedgerId') }}</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                            if($total_records){
                                        ?>
                                        <tbody class="page-data">
                                            <!--record-->
                                            <?php
                                                $counter = 0;
                                                foreach($records as $data){
                                                $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                                $counter++;
                                            ?>
                                            <tr>
                                                <td class=" td-checkbox">
                                                    <label class="form-check-label">
                                                    <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                    </label>
                                                </td>
                                                <!--PageComponentStart-->
                                                <td class="td-masterdetailbtn">
                                                    <a data-page-id="invoice_documents-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("invoice_documents/masterdetail/$data[id]"); ?>">
                                                    <i class="material-icons">more_vert</i> 
                                                </a>
                                            </td>
                                            <td class="td-id">
                                                <a href="<?php print_link("invoice_documents/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                            </td>
                                            <td class="td-doc_date">
                                                <?php echo  $data['doc_date'] ; ?>
                                            </td>
                                            <td class="td-doc_no">
                                                <?php echo  $data['doc_no'] ; ?>
                                            </td>
                                            <td class="td-comment">
                                                <?php echo  $data['comment'] ; ?>
                                            </td>
                                            <td class="td-doc_type">
                                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("source_documents/view/$data[doc_type]?subpage=1") ?>">
                                                <i class="material-icons">visibility</i> <?php echo "Source Documents" ?>
                                            </a>
                                        </td>
                                        <td class="td-user_id">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[user_id]?subpage=1") ?>">
                                            <i class="material-icons">visibility</i> <?php echo "Users" ?>
                                        </a>
                                    </td>
                                    <td class="td-company_id">
                                        <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("companies/view/$data[company_id]?subpage=1") ?>">
                                        <i class="material-icons">visibility</i> <?php echo "Companies" ?>
                                    </a>
                                </td>
                                <td class="td-status">
                                    <?php echo  $data['status'] ; ?>
                                </td>
                                <td class="td-customer_legder_id">
                                    <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("ledgers/view/$data[customer_legder_id]?subpage=1") ?>">
                                    <i class="material-icons">visibility</i> <?php echo "Ledgers" ?>
                                </a>
                            </td>
                            <td class="td-sales_ledger_id">
                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("sub_account_group/view/$data[sales_ledger_id]?subpage=1") ?>">
                                <i class="material-icons">visibility</i> <?php echo "Sub Account Group" ?>
                            </a>
                        </td>
                        <!--PageComponentEnd-->
                        <td class="td-btn">
                            <div class="dropdown" >
                                <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                <i class="material-icons">menu</i> 
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item "   href="<?php print_link("invoice_documents/view/$rec_id"); ?>" >
                                    <i class="material-icons">visibility</i> {{ __('view') }}
                                </a>
                                <a class="dropdown-item "   href="<?php print_link("invoice_documents/edit/$rec_id"); ?>" >
                                <i class="material-icons">edit</i> {{ __('edit') }}
                            </a>
                            <a class="dropdown-item record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" href="<?php print_link("invoice_documents/delete/$rec_id"); ?>" >
                            <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                        </a>
                    </ul>
                </div>
            </td>
        </tr>
        <?php 
            }
        ?>
        <!--endrecord-->
    </tbody>
    <tbody class="search-data"></tbody>
    <?php
        }
        else{
    ?>
    <tbody class="page-data">
        <tr>
            <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                <i class="material-icons">block</i> {{ __('noRecordFound') }}
            </td>
        </tr>
    </tbody>
    <?php
        }
    ?>
</table>
</div>
<?php
    if($show_footer){
?>
<div class=" mt-3">
    <div class="row align-items-center justify-content-between">    
        <div class="col-md-auto justify-content-center">    
            <div class="d-flex justify-content-start">  
                <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("invoice_documents/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                <i class="material-icons">delete_sweep</i> {{ __('deleteSelected') }}
                </button>
            </div>
        </div>
        <div class="col">   
            <?php
                if($show_pagination == true){
                $pager = new Pagination($total_records, $record_count);
                $pager->show_page_count = false;
                $pager->show_record_count = true;
                $pager->show_page_limit =false;
                $pager->limit = $limit;
                $pager->show_page_number_list = true;
                $pager->pager_link_range=5;
                $pager->render();
                }
            ?>
        </div>
    </div>
</div>
<?php
    }
?>
</div>
<!-- Detail Page Column -->
<?php if(!request()->has('subpage')){ ?>
<div class="col-12">
    <div class=" ">
        <div id="invoice_documents-detail-page" class="master-detail-page"></div>
    </div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection
<!-- Page custom css -->
@section('pagecss')
<style>

</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    <!--pageautofill-->
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
