<?php
include "../connect.php";

$query = "SELECT * FROM Product";
$result = mysqli_query($con, $query);
$result1 = mysqli_fetch_all($result);
$category = "SELECT * FROM Category";
$categoryResult = mysqli_fetch_all(mysqli_query($con, $category));

// код для фильра, сортировки и поиска не работает
if (!empty($_GET["filter"]) && !empty($_GET["sort"]) && !empty($_GET["search"])) {
    $filterSearch = "";
    $search = $_GET["search"];
    if (!empty($_GET["search"])) {
        $filterSearch = " WHERE Name LIKE '%" . $search . "%'";
    } elseif (!empty($_GET["filter"]) && empty($_GET["search"])) {
        $filterSearch = " WHERE product.category_id=" . $_GET["filter"];
    }
    if (!empty($_GET["filter"]) && !empty($_GET["search"])) {
        $filterSearch = " WHERE product.category_id=" . $_GET["filter"] . " AND product.name LIKE '%" . $search . "%'";
    }
    $query = mysqli_query($con, "SELECT * FROM Product
    INNER JOIN Category ON Category.category_id = Product.category_id
    ".$filterSearch."
    ORDER BY price " . $_GET["sort"]);
} else {
    $query = mysqli_query($con, "SELECT * FROM Product
    INNER JOIN Category ON Category.category_id = Product.category_id
    ORDER BY Product.category_id");
}

$list_products = mysqli_fetch_all($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            <div class="cart_account">
                <a href="newTovar.php">Управление товарами</a>
                <a href="categoryTovar.php">Управление категориями напитков</a>
                <a href="orderManagement.php">Управление заказами</a>
                <a href="Panel-admin5.php">Статистика и отчеты</a>
                <a href="/logout.php">Выйти</a>
            </div>
        </nav>
    </header>
    <!-- фильтр , сортирока и поиск -->
    <div class="filter-products">
        <form method="get">
            <input type="text" placeholder="Поиск" name="search" <?php if (!empty($_GET["search"])) { echo "value=" . $_GET["search"]; } ?>>
            <select name="filter" id="">
                <option value="" <?php if (isset($_GET["filter"]) && empty($_GET["filter"])) { echo " selected"; } ?>>Все категории</option>
                <?php foreach ($categoryResult as $item) : ?>
                    <option value="<?= $item[0] ?>" <?php if (isset($_GET["filter"]) && $item[0] == $_GET["filter"]) { echo " selected"; } ?>><?= $item[1] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="sort" id="">
                <option value="" <?php if (isset($_GET["sort"]) && empty($_GET["sort"])) { echo " selected"; } ?>>Цена</option>
                <option value="ASC" <?php if (isset($_GET["sort"]) && $_GET["sort"] == "ASC") { echo " selected"; } ?>>По возрастанию</option>
                <option value="DESC" <?php if (isset($_GET["sort"]) && $_GET["sort"] == "DESC") { echo " selected"; } ?>>По убыванию</option>
            </select>
            <button name="search">Отправить</button>

            </form>
            <!-- до сюда -->
            <div class="container">
                <div class="products">
                    <table>
                        <tr>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Цена</th>
                <th>Описание</th>
                <th>Миниатюра</th>
                <th>Редактировать</th>
                <th>Удалить</th>

            </tr>
            <form action="product_update.php" method="post">
            <?php foreach ($result1 as $item):?>
                <input type="hidden" name="Idp" value="<?=$item[0]?>">
            <tr>
                <td > <input type="text" name="Name" value="<?=$item[1]?>"></td>
                <!-- Выпадающий список для категории --> 
                <td>
                            <select name="Categ">
                                <?php foreach ($categoryResult as $categoryItem): ?>
                                    <option value="<?=$categoryItem[0]?>" <?= $categoryItem[0] == $item[3] ? 'selected' : '' ?>>
                                        <?=$categoryItem[1]?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                <!-- <td > <input type="text" name="Categ" value="<?=$item[3]?>"></td> -->
                <td > <input type="text" name="Price" value="<?=$item[4]?>"></td>
                <td > <input type="text" name="Descr" value="<?=$item[2]?>"></td>
                <td><img src="../images/<?=$item[5]?>" alt="" class="img-product-admin"></td>
                <td><input type="submit" value="Редактировать"></td>
                </form>
                <td><a href='product-delete.php?item=<?= $item[0]?>'>Удалить</a></td>

            </tr>
            <?php endforeach;?>
            
        </table>
        
    </div>
    <div>
                              
    <h2 class="edit-tovar">Добавление товара</h2>
        <form action="newTovar_db.php" class="adding" method="POST" >
           
            <input type="text" name="Name" id="" placeholder="Название">
            <select name="Categ" id="category">     
            <?php foreach ($categoryResult as $item) { ?>  
                <option value='<?= $item[0] ?>'><?php echo $item[1]; ?></option>  
            <?php } ?>  
        </select> 
            <input type="text" name="Price" id="" placeholder="Цена">
            <input type="text" name="Descr" id="" placeholder="Описание">
            <input type="text" name="Image" id="" placeholder="Изображение">
            <button type="submit" class="btn btn-success" value="Создать">Создать</button>
        </form>
    </div>
</div>
</body>
</html>