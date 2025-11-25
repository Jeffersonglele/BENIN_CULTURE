<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 color:#7a7979ff leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Role: {{ Auth::user()->role }}
                    
                    @if(Auth::user()->isAdmin())
                        <p>You have admin privileges.</p>
                    @elseif(Auth::user()->isManager())
                        <p>You have manager privileges.</p>
                    @else
                        <p>You have standard user privileges.</p>
                    @endif
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-wrap gap-4">
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.culture') }}" class="btn-1">
                                <span class="text-gray-900 dark:text-gray-100">Go to Culture Dashboard</span>
                                <div class="circle"></div>
                                <svg class="arr-1" viewBox="0 0 24 24">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg>
                                <svg class="arr-2" viewBox="0 0 24 24">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg>
                            </a>
                        @elseif(Auth::user()->isManager())
                            <a href="{{ route('manager.dashboard') }}" class="btn-1">
                                <span class="text-gray-900 dark:text-gray-100">Go to Manager Dashboard</span>
                                <div class="circle"></div>
                                <svg class="arr-1" viewBox="0 0 24 24">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg>
                                <svg class="arr-2" viewBox="0 0 24 24">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('home') }}" class="btn-1">
                                <span class="text-gray-900 dark:text-gray-100">Go to Home</span>
                                <div class="circle"></div>
                                <svg class="arr-1" viewBox="0 0 24 24">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg>
                                <svg class="arr-2" viewBox="0 0 24 24">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-1 {
            position: relative;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 16px 36px;
            border: 4px solid;
            border-color: transparent;
            font-size: 18px;
            background-color: inherit;
            border-radius: 100px;
            font-weight: 400;
            color: #f9f9f9;
            box-shadow: 0 0 0 2px #E2E9C0;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            text-decoration: none;
        }

        .btn-1 svg {
            position: absolute;
            width: 24px;
            fill: #1e1e1e;
            z-index: 9;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-1 .arr-1 {
            right: 16px;
        }

        .btn-1 .arr-2 {
            left: -25%;
        }

        .btn-1 .circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            background-color: #E2E9C0;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-1 .text {
            position: relative;
            z-index: 1;
            transform: translateX(-12px);
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .btn-1:hover {
            box-shadow: 0 0 0 12px transparent;
            border-radius: 12px;
        }

        .btn-1:hover .arr-1 {
            right: -25%;
        }

        .btn-1:hover .arr-2 {
            left: 16px;
        }

        .btn-1:hover .text {
            transform: translateX(12px);
        }

        .btn-1 svg {
            fill: #f9f9f9;
        }

        .btn-1:hover svg {
            fill: #f9f9f9;
        }

        .btn-1:active {
            transform: scale(0.95);
            box-shadow: 0 0 0 4px #E2E9C0;
        }

        .btn-1:hover .circle {
            width: 220px;
            height: 220px;
            opacity: 1;
        }
    </style>
</x-app-layout>