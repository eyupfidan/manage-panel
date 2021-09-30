<?php
require '../global.php';
if(isset($_POST["submit"]))
{
    $order_name = $_POST['OrderName'];
    $order_username = $_POST['OrderUserName'];
    $order_email = $_POST['OrderEmail'];
    $order_payment_method = $_POST['OrderPaymentMethod'];
    $order_quantity = $_POST['OrderQuantitiy'];
    $order_price = $_POST['OrderPrice'];
    $order_state = $_POST['OrderState'];
    $order_id = $_POST['orderid'];
    $uploadOk = 1;
    if ($order_name == "" || $order_username == "" || $order_email == "" || $order_payment_method == "" || $order_quantity == ""  || $order_price == "" )
    {
        echo "<script>alert('Boş alanlar var tekrar deneyin.')</script>";
        header('Refresh: 0; URL=https://manager.itembag.net/pages/order.php?editorder=' . $order_id . '');
        $uploadOk = 0;
    }

    if ($uploadOk == 1)
    {
        $sorgu = $conn->prepare("UPDATE ib_orders SET Name = ?, UserName = ?, Email = ?, PaymentMethod = ?, Quantity = ?, Price = ?, State = ? WHERE ID = ? ");
        $sorgu->bindParam(1, $order_name, PDO::PARAM_STR);
        $sorgu->bindParam(2, $order_username, PDO::PARAM_STR);
        $sorgu->bindParam(3, $order_email, PDO::PARAM_STR);
        $sorgu->bindParam(4, $order_payment_method, PDO::PARAM_STR);
        $sorgu->bindParam(5, $order_quantity, PDO::PARAM_STR);
        $sorgu->bindParam(6, $order_price, PDO::PARAM_STR);
        $sorgu->bindParam(7, $order_state, PDO::PARAM_STR);
        $sorgu->bindParam(8, $order_id, PDO::PARAM_INT);
        $sorgu->execute();
        if($sorgu)
        {
            echo "<script>alert('Kullanıcı güncelleme başarılı!')</script>";
            header('Refresh: 0; URL=https://manager.itembag.net/pages/order.php');
        }
    }

}

?>
