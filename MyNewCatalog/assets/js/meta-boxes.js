jQuery( function ( $ ) {

	
//мета-боксы вордпресса
	$( '.wc-metaboxes-wrapper' ).on( 'click', '.wc-metabox > h3', function() {
		$( this ).parent( '.wc-metabox' ).toggleClass( 'closed' ).toggleClass( 'open' );
	});

	// Табличные панели
	$( document.body ).on( 'wc-init-tabbed-panels', function() {
		$( 'ul.wc-tabs' ).show();
		$( 'ul.wc-tabs a' ).click( function( e ) {
			e.preventDefault();
			var panel_wrap = $( this ).closest( 'div.panel-wrap' );
			$( 'ul.wc-tabs li', panel_wrap ).removeClass( 'active' );
			$( this ).parent().addClass( 'active' );
			$( 'div.panel', panel_wrap ).hide();
			$( $( this ).attr( 'href' ) ).show();
		});
		$( 'div.panel-wrap' ).each( function() {
			$( this ).find( 'ul.wc-tabs li' ).eq( 0 ).find( 'a' ).click();
		});
	}).trigger( 'wc-init-tabbed-panels' );


	// Мета бокс отрыть/закрыть
	$( '.wc-metaboxes-wrapper' ).on( 'click', '.wc-metabox h3', function( event ) {

		if ( $( event.target ).filter( ':input, option, .sort' ).length ) {
			return;
		}

		$( this ).next( '.wc-metabox-content' ).stop().slideToggle();
	})
	.on( 'click', '.expand_all', function() {
		$( this ).closest( '.wc-metaboxes-wrapper' ).find( '.wc-metabox > .wc-metabox-content' ).show();
		return false;
	})
	.on( 'click', '.close_all', function() {
		$( this ).closest( '.wc-metaboxes-wrapper' ).find( '.wc-metabox > .wc-metabox-content' ).hide();
		return false;
	});
	$( '.wc-metabox.closed' ).each( function() {
		$( this ).find( '.wc-metabox-content' ).hide();
	});
});
