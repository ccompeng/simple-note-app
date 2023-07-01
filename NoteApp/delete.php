<?php require __DIR__ . "/connection.php"; ?>

<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];

$id = $_GET["id"];

$db = new Database();
$con = $db->connect();

$sql = "SELECT note FROM note_app_table WHERE id='$id' LIMIT 1";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $task = $result->fetch_assoc();
}

if ($requestMethod == "POST") {
    $sql = "DELETE FROM note_app_table WHERE id='$id' LIMIT 1";

    if ($con->query($sql)) {
        header("Location: http://localhost:3000/index.php");
        exit();
    } else {
        echo "Failed";
    }

    $con->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./delete.css">
    <title>Delete</title>
</head>

<body>
    <div class="container">
        <h3>Are you sure delete that note?</h3>
        <p>
            "<?php echo $task["note"]; ?>"
        </p>

        <form method="post">
            <button type="submit" id="yes">Yes</button>
            <button type="button" id="no">
                <a href="http://localhost:3000/index.php">No</a>
            </button>
        </form>
    </div>
</body>

</html>