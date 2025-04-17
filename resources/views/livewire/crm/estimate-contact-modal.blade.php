<div
  x-data="{ open: @entangle('isEstimateModalOpen') }"
  x-show="open"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
>
  <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl">
    <h3 class="text-xl font-bold mb-4">
      Nuovo Preventivo
    </h3>

    <form wire:submit.prevent="storeEstimate">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- client_id is fixed (this page) -->
        <input type="hidden" wire:model="client_id" value="{{ $client->id }}"/>

        <!-- referent_id -->
        <div>
          <label class="block text-sm font-medium">Referente</label>
          <select wire:model="referent_id" class="w-full border p-2 rounded @error('referent_id') border-red-500 @enderror">
            <option value="">Seleziona</option>
            @foreach($client->referents as $r)
              <option value="{{ $r->id }}">{{ $r->name }} {{ $r->last_name }}</option>
            @endforeach
          </select>
          @error('referent_id') <span class="text-red-600">{{ $message }}</span>@enderror
        </div>

        <!-- address_invoice, city, cap, country -->
        <div><label class="block">Indirizzo</label><input wire:model="address_invoice" class="w-full border p-2 rounded"/></div>
        <div><label class="block">Città</label><input wire:model="city" class="w-full border p-2 rounded"/></div>
        <div><label class="block">CAP</label><input wire:model="cap" class="w-full border p-2 rounded"/></div>
        <div><label class="block">Paese</label><input wire:model="country" class="w-full border p-2 rounded"/></div>

        <!-- has_same_address -->
        <div class="sm:col-span-2 flex items-center">
          <input type="checkbox" wire:model="has_same_address_for_delivery" id="same_addr" class="mr-2"/>
          <label for="same_addr">Stesso indirizzo per consegna</label>
        </div>

        <!-- price_list, expiration, term_pay, method_pay -->
        <div><label>Listino prezzi</label><input wire:model="price_list" class="w-full border p-2 rounded"/></div>
        <div><label>Scadenza</label><input type="date" wire:model="expiration" class="w-full border p-2 rounded"/></div>
        <div><label>Termini di pagamento</label><input wire:model="term_pay" class="w-full border p-2 rounded"/></div>
        <div><label>Metodo di pagamento</label><input wire:model="method_pay" class="w-full border p-2 rounded"/></div>

        <!-- title_service, service, note_service -->
        <div class="sm:col-span-2"><label>Titolo Servizio</label><input wire:model="title_service" class="w-full border p-2 rounded"/></div>
        <div class="sm:col-span-2"><label>Servizio</label><textarea wire:model="service" class="w-full border p-2 rounded"></textarea></div>
        <div class="sm:col-span-2"><label>Note</label><textarea wire:model="note_service" class="w-full border p-2 rounded"></textarea></div>

        <!-- serial_number, date_expiration, status_expiration -->
        <div><label>Serial Number</label><input wire:model="serial_number" class="w-full border p-2 rounded"/></div>
        <div><label>Data Scadenza</label><input type="date" wire:model="date_expiration" class="w-full border p-2 rounded"/></div>
        <div><label>Stato Scadenza</label><input wire:model="status_expiration" class="w-full border p-2 rounded"/></div>

        <!-- price, total, status -->
        <div><label>Prezzo</label><input type="number" wire:model="price" step="0.01" class="w-full border p-2 rounded"/></div>
        <div><label>Totale</label><input type="number" wire:model="total" step="0.01" class="w-full border p-2 rounded"/></div>
        <div class="sm:col-span-2"><label>Stato</label>
          <select wire:model="status" class="w-full border p-2 rounded">
            <option value="0">Bozza</option>
            <option value="1">Inviato</option>
            <option value="2">Approvato</option>
          </select>
        </div>
      </div>

      <div class="mt-6 flex justify-end space-x-3">
        <button type="button" wire:click="closeEstimateModal" class="px-4 py-2 bg-gray-200 rounded">Annulla</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Salva</button>
      </div>
    </form>
  </div>
</div>