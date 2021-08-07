<div wire:init="loadPosts">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- SHOW VIEW --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-3 flex items-center">

            <div class="flex items-center mr-2">
                <span>Show</span>
                <select wire:model="quant" class="mx-2 form-control">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <span>results</span>
            </div>

            <x-jet-input class="flex-1" placeholder="What are you looking for?" wire:model="search" type="text">
            </x-jet-input>
            @livewire('create-post')
        </div>

        {{-- LOADING POP UP --}}
        <div wire:loading wire:target="loadPosts" class="border border-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto items-center">
            <div class="animate-pulse flex space-x-4">
              <div class="rounded-full bg-blue-400 h-12 w-12"></div>
              <div class="flex-1 space-y-4 py-1">
                <div class="h-4 bg-blue-400 rounded w-3/4"></div>
                <div class="space-y-2">
                  <div class="h-4 bg-blue-400 rounded"></div>
                  <div class="h-4 bg-blue-400 rounded w-5/6"></div>
                </div>
              </div>
            </div>
          </div>

        @if (count($posts))

        {{-- TABLE SHOWING POSTS --}}
        <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                        <th wire:click="order('id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            ID
                        </th>
                        <th wire:click="order('title')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            Title

                            <i class="fas fa-sort"></i>
                        </th>
                        <th wire:click="order('content')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            Content
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $item)
                            
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ $item->id }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold ">
                                        {{ $item->title }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                        {!! $item->content !!}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <a class="btn btn-green" wire:click="edit({{ $item }})">
                                        Edit
                                    </a>
                                </td>
                            </tr>

                        @endforeach

                        <!-- More people... -->
                    </tbody>
                </table>
                <div class="px-6 py-3">
                    {{$posts->links() }}
                </div>
        </x-table>
            
        @else
            <div class="px-6 py-4"><p>There is not any match with your search... Try another word</p></div>
        @endif

    </div>

    {{-- EDIT MODAL --}}
    <x-jet-dialog-modal wire:model="open_edit">

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
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Discard
            </x-jet-secondary-button>

            {{-- THis button has the livewire method loading which shows a disabled class while it loads. --}}
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-20">
                Edit
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

</div>
