<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Item List</h3>
	</div>
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
					<table id="item_history_table" class="table table-bordered table-hover" style="width:100%">
						<thead>
							<tr>
								<th>Date</th>
								<th>Customer</th>
								<th>In</th>
								<th>Out</th>
								<th>Balance</th>
								<!--<th>Note</th>-->
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

	<!--<div class="box-body">
	<?php
	$break = 21;
	$start = 0;
	$end = $break;

	foreach ($print_items as $key => $item) {
		if ($key == $start) {
			echo "<div class='col-xs-2' style='padding-right: 0; padding-left: 0'><table class='table table-bordered'><tr><td style='width: 10px; text-align: right;'>" . $item->remaining . "</td><td>" . $item->alias . "</td></tr>";
		}
		else {
			echo "<tr><td style='width: 10px; text-align: right;'>" . $item->remaining . "</td><td>" . $item->alias . "</td></tr>";
		}
		if ($key == $end) {
			echo "</table></div>";
			$start = ($end + 1);
			$end += ($break + 1);
			
			if ($end > count($items)) {
				$end = (count($items)-1);
			}
		}
	}
	?>
	</div>-->
	<div class="box-body">
		<!--<div class='row'>
			<div class='col-sm-6'>
				<table class='table table-bordered'>
					<thead>
						<tr>
							<th>Date</th>
							<th>Customer</th>
							<th>In</th>
							<th>Out</th>
							<th>Balance</th>
							<th>Note</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$balance = 0;
					
					foreach ($test as $key => $item) :
						$item['customer'] = (isset($item['customer'])) ? $item['customer'] : '';
						$item['in'] = (isset($item['in'])) ? $item['in'] : '';
						$item['out'] = (isset($item['out'])) ? $item['out'] : '';
						$item['notes'] = (isset($item['notes'])) ? $item['notes'] : '';
						$balance += ($item['in'] - $item['out']);
					?>
					<tr>
						<td><?php echo $item['date']; ?></td>
						<td><?php echo $item['customer']; ?></td>
						<td><?php echo $item['in']; ?></td>
						<td><?php echo $item['out']; ?></td>
						<td><?php echo ($balance) ? $balance : ''; ?></td>
						<td><?php echo $item['notes']; ?></td>
					</tr>
					<?php
					endforeach;
					?>
					</tbody>
				</table>
			</div>
		</div>-->
		
		<?php
		$break = 18;
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
							<td style='width: 10px; text-align: right;'><?php echo $item->remaining; ?></td>
							<td><?php echo $item->name; ?></td>
						</tr>
					<?php else : ?>
						<tr class='item_selected' data-toggle="modal" data-target="#myModal" data-id='<?php echo $item->id; ?>' data-name='<?php echo $item->name; ?>'>
							<td style='width: 10px; text-align: right;'><?php echo $item->remaining; ?></td>
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