<?php

namespace ilateral\SilverStripe\CallToActions;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\SiteConfig\SiteConfig;

class ControllerExtension extends Extension
{
    public function getCTA(string $slug): DBHTMLText
    {
        $config = SiteConfig::current_site_config();
        $return = DBHTMLText::create('CTA');
        /** @var CallToAction */
        $cta = CallToAction::get()
            ->filter([
                'Site.ID' => $config->ID,
                'Slug' => $slug
            ])->first();

        if (empty($cta)) {
            return $return;
        }

        $result = $cta->forTemplate();

        if (is_a($result, DBHTMLText::class)) {
            $return = $result;
        } else {
            $return->setValue($result);
        }

        return $return;
    }
}
