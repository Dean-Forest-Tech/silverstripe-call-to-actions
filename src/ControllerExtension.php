<?php

namespace ilateral\SilverStripe\CallToActions;

use SilverStripe\Core\Extension;
use SilverStripe\SiteConfig\SiteConfig;

class ControllerExtension extends Extension
{
    public function getRenderedCTA(string $slug): string
    {
        $config = SiteConfig::current_site_config();
        /** @var CallToAction */
        $cta = CallToAction::get()
            ->filter([
                'Site.ID' => $config->ID,
                'Slug' => $slug
            ])->first();

        if (empty($cta)) {
            return "";
        }

        return $cta->forTemplate();
    }
}
