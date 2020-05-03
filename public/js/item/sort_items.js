
	function allowDrop(event) {
		event.preventDefault();
	}
	
	function drag(event) {
		event.dataTransfer.setData('id', event.target.id);
	}
	
	function drop(event) {
		event.preventDefault();
		var source_element = document.getElementById(event.dataTransfer.getData('id'));
		var source_parent = source_element.parentNode;
		var source_id = source_element.getAttribute('data-id');
		var source_sequence = source_element.getAttribute('data-sequence');
		var target_element = event.currentTarget.firstElementChild;
		var target_id = target_element.getAttribute('data-id');
		var target_sequence = target_element.getAttribute('data-sequence');
		event.currentTarget.replaceChild(source_element, target_element);
		source_parent.appendChild(target_element);
		var data = {source_id: source_id, source_sequence: source_sequence, target_id: target_id, target_sequence: target_sequence};
	
		$.ajax({
			url: base_url + 'item/database_sort_items',
			type: 'POST',
			data: {
				'data': data
			}
		});

		target_element.setAttribute('data-sequence', source_sequence);
		source_element.setAttribute('data-sequence', target_sequence);
	}