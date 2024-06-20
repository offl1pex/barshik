<?php
session_start();
require_once 'connect.php';

$id_tovar = $_GET["id_product"];
// var_dump($id_tovar);

$id_user = $_SESSION["User_id"];
$cart = mysqli_fetch_assoc(mysqli_query($con, "SELECT content FROM `Basket` WHERE User_id = $id_user"));
// var_dump($cart);

if (is_null($cart)) {
    $compount[$id_tovar] = 1;

    $compount = json_encode($compount);
    $sql = "INSERT INTO `Basket`( `User_id`, `Content`) VALUES ('$id_user','$compount')";
    // $_SESSION["message"] = "Товар добавлен в корзину";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION["cart"] =
            mysqli_fetch_assoc(mysqli_query($con, "SELECT content FROM `Basket` WHERE User_id = $id_user"))["content"];
        header("location: /");
    }
}

$cart = $cart["content"];
$cart = (array) json_decode($cart);

if (array_key_exists($id_tovar, $cart)) {
    $cart[$id_tovar]++;
   
}else{
    $cart[$id_tovar] = 1;
}
var_dump($cart);
$compount = json_encode($cart);
$sql = "UPDATE `Basket` SET `Content`='$compount ' WHERE User_id = $id_user";
$result = mysqli_query($con, $sql);
if ($result) {
    $_SESSION["cart"] = $compount;
    $_SESSION["message"] = "Товар добавлен в корзину";

    header("location: /");
}