<?php function getError($e) { ?>
	<table style="border:1px solid #000" cellpadding="5px;" cellspacing="0px;" border="1px">
		<tr>
			<th colspan=2 style="background-color:#000; color:white; font-weight:bold; font-size:22px;">Exception Info</th>
		</tr>
		<tr>
			<td><b>Code:</b></td><td><?php echo $e->getCode(); ?></td>
		</tr>
		<tr>
			<td><b>Message:</b></td><td><?php echo $e->getMessage(); ?></td>
		</tr>
		<tr>
			<td><b>File:</b></td><td><?php echo $e->getFile(); ?></td>
		</tr>
		<tr>
			<td><b>Line:</b></td><td><?php echo $e->getLine(); ?></td>
		</tr>
	</table>
<?php die(); } ?>
