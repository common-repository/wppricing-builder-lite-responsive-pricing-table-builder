<?php
if(!defined('ABSPATH')) die('Direct access of plugin file not allowed');

class wbrptGeneralSettings {
    static $data;
    static function init()
    {
        $rmpptGeneralSettings = array();

        $rmpptGeneralSettings[ 'controlList' ] = array(
            'base' => array(
                'DetailText'          => array( 'text', 'Detail text', '', array( true ) ),
                'FeaturesColumnWidth' => array( 'select', 'Features column width', '', array(
                    ''   => 'Default',
                    'xs' => 'Extra small (180px)',
                    'sm' => 'Small (220px)',
                    'md' => 'Medium (240px)',
                    'lg' => 'Large (280px)'
                ))
            ),
            'column' => array(
                'PlanMakeInactive'         => array( 'checkbox', 'Make this plan inactive', false, array( 'fa fa-lock', 'plan-state', null ) ),
                'PlanHighlight'            => array( 'checkbox', 'Highlight this plan', false, array( 'fa fa-rocket', 'plan-state', null ) ),
                'PlanShowCaption'          => array( 'checkbox', 'Show plan caption', false, array( 'fa fa-header', null, array( 'PlanCaptionHeader', 'PlanCaptionText' ) ) ),
                'PlanShowPriceCaption'     => array( 'checkbox', 'Show price caption', false, array( 'fa fa-cart-arrow-down', null, array( 'PlanPriceCaptionText' ) ) ),
                'PlanShowMostPopularSign'  => array( 'checkbox', "Show 'most popular' sign", false, array( 'fa fa-bolt', 'plan-sign', array( 'PlanMostPopularSignText' ) ) ),
                'PlanShowDiscountSign'     => array( 'checkbox', "Show 'discount' sign", false, array( 'fa fa-money', 'plan-sign', array( 'PlanDiscountSignText' ) ) ),
                'PlanShowNotAvailableSign' => array( 'checkbox', "Show 'not available' sign", false, array( 'fa fa-ban', 'plan-sign', array( 'PlanNotAvailableSignText' ) ) ),
                'PlanShowDiscountRibbon'   => array( 'checkbox', "Show 'discount' ribbon", false, array( 'fa fa-bookmark-o', 'plan-ribbon', array( 'PlanDiscountRibbonText' ) ) ),
                'PlanShowNewRibbon'        => array( 'checkbox', "Show 'new' ribbon", false, array( 'fa fa-bookmark', 'plan-ribbon', array( 'PlanNewRibbonText' ) ) ),
                'PlanShowRatingIcons'      => array( 'checkbox', 'Show rating icons', false, array( 'fa fa-star', null, array( 'PlanRatingIconsText' ) ) ),
                'PlanName'                 => array( 'text', 'Pricing plan name', '', array( true ) ),
                'PlanImageURL'             => array( 'image', 'Pricing plan image', '' ),
                'PlanIframeURL'            => array( 'text', 'Plan iframe URL', '', array( false ) ),
                'PlanPurchaseButtonName'   => array( 'text', 'Purchase button name', '', array( true ) ),
                'PlanPurchaseButtonLink'   => array( 'text', 'Purchase button link', '', array( false ) ),
                'PlanPurchaseButtonCode'   => array( 'text', 'Purchase button code', '', array( false ) ),
                'PlanPrice'                => array( 'text', 'Plan price', '', array( true ) ),
                'PlanCurrencySymbol'       => array( 'text', 'Currency symbol', '', array( true ) ),
                'PlanCaptionHeader'        => array( 'text', 'Plan caption header', '', array( true ) ),
                'PlanCaptionText'          => array( 'text', 'Plan caption text', '', array( true ) ),
                'PlanPriceCaptionText'     => array( 'text', 'Price caption text', '', array( true ) ),
                'PlanDiscountSignText'     => array( 'text', "Text for 'discount' sign", '', array( true ) ),
                'PlanMostPopularSignText'  => array( 'text', "Text for 'most popular' sign", '', array( true ) ),
                'PlanNotAvailableSignText' => array( 'text', "Text for 'not available' sign", '', array( true ) ),
                'PlanNewRibbonText'        => array( 'text', "Text for 'new' ribbon", '', array( true ) ),
                'PlanDiscountRibbonText'   => array( 'text', "Text for 'discount' ribbon", '', array( true ) ),
                'PlanRatingIconsText'      => array( 'text', 'Text for rating icons', '', array( true ) ),
                'PlanDetailsButtonName'    => array( 'text', 'Details button name', '', array( true ) ),
                'PlanDetailsButtonLink'    => array( 'text', 'Details button link', '', array( false ) )
            ),
            'row' => array(
                'FeatureName'            => array( 'text', 'Feature name', '', array( true ) ),
                'FeatureRowHeight'       => array( 'select', 'Feature row height', 1, array(
                    1 => 'Single',
                    2 => 'Double',
                    3 => 'Triple'
                ))
            ),
            'cell' => array(
                'FeatureValue'                   => array( 'text', 'Feature value', '', array( true ) ),
                'FeatureValuePrice'                => array( 'text', 'Feature value price', '', array( true ) ),
                'FeatureValueCurrencySymbol'       => array( 'text', 'Currency symbol', '', array( true ) ),
                'FeatureValuePurchaseButtonName'   => array( 'text', 'Purchase button name', '', array( true ) ),
                'FeatureValuePurchaseButtonLink'   => array( 'text', 'Purchase button link', '', array( false ) ),
                'FeatureValuePurchaseButtonCode'   => array( 'text', 'Purchase button code', '', array( false ) )
            )
        );

        $rmpptGeneralSettings[ 'designList' ] = array(
            'crpt-modern' => array( 
                'name'       => 'Modern',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-modern/'
            ),
            'crpt-colorful' => array(
                'name'       => 'Colorful',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-colorful/'
            ),
            'crpt-extra' => array(
                'name'       => 'Extra',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-extra/'
            ),
            'crpt-exo' => array(
                'name'         => 'Exo',
                'controlList'  => array( 'FeaturesColumnWidth', 'PlanMakeInactive', 'PlanHighlight', 'PlanShowPriceCaption', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'PlanPriceCaptionText', 'FeatureName', 'FeatureRowHeight', 'FeatureValue' ),
                'template'     => 'crptExo.php',
                'importFile'   => 'crptCommon.txt',
                'defaultColor' => 'ff8000',
                'colorFile'    => 'crptExo.php',
                'styleList'    => array(
                    'google-font-exo2-400-500'
                )
            ),
            'crpt-hipo' => array(
                'name'       => 'Hipo',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-hipo/'
            ),
            'crpt-advanced' => array(
                'name'                 => 'Advanced',
                'navigationItemNumber' => 3,
                'controlList'          => array( 'FeaturesColumnWidth', 'PlanMakeInactive', 'PlanHighlight', 'PlanShowMostPopularSign', 'PlanShowDiscountSign', 'PlanShowNotAvailableSign', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'PlanDiscountSignText', 'PlanMostPopularSignText', 'PlanNotAvailableSignText', 'FeatureName', 'FeatureRowHeight', 'FeatureValue' ),
                'template'             => 'crptAdvanced.php',
                'importFile'           => 'crpt3Versions.txt',
                'defaultColor'         => '333333',
                'colorFile'            => 'crptAdvanced.php',
                'styleList'            => array(
                    'google-font-abeezee'
                )
            ),
            'crpt-simple' => array(
                'name'       => 'Simple',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-simple/'
            ),
            'crpt-tabby' => array(
                'name'       => 'Tabby',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-tabby/'
            ),
            'crpt-flat' => array(
                'name'       => 'Flat',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-flat/'
            ),
            'crpt-ribbon' => array(
                'name'       => 'Ribbon',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-ribbon/'
            ),
            'crpt-plain' => array(
                'name'       => 'Plain',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-plain/'
            ),
            'crpt-frame' => array(
                'name'       => 'Frame',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-frame/'
            ),
            'crpt-plaid' => array(
                'name'       => 'Plaid',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/comparative-responsive-pricing-tables-plaid/'
            ),
            'rmsbpt-modern' => array(
                'name'       => 'Modern',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/responsive-multi-style-bootstrap-pricing-tables-modern/'
            ),
            'rmsbpt-flat' => array(
                'name'         => 'Flat',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanShowCaption', 'PlanShowPriceCaption', 'PlanShowMostPopularSign', 'PlanShowDiscountSign', 'PlanShowNotAvailableSign', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'PlanCaptionText', 'PlanPriceCaptionText', 'PlanDiscountSignText', 'PlanMostPopularSignText', 'PlanNotAvailableSignText', 'FeatureName', 'FeatureValue' ),
                'template'     => 'rmsbptFlat.php',
                'importFile'   => 'rmsbptExtraFlat.txt',
                'defaultColor' => '3499fe',
                'colorFile'    => 'rmsbptFlat.php',
                'styleList'    => array(
                    'google-font-abeezee'
                )
            ),
            'rmsbpt-extra' => array(
                'name'       => 'Extra',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/responsive-multi-style-bootstrap-pricing-tables-extra/'
            ),
            'csmrpt-solid' => array(
                'name'       => 'Solid',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/classic-solid-modern-responsive-pricing-tables-solid/'
            ),
            'csmrpt-modern' => array(
                'name'         => 'Modern',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanShowCaption', 'PlanShowMostPopularSign', 'PlanShowDiscountSign', 'PlanShowNotAvailableSign', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'PlanCaptionText', 'PlanDiscountSignText', 'PlanMostPopularSignText', 'PlanNotAvailableSignText', 'FeatureName', 'FeatureValue' ),
                'template'     => 'csmrptModern.php',
                'importFile'   => 'csmrptModern.txt',
                'defaultColor' => 'b22222',
                'colorFile'    => 'csmrptModern.php'
            ),
            'csmrpt-classic' => array(
                'name'       => 'Classic',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/classic-solid-modern-responsive-pricing-tables-classic/'
            ),
            'smoozy-style1' => array(
                'name'       => 'Style 1',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-1/'
            ),
            'smoozy-style2' => array(
                'name'         => 'Style 2',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanShowCaption', 'PlanDesignColor', 'PlanName', 'PlanImageURL', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanCaptionText', 'FeatureValue', 'FeatureValuePrice', 'FeatureValueCurrencySymbol' ),
                'template'     => 'smoozyStyle2Style3.php',
                'importFile'   => 'smoozyStyle1Style2.txt',
                'defaultColor' => 'ed4d13',
                'colorFile'    => 'smoozyStyle2.php',
                'styleList'    => array(
                    'google-font-amaranth-400-italic',
                    'google-font-alegreya-sans-500',
                    'google-font-allura'
                )
            ),
            'smoozy-style3' => array(
                'name'         => 'Style 3',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanShowCaption', 'PlanDesignColor', 'PlanName', 'PlanImageURL', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanCaptionText', 'FeatureValue', 'FeatureValuePrice', 'FeatureValueCurrencySymbol' ),
                'template'     => 'smoozyStyle2Style3.php',
                'importFile'   => 'smoozyStyle3Style5.txt',
                'defaultColor' => '9400d3',
                'colorFile'    => 'smoozyStyle3.php',
                'styleList'    => array(
                    'google-font-amaranth-400-italic',
                    'google-font-alegreya-sans-500',
                    'google-font-allura'
                )
            ),
            'smoozy-style4' => array(
                'name'       => 'Style 4',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-4/'
            ),
            'smoozy-style5' => array(
                'name'       => 'Style 5',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-5/'
            ),
            'smoozy-style6' => array(
                'name'       => 'Style 6',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-6/'
            ),
            'smoozy-style7' => array(
                'name'       => 'Style 7',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-7/'
            ),
            'smoozy-style8' => array(
                'name'       => 'Style 8',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-8/'
            ),
            'smoozy-style9' => array(
                'name'       => 'Style 9',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-9/'
            ),
            'smoozy-style10' => array(
                'name'       => 'Style 10',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-10/'
            ),
            'smoozy-style11' => array(
                'name'       => 'Style 11',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/smoozy-responsive-pricing-tables-style-11/'
            ),
            'flat-style1' => array(
                'name'       => 'Style 1',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/flat-responsive-pricing-tables-style-1/'
            ),
            'flat-style2' => array(
                'name'       => 'Style 2',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/flat-responsive-pricing-tables-style-2/'
            ),
            'flat-style3' => array(
                'name'       => 'Style 3',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/flat-responsive-pricing-tables-style-3/'
            ),
            'flat-style4' => array(
                'name'       => 'Style 4',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/flat-responsive-pricing-tables-style-4/'
            ),
            'flat-style5' => array(
                'name'       => 'Style 5',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/flat-responsive-pricing-tables-style-5/'
            ),
            'flat-style6' => array(
                'name'         => 'Style 6',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'FeatureName', 'FeatureValue' ),
                'template'     => 'flatStyle5Style6.php',
                'importFile'   => 'flatCommon.txt',
                'defaultColor' => 'b21325',
                'iconPattern'  => array( '$theme-color', '$block-background-color' ),
                'colorFile'    => 'flatStyle6.php',
                'styleList'    => array(
                    'google-font-roboto-300-400'
                )
            ),
            'flat-style7' => array(
                'name'       => 'Style 7',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/flat-responsive-pricing-tables-style-7/'
            ),
            'flat-style8' => array(
                'name'       => 'Style 8',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/flat-responsive-pricing-tables-style-8/'
            ),
            'ribbon-style1' => array(
                'name'       => 'Style 1',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/ribbon-responsive-pricing-tables-style-1/'
            ),
            'ribbon-style2' => array(
                'name'       => 'Style 2',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/ribbon-responsive-pricing-tables-style-2/'
            ),
            'ribbon-style3' => array(
                'name'       => 'Style 3',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/ribbon-responsive-pricing-tables-style-3/'
            ),
            'ribbon-style4' => array(
                'name'         => 'Style 4',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'FeatureValue' ),
                'template'     => 'ribbonStyle2Style3Style4.php',
                'importFile'   => 'ribbonCommon.txt',
                'defaultColor' => 'ff9700',
                'iconPattern'  => array( '$theme-color', '$block-background-color' ),
                'colorFile'    => 'ribbonStyle4.php',
                'styleList'    => array(
                    'google-font-roboto-300-400'
                )
            ),
            'ribbon-style5' => array(
                'name'       => 'Style 5',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/ribbon-responsive-pricing-tables-style-5/'
            ),
            'radius-style1' => array(
                'name'       => 'Style 1',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/radius-responsive-pricing-tables-style-1/'
            ),
            'radius-style2' => array(
                'name'       => 'Style 2',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/radius-responsive-pricing-tables-style-2/'
            ),
            'radius-style3' => array(
                'name'       => 'Style 3',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/radius-responsive-pricing-tables-style-3/'
            ),
            'radius-style4' => array(
                'name'       => 'Style 4',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/radius-responsive-pricing-tables-style-4/'
            ),
            'radius-style5' => array(
                'name'         => 'Style 5',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'FeatureValue' ),
                'template'     => 'radiusCommon.php',
                'importFile'   => 'radiusCommon.txt',
                'defaultColor' => '4d5873',
                'iconPattern'  => array( '$theme-color', '$block-background-color' ),
                'colorFile'    => 'radiusStyle5.php',
                'styleList'    => array(
                    'google-font-roboto-300-400-900'
                )
            ),
            'radius-style6' => array(
                'name'       => 'Style 6',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/radius-responsive-pricing-tables-style-6/'
            ),
            'radius-style7' => array(
                'name'       => 'Style 7',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/radius-responsive-pricing-tables-style-7/'
            ),
            'radius-style8' => array(
                'name'       => 'Style 8',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/radius-responsive-pricing-tables-style-8/'
            ),
            'sketch-style1' => array(
                'name'       => 'Style 1',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/sketch-responsive-pricing-tables-style-1/'
            ),
            'sketch-style2' => array(
                'name'       => 'Style 2',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/sketch-responsive-pricing-tables-style-2/'
            ),
            'sketch-style3' => array(
                'name'       => 'Style 3',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/sketch-responsive-pricing-tables-style-3/'
            ),
            'sketch-style4' => array(
                'name'       => 'Style 4',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/sketch-responsive-pricing-tables-style-4/'
            ),
            'sketch-style5' => array(
                'name'       => 'Style 5',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/sketch-responsive-pricing-tables-style-5/'
            ),
            'sketch-style6' => array(
                'name'         => 'Style 6',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'FeatureValue' ),
                'template'     => 'ribbonStyle2Style3Style4.php',
                'importFile'   => 'ribbonCommon.txt',
                'defaultColor' => '597489',
                'iconPattern'  => array( '$theme-color', '$active-block-border-color' ),
                'colorFile'    => 'sketchStyle6.php',
                'styleList'    => array(
                    'google-font-roboto-300-400'
                )
            ),
            'sketch-style7' => array(
                'name'       => 'Style 7',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/sketch-responsive-pricing-tables-style-7/'
            ),
            'gradient-style1' => array(
                'name'       => 'Style 1',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-1/'
            ),
            'gradient-style2' => array(
                'name'       => 'Style 2',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-2/'
            ),
            'gradient-style3' => array(
                'name'       => 'Style 3',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-3/'
            ),
            'gradient-style4' => array(
                'name'       => 'Style 4',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-4/'
            ),
            'gradient-style5' => array(
                'name'       => 'Style 5',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-5/'
            ),
            'gradient-style6' => array(
                'name'       => 'Style 6',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-6/'
            ),
            'gradient-style7' => array(
                'name'         => 'Style 7',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'FeatureValue' ),
                'template'     => 'gradientStyle7.php',
                'importFile'   => 'gradient3Features.txt',
                'defaultColor' => 'db6b55',
                'iconPattern'  => array( '$theme-color', '$active-block-background-gradient-end-color' ),
                'colorFile'    => 'gradientStyle7.php',
                'styleList'    => array(
                    'google-font-roboto-300-400'
                )
            ),
            'gradient-style8' => array(
                'name'       => 'Style 8',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-8/'
            ),
            'gradient-style9' => array(
                'name'       => 'Style 9',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-9/'
            ),
            'gradient-style10' => array(
                'name'       => 'Style 10',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-10/'
            ),
            'gradient-style11' => array(
                'name'       => 'Style 11',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-11/'
            ),
            'gradient-style12' => array(
                'name'       => 'Style 12',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-12/'
            ),
            'gradient-style13' => array(
                'name'       => 'Style 13',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/gradient-responsive-pricing-tables-style-13/'
            ),
            'rainbow-style1' => array(
                'name'       => 'Style 1',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rainbow-responsive-pricing-tables-style-1/'
            ),
            'rainbow-style2' => array(
                'name'       => 'Style 2',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rainbow-responsive-pricing-tables-style-2/'
            ),
            'rainbow-style3' => array(
                'name'       => 'Style 3',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rainbow-responsive-pricing-tables-style-3/'
            ),
            'rainbow-style4' => array(
                'name'       => 'Style 4',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rainbow-responsive-pricing-tables-style-4/'
            ),
            'rainbow-style5' => array(
                'name'         => 'Style 5',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanDesignColor', 'PlanName', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'FeatureValue' ),
                'template'     => 'rainbowStyle5.php',
                'importFile'   => 'rainbowCommon.txt',
                'defaultColor' => '802eaa',
                'iconPattern'  => array( '$theme-color', '$active-block-background-gradient-middle-color' ),
                'colorFile'    => 'rainbowStyle5.php',
                'styleList'    => array(
                    'google-font-roboto-300-400'
                )
            ),
            'rainbow-style6' => array(
                'name'       => 'Style 6',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rainbow-responsive-pricing-tables-style-6/'
            ),
            'rainbow-style7' => array(
                'name'       => 'Style 7',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rainbow-responsive-pricing-tables-style-7/'
            ),
            'rainbow-style8' => array(
                'name'       => 'Style 8',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rainbow-responsive-pricing-tables-style-8/'
            ),
            'rings-style1' => array(
                'name'       => 'Style 1',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rings-responsive-pricing-tables-style-1/'
            ),
            'rings-style2' => array(
                'name'       => 'Style 2',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rings-responsive-pricing-tables-style-2/'
            ),
            'rings-style3' => array(
                'name'       => 'Style 3',
                'previewURL' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/rings-responsive-pricing-tables-style-3/'
            ),
            'rings-style4' => array(
                'name'         => 'Style 4',
                'controlList'  => array( 'PlanMakeInactive', 'PlanHighlight', 'PlanDesignColor', 'PlanName', 'PlanImageURL', 'PlanPurchaseButtonName', 'PlanPurchaseButtonLink', 'PlanPurchaseButtonCode', 'PlanPrice', 'PlanCurrencySymbol', 'FeatureValue' ),
                'template'     => 'ringsStyle4.php',
                'importFile'   => 'ringsStyle3Style4.txt',
                'defaultColor' => '7c1962',
                'iconPattern'  => array( '$theme-color' ),
                'colorFile'    => 'ringsStyle4.php',
                'styleList'    => array(
                    'google-font-allura',
                    'google-font-amaranth-400-italic',
                    'google-font-roboto-400'
                )
            )
        );

        $rmpptGeneralSettings[ 'designGroupList' ] = array(
            'crpt' => array(
                'name'       => 'Comparative Responsive Pricing Tables',
                'designList' => array( 'crpt-modern', 'crpt-colorful', 'crpt-extra', 'crpt-exo', 'crpt-hipo', 'crpt-advanced', 'crpt-simple', 'crpt-tabby', 'crpt-flat', 'crpt-ribbon', 'crpt-plain', 'crpt-frame', 'crpt-plaid' )
            ),
            'rmsbpt' => array(
                'name'       => 'Responsive Multi Style Bootstrap Pricing Tables',
                'designList' => array( 'rmsbpt-modern', 'rmsbpt-flat', 'rmsbpt-extra' )
            ),
            'csmrpt' => array(
                'name'       => 'Classic Solid Modern - Responsive Pricing Tables',
                'designList' => array( 'csmrpt-solid', 'csmrpt-modern', 'csmrpt-classic' )
            ),
            'smoozy' => array(
                'name'       => 'Smoozy - Responsive Pricing Tables',
                'designList' => array( 'smoozy-style1', 'smoozy-style2', 'smoozy-style3', 'smoozy-style4', 'smoozy-style5', 'smoozy-style6', 'smoozy-style7', 'smoozy-style8', 'smoozy-style9', 'smoozy-style10', 'smoozy-style11' )
            ),
            'flat' => array(
                'name'       => 'Flat - Responsive Pricing Tables',
                'designList' => array( 'flat-style1', 'flat-style2', 'flat-style3', 'flat-style4', 'flat-style5', 'flat-style6', 'flat-style7', 'flat-style8' )
            ),
            'ribbon' => array(
                'name'       => 'Ribbon - Responsive Pricing Tables',
                'designList' => array( 'ribbon-style1', 'ribbon-style2', 'ribbon-style3', 'ribbon-style4', 'ribbon-style5' )
            ),
            'radius' => array(
                'name'       => 'Radius - Responsive Pricing Tables',
                'designList' => array( 'radius-style1', 'radius-style2', 'radius-style3', 'radius-style4', 'radius-style5', 'radius-style6', 'radius-style7', 'radius-style8' )
            ),
            'sketch' => array(
                'name'       => 'Sketch - Responsive Pricing Tables',
                'designList' => array( 'sketch-style1', 'sketch-style2', 'sketch-style3', 'sketch-style4', 'sketch-style5', 'sketch-style6', 'sketch-style7' )
            ),
            'gradient' => array(
                'name'       => 'Gradient - Responsive Pricing Tables',
                'designList' => array( 'gradient-style1', 'gradient-style2', 'gradient-style3', 'gradient-style4', 'gradient-style5', 'gradient-style6', 'gradient-style7', 'gradient-style8', 'gradient-style9', 'gradient-style10', 'gradient-style11', 'gradient-style12', 'gradient-style13' )
            ),
            'rainbow' => array(
                'name'       => 'Rainbow - Responsive Pricing Tables',
                'designList' => array( 'rainbow-style1', 'rainbow-style2', 'rainbow-style3', 'rainbow-style4', 'rainbow-style5', 'rainbow-style6', 'rainbow-style7', 'rainbow-style8' )
            ),
            'rings' => array(
                'name'       => 'Rings - Responsive Pricing Tables',
                'designList' => array( 'rings-style1', 'rings-style2', 'rings-style3', 'rings-style4' )
            )
        );

        $rmpptGeneralSettings[ 'additionalStyleList' ] = array(
            'google-font-amaranth-400-italic' => 'https://fonts.googleapis.com/css?family=Amaranth:400i',
            'google-font-alegreya-sans-500'   => 'https://fonts.googleapis.com/css?family=Alegreya+Sans:500',
            'google-font-allura'              => 'https://fonts.googleapis.com/css?family=Allura&subset=latin-ext',
            'google-font-exo2-400-500'        => 'https://fonts.googleapis.com/css?family=Exo+2:400,500&subset=cyrillic,latin-ext',
            'google-font-abeezee'             => 'https://fonts.googleapis.com/css?family=ABeeZee',
            'google-font-roboto-300-400'      => 'https://fonts.googleapis.com/css?family=Roboto:300,400&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese',
            'google-font-roboto-400-700'      => 'https://fonts.googleapis.com/css?family=Roboto:400,700&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese',
            'google-font-roboto-300-400-500'  => 'https://fonts.googleapis.com/css?family=Roboto:300,400,500&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese',
            'google-font-roboto-300-400-700'  => 'https://fonts.googleapis.com/css?family=Roboto:300,400,700&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese',
            'google-font-roboto-300-400-900'  => 'https://fonts.googleapis.com/css?family=Roboto:300,400,900&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese',
            'google-font-roboto-400'          => 'https://fonts.googleapis.com/css?family=Roboto:400&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese'
        );

        $rmpptGeneralSettings[ 'fullVersion' ] = array(
            'livepreviewLink' => 'https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables/'
        );

        self::$data = $rmpptGeneralSettings;
    }
}