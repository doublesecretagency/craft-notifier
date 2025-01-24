/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./web/assets/src/js/nested-checkboxes.js ***!
  \************************************************/
// Control behavior of nested checkboxes
window.nestedCheckboxes = {
  // Toggle nested checkboxes when parent is checked/unchecked
  toggleGroup: function toggleGroup(el, type, group) {
    // Get children of specified group
    var $children = $("[data-group=\"".concat(type, "-").concat(group, "\"]"));
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
  updateSelectAllLabel: function updateSelectAllLabel(selector) {
    // Get specified container
    var $container = $(selector);
    // Get "Select All" link
    var $selectAll = $container.find('.select-all');
    // Get children of specified container
    var $children = $container.find('input[type="checkbox"]');
    // Whether any checkboxes are unchecked
    var isUnchecked = $children.is(':not(:checked)');
    // Set link text based on whether any boxes are unchecked
    $selectAll.text(isUnchecked ? 'Select All' : 'Deselect All');
  },
  // Select (or deselect) all
  selectAll: function selectAll(selector) {
    // Get specified container
    var $container = $(selector);
    // Get children of specified container
    var $children = $container.find('input[type="checkbox"]');
    // Whether any checkboxes are unchecked
    var isUnchecked = $children.is(':not(:checked)');
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
  }
};
/******/ })()
;