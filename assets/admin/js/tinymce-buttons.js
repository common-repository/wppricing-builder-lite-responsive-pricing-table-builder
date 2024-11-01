(function() {
    /* Register the buttons */
    tinymce.create('tinymce.plugins.wbrptButtons', {
        init : function(ed, url) {
            ed.addButton( 'insert_pricing_table', {
                title : 'Insert pricing table',
                cmd   : 'select_pricing_table',
                image : '../wp-content/plugins/wppricing-builder-lite-responsive-pricing-table-builder/assets/admin/images/tinymce-icon.gif'
            });
            ed.addCommand('select_pricing_table', function() {
                var positionDialogFunc = function() {
                    if( wbrptTinymceDialogSelectPT.dialog( 'isOpen' ) ) {
                        var windowWidth = jQuery(window).width() - 30;
                        var windowHeight = jQuery(window).height() - 30;
                        wbrptTinymceDialogSelectPT.dialog( 'option', 'width', ( windowWidth < 400 ) ? windowWidth : 400 );
                        wbrptTinymceDialogSelectPT.dialog( 'option', 'height', ( windowHeight < 300 ) ? windowHeight : 300 );
                        wbrptTinymceDialogSelectPT.dialog( 'option', 'position', { my: 'center', at: 'center', of: window } );
                    }
                }
                if( typeof wbrptTinymceDialogSelectPT === 'undefined' ) {
                    wbrptTinymceDialogSelectPT = jQuery( '<div class="ajax-loader"></div>' );
                    wbrptTinymceDialogSelectPT.dialog({
                        title:     'Select pricing table',
                        autoOpen:  false,
                        modal:     true,
                        resizable: false,
                        draggable: false,
                        width:     400,
                        height:    300,
                        buttons: [
                            {
                                id: 'wbrpt-select-pt-button-insert',
                                text: 'Insert',
                                disabled: true,
                                click: function() {
                                    var optionEl = wbrptTinymceDialogSelectPT.find( 'select option:selected' );
                                    if( optionEl.length ) {
                                        tinymce.execCommand( 'mceInsertContent', false, '[wbr-pricing-table id=' + optionEl.val() + ']' );
                                        jQuery( this ).dialog( 'close' );
                                    }
                                }
                            },
                            {
                                id: 'wbrpt-select-pt-button-cancel',
                                text: 'Cancel',
                                click: function() {
                                    jQuery( this ).dialog( 'close' );
                                }
                            }
                        ]
                    });
                    var resizeDelay = true;
                    jQuery(window).resize(function() {
                        if( resizeDelay ) {
                            resizeDelay = false;
                            setTimeout( function(){
                                positionDialogFunc();
                                resizeDelay = true;
                            }, 500 );
                        }
                    });
                    jQuery.ajax( ajaxurl + '?action=wbrpt-pricing-table-list' ).done(function( data ) {
                        wbrptTinymceDialogSelectPT.removeClass( 'ajax-loader' );
                        wbrptTinymceDialogSelectPT.html( data );
                        wbrptTinymceDialogSelectPT.children( 'select' ).on( 'focus change', function() {
                            var optionIsUnselected = wbrptTinymceDialogSelectPT.find( 'select option:selected' ).length ? false : true;
                            var insertButtonEl = jQuery( '#wbrpt-select-pt-button-insert' );
                            if( insertButtonEl.button( 'option', 'disabled' ) != optionIsUnselected ) {
                                insertButtonEl.button( 'option', 'disabled', optionIsUnselected );
                            }
                        }).focus();
                    });
                }
                wbrptTinymceDialogSelectPT.dialog( 'open' );
                positionDialogFunc();
            });
        },
        createControl : function(n, cm) {
           return null;
        },
    });
    /* Start the buttons */
    tinymce.PluginManager.add( 'wbrpt_button_script', tinymce.plugins.wbrptButtons );
})();