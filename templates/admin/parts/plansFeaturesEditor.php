<?php if(!defined('ABSPATH')) die(); ?>
<?php $controlView = function( $instanceNumber, $value, $controlID, $controlSettings, $idSuffix, $nameSuffix, &$toggleList  ) { ?>
    <?php if( $controlSettings[ 0 ] == 'checkbox' ) { ?>
        <?php
            $hasToggle = !empty( $controlSettings[ 3 ][ 2 ] );
            if( $hasToggle ) {
                $toggleList[ 'counter' ]++;
                foreach( $controlSettings[ 3 ][ 2 ] as $toggleControlID ) {
                    $toggleList[ 'list' ][ $toggleControlID ][] = $toggleList[ 'counter' ];
                }
            }
        ?>
        <input class="toggle<?php echo $hasToggle ? ' checkbox' . $toggleList[ 'counter' ] : ''; ?>" id="wbrptPf<?php echo $controlID . 'Inst' . $instanceNumber . '-' . $idSuffix; ?>"<?php echo !empty( $controlSettings[ 3 ][ 1 ] ) ? ( ' data-checkbox-group="' . $controlSettings[ 3 ][ 1 ] . '"' ) : ''; ?> type="checkbox" data-var-name="<?php echo $controlID . $nameSuffix; ?>" <?php echo $value ? 'checked ' : ''; ?>value="">
        <label class="btn-ln top-tooltip" for="wbrptPf<?php echo $controlID . 'Inst' . $instanceNumber . '-' . $idSuffix; ?>" data-tooltip-text="<?php echo __( $controlSettings[ 1 ] ); ?>"><i class="<?php echo $controlSettings[ 3 ][ 0 ]; ?>"></i></label>
    <?php } elseif( $controlSettings[ 0 ] == 'text' ) { ?>
        <div class="field-wrapper side-tooltip<?php echo isset( $toggleList[ 'list' ][ $controlID ] ) ? ' toggle-field' . implode( ' toggle-field', $toggleList[ 'list' ][ $controlID ] ) : ''; ?>">
            <input class="<?php echo $controlSettings[ 3 ][ 0 ] ? 'preview-target' : ''; ?><?php echo ( $value == '' ) ? ' show-original' : ''; ?>" type="text" value="<?php echo esc_attr( $value ); ?>" data-var-name="<?php echo $controlID . $nameSuffix; ?>" placeholder="<?php echo __( $controlSettings[ 1 ] ); ?>">
            <?php if( $controlSettings[ 3 ][ 0 ] ) { ?>
                <div class="field-preview hide-br"><?php echo $value; ?></div>
            <?php } ?>
            <div class="side-tooltip-box"><?php echo __( $controlSettings[ 1 ] ); ?></div>
        </div>
    <?php } elseif( $controlSettings[ 0 ] == 'radio' ) { ?>
        <?php foreach( $controlSettings[ 3 ] as $radioID => $radioItem ) { ?>
            <?php
                $hasToggle = !empty( $radioItem[ 3 ] );
                if( $hasToggle ) {
                    $toggleList[ 'counter' ]++;
                    foreach( $radioItem[ 3 ] as $toggleControlID ) {
                        $toggleList[ 'list' ][ $toggleControlID ][] = $toggleList[ 'counter' ];
                    }
                }
            ?>
            <input class="<?php echo ( $radioItem[ 2 ] === false ) ? 'hide' : ( 'toggle' . ( $hasToggle ? ' checkbox' . $toggleList[ 'counter' ] : '' ) ); ?>" id="wbrptPf<?php echo $controlID . 'Inst' . $instanceNumber . 'Val' . $radioID . '-' . $idSuffix; ?>" type="radio" data-var-name="<?php echo $controlID . $nameSuffix; ?>" <?php if( $value == $radioID ) echo 'checked '; ?>value="<?php echo $radioID; ?>">
            <label class="btn-ln top-tooltip" for="wbrptPf<?php echo $controlID . 'Inst' . $instanceNumber . 'Val' . $radioID . '-' . $idSuffix; ?>" data-tooltip-text="<?php echo __( $radioItem[ 1 ] ); ?>"><i class="<?php echo $radioItem[ 0 ]; ?>"></i></label>
        <?php } ?>
    <?php } elseif( $controlSettings[ 0 ] == 'select' ) { ?>
        <div class="field-wrapper side-tooltip<?php echo isset( $toggleList[ 'list' ][ $controlID ] ) ? ' toggle-field' . implode( ' toggle-field', $toggleList[ 'list' ][ $controlID ] ) : ''; ?>">
            <select data-var-name="<?php echo $controlID . $nameSuffix; ?>">
                <?php foreach( $controlSettings[ 3 ] as $optionID => $optionItem ) { ?>
                    <option <?php if( $value == $optionID ) echo 'selected '; ?>value="<?php echo $optionID; ?>"><?php echo __( $optionItem ); ?></option>
                <?php } ?>
            </select>
            <div class="side-tooltip-box"><?php echo __( $controlSettings[ 1 ] ); ?></div>
        </div>
    <?php } elseif( $controlSettings[ 0 ] == 'textarea' ) { ?>
        <div class="field-wrapper side-tooltip<?php echo isset( $toggleList[ 'list' ][ $controlID ] ) ? ' toggle-field' . implode( ' toggle-field', $toggleList[ 'list' ][ $controlID ] ) : ''; ?>">
            <textarea class="<?php echo $controlSettings[ 3 ][ 0 ] ? 'preview-target' : ''; ?><?php echo ( $value == '' ) ? ' show-original' : ''; ?>" rows="3" data-var-name="<?php echo $controlID . $nameSuffix; ?>" placeholder="<?php echo __( $controlSettings[ 1 ] ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
            <?php if( $controlSettings[ 3 ][ 0 ] ) { ?>
                <div class="field-preview"><?php echo nl2br( $value ); ?></div>
            <?php } ?>
            <div class="side-tooltip-box"><?php echo __( $controlSettings[ 1 ] ); ?></div>
        </div>
    <?php } elseif( $controlSettings[ 0 ] == 'image' ) { ?>
        <div class="field-wrapper side-tooltip<?php echo isset( $toggleList[ 'list' ][ $controlID ] ) ? ' toggle-field' . $toggleList[ 'list' ][ $controlID ] : ''; ?>">
            <input type="hidden" value="<?php echo esc_attr( $value ); ?>" data-var-name="<?php echo $controlID . $nameSuffix; ?>" value="<?php echo esc_attr( $value ); ?>">
            <div class="image-preview"<?php echo !empty( $value ) ? ' style="background-image: url(' . esc_attr( $value ) . ');"' : ''; ?>></div>
            <div class="side-tooltip-box"><?php echo __( $controlSettings[ 1 ] ); ?></div>
        </div>
    <?php } elseif( $controlSettings[ 0 ] == 'hidden' ) { ?>
        <input type="hidden" value="<?php echo esc_attr( $value ); ?>" data-var-name="<?php echo $controlID . $nameSuffix; ?>">
    <?php } ?>
<?php }; ?>
<?php
    $getContrastYIQ = function( $hexColor ){
        $r = hexdec( substr( $hexColor, 0, 2 ) );
        $g = hexdec( substr( $hexColor, 2, 2 ) );
        $b = hexdec( substr( $hexColor, 4, 2 ) );
        $yiq = ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;
        return ( $yiq >= 128 ) ? 'black' : 'white';
    }
?>
<?php
    $designControlList = array_fill_keys( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'controlList' ], true );
    $designColorList = $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorList' ];
    $counter = 0;
    $instanceCount = count( $value );
    $instanceList = array();
    for( $version = 1; $version <= $instanceCount; $version++ ) {
        $instanceList[ $version ] = __( 'Version ' . $version );
    }
?>
<?php foreach( $value as $instance ) { ?>
    <?php $counter++; ?>
    <?php
        if( isset( $instance[ 'ActiveInstance' ] ) && $instance[ 'ActiveInstance' ] ) {
            $activeInstance = $counter;
        }
    ?>
    <?php if( $instanceCount > 1 ) { ?>
        <div class="header"><?php echo __( 'Version ' . $counter ); ?></div>
    <?php } ?>
    <div class="instance">
        <table>
            <thead>
                <tr>
                    <th class="noDrag">
                        <a class="extend-column btn-ln top-tooltip divide" href="#" data-tooltip-text="<?php echo __('Extend this column'); ?>"><i class="fa fa-exchange"></i></a>
                        <?php 
                            $toggleList = array( 'counter' => 0, 'list' => array() );
                            foreach( $wbrptGeneralSettings[ 'controlList' ][ 'base' ] as $controlID => $controlSettings ) {
                                if( !isset( $designControlList[ $controlID ] ) ) continue;
                                $controlView( $counter, $instance[ $controlID ], $controlID, $controlSettings, '', '', $toggleList );
                            }
                            if( isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'navigationItemNumber' ] ) ) {
                                $activeNavigationOptionList = array( '' => 'Inactive all' );
                                for( $number = 1; $number <= $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'navigationItemNumber' ]; $number++ ) {
                                    $activeNavigationOptionList[ $number ] = "Active nav $number";
                                    $controlView( $counter, $instance[ 'NavigationName' ][ $number ], 'NavigationName', array( 'text', "Navigation $number name", '', array( true ) ), $number, "[$number]", $toggleList );
                                    if( $instanceCount > 1 ) {
                                        $controlView( $counter, $instance[ 'NavigationLink' ][ $number ], 'NavigationLink', array( 'select', "Navigation $number link", $number, $instanceList ), $number, "[$number]", $toggleList );
                                    } else {
                                        $controlView( $counter, $instance[ 'NavigationLink' ][ $number ], 'NavigationLink', array( 'text', "Navigation $number link", '', array( false ) ), $number, "[$number]", $toggleList );
                                    }
                                }
                                $controlView( $counter, $instance[ 'ActiveNavigation' ], 'ActiveNavigation', array( 'select', 'Active navigation', 0, $activeNavigationOptionList ), '', '', $toggleList );
                            }
                        ?>
                    </th>
                    <?php foreach( $instance[ 'PlanName' ] as $planID => $planName ) { ?>
                        <th>
                            <a class="remove-column btn-ln top-tooltip" href="#" data-tooltip-text="<?php echo __('Remove this column'); ?>"><i class="fa fa-times"></i></a>
                            <a class="copy-column btn-ln top-tooltip" href="#" data-tooltip-text="<?php echo __('Dublicate this column'); ?>"><i class="fa fa-clone"></i></a>
                            <a class="extend-column btn-ln top-tooltip" href="#" data-tooltip-text="<?php echo __('Extend this column'); ?>"><i class="fa fa-exchange"></i></a>
                            <?php if( isset( $designControlList[ 'PlanDesignColor' ] ) ) { ?>
                                <?php if( !isset( $designColorList[ $instance[ 'PlanDesignColor' ][ $planID ] ] ) ) $instance[ 'PlanDesignColor' ][ $planID ] = ''; ?>
                                <?php $controlView( $counter, $instance[ 'PlanDesignColor' ][ $planID ], 'PlanDesignColor', array( 'hidden' ), $planID, "[$planID]", $toggleList ); ?>
                                <a class="color-column btn-ln top-tooltip divide" href="#" data-tooltip-text="<?php echo __('Plan design color'); ?>"<?php echo ( $instance[ 'PlanDesignColor' ][ $planID ] != '' ) ? ' style="background-color: #' . $instance[ 'PlanDesignColor' ][ $planID ] . '; color: ' . $getContrastYIQ( $instance[ 'PlanDesignColor' ][ $planID ] ) . ';"' : ''; ?>><i class="fa fa-eyedropper"></i></a>
                            <?php } ?>
                            <?php
                                if( !isset( $designControlList[ 'PlanName' ] ) ) {
                                    $controlView( $counter, $instance[ 'PlanName' ][ $planID ], 'PlanName', array( 'hidden' ), $planID, "[$planID]", $toggleList );
                                }
                                $toggleList = array( 'counter' => 0, 'list' => array() );
                                foreach( $wbrptGeneralSettings[ 'controlList' ][ 'column' ] as $controlID => $controlSettings ) {
                                    if( !isset( $designControlList[ $controlID ] ) ) continue;
                                    $controlView( $counter, $instance[ $controlID ][ $planID ], $controlID, $controlSettings, $planID, "[$planID]", $toggleList );
                                }
                            ?>
                        </th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $instance['FeatureName'] as $featureID => $featureName ) { ?>
                    <tr>
                        <th>
                            <a class="remove-row btn-ln top-tooltip" href="#" data-tooltip-text="<?php echo __('Remove this row'); ?>"><i class="fa fa-times"></i></a>
                            <a class="copy-row btn-ln top-tooltip divide" href="#" data-tooltip-text="<?php echo __('Dublicate this row'); ?>"><i class="fa fa-clone"></i></a>
                            <?php
                                $toggleList = array( 'counter' => 0, 'list' => array() );
                                if( !isset( $designControlList[ 'FeatureName' ] ) ) {
                                    $controlView( $counter, $instance[ 'FeatureName' ][ $featureID ], 'FeatureName', array( 'hidden' ), $featureID, "[$featureID]", $toggleList );
                                }
                                foreach( $wbrptGeneralSettings[ 'controlList' ][ 'row' ] as $controlID => $controlSettings ) {
                                    if( !isset( $designControlList[ $controlID ] ) ) continue;
                                    $controlView( $counter, $instance[ $controlID ][ $featureID ], $controlID, $controlSettings, $featureID, "[$featureID]", $toggleList );
                                }
                            ?>
                        </th>
                        <?php foreach( $instance['PlanName'] as $planID => $planName ) { ?>
                            <td>
                                <?php
                                    $toggleList = array( 'counter' => 0, 'list' => array() );
                                    foreach( $wbrptGeneralSettings[ 'controlList' ][ 'cell' ] as $controlID => $controlSettings ) {
                                        if( !isset( $designControlList[ $controlID ] ) ) continue;
                                        $controlView( $counter, $instance[ $controlID ][ $planID ][ $featureID ], $controlID, $controlSettings, $planID . '-' . $featureID, "[$planID][$featureID]", $toggleList );
                                    }
                                ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="#" class="add-row"><i class="fa fa-plus-circle"></i></a>
        <a href="#" class="add-column"><i class="fa fa-plus-circle"></i></a>
        <input type="hidden" name="wbrptData[<?php echo $counter; ?>]" value="">
    </div>
<?php } ?>