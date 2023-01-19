<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewInvoiceDocuments'); //set dynamic page title
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
                        {{ __('addNewInvoiceDocuments') }}
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
                        <form id="invoice_documents-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('invoice_documents.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="doc_date">{{ __('docDate') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-doc_date-holder" class="input-group "> 
                                            <input id="ctrl-doc_date" data-field="doc_date" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('doc_date', date('Y-m-d', strtotime('-1day'))) ?>" type="datetime" name="doc_date" placeholder="{{ __('enterDocDate') }}" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="doc_no">{{ __('docNo') }} </label>
                                        <div id="ctrl-doc_no-holder" class=" "> 
                                            <input id="ctrl-doc_no" data-field="doc_no"  value="<?php echo get_value('doc_no', "NULL") ?>" type="text" placeholder="{{ __('enterDocNo') }}"  name="doc_no"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                                <input id="ctrl-comment" data-field="comment"  value="<?php echo get_value('comment') ?>" type="hidden" placeholder="{{ __('enterComment') }}"  name="comment"  class="form-control " />
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="doc_type">{{ __('docType') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-doc_type-holder" class=" "> 
                                            <select required=""  id="ctrl-doc_type" data-field="doc_type" name="doc_type"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                            <option value="">{{ __('selectAValue') }}</option>
                                            <?php 
                                                $options = $comp_model->doc_type_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('doc_type', $value, "");
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="customer_legder_id">{{ __('customerLegder') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-customer_legder_id-holder" class=" "> 
                                            <select required=""  id="ctrl-customer_legder_id" data-field="customer_legder_id" name="customer_legder_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                            <option value="">{{ __('selectAValue') }}</option>
                                            <?php 
                                                $options = $comp_model->customer_legder_id_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('customer_legder_id', $value, "");
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input id="ctrl-user_id" data-field="user_id"  value="<?php echo get_value('user_id', auth()->user()->id) ?>" type="hidden" placeholder="{{ __('enterUserId') }}" list="user_id_list"  required="" name="user_id"  class="form-control " />
                                <datalist id="user_id_list">
                                <?php 
                                    $options = $comp_model->user_id_option_list() ?? [];
                                    foreach($options as $option){
                                    $value = $option->value;
                                    $label = $option->label ?? $value;
                                ?>
                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                <?php
                                    }
                                ?>
                                </datalist>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="sales_ledger_id">{{ __('salesLedger') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-sales_ledger_id-holder" class=" "> 
                                            <select required=""  id="ctrl-sales_ledger_id" data-field="sales_ledger_id" name="sales_ledger_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                            <option value="">{{ __('selectAValue') }}</option>
                                            <?php 
                                                $options = $comp_model->sales_ledger_id_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('sales_ledger_id', $value, "");
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                            <?php echo $label; ?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input id="ctrl-company_id" data-field="company_id"  value="<?php echo get_value('company_id', auth()->user()->company_id) ?>" type="hidden" placeholder="{{ __('enterCompanyId') }}" list="company_id_list"  required="" name="company_id"  class="form-control " />
                                <datalist id="company_id_list">
                                <?php 
                                    $options = $comp_model->company_id_option_list() ?? [];
                                    foreach($options as $option){
                                    $value = $option->value;
                                    $label = $option->label ?? $value;
                                ?>
                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                <?php
                                    }
                                ?>
                                </datalist>
                            </div>
                            <div class="form-ajax-status"></div>
                            <div class="bg-light p-2 subform">
                                <h4 class="record-title">Add New Item Lines</h4>
                                <hr />
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
                                        <select required=""  id="ctrl-product_id-row<?php echo $row; ?>" data-field="product_id" name="item_lines[<?php echo $row ?>][product_id]"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
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
                                    <input id="ctrl-qty-row<?php echo $row; ?>" data-field="qty"  value="<?php echo get_value('qty', "0.00") ?>" type="number" placeholder="{{ __('enterQty') }}" step="0.1"  required="" name="item_lines[<?php echo $row ?>][qty]"  class="form-control " />
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-s_price-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-s_price-row<?php echo $row; ?>" data-field="s_price"  value="<?php echo get_value('s_price', "0.00") ?>" type="number" placeholder="{{ __('enterSPrice') }}" step="0.1"  required="" name="item_lines[<?php echo $row ?>][s_price]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-amount-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-amount-row<?php echo $row; ?>" data-field="amount"  value="<?php echo get_value('amount', "0.00") ?>" type="number" placeholder="{{ __('enterAmount') }}" step="0.1"  required="" name="item_lines[<?php echo $row ?>][amount]"  class="form-control " />
                        </div>
                    </td>
                    <td>
                        <div id="ctrl-p_price-row<?php echo $row; ?>-holder" class=" ">
                        <input id="ctrl-p_price-row<?php echo $row; ?>" data-field="p_price"  value="<?php echo get_value('p_price', "0.00") ?>" type="number" placeholder="{{ __('enterPPrice') }}" step="0.1"  required="" name="item_lines[<?php echo $row ?>][p_price]"  class="form-control " />
                    </div>
                </td>
                <td>
                    <div id="ctrl-unit-row<?php echo $row; ?>-holder" class=" ">
                    <input id="ctrl-unit-row<?php echo $row; ?>" data-field="unit"  value="<?php echo get_value('unit', "NULL") ?>" type="text" placeholder="{{ __('enterUnit') }}"  name="item_lines[<?php echo $row ?>][unit]"  class="form-control " />
                </div>
            </td>
            <td>
                <div id="ctrl-comment-row<?php echo $row; ?>-holder" class=" ">
                <input id="ctrl-comment-row<?php echo $row; ?>" data-field="comment"  value="<?php echo get_value('comment', "NULL") ?>" type="text" placeholder="{{ __('enterComment') }}"  name="item_lines[<?php echo $row ?>][comment]"  class="form-control " />
            </div>
        </td>
        <td>
            <div id="ctrl-doc_no-row<?php echo $row; ?>-holder" class=" ">
            <input id="ctrl-doc_no-row<?php echo $row; ?>" data-field="doc_no"  value="<?php echo get_value('doc_no', "0") ?>" type="number" placeholder="{{ __('enterDocNo') }}" step="any"  name="item_lines[<?php echo $row ?>][doc_no]"  class="form-control " />
        </div>
    </td>
    <td>
        <div id="ctrl-company_id-row<?php echo $row; ?>-holder" class=" ">
        <select required=""  id="ctrl-company_id-row<?php echo $row; ?>" data-field="company_id" name="item_lines[<?php echo $row ?>][company_id]"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
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
    <select required=""  id="ctrl-user_id-row<?php echo $row; ?>" data-field="user_id" name="item_lines[<?php echo $row ?>][user_id]"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
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
</div>
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
