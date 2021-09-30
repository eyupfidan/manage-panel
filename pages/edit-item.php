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
   $get_category = $conn->query("SELECT * FROM ib_product", PDO::FETCH_ASSOC);
   ?>
<!doctype html>
<html lang="en">
   <head>
      <?php $views->getpage("meta-add");?>
      <title>Ürün Düzenle | itembag.net</title>

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
                                        <th>Ürün Adı</th>
                                        <th>Fiyat</th>
                                        <th>Stok</th>
                                        <th>Durum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>' ?>
                                 <?php
                                 if(empty($_GET)) {
                                 foreach ($get_category as $category)
                                 {
                                     $cat_id = $category['ID'];
                                     $name = $category['Name'];
                                     $max_price = $category['MaxPrice'];
                                     $stock = $category['Stock'];
                                     $state = $category['State'];
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
                                        <td>'.$name.'</td>
                                        <td>'.$max_price.'</td>
                                        <td>'.$stock.'</td>
                                        <td>'.$state_ic.'</td>
                                        <td><a href="?edititem='.$cat_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-success"><i class="pe-7s-tools btn-icon-wrapper"> </i>Ürünü Düzenle</a> <a href="?deleteitem='.$cat_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i>Ürünü Kaldır</a></td>
                                    </tr>';
                                }
                            }
                                ?>
                                <?php if(empty($_GET))
                                    echo'</tbody>
                                </table>'; ?>
                                
                                <?php if($_GET['edititem'])
                                {
                                    $item_id = $_GET['edititem'];
                                    $get_cat = $conn->query("SELECT * FROM ib_product WHERE ID = $item_id ", PDO::FETCH_ASSOC);
                                    foreach($get_cat as $cat)
                                    {
                                     $name = $cat['Name'];
                                     $detail = $cat['Detail'];
                                     $max_price = $cat['MaxPrice'];
                                     $min_price = $cat['MinPrice'];
                                     $stock = $cat['Stock'];
                                     $feature = $cat['IsFeatured'];
                                     $state = $cat['State'];
                                    echo '<div class="card-body">
                                    <h3 align="center" class="card-title">Ürün Ekle</h3>
                                    <form id="additemform" method="post" action="https://manager.itembag.net/action/item-edit.php" enctype="multipart/form-data">
                                       <div class="position-relative form-group">
                                          <label class="">Ürün İsmi</label>
                                          <input name="Name" id="Name" type="text" value="'.$name.'" class="form-control"> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Ürün Açıklaması</label>
                                          <textarea rows="8" name="Detail" id="Detail" class="form-control">'.$detail.'</textarea>
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Max Fiyat</label>
                                          <input name="MaxPrice" id="MaxPrice" type="number" value="'.$max_price.'" class="form-control"> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Min Fiyat</label>
                                          <input name="MinPrice" id="MinPrice" type="number" value="'.$min_price.'"  class="form-control"> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Stok</label>
                                          <input name="Stock" id="Stock" type="number" value="'.$stock.'"  class="form-control"> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label>Kategori Seçin</label>
                                          <select name="CategoryID" id="CategoryID" onchange="if (!window.__cfRLUnblockHandlers) return false; get_subcategory()" class="form-control">
                                               
                                             <option value="1">Metin 2</option>
                                               
                                             <option value="2">Twitch</option>
                                               
                                             <option value="3">Roblox</option>
                                                                           </select>
                                       </div>
                                       <div class="position-relative form-group">
                                          <label>Alt Kategori Seçin</label>
                                          <select name="SubCategoryID" id="SubCategoryID" class="form-control">
                                          </select>
                                       </div>
                                       <div class="position-relative form-group">
                                          <label>Para Birimi</label>
                                          <select name="CurrencyType" id="CurrencyType" class="form-control">
                                             <option selected="" value="EU">EU</option>
                                             <option value="USD"> USD</option>
                                          </select>
                                       </div>
                                       <div class="position-relative form-group">
                                          <div>
                                             <div class="custom-checkbox custom-control"><input type="checkbox" name="featured_item" value="'.$feature.'" id="exampleCustomCheckbox" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox">Anasayfada Gözüksün
                                                </label>
                                             </div>
                                             <div class="custom-checkbox custom-control"><input type="checkbox" name="state_item" value="'.$state.'" id="exampleCustomCheckbox2" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox2">Aktif Olsun
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                       <div style="margin-top:30px;" class="position-relative form-group">
                                          <label class="">Ürün Resmi Yükle</label>
                                          <input name="image" id="image" type="file" class="form-control-file"> <small>Lütfen webp uzantılı yükleyin</small> 
                                          <input name="itemid" type="hidden" value="'.$item_id.'"></input>
                                       </div>
                                       <button class="mb-2 mr-2 btn btn-primary" type="submit" id="item-adding" name="submit">Gönder</button>		
                                    </form>
                                 </div>';
                                }
                            }
                                ?>

<?php if($_GET['deleteitem'])
{
 
    $deleteid = $_GET['deleteitem'];
    $delete_product = $conn->query("DELETE FROM ib_product WHERE ID = $deleteid");
    $delete_product->execute();
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-item.php');
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