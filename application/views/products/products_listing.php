<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products Listing</title>
</head>
<body>
    <h1><?php echo $this->session->flashdata('order_success'); ?></h1>
    <h1>Products</h1>
    <p><?php echo $this->session->flashdata('add_success'); ?></p>
    <table>
        <tr>
            <th>Description</th>
            <th>Price</th>
            <th>Qty</th>
        </tr>
<?php foreach ($products as $product) { ?>
        <tr>
            <td><?php echo $product['description']; ?></td>
            <td>$<?php echo $product['price']; ?></td>
            <td>
                <form action='products/buy/<?php echo $product['id']; ?>' method='post'>
                    <input type='number' name='product_quantity' value='0'>
                    <input type='submit' value='Buy'>
                </form>
            </td>
       </tr>
<?php } ?>
    </table>
    <a href='products/show'>Your Cart</a>
</body>
</html>