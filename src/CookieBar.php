<?php

namespace Hestec\CookieBar;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;
use SilverStripe\SiteConfig\SiteConfig;


class CookieBar extends Extension
{

    public function onAfterInit(){

        $siteConfig = SiteConfig::current_site_config();
        if ($siteConfig->CbEnable) {
            if (http_build_query($siteConfig->CbOptions())) {

                Requirements::javascript("https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?" . http_build_query($siteConfig->CbOptions()));

            } else {

                Requirements::javascript("https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js");

            }
        }

    }

}
