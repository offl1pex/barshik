<?php
include "../connect.php";
$Name = isset($_POST['Name'])?$_POST['Name']:false;

if($Name){
    $result_add = mysqli_query($con, "INSERT INTO Category (`Name`) VALUES ('$Name')");
    echo"<script>alert('Категория создана');
    location.href ='Categories.php';
    </script>";
}
?>