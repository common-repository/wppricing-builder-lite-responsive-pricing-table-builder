<?php if(!defined('ABSPATH')) die(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo __('Pricing table preview'); ?></title>
        <meta charset="<?php echo get_bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?php echo(plugins_url('/assets/css/font-awesome.min.css', $pluginFile )); ?>" />
        <?php if( isset( $wbrptGeneralSettings[ 'designList' ][ $metaData[ 'designColor' ][ 'design' ] ][ 'styleList' ] ) ) { ?>
            <?php foreach( $wbrptGeneralSettings[ 'designList' ][ $metaData[ 'designColor' ][ 'design' ] ][ 'styleList' ] as $additionalStyleIdentifier ) { ?>
                <?php if( isset( $wbrptGeneralSettings[ 'additionalStyleList' ][ $additionalStyleIdentifier ] ) ) { ?>
                    <link rel="stylesheet" type="text/css" href="<?php echo esc_url( $wbrptGeneralSettings[ 'additionalStyleList' ][ $additionalStyleIdentifier ] ); ?>" />
                 <?php } ?>
             <?php } ?>
         <?php } ?>
        <link rel="stylesheet" type="text/css" href="<?php echo(plugins_url( '/assets/css/pricing-tables.css', $pluginFile )); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo(plugins_url('/assets/css/pt-' . $metaData[ 'designColor' ][ 'design' ] . '.css', $pluginFile )); ?>" />
        <?php if( trim( $metaData[ 'designColor' ][ 'styles' ] ) != '' ) { ?>
            <style type="text/css">
                <?php echo $metaData[ 'designColor' ][ 'styles' ]; ?>
            </style>
        <?php } ?>
        <?php if( isset( $colorStyles ) ) { ?>
            <style type="text/css">
                body { margin: 0 20px; }
                <?php echo $colorStyles; ?>
            </style>
        <?php } else { ?>
            <?php foreach( $wbrptGeneralSettings[ 'designList' ][ $metaData[ 'designColor' ][ 'design' ] ][ 'colorList' ] as $colorName => $colorValue ) { ?>
                <link rel="stylesheet" type="text/css" href="<?php echo(plugins_url( 'assets/css/pt-color/' . $metaData[ 'designColor' ][ 'design' ] . '/' . $colorName . '.css', $pluginFile )); ?>" />
            <?php } ?>
            <link rel="stylesheet" type="text/css" href="<?php echo(plugins_url( '/assets/admin/css/pricing-table-design.css', $pluginFile )); ?>" />
            <style type="text/css">
                body { margin: 0 20px; }
                .wbrpt-color-picker { text-align: center; }
                #wbrpt-new-color-button { display: none; }
            </style>
            <script type="text/javascript" src="<?php echo admin_url('load-scripts.php?c=0&load[]=jquery-core&ver=' . get_bloginfo('version')); ?>"></script>
            <script type="text/javascript">
                jQuery(function(){
                    var pricingTableEl = jQuery( '.<?php echo $metaData['designColor']['design']; ?>' );
                    var colorSelectorEl = jQuery( '#wbrpt-color-selector' );
                    colorSelectorEl.find( 'input' ).change( function( event ) {
                        var value = jQuery( this ).val();
                        var prevClass =  pricingTableEl.attr( 'class' ).match( /<?php echo $metaData['designColor']['design']; ?>-[a-z0-9]+/ );
                        if( prevClass != null ) {
                            pricingTableEl.removeClass( prevClass[ 0 ] );
                        }
                        colorSelectorEl.data( 'default-color', value );
                        pricingTableEl.addClass( '<?php echo $metaData['designColor']['design']; ?>' + '-c' + value  );
                    });
                });
            </script>
        <?php } ?>
    </head>
    <body>
        <?php if( !isset( $colorStyles ) ) { ?>
            <div class="wbrpt-color-picker full-width" id="wbrpt-color-selector">
                <?php include( 'parts/colorList.php' ); ?>
            </div>
            <hr>
        <?php } ?>
        <?php echo $pricingTableContent; ?>
    </body>
</html>