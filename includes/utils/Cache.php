<?php
class Cache {
    private $cacheDir;
    
    public function __construct() {
        $this->cacheDir = dirname(dirname(__DIR__)) . '/cache';
        if (!file_exists($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }
    
    public function get($key) {
        $filename = $this->cacheDir . '/' . md5($key) . '.cache';
        if (file_exists($filename) && (time() - filemtime($filename)) < 3600) {
            return unserialize(file_get_contents($filename));
        }
        return null;
    }
    
    public function set($key, $value, $ttl = 3600) {
        $filename = $this->cacheDir . '/' . md5($key) . '.cache';
        return file_put_contents($filename, serialize($value));
    }
}
?>
