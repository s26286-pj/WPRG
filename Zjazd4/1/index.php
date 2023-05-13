<?php
session_start();

if(isset($_POST['save'])){
	$_SESSION['cardNumber'] = $_POST['cardNumber'];
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['count'] = $_POST['count'];
}
?>
<body>
	<h1>Podaj dane:</h1>
	<form method="post" action="index.php">
		<label for="cardNumber">Numer Karty:</label>
		<input type="text" name="cardNumber" id="cardNumber"><br/>
		<label for="name">Imię i Nazwisko zamawiającego:</label>
		<input type="text" name="name" id="name"><br/>
		<label for="count">Ilość osób:</label>
		<input type="number" name="count" id="count"><br/>
		<input type="submit" name="save">
	</form>
</body>
