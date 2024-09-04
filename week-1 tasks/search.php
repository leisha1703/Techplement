<?php
include 'db.php';

if (isset($_GET['author'])) {
    $author = mysqli_real_escape_string($conn, $_GET['author']);
    $sql = "SELECT quote, author FROM quotes WHERE author LIKE '%$author%'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="quote-container">
        <h2>Search Results for "<?php echo htmlspecialchars($author); ?>"</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="quote"><?php echo $row['quote']; ?></div>
                <div class="author">- <?php echo $row['author']; ?></div>
                <hr>
            <?php endwhile; ?>
        <?php else: ?>
            <div>No quotes found for "<?php echo htmlspecialchars($author); ?>"</div>
        <?php endif; ?>
        <a href="index.php">Back to Random Quote</a>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
