function wbrptPricingTableEditor( baseEl ) {
    var instanceEls =  baseEl.children( '.instance' );
    var formEl = baseEl.parents( 'form' );

    function serializeBuilderDataFunc() {
        jQuery.each( instanceEls, function( index, instance ) {
            var data = {};
            var instanceEl = jQuery( instance );
            jQuery.each( instanceEl.find( '[data-var-name]' ), function( index, item ) {
                var itemEl = jQuery( item );
                var varNameParts = itemEl.attr( 'data-var-name' ).match( /([a-zA-Z0-9]+)(\[([\d\[\]]+)\]|)$/ );
                var varName = varNameParts[ 1 ];
                var varIndexList = (typeof varNameParts[ 3 ] !== 'undefined') ? varNameParts[ 3 ].split( '][' ) : false;
                var tagName = itemEl.prop( 'tagName' ).toLowerCase();
                var inputType = ( tagName == 'input' ) ? itemEl.prop( 'type' ) : false;
                var value = '';

                if( tagName == 'input' && inputType == 'checkbox' ) {
                    value = itemEl.is( ':checked' );
                } else if( tagName == 'input' && inputType == 'radio' ) {
                    value = itemEl.is( ':checked' ) ? itemEl.val() : '';
                } else {
                    value = itemEl.val();
                }

                if( varIndexList === false ) {
                    if( typeof data[ varName ] === 'undefined' || 
                        data[ varName ] === '' ) {
                        data[ varName ] = value;
                    }
                } else if( varIndexList.length == 1 ) {
                    if( !data.hasOwnProperty( varName ) ) {
                        data[ varName ] = {};
                    }
                    if( typeof data[ varName ][ varIndexList[ 0 ] ] === 'undefined' || 
                        data[ varName ][ varIndexList[ 0 ] ] === '' ) {
                        data[ varName ][ varIndexList[ 0 ] ] = value;
                    }
                } else if( varIndexList.length == 2 ) {
                    if( !data.hasOwnProperty( varName ) ) {
                        data[ varName ] = {};
                    }
                    if( typeof data[ varName ][ varIndexList[ 0 ] ] === 'undefined' ) {
                        data[ varName ][ varIndexList[ 0 ] ] = {};
                    }
                    if( typeof data[ varName ][ varIndexList[ 0 ] ][ varIndexList[ 1 ] ] === 'undefined' || 
                        data[ varName ][ varIndexList[ 0 ] ][ varIndexList[ 1 ] ] === '' ) {
                        data[ varName ][ varIndexList[ 0 ] ][ varIndexList[ 1 ] ] = value;
                    }
                }
            });
            instanceEl.children( 'input[name^=wbrptData]' ).val( JSON.stringify( data ) );
        });
    }

    formEl.submit( serializeBuilderDataFunc );

    // START: design and color theme functionality
    var designSelectorEl = jQuery( '#wbrpt-design-selector' );
    var colorSelectorEl = jQuery( '#wbrpt-color-selector' );
    var columnColorSelectorEl = jQuery( '#wbrpt-editor-column-color-box .wbrpt-color-picker' );
    var customColorAttrBlockEl = jQuery( '.wbrpt-custom-color-attribute' );
    var colorVariableListEl = jQuery( '#wbrpt-custom-color-variable-list' );
    var colorVariableInputEls = colorVariableListEl.find( '.color input' );
    var colorVariableDataInputEl = jQuery( '#wbrpt-custom-color-variable-data' );
    var customStylesBlockEl = jQuery( '#wbrpt-custom-styles-block' );
    var customStylesShowEl = jQuery( '#wbrpt-custom-styles-show' );
    var customStylesHideEl = jQuery( '#wbrpt-custom-styles-hide' );

    var spectrumOptions = {
        preferredFormat: 'hex',
        showInput:       true,
        allowEmpty:      true,
        change:          function( color ) {
            jQuery( this ).parent().prev( '.value' ).text( color ? color.toHexString() : jQuery( this ).data( 'defaultValue' ) );
        }
    };

    colorVariableInputEls.spectrum( spectrumOptions );

    colorSelectorEl.on( 'click', '#wbrpt-new-color-button', function( event ) {
        event.preventDefault();
        customColorAttrBlockEl.removeClass( 'hidden' );
    });

    // START: column color box
    function getContrastYIQ( hexColor ) {
        var r = parseInt( hexColor.substr( 0, 2 ), 16 );
        var g = parseInt( hexColor.substr( 2, 2 ), 16 );
        var b = parseInt( hexColor.substr( 4, 2 ), 16 );
        var yiq = ( ( r * 299 ) + ( g * 587 ) + ( b * 114 ) ) / 1000;
        return ( yiq >= 128 ) ? 'black' : 'white';
    }
    var columnColorBoxEl = jQuery( '#wbrpt-editor-column-color-box' );
    var columnColorTrigger = { button: false, input: false };
    jQuery( document ).on( 'mousedown', function( event ) {
        if( !columnColorBoxEl.hasClass( 'hidden' ) ) {
            var target = jQuery( event.target );
            if( target.closest( columnColorBoxEl ).length == 0 && target.closest( '.color-column' ).length == 0 ) {
                columnColorBoxEl.addClass( 'hidden' );
                columnColorTrigger = { button: false, input: false };
            }
        }
    });
    function updateColumnColorBoxWidthFunc() {
        columnColorBoxEl.css({
            width: 'auto',
            top:   '',
            left:  ''
        });
        var width = columnColorBoxEl.width();
        if( width >= 192 ) {
            columnColorBoxEl.css( 'width', '' );
        }
    }
    columnColorSelectorEl.on( 'change', 'input', function( event ) {
        iframeRequestFunc( ajaxurl + '?action=wbrpt-full-version-banner', 'Upgrade to full version', { width: 590, height: 343 } );
    });
    columnColorSelectorEl.on( 'click', '#wbrpt-new-color-reference', function() {
        jQuery( '#wbrpt-new-color-button' ).trigger( 'click' );
        jQuery( window ).scrollTo( '.wbrpt-custom-color-attribute' );
        jQuery( document ).trigger( 'mousedown' );
    });
    updateColumnColorBoxWidthFunc();
    // END: column color box

    function scrollToElementInCenterFunc( targetEl ) {
        var parentEl = targetEl.parent();
        parentEl.scrollTo( targetEl, { offset: { left: ( ( targetEl.outerWidth() / 2 ) + ( parentEl.outerWidth() / 2 ) * -1 ) } } );
    }

    function iframeRequestFunc( src, title, params ) {
        function getIframeHeightFunc() {
            try {
                if( wbrptIframeDialog.iframe.element[ 0 ].contentWindow.document.body ) {
                    if( wbrptIframeDialog.iframe.body === false ) wbrptIframeDialog.iframe.body = wbrptIframeDialog.iframe.element.contents().find( 'body' );
                    wbrptIframeDialog.iframe.body.css( 'overflow', 'hidden' );
                    wbrptIframeDialog.iframe.height = wbrptIframeDialog.iframe.body.height();
                }
            } catch (err) {
                wbrptIframeDialog.iframe.height = false;
                wbrptIframeDialog.iframe.body = false;
            }
        }
        function positionDialogFunc() {
            if( wbrptIframeDialog.element.dialog( 'isOpen' ) ) {
                var windowWidth = jQuery( window ).width() - 30;
                var windowHeight = jQuery( window ).height() - 30;
                wbrptIframeDialog.element.dialog( 'option', 'width', ( wbrptIframeDialog.config.width ) ? ( windowWidth < wbrptIframeDialog.config.width ? windowWidth : wbrptIframeDialog.config.width ) : windowWidth );
                if( wbrptIframeDialog.iframe.height ) {
                    getIframeHeightFunc();
                    wbrptIframeDialog.config.height = wbrptIframeDialog.iframe.height + ( wbrptIframeDialog.element.dialog( 'option', 'height' ) - wbrptIframeDialog.iframe.element.height() );
                }
                wbrptIframeDialog.element.dialog( 'option', 'height', ( wbrptIframeDialog.config.height ) ? ( windowHeight < wbrptIframeDialog.config.height ? windowHeight : wbrptIframeDialog.config.height ) : windowHeight );
                wbrptIframeDialog.element.dialog( 'option', 'position', { my: 'center', at: 'center', of: window } );
                if( wbrptIframeDialog.iframe.height ) {
                    if( wbrptIframeDialog.iframe.element.height() < wbrptIframeDialog.iframe.height ) {
                        wbrptIframeDialog.iframe.body.css( 'overflow', 'visible' );
                    }
                }
            }
        }
        if( typeof wbrptIframeDialog === 'undefined' ) {
            wbrptIframeDialog = { element: jQuery( '<div class="ajax-loader"></div>' ), iframe: { height: false, body: false } };
            wbrptIframeDialog.element.dialog({
                title:       'Iframe',
                autoOpen:    false,
                modal:       true,
                resizable:   false,
                draggable:   false,
                width:       800,
                height:      600,
                dialogClass: 'wbrpt-dialog-content-full',
                open: function( event, ui ) {
                    wbrptIframeDialog.iframe.element = jQuery( '<iframe width="100%" height="100%"></iframe>' );
                    wbrptIframeDialog.iframe.element.attr( 'src', wbrptIframeDialog.iframe.src );
                    wbrptIframeDialog.element.append( wbrptIframeDialog.iframe.element );
                    wbrptIframeDialog.iframe.element.load(function(){
                        wbrptIframeDialog.element.removeClass( 'ajax-loader' );
                        getIframeHeightFunc();
                        positionDialogFunc();
                    });
                },
                close: function( event, ui ) {
                    wbrptIframeDialog.element.addClass( 'ajax-loader' );
                    wbrptIframeDialog.iframe.element.remove();
                    wbrptIframeDialog.iframe.element = false;
                },
            });
            wbrptIframeDialog.resizePermitted = true;
            jQuery(window).resize(function() {
                if( !wbrptIframeDialog.resizePermitted ) return;
                wbrptIframeDialog.resizePermitted = false;
                setTimeout( function(){
                    positionDialogFunc();
                    wbrptIframeDialog.resizePermitted = true;
                }, 500 );
            });
        }
        wbrptIframeDialog.iframe.src = src;
        wbrptIframeDialog.iframe.height = false;
        wbrptIframeDialog.iframe.body = false;
        wbrptIframeDialog.config = { width:  false, height: false };
        if( typeof params !== 'undefined' ) {
            jQuery.extend( wbrptIframeDialog.config, params );
        }
        wbrptIframeDialog.element.dialog( 'option', 'title', title );
        wbrptIframeDialog.element.dialog( 'open' );
        positionDialogFunc();
    }

    designSelectorEl.data( 'value', designSelectorEl.val() );
    designSelectorEl.change( function( event ) {
        var optionEl = jQuery( 'option:selected', this );
        var previewUrl = optionEl.data( 'previewUrl' );
        if( previewUrl ) {
            designSelectorEl.val( designSelectorEl.data( 'value' ) );
            iframeRequestFunc( previewUrl, 'Preview full version design' );
            return;
        }
        designSelectorEl.data( 'value', designSelectorEl.val() );
        var previewInputEl = jQuery( '.wbrpt-design-preview input[value=' + designSelectorEl.val() + ']' );
        previewInputEl.prop( 'checked', true );
        scrollToElementInCenterFunc( previewInputEl.next( '.item' ) );
        customColorAttrBlockEl.addClass( 'hidden' );
        serializeBuilderDataFunc();
        var selectedColorEl = colorSelectorEl.find( 'input:checked' );
        actionAjaxRequestFunc(
            formEl.find( 'input[name^=wbrptData]' ).serialize() + '&action=wbrpt-builder-generate&design=' + designSelectorEl.val() + '&colorData=1' + ( selectedColorEl.length ? ( '&color=' + selectedColorEl.val() ) : '' ), 
            'Builder',
            'Changing design'
        );
    });

    jQuery( '.wbrpt-design-preview input' ).click( function( event ) {
        var disabled = jQuery( this ).hasClass( 'disabled' );
        if( disabled || confirm( 'Would you like to select this design?' ) ) {
            if( disabled ) event.preventDefault();
            designSelectorEl.val( jQuery( this ).val() );
            designSelectorEl.trigger( 'change' );
            return;
        }
        event.preventDefault();
    });
    scrollToElementInCenterFunc( jQuery( '.wbrpt-design-preview input:checked + .item' ) );

    jQuery( '.wbrpt-design-preview a.item' ).click( function( event ) {
        event.preventDefault();
        designSelectorEl.val( jQuery( this ).prev( 'input' ).val() );
        designSelectorEl.trigger( 'change' );
    });

    jQuery( '#wbrpt-post-status' ).click( function( event ) {
        event.preventDefault();
        jQuery( 'a.edit-post-status' ).trigger( 'click' );
        jQuery( '#post_status' ).val( 'draft' );
    });

    jQuery( '#wbrpt-custom-color-cancel' ).click( function( event ) {
        event.preventDefault();
        customColorAttrBlockEl.addClass( 'hidden' );
    });

    var actionAjaxRequestPerforming = false;
    function actionDialogPositionFunc() {
        if( wbrptActionDialog.dialog( 'isOpen' ) ) {
            var windowWidth = jQuery(window).width();
            var windowHeight = jQuery(window).height();
            wbrptActionDialog.dialog( 'option', 'width', windowWidth < 400 ? windowWidth - 30 : 400 );
            wbrptActionDialog.dialog( 'option', 'height', windowHeight < 200 ? windowHeight - 30 : 200 );
            wbrptActionDialog.dialog( 'option', 'position', { my: 'center', at: 'center', of: window } );
        }
    }
    function actionAjaxRequestFunc( data, title, loadingMessage ) {
        if( typeof wbrptActionDialog === 'undefined' ) {
            wbrptActionDialog = jQuery( '<div class="ajax-loader-text" data-caption=""></div>' );
            wbrptActionDialog.dialog({
                title:     'Theme colors',
                autoOpen:  false,
                modal:     true,
                resizable: false,
                draggable: false,
                width:     400,
                height:    200,
                open: function( event, ui ) {
                    wbrptActionDialog.text( '' );
                },
                close: function( event, ui ) {
                    actionAjaxRequestPerforming.abort();
                    wbrptActionDialog.html( '' );
                    wbrptActionDialog.addClass( 'ajax-loader-text' );
                }
            });
            var resizeDelay = true;
            jQuery(window).resize(function() {
                if( resizeDelay ) {
                    resizeDelay = false;
                    setTimeout( function(){
                        actionDialogPositionFunc();
                        resizeDelay = true;
                    }, 500 );
                }
            });
        }
        wbrptActionDialog.dialog( 'option', 'title', title );
        wbrptActionDialog.dialog( 'open' );
        wbrptActionDialog.attr( 'data-caption', loadingMessage );
        actionDialogPositionFunc();
        actionAjaxRequestPerforming = jQuery.ajax({
            method: 'POST',
            dataType: 'json',
            url: ajaxurl,
            data: data,
            success: function( response ) {
                if( response[ 'error' ] ) {
                    wbrptActionDialog.removeClass( 'ajax-loader-text' );
                    wbrptActionDialog.html( '<div class="message-error">' + response[ 'error' ] + '</div>' );
                } else {
                    if( response[ 'colorListHtml' ] && response[ 'columnColorListHtml' ] ) {
                        colorSelectorEl.empty();
                        columnColorSelectorEl.empty();
                        colorSelectorEl.html( response[ 'colorListHtml' ] );
                        columnColorSelectorEl.html( response[ 'columnColorListHtml' ] );
                        updateColumnColorBoxWidthFunc();
                    }
                    if( response[ 'colorVariableListHtml' ] ) {
                        colorVariableInputEls.spectrum( 'destroy' );
                        colorVariableListEl.empty();
                        colorVariableListEl.html( response[ 'colorVariableListHtml' ] );
                        colorVariableInputEls = colorVariableListEl.find( '.color input' );
                        colorVariableInputEls.spectrum( spectrumOptions );
                    }
                    if( response.hasOwnProperty( 'instanceAdding' ) ) {
                        if( response[ 'instanceAdding' ] ) {
                            instanceAddButtonEl.removeClass( 'hidden' );
                        } else {
                            instanceAddButtonEl.addClass( 'hidden' );
                        }
                    }
                    if( response[ 'builderHtml' ] ) {
                        baseEl.empty();
                        baseEl.html( response[ 'builderHtml' ] );
                        instanceEls = baseEl.children( '.instance' );
                        initInstancesFunc();
                    }
                    wbrptActionDialog.dialog( 'close' );
                }
            }
        });
    }

    function getColorVariableDataFunc() {
        var colorVariableData = {};
        jQuery.each( colorVariableInputEls, function( index, item ) {
            var colorVariableInputEl = jQuery( item );
            var colorVariableValue = colorVariableInputEl.val();
            if( colorVariableValue == '' ) {
                return true;
            }
            colorVariableData[ colorVariableInputEl.data( 'varName' ) ] = colorVariableInputEl.val();
        });
        return colorVariableData;
    }

    jQuery( '#wbrpt-custom-color-generate, #wbrpt-custom-color-remove, #wbrpt-custom-color-load-all, #wbrpt-custom-color-preview, .wbrpt-full-version-banner' ).click( function( event ) {
        event.preventDefault();
        iframeRequestFunc( ajaxurl + '?action=wbrpt-full-version-banner', 'Upgrade to full version', { width: 590, height: 343 } );
    });

    customStylesShowEl.click( function( event ) {
        event.preventDefault();
        customStylesShowEl.addClass( 'hidden' );
        customStylesBlockEl.removeClass( 'hidden' );
        customStylesHideEl.removeClass( 'hidden' );
    });

    customStylesHideEl.click( function( event ) {
        event.preventDefault();
        customStylesHideEl.addClass( 'hidden' );
        customStylesBlockEl.addClass( 'hidden' );
        customStylesShowEl.removeClass( 'hidden' );
    });
    // END: design and color theme functionality

    // START: preview functionality
    function positionPreviewPTDialogFunc() {
        if( wbrptPricingTableEditorDialogPreviewPT.dialog( 'isOpen' ) ) {
            var windowWidth = jQuery(window).width() - 30;
            var windowHeight = jQuery(window).height() - 30;
            wbrptPricingTableEditorDialogPreviewPT.dialog( 'option', 'width', windowWidth );
            wbrptPricingTableEditorDialogPreviewPT.dialog( 'option', 'height', windowHeight );
            wbrptPricingTableEditorDialogPreviewPT.dialog( 'option', 'position', { my: 'center', at: 'center', of: window } );
        }
    }
    var previewButtonEl = jQuery( '#wbrpt-preview-changes' );
    previewButtonEl.click( function( event ) {
        event.preventDefault();
        if( typeof wbrptPricingTableEditorDialogPreviewPT === 'undefined' ) {
            wbrptPricingTableEditorDialogPreviewPT = jQuery( '<div class="ajax-loader"></div>' );
            var previewIframeEl = false;
            wbrptPricingTableEditorDialogPreviewPT.dialog({
                title:     'Pricing table preview',
                autoOpen:  false,
                modal:     true,
                resizable: false,
                draggable: false,
                width:     800,
                height:    600,
                open: function( event, ui ) {
                    previewIframeEl = jQuery( '<iframe width="100%" height="100%" name="wbrpt-preview-output"></iframe>' );
                    wbrptPricingTableEditorDialogPreviewPT.append( previewIframeEl );
                    previewIframeEl.load(function(){
                        wbrptPricingTableEditorDialogPreviewPT.removeClass( 'ajax-loader' );
                    });
                },
                close: function( event, ui ) {
                    wbrptPricingTableEditorDialogPreviewPT.addClass( 'ajax-loader' );
                    previewIframeEl.remove();
                    previewIframeEl = false;
                    colorVariableDataInputEl.val( '' );
                }
            });
            var resizeDelay = true;
            jQuery(window).resize(function() {
                if( resizeDelay ) {
                    resizeDelay = false;
                    setTimeout( function(){
                        positionPreviewPTDialogFunc();
                        resizeDelay = true;
                    }, 500 );
                }
            });
        }
        wbrptPricingTableEditorDialogPreviewPT.dialog( 'open' );
        positionPreviewPTDialogFunc();
        var formActionEl = formEl.find( 'input[name=action]' );
        var originalData = {
            action:          formEl.attr( 'action' ),
            formActionValue: formActionEl.val()
        };
        formEl.attr( 'action', ajaxurl );
        formActionEl.val( 'wbrpt-pricing-table-preview' );
        formEl.attr( 'target', 'wbrpt-preview-output' );
        formEl.submit();
        formEl.attr( 'action', originalData.action );
        formActionEl.val( originalData.formActionValue );
        formEl.removeAttr( 'target' );
    });
    jQuery( '#minor-publishing-actions #save-action' ).after( previewButtonEl );
    previewButtonEl.removeClass( 'hidden' );
    // END: preview functionality

    // START: load demo content functionality and select design
    jQuery( '#wbrpt-load-demo-data' ).click( function( event ) {
        event.preventDefault();
        if( confirm( 'All your entered data will be overwritten by demo ones!' ) ) {
            actionAjaxRequestFunc({
                action:   'wbrpt-builder-generate',
                design:   designSelectorEl.val(),
                demoData: 1
            }, 'Builder', 'Loading demo content' );
        }
    });
    // END: load demo content functionality
    var instanceAddButtonEl = jQuery( '#wbrpt-editor-instance-add' );
    var instanceRemoveButtonEl = jQuery( '#wbrpt-editor-instance-remove' );
    var instanceSelectorEl = jQuery( '#wbrpt-editor-instance-selector' );

    // START: add instance button
    instanceAddButtonEl.click( function( event ) {
        event.preventDefault();
        serializeBuilderDataFunc();
        actionAjaxRequestFunc( formEl.find( 'input[name^=wbrptData]' ).serialize() + '&action=wbrpt-builder-generate&design=' + designSelectorEl.val() + '&addInstance=1', 'Builder', 'Adding new version' );
    });
    // END: add instance button

    // START: remove instance button
    instanceRemoveButtonEl.click( function( event ) {
        event.preventDefault();
        serializeBuilderDataFunc();
        actionAjaxRequestFunc( formEl.find( 'input[name^=wbrptData]' ).serialize() + '&action=wbrpt-builder-generate&design=' + designSelectorEl.val() + '&removeInstance=' + instanceSelectorEl.val(), 'Builder', 'Adding new version' );
    });
    // END: remove instance button

    function instanceFunc( instanceEl ) {
        var tableEl = instanceEl.find( 'table' );
        tableEl.tabledragdrop({
            'onDrop': function( startIndex, lastIndex, type ) {
                updateFieldsFunc( tableEl );
            }
        });

        function updateFieldsFunc( tableEl ) {
            jQuery.each( tableEl.find( 'tr' ), function( rowIndex, rowItem ) {
                jQuery.each( jQuery( rowItem ).find( 'td, th' ), function( cellIndex, cellItem ) {
                    if( rowIndex == 0 && cellIndex == 0 ) {
                        return true;
                    }
                    var isSingleIndex = ( rowIndex == 0 || cellIndex == 0 );
                    jQuery.each( jQuery( cellItem ).find( 'input, select, textarea' ), function( inputIndex, inputItem ) {
                        var inputEl = jQuery( inputItem );
                        var inputName = inputEl.attr( 'data-var-name' );
                        var inputType = inputEl.attr( 'type' );
                        if( inputType == 'radio' || inputType == 'checkbox' ) {
                            inputID = inputEl.attr( 'id' );
                            var inputNewID = inputID.replace( isSingleIndex ? /\d+$/ : /\d+-\d+$/, '' );
                            if( cellIndex != 0 ) {
                                inputNewID = inputNewID + cellIndex;
                            }
                            if( cellIndex != 0 && rowIndex != 0 ) {
                                inputNewID = inputNewID + '-';
                            }
                            if( rowIndex != 0 ) {
                                inputNewID = inputNewID + rowIndex;
                            }
                            jQuery( cellItem ).find( 'label[for=' + inputID + ']' ).attr( 'for', inputNewID );
                            inputEl.attr( 'id', inputNewID );
                        }
                        if( inputName && !( cellIndex == 0 && rowIndex == 0 ) ) {
                            var inputNewName = inputName.replace( isSingleIndex ? /\[\d+\]$/ : /\[\d+\]\[\d+\]$/, '' );
                            if( cellIndex != 0 ) {
                                inputNewName = inputNewName + '[' + cellIndex + ']';
                            }
                            if( rowIndex != 0 ) {
                                inputNewName = inputNewName + '[' + rowIndex + ']';
                            }
                            inputEl.attr( 'data-var-name', inputNewName );
                        }
                    });
                });
            });
        }

        function preparePreviewHTMLFunc( html ) {
            html = html.replace( /\n/g, '<br>' );
            return html;
        }

        instanceEl.find( '.copy-row' ).click( function( event ) {
            event.preventDefault();
            var thisRowEl = jQuery( this ).parents( 'tr' );
            thisRowEl.clone( true ).appendTo( tableEl.find( 'tbody' ) )
            updateFieldsFunc( tableEl );
        });

        instanceEl.find( '.copy-column' ).click( function( event ) {
            event.preventDefault();
            var headCellEls = tableEl.find( 'thead tr td, thead tr th' );
            if ( headCellEls.length >= 5 ) {
                alert( 'You cannot have more than four plans, only Full Version supports five!' );
            } else {
                headCellEls.removeClass( 'extend' );
                var thisCellEl = jQuery( this ).parents( 'td, th' );
                var thisCellIndex = headCellEls.index( thisCellEl );
                jQuery.each( tableEl.find( 'tr' ), function( index, rowItem ) {
                    var rowItemEl = jQuery( rowItem );
                    var itemCellEls = rowItemEl.children( 'td, th' );
                    jQuery( itemCellEls[ thisCellIndex ] ).clone( true ).appendTo( rowItemEl );
                });
                updateFieldsFunc( tableEl );
            }
        });

        instanceEl.find( '.remove-row' ).click( function( event ) {
            event.preventDefault();
            if( tableEl.find( 'tbody tr' ).length <= 1 ) {
                alert( 'You cannot remove all features, at least you need to have one!' );
            } else {
                thisRowEl = jQuery( this ).parents( 'tr' );
                thisRowEl.remove();
            }
            updateFieldsFunc( tableEl );
        });

        instanceEl.find( '.remove-column' ).click( function( event ) {
            event.preventDefault();
            var headCellEls = tableEl.find( 'thead tr td, thead tr th' );
            if( headCellEls.length <= 3 ) {
                alert( 'You cannot have less than two plans!' );
            } else {
                var thisCellEl = jQuery( this ).parents( 'td, th' );
                var thisCellIndex = headCellEls.index( thisCellEl );
                jQuery.each( tableEl.find( 'tr' ), function( index, rowItem ) {
                    var rowItemEl = jQuery( rowItem );
                    var cellEls = rowItemEl.find( 'td, th' );
                    jQuery( cellEls[ thisCellIndex ] ).remove();
                });
            }
            updateFieldsFunc( tableEl );
        });

        instanceEl.find( '.add-row' ).click( function( event ) {
            event.preventDefault();
            var firstTableRowEl = tableEl.find( 'tbody tr:first-child' );
            var newTableRowEl = firstTableRowEl.clone( true );
            newTableRowEl.appendTo( tableEl.find( 'tbody' ) );
            var newTableRowFieldEls = newTableRowEl.find( 'input[type=text], input[type=hidden], textarea' );
            newTableRowFieldEls.val( '' );
            newTableRowEl.find( '.field-preview' ).trigger( 'click' );
            newTableRowFieldEls.first().focus();
            updateFieldsFunc( tableEl );
            newTableRowEl.find( 'input[type=radio][value=0]' ).trigger( 'click' );
            jQuery.each( newTableRowEl.find( 'select' ), function( index, selectItem ) {
                var selectItemEl = jQuery( selectItem );
                selectItemEl.val( selectItemEl.children( 'option:first' ).val() ).trigger( 'change' );
            });
        });

        instanceEl.find( '.add-column' ).click( function( event ) {
            event.preventDefault();
            var headCellEls = tableEl.find( 'thead tr td, thead tr th' );
            if ( headCellEls.length >= 5 ) {
                alert( 'You cannot have more than four plans, only Full Version supports five!' );
            } else {
                headCellEls.removeClass( 'extend' );
                var firstCellFirstFieldEl = false;
                var newCellDefaultRadioEls = [];
                jQuery.each( tableEl.find( 'tr' ), function( index, rowItem ) {
                    var rowItemEl = jQuery( rowItem );
                    var firstCellEl = rowItemEl.children( 'td:nth-child(2),th:nth-child(2)' );
                    var newCellEl = firstCellEl.clone( true );
                    newCellEl.appendTo( rowItemEl );
                    var newCellFieldEls = newCellEl.find( 'input[type=text], input[type=hidden], textarea' );
                    newCellFieldEls.val( '' );
                    newCellEl.find( '.image-preview' ).attr( 'style', false );
                    newCellEl.find( '.field-preview' ).trigger( 'click' );
                    newCellEl.find( 'input[type=checkbox]' ).prop( 'checked', false );
                    if( firstCellFirstFieldEl === false ) {
                        firstCellFirstFieldEl = newCellFieldEls.filter( 'input[type=text]' ).first();
                    }
                    newCellDefaultRadioEls = jQuery.merge( newCellEl.find( 'input[type=radio][value=0]' ), newCellDefaultRadioEls );
                    jQuery.each( newCellEl.find( 'select' ), function( index, selectItem ) {
                        var selectItemEl = jQuery( selectItem );
                        selectItemEl.val( selectItemEl.children( 'option:first' ).val() ).trigger( 'change' );
                    });
                });
                jQuery( window ).scrollTop( instanceEl.offset().top - 32 );
                firstCellFirstFieldEl.focus();
                updateFieldsFunc( tableEl );
                newCellDefaultRadioEls.trigger( 'click' );
            }
        });

        instanceEl.find( '.extend-column' ).click( function( event ) {
            event.preventDefault();
            var thisCellEl = jQuery( this ).parents( 'td, th' );
            var thisRowEl = jQuery( this ).parents( 'tr' );
            if( thisCellEl.hasClass( 'extend' ) ) {
                thisCellEl.removeClass( 'extend' );
            } else {
                thisRowEl.children( 'td, th' ).removeClass( 'extend' );
                thisCellEl.addClass( 'extend' );
            }
        });

        instanceEl.find( '.color-column' ).click( function( event ) {
            event.preventDefault();
            thisEl = jQuery( this );
            if( columnColorTrigger.button === false || thisEl[ 0 ] != columnColorTrigger.button[ 0 ] ) {
                columnColorTrigger = { button: thisEl, input: thisEl.prev( 'input' ) };
                columnColorBoxEl.find( 'input[value=""]' ).prop( 'checked', true );
                columnColorBoxEl.find( 'input[value="' + columnColorTrigger.input.val() + '"]' ).prop( 'checked', true );
                columnColorBoxEl.removeClass( 'hidden' );
                columnColorBoxEl.position({
                    my:        'left top',
                    at:        'left bottom',
                    of:        thisEl
                });
            } else {
                jQuery( document ).trigger( 'mousedown' );
            }
        });

        instanceEl.find( 'input[type=radio]' ).change( function( event ) {
            var thisEl = jQuery( this );
            thisEl.parent().children( 'input[data-var-name="' + thisEl.attr( 'data-var-name' ) + '"]' ).prop( 'checked', false );
            thisEl.prop( 'checked', true );
        });

        instanceEl.find( 'select' ).change( function( event ) {
            var thisEl = jQuery( this );
            var thisOptionEl = thisEl.find( ':selected' );
            thisEl.find( 'option[selected]' ).attr( 'selected', false );
            thisOptionEl.attr( 'selected', true );
        });

        /* code preview for fields */
        instanceEl.find( '.field-preview' ).click( function( event ) {
            var thisEl = jQuery( this );
            var targetEl = thisEl.prev( '.preview-target' );
            targetEl.addClass( 'show-original' );
            targetEl.focus();
        });

        instanceEl.find( '.preview-target' ).blur( function( event ) {
            var thisEl = jQuery( this );
            if( thisEl.val() != '' ) {
                var previewEl = thisEl.next( '.field-preview' );
                previewEl.html( preparePreviewHTMLFunc( thisEl.val() ) );
                thisEl.removeClass( 'show-original' );
            }
        });

        instanceEl.find( 'input[data-checkbox-group]' ).change( function( event ) {
            if( this.checked ) {
                var thisEl = jQuery( this );
                thisEl.parent().children( 'input[data-checkbox-group="' + thisEl.attr( 'data-checkbox-group' ) + '"]' ).not( this ).prop( 'checked', false );
            }
        });

        instanceEl.find( '.image-preview' ).click( function( event ) {
            var thisEl = jQuery( this );
            var inputEl = thisEl.prev( 'input' );
            if( typeof wbrptPricingTableEditorImageInsert === 'undefined' ) {
                wbrptPricingTableEditorImageInsert = { dialog: false, inputEl: false, previewEl: false }
                wbrptPricingTableEditorImageInsert.dialog = wp.media({
                    frame: 'post',
                    library: { type: 'image' },
                    multiple: false
                });
                wbrptPricingTableEditorImageInsert.dialog.on( 'insert', function() { 
                    var url = wbrptPricingTableEditorImageInsert.dialog.state().get( 'selection' ).first().toJSON().url;
                    wbrptPricingTableEditorImageInsert.inputEl.val( url );
                    wbrptPricingTableEditorImageInsert.previewEl.css( 'background-image', 'url(' + url + ')' );
                });
                wbrptPricingTableEditorImageInsert.dialog.state('embed').on( 'select', function() {
                    var url = wbrptPricingTableEditorImageInsert.dialog.state().props.toJSON().url;
                    wbrptPricingTableEditorImageInsert.inputEl.val( url );
                    wbrptPricingTableEditorImageInsert.previewEl.css( 'background-image', 'url(' + url + ')' );
                });
            }
            wbrptPricingTableEditorImageInsert.inputEl = inputEl;
            wbrptPricingTableEditorImageInsert.previewEl = thisEl;
            wbrptPricingTableEditorImageInsert.dialog.open();
        });
    }

    function initInstancesFunc() {
        jQuery.each( instanceEls, function( index, item ) {
            new instanceFunc( jQuery( item ) );
        });
        if( instanceEls.length > 1 ) {
            instanceSelectorEl.empty();
            for( instanceID = 1; instanceID <= instanceEls.length; instanceID++ ) { 
                instanceSelectorEl.append( jQuery( '<option></option>' ).attr( 'value', instanceID ).text( 'Version ' + instanceID ) ); 
            }
            instanceRemoveButtonEl.removeClass( 'hidden' );
            instanceSelectorEl.removeClass( 'hidden' );
        } else {
            instanceRemoveButtonEl.addClass( 'hidden' );
            instanceSelectorEl.addClass( 'hidden' );
        }
    }

    initInstancesFunc();

    instanceSelectorEl.val( jQuery( '#wbrpt-editor-instance-active' ).val() );
    jQuery( '#save-post, #publish' ).show();
}

jQuery(function(){
    var pricingTableEditorEl = jQuery( '.wbrpt-editor' );
    wbrptPricingTableEditor( pricingTableEditorEl );
    pricingTableEditorEl.parent().removeClass( 'loading' );
});