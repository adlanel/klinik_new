/**
 * Alpine.js Dropdown Fix
 * 
 * This script fixes issues with Alpine.js dropdowns that might:
 * 1. Not appear due to z-index issues
 * 2. Get cut off at the bottom of the page
 * 3. Not initialize properly if Alpine.js loads late
 */
document.addEventListener('DOMContentLoaded', function() {
    // Give time for Alpine to load if it hasn't already
    setTimeout(function() {
        // Make sure Alpine.js is loaded and initialized
        if (typeof window.Alpine === 'undefined') {
            console.warn('Alpine.js is not loaded. Loading it now...');
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js';
            script.defer = true;
            document.head.appendChild(script);
            
            script.onload = function() {
                console.log('Alpine.js loaded dynamically');
                if (typeof window.Alpine !== 'undefined') {
                    window.Alpine.start();
                    initializeAlpineDropdownFixes();
                }
            };
        } else {
            initializeAlpineDropdownFixes();
        }
    }, 100);
    
    function initializeAlpineDropdownFixes() {
        console.log('Initializing Alpine dropdown fixes');
        
        // Fix all dropdown toggle buttons to ensure they work
        document.querySelectorAll('[x-data]').forEach(container => {
            if (container.getAttribute('x-data').includes('open')) {
                // Select all buttons that toggle dropdowns
                const toggleButtons = container.querySelectorAll('button[\\@click*="open"]');
                toggleButtons.forEach(button => {
                    // Ensure these buttons toggle dropdowns properly
                    button.addEventListener('click', function() {
                        setTimeout(checkDropdownPosition, 20);
                    });
                });
                
                // Find the dropdown element
                const dropdown = container.querySelector('[x-show]');
                if (dropdown) {
                    // Apply high z-index to ensure visibility
                    if (!dropdown.style.zIndex || parseInt(dropdown.style.zIndex) < 50) {
                        dropdown.style.zIndex = "50";
                    }
                    
                    // Make sure it has display:none by default
                    dropdown.style.display = "none";
                }
            }
        });
        
        // Fix for dropdowns that might get cut off at the bottom of the page
        function checkDropdownPosition() {
            document.querySelectorAll('[x-show]:not([style*="display: none"])').forEach(dropdown => {
                const rect = dropdown.getBoundingClientRect();
                
                // If the dropdown would overflow the bottom of the viewport
                if (rect.bottom + 20 > window.innerHeight) {
                    dropdown.classList.add('dropdown-menu-up');
                    dropdown.style.bottom = "100%";
                    dropdown.style.top = "auto";
                    dropdown.style.marginTop = "0";
                    dropdown.style.marginBottom = "0.25rem";
                } else {
                    dropdown.classList.remove('dropdown-menu-up');
                    dropdown.style.bottom = "";
                    dropdown.style.top = "";
                    dropdown.style.marginTop = "";
                    dropdown.style.marginBottom = "";
                }
            });
        }
        
        // Check dropdown positions on window resize
        window.addEventListener('resize', checkDropdownPosition);
        
        // Initial check for all dropdowns
        setTimeout(checkDropdownPosition, 100);
    }
});