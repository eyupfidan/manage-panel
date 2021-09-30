<?php include_once '../global.php';
if($_SESSION['Username'] == "")
{
   header("location:https://manager.itembag.net/login.php");
}
if($_GET['logout'])
{
   session_destroy();
   header("location:https://manager.itembag.net/login.php");
}
   $get_product = $conn->query("SELECT * FROM ib_product WHERE State = 1", PDO::FETCH_ASSOC);
   ?>
<!doctype html>
<html lang="en">
   <head>
      <?php $views->getpage("meta-add");?>
      <title>Sipariş Ekle | itembag.net</title>
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
                  ">
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h3 align="center" class="card-title">Sipariş Ekle</h3>
                        <form id="addsliderform" method="post" action="https://manager.itembag.net/action/order-add.php">
                           <div class="position-relative form-group">
                              <label>İsim</label>
                              <input name="Name" id="Name" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label>Ürünü Seçin</label>
                              <select name="ProductID" id="ProductID"  class="form-control">
                                 <?php foreach($get_product as $row){?>  
                                 <option value="<?php echo $row['ID']; ?>"><?php echo $row['Name']; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                           <div class="position-relative form-group">
                              <label>Kullanıcı Adı</label>
                              <input name="UserName" id="UserName" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label>Email</label>
                              <input name="Email" id="Email" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label>Ödeme Methodu</label>
                              <select name="PaymentMethod" id="PaymentMethod" class="form-control">
                                 <option selected value="Paypal">Paypal</option>
                              </select>
                           </div>
                           <div class="position-relative form-group">
                              <label>Miktar</label>
                              <input name="Quantity" id="Quantity" type="number" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label>Toplam Tutar</label>
                              <input name="Price" id="Price" type="number" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label>Sipariş Durumu</label>
                              <select name="OrderState" id="OrderState" class="form-control">
                                 <option value="0">Onaylanmamış</option>
                                 <option value="1">Hazırlanıyor</option>
                                 <option value="2">Tamamlandı</option>
                              </select>
                           </div>
                           <button class="mt-1 btn btn-primary" type="submit" name="submit" >Gönder</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="../assets/scripts/main.d810cf0ae7f39f28f336.js"></script>
   </body>
</html>