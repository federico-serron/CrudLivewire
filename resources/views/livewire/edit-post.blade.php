<div>
    <a class="btn btn-green" wire:click="$set('open', 'true')">
        Edit
    </a>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Post edition
        </x-slot>

        <x-slot name="content">

            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" wire:loading wire:target="image">
                <strong class="font-bold">Image loading</strong>
                <span class="block sm:inline">Please, wait a moment...</span>
            </div>

            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">

            @else
                <img src="{{ Storage::url($post->image) }}" alt="">
            @endif

            <div class="mb-4">
                <x-jet-label value="Title" />
                <x-jet-input wire:model="post.title" type="text" class="w-full" />
            </div>

            <div>
                <x-jet-label value="Content" />
                <textarea wire:model="post.content" rows="6" class="form-control w-full"></textarea>
            </div>

            <div>
                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-jet-input-error  for="image"/>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Discard
            </x-jet-secondary-button>

            {{-- THis button has the livewire method loading which shows a disabled class while it loads. --}}
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-20">
                Edit
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
