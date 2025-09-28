<aside
  id="drawer-navigation"
  aria-label="Sidenav"
  class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform
         -translate-x-full bg-white border-r border-gray-300
         md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
>
  <div class="overflow-y-auto h-full bg-white dark:bg-gray-800 py-5 px-3">
    <ul class="space-y-2">
        <li>
            <a
            href="/"
            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group"
            >
            <svg
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
                class="w-6 h-6 text-primary-900 transition duration-75 dark:text-gray-50 group-hover:text-primary-800 dark:group-hover:text-primary-800"
            >
                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
            </svg>
            <span class="ml-3 font-bold">Overview</span>
            </a>
        </li>
        <li>
            <a
            href="{{ route('agent') }}"
            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group"
            >
                <svg class="w-6 h-6 text-primary-900 transition duration-75 dark:text-gray-50 group-hover:text-primary-800 dark:group-hover:text-primary-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                </svg>
                <span class="ml-3 font-bold">Agents</span>
            </a>
        </li>
        <li>
            <a
              href="{{ route('team') }}"
              class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700 group"
            >
                <svg class="w-6 h-6 text-primary-900 transition duration-75 dark:text-gray-50 group-hover:text-primary-800 dark:group-hover:text-primary-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                </svg>
                <span class="ml-3 font-bold">Teams</span>
            </a>
        </li>
    </ul>
  </div>
</aside>
