<?php
 
$client = new SoapClient("https://api.bongous.com/services/v4?wsdl");
$request = (object) array(
    'partnerKey' => '8b7d1b6ed6416d014f7fac96755f9e81', // please your partner key
    'language' => 'en',
    'shipmentOriginCountry' => 'US',
    'shipmentDestinationCountry' => 'ES',
    'domesticShippingCost' => '0',
    'insuranceFlag' => '1',
    'currency' => '1',
    'currencyConversionRate' => '',
    'privateIndividuals' => '',
    'service' => '1',
    'items' => array(
        array(
            'productID' => 'DVD-MATRIX',
            'quantity' => 1,
            'price' => 1,
        )
    )
);
$response = $client->ConnectLandedCost($request);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PHP Page</title>
    </head>
    <body>
        <h1>ConnectLandedCost</h1>
        <br /><strong>Error:</strong> <?php echo $response->error ?>
        <br /><strong>ErrorMessage:</strong> <?php echo $response->errorMessage ?>
        <br /><strong>ErrorMessageDetail:</strong> <?php echo $response->errorMessageDetail ?>
        <br /><strong>Items:</strong> <?php echo print_r($response->items, true) ?>
        <br /><strong>DutyCost:</strong> <?php echo $response->dutyCost ?>
        <br /><strong>TaxCost:</strong> <?php echo $response->taxCost ?>
        <br /><strong>ShippingCost:</strong> <?php echo $response->shippingCost ?>
        <br /><strong>InsuranceCost:</strong> <?php echo $response->insuranceCost ?>
        <br /><strong>CurrencyCode:</strong> <?php echo $response->currencyCode ?>
        <br /><strong>DdpAvailable:</strong> <?php echo $response->ddpAvailable ?>
        <br /><strong>BongoExtendSignUp:</strong> <?php echo $response->bongoExtendSignUp ?>
        <br /><strong>LandedCostTransactionId:</strong> <?php echo $response->landedCostTransactionId ?>
    </body>
</html>