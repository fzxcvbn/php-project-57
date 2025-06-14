<nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
        <a href="{{ route('home') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{__('Менеджер задач')}}</span>
        </a>

        @auth
        <div class="items-center justify-between lg:flex lg:w-auto lg:order-1">
            <ul class="flex flex-row font-medium lg:space-x-8 lg:mt-0">
                <li>
                    <a href="/tasks" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        {{ __('Задачи') }}</a>
                </li>
                <li>
                    <a href="" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        {{ __('Статусы') }}</a>
                </li>
                <li>
                    <a href="/labels" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        {{ __('Метки') }}</a>
                </li>
            </ul>
        </div>
        @endauth

        <div class="flex items-center lg:order-2">
            @guest
                <x-primary-hyperlink-button :href="route('login')">
                    {{ __('Вход')  }}
                </x-primary-hyperlink-button>
                <x-primary-hyperlink-button class="ml-2" :href="route('register')">
                    {{ __('Регистрация')  }}
                </x-primary-hyperlink-button>
            @endguest

            @auth
                <x-primary-hyperlink-button :href="route('logout')" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Выход')  }}
                </x-primary-hyperlink-button>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </div>
    </div>
</nav>