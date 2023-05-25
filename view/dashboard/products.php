

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/products.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/addCoach.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/notification.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/side.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Products</title>

</head>

<body>
    <?php echo $msg; ?>

    <!-- this is the form for adding a product -->

    <form class="form-add">
        <button id="exit"><i class="bi bi-x-circle"></i></button>
        <div class="title">
            <h1>Add a product</h1>
        </div>
        <div class="inputs">
            <div class="input-name">
                <p>Name:
                </p>
                <div class="req"></div>
                <p></p>
                <input type="text" placeholder="enter the product name"  name="nameAdd" id="add-name" required>
            </div>

            <div class="input-price">
                <p>Product price:
                </p>
                <input type="number" placeholder="enter the price" name="priceAdd" id="add-price" required>
            </div>
        </div>
        <div class="submit">
            <input type="submit" value="Done"  id="done">
        </div>

    </form>




    <section class="prodsearch">
        <div class="search">
            <button id="search-icon"><i class="bi bi-search"></i></button>
            <input type="text" placeholder="Search for a product">
        </div>
    </section>


    <section class="products">
    <div class="header">
            <button id="add"><i class="bi bi-plus"></i></button>

            <h1>Add a product</h1>
        </div>

        <?php  displayProducts($conn); ?>

    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL ?>/js/products.js"></script>
</body>

</html>
