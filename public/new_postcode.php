<?php
if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";
    try  {
        $connection = new PDO($dsn, $username, $password, $options);

// insert new postcode
  $new_postcode = array(
	"SOANAME" => $_POST['SOANAME'],
	"SOA2001"  => $_POST['SOA2001'],
	"PC2"     => $_POST['PC2'],
	"PC3"       => $_POST['PC3'],
	"MDM_Decile2010"  => $_POST['MDM_Decile2010'],
  "MDM_Rank2017"  => $_POST['MDM_Rank2017']
  );
$sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"postcode_data",
		implode(", ", array_keys($new_postcode)),
		":" . implode(", :", array_keys($new_postcode))
);

$statement = $connection->prepare($sql);
$statement->execute($new_postcode);


	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <blockquote><?php echo escape($_POST['PC2']); ?> successfully added.</blockquote>
<?php } ?>

<form method="post">
  <label for="SOANAME"> SOANAME </label>
  <input type="text" name ="SOANAME" id="SOANAME">
  <label for="SOA2001"> SOA2001 </label>
  <input type="text" name ="SOA2001" id="SOA2001">
  <label for="PC2"> PC2 </label>
  <input type="text" name ="PC2" id="PC2">
  <label for="PC3"> PC3 </label>
  <input type="text" name ="PC3" id="PC3">
  <label for="MDM_Decile2010"> MDM_Decile2010 </label>
  <input type="text" name ="MDM_Decile2010" id="MDM_Decile2010">
  <label for="MDM_Rank2017"> MDM_Rank2017 </label>
  <input type="text" name ="MDM_Rank2017" id="MDM_Rank2017">
  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
