<?php
    require __DIR__ . '/../../functions.php';
    session_start();
    $user = new User($_SESSION['user']);
    $isEditsHimself = isset($_GET['id']) && $_GET['id'] === $user->id;
    $editedUser;
    if ($user && ($user->canEditOtherUsers() || $isEditsHimself)) {
        $db = new DatabaseConnection();
        $formUrl = "/admin/users/edit.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            var_dump($_POST["password"]);
            $savedUser = $db->saveUser(new UserParams($_POST["id"], $_POST["login"], $_POST["role"], $_POST["password"]));
            $formUrl = $formUrl . "?id=" . $savedUser->id;
            $editedUser = $db->getUserById($savedUser->id);
        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $formUrl = $formUrl . "?id=" . $id;
            $editedUser = $db->getUserById($id);
        } else {
            $editedUser = new User(null);
        }
        var_dump($editedUser->role);
    ?>
<h1>
    <?php echo $editedUser->exist() ? "Edycja użytkownika" : "Tworzenie użytkownika" ?>
</h1>
<form action="<?php echo $formUrl?>" method="POST">
    <input type="hidden" id="id" name="id" value="<?php echo $editedUser->id ?>"/>
    <label for="login">Login</label>
    </br>
    <input type="text" id="login" name="login" value="<?php echo $editedUser->login ?>" required/>
    </br>
    <label for="login">Nowe hasło</label>
    <br>
    <input type="password" id="password" name="password" <?php echo $editedUser->exist() ? null : "required" ?>/>
    </br>
    <label for="role">Rola</label>
    <br>
    <select id="role" name="role">
        <?php foreach ($ROLES as $role): ?>
            <option value="<?php echo $role; ?>" <?php echo $role === $editedUser->role ? "selected": null ?> ><?php echo $role; ?></option>
        <?php endforeach; ?>
    </select>
        </br>
    <input type="submit" value="Zapisz">
</form>

<?php  } else {
    echo "Brak dostępu";
}