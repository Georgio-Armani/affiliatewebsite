<?php
require_once '../includes/config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Recommendations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include BASE_PATH . '/includes/components/header.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php include BASE_PATH . '/includes/components/sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php include BASE_PATH . '/includes/components/product-grid.php'; ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
