$(function () {

	$('.file_select').click(function () {
		$(this).prev().click();
	});

	$('.file_input').change(function () {
		$(this).parent().prev().val($(this).val());
		$($(this).attr('data-id')).val($(this).val());
	});

	$('#form_trading_unit').change(function () {
		$('#minimum_lot_unit').html($('#form_trading_unit option:selected').text());
	});

	$('.delete_img').click(function () {
		$($(this).attr('data-id')).val('');
		$(this).prev().hide();
		$(this).hide();
	});

	$("#image_1_upload").uploadFile({
		url: "/uploadfile.json",
		fileName: "myfile",
		onSuccess: function (files, data, xhr)
		{
			console.log($(this).attr('class'));
			$('#form_image_1').val(data.saved_as);
			$('#image_1_thumbnail img').attr('src', '/upload/' + data.saved_as).show();
			$('#image_1_thumbnail').slideDown('slow');
			$('#image_1_thumbnail .delete_img').show();
		}
	});

	$("#image_2_upload").uploadFile({
		url: "/uploadfile.json",
		fileName: "myfile",
		onSuccess: function (files, data, xhr)
		{
			console.log($(this).attr('class'));
			$('#form_image_2').val(data.saved_as);
			$('#image_2_thumbnail img').attr('src', '/upload/' + data.saved_as).show();
			$('#image_2_thumbnail').slideDown('slow');
			$('#image_2_thumbnail .delete_img').show();
		}
	});

	$("#image_3_upload").uploadFile({
		url: "/uploadfile.json",
		fileName: "myfile",
		onSuccess: function (files, data, xhr)
		{
			console.log($(this).attr('class'));
			$('#form_image_3').val(data.saved_as);
			$('#image_3_thumbnail img').attr('src', '/upload/' + data.saved_as).show();
			$('#image_3_thumbnail').slideDown('slow');
			$('#image_3_thumbnail .delete_img').show();
		}
	});

});

