<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel LMS') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <nav class="lms-header sticky top-0 z-50 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <svg class="h-8 w-8 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                        <span class="text-xl font-semibold text-gray-900">{{ config('app.name') }}</span>
                    </a>
                    <div class="hidden md:ml-10 md:flex md:space-x-1">
                        <a href="{{ route('dashboard') }}" class="lms-nav-link">Dashboard</a>
                        <a href="{{ route('courses.index') }}" class="lms-nav-link">Courses</a>
                        @if(auth()->user()->isAdmin() || auth()->user()->isInstructor())
                            <a href="{{ route('admin.index') }}" class="lms-nav-link">Manage</a>
                        @endif
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-sm text-gray-700 font-medium">{{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-700 font-medium">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="min-h-screen">
        @isset($header)
            <header class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>