<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-white shadow-md border border-gray-200 overflow-y-auto h-full  pl-[95px] pr-[95px] pt-[30px] ">
        <button wire:click="closeModal"
            class="px-3 py-1.5 text-sm float-right bg-white text-[#B0B0B0]  hover:bg-gray-500 transition">
            x Annulla
        </button>

        <h2 class="text-lg font-semibold mb-3 ">{{ $lead_id ? 'Modifica Lead' : 'Crea Lead' }}</h3>
        <div class=" h-full pt-14">
            <!-- Ragione Sociale -->
            <label
                class=" text-xs   flex items-center gap-2 mb-1 text-[13px] leading-[16px] font-ultralight text-[#B0B0B0] tracking-[0px] text-left opacity-100">
                <span class="text-gray-500 text-sm">
                    <flux:icon.building-office class="w-[10px]" />
                </span> Ragione Sociale
            </label>
            <input type="text" wire:model="company_name"
                class="w-full border border-gray-200 text-sm p-2 mb-[40px] focus:outline-none " />

            <!-- Telefono -->
            <label
                class=" text-xs     flex items-center gap-2 mb-1 text-[13px] leading-[16px] font-light text-[#B0B0B0] tracking-[0px] text-left opacity-100">
                <span class="text-gray-500 text-sm">
                    <flux:icon.phone class="w-[10px]" />
                </span> Telefono
            </label>
            <input type="text" wire:model="first_telephone"
                class="w-full border border-gray-200 text-sm p-2 mb-[40px] focus:outline-none " />

            <!-- Email -->
            <label
                class=" text-xs     flex items-center gap-2 mb-1 text-[13px] leading-[16px] font-light text-[#B0B0B0] tracking-[0px] text-left opacity-100">
                <span class="text-gray-500 text-sm">
                    <flux:icon.at-symbol class="w-[10px]" />
                </span> Email
            </label>
            <input type="email" wire:model="email"
                class="w-full border border-gray-200 text-sm p-2 mb-[40px] focus:outline-none " />

            <!-- Servizio -->
            <label
                class=" text-xs     flex items-center gap-2 mb-1 text-[13px] leading-[16px] font-light text-[#B0B0B0] tracking-[0px] text-left opacity-100">
                <span class="text-gray-500 text-sm">
                    <flux:icon.briefcase class="w-[10px]" />
                </span> Servizio
            </label>
            <input type="text" wire:model="service"
                class="w-full border border-gray-200 text-sm p-2 mb-[40px] focus:outline-none " />

            <!-- Nota -->
            <div x-data x-init=" $nextTick(() => {
                            const quill = new Quill($refs.quillEditor, {
                                theme: 'snow',
                                placeholder: 'Scrivi qualcosa...',
                                modules: {
                                    toolbar: [
                                        ['bold', 'italic', 'underline'],
                                        [{ 'list': 'bullet' }],
                                        ['link', 'image']
                                    ]
                                }
                            });

                            quill.root.innerHTML = $refs.hiddenInput.value;

                            quill.on('text-change', function () {
                                $refs.hiddenInput.value = quill.root.innerHTML;
                                $refs.hiddenInput.dispatchEvent(new Event('input'));
                            });

                            Livewire.hook('message.processed', () => {
                                quill.root.innerHTML = $refs.hiddenInput.value;
                            });
                        })
                        " wire:ignore>
                <label class="text-xs flex items-center gap-2 mb-1 text-[13px] font-light text-[#B0B0B0]">
                    <span class="text-gray-500 text-sm">
                        <flux:icon.clipboard class="w-[10px]" />
                    </span> Nota
                </label>

                <!-- Visible Editor -->
                <div x-ref="quillEditor"
                    class="bg-white border border-gray-200 rounded h-[200px] mb-4 p-2 overflow-y-auto"></div>

                <!-- Hidden input that Livewire tracks -->
                <input type="hidden" wire:model="note" x-ref="hiddenInput">
            </div>



            <!-- Commerciale -->
    
            <label
                class=" text-xs  mt-[20px]   flex items-center gap-2 mb-1 text-[13px] leading-[16px] font-light text-[#B0B0B0] tracking-[0px] text-left opacity-100">
                <span class="text-gray-500 text-sm">
                    <flux:icon.user class="w-[10px]" />
                </span> Commerciale
            </label>
            <input type="text" wire:model="sales_manager"
                class="w-full border border-gray-200 text-sm p-2 mb-[40px] focus:outline-none ">

            <!-- Aggiunto il -->
       {{--      <label
                class=" text-xs     flex items-center gap-2 mb-1 text-[13px] leading-[16px] font-light text-[#B0B0B0] tracking-[0px] text-left opacity-100">
                <span class="text-gray-500 text-sm">
                    <flux:icon.calendar class="w-[10px]" />
                </span> Aggiunto il
            </label>
            <input type="date" wire:model="acquisition_date"
                class="w-full border border-gray-200 text-sm p-2 mb-[40px] focus:outline-none "> --}}



            <!-- Buttons -->
            <button wire:click="store"
                class="px-3 py-1.5 text-sm bg-cyan-400 text-white rounded-md hover:bg-cyan-500 ml-2 transition">
                Crea
            </button>
        </div>
    </div>
</div>



<!-- Initialize Quill editor -->
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('quill-editor-area')) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });
            var quillEditor = document.getElementById('quill-editor-area');
            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });

            quillEditor.addEventListener('input', function() {
                editor.root.innerHTML = quillEditor.value;
            });
        }
    });
</script>