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
                <x-jet-input class="w-full" type="text" wire:model.defer="title" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Post Content" />
                <textarea class="form-control w-full" rows="6" wire:model.defer="content" ></textarea>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Discard
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save">
                + Create
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
