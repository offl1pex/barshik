<?php
include "header.php";
include "connect.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-header.css">
    <link rel="stylesheet" href="style-personal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <title>Корзина</title>
</head>

<body>
<main> 
        <div class="container"> 
            <h2 class="text-personal-account">Корзина</h2> 
            <ul> 
                
                <table> 
                    <tr> 
                        <th>Товар</th> 
                        <th>Цена</th> 
                        <th>Количество</th> 
                    </tr> 
                    <?php 
                    $res = mysqli_fetch_all(mysqli_query($con, 'select * from basket INNER JOIN Product where User_id = ' . $_SESSION['User_id'])); 
                    $count = mysqli_fetch_assoc(mysqli_query($con, 'select content from basket INNER JOIN Product where User_id = ' . $_SESSION['User_id'])); 
                    $data = json_decode($count['content'], true); ?>
                          <form action="add_order.php" method="post">
                    <?php foreach ($res as $value) { 
                        $productId = $value["3"]; 
                        $quantity = $data[$productId]; 
                    ?> 
                    <tr> 
                  
                        <td> 
                            <input name="tovar" value = "<?= $value["4"] ?>"> 
                        </td> 
                        <td> 
                            <input name="prise" value =<?= $value["7"] ?> >
                        </td> 
                        <td> 
                            <input name="count" value = <?= $quantity ?>>
                        </td> 
                    </tr> 
                    <?php } ?> 
                </table> 
                <a href="delete_tovar_bascet.php?id_tovar <?=$value["3"]?>">Очистить корзину</a>

            </ul> 
            <button type="submit">ОФОРМИТЬ ЗАКАЗ</button>
            </form>
        </div> 
    </main> 
    <!-- подвал -->
    <footer id="footer">
        <div class="container">
            <div class="connection">
                <div class="connect">
                    <p>Связь с нами</p>
                    <div class="images-connection">
                        <img src="images\logorutub.png" alt="" class="icon-whatsapp">
                        <img src="images\icons8-vk-com-48.png" alt="" srcset="">
                        <img src="images\iconfinder-social-media-applications-23whatsapp-4102606_113811.png"
                            class="icon-whatsapp">
                    </div>
                </div>
                <div class="clock-work">
                    <p>Часы работы:</p>
                    <p>10:00 - 23:00</p>
                </div>
            </div>
            <hr>
            <p class="copirater">© 2023 Копирование запрещено. Все права защищены.</p>
        </div>
    </footer>
</body>

</html>