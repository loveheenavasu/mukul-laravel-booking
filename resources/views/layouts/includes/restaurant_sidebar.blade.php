<ul class="metismenu sidebar-height" id="menu">
                <li> <a target="_self" class="ai-icon item-category" href="{{route('showroom_service.restaurant',['slug'=>$restaurant->slug])}}">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">{{trans('layout.room_service')}}</span>
                    </a>
                </li>
                <li><a target="_parent" data-id="" class="ai-icon item-category" href="{{route('showfood_service.restaurant',['slug'=>$restaurant->slug,'id'=>$restaurant->id])}}" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">{{trans('layout.order_food')}}</span>
                    </a>
                </li>
                <li><a data-id="" class="ai-icon item-category" href="{{route('abouthotel.index',['slug'=>$restaurant->slug])}}" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">{{trans('layout.about_hotel')}}</span>
                    </a>
                </li>
                <li><a data-id="" class="ai-icon item-category" href="{{route('tourguide.index',['slug'=>$restaurant->slug])}}" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">{{trans('layout.tour_guide')}}</span>
                    </a>
                </li>
</ul>

<div class="copyright mt-4">
    <p><strong>{{json_decode(get_settings('site_setting'))->name}} </strong> © {{date('Y')}} All Rights Reserved</p>
</div>
