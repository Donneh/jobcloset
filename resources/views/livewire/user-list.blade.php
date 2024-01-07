<div>

    <x-main-card-header title="Users" />

    <p>Persistent user invite link: {{ url('/register/'.auth()->user()->tenant->registration_token) }}
    </p>

    <div class="mt-6">
        {{ $this->table }}
    </div>
</div>
