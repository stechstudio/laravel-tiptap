@props([
    'model',
])

<!-- @todo: extract to config? -->
@php
    $colors = [
        [
            'EA9999',
            'F9CB9C',
            'FFE599',
            'B6D7A8',
            'A2C4C9',
            '9FC5E8',
            'B4A7D6',
            'D5A6BD',
            'E06666',
            'F6B26B',
            'FFD966',
            '93C47D',
            '76A5AF',
            '6FA8DC',
            '8E7CC3',
            'C27BA0',
            'CC0000',
            'E69138',
            'F1C232',
            '6AA84F',
            '45818E',
            '3D85C6',
            '674EA7',
            'A64D79',
            '990000',
            'B45F06',
            'BF9000',
            '38761D',
            '134F5C',
            '0B5394',
            '351C75',
            '351C75',
            '660000',
            '783F04',
            '7F6000',
            '274E13',
            '0C343D',
            '0C343D',
            '073763',
            '4C1130',
        ],
    ];
@endphp

<div
    x-data="{
        open: false,
        setColor: (color) => window.tiptap.chain().focus().setColor(color).run(),
        ...setupEditor(@entangle($attributes->wire('model')).defer),
    }"
    x-init="() => init($refs.editor);"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    <div x-cloak>
        <div class="bg-gray-100 rounded flex justify-between items-stretch mb-1 p-1">
            <div class="ProseMirror-toolbar flex items-center space-x-1">
                <button
                    x-on:click="window.tiptap.chain().focus().toggleHeading({ level: 3 }).run()"
                    :class="(isActive('heading', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-heading class="w-5 h-5 px-1.5 py-1" />
                </button>

                <button
                    x-on:click="window.tiptap.chain().focus().toggleBold().run()"
                    :class="(isActive('bold', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-bold class="w-5 h-5 px-1.5 py-1" />
                </button>

                <button
                    x-on:click="window.tiptap.chain().focus().toggleItalic().run()"
                    :class="(isActive('italic', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-italic class="w-5 h-5 px-1.5 py-1" />
                </button>

                <!-- @todo: replace -->
                <div class="relative inline-block text-left">
                    <div>
                        <button @click.prevent="open = ! open" type="button" class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100" id="menu-button" aria-expanded="true" aria-haspopup="true">
                            <x-far-palette class="w-5 h-5 px-1.5 py-1" />
                        </button>
                    </div>

                    <x-tiptap::dropdown :rightAlign="false">
                        <x-slot name="trigger">
                            <button
                                type="button"
                                class="text-sm rounded-sm"
                                :class="(isActive('textStyle', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                            >
                                <i class="px-1.5 py-1 far fa-palette" x-on:click.prevent="open = !open"></i>
                            </button>
                        </x-slot>
                        <div class="bg-white p-4 rounded shadow space-y-2">
                            <div class="flex justify-between">
                                <div class="flex-grow h-6 border border-transparent hover:border-gray-500 cursor-pointer p-px"
                                     x-on:click="window.tiptap.chain().focus().unsetColor().run()">
                                    <div class="w-full h-full" style="background-color: #000"></div>
                                </div>
                                <div class="w-6 h-6 flex-shrink-0 border border-transparent hover:border-gray-500 cursor-pointer p-px"
                                     x-on:click="setColor('#444444')">
                                    <div class="w-full h-full" style="background-color: #444444"></div>
                                </div>
                                <div class="w-6 h-6 flex-shrink-0 border border-transparent hover:border-gray-500 cursor-pointer p-px"
                                     x-on:click="setColor('#666666')">
                                    <div class="w-full h-full" style="background-color: #666666"></div>
                                </div>
                                <div class="w-6 h-6 flex-shrink-0 border border-transparent hover:border-gray-500 cursor-pointer p-px"
                                     x-on:click="setColor('#999999')">
                                    <div class="w-full h-full" style="background-color: #999999"></div>
                                </div>
                            </div>
                            @foreach($colors AS $group)
                                <div class="flex flex-wrap justify-between">
                                    @foreach($group AS $color)
                                        <div class="w-6 h-6 flex-shrink-0 border border-transparent hover:border-gray-500 cursor-pointer p-px"
                                             x-on:click="setColor('#{{ $color }}')">
                                            <div class="w-full h-full" style="background-color: #{{ $color }}"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </x-tiptap::dropdown>
                </div>

                <div class="mx-2 inline-block border-l border-gray-300 h-full"></div>

                <button
                    :class="(isActive('link', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    x-on:click="setLink()"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-link x-on:click.prevent="open = ! open" class="w-5 h-5 px-1.5 py-1" />
                </button>

                <button
                    x-on:click="window.tiptap.chain().focus().toggleBulletList().run()"
                    :class="(isActive('bulletList', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-list-ul x-on:click.prevent="open = ! open" class="w-5 h-5 px-1.5 py-1" />
                </button>

                <button
                    x-on:click="window.tiptap.chain().focus().toggleOrderedList().run()"
                    :class="(isActive('orderedList', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-list-ol x-on:click.prevent="open = ! open" class="w-5 h-5 px-1.5 py-1" />
                </button>
            </div>

            <div class="ProseMirror-toolbar flex items-center space-x-1">
                <button
                    x-on:click="window.tiptap.chain().focus().undo().run()"
                    x-bind:disabled="! canUndo"
                    type="button"
                    class="text-sm rounded-sm text-gray-600 focus:bg-gray-300 hover:bg-gray-300 disabled:opacity-25 disabled:cursor-default"
                >
                    <x-far-rotate-left x-on:click.prevent="open = ! open" class="w-5 h-5 px-1.5 py-1" />
                </button>

                <button
                    x-on:click="window.tiptap.chain().focus().redo().run()"
                    x-bind:disabled="! canRedo"
                    type="button"
                    class="text-sm rounded-sm text-gray-600 focus:bg-gray-300 hover:bg-gray-300 disabled:opacity-25 disabled:cursor-default"
                >
                    <x-far-rotate-right x-on:click.prevent="open = ! open" class="w-5 h-5 px-1.5 py-1" />
                </button>
            </div>
        </div>

        <div x-ref="editor"></div>
    </div>
</div>
