<?php

require_once "config.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: view.php");

    exit;
}


$id = filter_input(
    INPUT_POST,
    "id",
    FILTER_VALIDATE_INT
);


$status = trim(
    $_POST["order_status"] ?? ""
);


$allowed_statuses = [
    "Pending",
    "Processing",
    "Delivered",
    "Cancelled"
];


if (
    !$id ||
    !in_array(
        $status,
        $allowed_statuses,
        true
    )
) {

    die("Invalid update request.");

}


/* Prepared UPDATE statement */

$stmt = mysqli_prepare(
    $conn,

    "UPDATE grocery_requests
     SET order_status = ?
     WHERE id = ?"
);


mysqli_stmt_bind_param(
    $stmt,
    "si",
    $status,
    $id
);


mysqli_stmt_execute($stmt);


mysqli_stmt_close($stmt);


header("Location: view.php");

exit;

?>