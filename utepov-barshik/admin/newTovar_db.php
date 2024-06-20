<?php
include "../connect.php";
$Name = isset($_POST['Name'])?$_POST['Name']:false;
$Categ = isset($_POST['Categ'])?$_POST['Categ']:false;
$Price = isset($_POST['Price'])?$_POST['Price']:false;
$Descr = isset($_POST['Descr'])?$_POST['Descr']:false;
$Image = isset($_POST['Image'])?$_POST['Image']:false;
// не работает наверное удалить
$idP = isset($_POST['idP'])?$_POST['idP']:false;
if ($Name and $Categ and $Price and $Descr) {
    $query = "INSERT INTO `Product` (`Name`, `Category_id`, `Description`, `Price`, `Image`) VALUES ('$Name', '$Categ', '$Descr', '$Price', '$Image')";
    $result = mysqli_query($con, $query);
    echo "<script>alert('Запись создана!');
    location.href = 'newTovar.php';</script>";
}else{
    echo "<script>alert('Все поля должны быть заполненны!');
    location.href = 'newTovar.php';</script>";
}

?>