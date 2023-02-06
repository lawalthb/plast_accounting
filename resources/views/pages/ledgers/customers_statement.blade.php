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
    $pageTitle = __('customersList'); //set dynamic page title
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
                        {{ __('customersStatement') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
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
                        <div id="ledgers-customers_statement-records">
                            <div class="row gutter-lg ">
                                <div class="col">
                                    <div id="page-main-content" class="table-responsive">
                                        <?php Html::page_bread_crumb("/ledgers/customers_statement", $field_name, $field_value); ?>
                                        <table class="table table-hover table-striped table-sm text-left">
                                            <thead class="table-header ">
                                                <tr>
                                                    <th class="td-" > </th><th class="td-id" > {{ __('id') }}</th>
                                                    <th class="td-ledger_name" > {{ __('ledgerName') }}</th>
                                                    <th class="td-credit_amount" > {{ __('creditAmount') }}</th>
                                                    <th class="td-debit_amount" > {{ __('debitAmount') }}</th>
                                                    <th class="td-balance" > {{ __('balance') }}</th>
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
                                                    <!--PageComponentStart-->
                                                    <td class="td-masterdetailbtn">
                                                        <a data-page-id="ledgers-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("ledgers/masterdetail/$data[id]"); ?>">
                                                        <i class="material-icons">more_vert</i> 
                                                    </a>
                                                </td>
                                                <td class="td-id">
                                                    <?php echo  $data['id'] ; ?>
                                                </td>
                                                <td class="td-ledger_name">
                                                    <?php echo  $data['ledger_name'] ; ?>
                                                </td>
                                                <td class="td-credit_amount">
                                                    <?php echo  $data['credit_amount'] ; ?>
                                                </td>
                                                <td class="td-debit_amount">
                                                    <?php echo  $data['debit_amount'] ; ?>
                                                </td>
                                                <td class="td-balance">
                                                    <?php echo  $data['balance'] ; ?>
                                                </td>
                                                <!--PageComponentEnd-->
                                                <td class="td-btn">
                                                    <a class="btn btn-sm btn-primary has-tooltip "   title="{{ __('view') }}" href="<?php print_link("#/$rec_id"); ?>" >
                                                    <i class="material-icons ">pageview</i> {{ __('view') }}
                                                </a>
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
                                            <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("ledgers/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
                                <div id="ledgers-detail-page" class="master-detail-page"></div>
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
