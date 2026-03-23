@php
    $footer = App\Models\FooterSetting::getActive();
@endphp

<footer class="rgc-footer">
    <div class="rgc-wrap">
        <h1 class="rgc-title">{{ $footer->club_name ?? 'Riviera Golf Club' }}</h1>

        <div class="rgc-grid">
            <!-- Logo -->
            <div class="rgc-col logo-col" role="img" aria-label="Riviera logo">
                @if ($footer && $footer->logo_path)
                    <img src="{{ asset('storage/' . $footer->logo_path) }}" alt="{{ $footer->club_name }} logo"
                        class="rgc-logo">
                @else
                    <img src="{{ asset('images/RivieraFooterLogo.png') }}" alt="Riviera logo" class="rgc-logo">
                @endif
            </div>

            <!-- Contact -->
            <div class="rgc-col contact-col">
                @if ($footer && $footer->phone_number)
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $footer->phone_number) }}" class="phone-link"
                        aria-label="Call {{ $footer->phone_number }}">
                        <i class="bi bi-telephone"></i>
                        <span class="link-text">{{ $footer->phone_number }}</span>
                    </a>
                @endif

                @if ($footer && $footer->location_url)
                    <a href="{{ $footer->location_url }}" target="_blank" class="location-link"
                        aria-label="Riviera Golf Club location">
                        <i class="bi bi-geo-alt"></i>
                        <span
                            class="addr-text">{{ $footer->address ?? 'By pass Road, Aguinaldo Highway, Silang, Cavite 4118' }}</span>
                    </a>
                @endif
            </div>

            <!-- Social -->
            <div class="rgc-col social-col">
                @if ($footer && $footer->facebook_url)
                    <a href="{{ $footer->facebook_url }}" target="_blank" class="social-link" aria-label="Facebook">
                        <i class="bi bi-facebook"></i><span
                            class="link-text">{{ str_replace('https://', '', $footer->facebook_url) }}</span>
                    </a>
                @endif

                @if ($footer && $footer->instagram_url)
                    <a href="{{ $footer->instagram_url }}" target="_blank" class="social-link" aria-label="Instagram">
                        <i class="bi bi-instagram"></i><span
                            class="link-text">{{ str_replace('https://', '', $footer->instagram_url) }}</span>
                    </a>
                @endif

                @if ($footer && $footer->youtube_url)
                    <a href="{{ $footer->youtube_url }}" target="_blank" class="social-link" aria-label="YouTube">
                        <i class="bi bi-youtube"></i><span
                            class="link-text">{{ str_replace('https://', '', $footer->youtube_url) }}</span>
                    </a>
                @endif
            </div>

            <!-- Corporate Governance -->
            <div class="rgc-col gov-col d-flex justify-content-center">
                <a href="{{ url('/corpgovernance') }}"
                    class="gov-link nowrap {{ request()->is('corpgovernance') || request()->is('definitive') || request()->is('asm_minutes') || request()->is('ACGR') || request()->is('cbce') || request()->is('boardCharter') || request()->is('corpGovManual') ? 'active' : '' }}">
                    <i class="bi bi-bank"></i><span class="link-text">Corporate Governance</span>
                </a>
            </div>
        </div>

        <hr class="rgc-divider">
        <div class="rgc-copy">
            <span class="copy-badge">©</span>
            <span class="copy-text">{{ $footer->copyright_text ?? 'Riviera Golf Club' }}</span>
        </div>
    </div>
</footer>
