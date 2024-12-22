document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.whc-admin-tab');
    const sections = document.querySelectorAll('.whc-admin-section');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.target;
            
            // Update active tab
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            
            // Show target section
            sections.forEach(section => {
                section.style.display = section.id === target ? 'block' : 'none';
            });
        });
    });

    // Color picker initialization
    const colorPicker = document.querySelector('.whc-color-picker');
    if (colorPicker) {
        jQuery(colorPicker).wpColorPicker();
    }

    // Save settings with AJAX
    const form = document.querySelector('#whc-settings-form');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(form);
            try {
                const response = await fetch(ajaxurl, {
                    method: 'POST',
                    body: formData
                });
                
                if (response.ok) {
                    // Show success message
                }
            } catch (error) {
                // Show error message
            }
        });
    }
});