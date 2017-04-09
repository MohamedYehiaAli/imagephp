<?php
require_once("includes/confiq.php");
global $connection;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="addimage.php" enctype="multipart/form-data">
	<input type="file" name="image">
	<p>
		<input type="submit" name="submit">
	</p>

</form>
<br>
<br>
<?php 
$query="select * from test ";
$result_set=mysqli_query($connection,$query);
while($rows=mysqli_fetch_array($result_set)){
 ?>

<img src="<?php echo'photos/'.$rows['image'] ;?>" width="200px" height="300px">
<br>

<?php }?>

</body>
</html>

<?php




if (isset($_POST['submit'])) {
	$target="photos/".basename($_FILES['image']['name']);
	
	$images=$_FILES['image']['name'];
	//to know the file extention
	$fileExtention=explode(".",$images);
	$extention=strtoupper(end($fileExtention));
	echo "$extention";
	//
	if(!empty($images)){
	$query="insert into test values(null,'$images') ";
	$result=mysqli_query($connection,$query);
}
else echo "please choose a image to upload .";
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
		echo "your image is updated ";
	else
		echo "error";
}

?>