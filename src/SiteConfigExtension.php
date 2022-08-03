<?php

namespace ilateral\SilverStripe\CallToActions;

use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{
    private static $has_many = [
        'CallToActions' => CallToAction::class
    ];
}