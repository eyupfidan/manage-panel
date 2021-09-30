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
?>
<!doctype html>
<html lang="en">
   <head>
      <?php $views->getpage("meta-add");?>
      <title>Slider Ekle | itembag.net</title>

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
                        <h3 align="center" class="card-title">Slider Ekle</h3>
                        <form id="addsliderform" method="post" action="https://manager.itembag.net/action/slider-add.php" enctype="multipart/form-data">
                           <div class="position-relative form-group">
                              <label >Büyük Yazı</label>
                              <input name="BigText" id="BigText" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label >Orta Yazı</label>
                              <input name="MiddleText" id="MiddleText" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label>Küçük Yazı</label>
                              <input name="SmallText" id="SmallText" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label >Not</label>
                              <input name="Note" id="Note" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label>Renk</label>
                              <input name="Renk" id="Renk" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <label>Buton Linki</label>
                              <input name="ButtonLink" id="ButtonLink" type="text" class="form-control"> 
                           </div>
                           <div class="position-relative form-group">
                              <div>
                                 <div class="custom-checkbox custom-control"><input type="checkbox" name="state_slide" value="1" id="exampleCustomCheckbox2" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox2">Aktif Olsun
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div style="margin-top:30px;" class="position-relative form-group">
                              <label class="">Slider Resmi Yükle</label>
                              <input name="image" id="Image_Slider" type="file" class="form-control-file"> <small>Lütfen webp uzantılı yükleyin</small> 
                           </div>
                           <button class="mt-1 btn btn-primary" type="submit" name="submit">Gönder</button>
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