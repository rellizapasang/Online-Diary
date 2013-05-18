$(function () {
	$('#unlikeForm').submit(function () {
		var action = $(this).attr('action');
	
		$.ajax({
			type: "POST",
			url: action,
			data: $(this).serialize(),
			success: function(response)
			{
				$('#like_field').html(response);
			}
		});
		return false;
	});
});

$(function () {
	$('#likeForm').submit(function () {
		var action = $(this).attr('action');
	
		$.ajax({
			type: "POST",
			url: action,
			data: $(this).serialize(),
			success: function(response)
			{
				$('#like_field').html(response);
			}
		});
		return false;
	});
});

$(function () {
	$('.hide_comment_form').submit(function () {
		var action = $(this).attr('action');
	
		$.ajax({
			type: "POST",
			url: action,
			data: $(this).serialize(),
			success: function(response)
			{
				$('.comment_list').html(response);
			}
		});
		return false;
	});
});

$(function () {
	$('.unhide_comment_form').submit(function () {
		var action = $(this).attr('action');
	
		$.ajax({
			type: "POST",
			url: action,
			data: $(this).serialize(),
			success: function(response)
			{
				$('.comment_list').html(response);
			}
		});
		return false;
	});
});
$(function () {
	$('#addComment').submit(function () {
		var action = $(this).attr('action');
	
		$.ajax({
			type: "POST",
			url: action,
			data: $(this).serialize(),
			success: function(response)
			{
				$('.comment_list').html(response);
				$('.add_comment_text').val('');
			}
		});
		return false;
	});
});
$(function () {
	$('.delete_comment_form').submit(function () {
		var action = $(this).attr('action');
	
		$.ajax({
			type: "POST",
			url: action,
			data: $(this).serialize(),
			success: function(response)
			{
				$('.comment_list').html(response);
			}
		});
		return false;
	});
});