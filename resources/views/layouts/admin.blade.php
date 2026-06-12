<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — {{ config('app.name', 'Admin') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=DM+Serif+Display&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="dashboard-body">

<div class="app-shell">

    {{-- ── SIDEBAR ── --}}
    <aside class="admin-sidebar">

        {{-- Header --}}
        <div class="admin-sidebar-header">
            <div class="admin-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <circle cx="12" cy="12" r="4"/>
                    <circle cx="12" cy="12" r="9" stroke-dasharray="3 3"/>
                    <circle cx="4"  cy="12" r="1.5" fill="white" stroke="none"/>
                    <circle cx="20" cy="12" r="1.5" fill="white" stroke="none"/>
                </svg>
            </div>
            <div>
                <div class="admin-brand-name">{{ config('app.name') }}</div>
                <div class="admin-brand-sub">CMS Admin</div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="admin-nav">

            {{-- Overview --}}
            <div class="admin-nav-section">
                <a href="{{ route('admin.dashboard') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
            </div>

            {{-- Settings --}}
            <div class="admin-nav-section">
                <div class="admin-nav-section-label">Settings</div>
                <a href="{{ route('admin.navbar.edit') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.navbar.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    Navbar
                </a>
                <a href="{{ route('admin.hero.edit') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    Hero
                </a>
                <a href="{{ route('admin.about.edit') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    About
                </a>
                <a href="{{ route('admin.cta-banner.edit') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.cta-banner.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    CTA Banner
                </a>
                <a href="{{ route('admin.footer.edit') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.footer.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="3" y1="18" x2="21" y2="18"/><path d="M4 14h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v8a1 1 0 001 1z"/></svg>
                    Footer
                </a>
                <a href="{{ route('admin.seo.edit') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    SEO
                </a>
            </div>

            {{-- Content --}}
            <div class="admin-nav-section">
                <div class="admin-nav-section-label">Content</div>
                <a href="{{ route('admin.services.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    Services
                </a>
                <a href="{{ route('admin.portfolio.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.portfolio*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    Portfolio
                </a>
                <a href="{{ route('admin.stats.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.stats*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    Stats
                </a>
                <a href="{{ route('admin.careers.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.careers*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
                    Career
                </a>
            </div>

            {{-- Social Proof --}}
            <div class="admin-nav-section">
                <div class="admin-nav-section-label">Social Proof</div>
                <a href="{{ route('admin.testimonials.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    Testimonials
                </a>
                <a href="{{ route('admin.partners.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.partners*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    Partners
                </a>
                <a href="{{ route('admin.team.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Team
                </a>
            </div>

            {{-- System --}}
            <div class="admin-nav-section">
                <div class="admin-nav-section-label">System</div>
                <a href="{{ route('admin.users.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    Users
                </a>
            </div>

        </nav>

        {{-- Footer --}}
        <div class="admin-sidebar-footer">
            <div class="admin-user-row">
                <div class="admin-user-av">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                </div>
                <div class="admin-user-info">
                    <div class="admin-user-name">{{ auth()->user()?->name }}</div>
                    <div class="admin-user-role">{{ auth()->user()?->getRoleNames()->first() ?? 'admin' }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="admin-logout-btn" title="Logout">
                        <svg viewBox="0 0 24 24" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- ── MAIN ── --}}
    <div class="admin-main">

        {{-- Topbar --}}
        <header class="admin-topbar">
            <div>
                <div class="admin-page-title">@yield('page-title', 'Dashboard')</div>
                @hasSection('breadcrumb')
                    <div class="admin-breadcrumb">@yield('breadcrumb')</div>
                @endif
            </div>
            <div style="margin-left:auto;display:flex;align-items:center;gap:10px;">
                @yield('topbar-actions')
            </div>
        </header>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div style="margin:16px 24px -8px;padding:10px 16px;background:#dcfce7;border:1px solid #86efac;border-radius:10px;font-size:13px;color:#166534;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="margin:16px 24px -8px;padding:10px 16px;background:#fee2e2;border:1px solid #fca5a5;border-radius:10px;font-size:13px;color:#991b1b;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Page Content --}}
        <div class="admin-content">
            @yield('content')
        </div>

    </div>

</div>

@stack('scripts')
</body>
</html>
