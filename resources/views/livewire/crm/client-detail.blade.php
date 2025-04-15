@extends('layout.main')

@section('content')



        <div class="lg:xl:flex md:block sm:block pl-24 pr-24 pt-12">
            
            <div class="flex xl:lg:w-2/3 md:sm:w-full p-6 bg-white">
                <div class="w-full mx-auto m-3" >
                    <a class="text-[20px] font-light text-[#A0A0A0] text-left opacity-100 font-inter"
                    href=" {{url()->previous()}}" >
                    <- Torna indietro </a>
                    <!-- Tab Content -->
                    <div class="mt-8">
                        @livewire('crm.referents', ['client' => $client])
                    </div>
                </div>
            </div>


            <div class="flex xl:lg:w-1/3 md:sm:w-full p-6 bg-white">
                <div class=" w-md  bg-white border-2 border-dotted border-[#10BDD4] rounded-[2px] opacity-100 mt-16">
                    <!-- Client Logo -->
                    <div
                        class="flex justify-center border-b border-t-0 border-l-0 border-r-0 border-2 h-[70px] border-dotted border-[#10BDD4] bg-[#F5FCFD]">
                        <img src="{{ asset($client->logo_path) }}" alt="Client Logo"
                            class="w-24 h-24 ml-52 mt-5 object-cover rounded-full border-2 border-dotted border-[#10BDD4]">
                    </div>

                    <!-- Client Details -->
                    <div class=" mt-10 p-10">
                        <h2 class="text-2xl font-bold text-left">{{ $client->company_name }}</h2>

                        <div class="">
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Tipo
                                    cliente:</span> {{ $client->tax_code }}
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Codice
                                    fiscale</span> {{ $client->tax_code }}
                            </p>

                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Partita
                                    iva:</span> {{ $client->tax_code }}
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">SDI:</span>
                                {{ $client->sdi }}
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Indirizzo:</span>
                                {{ $client->address }}, {{ $client->city }},
                                <hr class="mt-[10px] mb-[10px] border-1 border-dotted border-[#10BDD4]">
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Sito:</span>
                                <a href="{{ $client->site }}" class="underline hover:text-gray-200">{{ $client->site
                                    }}</a>
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">E-mail:</span>
                                {{ $client->email }}
                                <flux:icon.document-duplicate onclick="myFunction('{{ $client->email }}')" />
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">PEC:</span>
                                {{ $client->pec }}
                                <flux:icon.document-duplicate onclick="myFunction('{{ $client->pec }}')" />
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Telefono:</span>
                                {{ $client->first_telephone }}
                                <flux:icon.document-duplicate onclick="myFunction('{{ $client->first_telephone }}')" />
                            </p>

                            <hr class="mt-[10px] mb-[10px] border-1 border-dotted border-[#10BDD4]">

                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Sede
                                    di riferimento:</span>
                                {{ $client->registered_office_address }}
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Creato
                                    da:</span>
                                {{ $client->name_user_creation }}
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Data
                                    creazione:</span> {{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}
                            </p>
                            <p
                                class="flex flex-nowrap flex-row justify-between mt-[15px] text-[15px] leading-[19px] font-semibold text-[#A0A0A0] text-right tracking-[0px] opacity-100 font-inter">
                                <span
                                    class="text-[15px] leading-[19px] font-normal text-[#B0B0B0] text-left tracking-[0px] opacity-100 font-inter">Etichette:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-[15px] border border-solid 
                                    @if($client->status == 0)
                                        bg-[#FEF7EF] text-[#F5AD65] border-[#F5AD65]
                                    @else
                                        bg-[#E3F1F4] text-[#2A8397] border-[#2A8397]
                                    @endif">
                                    @if($client->status == 0)
                                    Call center
                                    @else
                                    Censimento
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function myFunction(text) {
                        var textArea = document.createElement('textarea');
                        textArea.value = text;
                        document.body.appendChild(textArea);
                        textArea.select();
                        textArea.setSelectionRange(0, 99999); // For mobile devices
                        document.execCommand('copy');
                        document.body.removeChild(textArea);
                
                        alert("Copiato: " + text);
                    }
            </script>
            @endsection