<?php if(!defined('ABSPATH')) die(); ?>
<div class="item header">
    <div><?php echo __('Description'); ?></div>
    <div><?php echo __('Variable name'); ?></div>
    <div><?php echo __('Variable value'); ?></div>
    <div class="fit-cnt txt-ctr"><i class="fa fa-eyedropper"></i></div>
</div>
<?php foreach( $wbrptGeneralSettings[ 'designList' ][ $value[ 'design' ] ][ 'colorVariableList' ] as $variableName => $variableDefaultValue ) { ?>
    <?php $variableDefaultValue = preg_match( '/^#[A-Fa-f0-9]{3}$/', $variableDefaultValue ) ? $variableDefaultValue[ 0 ] . $variableDefaultValue[ 1 ] . $variableDefaultValue[ 1 ] . $variableDefaultValue[ 2 ] . $variableDefaultValue[ 2 ] . $variableDefaultValue[ 3 ] . $variableDefaultValue[ 3 ] : $variableDefaultValue; ?>
    <div class="item">
        <div><?php echo ucfirst( preg_replace( array( '/\$theme\-color/', '/(background|box\-shadow|border|gradient)(|\-[a-z0-9]+)\-color/', '/\-color/', '/\-/', '/\$/' ),  array( 'Theme color (main)', '$1 $2 color', ' text color', ' ', '' ), $variableName ) ); ?></div>
        <div><?php echo $variableName; ?></div>
        <div class="value"><?php echo $variableDefaultValue; ?></div>
        <div class="color"><input data-var-name="<?php echo $variableName; ?>" value="<?php echo preg_match( '/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $variableDefaultValue ) ? $variableDefaultValue : ''; ?>" type="text" data-default-value="<?php echo $variableDefaultValue; ?>" readonly></div>
    </div>
<?php } ?>