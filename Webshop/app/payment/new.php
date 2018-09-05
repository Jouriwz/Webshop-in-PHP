<?php

try {

    // transaction starten
    $connection = db();
    $connection->beginTransaction();

    // user aanmaken
    $query = 'INSERT INTO `users`
    (first_name, suffix_name, last_name, country, city, street, street_number, street_suffix, zipcode, email, password, created_at, updated_at)
    VALUES
    (:first_name, :suffix_name, :last_name, :country, :city, :street, :street_number, :street_suffix, :zipcode, :email, :password, :created_at, :updated_at)';

    $data = [
        'first_name' => standardizeName($_POST['first_name']),
        'suffix_name' => trim($_POST['suffix_name']),
        'last_name' => standardizeName($_POST['last_name']),
        'country' => $_POST['country'],
        'city' => standardizeName($_POST['city']),
        'street' => standardizeName($_POST['street']),
        'street_number' => $_POST['street_number'],
        'street_suffix' => $_POST['street_suffix'],
        'zipcode' => standardizePostcode($_POST['zipcode']),
        'email' => strtolower($_POST['email']),
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];


    $products = $connection->prepare($query); // query voorbereiden
    $products->execute($data);

    $userId = $connection->lastInsertId();


    // order aanmaken
    $query = 'INSERT INTO `orders`
    (amount, payment_status, user_id, created_at, updated_at)
    VALUES
    (:amount, :payment_status, :user_id, :created_at, :updated_at)';

    $products = $connection->prepare($query); // query voorbereiden
    $products->execute([
        'amount' => $_SESSION['cart']['total'],
        'payment_status' => 'open',
        'user_id' => $userId,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);

    $userId = $connection->lastInsertId();

    $query = 'INSERT INTO orders_products
    (order_id, product_id, price, quantity, created_at, updated_at)
    VALUES
    (:order_id, :product_id, :price, :quantity, :created_at, :updated_at)';

    foreach ($_SESSION['cart']['products'] as $id => $product) {

        $products = $connection->prepare($query); // query voorbereiden
        $products->execute([
            'order_id' => $userId,
            'product_id' => $product['id'],
            'price' => $product['price'],
            'quantity' => $product['quantity'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // mollie betaling

    // order updaten met mollie feedback
    // dd('no commit');
    // transaction commit
    $connection->commit();

    // doorsturen naar betaling gelukt/mislukt

}
catch(Exception $e) {

    // transaction rollback
    $connection->rollBack();

    dd($e->getMessage());
}


function standardizePostcode($postcode)
{
    return strtoupper(chunk_split($postcode, 4, ' '));
}


function standardizeName($string)
{
    return ucfirst(trim($string));
}
