@extends('layouts.main')

@section("content")
<div class="slider_area">
    <div class="single_slider single_slider2  d-flex align-items-center property_bg overlay2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="property_wrap">
                            <div class="slider_text text-center justify-content-center">
                                    <h3>Поиск</h3>
                                </div>
                                <div class="property_form">
                                    <form name="frmmain" action="" method="POST">
                                        @csrf
                                        {{-- {{dd($selectedSort)}} --}}
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form_wrap d-flex">
                                                <div class="single-field max_width ">
                                                    <label for="#">Тип объявления</label>
                                                    <select class="wide" name="type">
                                                            <option data-display="Все" value="">Все</option>
                                                        @foreach ($types as $type)
                                                            <option value="{{ $type->name }}" {{ $selectedType == $type->name ? "selected" : "" }}>{{ $type->ru() }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="single_field range_slider">
                                                    <label for="#">Цена</label>
                                                    <div id="slider"></div>
                                                    <input hidden name="min_payment" value="{{ $selectedMin ?? 0 }}">
                                                    <input hidden name="max_payment" value="{{ $selectedMax ?? $maxPayment }}">
                                                </div>
                                                <div class="single-field max_width ">
                                                    <label for="#">Тип помещения</label>
                                                    <select class="wide" name="placement_type" >
                                                        <option data-display="Все" value="">Все</option>
                                                        @foreach ($placementTypes as $placementType)
                                                            <option value="{{ $placementType->name }}" {{ $selectedPlacementType == $placementType->name ? "selected" : "" }}>{{ $placementType->ru() }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>                                                            
                                                <div class="single-field max_width ">
                                                    <label for="#">Сортировка</label>
                                                    <select class="wide" name="sort">
                                                        <option data-display="Стандарт" value="">Стандарт</option>
                                                        @foreach ($sortVariants as $sortVariant)
                                                            @foreach ($sortTypes as $sortType)
                                                                @php $strg = ($sortVariant == 'payment' ? 'Цена' : 'Дата') . ($sortType->name == 'Asc' ? ' по возр.' : ' по убыв.'); @endphp
                                                                <option value="{{ $sortVariant . '-' . strtolower($sortType->name) }}" {{ $selectedSort == $sortVariant . '-' . strtolower($sortType->name) ? "selected" : "" }}>{{ $strg }}</option>
                                                            @endforeach
                                                        @endforeach                                                                       
                                                    </select>
                                                </div>
                                                <button style="background-color: #FD8E5E" type="button" onclick="btnsend()">
                                                    <div class="serach_icon">
                                                        <a>
                                                            <i class="ti-search"></i>
                                                        </a>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<div class="popular_property plus_padding">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title mb-40 text-center">
                    <h4>Найдено {{ $adverts->count() }} объявлений</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($adverts as $advert)
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="single_property">
                        <div class="property_thumb">
                            <div class="property_tag">{{ $advert->type == 'Sell' ? 'Продажа' : 'Аренда'}}</div>
                        </div>
                        <div class="property_content">
                            <div class="main_pro">
                                    <h3><a href="#">Comfortable Apartment in Palace</a></h3>
                                    <div class="mark_pro">
                                        <img src="img/svg_icon/location.svg" alt="">
                                        <span>Popular Properties</span>
                                    </div>
                                    <span class="amount">{{ $advert->payment }} руб.</span>
                            </div>
                        </div>
                        <div class="footer_pro">
                                <ul>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="img/svg_icon/bed.svg" alt="">
                                            <span>{{ match ($advert->type) {
                                                "Sell" => 'Продажа',
                                                "Rent" => 'Аренда',
                                            } }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="img/svg_icon/square.svg" alt="">
                                            <span>{{ $advert->square }} кв.м.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single_info_doc">
                                            <img src="img/svg_icon/bed.svg" alt="">
                                            <span>{{ match ($advert->placement_type) {
                                                "House" => 'Дом',
                                                "Flat" => 'Квартира',
                                                "Room" => 'Комната'
                                            } }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    window.onload = function () {
        
    }

    function btnsend() {
        // var form = frmmain
        // for (var i = 0; i < form.elements.length; i++) {
        //     var name = form.elements[i].name;
        //     console.log(name + " " + form.elements[i].value);
        // }
        form.submit()
    }

    function collision($div1, $div2) {
        var x1 = $div1.offset().left;
        var w1 = 40;
        var r1 = x1 + w1;
        var x2 = $div2.offset().left;
        var w2 = 40;
        var r2 = x2 + w2;

        if (r1 < x2 || x1 > r2)
            return false;
        return true;
    }
    // Fetch Url value 
    var getQueryString = function (parameter) {
        var href = window.location.href;
        var reg = new RegExp('[?&]' + parameter + '=([^&#]*)', 'i');
        var string = reg.exec(href);
        return string ? string[1] : null;
    };
    // End url 
    // // slider call
    $('#slider').slider({
        range: true,
        min: 0 ,
        max: {{  $maxPayment }},
        step: 1,
        values: [getQueryString('minval') ? getQueryString('minval') : {{  $selectedMin ?? 0  }}, getQueryString('maxval') ?
            getQueryString('maxval') : {{ $selectedMax ?? $maxPayment }}
        ],

        slide: function (event, ui) {

            $('.ui-slider-handle:eq(0) .price-range-min').html( ui.values[0] + 'K');
            $('.ui-slider-handle:eq(1) .price-range-max').html( ui.values[1] + 'K');
            $('.price-range-both').html('<i>K' + ui.values[0] + ' - </i>K' + ui.values[1]);

            // get values of min and max
            $("#minval").val(ui.values[0]);
            $("#maxval").val(ui.values[1]);
            $('[name="min_payment"]').val(ui.values[0]);
            $('[name="max_payment"]').val(ui.values[1]);

            if (ui.values[0] == ui.values[1]) {
                $('.price-range-both i').css('display', 'none');
            } else {
                $('.price-range-both i').css('display', 'inline');
            }

            if (collision($('.price-range-min'), $('.price-range-max')) == true) {
                $('.price-range-min, .price-range-max').css('opacity', '0');
                $('.price-range-both').css('display', 'block');
            } else {
                $('.price-range-min, .price-range-max').css('opacity', '1');
                $('.price-range-both').css('display', 'none');
            }

        }
    });

    $('.ui-slider-range').append('<span class="price-range-both value"><i>' + $('#slider').slider('values', 0) +
        ' - </i>' + $('#slider').slider('values', 1) + '</span>');

    $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">' + $('#slider').slider('values', 0) +
        'k</span>');

    $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">' + $('#slider').slider('values', 1) +
        'k</span>');
</script>    
@endsection