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
   $get_blog = $conn->query("SELECT * FROM ib_blog", PDO::FETCH_ASSOC);
   ?>
<!doctype html>
<html lang="en">
   <head>
      <?php $views->getpage("meta-add");?>
      <title>Blog Düzenle | itembag.net</title>

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
                                        <th>Başlık</th>
                                        <th>Yazar</th>
                                        <th>Kategori</th>
                                        <th>Durum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>' ?>
                                 <?php
                                 if(empty($_GET)) {
                                 foreach ($get_blog as $blog)
                                 {
                                     $blog_id = $blog['ID'];
                                     $title = $blog['Title'];
                                     $category = $blog['Category'];
                                     $author = $blog['Author'];
                                     $state = $blog['State'];
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
                                        <td>'.$title.'</td>
                                        <td>'.$author.'</td>
                                        <td>'.$category.'</td>
                                        <td>'.$state_ic.'</td>
                                        <td><a href="?editblog='.$blog_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-success"><i class="pe-7s-tools btn-icon-wrapper"> </i>Ürünü Düzenle</a> <a href="?deleteblog='.$blog_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i>Ürünü Kaldır</a></td>
                                    </tr>';
                                }
                            }
                                ?>
                                <?php if(empty($_GET))
                                    echo'</tbody>
                                </table>'; ?>
                                
                                <?php if($_GET['editblog'])
                                {
                                    $blog_id = $_GET['editblog'];
                                    $get_blog_text = $conn->query("SELECT * FROM ib_blog WHERE ID = $blog_id ", PDO::FETCH_ASSOC);
                                    foreach($get_blog_text as $blogs)
                                    {
                                        $title = $blogs['Title'];
                                        $detail = $blogs['Detail'];
                                        $author = $blogs['Author'];
                                        $category = $blogs['Category'];
                                        $state = $slider['State'];                    
                                        echo '<div class="card-body">
                                        <h3 align="center" class="card-title">Blog Yazısı Güncelle</h3>
                                        <form id="addsliderform" method="post" action="https://manager.itembag.net/action/blog-edit.php" enctype="multipart/form-data">
                                            <div class="position-relative form-group">
                                            <label>Başlık</label>
                                            <input name="title" id="title" type="text" value="'.$title.'" class="form-control">
                                            </div>
                                            <div class="position-relative form-group">
                                            <label class="">Detay</label>
                                            <textarea rows="8" name="Detail" id="Detail" class="form-control">'.$detail.'</textarea>
                                            </div>
                                            <div class="position-relative form-group">
                                            <label>Yazar</label>
                                            <input name="author" id="author" type="text" value="'.$author.'" class="form-control">
                                            </div>
                                            <div class="position-relative form-group">
                                            <label>Kategori Seçin</label>
                                            <select name="blogcategory" id="blogcategory" class="form-control">
                                            <option value="Metin 2">Metin 2</option>
                                            <option value="Twitch">Twitch</option>
                                            <option value="Roblox">Roblox</option>
                                            </select>
                                            </div>
                                            <div class="position-relative form-group">
                                            <div>
                                            <div class="custom-checkbox custom-control"><input type="checkbox" name="state_slide" value="1" id="exampleCustomCheckbox2" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox2">Aktif Olsun
                                            </label>
                                            </div>
                                            </div>
                                            </div>
                                            <div style="margin-top:30px;" class="position-relative form-group">
                                            <label class="">Blog Resmi Yükle</label>
                                            <input name="Blog_Image" id="Blog_Image" type="file" class="form-control-file"> <small>Lütfen webp uzantılı yükleyin</small>
                                            <input name="blogid" type="hidden" value="'.$blog_id.'"></input>
                                            </div>
                                            <button class="mt-1 btn btn-primary" type="submit" name="submit">Gönder</button>
                                            </form>
                                     </div>
                                  </div>';
                                }
                            }
                                ?>

<?php if($_GET['deleteblog'])
{
 
    $deleteid = $_GET['deleteblog'];
    $delete_product = $conn->query("DELETE FROM ib_blog WHERE ID = $deleteid");
    $delete_product->execute();
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-blog.php');
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