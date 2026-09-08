<?php

require_once "config.php";


$id = filter_input(
    INPUT_GET,
    "id",
    FILTER_VALIDATE_INT
);


if (!$id) {

    header("Location: view.php");

    exit;
}


/* Prepared DELETE statement */

$stmt = mysqli_prepare(
    $conn,

    "DELETE FROM grocery_requests
     WHERE id = ?"
);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


mysqli_stmt_execute($stmt);


mysqli_stmt_close($stmt);


header("Location: view.php");

exit;

?>