<?php
include 'db.php';

function fetch_random_quote() {
    $quote_json = file_get_contents("https://api.quotable.io/random");
    return json_decode($quote_json, true);
}

$quote_data = fetch_random_quote();
$random_quote = $quote_data['content'];
$author = $quote_data['author'];

$sql = "SELECT id FROM quotes WHERE quote = '" . mysqli_real_escape_string($conn, $random_quote) . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO quotes (author, quote) VALUES ('" . mysqli_real_escape_string($conn, $author) . "', '" . mysqli_real_escape_string($conn, $random_quote) . "')";
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote of the Day</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="quote-container">
        <div class="quote">
            <?php echo $random_quote; ?>
        </div>
        <div class="author">
            - <?php echo $author; ?>
        </div>
        <form action="search.php" method="GET">
            <input type="text" name="author" placeholder="Search by author">
            <button type="submit">Search</button>
        </form>
    </div>
</body>
</html>
