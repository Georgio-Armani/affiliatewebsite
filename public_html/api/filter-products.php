<?php
require_once '../../includes/config/config.php';
require_once '../../includes/utils/ProductService.php';
require_once '../../includes/components/product-card.php';

header('Content-Type: application/json');

$filters = [
    'category' => $_GET['category'] ?? null,
    'maxPrice' => isset($_GET['maxPrice']) ? floatval($_GET['maxPrice']) : null
];

$productService = new ProductService(PRODUCTS_FILE);
$filteredProducts = $productService->getProducts($filters);

$html = '';
foreach ($filteredProducts as $product) {
    $html .= renderProductCard($product);
}

echo json_encode(['html' => $html]);
