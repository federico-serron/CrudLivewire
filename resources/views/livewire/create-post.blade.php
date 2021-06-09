<div>
    <x-jet-danger-button class="h-10" wire:click="$set('open', true)">
        Create a post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Create a new post
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Post title" />
                <x-jet-input class="w-full" type="text" wire:model="title" />

                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Post Content" />
                <textarea class="form-control w-full" rows="6" wire:model.defer="content" ></textarea>

                <x-jet-input-error for="content" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Discard
            </x-jet-secondary-button>

            {{-- THis button has the livewire method loading which shows a disabled class while it loads. --}}
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-20">
                + Create
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
