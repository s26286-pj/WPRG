<?php

$ROLES = ["ADMIN", "EDITOR", "USER"];

class UserParams {
    public $login;
    public $role;
    public $id;
    public $password;

    public function __construct($id, $login, $role, $password = null) {
        $this->id = $id;
        $this->login = $login;
        $this->role = $role;
        $this->password = $password;
    }

    public function exist() : bool {
        return !!$this->id;
    }
}

class User {
    public $login;
    public $role;
    public $id;
    public $created;
    public $updated;
    public function __construct($obj) {
        if (is_array($obj)) {
            $this->login = $obj["login"];
            $this->role = $obj["role"];
        } else if (!is_null($obj)){
            $this->id = $obj->id;
            $this->login = $obj->login;
            $this->role = $obj->role;
            $this->created = $obj->created;
            $this->updated = $obj->updated;
        } else {
            $this->login = "";
            $this->role = "USER";
        }
    }
    public function canPost() : bool {
        return $this->role === "ADMIN" || $this->role === "EDITOR";
    }

    public function canEditOtherUsers() : bool {
        return $this->role === "ADMIN";
    }
    public function exist() : bool {
        return !!$this->id;
    }
}

class PostParams {
    public $id;
    public $title;
    public $content;
    public $mode;

    public function __construct($id, $title, $content, $mode = "DRAFT") {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->mode = $mode;
    }

    public function exist() : bool {
        return !!$this->id;
    }
}

class Post {
    public $id;
    public $title;
    public $content;
    public $mode;
    public $created;
    public $updated;
    public function __construct($obj) {
        if (!is_null($obj)) {
            $this->id = $obj->id;
            $this->title = $obj->title;
            $this->content = $obj->content;
            $this->mode = $obj->mode;
            $this->created = $obj->created;
            $this->updated = $obj->updated;
        } else {
            $this->title = "";
            $this->content = "";
            $this->mode = "DRAFT";
        }
    }
    public function exist() : bool {
        return !!$this->id;
    }
}
class DatabaseConnection
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct()
    {
        $this->host = "mysql";
        $this->username = "root";
        $this->password = "root";
        $this->database = "db";

        $this->connect();
    }

    private function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function authenticate($login, $password) : bool {
        $passwordHash = hash("sha256", $password);
        $query = $this->query("SELECT * from users WHERE login = '$login' AND password = '$passwordHash'");
        $obj = $query->fetch_object();
        if ($obj) {
            $_SESSION['user'] = new User($obj);
            return true;
        }
        return false;
    }

    public function getPostById($id) : ?Post {
        $query = $this->query("SELECT * from posts WHERE id = '$id'");
        $obj = $query->fetch_object();
        if ($obj) {
            return new Post($obj);
        }
        return null;
    }

    public function getPreviousPostId($id) : ?string {
        $query = $this->query("SELECT id from posts WHERE id < '$id' ORDER BY id DESC LIMIT 1");
        $obj = $query->fetch_object();
        if ($obj) {
            return $obj->id;
        }
        return null;
    }
    public function getNextPostId($id) : ?string {
        $query = $this->query("SELECT id from posts WHERE id > '$id' ORDER BY id ASC LIMIT 1");
        $obj = $query->fetch_object();
        if ($obj) {
            return $obj->id;
        }
        return null;
    }
    /**
     * @return Post[]
     */
    public function getPosts($fromNewest = false) : array {
        $sql = "SELECT * from posts";
        if ($fromNewest){
            $sql = $sql . " ORDER BY created DESC";
        }
        $query = $this->query($sql);
        $arr = [];
        while($row = $query->fetch_object()){
            array_push($arr, new Post($row));
        }
        return $arr;
    }

    public function savePost(PostParams $post) : ?Post {
        $sql;
        if ($post->exist()) {
            $sql = "UPDATE posts SET title = '$post->title', content = '$post->content', updated = NOW() WHERE id = '$post->id'";
        } else {
            $sql = "INSERT INTO posts ( title, content ) VALUES ('$post->title', '$post->content')";
        }
        $query = $this->query($sql);
        
        if ($query === TRUE) {
            $id;
            if ($post->exist()) {
                $id = $post->id;
            } else {
                $id = $this->connection->insert_id;
            }
            return $this->getPostById($id);
        }
        return null;
    }

    public function deletePost(string $id) : bool {
        $query = $this->query("DELETE FROM posts WHERE id = '$id'");
        return !!$query;
    }

    public function getUsers() : array {
        $query = $this->query("SELECT * from users");
        $arr = [];
        while($row = $query->fetch_object()){
            array_push($arr, new User($row));
        }
        return $arr;
    }

    public function getUserById($id) : ?User {
        $query = $this->query("SELECT * from users WHERE id = '$id'");
        $obj = $query->fetch_object();
        if ($obj) {
            return new User($obj);
        }
    }

    public function saveUser(UserParams $user) : ?User {
        $sql;
        if ($user->exist()) {
            if ($user->password) {
                $passwordHash = hash("sha256", $user->password);
                $sql = "UPDATE users SET login = '$user->login', role = '$user->role', password = '$passwordHash', updated = NOW() WHERE id = '$user->id'";
            } else {
                $sql = "UPDATE users SET login = '$user->login', role = '$user->role', updated = NOW() WHERE id = '$user->id'";
            }
        } else {
            $passwordHash = hash("sha256", $user->password);
            $sql = "INSERT INTO users ( login, role, password ) VALUES ('$user->login', '$user->role', '$passwordHash')";
        }
        $query = $this->query($sql);
        
        if ($query === TRUE) {
            $id;
            if ($user->exist()) {
                $id = $user->id;
            } else {
                $id = $this->connection->insert_id;
            }
            return $this->getUserById($id);
        }
        return null;
    }

    public function addComment(string | null $userId, string $postId, string $content) : bool {
        $query;
        if ($userId) {
            $query = $this->query("INSERT INTO comments ( userId, postId, content ) VALUES ('$userId', '$postId', '$content')");
        } else {
            $query = $this->query("INSERT INTO comments ( userId, postId, content ) VALUES (NULL, '$postId', '$content')");
        }
        return !!$query;
    }

    public function getComments($postId) : array {
        $arr = [];
        $query = $this->query("SELECT comments.content, users.login, comments.created FROM comments LEFT JOIN users ON comments.userId=users.id WHERE comments.postId = '$postId'");
        while($row = $query->fetch_object()){
            array_push($arr, $row);
        }
        return $arr;
    }

    public function deleteUser(string $id) : bool {
        $query = $this->query("DELETE FROM users WHERE id = '$id'");
        return !!$query;
    }

    public function query($sql)
    {
        return mysqli_query($this->connection, $sql);
    }

    public function close()
    {
        mysqli_close($this->connection);
    }
}
