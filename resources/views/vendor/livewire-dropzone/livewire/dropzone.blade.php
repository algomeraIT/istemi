<div x-cloak x-data="dropzone({
    _this: @this,
    uuid: @js($uuid),
    multiple: @js($multiple),
})" @dragenter.prevent.document="onDragenter($event)"
    @dragleave.prevent="onDragleave($event)" @dragover.prevent="onDragover($event)" @drop.prevent="onDrop"
    class="w-full antialiased">
    <div
        class="flex flex-col items-start h-full w-full justify-center bg-transparent dark:bg-gray-800 dark:border-gray-600 dark:hover:border-gray-500">
        @if (!is_null($error))
            <div class="bg-red-50 p-4 w-full mb-4 rounded dark:bg-red-600">
                <div class="flex gap-3 items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-5 h-5 text-red-400 dark:text-red-200">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-sm text-red-800 font-medium dark:text-red-100">{{ $error }}</h3>
                </div>
            </div>
        @endif
        <div @click="$refs.input.click()"
            class="border border-dashed rounded border-color-#8B8B8B w-full cursor-pointer">
            <div>
                <div x-show="!isDragging"
                    class="flex flex-col items-center bg-white justify-center gap-2 py-8 h-40">
                    <flux:icon.arrow-up-tray class="size-5" data-color="teal" />
                    <p class="text-base font-semibold text-[#B0B0B0]">Trascina & Rilascia il file</p>
                    <p class="text-xs text-[#B0B0B0]">oppure scegli da PC</p>
                </div>
                <div x-show="isDragging" class="flex items-center bg-gray-100 justify-center gap-2 py-8 h-40">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-6 h-6 text-gray-500 dark:text-gray-400">
                        <path
                            d="M10 2a.75.75 0 01.75.75v5.59l1.95-2.1a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0L6.2 7.26a.75.75 0 111.1-1.02l1.95 2.1V2.75A.75.75 0 0110 2z" />
                        <path
                            d="M5.273 4.5a1.25 1.25 0 00-1.205.918l-1.523 5.52c-.006.02-.01.041-.015.062H6a1 1 0 01.894.553l.448.894a1 1 0 00.894.553h3.438a1 1 0 00.86-.49l.606-1.02A1 1 0 0114 11h3.47a1.318 1.318 0 00-.015-.062l-1.523-5.52a1.25 1.25 0 00-1.205-.918h-.977a.75.75 0 010-1.5h.977a2.75 2.75 0 012.651 2.019l1.523 5.52c.066.239.099.485.099.732V15a2 2 0 01-2 2H3a2 2 0 01-2-2v-3.73c0-.246.033-.492.099-.73l1.523-5.521A2.75 2.75 0 015.273 3h.977a.75.75 0 010 1.5h-.977z" />
                    </svg>
                    <p class="text-md text-gray-600 dark:text-gray-400">Rilascia qui per caricare</p>
                </div>
            </div>
            <input x-ref="input" wire:model="upload" type="file" class="hidden"
                x-on:livewire-upload-start="isLoading = true" x-on:livewire-upload-finish="isLoading = false"
                x-on:livewire-upload-error="console.log('livewire-dropzone upload error', error)"
                @if (!is_null($this->accept)) accept="{{ $this->accept }}" @endif
                @if ($multiple === true) multiple @endif>
        </div>

        <div class="flex justify-between w-full mt-2">
            <div class="w-full flex items-center justify-between gap-2 text-[#B0B0B0] text-xs">
                @php
                    $hasMaxFileSize = !is_null($this->maxFileSize);
                    $hasMimes = !empty($this->mimes);
                @endphp

                @if ($hasMimes)
                    <p>{{ 'File supportati ' . Str::upper($this->mimes) }}</p>
                @endif

                @if ($hasMaxFileSize)
                    <p>{{ __('Dimensione massima :size', ['size' => \Illuminate\Support\Number::fileSize($this->maxFileSize * 1024)]) }}
                    </p>
                @endif
            </div>
            <div x-show="isLoading" role="status">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-700 fill-blue-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Caricamento...</span>
            </div>
        </div>

        @if (isset($files) && count($files) > 0)
            <div class="flex flex-wrap gap-x-10 gap-y-2 justify-start w-full mt-5">
                @foreach ($files as $file)
                    <div
                        class="p-1.5 flex items-center justify-between gap-2 bg-color-#D3CDC1 rounded w-full h-auto overflow-hidden dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            @if ($this->isImageMime($file['extension']))
                                <div class="flex-none w-11 h-11 rounded">
                                    <img src="{{ $file['temporaryUrl'] }}" class="object-fill w-full h-full rounded"
                                        alt="{{ $file['name'] }}">
                                </div>
                            @else
                                <div class="flex justify-center items-center w-11 h-11 rounded bg-gray-100 dark:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="flex flex-col items-start gap-1">
                                <div class="text-center text-slate-900 text-sm font-medium dark:text-slate-100">
                                    {{ $file['name'] }}</div>
                                <div class="text-center text-gray-500 text-sm font-medium">
                                    {{ \Illuminate\Support\Number::fileSize($file['size']) }}</div>
                            </div>
                        </div>
                        <div class="flex items-center mr-1 mb-4">
                            <button type="button" @click="removeUpload('{{ $file['tmpFilename'] }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-5 h-5 text-color-#8B8B8B">
                                    <path fill-rule="evenodd"
                                        d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @script
        <script>
            Alpine.data('dropzone', ({
                _this,
                uuid,
                multiple
            }) => {
                return ({
                    isDragging: false,
                    isDropped: false,
                    isLoading: false,

                    onDrop(e) {
                        this.isDropped = true
                        this.isDragging = false

                        const file = multiple ? e.dataTransfer.files : e.dataTransfer.files[0]

                        const args = ['upload', file, () => {
                            // Upload completed
                            this.isLoading = false
                        }, (error) => {
                            // An error occurred while uploading
                            console.log('livewire-dropzone upload error', error);
                        }, () => {
                            // Uploading is in progress
                            this.isLoading = true
                        }];

                        // Upload file(s)
                        multiple ? _this.uploadMultiple(...args) : _this.upload(...args)
                    },
                    onDragenter() {
                        this.isDragging = true
                    },
                    onDragleave() {
                        this.isDragging = false
                    },
                    onDragover() {
                        this.isDragging = true
                    },
                    removeUpload(tmpFilename) {
                        // Dispatch an event to remove the temporarily uploaded file
                        _this.dispatch(uuid + ':fileRemoved', {
                            tmpFilename
                        })
                    },
                });
            })
        </script>
    @endscript
</div>
