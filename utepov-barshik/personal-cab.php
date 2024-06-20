<?php 
session_start();
if(isset( $_SESSION["message"])){
    $mes = $_SESSION["message"];
    echo "<script>alert('$mes')</script>";
    unset( $_SESSION["message"]);
}
include "header.php"; 
include "connect.php"; 
// После успешной аутентификации пользователя
$id = $_SESSION['User_id'];
$queryUserInfo = mysqli_fetch_all(mysqli_query($con,"SELECT * from `Users` where User_id = $id"));
$userInfo = mysqli_fetch_all(mysqli_query($con ,"select * from `Users` where User_id = $id" ));
$orderInfo = mysqli_fetch_all(mysqli_query($con ,"select * from `Orders` where User_id = $id" ));

if (isset($_POST['review_submit'])) {
    $orderId = $_POST['order_id'];
    $reviewText = $_POST['review_text'];

    // Вставляем отзыв в базу данных
    $query = "UPDATE `Orders` SET `comment` = '$reviewText' WHERE `Id_order` = '$orderId'";
    $result = mysqli_query($con, $query);

    // После добавления отзыва обновляем $orderInfo
    $orderInfo = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM Orders WHERE User_id = $id" ));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-header.css">
    <link rel="stylesheet" href="style-personal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Личный кабинет</title>
</head>
<body>
    <main>
        <div class="container">
        <h2 class="text-personal-account">Личный кабинет</h2>
            <div class="blok-main">
                <div>
                <img src="images\free-icon-boy-4537069.png" class="img-user" alt="">
                </div>
                <form action="personal-cab_db.php" method="post" class="form-user-info">
                    <div>
                    <?php foreach ($queryUserInfo as $item):?>
                   
                        <h1>Привет, <?=$item[1]?> </h1> 
                    <input type="hidden" name="id" placeholder="имя" value="<?=$item[0]?>">

                    <!-- <label for="">Имя</label>
                    <input type="text" name="name" placeholder="имя" value="<?=$item[2]?>"> -->
                    </div>
                    <div>
                    <label for="">Почта</label>
                    <input type="text" name="email" placeholder="email" value="<?=$item[1]?>">
                    </div>
                    <!-- <input required type ="text"  name=" bonys" value="<?=$item[3]?>"></p> -->
                    <button name="edit" class="edit">Изменить </button>
                    <?endforeach;  
                    ?>
                </form>
                </div>
                <div class="history-zacaz">
                    <div class="order-history">
                        <h3 class="order">Мои заказы</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Заказ</th>
                                    <th>Дата</th>
                                    <th>Состав заказа</th>
                                    <th>Сумма</th>
                                    <th>Статус</th>
                                    <th>Отзыв</th>
                                    <th>Оставить отзыв</th>

                                </tr>
                            </thead>
                            <?php
                                foreach($orderInfo as $value){
                                $infoProduct=mysqli_fetch_all(mysqli_query($con,"SELECT * FROM Order_Product 
                                INNER JOIN Orders ON Order_Product.Id_order = Orders.Id_order
                                INNER JOIN Product ON Product.Id_product = Order_Product.Id_product 
                                where Orders.Id_order =$value[0] and Orders.User_id = $id"));
                                ?>
                                <tr>
                                <td>№<?=$value[0]?></td>
                                <td><?=$value[2]?></td>
                            <?php
                                foreach($infoProduct as $product) {?>
                            <!-- <p><?=$product[12]?><?=$product[3]?> шт</p> -->
                        

                                <?php } ?>
                                </td> 
                                <!-- <?php var_dump($infoProduct) ?> -->
                                <td><?=$product[13]?> </td>
                                <td><?=$product[8]?> р</td>
                                <td><?=$value[3]?></td>
                                <td><?=$value[7]?></td>
                                <td>
                                <?php if ($value[3] == "Готов"): ?> 
                        <!-- Ведите отзыв -->
                                <form method="post" action="">
                                <a href=""   data-bs-toggle="modal" data-bs-target="#feedback" ><img src="images\writing.png" alt="" class="img-writing"></a></td>
                                <div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <input type="hidden" name="order_id" value="<?= $value[0] ?>">

                                        <h5 class="modal-title" id="exampleModalLabel">Оставьте отзыв</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label" >Сообщение:</label>
                                            <textarea class="form-control" id="message-text" name="review_text"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="review_submit">Оставить отзыв</button>
                                            </div>
                                    </div>
                                    
                                    </div>
                                </div>
                                </div>
                            </form>
                                <?php else: ?> 
                                        Заказ не выполнен
                                    <?php endif; ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
                <img src="images\logorutub.png" alt=""class="icon-whatsapp">
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


<!-- модальное окно для отзыва -->
<!-- 
<form action="comment_db.php" method="post">
<div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Оставьте отзыв</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
            <label for="message-text" class="col-form-label" >Сообщение:</label>
            <textarea class="form-control" id="message-text" name="comment"></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Оставить отзыв</button>
            </div>
      </div>
     
    </div>
  </div>
</div>
</form> -->
