<?php
session_start();
?>

<body>
	<h1>Summary</h1>
    <h2>Numer karty:</h2>
    <?php echo $_SESSION['cardNumber'] ?>
    <h2>Imię i nazwisko zamawiąjącego:</h2> 
    <?php echo $_SESSION['name'] ?>
    <h2>Ilość ludzi:</h2> 
    <?php echo $_SESSION['count'] ?>
    <h2>Lista uczestników:</h2>
    <table>
        <tbody>
            <?php foreach ($_SESSION['people'] as $person) { ?>
                <tr>
                    <td><?php echo $person['name'] ?></td>
                    <td><?php echo $person['surname'] ?></td>
                <tr>
            <?php } ?>
        </tbody>
    </table>
</body>
