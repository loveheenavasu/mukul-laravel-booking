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

@section('main-content')
<div class="restaurant_page">
    <div id="restaurant-section">
        <div class="row qricle-demo">
            <div class="col-lg-12">
                <div class="profile card card-body px-0 pt-0 pb-0 mb-0">
                    <div class="profile-head">
                        @if($restaurant->foodservice_image)
                        <div class="photo-content">
                            <div class="cover-wrapper">
                                
                                <img class="cover-img" src="{{asset('uploads/'.$restaurant->foodservice_image)}}" alt="">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="restaurant_content-sec card">
                <div class="input-group stylish-input-group">
                    <input type="hidden" id="restaurant_id" value="{{$restaurant->id}}">
                    <i class="fa fa-search" id="txtSearch"></i><input type="text" id="txtSearchs" name="txtSearch" class="form-control"  placeholder="Search items from the menu" >
                </div>
        
            <div class="spinner-border float-right" role="status" style="display:none;">
            </div>
            <div class="" id="search_list">
            </div>
        <div id="item-lists">
        <!-- CUSTOM ORDER SECTION // developermanish.com-->
            <div class="category-item-wrapper catg-list" id="category-item-wrapper-my_order" style="display: none;">
                <div class="row page-titles mx-0">
                    @include('order.customer_order')
                </div>
            </div>
        <!-- END CUSTOM ORDER SECTION -->

        @foreach($categories as $categoryName=>$categoryItems)
        
        @if($categoryItems[0]->category->status == 'active')
        
        <div class="category-item-wrapper catg-list catg-list-items" id="category-item-wrapper-{{$categoryItems[0]->category_id}}">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0 p-0">
                    <div class="card-body cat-title">
                        <h3 class="text-capitalize"><span>{{$categoryName}}</span></h3>
                    </div>
                </div>

            </div>
            <div class="row cat-box">
                @foreach($categoryItems as $item)
                @if( $item->status == 'active')
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                           
                                <div class="new-arrival-product all-product restaurant-all-products">
                                   
                                    <div class="new-arrival-content w-100 d-flex">
                                    <div class="food-items-sec">
                                            <h4>{{$item->name}}</h4>
                                            <span class="d-block">{{$item->details}}</span>
                                            <ul class="star-rating d-none">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-half-empty"></i></li>
                                                <li><i class="fa fa-star-half-empty"></i></li>
                                            </ul>
                                        </div>
                                        <div class="price-box d-flex justify-content-end align-items-center">
                                            <div class="price">
                                                @if($item->discount>0)
                                                @if($item->discount_type=='percent')
                                                <del>{{formatNumberWithCurrSymbol($item->price)}}</del> {{formatNumberWithCurrSymbol(($item->price-(($item->discount*$item->price)/100)))}}
                                                @elseif($item->discount_type=='flat')
                                                <del>{{formatNumberWithCurrSymbol($item->price)}}</del> {{formatNumberWithCurrSymbol($item->price-$item->discount)}}
                                                @endif
                                                @else
                                                {{formatNumberWithCurrSymbol($item->price)}}
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <button data-value="{{json_encode($item->only(['name','id','price','details','discount','discount_type','discount_to']))}}" class="btn btn-xxs btn-info add-to-cart">{{trans('layout.add')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
        </div>


    <div class="add-overview col-sm-11" id="add-overview">
        <form action="{{route('order.place')}}" method="post" id="orderForm">
            @csrf
            <input type="hidden" name="restaurant" value="{{$restaurant->id}}">
            <input type="hidden" name="category_type" value="food">
                    <div class="row" id="orderOverviewSection">
                        <div class="col-xl-8 col-11">
                            <div class="card border-2-blue">
                                <div class="card-header border-0 pb-0">
                                    <h5 class="card-title">{{trans('layout.overview')}}</h5>
                                    <div id="close-overview" class="pull-right "><i class="fa fa-close"></i></div>
                                </div>
                                <div class="card-body">
                                    <div class="order-items">

                                    </div>
                                </div>
                                <div class="card-footer border-0 pt-0">
                                    <p class="card-text d-inline">Total: <span></span> <span id="totalAmount">0</span></p>
                                    <div class="footer-order-btns">
                                    <a id="close-overview" style="margin-right:10px" href="javascript:void(0)" class="btn btn-xs btn-primary float-right">Continue Browsing</a>
                                    <a id="processCheckout" href="javascript:void(0)" class="btn btn-xs btn-primary float-right">Proceed</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row" id="paymentOverviewSection">
                        <div class="col-xl-8 col-11">
                            <div class="card border-2-blue payment-form-sec">
                                <div class="card-header border-0 pb-0">
                                    <h5 class="card-title">{{trans('layout.payment')}}</h5>
                                    <div id="close-payment-overview" class="pull-right "><i class="fa fa-close"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="order-items-payment">
                                        <div class="row mid-payment">
                                            <div class="col-md-12">
                                                <!-- <label for="name">{{trans('layout.name')}}*</label> -->
                                                <input value="" name="name" type="text" class="form-control" id="name" placeholder="Full name" required>
                                            </div>
                                            @if(request()->get('table'))
                                            <div class="col-md-12">
                                                <label for="table_id">{{trans('layout.table')}}*</label>
                                                <select {{request()->get('table')?'disabled="true"':''}} class="form-control">
                                                    @foreach($tables as $table)
                                                    <option {{request()->get('table')==$table->id?'selected':''}} value="{{$table->id}}">{{$table->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <!-- <label for="whatsappnum">{{trans('layout.whatsappnum')}}*</label> -->
                                                <!-- country codes (ISO 3166) and Dial codes. -->
                                                <div class="countrycodesection">
                                                <select name="countryCode" id="">
                                                    <option data-countryCode="GB" value="44">+44</option>
                                                    <option data-countryCode="US" value="1">+1</option>
                                                    <optgroup label="Other countries">
                                                        <option data-countryCode="DZ" value="213">+213</option>
                                                        <option data-countryCode="AD" value="376">+376</option>
                                                        <option data-countryCode="AO" value="244">+244</option>
                                                        <option data-countryCode="AI" value="1264">+1264</option>
                                                        <option data-countryCode="AG" value="1268">+1268</option>
                                                        <option data-countryCode="AR" value="54">+54</option>
                                                        <option data-countryCode="AM" value="374">+374</option>
                                                        <option data-countryCode="AW" value="297">+297</option>
                                                        <option data-countryCode="AU" value="61">+61</option>
                                                        <option data-countryCode="AT" value="43">+43</option>
                                                        <option data-countryCode="AZ" value="994">+994</option>
                                                        <option data-countryCode="BS" value="1242">+1242</option>
                                                        <option data-countryCode="BH" value="973">+973</option>
                                                        <option data-countryCode="BD" value="880">+880</option>
                                                        <option data-countryCode="BB" value="1246">+1246</option>
                                                        <option data-countryCode="BY" value="375">+375</option>
                                                        <option data-countryCode="BE" value="32">+32</option>
                                                        <option data-countryCode="BZ" value="501">+501</option>
                                                        <option data-countryCode="BJ" value="229">+229</option>
                                                        <option data-countryCode="BM" value="1441">+1441</option>
                                                        <option data-countryCode="BT" value="975">+975</option>
                                                        <option data-countryCode="BO" value="591">+591</option>
                                                        <option data-countryCode="BA" value="387">+387</option>
                                                        <option data-countryCode="BW" value="267">+267</option>
                                                        <option data-countryCode="BR" value="55">+55</option>
                                                        <option data-countryCode="BN" value="673">+673</option>
                                                        <option data-countryCode="BG" value="359">+359</option>
                                                        <option data-countryCode="BF" value="226">+226</option>
                                                        <option data-countryCode="BI" value="257">+257</option>
                                                        <option data-countryCode="KH" value="855">+855</option>
                                                        <option data-countryCode="CM" value="237">+237</option>
                                                        <option data-countryCode="CA" value="1"> +1</option>
                                                        <option data-countryCode="CV" value="238">+238</option>
                                                        <option data-countryCode="KY" value="1345">+1345</option>
                                                        <option data-countryCode="CF" value="236">+236</option>
                                                        <option data-countryCode="CL" value="56">+56</option>
                                                        <option data-countryCode="CN" value="86">+86</option>
                                                        <option data-countryCode="CO" value="57">+57</option>
                                                        <option data-countryCode="KM" value="269">+269</option>
                                                        <option data-countryCode="CG" value="242">+242</option>
                                                        <option data-countryCode="CK" value="682">+682</option>
                                                        <option data-countryCode="CR" value="506">+506</option>
                                                        <option data-countryCode="HR" value="385">+385</option>
                                                        <option data-countryCode="CU" value="53">+53</option>
                                                        <option data-countryCode="CY" value="90392">+90392</option>
                                                        <option data-countryCode="CY" value="357">+357</option>
                                                        <option data-countryCode="CZ" value="42">+42</option>
                                                        <option data-countryCode="DK" value="45">+45</option>
                                                        <option data-countryCode="DJ" value="253">+253</option>
                                                        <option data-countryCode="DM" value="1809">+1809</option>
                                                        <option data-countryCode="DO" value="1809">+1809</option>
                                                        <option data-countryCode="EC" value="593">+593</option>
                                                        <option data-countryCode="EG" value="20">+20</option>
                                                        <option data-countryCode="SV" value="503">+503</option>
                                                        <option data-countryCode="GQ" value="240">+240</option>
                                                        <option data-countryCode="ER" value="291">+291</option>
                                                        <option data-countryCode="EE" value="372">+372</option>
                                                        <option data-countryCode="ET" value="251">+251</option>
                                                        <option data-countryCode="FK" value="500">+500</option>
                                                        <option data-countryCode="FO" value="298">+298</option>
                                                        <option data-countryCode="FJ" value="679">+679</option>
                                                        <option data-countryCode="FI" value="358">+358</option>
                                                        <option data-countryCode="FR" value="33">+33</option>
                                                        <option data-countryCode="GF" value="594">+594</option>
                                                        <option data-countryCode="PF" value="689">+689</option>
                                                        <option data-countryCode="GA" value="241">+241</option>
                                                        <option data-countryCode="GM" value="220">+220</option>
                                                        <option data-countryCode="GE" value="7880">+7880</option>
                                                        <option data-countryCode="DE" value="49">+49</option>
                                                        <option data-countryCode="GH" value="233">+233</option>
                                                        <option data-countryCode="GI" value="350">+350</option>
                                                        <option data-countryCode="GR" value="30">+30</option>
                                                        <option data-countryCode="GL" value="299">+299</option>
                                                        <option data-countryCode="GD" value="1473">+1473</option>
                                                        <option data-countryCode="GP" value="590">+590</option>
                                                        <option data-countryCode="GU" value="671">+671</option>
                                                        <option data-countryCode="GT" value="502">+502</option>
                                                        <option data-countryCode="GN" value="224">+224</option>
                                                        <option data-countryCode="GW" value="245">+245</option>
                                                        <option data-countryCode="GY" value="592">+592</option>
                                                        <option data-countryCode="HT" value="509">+509</option>
                                                        <option data-countryCode="HN" value="504">+504</option>
                                                        <option data-countryCode="HK" value="852">+852</option>
                                                        <option data-countryCode="HU" value="36">+36</option>
                                                        <option data-countryCode="IS" value="354">+354</option>
                                                        <option data-countryCode="IN" value="91" Selected>+91</option>
                                                        <option data-countryCode="ID" value="62">+62</option>
                                                        <option data-countryCode="IR" value="98">+98</option>
                                                        <option data-countryCode="IQ" value="964">+964</option>
                                                        <option data-countryCode="IE" value="353">+353</option>
                                                        <option data-countryCode="IL" value="972">+972</option>
                                                        <option data-countryCode="IT" value="39">+39</option>
                                                        <option data-countryCode="JM" value="1876">+1876</option>
                                                        <option data-countryCode="JP" value="81">+81</option>
                                                        <option data-countryCode="JO" value="962">+962</option>
                                                        <option data-countryCode="KZ" value="7">+7</option>
                                                        <option data-countryCode="KE" value="254">+254</option>
                                                        <option data-countryCode="KI" value="686">+686</option>
                                                        <option data-countryCode="KP" value="850">+850</option>
                                                        <option data-countryCode="KR" value="82">+82</option>
                                                        <option data-countryCode="KW" value="965">+965</option>
                                                        <option data-countryCode="KG" value="996">+996</option>
                                                        <option data-countryCode="LA" value="856">+856</option>
                                                        <option data-countryCode="LV" value="371">+371</option>
                                                        <option data-countryCode="LB" value="961">+961</option>
                                                        <option data-countryCode="LS" value="266">+266</option>
                                                        <option data-countryCode="LR" value="231">+231</option>
                                                        <option data-countryCode="LY" value="218">+218</option>
                                                        <option data-countryCode="LI" value="417">+417</option>
                                                        <option data-countryCode="LT" value="370">+370</option>
                                                        <option data-countryCode="LU" value="352">+352</option>
                                                        <option data-countryCode="MO" value="853">+853</option>
                                                        <option data-countryCode="MK" value="389">+389</option>
                                                        <option data-countryCode="MG" value="261">+261</option>
                                                        <option data-countryCode="MW" value="265">+265</option>
                                                        <option data-countryCode="MY" value="60">+60</option>
                                                        <option data-countryCode="MV" value="960">+960</option>
                                                        <option data-countryCode="ML" value="223">+223</option>
                                                        <option data-countryCode="MT" value="356">+356</option>
                                                        <option data-countryCode="MH" value="692">+692</option>
                                                        <option data-countryCode="MQ" value="596">+596</option>
                                                        <option data-countryCode="MR" value="222">+222</option>
                                                        <option data-countryCode="YT" value="269">+269</option>
                                                        <option data-countryCode="MX" value="52">+52</option>
                                                        <option data-countryCode="FM" value="691">+691</option>
                                                        <option data-countryCode="MD" value="373">+373</option>
                                                        <option data-countryCode="MC" value="377">+377</option>
                                                        <option data-countryCode="MN" value="976">+976</option>
                                                        <option data-countryCode="MS" value="1664">+1664</option>
                                                        <option data-countryCode="MA" value="212">+212</option>
                                                        <option data-countryCode="MZ" value="258">+258</option>
                                                        <option data-countryCode="MN" value="95">+95</option>
                                                        <option data-countryCode="NA" value="264">+264</option>
                                                        <option data-countryCode="NR" value="674">+674</option>
                                                        <option data-countryCode="NP" value="977">+977</option>
                                                        <option data-countryCode="NL" value="31">+31</option>
                                                        <option data-countryCode="NC" value="687">+687</option>
                                                        <option data-countryCode="NZ" value="64">+64</option>
                                                        <option data-countryCode="NI" value="505">+505</option>
                                                        <option data-countryCode="NE" value="227">+227</option>
                                                        <option data-countryCode="NG" value="234">+234</option>
                                                        <option data-countryCode="NU" value="683">+683</option>
                                                        <option data-countryCode="NF" value="672">+672</option>
                                                        <option data-countryCode="NP" value="670">+670</option>
                                                        <option data-countryCode="NO" value="47">+47</option>
                                                        <option data-countryCode="OM" value="968">+968</option>
                                                        <option data-countryCode="PW" value="680">+680</option>
                                                        <option data-countryCode="PA" value="507">+507</option>
                                                        <option data-countryCode="PG" value="675">+675</option>
                                                        <option data-countryCode="PY" value="595">+595</option>
                                                        <option data-countryCode="PE" value="51">+51</option>
                                                        <option data-countryCode="PH" value="63">+63</option>
                                                        <option data-countryCode="PL" value="48">+48</option>
                                                        <option data-countryCode="PT" value="351">+351</option>
                                                        <option data-countryCode="PR" value="1787">+1787</option>
                                                        <option data-countryCode="QA" value="974">+974</option>
                                                        <option data-countryCode="RE" value="262">+262</option>
                                                        <option data-countryCode="RO" value="40">+40</option>
                                                        <option data-countryCode="RU" value="7">+7</option>
                                                        <option data-countryCode="RW" value="250">+250</option>
                                                        <option data-countryCode="SM" value="378">+378</option>
                                                        <option data-countryCode="ST" value="239">+239</option>
                                                        <option data-countryCode="SA" value="966">+966</option>
                                                        <option data-countryCode="SN" value="221">+221</option>
                                                        <option data-countryCode="CS" value="381">+381</option>
                                                        <option data-countryCode="SC" value="248">+248</option>
                                                        <option data-countryCode="SL" value="232">+232</option>
                                                        <option data-countryCode="SG" value="65">+65</option>
                                                        <option data-countryCode="SK" value="421">+421</option>
                                                        <option data-countryCode="SI" value="386">+386</option>
                                                        <option data-countryCode="SB" value="677">+677</option>
                                                        <option data-countryCode="SO" value="252">+252</option>
                                                        <option data-countryCode="ZA" value="27">+27</option>
                                                        <option data-countryCode="ES" value="34">+34</option>
                                                        <option data-countryCode="LK" value="94">+94</option>
                                                        <option data-countryCode="SH" value="290">+290</option>
                                                        <option data-countryCode="KN" value="1869">+1869</option>
                                                        <option data-countryCode="SC" value="1758">+1758</option>
                                                        <option data-countryCode="SD" value="249">+249</option>
                                                        <option data-countryCode="SR" value="597">+597</option>
                                                        <option data-countryCode="SZ" value="268">+268</option>
                                                        <option data-countryCode="SE" value="46">+46</option>
                                                        <option data-countryCode="CH" value="41">+41</option>
                                                        <option data-countryCode="SI" value="963">+963</option>
                                                        <option data-countryCode="TW" value="886">+886</option>
                                                        <option data-countryCode="TJ" value="7">+7</option>
                                                        <option data-countryCode="TH" value="66">+66</option>
                                                        <option data-countryCode="TG" value="228">+228</option>
                                                        <option data-countryCode="TO" value="676">+676</option>
                                                        <option data-countryCode="TT" value="1868">+1868</option>
                                                        <option data-countryCode="TN" value="216">+216</option>
                                                        <option data-countryCode="TR" value="90">+90</option>
                                                        <option data-countryCode="TM" value="7">+7</option>
                                                        <option data-countryCode="TM" value="993">+993</option>
                                                        <option data-countryCode="TC" value="1649">+1649</option>
                                                        <option data-countryCode="TV" value="688">+688</option>
                                                        <option data-countryCode="UG" value="256">+256</option>
                                                        <option data-countryCode="GB" value="44">+44</option>
                                                        <option data-countryCode="UA" value="380">+380</option>
                                                        <option data-countryCode="AE" value="971">+971</option>
                                                        <option data-countryCode="UY" value="598">+598</option>
                                                        <option data-countryCode="US" value="1">+1</option>
                                                        <option data-countryCode="UZ" value="7">+7</option>
                                                        <option data-countryCode="VU" value="678">+67</option>
                                                        <option data-countryCode="VA" value="379">+379</option>
                                                        <option data-countryCode="VE" value="58">+58</option>
                                                        <option data-countryCode="VN" value="84">+84</option>
                                                        <option data-countryCode="VG" value="84">+1284</option>
                                                        <option data-countryCode="VI" value="84">+1340</option>
                                                        <option data-countryCode="WF" value="681">+681</option>
                                                        <option data-countryCode="YE" value="969">+969</option>
                                                        <option data-countryCode="YE" value="967">+967</option>
                                                        <option data-countryCode="ZM" value="260">+260</option>
                                                        <option data-countryCode="ZW" value="263">+263</option>
                                                    </optgroup>
                                                </select>
                                                <input name="whatsappnum" type="number" class="form-control" id="whatsappnum" placeholder="Whatsapp Number" required>
                                              </div>
                                            </div>
                                            <div class="col-md-12 {{request()->get('table')?'d-none':''}}">
                                                <!-- <label for="table_id">{{trans('layout.table')}}*</label> -->
                                                <select name="table_id" id="table_id" class="form-control">
                                                    @foreach($tables as $table)
                                                    <option {{request()->get('table')==$table->id?'selected':''}} value="{{$table->id}}">{{$table->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <!-- <div class="col-md-12">
                                                <label for="comment">{{trans('layout.comment')}}</label>
                                                <input name="comment" type="text" class="form-control" id="comment" placeholder="Ex: Need extra spoon">
                                            </div> -->
                                        </div>
                                        <div class="row payment-checkbox-btns">
                                            <h3 class="pay-with">Pay-with</h3>
                                                <div class="chekbox-inner">
                                                     @php
                                                        $rest_gateway_credentials=get_restaurant_gateway_settings($restaurant->user_id);
                                                        $isPaymentEnable=false;
                                                    @endphp
                                                    @php $credentials=isset($rest_gateway_credentials)?json_decode($rest_gateway_credentials->value):''; @endphp

                                                    @if(isset($credentials->offline_status) && $credentials->offline_status=='active')
                                                        @php $isPaymentEnable=true; 
                                                        @endphp
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input value="pay_on_table" id="pay_on_table" name="pay_type"
                                                                   type="radio"
                                                                   class="custom-control-input" checked="" required="">
                                                            <label class="custom-control-label"
                                                                   for="pay_on_table">{{trans('layout.pay_on_table')}}</label>
                                                        </div>
                                                    @endif

        <?php if((isset($credentials->paypal_status) && $credentials->paypal_client_id && $credentials->paypal_secret_key && $credentials->paypal_status=='active') || (isset($credentials->stripe_status) && $credentials->stripe_publish_key && $credentials->stripe_secret_key && $credentials->stripe_status=='active') || (isset($credentials->paytm_environment) && $credentials->paytm_mid && $credentials->paytm_secret_key && $credentials->paytm_website && $credentials->paytm_txn_url && $credentials->paytm_status=='active') ) { ?>
                                                        @php $isPaymentEnable=true; @endphp

                                                        <div class="custom-control custom-radio mb-2">
                                                            <input value="pay_now" id="pay_now"
                                                                   name="pay_type"
                                                                   type="radio"
                                                                   class="custom-control-input" required="">
                                                            <label class="custom-control-label"
                                                                   for="pay_now">{{trans('layout.pay_now')}}</label>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                        </div>
                                        <div class="pay-now-section">
                                            <div class="row">
                                                <div class="col-md-12">
                                                     <div class="paytm-box">

                                                        @if($rest_gateway_credentials && $credentials)

                                                            @if(isset($credentials->paypal_status) && $credentials->paypal_client_id && $credentials->paypal_secret_key && $credentials->paypal_status=='active')
                                                                <div class="custom-control custom-radio mb-2">
                                                                    <input id="paypal" name="paymentMethod" type="radio"
                                                                           class="custom-control-input"
                                                                           required="" checked="" value="paypal">
                                                                    <label class="custom-control-label"
                                                                           for="paypal">{{trans('layout.paypal')}}</label>
                                                                </div>
                                                            @endif


                                                            @if(isset($credentials->paytm_environment) && $credentials->paytm_mid && $credentials->paytm_secret_key && $credentials->paytm_website && $credentials->paytm_txn_url && $credentials->paytm_status=='active')
                                                                <div class="custom-control custom-radio mb-2">
                                                                    <input id="paytm" name="paymentMethod" type="radio"
                                                                           class="custom-control-input"
                                                                           required="" value="paytm">
                                                                    <label class="custom-control-label"
                                                                           for="paytm">{{trans('layout.paytm')}}</label>
                                                                </div>
                                                            @endif

                                                            @if(isset($credentials->stripe_status) && $credentials->stripe_publish_key && $credentials->stripe_secret_key && $credentials->stripe_status=='active')
                                                                <div class="custom-control custom-radio mb-2">
                                                                    <input id="credit" name="paymentMethod" type="radio"
                                                                           class="custom-control-input"
                                                                           required="" value="stripe">
                                                                    <label class="custom-control-label"
                                                                           for="credit">{{trans('Credit or Debit card')}}</label>
                                                                </div>
                                                            @endif

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-payment-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="card-element" class="border-1-gray p-3 border-radius-1"></div>
                                                    <div id="card-errors" role="alert"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              <hr class="total-hr"/>
                              <div class="total-price-sec">
                                <div class="card-footer border-0 p-1">
                                    <p class="card-text d-inline">{{trans('layout.total_price_before_tax')}}: <span id="totalPriceBeforeTax">0</span>
                                    </p>
                                    @if(isset($tax))
                                    <span id="taxData" style="display: none;">{{$tax->vat_percentage}}</span>
                                    @endif
                                </div>
                                <div class="card-footer border-0 p-1">
                                    <p class="card-text d-inline">{{trans('layout.tax')}}({{isset($tax->vat_percentage)}}%): <span id="totalTax">0</span>
                                    </p>
                                </div>
                                <div class="card-footer border-0 p-1">
                                    <p class="card-text d-inline">{{trans('layout.sub_total')}}: <span id="totalAmountToPayment">0</span>
                                    </p>
                                    
                                </div>
                                </div>
                                @if($isPaymentEnable)
                                    <button id="place-order" class="btn btn-xs btn-primary float-right place-order disabled">{{trans('layout.place_order')}}</button>
                                    @endif
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>   
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="{{asset('vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
@if(isset($credentials->stripe_status) && $credentials->stripe_status=='active')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#slideshow .slick').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            dots: false,
            infinite: false,
            slidesToShow: 5,
            slidesToScroll: 3,
            adaptiveHeight: true,
            variableWidth: true,
            cssEase: 'linear',
            responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
                infinite: true,
                dots: false,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: false,
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
              }
            }
          ]
        });
        $(document).on('click', '.restaurant-cate-wrapper', function(event) {
            var id = $(this).attr("href");
            event.preventDefault();
            $("body, html").animate({ 
              scrollTop: $(id).offset().top
            }, 600);
        });
    });
</script>
<script !src="">
    "use strict";
    // Create a Stripe client.
    var stripe = Stripe('{{$credentials->stripe_publish_key}}');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

</script>
@endif

<script>
    // Handle form submission.
    $("#orderForm").validate();
    var btn = document.getElementById('place-order');
    btn.addEventListener('click', function(event) {
        event.preventDefault();
        $("#orderForm").submit();
        // this.disabled = true;
        var name = document.getElementById('name');
        var whatsappnum = document.getElementById('whatsappnum');
        if(!whatsappnum.value) return true;
        if (!name.value) return true;
        let credit = document.getElementById('credit');
        if (credit && credit.checked) {
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        } else {

            $('input[type=radio][name=pay_type]').each(function(index, value) {

                if ($(value).is(':checked')) {
                    $('input[type=radio][name=paymentMethod]').each(function(i, v) {
                        if ($(v).is(':checked')) $('#orderForm').attr('data-can', 'true');
                    });
                }
                if ($(value).val() == 'pay_on_table') $('#orderForm').attr('data-can', 'true');

            });


            var form = $('#orderForm');
            if (form.attr('data-can') == 'true') {
                form.submit();
            } else {
                $('#place-order').addClass('disabled')
            }
        }
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('orderForm');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

</script>

<script !src="">
    const currencySymbol = '{{isset(json_decode(get_settings('local_setting'))->currency_symbol)?json_decode(get_settings('local_setting'))->currency_symbol:'$'}}';

    Number.prototype.number_format = function(decimals, dec_point, thousands_sep) {
        let number = this.valueOf();
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    };
    Number.prototype.formatNumber = function () {
        const decimal_format = '{{isset(json_decode(get_settings('local_setting'))->decimal_format)?json_decode(get_settings('local_setting'))->decimal_format:'.'}}';
        const decimals = '{{isset(json_decode(get_settings('local_setting'))->decimals)?json_decode(get_settings('local_setting'))->decimals:'2'}}';
        const thousand_separator = '{{isset(json_decode(get_settings('local_setting'))->thousand_separator)?json_decode(get_settings('local_setting'))->thousand_separator:','}}';
        return this.valueOf().number_format(decimals, decimal_format, thousand_separator);
    };
    Number.prototype.formatNumberWithCurrSymbol = function () {
            const symbol_position = '{{isset(json_decode(get_settings('local_setting'))->currency_symbol_position)?json_decode(get_settings('local_setting'))->currency_symbol_position:'after'}}';

            if (symbol_position == 'after') {
                return this.valueOf().formatNumber() + currencySymbol;
            } else if (symbol_position == 'before') {
                return currencySymbol + this.valueOf().formatNumber();
            }

        };

    function calculateTotal() {
        var vat = $('#taxData').text();
        let total = 0;
        $('.row-total').each((index, value) => {
            total += parseFloat($(value).text());
        });
        let price_with_vat = 0;
        let total_vat_price = (vat*(total/100));
        price_with_vat = total + (vat*(total/100));
        $('#totalTax').text(total_vat_price.formatNumberWithCurrSymbol());
        $('#totalPriceBeforeTax').text(total.formatNumberWithCurrSymbol());
        $('#totalAmount').text(total.formatNumberWithCurrSymbol());
        $('#totalAmountToPayment').text(price_with_vat.formatNumberWithCurrSymbol());
    }

    $(document).on('click', '.item-category', function(e) {
        e.preventDefault();
        $('body').removeClass("myordercontent");
        $('.hamburger').click();
        $('#restaurant-section').show();
        $('#item-lists').show();
        $('.category-item-wrapper').hide();
        $('#category-item-wrapper-' + $(this).attr('data-id')).show();
        $('#txtSearch').show();
        $('#txtSearchs').show();
    });
    $(document).on('click','#foodItems', function(e){
        //alert("hi");
        e.preventDefault();
        $('body').addClass("myordercontent"); 
        $('.hamburger').click();
        $('#restaurant-section').show();
        $('#item-lists').show();
        $('.category-item-wrapper').hide();
        $('.catg-list-items').show();
        //$('#category-item-wrapper-my_order').show().html($('#custom_order_details').html());
        $('#txtSearch').hide();
        $('#txtSearchs').hide();
    });
    $(document).on('click','#my_order', function(e){
        //alert("hi");
        e.preventDefault();
        $('body').addClass("myordercontent"); 
        $('.hamburger').click();
        $('#restaurant-section').show();
        $('#item-lists').show();
        $('.category-item-wrapper').hide();
        $('#category-item-wrapper-my_order').show();
        $('#category-item-wrapper-my_order').show().html($('#custom_order_details').html());
        $('#txtSearch').hide();
        $('#txtSearchs').hide();
    });
    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        //console.log("Hey");
        $('#add-overview').animate({
            bottom: '0px'
        });
        $('#orderOverviewSection').show();
        $('#paymentOverviewSection').hide();

        const item = JSON.parse($(this).attr('data-value'));

        let singleItem = $('#single-item-' + item.id).length;
        let singleItemHtml = '';
        let discount = item.discount;
        let discountedPrice = 0;
        if (item.discount_type == 'flat') {
            discountedPrice = item.price - discount;
        } else if (item.discount_type == 'percent') {
            discountedPrice = (item.price * discount) / 100;
            discountedPrice = item.price - discountedPrice;
        }
        if (singleItem <= 0) {
            singleItemHtml = `<div class="single-item" id="single-item-${item.id}">
                                    <div class="item-details">
                                        <div class="item-title">${item.name}</div>
                                        
                                            <input type="hidden" name="item_id[]" value="${item.id}">
                                            <input type="hidden" name="item_quantity[]" value="1" id="input-item-quantity-${item.id}">
                                        <div class="item-price"><span class="item-individual-currency-symbol"></span> <span class="item-individual-price d-none">${discountedPrice}</span> <span>${discountedPrice.formatNumberWithCurrSymbol()}</span></div>
                                    </div>
                                    <div class="modify-item">
                                        <span class="d-none row-total">${discountedPrice}</span>
                                        <h3 class="addon-text">Addons</h3>
                                        <div data-id="${item.id}" class="minus-quantity">
                                            <i class="fa fa-minus"></i>
                                        </div>
                                        <div id="item-quantity-${item.id}" class="item-quantity">1</div>
                                        <div data-id="${item.id}" class="plus-quantity" id="plus-quantity-${item.id}">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>`;
        } else {
            $('#plus-quantity-' + item.id).click();
        }
        $('.order-items').append(singleItemHtml);
        calculateTotal();

    });

    $('#close-overview,#close-payment-overview').on('click', function(e) {
        $('#add-overview').animate({
            bottom: '-1000px'
        });
    });

    $(document).on('click', '.minus-quantity', function(e) {
        e.preventDefault();
        let price = parseFloat($(this).parent().parent().find('.item-individual-price').first().text());
        let quantity = parseInt($(this).parent().find('.item-quantity').first().text());
        quantity--;
        if (quantity <= 0) $(this).parent().parent().remove();
        $(this).parent().find('.item-quantity').text(quantity);
        const total = quantity * price;
        $(this).parent().find('.row-total').text(total);
        $('#input-item-quantity-' + $(this).attr('data-id')).val(quantity);
        calculateTotal();
    });

    $(document).on('click', '.plus-quantity', function(e) {
        e.preventDefault();
        let price = parseFloat($(this).parent().parent().find('.item-individual-price').first().text());
        let quantity = parseInt($(this).parent().find('.item-quantity').first().text());
        //console.log(price, quantity);
        quantity++;
        $(this).parent().find('.item-quantity').text(quantity);
        const total = quantity * price;
        $(this).parent().find('.row-total').text(total);
        $('#input-item-quantity-' + $(this).attr('data-id')).val(quantity);
        calculateTotal();
    });

    $('#processCheckout').on('click', function(e) {
        e.preventDefault();
        $('#orderOverviewSection').hide();
        $('#paymentOverviewSection').show();
    });

    $('input[type=radio][name=pay_type]').change(function() {
        if (this.value == 'pay_on_table') {
            $('.pay-now-section').hide();
            $('.card-payment-section').hide();
        } else if (this.value == 'pay_now') {
            $('.pay-now-section').show();
        }
        checkPayType();
    });

    $('input[type=radio][name=paymentMethod]').change(function() {
        if (this.value == 'paypal') {
            $('.card-payment-section').hide();
        } else if (this.value == 'paytm') {
            $('.card-payment-section').hide();
        } else if (this.value == 'stripe') {
            $('.card-payment-section').show();
        }
        checkPayType();
    });
    
    var currentRequest = null;
    $(document).on('keyup click', '#txtSearchs,#txtSearch', function(e) {
        e.preventDefault();
        var restaurant_id = $("#restaurant_id").val();
        var search = $('#txtSearchs').val();
        if(search.length == 0){
            $('.catg-list-items').show();
            $('.category-search-result').hide();
            $('.no_item_result').hide();
        }else{
            $('.spinner-border').show();
            currentRequest = $.ajax({
                type:"GET",
                url: '/restaurants/search',
                beforeSend : function()    {           
                    if(currentRequest != null) {
                        currentRequest.abort();
                    }
                },
                data: {search: search,restaurant_id:restaurant_id},
                success: function(data) {
                    $('.spinner-border').hide();
                    $('.catg-list-items').hide();
                    $('#search_list').html(data);
                },error:function(XMLHttpRequest, textStatus, errorThrown){
                    $('.spinner-border').hide();
                }
            });
        }
    });
    // var currentRequest = null;
    // $(document).on('click', '#txtSearch', function(e) {
    //     e.preventDefault();
    //     $('.spinner-border').show();
    //     var search = $('#txtSearchs').val();
    //     var restaurant_id = $("#restaurant_id").val();
    //     currentRequest = $.ajax({
    //         type:"GET",
    //         url: '/restaurants/search',
    //         data: {search: search,restaurant_id:restaurant_id},
    //         success: function(data) {
    //             $('.spinner-border').hide();
    //             $('.catg-list-items').hide();
    //             $('#search_list').html(data);
    //         },error:function(XMLHttpRequest, textStatus, errorThrown){
    //             $('.spinner-border').hide();
    //         }
    //     });
    // });

    // var currentRequest = null;
    // $(document).on('keyup', '#txtSearchs', function(e) {
    //     var search = $('#txtSearchs').val();
    //     var restaurant_id = $("#restaurant_id").val();
    //     var keycode = (e.keyCode ? e.keyCode : e.which);
    //     if(keycode == '13'){
    //         e.preventDefault();
    //         $('.spinner-border').show();
    //         currentRequest = $.ajax({
    //             type:"GET",
    //             url: '/restaurants/search',
    //             data: {search: search,restaurant_id:restaurant_id},
    //             success: function(data) {
    //                 $('.spinner-border').hide();
    //                 $('.catg-list-items').hide();
    //                 $('#search_list').html(data);
    //             },error:function(XMLHttpRequest, textStatus, errorThrown){
    //                 $('.spinner-border').hide();
    //             }
    //         });
    //     }
    // });

    /* $('.place-order').on('click', function (e) {
         e.preventDefault();
         $('#orderForm').submit();
     })*/
    function checkPayType() {
        $('input[type=radio][name=pay_type]').each(function(index, value) {
            if ($(value).is(':checked')) {
                $('input[type=radio][name=paymentMethod]').each(function(i, v) {
                    if ($(v).is(':checked')) $('#place-order').removeClass('disabled');
                });
            }
            if ($(value).val() == 'pay_on_table') $('#place-order').removeClass('disabled');
        });
    }
    checkPayType();

    $("#orderForm").validate();

</script>
@if(session()->has('order-success'))
<script !src="">
    swal("Great!!", '{{session()->get('
        order - success ')}}', "success");

</script>
@endif
@endsection

