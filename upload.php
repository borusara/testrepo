<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Handle article upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Upload the image to the server
    move_uploaded_file($image_tmp, 'images/' . $image);

    // Insert article into the database
    insertArticle($title, 'images/' . $image);

    header('Location: index.php'); // Redirect to the main page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Upload Article</title>
</head>
<body>
    <h1>Upload Article</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
