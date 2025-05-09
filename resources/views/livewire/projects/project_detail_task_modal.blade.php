<div x-data="{
    company_name: @entangle('company_name'),
    first_telephone: @entangle('first_telephone'),
    email: @entangle('email'),
    get isValid() {
        return this.company_name.trim().length > 0 &&
            this.first_telephone.trim().length > 0 &&
            /\S+@\S+\.\S+/.test(this.email);
    }
}" x-show="$wire.isOpen" x-transition
x-init="$watch('$wire.isOpen', value => value && $nextTick(() => {}))"
    class="fixed inset-0 bg-gray-100 bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-white shadow-md border border-gray-200 overflow-y-auto h-full pl-[95px] pr-[95px] pt-[30px]">
        @include('livewire.general.cancel')

        <h2 class="text-lg font-semibold mb-3 text-[24px]">
            {{ $selectedProjectStartId ? 'Modifica Task' : 'Crea Task' }}
        </h2>

        <div class="h-full pt-14 space-y-6">
            <!-- Titolo attività -->
            <div>
                <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                    <flux:icon.building-office class="w-[10px] text-gray-500" />
                    Titolo attività
                </label>
                <input type="text" wire:model="company_name"
                    class="w-full border border-gray-200 text-sm p-2 focus:outline-none" />
            </div>

            <!-- Assegnata a -->
            <div>
                <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                    <flux:icon.at-symbol class="w-[10px] text-gray-500" />
                    Assegnata a
                </label>
                <input type="email" wire:model="email"
                    class="w-full border border-gray-200 text-sm p-2 focus:outline-none" />
            </div>

            <!-- Conoscenza -->
            <div>
                <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                    <flux:icon.at-symbol class="w-[10px] text-gray-500" />
                    Conoscenza
                </label>
                <input type="email" wire:model="email"
                    class="w-full border border-gray-200 text-sm p-2 focus:outline-none" />
            </div>

            <!-- Scadenza -->
            <div>
                <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                    <flux:icon.briefcase class="w-[10px] text-gray-500" />
                    Scadenza
                </label>
                <input type="date" wire:model="created_at"
                    class="w-full border border-gray-200 text-sm p-2 focus:outline-none" />
            </div>

            <!-- Nota (rich text) -->


            {{-- The x-init directive allows you to hook into the initialization phase of any element in Alpine. --}}
            <div x-data x-init="$nextTick(() => {
                const Icon = Quill.import('ui/icons');
                Icon['bold'] = 'grassetto';
                Icon['italic'] = 'corsivo';
                Icon['underline'] = 'sottolineato';
            
                const quill = new Quill($refs.quillEditor, {
                    theme: 'snow',
                    placeholder: 'Scrivi qualcosa…',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'bullet' }, 'link', 'image'],
            
                        ]
                    }
                });
            
                quill.root.innerHTML = $refs.hiddenInput.value;
                quill.on('text-change', () => {
                    $refs.hiddenInput.value = quill.root.innerHTML;
                    $refs.hiddenInput.dispatchEvent(new Event('input'));
                });
                Livewire.hook('message.processed', () => {
                    quill.root.innerHTML = $refs.hiddenInput.value;
                });
            })" wire:ignore>
                <label class="text-xs flex items-center gap-2 mb-1 text-[#B0B0B0]">
                    <flux:icon.clipboard class="w-[10px] text-gray-500" />
                    Nota
                </label>

                <!-- This is where Quill will render -->
                <div x-ref="quillEditor" class="bg-white border border-gray-200 h-[200px] mb-4 p-2 overflow-y-auto">
                </div>

                <!-- Hidden field Livewire listens to -->
                <input type="hidden" wire:model="note" x-ref="hiddenInput" />
            </div>

            <style>
                .ql-toolbar {
                    background-color: #F5FCFD;
                    height: 35px;
                    padding: 2px;
                    display: flex;
                    align-items: center;
                }

                .ql-snow.ql-toolbar button,
                .ql-snow .ql-toolbar {
                    width: 60px;
                    font-size: 0.75rem;
                    white-space: normal;
                    padding: 4px;
                }

                .ql-list .ql-link .ql-image {
                    width: 20px !important;
                    font-size: 0.75rem;
                    white-space: normal;
                    padding: 4px;
                }
            </style>





            <!-- ACTION BUTTON -->
            <div class="mt-6">
                <button wire:click="store" :disabled="!isValid"
                    :class="{
                        'opacity-50 cursor-not-allowed': !isValid,
                        'bg-cyan-400 hover:bg-cyan-500': isValid
                    }"
                    class="px-3 py-1.5 text-sm text-white transition rounded-md">
                    Crea
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fallback Quill init if needed elsewhere
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
