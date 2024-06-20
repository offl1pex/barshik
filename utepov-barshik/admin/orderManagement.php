<?php 
include "../connect.php";
$query="SELECT * FROM Order_Product INNER JOIN Product ON Product.Id_product = Order_Product.Id_product INNER JOIN Orders ON Order_Product.Id_order = Orders.Id_order";
$queryOrder= mysqli_fetch_all(mysqli_query($con ,$query ));
$infoProduct=mysqli_fetch_all(mysqli_query($con,"SELECT *, Product.Price FROM Order_Product 
INNER JOIN Orders ON Order_Product.Id_order = Orders.Id_order
INNER JOIN Product ON Product.Id_product = Order_Product.Id_product
"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заказами</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel = "stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<header>
    <nav class="nav">
        <div class="index">
            <h1 class="index_">Админ</h1>
            <form id="search" action="/">
                <input type="search" name="search" id="searchText" placeholder="Поиск">
            </form>
        </div>
        <div class = "cart_account">
            <a href="newTovar.php">Управление товарами</a>
            <a href="categoryTovar.php">Управление категориями напитков</a>
            <a href="orderManagement.php">Управление заказами</a>
            <a href="Panel-admin5.php">Статистика и отчеты</a>
            <a href="/logout.php">Выйти</a>
            
        </div>
    </nav>
</header>
<div class="container">
    <h1>Управление заказами</h1>
    <!-- <input type="text" id="searchInput" placeholder="Поиск по заказам"> -->
    <table id="orderTable">
    <tr>
        <th>Номер заказа</th>
        <th>Статус</th>
        <th>Дата</th>
        <th>Цена</th>
        <th>Действия</th>
    </tr>
    <tr> 
    <table>
        <?php
        foreach($queryOrder as $value){?>
    <tr>  
        <td>заказ:<?="$value[1]"?></td>  
        <td>
            <form action="updateOrderStatus.php" method="post">
            <input type="hidden" name="orderId" value="<?= $value[0] ?>">

                <label for="cars">Статус:</label>
                <select id="cars" name="newStatus" onchange="showSelectedCar()">
  <option value="Готовим" <?php if ($value[13] === "Готовим") echo "selected"; ?> name = "newStatus">Готовим</option>
  <option value="Доставка" <?php if ($value[13] === "Доставка") echo "selected"; ?> name = "newStatus">Доставка</option>
  <option value="Выполнено" <?php if ($value[13] === "Выполнено") echo "selected"; ?> name = "newStatus">Выполнено</option>
</select>

                <button type="submit">Обновить статус</button>
            </form>
        </td>
        <td><input type="text" value=<?="$value[12]"?>></td>
        <td><input type="text" value=<?="$value[14]"?>></td> 
        <td>  
        <a href=""   data-bs-toggle="modal" data-bs-target="#feedback" > <button class="view-details">Подробности</button>  </a>
        <a href='deleteOrder.php?item=<?php echo htmlspecialchars($value[0]);?>&itenOr=<?php echo htmlspecialchars($value[2]);?>'>
    <button class="delete-order">Удалить заказ</button>
</a>
        </td>  
    </tr>
    <?php } ?>
    </table>
</div>
<!-- <script src="script.js"></script> -->
</body>
</html>
<!-- модальное окно для отзыва -->

<div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Состав заказа</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="container">
      <table id="orderTable">
    <tr>
        <th>Номер заказа</th>
        <th>Состав</th>
        <th>Цена товара</th>
        <th>Количество</th>
    </tr>
    <tr> 
    <table>
    <?php
        foreach($infoProduct as $value){?>
    <tr>  
        
        <td><?="$value[2]"?></td> 
        <td>
          <li><?="$value[13]"?></li>
        </td>  
        <td><?="$value[17]"?></td>  
        <td><?="$value[3]"?></td>  

    </tr>
    <?php }?>
    </table>
    </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>