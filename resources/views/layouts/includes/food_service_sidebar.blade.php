<ul class="metismenu sidebar-height" id="menu">
     <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="{{route('show.restaurant',['slug'=>$restaurant->slug])}}"><i class="fa fa-home fa-lg"></i>{{trans('layout.home')}} <span class="arrow"></span></a>
    </li>
    <li data-toggle="collapse" data-target="#service" class="collapsed" id="foodItems">
                  <a href="#"><i class="fa fa-cutlery fa-lg"></i>{{trans('layout.food_items')}} <span class="arrow"></span></a>
    </li> 
    <ul>
        @foreach($rest_categories as $cat)

            <li><a data-id="{{$cat->id}}" class="ai-icon item-category" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">{{$cat->name}}</span>
                </a>
            </li>
        @endforeach
    </ul>
        

    <li class="listmyorder">
        <a data-id="my_order" id="my_order" class="ai-icon" href="javascript:void(0)" aria-expanded="false">
            <span class="nav-text"><?php echo e(trans('layout.my_order')); ?></span>
        </a>
    </li>
    @if(!auth()->check())
        <!-- <li><a class="ai-icon" href="{{route('registration',['type'=>'customer'])}}"
               aria-expanded="false">
                <i class="flaticon-381-add"></i>
                <span class="nav-text">{{trans('layout.signup')}}</span>
            </a>
        </li> -->
    @endif
</ul>

<div class="copyright mt-4">
    <p><strong>{{json_decode(get_settings('site_setting'))->name}} </strong> © {{date('Y')}} All Rights Reserved</p>
</div>
