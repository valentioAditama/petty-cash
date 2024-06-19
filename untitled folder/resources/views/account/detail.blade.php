<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Account Detail
        </h2>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-table>
                <x-slot name="header">
                    <x-table-header scope="col">
                        Account Name
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
                <tr class="bg-white dark:bg-gray-800">
                    <x-table-header scope="col">
                        {{$account->name}} ({{$account->currency}})
                    </x-table-header>
                    <x-table-column class="text-red-600">
                        {{ Illuminate\Support\Number::currency($account->debit, $account->currency)}}
                        </x-table-header>
                        <x-table-column class="text-green-600">
                            {{ Illuminate\Support\Number::currency($account->credit, $account->currency)}}
                            </x-table-header>
                            <x-table-header scope="col">
                                {{ Illuminate\Support\Number::currency($account->balance, $account->currency)}}
                            </x-table-header>
                </tr>
            </x-table>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="shadow">
                    <x-table>
                        <x-slot name="header">
                            <x-table-header scope="col">
                                Transaction Date
                            </x-table-header>
                            <x-table-header scope="col">
                                Debit
                            </x-table-header>
                            <x-table-header scope="col">
                                Credit
                            </x-table-header>
        
                        </x-slot>
                        @foreach ($transactions as $transaction)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <x-table-header scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$transaction->note}}<br />{{$transaction->transaction_datetime}}
                            </x-table-header>
                            <x-table-column class="text-red-600">
                                {{ Illuminate\Support\Number::currency($transaction->debit, $transaction->currency)}}
                            </x-table-column>
                            <x-table-column class="text-green-600">
                                {{ Illuminate\Support\Number::currency($transaction->credit, $transaction->currency)}}
                            </x-table-column>
                        </tr>
                        @endforeach
                    </x-table>
                    <div class="py-2">
                    {{ $transactions->links() }}
                    </div>
                </div>

                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                    <div class="max-w-xl">
                        @include('transaction.create')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>