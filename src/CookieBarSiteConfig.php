<?php

namespace Hestec\CookieBar;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\NumericField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;

class CookieBarSiteConfig extends DataExtension {

    private static $db = array(
        'Tracking' => 'Boolean',
        'ThirdParty' => 'Boolean',
        'Always' => 'Boolean',
        'NoGeoIp' => 'Boolean',
        'Scrolling' => 'Boolean',
        'RefreshPage' => 'Boolean',
        'Top' => 'Boolean',
        'ShowNoConsent' => 'Boolean',
        'HideDetailsBtn' => 'Boolean',
        'Blocking' => 'Boolean',
        'ForceLang' => 'Varchar(2)',
        'Theme' => 'Varchar(20)',
        'Remember' => 'Int'
    );

    private static $has_one = array(
        'PrivacyPage' => SiteTree::class
    );

    public function updateCMSFields(FieldList $fields)
    {

        $ForceLangSource = array(
            'ca' => _t("CookieBarSiteConfig.CATALAN", "Catalan"),
            'cz' => _t("CookieBarSiteConfig.CZECH", "Czech"),
            'da' => _t("CookieBarSiteConfig.DANISCH", "Danisch"),
            'nl' => _t("CookieBarSiteConfig.DUTCH", "Dutch"),
            'en' => _t("CookieBarSiteConfig.ENGLISH", "English"),
            'fr' => _t("CookieBarSiteConfig.FRENCH", "French"),
            'de' => _t("CookieBarSiteConfig.GERMAN", "German"),
            'hu' => _t("CookieBarSiteConfig.HUNGARIAN", "Hungarian"),
            'it' => _t("CookieBarSiteConfig.ITALIAN", "Italian"),
            'es' => _t("CookieBarSiteConfig.SPANISH", "Spanish"),
            'pl' => _t("CookieBarSiteConfig.POLISH", "Polish"),
            'po' => _t("CookieBarSiteConfig.PORTUGUESE", "Portuguese"),
            'ro' => _t("CookieBarSiteConfig.ROMANIAN", "Romanian"),
            'ru' => _t("CookieBarSiteConfig.RUSSIAN", "Russian"),
            'sk' => _t("CookieBarSiteConfig.SLOVAK", "Slovak"),
            'sl' => _t("CookieBarSiteConfig.SLOVENIAN", "Slovenian"),
            'se' => _t("CookieBarSiteConfig.SWEDISH", "Swedish")
        );

        $ThemeSource = array(
            'altblack' => _t("CookieBarSiteConfig.ALTERNATIVE_BLACK", "Alternative black"),
            'flying' => _t("CookieBarSiteConfig.FLYINGBAR", "FlyingBAR"),
            'grey' => _t("CookieBarSiteConfig.PLAIN_GREY", "Plain grey"),
            'white' => _t("CookieBarSiteConfig.THICK_WHITE", "Thick white")
        );

        $TrackingField = CheckboxField::create('Tracking', _t("CookieBarSiteConfig.TRACKING", "The website uses tracking cookies"));
        $ThirdPartyField = CheckboxField::create('ThirdParty', _t("CookieBarSiteConfig.THIRDPARTY", "The website uses third party cookies"));
        $AlwaysField = CheckboxField::create('Always', _t("CookieBarSiteConfig.ALWAYS", "Always show cookieBAR"));
        $AlwaysField->setDescription(_t("CookieBarSiteConfig.ALWAYS_DESCRIPTION", "(show cookieBAR even if no cookies are detected)"));
        $NoGeoIpField = CheckboxField::create('NoGeoIp', _t("CookieBarSiteConfig.NOGEOIP", "No GeoIP lookup"));
        $NoGeoIpField->setDescription(_t("CookieBarSiteConfig.NOGEOIP_DESCRIPTION", "(show cookieBAR regardless of the user's location)"));
        $ScrollingField = CheckboxField::create('Scrolling', _t("CookieBarSiteConfig.SCROLLING", "Accept cookies by scrolling window"));
        $RefreshPageField = CheckboxField::create('RefreshPage', _t("CookieBarSiteConfig.REFRESHPAGE", "Refresh page on CookieAllowed"));
        $TopField = CheckboxField::create('Top', _t("CookieBarSiteConfig.TOP", "Show cookieBAR on top"));
        $TopField->setDescription(_t("CookieBarSiteConfig.TOP_DESCRIPTION", "(by default cookiebar is at the bottom of the website)"));
        $ShowNoConsentField = CheckboxField::create('ShowNoConsent', _t("CookieBarSiteConfig.SHOWNOCONSENT", "Show DENY button"));
        $HideDetailsBtnField = CheckboxField::create('HideDetailsBtn', _t("CookieBarSiteConfig.HIDEDETAILSBTN", "HideDetailsBtn"));
        $BlockingField = CheckboxField::create('Blocking', _t("CookieBarSiteConfig.BLOCKING", "Blocking"));
        $ForceLangField = DropdownField::create('ForceLang', _t("CookieBarSiteConfig.FORCELANG", "Language"), $ForceLangSource);
        $ForceLangField->setEmptyString(_t("CookieBarSiteConfig.AUTODETECT", "Autodetect"));
        $ForceLangField->setDescription(_t("CookieBarSiteConfig.FORCELANG_DESCRIPTION", "(use language autodetection or force a specific language)"));
        $ThemeField = DropdownField::create('Theme', _t("CookieBarSiteConfig.THEME", "Theme"), $ThemeSource);
        $ThemeField->setEmptyString(_t("CookieBarSiteConfig.DEFAULT_BLACK", "Default (black)"));
        $RememberField = NumericField::create('Remember', _t("CookieBarSiteConfig.REMEMBER", "Remember"));

        $fields->addFieldsToTab("Root."._t("CookieBarSiteConfig.COOKIEBAR", "CookieBAR"), array(
            $TrackingField,
            $ThirdPartyField,
            $AlwaysField,
            $NoGeoIpField,
            $ScrollingField,
            $RefreshPageField,
            $TopField,
            $ShowNoConsentField,
            $HideDetailsBtnField,
            $BlockingField,
            $ForceLangField,
            $ThemeField,
            $RememberField
        ));


    }

    public function Options(){

        $array = array();

        if ($this->owner->Tracking){
            $array['tracking'] = 1;
        }
        if ($this->owner->ThirdParty){
            $array['thirdparty'] = 1;
        }
        if ($this->owner->Always){
            $array['always'] = 1;
        }
        if ($this->owner->NoGeoIp){
            $array['noGeoIp'] = 1;
        }
        if ($this->owner->Scrolling){
            $array['scrolling'] = 1;
        }
        if ($this->owner->RefreshPage){
            $array['refreshPage'] = 1;
        }
        if ($this->owner->Top){
            $array['top'] = 1;
        }
        if ($this->owner->ShowNoConsent){
            $array['showNoConsent'] = 1;
        }
        if ($this->owner->HideDetailsBtn){
            $array['hideDetailsBtn'] = 1;
        }
        if ($this->owner->Blocking){
            $array['blocking'] = 1;
        }
        if ($this->owner->Remember <> 30 && $this->owner->Remember > 0){
            $array['remember'] = $this->owner->Remember;
        }
        if ($this->owner->Theme){
            $array['theme'] = $this->owner->Theme;
        }
        if ($this->owner->ForceLang){
            $array['forceLang'] = $this->owner->ForceLang;
        }

        return $array;

    }

}