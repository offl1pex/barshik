<?php
    include"header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-header.css">
    <link rel="stylesheet" href="style-makingOrder.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Оформление заказа</title>
</head>
<body>
<main>
    <div class="order-verification">
        <h2>Оформление заказа</h2>
        <P>Проверьте данные перед оформлением</P>
        <form action="" method="post" class="">
            <div>
            <label for="">Имя</label>
                <input type="text" placeholder="имя">
            </div>
            <div>
                <label for="">Адрес</label>
                <input type="text" placeholder="Адрес доставки">
            </div>
            <div>
                <label for="">Состав заказа</label>
                <input type="text" placeholder="заказ">
            </div>
            <div>
                <label for="">Цена</label>
                <input type="text" placeholder="Цена">
            </div>
            
            <button name="edit" class="edit">Оформить заказ </button>
        </form>
        <div class="toggle-switch">
                    <p>Оплата баллами</p>
            <div class="toggle-button">
                <input type="checkbox" id="toggle" class="toggle-input">
                <label for="toggle" class="toggle-label"></label>
            </div>
        </div>
    </div>
</main>
  <!-- подвал -->
  <footer id="footer">
    <div class="container">
        <div class="connection">
            <div class="connect">
            <p>Связь с нами</p> 
            <div class="images-connection">
                <img src="images/free-icon-odnoklassniki-2504930.png" alt=""class="icon-whatsapp">
                <img src="images\icons8-vk-com-48.png" alt="" srcset="">
                <img src="images\iconfinder-social-media-applications-23whatsapp-4102606_113811.png" class="icon-whatsapp">
            </div>
            </div>
            <div class="clock-work">
                    <p>Часы  работы:</p>
                    <p>10:00 - 23:00</p>
                </div>
            </div>
        <hr> 
        <p class="copirater">© 2023 Копирование запрещено. Все права защищены.</p> 
    </div>
</footer>
</body>
</html>