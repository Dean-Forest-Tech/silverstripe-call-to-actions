<?php

namespace ilateral\SilverStripe\CallToActions;

use SilverStripe\ORM\DataObject;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;

class CallToAction extends DataObject
{
    private static $db = [
        'Name' => 'Varchar',
        'Slug' => 'Varchar',
        'Content' => 'HTMLText'
    ];

    private static $has_one = [
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
            $fields->addFieldToTab(
                'Root.Main',
                LinkField::create(
                    'Button',
                    'Button',
                    $self
                )
            );
        });

        return parent::getCMSFields();
    }
}
