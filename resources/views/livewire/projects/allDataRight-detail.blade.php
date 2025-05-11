<div class="mx-auto  bg-white border-2 border-dotted border-[#A0A0A0] rounded-sm ">


    <div class="mt-1 p-7 ">
        <div class="flex items-center justify-between">
            <div class="flex justify-baseline items-center">
                <img src="/icon/menu/progetti.svg" alt="Progetto" class="w-5 h-5 mr-2">
                <h2 class="text-2xl font-bold text-left">{{ $project->estimate }}</h2>
            </div>
            <div class="">
                <flux:button variant="primary" data-variant="primary" data-color="small"
                    icon="archive-box">
                    Archivia</flux:button>
            </div>
        </div>
        @php
            $details = [
                'Nome progetto' => $project->name_project,
                'Cliente' => $project->client_name,
                'tipo di progetto' => $project->client_type,
                'Budget allocato' => $project->total_budget,
                'Responsabile di progetto' => $project->responsible,
                'Responsabile di area' => $project->chief_area,
                'Data inizio' => \Carbon\Carbon::parse($project->start_at)->format('d/m/Y'),
                'Data fine' => \Carbon\Carbon::parse($project->end_at)->format('d/m/Y'),
            ];
        @endphp

        @foreach ($details as $label => $value)
            <p class="flex flex-col mt-4 text-[15px] font-semibold text-[#A0A0A0]">
                <span
                    class="@if ($label === 'Data fine') text-[#28A745] @else text-[#B0B0B0] @endif font-light pb-1">{{ $label }}:</span>
                <span>{!! $value !!}</span>
                @if ($label === 'Responsabile di progetto')
                    <flux:separator />
                @endif
            </p>
        @endforeach


    </div>
</div>