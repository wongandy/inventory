<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Item List</h3>
	</div>
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
					<table id="item_history_table" class="table table-bordered table-hover" style="width:100%">
						<thead>
							<tr>
								<th>Date</th>
								<th>Details</th>
								<th>In</th>
								<th>Out</th>
								<th>Balance</th>
								<th>Note</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="box-body table-responsive">
		<?php
		$break = 28;
		$start = 0;
		$end = $break;
		?>
		<table class='table table-bordered'>
			<tr>
				<?php foreach ($items as $key => $item) : ?>
					<?php if ($key == $start) : ?>
					<td>
					<table class='table table-bordered table-hover'>
						<tr class='item_selected' data-toggle="modal" data-target="#myModal" data-id='<?php echo $item->id; ?>' data-name='<?php echo $item->name; ?>'>
							<td style='width: 10px; text-align: right;'>
								<div><?php echo $item->remaining; ?></div>
								<div class="progress progress-xs">
									<div class="progress-bar progress-bar-<?php echo $item->status; ?>" style="width: <?php echo $item->percentage; ?>%"></div>
								</div>
							</td>
							<td><?php echo $item->name; ?></td>
							
						</tr>
					<?php else : ?>
						<tr class='item_selected' data-toggle="modal" data-target="#myModal" data-id='<?php echo $item->id; ?>' data-name='<?php echo $item->name; ?>'>
							<td style='width: 10px; text-align: right;'>
								<div><?php echo $item->remaining; ?></div>
								<div class="progress progress-xs">
									<div class="progress-bar progress-bar-<?php echo $item->status; ?>" style="width: <?php echo $item->percentage; ?>%"></div>
								</div>
							</td>
							<td><?php echo $item->name; ?></td>
						</tr>
					<?php if ($key == $end) : ?>
					<?php
					$start = ($end + 1);
					$end += ($break + 1);
					
					if ($end > count($items)) {
						$end = (count($items)-1);
					}
					?>
					</table>
					</td>
					<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</tr>
		</table>
	</div>
	
	<div class="box-footer">
	</div>
</div>