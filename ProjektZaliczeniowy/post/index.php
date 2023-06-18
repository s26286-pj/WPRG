<?php
require __DIR__ . '/../functions.php';
session_start();
$db = new DatabaseConnection();
if (isset($_GET['id'])) {
    $post = $db->getPostById($_GET['id']);
    $previousPostId = $db->getPreviousPostId($_GET['id']);
    $nextPostId = $db->getNextPostId($_GET['id']);
}
if (isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST["comment"];
    $userId = null;
    if (isset($_SESSION['user'])) {
        $user = new User($_SESSION['user']);
        $userId = $user->id;
    }
    $isCommentAdded = $db->addComment($userId, $post->id, htmlspecialchars($comment));
    if ($isCommentAdded) {
        echo 'dodano komentarz';
    } else {
        echo 'błąd';
    }
}
?>

<h1><?php echo $post->title ?></h1>
<img src="https://placekitten.com/600/400"/>
<h6>Utworzono: <?php echo $post->created ?></h6>
<div>
    <?php echo $post->content ?>
</div>

<h2>Komentarze</h2>
<?php
$comments = $db->getComments($_GET['id']);

foreach ($comments as $comment) { ?>
    <div>
        <h3><?php echo $comment->login ? $comment->login : "Gość" ?></h3>
        <h6>Utworzono: <?php echo $comment->created ?></h6>
        <p><?php echo $comment->content ?></p>
    </div>
    <?php } ?>

<form method="post" action="/post/index.php?id=<?php echo $_GET['id'] ?>">
        <label for="comment">Dodaj komentarz:</label>
        </br>
        <textarea name="comment" rows="4" cols="50" required></textarea><br>
        <input type="submit" name="submit" value="Dodaj">
</form>

<?php if ($previousPostId): ?>
<a href="/post?id=<?php echo $previousPostId ?>">Poprzedni post</a>
<?php endif; ?>
<?php if ($nextPostId): ?>
<a href="/post?id=<?php echo $nextPostId ?>">Następny post</a>
<?php endif; ?>
