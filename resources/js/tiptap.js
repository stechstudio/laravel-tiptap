import {Editor} from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import Link from '@tiptap/extension-link'
import TextStyle from "@tiptap/extension-text-style";
import Color from '@tiptap/extension-color'

window.setupEditor = function (content) {
    return {
        editor: null,
        content: content,
        canUndo: false,
        canRedo: false,
        updatedAt: Date.now(),
        isActive: ($markName) => window.tiptap.isActive($markName),
        init(element) {
            window.tiptap = new Editor({
                element: element,
                canUndo: false,
                canRedo: false,
                autofocus: true,
                editorProps: {
                    attributes: {
                      class: 'html-editor border-gray-300 form-input rounded-md shadow-sm focus:outline-none focus:ring-4 focus:ring-primary-600 focus:ring-opacity-30 focus:border-primary-600',
                    },
                },
                onTransaction: () => {
                    this.updatedAt = Date.now()
                },
                extensions: [
                    StarterKit.configure({
                        blockquote: false,
                        // bold: {},
                        // bulletList: {},
                        code: false,
                        codeBlock: false,
                        // document: {},
                        // dropcursor: {},
                        gapcursor: false,
                        // hardBreak: {},
                        heading: {
                            levels: [3],
                        },
                        // history: {},
                        horizontalRule: false,
                        // italic: {},
                        // listItem: {},
                        // orderedList: {},
                        // paragraph: {},
                        strike: false,
                        // text: {}
                    }),
                    TextStyle,
                    Color,
                    Link.configure({
                        openOnClick: false
                    })
                ],
                content: this.content,
                onUpdate: ({editor}) => {
                    this.canUndo = editor.can().undo();
                    this.canRedo = editor.can().redo();
                    this.content = editor.getHTML();
                }
            })

            this.$watch('content', (content) => {
                // If the new content matches TipTap's then we just skip.
                if (content === window.tiptap.getHTML()) return

                /*
                  Otherwise, it means that a force external to TipTap
                  is modifying the data on this Alpine component,
                  which could be Livewire itself.
                  In this case, we just need to update TipTap's
                  content and we're good to do.
                  For more information on the `setContent()` method, see:
                    https://www.tiptap.dev/api/commands/set-content
                */
                window.tiptap.commands.setContent(content, false)
            })
        },

        setLink() {
            const previousUrl = window.tiptap.getAttributes('link').href
            const url = window.prompt('URL', previousUrl)

            // cancelled
            if (url === null) {
                return
            }

            // empty
            if (url === '') {
                window.tiptap
                    .chain()
                    .focus()
                    .extendMarkRange('link')
                    .unsetLink()
                    .run()

                return
            }

            // update link
            window.tiptap
                .chain()
                .focus()
                .extendMarkRange('link')
                .setLink({href: url})
                .run()
        },
    }
}