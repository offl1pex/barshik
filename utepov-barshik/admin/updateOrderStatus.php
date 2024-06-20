<?php 
include "../connect.php";

$orderId = $_POST['orderId']; 
$newStatus = $_POST['newStatus']; 
if ($orderId and $newStatus) { 
    
 
    $query =mysqli_query($con, "UPDATE Orders SET Status = '$newStatus' WHERE Id_order = $orderId"); 
        // var_dump($query);
        echo "<script>alert('Статус обновлен'); 
        location.href = 'orderManagement.php'; 
        </script>"; 
    } else { 
        echo "Ошибка при обновлении статуса заказа: " . mysqli_error($con); 
    } 

?> 