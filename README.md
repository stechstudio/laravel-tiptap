A TALL-stack implementation of the Tiptap WYSYWIG editor.

## Installation

You can install the package via composer:

```bash
composer require stechstudio/laravel-tiptap
```

The service provider will be automatically wired up for you.

### Include Javascript resources

The following packages must be installed.

Tailwind:

```bash

npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

TipTap Starter Kit:

```bash

npm install @tiptap/starter-kit
```

TipTap Extension Link:

```bash

npm install @tiptap/extension-link
```

TipTap Extension Color:

```bash

npm install @tiptap/extension-color
```

TipTap Extension Text Style:

```bash

npm install @tiptap/extension-text-style
```

You also need to have Alpine.js and the TipTap editor already installed.

Alpine.js:

```bash

npm install alpinejs
```

TipTap Core:

```bash

npm install @tiptap/core
```

In your app.js file, add the following boilerplate to get up and running.

```js
import { Editor } from "@tiptap/core";
import StarterKit from "@tiptap/starter-kit";
import Link from "@tiptap/extension-link";
import TextStyle from "@tiptap/extension-text-style";
import Color from "@tiptap/extension-color";
import Alpine from 'alpinejs';

window.Editor = Editor;
window.StarterKit = StarterKit;
window.Link = Link;
window.TextStyle = TextStyle;
window.Color = Color;
window.Alpine = Alpine;

Alpine.start();
```

This will make use of the previously mentioned packages.

## Usage

Within your Livewire component view, add the TipTap editor component and bind it to your desired Livewire property as usual:

```html

<x-tiptap::editor wire:model="message.body" id="body" name="body" />
```

## Customization

The editor view may be customized by publishing the views into your application's `resources/views/vendor` folder.

```bash

php artisan vendor:publish --tag=tiptap-views
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
