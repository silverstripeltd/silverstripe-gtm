<?php

namespace gorriecoe\GTM\View;

use SilverStripe\View\TemplateGlobalProvider;
use SilverStripe\Model\ArrayData;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Core\Environment;
use SilverStripe\Control\Controller;

/**
 * Adds tag methods to templates
 *
 * @package silverstripe-gtm
 */
class GTMTemplateProvider implements TemplateGlobalProvider
{
    /**
     * @return Array|Void
     */
    public static function get_template_global_variables()
    {
        return [
            'GTM_ID' => 'GTM_ID',
            'GTMscript' => 'GTMscript',
            'GTMnoscript' => 'GTMnoscript'
        ];
    }

    /**
     * Get the GTM Id via .Env or Siteconfig.
     * @return String|Null
     */
    public static function GTM_ID()
    {
        if (!$gtm = Environment::getEnv('GTM_ID')) {
            $gtm = SiteConfig::current_site_config()->GoogleTagManager;
        }
        return $gtm;
    }

    /**
     * @return HTML|Null
     */
    public static function GTMscript()
    {
        if ($gtm = self::GTM_ID()) {
            $controller = Controller::curr();
            $nonce = $controller->hasMethod('getNonce') ? $controller->getNonce() : Null;
            if ($nonce) {
                return ArrayData::create([
                    'GTM' => $gtm,
                    'NONCE' => $nonce
                ])->renderWith('GTMscript_Nonce');
            } else {
                return ArrayData::create([
                    'GTM' => $gtm
                ])->renderWith('GTMscript');
            }

        }
    }

    /**
     * @return HTML|Null
     */
    public static function GTMnoscript()
    {
        if ($gtm = self::GTM_ID()) {
            return ArrayData::create([
                'GTM' => $gtm
            ])->renderWith('GTMnoscript');
        }
    }
}
