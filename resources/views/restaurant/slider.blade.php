@extends('layouts.dashboard')

@section('title',' Card Slider')

@section('css')
    <link href="{{asset('vendor/jquery-steps/css/jquery.steps.css')}}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{trans('layout.restaurant')}}</h4>
                <p class="mb-0">{{trans('layout.restaurant_edit')}}</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{trans('layout.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('restaurant.index')}}">{{trans('layout.restaurant')}}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{trans('layout.slider')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('layout.card_slider')}}</h4>
                </div>
                <div class="card-body">
                   <form action="{{url('/slider')}}" method="post">
                    @csrf
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="text-label">{{trans('layout.slider_one')}}</label>
                        <input type="file" name="slider_image" class="form-control" accept="image/*">
                    </div>
                </div>
             <div class="col-lg-12 mb-3">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.text')}}</label>
                    <input type="text" name="slider_title" class="form-control" >

                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.button')}}</label>
                    <input type="text" name="slider_button_text" class="form-control" >

                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="form-group">
                    <label class="text-label">{{trans('layout.link')}}</label>
                    <input type="text" name="slider_button_link" class="form-control" >

                </div>
            </div>
            <input type="hidden" name="hotel_id" value="{{$id}}">
             <input type="submit" name="submit" value="submit" class="btn btn-success">
                   </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('layout.list')}}</h4>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>

                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>{{trans('layout.slider')}}</strong></th>
                                <th><strong>{{trans('layout.text')}}</strong></th>
                                <th><strong>{{trans('layout.button')}}</strong></th>
                                <th><strong>{{trans('layout.link')}}</strong></th>
                                <th><strong>{{trans('layout.action')}}</strong></th>
            
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($slider as $data_slider)
                                {{-- <?php 
                             echo"<pre>"; print_r($data_slider); die;?> --}}
                                <tr>
                                    <td>{{$data_slider->id}}</td>
                                    
                                    <td>{{$data_slider->slider_image}}</td>
                                    <td>{{$data_slider->slider_title}}</td>
                                    <td>{{$data_slider->slider_button_text}}</td>
                                    <td>{{$data_slider->slider_button_link}}</td>
                                    <{{-- td><a class="dropdown-item"
                                                   href="{{route('slider.edit',[$data_slider->id])}}">{{trans('layout.edit')}}</a></td> --}}

                                </tr>
                         
                           @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{asset('js/plugins-init/jquery-steps-init.js')}}"></script>
@endsection
