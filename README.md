# laravel-js-lang
laravel localization for javascript

use laravel `__()` function in javascript with same syntax

# installation
to install this package run:

`composer require mralgorithm/laravel-js-lang`

then run this command to publish required files:

`php artisan vendor:publish --tag=laravel-js-lang`

to create json files from your `lang` directory run this command:

`php artisan JsLang:update`

for the last step, add this script to your template file eather to use `JS` functions

`<script id="laravel_js_lang_helper" lang="{{ App::getLocale() }}" src="{{ url('/laravel-js-lang/js/JsLang.js') }}"></script>`

# functions
## 1. `__()`:
function __(key,replace = '',locale = ''){}

as you can see, this function take three parameters(key,replace,locale) that key is necessary and others(replace,locale) is optional.
this function return the translation(if exist!) or the key if the translation does not exist.

### example

1. `__('auth.failed')`
2. `__('hello i am mralgorithm!')`
3. `__('auth.throttle',{seconds:'50'})`
4. `__('auth.failed','','fa')`

for more detail please read [Laravel Localization Document](https://laravel.com/docs/9.x/localization)

## 2. `lang_getLocale()`:
take no parameters

return current Locale

### example
- `lang_getLocale()`
> en


## 3. `lang_setLocale()`
take Locale

return void

### example
- `lang_getLocale()`
> en
- `lang_setLocale('fa')`
- `lang_getLocale()`
> fa

## 4. `is_locale()`:
take Locale

return true if Locale equal to Locale parameter and false in otherwise

### example 
- `lang_setLocale('en')`
- `is_locale('fa')`
> false
- `is_locale('en')`
> true

# Commands
## 1. `JsLang:update`;
this command convert your `Lang` directory to `JSON` files so JavaScript can use them

**run this command whenever you make a change in your `Lang` directory**

`php artisan JsLang:update`
