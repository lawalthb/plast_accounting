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
    $pageTitle = __('options'); //set dynamic page title
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
                        {{ __('options') }}
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
                        <div id="options-user_list-records">
                            <div id="page-main-content" class="table-responsive">
                                <?php Html::page_bread_crumb("/options/user_list", $field_name, $field_value); ?>
                                <table class="table table-hover table-striped table-sm text-left">
                                    <thead class="table-header ">
                                        <tr>
                                            <th class="td-option_name" > {{ __('optionName') }}</th>
                                            <th class="td-option_value" > {{ __('optionValue') }}</th>
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
                                            <td class="td-option_name">
                                                <?php echo  $data['option_name'] ; ?>
                                            </td>
                                            <td class="td-option_value">
                                                <?php echo  $data['option_value'] ; ?>
                                            </td>
                                            <!--PageComponentEnd-->
                                            <td class="td-btn">
                                                <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("options/user_edit/$rec_id"); ?>" >
                                                <i class="material-icons">edit</i> {{ __('edit') }}
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
                                        <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("options/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
                </div>
            </div>
            <div class="col-12 comp-grid " >
                <div class=" "><!-- how to use options
                    <div>{{alloption('color')}}</div>
                    -->
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
