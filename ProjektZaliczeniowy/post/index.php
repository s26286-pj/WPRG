<?php
require __DIR__ . '/../functions.php';
$db = new DatabaseConnection();
if (isset($_GET['id'])) {
    $post = $db->getPostById($_GET['id']);
    $previousPostId = $db->getPreviousPostId($_GET['id']);
    $nextPostId = $db->getNextPostId($_GET['id']);
}
?>

<h1><?php echo $post->title ?></h1>
<img src="https://placekitten.com/600/400"/>
<h6>Utworzono: <?php echo $post->created ?></h6>
<div>
    <?php echo $post->content ?>
</div>

<?php if ($previousPostId): ?>
<a href="/post?id=<?php echo $previousPostId ?>">Poprzedni post</a>
<?php endif; ?>
<?php if ($nextPostId): ?>
<a href="/post?id=<?php echo $nextPostId ?>">Następny post</a>
<?php endif; ?>
