<!-- Footer snippet -->
<footer class="rgc-footer">
    <div class="rgc-wrap">
        <h1 class="rgc-title">Riviera Golf Club</h1>

        <div class="rgc-grid">
            <!-- Logo (centered, spans both columns on small screens) -->
            <div class="rgc-col logo-col" role="img" aria-label="Riviera logo">
                <img src="{{ asset('images/RivieraFooterLogo.png') }}" alt="Riviera logo" class="rgc-logo">
            </div>

            <!-- Contact (left column on mobile) -->
            <div class="rgc-col contact-col">
                <a href="tel:+63464091077" class="phone-link" aria-label="Call (046) 409-1077">
                    <i class="bi bi-telephone"></i>
                    <span class="link-text">(046) 409-1077</span>
                </a>

                <a href="https://maps.app.goo.gl/bW6hpfDtEtu2GDPZ8" target="_blank" class="location-link"
                    aria-label="Riviera Golf Club location">
                    <i class="bi bi-geo-alt"></i>
                    <span class="addr-text">By pass Road, Aguinaldo Highway, Silang, Cavite 4118</span>
                </a>
            </div>

            <!-- Social (right column on mobile) -->
            <div class="rgc-col social-col">
                <a href="https://facebook.com/rivieragolfph" target="_blank" class="social-link" aria-label="Facebook">
                    <i class="bi bi-facebook"></i><span class="link-text">facebook.com/rivieragolfph</span>
                </a>
                <a href="https://instagram.com/rivieragolfph" target="_blank" class="social-link"
                    aria-label="Instagram">
                    <i class="bi bi-instagram"></i><span class="link-text">instagram.com/rivieragolfph</span>
                </a>
                <a href="https://www.youtube.com/@RivieraGolfClubInc." target="_blank" class="social-link"
                    aria-label="YouTube">
                    <i class="bi bi-youtube"></i><span class="link-text">youtube.com/rivieragolfph</span>
                </a>
            </div>

            <!-- Corporate Governance (full-width row below on mobile) -->
            <div class="rgc-col gov-col d-flex justify-content-center">
                <a href="{{ url('/corpgovernance') }}"
                    class="gov-link nowrap {{ request()->is('corpgovernance') || request()->is('definitive') || request()->is('asm_minutes') || request()->is('ACGR') || request()->is('cbce') || request()->is('boardCharter') || request()->is('corpGovManual') ? 'active' : '' }}">
                    <i class="bi bi-bank"></i><span class="link-text">Corporate Governance</span>
                </a>
            </div>
        </div>

        <hr class="rgc-divider">
        <div class="rgc-copy">
            <span class="copy-badge">©</span><span class="copy-text">Riviera Golf Club</span>
        </div>
    </div>
</footer>
