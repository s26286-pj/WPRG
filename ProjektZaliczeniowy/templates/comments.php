<?php
foreach ($comments as $comment) { ?>
    <div>
        <h3><?php echo $comment->login ? $comment->login : "Gość" ?></h3>
        <h6>Utworzono: <?php echo $comment->created ?></h6>
        <p><?php echo $comment->content ?></p>
    </div>
    <?php } ?>

<form method="post" action="/post/index.php?id=<?php echo $id ?>">
        <label for="comment">Dodaj komentarz:</label>
        </br>
        <textarea name="comment" rows="4" cols="50" required></textarea><br>
        <input type="submit" name="submit" value="Dodaj">
</form>