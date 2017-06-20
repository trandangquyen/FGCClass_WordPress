jQuery(document).ready(function($) {
	var body, masthead, menuTogglePrimary, siteNavigationPrimary, socialNavigation, siteHeaderMenuPrimary, resizeTimer;

	function initMainNavigation( container ) {
		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: screenReaderText.expand
		} ) );

		container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		// For default page menu
		container.find( '.page_item_has_children > a' ).after( dropdownToggle );
        container.find( '.current_page_ancestor > button' ).addClass( 'toggled-on' );
        container.find( '.current_page_ancestor > .sub-menu' ).addClass( 'toggled-on' );
        container.find( '.page_item_has_children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		} );
	}
	//initMainNavigation( $( '.main-navigation' ) );

	//For Primary Menu
	menuTogglePrimary       = $( '#menu-toggle-primary' ); // button id
	siteHeaderMenuPrimary   = $( '#site-header-menu-primary' ); // wrapper id
	siteNavigationPrimary   = $( '#site-navigation-primary' ); // nav id
	initMainNavigation( siteNavigationPrimary );

	// Enable menuTogglePrimary.
	( function() {

		// Return early if menuTogglePrimary is missing.
		if ( ! menuTogglePrimary.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuTogglePrimary.add( siteNavigationPrimary ).attr( 'aria-expanded', 'false' );

		menuTogglePrimary.on( 'click', function() {
			$( this ).add( siteHeaderMenuPrimary ).toggleClass( 'toggled-on' );

			// jscs:disable
			$( this ).add( siteNavigationPrimary ).attr( 'aria-expanded', $( this ).add( siteNavigationPrimary ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigationPrimary.length || ! siteNavigationPrimary.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.clean-education', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigationPrimary.find( '.menu-item-has-children > a' ).on( 'touchstart.clean-education', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigationPrimary.find( '.menu-item-has-children > a' ).unbind( 'touchstart.clean-education' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.clean-education', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigationPrimary.find( 'a' ).on( 'focus.clean-education blur.clean-education', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();
	//Primary Menu End

	//For Secondary Menu
    menuToggleSecondary     = $( '#menu-toggle-secondary' ); // button id
    siteSecondaryMenu       = $( '#site-header-menu-secondary' ); // wrapper id
    siteNavigationSecondary = $( '#site-navigation-secondary' ); // nav id
    initMainNavigation( siteNavigationSecondary );

    // Enable menuToggleSecondary.
    ( function() {
        // Return early if menuToggleSecondary is missing.
        if ( ! menuToggleSecondary.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggleSecondary.add( siteNavigationSecondary ).attr( 'aria-expanded', 'false' );

        menuToggleSecondary.on( 'click', function() {
            $( this ).add( siteSecondaryMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigationSecondary ).attr( 'aria-expanded', $( this ).add( siteNavigationSecondary ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigationSecondary.length || ! siteNavigationSecondary.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 910 ) {
                $( document.body ).on( 'touchstart', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigationSecondary.find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigationSecondary.find( '.menu-item-has-children > a' ).unbind( 'touchstart' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigationSecondary.find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    })();
    //Secondary Menu End

	// Add the default ARIA attributes for the menu toggle and the navigations.
	function onResizeARIA() {
		if ( window.innerWidth < 910 ) {
			if ( menuTogglePrimary.hasClass( 'toggled-on' ) ) {
				menuTogglePrimary.attr( 'aria-expanded', 'true' );
			} else {
				menuTogglePrimary.attr( 'aria-expanded', 'false' );
			}

			if ( siteHeaderMenuPrimary.hasClass( 'toggled-on' ) ) {
				siteNavigationPrimary.attr( 'aria-expanded', 'true' );
			} else {
				siteNavigationPrimary.attr( 'aria-expanded', 'false' );
			}

			menuTogglePrimary.attr( 'aria-controls', 'site-navigation social-navigation' );
		} else {
			menuTogglePrimary.removeAttr( 'aria-expanded' );
			siteNavigationPrimary.removeAttr( 'aria-expanded' );
			menuTogglePrimary.removeAttr( 'aria-controls' );
		}
	}

	// Add 'below-entry-meta' class to elements.
	function belowEntryMetaClass( param ) {
		if ( body.hasClass( 'page' ) || body.hasClass( 'search' ) || body.hasClass( 'single-attachment' ) || body.hasClass( 'error404' ) ) {
			return;
		}

		$( '.entry-content' ).find( param ).each( function() {
			var element              = $( this ),
				elementPos           = element.offset(),
				elementPosTop        = elementPos.top,
				entryFooter          = element.closest( 'article' ).find( '.entry-footer' ),
				entryFooterPos       = entryFooter.offset(),
				entryFooterPosBottom = entryFooterPos.top + ( entryFooter.height() + 28 ),
				caption              = element.closest( 'figure' ),
				newImg;

			// Add 'below-entry-meta' to elements below the entry meta.
			if ( elementPosTop > entryFooterPosBottom ) {

				// Check if full-size images and captions are larger than or equal to 840px.
				if ( 'img.size-full' === param ) {

					// Create an image to find native image width of resized images (i.e. max-width: 100%).
					newImg = new Image();
					newImg.src = element.attr( 'src' );

					$( newImg ).on( 'load.clean-education', function() {
						if ( newImg.width >= 840  ) {
							element.addClass( 'below-entry-meta' );

							if ( caption.hasClass( 'wp-caption' ) ) {
								caption.addClass( 'below-entry-meta' );
								caption.removeAttr( 'style' );
							}
						}
					} );
				} else {
					element.addClass( 'below-entry-meta' );
				}
			} else {
				element.removeClass( 'below-entry-meta' );
				caption.removeClass( 'below-entry-meta' );
			}
		} );
	}

	$( document ).ready( function() {
		body = $( document.body );

		$( window )
			.on( 'load.clean-education', onResizeARIA )
			.on( 'resize.clean-education', function() {
				clearTimeout( resizeTimer );
				resizeTimer = setTimeout( function() {
					belowEntryMetaClass( 'img.size-full' );
					belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
				}, 300 );
				onResizeARIA();
			} );

		belowEntryMetaClass( 'img.size-full' );
		belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
	} );


	var jQueryheader_search = jQuery( '#search-toggle' );
	jQueryheader_search.click( function() {
		var jQuerythis_el_search = jQuery(this),
			jQueryform_search = jQuerythis_el_search.siblings( '#search-container' );

		if ( jQueryform_search.hasClass( 'displaynone' ) ) {
			jQueryform_search.removeClass( 'displaynone' ).addClass( 'displayblock' ).animate( { opacity : 1 }, 300 );
		} else {
			jQueryform_search.removeClass( 'displayblock' ).addClass( 'displaynone' ).animate( { opacity : 0 }, 300 );
		}
	});

	//Fit vids
	if ( jQuery.isFunction( jQuery.fn.fitVids ) ) {
		jQuery('.hentry, .widget').fitVids();
	}
});