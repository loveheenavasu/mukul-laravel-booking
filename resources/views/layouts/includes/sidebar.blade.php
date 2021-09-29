<ul class="metismenu sidebar-height" id="menu">
    @can('restaurant_manage')

        <li><a class="ai-icon" href="{{route('dashboard')}}" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                <span class="nav-text">{{trans('layout.dashboard')}}</span>
            </a>
        </li>
    @endcan

    @can('restaurant_manage')
        <li class="{{isSidebarActive('restaurant*')}} active-no-child"><a class="ai-icon" href="{{route('restaurant.index')}}"aria-expanded="false">
                <i class="fas fa-hat-chef"></i>
                <span class="nav-text">{{trans('layout.restaurant')}}</span>
            </a>
        </li>
    @endcan

    @can('manage_user')
        <li class="{{isSidebarActive('customers.index')}} active-no-child"><a class="ai-icon"href="{{route('customers.index')}}"aria-expanded="false">
            <i class="fas fa-users"></i><span class="nav-text">

                    @if(auth()->user()->type=='restaurant_owner')
                        {{trans('layout.staff')}}
                    @elseif(auth()->user()->type=='admin')
                        {{trans('layout.customer')}}
                    @endif
                </span></a>
        </li>
    @endcan

    @can('food_category_manage')
        <li data-toggle="collapse" data-target="#service" class="collapsed">
            <a href="#"><i class="fas fa-pizza-slice"></i>
                <span class="nav-text">
                {{trans('layout.food_items')}}</span> <span class="arrow"></span></a>
        </li>  
        <ul class="collapse navbar-collapse" id="service">
            <li class="{{isSidebarActive('category*')}} active-no-child"><a class="ai-icon"href="{{route('category.index')}}"aria-expanded="false"><i class="flaticon-381-television"></i><span class="nav-text">
                    {{trans('layout.category')}}
                </span></a>
            </li>
            <li class="{{isSidebarActive('item*')}} active-no-child"><a class="ai-icon" href="{{route('item.index')}}"aria-expanded="false"><i class="flaticon-381-network"></i><span class="nav-text">
                        {{trans('layout.items')}}
                </span></a>
            </li>
        </ul>
    @endcan
    

    @can('roomservice_manage')
        <li data-toggle="collapse" data-target="#service" ><a href="#"><i class="fa fa-bed fa-lg"></i>
            <span class="nav-text">{{trans('layout.room_supplies')}} </span>
            <span class="arrow"></span></a>
        </li>  
        <ul class="collapse navbar-collapse" id="service">
            <li><a class="ai-icon" href="{{route('roomcategory.index')}}"aria-expanded="true">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">
                            {{trans('layout.room_category')}}
                    </span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{route('roomitems.index')}}" aria-expanded="false"><i class="flaticon-381-network"></i>
                <span class="nav-text">
                        {{trans('layout.room_items')}}
                </span>
            </a>
            </li>
        </ul>       
    @endcan

    @can('all_orders')
        <li class="{{isSidebarActive('allorders*')}} active-no-child"><a class="ai-icon"href="{{route('allorders.index')}}"aria-expanded="false"><i class="fas fa-truck"></i>
        <span class="nav-text">
            {{trans('layout.all_orders')}}
        </span>
        </a>
        </li>
    @endcan

    @can('room_orders')
    
        <li class="{{isSidebarActive('roomorder*')}} active-no-child"><a class="ai-icon"href="{{route('roomorder.index')}}"aria-expanded="false"><i class="fas fa-shipping-fast"></i>
        <span class="nav-text">
                {{trans('layout.room_orders')}}
            
        </span></a>
        </li>
    
    @endcan

    @can('kitchen_orders')
    
        <li class="{{isSidebarActive('kitchenorder*')}} active-no-child"><a class="ai-icon" href="{{route('kitchenorder.index')}}"aria-expanded="false"><i class="fa fa-cutlery fa-lg"></i><span class="nav-text">
                {{trans('layout.kitchen_orders')}}
        </span></a>
        </li>
        
    @endcan

    @can('order_list')
        <li class="{{isSidebarActive('order*')}} active-no-child"><a class="ai-icon" href="{{route('order.index')}}"aria-expanded="false"><i class="fas fa-vote-yea"></i><span class="nav-text">{{trans('layout.orders')}}</span>
        </a>
        </li>
    @endcan

    @can('qr_manage')
        <li class="{{isSidebarActive('qr*')}} active-no-child"><a class="ai-icon" href="{{route('qr.maker')}}"aria-expanded="false"><i class="flaticon-381-notepad "></i>
        <span class="nav-text">{{trans('layout.qr_maker')}}</span></a>
        </li>

    @endcan

    @can('billing')
        <li><a class="ai-icon" href="{{route('plan.list')}}" aria-expanded="false">
                <i class="flaticon-381-network "></i>
                <span class="nav-text">{{trans('layout.billings')}}</span>
            </a>

        </li>

    @endcan
    @can('plan_manage')
        <li><a class="ai-icon" href="{{route('plan.index')}}" aria-expanded="false">
                <i class="flaticon-381-network "></i>
                <span class="nav-text">{{trans('layout.plan')}}</span>
            </a>

        </li>
    @endcan
    @can('user_plan_change')
        <li><a class="ai-icon" href="{{route('user.plan')}}" aria-expanded="false">
                <i class="flaticon-381-network "></i>
                <span class="nav-text">{{trans('layout.user_plan')}}</span>
            </a>

        </li>

    @endcan
    @can('table_manage')
        <li><a class="ai-icon" href="{{route('table.index')}}" aria-expanded="false">
                <i class="flaticon-381-layer-1 "></i>
                <span class="nav-text">{{trans('layout.table')}}</span>
            </a>

        </li>
    @endcan
    @can('restaurant_manage')
    <li><a href="{{route('settings')}}" class="ai-icon" aria-expanded="false">
            <i class="flaticon-381-settings-2"></i>
            <span class="nav-text">{{trans('layout.settings')}}</span>
        </a>
    </li>
    @endcan
    @can('restaurant_manage')
    <li><a href="{{route('userdetails.index')}}" class="ai-icon" aria-expanded="false">
            <i class="fa fa-user-circle-o"></i>
            <span class="nav-text">{{trans('layout.user')}}</span>
        </a>
    </li>
    @endcan
</ul>
<!-- <div class="copyright">
    <p><strong>{{json_decode(get_settings('site_setting'))->name}} </strong> © {{date('Y')}} {{trans('layout.all_right_reserved')}}</p>
</div> -->
