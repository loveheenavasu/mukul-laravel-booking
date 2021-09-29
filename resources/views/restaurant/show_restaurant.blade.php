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
        <?php
            $coverImage=explode(',',$restaurant->cover_image);
            $slidecount=count($coverImage);
            $count = 0;
        ?>
        <div class="row qricle-demo">
            <div class="col-lg-12">

                <div class="profile card card-body px-0 pt-0 pb-0 mb-0">
                        <div class="profile-head">
                            <div class="photo-content sanjeev-slider">
                                <h3>Hi, {{ Auth()->user()->name ?? $_COOKIE['user_name'] }}</h3>
                                <p>Welcome to Velmore, We hope you enjoy your stay</p>
                                    <!-- https://codepen.io/vilcu/pen/ZQwdGQ -->
                                <div class="wrapper">
                                    <div class="carousel">
                                        <?php
                                           $count = 0;
                                         ?>

                                        @foreach($hotel_slider as $slider)

                                      <div>
                                        <div class="card">
                                          <div class="card-header">
                                            <img class="cover-img slick-imgs" src="{{asset('uploads/'.$slider->slider_image)}}" alt="">
                                            <div class="all-text">
                                                <p class="custom_text">{{$slider->slider_title}}</p>
                                                <p class="custom_link"><a href="{{$slider->slider_button_link}}">{{$slider->slider_button_text}}</a></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                         {{$count++}}
                                        @endforeach
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="restaurant_content-sec card">
            <div class="row quik-links">
                <div class="card-body cat-title w-100">
                    <h3 class="text-title"><span>Quick links</span></h3>
                </div>
            </div>

            <div class="quick-card-content new-quick">
                @foreach($rcategories as $quicklinks)
                <div class="col-3 p-2 quick-card">
                    <a target="_self" id="item_cart" class="ai-icon item-category" href="{{route('showroom_service.restaurant',['slug'=>$restaurant->slug]).'?link='.$quicklinks['id']}}">
                    <img class="link-cover-img" src="{{asset('uploads/'.$quicklinks['image'])}}" alt="">
                    <p>{{$quicklinks['name']}}</p>
                    </a>
                </div>
                @endforeach
            </div>



            <div class="row food-service-sec">
                <div class="card-body cat-title w-100">
                    <h3 class="text-title"><span>How can we be of service?</span></h3>
                </div>
                <div class="col-6 service-box-1">
                    <div class="service-img">
                    <a target="_self" class="ai-icon item-category" href="{{route('showroom_service.restaurant',['slug'=>$restaurant->slug])}}">
                    <img class="cover-img" src="{{asset('uploads/'.$restaurant->roomservice_image)}}" alt="">
                    <p>{{trans('layout.room_service')}}</p></a>
                    </div>
                </div>
                <div class="col-6 service-box">
                    <div class="service-img">
                    <a target="_self" data-id="" class="ai-icon item-category" href="{{route('showfood_service.restaurant',['slug'=>$restaurant->slug,'id'=>$restaurant->id])}}">
                    <img class="cover-img" src="{{asset('uploads/'.$restaurant->foodservice_image)}}" alt="">
                    <p>{{trans('layout.order_food')}}</p></a>
                    </div>
                </div>
                <div class="col-6 service-box-1">
                <div class="service-img">
                    <a data-id="" class="ai-icon item-category" href="{{route('abouthotel.index',['slug'=>$restaurant->slug])}}" aria-expanded="false">
                    <img class="cover-img" src="{{asset('uploads/33.png')}}" alt="">
                    <p>{{trans('layout.about_hotel')}}</p> </a>
                    </div>
                </div>
                <div class="col-6 service-box">
                    <div class="service-img">
                    <a data-id="" class="ai-icon item-category" href="{{route('tourguide.index',['slug'=>$restaurant->slug])}}" aria-expanded="false">
                    <img class="cover-img" src="{{asset('uploads/44.png')}}" alt="">
                    <p>{{trans('layout.tour_guide')}}</p> </a>
                    </div>
                </div>
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
        $(document).ready(function() {
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
                responsive: [{
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
            if (!whatsappnum.value) return true;
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
        const currencySymbol = '{{isset(json_decode(get_settings('
        local_setting '))->currency_symbol)?json_decode(get_settings('
        local_setting '))->currency_symbol:'
        $ '}}';

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
        Number.prototype.formatNumber = function() {
            const decimal_format = '{{isset(json_decode(get_settings('
            local_setting '))->decimal_format)?json_decode(get_settings('
            local_setting '))->decimal_format:'.
            '}}';
            const decimals = '{{isset(json_decode(get_settings('
            local_setting '))->decimals)?json_decode(get_settings('
            local_setting '))->decimals:'
            2 '}}';
            const thousand_separator = '{{isset(json_decode(get_settings('
            local_setting '))->thousand_separator)?json_decode(get_settings('
            local_setting '))->thousand_separator:', '}}';
            return this.valueOf().number_format(decimals, decimal_format, thousand_separator);
        };
        Number.prototype.formatNumberWithCurrSymbol = function() {
            const symbol_position = '{{isset(json_decode(get_settings('
            local_setting '))->currency_symbol_position)?json_decode(get_settings('
            local_setting '))->currency_symbol_position:'
            after '}}';

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
            let total_vat_price = (vat * (total / 100));
            price_with_vat = total + (vat * (total / 100));
            $('#totalTax').text(total_vat_price.formatNumberWithCurrSymbol());
            $('#totalPriceBeforeTax').text(total.formatNumberWithCurrSymbol());
            $('#totalAmount').text(total.formatNumberWithCurrSymbol());
            $('#totalAmountToPayment').text(price_with_vat.formatNumberWithCurrSymbol());
        }
        $(document)
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
        $(document).on('click', '#my_order', function(e) {
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
        $(document).on('click', '#item_cart', function(e) {
            alert();
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
            if (search.length == 0) {
                $('.catg-list-items').show();
                $('.category-search-result').hide();
                $('.no_item_result').hide();
            } else {
                $('.spinner-border').show();
                currentRequest = $.ajax({
                    type: "GET",
                    url: '/restaurants/search',
                    beforeSend: function() {
                        if (currentRequest != null) {
                            currentRequest.abort();
                        }
                    },
                    data: {
                        search: search,
                        restaurant_id: restaurant_id
                    },
                    success: function(data) {
                        $('.spinner-border').hide();
                        $('.catg-list-items').hide();
                        $('#search_list').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        $('.spinner-border').hide();
                    }
                });
            }
        });

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


  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

      <script type="text/javascript">
        $(document).ready(function(){
    $('.carousel').slick({
      speed: 2000,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      dots:false,
      centerMode: true,
      responsive: [{
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          // centerMode: true,

        }

      }, {
        breakpoint: 800,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          infinite: true,

        }
      },  {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          infinite: true,
          autoplay: true,
          autoplaySpeed: 2000,
        }
      }]
    });
  });
      </script>

