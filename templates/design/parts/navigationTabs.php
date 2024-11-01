<?php if( isset( $wbrptGeneralSettings[ 'designList' ][ $ptDesign ][ 'navigationItemNumber' ] ) && count( array_filter( $ptPlansFeaturesMeta[ 'NavigationName' ], 'strlen' ) ) && count( array_filter( $ptPlansFeaturesMeta[ 'NavigationLink' ], 'strlen' ) ) ) { ?>
    <div class="pt-tabs">
        <?php for( $number = 1; $number <= $wbrptGeneralSettings[ 'designList' ][ $ptDesign ][ 'navigationItemNumber' ]; $number++ ) { ?>
            <?php if( $ptPlansFeaturesMeta[ 'NavigationName' ][ $number ] == '' || $ptPlansFeaturesMeta[ 'NavigationLink' ][ $number ] == '' ) continue; ?>
            <?php if( $hasMultipleInstances ) { ?>
                <label for="<?php echo 'wbrpt-' . $pricingTableID . '-instance-' . $ptPlansFeaturesMeta['NavigationLink'][$number]; ?>" class="pt-tab<?php echo ( $ptPlansFeaturesMeta['ActiveNavigation'] == $number ) ? ' pt-tab-active' : ''; ?><?php echo isset( $tabsCSSClass[ $number ] ) ? ' ' . $tabsCSSClass[ $number ] : ''; ?>"><span><?php echo $ptPlansFeaturesMeta[ 'NavigationName' ][ $number ]; ?></span></label>
            <?php } else { ?>
                <a href="<?php echo esc_url($ptPlansFeaturesMeta['NavigationLink'][$number]); ?>" class="pt-tab<?php echo ( $ptPlansFeaturesMeta['ActiveNavigation'] == $number ) ? ' pt-tab-active' : ''; ?><?php echo isset( $tabsCSSClass[ $number ] ) ? ' ' . $tabsCSSClass[ $number ] : ''; ?>"><span><?php echo $ptPlansFeaturesMeta[ 'NavigationName' ][ $number ]; ?></span></a>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>