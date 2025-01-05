<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User - Event and Attendance Management System</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="h-full bg-yellow-50">
    <div>
        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
            <!-- ... (mobile menu code remains unchanged) ... -->
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex flex-col px-6 overflow-y-auto bg-yellow-100 grow gap-y-5">
                <div class="flex items-center h-20 mt-8 shrink-0">
                    <a href="#" class="flex items-center no-underline">
                        <span
                            class="text-2xl font-bold text-yellow-800 transition duration-300 ease-in-out transform hover:scale-105">
                            Event & Attendance<br>
                            Management
                        </span>
                    </a>
                </div>
                <nav class="flex flex-col flex-1">
                    <ul role="list" class="flex flex-col flex-1 gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('user.dashboard') }}"
                                        class="flex items-center p-3 text-sm font-semibold leading-6 text-yellow-800 transition-all duration-200 rounded-lg group gap-x-3 hover:bg-yellow-200 hover:text-yellow-900">
                                        <svg class="w-6 h-6 text-yellow-600 shrink-0 group-hover:text-yellow-800"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.events') }}"
                                        class="flex items-center p-3 text-sm font-semibold leading-6 text-yellow-800 transition-all duration-200 rounded-lg group gap-x-3 hover:bg-yellow-200 hover:text-yellow-900">
                                        <svg class="w-6 h-6 text-yellow-600 shrink-0 group-hover:text-yellow-800"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Events
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('feedback.index') }}"
                                        class="flex items-center p-3 text-sm font-semibold leading-6 text-yellow-800 transition-all duration-200 rounded-lg group gap-x-3 hover:bg-yellow-200 hover:text-yellow-900">
                                        <svg class="w-6 h-6 text-yellow-600 shrink-0 group-hover:text-yellow-800"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        Feedback
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.event.donations') }}"
                                        class="flex items-center p-3 text-sm font-semibold leading-6 text-yellow-800 transition-all duration-200 rounded-lg group gap-x-3 hover:bg-yellow-200 hover:text-yellow-900">
                                        <svg class="w-6 h-6 text-yellow-600 shrink-0 group-hover:text-yellow-800"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Donations
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="mt-auto">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center p-3 -mx-2 text-sm font-semibold leading-6 text-yellow-800 transition-all duration-200 rounded-lg gap-x-4 hover:bg-yellow-200 hover:text-yellow-900">
                                <svg class="w-6 h-6 text-yellow-600 shrink-0 group-hover:text-yellow-800" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                User Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full p-3 -mx-2 text-sm font-semibold leading-6 text-yellow-800 transition-all duration-200 rounded-lg gap-x-4 hover:bg-yellow-200 hover:text-yellow-900">
                                    <svg class="w-6 h-6 text-yellow-600 shrink-0 group-hover:text-yellow-800"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="sticky top-0 z-40 flex items-center px-4 py-4 bg-yellow-100 shadow-sm gap-x-6 sm:px-6 lg:hidden">
            <button type="button" class="-m-2.5 p-2.5 text-yellow-700 lg:hidden">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            <div class="flex-1 text-sm font-semibold leading-6 text-yellow-800">Dashboard</div>
            <a href="#">
                <span class="sr-only">Your profile</span>
                <img class="w-8 h-8 bg-yellow-200 rounded-full"
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt="">
            </a>
        </div>

        <main class="py-10 lg:pl-72">
            <div class="px-4 sm:px-6 lg:px-8">
                @yield('user')
            </div>
        </main>
    </div>
</body>

</html>
