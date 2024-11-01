<?php
/*
Plugin Name: wpPricing Builder Lite - Responsive Pricing Table Builder
Plugin URI: https://swebdeveloper.com/apps/wordpress-builder-responsive-pricing-tables
Description: Build your Pricing Tables in few minutes
Author: Swebdeveloper
Version: 1.5.0
*/

if(!defined('ABSPATH'))
    die('Direct access of plugin file not allowed');

include( plugin_dir_path( __FILE__ ) . 'includes/wbrptSettings.php' );
wbrptGeneralSettings::init();

add_action( 'init', 'wbrpt_pricing_table_init' );

function wbrpt_pricing_table_init() 
{
    $labels = array(
        'name'               => _x( 'Pricing Tables', 'post type general name' ),
        'singular_name'      => _x( 'Pricing Table', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'pricing-table' ),
        'add_new_item'       => __( 'Add New Pricing Table' ),
        'edit_item'          => __( 'Edit Pricing Table' ),
        'new_item'           => __( 'New Pricing Table' ),
        'all_items'          => __( 'All Pricing Tables' ),
        'view_item'          => __( 'View Pricing Table' ),
        'search_items'       => __( 'Search Pricing Tables' ),
        'not_found'          => __( 'No Pricing Table found' ),
        'not_found_in_trash' => __( 'No Pricing Tables found in Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => __( 'Pricing Tables' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title' ),
        'menu_icon'          => plugin_dir_url( __FILE__ ) . 'assets/admin/images/menu-icon.gif'
    );

    register_post_type( 'wbr-pricing-table' , $args );
}

function wbrpt_control_menu() {
    global $submenu;
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    $submenu[ 'edit.php?post_type=wbr-pricing-table' ][ 500 ] = array( '<span id="wbrpt-submenu-upgrade-full-version">' . __( 'Upgrade to Full Version' ) . '</span>', 'install_plugins' , $wbrptGeneralSettings[ 'fullVersion' ][ 'livepreviewLink' ] );
}

add_action( 'admin_menu', 'wbrpt_control_menu' );

function wbrpt_add_meta_boxes()
{
    add_meta_box(
        'wbr-pricing-table-design-color-meta-box',
        'Design and color theme',
        'wbrpt_meta_box_desing_color_callback',
        'wbr-pricing-table',
        'advanced',
        'low'
    );

    add_meta_box(
        'wbr-pricing-table-plans-features-meta-box',
        'Plans and features',
        'wbrpt_meta_box_plans_features_callback',
        'wbr-pricing-table',
        'advanced',
        'low'
    );
}

add_action( 'add_meta_boxes', 'wbrpt_add_meta_boxes' );

function wbrpt_meta_box_desing_color_callback( $post )
{
    $pluginFile = __FILE__;
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    $value = wbrpt_get_design_color_meta( $post->ID );
    wbrpt_get_available_design_color_list( $value[ 'design' ] );
    wbrpt_get_design_color_variable_list( $value[ 'design' ] );
    if( empty( $value[ 'color' ] ) || !isset( $wbrptGeneralSettings[ 'designList' ][ $value[ 'design' ] ][ 'colorList' ][ $value[ 'color' ] ] ) ) {
        $value[ 'color' ] = wbrpt_get_default_color( $value[ 'design' ] );
    }
    if( !isset( $value[ 'animation' ] ) ) {
        $value[ 'animation' ] = 0;
    }
    include( 'templates/admin/metaBoxDesingColor.php' );
}

function wbrpt_meta_box_plans_features_callback( $post )
{
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    $designID = wbrpt_get_design_color_meta( $post->ID, 'design' );
    wbrpt_get_available_design_color_list( $designID );
    $value = get_post_meta( $post->ID, 'wbrpt_plans_features', true );
    if( empty( $value ) ) {
        $value = array( 1 => array(
            'PlanName'    => array( 1 => '', 2 => '' ),
            'FeatureName' => array( 1 => '', 2 => '' )
        ));
    }
    /* Backward compatibility with older versions */
    if( isset( $value[ 'PlanName' ] ) || isset( $value[ 'FeatureName' ] ) ) {
        $value = array( 1 => $value );
    }
    wbrpt_plans_features_default_value( $value, $designID );
    include( 'templates/admin/metaBoxPlansFeatures.php' );
}

function wbrpt_get_design_color_meta( $postID, $attributeID = null )
{
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    $value = get_post_meta( $postID, 'wbrpt_design_color', true );
    if( !is_array( $value ) ) {
        $value = array();
    }
    if( empty( $value[ 'design' ] ) || !isset( $wbrptGeneralSettings[ 'designList' ][ $value[ 'design' ] ][ 'controlList' ] ) ) {
        foreach( $wbrptGeneralSettings[ 'designList' ] as $identifier => $design ) {
            if( isset( $design[ 'controlList' ] ) ) {
                $value[ 'design' ] = $identifier;
                break;
            }
        }
    }
    if( !empty( $attributeID ) && isset( $value[ $attributeID ] ) ) {
        return $value[ $attributeID ];
    }
    return $value;
}

function wbrpt_get_default_color( $designID )
{
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    if( isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorList' ][ $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'defaultColor' ] ] ) ) {
        return $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'defaultColor' ];
    }
    reset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorList' ] );
    return key( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorList' ] );
}

function wbrpt_get_available_design_color_list( $designID, $return = false, $raw = false )
{
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    if( !$return ) {
        $raw = false;
    }
    if( !$raw ) {
        $default = array( '$theme-color' => '#' . $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'defaultColor' ] );
        $getDefault = true;
        include( 'includes/color/style/' . $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorFile' ] );
        $colorVariableNameList = array_keys( $default );
    }
    $colorList = array();
    foreach( glob( plugin_dir_path( __FILE__ ) . 'assets/css/pt-color/' . $designID . '/*.css' ) as $fileName ) {
        $f = fopen( $fileName, 'r' );
        $line = fgets( $f );
        fclose( $f );
        if( !preg_match( '/^\/\*[\-a-f0-9]+:[\-a-f0-9]+\*\/$/', $line ) ) {
            continue;
        }
        if( $raw ) {
            $colorList[ basename( $fileName, '.css' ) ] = trim( $line );
        } else {
            $colorHash = explode( ':', trim( $line, "\n/*" ) );
            $colorList[ basename( $fileName, '.css' ) ][ 'icon' ] = explode( '-', $colorHash[ 0 ] );
            $colorList[ basename( $fileName, '.css' ) ][ 'vars' ] = array_combine( $colorVariableNameList, explode( '-', $colorHash[ 1 ] ) );
        }
    }
    if( $return ) {
        return $colorList;
    }
    if( empty( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorList' ] ) ) {
        $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorList' ] = $colorList;
    }
}

function wbrpt_get_design_color_variable_list( $designID )
{
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    $default = array( '$theme-color' => '#' . $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'defaultColor' ] );
    $getDefault = true;
    ob_start();
    include( 'includes/color/style/' . $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorFile' ] );
    ob_end_clean();
    if( empty( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorVariableList' ] ) ) {
        $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorVariableList' ] = $default;
    }
}

/* Loading styles in admin panel for edit page */
function wbrpt_enqueue_admin_styles_scripts( $hook )
{
    if( current_user_can( 'install_plugins' ) ) {
        wp_register_script( 'wbr-main', plugins_url( 'assets/admin/js/main.js', __FILE__ ), array( 'jquery' ) );
        wp_enqueue_script( 'wbr-main' );
    }

    $pages = array( 'post-new.php', 'post.php' );
    if( !in_array( $hook, $pages ) ) {
        return;
    }

    global $post;

    /* These files are required for all 'edit' pages to make the 'Insert pricing table' button work in TinyMCE */
    wp_register_style( 'wbr-main', plugins_url( 'assets/admin/css/main.css', __FILE__ ) );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-dialog' );
    wp_enqueue_style( 'wp-jquery-ui-dialog' );
    wp_enqueue_style( 'wbr-main' );

    if( $post->post_type != 'wbr-pricing-table' ) {
        return;
    }

    wp_enqueue_media( array( 'post' => $post->ID ) );

    wp_register_script( 'wbr-jquery-spectrum', plugins_url( 'assets/js/spectrum.js', __FILE__ ), array( 'jquery' ) );
    wp_register_script( 'wbr-jquery-scroll-to', plugins_url( 'assets/js/jquery.scrollTo.min.js', __FILE__ ), array( 'jquery' ) );
    wp_register_script( 'wbr-table-drag-drop', plugins_url( 'assets/admin/js/table-drag-drop.js', __FILE__ ), array( 'jquery' ) );
    wp_register_script( 'wbr-pricing-table-editor', plugins_url( 'assets/admin/js/pricing-table-editor.js', __FILE__ ), array( 'wbr-jquery-scroll-to', 'jquery-ui-position', 'wbr-table-drag-drop', 'wbr-jquery-spectrum' ) );
    wp_register_style( 'wbr-jquery-spectrum', plugins_url( 'assets/css/spectrum.css', __FILE__ ) );
    wp_register_style( 'wbr-font-awesome', plugins_url( 'assets/css/font-awesome.min.css', __FILE__ ) );
    wp_register_style( 'wbr-table-drag-drop', plugins_url( 'assets/admin/css/table-drag-drop.css', __FILE__ ) );
    wp_register_style( 'wbr-pricing-table-design', plugins_url( 'assets/admin/css/pricing-table-design.css', __FILE__ ) );
    wp_register_style( 'wbr-pricing-table-editor', plugins_url( 'assets/admin/css/pricing-table-editor.css', __FILE__ ), array( 'wbr-font-awesome', 'wbr-table-drag-drop', 'wbr-pricing-table-design', 'wbr-jquery-spectrum' ) );

    wp_enqueue_script( 'wbr-pricing-table-editor' );
    wp_enqueue_style( 'wbr-pricing-table-editor' );
}

add_action( 'admin_enqueue_scripts', 'wbrpt_enqueue_admin_styles_scripts' );

function wbrpt_meta_box_post_data_processing()
{
    /* If there are no plans, then it's pointless to do something! */
    if( !isset( $_POST[ 'wbrptData' ] ) || empty( $_POST[ 'wbrptData' ] ) ) return;

    $plansFeaturesData = array();
    foreach( $_POST[ 'wbrptData' ] as $index => $instance ) {
        $plansFeaturesData[ $index ] = json_decode( stripcslashes( $instance ), true );
    }

    if( isset( $_POST[ 'wbrptActiveInstance' ] ) && isset( $plansFeaturesData[ $_POST[ 'wbrptActiveInstance' ] ] ) ) {
        $plansFeaturesData[ $_POST[ 'wbrptActiveInstance' ] ][ 'ActiveInstance' ] = true;
    }

    $designColorData = array();
    $designColorData[ 'design' ] = isset( $_POST[ 'wbrptDesign' ] ) ? $_POST[ 'wbrptDesign' ] : '';
    $designColorData[ 'color' ] = isset( $_POST[ 'wbrptColor' ] ) ? $_POST[ 'wbrptColor' ] : '';
    $designColorData[ 'animation' ] = isset( $_POST[ 'wbrptAnimation' ] ) ? $_POST[ 'wbrptAnimation' ] : 0;

    return array( 'plansFeatures' => $plansFeaturesData, 'designColor' => $designColorData );
}

function wbrpt_clean_empty_plans_features_data( $value )
{
    $defaultList = array(
        'FeatureTooltipPosition'      => 't',
        'FeatureValueTooltipPosition' => 't',
        'FeatureRowHeight'            => '1',
        'FeatureValueTooltipType'     => '0',
        'FeatureTooltipType'          => '0'
    );

    foreach( $value as &$instance ) {
        foreach( $instance as $key => &$item ) {
            if( $key == 'PlanName' || $key == 'FeatureName' ) {
                continue;
            }
            if( is_array( $item ) ) {
                $item = wbrpt_array_filter( $item, ( isset( $defaultList[ $key ] ) ? $defaultList[ $key ] : null ) );
                if( $item === array() ) unset( $instance[ $key ] );
            }
        }
    }

    return $value;
}

function wbrpt_array_filter( $value, $default = null )
{
    foreach( $value as &$item ) {
        if( is_array( $item ) ) {
            $item = wbrpt_array_filter( $item, $default );
        }
    }
    return array_filter( $value, function( $var ) use( $default ) {
        return !( $var === '' || $var === false || $var === 0 || $var === array() || $var === $default );
    });
}

function wbrpt_get_template_result( $gtrTemplatePath, $gtrTemplateVars = array() )
{
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    foreach( $gtrTemplateVars as $varName => $varValue ) {
        $$varName = $varValue;
    }
    ob_start();
    include $gtrTemplatePath;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

function wbrpt_plans_features_default_value( &$value, $designID ) 
{
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    $designControlList = array_fill_keys( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'controlList' ], true );
    $navigationControlList = array();
    if( isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'navigationItemNumber' ] ) ) {
        for( $number = 1; $number <= $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'navigationItemNumber' ]; $number++ ) {
            $navigationControlList[ 'NavigationName' ][ $number ] = '';
            $navigationControlList[ 'NavigationLink' ][ $number ] = '';
        }
        $navigationControlList[ 'ActiveNavigation' ] = 0;
    }
    foreach( $value as $index => $instance ) {
        if( $navigationControlList !== array() ) {
            $value[ $index ] = array_replace_recursive( $navigationControlList, $value[ $index ] );
        }
        foreach( $wbrptGeneralSettings[ 'controlList' ][ 'base' ] as $controlID => $controlSettings ) {
            if( !isset( $designControlList[ $controlID ] ) ) continue;
            if( !isset( $value[ $index ][ $controlID ] ) ) {
                $value[ $index ][ $controlID ] = $controlSettings[ 2 ];
            }
        }
        foreach( array_merge( $wbrptGeneralSettings[ 'controlList' ][ 'column' ], array( 'PlanDesignColor' => array( 2 => '' ) ) ) as $controlID => $controlSettings ) {
            if( !isset( $designControlList[ $controlID ] ) ) continue;
            foreach( $value[ $index ][ 'PlanName' ] as $planID => $planName ) {
                if( !isset( $value[ $index ][ $controlID ][ $planID ] ) ) {
                    $value[ $index ][ $controlID ][ $planID ] = $controlSettings[ 2 ];
                }
            }
        }
        foreach( $wbrptGeneralSettings[ 'controlList' ][ 'row' ] as $controlID => $controlSettings ) {
            if( !isset( $designControlList[ $controlID ] ) ) continue;
            foreach( $value[ $index ][ 'FeatureName' ] as $featureID => $featureName ) {
                if( !isset( $value[ $index ][ $controlID ][ $featureID ] ) ) {
                    $value[ $index ][ $controlID ][ $featureID ] = $controlSettings[ 2 ];
                }
            }
        }
        foreach( $wbrptGeneralSettings[ 'controlList' ][ 'cell' ] as $controlID => $controlSettings ) {
            if( !isset( $designControlList[ $controlID ] ) ) continue;
            foreach( $value[ $index ][ 'PlanName' ] as $planID => $planName ) {
                foreach( $value[ $index ][ 'FeatureName' ] as $featureID => $featureName ) {
                    if( !isset( $value[ $index ][ $controlID ][ $planID ][ $featureID ] ) ) {
                        $value[ $index ][ $controlID ][ $planID ][ $featureID ] = $controlSettings[ 2 ];
                    }
                }
            }
        }
    }
}

/* Storing values in DB */
function wbrpt_save_meta_box_data( $post_id )
{
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post', $post_id ) ) return;
    if( get_post_type() != 'wbr-pricing-table' ) return;

    $metaData = wbrpt_meta_box_post_data_processing();
    if( is_null( $metaData ) ) return;

    update_post_meta( $post_id, 'wbrpt_design_color', $metaData[ 'designColor' ] );
    update_post_meta( $post_id, 'wbrpt_plans_features', wbrpt_clean_empty_plans_features_data( $metaData[ 'plansFeatures' ] ) );

    if ( !wp_is_post_revision( $post_id ) ){
        remove_action( 'save_post', 'wbrpt_save_meta_box_data' );
        $content = wbrpt_generate_pricing_table_content( $metaData[ 'designColor' ], $metaData[ 'plansFeatures' ], $post_id );
        wp_update_post( array( 
            'ID'           => $post_id,
            'post_content' => $content
        ), true );
        add_action( 'save_post', 'wbrpt_save_meta_box_data' );
    }
}

add_action( 'save_post', 'wbrpt_save_meta_box_data' );

function wbrpt_enqueue_styles_scripts()
{
    wp_register_style( 'wbr-font-awesome', plugins_url( 'assets/css/font-awesome.min.css', __FILE__ ) );
    wp_register_style( 'wbr-pricing-tables', plugins_url( 'assets/css/pricing-tables.css', __FILE__ ) );
    wp_register_script( 'wbr-purchase-button-code', plugins_url( 'assets/js/purchase-button-code.js', __FILE__ ), array( 'jquery' ) );
    wp_register_script( 'wbr-repeated-pricing-table', plugins_url( 'assets/js/repeated-pricing-table.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_style( 'wbr-pricing-tables' ) ;
}

add_action( 'wp_enqueue_scripts', 'wbrpt_enqueue_styles_scripts' );

function wbrpt_generate_pricing_table_content( $ptDesignColorMeta, $ptPlansFeaturesListMeta, $pricingTableID = 0 )
{
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    $ptDesign = $ptDesignColorMeta[ 'design' ];
    $ptColor = $ptDesignColorMeta[ 'color' ];
    $template = $wbrptGeneralSettings[ 'designList' ][ $ptDesign ][ 'template' ];
    foreach( $ptPlansFeaturesListMeta as $index => $ptPlansFeaturesMeta ) {
        if( isset( $ptPlansFeaturesListMeta[ $index ][ 'PlanPurchaseButtonCode' ] ) ) {
            foreach( $ptPlansFeaturesListMeta[ $index ][ 'PlanPurchaseButtonCode' ] as $planID => $planPurchaseButtonCode ) {
                if( trim( $planPurchaseButtonCode ) != '' ) {
                    $ptPlansFeaturesListMeta[ $index ][ 'PlanPurchaseButtonLink' ][ $planID ] = '#wbrpt-purchase-button-' . $pricingTableID . '-' . $index . '-' . $planID;
                }
            }
        }
        if( isset( $ptPlansFeaturesListMeta[ $index ][ 'FeatureValuePurchaseButtonCode' ] ) ) {
            foreach( $ptPlansFeaturesListMeta[ $index ][ 'FeatureValuePurchaseButtonCode' ] as $planID => $featureValuePurchaseButtonCodeList ) {
                foreach( $featureValuePurchaseButtonCodeList as $featureID => $featureValuePurchaseButtonCode ) {
                    if( trim( $featureValuePurchaseButtonCode ) != '' ) {
                        $ptPlansFeaturesListMeta[ $index ][ 'FeatureValuePurchaseButtonLink' ][ $planID ][ $featureID ] = '#wbrpt-purchase-button-' . $pricingTableID . '-' . $index . '-' . $planID . '-' . $featureID;
                    }
                }
            }
        }
    }
    ob_start();
    include( 'templates/pricingTable.php' );
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

/* Adding shortcode - tag for XML attributes */
function wbrpt_add_short_code( $attributes )
{
    static $purchaseButtonBlockIDList = array();
    static $repeatedInstancePricingTableList = array();

    if( !isset( $attributes[ 'id' ] ) ) {
        return __( 'Pricing table ID is undefined!' );
    }
    $pricingTableID = intval( $attributes[ 'id' ] );
    $pricingTablePost = get_post( $pricingTableID );
    if( $pricingTablePost === null ) {
        return __( 'Pricing table with current ID cannot be found!' );
    }
    if( $pricingTablePost->post_type != 'wbr-pricing-table' ) {
        return __( 'Post with current ID is not pricing table!' );
    }
    if( $pricingTablePost->post_status != 'publish' ) {
        return __( 'Current pricing table is not published!' );
    }

    $ptDesignColorMeta = get_post_meta( $pricingTableID, 'wbrpt_design_color', true );
    $ptPlansFeaturesMeta = get_post_meta( $pricingTableID, 'wbrpt_plans_features', true );

    /* Backward compatibility with older versions */
    if( isset( $ptPlansFeaturesMeta[ 'PlanName' ] ) || isset( $ptPlansFeaturesMeta[ 'FeatureName' ] ) ) {
        $ptPlansFeaturesMeta = array( 1 => $ptPlansFeaturesMeta );
    }

    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;

    if( isset( $wbrptGeneralSettings[ 'designList' ][ $ptDesignColorMeta[ 'design' ] ][ 'styleList' ] ) ) {
        foreach( $wbrptGeneralSettings[ 'designList' ][ $ptDesignColorMeta[ 'design' ] ][ 'styleList' ] as $additionalStyleIdentifier ) {
            if( isset( $wbrptGeneralSettings[ 'additionalStyleList' ][ $additionalStyleIdentifier ] ) ) {
                wp_enqueue_style( 'wbr-' . $additionalStyleIdentifier, $wbrptGeneralSettings[ 'additionalStyleList' ][ $additionalStyleIdentifier ] );
            }
        }
    }

    wp_enqueue_style( 'wbr-pricing-tables-' . $ptDesignColorMeta[ 'design' ], plugins_url( 'assets/css/pt-' . $ptDesignColorMeta[ 'design' ] . '.css', __FILE__ ), array( 'wbr-font-awesome' ) );
    wp_enqueue_style( 'wbr-pricing-tables-color-' . $ptDesignColorMeta[ 'design' ] . '-' . $ptDesignColorMeta[ 'color' ], plugins_url( 'assets/css/pt-color/' . $ptDesignColorMeta[ 'design' ] . '/' . $ptDesignColorMeta[ 'color' ] . '.css', __FILE__ ), array( 'wbr-pricing-tables-' . $ptDesignColorMeta[ 'design' ] ) );

    $pricingTableCode = '';
    foreach( $ptPlansFeaturesMeta as $index => $instance ) {
        if( isset( $ptPlansFeaturesMeta[ $index ][ 'PlanPurchaseButtonCode' ] ) ) {
            foreach( $ptPlansFeaturesMeta[ $index ][ 'PlanPurchaseButtonCode' ] as $planID => $planPurchaseButtonCode ) {
                if( ( trim( $planPurchaseButtonCode ) != '' ) && !in_array( $pricingTableID . '-' . $index . '-' . $planID, $purchaseButtonBlockIDList ) ) {
                    wp_enqueue_script( 'wbr-purchase-button-code' );
                    $pricingTableCode .= '<div id="wbrpt-purchase-button-' . $pricingTableID . '-' . $index . '-' . $planID . '">' . do_shortcode( $planPurchaseButtonCode ) . '</div>';
                    $purchaseButtonBlockIDList[] = $pricingTableID . '-' . $index . '-' . $planID;
                }
            }
        }
        if( isset( $ptPlansFeaturesMeta[ $index ][ 'FeatureValuePurchaseButtonCode' ] ) ) {
            foreach( $ptPlansFeaturesMeta[ $index ][ 'FeatureValuePurchaseButtonCode' ] as $planID => $featureValuePurchaseButtonCodeList ) {
                foreach( $featureValuePurchaseButtonCodeList as $featureID => $featureValuePurchaseButtonCode ) {
                    if( ( trim( $featureValuePurchaseButtonCode ) != '' ) && !in_array( $pricingTableID . '-' . $index . '-' . $planID . '-' . $featureID, $purchaseButtonBlockIDList ) ) {
                        wp_enqueue_script( 'wbr-purchase-button-code' );
                        $pricingTableCode .= '<div id="wbrpt-purchase-button-' . $pricingTableID . '-' . $index . '-' . $planID . '-' . $featureID . '">' . do_shortcode( $featureValuePurchaseButtonCode ) . '</div>';
                        $purchaseButtonBlockIDList[] = $pricingTableID . '-' . $index . '-' . $planID . '-' . $featureID;
                    }
                }
            }
        }
    }
    if( !empty( $pricingTableCode ) ) {
        $pricingTableCode = '<div class="pt-hidden">' . $pricingTableCode . '</div>';
    }

    if( isset( $repeatedInstancePricingTableList[ $pricingTableID ] ) ) {
        wp_enqueue_script( 'wbr-repeated-pricing-table' );
    }
    $repeatedInstancePricingTableList[ $pricingTableID ] = true;

    if( empty( $pricingTablePost->post_content ) ) {
        wbrpt_plans_features_default_value( $ptPlansFeaturesMeta, $ptDesignColorMeta[ 'design' ] );
        return wbrpt_generate_pricing_table_content( $ptDesignColorMeta, $ptPlansFeaturesMeta, $pricingTableID ) . $pricingTableCode;
    }

    return $pricingTablePost->post_content . $pricingTableCode;
}

add_shortcode( 'wbr-pricing-table', 'wbrpt_add_short_code' );

function wbrpt_add_shortcode_column( $columns )
{
    $updatedColumns = array();
    foreach( $columns as $identifier => $value ) {
        $updatedColumns[ $identifier ] = $value;
        if( $identifier == 'title' ) {
            $updatedColumns[ 'shortcode' ] = __( 'Shortcode' );
        }
    }
    return $updatedColumns;
}

add_filter( 'manage_wbr-pricing-table_posts_columns' , 'wbrpt_add_shortcode_column' );

function wbrpt_add_shortcode_column_value( $column, $post_id )
{
    if( $column == 'shortcode' ) {
        echo "<code>[wbr-pricing-table id=$post_id]</code>";
    }
}

add_action( 'manage_wbr-pricing-table_posts_custom_column' , 'wbrpt_add_shortcode_column_value', 10, 2 );

/* Tinymce start */
function wbrpt_tinymce_button()
{
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
        add_filter( 'mce_buttons', 'wbrpt_register_tinymce_button' );
        add_filter( 'mce_external_plugins', 'wbrpt_add_tinymce_button' );
    }
}

add_action( 'admin_init', 'wbrpt_tinymce_button' );

function wbrpt_register_tinymce_button( $buttons )
{
    array_push( $buttons, 'insert_pricing_table' );
    return $buttons;
}

function wbrpt_add_tinymce_button( $plugin_array )
{
    $plugin_array[ 'wbrpt_button_script' ] = plugins_url( '/assets/admin/js/tinymce-buttons.js', __FILE__ );
    return $plugin_array;
}

add_action( 'wp_ajax_wbrpt-pricing-table-list', 'wbrpt_ajax_pricing_table_list' );

function wbrpt_ajax_pricing_table_list()
{
    include( 'templates/admin/ajaxPricingTableList.php' );
    die();
}

/* Duplicate start */
function wbrpt_change_row_actions( $actions, $post )
{
    if( $post->post_type == 'wbr-pricing-table' ) {
        $actions[ 'duplicate' ] = '<a href="' . admin_url( 'admin-post.php?action=wbrpt-duplicate-pt&ptid=' . $post->ID ) . '" title="" rel="permalink">' . __( 'Duplicate' ) . '</a>';
        unset( $actions[ 'inline hide-if-no-js' ] );
    }
    return $actions;
}

add_filter( 'post_row_actions', 'wbrpt_change_row_actions', 10, 2 );

function wbrpt_duplicate_pricing_table()
{
    if( !isset( $_GET[ 'ptid' ] ) ) die();
    $ptID = $_GET[ 'ptid' ];
    $post = get_post( $ptID );
    if( is_null( $post ) ) die();
    if( $post->post_type != 'wbr-pricing-table' ) die();

    $currentUser = wp_get_current_user();
    $args = array(
        'comment_status' => $post->comment_status,
        'ping_status'    => $post->ping_status,
        'post_author'    => $currentUser->ID,
        'post_content'   => $post->post_content,
        'post_excerpt'   => $post->post_excerpt,
        'post_name'      => $post->post_name,
        'post_parent'    => $post->post_parent,
        'post_password'  => $post->post_password,
        'post_status'    => 'draft',
        'post_title'     => 'Duplicate of ' . $post->post_title,
        'post_type'      => $post->post_type,
        'to_ping'        => $post->to_ping,
        'menu_order'     => $post->menu_order
    );
 
    $newPostID = wp_insert_post( $args );

    $metaDataDesignColor =  get_post_meta( $ptID, 'wbrpt_design_color', true );
    $metaDataPlansFeatures = get_post_meta( $ptID, 'wbrpt_plans_features', true );

    update_post_meta( $newPostID, 'wbrpt_design_color', $metaDataDesignColor );
    update_post_meta( $newPostID, 'wbrpt_plans_features', $metaDataPlansFeatures );

    wp_redirect( admin_url( 'post.php?action=edit&post=' . $newPostID ) );
    die();
}

add_action( 'admin_post_wbrpt-duplicate-pt', 'wbrpt_duplicate_pricing_table' );

/* Preview pricing table */
function wbrpt_wp_ajax_pricing_table_preview()
{
    $metaData = wbrpt_meta_box_post_data_processing();
    if( is_null( $metaData ) ) die();
    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    array_walk_recursive( $metaData, function( &$value ){ $value = stripslashes( $value ); } );
    /* Two cases: preview one color or collection */
    if( !empty( $_POST[ 'wbrptColorVariableList' ] ) ) {
        $colorStyles = wbrpt_get_template_result(
            'includes/color/style/' . $wbrptGeneralSettings[ 'designList' ][ $metaData[ 'designColor' ][ 'design' ] ][ 'colorFile' ],
            array(
                'colorClass' => 'cpreview',
                'variables' => json_decode( stripcslashes( $_POST[ 'wbrptColorVariableList' ] ), true ),
                'calculateColors' => true,
                'generateStyles' => true
            )
        );
        $metaData[ 'designColor' ][ 'color' ] = 'preview';
    } else {
        wbrpt_get_available_design_color_list( $metaData[ 'designColor' ][ 'design' ] );
        $value = $metaData[ 'designColor' ];
    }
    $pricingTableContent = wbrpt_generate_pricing_table_content( $metaData[ 'designColor' ], $metaData[ 'plansFeatures' ] );
    $pluginFile = __FILE__;
    include( 'templates/admin/ajaxPricingTablePreview.php' );
    die();
}

add_action( 'wp_ajax_wbrpt-pricing-table-preview', 'wbrpt_wp_ajax_pricing_table_preview' );

function wbrpt_plugin_links( $links )
{
    $links[] = '<a href="https://swebdeveloper.com/apps/public/wordpress-builder-responsive-pricing-tables-lite/documentation/" target="_blank">' . __( 'Documentation' ) . '</a>'; 
    return $links; 
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wbrpt_plugin_links' );

function wbrpt_wp_ajax_builder_generate()
{
    header( 'Content-Type: application/json' );

    if( empty( $_POST[ 'design' ] ) ) {
        echo json_encode( array( 'error' => 'WordPress: design is required parameter' ) );
        exit;
    }

    $wbrptGeneralSettings = &wbrptGeneralSettings::$data;
    $designID = $_POST[ 'design' ];

    if( !isset( $wbrptGeneralSettings[ 'designList' ][ $designID ] ) ) {
        echo json_encode( array( 'error' => 'WordPress: design cannot be found' ) );
        exit;
    }

    $result = array();
    if( !empty( $_POST[ 'colorData' ] ) ) {
        wbrpt_get_available_design_color_list( $designID );
        wbrpt_get_design_color_variable_list( $designID );
        $color = ( empty( $_POST[ 'color' ] ) || !isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorList' ][ $_POST[ 'color' ] ] ) ) ? wbrpt_get_default_color( $designID ) : $_POST[ 'color' ];
        $result[ 'colorListHtml' ] = wbrpt_get_template_result( 'templates/admin/parts/colorList.php', array( 'value' => array( 'design' => $designID, 'color' => $color ) ) );
        $result[ 'columnColorListHtml' ] = wbrpt_get_template_result( 'templates/admin/parts/columnColorList.php', array( 'designID' => $designID ) );
        $result[ 'colorVariableListHtml' ] = wbrpt_get_template_result( 'templates/admin/parts/colorVariableList.php', array( 'value' => array( 'design' => $designID ) ) );
    }

    if( !empty( $_POST[ 'demoData' ] ) ) {
        $importFile = $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'importFile' ];
        $value = unserialize( file_get_contents( 'imports/' . $importFile, true ) );
        wbrpt_plans_features_default_value( $value, $designID );
    } else {
        $metaData = wbrpt_meta_box_post_data_processing();
        $value = $metaData[ 'plansFeatures' ];
        unset( $metaData );
    }

    if( !empty( $_POST[ 'addInstance' ] ) ) {
        reset( $value );
        $value[] = current( $value );
    } elseif( !empty( $_POST[ 'removeInstance' ] ) && isset( $value[ $_POST[ 'removeInstance' ] ] ) ) {
        unset( $value[ $_POST[ 'removeInstance' ] ] );
    }

    $result[ 'instanceAdding' ] = ( isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'navigationItemNumber' ] ) && $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'navigationItemNumber' ] > count( $value ) );

    wbrpt_plans_features_default_value( $value, $designID );

    $result[ 'builderHtml' ] = wbrpt_get_template_result( 'templates/admin/parts/plansFeaturesEditor.php', array( 'value' => $value, 'designID' => $designID ) );

    echo json_encode( $result );
    exit;
}

add_action( 'wp_ajax_wbrpt-builder-generate', 'wbrpt_wp_ajax_builder_generate' );

function wbrpt_wp_ajax_full_version_banner()
{
    $url = 'http://swebdeveloper.com/apps/public/wordpress-builder-responsive-pricing-tables-lite/full-version-html-banner/';
    $response = wp_remote_get( $url, array( 'timeout' => 15, 'httpversion' => '1.1' ) );
    if( is_wp_error( $response ) || $response[ 'response' ][ 'code' ] != 200 ) {
        include( 'templates/admin/fullVersionBanner.php' );
    } else {
        echo $response[ 'body' ];
    }
    die();
}

add_action( 'wp_ajax_wbrpt-full-version-banner', 'wbrpt_wp_ajax_full_version_banner' );

function wbrpt_media_view_strings( $strings, $post )
{
    if( ( $post instanceof WP_Post ) && $post->post_type == 'wbr-pricing-table' ) {
        $strings[ 'createGalleryTitle' ] = '';
        $strings[ 'setFeaturedImageTitle' ] = '';
        $strings[ 'createPlaylistTitle' ] = '';
        $strings[ 'createVideoPlaylistTitle' ] = '';
        $strings[ 'insertIntoPost' ] = __( 'Insert the image' );
    }

    return $strings;
}

add_filter( 'media_view_strings', 'wbrpt_media_view_strings', 10, 2 );
