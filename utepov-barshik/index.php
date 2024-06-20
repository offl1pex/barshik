<?php
session_start();
require_once 'connect.php';
if (isset($_SESSION["message"])) {
    $mes = $_SESSION["message"];
    echo "<script>alert('$mes')</script>";
    unset($_SESSION["message"]);
}
$cart = [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Главная</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <!-- //*для слайдера*// -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>

<body>
    <?php require_once "header.php" ?>
    <main>
        <div class="catalog">
            <h2>Каталог</h2>
            <div class="category">
                <button class="button-category">Соки</button>
                <button class="button-category">Кофе</button>
                <button class="button-category">Газированные напитки</button>
                <button class="button-category">Молочные напитки</button>
                <button class="button-category">Вода</button>
                <button class="button-category">Детские напитки</button>
            </div>
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
            <a href="/catalog.php"><button class="podrobnee">Подробнее</button></a>
        </div>
        <!-- часть с текстом -->
        <div class="description">
            <div class="text-discription">
                <h3>Закажите напитки к себе домой</h3>
                <p>Наша компания предлагает широкий ассортимент напитков для тех, кто всегда в движении и ценит качество
                    и удобство.</p>
                <p> У нас вы найдете прохладные газированные напитки, натуральные соки, чай и кофе, а также молочные
                    продукты и спортивные напитки.</p>
            </div>
            <div class="bloc-img-description">
                <img src="images\Group 8192.png" alt="" class="logo">
                <img src="images\Group 8195.png" alt="" class="img-description">
            </div>
        </div>

        <div class="reviews">
            <h2 class="text-reviews">Отзывы</h2>
            <div class="slider">
                <div class="slide">
                    <div class="otzv">
                        <img class="user-img" src="images\free-icon-boy-4537069.png" alt="">
                        <p>Отличный кофе! Очень ароматный и насыщенный вкус. Упаковка красивая и удобная. Я очень
                            доволен покупкой и
                            с удовольствием буду заказывать этот кофе снова. Рекомендую всем любителям кофе!</p>
                    </div>
                    <div class="otzv">
                        <img class="user-img" src="images\free-icon-boy-4537069.png" alt="">
                        <p>Заказываю через это приложение не первый раз.
                            Товарами доволен и доставка быстрая.Рекомендую!</p>
                    </div>
                    <div class="otzv">
                        <img class="user-img" src="images\free-icon-boy-4537069.png" alt="">
                        <p>Отличный кофе! Очень ароматный и насыщенный вкус. Упаковка красивая и удобная. Я очень
                            доволен покупкой и
                            с удовольствием буду заказывать этот кофе снова. Рекомендую всем любителям кофе!</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="otzv">
                        <img class="user-img" src="images\free-icon-boy-4537069.png" alt="">
                        <p>Очень ароматный и насыщенный вкус. Упаковка красивая и удобная. Я очень доволен покупкой и
                            с удовольствием буду заказывать этот кофе снова. Рекомендую всем любителям кофе!</p>
                    </div>
                    <div class="otzv">
                        <img class="user-img" src="images\free-icon-boy-4537069.png" alt="">
                        <p>Заказываю через это приложение не первый раз.
                            Товарами доволен и доставка быстрая.Рекомендую!</p>
                    </div>
                    <div class="otzv">
                        <img class="user-img" src="images\free-icon-boy-4537069.png" alt="">
                        <p>Отличный кофе! Очень ароматный и насыщенный вкус. Упаковка красивая и удобная. Я очень
                            доволен покупкой и
                            с удовольствием буду заказывать этот кофе снова. Рекомендую всем любителям кофе!</p>
                    </div>
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
                        <img src="images\logorutub.png" alt="" class="icon-rutube">
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

<script>
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;

    function nextSlide() {
        slides[currentSlide].style.display = 'none';
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].style.display = 'flex';
    }

    // setInterval(nextSlide, 9000);


    //  $('.btn-add-cart').on('click', function () {
    //      let id_product = $(this).attr('data-id');
    //     let data = {
    //        id_product: id_product
    //      };
    //     $.ajax({
    //         url: 'add_basket.php',
    //         type: 'POST',
    //         contentType: 'application/json',
    //         data: JSON.stringify(data),
    //         success: function (response) {
    //         alert(response);
    //         }
    //    });
    //  });
</script>