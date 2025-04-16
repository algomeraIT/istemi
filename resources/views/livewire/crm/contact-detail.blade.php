@extends('layout.main')

@section('content')
    <div class="flex flex-col lg:flex-row px-6 lg:px-24 pt-12">
        <!-- Left: Referents -->
        <div class="w-full lg:w-2/3 p-6">
            <a href="{{ url()->previous() }}" class="block mb-6 text-lg font-light text-gray-400">
                &larr; Torna indietro
            </a>
            <div class="bg-white p-6 rounded shadow">
                @livewire('crm.contact-sub', ['client' => $client])
            </div>
        </div>

        <!-- Right: Client Summary -->
        <div class="w-full lg:w-1/3 p-6">
            <div class="mx-auto bg-white border-2 border-dotted border-cyan-300 rounded p-6">

                <!-- Details -->
                <h2 class="mt-4 text-2xl font-bold flex mr-4">
                    <flux:icon.briefcase />{{ $client->company_name }}
                </h2>

                @php
                    $fields = [
                        'E-mail' => $client->email,
                        'Telefono' => $client->first_telephone,
                        'Servizio' => $client->service,
                        'Data acquisizione' => \Carbon\Carbon::parse($client->created_at)->format('d/m/Y'),
                        'Commerciale' => $client->tax_code,
                        'Stato' => $client->status,
                    ];
                @endphp

                <div class="mt-4 space-y-3 text-gray-500 font-inter">
                    @foreach ($fields as $label => $value)
                        <div class="flex flex-col sm:flex-row justify-between">
                            <span class="font-normal text-gray-400">{{ $label }}:</span>
                            <span class="font-semibold">{!! $value !!}</span>
                        </div>
                    @endforeach

                    <!-- Status Tag -->
                    <div class="flex flex-col sm:flex-row justify-between">
                        <span class="font-normal text-gray-400">Etichette:</span>
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold rounded-full border
            {{ $client->status == 0
                ? 'bg-[#FEF7EF] text-[#F5AD65] border-[#F5AD65]'
                : 'bg-[#E3F1F4] text-[#2A8397] border-[#2A8397]' }}">
                            {{ $client->status == 0 ? 'Call center' : 'Censimento' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text)
                .then(() => alert(`Copiato: ${text}`))
                .catch(console.error);
        }
    </script>
@endsection
