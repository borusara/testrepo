<?php
// Include the db.php file
include 'db.php';

// Start the session
session_start();

// Check if the user is an admin
$isAdmin = (isset($_SESSION['admin']) && $_SESSION['admin']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Article Uploader</title>
</head>
<body>
    <h1>Welcome to the Article Uploader</h1>

    <div id="login-form">
        <?php
        if (!$isAdmin) {
            echo '
                <form action="login.php" method="post">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            ';
        } else {
            echo '<a href="upload.php">Upload Article</a>';
        }
        ?>
    </div>

    <div id="articles">
        <?php
        // Retrieve articles from the database
        $articles = getArticles();

        // Display articles
        foreach ($articles as $article) {
            echo '<div class="article">';
            echo '<h2>' . htmlspecialchars($article['title']) . '</h2>';
            echo '<img src="' . htmlspecialchars($article['image_url']) . '" alt="Article Image">';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
