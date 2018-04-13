<?php

namespace Hestec\CookieBar;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;


class CookieBar extends Extension
{

    public function onAfterInit(){

        Requirements::javascript("https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js");

    }

}
