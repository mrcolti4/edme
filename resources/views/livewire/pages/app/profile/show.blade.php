<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use App\Models\Profile;

new #[Layout('layouts.app')] #[Title('My profile')] class extends Component {
    public User $user;
    public Profile $profile;

    public function mount()
    {
        $this->user = Auth::user();
        $this->profile = Profile::where("user_id", auth()->user()->id)->first();
    }
}; ?>

<section>
    <x-container>
        <aside>
            <header>
                <img src="{{$this->profile->avatar}}" alt="{{$this->profile->first_name . ' ' . $this->profile->last_name}}"/>
                <div>
                    <h3></h3>
                    <p></p>
                </div>
            </header>
        </aside>
    </x-container>
</section>
