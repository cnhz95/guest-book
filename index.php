<?php
    error_reporting(-1); // Reports every possible error
    ini_set("display_errors", 1); // Turns on the display_errors setting

    // Includes the file when the class is instantiated
    spl_autoload_register(function($class) {
        include "classes/" . $class . ".class.php";
    });

    $db = new Database();

    // The add post button is pressed
    if (isset($_POST["add_post"])) {
        if (!empty($_POST["guest"]) && !empty($_POST["message"])) {
            $db->insert_post($_POST["guest"], $_POST["message"], date("d-m-Y H:i:s"));
        }
        unset($_POST["add_post"]);
        header("location: index.php"); // Reloads the page
    }

    // Delete post is pressed
    if (isset($_GET["delete_post"])) {
        $db->delete_post($_GET["delete_post"]);
        unset($_GET["delete_post"]);
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="sv">
<?php
	$page_title="Guest book";
	include "includes/head.php";
?>
<body>
    <?php include "includes/header.php"; ?>
	<div class="container">
        <div class="message_form">
            <form method="post">
                <label for="guest">Name:</label>
                <input type="text" id="guest" name="guest" required><br>
                <label for="message">Message:</label><br>
                <textarea cols="40" rows="6" id="message" name="message" required></textarea><br>
                <input type="submit" name="add_post" value="Submit">
            </form>
        </div>
        <div class="guest_book">
            <?php $db->print_posts(); ?>
        </div>
	</div>
</body>
</html>