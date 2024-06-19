<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Account Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-table>
                <x-slot name="header">
                    <x-table-header scope="col">
                        Account name
                    </x-table-header>
                    <x-table-header scope="col">
                        Debit
                    </x-table-header>
                    <x-table-header scope="col">
                        Credit
                    </x-table-header>
                    <x-table-header scope="col">
                        Balance
                    </x-table-header>
                </x-slot>
                @foreach ($accounts as $account)
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <x-table-header scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('account.show', $account->id)}}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{$account->name}}</a>
                    </x-table-header>
                    <x-table-column class="text-red-600">
                        {{ Illuminate\Support\Number::currency($account->debit, $account->currency)}}
                    </x-table-column>
                    <x-table-column class="text-green-600">
                        {{ Illuminate\Support\Number::currency($account->credit, $account->currency)}}
                    </x-table-column>
                    <x-table-column>
                        {{ Illuminate\Support\Number::currency($account->balance, $account->currency)}}
                    </x-table-column>
                    
                </tr>
                @endforeach
            </x-table>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800 ">
                    <div class="max-w-xl">
                        @include('account.partials.create-account-form')
                    </div>
                </div>

                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                    <div class="max-w-xl">
                        @include('account.partials.transfer-account-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>