<?php
require '../global.php';
$target_dir = "/var/www/vhosts/itembag.net/httpdocs/assets/images/sliders/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$date = date('d.m.y H:i:s');

if(isset($_POST["submit"])) {

    $bigtext = $_POST['BigText'];
    $middletext = $_POST['MiddleText'];
    $smalltext = $_POST['SmallText'];
    $note = $_POST['Note'];
    $renk = $_POST['Renk'];
    $buttonlink = $_POST['ButtonLink'];
    $slide_state = $_POST['state_slide'];
    $file = $_FILES['image'];


if($_FILES['image']['name'] == "")
{
  echo "<script>alert('Lütfen resim seçiniz.')</script>";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/add-slider.php');
  $uploadOk = 0;

}

if (file_exists($target_file)) {
  echo "<script>alert('Aynı isimde bir dosya mevcut.')</script>";
  $uploadOk = 0;
  header('Refresh: 0; URL=https://manager.itembag.net/pages/add-slider.php');
}

else if ($_FILES["image"]["size"] > 500000) {
  echo "Dosyanın boyutu çok büyük.";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/add-slider.php');
  $uploadOk = 0;
}

else if($imageFileType != "webp") {
  echo "Sadece webp uzantılı dosyaları yükleyebilirsiniz.";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/add-slider.php');
  $uploadOk = 0;
}

else if($bigtext == "" || $middletext == "" || $smalltext == "" || $note == "" || $renk == "" || $buttonlink == "")
  {
    echo "<script>alert('Boş alanlar var tekrar deneyin.')</script>";
    header('Refresh: 0; URL=https://manager.itembag.net/pages/add-slider.php');
    $uploadOk = 0;
 }

 if($slide_state == "" || $slide_state != 1)
 {
   $slide_state = "0";
 }
 

if($uploadOk == 1)
{
      $image_name = $_FILES["image"]["name"];
      $sorgu = $conn->prepare("INSERT INTO ib_slider(BigText,MiddleText,SmallText,Note,Color,ButtonLink,Image,State) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
      $sorgu->bindParam(1, $bigtext, PDO::PARAM_STR);
      $sorgu->bindParam(2, $middletext, PDO::PARAM_STR);
      $sorgu->bindParam(3, $smalltext, PDO::PARAM_STR);
      $sorgu->bindParam(4, $note, PDO::PARAM_STR);
      $sorgu->bindParam(5, $renk, PDO::PARAM_STR);
      $sorgu->bindParam(6, $buttonlink, PDO::PARAM_STR);
      $sorgu->bindParam(7, $image_name, PDO::PARAM_STR);
      $sorgu->bindParam(8, $slide_state, PDO::PARAM_STR);
      $sorgu->execute();  
      if ($sorgu){
    echo "<script>alert('Slider ekleme başarılı!')</script>";
    header('Refresh: 0; URL=https://manager.itembag.net/pages/add-slider.php');
  }
  
  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}

}

?>