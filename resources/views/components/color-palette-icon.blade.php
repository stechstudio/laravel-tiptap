@props([
    'color',
])


<button
    @click="window.tiptap.chain().focus().unsetColor().run()"
    type="button"
    class="text-sm rounded-sm"
>
    <div class="w-full h-full" style="background-color: {{ $color }}"></div>
</button>
