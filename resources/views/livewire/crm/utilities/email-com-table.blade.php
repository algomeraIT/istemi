@if (empty($email_communications) || count($email_communications) === 0)
<p class="text-gray-500">Nessuna Email per questo cliente</p>
@else

<ul class="border pt-4 mb-5">
    <flux:badge variant="pill" icon="paper-airplane"
        class="bg-[#E2EDF7]! text-[#1078D4! rounded-0!  pl-8 pr-8  rounded-none!">E-mail
    </flux:badge>
    @foreach ($email_communications as $email)
        <li class=" m-3.5 mb-6">
            <div>
                <div class="m-2">
                    <div class="flex">
                        @if (isset(Auth::user()->profile_photo))
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="User"
                                class="w-8 h-8 rounded-full">
                        @else
                            <img alt="utente" src="{{ asset('icon/navbar/user.svg') }}" />
                        @endif

                        @foreach ($activity_communications as $activity)
                        @include("livewire.crm.utilities.name-lastname-role-createdat", ['activity' => $activity])
                        @endforeach

                    </div>
                </div>
                <div class="flex">
                    <div class="m-4">
                        <p>Mittente:</p>
                        <p>{{ $email->sender }}</p>
                    </div>
                    <div class="m-4">
                        <p>Destinatario:</p>
                        @foreach (explode(',', $email->receiver) as $recipient)
                            <p>{{ trim($recipient) }}</p>
                        @endforeach
                    </div>

    
                </div>
                <div class="m-4 flex">
                    <p>Oggetto:</p>
                    <p>Fare modifica su DB</p>

                </div>
                <div class="m-4">
                    <p>{{ $email->note }}</p>

                </div>
            </div>
        </li>
    @endforeach
</ul>
</div>
@endif