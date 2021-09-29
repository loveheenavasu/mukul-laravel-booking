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


</style>

@section('main-content')    
    <div class="card-header">
        <h5>{{trans('layout.kitchen_orders')}}</h5>
   	</div>
    <div class="row">
   	  <?php
        $order_data = [];
      ?>       
      @foreach($orders as $k =>$order)
        @foreach($order as $orderdata)
        <?php
            $order_data[$k][] = array('item_name'=>$orderdata['item_name'],'qty'=>$orderdata['quantity'],'item_id'=>$orderdata['oid']);
        ?>
        
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
                        <!-- <td><a class="item_delete" data-id="{{$od['item_id']}}"><i class="fa fa-window-close" style="color:red"></i></a></td> -->
                      </tr>
                      <?php $i++;?>
                    @endforeach
                    </tbody>
                </table>
                <button type="button" name="accept_order" id="accept_order_{{$orderdata['id']}}" class="btn btn-primary kitchenorder_button" data-id="{{$orderdata['id']}}">{{trans('layout.processing')}}</button>
            </div>
        </div>
        @endif
      @endforeach 
    @endforeach
</div>    

@endsection  

