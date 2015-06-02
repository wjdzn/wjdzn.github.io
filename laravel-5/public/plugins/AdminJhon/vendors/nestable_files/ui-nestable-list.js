$(document).ready(function() {

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })

    // activate Nestable for list 2
    $('#nestable2').nestable({
        group: 1
    })

    $('#nestable3').nestable();

	$('#nestable-menu').on('click', function(e) {
	        var target = $(e.target),
	            action = target.data('action');
	        if (action === 'expand-all') {
	            $('.dd').nestable('expandAll');
	        }
	        if (action === 'collapse-all') {
	            $('.dd').nestable('collapseAll');
	        }
	});

<<<<<<< HEAD
});
=======
});
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
