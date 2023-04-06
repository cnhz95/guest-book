<?php
class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("studentmysql.miun.se", "chhe1902", "password", "chhe1902");
        if ($this->conn->connect_error) {
            die("Connection error: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function insert_post($name, $message, $date_time) {
        $sql = "INSERT INTO guest_book_table(Username, Post, Post_date) VALUES('$name', '$message', '$date_time');";
        if (!$this->conn->query($sql)) {
            die("Error: " . $this->conn->error);
        }
    }

    public function delete_post($id) {
        $sql = "DELETE FROM guest_book_table WHERE id=" . $id;
        if (!$this->conn->query($sql)) {
            die("Error: " . $this->conn->error);
        }
    }

    public function print_posts() {
        $sql = "SELECT * FROM guest_book_table";
        $result = $this->conn->query($sql); // Performs the query
        // Displays each row of the associative array returned by the query
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<p>User: " . $row["Username"] . "</p>";
            echo "<p>" . $row["Post"] . "</p>";
            echo "<p>" . $row["Post_date"] . "</p>";
            echo "<a class='delete_button' href='index.php?delete_post=" . $row["id"]. "'>Delete</a>";
            echo "</div>";
        }
    }
}
