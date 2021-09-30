<?php
require '../global.php';
$target_dir = "/var/www/vhosts/itembag.net/httpdocs/assets/images/products/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$date = date('d.m.y H:i:s');

if(isset($_POST["submit"])) {

    $name = $_POST['Name'];
    $detail = $_POST['Detail'];
    $maxprice = $_POST['MaxPrice'];
    $minprice = $_POST['MinPrice'];
    $stock = $_POST['Stock'];
    $categoryid = $_POST['CategoryID'];
    $subcategoryid = $_POST['SubCategoryID'];
    $currencytype = $_POST['CurrencyType'];
    $featured = $_POST['featured_item'];
    $state = $_POST['state_item'];
    $file = $_FILES['image'];
    $item_id = $_POST['itemid'];

if($_FILES['image']['name'] == "")
{
  echo "<script>alert('Lütfen resim seçiniz.')</script>";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-item.php?edititem='.$item_id.'');
  $uploadOk = 0;

}
if(empty($_POST["subcategoryid"]))
{
  echo "<script>alert('Lütfen alt kategori seçiniz.')</script>";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-item.php?edititem='.$item_id.'');
  $uploadOk = 0;

}
if (file_exists($target_file)) {
  unlink($target_file);
}

else if ($_FILES["image"]["size"] > 500000) {
  echo "Dosyanın boyutu çok büyük.";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-item.php?edititem='.$item_id.'');
  $uploadOk = 0;
}

else if($imageFileType != "webp") {
  echo "Sadece webp uzantılı dosyaları yükleyebilirsiniz.";
  header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-item.php?edititem='.$item_id.'');
  $uploadOk = 0;
}

else if($name == "" || $detail == "" || $maxprice == "" || $minprice == "" || $stock == "" )
  {
    echo "<script>alert('Boş alanlar var tekrar deneyin.')</script>";
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-item.php?edititem='.$item_id.'');
    $uploadOk = 0;
 }

 if($state == "" || $state != 1)
 {
   $state = "0";
 }

if($featured == "" || $featured != 1)
{
  $featured = "0";
}
if($uploadOk == 1)
{     

      $delete = $conn->prepare("DELETE FROM ib_product WHERE ID = ?");
      $delete->bindParam(1, $item_id, PDO::PARAM_INT);
      $delete->execute();
      if($delete)
      {
      $image_name = $_FILES["image"]["name"];
      $sorgu = $conn->prepare("INSERT INTO ib_product(Name, Detail, Image,MaxPrice,MinPrice,Stock,CategoryID,SubCategoryID,Date,State,CurrencyType,IsFeatured) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $sorgu->bindParam(1, $name, PDO::PARAM_STR);
      $sorgu->bindParam(2, $detail, PDO::PARAM_STR);
      $sorgu->bindParam(3, $image_name, PDO::PARAM_STR);
      $sorgu->bindParam(4, $maxprice, PDO::PARAM_STR);
      $sorgu->bindParam(5, $minprice, PDO::PARAM_STR);
      $sorgu->bindParam(6, $stock, PDO::PARAM_STR);
      $sorgu->bindParam(7, $categoryid, PDO::PARAM_STR);
      $sorgu->bindParam(8, $subcategoryid, PDO::PARAM_STR);
      $sorgu->bindParam(9, $date, PDO::PARAM_STR);
      $sorgu->bindParam(10, $state, PDO::PARAM_STR);
      $sorgu->bindParam(11, $currencytype, PDO::PARAM_STR);
      $sorgu->bindParam(12, $featured, PDO::PARAM_STR);
      $sorgu->execute();  
    } 

  if ($sorgu){
    echo "<script>alert('Ürün ekleme başarılı!')</script>";
    header('Refresh: 0; URL=https://manager.itembag.net/pages/edit-item.php');
  }
  
  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}

}

?>