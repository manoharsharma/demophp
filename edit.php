<!-- <?php include 'db.php';
session_start();
if(!isset($_SESSION['username']))
{
      header('location:form.php');
      die();
}

      	$Pro_sn=$_GET['ID'];
		$query =$connect->prepare("SELECT * FROM prod where Sn =?");
      	
            $query->execute([$Pro_sn]);
      	while($row = $query->fetch(PDO::FETCH_OBJ)){
            
            $query1=$connect->prepare("SELECT * FROM pro_image where proid=$Pro_sn ");
            $query1->execute();
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="update.php?id=<?php echo $row->Sn ?>" method = "post" enctype="multipart/form-data">
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
