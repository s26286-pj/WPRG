<?php
require __DIR__ . '/functions.php';
$db = new DatabaseConnection();
$posts = $db->getPosts(true);

//nie moja funkcja
function excerpt($paragraph, $limit) {
    $tok = strtok($paragraph, " ");
    $text = "";
    $words = 0;
    while ($tok !== false) {
        $text .= " ".$tok;
        $words++;
        if (($words >= $limit) && ((substr($tok, -1) == "!") || (substr($tok, -1) == ".") || (substr($tok, -1) == "?"))) {
        break;
        }
        $tok = strtok(" ");
    }
    return ltrim($text);
}
?>
    <?php
    foreach ($posts as $post) { ?>
    <div>
        <h2><?php echo $post->title ?></h2>
        <img src="https://placekitten.com/600/400"/>
        <h6>Utworzono: <?php echo $post->created ?></h6>
        <p><?php echo excerpt($post->content, 50) ?></p>
        <a href="/post?id=<?php echo $post->id?>">Czytaj dalej </a>
    </div>
    <?php } ?>
