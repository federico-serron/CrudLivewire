<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-3">
            <x-jet-input class="w-full" placeholder="What are you looking for?" wire:model="search" type="text">
            </x-jet-input>
        </div>
        @if ($posts->count())
        <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                        <th wire:click="order('id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            ID
                        </th>
                        <th wire:click="order('title')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            Title
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
                        @foreach ($posts as $post)
                            
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ $post->id }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold ">
                                        {{ $post->title }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $post->content }}
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>

                        @endforeach

                        <!-- More people... -->
                    </tbody>
                </table>
        </x-table>
            
        @else
            <div class="px-6 py-4"><p>There is not any match with your search... Try another word</p></div>
        @endif
    </div>
</div>
