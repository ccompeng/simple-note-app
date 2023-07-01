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
    $edit_note = $_POST["editNote"];

    $sql = "UPDATE note_app_table SET note='$edit_note' WHERE id='$id' LIMIT 1";

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
    <link rel="stylesheet" href="./edit.css">
    <title>Edit</title>
</head>

<body>
    <div class="container">
        <form method="post">
            <input type="text" name="editNote" id="editNote" value="<?php echo $task['note']; ?>" spellcheck="false">
            <input type="submit" value="Edit" id="edit" name="edit">
        </form>
    </div>
</body>

</html>