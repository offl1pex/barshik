<?php
session_start();

?>
<header  content="width=device-width, initial-scale=1">
        <div class="container">
            <div class="naw-header">
                <img src="images\Group 8192.png" alt="" class="logo">
                <h1>БарШик</h1>
                <div class="naw-menu">
                    <a href="/">Главная</a>
                    <a href="/catalog.php">Каталог</a>
                    
                    <a href="#footer">Контакты</a>
                    <?php if(isset($_SESSION["User_id"])){?>
                        <a href="/personal-cab.php">Личный кабинет</a>
                        <a href="/cart.php">Корзина</a>
                        <a href="/logout.php">Выйти</a>
                   <?php }else{ ?>
                    <a href="auto.php">Войти</a>
                    <?php } ?>
                 
                </div>
            </div>
        </div>
    </header>