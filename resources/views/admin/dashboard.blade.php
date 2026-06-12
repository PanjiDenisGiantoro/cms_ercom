@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats Row 1: Content --}}
<div class="admin-stats-grid">

    <div class="admin-stat-card" style="animation-delay:0.04s">
        <div class="admin-stat-icon" style="background:linear-gradient(135deg,#4a9da8,#2d7a85)">
            <svg viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
        </div>
        <div class="admin-stat-label">Portfolio</div>
        <div class="admin-stat-value">{{ $stats['portfolio'] }}</div>
        <div style="font-size:11px;color:#8896a8;margin-top:4px">{{ $stats['portfolio_published'] }} published</div>
    </div>

    <div class="admin-stat-card" style="animation-delay:0.08s">
        <div class="admin-stat-icon" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8)">
            <svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <div class="admin-stat-label">Service Categories</div>
        <div class="admin-stat-value">{{ $stats['services'] }}</div>
        <div style="font-size:11px;color:#8896a8;margin-top:4px">kategori layanan</div>
    </div>

    <div class="admin-stat-card" style="animation-delay:0.12s">
        <div class="admin-stat-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706)">
            <svg viewBox="0 0 24 24" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        </div>
        <div class="admin-stat-label">Testimonials</div>
        <div class="admin-stat-value">{{ $stats['testimonials'] }}</div>
        <div style="font-size:11px;color:#8896a8;margin-top:4px">ulasan klien</div>
    </div>

    <div class="admin-stat-card" style="animation-delay:0.16s">
        <div class="admin-stat-icon" style="background:linear-gradient(135deg,#8b5cf6,#6d28d9)">
            <svg viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <div class="admin-stat-label">Partners</div>
        <div class="admin-stat-value">{{ $stats['partners'] }}</div>
        <div style="font-size:11px;color:#8896a8;margin-top:4px">mitra perusahaan</div>
    </div>

</div>

{{-- Stats Row 2 --}}
<div class="admin-stats-grid-secondary">

    <div class="admin-stat-card" style="animation-delay:0.2s">
        <div class="admin-stat-icon" style="background:linear-gradient(135deg,#10b981,#059669)">
            <svg viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="admin-stat-label">Team</div>
        <div class="admin-stat-value">{{ $stats['team'] }}</div>
        <div style="font-size:11px;color:#8896a8;margin-top:4px">anggota tim</div>
    </div>

    <div class="admin-stat-card" style="animation-delay:0.24s">
        <div class="admin-stat-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
            <svg viewBox="0 0 24 24" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
        </div>
        <div class="admin-stat-label">Stats Entries</div>
        <div class="admin-stat-value">{{ $stats['stats'] }}</div>
        <div style="font-size:11px;color:#8896a8;margin-top:4px">angka statistik</div>
    </div>

    <div class="admin-stat-card" style="animation-delay:0.28s">
        <div class="admin-stat-icon" style="background:linear-gradient(135deg,#2d3f55,#4a5f75)">
            <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </div>
        <div class="admin-stat-label">Users</div>
        <div class="admin-stat-value">{{ $stats['users'] }}</div>
        <div style="font-size:11px;color:#8896a8;margin-top:4px">admin & editor</div>
    </div>

    <div class="admin-stat-card" style="animation-delay:0.32s;background:linear-gradient(135deg,#f8fafc,#f1f5f9);border:1.5px dashed #cbd5e1;box-shadow:none;">
        <div style="font-size:12px;font-weight:600;color:#94a3b8;margin-bottom:8px">Sistem</div>
        <div style="font-size:11px;color:#64748b;line-height:1.6">
            Laravel v13 · PHP 8.4<br>
            <span style="color:#10b981">● Online</span>
        </div>
    </div>

</div>

{{-- Two column layout: Quick Access + Recent Portfolio --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start">

    {{-- Quick Access --}}
    <div>
        <div style="font-size:12px;font-weight:700;color:#8896a8;letter-spacing:.06em;text-transform:uppercase;margin-bottom:12px">Settings</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px">

            <a href="{{ route('admin.hero.edit') }}" class="admin-section-card" style="animation-delay:0.06s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#4a9da8,#2d7a85)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <div><div class="admin-section-title">Hero</div><div class="admin-section-desc">Headline & CTA</div></div>
            </a>

            <a href="{{ route('admin.about.edit') }}" class="admin-section-card" style="animation-delay:0.08s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#8b5cf6,#6d28d9)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <div><div class="admin-section-title">About</div><div class="admin-section-desc">Deskripsi & video</div></div>
            </a>

            <a href="{{ route('admin.cta-banner.edit') }}" class="admin-section-card" style="animation-delay:0.1s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <div><div class="admin-section-title">CTA Banner</div><div class="admin-section-desc">Headline & tombol</div></div>
            </a>

            <a href="{{ route('admin.footer.edit') }}" class="admin-section-card" style="animation-delay:0.12s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#10b981,#059669)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="3" y1="18" x2="21" y2="18"/><path d="M4 14h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v8a1 1 0 001 1z"/></svg>
                </div>
                <div><div class="admin-section-title">Footer</div><div class="admin-section-desc">Kontak & sosmed</div></div>
            </a>

            <a href="{{ route('admin.seo.edit') }}" class="admin-section-card" style="animation-delay:0.14s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <div><div class="admin-section-title">SEO</div><div class="admin-section-desc">Meta & tracking</div></div>
            </a>

        </div>

        <div style="font-size:12px;font-weight:700;color:#8896a8;letter-spacing:.06em;text-transform:uppercase;margin-bottom:12px">Content</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">

            <a href="{{ route('admin.services.index') }}" class="admin-section-card" style="animation-delay:0.16s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <div><div class="admin-section-title">Services</div><div class="admin-section-desc">{{ $stats['services'] }} kategori</div></div>
            </a>

            <a href="{{ route('admin.portfolio.index') }}" class="admin-section-card" style="animation-delay:0.18s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#4a9da8,#2d7a85)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                </div>
                <div><div class="admin-section-title">Portfolio</div><div class="admin-section-desc">{{ $stats['portfolio'] }} project</div></div>
            </a>

            <a href="{{ route('admin.stats.index') }}" class="admin-section-card" style="animation-delay:0.2s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </div>
                <div><div class="admin-section-title">Stats</div><div class="admin-section-desc">{{ $stats['stats'] }} item</div></div>
            </a>

            <a href="{{ route('admin.testimonials.index') }}" class="admin-section-card" style="animation-delay:0.22s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <div><div class="admin-section-title">Testimonials</div><div class="admin-section-desc">{{ $stats['testimonials'] }} ulasan</div></div>
            </a>

            <a href="{{ route('admin.partners.index') }}" class="admin-section-card" style="animation-delay:0.24s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#8b5cf6,#6d28d9)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                </div>
                <div><div class="admin-section-title">Partners</div><div class="admin-section-desc">{{ $stats['partners'] }} mitra</div></div>
            </a>

            <a href="{{ route('admin.team.index') }}" class="admin-section-card" style="animation-delay:0.26s">
                <div class="admin-section-icon" style="background:linear-gradient(135deg,#10b981,#059669)">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div><div class="admin-section-title">Team</div><div class="admin-section-desc">{{ $stats['team'] }} anggota</div></div>
            </a>

        </div>
    </div>

    {{-- Recent Portfolio --}}
    <div>
        <div style="font-size:12px;font-weight:700;color:#8896a8;letter-spacing:.06em;text-transform:uppercase;margin-bottom:12px">Portfolio Terbaru</div>
        <div class="cms-card" style="padding:0;overflow:hidden">
            @forelse($recentPortfolio as $p)
                <div style="display:flex;align-items:center;gap:14px;padding:14px 18px;border-bottom:1px solid #f1f5f9">
                    @if($p->cover_image)
                        <img src="{{ Storage::url($p->cover_image) }}" style="width:52px;height:36px;object-fit:cover;border-radius:8px;flex-shrink:0" alt="">
                    @else
                        <div style="width:52px;height:36px;background:#f1f5f9;border-radius:8px;flex-shrink:0"></div>
                    @endif
                    <div style="flex:1;min-width:0">
                        <div style="font-size:13px;font-weight:600;color:#1a2332;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $p->project_title }}</div>
                        <div style="font-size:11px;color:#8896a8;margin-top:2px">{{ $p->serviceCategory?->name ?? '—' }} · {{ $p->project_date?->format('M Y') ?? '—' }}</div>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;flex-shrink:0">
                        <span class="cms-badge {{ $p->is_published ? 'cms-badge-green' : 'cms-badge-gray' }}" style="font-size:10px">{{ $p->is_published ? 'Live' : 'Draft' }}</span>
                        <a href="{{ route('admin.portfolio.edit', $p) }}" style="font-size:11px;color:#4a9da8;text-decoration:none;font-weight:500">Edit</a>
                    </div>
                </div>
            @empty
                <div style="padding:32px;text-align:center;color:#8896a8;font-size:13px">Belum ada portfolio.</div>
            @endforelse
            <div style="padding:12px 18px;border-top:1px solid #f1f5f9">
                <a href="{{ route('admin.portfolio.index') }}" style="font-size:12px;font-weight:600;color:#4a9da8;text-decoration:none">Lihat semua portfolio →</a>
            </div>
        </div>

        {{-- System Info --}}
        <div style="font-size:12px;font-weight:700;color:#8896a8;letter-spacing:.06em;text-transform:uppercase;margin:20px 0 12px">System</div>
        <div class="cms-card" style="padding:16px 18px">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                <a href="{{ route('admin.users.index') }}" class="admin-section-card" style="padding:14px;animation-delay:0.28s">
                    <div class="admin-section-icon" style="background:linear-gradient(135deg,#2d3f55,#4a5f75);width:34px;height:34px;border-radius:9px">
                        <svg viewBox="0 0 24 24" stroke-width="2" style="width:16px;height:16px"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </div>
                    <div><div class="admin-section-title">Users</div><div class="admin-section-desc">{{ $stats['users'] }} akun</div></div>
                </a>
                <div style="background:#f8fafc;border-radius:10px;padding:14px;border:1px solid #f1f5f9">
                    <div style="font-size:11px;font-weight:600;color:#64748b;margin-bottom:6px">Versi</div>
                    <div style="font-size:11px;color:#94a3b8;line-height:1.7">
                        Laravel 13<br>PHP 8.4<br>
                        <span style="color:#10b981;font-weight:500">● Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
