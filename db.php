<?php
// Database connection details
$databaseUrl = "postgres://vfnweizf:grstBk4ruvlMiJjHNqYYdBiIYLJZ30MI@floppy.db.elephantsql.com/vfnweizf";

// Function to create the "articles" table if it doesn't exist
function createArticlesTable() {
    global $databaseUrl;
    try {
        $conn = new PDO($databaseUrl);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "
            CREATE TABLE IF NOT EXISTS articles (
                id SERIAL PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                image_url VARCHAR(255) NOT NULL
            );
        ";
        
        $conn->exec($sql);
        echo "Table 'articles' created successfully";
    } catch (PDOException $e) {
        echo "Table creation failed: " . $e->getMessage();
    }
}

// Function to connect to the database
function connectDB() {
    global $databaseUrl;
    try {
        $conn = new PDO($databaseUrl);
        return $conn;
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
        die();
    }
}

// Function to insert a new article
function insertArticle($title, $image_url) {
    $conn = connectDB();
    $query = "INSERT INTO articles (title, image_url) VALUES (:title, :image_url)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':image_url', $image_url);
    $stmt->execute();
}

// Function to get all articles from the database
function getArticles() {
    $conn = connectDB();
    $query = "SELECT * FROM articles";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $articles;
}
?>
