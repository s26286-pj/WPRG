<?php
require __DIR__ . '/../functions.php';

session_start();
class CommentForm {
    private $comment;
    private $userId;
    private $user;
    private $postId;
    public function __construct(DatabaseConnection $db, string $postId) {
        $this->postId = $postId;
        $this->comment = isset($_POST['comment']) ? $_POST['comment'] : null;
        $this->userId = isset($_SESSION['user']) ? $_SESSION['user']->id : null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db->addComment($this->userId, $this->postId, htmlspecialchars($this->comment));
        }
    }

    private function getUrl(): string {
        return "/post/index.php?id=" . $this->postId;
    }

    public function render(): void { ?>
        <form method="post" action="<?php echo $this->getUrl() ?>">
                <label for="comment">Dodaj komentarz:</label>
                </br>
                <textarea name="comment" rows="4" cols="50" required></textarea>
                <br>
                <input type="submit" name="submit" value="Dodaj">
        </form>
    <?php }
}

class Comments {
    private $comment;
    private $comments = [];
    private $userId;
    private $postId;
    private $user;
    public function __construct(DatabaseConnection $db, string $postId) {
        $this->postId = $postId;
        $this->comments = $db->getComments($this->postId);
        $this->comment = isset($_POST['comment']) ? $_POST['comment'] : null;
        $this->userId = isset($_POST['user']) ? $_POST['user'] : null;
    }

    public function render(): void { ?>
        <h2>Komentarze</h2>
        <?php foreach ($this->comments as $comment) { ?>
        <div>
            <h3><?php echo $comment->login ? $comment->login : "Gość" ?></h3>
            <h6>Utworzono: <?php echo $comment->created ?></h6>
            <p><?php echo $comment->content ?></p>
        </div>
        <?php }
    }
}

class PostView {
    private $post;
    private $postId;
    private $db;
    private $commentForm;
    private $comments;

    public function __construct(DatabaseConnection $db) {
        if (isset($_GET['id'])) {
            $this->db = $db;
            $this->postId = $_GET['id'];
            $this->post = $this->db->getPostById($this->postId);
            if ($this->post) {
                $this->commentForm = new CommentForm($db, $this->postId);
                $this->comments = new Comments($db, $this->postId);
                $this->render();
            }
        }
    }

    private function previousPostLink() {
        $previousPostId = $this->db->getPreviousPostId($this->postId);
        if ($previousPostId) { ?>
            <a href="/post?id=<?php echo $previousPostId ?>">Poprzedni post</a>
        <?php
        }
    }

    private function nextPostLink() {
        $nextPostId = $this->db->getNextPostId($this->postId);
        if ($nextPostId) { ?>
            <a href="/post?id=<?php echo $nextPostId ?>">Następny post</a>
        <?php
        }
    }

    public function render(): void { ?>
        <h1><?php echo $this->post->title ?></h1>
        <img src="https://placekitten.com/600/400"/>
        <h6>Utworzono: <?php echo $this->post->created ?></h6>
        <div>
            <?php echo $this->post->content ?>
        </div>
        <?php $this->comments->render(); ?>
        <?php $this->commentForm->render(); ?>
        <?php $this->previousPostLink(); ?>
        <?php $this->nextPostLink(); ?>
        <?php 
    }
}

$db = new DatabaseConnection();
$post = new PostView($db);
?>
