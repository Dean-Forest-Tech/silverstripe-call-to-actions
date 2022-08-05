<?php

namespace ilateral\SilverStripe\CallToActions;

use gorriecoe\Link\Models\Link;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use gorriecoe\LinkField\LinkField;
use SilverStripe\Core\Convert;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * @property string     Name
 * @property string     Slug
 * 
 * @method SiteConfig   Site
 * @method Link         Button
 */
class CallToAction extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'Slug' => 'Varchar'
    ];

    private static $has_one = [
        'Site' => SiteConfig::class,
        'Button' => Link::class
    ];

    public function forTemplate(): string
    {
        return $this->renderWith($this->getViewerTemplates());
    }

    public function getCMSFields()
    {
        $self = $this;
   
        $this->beforeUpdateCMSFields(function ($fields) use ($self) {
            /** @var FieldList $fields */
            $fields->addFieldToTab(
                'Root.Main',
                LinkField::create(
                    'Button',
                    'Button',
                    $self
                )
            );

            $fields->replaceField(
                'Slug',
                ReadonlyField::create('Slug')
            );
        });

        return parent::getCMSFields();
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        $this->Slug = Convert::raw2url($this->Name);
    }
}
