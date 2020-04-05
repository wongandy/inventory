<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo (isset($title)) ? $title : ''; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css">
	<style>
		.table>tbody>tr>td {
			padding: 0;
			line-height: 1.1;
			font-size: small;
		}
		
		.table>tbody>tr>td.remaining {
			width: 10px;
			padding-right: 3px;
			text-align: right;
		}
	</style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
	<?php
	// $break = 21;
	// $start = 0;
	// $end = $break;

	// foreach ($items as $key => $item) {
		// if ($key == $start) {
			// echo "<div class='col-xs-2' style='padding-right: 0; padding-left: 0'><table class='table table-bordered'><tr><td style='width: 10px; text-align: right;'>" . $item->remaining . "</td><td>" . $item->alias . "</td></tr>";
		// }
		// else {
			// echo "<tr><td style='width: 10px; text-align: right;'>" . $item->remaining . "</td><td>" . $item->alias . "</td></tr>";
		// }
		// if ($key == $end) {
			// echo "</table></div>";
			// $start = ($end + 1);
			// $end += ($break + 1);
			
			// if ($end > count($items)) {
				// $end = (count($items)-1);
			// }
		// }
	// }
	?>
	
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
				<table class='table table-bordered'>
					<tr>
						<td class='remaining'><?php echo $item->remaining; ?></td>
						<td><?php echo $item->alias; ?></td>
					</tr>
				<?php else : ?>
					<tr>
						<td class='remaining'><?php echo $item->remaining; ?></td>
						<td><?php echo $item->alias; ?></td>
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
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
