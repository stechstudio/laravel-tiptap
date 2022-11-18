<!--suppress JSValidateTypes, JSUnresolvedFunction, JSUnresolvedVariable, BladeUnknownComponentInspection -->
@props([
    'model',
])

@php
    $colors = config(key: 'tiptap.paletteColors');
@endphp

<div
    x-data="TipTapEditor"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    <div x-cloak>
        <div class="bg-gray-100 rounded flex justify-between items-stretch mb-1 p-1">
            <div class="ProseMirror-toolbar flex items-center space-x-2">
                <button
                    @click="window.tiptap.chain().focus().toggleHeading({ level: 3 }).run()"
                    :class="(isActive('heading', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-heading class="w-7 h-7 px-1.5 py-1" />
                </button>

                <button
                    @click="window.tiptap.chain().focus().toggleBold().run()"
                    :class="(isActive('bold', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-bold class="w-7 h-7 px-1.5 py-1" />
                </button>

                <button
                    @click="window.tiptap.chain().focus().toggleItalic().run()"
                    :class="(isActive('italic', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-italic class="w-7 h-7 px-1.5 py-1" />
                </button>

                <div>
                    <x-tiptap::dropdown :rightAlign="false">
                        <x-slot name="trigger">
                            <button
                                @click="setColor('#666666')"
                                type="button"
                                class="text-sm rounded-sm focus:bg-gray-300 hover:bg-gray-300 text-gray-600"
                            >
                                <x-far-palette @click="open = ! open" class="w-7 h-7 px-1.5 py-1" />
                            </button>
                        </x-slot>

                        <div class="bg-white p-4 rounded shadow space-y-2">
                            <div class="flex justify-between">
                                <x-color-palette-icon color="#000" />
                                <x-color-palette-icon color="#444" />
                                <x-color-palette-icon color="#444" />
                                <x-color-palette-icon color="#666" />
                                <x-color-palette-icon color="#666" />
                                <x-color-palette-icon color="#999" />
                            </div>

                            <div class="flex flex-wrap justify-between">
                                @foreach ($colors as $color)
                                    <div
                                        @click="setColor('#{{ $color }}')"
                                        class="w-6 h-6 flex-shrink-0 border border-transparent hover:border-gray-500 cursor-pointer p-px"
                                    >
                                        <div class="w-full h-full" style="background-color: {{ '#' . $color }}"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </x-tiptap::dropdown>
                </div>

                <div class="mx-2 inline-block border-l border-gray-300 h-full"></div>

                <button
                    :class="(isActive('link', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    @click="setLink()"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-link @click.prevent="open = ! open" class="w-7 h-7 px-1.5 py-1" />
                </button>

                <button
                    @click="window.tiptap.chain().focus().toggleBulletList().run()"
                    :class="(isActive('bulletList', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-list-ul @click.prevent="open = ! open" class="w-7 h-7 px-1.5 py-1" />
                </button>

                <button
                    @click="window.tiptap.chain().focus().toggleOrderedList().run()"
                    :class="(isActive('orderedList', updatedAt)) ? 'bg-gray-500 focus:bg-gray-400 hover:bg-gray-400 text-white' : 'focus:bg-gray-300 hover:bg-gray-300 text-gray-600'"
                    type="button"
                    class="text-sm rounded-sm"
                >
                    <x-far-list-ol @click.prevent="open = ! open" class="w-7 h-7 px-1.5 py-1" />
                </button>
            </div>

            <div class="ProseMirror-toolbar flex items-center space-x-1">
                <button
                    @click="window.tiptap.chain().focus().undo().run()"
                    :disabled="! canUndo"
                    type="button"
                    class="text-sm rounded-sm text-gray-600 focus:bg-gray-300 hover:bg-gray-300 disabled:opacity-25 disabled:cursor-default"
                >
                    <x-far-rotate-left @click.prevent="open = ! open" class="w-7 h-7 px-1.5 py-1" />
                </button>

                <button
                    @click="window.tiptap.chain().focus().redo().run()"
                    :disabled="! canRedo"
                    type="button"
                    class="text-sm rounded-sm text-gray-600 focus:bg-gray-300 hover:bg-gray-300 disabled:opacity-25 disabled:cursor-default"
                >
                    <x-far-rotate-right @click.prevent="open = ! open" class="w-7 h-7 px-1.5 py-1" />
                </button>
            </div>
        </div>

        <div x-ref="editor"></div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/prosemirror.css') }}">
    <script src="{{ asset('js/tiptap.js') }}"></script>
</div>
