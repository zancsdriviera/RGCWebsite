<!-- Footer snippet -->
<footer class="rgc-footer">
    <div class="rgc-wrap">
        <h1 class="rgc-title">Riviera Golf Club</h1>
        <div class="rgc-grid">
            <!-- 1) Logo -->
            <div class="rgc-col logo-col">
                <img src="{{ asset('images/RivieraFooterLogo.png') }}" alt="Riviera logo" class="rgc-logo">
            </div>
            <!-- 2) Contact -->
            <div class="rgc-col">
                <div>
                    <p>
                        <a href="tel:+63464091077" class="phone-link">
                            <i class="bi bi-telephone"></i> (046) 409-1077
                        </a>
                    </p>

                    <p>
                        <a href="https://maps.app.goo.gl/bW6hpfDtEtu2GDPZ8" target="_blank" class="location-link">
                            <i class="bi bi-geo-alt"></i> RIVIERA GOLF CLUB<br>
                            By pass Road Aguinaldo Highway<br>
                            Silang, Cavite, Philippines, 4118
                        </a>
                    </p>

                </div>
            </div>
            <!-- 3) Social -->
            <div class="rgc-col">
                <p>
                    <i class="bi bi-facebook"></i>
                    <a href="https://facebook.com/rivieragolfph" target="_blank"
                        class="text-white text-decoration-none">
                        facebook.com/rivieragolfph
                    </a>
                </p>
                <p>
                    <i class="bi bi-instagram"></i>
                    <a href="https://instagram.com/rivieragolfph" target="_blank"
                        class="text-white text-decoration-none">
                        instagram.com/rivieragolfph
                    </a>
                </p>
                <p>
                    <i class="bi bi-youtube"></i>
                    <a href="https://www.youtube.com/@RivieraGolfClubInc." target="_blank"
                        class="text-white text-decoration-none">
                        youtube.com/rivieragolfph
                    </a>
                </p>
            </div>
            <!-- 4) Corporate Governance -->
            <div class="rgc-col">
                <p class="col-line governance">
                    <i class="bi bi-bank"></i>
                    <a href="{{ url('/corpgovernance') }}"
                        class="nowrap {{ request()->is('corpgovernance') || request()->is('definitive') || request()->is('asmMinutes') || request()->is('ACGR') || request()->is('cbce') || request()->is('boardCharter') || request()->is('corpGovManual') ? 'active' : '' }}">
                        Corporate Governance
                    </a>
                </p>
            </div>

        </div>
        <hr class="rgc-divider">
        <div class="rgc-copy">
            <br>
            <span class="copy-badge">©</span>
            <span>Copyright Riviera Golf Club</span>
        </div>
    </div>
</footer>
