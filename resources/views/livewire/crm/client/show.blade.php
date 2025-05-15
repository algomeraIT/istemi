<div class="h-full bg-white p-10 pb-4 shadow">
    @include('livewire.general.goback')

    @if ($this->client->status == 'cliente')
        @include('livewire.crm.client.partials.client-detail')
    @endif

    @if ($this->client->status == 'contatto')
        @include('livewire.crm.client.partials.contact-detail')
    @endif
</div>
