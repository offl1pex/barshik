<?php 
include "../connect.php"; 

$idCat = isset($_POST['idCat']) ? $_POST['idCat'] : false; 
$Name = isset($_POST['Name']) ? $_POST['Name'] : false; 

$query = "SELECT Category_id, name FROM Category"; 
$result = mysqli_query($con, $query); 
$result1 = mysqli_fetch_all($result); 
$add=isset($_POST['add']) ? $_POST['add'] : false; 

if (!empty($add)) {
    $queryAdd="INSERT INTO `Category`( `Name`) VALUES ('$Name')"; 
    $update=mysqli_query($con, $queryAdd);
    echo "<script>alert('Категория создана!');
    location.href = 'categoryTovar.php';</script>";
}

?>