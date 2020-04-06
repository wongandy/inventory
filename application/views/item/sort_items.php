<style>
	.table>tbody>tr>td {
		padding: 0;
		line-height: 1.4;
		font-size: small;
	}
	
	.table>tbody>tr>td.remaining {
		width: 10px;
		padding-right: 3px;
		text-align: right;
	}
</style>
<div class="box">
	<div class="box-header with-border">
		<div class='row'>
			<div class='col-sm-1'>
				<h3 class="box-title">Item List</h3>
			</div>
			<div class='col-sm-11'>
				<!--<button type='button' class='btn btn-info btn-xs'>Print Item List</button>-->
				<a href="<?php echo base_url(); ?>item/item_list_print" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-print"></i> Print Item List</a>
			</div>
		</div>
	</div>
	
	<div class="box-body table-responsive">
		<?php
		$break = 27;
		$start = 0;
		$end = $break;
		?>
		<table class='table table-bordered'>
			<tr>
			<?php foreach ($items as $key => $item) : ?>
				<?php if ($key == $start) : ?>
				<td>
					<table class='table table-bordered table-hover'>
						<tr class='external-event' ondrop="drop(event)" ondragover="allowDrop(event)">
							<td id='<?php echo $item->id; ?>' data-id='<?php echo $item->id; ?>' data-sequence='<?php echo $item->sequence; ?>' draggable=true ondragstart='drag(event)'><?php echo $item->remaining . ' ' . $item->alias; ?></td>
						</tr>
					<?php else : ?>
						<tr class='external-event' ondrop="drop(event)" ondragover="allowDrop(event)">
							<td id='<?php echo $item->id; ?>' data-id='<?php echo $item->id; ?>' data-sequence='<?php echo $item->sequence; ?>' draggable=true ondragstart='drag(event)'><?php echo $item->remaining . ' ' . $item->alias; ?></td>
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
</div>