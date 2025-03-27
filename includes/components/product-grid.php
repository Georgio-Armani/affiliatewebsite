<?php
require_once __DIR__ . '/product-card.php';
require_once __DIR__ . '/../utils/ProductService.php';

$productService = new ProductService(PRODUCTS_FILE);
$products = $productService->getProducts();
?>

<div class="container py-4">
    <div class="row" id="product-grid">
        <?php foreach ($products as $product): ?>
            <?php echo renderProductCard($product); ?>
        <?php endforeach; ?>
    </div>
</div>
