<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Place Grocery Request</title>

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
            Place a Grocery Request
        </h1>

        <p class="muted">
            Enter the grocery details below.
        </p>


        <form action="save.php" method="post">


            <label for="item_name">
                Grocery Item
            </label>

            <input
                type="text"
                id="item_name"
                name="item_name"
                maxlength="100"
                required
                placeholder="e.g. Rice"
            >


            <label for="quantity">
                Quantity
            </label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                min="1"
                max="100"
                required
                placeholder="e.g. 5"
            >


            <label for="unit">
                Unit
            </label>

            <select
                id="unit"
                name="unit"
                required
            >

                <option value="">
                    Select unit
                </option>

                <option value="kg">
                    kg
                </option>

                <option value="g">
                    g
                </option>

                <option value="litre">
                    litre
                </option>

                <option value="packet">
                    packet
                </option>

                <option value="piece">
                    piece
                </option>

            </select>


            <label for="locality">
                Delivery Locality
            </label>

            <input
                type="text"
                id="locality"
                name="locality"
                maxlength="100"
                required
                placeholder="e.g. Main Road"
            >


            <button
                class="btn primary full"
                type="submit"
            >
                Submit Request
            </button>

        </form>

    </div>

</main>


<footer>

    Grocery Delivery Request System | DBMS Mini Project

</footer>


</body>

</html>