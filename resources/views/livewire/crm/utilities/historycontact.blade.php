@php
    $typeIcon = ['note' => 'document', 'attività' => 'rectangle-stack', 'e-mail' => 'envelope'];
    $typeColor = ['note' => '[#B0B0B0]', 'attività' => '[#B0B0B0]', 'e-mail' => '[#FFC107]'];
@endphp

<div class="relative overflow-auto h-[600px]">
    <ul class="">
        @foreach ($histories as $item)
            <li class="relative flex items-start">
                {{-- Icon badge --}}
                <div class="absolute left-1 bg-white">
                    <div
                        class="w-8 h-8 flex items-center justify-center border {{ 'border-' . $typeColor[$item['type']] }} rounded-full">
                        @switch($item['type'])
                            @case('note')
                                <flux:icon.document class="size-4 {{ 'text-' . $typeColor[$item['type']] }}" />
                            @break

                            @case('attività')
                                <flux:icon.rectangle-stack class="size-4 {{ 'text-' . $typeColor[$item['type']] }}" />
                            @break

                            @case('e-mail')
                                <flux:icon.envelope class="size-4 {{ 'text-' . $typeColor[$item['type']] }}" />
                            @break

                            @default
                                <flux:icon.document class="size-4 {{ 'text-' . $typeColor[$item['type']] }}" />
                        @endswitch
                    </div>
                </div>

                {{-- vertical line --}}
                <div class="absolute left-5 top-8 bottom-0 w-px bg-[#DBDBDB]"></div>

                {{-- Content --}}
                <div class="ml-12 mb-8 w-full pt-1">
                    <span class="text-[#B0B0B0]">{{ dateItFormat($item['created_at']) }}</span>

                    <div class="border rounded p-5 mt-5">
                        <flux:badge size="sm" data-step="{{ $item->client->step }}" class="mb-2">
                            {{ ucfirst($item->client->step) }}</flux:badge>

                        <div>
                            <span class="font-medium text-[#232323]">{{ $item->user->full_name }}</span>
                            <span class="ml-2 text-sm text-[#B0B0B0] font-normal capitalize">-
                                {{ $item->role }}</span>
                        </div>

                        @if ($item->type == 'e-mail')
                            <p class="mt-1 mb-4 text-xs font-light italic text-gray-600">
                                ha inviato una mail
                            </p>
                        @endif

                        @if ($item->note)
                            <p class="mt-1 mb-4 text-xs font-light italic text-gray-600">
                                {{ $item->note }}
                            </p>
                        @endif

                        @if (in_array($item->type, ['note', 'e-mail']))
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
