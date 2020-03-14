<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title"><?php echo (isset($id)) ? 'Edit Item' : 'Create Item'; ?></h3>
	</div>
	
	<?php echo form_open(base_url() . 'item/auth', array('class'=>'form-horizontal')); ?>
	<div class="box-body">
		<div class="form-group">
		<?php echo form_label('Item Name', 'name', array('class'=>'col-sm-1 control-label')); ?>
			<div class="col-sm-11">
			<?php echo form_input(array('type'=>'text', 'class'=>'form-control', 'id'=>'name', 'name'=>'name', 'placeholder'=>'e.g. Grand Pozzo Cement', 'autofocus'=>true)); ?>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo form_label('Alias', 'alias', array('class'=>'col-sm-1 control-label')); ?>
			<div class="col-sm-11">
			<?php echo form_input(array('type'=>'text', 'class'=>'form-control', 'id'=>'alias', 'name'=>'alias', 'placeholder'=>'e.g. pozzo')); ?>
			</div>
		</div>
	</div>

	<div class="box-footer">
		<button type='submit' class='btn btn-info'>Create Item</button>
	</div>
	<?php echo form_close(); ?>
</div>