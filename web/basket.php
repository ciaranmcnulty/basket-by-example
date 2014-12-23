<?php

require_once __DIR__ . '/../vendor/autoload.php';

$catalogue = new FileSystemCatalogue();

$basket = new Basket(new DeliveryCostCalculator());
$basket->addProductFromCatalogue(Sku::fromString($_GET['add']), $catalogue);

?>
<html>
<head>
    <meta charset="utf-8" />
</head>
    Total cost: £<?= $basket->getTotalCost(); ?>
</html>