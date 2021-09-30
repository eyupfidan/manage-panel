<?php
require '../global.php';
$target_dir = "/var/www/vhosts/itembag.net/httpdocs/assets/images/blog-post/";
$target_file = $target_dir . basename($_FILES["Blog_Image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$date = date("Y/m/d");

if(isset($_POST["submit"])) {

    $title = $_POST['title'];
    $detail = $_POST['Detail'];
    $author = $_POST['author'];
    $blogcategory = $_POST['blogcategory'];
    $state_slide = $_POST['state_slide'];
    $file = $_FILES['Blog_Image'];
    $blogid = $_POST['blogid'];


if($_FILES['Blog_Image']['name'] == "")
{
  echo "<script>alert('Lütfen resim seçiniz.')</script>";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-blog.php?editblog='.$blogid.'');
  $uploadOk = 0;

}

if (file_exists($target_file)) {
    unlink($target_file);
  }
else if ($_FILES["Blog_Image"]["size"] > 500000) {
  echo "Dosyanın boyutu çok büyük.";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-blog.php?editblog='.$blogid.'');
  $uploadOk = 0;
}

else if($imageFileType != "webp") {
  echo "Sadece webp uzantılı dosyaları yükleyebilirsiniz.";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-blog.php?editblog='.$blogid.'');
  $uploadOk = 0;
}

else if($title == "" || $detail == "" || $author == "" || $blogcategory == "" )
  {
    echo "<script>alert('Boş alanlar var tekrar deneyin.')</script>";
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-blog.php?editblog='.$blogid.'');
    $uploadOk = 0;
 }

 if($state_slide == "" || $state_slide != 1)
 {
   $state_slide = "0";
 }
 

if($uploadOk == 1)
{
    $delete = $conn->prepare("DELETE FROM ib_blog WHERE ID = ?");
    $delete->bindParam(1, $blogid, PDO::PARAM_INT);
    $delete->execute();
    if($delete)
    {
      $image_name = $_FILES["Blog_Image"]["name"];
      $sorgu = $conn->prepare("INSERT INTO ib_blog(Title,Detail,Author,Category,Date,State,Image) VALUES(?, ?, ?, ?, ?, ?, ?)");
      $sorgu->bindParam(1, $title, PDO::PARAM_STR);
      $sorgu->bindParam(2, $detail, PDO::PARAM_STR);
      $sorgu->bindParam(3, $author, PDO::PARAM_STR);
      $sorgu->bindParam(4, $blogcategory, PDO::PARAM_STR);
      $sorgu->bindParam(5, $date, PDO::PARAM_STR);
      $sorgu->bindParam(6, $state_slide, PDO::PARAM_STR);
      $sorgu->bindParam(7, $image_name, PDO::PARAM_STR);
      $sorgu->execute();  }
      if ($sorgu){
    echo "<script>alert('Blog güncelleme başarılı!')</script>";
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-blog.php');
}
  
  move_uploaded_file($_FILES["Blog_Image"]["tmp_name"], $target_file);
}

}

?>