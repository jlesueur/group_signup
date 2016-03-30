$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
$(function () {
	$('.js-join').click(function () {
		var $this = $(this);
		var groupId = $this.attr('gs-groupId');
		console.log(groupId);
		$.post('/index.php/join', {groupId: groupId}, function () {
			console.log('joined!');
			window.location.reload();
		});
	});

	$('.js-save-group').click(function () {
		var $this = $(this);
		var $form = $this.closest('.modal-content').find('.modal-body form');
		$.post('/index.php/create_group', $form.serialize(), function() {
			console.log('created');
			window.location.reload();
		});
	});

	$('.js-kick-user').click(function() {
		var $this = $(this);
		var userId = $this.attr('data-userId');
		$.post('/index.php/kick', {userId: userId}, function () {
			window.location.reload();
		});
	});
	
	$('.js-delete-group').click(function() {
		var $this = $(this);
		var groupId = $this.attr('data-groupId');
		$.post('/index.php/delete_group', {groupId: groupId}, function () {
			window.location.reload();
		});
	})
});