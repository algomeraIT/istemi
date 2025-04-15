<div class="flex flex-col items-start ml-[20px]">
    <span
        class="text-lg leading-[21px] font-normal text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
        {{ $activity->name . ' ' . $activity->last_name . ' - ' . $activity->role }}
    </span>
    <span
        class="text-[17px] leading-[20px] font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
        {{ Auth::user()->role }}</span>
    <span
        class="font-extralight">{{ \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y') }}</span>
</div>