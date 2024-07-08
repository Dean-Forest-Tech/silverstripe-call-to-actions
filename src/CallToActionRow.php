<?php

namespace DFT\SilverStripe\CallToActions;

class CallToActionRow extends CallToAction
{
    private static $table_name = "CTA_CallToActionRow";

    private static $db = [
        'Content' => 'HTMLText'
    ];
}
