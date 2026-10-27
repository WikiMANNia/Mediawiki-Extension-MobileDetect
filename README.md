# mediawiki-extensions-MobileDetect
Github mirror of MediaWiki extension MobileDetect - the actual code is hosted with Gerrit (please see https://www.mediawiki.org/wiki/Developer_access for contributing

Die Pflege dieses Forks der MediaWiki-Erweiterung [MobileDetect](https://www.mediawiki.org/wiki/Extension:MobileDetect) wird von WikiMANNia verwaltet.

The maintenance of this fork of the MediaWiki extension [MobileDetect](https://www.mediawiki.org/wiki/Extension:MobileDetect) is managed by WikiMANNia.

El mantenimiento de esta bifurcación de la extensión de MediaWiki [MobileDetect](https://www.mediawiki.org/wiki/Extension:MobileDetect) está gestionado por WikiMANNia.

# Compatibility

This extension has been tested to MediaWiki versions `1.39.17`, `1.43.9`, `1.45.1`, and `1.47.0-alpha`.

This extension also works with REL1_35, but `1.35.14` is no longer tested.

# Description

The MobileDetect extension detects mobile devices based on the HTTP User-Agent header. Due to its straightforward detection mechanism, it is designed to be compatible with a wide range of MediaWiki versions.

The extension provides the global PHP function `wfMobileDetect()`, which returns `true` if a mobile device is detected and false otherwise.

It also provides the `<nomobile>` and ‎`<mobileonly>` tags, parser functions, and CSS classes that allow wiki administrators and editors to control which content is displayed on mobile devices and which content is displayed on desktop browsers.

## Usage of wfMobileDetect()

**1. Setting the default skin based on the visitor's device**

To select a default skin depending on whether the visitor is using a mobile device or a desktop browser, add the following code to your LocalSettings.php:

```php
wfLoadExtension( 'MobileDetect' );
require_once "$IP/extensions/MobileDetect/bootstrap.php";
$mobile = wfMobileDetect();

if ( $mobile ) {
    $wgDefaultSkin = "minerva"; # If mobile
} else {
    $wgDefaultSkin = "vector"; # If not mobile
}
```

With this configuration, the default skin will be set to `minerva` for visitors identified as using mobile devices and to `vector` for visitors identified as using desktop browsers.

**Note:** The skins `minerva` and `vector` must be installed and available in your MediaWiki installation.

**2. Loading an extension only for desktop browsers**

You can also use `wfMobileDetect()` to conditionally load another extension. For example, to load ConfirmEdit only for desktop browsers, add the following to your LocalSettings.php:

```php
wfLoadExtension( 'MobileDetect' );
require_once "$IP/extensions/MobileDetect/bootstrap.php";
$mobile = wfMobileDetect();

if ( ! $mobile ) {
    wfLoadExtension( 'ConfirmEdit' ); # Only load if desktop browser
}
```

With this configuration, `ConfirmEdit` will be loaded only when MobileDetect identifies the visitor as using a desktop browser.

**Important:** Conditional extension loading can affect functionality and configuration. Make sure that extensions excluded from mobile requests are not required for features that must remain available on mobile devices.

## Important note about wfMobileDetect() in LocalSettings.php

Calling `wfLoadExtension( 'MobileDetect' )` alone is not sufficient to make the global function `wfMobileDetect()` available immediately in LocalSettings.php.

MediaWiki schedules the extension's normal registration process, including its registration callback, to run after LocalSettings.php has been processed. Consequently, the function would not yet be defined when called directly from LocalSettings.php.

To make the function available at that point, explicitly include the extension's bootstrap file:

```php
require_once "$IP/extensions/MobileDetect/bootstrap.php";
```

The `bootstrap.php` file loads the required compatibility code, the Hooks class, and the global function definition in the appropriate order.

This additional line is necessary when you want to call `wfMobileDetect()` directly from LocalSettings.php. It is not required merely to use the extension's parser tags and other features during normal wiki operation.

# History

## Version 3.0
Please see the [Mediawiki](https://www.mediawiki.org/wiki/Extension:MobileDetect) for details.

## Version 3.1
- 29 May 2023: Output JS config var [diff](https://github.com/wikimedia/mediawiki-extensions-HitCounters/commit/99bbb5e07531095a2bbc506da189e392fdb1f134)
- Fix - 25 May 2024: Make the wfMobileDetect() global function usable again - [Bug: T365912][diff](https://github.com/wikimedia/mediawiki-extensions-MobileDetect/commit/5e253927ab38a29482761e3ebad084d72769dd91)
- Fix - 25 Aug 2024: Check for presence of mobile view cookie `mf_useformat` - [Bug: T373268][diff](https://github.com/wikimedia/mediawiki-extensions-MobileDetect/commit/0b0797a8aa0e83dd9d3699c3bfbf659c14d060e2)

## Version 3.2
- 26 Sep 2022: Add #nomobile and #mobileonly parser hooks [diff](https://github.com/wikimedia/mediawiki-extensions-MobileDetect/commit/bb1131bf1eeb6c8ad0e177042d1d5be12f42e428)

## Version 4.0

* Refactoring classes, namespace and backward compatibility.
* Added `compat.php`

## Version 4.1

* Added `bootstrap.php` to support calling `wfMobileDetect()` from LocalSettings.php.
* Added documentation explaining how to use `wfMobileDetect()` in LocalSettings.php.
* Tested with PHP 8.2, 8.3, and 8.4.
