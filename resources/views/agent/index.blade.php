@include('partials.header')

<div class="antialiased bg-gray-200 dark:bg-gray-900 h-screen">

    <!-- Navigation -->
    @include('partials.navigation')

    <!-- Sidebar -->
    @include('partials.sidebar')

    <main class="p-4 md:ml-64 pt-20 h-cover">
        <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
                @include('agent.search')
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 shadow-xl">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Agent Name</th>
                            <th scope="col" class="px-4 py-3">Team</th>
                            <th scope="col" class="px-4 py-3">Attendance</th>
                            <th scope="col" class="px-4 py-3">KPI Performance</th>
                            <th scope="col" class="px-4 py-3">Behavior</th>
                            <th scope="col" class="px-4 py-3">IRs, Violations, PIP</th>
                            <th scope="col" class="px-4 py-3">Performance Rating</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agents as $agent)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <!-- Modal toggle -->
                                    <button data-modal-target="modal-{{ Str::slug($agent->agent_name, '-') }}" data-modal-toggle="modal-{{ Str::slug($agent->agent_name, '-') }}" class="block cursor-pointer font-bold underline text-gray-900 dark:text-white" type="button">
                                        {{ $agent->agent_name }}
                                    </button>


                                </th>
                                <td class="px-4 py-3">{{ $agent->team }}</td>
                                <td class="px-4 py-3">{{ number_format($agent->avg_attendance, 2) ?? 'N/A' }}%</td>
                                <td class="px-4 py-3">{{ number_format($agent->avg_kpi_performance, 2) ?? 'N/A' }}%</td>
                                <td class="px-4 py-3">{{ number_format($agent->avg_behavior, 2) ?? 'N/A' }}%</td>
                                <td class="px-4 py-3">{{ number_format($agent->avg_ivp, 2) ?? 'N/A' }}%</td>
                                <td class="px-4 py-3 font-semibold">
                                    {{ number_format($agent->avg_performance_rating, 2) ?? 'N/A' }}%
                                </td>
                            </tr>

                            @include('agent.modal')

                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                    No agents found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ $agents->firstItem() }}
                        -
                        {{ $agents->lastItem() }}
                    </span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ $agents->total() }}
                    </span>
                </span>

                <ul class="inline-flex items-stretch -space-x-px">
                    {{-- Previous button --}}
                    <li>
                        @if ($agents->onFirstPage())
                            <span class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-400 bg-gray-100 rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $agents->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif
                    </li>

                    {{-- Page numbers --}}
                    @for ($i = 1; $i <= $agents->lastPage(); $i++)
                        <li>
                            <a href="{{ $agents->url($i) }}"
                            class="flex items-center justify-center text-sm py-2 px-3 leading-tight border
                            {{ $i == $agents->currentPage()
                                    ? 'z-10 text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                                    : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                            }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endfor

                    {{-- Next button --}}
                    <li>
                        @if ($agents->hasMorePages())
                            <a href="{{ $agents->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4-4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <span class="flex items-center justify-center h-full py-1.5 px-3 text-gray-400 bg-gray-100 rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4-4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </li>
                </ul>
            </nav>
        </div>
    </main>

</div>

@include('partials.footer')
