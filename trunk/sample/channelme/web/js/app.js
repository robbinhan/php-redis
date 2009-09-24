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
		$('a').bind('click', function(){ App.loadUrl( $(this).attr('href') ); });
	},

	loadUrl: function( ancor )
	{
		var container = ancor.substr(0, ancor.indexOf(':'));
		var url = 'index.php?action=' + ancor.substr(ancor.indexOf(':') + 1);
		$.get( url, function( r ) { $(container).html(r) } );
	},

	initForms: function()
	{
		$('form').bind('submit', function(){ App.submitForm( $(this) ); return false; });
	},

	submitForm: function( form )
	{
		var url = form.attr('action').substr(1);
		url = 'index.php?action=' + url;
		$.post(url, form.serialize(), function(r) { eval('App.' + form.attr('id') + 'FormHandle(r)'); }, 'json');
	},

	renderFormError: function( e )
	{
		if ( $('#error').length == 0 )
		{
			$('body').append( '<div class="error hidden" id="error">' + e + '</div>' );
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
	}
}

$(document).ready( App.init );