	$.editable.addInputType('autocomplete', { 
		element : $.editable.types.text.element, 
		plugin : function(settings, original) { 
			$('input', this).autocomplete(settings.autocomplete);
		}
	}); 