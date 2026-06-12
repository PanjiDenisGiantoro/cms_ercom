<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ config('app.name', 'Admin') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center" style="font-family: 'DM Sans', sans-serif;">

    <div class="w-full max-w-sm px-6">

        {{-- Logo --}}
        <div class="flex justify-center mb-8">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: #1a1a2e;">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <circle cx="12" cy="12" r="4"/>
                    <circle cx="12" cy="12" r="9" stroke-dasharray="3 3"/>
                    <circle cx="4"  cy="12" r="1.5" fill="white" stroke="none"/>
                    <circle cx="20" cy="12" r="1.5" fill="white" stroke="none"/>
                </svg>
            </div>
        </div>

        <h1 class="text-2xl font-semibold text-center text-gray-900 mb-1">Masuk ke Admin</h1>
        <p class="text-sm text-center text-gray-500 mb-8">{{ config('app.name') }} CMS</p>

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Session Status --}}
        @if (session('status'))
            <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    class="w-full px-3 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-900 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-200 transition @error('email') border-red-400 @enderror"
                    placeholder="admin@example.com"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full px-3 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-900 outline-none focus:border-gray-500 focus:ring-2 focus:ring-gray-200 transition"
                    placeholder="••••••••"
                >
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-gray-800">
                    Ingat saya
                </label>
            </div>

            <button
                type="submit"
                class="w-full py-2.5 px-4 rounded-lg text-sm font-semibold text-white transition hover:opacity-90 active:scale-[0.98]"
                style="background: #1a1a2e;"
            >
                Masuk
            </button>
        </form>

    </div>

</body>
</html>
