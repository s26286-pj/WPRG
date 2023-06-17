<?php
    require __DIR__ . '/../../functions.php';
    session_start();
    $user = new User($_SESSION['user']);
    $post;
    if ($user && $user->canPost()) {
        $db = new DatabaseConnection();
        $formUrl = "/admin/posts/edit.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $savedPost = $db->savePost(new PostParams($_POST["id"], $_POST["title"], $_POST["content"]));
            $formUrl = $formUrl . "?id=" . $savedPost->id;
            $post = $db->getPostById($savedPost->id);
        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $formUrl = $formUrl . "?id=" . $id;
            $post = $db->getPostById($id);
        } else {
            $post = new Post(null);
        }
    ?>
<h1>
    <?php echo $post->exist() ? "Edycja posta" : "Tworzenie posta" ?>
</h1>
<form action="<?php echo $formUrl?>" method="POST">
    <input type="hidden" id="id" name="id" value="<?php echo $post->id ?>"/>
    <label for="title">Tytuł:</label><br>
    <input type="text" id="title" name="title" value="<?php echo $post->title ?>" required/>
    </br>
    <label for="content">Zawartość:</label><br>
    <textarea id="content" name="content" rows="100" required><?php echo $post->content ?></textarea>
    <input type="submit" value="Zapisz">
</form>

<?php  } else {

}