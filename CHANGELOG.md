### Version 0.9.0

#### Deprecation notice ⚠️

Since Bridge v0.9.0 brings Settings group feature it will no longer support
`Settings::getOrCreate('email')` function (as well as `create` and `get` functions). Use `Settings::group('contacts')->getOrCreate('email')` instead.
We do that in order to force developers to make better user interfaces and experience to content moderators.

You can use `Settings::misc()->getOrCreate('settings_i_didn\'t_find_a_place_for')` for
settings that you did not find places for.

Those methods will be deleted in `v1.0.0`. In order to migrate to new syntax you can set
`group_id`.

Thanks.

#### Changelog

- Added `Kolyunya/yii2-map-input-widget` and new widget to `ActiveField`. 
In order to provide Google maps api API key to widget,  
- Added new settings type for maps.
- Added `vlucas/phpdotenv` dependency for local development setup. Refer to `.env.example`.
- Created console Yii2 app in `bin` directory for development purposes (to create migrations and etc). 
You can run it with `php bin/yii.php`.
- Added `./bin/bridge-install-dev` install script for dev and test/CI environment.
- Created `SettingsGroups` model
- Created `FontAwesomePicker` widget and added it to `ActiveField`
- Added `no-panel` View param support in order to hide admin layout's bootstrap panel
- Updated Settings UI
- Changed `ActiveField::relationalDropDown` widget code for flexibility.
- Fixed `Toastr` widget.
- Fixed `TranslationBehavior`.

### Version 0.8.4

- Fixed `TranslationBehavior` save method
- Added ability to set footer text

### Version 0.8.3

- Fixed issue of overwriting app `i18n` config (translations) in BridgeModule
- Fixed issue of duplicating translations in translations view (index)   

### Version 0.8.1

- Fixed `i18n` and `urlManager` components setup

### Version 0.8.0

- Created CHANGELOG
- Added dependency to `zelenin/yii2-i18n-module` ([Repo link](https://github.com/zelenin/yii2-i18n-module))
- Added `BridgeModule::$languageInitHandler` field. It defines the way language is initialized. 
Accepts anything for `call_user_func()` PHP function.
**By default** language is stored in cache under `lang` key.
- Added `BridgeModule::$languages` array. You can pass both associative arrays or array for `call_user_func()` function.
In case `languages` is associative, key is language identifier, such as `ru-RU` or `kk-KZ` and value is label (`Русский`, `Qazaqsha`).
**Default** is ` [ 'en-US' => 'EN', 'ru-RU' => 'RU', 'kk-KZ' => 'KZ' ] `
- Added `BridgeModule::$languageSwitchAction` property. **By default** it's `\naffiq\bridge\controllers\actions\LanguageSwitchAction`.
It stores language code to cache under `lang` key.
- Added `BridgeModule::$showLanguageSwitcher` property. **Default:** `true`
- Added `Translations` menu item to admin panel that is visible, if `BridgeModule::$showLanguageSwitcher` is `true`. 
- Added language switch dropdown to main layout that is visible, if `BridgeModule::$showLanguageSwitcher` is `true`.
- Added `defaultImageWidth` and `defaultImageHeight` support to `options` param of `ActiveField::richTextArea()` method. 
Sets default image size for CKEditor image plugin. Currently limited to same size per view.
- Added `codemix/yii2-localeurls` for managing current language via URLManager.
- Added `TranslationFormWidget` for managing translations and added it to `ActiveForm`
- Added `TranslationBehavior` for saving and getting translations from `ActiveRecord`s
