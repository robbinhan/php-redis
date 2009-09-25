var App = {
	init: function()
	{
		App.initLinks();
		App.initForms();

		if ( document.location.toString().indexOf('#') > 0 )
		{
			App.loadUrl( document.location.toString().substr( document.location.toString().indexOf('#') ) );
		}
		else
		{
			App.loadUrl( '#body:index' );
		}
	},

	initLinks: function()
	{
		$('a[forced!=1]').bind('click', function(){ App.loadUrl( $(this).attr('href') ); });
		$('a').attr('forced', 1);
	},

	loadUrl: function( ancor )
	{
		var container = ancor.substr(0, ancor.indexOf(':'));
		var url = 'index.php?action=' + ancor.substr(ancor.indexOf(':') + 1);
		$.get( url, function( r ) { $(container).html(r); App.initLinks(); App.initForms(); } );
	},

	initForms: function()
	{
		$('form[forced!=1]').bind('submit', function(){ App.submitForm( $(this) ); return false; });
		$('form').attr('forced', 1);
	},

	submitForm: function( form )
	{
		var url = form.attr('action').substr(1);
		url = 'index.php?action=' + url;
		$.post(url, form.serialize(), function(r) {
			eval('App.' + form.attr('id') + 'FormHandle(r)');
		}, form.attr('rel') ? form.attr('rel') : 'json' );
	},

	renderFormError: function( e )
	{
		if ( $('#error').length == 0 )
		{
			$('body').append( '<div class="error" id="error">' + e + '</div>' );
		}
		else
		{
			$('#error').html( e );
		}
	},

	signupFormHandle: function( r )
	{
		if ( !r.error )
		{
			document.location.reload();
		}

		App.renderFormError( r.error );
		$('#error').prependTo( $('#signup > fieldset') );
	},

	signinFormHandle: function( r )
	{
		if ( !r.error )
		{
			document.location.reload();
		}

		App.renderFormError( r.error );
		$('#error').prependTo( $('#signin > fieldset') );
	},

	add_channelFormHandle: function( r )
	{
		$('#add_channel > input.text').val('');
		$('#my_channels_list').prepend( App.renderChannel(r) );
		$('#c' + r.id).fadeIn( 150 );

		App.initLinks();
	},

	renderChannel: function( data )
	{
		return '<li class="hidden" id="c' + data.id + '"><a onclick="App.channelSelect(this);" href="#body:channel&id=' + data.id + '">' + data.title + '</a></li>';
	},

	postFormHandle: function( r )
	{
		$('#add_channel > input.text').val('');
		$('#posts').prepend(r);
		$('#posts > li.hidden').show(150);
		$('#post > textarea').val('');

		App.initLinks();
	},

	channelSelect: function( ob )
	{
		$('#my_channels_list > li').removeClass('selected');
		$(ob).parent().addClass('selected');
	},

	joinChannel: function( id )
	{
		$.post( 'index.php?action=join_channel', {id: id}, function( r ) {
			$('#my_channels_list').prepend( App.renderChannel(r) );
			$('#c' + r.id).fadeIn( 150 );
			$('#join_pane').hide();
			$('#post').show();

			App.initLinks();
		}, 'json' );
	},

	leaveChannel: function( id )
	{
		$.post( 'index.php?action=leave_channel', {id: id}, function( r ) {
			$('#c' + id).fadeOut( 150 );
			$('#join_pane').show();
			$('#post').hide();
		}, 'json' );
	}
}

$(document).ready( App.init );