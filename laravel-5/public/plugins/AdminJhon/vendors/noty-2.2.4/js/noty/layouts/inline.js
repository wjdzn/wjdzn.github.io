(function($) {

	$.noty.layouts.inline = {
		name: 'inline',
		options: {},
		container: {
			object: '<ul class="noty_inline_layout_container" />',
			selector: 'ul.noty_inline_layout_container',
			style: function() {
				$(this).css({
					width: '100%',
					height: 'auto',
					margin: 0,
					padding: 0,
					listStyleType: 'none',
					zIndex: 9999999
				});
			}
		},
		parent: {
			object: '<li />',
			selector: 'li',
			css: {}
		},
		css: {
			display: 'none'
		},
		addClass: ''
	};

<<<<<<< HEAD
})(jQuery);
=======
})(jQuery);
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
