$(document).ready(function () {
	 //Initialize Select2 Elements
	$('#item_id').select2();
    $('#customer').focus();
	var item_id = $('#item_id').val();
	
	//function for returning remaining quantity of an item
	function get_remaining_item_quantity(item_id = '') {
		return $.ajax({
			type: 'POST',
			url: base_url + 'item/get_remaining_item_quantity',
			data: { 
				item_id: item_id
			},
			success: function(data) {
				$('#remaining').val(data);
				
				if (parseInt($('#quantity').val()) > parseInt($('#remaining').val())) {
					alert('Quantity must not be more than remaining value');
					$('#quantity').val('');
				}
			}
		});
	}
	
	//display the remaining item quantity of the default item on page load
	get_remaining_item_quantity(item_id);
	
	$('#item_id').on('select2:select', function() {
		var item_id = $(this).val();
		get_remaining_item_quantity(item_id);
		var remaining = $('#remaining').val();
		
		if (parseInt($('#quantity').val()) > parseInt(remaining)) {
			alert('Quantity must not be more than remaining value');
			$('#quantity').val('');
		}
	});
	
	$('#quantity').on('keyup', function() {
		var remaining = $('#remaining').val();
		
		if (parseInt($(this).val()) > parseInt(remaining)) {
			alert('Quantity must not be more than remaining value');
			$(this).val('');
		}
	});
	// displays all item out
	$('#item_out_table').DataTable({
        ajax: base_url + 'item/getAllItemOut',
		order: [],
		columns: [
			{ data: 'date' },
			{ data: 'customer' },
			{ data: 'quantity' },
			{ data: 'name' },
			{ data: 'notes' },
			{ data: 'action' }
		]
    });
	
	$('#date').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd'
	});
	
	
	// using jquery UI autocomplete when searching for item name
	$('#customer').autocomplete({
		source: base_url + 'item/getCustomerName/',
		autoFocus: true
	});
	
	function currentDate() {
		let date = new Date();
		let	month = date.getMonth() + 1;
		let	day = date.getDate();
		let	year = date.getFullYear();

		if (month.toString().length < 2) {
			month = '0' + month;
		}
		
		if (day.toString().length < 2) {
			day = '0' + day;
		}

		return `${year}-${month}-${day}`;
	}
	
	function currentTime() {
		let date = new Date();
		let	hour = date.getHours();
		let	minutes = date.getMinutes();
		let	seconds = date.getSeconds();

		if (hour.toString().length < 2) {
			hour = '0' + hour;
		}
		
		if (minutes.toString().length < 2) {
			minutes = '0' + minutes;
		}
		
		if (seconds.toString().length < 2) {
			seconds = '0' + seconds;
		}

		return `${hour}:${minutes}:${seconds}`;
	}
	
	function form_default() {
		$('#customer').focus();
		$('#quantity').val('');
		$('#notes').val('');
		$('#id').val('');
		$('.box-title').html('Item Out');
		$('#item_out_button').html('Item Out');
	}
	
	$("#form_item_out").submit(function(e){
		e.preventDefault();
		$('#datetime').val($('#date').val() + ' ' + currentTime());
		var form_data = $(this).serialize();
		
		// get the item name of item
		var item_name = $('#item_id').select2('data')[0].text;
		var quantity = $('#quantity').val();
		var message = quantity + ' ' + item_name + '\n \nItem Out?';
		
		if (confirm(message)) {
			$.ajax({
				type: 'POST',
				url: base_url + 'item/item_out_process',
				data: form_data,
				success: function() {
					var details = quantity + ' ' + item_name;
					form_default();
					
					toastr.options = {
						timeOut: 3000,
						positionClass: 'toast-top-center'
					}
					
					toastr.success(details, 'Item Out');
					$('#item_out_table').DataTable().ajax.reload();
					get_remaining_item_quantity($item_id);
				}
			});
		}
	});
	
	$(document).on('click', '.edit_item_out', function(event) {
		var id = $(this).attr('data-id');
		
		$.ajax({
			url: base_url + 'item/get_item_out_details/'+id,
			dataType: 'json',
			success: function(data) {
				$('#date').val(data[0].date);
				$('#customer').val(data[0].customer);
				$('#quantity').val(data[0].quantity);
				$('#notes').val(data[0].notes);
				$('#item_id').val(data[0].item_id).trigger('change');
				$('#customer').focus();
				$('#id').val(id);
				$('.box-title').html('Edit Item Out');
				$('#item_out_button').html('Edit Item Out');
				get_remaining_item_quantity(data[0].item_id);
			}
		});
	});
	
	$(document).on('click', '.delete_item_out', function(event) {
		var id = $(this).attr('data-id');
		var quantity = $(this).attr('data-quantity');
		var item_name = $(this).attr('data-item');
		var message = quantity + ' ' + item_name + '\n \nDelete this?';
		
		if (confirm(message)) {
			$.ajax({
				url: base_url + 'item/delete_item_out/'+id,
				success: function() {
					var details = quantity + ' ' + item_name;
					toastr.options = {
						timeOut: 3000,
						positionClass: 'toast-top-center'
					}
					
					toastr.success(details, 'Deleted');
					$('#item_out_table').DataTable().ajax.reload();
				}
			});
		}
	});
});