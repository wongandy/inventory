<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title"><?php echo (isset($id)) ? 'Edit Item' : 'Create Item'; ?></h3>
	</div>
	
	<?php echo form_open(base_url() . 'item/create_edit_item_auth', array('id'=>'form_item_in', 'autocomplete'=>'off')); ?>
	<div class="box-body">
		<div class="form-group">
			<?php 
			echo form_label('Item Name', 'name');
			echo form_input(array('type'=>'text', 'class'=>'form-control', 'id'=>'name', 'name'=>'name', 'placeholder'=>'e.g. Grand Pozzo Cement', 'autofocus'=>true, 'required'=>true));
			?>
		</div>
		
		<div class="form-group">
			<?php
			echo form_label('Alias', 'alias');
			echo form_input(array('type'=>'text', 'class'=>'form-control', 'id'=>'alias', 'name'=>'alias', 'placeholder'=>'e.g. pozzo'));
			?>
		</div>
		
		<div class="form-group">
			<?php
			echo form_label('Notes', 'notes');
			echo form_textarea(array('class'=>'form-control', 'id'=>'notes', 'name'=>'notes', 'placeholder'=>'Type your notes here'));
			?>
		</div>
	</div>

	<div class="box-footer">
		<button type='submit' class='btn btn-info'>Create Item</button>
	</div>
	<?php echo form_close(); ?>
</div>