<!-- <?php include 'db.php';
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
?> -->