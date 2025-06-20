<x-app-layout>
    <x-slot name="header">
        @include('layouts.navigation')
    </x-slot>

    <section class="bg-white">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
                <h1 class="mb-5">{{ __('task-status.create-status') }}</h1>
                {!! html()->form('POST', route('task_statuses.store'))->open() !!}
                    @csrf
                    @include('task_statuses.form')
                    <div class="mt-2">
                        <x-primary-submit-button>{{__('Create') }}</x-primary-submit-button>
                    </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </section>
</x-app-layout>