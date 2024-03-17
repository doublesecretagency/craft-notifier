// Control behavior of nested checkboxes
window.nestedCheckboxes = {

    // Toggle nested checkboxes when parent is checked/unchecked
    toggleGroup: function(el, group) {
        // Get children of specified group
        const $children = $(`[data-group="${group}"]`);
        // If parent is checked
        if (el.checked) {
            // Enable children
            $children.prop('disabled', false);
        } else {
            // Disable children
            $children.prop('checked', false).prop('disabled', true);
        }
        // Update "Select All" label
        this.updateSelectAllLabel('.nested-checkboxes');
    },

    // Update "Select All" label
    updateSelectAllLabel: function(selector) {
        // Get specified container
        const $container = $(selector);
        // Get "Select All" link
        const $selectAll = $container.find('.select-all');
        // Get children of specified container
        const $children = $container.find('input[type="checkbox"]');
        // Whether any checkboxes are unchecked
        const isUnchecked = $children.is(':not(:checked)');
        // Set link text based on whether any boxes are unchecked
        $selectAll.text(isUnchecked ? 'Select All' : 'Deselect All');
    },

    // Select (or deselect) all
    selectAll: function(selector) {
        // Get specified container
        const $container = $(selector);
        // Get children of specified container
        const $children = $container.find('input[type="checkbox"]');
        // Whether any checkboxes are unchecked
        const isUnchecked = $children.is(':not(:checked)');
        // If any boxes are unchecked
        if (isUnchecked) {
            // Check all checkboxes
            $children.prop('checked', true);
            // Enable child checkboxes
            $children.filter('.checkbox-child').prop('disabled', false);
        } else {
            // Uncheck all checkboxes
            $children.prop('checked', false);
            // Disable child checkboxes
            $children.filter('.checkbox-child').prop('disabled', true);
        }
        // Update "Select All" label
        this.updateSelectAllLabel(selector);
    },

}
