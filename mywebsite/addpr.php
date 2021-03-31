<?php

    $pdo = new PDO('mysql:host=localhost;dbname=scandiskep','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requests = [];
    $sku = '';
    $name = '';
    $price = '';
    $attribute = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $attribute = $_POST['attr'];

        if(!$sku){
            array_push($requests,'SKU is required, please fill the required field');
        }
        if(!$name){
            array_push($requests,'Name is required, please fill the required field');
        }
        if(!$price){
            array_push($requests,'Price is required, please fill the required field');
        }
        if(!$attribute){
            array_push($requests,'Attribute is required, please fill the required field');
        }

        if(empty($requests)){
            $order = $pdo->prepare ("INSERT INTO products (SKU, Name, Price, Attribute) VALUES(:sku, :name, :price, :attribute)");
            $order->bindValue(':sku', $sku);
            $order->bindValue(':name', $name);
            $order->bindValue(':price', $price);
            $order->bindValue(':attribute', $attribute);
            $order->execute();

            header('Location: index.php');
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" >
    <title>Products page</title>
</head>
<body>
<a href="index.php" type="button" class="btn btn-outline-danger" style="float: right ; margin: 5px">Discard</a>
<h1>Add New Product</h1>

<?php
    if(!empty($requests)){?>
        <div class="alert alert-danger">
            <?php
            foreach ($requests as $request){?>
                <div><?php echo $request ?></div>
            <?php }
            ?>
        </div>
    <?php }
?>

<form method="post">
    <div class="form-group" style="margin: 5px">
        <label>SKU</label>
        <input type="text" name="sku" class="form-control" value="<?php echo $sku ?>">
    </div>
    <div class="form-group" style="margin: 5px">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
    </div>
    <div class="form-group" style="margin: 5px">
        <label>Price $</label>
        <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $price ?>">
    </div>
    <div class="form-group" style="margin: 5px">
        <label>Attribution</label>
        <input type="text" name="attr" class="form-control" value="<?php echo $attribute ?>">
    </div>

    <button type="submit" class="btn btn-outline-success" style="margin: 5px">Add</button>
</form>

</body>
</html>
