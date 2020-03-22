$(document).ready(function () {
	var base_url = "<?php echo base_url(); ?>";
	
	 //Initialize Select2 Elements
    $('#item_id').select2();
	$('#item_id').select2('open');
	
	$('#item_id').on('select2:select', function (e) {
		 $('#quantity').focus();
	});
	
	// displays all item in
	$('#item_in_table').DataTable({
        ajax: base_url + 'item/getAllItemIn',
		order: [],
		columns: [
			{ data: 'date' },
			{ data: 'quantity' },
			{ data: 'name' },
			{ data: 'notes' }
		]
    });
	
	$('#date').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd'
	});
	
	// using jquery UI autocomplete when searching for item name
	// $('#name').focus();
	// $('#name').autocomplete({
		// source: base_url + 'item/getItemName/',
		// autofocus: true,
		// focus: function(event, ui) {
			// event.preventDefault();
			// $(this).val(ui.item.label);
		// },
		// select: function(event, ui) {
			// event.preventDefault();
			// $("#item_id").val(ui.item.value);
		// },
		// change: function(event, ui) {
			// if (ui.item == null) {
				// event.currentTarget.value = '';
				// $("#item_id").val('');
			// }
		// }
	// });
	
	$("#form_item_in").submit(function(e){
		e.preventDefault();
		var form_data = $(this).serialize();
		
		// get the item name of item
		var name = $('#item_id').select2('data')[0].text;
		var quantity = $('#quantity').val();
		var message = quantity + ' ' + name + '\n \nItem In?';
		
		if (confirm(message)) {
			$.ajax({
				type: 'POST',
				url: base_url + 'item/create_edit_item_in_auth',
				data: form_data,
				success: function() {
					var details = quantity + ' ' + name;
					$('#item_id').select2('open');
					$('#quantity').val('');
					$('#notes').val('');
					
					toastr.options = {
						timeOut: 3000,
						positionClass: 'toast-top-center'
					}
					
					toastr.success(details, 'Item In');
					$('#item_in_table').DataTable().ajax.reload();
				}
			});
		}
	});
});