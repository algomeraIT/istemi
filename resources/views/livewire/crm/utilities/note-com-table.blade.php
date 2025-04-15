@if (empty($note_communications) || count($note_communications) === 0)
<p class="text-gray-500">Nessuna Nota per questo cliente</p>
@else

<ul class="border pt-4 mb-5">
    <flux:badge variant="pill" icon="pencil"
        class="bg-[#F3F3F3]! text-[#B0B0B0]! rounded-0!  pl-8 pr-8  rounded-none!">Nota
    </flux:badge>
    @foreach ($note_communications as $note)
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
                        <p>{{ $note->note }}</p>
                    </div>

                </div>
                <div class="mt-4">
                    @include('livewire.crm.utilities.detail-button', [
                        'functionName' => 'showNote',
                        'id' => $note->id,
                    ])

                    @include('livewire.crm.utilities.edit-button', [
                        'functionName' => 'edit',
                        'id' => $note->id,
                    ])

                    @include('livewire.crm.utilities.delete-button', [
                        'functionName' => 'delete',
                        'id' => $note->id,
                    ])

                </div>
            </div>
        </li>
    @endforeach
</ul>
@endif