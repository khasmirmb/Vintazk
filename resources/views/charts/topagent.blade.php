<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Position
                </th>
                <th scope="col" class="px-6 py-3">
                    Average
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($top_agents as $agent)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $agent->agent_name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $agent->team }}
                    </td>
                    <td class="px-6 py-4">
                        {{ number_format($agent->avg_performance_rating, 2) }}%
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
