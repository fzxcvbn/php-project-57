<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <section class="bg-white">
        <div class="max-w-screen-xl px-4 pt-28 pb-8 mx-auto lg:pb-16">
            @include('flash::message')
            <div class="grid col-span-full">
                <h1 class="mb-5">{{ __('Tasks') }}</h1>

                <div class="w-full flex items-center">
                    <div>
                        <form method="GET" action="{{ route('tasks.index') }}">
                            <div class="flex">
                                <div>
                                    {!! html()->select('filter[status_id]', $taskStatuses->prepend(__('Status'), null))->value(request()->input('filter.status_id'))->class('rounded border-gray-300')!!}
                                </div>
                                <div>
                                    {!! html()->select('filter[created_by_id]', $users->prepend(__('Author'), null))->value(request()->input('filter.created_by_id'))->class('rounded border-gray-300 ml-2')!!}
                                </div>
                                <div>
                                    {!! html()->select('filter[assigned_to_id]', $users->prepend(__('Executor'), null), request()->input('filter.assigned_to_id'))->class('rounded border-gray-300 ml-2')!!}
                                </div>
                                <div>
                                    <x-primary-submit-button class="ml-2">{{__('Apply') }}</x-primary-submit-button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @can('create', \App\Models\Task::class)
                        <div class="ml-auto">
                            <x-primary-hyperlink-button :href="route('tasks.create')">
                                {{ __('task.create-task') }}
                            </x-primary-hyperlink-button>
                        </div>
                    @endcan
                </div>

                <table class="mt-4">
                    <thead class="border-b-2 border-solid border-black text-left">
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Author') }}</th>
                        <th>{{ __('Executor') }}</th>
                        <th>{{ __('Date of creation') }}</th>
                        @canany(['update', 'delete'], new \App\Models\Task())
                            <th>{{ __('Actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->status->name }}</td>
                            <td><a class="text-blue-600 hover:text-blue-900"
                                   href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                            <td>{{ $task->creator->name }}</td>
                            <td>{{ $task->executor->name ?? '' }}</td>
                            <td>{{ $task->created_at->format('d.m.Y') }}</td>
                            @canany(['update', 'delete'], $task)
                                <td>
                                @can('delete', $task)
                                        <a class="text-red-600 hover:text-red-900" 
                                        href="#" 
                                        onclick="if(confirm('{{ __('Are you sure?') }}')) { 
                                            event.preventDefault(); 
                                            document.getElementById('delete-form-{{ $task->id }}').submit(); 
                                        }">
                                            {{ __('Delete') }}
                                        </a>

                                        <form id="delete-form-{{ $task->id }}" 
                                            action="{{ route('tasks.destroy', $task) }}" 
                                            method="POST" 
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endcan
                                    @can('update', $task)
                                        <a class="text-blue-600 hover:text-blue-900"
                                           href="{{ route('tasks.edit', $task) }}">
                                            {{ __('Edit') }}</a>
                                    @endcan
                                </td>
                            @endcanany
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>