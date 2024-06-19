<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Currency') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl text-white">
                    <x-table>
                        <x-slot name="header">
                            <x-table-column>Name</x-table-column>
                            <x-table-column>Symbol</x-table-column>
                            {{-- <x-table-column>Action</x-table-column> --}}
                        </x-slot>
                        @foreach ($currencies as $currency)
                        <tr>
                            <x-table-column>{{$currency->name}}</x-table-column>
                            <x-table-column>{{$currency->symbol}}</x-table-column>
                            {{-- <x-table-column></x-table-column> --}}
                        </tr>
                        @endforeach
                    </x-table>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('currency.partials.create-currency-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>