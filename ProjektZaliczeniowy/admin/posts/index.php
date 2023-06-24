<?php
    require __DIR__ . '/../../functions.php';
    $db = new DatabaseConnection();
    session_start();
    $user = new User($_SESSION['user']);
    if ($user && $user->canPost()) {
        $posts = $db->getPosts(true);
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Autor</th>
            <th>Stworzono</th>
            <th>Zaktualizowano</th>
            <th>Akcje</th>
        </tr>
    </thead>
<tbody>
    <?php
    foreach ($posts as $post) { ?>
    <tr>
        <td><?php echo $post->id ?></td>
        <td><?php echo $post->title ?></td>
        <td>TODO</td>
        <td><?php echo $post->created ?></td>
        <td><?php echo $post->updated ?></td>
        <td><a href="/admin/posts/edit.php?id=<?php echo $post->id?>">Edytuj</a> <a href="/admin/posts/delete.php?id=<?php echo $post->id?>">Usuń</a></td>
    </tr>
    <?php } ?>
</tbody>
</table>
<?php } else {
    echo "Brak dostępu";
}
