<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('myAccount'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content" >
                        <?php
                            $counter = 0;
                            if($data){
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                            $counter++;
                        ?>
                        <div class="bg-primary m-2 mb-4">
                            <div class="profile">
                                <div class="avatar">
                                    <?php 
                                        $user_photo = $user->UserPhoto();
                                        if($user_photo){
                                        Html::page_img($user_photo, 100, 100, "small", "large"); 
                                        }
                                    ?>
                                </div>
                                <h1 class="title mt-4"><?php echo $data['username']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mx-3 mb-3">
                                    <ul class="nav nav-pills flex-column text-left">
                                        <li class="nav-item">
                                            <a data-bs-toggle="tab" href="#AccountPageView" class="nav-link active">
                                                <i class="material-icons">account_box</i> {{ __('accountDetail') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-bs-toggle="tab" href="#AccountPageEdit" class="nav-link">
                                                <i class="material-icons">edit</i> {{ __('editAccount') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-bs-toggle="tab" href="#AccountPageChangePassword" class="nav-link">
                                                <i class="material-icons">lock</i> {{ __('changePassword') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active fade" id="AccountPageView" role="tabpanel">
                                            <div class="page-data">
                                                <!--PageComponentStart-->
                                                <div class="mb-3 row ">
                                                    <div class="border-top td-firstname p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('firstname') }}</div>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['firstname'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-lastname p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('lastname') }}</div>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['lastname'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-email p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('email') }}</div>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['email'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-role_id p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('roleId') }}</div>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['role_id'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-phone p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('phone') }}</div>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['phone'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-user_type p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('userType') }}</div>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['user_type'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-date_join p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('dateJoin') }}</div>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['date_join'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-is_active p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('isActive') }}</div>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['is_active'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="border-top td-company_id p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <div class="text-muted"> {{ __('companyName') }}</div>
                                                                <div class="fw-bold">
                                                                    <div class="inline-page">
                                                                        <a class="btn btn-sm btn btn-secondary open-page-inline" href="<?php print_link("companies//$data[company_id]?subpage=1"); ?>">
                                                                        <?php echo $data['companies_name'] ?>
                                                                    </a>
                                                                    <div class="page-content reset-grids d-none"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-top td-username p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="text-muted"> {{ __('username') }}</div>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['username'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--PageComponentEnd-->
                                            <div class="d-flex gap-1 justify-content-start">
                                                <a class="btn btn-sm btn-success has-tooltip "   title="{{ __('edit') }}" href="<?php print_link("users/edit/$rec_id"); ?>" >
                                                <i class="material-icons">edit</i> {{ __('edit') }}
                                            </a>
                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" title="{{ __('delete') }}" href="<?php print_link("users/delete/$rec_id?redirect=users"); ?>" >
                                            <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="AccountPageEdit" role="tabpanel">
                                <div class=" reset-grids">
                                    <x-sub-page url="{{ url('account/edit') }}"></x-sub-page>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="AccountPageChangePassword" role="tabpanel">
                                <div class=" reset-grids">
                                    @include("pages.account.changepassword")
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
                else{
            ?>
            <!-- Empty Record Message -->
            <div class="text-muted p-3">
                <i class="material-icons">block</i> {{ __('noRecordFound') }}
            </div>
            <?php
                }
            ?>
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
<!--custom page css--><!--pagecss-->
</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    <!--pageautofill--><!--custom page js--><!--pagejs-->
</script>
@endsection
