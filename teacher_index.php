<?php 
	include 'header.php';
	include 'database/teacher.php';
	
 ?>

<div id="contents">

		<h1>
			It's teachers portion
			<a href="index.php">Students</a>
		</h1>

		<section id="main_left">

			<h1>Create portion</h1>

			<?php
	
				$loop_var= new Teacher();

				//insert data portion
				if(isset($_POST['submit']))
				{
					$name= $_POST['name'];
					$dept= $_POST['dept'];
					$age= $_POST['age'];

					$loop_var->setName($name);
					$loop_var->setDept($dept);
					$loop_var->setAge($age);

					if($loop_var->insertInfo())
					{
						echo "<span style= 'color: tomato; font-weight: bold;'> Data inserted successfully... </span>";
					}
					else
					{
						echo "<span style= 'color: red; font-weight: bold;'> Data inserted unsuccessfully... </span>";
					}
				}

				//update data portion
				if(isset($_POST['update']))
				{
					$id= $_POST['id'];
					$name= $_POST['name'];
					$dept= $_POST['dept'];
					$age= $_POST['age'];

					$loop_var->setName($name);
					$loop_var->setDept($dept);
					$loop_var->setAge($age);

					if($loop_var->updateInfo($id))
					{
						echo "<span style='color: tomato; font-weight: bold;'> Data updated successfully... </span>";
					}
					else
					{
						echo "<span style='color: red; font-weight: bold;'> Data updated unsuccessfully... </span>";
					}
				}

			?>
			<?php

				if(isset($_GET['action']) && $_GET['action']=='update')
				{
					$id= (int)$_GET['id'];

					$result= $loop_var->helpToUpdate($id);

			?>
				<form action="teacher_index.php" method="post" accept-charset="utf-8">
				<table>
					<!--to get id when update -->
					<input type="hidden" name="id" value="<?php echo $result['id'] ?>">

					<tr>
						<td id="input_table_data">Name: </td>
						<td><input type="text" name="name" value="<?php echo $result['name']; ?>" required="1"></td>
					</tr>
					<tr>
						<td id="input_table_data">Department: </td>
						<td><input type="text" name="dept" value="<?php echo $result['dept']; ?>" required="1"></td>
					</tr>
					<tr>
						<td id="input_table_data">Age: </td>
						<td><input type="text" name="age" value="<?php echo $result['age']; ?>" required="1"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="update" value="Update">
							<input type="reset" name="reset" value="Clear">
						</td>
					</tr>
				</table>
			</form>

			<?php

				} else{
			?>

			<form action="teacher_index.php" method="post" accept-charset="utf-8">
				<table>
					<tr>
						<td id="input_table_data">Name: </td>
						<td><input type="text" name="name" placeholder="Input your name" required="1"></td>
					</tr>
					<tr>
						<td id="input_table_data">Department: </td>
						<td><input type="text" name="dept" placeholder="Input your department" required="1"></td>
					</tr>
					<tr>
						<td id="input_table_data">Age: </td>
						<td><input type="text" name="age" placeholder="Input your age" required="1"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Send">
							<input type="reset" name="reset" value="Clear">
						</td>
					</tr>
				</table>
			</form>
		<?php

			}
		?>
		</section>

		<section id="main_right">

			<h1>View portion</h1>

			<!--delete portion -->
			<?php

				if(isset($_GET['action']) && $_GET['action']=='delete')
				{
					$id= (int)$_GET['id'];

					if($loop_var->deleteInfo($id))
					{
						echo "<span style='color: tomato; font-weight: bold;'> Data deleted successfully... </span>";
					}
					else
					{
						echo "<span style='color: red; font-weight: bold;'> Data deleted unsuccessfully... </span>";
					}
				}
			?>
		
			<table id="output_table">
				<tr>
					<th>Serial</th>
					<th>Name</th>
					<th>Department</th>
					<th>Age</th>
					<th>Action(s)</th>
				</tr>

				<?php

					$i=0;
					foreach ($loop_var->getInfo() as $key => $value) 
					{
						$i++;
				?>

				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $value['name'];?></td>
					<td><?php echo $value['dept'];?></td>
					<td><?php echo $value['age'];?></td>
					<td>
						<?php echo "<a href='teacher_index.php?action=update&id=".$value['id']."'> Update </a>"; ?> ||
						<?php echo "<a href='teacher_index.php?action=delete&id=".$value['id']."' onClick= 'return confirm(\"Sure to delete?\")'> Delete </a>"; ?>
					</td>
				</tr>

				<?php

					}

				?>

			</table>
		</section>

</div>

<?php 
	include 'footer.php';
?>