<?php

namespace Hestec\CookieBar;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;

class CookieBarSiteConfig extends DataExtension {

    private static $db = array(
        'CbEnable' => 'Boolean',
        'CbTracking' => 'Boolean',
        'CbThirdParty' => 'Boolean',
        'CbAlways' => 'Boolean',
        'CbNoGeoIp' => 'Boolean',
        'CbScrolling' => 'Boolean',
        'CbRefreshPage' => 'Boolean',
        'CbTop' => 'Boolean',
        'CbShowNoConsent' => 'Boolean',
        'CbHideDetailsBtn' => 'Boolean',
        'CbBlocking' => 'Boolean',
        'CbForceLang' => 'Varchar(2)',
        'CbTheme' => 'Varchar(20)',
        'CbRemember' => 'Int'
    );

    private static $has_one = array(
        'CbPrivacyPage' => SiteTree::class
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

        $SiteTreeSource = SiteTree::class;

        $EnableField = CheckboxField::create('CbEnable', _t("CookieBarSiteConfig.ENABLE", "Enable CookieBAR"));
        $TrackingField = CheckboxField::create('CbTracking', _t("CookieBarSiteConfig.TRACKING", "The website uses tracking cookies"));
        $ThirdPartyField = CheckboxField::create('CbThirdParty', _t("CookieBarSiteConfig.THIRDPARTY", "The website uses third party cookies"));
        $AlwaysField = CheckboxField::create('CbAlways', _t("CookieBarSiteConfig.ALWAYS", "Always show cookieBAR"));
        $AlwaysField->setDescription(_t("CookieBarSiteConfig.ALWAYS_DESCRIPTION", "(show cookieBAR even if no cookies are detected)"));
        $NoGeoIpField = CheckboxField::create('CbNoGeoIp', _t("CookieBarSiteConfig.NOGEOIP", "No GeoIP lookup"));
        $NoGeoIpField->setDescription(_t("CookieBarSiteConfig.NOGEOIP_DESCRIPTION", "(show cookieBAR regardless of the user's location)"));
        $ScrollingField = CheckboxField::create('CbScrolling', _t("CookieBarSiteConfig.SCROLLING", "Accept cookies by scrolling window"));
        $RefreshPageField = CheckboxField::create('CbRefreshPage', _t("CookieBarSiteConfig.REFRESHPAGE", "Refresh page on CookieAllowed"));
        $TopField = CheckboxField::create('CbTop', _t("CookieBarSiteConfig.TOP", "Show cookieBAR on top"));
        $TopField->setDescription(_t("CookieBarSiteConfig.TOP_DESCRIPTION", "(by default cookiebar is at the bottom of the website)"));
        $ShowNoConsentField = CheckboxField::create('CbShowNoConsent', _t("CookieBarSiteConfig.SHOWNOCONSENT", "Show DENY button"));
        $HideDetailsBtnField = CheckboxField::create('CbHideDetailsBtn', _t("CookieBarSiteConfig.HIDEDETAILSBTN", "Hide the Details link"));
        $BlockingField = CheckboxField::create('CbBlocking', _t("CookieBarSiteConfig.BLOCKING", "Blocking"));
        $BlockingField->setDescription(_t("CookieBarSiteConfig.BLOCKING_DESCRIPTION", "(forces a visitor to select whether to accept or decline cookies)"));
        $ForceLangField = DropdownField::create('CbForceLang', _t("CookieBarSiteConfig.FORCELANG", "Language"), $ForceLangSource);
        $ForceLangField->setEmptyString(_t("CookieBarSiteConfig.AUTODETECT", "Autodetect"));
        $ForceLangField->setDescription(_t("CookieBarSiteConfig.FORCELANG_DESCRIPTION", "(use language autodetection or force a specific language)"));
        $ThemeField = DropdownField::create('CbTheme', _t("CookieBarSiteConfig.THEME", "Theme"), $ThemeSource);
        $ThemeField->setEmptyString(_t("CookieBarSiteConfig.DEFAULT_BLACK", "Default (black)"));
        $RememberField = NumericField::create('CbRemember', _t("CookieBarSiteConfig.REMEMBER", "Remember choice for X days"));
        $RememberField->setDescription(_t("CookieBarSiteConfig.REMEMBER_DESCRIPTION", "(default 30 days, if you leave it empty or set 0, it will be 30 days)"));
        $PrivacyPageField = TreeDropdownField::create('CbPrivacyPageID', _t("CookieBarSiteConfig.PRIVACYPAGE", "PrivacyPage"), $SiteTreeSource);

        $fields->addFieldsToTab("Root."._t("CookieBarSiteConfig.COOKIEBAR", "CookieBAR"), array(
            $EnableField,
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
            $RememberField,
            $PrivacyPageField
        ));


    }

    public function CbOptions(){

        $array = array();

        if ($this->owner->CbTracking){
            $array['tracking'] = 1;
        }
        if ($this->owner->CbThirdParty){
            $array['thirdparty'] = 1;
        }
        if ($this->owner->CbAlways){
            $array['always'] = 1;
        }
        if ($this->owner->CbNoGeoIp){
            $array['noGeoIp'] = 1;
        }
        if ($this->owner->CbScrolling){
            $array['scrolling'] = 1;
        }
        if ($this->owner->CbRefreshPage){
            $array['refreshPage'] = 1;
        }
        if ($this->owner->CbTop){
            $array['top'] = 1;
        }
        if ($this->owner->CbShowNoConsent){
            $array['showNoConsent'] = 1;
        }
        if ($this->owner->CbHideDetailsBtn){
            $array['hideDetailsBtn'] = 1;
        }
        if ($this->owner->CbBlocking){
            $array['blocking'] = 1;
        }
        if ($this->owner->CbRemember <> 30 && $this->owner->CbRemember > 0){
            $array['remember'] = $this->owner->CbRemember;
        }
        if ($this->owner->CbTheme){
            $array['theme'] = $this->owner->CbTheme;
        }
        if ($this->owner->CbForceLang){
            $array['forceLang'] = $this->owner->CbForceLang;
        }
        if ($this->owner->CbPrivacyPageID){
            $array['privacyPage'] = $this->owner->CbPrivacyPage()->AbsoluteLink();
        }

        return $array;

    }

}