@extends('layouts.front_dashboard')
@section('title',trans('layout.restaurant').' | '.$restaurant->name)

@section('css')
<link href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />

<style>
    .dropdown.bootstrap-select.swal2-select {
        display: none !important;
    }
</style>

@endsection

@section('main-content')
<div class="restaurant_page tour-guide">
    <div id="restaurant-section">
        <div class="row qricle-demo">
            <div class="col-lg-12">
                <div class="profile card card-body">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-wrapper tour_head">
                               <span>{{trans('layout.tour_guide')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <!--Accordion wrapper-->
  <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

    <!-- Accordion card -->
    <div class="card m-3">

      <!-- Card header -->
      <div class="card-header " role="tab" id="headingOne1">
        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
           aria-controls="collapseOne1" class="d-flex justify-content-between w-100">
          <h5 class="mb-0">
            Top 10 places to visit near Kasuali 
          </h5>
          <i class="fa fa-angle-down fa-2x"></i>
        </a>
      </div>

      <!-- Card body -->
      <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
           data-parent="#accordionEx">
        <div class="card-body">
         Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>

    </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card m-3">

      <!-- Card header -->
      <div class="card-header" role="tab" id="headingTwo2">
        <a class="collapsed d-flex justify-content-between w-100" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
           aria-expanded="false" aria-controls="collapseTwo2">
          <h5 class="mb-0">
            Top 5 places to eat in Kasuali 
          </h5>
          <i class="fa fa-angle-down fa-2x"></i>
        </a>
      </div>

      <!-- Card body -->
      <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
           data-parent="#accordionEx">
        <div class="card-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>

    </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card m-3">

      <!-- Card header -->
      <div class="card-header" role="tab" id="headingThree3">
        <a class="collapsed d-flex justify-content-between w-100" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
           aria-expanded="false" aria-controls="collapseThree3">
          <h5 class="mb-0">
             5 facts about Kasuali
          </h5>
           <i class="fa fa-angle-down fa-2x"></i>
        </a>
      </div>

      <!-- Card body -->
      <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
           data-parent="#accordionEx">
        <div class="card-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>

    </div>
    <div class="card m-3">

      <!-- Card header -->
      <div class="card-header" role="tab" id="headingThree4">
        <a class="collapsed d-flex justify-content-between w-100" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree4"
           aria-expanded="false" aria-controls="collapseThree4">
          <h5 class="mb-0">
             Historical Facts 
          </h5>
          <i class="fa fa-angle-down fa-2x"></i>
        </a>
      </div>

      <!-- Card body -->
      <div id="collapseThree4" class="collapse" role="tabpanel" aria-labelledby="headingThree4"
           data-parent="#accordionEx">
        <div class="card-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>

    </div>
    <!-- Accordion card -->

  </div>
  <!-- Accordion wrapper -->


    
@endsection