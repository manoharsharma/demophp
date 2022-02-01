
<!-- <?php include 'db.php';
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
?> -->