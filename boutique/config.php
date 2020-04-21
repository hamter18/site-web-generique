<?php
	require_once "../boutique/stripe-php-master/init.php";
	require_once "../boutique/products.php";

	$stripeDetails = array(
		"secretKey" => "sk_test_AdvSQ05afdUwHp7W37t4ojKF00DA1gvJHj",
		"publishableKey" => "pk_test_IXP1ySPsiWyzc7XN53z7W1sl00D9PilPDB"
	);

	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	\Stripe\Stripe::setApiKey($stripeDetails['publishableKey']);
?>
