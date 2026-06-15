@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('topbar-actions')
    <div style="display:flex;align-items:center;gap:10px;">
        <div class="avatar-stack">
            @php($avatarColors = ['linear-gradient(135deg,#a78bfa,#7c3aed)','linear-gradient(135deg,#f59e0b,#d97706)','linear-gradient(135deg,#34d399,#059669)'])
            @foreach ($users as $i => $user)
                <div class="av" style="background:{{ $avatarColors[$i % 3] }}">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            @endforeach
        </div>
        <span class="member-count">{{ $stats['users'] }} pengguna</span>
    </div>
@endsection

@section('content')
<div class="dash-grid" style="padding:0">

    {{-- ── HERO CARD: TOTAL PORTFOLIO ── --}}
    <div class="hero-card">
        <div class="hero-label">Total Portfolio</div>
        <div class="hero-number">
            <span class="count-up" data-target="{{ $stats['portfolio'] }}">0</span>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="rgba(255,255,255,0.9)">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                <div>
                    <div class="hero-stat-label">Published</div>
                    <div class="hero-stat-val">{{ $stats['portfolio_published'] }}</div>
                </div>
            </div>
            <div class="hero-stat">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke="rgba(255,255,255,0.9)">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                <div>
                    <div class="hero-stat-label">Draft</div>
                    <div class="hero-stat-val">{{ $stats['portfolio_draft'] }}</div>
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

        <a href="{{ route('admin.portfolio.index') }}" class="view-btn">
            Lihat Semua Portfolio
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>
    </div>

    {{-- ── PUBLISH RATE CARD ── --}}
    <div class="pop-card">
        <div class="pop-label">Tingkat Publikasi</div>
        <div class="pop-number-row">
            <div class="pop-number">
                <span class="count-up" data-target="{{ $stats['publish_rate'] }}">0</span>%
            </div>
            @if ($stats['portfolio_draft'] > 0)
                <div class="pop-badge" style="color:#d97706;background:rgba(217,119,6,0.12)">{{ $stats['portfolio_draft'] }} draft</div>
            @else
                <div class="pop-badge">✓ Lengkap</div>
            @endif
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
            @if ($stats['portfolio_draft'] > 0)
                {{ $stats['portfolio_draft'] }} portfolio masih berstatus draft.
                <strong>Publikasikan</strong> agar tampil di website.
            @else
                Semua portfolio sudah dipublikasikan.
                <strong>Pertahankan</strong> kualitas konten Anda!
            @endif
        </p>

        <a href="{{ route('admin.portfolio.index') }}" class="learn-row" style="text-decoration:none">
            <div class="learn-icon">
                <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="2" stroke="white" stroke-width="2"/><path d="M3 9h18M9 21V9" stroke="white" stroke-width="2"/></svg>
            </div>
            <p class="learn-text">Kelola dan publikasikan portfolio agar tampil di halaman utama website.</p>
            <div class="learn-arrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </div>
        </a>
    </div>

    {{-- ── RINGKASAN KONTEN (BAR CHART) ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Ringkasan Konten</span>
            <div class="card-icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
                    <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
                </svg>
            </div>
        </div>

        <div class="finance-row">
            <div class="dollar-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width:18px;height:18px">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
            </div>
            <div>
                <div class="finance-amount">
                    <span class="count-up" data-target="{{ $totalContent }}">0</span>
                </div>
            </div>
        </div>
        <div class="finance-sub">Total Item Konten CMS</div>

        <div class="bar-chart">
            @foreach ($content as $i => $item)
                <div class="bar-col">
                    <div class="bar {{ $item['active'] ? 'bar--active' : '' }}"
                         style="height:{{ $item['height'] }}px;animation-delay:{{ 0.3 + $i * 0.1 }}s"></div>
                    <span class="bar-lbl">{{ $item['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── TIM KAMI ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Tim Kami</span>
            <a href="{{ route('admin.team.index') }}" class="card-icon-btn" style="text-decoration:none">
                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
            </a>
        </div>

        @php($teamColors = ['linear-gradient(135deg,#4a9da8,#2d7a85)','linear-gradient(135deg,#8b5cf6,#6d28d9)','linear-gradient(135deg,#f59e0b,#d97706)','linear-gradient(135deg,#10b981,#059669)'])

        @forelse ($teamMembers as $i => $member)
            <div class="performer-item">
                @if ($member->photo)
                    <img src="{{ Storage::url($member->photo) }}" class="performer-av" style="object-fit:cover" alt="">
                @else
                    <div class="performer-av" style="background:{{ $teamColors[$i % 4] }}">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                @endif
                <div class="performer-info">
                    <div class="performer-name">{{ $member->name }}</div>
                    <div class="performer-status">
                        <span class="status-dot status-dot--online"></span>
                        {{ $member->position }}
                    </div>
                </div>
                <a href="{{ route('admin.team.edit', $member) }}" style="font-size:12px;font-weight:600;color:#4a9da8;text-decoration:none;flex-shrink:0">Edit</a>
            </div>
        @empty
            <div style="padding:24px 0;text-align:center;color:#8896a8;font-size:13px">Belum ada anggota tim.</div>
        @endforelse
    </div>

    {{-- ── PORTFOLIO TERBARU ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Portfolio Terbaru</span>
            <a href="{{ route('admin.portfolio.index') }}" class="card-icon-btn" style="text-decoration:none">
                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>

        @forelse ($recentPortfolio as $p)
            <div style="display:flex;align-items:center;gap:12px;padding:9px 0;border-bottom:1px solid #f1f5f9">
                @if ($p->cover_image)
                    <img src="{{ Storage::url($p->cover_image) }}" style="width:42px;height:42px;object-fit:cover;border-radius:10px;flex-shrink:0" alt="">
                @else
                    <div style="width:42px;height:42px;background:#f1f5f9;border-radius:10px;flex-shrink:0"></div>
                @endif
                <div style="flex:1;min-width:0">
                    <div class="performer-name">{{ $p->project_title }}</div>
                    <div class="performer-status">{{ $p->category?->name ?? '—' }} · {{ $p->project_date?->format('M Y') ?? '—' }}</div>
                </div>
                <span class="cms-badge {{ $p->is_published ? 'cms-badge-green' : 'cms-badge-gray' }}" style="font-size:10px;flex-shrink:0">{{ $p->is_published ? 'Live' : 'Draft' }}</span>
            </div>
        @empty
            <div style="padding:24px 0;text-align:center;color:#8896a8;font-size:13px">Belum ada portfolio.</div>
        @endforelse
    </div>

    {{-- ── LOWONGAN KARIR ── --}}
    <div class="card" style="grid-column:1 / -1;animation:fadeInUp 0.55s 0.35s ease both">
        <div class="card-header">
            <span class="card-title">Lowongan Karir</span>
            <a href="{{ route('admin.careers.index') }}" class="card-icon-btn" style="text-decoration:none">
                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>

        <div style="display:flex;gap:32px;margin-bottom:14px">
            <div>
                <div class="finance-amount"><span class="count-up" data-target="{{ $stats['careers'] }}">0</span></div>
                <div class="finance-sub" style="margin-bottom:0">Lowongan Aktif</div>
            </div>
            <div>
                <div class="finance-amount"><span class="count-up" data-target="{{ $stats['applications'] }}">0</span></div>
                <div class="finance-sub" style="margin-bottom:0">Total Pelamar</div>
            </div>
        </div>

        @forelse ($careers as $career)
            <div style="display:flex;align-items:center;gap:12px;padding:9px 0;border-bottom:1px solid #f1f5f9">
                <div class="performer-av" style="background:linear-gradient(135deg,#2d3f55,#4a5f75)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" style="width:16px;height:16px"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
                </div>
                <div style="flex:1;min-width:0">
                    <div class="performer-name">{{ $career->title }}</div>
                    <div class="performer-status">{{ $career->employment_type }} · {{ $career->location }}</div>
                </div>
                <span class="cms-badge cms-badge-blue" style="font-size:10px;flex-shrink:0">{{ $career->applications_count }} pelamar</span>
            </div>
        @empty
            <div style="padding:24px 0;text-align:center;color:#8896a8;font-size:13px">Belum ada lowongan aktif.</div>
        @endforelse
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

function animateGauge(rate) {
    const arc   = document.getElementById('gaugeArc');
    const total = 194;
    const max   = 137;
    const filled = (rate / 100) * max;
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
    animateGauge({{ $stats['publish_rate'] }});
});
</script>
@endpush