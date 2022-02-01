<!-- add product -->
<?php include 'db.php';
session_start();
if(!isset($_SESSION['username']))
{
	header('location:form.php');
	die();
}
?>
<?php

      if (isset($_POST['add_p']))
      {
      	
		$Name = $_POST['p_name'];
      	$Disp = $_POST['p_dis'];
      	$Price = $_POST['p_price'];
      	$add_product = $connect->prepare("INSERT INTO prod(pname,pdis,pprice) values(?,?,?)");
      	$add_product->execute([$Name,$Disp,$Price]);
      	$last_id = $connect->lastInsertId();
      	for($i=0; $i< count($_FILES['p_image']['name']); $i++){
      	
     	$v1=rand(1,99999);
     	$v2=md5($v1);
     	$fna = $_FILES['p_image']['name'][$i];
     	
     	$dst="product_image/".$v2.$fna;
     	
     	move_uploaded_file($_FILES['p_image']['tmp_name'][$i],$dst);
     	
      	$add_product1 = $connect->prepare("INSERT INTO pro_image(proid,pimage) values(?,?) ");
      	$add_product1->execute([$last_id,$dst]);
    
        if($add_product AND $add_product1 )
 	  	{
         	
         	header('location:login.php'); 
        }
         else
         {
         	echo "failed";
         }
       
     	} 
     	
 	 }

      	$Pro_sn=$_GET['ID'];
		$query =$connect->prepare("SELECT * FROM prod where Sn =?");
      	
            $query->execute([$Pro_sn]);
      	while($row = $query->fetch(PDO::FETCH_OBJ)){
            
            $query1=$connect->prepare("SELECT * FROM pro_image where proid=$Pro_sn ");
            $query1->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="formaction.php?id=<?php echo $row->Sn ?>" method = "post" enctype="multipart/form-data">
            <table>
                  <tr>
	                 <td><b>Product Name:</b></td>
                        <td>
                               <input type="text" name="p_name" value="<?php echo $row->pname ?>">
                        </td>
                  </tr>
	<tr>
            <td><b>Product Discription:</b></td>
            <td>
                  <input type="text" name="p_dis"  value="<?php echo $row->pdis?>">
            </td>
      </tr>
	<tr>
            <td><b>Product Price:</b></td>
            <td>
                  <input type="text" name="p_price" value="<?php echo $row->pprice?>">
             </td>
      </tr>
      <tr>
            <td><b>Product Image:</b> </td>
                  <?php
                   while($row1 = $query1->fetch(PDO::FETCH_OBJ)){
                  ?>
                        <td><img src="<?php echo $row1->pimage ?>"></td>  
      <?php 

                        }
                   }
       ?>                      
         </tr>
            <tr>
                              <td>
                                    <input type='file' name='p_image[]' multiple>
                              </td>
      </tr>
      <tr>
	     <td><input type="submit" name="update" value ="Update"></td>
      </tr>
      
</table>
      </form>
</body>
</html>
<!-- update -->
<?php 
	if (isset($_POST["update"]))
	{
		$Pro_sn=$_GET['id'];
		$Pro_name=$_POST['p_name'];
		$Pro_dis=$_POST['p_dis'];
		$Pro_price=$_POST['p_price'];
		$Query= $connect->prepare("UPDATE prod SET pname =?,pdis = ?,pprice=? WHERE Sn ='$Pro_sn'");
		$Query->execute([$Pro_name,$Pro_dis,$Pro_price]);
		$last_id = $connect->lastInsertId();
		for($i=0; $i< count($_FILES['p_image']['name']); $i++){
		$v1=rand(1,99999);
     	$v2=md5($v1);
     	$fna = $_FILES['p_image']['name'][$i];
     	$dst="product_image/".$v2.$fna;
     	move_uploaded_file($_FILES['p_image']['tmp_name'][$i],$dst);
     	$query1 = $connect->prepare("INSERT INTO pro_image(proid,pimage) values(?,?) ");
      	$query1->execute([$Pro_sn,$dst]);
		// $Query= $connect->prepare("UPDATE pro_image SET pimage=? WHERE proid ='$Pro_sn'");
		// $Query->execute([$dst]);
	}	
		if($Query OR $query1)
		{
			header('location:list.php');  
		}
		else{
			echo "connection failed";
		}
	}



if (isset($_GET['del'])){
	$Pro_sn = $_GET['del'];
	$query =$connect->prepare("SELECT * FROM pro_image where proid =?");
    $query->execute([$Pro_sn]);
    while($row = $query->fetch(PDO::FETCH_OBJ)){
    unlink($row->pimage);}
	$Query = $connect->prepare("DELETE FROM prod WHERE Sn=?");
	$Query->execute([$Pro_sn]);
	if($Query)
	{	
		header("location:list.php");
	}
	else
	{
		echo "connection failed";
	}
}
?>