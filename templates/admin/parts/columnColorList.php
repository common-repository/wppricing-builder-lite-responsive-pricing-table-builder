<?php if(!defined('ABSPATH')) die(); ?><label title="<?php echo __('None'); ?>"><input type="radio" name="wbrptColumnColor" value=""><span><i class="fa fa-times"></i></span></label><?php foreach( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'colorList' ] as $colorName => $colorValue ) { ?><?php $colorList = '#' . implode( ', #', $colorValue[ 'icon' ] ); ?><label title="<?php echo $colorList; ?>"><input type="radio" name="wbrptColumnColor" value="<?php echo $colorName; ?>"><span style="background: #<?php echo $colorValue[ 'icon' ][ 0 ]; ?>;<?php if( count( $colorValue[ 'icon' ] ) > 1 ) { ?>background: -webkit-linear-gradient(left,<?php echo $colorList; ?>);background: -o-linear-gradient(left,<?php echo $colorList; ?>);background: -moz-linear-gradient(left,<?php echo $colorList; ?>);background: linear-gradient(to right,<?php echo $colorList; ?>);<?php } ?>"></span></label><?php } ?><label id="wbrpt-new-color-reference" title="<?php echo __('Add a new color'); ?>"><span><i class="fa fa-eyedropper"></i></span></label>