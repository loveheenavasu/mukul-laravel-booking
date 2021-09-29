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
<div class="about-page-new">
@section('main-content')
<div class="restaurant_page ">
    <div id="restaurant-section">
        <div class="row qricle-demo">
            <div class="col-lg-12">
                <div class="profile card card-body px-0 pt-0 pb-0 mb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-wrapper">
                                <img class="cover-img" src="{{asset('uploads/res1.jpeg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="restaurant_content-sec card-des">
            <div class="row">
                <div class="card-body about-title w-100">
                    <span><?php echo strip_tags($restaurant->description);?></span>
                </div>
            </div>
       	</div>
        <div class="restaurant_content">
        	<div class="card-body about-title ">
            	<div class="location_content ">
                    <i class="fa fa-map-marker fa-2x"></i>
                    <p>{{$restaurant->location}}</p>
                </div>
                <div class="phone_content">
            	<i class="fa fa-volume-control-phone fa-2x"></i>
                <p>{{$restaurant->phone_number}}

                </p>
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
<div class="visit-site call-site py-3 text-center">
    <a href="{{route('show.restaurant',['slug'=>$restaurant->slug])}}" class="d-inline-block"><p class="para-content">{{trans('layout.visit_website')}}</p></a>
</div>


    
@endsection