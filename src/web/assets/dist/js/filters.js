/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./web/assets/src/js/filters.js":
/*!**************************************!*\
  !*** ./web/assets/src/js/filters.js ***!
  \**************************************/
/***/ (() => {

/**
 * Largely copied from:
 * https://github.com/craftcms/webhooks/blob/3.x/src/assets/edit/dist/js/EditWebhook.js
 */

(function ($) {
  /** global: Craft */
  /** global: Garnish */
  var EditWebhook = Garnish.Base.extend({
    $nameInput: null,
    $classInput: null,
    $eventInput: null,
    $filterSpinner: null,
    $noFiltersMessage: null,
    $filtersTable: null,
    filters: null,
    matchingFilters: null,
    classVal: null,
    eventVal: null,
    filterTimeout: null,
    init: function init() {
      this.$nameInput = $('#name');
      this.$classInput = $('#class');
      this.$eventInput = $('#event');
      this.$filterSpinner = $('#filter-spinner');
      this.$noFiltersMessage = $('#no-filters');
      this.$filtersTable = $('#filters');
      this.filters = {};
      this.matchingFilters = [];
      var $filterRows = this.$filtersTable.find('tr');
      for (var i = 0; i < $filterRows.length; i++) {
        var filter = new EditWebhook.Filter(this, $filterRows.eq(i));
        this.filters[filter["class"]] = filter;
        if (!filter.$tr.hasClass('hidden')) {
          this.matchingFilters.push(filter);
        }
      }
      this.applyExclusions();
      this.addListener(this.$nameInput, 'change, keyup', 'handleTextChange');
      this.addListener(this.$classInput, 'change, keyup, blur', 'handleEventChange');
      this.addListener(this.$eventInput, 'change, keyup, blur', 'handleEventChange');
    },
    handleTextChange: function handleTextChange() {
      var input = this.$nameInput.get(0);

      // does it look like they just typed -> or => ?
      if (typeof input.selectionStart !== 'undefined' && input.selectionStart === input.selectionEnd) {
        var pos = input.selectionStart;
        var last2 = input.value.substring(pos - 2, pos);
        if (last2 === '->' || last2 === '=>') {
          input.value = input.value.substring(0, pos - 2) + '➡️' + input.value.substring(pos);
          input.setSelectionRange(pos, pos);
        }
      }
    },
    handleEventChange: function handleEventChange() {
      var classChanged = this.classVal !== (this.classVal = this.$classInput.val());
      var eventChanged = this.eventVal !== (this.eventVal = this.$eventInput.val());
      if (classChanged || eventChanged) {
        clearTimeout(this.filterTimeout);
        this.filterTimeout = setTimeout(this.updateFilters.bind(this), 500);
      }
    },
    updateFilters: function updateFilters() {
      var _this = this;
      if (!this.classVal || !this.eventVal) {
        return;
      }
      this.$filterSpinner.removeClass('hidden');
      Craft.sendActionRequest('POST', 'webhooks/webhooks/filters', {
        data: {
          senderClass: this.classVal,
          event: this.eventVal
        }
      }).then(function (response) {
        _this.resetFilters();
        if (response.data.filters.length) {
          _this.$noFiltersMessage.addClass('hidden');
          _this.$filtersTable.removeClass('hidden');
          for (var i = 0; i < response.data.filters.length; i++) {
            var filter = _this.filters[response.data.filters[i]];
            _this.matchingFilters.push(filter);
            filter.enable();
            filter.$tr.removeClass('hidden');
          }
          _this.applyExclusions();
        } else {
          _this.$noFiltersMessage.removeClass('hidden');
          _this.$filtersTable.addClass('hidden');
        }
      })["finally"](function () {
        _this.$filterSpinner.addClass('hidden');
      });
    },
    resetFilters: function resetFilters() {
      this.matchingFilters = [];
      for (var filter in this.filters) {
        if (!this.filters.hasOwnProperty(filter)) {
          continue;
        }
        this.filters[filter].$tr.addClass('hidden');
        this.filters[filter].selectIgnore(false);
      }
    },
    applyExclusions: function applyExclusions() {
      var _this2 = this;
      this.matchingFilters.forEach(function (f) {
        f.enable();
      });
      this.matchingFilters.filter(function (f) {
        return f.value === true;
      }).forEach(function (f) {
        f.excludes.forEach(function (e) {
          if (_this2.filters[e]) {
            _this2.filters[e].disable();
          }
        });
      });
    }
  });
  EditWebhook.Filter = Garnish.Base.extend({
    manager: null,
    $tr: null,
    $input: null,
    "class": null,
    $btnGroup: null,
    $noBtn: null,
    $ignoreBtn: null,
    $yesBtn: null,
    value: null,
    enabled: false,
    init: function init(manager, $tr) {
      this.manager = manager;
      this.$tr = $tr;
      this["class"] = $tr.data('class');
      this.$btnGroup = this.$tr.find('.btngroup');
      this.$noBtn = this.$btnGroup.find('.filter-no');
      this.$ignoreBtn = this.$btnGroup.find('.filter-ignore');
      this.$yesBtn = this.$btnGroup.find('.filter-yes');
      this.$input = $tr.find('input');
      switch (this.$input.val()) {
        case 'yes':
          this.selectYes();
          break;
        case 'no':
          this.selectNo();
          break;
      }
      this.enable();
    },
    /**
     * @returns {string[]}
     */
    get excludes() {
      return this.$tr.data('excludes');
    },
    enable: function enable() {
      if (!this.enabled) {
        this.addListener(this.$btnGroup, 'keydown', 'handleKeydown');
        this.addListener(this.$noBtn, 'click', 'selectNo');
        this.addListener(this.$ignoreBtn, 'click', 'selectIgnore');
        this.addListener(this.$yesBtn, 'click', 'selectYes');
        this.$tr.removeClass('disabled');
        this.$btnGroup.attr('tabindex', '0');
        this.enabled = true;
      }
    },
    disable: function disable() {
      if (this.enabled) {
        this.selectIgnore(false);
        this.removeAllListeners(this.$btnGroup);
        this.removeAllListeners(this.$noBtn);
        this.removeAllListeners(this.$ignoreBtn);
        this.removeAllListeners(this.$yesBtn);
        this.$tr.addClass('disabled');
        this.$btnGroup.attr('tabindex', '-1');
        this.enabled = false;
      }
    },
    /**
     * @param {boolean|null} value
     * @param {boolean} [applyExclusions=true]
     */
    setValue: function setValue(value, applyExclusions) {
      this.value = value;
      if (applyExclusions !== false) {
        this.manager.applyExclusions();
      }
    },
    /**
     * @param {boolean} [applyExclusions=true]
     */
    selectNo: function selectNo(applyExclusions) {
      this.clear();
      this.$noBtn.addClass('active');
      this.setValue(false, applyExclusions);
      this.$input.val('no');
    },
    /**
     * @param {boolean} [applyExclusions=true]
     */
    selectIgnore: function selectIgnore(applyExclusions) {
      this.clear();
      this.$ignoreBtn.addClass('active');
      this.setValue(null, applyExclusions);
      this.$input.val('');
    },
    /**
     * @param {boolean} [applyExclusions=true]
     */
    selectYes: function selectYes(applyExclusions) {
      this.clear();
      this.$yesBtn.addClass('active');
      this.setValue(true, applyExclusions);
      this.$input.val('yes');
    },
    clear: function clear() {
      this.$yesBtn.removeClass('active');
      this.$ignoreBtn.removeClass('active');
      this.$noBtn.removeClass('active');
    },
    handleKeydown: function handleKeydown(ev) {
      switch (ev.keyCode) {
        case Garnish.LEFT_KEY:
          ev.preventDefault();
          if (this.value === null) {
            this.selectNo();
          } else if (this.value === true) {
            this.selectIgnore();
          }
          break;
        case Garnish.RIGHT_KEY:
          ev.preventDefault();
          if (this.value === null) {
            this.selectYes();
          } else if (this.value === false) {
            this.selectIgnore();
          }
      }
    }
  });
  Garnish.$doc.ready(function () {
    new EditWebhook();
  });
})(jQuery);

/***/ }),

/***/ "./web/assets/src/sass/filters.scss":
/*!******************************************!*\
  !*** ./web/assets/src/sass/filters.scss ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./web/assets/src/sass/log.scss":
/*!**************************************!*\
  !*** ./web/assets/src/sass/log.scss ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./web/assets/src/sass/nested-checkboxes.scss":
/*!****************************************************!*\
  !*** ./web/assets/src/sass/nested-checkboxes.scss ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/web/assets/dist/js/filters": 0,
/******/ 			"web/assets/dist/css/nested-checkboxes": 0,
/******/ 			"web/assets/dist/css/log": 0,
/******/ 			"web/assets/dist/css/filters": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["web/assets/dist/css/nested-checkboxes","web/assets/dist/css/log","web/assets/dist/css/filters"], () => (__webpack_require__("./web/assets/src/js/filters.js")))
/******/ 	__webpack_require__.O(undefined, ["web/assets/dist/css/nested-checkboxes","web/assets/dist/css/log","web/assets/dist/css/filters"], () => (__webpack_require__("./web/assets/src/sass/filters.scss")))
/******/ 	__webpack_require__.O(undefined, ["web/assets/dist/css/nested-checkboxes","web/assets/dist/css/log","web/assets/dist/css/filters"], () => (__webpack_require__("./web/assets/src/sass/log.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["web/assets/dist/css/nested-checkboxes","web/assets/dist/css/log","web/assets/dist/css/filters"], () => (__webpack_require__("./web/assets/src/sass/nested-checkboxes.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;