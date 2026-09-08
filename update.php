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


/* Get record */

$stmt = mysqli_prepare(
    $conn,

    "SELECT id,
            item_name,
            quantity,
            unit,
            locality,
            order_status

     FROM grocery_requests

     WHERE id = ?"
);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$row = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);


if (!$row) {

    die("Request not found.");

}


$statuses = [
    "Pending",
    "Processing",
    "Delivered",
    "Cancelled"
];

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Update Request</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


<header class="navbar">

    <div class="brand">
        Grocery Delivery 🛒
    </div>

    <nav>

        <a href="index.php">
            Home
        </a>

        <a href="request.php">
            Place Request
        </a>

        <a href="view.php">
            View Requests
        </a>

    </nav>

</header>


<main class="page">


<div class="card form-card">

    <h1>
        Update Order Status
    </h1>


    <p>

        <strong>Item:</strong>

        <?= htmlspecialchars(
            $row["item_name"],
            ENT_QUOTES,
            'UTF-8'
        ) ?>

    </p>


    <p>

        <strong>Locality:</strong>

        <?= htmlspecialchars(
            $row["locality"],
            ENT_QUOTES,
            'UTF-8'
        ) ?>

    </p>


    <form
        action="update_save.php"
        method="post"
    >

        <input
            type="hidden"
            name="id"
            value="<?= (int)$row["id"] ?>"
        >


        <label for="order_status">

            Order Status

        </label>


        <select
            id="order_status"
            name="order_status"
            required
        >


            <?php foreach (
                $statuses as $status
            ): ?>


                <option
                    value="<?= htmlspecialchars(
                        $status,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"

                    <?= $row["order_status"] === $status
                        ? "selected"
                        : "" ?>
                >

                    <?= htmlspecialchars(
                        $status,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                </option>


            <?php endforeach; ?>


        </select>


        <button
            class="btn primary full"
            type="submit"
        >

            Save Status

        </button>


    </form>

</div>


</main>


<footer>

    Grocery Delivery Request System | DBMS Mini Project

</footer>


</body>

</html>