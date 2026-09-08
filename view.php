<?php

require_once "config.php";


$success = isset($_GET["success"]);


$search = trim($_GET["search"] ?? "");


if ($search !== "") {

    $stmt = mysqli_prepare(
        $conn,

        "SELECT id,
                item_name,
                quantity,
                unit,
                locality,
                order_status,
                created_at

         FROM grocery_requests

         WHERE item_name LIKE CONCAT('%', ?, '%')

         OR locality LIKE CONCAT('%', ?, '%')

         ORDER BY id DESC"
    );


    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $search,
        $search
    );

} else {

    $stmt = mysqli_prepare(
        $conn,

        "SELECT id,
                item_name,
                quantity,
                unit,
                locality,
                order_status,
                created_at

         FROM grocery_requests

         ORDER BY id DESC"
    );

}


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>View Grocery Requests</title>

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


<div class="card">

    <h1>
        Grocery Requests
    </h1>


    <?php if ($success): ?>

        <div class="success">

            Request submitted successfully.

        </div>

    <?php endif; ?>


    <!-- SEARCH -->

    <form
        class="search-form"
        method="get"
        action="view.php"
    >

        <label for="search">

            Search by item or locality

        </label>


        <div class="search-row">

            <input
                type="text"
                id="search"
                name="search"
                value="<?= htmlspecialchars(
                    $search,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
                maxlength="100"
                placeholder="e.g. Rice"
            >


            <button
                class="btn primary"
                type="submit"
            >

                Search

            </button>


            <a
                class="btn secondary"
                href="view.php"
            >

                Clear

            </a>

        </div>

    </form>


    <!-- TABLE -->

    <div class="table-wrap">

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Item</th>

                    <th>Quantity</th>

                    <th>Locality</th>

                    <th>Status</th>

                    <th>Date</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>


            <?php if (
                mysqli_num_rows($result) > 0
            ): ?>


                <?php while (
                    $row = mysqli_fetch_assoc($result)
                ): ?>


                <tr>

                    <td>
                        <?= (int)$row["id"] ?>
                    </td>


                    <td>

                        <?= htmlspecialchars(
                            $row["item_name"],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>

                    </td>


                    <td>

                        <?= (int)$row["quantity"] ?>

                        <?= htmlspecialchars(
                            $row["unit"],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>

                    </td>


                    <td>

                        <?= htmlspecialchars(
                            $row["locality"],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>

                    </td>


                    <td>

                        <span class="status">

                            <?= htmlspecialchars(
                                $row["order_status"],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>

                        </span>

                    </td>


                    <td>

                        <?= htmlspecialchars(
                            $row["created_at"],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>

                    </td>


                    <td class="actions-cell">

                        <a
                            href="update.php?id=<?= (int)$row["id"] ?>"
                        >

                            Update

                        </a>


                        <a
                            href="delete.php?id=<?= (int)$row["id"] ?>"
                            onclick="return confirm('Delete this request?');"
                        >

                            Delete

                        </a>

                    </td>

                </tr>


                <?php endwhile; ?>


            <?php else: ?>


                <tr>

                    <td
                        colspan="7"
                        class="empty"
                    >

                        No requests found.

                    </td>

                </tr>


            <?php endif; ?>


            </tbody>

        </table>

    </div>

</div>


</main>


<footer>

    Grocery Delivery Request System | DBMS Mini Project

</footer>


</body>

</html>


<?php

mysqli_stmt_close($stmt);

?>