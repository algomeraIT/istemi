@php
    $typeColor = ['client' => '[#B0B0B0]', 'note' => '[#B0B0B0]', 'activity' => '[#B0B0B0]', 'email' => '[#FFC107]'];
@endphp

<div class="relative overflow-auto h-[600px]">
    <ul class="">
        @foreach ($histories as $history)
            <li class="relative flex items-start">
                {{-- Icon --}}
                <div class="absolute left-1 bg-white">
                    <div
                        class="w-8 h-8 flex items-center justify-center border {{ 'border-' . $typeColor[$history->type] }} rounded-full">
                        @switch($history->type)
                            @case('client')
                                <flux:icon.arrow-path class="size-4 {{ 'text-' . $typeColor[$history->type] }}" />
                            @break

                            @case('note')
                                <flux:icon.document class="size-4 {{ 'text-' . $typeColor[$history->type] }}" />
                            @break

                            @case('activity')
                                <flux:icon.rectangle-stack class="size-4 {{ 'text-' . $typeColor[$history->type] }}" />
                            @break

                            @case('email')
                                <flux:icon.envelope class="size-4 {{ 'text-' . $typeColor[$history->type] }}" />
                            @break

                            @default
                                <flux:icon.document class="size-4 {{ 'text-' . $typeColor[$history->type] }}" />
                        @endswitch
                    </div>
                </div>

                {{-- vertical line --}}
                <div class="absolute left-5 top-8 bottom-0 w-px bg-[#DBDBDB]"></div>

                {{-- Content --}}
                <div class="ml-12 mb-8 w-full pt-1">
                    <span class="text-[#B0B0B0]">{{ dateItFormat($history['created_at']) }}</span>

                    <div class="border rounded p-5 mt-5">
                        <flux:badge size="sm" data-step="{{ $history->status_client }}" class="mb-2">
                            {{ ucfirst($history->status_client) }}</flux:badge>

                        <div>
                            <span class="font-medium text-[#232323]">{{ $history->model->user?->full_name }}</span>
                            <span class="ml-2 text-sm text-[#B0B0B0] font-normal capitalize">-
                                {{ $history->model->user?->role_name }}</span>
                        </div>

                        @if ($history->type == 'client')
                            @if ($history->action == 'create')
                                <p class="mt-1 mb-4 text-xs font-light italic text-gray-600">
                                    Nuovo Utente inserito
                                </p>
                            @endif
                            @if ($history->action == 'update')
                                <p class="mt-1 mb-4 text-xs font-light italic text-gray-600">
                                    Utente aggiornato
                                </p>
                            @endif
                        @endif

                        @if ($history->type == 'email')
                            <p class="mt-1 mb-4 text-xs font-light italic text-gray-600">
                                ha inviato una mail
                            </p>
                        @endif

                        @if ($history->type == 'note')
                            <p class="mt-1 mb-4 text-xs font-light italic text-gray-600">
                                {{ $history->model->content }}
                            </p>
                        @endif

                        @if (in_array($history->type, ['note', 'email']))
                            <flux:button variant="ghost" icon:trailing="arrow-right" data-color="teal">
                                Leggi
                            </flux:button>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
