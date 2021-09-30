<?php
require '../global.php';
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))  
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

if(isset($_POST["submit"]))
{
    $name = $_POST['Name'];
    $productid = $_POST['ProductID'];
    $username = $_POST['UserName'];
    $email = $_POST['Email'];
    $payment_method = $_POST['PaymentMethod'];
    $quantity = $_POST['Quantity'];
    $price = $_POST['Price'];
    $order_state = $_POST['OrderState'];
    $currency_type = "$";
    $user_id = "-1";
    $discount_code = "#";
    $uploadOk = 1;
    $date = date('d.m.y H:i:s');
    $activeip = getRealIpAddr();
    $order_id = time();

    if($name == "" || $email == "" || $email == "" || $payment_method == "" || $quantity == "" || $price == "")
    {
        echo "<script>alert('Boş alanlar var tekrar deneyin.')</script>";
        header('Refresh: 0; URL=https://manager.itembag.net/pages/add-order.php');
        $uploadOk = 0;
    }

    if ($uploadOk == 1)
    {

        $sorgu = $conn->prepare("INSERT INTO ib_orders(Name,ProductID,UserID,UserName,Email,PaymentMethod,Quantity,Price,CurrencyType,State,Date,ActiveIP,DiscountCode,ID) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sorgu->bindParam(1, $name, PDO::PARAM_STR);
        $sorgu->bindParam(2, $productid, PDO::PARAM_STR);
        $sorgu->bindParam(3, $user_id, PDO::PARAM_STR);
        $sorgu->bindParam(4, $username, PDO::PARAM_STR);
        $sorgu->bindParam(5, $email, PDO::PARAM_STR);
        $sorgu->bindParam(6, $payment_method, PDO::PARAM_STR);
        $sorgu->bindParam(7, $quantity, PDO::PARAM_STR);
        $sorgu->bindParam(8, $price, PDO::PARAM_STR);
        $sorgu->bindParam(9, $currency_type, PDO::PARAM_STR);
        $sorgu->bindParam(10, $order_state, PDO::PARAM_STR);
        $sorgu->bindParam(11, $date, PDO::PARAM_STR);
        $sorgu->bindParam(12, $activeip, PDO::PARAM_STR);
        $sorgu->bindParam(13, $discount_code, PDO::PARAM_STR);
        $sorgu->bindParam(14, $order_id, PDO::PARAM_STR);

        $sorgu->execute();
        if($sorgu)
        {
            echo "<script>alert('Sipariş ekleme başarılı!')</script>";
            header('Refresh: 0; URL=https://manager.itembag.net/pages/add-order.php');
        }
    }

}

?>
