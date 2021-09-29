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
<style>
  .nav_li{
    padding-right: 9px;
}
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}
a:hover {
 cursor:pointer;
} 


</style>

@section('main-content')    
    <div class="card-header">
        <h5>{{trans('layout.new_orders')}}</h5>
        <ul class="nav nav-pills card-header-pills" style="margin-right: 0.375rem">
          <li class="nav-item nav_li" style="padding-right: 9px;">
            <a class="nav-link active" href="{{ url('allorders') }}" style="background-color: #e6bbe5">{{trans('layout.all_orders')}}</a>
          </li>
          <li class="nav-item nav_li">
            <a class="nav-link" href="{{ url('allorders/food') }}" style="background-color: #e6aa8d">{{trans('layout.food_orders')}}</a>
          </li>
          <li class="nav-item nav_li">
            <a class="nav-link" href="{{ url('allorders/room') }}" style="background-color: #b9b5f1">{{trans('layout.room_service_orders')}}</a>
          </li>
        </ul>
    </div>
    <div class="row">
        <?php
            
            $order_data = [];
      ?>
        
      @foreach($orders as $k =>$order)
        @foreach($order as $orderdata)
        <?php
            $order_data[$k][] = array('ritem_name'=>$orderdata['ritem_name'],'item_name'=>$orderdata['item_name'],'qty'=>$orderdata['quantity'],'item_id'=>$orderdata['oid']);
        ?>
        @endforeach
        @if($orderdata['category_type']=='food') 
        <div class="column">
            <div class="card">
                <div class="nav-item nav_li" style="background-color: #e6aa8d">
                  <h6><small>{{trans('layout.food_order')}}</small></h6>
                  <h4>Room No {{$orderdata['table_name']}}</h4>
                  <div>
                    <?php
                      $date = strtotime($orderdata['created_at']);
                      $date= date('Y-m-d H:i:s', $date);
                    ?>
                    <p><small>{{$date}}</small></p>
                  </div>
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i=1;
                      ?>
                      @foreach($order_data[$k] as $key=>$od)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$od['item_name']}}</td>
                        <td>{{$od['qty']}}</td>
                        <td><a class="item_delete" data-id="{{$od['item_id']}}"><i class="fa fa-window-close" style="color:red"></i></a></td>
                      </tr>
                      <?php $i++;?>
                    @endforeach
                    </tbody>
                </table>
                <div class="btn-group">
                <button type="button" name="accept_order" id="accept_order_{{$orderdata['id']}}" class="btn btn-success order_button" data-id="{{$orderdata['id']}}">{{trans('layout.accept_order')}}</button>
                <button type="button" name="delete_order" id="delete_order_{{$orderdata['id']}}" class="btn btn-dark order_delete" data-id="{{$orderdata['id']}}"><i class="fa fa-trash"></i></button>
              </div>
            </div>
        </div>
        @elseif($orderdata['category_type']=='room')
            <div class="column">
            <div class="card">
                <div class="nav-item nav_li" style="background-color: #b9b5f1">
                  <h6><small>{{trans('layout.room_service')}}</small></h6>
                  <h4>Room No {{$orderdata['table_name']}}</h4>
                  <div>
                    <?php
                      $date = strtotime($orderdata['created_at']);
                      $date= date('Y-m-d H:i:s', $date);
                    ?>
                    <p><small>{{$date}}</small></p>
                  </div>
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>Item</th>
                        <th>Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i=1;
                      ?>
                      @foreach($order_data[$k] as $key=>$od)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$od['ritem_name']}}</td>
                        <td>{{$od['qty']}}</td>
                        <td><a class="item_delete" data-id="{{$od['item_id']}}"><i class="fa fa-window-close" style="color:red"></i></a></td>
                      </tr>
                      <?php
                       $i++;
                      ?>
                     
                    @endforeach
                    </tbody>
                </table>
                <div class="btn-group">
                <button type="button" name="accept_order" id="accept_order_{{$orderdata['id']}}" class="btn btn-success order_button" data-id="{{$orderdata['id']}}">{{trans('layout.accept_order')}}</button>
                <button type="button" name="delete_order" id="delete_order_{{$orderdata['id']}}" class="btn btn-dark  order_delete" data-id="{{$orderdata['id']}}"><i class="fa fa-trash"></i></button>
                
              </div>
            </div>
        </div>
        @else
           <div class="column">
            <div class="card">
              @if(isset($orderdata['category_type']))
                <div class="nav-item nav_li" style="background-color: #e6aa8d">
                @else
                <div class="nav-item nav_li" style="background-color: #b9b5f1">
                @endif
                  <h6>
                  @if(isset($orderdata['category_type']))
                  <small>
                    {{trans('layout.food_order')}}
                  </small>
                  @else
                  <small>
                    {{trans('layout.all_orders')}}
                  </small>
                  @endif
                </h6>
                  <h4>Room No {{$orderdata['table_name']}}</h4>
                  <div>
                    <?php
                      $date = strtotime($orderdata['created_at']);
                      $date= date('Y-m-d H:i:s', $date);
                    ?>
                    <p><small>{{$date}}</small></p>
                  </div>
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>Item</th>
                        <th>Qty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i=1;
                      ?>
                      @foreach($order_data[$k] as $key=>$od)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$od['item_name']}}</td>
                        <td>{{$od['qty']}}</td>
                        <td><a class="item_delete" data-id="{{$od['item_id']}}"><i class="fa fa-window-close" style="color:red"></i></a></td>
                      </tr>
                      <?php
                       $i++;
                      ?>
                     
                    @endforeach
                    </tbody>
                </table>
                <div class="btn-group">
                <button type="button" name="accept_order" id="accept_order_{{$orderdata['id']}}" class="btn btn-success order_button" data-id="{{$orderdata['id']}}">{{trans('layout.accept_order')}}</button>
                <button type="button" name="delete_order" id="delete_order_{{$orderdata['id']}}" class="btn btn-dark order_delete" data-id="{{$orderdata['id']}}"><i class="fa fa-trash"></i></button>
                
              </div>
            </div>
        </div>
        @endif
        <?php 
            $i++;
        ?>
       @endforeach 
    </div>

@endsection



