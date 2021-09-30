<?php
require '../global.php';
if(isset($_POST["submit"]))
{
    $username = $_POST['Name'];
    $mail = $_POST['Mail'];
    $accountid = $_POST['accountid'];
    $uploadOk = 1;
    if ($username == "" || $mail == "")
    {
        echo "<script>alert('Boş alanlar var tekrar deneyin.')</script>";
        header('Refresh: 0; URL=https://manager.itembag.net/pages/account.php?edituser=' . $username . '');
        $uploadOk = 0;
    }

    if ($uploadOk == 1)
    {
        $sorgu = $conn->prepare("UPDATE ib_users SET Username = ?, Email = ? WHERE ID = ? ");
        $sorgu->bindParam(1, $username, PDO::PARAM_STR);
        $sorgu->bindParam(2, $mail, PDO::PARAM_STR);
        $sorgu->bindParam(3, $accountid, PDO::PARAM_INT);
        $sorgu->execute();
        if($sorgu)
        {
            echo "<script>alert('Kullanıcı güncelleme başarılı!')</script>";
            header('Refresh: 0; URL=https://manager.itembag.net/pages/account.php');
        }
    }

}

?>
