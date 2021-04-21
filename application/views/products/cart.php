<!DOCTYPE html>
<html lang="en">
<head>

    <title>Cart</title>
</head>
<body>
    <h1>Check Out</h1>
    <p><?= $this->session->flashdata('delete_success'); ?></p>
    <table>
        <tr>
            <th>Qty</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
<?php foreach ($products as $product) { ?>
        <tr>
            <td><?= $product['quantity']; ?></td>
            <td><?= $product['description']; ?></td>
            <td>$<?= $product['price']; ?></td>
            <td><a href='/products/delete/<?= $product['id'] ?>'>Delete</a></td>
       </tr>
<?php } ?>
        <tr>
            <td></td>
            <td>Total </td>
            <td><h4>$<?= $total['total_price']; ?></h4></td>
    </table>
    <h2>Billing Info</h2>
    <?= $this->session->flashdata('login_error'); ?>
    <form action='/products/checkout' method='post'>
        Name: <input type='text' name='name'><br>
        Address: <input type='text' name='address'><br>
        Card# <input type='text' name='card_number'><br>
        <input type='submit' value='Order'>
    </form>
    <br><a href='../products'>Back</a>
</body>
</html>