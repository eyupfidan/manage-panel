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

   $get_users = $conn->query("SELECT * FROM ib_users", PDO::FETCH_ASSOC);
   ?>
<!doctype html>
<html lang="en">
   <head>
      <?php $views->getpage("meta-add");?>
      <title>Kullanıcı İşlemleri | itembag.net</title>
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
                                        <th>Kullanıcı Adı</th>
                                        <th>Email</th>
                                        <th>Son Giriş</th>
                                        <th>Durum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>' ?>
                                 <?php
                                 if(empty($_GET)) {
                                 foreach ($get_users as $user)
                                 {
                                     $user_id = $user['ID'];
                                     $user_name = $user['Username'];
                                     $user_mail = $user['Email'];
                                     $user_lastlogin = $user['LastLogin'];
                                     $user_activeip = $user['ActiveIP'];
                                     $state = $user['State'];
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
                                        <td>'.$user_name.'</td>
                                        <td>'.$user_mail.'</td>
                                        <td>'.$user_lastlogin.'</td>
                                        <td>'.$state_ic.'</td>
                                        <td><a href="?edituser='.$user_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-success"><i class="pe-7s-tools btn-icon-wrapper"> </i>Kullanıcıyı Düzenle</a> <a href="?deleteuser='.$user_id.'" class="mb-2 mr-2 btn-icon btn-pill btn btn-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i>Kullanıcıyı Kaldır</a></td>
                                    </tr>';
                                }
                            }
                                ?>
                                <?php if(empty($_GET))
                                    echo'</tbody>
                                </table>'; ?>
                                
                                <?php if($_GET['edituser'])
                                {
                                    $user_id = $_GET['edituser'];
                                    $get_user = $conn->query("SELECT * FROM ib_users WHERE ID = $user_id", PDO::FETCH_ASSOC);
                                    foreach($get_user as $users)
                                    {
                                        $user_name = $users['Username'];
                                        $user_mail = $users['Email'];
                                        $user_date = $users['Date'];
                                        $user_lastlogin = $users['LastLogin'];
                                        $user_activeip = $users['ActiveIP'];
                                    echo '<div class="card-body">
                                    <h3 align="center" class="card-title">Kullanıcıyı Düzenle</h3>
                                    <form id="additemform" method="post" action="https://manager.itembag.net/action/user-edit.php">
                                       <div class="position-relative form-group">
                                          <label class="">Kullanıcı Adı</label>
                                          <input name="Name" id="Name" type="text" value="'.$user_name.'" class="form-control"> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">E-mail Adresi</label>
                                          <input name="Mail" id="Mail" type="text" value="'.$user_mail.'" class="form-control"> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Kayıt Tarihi</label>
                                          <input name="Date" id="Date" type="text" value="'.$user_date.'" class="form-control" disabled> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Son Giriş</label>
                                          <input name="LastLogin" id="LastLogin" type="text" value="'.$user_lastlogin.'"  class="form-control" disabled> 
                                       </div>
                                       <div class="position-relative form-group">
                                          <label class="">Ip Adresi</label>
                                          <input name="Activeip" id="Activeip" type="text" value="'.$user_activeip.'"  class="form-control" disabled> 
                                          <input name="accountid" type="hidden" value="'.$user_id.'">                                       </div>
                                       <button class="mb-2 mr-2 btn btn-primary" type="submit" id="submit" name="submit" >Gönder</button>		
                                    </form>
                                 </div>';
                                }
                            }
                                ?>

<?php if($_GET['deleteuser'])
{
 
    $deleteid = $_GET['deleteuser'];
    $delete_product = $conn->query("DELETE FROM ib_users WHERE ID = $deleteid");
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