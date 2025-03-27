<?php
$categories = json_decode(file_get_contents(CATEGORIES_FILE), true)['categories'];
?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">Categories</h6>
        <ul class="nav flex-column">
            <?php foreach ($categories as $category): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-category="<?php echo htmlspecialchars($category['id']); ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">Price Range</h6>
        <div class="price-range">
            <input type="range" class="form-range" id="priceRange" min="0" max="200" step="10">
            <div class="d-flex justify-content-between">
                <span>€0</span>
                <span id="priceValue">€100</span>
                <span>€200</span>
            </div>
        </div>
    </div>
</nav>
