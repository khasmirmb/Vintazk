@include('partials.header')

<div class="antialiased bg-gray-200 dark:bg-gray-900 h-screen">

    @include('partials.navigation')
    @include('partials.sidebar')

    <main class="p-4 md:ml-64 pt-20 h-cover">
        <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">

            @include('team.search')

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 shadow-xl">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3">Team</th>
                            <th scope="col" class="px-4 py-3">Attendance</th>
                            <th scope="col" class="px-4 py-3">Team KPI</th>
                            <th scope="col" class="px-4 py-3">Attrition</th>
                            <th scope="col" class="px-4 py-3">IRs, Violations, PIP</th>
                            <th scope="col" class="px-4 py-3">Performance Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teams as $team)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <!-- Modal toggle -->
                                    <button data-modal-target="modal-{{ Str::slug($team->name, '-') }}"
                                            data-modal-toggle="modal-{{ Str::slug($team->name, '-') }}"
                                            class="block cursor-pointer font-bold underline text-gray-900 dark:text-white" type="button">
                                        {{ $team->name }}
                                    </button>
                                </th>
                                <td class="px-4 py-3">{{ $team->team }}</td>
                                <td class="px-4 py-3">{{ number_format($team->avg_attendance, 2) ?? 'N/A' }}%</td>
                                <td class="px-4 py-3">{{ number_format($team->avg_kpi_performance, 2) ?? 'N/A' }}%</td>
                                <td class="px-4 py-3">{{ number_format($team->avg_behavior, 2) ?? 'N/A' }}%</td>
                                <td class="px-4 py-3">{{ number_format($team->avg_ivp, 2) ?? 'N/A' }}%</td>
                                <td class="px-4 py-3 font-semibold">
                                    {{ number_format($team->avg_performance_rating, 2) ?? 'N/A' }}%
                                </td>
                            </tr>

                            @include('team.modal')

                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                    No teams found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center p-4">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $teams->firstItem() }}-{{ $teams->lastItem() }}</span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $teams->total() }}</span>
                </span>
                {{ $teams->links() }}
            </nav>
        </div>
    </main>

</div>

@include('partials.footer')
