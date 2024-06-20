<?php
session_start();
require_once "header.php";
require_once "connect.php";
if (isset($_SESSION["message"])) {
    $mes = $_SESSION["message"];
    echo "<script>alert('$mes')</script>";
    unset($_SESSION["message"]);
}
$cart = [];
?>
   <link rel="stylesheet" href="style.css">
    <title>Каталог</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<h1 style="text-align:center">Каталог</h1>
<div class="bloc-drinks">

<div class="drink">
    <?php
    $res = mysqli_query($con, "SELECT * FROM product JOIN category ON product.Category_id = category.Category_id");
    while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <div class="tovar">
            <img src="images/<?= $row["Image"] ?>" alt="">
            <h4><?= $row["Name"] ?></h4>
            <p><?= $row["Price"] ?></p>
            <?php if (isset($_SESSION["User_id"])) { ?>
                <?php if (array_key_exists($row["Id_product"], $cart))
                    echo $cart[$row["Id_product"]]; ?>
                <a href="add_basket.php?id_product=<?= $row['Id_product'] ?>">
                    <button class="button-tovar btn-add-cart" value="<?= $row['Id_product'] ?>">Добавить в
                        корзину</button>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>

</div>