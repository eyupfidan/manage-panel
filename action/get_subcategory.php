<?php
require '../global.php';
$get_subcategory = $_GET['CategoryID'];
$get_cat = $conn->query("SELECT * FROM ib_subcategory WHERE CategoryID = $get_subcategory AND state = 1", PDO::FETCH_ASSOC);
?> 

<?php foreach($get_cat as $row){ ?>
    <option value="<?php echo $row['ID']; ?>"><?php echo $row['Name']; ?></option>
<?php } ?>