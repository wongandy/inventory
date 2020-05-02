<?php
foreach ($items as $item) {
	echo $generatorHTML->getBarcode($item->id, $generatorHTML::TYPE_CODE_128, 2, 50) . $item->name . '<br><br>';
}

?>
<div class="box">
	<div class="box-header with-border">
		<div class='row'>
			<div class='col-sm-1'>
				<h3 class="box-title">Barcode Item List</h3>
			</div>
		</div>
	</div>
	
	<div class="box-body table-responsive">
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