@extends('layouts.dashboard')

@section('title',trans('layout.user'))

@section('css')

@endsection

@section('main-content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{trans('layout.user')}}</h4>
                <p class="mb-0"></p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{trans('layout.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{trans('layout.user')}}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('layout.user')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    	<table class="table table-responsive-md" id="customers">
                            <thead class="text-center">
                            <tr>
                                <th><strong>{{trans('layout.name')}}</strong></th>
                                <th><strong>{{trans('layout.phone_number')}}</strong></th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            	@if($users)
                            		@foreach($users as $user)
                            			<tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->number}}</td> 
                                    </tr>
                            		@endforeach
                            	@endif
                            </tbody>
                        </table>
                   	</div>
                </div>




    		</div>
        </div>
    </div>


    
    @endsection