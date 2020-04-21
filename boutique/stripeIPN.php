<?php
require_once "../boutique/config.php";

\Stripe\Stripe::setVerifySslCerts(false);

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$productID = $_GET['id'];
$prix = $_GET['prix'];

if (!isset($_POST['stripeToken']) || !isset($products[$productID])) {
	header("Location: paiement.php");
	exit();
}

$token = $_POST['stripeToken'];
$email = $_POST["stripeEmail"];
$card = $_POST["stripeTokenType"];

$charge = \Stripe\Charge::create(array(
	"amount" => $prix,
	"currency" => "eur",
	"description" => "panier",
	"source" => $token,
));

//print_r($_POST);
header("Location: recapitulatif.php?cb=y");
