<!DOCTYPE html>
<html lang="{{session()->get('locale')}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('uploads/'.json_decode(get_settings('site_setting'))->favicon)}}">

    <link href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">

    <link href="{{asset('vendor/lineicons/2.0/LineIcons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("vendor/toastr/css/toastr.min.css")}}">
    @yield('css')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
</head>
<body>


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper" class="place-order-front-sec new-cat-design">
    <div class="nav-header">
        <div class="nav-control nav-controls-box">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>

    <div class="header front_res_header ">
        <div class="header-content">

            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between navbar-collapse-box">

                </div>

                    <div class="header-left front_res_logo your-hotel-logo">
                        @if($restaurant->profile_image)
                         <a href="{{route('show.restaurant',['slug'=>$restaurant->slug])}}"> <img class="cover-img" src="{{asset('uploads/'.$restaurant->profile_image)}}" alt=""></a>
                        @endif
                    </div>



                <div class="home-icon">

                      <a  data-target="#service" class="collapsed" href="{{route('show.restaurant',['slug'=>$restaurant->slug])}}"><img src="{{asset('images/icons/Iconfeatherhome.png')}}"></a>

                </div>
            </nav>
        </div>
        @if(Request::url() == 'https://demo.qricle.com/restaurant/qricle-demo/roomservice')
        <div class="container-fluid room_service_top_icons">
                                <div class="card-deck room_card row justify-content-around">
                                    <div class="card col-8 room_card_content p-0 service_room_sec">
                                        <div class="service-room card-body d-flex justify-content-center align-items-center">
                                            <img class="room-sec-img" src="{{asset('uploads/service.svg')}}">
                                            <h5 class="card-title ml-3 call-room pb-3 mb-0">Call Room <br> Service</h5>
                                        </div>
                                    </div>
                                    <div class="card col-3 room_card_content p-0 service_room_sec">
                                        <div class="wifi-sec card-body d-flex flex-column align-items-center">
                                            <img class="wifi-img" src="{{asset('uploads/iconwifi.svg')}}">
                                            <h5 class="card-title text-center">Request Wifi</h4>
                                        </div>
                                    </div>
                                </div>
                        </div>
        @endif
        @php 
        $url=substr(Request::url(), strrpos(Request::url(), '/') + 1);
        @endphp
        
        <div class="header-left front_res_logo my-logo @if(Request::url() == 'https://demo.qricle.com/restaurant/qricle-demo/roomservice') room_service_header @endif">
                    @if($url == 'foodservice')
                        @if($restaurant->foodservice_image)
                        <img class="cover-img" src="{{asset('uploads/'.$restaurant->foodservice_image)}}" alt="">
                        @endif

                    @elseif($url == 'roomservice')
                        @if($restaurant->roomservice_image)
                         <img class="cover-img" src="{{asset('uploads/'.$restaurant->roomservice_image)}}" alt="">
                        @endif

                    @else
                    
                        @if($restaurant->background_image)
                        <img class="cover-img" src="{{asset('uploads/'.$restaurant->background_image)}}" alt="">
                        @endif

                    @endif
        </div>
    </div>

        <div class="header-left front_res_logo">
                        @if($restaurant->background_image)

                        <img class="cover-img" src="{{asset('uploads/'.$restaurant->background_image)}}" alt="">
                        @endif
                    </div>
    </div>

    <div class="deznav">
        <div class="deznav-scroll">
            @if(isset($rest_categories))
                @include('layouts.includes.food_service_sidebar')
            @elseif(isset($room_categories))
                @include('layouts.includes.room_service_sidebar')
            @else
                @include('layouts.includes.restaurant_sidebar')

            @endif

        </div>
    </div>

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid restu_front">
            @yield('main-content')
        </div>
    </div>
    <div class="footer">
        <div class="copyright">
            <p>{{trans('layout.copyright_footer')}} <a href="https://www.qricle.com" target="_blank">Qricle</a> {{date('Y')}}</p>
        </div>
    </div>
</div>

<!-- Confirmation modal -->
<div class="modal fade" id="modal-confirm">
    <div class="modal-dialog">
        <form id="modal-form">
            @csrf
            <div id="customInput"></div>
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h4 class="modal-title">{{trans('layout.confirmation')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer p-2">
                    <button id="modal-confirm-btn" type="button"
                            class="btn btn-primary btn-sm">{{trans('layout.confirm')}}</button>
                    <button type="button" class="btn btn-secondary btn-sm"
                            data-dismiss="modal">{{trans('layout.cancel')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Delivered Within modal -->
<div class="modal fade" id="delivered_within_modal">
    <div class="modal-dialog">
        <form id="delivered_within_modal_form" method="post" action="{{route('order.update.status')}}">
            @csrf
            <div id="deliveredWithinCustomInput"></div>
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h4 class="modal-title">{{trans('layout.confirmation')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>{{trans('layout.within')}}</label>
                            <input name="time" required type="number" class="form-control" placeholder="Ex: 20">
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{trans('layout.time')}}</label>
                            <select name="type" class="form-control" required>
                                <option value="minutes">{{trans('layout.minutes')}}</option>
                                <option value="hours">{{trans('layout.hours')}}</option>
                                <option value="days">{{trans('layout.days')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-2">
                    <button id="within-modal-confirm-btn" type="submit"
                            class="btn btn-primary btn-sm">{{trans('layout.confirm')}}</button>
                    <button type="button" class="btn btn-secondary btn-sm"
                            data-dismiss="modal">{{trans('layout.cancel')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('vendor/global/global.min.js')}}"></script>
<script src="{{asset('vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

<script src="{{asset('js/custom.min.js')}}"></script>
<script src="{{asset('js/deznav-init.js')}}"></script>
<script src="{{asset("vendor/toastr/js/toastr.min.js")}}"></script>


<!-- Toastr -->

@php $allErrors=''; @endphp

@if (isset($errors) && count($errors) > 0)
    @foreach ($errors->all() as $error)
        @php $allErrors.=$error.'<br/>' @endphp
    @endforeach
    <script>
        $(function () {
            toastr.error('{!! clean($allErrors) !!}', 'Failed', {timeOut: 5000});
        });

    </script>
@endif
@if(session()->has('success'))
    <script>
        $(function () {
            toastr.info('{{session()->get('success')}}', 'Success', {
                positionClass: "toast-top-right",
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            });
        });

    </script>
@endif
@yield('js')


</body>

</html>
