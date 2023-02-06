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
    $pageTitle = __('products'); //set dynamic page title
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
                        {{ __('products') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <a  class="btn btn-primary" href="<?php print_link("products/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    {{ __('addNewProducts') }} 
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
                    <div id="products-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/products/", $field_name, $field_value); ?>
                            <table class="table table-hover table-striped table-sm text-left">
                                <thead class="table-header ">
                                    <tr>
                                        <th class="td-checkbox">
                                        <label class="form-check-label">
                                        <input class="toggle-check-all form-check-input" type="checkbox" />
                                        </label>
                                        </th>
                                        <th class="td-name" > {{ __('name') }}</th>
                                        <th class="td-category" > {{ __('category') }}</th>
                                        <th class="td-qty" > {{ __('avalQty') }}</th>
                                        <th class="td-selling_price" > {{ __('sellingPrice') }}</th>
                                        <th class="td-purchase_price" > {{ __('purchasePrice') }}</th>
                                        <th class="td-user_id" > {{ __('createdBy') }}</th>
                                        <th class="td-unit" > {{ __('unit') }}</th>
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
                                        <td class="td-name">
                                            <?php echo  $data['name'] ; ?>
                                        </td>
                                        <td class="td-category">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("product_categories/view/$data[category]?subpage=1") ?>">
                                            <?php echo $data['product_categories_name'] ?>
                                        </a>
                                    </td>
                                    <td class="td-qty">
                                        <?php echo  $data['qty'] ; ?>
                                    </td>
                                    <td class="td-selling_price">
                                        <?php echo  $data['selling_price'] ; ?>
                                    </td>
                                    <td class="td-purchase_price">
                                        <?php echo  $data['purchase_price'] ; ?>
                                    </td>
                                    <td class="td-user_id">
                                        <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[user_id]?subpage=1") ?>">
                                        <?php echo $data['users_username'] ?>
                                    </a>
                                </td>
                                <td class="td-unit">
                                    <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("units/view/$data[unit]?subpage=1") ?>">
                                    <?php echo $data['units_name'] ?>
                                </a>
                            </td>
                            <!--PageComponentEnd-->
                            <td class="td-btn">
                                <div class="dropdown" >
                                    <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                    <i class="material-icons">menu</i> 
                                    </button>
                                    <ul class="dropdown-menu">
                                        <a class="dropdown-item "   href="<?php print_link("products/view/$rec_id"); ?>" >
                                        <i class="material-icons">visibility</i> {{ __('view') }}
                                    </a>
                                    <a class="dropdown-item "   href="<?php print_link("products/edit/$rec_id"); ?>" >
                                    <i class="material-icons">edit</i> {{ __('edit') }}
                                </a>
                                <a class="dropdown-item record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" href="<?php print_link("products/delete/$rec_id"); ?>" >
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
                <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("products/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
