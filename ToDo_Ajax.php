<?php

	include "config.php";
	$errors = "";
	//connecting database
	

	if(isset($_POST['add']))
	{
		$task = $_POST['task'];

		if(empty($task))
		{
			$errors = "You Must fill the task";
		}
		else
		{
			mysqli_query($conn,"INSERT INTO `tasks`(`task`) VALUES ('$task')");
			header("location:ToDo_Ajax.php");
		}
	}
	//deleting the tasks
	if(isset($_GET['del_task']))
	{
		$id = $_GET['del_task'];
		mysqli_query($conn,"DELETE FROM `tasks` WHERE id=$id");
		header("location:ToDo_Ajax.php");
	}

	//store the data into an object
	$tasks = mysqli_query($conn,"SELECT * FROM `tasks`");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="todo.css">
	<title>Todo_Ajax</title>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	
</head>
<body>
		<div class="first_container">
			<form action="" method="POST">
				<div class = "Container">
					<div class="row">
						<h2>ToDo List</h2>
						<div class="data">
							<input type="text" name="task" class="task_input" placeholder="Enter Your Task">
							<button type="submit" class="add_btn" name="add">Add</button><br>
							<button type="submit" class="submit_data" name="submit" id="submit">Submit</button>
						</div>
					</div>
				</div>
			</form>
			<table class="tbl_data">
		<thead>
			<tr>
				<th>No</th>
				<th>Tasks</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=1;
			while ($row = mysqli_fetch_array($tasks)) { 
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td class="task"><?php echo $row['task'];?></td>
				<td class="delete">
					<a href="ToDo_Ajax.php?del_task=<?php echo $row['id'];?>">Delete</a>
				</td>
			</tr>
			<?php 
			$i++;}
			?>
		</tbody>
	</table>

		</div>
		<div class = second_container>
			<div class ="heading">
				<h2 style="text-align: center;font-family: poppins;">Entered Data</h2>
			</div>
			<div class="taskdata">
				<table style="width:80%;font-family:poppins;margin-left: 10%;">
					<thead style="text-align:center;background-color: black;color: white;">
						<tr>
							<td>Id</td>
							<td>Name</td>
						</tr>
					</thead>
					<tbody id="tbody" style="text-align:center;">
				<!-- 	coding -->	
					</tbody>
				</table>
			</div>
		</div>
		<script>
		$(document).ready(function(){

			$('#submit').click(function(e){

				e.preventDefault();
				console.log("button Clicked");
				$.ajax({
					url:'showdata.php',
					method:'POST',
					dataType:'html',
					success:function(response)
					{
						$('#tbody').html(response);
					}
				});
			});
		});
	</script>
</body>
</html>