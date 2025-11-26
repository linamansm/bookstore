<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Welcome, {{ auth()->user()->name }}!</h1>
            @if(auth()->user()->role === 'admin')
                 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                            <!-- Total Users Card -->
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                                <div>
                                    <h2 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Total Users</h2>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $userCount }}</p>
                                </div>
                                <div class="mt-4">
                                    <span class="text-green-500 font-semibold">All registered users</span>
                                </div>
                            </div>

                            <!-- Admins Card -->
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                                <div>
                                    <h2 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Admins</h2>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $adminCount }}</p>
                                </div>
                                <div class="mt-4">
                                    <span class="text-blue-500 font-semibold">Users with admin role</span>
                                </div>
                            </div>

                            <!-- Non-Admins Card -->
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                                <div>
                                    <h2 class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">Cients</h2>
                                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $nonAdminCount }}</p>
                                </div>
                                <div class="mt-4">
                                    <span class="text-red-500 font-semibold">Users without admin role</span>
                                </div>
                            </div>

                        </div>
            @endif
            
        </div>
    </div>
</x-app-layout>
