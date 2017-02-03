<?php

class FeesAdmin extends ModelAdmin
{

    private static $menu_title = 'Fees';

    private static $url_segment = 'Fees';

    private static $managed_models = array(
        'Fees',
        'FeesType'
    );

    private static $menu_icon = 'mysite/icons/Money.png';
}