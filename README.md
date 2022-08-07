# SilverStripe Call To Actions

A SilverStripe module that allows creation of custom call to actions
via `SiteConfig` and allows them to be rendered in templates using
unique "slugs"

This module is developed and maintained by [ilateral](http://www.ilateralweb.co.uk)

## Installation Instructions

The prefered way to install this module is via composer:

    composer require ilateral/silverstripe-calltoactions

## Usage

Once the module is downloaded and installed, you can create call to actions
via:

    http://www.yourwebsite.com/admin/settings

And then clicking on the "CTA" tab.

You will then need to create a `MenuHolder` (or use one of the installed defaults).

By default this module includes two CTA types:

 * `Button`: A single linkable button that can be added to templates
 * `Row`: A full width row with short html content and a linkable button

## Templates

This module exposes `$GetCTA("slug")` into all 
controllers and can be called anywhere from within a
controller.

Each `CallToAction` uses `forTemplate` to handle rendering their data, so you
could also link `CallToAction`s to your own pages or objects and load them
via a loop/call etc.