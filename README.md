A TALL-stack implementation of the Tiptap WYSYWIG editor.

## Installation

You can install the package via composer:

```bash
composer require stechstudio/laravel-tiptap
```

The service provider will be automatically wired up for you.

### Include Javascript resources

The following packages must be installed.

```bash

npm install @tiptap/starter-kit
```

```bash

npm install @tiptap/extension-link
```

```bash

npm install @tiptap/extension-color
```

```bash

npm install @tiptap/extension-text-style
```

You also need to have Alpine.js and the TipTap editor already installed.

```bash

npm install alpinejs
```

```bash

npm install @tiptap/core
```

## Usage

Within your Livewire component view, add the TipTap editor component and bind it to your desired Livewire property as usual:

```html

<x-tiptap::editor wire:model="message.body" id="body" name="body" />
```

## Customization

The editor view may be customized by publishing the views into your application's `resources/views/vendor` folder.

php artisan vendor:publish --tag=tiptap-views

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
