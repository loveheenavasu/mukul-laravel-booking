@extends('layouts.dashboard')

@section('title',trans('layout.order_list'))

@section('css')
    <link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
   {{--  <script src="jquery-3.5.1.min.js"></script> --}}
    <script>
        let orderDataTable='';
    </script>
    {{-- <meta http-equiv="refresh" content="15">     --}}
@endsection

@section('main-content')

    <audio id="audio" controls preload="none" allow="autoplay" style="display: none">
      <source src="{{url('sounds/notification.wav')}}" type="audio/ogg">
    </audio>
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{trans('layout.order')}}</h4>
                <p class="mb-0">{{trans('layout.your_order')}}</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{trans('layout.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{trans('layout.orders')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('layout.list')}}</h4>
                    <div class="pull-right">
                        <button type="button" id="check_new_order" class="btn btn-sm btn-info">{{trans('layout.check_new_order')}}</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md" id="orderTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><strong>{{trans('layout.name')}}</strong></th>
                                <th><strong>{{trans('layout.restaurant')}}</strong></th>
                                <th><strong>{{trans('layout.table')}}</strong></th>
                                <th><strong>{{trans('layout.amount')}}</strong></th>
                                <th><strong>{{trans('layout.items')}}</strong></th>
                                <th><strong>{{trans('layout.payment_status')}}</strong></th>
                                <th><strong>{{trans('layout.status')}}</strong></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script !src="">
        "use strict";

        function generateActionButton(order){
            let html='';
            const deleteHtml=`<button class="dropdown-item" type="button"
                                                        data-message="{{trans('layout.message.order_delete_warning')}}"
                                                        data-action='{{route('order.delete')}}'
                                                        data-input={"id":"${order.id}","_method":"delete"}
                                                        data-toggle="modal"
                                                        data-target="#modal-confirm">{{trans('layout.delete')}}</button>`;
            if(order.status=='pending'){
                html=`<button class="dropdown-item" type="button"
                                                        data-message="{{trans('layout.message.order_status_warning',['status'=>'Approved'])}}"
                                                        data-action='{{route('order.update.status')}}'
                                                        data-input={"status":"approved","order_id":"${order.id}"}
                                                        data-toggle="modal"
                                                        data-isAjax="true"
                                                        data-target="#modal-confirm">{{trans('layout.approved')}}</button>`;
            }else if(order.status=='approved'){
                html=`<button class="dropdown-item" type="button"
                                                        data-message="{{trans('layout.message.order_status_warning',['status'=>'delivered'])}}"
                                                        data-action='{{route('order.update.status')}}'
                                                        data-input={"status":"delivered","order_id":"${order.id}"}
                                                        data-toggle="modal"
                                                        data-isAjax="true"
                                                        data-target="#modal-confirm">{{trans('layout.delivered')}}</button>`;
            }else if(order.status=='ready_for_delivery'){
                html=`<button class="dropdown-item" type="button"
                                                        data-message="{{trans('layout.message.order_status_warning',['status'=>'delivered'])}}"
                                                        data-action='{{route('order.update.status')}}'
                                                        data-input={"status":"delivered","order_id":"${order.id}"}
                                                        data-toggle="modal"
                                                        data-isAjax="true"
                                                        data-toggle="modal"
                                                        data-target="#modal-confirm">{{trans('layout.delivered')}}</button>`;
            }

            return html;

        }
        var checkrecords = 0;
         orderDataTable=$('#orderTable').DataTable({
            processing: true,
         //   serverSide: true,
            ajax: {
                "url": '{{route('order.getAll')}}',
                "dataSrc": "data"
            },
             columnDefs: [
                 { targets: 0, visible: false }
            ],
            columns: [
                {data: 'row'},
                {data: 'name'},
                {data: 'restaurant_name'},
                {data: 'table'},
                {data: 'total_price'},
                {data: function(row){
                    let items = row.items;
                     // console.log(row);
                    let html = "<ul>";
                    for (var i = 0; i < items.length; i++) {
                        html += "<li>"+items[i]+"</li>";
                    }
                    html += "<ul>";
                    return html;
                }},
                {data: 'payment_status'},
                {data: 'raw_status'},
                {data: function(row){
                    let html=`<div class="dropdown">
                                            <button type="button" class="btn btn-success light sharp"
                                                    data-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" cx="5" cy="12" r="2"/>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"/>
                                                        <circle fill="#000000" cx="19" cy="12" r="2"/>
                                                    </g>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                            @can('order_manage')
                                            ${generateActionButton(row)}
                                            @endcan
                                                <a href="{{route('order.show')}}?id=${row.id}" class="dropdown-item">{{trans('layout.details')}}</a>
                                            </div>
                                        </div>`;
                    return html;
                    }},
            ],
             order: [[ 0, 'asc' ]],
             bInfo: false,
             bLengthChange: false,
            drawCallback: function (settings) {
               var recordsTotal = settings?.json?.recordsTotal; 
               if (recordsTotal > checkrecords) {
                // if (checkrecords > 0 ) {
                    document.getElementById('audio').load();
                    document.getElementById('audio').play();
                    document.getElementById('audio').muted = false;
                // }
                checkrecords = recordsTotal;
               }

            }
        });

        $('#check_new_order').on('click',function(e){
            e.preventDefault();
            orderDataTable.ajax.reload();
        });

        function reloadDataTable() {
          orderDataTable.ajax.reload();
        }

        setInterval(reloadDataTable, 10000);
    </script>

@endsection
