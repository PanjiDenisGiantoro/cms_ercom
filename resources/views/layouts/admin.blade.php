<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('app.name', 'Admin') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="dashboard-body">

<div class="app-shell admin-shell">

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
                <a href="{{ route('admin.hero.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    Hero
                </a>
                <div class="admin-nav-group {{ request()->routeIs('admin.about.*', 'admin.about-sections.*', 'admin.about-section3.*', 'admin.about-milestones.*', 'admin.about-section4-items.*', 'admin.about-section4-pages.*') ? 'open' : '' }}">
                    <button type="button" class="admin-nav-link admin-nav-toggle {{ request()->routeIs('admin.about.*', 'admin.about-sections.*', 'admin.about-section3.*', 'admin.about-milestones.*', 'admin.about-section4-items.*', 'admin.about-section4-pages.*') ? 'active' : '' }}" onclick="toggleNavGroup(this)">
                        <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        About
                        <svg class="admin-nav-caret" viewBox="0 0 24 24" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="admin-nav-submenu">
                        <a href="{{ route('admin.about.edit') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.about.edit') ? 'active' : '' }}">
                            Sub Heading
                        </a>
                        <a href="{{ route('admin.about-sections.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.about-sections.*') ? 'active' : '' }}">
                            What Drives ER
                        </a>
                        <a href="{{ route('admin.about-milestones.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.about-section3.*', 'admin.about-milestones.*') ? 'active' : '' }}">
                            Timeline
                        </a>
                        <a href="{{ route('admin.about-section4-items.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.about-section4-items.*', 'admin.about-section4-pages.*') ? 'active' : '' }}">
                            History
                        </a>
                    </div>
                </div>
                <a href="{{ route('admin.seo.edit') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    SEO
                </a>
                <a href="{{ route('admin.social.edit') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.social.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                    Sosmed & WhatsApp
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
                <div class="admin-nav-group {{ request()->routeIs('admin.blog*', 'admin.blog-categories.*') ? 'open' : '' }}">
                    <button type="button" class="admin-nav-link admin-nav-toggle {{ request()->routeIs('admin.blog*', 'admin.blog-categories.*') ? 'active' : '' }}" onclick="toggleNavGroup(this)">
                        <svg viewBox="0 0 24 24" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                        Blog
                        <svg class="admin-nav-caret" viewBox="0 0 24 24" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="admin-nav-submenu">
                        <a href="{{ route('admin.blog.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                            Blog
                        </a>
                        <a href="{{ route('admin.blog-categories.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
                            Kategori
                        </a>
                    </div>
                </div>
                <a href="{{ route('admin.stats.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.stats*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    Stats
                </a>
                <div class="admin-nav-group {{ request()->routeIs('admin.careers*', 'admin.career-applicants.*') ? 'open' : '' }}">
                    <button type="button" class="admin-nav-link admin-nav-toggle {{ request()->routeIs('admin.careers*', 'admin.career-applicants.*') ? 'active' : '' }}" onclick="toggleNavGroup(this)">
                        <svg viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
                        Career
                        <svg class="admin-nav-caret" viewBox="0 0 24 24" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="admin-nav-submenu">
                        <a href="{{ route('admin.careers.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.careers*') ? 'active' : '' }}">
                            Career
                        </a>
                        <a href="{{ route('admin.career-applicants.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.career-applicants.*') ? 'active' : '' }}">
                            Pelamar
                        </a>
                    </div>
                </div>
                <a href="{{ route('admin.contacts.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Contact
                </a>
                <a href="{{ route('admin.contact-messages.index') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    Contact Messages
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
                <div class="admin-nav-group {{ request()->routeIs('admin.clients*', 'admin.client-categories.*') ? 'open' : '' }}">
                    <button type="button" class="admin-nav-link admin-nav-toggle {{ request()->routeIs('admin.clients*', 'admin.client-categories.*') ? 'active' : '' }}" onclick="toggleNavGroup(this)">
                        <svg viewBox="0 0 24 24" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                        Client
                        <svg class="admin-nav-caret" viewBox="0 0 24 24" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="admin-nav-submenu">
                        <a href="{{ route('admin.clients.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
                            Client
                        </a>
                        <a href="{{ route('admin.client-categories.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.client-categories.*') ? 'active' : '' }}">
                            Kategori
                        </a>
                    </div>
                </div>
                <div class="admin-nav-group {{ request()->routeIs('admin.team.*', 'admin.team-settings.*') ? 'open' : '' }}">
                    <button type="button" class="admin-nav-link admin-nav-toggle {{ request()->routeIs('admin.team.*', 'admin.team-settings.*') ? 'active' : '' }}" onclick="toggleNavGroup(this)">
                        <svg viewBox="0 0 24 24" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Team
                        <svg class="admin-nav-caret" viewBox="0 0 24 24" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="admin-nav-submenu">
                        <a href="{{ route('admin.team-settings.edit') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.team-settings.*') ? 'active' : '' }}">
                            Config
                        </a>
                        <a href="{{ route('admin.team.index') }}"
                           class="admin-nav-sublink {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                            Team List
                        </a>
                    </div>
                </div>
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
            <div class="admin-topbar-actions">
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
<script>
function positionSubmenu(group) {
    var button = group.querySelector('.admin-nav-toggle');
    var submenu = group.querySelector('.admin-nav-submenu');
    if (button && submenu) {
        submenu.style.top = button.getBoundingClientRect().top + 'px';
    }
}

function isSidebarCollapsed() {
    return window.matchMedia('(max-width: 1100px)').matches;
}

function toggleNavGroup(button) {
    var group = button.closest('.admin-nav-group');
    var wasOpen = group.classList.contains('open');

    document.querySelectorAll('.admin-nav-group.open').forEach(function (openGroup) {
        openGroup.classList.remove('open');
    });

    if (!wasOpen) {
        group.classList.add('open');
        positionSubmenu(group);
    }
}

function syncNavGroupsOnLoad() {
    if (isSidebarCollapsed()) {
        // Icon-only rail: submenus only ever open on click, never pre-expanded.
        document.querySelectorAll('.admin-nav-group.open').forEach(function (group) {
            group.classList.remove('open');
        });
    } else {
        document.querySelectorAll('.admin-nav-group.open').forEach(positionSubmenu);
    }
}

syncNavGroupsOnLoad();
window.addEventListener('resize', syncNavGroupsOnLoad);

document.addEventListener('click', function (event) {
    if (!event.target.closest('.admin-nav-group')) {
        document.querySelectorAll('.admin-nav-group.open').forEach(function (openGroup) {
            openGroup.classList.remove('open');
        });
    }
});

</script>
</body>
</html>
