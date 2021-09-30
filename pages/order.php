<?php
ob_start();
include_once '../global.php';
if($_SESSION['Username'] == "")
{
   header("location:https://manager.itembag.net/login.php");
}
if($_GET['logout'])
{
   session_destroy();
   header("location:https://manager.itembag.net/login.php");
}
   $get_order = $conn->query("SELECT * FROM ib_orders", PDO::FETCH_ASSOC);
   ?>
<!doctype html>
<html lang="en">
   <head>
      <?php $views->getpage("meta-add");?>
      <title>Sipariş İşlemleri | itembag.net</title>

   </head>
   <body>
      <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
         <?php $views->getpage("header"); ?>
         <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
               <div class="app-header__logo">
                  <div class="logo-src"></div>
                  <div class="header__pane ml-auto">
                     <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar"> <span class="hamburger-box">
                        <span class="hamburger-inner"></span> </span>
                        </button>
                     </div>
                  </div>
               </div>
               <div class="app-header__mobile-menu">
                  <div>
                     <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"> <span class="hamburger-box">
                     <span class="hamburger-inner"></span> </span>
                     </button>
                  </div>
               </div>
               <div class="app-header__menu"> <span>
                  <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                  <span class="btn-icon-wrapper">
                  <i class="fa fa-ellipsis-v fa-w-6"></i>
                  </span> </button>
                  </span>
               </div>
               <?php $views->getpage("sidebar");?>
            </div>
            <div class="app-main__outer">
               <div class="col-md-8" style="
                  margin: auto;
                  margin-top: 20px;
                  background-color:white;
                  "> 
                  <?php if(empty($_GET))
                  echo'<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Sipariş No</th>
                                        <th>İsim</th>
                                        <th>Kullanıcı Adı</th>
                                        <th>Durum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>' ?>
                                 <?php
                                 if(empty($_GET)) {
                                 foreach ($get_order as $orders)
                                 {
                                     $order_id = $orders['ID'];
                                     $order_name = $orders['Name'];
                                     $order_username = $orders['UserName'];
                                     $state = $orders['State'];
                                     $state_ic = "";
                                     if($state == 0 )
                                     {
                                        $state_ic = '<button class="mb-2 mr-2 btn-icon btn-pill btn btn-secondary">Onaylanmamış</button>';
                                     }
                                     else if($state == 1)
                                     {
                                         $state_ic = '<button class="mb-2 mr-2 btn-icon btn-pill btn btn-warning">Hazırlanıyor</button>';
                                     }
                                     else if($state == 2)
                                     {
                                         $state_ic = '<button class="mb-2 mr-2 btn-icon btn-pill btn btn-success">Tamamlandı</button>';
                                     }
                                    echo'<tr>
                                        <td>'.$order_id.'</td>
                                        <td>'.$order_name.'</td>
                                        <td>'.$order_username.'</td>
                                        <td>'.$state_ic.'</td>
                                        <td><a href="?editorder='.$order_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-success"><i class="pe-7s-tools btn-icon-wrapper"> </i>Siparişi Düzenle</a> <a href="?deleteorder='.$order_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i>Siparişi Sil</a></td>
                                    </tr>';
                                }
                            }
                                ?>
                                <?php if(empty($_GET))
                                    echo'</tbody>
                                </table>'; ?>
                                
                                <?php if($_GET['editorder'])
                                {
                                    $user_id = $_GET['editorder'];
                                    $get_orders = $conn->query("SELECT * FROM ib_orders WHERE ID = $user_id", PDO::FETCH_ASSOC);
                                    foreach($get_orders as $order)
                                    {
                                        $order_id = $order['ID'];
                                        $order_name = $order['Name'];
                                        $order_username = $order['UserName'];
                                        $order_email = $order['Email'];
                                        $order_payment_method = $order['PaymentMethod'];
                                        $order_quantity = $order['Quantity'];
                                        $order_price = $order['Price'];
                                        $order_currency_type = $order['CurrencyType'];
                                        $order_date = $order['Date'];
                                        $order_ip = $order['ActiveIP'];
                                        $order_discount_code = $order['DiscountCode'];
                                        $order_state = $order['State'];
                                        $state_ic = "";
                                        if($order_state == 0 )
                                        {
                                           $state_ic = 'Onaylanmamış';
                                        }
                                        else if($order_state == 1)
                                        {
                                            $state_ic = 'Hazırlanıyor';
                                        }
                                        else if($order_state == 2)
                                        {
                                            $state_ic = 'Tamamlandı';
                                        }
                                    echo '<div class="card-body">
                                    <h3 align="center" class="card-title">Kullanıcıyı Düzenle</h3>
                                    <form id="additemform" method="post" action="https://manager.itembag.net/action/order-edit.php">
                                       <div class="position-relative form-group">
                                          <label class="">Sipariş Numarası</label>
                                          <input name="OrderID" id="OrderID" type="text" value="'.$order_id.'" class="form-control" disabled> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">İsim</label>
                                          <input name="OrderName" id="OrderName" type="text" value="'.$order_name.'" class="form-control"> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Kullanıcı Adı</label>
                                          <input name="OrderUserName" id="OrderUserName" type="text" value="'.$order_username.'" class="form-control" > 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Email</label>
                                          <input name="OrderEmail" id="OrderEmail" type="text" value="'.$order_email.'"  class="form-control" > 
                                       </div>
                                       <div class="position-relative form-group">
                                       <label class="">Ödeme Yöntemi</label>
                                       <input name="OrderPaymentMethod" id="OrderPaymentMethod" type="text" value="'.$order_payment_method.'"  class="form-control" > 
                                    </div>
                                    <div class="position-relative form-group">
                                    <label class="">Sipariş Adeti</label>
                                    <input name="OrderQuantitiy" id="OrderQuantitiy" type="text" value="'.$order_quantity.'"  class="form-control" > 
                                    </div>
                                 <div class="position-relative form-group">
                                 <label class="">Toplam Tutar</label>
                                 <input name="OrderPrice" id="OrderPrice" type="text" value="'.$order_price.'"  class="form-control" > 
                                </div>
                                <div class="position-relative form-group">
                                <label class="">Döviz Tipi</label>
                                <input name="OrderCurrencyType" id="OrderCurrencyType" type="text" value="'.$order_currency_type.'"  class="form-control" disabled> 
                               </div>
                               <div class="position-relative form-group">
                               <label class="">Sipariş Tarihi</label>
                               <input name="OrderDate" id="OrderDate" type="text" value="'.$order_date.'"  class="form-control" disabled> 
                              </div>
                              <div class="position-relative form-group">
                              <label class="">IP Adresi</label>
                              <input name="OrderIP" id="OrderIP" type="text" value="'.$order_ip.'"  class="form-control" disabled > 
                             </div>
                             <div class="position-relative form-group">
<label>Kategori Seçin</label>
<select name="OrderState" id="OrderState" class="form-control">
<option selected value="'.$order_state.'">'.$state_ic.'</option>
<option value="0">Onaylanmamış</option>
<option value="1">Hazırlanıyor</option>
<option value="2">Tamamlandı</option>
</select>
</div>
                             <div class="position-relative form-group">
                             <label class="">İndirim Kodu</label>
                             <input name="OrderDiscountCode" id="OrderDiscountCode" type="text" value="'.$order_discount_code.'"  class="form-control" disabled > 
                            </div>
                                       <div class="position-relative form-group">
                                          <input name="orderid" type="hidden" value="'.$user_id.'">                                       </div>
                                       <button class="mb-2 mr-2 btn btn-primary" type="submit" id="submit" name="submit" >Gönder</button>		
                                    </form>
                                 </div>';
                                }
                            }
                                ?>

<?php if($_GET['deleteorder'])
{
 
    $deleteid = $_GET['deleteorder'];
    $delete_product = $conn->query("DELETE FROM ib_orders WHERE ID = $deleteid");
    $delete_product->execute();
    header('Refresh: 0; URL=https://manager.itembag.net/pages/order.php');
}
?>               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="../assets/scripts/main.d810cf0ae7f39f28f336.js"></script>
      <script type="text/javascript" src="../assets/scripts/custom.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   </body>
</html>