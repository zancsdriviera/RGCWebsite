@extends('layouts.app')

@section('title', 'Tournament Rates')

@push('styles')
    <link href="{{ asset('css/tournament_rates.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">RATES</h1>
    </div>

    <div class="top_caption text-center my-0">
        <h2 class="top-title">TOURNAMENT RATES</h2>
    </div>

    <div class="pricing-container">
        @foreach ($tournamentRates as $rate)
            <div class="pricing-box">
                <div class="pricing-header">
                    @php $season = strtolower(trim($rate->season)); @endphp
                    @if ($season === 'peak')
                        <h2>PEAK SEASON</h2>
                        <p>(NOV–MAR)</p>
                    @elseif ($season === 'non-peak')
                        <h2>NON-PEAK SEASON</h2>
                        <p>(APR–OCT)</p>
                    @endif
                </div>

                <ul class="pricing-list">
                    {{-- GREEN FEE --}}
                    <li>
                        <span class="label">GREEN FEE <span class="desc">(min. gtd guest)</span></span>
                        <span class="price">
                            {!! nl2br(preg_replace('/(PHP\s*[\d,]+\.\d+)/', '$1 –', str_replace('\\n', "\n", $rate->green_fee ?? ''))) !!}
                        </span>
                    </li>

                    {{-- SCORING FEE --}}
                    <li>
                        <span class="label">SCORING FEE <span class="desc">(Optional)</span></span>
                        <span class="price">
                            {{ is_numeric(trim($rate->scoring_fee))
                                ? 'PHP ' . number_format($rate->scoring_fee, 2)
                                : $rate->scoring_fee ?? '—' }}
                        </span>
                    </li>

                    {{-- CADDIE FEE --}}
                    <li>
                        <span class="label">CADDIE FEE / MARKERS FEE
                            <span class="desc">(Must be paid in CASH on functional day)</span>
                        </span>
                        <span class="price">
                            {{ is_numeric(trim($rate->caddie_fee))
                                ? 'PHP ' . number_format($rate->caddie_fee, 2)
                                : $rate->caddie_fee ?? '—' }}
                        </span>
                    </li>

                    {{-- GOLF CART --}}
                    <li>
                        <span class="label">GOLF CART RENTAL<br>(18-HOLES)
                            <span class="desc">
                                Note: 2 carts per flight for shotgun<br>
                                tournament charged to organizer
                            </span>
                        </span>
                        <span class="price">
                            {{ is_numeric(trim($rate->golf_cart_fee))
                                ? 'PHP ' . number_format($rate->golf_cart_fee, 2)
                                : $rate->golf_cart_fee ?? '—' }}
                        </span>
                    </li>

                    {{-- HOLE-IN-ONE FUND --}}
                    <li>
                        <span class="label">HOLE-IN-ONE FUND</span>
                        <span class="price">
                            {{ is_numeric(trim($rate->hole_in_one_fund))
                                ? 'PHP ' . number_format($rate->hole_in_one_fund, 2)
                                : $rate->hole_in_one_fund ?? '—' }}
                        </span>
                    </li>

                    {{-- SPORTS DEV FUND --}}
                    <li>
                        <span class="label">SPORTS DEVELOPMENT FUND</span>
                        <span class="price">
                            {{ is_numeric(trim($rate->sports_dev_fund))
                                ? 'PHP ' . number_format($rate->sports_dev_fund, 2)
                                : $rate->sports_dev_fund ?? '—' }}
                        </span>
                    </li>

                    {{-- ENVIRONMENTAL FUND --}}
                    <li>
                        <span class="label">ENVIRONMENTAL FUND</span>
                        <span class="price">
                            {{ is_numeric(trim($rate->environmental_fund))
                                ? 'PHP ' . number_format($rate->environmental_fund, 2)
                                : $rate->environmental_fund ?? '—' }}
                        </span>
                    </li>


                    {{-- FOOD & BEVERAGE --}}
                    <li>
                        <span class="label">FOOD & BEVERAGE
                            <span class="desc">
                                Set Lunch<br>
                                Buffet Menu (min. 50 pax)<br>
                                F&B Consumables per player if<br>
                                NO F&B Arrangement
                            </span>
                        </span>
                        <span class="price">
                            {!! nl2br(preg_replace('/(PHP\s*[\d,]+\.\d+)/', '$1 –', str_replace('\\n', "\n", $rate->food_beverage ?? ''))) !!}
                        </span>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
@endsection
