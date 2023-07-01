<?php require __DIR__ . "/connection.php"; ?>

<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
$data = [];

$db = new Database();
$con = $db->connect();

$sql = "SELECT * FROM note_app_table ORDER BY completed ASC, id DESC";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

if ($requestMethod == "POST" && !empty($_POST["note"])) {
    $note = htmlentities($_POST["note"]);

    $sql = "INSERT INTO note_app_table (note) VALUES ('$note')";

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
    <link rel="stylesheet" href="./index.css">
    <title>Note app</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" name="note" id="note" placeholder="enter your note here" spellcheck="false">
                <input type="submit" id="add" name="add" value="&plus;">
            </form>
        </div>

        <div class="notes-container">
            <?php if (count($data) > 0): ?>
                <?php for ($i = 0; $i < count($data); $i++): ?>
                    <div class="note-wrapper">
                        <p>
                            <?php echo $data[$i]["note"]; ?>
                        </p>

                        <div class="note-edit-delete-buttons">
                            <button class="edit">
                                <a href="http://localhost:3000/edit.php?id=<?php echo $data[$i]['id']; ?>">&#x270E;</a>
                            </button>
                            <button class="delete">
                                <a href="http://localhost:3000/delete.php?id=<?php echo $data[$i]['id']; ?>">&#x2716;</a>
                            </button>
                        </div>

                        <span class="date">
                            <?php echo date("d M, D", strtotime($data[$i]["pub_date"])) ?>
                        </span>
                    </div>
                <?php endfor; ?>
            <?php else: ?>
                <p class="no-task">No task</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>