<?php

require_once __DIR__ . '/../vendor/autoload.php';

$catalogue = new FileSystemCatalogue();

?>
<html>

<body>

<ul>
    <?php foreach ($catalogue->getAllProducts() as $product) : ?>
        <li class="product"><?= $product->getSku() ?> <a href="/basket.php?add=<?= urlencode($product->getSku()) ?>">Add to Basket</a></li>
    <?php endforeach; ?>
</ul>

</body>

</html>