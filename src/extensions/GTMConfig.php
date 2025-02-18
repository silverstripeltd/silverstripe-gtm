<?php

namespace gorriecoe\GTM\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Core\Extension;
use SilverStripe\Core\Environment;

/**
 * Adds a google tag manager tab to object
 *
 * @package silverstripe-gtm
 */
class GTMConfig extends Extension
{
    /**
     * Database fields
     * @var array
     */
    private static $db = array(
        'GoogleTagManager' => 'Varchar(20)'
    );

    /**
     * Defines tab to insert the field into.
     * @var string
     */
    private static $gtm_tab = 'Main';

    /**
     * Update Fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        $owner = $this->owner;
        $tab = $owner->config()->get('gtm_tab');

        // IF GTM is defined in .env don't allow editing here
        // This is usefull for uat environments etc.
        if ($gtm = Environment::getEnv('GTM_ID')) {
            $field = LiteralField::create(
                'GoogleTagManager',
                _t(__CLASS__ . '.IDEQUALS', 'The current tag manager ID is {GTM_ID}', [
                    'GTM_ID' => $gtm
                ])
            );
        } else {
            $field = TextField::create(
                'GoogleTagManager',
                _t(__CLASS__ . '.ID', 'Tag manager ID')
            )
            ->setAttribute(
                "placeholder",
                "GTM-******"
            );
        }
        $fields->addFieldToTab('Root.' . $tab, $field);

        return $fields;
    }


}
