@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('topbar-tabs')
    <a class="topbar-tab active">Dashboard</a>
    <a class="topbar-tab">Channels</a>
@endsection

@section('topbar-right')
    <div style="display:flex;align-items:center;gap:10px;">
        <div class="avatar-stack">
            <div class="av" style="background:linear-gradient(135deg,#a78bfa,#7c3aed)">A</div>
            <div class="av" style="background:linear-gradient(135deg,#f59e0b,#d97706)">B</div>
            <div class="av" style="background:linear-gradient(135deg,#34d399,#059669)">C</div>
        </div>
        <span class="member-count">{{ $stats['members'] }} members</span>
    </div>
@endsection

@section('content')
<div class="dash-grid">

    {{-- ── HERO CARD ── --}}
    <div class="hero-card">
        <div class="hero-label">Visits for today</div>
        <div class="hero-number">
            <span class="count-up" data-target="{{ $stats['visits'] }}">0</span>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="rgba(255,255,255,0.9)">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <div>
                    <div class="hero-stat-label">Popularity</div>
                    <div class="hero-stat-val">93</div>
                </div>
            </div>
            <div class="hero-stat">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="rgba(255,255,255,0.9)">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
                <div>
                    <div class="hero-stat-label">General rate</div>
                    <div class="hero-stat-val">{{ $stats['general_rate'] }}</div>
                </div>
            </div>
        </div>

        <div class="hero-illustration" aria-hidden="true">
            <svg viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="90" cy="168" rx="22" ry="5" fill="rgba(0,0,0,0.1)"/>
                <rect x="74" y="144" width="32" height="26" rx="4" fill="#8B7355" opacity="0.65"/>
                <path d="M90 142 Q73 117 82 98 Q100 118 90 142Z" fill="#5a9e6f" opacity="0.85"/>
                <path d="M90 130 Q112 112 108 93 Q90 110 90 130Z" fill="#4a8e5f" opacity="0.8"/>
                <rect x="46" y="107" width="88" height="8" rx="4" fill="rgba(255,255,255,0.4)"/>
                <rect x="49" y="115" width="6" height="36" rx="3" fill="rgba(255,255,255,0.3)"/>
                <rect x="125" y="115" width="6" height="36" rx="3" fill="rgba(255,255,255,0.3)"/>
                <rect x="56" y="74" width="68" height="35" rx="6" fill="rgba(255,255,255,0.35)"/>
                <ellipse cx="90" cy="59" rx="15" ry="17" fill="rgba(255,220,185,0.92)"/>
                <path d="M75 53 Q76 39 90 41 Q104 39 105 53 Q100 44 90 46 Q80 44 75 53Z" fill="rgba(50,30,10,0.65)"/>
                <path d="M68 99 Q70 78 90 78 Q110 78 112 99 Q105 104 90 105 Q75 104 68 99Z" fill="rgba(200,150,110,0.7)"/>
                <rect x="54" y="104" width="72" height="6" rx="2" fill="rgba(255,255,255,0.5)"/>
                <rect x="59" y="85" width="62" height="21" rx="3" fill="rgba(255,255,255,0.42)"/>
                <rect x="61" y="87" width="58" height="17" rx="2" fill="rgba(74,157,168,0.28)"/>
                <circle cx="142" cy="44" r="16" fill="rgba(255,255,255,0.28)" stroke="rgba(255,255,255,0.55)" stroke-width="1.5"/>
                <ellipse cx="142" cy="44" rx="9" ry="16" fill="none" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                <line x1="126" y1="44" x2="158" y2="44" stroke="rgba(255,255,255,0.45)" stroke-width="1.5"/>
                <line x1="128" y1="36" x2="156" y2="36" stroke="rgba(255,255,255,0.35)" stroke-width="1"/>
                <line x1="128" y1="52" x2="156" y2="52" stroke="rgba(255,255,255,0.35)" stroke-width="1"/>
                <path d="M72 90 Q63 97 61 104" stroke="rgba(255,220,185,0.9)" stroke-width="7" stroke-linecap="round" fill="none"/>
                <path d="M108 90 Q122 85 136 59" stroke="rgba(255,220,185,0.9)" stroke-width="7" stroke-linecap="round" fill="none"/>
            </svg>
        </div>

        <button class="view-btn">
            View Full Statistic
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
    </div>

    {{-- ── POPULARITY CARD ── --}}
    <div class="pop-card">
        <div class="pop-label">Popularity rate</div>
        <div class="pop-number-row">
            <div class="pop-number">
                <span class="count-up" data-target="{{ $stats['popularity'] }}">0</span>
            </div>
            <div class="pop-badge">↑ {{ $stats['popularity_up'] }}</div>
        </div>

        <div class="gauge-wrap">
            <svg class="gauge-svg" viewBox="0 0 78 78">
                <circle cx="39" cy="39" r="31" fill="none" stroke="#f0d9d0" stroke-width="6"
                    stroke-linecap="round" stroke-dasharray="137 57"/>
                <circle id="gaugeArc" cx="39" cy="39" r="31" fill="none" stroke="#e8a868" stroke-width="6"
                    stroke-linecap="round" stroke-dasharray="0 194"/>
                <circle cx="39" cy="8" r="5" fill="#e8a868"/>
            </svg>
        </div>

        <p class="pop-desc">
            Your rate has increased because of your recent update activity.
            <strong>Keep moving</strong> forward and get more points!
        </p>

        <div class="learn-row">
            <div class="learn-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" stroke="white" stroke-width="2"/>
                </svg>
            </div>
            <p class="learn-text">Learn insights how to manage all aspects of your startup.</p>
            <div class="learn-arrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- ── FINANCE CARD ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Finance Performance</span>
            <div class="card-icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
        </div>

        <div class="finance-row">
            <div class="dollar-icon">$</div>
            <div>
                <div class="finance-amount">
                    <span class="count-up" data-target="{{ $stats['monthly_income'] }}">0</span>
                </div>
            </div>
        </div>
        <div class="finance-sub">Monthly Income</div>

        <div class="bar-chart">
            @foreach ($finance as $i => $bar)
                <div class="bar-col">
                    <div class="bar {{ $bar['active'] ? 'bar--active' : '' }}"
                         style="height:{{ $bar['height'] }}px;animation-delay:{{ 0.3 + $loop->index * 0.1 }}s"></div>
                    <span class="bar-lbl">{{ $bar['month'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── TOP PERFORMERS ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Top Performers</span>
            <div class="card-icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                    <circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/>
                </svg>
            </div>
        </div>

        @foreach ($performers as $performer)
            <div class="performer-item">
                <div class="performer-av bg-gradient-to-br {{ $performer['color'] }}">
                    {{ $performer['initial'] }}
                </div>
                <div class="performer-info">
                    <div class="performer-name">{{ $performer['name'] }}</div>
                    <div class="performer-status">
                        <span class="status-dot {{ $performer['status'] === 'Online' ? 'status-dot--online' : 'status-dot--away' }}"></span>
                        {{ $performer['status'] }}
                    </div>
                </div>
                <div class="performer-score">{{ $performer['score'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- ── MAP CARD ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Targeting by region</span>
            <div class="card-icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>

        <div class="map-container">
            <svg class="map-svg" viewBox="0 0 300 150" xmlns="http://www.w3.org/2000/svg">
                <g fill="#8ba8be" opacity="0.42">
                    <circle cx="58"  cy="52" r="2"/><circle cx="68"  cy="47" r="2"/><circle cx="53"  cy="62" r="2"/>
                    <circle cx="73"  cy="57" r="2"/><circle cx="63"  cy="68" r="2"/><circle cx="78"  cy="52" r="2"/>
                    <circle cx="48"  cy="55" r="2"/><circle cx="83"  cy="62" r="2"/><circle cx="60"  cy="74" r="2"/>
                    <circle cx="143" cy="38" r="2"/><circle cx="150" cy="34" r="2"/><circle cx="156" cy="41" r="2"/>
                    <circle cx="146" cy="46" r="2"/><circle cx="153" cy="48" r="2"/><circle cx="160" cy="38" r="2"/>
                    <circle cx="166" cy="44" r="2"/><circle cx="138" cy="44" r="2"/>
                    <circle cx="193" cy="41" r="2"/><circle cx="203" cy="36" r="2"/><circle cx="213" cy="44" r="2"/>
                    <circle cx="223" cy="38" r="2"/><circle cx="218" cy="54" r="2"/><circle cx="198" cy="54" r="2"/>
                    <circle cx="208" cy="61" r="2"/><circle cx="228" cy="51" r="2"/><circle cx="233" cy="61" r="2"/>
                    <circle cx="93"  cy="91" r="2"/><circle cx="98"  cy="101" r="2"/><circle cx="88"  cy="106" r="2"/>
                    <circle cx="103" cy="111" r="2"/><circle cx="93"  cy="116" r="2"/>
                    <circle cx="153" cy="78" r="2"/><circle cx="160" cy="86" r="2"/><circle cx="153" cy="96" r="2"/>
                    <circle cx="166" cy="94" r="2"/><circle cx="160" cy="104" r="2"/>
                    <circle cx="233" cy="96" r="2"/><circle cx="243" cy="101" r="2"/>
                    <circle cx="238" cy="111" r="2"/><circle cx="248" cy="108" r="2"/>
                </g>
            </svg>

            <div class="map-pin" style="left:51%;top:20%">
                <div style="position:relative">
                    <div class="pin-dot" style="background:#4a9da8;"></div>
                    <div class="pin-pulse" style="border-color:#4a9da8;"></div>
                </div>
                <div class="map-label">Poland<div class="map-label-sub">23.03% · 4.7★</div></div>
            </div>

            <div class="map-pin" style="left:21%;top:36%">
                <div style="position:relative">
                    <div class="pin-dot" style="background:#f59e0b;"></div>
                    <div class="pin-pulse" style="border-color:#f59e0b;animation-delay:0.8s"></div>
                </div>
            </div>

            <div class="map-pin" style="left:70%;top:32%">
                <div style="position:relative">
                    <div class="pin-dot" style="background:#a78bfa;"></div>
                    <div class="pin-pulse" style="border-color:#a78bfa;animation-delay:0.4s"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function countUp(el, target, duration = 1200) {
    const start = performance.now();
    const isFloat = String(target).includes('.');
    function step(now) {
        const p    = Math.min((now - start) / duration, 1);
        const ease = 1 - Math.pow(1 - p, 3);
        const val  = target * ease;
        el.textContent = isFloat
            ? val.toFixed(1)
            : Math.floor(val).toLocaleString();
        if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
}

function animateGauge(popularity) {
    const arc   = document.getElementById('gaugeArc');
    const total = 194;
    const max   = 137;
    const filled = (popularity / 100) * max;
    let cur = 0;
    const tick = () => {
        cur = Math.min(cur + 2.5, filled);
        arc.setAttribute('stroke-dasharray', `${cur} ${total - cur}`);
        if (cur < filled) requestAnimationFrame(tick);
    };
    setTimeout(() => requestAnimationFrame(tick), 500);
}

window.addEventListener('load', () => {
    document.querySelectorAll('.count-up').forEach(el => {
        setTimeout(() => countUp(el, parseFloat(el.dataset.target)), 300);
    });
    animateGauge({{ $stats['popularity'] }});
});
</script>
@endpush
