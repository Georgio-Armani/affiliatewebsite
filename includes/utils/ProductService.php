<?php
require_once __DIR__ . '/Cache.php';

class ProductService {
    private $productsFile;
    private $cache;
    
    public function __construct($productsFile) {
        $this->productsFile = $productsFile;
        $this->cache = new Cache();
    }
    
    public function getProducts($filters = []) {
        $cacheKey = 'products_' . md5(serialize($filters));
        $cachedResult = $this->cache->get($cacheKey);
        
        if ($cachedResult !== null) {
            return $cachedResult;
        }
        
        $products = json_decode(file_get_contents($this->productsFile), true)['products'];
        
        if (empty($filters)) {
            $this->cache->set($cacheKey, $products);
            return $products;
        }
        
        $filtered = array_filter($products, function($product) use ($filters) {
            $matches = true;
            
            if (isset($filters['category'])) {
                $matches &= strtolower($product['category']) === strtolower($filters['category']);
            }
            
            if (isset($filters['maxPrice'])) {
                $matches &= $product['price'] <= $filters['maxPrice'];
            }
            
            return $matches;
        });
        
        $this->cache->set($cacheKey, $filtered);
        return $filtered;
    }
}
?>
