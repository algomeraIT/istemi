<div class="fixed inset-0 bg-[oklch(0.97_0_0_/_0.5)] bg-opacity-20 flex justify-end z-50">
    <div class="w-1/3 bg-gray-50">
        <div class="flex justify-between items-start p-6 bg-[#F5FCFD] h-24">
            <h2 class="text-2xl font-bold">Scrivi nota</h2>
            <button wire:click="$dispatch('closeModal')" class="hover:cursor-pointer">Chiudi</button>
        </div>
        <div class="m-16">

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
        </div>

        <div class="flex justify-end space-x-2">
            <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded">Scrivi</button>
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
