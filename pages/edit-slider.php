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
   $get_slider = $conn->query("SELECT * FROM ib_slider", PDO::FETCH_ASSOC);
   ?>
<!doctype html>
<html lang="en">
   <head>
      <?php $views->getpage("meta-add");?>
      <title>Slider Düzenle | itembag.net</title>

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
                                        <th>BigText</th>
                                        <th>MiddleText</th>
                                        <th>SmallText</th>
                                        <th>Durum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>' ?>
                                 <?php
                                 if(empty($_GET)) {
                                 foreach ($get_slider as $slider)
                                 {
                                     $slide_id = $slider['ID'];
                                     $bigtext = $slider['BigText'];
                                     $middletext = $slider['MiddleText'];
                                     $smalltext = $slider['SmallText'];
                                     $state = $slider['State'];
                                     $state_ic = "";
                                     if($state == 0 )
                                     {
                                        $state_ic = '<button class="mb-2 mr-2 btn-icon btn-pill btn btn-secondary">Pasif</button>';
                                     }
                                     else if($state == 1)
                                     {
                                         $state_ic = '<button class="mb-2 mr-2 btn-icon btn-pill btn btn-success">Aktif</button>';
                                     }
                                    echo'<tr>
                                        <td>'.$bigtext.'</td>
                                        <td>'.$middletext.'</td>
                                        <td>'.$smalltext.'</td>
                                        <td>'.$state_ic.'</td>
                                        <td><a href="?editslider='.$slide_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-success"><i class="pe-7s-tools btn-icon-wrapper"> </i>Ürünü Düzenle</a> <a href="?deleteitem='.$slide_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i>Ürünü Kaldır</a></td>
                                    </tr>';
                                }
                            }
                                ?>
                                <?php if(empty($_GET))
                                    echo'</tbody>
                                </table>'; ?>
                                
                                <?php if($_GET['editslider'])
                                {
                                    $slide_id = $_GET['editslider'];
                                    $get_slider = $conn->query("SELECT * FROM ib_slider WHERE ID = $slide_id ", PDO::FETCH_ASSOC);
                                    foreach($get_slider as $slider)
                                    {
                                        $slide_id = $slider['ID'];
                                        $bigtext = $slider['BigText'];
                                        $middletext = $slider['MiddleText'];
                                        $smalltext = $slider['SmallText'];
                                        $note = $slider['Note'];
                                        $color = $slider['Color'];
                                        $buttonlink = $slider['ButtonLink'];
                                        $state = $slider['State'];                    
                                        echo '<div class="card-body">
                                        <h3 align="center" class="card-title">Slider Güncelle</h3>
                                        <form id="addsliderform" method="post" action="https://manager.itembag.net/action/slider-edit.php" enctype="multipart/form-data">
                                           <div class="position-relative form-group">
                                              <label >Büyük Yazı</label>
                                              <input name="BigText" id="BigText" type="text" value="'.$bigtext.'" class="form-control"> 
                                           </div>
                                           <div class="position-relative form-group">
                                              <label >Orta Yazı</label>
                                              <input name="MiddleText" id="MiddleText" type="text" value="'.$middletext.'" class="form-control"> 
                                           </div>
                                           <div class="position-relative form-group">
                                              <label>Küçük Yazı</label>
                                              <input name="SmallText" id="SmallText" type="text" value="'.$smalltext.'" class="form-control"> 
                                           </div>
                                           <div class="position-relative form-group">
                                              <label >Not</label>
                                              <input name="Note" id="Note" type="text" value="'.$note.'"class="form-control"> 
                                           </div>
                                           <div class="position-relative form-group">
                                              <label>Renk</label>
                                              <input name="Renk" id="Renk" type="text" value="'.$color.'" class="form-control"> 
                                           </div>
                                           <div class="position-relative form-group">
                                              <label>Buton Linki</label>
                                              <input name="ButtonLink" id="ButtonLink" type="text" value="'.$buttonlink.'"class="form-control"> 
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
                                              <input name="slideid" type="hidden" value="'.$slide_id.'"></input>
                                           </div>
                                           <button class="mt-1 btn btn-primary" type="submit" name="submit">Gönder</button>
                                        </form>
                                     </div>
                                  </div>';
                                }
                            }
                                ?>

<?php if($_GET['deleteitem'])
{
 
    $deleteid = $_GET['deleteitem'];
    $delete_product = $conn->query("DELETE FROM ib_slider WHERE ID = $deleteid");
    $delete_product->execute();
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-slider.php');
}
?>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="../assets/scripts/main.d810cf0ae7f39f28f336.js"></script>
      <script type="text/javascript" src="../assets/scripts/custom.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   </body>
</html>