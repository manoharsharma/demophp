<?php 
session_start();
if(!isset($_SESSION['username']))

{
	header('location:form.php');
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>List of All Product </h1>
		<table align= "centre" border="1px">
			<thead>
				<t>
					<!-- <th>Sn</th> -->
					<th>Name</th>
					<th>Discription</th>
					<th>Price</th>
					<th>product image</th>
					<th colspan="3">Operation</th>
				</t>

	<?php include 'db.php';
	

      $query=$connect->prepare("SELECT * FROM prod ");
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_OBJ)){
      		$Id=$row->Sn;
      $query1=$connect->prepare("SELECT * FROM pro_image where proid=$Id LIMIT 0,1 ");
      	 $query1->execute();
      	 while($row1 = $query1->fetch(PDO::FETCH_OBJ)){

	?>
      	<tr>
			<td><?php echo $row->pname ?></td>
			<td><?php echo $row->pdis ?></td>
			<td><?php echo $row->pprice ?></td>
			<td><img src="<?php echo $row1->pimage ?>"></td>
			<td><a href="formaction.php?ID=<?php echo $row->Sn; ?>">Edit</a></td>
			<td><a href="formaction.php?del=<?php echo $row->Sn; ?>">Delete</a></td>
		</tr>
	
	<?php
     }
 }

?>
<a href="login.php">Back</a>
			
			</thead>
		</table>
</body>
</html>