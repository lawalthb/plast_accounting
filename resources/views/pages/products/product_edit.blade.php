<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editProducts'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
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
                        {{ __('editProducts') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("products/product_edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="category">{{ __('category') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-category-holder" class=" "> 
                                        <select required=""  id="ctrl-category" data-field="category" name="category"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                        <option value="">{{ __('selectAValue') }}</option>
                                        <?php
                                            $options = $comp_model->category_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = ( $value == $data['category'] ? 'selected' : null );
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
                                    <label class="control-label" for="name">{{ __('productName') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-name-holder" class=" "> 
                                        <input id="ctrl-name" data-field="name"  value="<?php  echo $data['name']; ?>" type="text" placeholder="{{ __('enterProductName') }}"  required="" name="name"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="unit">{{ __('unit') }} </label>
                                    <div id="ctrl-unit-holder" class=" "> 
                                        <select  id="ctrl-unit" data-field="unit" name="unit"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                        <option value="">{{ __('selectAValue') }}</option>
                                        <?php
                                            $options = $comp_model->unit_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = ( $value == $data['unit'] ? 'selected' : null );
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
                                    <label class="control-label" for="qty">{{ __('qty') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-qty-holder" class=" "> 
                                        <input id="ctrl-qty" data-field="qty"  value="<?php  echo $data['qty']; ?>" type="number" placeholder="{{ __('enterQty') }}" step="0.1"  required="" name="qty"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="selling_price">{{ __('sellingPrice') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-selling_price-holder" class=" "> 
                                        <input id="ctrl-selling_price" data-field="selling_price"  value="<?php  echo $data['selling_price']; ?>" type="number" placeholder="{{ __('enterSellingPrice') }}" step="0.1"  required="" name="selling_price"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="purchase_price">{{ __('purchasePrice') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-purchase_price-holder" class=" "> 
                                        <input id="ctrl-purchase_price" data-field="purchase_price"  value="<?php  echo $data['purchase_price']; ?>" type="number" placeholder="{{ __('enterPurchasePrice') }}" step="0.1"  required="" name="purchase_price"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="dead_stock">{{ __('deadStock') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-dead_stock-holder" class=" "> 
                                        <?php
                                            $options = Menu::is_active();
                                            $field_value = $data['dead_stock'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if value is among checked options
                                            $checked = Html::get_record_checked($field_value, $value);
                                        ?>
                                        <label class="option-btn">
                                        <input class="btn-check" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="dead_stock" />
                                        <span class="btn btn-outline-secondary"><?php echo $label ?></span>
                                        </label>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="is_active">{{ __('isActive') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-is_active-holder" class=" "> 
                                        <?php
                                            $options = Menu::is_active();
                                            $field_value = $data['is_active'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if value is among checked options
                                            $checked = Html::get_record_checked($field_value, $value);
                                        ?>
                                        <label class="option-btn">
                                        <input class="btn-check" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="is_active" />
                                        <span class="btn btn-outline-secondary"><?php echo $label ?></span>
                                        </label>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <input id="ctrl-user_id" data-field="user_id"  value="<?php  echo $data['user_id']; ?>" type="hidden" placeholder="{{ __('enterUserId') }}" list="user_id_list"  required="" name="user_id"  class="form-control " />
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
                                    <label class="control-label" for="exp_date">{{ __('expDate') }} </label>
                                    <div id="ctrl-exp_date-holder" class="input-group "> 
                                        <input id="ctrl-exp_date" data-field="exp_date" class="form-control datepicker  datepicker"  value="<?php  echo $data['exp_date']; ?>" type="datetime" name="exp_date" placeholder="{{ __('enterExpDate') }}" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="mfg_date">{{ __('mfgDate') }} </label>
                                    <div id="ctrl-mfg_date-holder" class="input-group "> 
                                        <input id="ctrl-mfg_date" data-field="mfg_date" class="form-control datepicker  datepicker"  value="<?php  echo $data['mfg_date']; ?>" type="datetime" name="mfg_date" placeholder="{{ __('enterMfgDate') }}" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="image">{{ __('productImage') }} </label>
                                <div id="ctrl-image-holder" class=" "> 
                                    <div class="dropzone " input="#ctrl-image" fieldname="image" uploadurl="{{ url('fileuploader/upload/image') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                        <input name="image" id="ctrl-image" data-field="image" class="dropzone-input form-control" value="<?php  echo $data['image']; ?>" type="text"  />
                                        <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                    </div>
                                </div>
                                <?php Html :: uploaded_files_list($data['image'], '#ctrl-image'); ?>
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            {{ __('update') }}
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
    <!--pageautofill-->
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
