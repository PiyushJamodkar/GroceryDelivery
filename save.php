<?php

require_once "config.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: request.php");

    exit;
}


/* Get form values */

$item_name = trim($_POST["item_name"] ?? "");

$quantity = filter_input(
    INPUT_POST,
    "quantity",
    FILTER_VALIDATE_INT
);

$unit = trim($_POST["unit"] ?? "");

$locality = trim($_POST["locality"] ?? "");


/* Default status */

$order_status = "Pending";


/* Allowed units */

$allowed_units = [
    "kg",
    "g",
    "litre",
    "packet",
    "piece"
];


/* Server-side validation */

if (
    $item_name === "" ||
    $quantity === false ||
    $quantity < 1 ||
    $quantity > 100 ||
    !in_array($unit, $allowed_units, true) ||
    $locality === ""
) {

    die("Please enter valid request details.");

}


/* Prepared statement */

$stmt = mysqli_prepare(
    $conn,

    "INSERT INTO grocery_requests
    (item_name, quantity, unit, locality, order_status)
    VALUES (?, ?, ?, ?, ?)"
);


/* Bind values */

mysqli_stmt_bind_param(
    $stmt,
    "sisss",
    $item_name,
    $quantity,
    $unit,
    $locality,
    $order_status
);


/* Execute */

$success = mysqli_stmt_execute($stmt);


mysqli_stmt_close($stmt);


if ($success) {

    header("Location: view.php?success=1");

    exit;

}


die("Unable to save the request.");

?>