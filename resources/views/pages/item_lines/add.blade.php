<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewItemLines'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                         
                    </a>
                </div>
                <div class="col col-md-auto  " >
                    <div class=" h5 font-weight-bold text-primary" >
                        {{ __('addNewItemLines') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class="card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form id="item_lines-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('item_lines.store') }}" method="post" >
                            @csrf
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="product_id">{{ __('productId') }}</label></th>
                                            <th class="bg-light"><label for="qty">{{ __('qty') }}</label></th>
                                            <th class="bg-light"><label for="s_price">{{ __('sPrice') }}</label></th>
                                            <th class="bg-light"><label for="amount">{{ __('amount') }}</label></th>
                                            <th class="bg-light"><label for="p_price">{{ __('pPrice') }}</label></th>
                                            <th class="bg-light"><label for="unit">{{ __('unit') }}</label></th>
                                            <th class="bg-light"><label for="comment">{{ __('comment') }}</label></th>
                                            <th class="bg-light"><label for="doc_no">{{ __('docNo') }}</label></th>
                                            <th class="bg-light"><label for="company_id">{{ __('companyId') }}</label></th>
                                            <th class="bg-light"><label for="user_id">{{ __('userId') }}</label></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="100" class="text-right">
                                        <?php $template_id = "table-row-" . random_str(); ?>
                                        <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-success btn-add-table-row"><i class="material-icons">add</i></button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!--[table row template]-->
                                <template id="<?php echo $template_id ?>">
                                <?php $row = "CURRENTROW"; // will be replaced with current row index. ?>
                                <tr data-row="<?php echo $row ?>" class="input-row">
                                <td>
                                    <div id="ctrl-product_id-row<?php echo $row; ?>-holder" class=" ">
                                    <select required=""  id="ctrl-product_id-row<?php echo $row; ?>" data-field="product_id" name="row[<?php echo $row ?>][product_id]"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                    <option value="">{{ __('selectAValue') }}</option>
                                    <?php 
                                        $options = $comp_model->product_id_option_list() ?? [];
                                        foreach($options as $option){
                                        $value = $option->value;
                                        $label = $option->label ?? $value;
                                        $selected = Html::get_field_selected('product_id', $value, "");
                                    ?>
                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                    <?php echo $label; ?>
                                    </option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-qty-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-qty-row<?php echo $row; ?>" data-field="qty"  value="<?php echo get_value('qty', "0.00") ?>" type="number" placeholder="{{ __('enterQty') }}" step="0.1"  required="" name="row[<?php echo $row ?>][qty]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-s_price-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-s_price-row<?php echo $row; ?>" data-field="s_price"  value="<?php echo get_value('s_price', "0.00") ?>" type="number" placeholder="{{ __('enterSPrice') }}" step="0.1"  required="" name="row[<?php echo $row ?>][s_price]"  class="form-control " />
                        </div>
                    </td>
                    <td>
                        <div id="ctrl-amount-row<?php echo $row; ?>-holder" class=" ">
                        <input id="ctrl-amount-row<?php echo $row; ?>" data-field="amount"  value="<?php echo get_value('amount', "0.00") ?>" type="number" placeholder="{{ __('enterAmount') }}" step="0.1"  required="" name="row[<?php echo $row ?>][amount]"  class="form-control " />
                    </div>
                </td>
                <td>
                    <div id="ctrl-p_price-row<?php echo $row; ?>-holder" class=" ">
                    <input id="ctrl-p_price-row<?php echo $row; ?>" data-field="p_price"  value="<?php echo get_value('p_price', "0.00") ?>" type="number" placeholder="{{ __('enterPPrice') }}" step="0.1"  required="" name="row[<?php echo $row ?>][p_price]"  class="form-control " />
                </div>
            </td>
            <td>
                <div id="ctrl-unit-row<?php echo $row; ?>-holder" class=" ">
                <input id="ctrl-unit-row<?php echo $row; ?>" data-field="unit"  value="<?php echo get_value('unit', "NULL") ?>" type="text" placeholder="{{ __('enterUnit') }}"  name="row[<?php echo $row ?>][unit]"  class="form-control " />
            </div>
        </td>
        <td>
            <div id="ctrl-comment-row<?php echo $row; ?>-holder" class=" ">
            <input id="ctrl-comment-row<?php echo $row; ?>" data-field="comment"  value="<?php echo get_value('comment', "NULL") ?>" type="text" placeholder="{{ __('enterComment') }}"  name="row[<?php echo $row ?>][comment]"  class="form-control " />
        </div>
    </td>
    <td>
        <div id="ctrl-doc_no-row<?php echo $row; ?>-holder" class=" ">
        <input id="ctrl-doc_no-row<?php echo $row; ?>" data-field="doc_no"  value="<?php echo get_value('doc_no', "0") ?>" type="number" placeholder="{{ __('enterDocNo') }}" step="any"  name="row[<?php echo $row ?>][doc_no]"  class="form-control " />
    </div>
</td>
<td>
    <div id="ctrl-company_id-row<?php echo $row; ?>-holder" class=" ">
    <select required=""  id="ctrl-company_id-row<?php echo $row; ?>" data-field="company_id" name="row[<?php echo $row ?>][company_id]"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
    <option value="">{{ __('selectAValue') }}</option>
    <?php 
        $options = $comp_model->company_id_option_list() ?? [];
        foreach($options as $option){
        $value = $option->value;
        $label = $option->label ?? $value;
        $selected = Html::get_field_selected('company_id', $value, "");
    ?>
    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
    <?php echo $label; ?>
    </option>
    <?php
        }
    ?>
    </select>
</div>
</td>
<td>
    <div id="ctrl-user_id-row<?php echo $row; ?>-holder" class=" ">
    <select required=""  id="ctrl-user_id-row<?php echo $row; ?>" data-field="user_id" name="row[<?php echo $row ?>][user_id]"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
    <option value="">{{ __('selectAValue') }}</option>
    <?php 
        $options = $comp_model->user_id_option_list() ?? [];
        foreach($options as $option){
        $value = $option->value;
        $label = $option->label ?? $value;
        $selected = Html::get_field_selected('user_id', $value, "");
    ?>
    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
    <?php echo $label; ?>
    </option>
    <?php
        }
    ?>
    </select>
</div>
</td>
<th class="text-center">
<button type="button" class="btn-close btn-remove-table-row"></button>
</th>
</tr>
</template>
<!--[/table row template]-->
</div>
<div class="form-ajax-status"></div>
<!--[form-button-start]-->
<div class="form-group form-submit-btn-holder text-center mt-3">
    <button class="btn btn-primary" type="submit">
    {{ __('submit') }}
    <i class="material-icons">send</i>
    </button>
</div>
<!--[form-button-end]-->
</form>
<!--[form-end]-->
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
    
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
