@include('partials.header')

<div class="antialiased bg-gray-50 dark:bg-gray-900 h-screen">

    <!-- Navigation -->
    @include('partials.navigation')

    <!-- Sidebar -->
    @include('partials.sidebar')

        <main class="p-4 md:ml-64 pt-20 h-screen">
            <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="border-2 border-gray-300 rounded-lg dark:border-gray-600">
                        @include('cards.first')
                    </div>
                    <div class="border-2 border-gray-300 rounded-lg dark:border-gray-600">
                        @include('cards.second')
                    </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4 2xl:grid-cols-3">
                <div class="2xl:col-span-2 rounded-xl bg-gradient-to-br from-primary-900 to-gray-200 dark:from-gray-800 dark:to-gray-900 shadow-lg hover:shadow-xl transition-shadow duration-300 p-6">
                    @include('charts.agentmonthly')
                </div>
                <div class="relative border-2 rounded-lg border-gray-300 dark:border-gray-600 p-2">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white p-3">Top Agent Performance Rating</h2>
                    @include('charts.topagent')
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4 2xl:grid-cols-3">
                <div class="2xl:col-span-2 rounded-xl bg-gradient-to-br from-primary-800 to-gray-200 dark:from-gray-800 dark:to-gray-900 shadow-lg hover:shadow-xl transition-shadow duration-300 p-6">
                    @include('charts.teammonthly')
                </div>
                <div class="relative border-2 rounded-lg border-gray-300 dark:border-gray-600 p-2">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white p-3">Top Team Performance Rating</h2>
                    @include('charts.topteams')
                </div>
            </div>

            <div class="rounded-xl bg-gradient-to-br from-blue-200 to-gray-200 dark:from-gray-800 dark:to-gray-900 shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 mb-4">
                @include('charts.agentcomparison')
            </div>

            <div class="rounded-xl bg-gradient-to-br from-blue-600 to-gray-200 dark:from-gray-800 dark:to-gray-900 shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 mb-4">
                @include('charts.teamcomparison')
            </div>
        </main>
</div>

@include('partials.footer')
