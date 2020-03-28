<div class='row'>
	<div class="col-md-4">
		<div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">Item In</h3>
			</div>
			
			<?php echo form_open(base_url() . 'item/create_edit_item_in_auth', array('id'=>'form_item_in', 'autocomplete'=>'off')); ?>
			<div class="box-body">
				<div class="form-group">
					<?php echo form_label('Date', 'date'); ?>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<?php echo form_input(array('type'=>'text', 'required'=>true, 'class'=>'form-control', 'id'=>'date', 'name'=>'date', 'value'=>date('Y-m-d'))); ?>
					</div>
				</div>
				
				<div class="form-group">
					<?php
					echo form_label('Item Name', 'item_id');
					echo form_dropdown('item_id', $item_names, '', 'class="form-control" name="item_id" id="item_id" style="width: 100%;"');
					?>
				</div>
				
				<div class="form-group">
					<?php
					echo form_label('Remaining', 'remaining');
					echo form_input(array('type'=>'number', 'disabled'=>true, 'class'=>'form-control', 'id'=>'remaining'));
					?>
				</div>
				
				<div class="form-group">
					<?php
					echo form_label('Quantity', 'quantity');
					echo form_input(array('type'=>'number', 'required'=>true, 'class'=>'form-control', 'id'=>'quantity', 'name'=>'quantity', 'placeholder'=>'e.g. 20'));
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
				<button type='submit' class='btn btn-info'>Item In</button>
			</div>
			<?php
			echo form_close();
			?>
		</div>
	</div>
	<div class="col-md-8">
		<div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">Item In History</h3>
			</div>
			
			<div class="box-body">
				<table id="item_in_table" class="table table-bordered table-hover" style="width:100%">
					<thead>
						<tr>
							<th>Date</th>
							<th>Quantity</th>
							<th>Item</th>
							<th>Note</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="box-footer">
			</div>
		</div>
	</div>
</div>