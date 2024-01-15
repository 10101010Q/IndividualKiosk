<?php
 
include('conf.php');
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
 
// |-----------------------------------------------------------------------
// |   FUNCTION : Data from staff
// |-----------------------------------------------------------------------
 
if($_GET['getFoodSold'])
{
    $sql = "SELECT orders_item.food_id, 
    food.food_name AS fName, 
    food.food_price AS fPrice, 
    SUM(orders_item.item_quantity) AS fQuantity, 
    ((food.food_price)*(SUM(orders_item.item_quantity))) AS fTotal
    FROM orders_item JOIN food ON orders_item.food_id= food.food_id GROUP BY food_id";

    $result = $db->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);
 
    echo json_encode($result);
    die;
}
 
// |-----------------------------------------------------------------------
// |   FUNCTION : Data from Profict
// |-----------------------------------------------------------------------
 
if($_GET['getSales'])
{
    $sql = "SELECT SUM(orders.orders_subtotal) AS total, SUM(orders_item.item_quantity) AS tQuantity, DATE_FORMAT(orders.order_date, '%M') AS mth FROM orders JOIN orders_item ON orders.orders_id= orders_item.orders_id GROUP BY MONTH(order_date)";
    $result = $db->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);
 
 
    foreach($result as $row)
    {
        $sales[] = $row['total'];
        $orders[] = $row['tQuantity'];
        $bulan[] = $row['mth'];
    }
 
    echo json_encode([
        "sales" => $sales,
        "orders" => $orders,
        "bulan" => $bulan,
    ]);

    
    die;
}
 
// |-----------------------------------------------------------------------
// |   FUNCTION : Data from Profict
// |-----------------------------------------------------------------------
 
if($_GET['getshipping'])
{
    echo json_encode([
        "incomp" => 20,
        "total" => 40,
    ]);
    die;
}
 
 
 
?>