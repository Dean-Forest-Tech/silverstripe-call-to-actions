<?php

namespace ilateral\SilverStripe\CallToActions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Forms\GridField\GridField;

class SiteConfigExtension extends DataExtension
{
    private static $has_many = [
        'CallToActions' => CallToAction::class
    ];

    public function updateCMSFields(FieldList $fields)
    {
        /** @var SiteConfig */
        $owner = $this->getOwner();

        $fields->addFieldToTab(
            'Root.CTA',
            GridField::create(
                'CallToActions',
                $owner->fieldLabel('CallToActions'),
                $owner->CallToActions()
            )->setConfig(GridFieldConfig::create(CallToAction::class))
        );
    }
}
