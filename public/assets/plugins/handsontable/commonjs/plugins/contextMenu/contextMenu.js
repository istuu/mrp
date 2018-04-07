'use strict';

exports.__esModule = true;

var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _base = require('./../_base');

var _base2 = _interopRequireDefault(_base);

var _pluginHooks = require('./../../pluginHooks');

var _pluginHooks2 = _interopRequireDefault(_pluginHooks);

var _array = require('./../../helpers/array');

var _commandExecutor = require('./commandExecutor');

var _commandExecutor2 = _interopRequireDefault(_commandExecutor);

var _eventManager = require('./../../eventManager');

var _eventManager2 = _interopRequireDefault(_eventManager);

var _itemsFactory = require('./itemsFactory');

var _itemsFactory2 = _interopRequireDefault(_itemsFactory);

var _menu = require('./menu');

var _menu2 = _interopRequireDefault(_menu);

var _plugins = require('./../../plugins');

var _event = require('./../../helpers/dom/event');

var _element = require('./../../helpers/dom/element');

var _predefinedItems = require('./predefinedItems');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

_pluginHooks2.default.getSingleton().register('afterContextMenuDefaultOptions');
_pluginHooks2.default.getSingleton().register('afterContextMenuShow');
_pluginHooks2.default.getSingleton().register('afterContextMenuHide');
_pluginHooks2.default.getSingleton().register('afterContextMenuExecute');

/**
 * @description
 * This plugin creates the Handsontable Context Menu. It allows to create a new row or
 * column at any place in the grid among [other features](http://docs.handsontable.com/demo-context-menu.html).
 * Possible values:
 * * `true` (to enable default options),
 * * `false` (to disable completely)
 *
 * or array of any available strings:
 * * `["row_above", "row_below", "col_left", "col_right",
 * "remove_row", "remove_col", "---------", "undo", "redo"]`.
 *
 * See [the context menu demo](http://docs.handsontable.com/demo-context-menu.html) for examples.
 *
 * @example
 * ```js
 * ...
 * // as a boolean
 * contextMenu: true
 * ...
 * // as a array
 * contextMenu: ['row_above', 'row_below', '---------', 'undo', 'redo']
 * ...
 * ```
 *
 * @plugin ContextMenu
 */

var ContextMenu = function (_BasePlugin) {
  _inherits(ContextMenu, _BasePlugin);

  _createClass(ContextMenu, null, [{
    key: 'DEFAULT_ITEMS',

    /**
     * Default menu items order when `contextMenu` is enabled by `true`.
     *
     * @returns {Array}
     */
    get: function get() {
      return [_predefinedItems.ROW_ABOVE, _predefinedItems.ROW_BELOW, _predefinedItems.SEPARATOR, _predefinedItems.COLUMN_LEFT, _predefinedItems.COLUMN_RIGHT, _predefinedItems.SEPARATOR, _predefinedItems.REMOVE_ROW, _predefinedItems.REMOVE_COLUMN, _predefinedItems.SEPARATOR, _predefinedItems.UNDO, _predefinedItems.REDO, _predefinedItems.SEPARATOR, _predefinedItems.READ_ONLY, _predefinedItems.SEPARATOR, _predefinedItems.ALIGNMENT];
    }
  }]);

  function ContextMenu(hotInstance) {
    _classCallCheck(this, ContextMenu);

    /**
     * Instance of {@link EventManager}.
     *
     * @type {EventManager}
     */
    var _this = _possibleConstructorReturn(this, (ContextMenu.__proto__ || Object.getPrototypeOf(ContextMenu)).call(this, hotInstance));

    _this.eventManager = new _eventManager2.default(_this);
    /**
     * Instance of {@link CommandExecutor}.
     *
     * @type {CommandExecutor}
     */
    _this.commandExecutor = new _commandExecutor2.default(_this.hot);
    /**
     * Instance of {@link ItemsFactory}.
     *
     * @type {ItemsFactory}
     */
    _this.itemsFactory = null;
    /**
     * Instance of {@link Menu}.
     *
     * @type {Menu}
     */
    _this.menu = null;
    return _this;
  }

  /**
   * Check if the plugin is enabled in the Handsontable settings.
   *
   * @returns {Boolean}
   */


  _createClass(ContextMenu, [{
    key: 'isEnabled',
    value: function isEnabled() {
      return this.hot.getSettings().contextMenu;
    }

    /**
     * Enable plugin for this Handsontable instance.
     */

  }, {
    key: 'enablePlugin',
    value: function enablePlugin() {
      var _this2 = this;

      if (this.enabled) {
        return;
      }
      this.itemsFactory = new _itemsFactory2.default(this.hot, ContextMenu.DEFAULT_ITEMS);

      var settings = this.hot.getSettings().contextMenu;
      var predefinedItems = {
        items: this.itemsFactory.getItems(settings)
      };
      this.registerEvents();

      if (typeof settings.callback === 'function') {
        this.commandExecutor.setCommonCallback(settings.callback);
      }
      _get(ContextMenu.prototype.__proto__ || Object.getPrototypeOf(ContextMenu.prototype), 'enablePlugin', this).call(this);

      var delayedInitialization = function delayedInitialization() {
        if (!_this2.hot) {
          return;
        }

        _this2.hot.runHooks('afterContextMenuDefaultOptions', predefinedItems);

        _this2.itemsFactory.setPredefinedItems(predefinedItems.items);
        var menuItems = _this2.itemsFactory.getItems(settings);

        _this2.menu = new _menu2.default(_this2.hot, {
          className: 'htContextMenu',
          keepInViewport: true
        });
        _this2.hot.runHooks('beforeContextMenuSetItems', menuItems);

        _this2.menu.setMenuItems(menuItems);

        _this2.menu.addLocalHook('afterOpen', function () {
          return _this2.onMenuAfterOpen();
        });
        _this2.menu.addLocalHook('afterClose', function () {
          return _this2.onMenuAfterClose();
        });
        _this2.menu.addLocalHook('executeCommand', function () {
          for (var _len = arguments.length, params = Array(_len), _key = 0; _key < _len; _key++) {
            params[_key] = arguments[_key];
          }

          return _this2.executeCommand.apply(_this2, params);
        });

        // Register all commands. Predefined and added by user or by plugins
        (0, _array.arrayEach)(menuItems, function (command) {
          return _this2.commandExecutor.registerCommand(command.key, command);
        });
      };

      this.callOnPluginsReady(function () {
        if (_this2.isPluginsReady) {
          setTimeout(delayedInitialization, 0);
        } else {
          delayedInitialization();
        }
      });
    }

    /**
     * Updates the plugin to use the latest options you have specified.
     */

  }, {
    key: 'updatePlugin',
    value: function updatePlugin() {
      this.disablePlugin();
      this.enablePlugin();

      _get(ContextMenu.prototype.__proto__ || Object.getPrototypeOf(ContextMenu.prototype), 'updatePlugin', this).call(this);
    }

    /**
     * Disable plugin for this Handsontable instance.
     */

  }, {
    key: 'disablePlugin',
    value: function disablePlugin() {
      this.close();

      if (this.menu) {
        this.menu.destroy();
        this.menu = null;
      }
      _get(ContextMenu.prototype.__proto__ || Object.getPrototypeOf(ContextMenu.prototype), 'disablePlugin', this).call(this);
    }

    /**
     * Register dom listeners.
     *
     * @private
     */

  }, {
    key: 'registerEvents',
    value: function registerEvents() {
      var _this3 = this;

      this.eventManager.addEventListener(this.hot.rootElement, 'contextmenu', function (event) {
        return _this3.onContextMenu(event);
      });
    }

    /**
     * Open menu and re-position it based on dom event object.
     *
     * @param {Event} event The event object.
     */

  }, {
    key: 'open',
    value: function open(event) {
      if (!this.menu) {
        return;
      }
      this.menu.open();
      this.menu.setPosition({
        top: parseInt((0, _event.pageY)(event), 10) - (0, _element.getWindowScrollTop)(),
        left: parseInt((0, _event.pageX)(event), 10) - (0, _element.getWindowScrollLeft)()
      });

      // ContextMenu is not detected HotTableEnv correctly because is injected outside hot-table
      this.menu.hotMenu.isHotTableEnv = this.hot.isHotTableEnv;
      // Handsontable.eventManager.isHotTableEnv = this.hot.isHotTableEnv;
    }

    /**
     * Close menu.
     */

  }, {
    key: 'close',
    value: function close() {
      if (!this.menu) {
        return;
      }
      this.menu.close();
    }

    /**
     * Execute context menu command.
     *
     * You can execute all predefined commands:
     *  * `'row_above'` - Insert row above
     *  * `'row_below'` - Insert row below
     *  * `'col_left'` - Insert column left
     *  * `'col_right'` - Insert column right
     *  * `'clear_column'` - Clear selected column
     *  * `'remove_row'` - Remove row
     *  * `'remove_col'` - Remove column
     *  * `'undo'` - Undo last action
     *  * `'redo'` - Redo last action
     *  * `'make_read_only'` - Make cell read only
     *  * `'alignment:left'` - Alignment to the left
     *  * `'alignment:top'` - Alignment to the top
     *  * `'alignment:right'` - Alignment to the right
     *  * `'alignment:bottom'` - Alignment to the bottom
     *  * `'alignment:middle'` - Alignment to the middle
     *  * `'alignment:center'` - Alignment to the center (justify)
     *
     * Or you can execute command registered in settings where `key` is your command name.
     *
     * @param {String} commandName
     * @param {*} params
     */

  }, {
    key: 'executeCommand',
    value: function executeCommand() {
      for (var _len2 = arguments.length, params = Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        params[_key2] = arguments[_key2];
      }

      this.commandExecutor.execute.apply(this.commandExecutor, params);
    }

    /**
     * On context menu listener.
     *
     * @private
     * @param {Event} event
     */

  }, {
    key: 'onContextMenu',
    value: function onContextMenu(event) {
      var settings = this.hot.getSettings();
      var showRowHeaders = settings.rowHeaders;
      var showColHeaders = settings.colHeaders;

      function isValidElement(element) {
        return element.nodeName === 'TD' || element.parentNode.nodeName === 'TD';
      }
      // if event is from hot-table we must get web component element not element inside him
      var element = event.realTarget;
      this.close();

      if ((0, _element.hasClass)(element, 'handsontableInput')) {
        return;
      }

      event.preventDefault();
      (0, _event.stopPropagation)(event);

      if (!(showRowHeaders || showColHeaders)) {
        if (!isValidElement(element) && !((0, _element.hasClass)(element, 'current') && (0, _element.hasClass)(element, 'wtBorder'))) {
          return;
        }
      }

      this.open(event);
    }

    /**
     * On menu after open listener.
     *
     * @private
     */

  }, {
    key: 'onMenuAfterOpen',
    value: function onMenuAfterOpen() {
      this.hot.runHooks('afterContextMenuShow', this);
    }

    /**
     * On menu after close listener.
     *
     * @private
     */

  }, {
    key: 'onMenuAfterClose',
    value: function onMenuAfterClose() {
      this.hot.listen();
      this.hot.runHooks('afterContextMenuHide', this);
    }

    /**
     * Destroy instance.
     */

  }, {
    key: 'destroy',
    value: function destroy() {
      this.close();

      if (this.menu) {
        this.menu.destroy();
      }
      _get(ContextMenu.prototype.__proto__ || Object.getPrototypeOf(ContextMenu.prototype), 'destroy', this).call(this);
    }
  }]);

  return ContextMenu;
}(_base2.default);

ContextMenu.SEPARATOR = {
  name: _predefinedItems.SEPARATOR
};

(0, _plugins.registerPlugin)('contextMenu', ContextMenu);

exports.default = ContextMenu;