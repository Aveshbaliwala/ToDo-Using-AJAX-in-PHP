<?php
	include "config.php";

	$result=mysqli_query($conn,"SELECT * FROM `tasks`");


	$i=1;
	while($row=mysqli_fetch_array($result))
	{?>	
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $row['task'];?></td>
	<?php
	$i++;}?>
?>