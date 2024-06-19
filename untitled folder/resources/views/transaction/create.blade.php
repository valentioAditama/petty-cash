<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add New Transaction') }}
        </h2>
    </header>
    <form method="post" action="{{ route('transaction.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="account" :value="__('Account')" />
            <input type="hidden" name="account" value="{{$account->id}}" />
            <x-text-input id="account" type="text" class="mt-1 block w-full rounded-md " disabled
                value="{{$account->name}} ({{ $account->currency }} )" />
        </div>

        <div>
            <x-input-label for="date" :value="__('Transaction Date Time')" />
            <x-text-input id="date" name="date" type="date"
                class="mt-1 block w-full rounded-md dark:text-white " :value="old('date')"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('date')" />
        </div>

        <div>
            <x-input-label for="amount" :value="__('Amount')" />
            <div class="flex">
                <x-text-input id="amount" name="amount" type="number" step="any" min="0.00"
                    class="block min-w-0 w-full rounded-l-md flex-1 " :value="old('amount')"
                    required />
                <span
                    class="inline-flex items-center text-sm text-gray-900 bg-gray-200  dark:bg-gray-600 dark:text-gray-400 ">
                    <span class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-r-md">{{$account->currency}}</span>
                </span>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="message" :value="__('Note')" />
            <textarea id="message" name="note" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Leave a note...">{{old('note')}}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('note')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Transaction Type')" />
            <div class="flex items-center my-4">
                <input checked id="debit" type="radio" value="D" name="type"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="debit"
                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Debit</label>

                <div class="p-4">
                    <input id="credit" type="radio" value="C" name="type"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="credit"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Credit</label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'transaction-created')
            <p x-data="{ show: true }" x-show="show" x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Transaction Created.') }}
            </p>
            @endif
        </div>
    </form>
</section>