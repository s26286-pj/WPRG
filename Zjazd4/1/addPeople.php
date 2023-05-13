<?php
session_start();

if(isset($_POST['save'])){
	$count = $_SESSION['count'];
	for($i = 0; $i <= $count; $i++){
		$_SESSION["people"][$i]['name'] = $_POST["person{$i}_name"];
		$_SESSION["people"][$i]['surname'] = $_POST["person{$i}_surname"];
	}
}
?>
<body>
	<h1>Details</h1>
	<form method="post" action="addPeople.php">
		<?php
		for($i = 0; $i < $count; $i++){ ?>
			<h2>Osoba <?php echo $i + 1 ?></h2>
			<label for='person<?php echo $i + 1 ?>_name'>Imię:</label>
			<input type='text' name='person<?php echo $i ?>_name'></br>
			<label for='person<?php echo $i + 1 ?>_surname'>Nazwisko:</label>
			<input type='text' name='person<?php echo $i ?>_surname'></br>
		<?} ?>
		<input type="submit" name="save">
	</form>
	<a href="index.php"><button>Wróć do 1 strony</button></a>
</body>
</html>
