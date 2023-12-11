<div>
    <x-main-card-header title="Profile" />

    <div class="mt-6">
        {{ $this->userInfoList }}
    </div>

    <div class="mt-6">
        <div class="text-lg bold">
            Your orders
        </div>
        {{ $this->table }}
    </div>

</div>
