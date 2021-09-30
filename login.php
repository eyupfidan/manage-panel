<?php require_once 'global.php';
if($_SESSION['Username'] != "")
{
   header("location:https://manager.itembag.net");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Giriş Yap - itembag.net</title>
    <meta name="viewport"
  content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

<link href="./main.d810cf0ae7f39f28f336.css" rel="stylesheet"></head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="h5 modal-title text-center">
                                        <h4 class="mt-2">
                                            <div>Giriş Yap</div>
                                        </h4>
                                    </div>
                                    <form class="loginup" method="post" action="">
                                        <div class="form-row">
                                        <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="Username" id="exampleText" placeholder="Kullanıcı adın..." type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="Password" id="examplePassword" placeholder="Şifren..." type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="divider"></div>
                                </div>
                                <div class="modal-footer clearfix">

                                    <div class="float-right">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg">Giriş Yap</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © itembag.net 2021</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="./assets/scripts/main.d810cf0ae7f39f28f336.js"></script></body>

</html>
<?php if(isset($_POST['submit']))
{
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $password = md5($password);
    $result = "";
    if($username == "" ||  $password == "")
    {
     echo "<script>alert('Lütfen boş alan bırakmayınız')</script>";
     $result = "no";
    }
    if($result == "")
    {
        $sorgu = $conn->prepare("SELECT * FROM ib_admins WHERE Username = ? and password = ? ");
        $sorgu->bindParam(1, $username, PDO::PARAM_STR);
        $sorgu->bindParam(2, $password, PDO::PARAM_STR);
        $sorgu->execute();
        $count = $sorgu->rowCount();
        if($count > 0)
        {
         $_SESSION['Username'] = $username;
         echo "<script>alert('Giriş başarılı yönlendiriliyorsunuz!')</script>";
         header('Refresh: 0; URL=https://manager.itembag.net');

        }
        else 
        {
            echo "<script>alert('Kullanıcı adınız veya şifreniz yanlış!')</script>";

        }
    }
 
}
?>