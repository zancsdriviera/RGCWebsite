@extends('admin.layout')
@section('title', 'Tournament Rates Editor')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Tournament Rates</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- show validation errors if any --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            @foreach ($tournamentRates as $rate)
                <div class="col-md-6">
                    <form action="{{ route('admin.tournament_rates.update', $rate->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Hidden season input to satisfy validation --}}
                        <input type="hidden" name="season" value="{{ $rate->season }}">

                        <div class="card shadow-sm p-4">
                            <h4 style="font-weight: bolder;">{{ strtoupper($rate->season) }} SEASON</h4>

                            {{-- Green Fee --}}
                            <div class="mb-3">
                                <label class="form-label">GREEN FEE (multiple line entry)</label>
                                <textarea name="green_fee" class="form-control" rows="4"
                                    placeholder="e.g. PHP 3,500.00 – 20 pax&#10;PHP 3,350.00 – 40 pax">{{ old('green_fee', $rate->green_fee) }}</textarea>
                                <small class="text-muted">Use format: <code>PHP 3,500.00 20 pax</code> (do not forget the
                                    SPACE
                                    ).</small>
                            </div>

                            {{-- Two-column numeric fields --}}
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">SCORING FEE</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="scoring_fee" step="0.01" class="form-control"
                                            value="{{ old('scoring_fee', $rate->scoring_fee) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">CADDIE FEE / MARKERS FEE</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="caddie_fee" step="0.01" class="form-control"
                                            value="{{ old('caddie_fee', $rate->caddie_fee) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">GOLF CART RENTAL (18-HOLES)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="golf_cart_fee" step="0.01" class="form-control"
                                            value="{{ old('golf_cart_fee', $rate->golf_cart_fee) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">HOLE-IN-ONE FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="hole_in_one_fund" step="0.01" class="form-control"
                                            value="{{ old('hole_in_one_fund', $rate->hole_in_one_fund) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">SPORTS DEVELOPMENT FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="sports_dev_fund" step="0.01" class="form-control"
                                            value="{{ old('sports_dev_fund', $rate->sports_dev_fund) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">ENVIRONMENTAL FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="environmental_fund" step="0.01" class="form-control"
                                            value="{{ old('environmental_fund', $rate->environmental_fund) }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Food & Beverage --}}
                            <div class="mt-3">
                                <label class="form-label">FOOD & BEVERAGE (can be blank)</label>
                                <textarea name="food_beverage" class="form-control" rows="3"
                                    placeholder="e.g. PHP 400.00 – 550.00&#10;PHP 700.00 – 1,000.00">{{ old('food_beverage', $rate->food_beverage) }}</textarea>
                                <small class="text-muted">Use format: <code>PHP 400.00 –
                                        550.00</code> or leave a note or N/A.</small>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 w-100">Save Changes</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .form-label {
            font-weight: 600;
            font-size: 1.2rem;
        }
    </style>
@endsection
