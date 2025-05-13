<div>
    @if ($this->client->status == 'cliente')
        @include('livewire.crm.client.partials.client-detail')
    @endif

    @if ($this->client->status == 'contatto')
        @include('livewire.crm.client.partials.contact-detail')
    @endif
</div>
