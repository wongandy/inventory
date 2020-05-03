$(document).ready(function () {
	//displays all created items
	$('#created_item_table').DataTable({
        ajax: base_url + 'item/getAllCreatedItem',
		order: [],
		paging: false,
		columns: [
			{ data: 'name' },
			{ data: 'alias' },
			{ data: 'notes' }
		]
    });

	$("#form_create_item").submit(function(e){
		e.preventDefault();
		var form_data = $(this).serialize();
		
		// get the item name of item
		var item_name = $('#name').val();
		var message = item_name + '\n \nCreate Item?';
		
		if (confirm(message)) {
			$.ajax({
				type: 'POST',
				url: base_url + 'item/create_edit_item_auth',
				data: form_data,
				success: function() {
					var details = item_name;
					$('#name').focus();
					
					toastr.options = {
						timeOut: 3000,
						positionClass: 'toast-top-center'
					}
					
					toastr.success(details, 'Created Item');
					$('#created_item_table').DataTable().ajax.reload();
				}
			});
		}
	});
});