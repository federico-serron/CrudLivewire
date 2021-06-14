<div>
    <x-jet-danger-button class="h-10" wire:click="$set('open', true)">
        Create a post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Create a new post
        </x-slot>

        <x-slot name="content">

            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" wire:loading wire:target="image">
                <strong class="font-bold">Image loading</strong>
                <span class="block sm:inline">Please, wait a moment...</span>
            </div>

            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">
            @endif

            <div class="mb-4">
                <x-jet-label value="Post title" />
                <x-jet-input class="w-full" type="text" wire:model="title" />

                <x-jet-input-error for="title" />
            </div>

            <div wire:ignore class="mb-4">
                <x-jet-label value="Post Content" />
                <textarea id="editor" class="form-control w-full" wire:model.defer="content" ></textarea>

                <x-jet-input-error for="content" />
            </div>

            <div>
                <input type="file" wire:model="image">
                <x-jet-input-error  for="image"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Discard
            </x-jet-secondary-button>

            {{-- THis button has the livewire method loading which shows a disabled class while it loads. --}}
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-20">
                + Create
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    })
                })
                .catch( error => {
                    console.error( error );
                } );
        </script>

    @endpush
</div>
