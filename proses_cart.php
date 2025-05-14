<?php
session_start();
$id = $_POST['id'];
$action = $_POST['action'];

switch ($action) {
  case 'add':
    if (isset($_SESSION['cart'][$id])) {
      $_SESSION['cart'][$id]++;
    } else {
      $_SESSION['cart'][$id] = 1;
    }
    break;

  case 'update':
    $qty = max(1, intval($_POST['qty']));
    $_SESSION['cart'][$id] = $qty;
    break;

  case 'delete':
    unset($_SESSION['cart'][$id]);
    break;
}

header('Location: cart.php');
exit();
