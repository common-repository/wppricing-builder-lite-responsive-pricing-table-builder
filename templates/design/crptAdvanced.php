<?php if(!defined('ABSPATH')) die(); ?>
<?php
    if( count( array_filter( $ptPlansFeaturesMeta['PlanPurchaseButtonName'], 'strlen' ) ) == 0 ) {
        $baseCSSClassList[] = 'pt-no-footer';
    }
?>
<div class="<?php echo implode( ' ', $baseCSSClassList ); ?>">
    <div class="pt-cols pt-cols-<?php echo count($ptPlansFeaturesMeta['PlanName']); ?>">
        <div class="pt-cols-side">
            <?php
                $tabsCSSClass = array( 1 => 'pt-tab-red pt-tab-full', 2 => 'pt-tab-orange', 3 => 'pt-tab-blue' );
            ?>
            <?php include(dirname(__FILE__).'/parts/navigationTabs.php'); ?>
            <div class="pt-list-block">
                <?php foreach( $ptPlansFeaturesMeta['FeatureName'] as $featureID => $featureName ) { ?>
                    <div class="pt-list-item">
                        <?php
                            include(dirname(__FILE__).'/parts/rowHeight.php');
                            echo $rowHeightPrependHTML;
                            include(dirname(__FILE__).'/parts/tooltipFeature.php');
                            echo $rowHeightAppendHTML;
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="pt-cols-main">
            <?php foreach( $ptPlansFeaturesMeta['PlanName'] as $planID => $planName ) { ?>
                <div class="pt-col">
                    <div class="pt-block<?php echo ( $ptPlansFeaturesMeta['PlanHighlight'][$planID] ) ? ' pt-selected' : ( ( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) ? ' pt-not-available' : '' ); ?>">
                        <?php
                            $showPriceBlock = ( $ptPlansFeaturesMeta['PlanPrice'][$planID] != '' || $ptPlansFeaturesMeta['PlanCurrencySymbol'][$planID] != '' );
                        ?>
                        <?php if( $planName != '' || $showPriceBlock ) { ?>
                            <div class="pt-top">
                                <?php if( $planName != '' ) { ?>
                                    <div class="pt-title"><?php echo $planName; ?></div>
                                <?php } ?>
                                <?php if( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] || $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) { ?>
                                    <div class="pt-badge<?php echo ( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] ) ? ' pt-discount' : ( $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] ? ' pt-popular' : '' ); ?>">
                                    <div class="pt-badge-text"><?php echo ( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] ) ? $ptPlansFeaturesMeta['PlanDiscountSignText'][$planID] : ( $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] ? $ptPlansFeaturesMeta['PlanMostPopularSignText'][$planID] : ( $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ? $ptPlansFeaturesMeta['PlanNotAvailableSignText'][$planID] : '' ) ); ?></div>
                                <?php } ?>
                                <?php if( $showPriceBlock ) { ?>
                                    <div class="pt-price">
                                        <span class="pt-currency"><?php echo $ptPlansFeaturesMeta['PlanCurrencySymbol'][$planID]; ?></span>
                                        <span class="pt-value"><?php echo $ptPlansFeaturesMeta['PlanPrice'][$planID]; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] || $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) { ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class="pt-content">
                            <div class="pt-list">
                                <?php foreach( $ptPlansFeaturesMeta['FeatureName'] as $featureID => $featureName ) { ?>
                                    <div class="pt-list-item">
                                        <div class="pt-text">
                                            <?php include(dirname(__FILE__).'/parts/tooltipFeature.php'); ?>
                                        </div>
                                        <div class="pt-value">
                                            <?php
                                                include(dirname(__FILE__).'/parts/rowHeight.php');
                                                echo $rowHeightPrependHTML;
                                                include(dirname(__FILE__).'/parts/tooltipValue.php');
                                                echo $rowHeightAppendHTML;
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="pt-footer">
                                <?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>
                                    <a <?php if( !( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) ) { ?>href="<?php echo esc_url($ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID]); ?>" <?php } ?>class="pt-btn"><?php echo $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID]; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>