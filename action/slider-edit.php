<?php
require '../global.php';
$target_dir = "/var/www/vhosts/itembag.net/httpdocs/assets/images/products/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$date = date('d.m.y H:i:s');

if(isset($_POST["submit"])) {

    $bigtext = $_POST['BigText'];
    $middletext = $_POST['MiddleText'];
    $smalltext = $_POST['SmallText'];
    $note = $_POST['Note'];
    $color = $_POST['Renk'];
    $buttonlink = $_POST['ButtonLink'];
    $state = $_POST['state_slide'];
    $slide_id = $_POST['slideid'];

if($_FILES['image']['name'] == "")
{
  echo "<script>alert('Lütfen resim seçiniz.')</script>";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-slider.php?editslider='.$slide_id.'');
  $uploadOk = 0;

}
if (file_exists($target_file)) {
  unlink($target_file);
}

else if ($_FILES["image"]["size"] > 500000) {
  echo "Dosyanın boyutu çok büyük.";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-slider.php?editslider='.$slide_id.'');
  $uploadOk = 0;
}

else if($imageFileType != "webp") {
  echo "Sadece webp uzantılı dosyaları yükleyebilirsiniz.";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-slider.php?editslider='.$slide_id.'');
  $uploadOk = 0;
}

else if($bigtext == "" || $middletext == "" || $smalltext == "" || $note == "" || $color == ""  || $buttonlink == "")
  {
    echo "<script>alert('Boş alanlar var tekrar deneyin.')</script>";
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-slider.php?editslider='.$slide_id.'');
    $uploadOk = 0;
 }

 if($state == "" || $state != 1)
 {
   $state = "0";
 }

if($uploadOk == 1)
{     

      $delete = $conn->prepare("DELETE FROM ib_slider WHERE ID = ?");
      $delete->bindParam(1, $slide_id, PDO::PARAM_INT);
      $delete->execute();
      if($delete)
      {
        $image_name = $_FILES["image"]["name"];
        $sorgu = $conn->prepare("INSERT INTO ib_slider(BigText,MiddleText,SmallText,Note,Color,ButtonLink,Image,State) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $sorgu->bindParam(1, $bigtext, PDO::PARAM_STR);
        $sorgu->bindParam(2, $middletext, PDO::PARAM_STR);
        $sorgu->bindParam(3, $smalltext, PDO::PARAM_STR);
        $sorgu->bindParam(4, $note, PDO::PARAM_STR);
        $sorgu->bindParam(5, $color, PDO::PARAM_STR);
        $sorgu->bindParam(6, $buttonlink, PDO::PARAM_STR);
        $sorgu->bindParam(7, $image_name, PDO::PARAM_STR);
        $sorgu->bindParam(8, $state, PDO::PARAM_STR);
        $sorgu->execute();  
      } 

  if ($sorgu){
    echo "<script>alert('Slider güncelleme başarılı!')</script>";
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-slider.php');
  }
  
  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}

}

?>