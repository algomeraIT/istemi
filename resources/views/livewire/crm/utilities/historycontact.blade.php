@php

    $typeIcon = ['note' => 'document', 'attività' => 'rectangle-stack', 'e-mail' => 'envelope'];
    $typeColor = ['note' => 'text-blue-600', 'attività' => 'text-green-600'];
@endphp

<div class="relative overflow-auto h-[500px] mt-16">
    {{-- vertical line --}}
    <div class="absolute left-5 top-0 bottom-0 w-px bg-gray-200"></div>

    <ul class="space-y-8">
        @foreach ($histories as $item)
            <li class="relative flex items-start">
                {{-- Icon badge --}}
                <div class="absolute left-0">
                    <div class="bg-white block border border-gray-200 rounded-full p-1">

                        <flux:icon.document class="w-8 h-8 {{ $typeColor[$item['type']] ?? 'text-gray-600' }}" />

                    </div>

                </div>

                {{-- Content --}}
                <div class="ml-14 w-full">
                    {{ $item['created_at'] }}
                    <div class="border p-8 mt-14 h-32">
                        <p class="font-semibold text-gray-800">
                            {{ $item['name'] }} {{ $item['last_name'] }}
                            <span class="ml-2 text-sm text-gray-500 capitalize">({{ $item['role'] }})</span>
                        </p>
                        <p class="mt-1 text-gray-600">
                            {{ $item['action'] }} : {{ $item['note'] ?? '—' }}
                        </p>
                    
                    </div>

                </div>
            </li>
        @endforeach
    </ul>
</div>
