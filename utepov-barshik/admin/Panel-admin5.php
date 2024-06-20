
<?php
require_once "../connect.php";
$result = mysqli_query($con, "SELECT COUNT(*) AS total_orders FROM `Orders`");
$sql = mysqli_fetch_all(mysqli_query($con,"SELECT SUM(Total_price) FROM `Orders`"));
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_orders = $row['total_orders'];
}
$result_total_revenue = mysqli_query($con, "SELECT SUM(Total_price) AS total_revenue FROM `Orders`");
if ($result_total_revenue && mysqli_num_rows($result_total_revenue) > 0) {
    $row_total_revenue = mysqli_fetch_assoc($result_total_revenue);
    $total_revenue = $row_total_revenue['total_revenue'];
}
$zacaz = mysqli_fetch_all(mysqli_query($con,'SELECT * FROM `Orders` '));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel = "stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
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
            <a href="">Статистика и отчеты</a>
            <a href="/logout.php">Выйти</a>
            
        </div>
    </nav>
</header>
<body>
<p style="text-align:center">Таблица статистики и отчетов</p>

    <table style="text-align:center">
        <tr>
            <th>Количество заказов</th>
            <th> выручка за заказ</th>

        </tr>
        <?php foreach ($zacaz as $zac) { ?>
        <tr>
            <td><?=$zac["0"]?></td>
            <td><?=$zac["4"]?></td>
        </tr>
      <?php }?>
    </table>
    <table style="text-align:center">
    <tr>
        <th>Количество заказов</th>
        <th>Общая выручка:</th>
    </tr>
    <tr>
        <td><?php echo htmlspecialchars($total_orders);?></td>
        <td><?php echo htmlspecialchars( number_format($total_revenue, 2));?></td> 
    </tr>
</table>
</body>
</html>