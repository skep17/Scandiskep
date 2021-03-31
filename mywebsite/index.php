<?php

  $pdo = new PDO('mysql:host=localhost;dbname=scandiskep','root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $myQ = $pdo->prepare('SELECT * FROM products');
  $myQ->execute();
  $products = $myQ->fetchAll(PDO::FETCH_ASSOC);

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
    <h1>Products page</h1>
    <a href="addpr.php" type="button" class="btn btn-outline-success" style="float: right ; margin: 5px">Add New Product</a>
    <button type="button" class="btn btn-outline-danger" style="float: right ; margin: 5px">Delete Selected Products</button>
    <table class="table table-dark table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">SKU</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
        <th scope="col">Attribute</th>
        <th scope="col">Select for Mass Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($products as $j => $item) { ?>
      <tr>
          <th scope="row"><?php echo $j + 1 ?></th>
          <td><?php echo $item['SKU'] ?></td>
          <td><?php echo $item['Name'] ?></td>
          <td><?php echo $item['Price']." $" ?></td>
          <td><?php echo $item['Attribute'] ?></td>
          <td>
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              </div>
          </td>
      </tr>
  <?php } ?>
  </tbody>
</table>
  </body>
</html>
