<?php

namespace ilateral\SilverStripe\CallToActions;

class CallToActionRow extends CallToAction
{
    private static $db = [
        'Content' => 'HTMLText'
    ];
}
