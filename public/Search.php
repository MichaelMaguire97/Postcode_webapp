<?php
 
if (isset($_POST['submit'])) {
    try  {
        
        require "../config.php";
        require "../common.php";
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT * 
                        FROM postcode_data
                        WHERE PC2 = :PC2";
        $PC2 = $_POST['PC2'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':PC2', $PC2, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>SOANAME</th>
					<th>SOA2001</th>
					<th>PC2</th>
					<th>PC3</th>
					<th>MDM Decile 2010</th>
					<th>mdm Rank 2017</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["SOANAME"]); ?></td>
				<td><?php echo escape($row["SOA2001"]); ?></td>
				<td><?php echo escape($row["PC2"]); ?></td>
				<td><?php echo escape($row["PC3"]); ?></td>
				<td><?php echo escape($row["MDM_Decile2010"]); ?></td>
				<td><?php echo escape($row["MDM_Rank2017"]); ?> </td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['PC2']); ?>.</blockquote>
	<?php } 
} ?> 


<?php include "templates/header.php"; ?>

<h2>Find Postcode</h2>

<form method="post">
	<label for="PC2">Enter Postcode</label>
	<input type="text" id="PC2" name="PC2">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
