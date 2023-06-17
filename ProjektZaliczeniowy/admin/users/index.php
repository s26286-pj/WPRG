<?php
    require __DIR__ . '/../../functions.php';
    $db = new DatabaseConnection();
    $users = $db->getUsers();
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Rola</th>
            <th>Stworzono</th>
            <th>Zaktualizowano</th>
            <th>Akcje</th>
        </tr>
    </thead>
<tbody>
    <?php
    foreach ($users as $user) { ?>
    <tr>
        <td><?php echo $user->id ?></td>
        <td><?php echo $user->login ?></td>
        <td><?php echo $user->role ?></td>
        <td><?php echo $user->created ?></td>
        <td><?php echo $user->updated ?></td>
        <td><a href="/admin/users/edit.php?id=<?php echo $user->id?>">Edytuj</a> <a href="/admin/users/delete.php?id=<?php echo $user->id?>">Usuń</a></td>
    </tr>
    <?php } ?>
</tbody>
</table>