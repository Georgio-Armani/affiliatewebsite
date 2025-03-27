document.addEventListener('DOMContentLoaded', function() {
    // Performance monitoring
    const performance = {
        startTime: Date.now(),
        log: function(action) {
            console.log(`${action}: ${Date.now() - this.startTime}ms`);
        }
    };

    // State management
    const state = {
        filters: {
            category: null,
            maxPrice: 200
        }
    };

    // Initialize components
    initializeSidebar();
    initializePriceRange();
    initializeProductCards();

    function initializeSidebar() {
        document.querySelectorAll('[data-category]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const category = e.target.dataset.category;
                
                // Update active state
                document.querySelectorAll('[data-category]').forEach(el => 
                    el.classList.remove('active'));
                e.target.classList.add('active');

                // Update filters and apply
                state.filters.category = category;
                applyFilters();
            });
        });
    }

    function initializePriceRange() {
        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');

        if (priceRange && priceValue) {
            priceRange.addEventListener('input', (e) => {
                const value = e.target.value;
                priceValue.textContent = `€${value}`;
                state.filters.maxPrice = parseInt(value);
                applyFilters();
            });
        }
    }

    function initializeProductCards() {
        document.querySelectorAll('[data-product-id]').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const productId = e.target.dataset.productId;
                showProductDetails(productId);
            });
        });
    }

    async function applyFilters() {
        const startTime = performance.now();
        const productGrid = document.getElementById('product-grid');
        productGrid.classList.add('loading');

        const params = new URLSearchParams({
            category: state.filters.category || '',
            maxPrice: state.filters.maxPrice
        });

        try {
            const response = await fetch(`./api/filter-products.php?${params}`);
            const data = await response.json();
            
            const productGrid = document.getElementById('product-grid');
            productGrid.innerHTML = data.html;
            
            initializeProductCards(); // Reinitialize cards after update
            
            performance.log('Filter application completed');
        } catch (error) {
            console.error('Error applying filters:', error);
            productGrid.innerHTML = '<div class="alert alert-danger">Error loading products. Please try again.</div>';
        } finally {
            productGrid.classList.remove('loading');
            console.log(`Filter operation took ${performance.now() - startTime}ms`);
        }
    }

    function showProductDetails(productId) {
        // To be implemented in future phase
        console.log(`Show details for product ${productId}`);
    }

    // Cross-browser compatibility checks
    function checkBrowserCompatibility() {
        const features = {
            fetch: 'fetch' in window,
            customElements: 'customElements' in window,
            cssGrid: CSS.supports('display', 'grid')
        };

        const incompatibleFeatures = Object.entries(features)
            .filter(([, supported]) => !supported)
            .map(([feature]) => feature);

        if (incompatibleFeatures.length > 0) {
            console.warn('Browser compatibility issues:', incompatibleFeatures);
        }
    }

    checkBrowserCompatibility();
});
