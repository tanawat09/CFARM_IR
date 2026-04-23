@php
    $currentPage = request()->routeIs('home') ? 'home' : 'other';
    $popups = \App\Models\Popup::getActive($currentPage);
    $locale = session('locale', config('app.locale'));
@endphp

@if($popups->count() > 0)
<style>
/* ── Popup Overlay ── */
.cfarm-popup-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(4px);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.4s cubic-bezier(.4,0,.2,1);
    padding: 20px;
}
.cfarm-popup-overlay.show {
    opacity: 1;
    visibility: visible;
}

/* ── Popup Card ── */
.cfarm-popup {
    background: #fff;
    border-radius: 20px;
    max-width: 520px;
    width: 100%;
    box-shadow: 0 25px 80px rgba(0,0,0,0.25);
    transform: scale(0.85) translateY(30px);
    transition: all 0.45s cubic-bezier(.34,1.56,.64,1);
    overflow: hidden;
    position: relative;
}
.cfarm-popup-overlay.show .cfarm-popup {
    transform: scale(1) translateY(0);
}

/* Close button */
.cfarm-popup-close {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(0,0,0,0.5);
    border: none;
    color: #fff;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.25s;
    backdrop-filter: blur(5px);
}
.cfarm-popup-close:hover {
    background: rgba(0,0,0,0.75);
    transform: rotate(90deg);
}

/* Image */
.cfarm-popup-image {
    width: 100%;
    overflow: hidden;
    line-height: 0;
}
.cfarm-popup-image img {
    width: 100%;
    height: auto;
    display: block;
}

/* Body */
.cfarm-popup-body {
    padding: 28px 30px;
}
.cfarm-popup-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a1a2e;
    margin-bottom: 10px;
    line-height: 1.4;
}
.cfarm-popup-content {
    font-size: 0.92rem;
    color: #555;
    line-height: 1.7;
    margin-bottom: 18px;
}
.cfarm-popup-content:empty { display: none; }

/* Action button */
.cfarm-popup-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 28px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--cfarm-green, #2e7d32), var(--cfarm-green-dark, #1b5e20));
    color: #fff;
    font-weight: 500;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(46,125,50,0.3);
}
.cfarm-popup-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(46,125,50,0.4);
    color: #fff;
}

/* Footer (don't show again) */
.cfarm-popup-footer {
    padding: 0 30px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.cfarm-popup-dismiss {
    font-size: 0.8rem;
    color: #999;
    cursor: pointer;
    transition: color 0.2s;
    background: none;
    border: none;
    padding: 0;
}
.cfarm-popup-dismiss:hover {
    color: #555;
}

/* Carousel dots */
.cfarm-popup-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
    padding: 0 0 20px;
}
.cfarm-popup-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #ddd;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    padding: 0;
}
.cfarm-popup-dot.active {
    background: var(--cfarm-green, #2e7d32);
    width: 24px;
    border-radius: 4px;
}

/* No-image layout */
.cfarm-popup.no-image .cfarm-popup-body {
    padding-top: 50px;
    text-align: center;
}
.cfarm-popup.no-image .cfarm-popup-title {
    font-size: 1.35rem;
}
.cfarm-popup.no-image .cfarm-popup-close {
    background: rgba(0,0,0,0.08);
    color: #666;
}
.cfarm-popup.no-image .cfarm-popup-close:hover {
    background: rgba(0,0,0,0.15);
}

@media (max-width: 576px) {
    .cfarm-popup { max-width: 95%; border-radius: 16px; }
    .cfarm-popup-body { padding: 20px; }
}
</style>

{{-- Popup Overlay --}}
<div class="cfarm-popup-overlay" id="cfarmPopupOverlay">
    @foreach($popups as $i => $popup)
    @php
        $title = $locale == 'en' && !empty($popup->title_en) ? $popup->title_en : $popup->title_th;
        $content = $locale == 'en' && !empty($popup->content_en) ? $popup->content_en : $popup->content_th;
        $linkText = $locale == 'en' && !empty($popup->link_text_en) ? $popup->link_text_en : ($popup->link_text_th ?? 'ดูรายละเอียด');
    @endphp
    <div class="cfarm-popup {{ !$popup->image_path ? 'no-image' : '' }}" 
         data-popup-id="{{ $popup->id }}" 
         style="{{ $i > 0 ? 'display:none;' : '' }}">
        
        <button class="cfarm-popup-close" onclick="cfarmClosePopup()" aria-label="ปิด">
            <i class="bi bi-x-lg"></i>
        </button>

        @if($popup->image_path)
            <div class="cfarm-popup-image">
                @if($popup->link_url)
                    <a href="{{ $popup->link_url }}" target="_blank">
                        <img src="{{ asset('storage/' . $popup->image_path) }}" alt="{{ $title }}">
                    </a>
                @else
                    <img src="{{ asset('storage/' . $popup->image_path) }}" alt="{{ $title }}">
                @endif
            </div>
        @endif

        <div class="cfarm-popup-body">
            <div class="cfarm-popup-title">{{ $title }}</div>
            @if($content)
                <div class="cfarm-popup-content">{!! nl2br(e($content)) !!}</div>
            @endif
            @if($popup->link_url)
                <a href="{{ $popup->link_url }}" target="_blank" class="cfarm-popup-action">
                    {{ $linkText }} <i class="bi bi-arrow-right"></i>
                </a>
            @endif
        </div>

        @if($popups->count() > 1)
            <div class="cfarm-popup-dots">
                @foreach($popups as $j => $p)
                    <button class="cfarm-popup-dot {{ $j == $i ? 'active' : '' }}" onclick="cfarmShowPopup({{ $j }})"></button>
                @endforeach
            </div>
        @endif

        <div class="cfarm-popup-footer">
            <button class="cfarm-popup-dismiss" onclick="cfarmDismissPopup()">
                <i class="bi bi-x-circle me-1"></i> ไม่ต้องแสดงอีก
            </button>
            <span></span>
        </div>
    </div>
    @endforeach
</div>

<script>
(function(){
    const COOKIE_NAME = 'cfarm_popup_dismissed';
    const COOKIE_DAYS = 1; // Don't show again for 1 day

    // Check if dismissed
    function isDismissed() {
        return document.cookie.split('; ').some(c => c.startsWith(COOKIE_NAME + '='));
    }

    // Set dismiss cookie
    function setDismissed(days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = COOKIE_NAME + '=1; expires=' + d.toUTCString() + '; path=/; SameSite=Lax';
    }

    // Show popup after a short delay
    if (!isDismissed()) {
        setTimeout(function(){
            document.getElementById('cfarmPopupOverlay').classList.add('show');
        }, 800);
    }

    // Close popup (no cookie — will show again on next page load)
    window.cfarmClosePopup = function() {
        document.getElementById('cfarmPopupOverlay').classList.remove('show');
    };

    // Dismiss until browser closes (session cookie only)
    window.cfarmDismissPopup = function() {
        document.cookie = COOKIE_NAME + '=1; path=/; SameSite=Lax';
        document.getElementById('cfarmPopupOverlay').classList.remove('show');
    };

    // Multi-popup carousel
    window.cfarmShowPopup = function(index) {
        const popups = document.querySelectorAll('.cfarm-popup');
        popups.forEach((p, i) => {
            p.style.display = i === index ? '' : 'none';
            // Update dots
            p.querySelectorAll('.cfarm-popup-dot').forEach((dot, j) => {
                dot.classList.toggle('active', j === index);
            });
        });
    };

    // Close on overlay click (not popup)
    document.getElementById('cfarmPopupOverlay').addEventListener('click', function(e) {
        if (e.target === this) cfarmClosePopup();
    });

    // Close with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cfarmClosePopup();
    });
})();
</script>
@endif
