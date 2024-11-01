<?php if(!defined('ABSPATH')) die(); ?>
<?php
    $baseCSSClassList = array( $ptDesign );
    if( !empty( $ptDesignColorMeta[ 'color' ] ) ) {
        $baseCSSClassList[] = $ptDesign . '-c' . $ptDesignColorMeta[ 'color' ];
    }
    if( !isset( $ptDesignColorMeta[ 'animation' ] ) || $ptDesignColorMeta[ 'animation' ] == 0 ) {
        $baseCSSClassList[] = 'pt-animation-default';
    } elseif( isset( $ptDesignColorMeta[ 'animation' ] ) && $ptDesignColorMeta[ 'animation' ] >= 1 && $ptDesignColorMeta[ 'animation' ] <= 2 ) {
        $baseCSSClassList[] = 'pt-animation-' . $ptDesignColorMeta[ 'animation' ];
    }
    $hasMultipleInstances = ( count( $ptPlansFeaturesListMeta ) > 1 );
?>
<div class="pt-content-loader ptcl-<?php echo $ptDesign; ?>">
    <?php if( $hasMultipleInstances ) { ?>
        <form data-wbrpt-id="<?php echo $pricingTableID; ?>">
    <?php } ?>
    <?php foreach( $ptPlansFeaturesListMeta as $instanceID => $ptPlansFeaturesMeta ) { ?>
        <?php
            if( !empty( $ptPlansFeaturesMeta[ 'FeaturesColumnWidth' ] ) && in_array( $ptPlansFeaturesMeta[ 'FeaturesColumnWidth'], array( 'xs', 'sm', 'md', 'lg' ) ) ) {
                $baseCSSClassList[] = 'pt-side-' . $ptPlansFeaturesMeta[ 'FeaturesColumnWidth' ];
            }
        ?>
        <?php if( $hasMultipleInstances ) { ?>
            <input type="radio" id="<?php echo "wbrpt-$pricingTableID-instance-$instanceID"; ?>" class="pt-instance-switch" name="wbrpt<?php echo $pricingTableID; ?>Instance"<?php echo ( isset( $ptPlansFeaturesMeta[ 'ActiveInstance' ] ) && $ptPlansFeaturesMeta[ 'ActiveInstance' ] ) ? ' checked' : ''; ?>>
            <div class="pt-instance">
        <?php } ?>
        <?php include( 'design/' . $template ); ?>
        <?php if( $hasMultipleInstances ) { ?>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if( $hasMultipleInstances ) { ?>
        </form>
    <?php } ?>
</div>
<div class="pt-content-loader-bar"></div>