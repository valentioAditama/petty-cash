<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Buat Akun Baru') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("pembuatan akun baru di aplikasi petty cash.") }}
        </p>
    </header>

    <form method="post" action="{{ route('account.store') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-md "  :value="old('name')" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="debit" :value="__('Pembukaan Saldo')" />
            <x-text-input id="debit" name="debit" type="number"  step="any" min="0.00" class="mt-1 block w-full rounded-md "  :value="old('credit')" required />
            <x-input-error class="mt-2" :messages="$errors->get('credit')" />
        </div>

        <div>
            <x-input-label for="currency" :value="__('Mata Uang')" />
            <x-select-input id="currency" name="currency" class="mt-1 block w-full rounded-md"  :value="old('currency')" required>
                @foreach ($currencies as $currency)
                    <option>{{$currency->symbol}}</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('currency')" />

        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
