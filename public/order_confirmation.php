<?php
session_start();
require '../pdo.php';
require '../functions.php';

$title = 'Confirmation';
$mainClass='confirm';


if (isset($_POST['delivery_add_street']) && isset($_POST['delivery_add_county']) && isset($_POST['delivery_add_postcode']) && isset($_POST['delivery_add_country']) && isset($_POST['card_name']) && isset($_POST['card_number']) && isset($_POST['card_exp_date']) && isset($_POST['card_cvv']) && isset($_POST['phone_number'])) {
        
    foreach ($_SESSION['bag'] as $item) {
        $prodid = $item['prodid'];
        $totalprice = $_POST['totalPrice'];
        $quantity = $item['quantity'];
        /* $billing_add_house_number = $item['billing_add_house_number'];
        $billing_add_street = $item['billing_add_street'];
        $billing_add_county = $item['billing_add_county'];
        $billing_add_postcode = $item['billing_add_postcode'];
        $billing_add_country = $item['billing_add_country'];
        $delivery_add_house_number = $item['delivery_add_house_number']; */    
    }

    $values = [
        'prodid'=>$prodid,
        'delivery_add_street' => $_POST['delivery_add_street'],
        'delivery_add_county' => $_POST['delivery_add_county'],
        'delivery_add_postcode' => $_POST['delivery_add_postcode'],
        'delivery_add_country' => $_POST['delivery_add_country'],
        'price'=>$totalprice,
        'card_name' => $_POST['card_name'],
        'card_number' => $_POST['card_number'],
        'card_exp_date' => $_POST['card_exp_date'],
        'card_cvv' => $_POST['card_cvv'],
        'phone_number' => $_POST['phone_number'],
        'userid'=>$_SESSION['login']
    ];



    $result = insert($pdo, 'order', $values);

    if ($result) {
        $_SESSION['bag'] = [];
        exit();
    } else {
        // Error occurred while inserting the order details
        echo "An error occurred while placing the order.";
    }
}else{

    $output = loadTemplate('../templates/checkout.html.php', []);

}

$output=loadTemplate('../templates/orderconfirmation.html.php', []);

require '../templates/mainTemp.html.php';
?>