
<?php

use App\Models\User;
use App\Models\Profile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public User $user;
    public string $first_name = '';
    public string $last_name = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);

        $validated["user_id"] = $this->user->id;

        Profile::create($validated);

        Auth::login($this->user);

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- First name -->
        <div>
            <x-form.label for="name" :value="__('First name')" />
            <x-form.input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" required
                autofocus autocomplete="first_name" />
            <x-form.input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>


        <!-- Last name -->
        <div>
            <x-form.label for="last_name" :value="__('Last name')" />
            <x-form.input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required
                autofocus autocomplete="last_name" />
            <x-form.input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
