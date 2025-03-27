<?php
function renderProductCard($product) {
    return sprintf(
        '<div class="col-md-4 mb-4">
            <div class="card product-card">
                <div class="card-body">
                    <h5 class="card-title">%s</h5>
                    <p class="card-text">€%.2f</p>
                    <span class="badge bg-primary">%s</span>
                    <a href="#" class="btn btn-primary mt-2" data-product-id="%d">View Details</a>
                </div>
            </div>
        </div>',
        htmlspecialchars($product['name']),
        $product['price'],
        htmlspecialchars($product['category']),
        $product['id']
    );
}
?>
