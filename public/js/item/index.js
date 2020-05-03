$(document).ready(function () {
	$('.item_selected').on('click', function() {
		$id = $(this).data('id');
		$name = $(this).data('name');		
		$('#myModalLabel').html($name);
	});
	
	$('#myModal').on('show.bs.modal', function(){
		var table = $('#item_history_table').DataTable({
			ajax: base_url + 'item/get_item_history/' + $id,
			order: [],
			ordering: false,
			destroy: true,
			aLengthMenu: [[25, 50, 75, -1], [25, 50, 75, 'All']],
			iDisplayLength: 25,
			dom: "<'row'<'col-sm-3'f><'col-sm-9'p>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'l><'col-sm-7'p>>",
			columns: [
				{ data: 'date' },
				{ data: 'customer' },
				{ data: 'in' },
				{ data: 'out' },
				{ data: 'balance' }
			],
			initComplete: function(){
                this.api().page('last').draw('page')
			}
		});
	});
	
	// $.ajax({
		// url: "https://reqres.in/api/users",
		// type: "POST",
		// data: {
			// name: "paul rudd",
			// movies: ["I Love You Man", "Role Models"]
		// },
		// success: function(response){
			// var data = response;
			// console.log(data);
			// alert(response);
		// }
	// });
		
});