A TALL-stack implementation of the Tiptap WYSYWIG editor


## Installation

You can install the package via composer:

```bash
composer require stechstudio/laravel-tiptap
```

The service provider will be automatically wired up for you.


### Include Javascript resources

The following must be installed in your `package.json` file to enable the rich text features this editor exposes

```
@tiptap/extension-color
@tiptap/extension-link
@tiptap/extension-text-style
@tiptap/starter-kit
```

Once these have been installed, include this package's javascript resources within the `app.js` file of your application:

```js
...
require('./../../vendor/stechstudio/laravel-tiptap/resources/js/tiptap.js');
...
```

Unless the editor view has been published into your application's resources folder, you will also want to include this package's views in the `content` section of your tailwind configuration file so that the editor styles are not purged from your asset build:

```js
module.exports = {
    ...
    content: [
        ...
        './vendor/stechstudio/laravel-tiptap/resources/views/**/*.blade.php',
        ...
    ],
    ...
```

## Usage

Within your livewire component view, add the tiptap editor component and bind it to your desired livewire property as usual:

```html
<x-tiptap-editor id="body" name="body" wire:ignore wire:model="body"></x-tiptap-editor>
```

## Customization

The editor view may be customized by publishing this package's views into your application's `resources/views/vendor` folder. 

php artisan vendor:publish --tag=tiptap-views

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
