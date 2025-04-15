@if (empty($activity_communications) || count($activity_communications) === 0)
<p class="text-gray-500">Nessuna Attività per questo cliente</p>
@else
<div class=" h-3/6 overflow-scroll">

    <ul class="border pt-4 mb-5">
        <flux:badge variant="pill" icon="calendar"
            class="bg-[#F9EDF1]! text-[#E873A0]! rounded-0  pl-8 pr-8  rounded-none!">Attività
        </flux:badge>
        @foreach ($activity_communications as $activity)
            <li class=" m-3.5 mb-6">
                <div>
                    <div class="flex">
                        @if (isset(Auth::user()->profile_photo))
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="User"
                                class="w-8 h-8 rounded-full">
                        @else
                            <img alt="utente" src="{{ asset('icon/navbar/user.svg') }}" />
                        @endif

                        <div class="flex flex-col items-start ml-[20px]">
                            <span
                                class="text-lg leading-[21px] font-normal text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                {{ $activity->name . ' ' . $activity->last_name . ' - ' . $activity->role }}
                            </span>
                            <span
                                class="text-[17px] leading-[20px] font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                                {{ Auth::user()->role }}</span>
                            <span
                                class="font-extralight">{{ $activity->created_at->diffForHumans() }}</span>
                        </div>

                    </div>
                    <div class="flex ml-5">
                        <div class="m-4 flex">
                            <p class="font-extralight">Assegnato a:</p>
                            <img class=" w-5 h-5"
                                src="{{ $activity->user->image_path ? asset($activity->user->image_path) : asset('icon/navbar/user.svg') }}"
                                class="rounded-full h-10 w-10 object-cover" />
                        </div>
                        <div class="m-4 flex">
                            <p class="font-extralight">Conoscenza:</p>
                            <img class="w-5 h-5"
                                title=" {{ $activity->name . ' ' . $activity->last_name }}"
                                src="{{ $activity->user->image_path ? asset($activity->user->image_path) : asset('icon/navbar/user.svg') }}"
                                class="rounded-full h-10 w-10 object-cover" />
                        </div>

                        <div class="m-4 flex">
                            <p class="font-extralight">Scadenza:</p>
                            <p class="text-[#28A745]">
                                {{ \Carbon\Carbon::parse($activity->expire_at)->format('d/m/Y') }}
                            </p>
                        </div>
                        <div class="m-4 flex">
                            <p> <span
                                    class="px-2 py-1  font-semibold rounded-[15px] border border-solid 
                            @if ($activity->to_do == 'Fatta') bg-[#EFF9F3] text-[#65C587]
                                border-[#65C587] @elseif($activity->to_do == 'Da Terminare')
                                bg-[] text-[#65C587] border-[#E63946]
                                @elseif($activity->to_do == 'In sospeso')
                                bg-cyan-100 text-[#0C7BFF] border-[#65C587]
                                @else
                                bg-gray-100 text-gray-600 border-gray-600 @endif">
                                    @if ($activity->to_do == 'Fatta')
                                        Fatta
                                    @elseif($activity->to_do == 'Da Terminare')
                                        Da terminare
                                    @elseif($activity->to_do == 'In sospeso')
                                        In sospeso
                                    @else
                                        ---
                                    @endif
                                </span></p>
                        </div>
                    </div>
                    <div class="flex ml-8">
                        <p class="font-extralight">Titolo:</p>
                        <p>{{ $activity->activities }}</p>

                    </div>
                    <div class="mt-4">
                        @include('livewire.crm.utilities.detail-button', [
                            'functionName' => 'showActivity',
                            'id' => $activity->id,
                        ])


                        @include('livewire.crm.utilities.edit-button', [
                            'functionName' => 'edit',
                            'id' => $activity->id,
                        ])

                        @include('livewire.crm.utilities.delete-button', [
                            'functionName' => 'delete',
                            'id' => $activity->id,
                        ])

                    </div>
                </div>
            </li>
        @endforeach
    </ul>

@endif
