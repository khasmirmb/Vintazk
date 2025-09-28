<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Average
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($top_teams as $team)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ $team->name }}</div>
                            <div class="font-normal text-gray-500">{{ $team->team }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        {{ number_format($team->avg_performance_rating, 2) }}%
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
