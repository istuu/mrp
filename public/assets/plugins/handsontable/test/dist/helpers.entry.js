/*!
 * (The MIT License)
 * 
 * Copyright (c) 2012-2014 Marcin Warpechowski
 * Copyright (c) 2015 Handsoncode sp. z o.o. <hello@handsoncode.net>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * 'Software'), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 * 
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * 
 * Version: 0.35.0
 * Release date: 06/12/2017 (built at 06/12/2017 12:17:14)
 */
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 76);
/******/ })
/************************************************************************/
/******/ ({

/***/ 76:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _window = __webpack_require__(77);

var _window2 = _interopRequireDefault(_window);

var _common = __webpack_require__(78);

var common = _interopRequireWildcard(_common);

var _jasmine = __webpack_require__(79);

var jasmine = _interopRequireWildcard(_jasmine);

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } else { var newObj = {}; if (obj != null) { for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) newObj[key] = obj[key]; } } newObj.default = obj; return newObj; } }

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var exportToWindow = function exportToWindow(helpersHolder) {
  Object.keys(helpersHolder).forEach(function (key) {
    if (key === '__esModule') {
      return;
    }

    if (_window2.default[key] !== void 0) {
      throw Error('Cannot export "' + key + '" helper because this name is already assigned.');
    }

    _window2.default[key] = helpersHolder[key];
  });
};

// Export all helpers to the window.
/* eslint-disable import/no-unresolved */
exportToWindow(common);
exportToWindow(jasmine);

/***/ }),

/***/ 77:
/***/ (function(module, exports) {

module.exports = window;

/***/ }),

/***/ 78:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


exports.__esModule = true;
exports.sleep = sleep;
exports.hot = hot;
exports.handsontable = handsontable;
exports.getHtCore = getHtCore;
exports.getTopClone = getTopClone;
exports.getTopLeftClone = getTopLeftClone;
exports.getLeftClone = getLeftClone;
exports.getBottomClone = getBottomClone;
exports.getBottomLeftClone = getBottomLeftClone;
exports.countCells = countCells;
exports.isEditorVisible = isEditorVisible;
exports.isFillHandleVisible = isFillHandleVisible;
exports.getCorrespondingOverlay = getCorrespondingOverlay;
exports.contextMenu = contextMenu;
exports.closeContextMenu = closeContextMenu;
exports.dropdownMenu = dropdownMenu;
exports.closeDropdownMenu = closeDropdownMenu;
exports.dropdownMenuRootElement = dropdownMenuRootElement;
exports.handsontableMouseTriggerFactory = handsontableMouseTriggerFactory;
exports.mouseDoubleClick = mouseDoubleClick;
exports.handsontableKeyTriggerFactory = handsontableKeyTriggerFactory;
exports.keyDownUp = keyDownUp;
exports.keyProxy = keyProxy;
exports.serveImmediatePropagation = serveImmediatePropagation;
exports.autocompleteEditor = autocompleteEditor;
exports.setCaretPosition = setCaretPosition;
exports.autocomplete = autocomplete;
exports.triggerPaste = triggerPaste;
exports.handsontableMethodFactory = handsontableMethodFactory;
exports.colWidth = colWidth;
exports.rowHeight = rowHeight;
exports.getRenderedValue = getRenderedValue;
exports.getRenderedContent = getRenderedContent;
exports.createNumericData = createNumericData;
exports.Model = Model;
exports.createAccessorForProperty = createAccessorForProperty;
exports.resizeColumn = resizeColumn;
exports.resizeRow = resizeRow;
exports.moveSecondDisplayedRowBeforeFirstRow = moveSecondDisplayedRowBeforeFirstRow;
exports.moveFirstDisplayedRowAfterSecondRow = moveFirstDisplayedRowAfterSecondRow;
exports.swapDisplayedColumns = swapDisplayedColumns;
exports.triggerTouchEvent = triggerTouchEvent;
function sleep() {
  var delay = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 100;

  return Promise.resolve({
    then: function then(resolve) {
      setTimeout(resolve, delay);
    }
  });
};

function hot() {
  return spec().$container.data('handsontable');
};

function handsontable(options) {
  var currentSpec = spec();

  currentSpec.$container.handsontable(options);
  currentSpec.$container[0].focus(); // otherwise TextEditor tests do not pass in IE8

  return currentSpec.$container.data('handsontable');
};

/**
 * As for v. 0.11 the only scrolling method is native scroll, which creates copies of main htCore table inside of the container.
 * Therefore, simple $(".htCore") will return more than one object. Most of the time, you're interested in the original
 * htCore, not the copies made by native scroll.
 *
 * This method returns the original htCore object
 *
 * @returns {jqObject} reference to the original htCore
 */

function getHtCore() {
  return spec().$container.find('.htCore').first();
};

function getTopClone() {
  return spec().$container.find('.ht_clone_top');
};

function getTopLeftClone() {
  return spec().$container.find('.ht_clone_top_left_corner');
};
// for compatybility
// var getCornerClone = getTopLeftClone;

function getLeftClone() {
  return spec().$container.find('.ht_clone_left');
};

function getBottomClone() {
  return spec().$container.find('.ht_clone_bottom');
};

function getBottomLeftClone() {
  return spec().$container.find('.ht_clone_bottom_left_corner');
};

// Rename me to countTD
function countCells() {
  return getHtCore().find('tbody td').length;
};

function isEditorVisible() {
  return !!(keyProxy().is(':visible') && keyProxy().parent().is(':visible') && !keyProxy().parent().is('.htHidden'));
};

function isFillHandleVisible() {
  return !!spec().$container.find('.wtBorder.corner:visible').length;
};

function getCorrespondingOverlay(cell, container) {
  var overlay = $(cell).parents('.handsontable');

  if (overlay[0] == container[0]) {
    return $('.ht_master');
  }

  return $(overlay[0]);
};

/**
 * Shows context menu
 */
function contextMenu(cell) {
  var hot = spec().$container.data('handsontable');
  var selected = hot.getSelected();

  if (!selected) {
    hot.selectCell(0, 0);
    selected = hot.getSelected();
  }
  if (!cell) {
    cell = getCell(selected[0], selected[1]);
  }
  var cellOffset = $(cell).offset();

  $(cell).simulate('contextmenu', {
    clientX: cellOffset.left - Handsontable.dom.getWindowScrollLeft(),
    clientY: cellOffset.top - Handsontable.dom.getWindowScrollTop()
  });
};

function closeContextMenu() {
  $(document).simulate('mousedown');
  //  $(document).trigger('mousedown');
};

/**
 * Shows dropdown menu
 */
function dropdownMenu(columnIndex) {
  var hot = spec().$container.data('handsontable');
  var th = hot.view.wt.wtTable.getColumnHeader(columnIndex || 0);
  var button = th.querySelector('.changeType');

  if (button) {
    $(button).simulate('mousedown');
    $(button).simulate('click');
  }
};

function closeDropdownMenu() {
  $(document).simulate('mousedown');
};

function dropdownMenuRootElement() {
  var plugin = hot().getPlugin('dropdownMenu');
  var root;

  if (plugin && plugin.menu) {
    root = plugin.menu.container;
  }

  return root;
};

/**
 * Returns a function that triggers a mouse event
 * @param {String} type Event type
 * @return {Function}
 */
function handsontableMouseTriggerFactory(type, button) {
  return function (element) {
    if (!(element instanceof jQuery)) {
      element = $(element);
    }
    var ev = $.Event(type);
    ev.which = button || 1; // left click by default

    element.simulate(type, ev);
  };
};

var mouseDown = exports.mouseDown = handsontableMouseTriggerFactory('mousedown');
var mouseMove = exports.mouseMove = handsontableMouseTriggerFactory('mousemove');
var mouseOver = exports.mouseOver = handsontableMouseTriggerFactory('mouseover');
var mouseUp = exports.mouseUp = handsontableMouseTriggerFactory('mouseup');

function mouseDoubleClick(element) {
  mouseDown(element);
  mouseUp(element);
  mouseDown(element);
  mouseUp(element);
};

var mouseRightDown = exports.mouseRightDown = handsontableMouseTriggerFactory('mousedown', 3);
var mouseRightUp = exports.mouseRightUp = handsontableMouseTriggerFactory('mouseup', 3);

/**
 * Returns a function that triggers a key event
 * @param {String} type Event type
 * @return {Function}
 */
function handsontableKeyTriggerFactory(type) {
  return function (key, extend) {
    var ev = {}; // $.Event(type);

    if (typeof key === 'string') {
      if (key.indexOf('shift+') > -1) {
        key = key.substring(6);
        ev.shiftKey = true;
      }

      if (key.indexOf('ctrl+') > -1) {
        key = key.substring(5);
        ev.ctrlKey = true;
        ev.metaKey = true;
      }

      switch (key) {
        case 'tab':
          ev.keyCode = 9;
          break;

        case 'enter':
          ev.keyCode = 13;
          break;

        case 'esc':
          ev.keyCode = 27;
          break;

        case 'f2':
          ev.keyCode = 113;
          break;

        case 'arrow_left':
          ev.keyCode = 37;
          break;

        case 'arrow_up':
          ev.keyCode = 38;
          break;

        case 'arrow_right':
          ev.keyCode = 39;
          break;

        case 'arrow_down':
          ev.keyCode = 40;
          break;

        case 'ctrl':
          ev.keyCode = 17;
          break;

        case 'shift':
          ev.keyCode = 16;
          break;

        case 'backspace':
          ev.keyCode = 8;
          break;

        case 'delete':
          ev.keyCode = 46;
          break;

        case 'space':
          ev.keyCode = 32;
          break;

        case 'x':
          ev.keyCode = 88;
          break;

        case 'c':
          ev.keyCode = 67;
          break;

        case 'v':
          ev.keyCode = 86;
          break;

        default:
          throw new Error('Unrecognised key name: ' + key);
      }
    } else if (typeof key === 'number') {
      ev.keyCode = key;
    }
    //    ev.originalEvent = {}; //needed as long Handsontable searches for event.originalEvent
    $.extend(ev, extend);
    $(document.activeElement).simulate(type, ev);
  };
};

var keyDown = exports.keyDown = handsontableKeyTriggerFactory('keydown');
var keyUp = exports.keyUp = handsontableKeyTriggerFactory('keyup');

/**
 * Presses keyDown, then keyUp
 */
function keyDownUp(key, extend) {
  if (typeof key === 'string' && key.indexOf('shift+') > -1) {
    keyDown('shift');
  }

  keyDown(key, extend);
  keyUp(key, extend);

  if (typeof key === 'string' && key.indexOf('shift+') > -1) {
    keyUp('shift');
  }
};

/**
 * Returns current value of the keyboard proxy textarea
 * @return {String}
 */
function keyProxy() {
  return spec().$container.find('textarea.handsontableInput');
};

function serveImmediatePropagation(event) {
  if (event != null && event.isImmediatePropagationEnabled == null) {
    event.stopImmediatePropagation = function () {
      this.isImmediatePropagationEnabled = false;
      this.cancelBubble = true;
    };
    event.isImmediatePropagationEnabled = true;
    event.isImmediatePropagationStopped = function () {
      return !this.isImmediatePropagationEnabled;
    };
  }

  return event;
};

function autocompleteEditor() {
  return spec().$container.find('.handsontableInput');
};

/**
 * Sets text cursor inside keyboard proxy
 */
function setCaretPosition(pos) {
  var el = keyProxy()[0];

  if (el.setSelectionRange) {
    el.focus();
    el.setSelectionRange(pos, pos);
  } else if (el.createTextRange) {
    var range = el.createTextRange();
    range.collapse(true);
    range.moveEnd('character', pos);
    range.moveStart('character', pos);
    range.select();
  }
};

/**
 * Returns autocomplete instance
 */
function autocomplete() {
  return spec().$container.find('.autocompleteEditor');
};

/**
 * Triggers paste string on current selection
 */
function triggerPaste(str) {
  spec().$container.data('handsontable').getPlugin('CopyPaste').paste(str);
};

/**
 * Calls a method in current Handsontable instance, returns its output
 * @param method
 * @return {Function}
 */
function handsontableMethodFactory(method) {
  return function () {
    var _instance;

    var instance;
    try {
      instance = spec().$container.handsontable('getInstance');
    } catch (err) {
      console.error(err);
    }

    if (instance) {
      if (method === 'destroy') {
        spec().$container.removeData();
      }
    } else {
      if (method === 'destroy') {
        return; // we can forgive this... maybe it was destroyed in the test
      }
      throw new Error('Something wrong with the test spec: Handsontable instance not found');
    }

    return (_instance = instance)[method].apply(_instance, arguments);
  };
};

var addHook = exports.addHook = handsontableMethodFactory('addHook');
var alter = exports.alter = handsontableMethodFactory('alter');
var colToProp = exports.colToProp = handsontableMethodFactory('colToProp');
var countCols = exports.countCols = handsontableMethodFactory('countCols');
var countRows = exports.countRows = handsontableMethodFactory('countRows');
var deselectCell = exports.deselectCell = handsontableMethodFactory('deselectCell');
var destroy = exports.destroy = handsontableMethodFactory('destroy');
var destroyEditor = exports.destroyEditor = handsontableMethodFactory('destroyEditor');
var getActiveEditor = exports.getActiveEditor = handsontableMethodFactory('getActiveEditor');
var getCell = exports.getCell = handsontableMethodFactory('getCell');
var getCellEditor = exports.getCellEditor = handsontableMethodFactory('getCellEditor');
var getCellMeta = exports.getCellMeta = handsontableMethodFactory('getCellMeta');
var getCellMetaAtRow = exports.getCellMetaAtRow = handsontableMethodFactory('getCellMetaAtRow');
var getCellRenderer = exports.getCellRenderer = handsontableMethodFactory('getCellRenderer');
var getCellsMeta = exports.getCellsMeta = handsontableMethodFactory('getCellsMeta');
var getCellValidator = exports.getCellValidator = handsontableMethodFactory('getCellValidator');
var getColHeader = exports.getColHeader = handsontableMethodFactory('getColHeader');
var getCopyableData = exports.getCopyableData = handsontableMethodFactory('getCopyableData');
var getCopyableText = exports.getCopyableText = handsontableMethodFactory('getCopyableText');
var getData = exports.getData = handsontableMethodFactory('getData');
var getDataAtCell = exports.getDataAtCell = handsontableMethodFactory('getDataAtCell');
var getDataAtCol = exports.getDataAtCol = handsontableMethodFactory('getDataAtCol');
var getDataAtRow = exports.getDataAtRow = handsontableMethodFactory('getDataAtRow');
var getDataAtRowProp = exports.getDataAtRowProp = handsontableMethodFactory('getDataAtRowProp');
var getDataType = exports.getDataType = handsontableMethodFactory('getDataType');
var getInstance = exports.getInstance = handsontableMethodFactory('getInstance');
var getRowHeader = exports.getRowHeader = handsontableMethodFactory('getRowHeader');
var getSelected = exports.getSelected = handsontableMethodFactory('getSelected');
var getSourceData = exports.getSourceData = handsontableMethodFactory('getSourceData');
var getSourceDataArray = exports.getSourceDataArray = handsontableMethodFactory('getSourceDataArray');
var getSourceDataAtCell = exports.getSourceDataAtCell = handsontableMethodFactory('getSourceDataAtCell');
var getSourceDataAtCol = exports.getSourceDataAtCol = handsontableMethodFactory('getSourceDataAtCol');
var getSourceDataAtRow = exports.getSourceDataAtRow = handsontableMethodFactory('getSourceDataAtRow');
var getValue = exports.getValue = handsontableMethodFactory('getValue');
var loadData = exports.loadData = handsontableMethodFactory('loadData');
var populateFromArray = exports.populateFromArray = handsontableMethodFactory('populateFromArray');
var propToCol = exports.propToCol = handsontableMethodFactory('propToCol');
var removeCellMeta = exports.removeCellMeta = handsontableMethodFactory('removeCellMeta');
var render = exports.render = handsontableMethodFactory('render');
var selectCell = exports.selectCell = handsontableMethodFactory('selectCell');
var setCellMeta = exports.setCellMeta = handsontableMethodFactory('setCellMeta');
var setDataAtCell = exports.setDataAtCell = handsontableMethodFactory('setDataAtCell');
var setDataAtRowProp = exports.setDataAtRowProp = handsontableMethodFactory('setDataAtRowProp');
var spliceCellsMeta = exports.spliceCellsMeta = handsontableMethodFactory('spliceCellsMeta');
var spliceCol = exports.spliceCol = handsontableMethodFactory('spliceCol');
var spliceRow = exports.spliceRow = handsontableMethodFactory('spliceRow');
var updateSettings = exports.updateSettings = handsontableMethodFactory('updateSettings');
var countSourceRows = exports.countSourceRows = handsontableMethodFactory('countSourceRows');
var countSourceCols = exports.countSourceCols = handsontableMethodFactory('countSourceCols');
var countEmptyRows = exports.countEmptyRows = handsontableMethodFactory('countEmptyRows');
var countEmptyCols = exports.countEmptyCols = handsontableMethodFactory('countEmptyCols');

/**
 * Returns column width for HOT container
 * @param $elem
 * @param col
 * @returns {Number}
 */
function colWidth($elem, col) {
  var TR = $elem[0].querySelector('TBODY TR');
  var cell;

  if (TR) {
    cell = TR.querySelectorAll('TD')[col];
  } else {
    cell = $elem[0].querySelector('THEAD TR').querySelectorAll('TH')[col];
  }

  if (!cell) {
    throw new Error('Cannot find table column of index \'' + col + '\'');
  }

  return cell.offsetWidth;
}

/**
 * Returns row height for HOT container
 * @param $elem
 * @param row
 * @returns {Number}
 */
function rowHeight($elem, row) {
  var TD;

  if (row >= 0) {
    TD = $elem[0].querySelector('tbody tr:nth-child(' + (row + 1) + ') td');
  } else {
    TD = $elem[0].querySelector('thead tr:nth-child(' + Math.abs(row) + ')');
  }

  if (!TD) {
    throw new Error('Cannot find table row of index \'' + row + '\'');
  }

  return Handsontable.dom.outerHeight(TD);
}

/**
 * Returns value that has been rendered in table cell
 * @param {Number} trIndex
 * @param {Number} tdIndex
 * @returns {String}
 */
function getRenderedValue(trIndex, tdIndex) {
  return spec().$container.find('tbody tr').eq(trIndex).find('td').eq(tdIndex).html();
}

/**
 * Returns nodes that have been rendered in table cell
 * @param {Number} trIndex
 * @param {Number} tdIndex
 * @returns {String}
 */
function getRenderedContent(trIndex, tdIndex) {
  return spec().$container.find('tbody tr').eq(trIndex).find('td').eq(tdIndex).children();
}

/**
 * Create numerical data values for the table
 * @param rowCount
 * @param colCount
 * @returns {Array}
 */
function createNumericData(rowCount, colCount) {
  rowCount = typeof rowCount === 'number' ? rowCount : 100;
  colCount = typeof colCount === 'number' ? colCount : 4;

  var rows = [],
      i,
      j;

  for (i = 0; i < rowCount; i++) {
    var row = [];

    for (j = 0; j < colCount; j++) {
      row.push(i + 1);
    }
    rows.push(row);
  }

  return rows;
}

/**
 * Model factory, which creates object with private properties, accessible by setters and getters.
 * Created for the purpose of testing HOT with Backbone-like Models
 * @param opts
 * @returns {{}}
 * @constructor
 */
function Model(opts) {
  var obj = {};

  var _data = $.extend({
    id: undefined,
    name: undefined,
    address: undefined
  }, opts);

  obj.attr = function (name, value) {
    if (typeof value === 'undefined') {
      return this.get(name);
    }

    return this.set(name, value);
  };

  obj.get = function (name) {
    return _data[name];
  };

  obj.set = function (name, value) {
    _data[name] = value;

    return this;
  };

  return obj;
}
/**
 * Factory which produces an accessor for objects of type "Model" (see above).
 * This function should be used to create accessor for a given property name and pass it as `data` option in column
 * configuration.
 *
 * @param name - name of the property for which an accessor function will be created
 * @returns {Function}
 */
function createAccessorForProperty(name) {
  return function (obj, value) {
    return obj.attr(name, value);
  };
}

function resizeColumn(displayedColumnIndex, width) {
  var $container = spec().$container;
  var $th = $container.find('thead tr:eq(0) th:eq(' + displayedColumnIndex + ')');

  $th.simulate('mouseover');

  var $resizer = $container.find('.manualColumnResizer');
  var resizerPosition = $resizer.position();

  $resizer.simulate('mousedown', {
    clientX: resizerPosition.left
  });

  var delta = width - $th.width() - 2;
  var newPosition = resizerPosition.left + delta;
  $resizer.simulate('mousemove', {
    clientX: newPosition
  });

  $resizer.simulate('mouseup');
}

function resizeRow(displayedRowIndex, height) {
  var $container = spec().$container;
  var $th = $container.find('tbody tr:eq(' + displayedRowIndex + ') th:eq(0)');

  $th.simulate('mouseover');

  var $resizer = $container.find('.manualRowResizer');
  var resizerPosition = $resizer.position();

  $resizer.simulate('mousedown', {
    clientY: resizerPosition.top
  });

  var delta = height - $th.height() - 2;

  if (delta < 0) {
    delta = 0;
  }

  $resizer.simulate('mousemove', {
    clientY: resizerPosition.top + delta
  });

  $resizer.simulate('mouseup');
}

function moveSecondDisplayedRowBeforeFirstRow(container, secondDisplayedRowIndex) {
  var $mainContainer = container.parents('.handsontable').not('[class*=clone]').not('[class*=master]').first(),
      $rowHeaders = container.find('tbody tr th'),
      $firstRowHeader = $rowHeaders.eq(secondDisplayedRowIndex - 1),
      $secondRowHeader = $rowHeaders.eq(secondDisplayedRowIndex);

  $secondRowHeader.simulate('mouseover');
  var $manualRowMover = $mainContainer.find('.manualRowMover');

  if ($manualRowMover.length) {
    $manualRowMover.simulate('mousedown', {
      clientY: $manualRowMover[0].getBoundingClientRect().top
    });

    $manualRowMover.simulate('mousemove', {
      clientY: $manualRowMover[0].getBoundingClientRect().top - 20
    });

    $firstRowHeader.simulate('mouseover');
    $secondRowHeader.simulate('mouseup');
  }
}

function moveFirstDisplayedRowAfterSecondRow(container, firstDisplayedRowIndex) {
  var $mainContainer = container.parents('.handsontable').not('[class*=clone]').not('[class*=master]').first(),
      $rowHeaders = container.find('tbody tr th'),
      $firstRowHeader = $rowHeaders.eq(firstDisplayedRowIndex),
      $secondRowHeader = $rowHeaders.eq(firstDisplayedRowIndex + 1);

  $secondRowHeader.simulate('mouseover');
  var $manualRowMover = $mainContainer.find('.manualRowMover');

  if ($manualRowMover.length) {
    $manualRowMover.simulate('mousedown', {
      clientY: $manualRowMover[0].getBoundingClientRect().top
    });

    $manualRowMover.simulate('mousemove', {
      clientY: $manualRowMover[0].getBoundingClientRect().top + 20
    });

    $firstRowHeader.simulate('mouseover');
    $secondRowHeader.simulate('mouseup');
  }
}

function swapDisplayedColumns(container, from, to) {
  var $mainContainer = container.parents('.handsontable').not('[class*=clone]').not('[class*=master]').first();
  var $colHeaders = container.find('thead tr:eq(0) th');
  var $to = $colHeaders.eq(to);
  var $from = $colHeaders.eq(from);

  // Enter the second column header
  $from.simulate('mouseover');
  var $manualColumnMover = $mainContainer.find('.manualColumnMover');

  // Grab the second column
  $manualColumnMover.simulate('mousedown', {
    pageX: $manualColumnMover[0].getBoundingClientRect().left
  });

  // Drag the second column over the first column
  $manualColumnMover.simulate('mousemove', {
    pageX: $manualColumnMover[0].getBoundingClientRect().left - 20
  });

  $to.simulate('mouseover');

  // Drop the second column
  $from.simulate('mouseup');
}

function triggerTouchEvent(type, target, pageX, pageY) {
  var e = document.createEvent('TouchEvent');
  var targetCoords = target.getBoundingClientRect();
  var touches;
  var targetTouches;
  var changedTouches;

  if (!pageX && !pageY) {
    pageX = parseInt(targetCoords.left + 3, 10);
    pageY = parseInt(targetCoords.top + 3, 10);
  }

  var touch = document.createTouch(window, target, 0, pageX, pageY, pageX, pageY);

  if (type == 'touchend') {
    touches = document.createTouchList();
    targetTouches = document.createTouchList();
    changedTouches = document.createTouchList(touch);
  } else {
    touches = document.createTouchList(touch);
    targetTouches = document.createTouchList(touch);
    changedTouches = document.createTouchList(touch);
  }

  e.initTouchEvent(type, true, true, window, null, 0, 0, 0, 0, false, false, false, false, touches, targetTouches, changedTouches, 1, 0);
  target.dispatchEvent(e);
};

/***/ }),

/***/ 79:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


exports.__esModule = true;
exports.spec = spec;
/* eslint-disable import/prefer-default-export */
var currentSpec;

function spec() {
  return currentSpec;
};

beforeEach(function () {
  currentSpec = this;

  var matchers = {
    toBeInArray: function toBeInArray() {
      return {
        compare: function compare(actual, expected) {
          return {
            pass: Array.isArray(expected) && expected.indexOf(actual) > -1
          };
        }
      };
    },
    toBeFunction: function toBeFunction() {
      return {
        compare: function compare(actual, expected) {
          return {
            pass: typeof actual === 'function'
          };
        }
      };
    },
    toBeAroundValue: function toBeAroundValue() {
      return {
        compare: function compare(actual, expected, diff) {
          diff = diff || 1;

          var pass = actual >= expected - diff && actual <= expected + diff;
          var message = 'Expected ' + actual + ' to be around ' + expected + ' (between ' + (expected - diff) + ' and ' + (expected + diff) + ')';

          if (!pass) {
            message = 'Expected ' + actual + ' NOT to be around ' + expected + ' (between ' + (expected - diff) + ' and ' + (expected + diff) + ')';
          }

          return {
            pass: pass,
            message: message
          };
        }
      };
    }
  };

  jasmine.addMatchers(matchers);

  if (document.activeElement && document.activeElement != document.body) {
    document.activeElement.blur();
  } else if (!document.activeElement) {
    // IE
    document.body.focus();
  }
});

afterEach(function () {
  window.scrollTo(0, 0);
});

/***/ })

/******/ });
//# sourceMappingURL=helpers.entry.js.map