<?php

namespace ilateral\SilverStripe\CallToActions;

use SilverStripe\Core\Extension;

class ControllerExtension extends Extension
{
    public function getRenderedCTA(string $slug): string
    {
        /** @var CallToAction */
        $cta = CallToAction::get()->find('Slug', $slug);

        if (empty($cta)) {
            return "";
        }

        return $cta->forTemplate();
    }
}
