@extends('layout.main')

@section('content')
<div class="flex flex-col lg:flex-row px-6 lg:px-24 pt-12">
    <!-- Left Section: Referents -->
    <div class="w-full lg:w-2/3 p-6 bg-white">
        <div class="mx-auto my-3">
            <a href="{{ url()->previous() }}" class="text-[20px] font-light text-[#A0A0A0] text-left">
                &larr; Torna indietro
            </a>
            <div class="mt-8">
                @livewire('crm.referents', ['client' => $client])
            </div>
        </div>
    </div>

    <!-- Right Section: Client Info -->
    <div class="w-full lg:w-1/3 p-6 bg-white">
        <div class="mx-auto mt-8 lg:mt-16 bg-white border-2 border-dotted border-[#10BDD4] rounded-sm">
            <!-- Client Logo -->
            <div class="flex justify-center items-center border-b border-[#10BDD4] bg-[#F5FCFD] h-20">
                <img src="{{ asset($client->logo_path) }}" alt="Client Logo"
                     class="w-24 h-24 object-cover rounded-full border-2 border-dotted border-[#10BDD4] mt-16 ml-[65%]">
            </div>

            <!-- Client Details -->
            <div class="mt-10 p-6">
                <h2 class="text-2xl font-bold text-left">{{ $client->company_name }}</h2>

                @php
                    $details = [
                        'Tipo cliente'           => $client->tax_code,
                        'Codice fiscale'         => $client->tax_code,
                        'Partita IVA'            => $client->tax_code,
                        'SDI'                    => $client->sdi,
                        'Indirizzo'              => $client->address . ', ' . $client->city,
                        'Sito'                   => "<a href='{$client->site}' class='underline hover:text-gray-200'>{$client->site}</a>",
                        'E-mail'                 => $client->email,
                        'PEC'                    => $client->pec,
                        'Telefono'               => $client->first_telephone,
                        'Sede di riferimento'    => $client->registered_office_address,
                        'Creato da'              => $client->name_user_creation,
                        'Data creazione'         => \Carbon\Carbon::parse($client->created_at)->format('d/m/Y'),
                    ];
                @endphp

                @foreach($details as $label => $value)
                    <p class="flex flex-col sm:flex-row justify-between mt-4 text-[15px] font-semibold text-[#A0A0A0]">
                        <span class="text-[#B0B0B0]">{{ $label }}:</span>
                        <span>{!! $value !!}</span>
                    </p>
                @endforeach

                <!-- Labels -->
                <p class="flex flex-col sm:flex-row justify-between mt-4 text-[15px] font-semibold text-[#A0A0A0]">
                    <span class="text-[#B0B0B0]">Etichette:</span>
                    <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border
                        @if($client->status == 0)
                            bg-[#FEF7EF] text-[#F5AD65] border-[#F5AD65]
                        @else
                            bg-[#E3F1F4] text-[#2A8397] border-[#2A8397]
                        @endif">
                        {{ $client->status == 0 ? 'Call center' : 'Censimento' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection