# Silverstripe google tag manager
A simple module that adds google tag manager snippets to silverstripe.

## Installation
Composer is the recommended way of installing SilverStripe modules.
```
composer require gorriecoe/silverstripe-gtm
```

## Requirements

- `silverstripe/cms: ^5`

## Maintainers

- [Gorrie Coe](https://github.com/gorriecoe)

## Config

GTM will check if your `.env` file has defined `GTM_ID` first.  As follows:

```
GTM_ID="GTM-123456"
```

If GTM_ID has not been defined you can edit it in your CMS settings.

## Options

Define the tab to insert the gtm field into.

```yml
SilverStripe\SiteConfig\SiteConfig:
  gtm_tab: 'SomeTabName' // Defaults to 'Main'
```

## Usage
Insert `$GTMscript` after the opening head tag and `$GTMnoscript` after the opening body tag.
```
<!doctype html>
<html class="no-js" lang="en">
<head>
	{$GTMscript}
	...
</head>
<body>
	{$GTMnoscript}
	...
</body>
</html>
```

## [CSP - Content Security Policy](https://developers.google.com/tag-manager/web/csp)

GTM checks for `getNonce()` method in the current controller.  If its avaiable it will produce a CSP compatible snippet.

This means GTM is works with [Firesphere/csp-headers](https://github.com/Firesphere/silverstripe-csp-headers)
