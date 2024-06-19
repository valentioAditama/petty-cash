<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Transfer Between Accounts') }}
        </h2>
    </header>

    <form method="post" action="{{ route('account.transfer') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="from_account" :value="__('From Account')" />
            <x-select-input id="from_account" name="from_account" class="mt-1 block w-full rounded-lg"
                required>
                @foreach ($accounts as $account)
                <option value="{{$account->id}}"
                    @if (old('from_account') == $account->id)
                        selected
                    @endif
                    >{{$account->name}} ({{ $account->currency }} )</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('from_account')" />
        </div>

        <div>
            <x-input-label for="to_account" :value="__('To Account')" />
            <x-select-input id="to_account" name="to_account" class="mt-1 block w-full rounded-lg"
                required>
                @foreach ($accounts as $account)
                <option value="{{$account->id}}"
                    @if (old('to_account') == $account->id)
                        selected
                    @endif
                    >{{$account->name}} ({{ $account->currency }} )</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('to_account')" />
        </div>

        <div>
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input id="amount" name="amount" type="number" step="any" min="0.00" class="mt-1 block w-full rounded-md "
                :value="old('amount')" required />
            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        </div>

        <div>
            <x-input-label for="rate" :value="__('Exchange Rate (Optional)')" />
            <x-text-input id="rate" name="rate" type="number" step="any" min="0.00" class="mt-1 block w-full rounded-md "
                :value="old('rate')" />
            <x-input-error class="mt-2" :messages="$errors->get('rate')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Transfer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>