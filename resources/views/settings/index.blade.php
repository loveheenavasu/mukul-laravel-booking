@extends('layouts.dashboard')

@section('title',trans('layout.settings_title'))
@section('css')
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <style>
        .custom-nav.active {
            color: #2f4cdd !important;
            box-shadow: none !important;
        }

        .nav-flex {
            display: flex;
            flex-direction: column;
        }

        .flex-content {
            width: fit-content;
        }
    </style>
@endsection

@section('main-content')

    <div class="col-xl-12 without-shadow">
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        @can('general_setting')
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab"
                                   href="#generalSettings">{{trans('layout.general')}}</a>
                            </li>
                        @endcan
                        @can('email_setting')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#emailSettings">{{trans('layout.email_settings')}}</a>
                            </li>
                        @endcan
                        @can('email_template_setting')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#emailTemplate">{{trans('layout.email_template')}}</a>
                            </li>
                        @endcan
                        @can('payment_gateway_setting')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#paymentGateway">{{trans('layout.payment_gateway')}}</a>
                            </li>
                        @endcan
                        @can('role_permission')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#rolePermission">{{trans('layout.role_permission')}}</a>
                            </li>
                        @endcan
                        @can('sms_gateway_setting')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#smsGateway">{{trans('layout.sms_gateway')}}</a>
                            </li>
                        @endcan
                        @can('tax_setting')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                   href="#taxSetting">{{trans('layout.tax_setting')}}</a>
                            </li>
                        @endcan
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="generalSettings" role="tabpanel">
                            <div class="pt-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="nav nav-pills mb-3 nav-flex">
                                                    @can('general_setting')
                                                        <a href="#v-pills-generalSettings" data-toggle="pill"
                                                           class="nav-link active show custom-nav flex-content">{{trans('layout.general_settings')}}</a>
                                                    @endcan
                                                    @can('change_password')
                                                        <a href="#v-pills-passwordChange" data-toggle="pill"
                                                           class="nav-link custom-nav flex-content">{{trans('layout.password_change')}}</a>
                                                    @endcan
                                                    @can('site_setting')
                                                        <a href="#v-pills-siteSettings" data-toggle="pill"
                                                           class="nav-link custom-nav flex-content">{{trans('layout.site_settings')}}</a>
                                                    @endcan
                                                    @can('local_setting')
                                                        <a href="#v-pills-localSettings" data-toggle="pill"
                                                           class="nav-link custom-nav flex-content">{{trans('layout.local_settings')}}</a>
                                                    @endcan
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="tab-content">
                                                    @can('general_setting')
                                                        <div id="v-pills-generalSettings"
                                                             class="tab-pane fade active show">
                                                            <form role="form" action="{{route('general')}}"
                                                                  method="post"
                                                                  enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{{trans('layout.name')}}</label>
                                                                    <input type="text" name="name"
                                                                           value="{{isset($admin->name)?$admin->name:''}}"
                                                                           class="form-control"
                                                                           placeholder="{{trans('layout.name')}}">
                                                                </div>
                                                                <div class="form-group general-mobile-no">
                                                                    <label
                                                                        for="exampleInputEmail1">{{trans('layout.phone_number')}}</label>
                                                                        <select name="countryCode" id="countryCode">
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
                                                                      <option data-countryCode="VU" value="678">+678</option>
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
                                                                    <input type="tel" name="phone_number"
                                                                           value="{{isset($admin->phone_number)?$admin->phone_number:''}}"
                                                                           class="form-control"
                                                                           placeholder="{{trans('layout.phone_number')}}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{{trans('layout.email')}}</label>
                                                                    <input type="email" name="email"
                                                                           value="{{isset($admin->email)?$admin->email:''}}"
                                                                           class="form-control"
                                                                           id="exampleInputEmail1"
                                                                           placeholder="{{trans('layout.email')}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>{{trans('layout.picture')}}</label>
                                                                    <div class="input-group">
                                                                        <div class="form-control">
                                                                            <input type="file" name="picture"
                                                                                   value="{{isset($admin->picture)?$admin->picture:''}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit"
                                                                        class="btn btn-primary float-right">{{trans('layout.submit')}}</button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                    @can('change_password')
                                                        <div id="v-pills-passwordChange"
                                                             class="tab-pane fade">
                                                            <form role="form" action="{{route('password.update')}}"
                                                                  method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>{{trans('layout.old_password')}}</label>
                                                                    <input type="password" name="old_password"
                                                                           class="form-control"
                                                                           placeholder="{{trans('layout.password')}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputPassword1">{{trans('layout.new_password')}}</label>
                                                                    <input type="password" name="new_password"
                                                                           class="form-control"
                                                                           placeholder="{{trans('layout.password')}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputPassword1">{{trans('layout.password')}}</label>
                                                                    <input type="password" name="confirm_password"
                                                                           class="form-control"
                                                                           placeholder=" Confirm Password">
                                                                </div>
                                                                <button type="submit"
                                                                        class="btn btn-primary float-right">{{trans('layout.submit')}}</button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                    @can('site_setting')
                                                        <div id="v-pills-siteSettings"
                                                             class="tab-pane fade">
                                                            <form action="{{route('side.bar.settings')}}" method="post"
                                                                  enctype="multipart/form-data">
                                                                @csrf

                                                                @isset($site_setting_id)
                                                                    <input type="hidden" name="settings_id"
                                                                           value="{{$site_setting_id}}">
                                                                @endisset
                                                                <div class="form-group">
                                                                    <label>{{trans('layout.name')}} </label>

                                                                    <input
                                                                        value="{{isset($site_setting->name)?$site_setting->name:''}}"
                                                                        class="form-control" type="text"
                                                                        name="name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Fav Icon </label>
                                                                    @isset($site_setting->favicon)
                                                                        <img class="height-30"
                                                                             src="{{asset('uploads/'.$site_setting->favicon)}}"
                                                                             alt="">
                                                                    @endisset
                                                                    <input class="form-control"
                                                                           type="file" name="fav_icon">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Logo</label>
                                                                    @isset($site_setting->logo)
                                                                        <img class="height-30"
                                                                             src="{{asset('uploads/'.$site_setting->logo)}}"
                                                                             alt="">
                                                                    @endisset
                                                                    <input class="form-control"
                                                                           value="{{isset($side_bar->logo)?$side_bar->logo:''}}"
                                                                           type="file"
                                                                           name="logo">
                                                                </div>
                                                                <button type="submit"
                                                                        class="btn btn-primary">{{trans('layout.submit')}}</button>

                                                            </form>
                                                        </div>
                                                    @endcan
                                                    @can('local_setting')
                                                        <div id="v-pills-localSettings"
                                                             class="tab-pane fade">
                                                            <form action="{{route('settings.local')}}" method="post">
                                                                @csrf

                                                                @isset($local_setting_id)
                                                                    <input type="hidden" name="local_setting_id"
                                                                           value="{{$local_setting_id}}">
                                                                @endisset
                                                                <div class="form-group">
                                                                    <label>{{trans('layout.language')}} </label>

                                                                    <select name="language" class="form-control">
                                                                        <option
                                                                            {{isset($local_setting->language) && $local_setting->language=='bn'?'selected':''}} value="bn">{{trans('layout.bengali')}}</option>
                                                                        <option
                                                                            {{isset($local_setting->language) && $local_setting->language=='ar'?'selected':''}} value="ar">{{trans('layout.arabic')}}</option>
                                                                        <option
                                                                            {{isset($local_setting->language) && $local_setting->language=='en'?'selected':''}} value="en">{{trans('layout.english')}}</option>
                                                                        <option
                                                                            {{isset($local_setting->language) && $local_setting->language=='es'?'selected':''}} value="es">{{trans('layout.spanish')}}</option>
                                                                        <option
                                                                            {{isset($local_setting->language) && $local_setting->language=='jp'?'selected':''}} value="jp">{{trans('layout.japanese')}}</option>
                                                                        <option
                                                                            {{isset($local_setting->language) && $local_setting->language=='pt'?'selected':''}} value="pt">{{trans('layout.portuguese')}}</option>
                                                                        <option
                                                                            {{isset($local_setting->language) && $local_setting->language=='hi'?'selected':''}} value="hi">{{trans('layout.hindi')}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label>{{trans('layout.date_time_format')}} </label>

                                                                            <select name="date_time_format"
                                                                                    class="form-control">
                                                                                <option
                                                                                    {{isset($local_setting->date_time_format) && $local_setting->date_time_format=='d m Y'?'selected':''}} value="d m Y">{{trans('30 12 2021')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->date_time_format) && $local_setting->date_time_format=='m d Y'?'selected':''}} value="m d Y">{{trans('12 30 2021')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->date_time_format) && $local_setting->date_time_format=='Y d m'?'selected':''}} value="Y d m">{{trans('2021 30 12')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->date_time_format) && $local_setting->date_time_format=='Y m d'?'selected':''}} value="Y m d">{{trans('2021 12 30')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->date_time_format) && $local_setting->date_time_format=='d_M,Y'?'selected':''}}  value="d_M,Y">{{trans('17 July,2021')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->date_time_format) && $local_setting->date_time_format=='M_d,Y'?'selected':''}}  value="M_d,Y">{{trans('July 17,2021')}}</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label>{{trans('layout.date_time_separator')}} </label>

                                                                            <select name="date_time_separator"
                                                                                    class="form-control">
                                                                                <option
                                                                                    {{isset($local_setting->date_time_separator) && $local_setting->date_time_separator=='-'?'selected':''}} value="-">{{trans('-')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->date_time_separator) && $local_setting->date_time_separator=='/'?'selected':''}} value="/">{{trans('/')}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label>{{trans('layout.timezone')}} </label>

                                                                            <select id="timezone" name="timezone"
                                                                                    class="form-control">

                                                                                @foreach(getAllTimeZones() as $time)
                                                                                    <option
                                                                                        {{isset($local_setting->timezone) && $local_setting->timezone==$time['zone']?'selected':''}} value="{{$time['zone']}}">
                                                                                        ({{$time['GMT_difference']. ' ) '.$time['zone']}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label>{{trans('layout.decimal_point')}} </label>
                                                                            <select name="decimal_format"
                                                                                    class="form-control">
                                                                                <option
                                                                                    {{isset($local_setting->decimal_format) && $local_setting->decimal_format==','?'selected':''}} value=",">{{trans('Comma (,)')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->decimal_format) && $local_setting->decimal_format=='.'?'selected':''}} value=".">{{trans('Dot (.)')}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label>{{trans('layout.currency_symbol')}} </label>

                                                                            <input
                                                                                value="{{isset($local_setting->currency_symbol) ?$local_setting->currency_symbol:''}}"
                                                                                class="form-control" type="text"
                                                                                name="currency_symbol">

                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label>{{trans('layout.currency_code')}} </label>

                                                                            <input
                                                                                value="{{isset($local_setting->currency_code) ?$local_setting->currency_code:''}}"
                                                                                class="form-control" type="text"
                                                                                name="currency_code" placeholder="Ex: usd or eur">
                                                                           <a target="_blank" class="pull-right" href="https://www.iban.com/currency-codes">{{trans('layout.find_yours')}}</a>

                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label>{{trans('layout.currency_symbol_position')}} </label>
                                                                            <select name="currency_symbol_position"
                                                                                    class="form-control">
                                                                                <option
                                                                                    {{isset($local_setting->currency_symbol_position) && $local_setting->currency_symbol_position=='before'?'selected':''}} value="before">{{trans('layout.before')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->currency_symbol_position) && $local_setting->currency_symbol_position=='after'?'selected':''}} value="after">{{trans('layout.after')}}</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label>{{trans('layout.decimals')}} </label>

                                                                            <input
                                                                                value="{{isset($local_setting->decimals) ?$local_setting->decimals:'0'}}"
                                                                                class="form-control" type="number"
                                                                                name="decimals">

                                                                        </div>

                                                                        <div class="col-6">
                                                                            <label>{{trans('layout.thousand_separator')}} </label>
                                                                            <select name="thousand_separator"
                                                                                    class="form-control">
                                                                                <option
                                                                                    {{isset($local_setting->thousand_separator) && $local_setting->thousand_separator==','?'selected':''}} value=",">{{trans('Comma (,)')}}</option>
                                                                                <option
                                                                                    {{isset($local_setting->thousand_separator) && $local_setting->thousand_separator=='.'?'selected':''}} value=".">{{trans('Dot (.)')}}</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-primary">{{trans('layout.submit')}}</button>

                                                            </form>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @can('email_setting')
                            <div class="tab-pane fade" id="emailSettings">
                                <div class="pt-4">
                                    <div class="card">
                                        <form role="form" action="{{route('email.settings')}}" method="post">
                                            @csrf
                                            <div class="card-body">

                                                @isset($email_setting_id)
                                                    <input type="hidden" name="setting_id"
                                                           value="{{$email_setting_id}}">
                                                @endisset
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputPassword1">{{trans('layout.name')}}</label>
                                                            <input
                                                                value="{{isset($email_setting->name)?$email_setting->name:''}}"
                                                                type="text" name="name" class="form-control"
                                                                placeholder="{{trans('layout.name')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputPassword1">{{trans('layout.email_from')}}</label>
                                                            <input
                                                                value="{{isset($email_setting->email_from)?$email_setting->email_from:''}}"
                                                                type="text" name="email_from" class="form-control"
                                                                placeholder="{{trans('layout.email')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputPassword1">{{trans('layout.username')}}</label>
                                                            <input
                                                                value="{{isset($email_setting->username)?$email_setting->username:''}}"
                                                                type="text" name="username" class="form-control"
                                                                placeholder="{{trans('layout.username')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputPassword1">{{trans('layout.password')}}</label>
                                                            <input
                                                                value="{{isset($email_setting->password)?$email_setting->password:''}}"
                                                                type="password" name="password" class="form-control"
                                                                placeholder=" Password">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputPassword1">{{trans('layout.host')}}</label>
                                                            <input
                                                                value="{{isset($email_setting->host)?$email_setting->host:''}}"
                                                                type="text" name="host" class="form-control"
                                                                placeholder="{{trans('layout.host')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputPassword1">{{trans('layout.port')}}</label>
                                                            <input
                                                                value="{{isset($email_setting->port)?$email_setting->port:''}}"
                                                                type="text" name="port" class="form-control"
                                                                placeholder="{{trans('layout.port')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputPassword1">{{trans('layout.encrypt_type')}}</label>
                                                            <select name="encryption_type" class="form-control">
                                                                <option
                                                                    {{isset($email_setting->encryption_type) && $email_setting->encryption_type=='tls'?'selected':''}} value="tls">
                                                                    tls
                                                                </option>
                                                                <option
                                                                    {{isset($email_setting->encryption_type) && $email_setting->encryption_type=='ssl'?'selected':''}} value="ssl">
                                                                    ssl
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer text-right">
                                                <button type="submit"
                                                        class="btn btn-sm btn-primary">{{trans('layout.submit')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('email_template_setting')
                            <div class="tab-pane fade" id="emailTemplate">
                                <div class="pt-4">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <div class="nav nav-pills mb-3 nav-flex">
                                                            <a href="#v-pills-registration" data-toggle="pill"
                                                               class="nav-link active show custom-nav flex-content">{{trans('layout.registration')}}</a>
                                                            <a href="#v-pills-forgetPass" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.forget_password')}}</a>
                                                            <a href="#v-pills-orderPlaced" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.order_placed')}}</a>
                                                            <a href="#v-pills-orderStatus" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.order_status')}}</a>
                                                            <a href="#v-pills-planRequest" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.plan_request')}}</a>
                                                            <a href="#v-pills-planAccepted" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.plan_accept')}}</a>
                                                            <a href="#v-pills-planExpire" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.plan_expire')}}</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-8">
                                                        <div class="tab-content">
                                                            <div id="v-pills-registration"
                                                                 class="tab-pane fade active show">
                                                                <form action="{{route('email.template.store')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @isset($emailTemplateReg)
                                                                        <input type="hidden"
                                                                               value="{{$emailTemplateReg->id}}"
                                                                               name="emailTemplateID">
                                                                    @endisset
                                                                    <input type="hidden" name="type"
                                                                           value="{{isset($emailTemplateReg->type)?$emailTemplateReg->type:'registration'}}">
                                                                    <textarea class="form-control" name="subject"
                                                                              rows="2"
                                                                              placeholder="{{trans('layout.email_subject')}}">{{isset($emailTemplateReg->subject)?$emailTemplateReg->subject:''}}</textarea>
                                                                    <textarea class="form-control mt-2" name="body"

                                                                              rows="5"
                                                                              placeholder="{{trans('layout.email_body')}}">{{isset($emailTemplateReg->body)?$emailTemplateReg->body:''}}</textarea>

                                                                    <div>{customer_name} = Customer Name</div>
                                                                    <div>{click_here} = For verification link</div>
                                                                    <button type="submit"
                                                                            class="btn btn-primary float-right mt-4">
                                                                        {{trans('layout.submit')}}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div id="v-pills-forgetPass" class="tab-pane fade">
                                                                <form action="{{route('email.template.store')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @isset($emailTemplatePass)
                                                                        <input type="hidden"
                                                                               value="{{$emailTemplatePass->id}}"
                                                                               name="emailTemplateID">
                                                                    @endisset
                                                                    <input type="hidden" name="type"
                                                                           value="{{isset($emailTemplatePass->type)?$emailTemplatePass->type:'forget_password'}}">
                                                                    <textarea class="form-control" name="subject"
                                                                              rows="2"
                                                                              placeholder="{{trans('layout.email_subject')}}">{{isset($emailTemplatePass->subject)?$emailTemplatePass->subject:''}}</textarea>
                                                                    <textarea class="form-control mt-2" name="body"

                                                                              rows="5"
                                                                              placeholder="{{trans('layout.email_body')}}">{{isset($emailTemplatePass->body)?$emailTemplatePass->body:''}}</textarea>
                                                                    <div>{customer_name} = Customer Name</div>
                                                                    <div>{reset_url} = Reset URL Link</div>
                                                                    <button type="submit"
                                                                            class="btn btn-primary float-right mt-4">
                                                                        {{trans('layout.submit')}}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div id="v-pills-orderPlaced" class="tab-pane fade">
                                                                <form action="{{route('email.template.store')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @isset($emailTemplateOrderPlaced)
                                                                        <input type="hidden"
                                                                               value="{{$emailTemplateOrderPlaced->id}}"
                                                                               name="emailTemplateID">
                                                                    @endisset
                                                                    <input type="hidden" name="type"
                                                                           value="{{isset($emailTemplateOrderPlaced->type)?$emailTemplateOrderPlaced->type:'order_placed'}}">
                                                                    <textarea class="form-control" name="subject"
                                                                              rows="2"
                                                                              placeholder="{{trans('layout.email_subject')}}">{{isset($emailTemplateOrderPlaced->subject)?$emailTemplateOrderPlaced->subject:''}}</textarea>
                                                                    <textarea class="form-control mt-2" name="body"

                                                                              rows="5"
                                                                              placeholder="{{trans('layout.email_body')}}">{{isset($emailTemplateOrderPlaced->body)?$emailTemplateOrderPlaced->body:''}}</textarea>

                                                                    <div>{customer_name} = Customer Name</div>
                                                                    <button type="submit"
                                                                            class="btn btn-primary float-right mt-4">
                                                                        {{trans('layout.submit')}}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div id="v-pills-orderStatus" class="tab-pane fade">
                                                                <form action="{{route('email.template.store')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @isset($emailTemplateOrderStatus)
                                                                        <input type="hidden"
                                                                               value="{{$emailTemplateOrderStatus->id}}"
                                                                               name="emailTemplateID">
                                                                    @endisset
                                                                    <input type="hidden" name="type"
                                                                           value="{{isset($emailTemplateOrderStatus->type)?$emailTemplateOrderStatus->type:'order_status'}}">
                                                                    <textarea class="form-control" name="subject"
                                                                              rows="2"
                                                                              placeholder="{{trans('layout.email_subject')}}">{{isset($emailTemplateOrderStatus->subject)?$emailTemplateOrderStatus->subject:''}}</textarea>
                                                                    <textarea class="form-control mt-2" name="body"

                                                                              rows="5"
                                                                              placeholder="{{trans('layout.email_body')}}">{{isset($emailTemplateOrderStatus->body)?$emailTemplateOrderStatus->body:''}}</textarea>

                                                                    <div>{customer_name} = Customer Name</div>
                                                                    <button type="submit"
                                                                            class="btn btn-primary float-right mt-4">
                                                                        {{trans('layout.submit')}}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div id="v-pills-planRequest" class="tab-pane fade">
                                                                <form action="{{route('email.template.store')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @isset($emailTemplatePlanRequest)
                                                                        <input type="hidden"
                                                                               value="{{$emailTemplatePlanRequest->id}}"
                                                                               name="emailTemplateID">
                                                                    @endisset
                                                                    <input type="hidden" name="type"
                                                                           value="{{isset($emailTemplatePlanRequest->type)?$emailTemplatePlanRequest->type:'plan_request'}}">
                                                                    <textarea class="form-control" name="subject"
                                                                              rows="2"
                                                                              placeholder="{{trans('layout.email_subject')}}">{{isset($emailTemplatePlanRequest->subject)?$emailTemplatePlanRequest->subject:''}}</textarea>
                                                                    <textarea class="form-control mt-2" name="body"

                                                                              rows="5"
                                                                              placeholder="{{trans('layout.email_body')}}">{{isset($emailTemplatePlanRequest->body)?$emailTemplatePlanRequest->body:''}}</textarea>

                                                                    <div>{customer_name} = Customer Name</div>
                                                                    <button type="submit"
                                                                            class="btn btn-primary float-right mt-4">
                                                                        {{trans('layout.submit')}}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div id="v-pills-planAccepted" class="tab-pane fade">
                                                                <form action="{{route('email.template.store')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @isset($emailTemplatePlanAccepted)
                                                                        <input type="hidden"
                                                                               value="{{$emailTemplatePlanAccepted->id}}"
                                                                               name="emailTemplateID">
                                                                    @endisset
                                                                    <input type="hidden" name="type"
                                                                           value="{{isset($emailTemplatePlanAccepted->type)?$emailTemplatePlanAccepted->type:'plan_accepted'}}">
                                                                    <textarea class="form-control" name="subject"
                                                                              rows="2"
                                                                              placeholder="{{trans('layout.email_subject')}}">{{isset($emailTemplatePlanAccepted->subject)?$emailTemplatePlanAccepted->subject:''}}</textarea>
                                                                    <textarea class="form-control mt-2" name="body"

                                                                              rows="5"
                                                                              placeholder="{{trans('layout.email_body')}}">{{isset($emailTemplatePlanAccepted->body)?$emailTemplatePlanAccepted->body:''}}</textarea>

                                                                    <div>{customer_name} = Customer Name</div>
                                                                    <button type="submit"
                                                                            class="btn btn-primary float-right mt-4">
                                                                        {{trans('layout.submit')}}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div id="v-pills-planExpire" class="tab-pane fade">
                                                                <form action="{{route('email.template.store')}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @isset($emailTemplatePlanExpire)
                                                                        <input type="hidden"
                                                                               value="{{$emailTemplatePlanExpire->id}}"
                                                                               name="emailTemplateID">
                                                                    @endisset
                                                                    <input type="hidden" name="type"
                                                                           value="{{isset($emailTemplatePlanExpire->type)?$emailTemplatePlanExpire->type:'plan_expired'}}">
                                                                    <textarea class="form-control" name="subject"
                                                                              rows="2"
                                                                              placeholder="{{trans('layout.email_subject')}}">{{isset($emailTemplatePlanExpire->subject)?$emailTemplatePlanExpire->subject:''}}</textarea>
                                                                    <textarea class="form-control mt-2" name="body"

                                                                              rows="5"
                                                                              placeholder="{{trans('layout.email_body')}}">{{isset($emailTemplatePlanExpire->body)?$emailTemplatePlanExpire->body:''}}</textarea>

                                                                    <div>{customer_name} = Customer Name</div>
                                                                    <button type="submit"
                                                                            class="btn btn-primary float-right mt-4">
                                                                        {{trans('layout.submit')}}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('payment_gateway_setting')
                            <div class="tab-pane fade" id="paymentGateway">
                                <div class="pt-4">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-3">
                                                        <div class="nav nav-pills mb-3 nav-flex">
                                                            <a href="#v-pills-paypalPay" data-toggle="pill"
                                                               class="nav-link active show custom-nav flex-content">{{trans('layout.paypal')}}</a>
                                                            <a href="#v-pills-stripePay" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.stripe')}}</a>
                                                            <a href="#v-pills-paytm" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.paytm')}}</a>
                                                            <a href="#v-pills-offline" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.offline')}}</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-9">
                                                        <form action="{{route('payment.gateway')}}" method="post">
                                                            <div class="tab-content">

                                                                @php $rest_gateways=get_restaurant_gateway_settings(auth()->id()) @endphp

                                                                @csrf
                                                                @if(auth()->user()->type=='admin')
                                                                    @isset($payment_gateway_id)
                                                                        <input type="hidden"
                                                                               name="payment_gateway_id"
                                                                               value="{{$payment_gateway_id}}">
                                                                    @endisset
                                                                    @include('settings.admin_payment_gateway')

                                                                @else
                                                                    @if($rest_gateways)
                                                                        <input type="hidden"
                                                                               name="rest_payment_gateway_id"
                                                                               value="{{$rest_gateways->id}}">
                                                                        @php $rest_gateways_credentials=json_decode(get_restaurant_gateway_settings(auth()->id())->value); @endphp
                                                                    @endif

                                                                    @include('settings.restaurant_payment_gateway')

                                                                @endif

                                                            </div>
                                                            <button type="submit"
                                                                    class="btn btn-primary float-right mt-4">
                                                                {{trans('layout.submit')}}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('sms_gateway_setting')
                            <div class="tab-pane fade" id="smsGateway">
                                <div class="pt-4">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-3">
                                                        <div class="nav nav-pills mb-3 nav-flex">
                                                            <a href="#v-pills-twilio" data-toggle="pill"
                                                               class="nav-link active show custom-nav flex-content">{{trans('layout.twilio')}}</a>
                                                            <a href="#v-pills-voyager" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.voyager')}}</a>
                                                            <a href="#v-pills-signalwire" data-toggle="pill"
                                                               class="nav-link custom-nav flex-content">{{trans('layout.signalwire')}}</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-9">
                                                        <form action="{{route('sms.gateway')}}" method="post">
                                                            <div class="tab-content">
                                                                <div id="v-pills-twilio"
                                                                     class="tab-pane fade active show">
                                                                    @csrf
                                                                    @isset($sms_gateway_id)
                                                                        <input type="hidden" name="sms_gateway_id"
                                                                               value="{{$sms_gateway_id}}">
                                                                    @endisset
                                                                    
                                                                    @if( isset($sms_admin_gateway_id) )
                                                                      <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.sid')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_admin_gateway->twilio_sid)?$sms_admin_gateway->twilio_sid:''}}"
                                                                            type="text" name="twilio_sid"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.token')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_admin_gateway->twilio_token)?$sms_admin_gateway->twilio_token:''}}"
                                                                            type="text" name="twilio_token"
                                                                            class="form-control">
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="whatsappnumber">{{trans('layout.whatsappnum')}}</label>
                                                                            <select name="countrycode" id="countryCode" class="smswhatsapp">
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1'?'selected':''}} value="1">+1</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='213'?'selected':''}} value="213">+213</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='376'?'selected':''}} value="376">+376</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='244'?'selected':''}} value="244">+244</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1264'?'selected':''}} value="1264">+1264</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1268'?'selected':''}} value="1268">+1268</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='54'?'selected':''}} value="54">+54</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='374'?'selected':''}} value="374">+374</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='297'?'selected':''}} value="297">+297</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='61'?'selected':''}} value="61">+61</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='43'?'selected':''}} value="43">+43</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='994'?'selected':''}} value="994">+994</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1242'?'selected':''}} value="1242">+1242</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='973'?'selected':''}} value="973">+973</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='880'?'selected':''}} value="880">+880</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1246'?'selected':''}} value="1246">+1246</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='375'?'selected':''}} value="375">+375</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='32'?'selected':''}} value="32">+32</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='501'?'selected':''}} value="501">+501</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='229'?'selected':''}} value="229">+229</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1441'?'selected':''}} value="1441">+1441</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='975'?'selected':''}} value="975">+975</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='591'?'selected':''}} value="591">+591</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='387'?'selected':''}} value="387">+387</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='267'?'selected':''}} value="267">+267</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='55'?'selected':''}} value="55">+55</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='673'?'selected':''}} value="673">+673</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='359'?'selected':''}} value="359">+359</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='226'?'selected':''}} value="226">+226</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='257'?'selected':''}} value="257">+257</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='855'?'selected':''}} value="855">+855</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='237'?'selected':''}} value="237">+237</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='238'?'selected':''}} value="238">+238</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1345'?'selected':''}} value="1345">+1345</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='236'?'selected':''}} value="236">+236</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='56'?'selected':''}} value="56">+56</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='86'?'selected':''}} value="86">+86</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='57'?'selected':''}} value="57">+57</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='269'?'selected':''}} value="269">+269</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='242'?'selected':''}} value="242">+242</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='682'?'selected':''}} value="682">+682</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='506'?'selected':''}} value="506">+506</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='385'?'selected':''}} value="385">+385</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='53'?'selected':''}} value="53">+53</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='90392'?'selected':''}} value="90392">+90392</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='357'?'selected':''}} value="357">+357</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='42'?'selected':''}} value="42">+42</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='45'?'selected':''}} value="45">+45</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='253'?'selected':''}} value="253">+253</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1809'?'selected':''}} value="1809">+1809</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='593'?'selected':''}} value="593">+593</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='20'?'selected':''}} value="20">+20</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='503'?'selected':''}} value="503">+503</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='240'?'selected':''}} value="240">+240</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='291'?'selected':''}} value="291">+291</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='372'?'selected':''}} value="372">+372</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='251'?'selected':''}} value="251">+251</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='500'?'selected':''}} value="500">+500</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='298'?'selected':''}} value="298">+298</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='679'?'selected':''}} value="679">+679</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='358'?'selected':''}} value="358">+358</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='33'?'selected':''}} value="33">+33</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='594'?'selected':''}} value="594">+594</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='689'?'selected':''}} value="689">+689</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='241'?'selected':''}} value="241">+241</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='220'?'selected':''}} value="220">+220</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='7880'?'selected':''}} value="7880">+7880</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='49'?'selected':''}} value="49">+49</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='233'?'selected':''}} value="233">+233</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='350'?'selected':''}} value="350">+350</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='30'?'selected':''}} value="30">+30</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='30'?'selected':''}} value="30">+30</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='299'?'selected':''}} value="299">+299</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1473'?'selected':''}} value="1473">+1473</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='590'?'selected':''}} value="590">+590</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='671'?'selected':''}} value="671">+671</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='502'?'selected':''}} value="502">+502</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='224'?'selected':''}} value="224">+224</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='245'?'selected':''}} value="245">+245</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='592'?'selected':''}} value="592">+592</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='509'?'selected':''}} value="509">+509</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='504'?'selected':''}} value="504">+504</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='852'?'selected':''}} value="852">+852</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='36'?'selected':''}} value="36">+36</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='354'?'selected':''}} value="354">+354</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='91'?'selected':''}} value="91">+91</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='62'?'selected':''}} value="62">+62</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='98'?'selected':''}} value="98">+98</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='964'?'selected':''}} value="964">+964</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='353'?'selected':''}} value="353">+353</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='972'?'selected':''}} value="972">+972</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='39'?'selected':''}} value="39">+39</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1876'?'selected':''}} value="1876">+1876</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='81'?'selected':''}} value="81">+81</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='962'?'selected':''}} value="962">+962</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='254'?'selected':''}} value="254">+254</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='686'?'selected':''}} value="686">+686</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='850'?'selected':''}} value="850">+850</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='82'?'selected':''}} value="82">+82</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='965'?'selected':''}} value="965">+965</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='996'?'selected':''}} value="996">+996</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='856'?'selected':''}} value="856">+856</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='371'?'selected':''}} value="371">+371</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='961'?'selected':''}} value="961">+961</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='266'?'selected':''}} value="266">+266</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='231'?'selected':''}} value="231">+231</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='218'?'selected':''}} value="218">+218</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='417'?'selected':''}} value="417">+417</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='370'?'selected':''}} value="370">+370</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='352'?'selected':''}} value="352">+352</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='853'?'selected':''}} value="853">+853</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='389'?'selected':''}} value="389">+389</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='261'?'selected':''}} value="261">+261</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='265'?'selected':''}} value="265">+265</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='60'?'selected':''}} value="60">+60</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='960'?'selected':''}} value="960">+960</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='223'?'selected':''}} value="223">+223</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='356'?'selected':''}} value="356">+356</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='692'?'selected':''}} value="692">+692</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='596'?'selected':''}} value="596">+596</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='222'?'selected':''}} value="222">+222</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='269'?'selected':''}} value="269">+269</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='52'?'selected':''}} value="52">+52</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='691'?'selected':''}} value="691">+691</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='373'?'selected':''}} value="373">+373</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='377'?'selected':''}} value="377">+377</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='976'?'selected':''}} value="976">+976</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1664'?'selected':''}} value="1664">+1664</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='212'?'selected':''}} value="212">+212</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='258'?'selected':''}} value="258">+258</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='95'?'selected':''}} value="95">+95</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='264'?'selected':''}} value="264">+264</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='674'?'selected':''}} value="674">+674</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='977'?'selected':''}} value="977">+977</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='31'?'selected':''}} value="31">+31</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='687'?'selected':''}} value="687">+687</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='64'?'selected':''}} value="64">+64</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='505'?'selected':''}} value="505">+505</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='227'?'selected':''}} value="227">+227</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='234'?'selected':''}} value="234">+234</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='683'?'selected':''}} value="683">+683</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='672'?'selected':''}} value="672">+672</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='670'?'selected':''}} value="670">+670</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='47'?'selected':''}} value="47">+47</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='968'?'selected':''}} value="968">+968</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='680'?'selected':''}} value="680">+680</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='507'?'selected':''}} value="507">+507</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='675'?'selected':''}} value="675">+675</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='595'?'selected':''}} value="595">+595</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='51'?'selected':''}} value="51">+51</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='63'?'selected':''}} value="63">+63</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='48'?'selected':''}} value="48">+48</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='351'?'selected':''}} value="351">+351</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1787'?'selected':''}} value="1787">+1787</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='974'?'selected':''}} value="974">+974</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='262'?'selected':''}} value="262">+262</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='40'?'selected':''}} value="40">+40</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='250'?'selected':''}} value="250">+250</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='378'?'selected':''}} value="378">+378</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='239'?'selected':''}} value="239">+239</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='966'?'selected':''}} value="966">+966</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='221'?'selected':''}} value="221">+221</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='381'?'selected':''}} value="381">+381</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='248'?'selected':''}} value="248">+248</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='232'?'selected':''}} value="232">+232</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='65'?'selected':''}} value="65">+65</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='421'?'selected':''}} value="421">+421</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='386'?'selected':''}} value="386">+386</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='677'?'selected':''}} value="677">+677</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='252'?'selected':''}} value="252">+252</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='27'?'selected':''}} value="27">+27</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='34'?'selected':''}} value="34">+34</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='94'?'selected':''}} value="94">+94</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='290'?'selected':''}} value="290">+290</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1869'?'selected':''}} value="1869">+1869</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1758'?'selected':''}} value="1758">+1758</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='249'?'selected':''}} value="249">+249</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='597'?'selected':''}} value="597">+597</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='268'?'selected':''}} value="268">+268</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='268'?'selected':''}} value="268">+268</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='46'?'selected':''}} value="46">+46</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='41'?'selected':''}} value="41">+41</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='963'?'selected':''}} value="963">+963</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='886'?'selected':''}} value="886">+886</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='66'?'selected':''}} value="66">+66</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='228'?'selected':''}} value="228">+228</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='228'?'selected':''}} value="676">+676</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1868'?'selected':''}} value="1868">+1868</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='216'?'selected':''}} value="216">+216</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='90'?'selected':''}} value="90">+90</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='993'?'selected':''}} value="993">+993</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1649'?'selected':''}} value="1649">+1649</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='688'?'selected':''}} value="688">+688</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='256'?'selected':''}} value="256">+256</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='44'?'selected':''}} value="44">+44</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='380'?'selected':''}} value="380">+380</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='971'?'selected':''}} value="971">+971</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='598'?'selected':''}} value="598">+598</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1'?'selected':''}} value="1">+1</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='678'?'selected':''}} value="678">+678</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='379'?'selected':''}} value="379">+379</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='58'?'selected':''}} value="58">+58</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='84'?'selected':''}} value="84">+84</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1284'?'selected':''}} value="1284">+1284</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='1340'?'selected':''}} value="1340">+1340</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='681'?'selected':''}} value="681">+681</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='969'?'selected':''}} value="969">+969</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='967'?'selected':''}} value="967">+967</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='260'?'selected':''}} value="260">+260</option>
                                                                              <option {{isset($sms_admin_gateway->countrycode) && $sms_admin_gateway->countrycode=='263'?'selected':''}} value="263">+263</option>
                                                                          </select>
                                                                        <input
                                                                            value="{{isset($sms_admin_gateway->whatsappnumber)?$sms_admin_gateway->whatsappnumber:''}}"
                                                                            type="number" name="whatsappnumber"
                                                                            class="form-control" id="smswhatsappnum">
                                                                    </div>
                                                                    @else
                                                                      <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.sid')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_gateway->twilio_sid)?$sms_gateway->twilio_sid:''}}"
                                                                            type="text" name="twilio_sid"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.token')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_gateway->twilio_token)?$sms_gateway->twilio_token:''}}"
                                                                            type="text" name="twilio_token"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="whatsappnumber">{{trans('layout.whatsappnum')}}</label>
                                                                            <select name="countrycode" id="countryCode" class="smswhatsapp">
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1'?'selected':''}} value="1">+1</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='213'?'selected':''}} value="213">+213</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='376'?'selected':''}} value="376">+376</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='244'?'selected':''}} value="244">+244</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1264'?'selected':''}} value="1264">+1264</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1268'?'selected':''}} value="1268">+1268</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='54'?'selected':''}} value="54">+54</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='374'?'selected':''}} value="374">+374</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='297'?'selected':''}} value="297">+297</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='61'?'selected':''}} value="61">+61</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='43'?'selected':''}} value="43">+43</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='994'?'selected':''}} value="994">+994</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1242'?'selected':''}} value="1242">+1242</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='973'?'selected':''}} value="973">+973</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='880'?'selected':''}} value="880">+880</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1246'?'selected':''}} value="1246">+1246</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='375'?'selected':''}} value="375">+375</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='32'?'selected':''}} value="32">+32</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='501'?'selected':''}} value="501">+501</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='229'?'selected':''}} value="229">+229</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1441'?'selected':''}} value="1441">+1441</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='975'?'selected':''}} value="975">+975</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='591'?'selected':''}} value="591">+591</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='387'?'selected':''}} value="387">+387</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='267'?'selected':''}} value="267">+267</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='55'?'selected':''}} value="55">+55</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='673'?'selected':''}} value="673">+673</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='359'?'selected':''}} value="359">+359</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='226'?'selected':''}} value="226">+226</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='257'?'selected':''}} value="257">+257</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='855'?'selected':''}} value="855">+855</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='237'?'selected':''}} value="237">+237</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='238'?'selected':''}} value="238">+238</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1345'?'selected':''}} value="1345">+1345</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='236'?'selected':''}} value="236">+236</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='56'?'selected':''}} value="56">+56</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='86'?'selected':''}} value="86">+86</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='57'?'selected':''}} value="57">+57</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='269'?'selected':''}} value="269">+269</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='242'?'selected':''}} value="242">+242</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='682'?'selected':''}} value="682">+682</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='506'?'selected':''}} value="506">+506</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='385'?'selected':''}} value="385">+385</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='53'?'selected':''}} value="53">+53</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='90392'?'selected':''}} value="90392">+90392</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='357'?'selected':''}} value="357">+357</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='42'?'selected':''}} value="42">+42</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='45'?'selected':''}} value="45">+45</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='253'?'selected':''}} value="253">+253</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1809'?'selected':''}} value="1809">+1809</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='593'?'selected':''}} value="593">+593</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='20'?'selected':''}} value="20">+20</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='503'?'selected':''}} value="503">+503</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='240'?'selected':''}} value="240">+240</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='291'?'selected':''}} value="291">+291</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='372'?'selected':''}} value="372">+372</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='251'?'selected':''}} value="251">+251</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='500'?'selected':''}} value="500">+500</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='298'?'selected':''}} value="298">+298</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='679'?'selected':''}} value="679">+679</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='358'?'selected':''}} value="358">+358</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='33'?'selected':''}} value="33">+33</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='594'?'selected':''}} value="594">+594</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='689'?'selected':''}} value="689">+689</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='241'?'selected':''}} value="241">+241</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='220'?'selected':''}} value="220">+220</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='7880'?'selected':''}} value="7880">+7880</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='49'?'selected':''}} value="49">+49</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='233'?'selected':''}} value="233">+233</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='350'?'selected':''}} value="350">+350</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='30'?'selected':''}} value="30">+30</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='30'?'selected':''}} value="30">+30</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='299'?'selected':''}} value="299">+299</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1473'?'selected':''}} value="1473">+1473</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='590'?'selected':''}} value="590">+590</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='671'?'selected':''}} value="671">+671</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='502'?'selected':''}} value="502">+502</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='224'?'selected':''}} value="224">+224</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='245'?'selected':''}} value="245">+245</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='592'?'selected':''}} value="592">+592</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='509'?'selected':''}} value="509">+509</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='504'?'selected':''}} value="504">+504</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='852'?'selected':''}} value="852">+852</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='36'?'selected':''}} value="36">+36</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='354'?'selected':''}} value="354">+354</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='91'?'selected':''}} value="91">+91</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='62'?'selected':''}} value="62">+62</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='98'?'selected':''}} value="98">+98</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='964'?'selected':''}} value="964">+964</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='353'?'selected':''}} value="353">+353</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='972'?'selected':''}} value="972">+972</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='39'?'selected':''}} value="39">+39</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1876'?'selected':''}} value="1876">+1876</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='81'?'selected':''}} value="81">+81</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='962'?'selected':''}} value="962">+962</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='254'?'selected':''}} value="254">+254</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='686'?'selected':''}} value="686">+686</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='850'?'selected':''}} value="850">+850</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='82'?'selected':''}} value="82">+82</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='965'?'selected':''}} value="965">+965</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='996'?'selected':''}} value="996">+996</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='856'?'selected':''}} value="856">+856</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='371'?'selected':''}} value="371">+371</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='961'?'selected':''}} value="961">+961</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='266'?'selected':''}} value="266">+266</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='231'?'selected':''}} value="231">+231</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='218'?'selected':''}} value="218">+218</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='417'?'selected':''}} value="417">+417</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='370'?'selected':''}} value="370">+370</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='352'?'selected':''}} value="352">+352</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='853'?'selected':''}} value="853">+853</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='389'?'selected':''}} value="389">+389</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='261'?'selected':''}} value="261">+261</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='265'?'selected':''}} value="265">+265</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='60'?'selected':''}} value="60">+60</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='960'?'selected':''}} value="960">+960</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='223'?'selected':''}} value="223">+223</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='356'?'selected':''}} value="356">+356</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='692'?'selected':''}} value="692">+692</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='596'?'selected':''}} value="596">+596</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='222'?'selected':''}} value="222">+222</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='269'?'selected':''}} value="269">+269</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='52'?'selected':''}} value="52">+52</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='691'?'selected':''}} value="691">+691</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='373'?'selected':''}} value="373">+373</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='377'?'selected':''}} value="377">+377</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='976'?'selected':''}} value="976">+976</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1664'?'selected':''}} value="1664">+1664</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='212'?'selected':''}} value="212">+212</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='258'?'selected':''}} value="258">+258</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='95'?'selected':''}} value="95">+95</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='264'?'selected':''}} value="264">+264</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='674'?'selected':''}} value="674">+674</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='977'?'selected':''}} value="977">+977</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='31'?'selected':''}} value="31">+31</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='687'?'selected':''}} value="687">+687</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='64'?'selected':''}} value="64">+64</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='505'?'selected':''}} value="505">+505</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='227'?'selected':''}} value="227">+227</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='234'?'selected':''}} value="234">+234</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='683'?'selected':''}} value="683">+683</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='672'?'selected':''}} value="672">+672</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='670'?'selected':''}} value="670">+670</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='47'?'selected':''}} value="47">+47</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='968'?'selected':''}} value="968">+968</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='680'?'selected':''}} value="680">+680</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='507'?'selected':''}} value="507">+507</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='675'?'selected':''}} value="675">+675</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='595'?'selected':''}} value="595">+595</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='51'?'selected':''}} value="51">+51</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='63'?'selected':''}} value="63">+63</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='48'?'selected':''}} value="48">+48</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='351'?'selected':''}} value="351">+351</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1787'?'selected':''}} value="1787">+1787</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='974'?'selected':''}} value="974">+974</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='262'?'selected':''}} value="262">+262</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='40'?'selected':''}} value="40">+40</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='250'?'selected':''}} value="250">+250</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='378'?'selected':''}} value="378">+378</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='239'?'selected':''}} value="239">+239</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='966'?'selected':''}} value="966">+966</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='221'?'selected':''}} value="221">+221</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='381'?'selected':''}} value="381">+381</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='248'?'selected':''}} value="248">+248</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='232'?'selected':''}} value="232">+232</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='65'?'selected':''}} value="65">+65</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='421'?'selected':''}} value="421">+421</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='386'?'selected':''}} value="386">+386</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='677'?'selected':''}} value="677">+677</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='252'?'selected':''}} value="252">+252</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='27'?'selected':''}} value="27">+27</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='34'?'selected':''}} value="34">+34</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='94'?'selected':''}} value="94">+94</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='290'?'selected':''}} value="290">+290</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1869'?'selected':''}} value="1869">+1869</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1758'?'selected':''}} value="1758">+1758</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='249'?'selected':''}} value="249">+249</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='597'?'selected':''}} value="597">+597</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='268'?'selected':''}} value="268">+268</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='268'?'selected':''}} value="268">+268</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='46'?'selected':''}} value="46">+46</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='41'?'selected':''}} value="41">+41</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='963'?'selected':''}} value="963">+963</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='886'?'selected':''}} value="886">+886</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='66'?'selected':''}} value="66">+66</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='228'?'selected':''}} value="228">+228</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='228'?'selected':''}} value="676">+676</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1868'?'selected':''}} value="1868">+1868</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='216'?'selected':''}} value="216">+216</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='90'?'selected':''}} value="90">+90</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='993'?'selected':''}} value="993">+993</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1649'?'selected':''}} value="1649">+1649</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='688'?'selected':''}} value="688">+688</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='256'?'selected':''}} value="256">+256</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='44'?'selected':''}} value="44">+44</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='380'?'selected':''}} value="380">+380</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='971'?'selected':''}} value="971">+971</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='598'?'selected':''}} value="598">+598</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1'?'selected':''}} value="1">+1</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='7'?'selected':''}} value="7">+7</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='678'?'selected':''}} value="678">+678</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='379'?'selected':''}} value="379">+379</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='58'?'selected':''}} value="58">+58</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='84'?'selected':''}} value="84">+84</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1284'?'selected':''}} value="1284">+1284</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='1340'?'selected':''}} value="1340">+1340</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='681'?'selected':''}} value="681">+681</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='969'?'selected':''}} value="969">+969</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='967'?'selected':''}} value="967">+967</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='260'?'selected':''}} value="260">+260</option>
                                                                              <option {{isset($sms_gateway->countrycode) && $sms_gateway->countrycode=='263'?'selected':''}} value="263">+263</option>
                                                                          </select>
                                                                        <input
                                                                            value="{{isset($sms_gateway->whatsappnumber)?$sms_gateway->whatsappnumber:''}}"
                                                                            type="number" name="whatsappnumber"
                                                                            class="form-control" id="smswhatsappnum">
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div id="v-pills-voyager" class="tab-pane fade">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.api_key')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_gateway->voyager_api)?$sms_gateway->voyager_api:''}}"
                                                                            type="text" name="voyager_api"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.api_secret')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_gateway->voyager_api_secret)?$sms_gateway->voyager_api_secret:''}}"
                                                                            type="text" name="voyager_api_secret"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div id="v-pills-signalwire" class="tab-pane fade">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.project_id')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_gateway->signalwire_project_id)?$sms_gateway->signalwire_project_id:''}}"
                                                                            type="text" name="signalwire_project_id"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.space_url')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_gateway->signalware_url)?$sms_gateway->signalware_url:''}}"
                                                                            type="text" name="signalware_url"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputPassword1">{{trans('layout.token')}}</label>
                                                                        <input
                                                                            value="{{isset($sms_gateway->signalware_token)?$sms_gateway->signalware_token:''}}"
                                                                            type="text" name="signalware_token"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                    class="btn btn-primary float-right mt-4">
                                                                {{trans('layout.submit')}}
                                                            </button>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('tax_setting')
                            <div class="tab-pane fade" id="taxSetting">
                                <div class="pt-4">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <form action="{{route('tax.setting')}}" method="post">
                                                          @csrf
                                                          @isset($vat_setting_id)
                                                                        <input type="hidden" name="vat_setting_id"
                                                                               value="{{$vat_setting_id}}" placeholder="Ex: 5">
                                                           @endisset
                                                          <div class="form-group">
                                                            <label for="vatpercentage">{{trans('layout.vat_percentage')}}</label>
                                                            <input value="{{isset($vat_setting->vat_percentage)?$vat_setting->vat_percentage:''}}" type="number" name="vat_percentage" class="form-control">
                                                          </div>
                                                          <button type="submit" class="btn btn-primary float-right mt-4">{{trans('layout.submit')}}
                                                          </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('role_permission')
                            <div class="tab-pane fade" id="rolePermission">
                                <div class="pt-4">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <form class="{{auth()->user()->type=='admin'?'':'d-none'}}" action="{{route('settings.permission.update')}}" method="post">
                                                @csrf
                                                <div class="card-body">

                                                    <div class="row mb-2 d-none">
                                                        <div class="col-lg-2">
                                                            <label>Admin</label>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                @foreach($permissions as $permission)
                                                                    <div class="col-4">
                                                                        <div
                                                                            class="custom-control custom-checkbox mb-3 checkbox-info">
                                                                            <input
                                                                                {{in_array($permission->name,$admin_permissions)?'checked':''}} name="admin_permission[]"
                                                                                value="{{$permission->name}}"
                                                                                type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="admin-permission-{{$permission->id}}">
                                                                            <label class="custom-control-label"
                                                                                   for="admin-permission-{{$permission->id}}">{{ucfirst(str_replace('_',' ',$permission->name))}}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2 {{auth()->user()->type=='admin'?'':'d-none'}}">
                                                        <div class="col-lg-2">
                                                            <label>Restaurant Owner</label>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                @foreach($permissions->whereIn('name',get_restaurant_permissions()) as $permission)
                                                                    <div class="col-4">
                                                                        <div
                                                                            class="custom-control custom-checkbox mb-3 checkbox-info">
                                                                            <input
                                                                                {{in_array($permission->name,$rest_owner_permissions)?'checked':''}} name="rest_owner_permission[]"
                                                                                value="{{$permission->name}}"
                                                                                type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="rest_owner-permission-{{$permission->id}}">
                                                                            <label class="custom-control-label"
                                                                                   for="rest_owner-permission-{{$permission->id}}">{{ucfirst(str_replace('_',' ',$permission->name))}}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <hr class="{{auth()->user()->type=='admin'?'':'d-none'}}">
                                                    <div class="row mb-2 {{auth()->user()->type=='admin'?'':'d-none'}}">
                                                        <div class="col-lg-2">
                                                            <label>Customer</label>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                @foreach($permissions->whereIn('name',get_customer_permissions()) as $permission)
                                                                    <div class="col-4">
                                                                        <div
                                                                            class="custom-control custom-checkbox mb-3 checkbox-info">
                                                                            <input
                                                                                {{in_array($permission->name,$customer_permissions)?'checked':''}} name="customer_permission[]"
                                                                                value="{{$permission->name}}"
                                                                                type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="customer-permission-{{$permission->id}}">
                                                                            <label class="custom-control-label"
                                                                                   for="customer-permission-{{$permission->id}}">{{ucfirst(str_replace('_',' ',$permission->name))}}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-footer text-right">
                                                    <button
                                                        class="btn btn-sm btn-primary">{{trans('layout.submit')}}</button>
                                                </div>
                                            </form>
                                            @if(auth()->user()->type=='restaurant_owner')
                                                <form action="{{route('user.permission.update')}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    @foreach($roles as $role)
                                                    @if($role->name !='admin' && $role->name !='customer' &&  $role->name != 'restaurant_owner')
                                                    @if(auth()->user()->id==$role->restaurant_id)
                                                    <div class="row mb-2" id="show_role_{{$role->name}}">
                                                        <div class="col-lg-2">
                                                            <label>{{$role->name}} <span
                                                            class="float-right ml-3"><a
                                                                href="#"><i data-role="{{$role->name}}"
                                                                            class="fa fa-trash text-danger"></i></a></span></label>
                                                        </div>
                                                    <div class="col-lg-10">
                                                        <div class="row">
                                                            <input type="hidden" value="{{$role->name}}"
                                                               name="role_name[]">
                                                        @php $rolePermissions= \Spatie\Permission\Models\Role::findByName($role->name)->getAllPermissions()->pluck('name')->toArray();@endphp
                                                        @foreach(get_user_permission() as $key=>$permission)
                                                            <div class="col-sm-4 display">
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success">
                                                                        <input
                                                                            name="permission[{{$role->id}}][]"
                                                                            value="{{$permission}}"
                                                                            {{in_array($permission,$rolePermissions)?'checked':''}} type="checkbox"
                                                                            id="checkboxSuccess_{{$permission}}_{{$role->name}}">
                                                                        <label
                                                                            for="checkboxSuccess_{{$permission}}_{{$role->name}}"
                                                                            class="text-muted d-inline ml-2">
                                                                            {{strtoupper(str_replace('_',' ',$permission))}}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    </div>
                                                    </div>
                                                    @endif
                                                    @endif
                                                    @endforeach

                                                    <div class="text-right mt-2">
                                                    <button type="submit"
                                                    class="btn btn-md btn-primary" style="margin-right: 20px;">{{trans('layout.submit')}}</button>
                                                    </div>
                                                    </form><div class="text-right p-4">
                                                    <button type="button"
                                                    class="btn btn-md btn-primary float-left" data-toggle="modal"
                                                    data-target="#modal-default_new">{{trans('Add New Role')}}
                                                    </button>
                                                    </div>
                                                    @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    @endcan
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="modal fade" id="modal-default_new">
                                                    <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <form action="{{route('user.permission.store')}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">{{trans('Permission')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                    <div class="col-sm-12">


                                                    <div class="form-group">
                                                    <label for="">{{trans('Role Name')}}</label>
                                                    <input type="text" name="role_name"
                                                    class="form-control">
                                                    </div>
                                                    </div>
                                                    @foreach($permissions->whereIn('name',get_user_permission()) as $permission)
                                                    <div class="col-sm-4" style="text-wrap: inherit">
                                                    <div class="form-group clearfix display">
                                                    <div class="icheck-success">
                                                    <input type="checkbox"
                                                    id="checkboxSuccess_{{$permission->name}}"
                                                    value="{{$permission->name}}"
                                                    name="permission[]">
                                                    <label class="text-muted d-inline"
                                                    for="checkboxSuccess_{{$permission->name}}">
                                                    {{strtoupper(str_replace('_',' ',$permission->name))}}
                                                    </label>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    @endforeach

                                                    </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">
                                                    Close
                                                    </button>
                                                    <button type="submit"
                                                    class="btn btn-primary">{{trans('layout.submit')}}</button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                    </div>
                                                    @endsection

@section('js')

<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<script !src="">
$(document).on('click', '.fa-trash', function (e) {
e.preventDefault();

const role = $(this).attr('data-role');
$.ajax({
method: "get",
url: "{{route('user.role.delete')}}",
data: {
role: role,
},

success: function (res) {
let html = '';
if (res.status == 'success') {
$('#show_role_' + role).remove();
} else {
toastr.error(res.message, 'failed', {timeOut: 5000});
}
}
})
});

$(document).ready(function () {
$("#timezone").selectpicker({
liveSearch: true
});
});
</script>
@endsection