@extends('admin.layout')
@section('title', 'Tournament Rates Editor')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Tournament Rates</h3>
        <style>
            .form-label {
                font-weight: 600;
                font-size: 1.2rem;
            }
        </style>

        {{-- CONTACT SECTION - Separate Container at the Top --}}
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-telephone me-2"></i>Contact Information</h4>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Contact details are shared across all seasons. Changes here will apply to both
                    Peak and Non-Peak seasons.</p>

                @php
                    // Get contact info from first record
                    $contact = $tournamentRates->first();
                @endphp

                <form action="{{ route('admin.tournament_rates.update_contact') }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <label class="form-label">Contact Phone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" name="contact_phone" class="form-control"
                                value="{{ old('contact_phone', $contact->contact_phone ?? '') }}"
                                placeholder="e.g. +63 123 456 7890">
                        </div>
                        <small class="text-muted">Enter phone number for tournament inquiries</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Contact Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="contact_email" class="form-control"
                                value="{{ old('contact_email', $contact->contact_email ?? '') }}"
                                placeholder="e.g. tournaments@example.com">
                        </div>
                        <small class="text-muted">Enter email address for tournament inquiries</small>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Update Contact Information
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- RATES SECTION - Original Forms Below --}}
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
                                <textarea name="green_fee" class="form-control" required rows="4"
                                    placeholder="e.g. PHP 3,500.00 – 20 pax&#10;PHP 3,350.00 – 40 pax">{{ old('green_fee', $rate->green_fee) }}</textarea>
                                <small class="text-muted">Use format: <code>PHP 3,500.00 20 pax</code> (do not forget the
                                    SPACE).</small>
                            </div>

                            {{-- Two-column numeric fields --}}
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">SCORING FEE</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="scoring_fee" step="0.01" class="form-control"
                                            value="{{ old('scoring_fee', $rate->scoring_fee) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">CADDIE FEE / MARKERS FEE</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="caddie_fee" step="0.01" class="form-control"
                                            value="{{ old('caddie_fee', $rate->caddie_fee) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">GOLF CART RENTAL (18-HOLES)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="golf_cart_fee" step="0.01" class="form-control"
                                            value="{{ old('golf_cart_fee', $rate->golf_cart_fee) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">HOLE-IN-ONE FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="hole_in_one_fund" step="0.01" class="form-control"
                                            value="{{ old('hole_in_one_fund', $rate->hole_in_one_fund) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">SPORTS DEVELOPMENT FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="sports_dev_fund" step="0.01" class="form-control"
                                            value="{{ old('sports_dev_fund', $rate->sports_dev_fund) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">ENVIRONMENTAL FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="environmental_fund" step="0.01"
                                            class="form-control"
                                            value="{{ old('environmental_fund', $rate->environmental_fund) }}" required>
                                    </div>
                                </div>
                            </div>

                            {{-- Food & Beverage --}}
                            <div class="mt-3">
                                <label class="form-label">FOOD & BEVERAGE</label>
                                <textarea name="food_beverage" class="form-control" rows="3"
                                    placeholder="e.g. PHP 400.00 – 550.00&#10;PHP 700.00 – 1,000.00">{{ old('food_beverage', $rate->food_beverage) }}</textarea>
                                <small class="text-muted">Use format: <code>PHP 400.00 – 550.00</code> or leave a note or
                                    N/A.</small>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-3"><i
                                        class="bi bi-check-square me-2"></i>Save Season Changes</button>
                            </div>

                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header btn-success text-white">
                    <h5 class="modal-title">Success</h5>
                </div>
                <div class="modal-body text-black">
                    {{ session('modal_message') }}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "{{ session('success') }}";
                modalBody.style.color = 'green';

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 3s
                setTimeout(() => modal.hide(), 3000);
            @endif
        });
    </script>
@endsection
