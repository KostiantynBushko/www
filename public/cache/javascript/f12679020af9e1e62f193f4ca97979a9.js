


/***************************************************
 * library/prototype/prototype.js
 ***************************************************/

/*  Prototype JavaScript framework, version 1.5.2_pre0
 *  (c) 2005-2007 Sam Stephenson
 *
 *  Prototype is freely distributable under the terms of an MIT-style license.
 *  For details, see the Prototype web site: http://www.prototypejs.org/
 *
/*--------------------------------------------------------------------------*/

var Prototype = {
  Version: '1.5.2_pre0',

  Browser: {
    IE:     !!(window.attachEvent && !window.opera),
    Opera:  !!window.opera,
    WebKit: navigator.userAgent.indexOf('AppleWebKit/') > -1,
    Gecko:  navigator.userAgent.indexOf('Gecko') > -1 && navigator.userAgent.indexOf('KHTML') == -1
  },

  BrowserFeatures: {
    XPath: !!document.evaluate,
    ElementExtensions: !!window.HTMLElement,
    SpecificElementExtensions:
      (document.createElement('div').__proto__ !==
       document.createElement('form').__proto__)
  },

  ScriptFragment: '<script[^>]*>([\\S\\s]*?)<\/script>',
  JSONFilter: /^\/\*-secure-([\s\S]*)\*\/\s*$/,

  emptyFunction: function() { },
  K: function(x) { return x }
}

var Class = {
  create: function() {
    return function() {
      this.initialize.apply(this, arguments);
    }
  }
}

var Abstract = new Object();

Object.extend = function(destination, source) {
  for (var property in source) {
    destination[property] = source[property];
  }
  return destination;
}

Object.extend(Object, {
  inspect: function(object) {
    try {
      if (object === undefined) return 'undefined';
      if (object === null) return 'null';
      return object.inspect ? object.inspect() : object.toString();
    } catch (e) {
      if (e instanceof RangeError) return '...';
      throw e;
    }
  },

  toJSON: function(object) {
    var type = typeof object;
    switch(type) {
      case 'undefined':
      case 'function':
      case 'unknown': return;
      case 'boolean': return object.toString();
    }
    if (object === null) return 'null';
    if (object.toJSON) return object.toJSON();
    if (object.ownerDocument === document) return;
    var results = [];
    for (var property in object) {
      var value = Object.toJSON(object[property]);
      if (value !== undefined)
        results.push(property.toJSON() + ': ' + value);
    }
    return '{' + results.join(', ') + '}';
  },

  keys: function(object) {
    var keys = [];
    for (var property in object)
      keys.push(property);
    return keys;
  },

  values: function(object) {
    var values = [];
    for (var property in object)
      values.push(object[property]);
    return values;
  },

  clone: function(object) {
    return Object.extend({}, object);
  }
});

Object.extend(Function.prototype, {
  bind: function() {
    var __method = this, args = $A(arguments), object = args.shift();
    return function() {
      return __method.apply(object, args.concat($A(arguments)));
    }
  },

  bindAsEventListener: function() {
    var __method = this, args = $A(arguments), object = args.shift();
    return function(event) {
      return __method.apply(object, [event || window.event].concat(args));
    }
  },

  curry: function() {
    var __method = this, args = $A(arguments);
    return function() {
      return __method.apply(this, args.concat($A(arguments)));
    }
  },

  delay: function() {
    var __method = this, args = $A(arguments), timeout = args.shift() * 1000;
    return window.setTimeout(function() {
      return __method.apply(__method, args);
    }, timeout);
  },

  wrap: function(wrapper) {
    var __method = this;
    return function() {
      return wrapper.apply(this, [__method.bind(this)].concat($A(arguments)));
    }
  },

  methodize: function() {
    if (this._methodized) return this._methodized;
    var __method = this;
    return this._methodized = function() {
      return __method.apply(null, [this].concat($A(arguments)));
    };
  }
});

Function.prototype.defer = Function.prototype.delay.curry(0.01);

Date.prototype.toJSON = function() {
  return '"' + this.getFullYear() + '-' +
    (this.getMonth() + 1).toPaddedString(2) + '-' +
    this.getDate().toPaddedString(2) + 'T' +
    this.getHours().toPaddedString(2) + ':' +
    this.getMinutes().toPaddedString(2) + ':' +
    this.getSeconds().toPaddedString(2) + '"';
};

var Try = {
  these: function() {
    var returnValue;

    for (var i = 0, length = arguments.length; i < length; i++) {
      var lambda = arguments[i];
      try {
        returnValue = lambda();
        break;
      } catch (e) {}
    }

    return returnValue;
  }
}

/*--------------------------------------------------------------------------*/

var PeriodicalExecuter = Class.create();
PeriodicalExecuter.prototype = {
  initialize: function(callback, frequency) {
    this.callback = callback;
    this.frequency = frequency;
    this.currentlyExecuting = false;

    this.registerCallback();
  },

  registerCallback: function() {
    this.timer = setInterval(this.onTimerEvent.bind(this), this.frequency * 1000);
  },

  stop: function() {
    if (!this.timer) return;
    clearInterval(this.timer);
    this.timer = null;
  },

  onTimerEvent: function() {
    if (!this.currentlyExecuting) {
      try {
        this.currentlyExecuting = true;
        this.callback(this);
      } finally {
        this.currentlyExecuting = false;
      }
    }
  }
}
Object.extend(String, {
  interpret: function(value) {
    return value == null ? '' : String(value);
  },
  specialChar: {
    '\b': '\\b',
    '\t': '\\t',
    '\n': '\\n',
    '\f': '\\f',
    '\r': '\\r',
    '\\': '\\\\'
  }
});

Object.extend(String.prototype, {
  gsub: function(pattern, replacement) {
    var result = '', source = this, match;
    replacement = arguments.callee.prepareReplacement(replacement);

    while (source.length > 0) {
      if (match = source.match(pattern)) {
        result += source.slice(0, match.index);
        result += String.interpret(replacement(match));
        source  = source.slice(match.index + match[0].length);
      } else {
        result += source, source = '';
      }
    }
    return result;
  },

  sub: function(pattern, replacement, count) {
    replacement = this.gsub.prepareReplacement(replacement);
    count = count === undefined ? 1 : count;

    return this.gsub(pattern, function(match) {
      if (--count < 0) return match[0];
      return replacement(match);
    });
  },

  scan: function(pattern, iterator) {
    this.gsub(pattern, iterator);
    return this;
  },

  truncate: function(length, truncation) {
    length = length || 30;
    truncation = truncation === undefined ? '...' : truncation;
    return this.length > length ?
      this.slice(0, length - truncation.length) + truncation : String(this);
  },

  strip: function() {
    return this.replace(/^\s+/, '').replace(/\s+$/, '');
  },

  stripTags: function() {
    return this.replace(/<\/?[^>]+>/gi, '');
  },

  stripScripts: function() {
    return this.replace(new RegExp(Prototype.ScriptFragment, 'img'), '');
  },

  extractScripts: function() {
    var matchAll = new RegExp(Prototype.ScriptFragment, 'img');
    var matchOne = new RegExp(Prototype.ScriptFragment, 'im');
    return (this.match(matchAll) || []).map(function(scriptTag) {
      return (scriptTag.match(matchOne) || ['', ''])[1];
    });
  },

  evalScripts: function() {
    return this.extractScripts().map(function(script) { return eval(script) });
  },

  escapeHTML: function() {
    var self = arguments.callee;
    self.text.data = this;
    return self.div.innerHTML;
  },

  unescapeHTML: function() {
    var div = new Element('div');
    div.innerHTML = this.stripTags();
    return div.childNodes[0] ? (div.childNodes.length > 1 ?
      $A(div.childNodes).inject('', function(memo, node) { return memo+node.nodeValue }) :
      div.childNodes[0].nodeValue) : '';
  },

  toQueryParams: function(separator) {
    var match = this.strip().match(/([^?#]*)(#.*)?$/);
    if (!match) return {};

    return match[1].split(separator || '&').inject({}, function(hash, pair) {
      if ((pair = pair.split('='))[0]) {
        var key = decodeURIComponent(pair.shift());
        var value = pair.length > 1 ? pair.join('=') : pair[0];
        if (value != undefined) value = decodeURIComponent(value);

        if (key in hash) {
          if (hash[key].constructor != Array) hash[key] = [hash[key]];
          hash[key].push(value);
        }
        else hash[key] = value;
      }
      return hash;
    });
  },

  toArray: function() {
    return this.split('');
  },

  succ: function() {
    return this.slice(0, this.length - 1) +
      String.fromCharCode(this.charCodeAt(this.length - 1) + 1);
  },

  times: function(count) {
    var result = '';
    for (var i = 0; i < count; i++) result += this;
    return result;
  },

  camelize: function() {
    var parts = this.split('-'), len = parts.length;
    if (len == 1) return parts[0];

    var camelized = this.charAt(0) == '-'
      ? parts[0].charAt(0).toUpperCase() + parts[0].substring(1)
      : parts[0];

    for (var i = 1; i < len; i++)
      camelized += parts[i].charAt(0).toUpperCase() + parts[i].substring(1);

    return camelized;
  },

  capitalize: function() {
    return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
  },

  underscore: function() {
    return this.gsub(/::/, '/').gsub(/([A-Z]+)([A-Z][a-z])/,'#{1}_#{2}').gsub(/([a-z\d])([A-Z])/,'#{1}_#{2}').gsub(/-/,'_').toLowerCase();
  },

  dasherize: function() {
    return this.gsub(/_/,'-');
  },

  inspect: function(useDoubleQuotes) {
    var escapedString = this.gsub(/[\x00-\x1f\\]/, function(match) {
      var character = String.specialChar[match[0]];
      return character ? character : '\\u00' + match[0].charCodeAt().toPaddedString(2, 16);
    });
    if (useDoubleQuotes) return '"' + escapedString.replace(/"/g, '\\"') + '"';
    return "'" + escapedString.replace(/'/g, '\\\'') + "'";
  },

  toJSON: function() {
    return this.inspect(true);
  },

  unfilterJSON: function(filter) {
    return this.sub(filter || Prototype.JSONFilter, '#{1}');
  },

  isJSON: function() {
    var str = this.replace(/\\./g, '@').replace(/"[^"\\\n\r]*"/g, '');
    return (/^[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]*$/).test(str);
  },

  evalJSON: function(sanitize) {
    var json = this.unfilterJSON();
    try {
      if (!sanitize || json.isJSON()) return eval('(' + json + ')');
    } catch (e) { }
    throw new SyntaxError('Badly formed JSON string: ' + this.inspect());
  },

  include: function(pattern) {
    return this.indexOf(pattern) > -1;
  },

  startsWith: function(pattern) {
    return this.indexOf(pattern) === 0;
  },

  endsWith: function(pattern) {
    var d = this.length - pattern.length;
    return d >= 0 && this.lastIndexOf(pattern) === d;
  },

  empty: function() {
    return this == '';
  },

  blank: function() {
    return /^\s*$/.test(this);
  }
});

if (Prototype.Browser.WebKit || Prototype.Browser.IE) Object.extend(String.prototype, {
  escapeHTML: function() {
    return this.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
  },
  unescapeHTML: function() {
    return this.replace(/&amp;/g,'&').replace(/&lt;/g,'<').replace(/&gt;/g,'>');
  }
});

String.prototype.gsub.prepareReplacement = function(replacement) {
  if (typeof replacement == 'function') return replacement;
  var template = new Template(replacement);
  return function(match) { return template.evaluate(match) };
}

String.prototype.parseQuery = String.prototype.toQueryParams;

Object.extend(String.prototype.escapeHTML, {
  div:  document.createElement('div'),
  text: document.createTextNode('')
});

with (String.prototype.escapeHTML) div.appendChild(text);

var Template = Class.create();
Template.Pattern = /(^|.|\r|\n)(#\{(.*?)\})/;
Template.prototype = {
  initialize: function(template, pattern) {
    this.template = template.toString();
    this.pattern  = pattern || Template.Pattern;
  },

  evaluate: function(object) {
    return this.template.gsub(this.pattern, function(match) {
      var before = match[1];
      if (before == '\\') return match[2];
      return before + String.interpret(object[match[3]]);
    });
  }
}

var $break = {};

var Enumerable = {
  each: function(iterator) {
    var index = 0;
    try {
      this._each(function(value) {
        iterator(value, index++);
      });
    } catch (e) {
      if (e != $break) throw e;
    }
    return this;
  },

  eachSlice: function(number, iterator) {
    var index = -number, slices = [], array = this.toArray();
    while ((index += number) < array.length)
      slices.push(array.slice(index, index+number));
    return slices.map(iterator);
  },

  all: function(iterator) {
    var result = true;
    this.each(function(value, index) {
      result = result && !!(iterator || Prototype.K)(value, index);
      if (!result) throw $break;
    });
    return result;
  },

  any: function(iterator) {
    var result = false;
    this.each(function(value, index) {
      if (result = !!(iterator || Prototype.K)(value, index))
        throw $break;
    });
    return result;
  },

  collect: function(iterator) {
    var results = [];
    this.each(function(value, index) {
      results.push((iterator || Prototype.K)(value, index));
    });
    return results;
  },

  detect: function(iterator) {
    var result;
    this.each(function(value, index) {
      if (iterator(value, index)) {
        result = value;
        throw $break;
      }
    });
    return result;
  },

  findAll: function(iterator) {
    var results = [];
    this.each(function(value, index) {
      if (iterator(value, index))
        results.push(value);
    });
    return results;
  },

  grep: function(pattern, iterator) {
    var results = [];
    this.each(function(value, index) {
      var stringValue = value.toString();
      if (stringValue.match(pattern))
        results.push((iterator || Prototype.K)(value, index));
    })
    return results;
  },

  include: function(object) {
    var found = false;
    this.each(function(value) {
      if (value == object) {
        found = true;
        throw $break;
      }
    });
    return found;
  },

  inGroupsOf: function(number, fillWith) {
    fillWith = fillWith === undefined ? null : fillWith;
    return this.eachSlice(number, function(slice) {
      while(slice.length < number) slice.push(fillWith);
      return slice;
    });
  },

  inject: function(memo, iterator) {
    this.each(function(value, index) {
      memo = iterator(memo, value, index);
    });
    return memo;
  },

  invoke: function(method) {
    var args = $A(arguments).slice(1);
    return this.map(function(value) {
      return value[method].apply(value, args);
    });
  },

  max: function(iterator) {
    var result;
    this.each(function(value, index) {
      value = (iterator || Prototype.K)(value, index);
      if (result == undefined || value >= result)
        result = value;
    });
    return result;
  },

  min: function(iterator) {
    var result;
    this.each(function(value, index) {
      value = (iterator || Prototype.K)(value, index);
      if (result == undefined || value < result)
        result = value;
    });
    return result;
  },

  partition: function(iterator) {
    var trues = [], falses = [];
    this.each(function(value, index) {
      ((iterator || Prototype.K)(value, index) ?
        trues : falses).push(value);
    });
    return [trues, falses];
  },

  pluck: function(property) {
    var results = [];
    this.each(function(value, index) {
      results.push(value[property]);
    });
    return results;
  },

  reject: function(iterator) {
    var results = [];
    this.each(function(value, index) {
      if (!iterator(value, index))
        results.push(value);
    });
    return results;
  },

  sortBy: function(iterator) {
    return this.map(function(value, index) {
      return {value: value, criteria: iterator(value, index)};
    }).sort(function(left, right) {
      var a = left.criteria, b = right.criteria;
      return a < b ? -1 : a > b ? 1 : 0;
    }).pluck('value');
  },

  toArray: function() {
    return this.map();
  },

  zip: function() {
    var iterator = Prototype.K, args = $A(arguments);
    if (typeof args.last() == 'function')
      iterator = args.pop();

    var collections = [this].concat(args).map($A);
    return this.map(function(value, index) {
      return iterator(collections.pluck(index));
    });
  },

  size: function() {
    return this.toArray().length;
  },

  inspect: function() {
    return '#<Enumerable:' + this.toArray().inspect() + '>';
  }
}

Object.extend(Enumerable, {
  map:     Enumerable.collect,
  find:    Enumerable.detect,
  select:  Enumerable.findAll,
  member:  Enumerable.include,
  entries: Enumerable.toArray
});
function $A(iterable) {
  if (!iterable) return [];
  if (iterable.toArray) {
    return iterable.toArray();
  } else {
    var results = [];
    for (var i = 0, length = iterable.length; i < length; i++)
      results.push(iterable[i]);
    return results;
  }
}

if (Prototype.Browser.WebKit) {
  function $A(iterable) {
    if (!iterable) return [];
    if (!(typeof iterable == 'function' && iterable == '[object NodeList]') &&
      iterable.toArray) {
      return iterable.toArray();
    } else {
      var results = [];
      for (var i = 0, length = iterable.length; i < length; i++)
        results.push(iterable[i]);
      return results;
    }
  }
}

Array.from = $A;

Object.extend(Array.prototype, Enumerable);

if (!Array.prototype._reverse)
  Array.prototype._reverse = Array.prototype.reverse;

Object.extend(Array.prototype, {
  _each: function(iterator) {
    for (var i = 0, length = this.length; i < length; i++)
      iterator(this[i]);
  },

  clear: function() {
    this.length = 0;
    return this;
  },

  first: function() {
    return this[0];
  },

  last: function() {
    return this[this.length - 1];
  },

  compact: function() {
    return this.select(function(value) {
      return value != null;
    });
  },

  flatten: function() {
    return this.inject([], function(array, value) {
      return array.concat(value && value.constructor == Array ?
        value.flatten() : [value]);
    });
  },

  without: function() {
    var values = $A(arguments);
    return this.select(function(value) {
      return !values.include(value);
    });
  },

  indexOf: function(object) {
    for (var i = 0, length = this.length; i < length; i++)
      if (this[i] == object) return i;
    return -1;
  },

  reverse: function(inline) {
    return (inline !== false ? this : this.toArray())._reverse();
  },

  reduce: function() {
    return this.length > 1 ? this : this[0];
  },

  uniq: function(sorted) {
    return this.inject([], function(array, value, index) {
      if (0 == index || (sorted ? array.last() != value : !array.include(value)))
        array.push(value);
      return array;
    });
  },

  clone: function() {
    return [].concat(this);
  },

  size: function() {
    return this.length;
  },

  inspect: function() {
    return '[' + this.map(Object.inspect).join(', ') + ']';
  },

  toJSON: function() {
    var results = [];
    this.each(function(object) {
      var value = Object.toJSON(object);
      if (value !== undefined) results.push(value);
    });
    return '[' + results.join(', ') + ']';
  }
});

Array.prototype.toArray = Array.prototype.clone;

function $w(string) {
  string = string.strip();
  return string ? string.split(/\s+/) : [];
}

if (Prototype.Browser.Opera){
  Array.prototype.concat = function() {
    var array = [];
    for (var i = 0, length = this.length; i < length; i++) array.push(this[i]);
    for (var i = 0, length = arguments.length; i < length; i++) {
      if (arguments[i].constructor == Array) {
        for (var j = 0, arrayLength = arguments[i].length; j < arrayLength; j++)
          array.push(arguments[i][j]);
      } else {
        array.push(arguments[i]);
      }
    }
    return array;
  }
}
Object.extend(Number.prototype, {
  toColorPart: function() {
    return this.toPaddedString(2, 16);
  },

  succ: function() {
    return this + 1;
  },

  times: function(iterator) {
    $R(0, this, true).each(iterator);
    return this;
  },

  toPaddedString: function(length, radix) {
    var string = this.toString(radix || 10);
    return '0'.times(length - string.length) + string;
  },

  toJSON: function() {
    return isFinite(this) ? this.toString() : 'null';
  }
});

$w('abs round ceil floor').each(function(method){
  Number.prototype[method] = Math[method].methodize()
});
var Hash = function(object) {
  if (object instanceof Hash) this.merge(object);
  else Object.extend(this, object || {});
};

Object.extend(Hash, {
  toQueryString: function(obj) {
    var parts = [];
    parts.add = arguments.callee.addPair;

    this.prototype._each.call(obj, function(pair) {
      if (!pair.key) return;
      var value = pair.value;

      if (value && typeof value == 'object') {
        if (value.constructor == Array) value.each(function(value) {
          parts.add(pair.key, value);
        });
        return;
      }
      parts.add(pair.key, value);
    });

    return parts.join('&');
  },

  toJSON: function(object) {
    var results = [];
    this.prototype._each.call(object, function(pair) {
      var value = Object.toJSON(pair.value);
      if (value !== undefined) results.push(pair.key.toJSON() + ': ' + value);
    });
    return '{' + results.join(', ') + '}';
  }
});

Hash.toQueryString.addPair = function(key, value, prefix) {
  key = encodeURIComponent(key);
  if (value === undefined) this.push(key);
  else this.push(key + '=' + (value == null ? '' : encodeURIComponent(value)));
}

Object.extend(Hash.prototype, Enumerable);
Object.extend(Hash.prototype, {
  _each: function(iterator) {
    for (var key in this) {
      var value = this[key];
      if (value && value == Hash.prototype[key]) continue;

      var pair = [key, value];
      pair.key = key;
      pair.value = value;
      iterator(pair);
    }
  },

  keys: function() {
    return this.pluck('key');
  },

  values: function() {
    return this.pluck('value');
  },

  index: function(value) {
    var match = this.detect(function(pair) {
      return pair.value === value;
    });
    return match && match.key;
  },

  merge: function(hash) {
    return $H(hash).inject(this, function(mergedHash, pair) {
      mergedHash[pair.key] = pair.value;
      return mergedHash;
    });
  },

  remove: function() {
    var result;
    for(var i = 0, length = arguments.length; i < length; i++) {
      var value = this[arguments[i]];
      if (value !== undefined){
        if (result === undefined) result = value;
        else {
          if (result.constructor != Array) result = [result];
          result.push(value)
        }
      }
      delete this[arguments[i]];
    }
    return result;
  },

  toQueryString: function() {
    return Hash.toQueryString(this);
  },

  inspect: function() {
    return '#<Hash:{' + this.map(function(pair) {
      return pair.map(Object.inspect).join(': ');
    }).join(', ') + '}>';
  },

  toJSON: function() {
    return Hash.toJSON(this);
  }
});

function $H(object) {
  if (object instanceof Hash) return object;
  return new Hash(object);
};

// Safari iterates over shadowed properties
if (function() {
  var i = 0, Test = function(value) { this.key = value };
  Test.prototype.key = 'foo';
  for (var property in new Test('bar')) i++;
  return i > 1;
}()) Hash.prototype._each = function(iterator) {
  var cache = [];
  for (var key in this) {
    var value = this[key];
    if ((value && value == Hash.prototype[key]) || cache.include(key)) continue;
    cache.push(key);
    var pair = [key, value];
    pair.key = key;
    pair.value = value;
    iterator(pair);
  }
};
ObjectRange = Class.create();
Object.extend(ObjectRange.prototype, Enumerable);
Object.extend(ObjectRange.prototype, {
  initialize: function(start, end, exclusive) {
    this.start = start;
    this.end = end;
    this.exclusive = exclusive;
  },

  _each: function(iterator) {
    var value = this.start;
    while (this.include(value)) {
      iterator(value);
      value = value.succ();
    }
  },

  include: function(value) {
    if (value < this.start)
      return false;
    if (this.exclusive)
      return value < this.end;
    return value <= this.end;
  }
});

var $R = function(start, end, exclusive) {
  return new ObjectRange(start, end, exclusive);
}

var Ajax = {
  getTransport: function() {
    return Try.these(
      function() {return new XMLHttpRequest()},
      function() {return new ActiveXObject('Msxml2.XMLHTTP')},
      function() {return new ActiveXObject('Microsoft.XMLHTTP')}
    ) || false;
  },

  activeRequestCount: 0
}

Ajax.Responders = {
  responders: [],

  _each: function(iterator) {
    this.responders._each(iterator);
  },

  register: function(responder) {
    if (!this.include(responder))
      this.responders.push(responder);
  },

  unregister: function(responder) {
    this.responders = this.responders.without(responder);
  },

  dispatch: function(callback, request, transport, json) {
    this.each(function(responder) {
      if (typeof responder[callback] == 'function') {
        try {
          responder[callback].apply(responder, [request, transport, json]);
        } catch (e) {}
      }
    });
  }
};

Object.extend(Ajax.Responders, Enumerable);

Ajax.Responders.register({
  onCreate: function() {
    Ajax.activeRequestCount++;
  },
  onComplete: function() {
    Ajax.activeRequestCount--;
  }
});

Ajax.Base = function() {};
Ajax.Base.prototype = {
  setOptions: function(options) {
    this.options = {
      method:       'post',
      asynchronous: true,
      contentType:  'application/x-www-form-urlencoded',
      encoding:     'UTF-8',
      parameters:   ''
    }
    Object.extend(this.options, options || {});

    this.options.method = this.options.method.toLowerCase();
    if (typeof this.options.parameters == 'string')
      this.options.parameters = this.options.parameters.toQueryParams();
  }
}

Ajax.Request = Class.create();
Ajax.Request.Events =
  ['Uninitialized', 'Loading', 'Loaded', 'Interactive', 'Complete'];

Ajax.Request.prototype = Object.extend(new Ajax.Base(), {
  _complete: false,

  initialize: function(url, options) {
    this.transport = Ajax.getTransport();
    this.setOptions(options);
    this.request(url);
  },

  request: function(url) {
    this.url = url;
    this.method = this.options.method;
    var params = Object.clone(this.options.parameters);

    if (!['get', 'post'].include(this.method)) {
      // simulate other verbs over post
      params['_method'] = this.method;
      this.method = 'post';
    }

    this.parameters = params;

    if (params = Hash.toQueryString(params)) {
      // when GET, append parameters to URL
      if (this.method == 'get')
        this.url += (this.url.include('?') ? '&' : '?') + params;
      else if (/Konqueror|Safari|KHTML/.test(navigator.userAgent))
        params += '&_=';
    }

    try {
      if (this.options.onCreate) this.options.onCreate(this.transport);
      Ajax.Responders.dispatch('onCreate', this, this.transport);

      this.transport.open(this.method.toUpperCase(), this.url,
        this.options.asynchronous);

      if (this.options.asynchronous) this.respondToReadyState.bind(this).defer(1);

      this.transport.onreadystatechange = this.onStateChange.bind(this);
      this.setRequestHeaders();

      this.body = this.method == 'post' ? (this.options.postBody || params) : null;
      this.transport.send(this.body);

      /* Force Firefox to handle ready state 4 for synchronous requests */
      if (!this.options.asynchronous && this.transport.overrideMimeType)
        this.onStateChange();

    }
    catch (e) {
      this.dispatchException(e);
    }
  },

  onStateChange: function() {
    var readyState = this.transport.readyState;
    if (readyState > 1 && !((readyState == 4) && this._complete))
      this.respondToReadyState(this.transport.readyState);
  },

  setRequestHeaders: function() {
    var headers = {
      'X-Requested-With': 'XMLHttpRequest',
      'X-Prototype-Version': Prototype.Version,
      'Accept': 'text/javascript, text/html, application/xml, text/xml, */*'
    };

    if (this.method == 'post') {
      headers['Content-type'] = this.options.contentType +
        (this.options.encoding ? '; charset=' + this.options.encoding : '');

      /* Force "Connection: close" for older Mozilla browsers to work
       * around a bug where XMLHttpRequest sends an incorrect
       * Content-length header. See Mozilla Bugzilla #246651.
       */
      if (this.transport.overrideMimeType &&
          (navigator.userAgent.match(/Gecko\/(\d{4})/) || [0,2005])[1] < 2005)
            headers['Connection'] = 'close';
    }

    // user-defined headers
    if (typeof this.options.requestHeaders == 'object') {
      var extras = this.options.requestHeaders;

      if (typeof extras.push == 'function')
        for (var i = 0, length = extras.length; i < length; i += 2)
          headers[extras[i]] = extras[i+1];
      else
        $H(extras).each(function(pair) { headers[pair.key] = pair.value });
    }

    for (var name in headers)
      this.transport.setRequestHeader(name, headers[name]);
  },

  success: function() {
    return !this.transport.status
        || (this.transport.status >= 200 && this.transport.status < 300);
  },

  respondToReadyState: function(readyState) {
    var state = Ajax.Request.Events[readyState];
    var transport = this.transport, json = this.evalJSON();

    if (state == 'Complete') {
      try {
        this._complete = true;
        (this.options['on' + this.transport.status]
         || this.options['on' + (this.success() ? 'Success' : 'Failure')]
         || Prototype.emptyFunction)(transport, json);
      } catch (e) {
        this.dispatchException(e);
      }

      var contentType = this.getHeader('Content-type');
      if (contentType && contentType.strip().
        match(/^(text|application)\/(x-)?(java|ecma)script(;.*)?$/i))
          this.evalResponse();
    }

    try {
      (this.options['on' + state] || Prototype.emptyFunction)(transport, json);
      Ajax.Responders.dispatch('on' + state, this, transport, json);
    } catch (e) {
      this.dispatchException(e);
    }

    if (state == 'Complete') {
      // avoid memory leak in MSIE: clean up
      this.transport.onreadystatechange = Prototype.emptyFunction;
    }
  },

  getHeader: function(name) {
    try {
      return this.transport.getResponseHeader(name);
    } catch (e) { return null }
  },

  evalJSON: function() {
    try {
      var json = this.getHeader('X-JSON');
      return json ? json.evalJSON() : null;
    } catch (e) { return null }
  },

  evalResponse: function() {
    try {
      return eval((this.transport.responseText || '').unfilterJSON());
    } catch (e) {
      this.dispatchException(e);
    }
  },

  dispatchException: function(exception) {
    (this.options.onException || Prototype.emptyFunction)(this, exception);
    Ajax.Responders.dispatch('onException', this, exception);
  }
});

Ajax.Updater = Class.create();

Object.extend(Object.extend(Ajax.Updater.prototype, Ajax.Request.prototype), {
  initialize: function(container, url, options) {
    this.container = {
      success: (container.success || container),
      failure: (container.failure || (container.success ? null : container))
    }

    this.transport = Ajax.getTransport();
    this.setOptions(options);

    var onComplete = this.options.onComplete || Prototype.emptyFunction;
    this.options.onComplete = (function(transport, param) {
      this.updateContent();
      onComplete(transport, param);
    }).bind(this);

    this.request(url);
  },

  updateContent: function() {
    var receiver = this.container[this.success() ? 'success' : 'failure'];
    var response = this.transport.responseText, options = this.options;

    if (!options.evalScripts) response = response.stripScripts();

    if (receiver = $(receiver)) {
      if (options.insertion) {
        if (typeof options.insertion == 'string') {
          var insertion = {}; insertion[options.insertion] = response;
          receiver.insert(insertion);
        }
        else options.insertion(receiver, response);
      }
      else receiver.update(response);
    }

    if (this.success()) {
      if (this.onComplete) this.onComplete.bind(this).defer();
    }
  }
});

Ajax.PeriodicalUpdater = Class.create();
Ajax.PeriodicalUpdater.prototype = Object.extend(new Ajax.Base(), {
  initialize: function(container, url, options) {
    this.setOptions(options);
    this.onComplete = this.options.onComplete;

    this.frequency = (this.options.frequency || 2);
    this.decay = (this.options.decay || 1);

    this.updater = {};
    this.container = container;
    this.url = url;

    this.start();
  },

  start: function() {
    this.options.onComplete = this.updateComplete.bind(this);
    this.onTimerEvent();
  },

  stop: function() {
    this.updater.options.onComplete = undefined;
    clearTimeout(this.timer);
    (this.onComplete || Prototype.emptyFunction).apply(this, arguments);
  },

  updateComplete: function(request) {
    if (this.options.decay) {
      this.decay = (request.responseText == this.lastText ?
        this.decay * this.options.decay : 1);

      this.lastText = request.responseText;
    }
    this.timer = this.onTimerEvent.bind(this).delay(this.decay * this.frequency);
  },

  onTimerEvent: function() {
    this.updater = new Ajax.Updater(this.container, this.url, this.options);
  }
});
function $(element) {
  if (arguments.length > 1) {
    for (var i = 0, elements = [], length = arguments.length; i < length; i++)
      elements.push($(arguments[i]));
    return elements;
  }
  if (typeof element == 'string')
    element = document.getElementById(element);
  return Element.extend(element);
}

if (Prototype.BrowserFeatures.XPath) {
  document._getElementsByXPath = function(expression, parentElement) {
    var results = [];
    var query = document.evaluate(expression, $(parentElement) || document,
      null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
    for (var i = 0, length = query.snapshotLength; i < length; i++)
      results.push(query.snapshotItem(i));
    return results;
  };

  document.getElementsByClassName = function(className, parentElement) {
    var q = ".//*[contains(concat(' ', @class, ' '), ' " + className + " ')]";
    return document._getElementsByXPath(q, parentElement);
  }

} else document.getElementsByClassName = function(className, parentElement) {
  var children = ($(parentElement) || document.body).getElementsByTagName('*');
  var elements = [], child;
  for (var i = 0, length = children.length; i < length; i++) {
    child = children[i];
    if (Element.hasClassName(child, className))
      elements.push(Element.extend(child));
  }
  return elements;
};

/*--------------------------------------------------------------------------*/

(function() {
  var element = this.Element;
  this.Element = function(tagName, attributes) {
    attributes = attributes || {};
    tagName = tagName.toLowerCase();
    var cache = Element.cache;
    if (Prototype.Browser.IE && attributes.name) {
      tagName = '<' + tagName + ' name="' + attributes.name + '">';
      delete attributes.name;
      return Element.writeAttribute(document.createElement(tagName), attributes);
    }
    if (!cache[tagName]) cache[tagName] = Element.extend(document.createElement(tagName));
    return Element.writeAttribute(cache[tagName].cloneNode(false), attributes);
  };
  Object.extend(this.Element, element || {});
}).call(window);

Element.cache = {};

Element.Methods = {
  visible: function(element) {
    return $(element).style.display != 'none';
  },

  toggle: function(element) {
    element = $(element);
    Element[Element.visible(element) ? 'hide' : 'show'](element);
    return element;
  },

  hide: function(element) {
    $(element).style.display = 'none';
    return element;
  },

  show: function(element) {
    $(element).style.display = '';
    return element;
  },

  remove: function(element) {
    element = $(element);
    element.parentNode.removeChild(element);
    return element;
  },

  update: function(element, html) {
    html = typeof html == 'undefined' ? '' : html.toString();
    $(element).innerHTML = html.stripScripts();
    html.evalScripts.bind(html).defer();
    return element;
  },

  replace: function(element, html) {
    element = $(element);
    html = typeof html == 'undefined' ? '' : html.toString();
    if (element.outerHTML) {
      element.outerHTML = html.stripScripts();
    } else {
      var range = element.ownerDocument.createRange();
      range.selectNode(element);
      element.parentNode.replaceChild(
        range.createContextualFragment(html.stripScripts()), element);
    }
    html.evalScripts.bind(html).defer();
    return element;
  },

  insert: function(element, insertions) {
    element = $(element);

    if (typeof insertions == 'string' || typeof insertions == 'number' ||
        (insertions && insertions.ownerDocument === document))
          insertions = {bottom:insertions};

    var content, t, range;

    for (position in insertions) {
      content  = insertions[position];
      position = position.toLowerCase();
      t = Element._insertionTranslations[position];

      if (content && content.ownerDocument === document) {
        t.insert(element, content);
        continue;
      }

      content = String.interpret(content);

      range = element.ownerDocument.createRange();
      t.initializeRange(element, range);
      t.insert(element, range.createContextualFragment(content.stripScripts()));

      content.evalScripts.bind(content).defer();
    }

    return element;
  },

  wrap: function(element, wrapper) {
    element = $(element);
    wrapper = wrapper || 'div';
    if (typeof wrapper == 'string') wrapper = new Element(wrapper);
    else Element.extend(wrapper);
    element.parentNode.replaceChild(wrapper, element);
    wrapper.appendChild(element);
    return element;
  },

  inspect: function(element) {
    element = $(element);
    var result = '<' + element.tagName.toLowerCase();
    $H({'id': 'id', 'className': 'class'}).each(function(pair) {
      var property = pair.first(), attribute = pair.last();
      var value = (element[property] || '').toString();
      if (value) result += ' ' + attribute + '=' + value.inspect(true);
    });
    return result + '>';
  },

  recursivelyCollect: function(element, property) {
    element = $(element);
    var elements = [];
    while (element = element[property])
      if (element.nodeType == 1)
        elements.push(Element.extend(element));
    return elements;
  },

  ancestors: function(element) {
    return $(element).recursivelyCollect('parentNode');
  },

  descendants: function(element) {
    return $A($(element).getElementsByTagName('*')).each(Element.extend);
  },

  firstDescendant: function(element) {
    element = $(element).firstChild;
    while (element && element.nodeType != 1) element = element.nextSibling;
    return $(element);
  },

  immediateDescendants: function(element) {
    if (!(element = $(element).firstChild)) return [];
    while (element && element.nodeType != 1) element = element.nextSibling;
    if (element) return [element].concat($(element).nextSiblings());
    return [];
  },

  previousSiblings: function(element) {
    return $(element).recursivelyCollect('previousSibling');
  },

  nextSiblings: function(element) {
    return $(element).recursivelyCollect('nextSibling');
  },

  siblings: function(element) {
    element = $(element);
    return element.previousSiblings().reverse().concat(element.nextSiblings());
  },

  match: function(element, selector) {
    if (typeof selector == 'string')
      selector = new Selector(selector);
    return selector.match($(element));
  },

  up: function(element, expression, index) {
    element = $(element);
    if (arguments.length == 1) return $(element.parentNode);
    var ancestors = element.ancestors();
    return expression ? Selector.findElement(ancestors, expression, index) :
      ancestors[index || 0];
  },

  down: function(element, expression, index) {
    element = $(element);
    if (arguments.length == 1) return element.firstDescendant();
    var descendants = element.descendants();
    return expression ? Selector.findElement(descendants, expression, index) :
      descendants[index || 0];
  },

  previous: function(element, expression, index) {
    element = $(element);
    if (arguments.length == 1) return $(Selector.handlers.previousElementSibling(element));
    var previousSiblings = element.previousSiblings();
    return expression ? Selector.findElement(previousSiblings, expression, index) :
      previousSiblings[index || 0];
  },

  next: function(element, expression, index) {
    element = $(element);
    if (arguments.length == 1) return $(Selector.handlers.nextElementSibling(element));
    var nextSiblings = element.nextSiblings();
    return expression ? Selector.findElement(nextSiblings, expression, index) :
      nextSiblings[index || 0];
  },

  getElementsBySelector: function() {
    var args = $A(arguments), element = $(args.shift());
    return Selector.findChildElements(element, args);
  },

  getElementsByClassName: function(element, className) {
    return document.getElementsByClassName(className, element);
  },

  readAttribute: function(element, name) {
    element = $(element);
    if (Prototype.Browser.IE) {
      if (!element.attributes) return null;
      var t = Element._attributeTranslations.read;
      if (t.values[name]) return t.values[name](element, name);
      if (t.names[name])  name = t.names[name];
      var attribute = element.attributes[name];
      return attribute ? attribute.nodeValue : null;
    }
    return element.getAttribute(name);
  },

  writeAttribute: function(element, name, value) {
    element = $(element);
    var attributes = {}, t = Element._attributeTranslations.write;

    if (typeof name == 'object') attributes = name;
    else attributes[name] = value === undefined ? true : value;

    for (var attr in attributes) {
      var name = t.names[attr] || attr, value = attributes[attr];
      if (t.values[attr]) name = t.values[attr](element, value);
      if (value === false || value === null)
        element.removeAttribute(name);
      else if (value === true)
        element.setAttribute(name, name);
      else element.setAttribute(name, value);
    }
    return element;
  },

  getHeight: function(element) {
    return $(element).getDimensions().height;
  },

  getWidth: function(element) {
    return $(element).getDimensions().width;
  },

  classNames: function(element) {
    return new Element.ClassNames(element);
  },

  hasClassName: function(element, className) {
    if (!(element = $(element))) return;
    var elementClassName = element.className;
    if (elementClassName.length == 0) return false;
    if (elementClassName == className ||
        elementClassName.match(new RegExp("(^|\\s)" + className + "(\\s|$)")))
      return true;
    return false;
  },

  addClassName: function(element, className) {
    if (!(element = $(element))) return;
    Element.classNames(element).add(className);
    return element;
  },

  removeClassName: function(element, className) {
    if (!(element = $(element))) return;
    Element.classNames(element).remove(className);
    return element;
  },

  toggleClassName: function(element, className) {
    if (!(element = $(element))) return;
    Element.classNames(element)[element.hasClassName(className) ? 'remove' : 'add'](className);
    return element;
  },

  observe: function() {
    Event.observe.apply(Event, arguments);
    return $A(arguments).first();
  },

  stopObserving: function() {
    Event.stopObserving.apply(Event, arguments);
    return $A(arguments).first();
  },

  // removes whitespace-only text node children
  cleanWhitespace: function(element) {
    element = $(element);
    var node = element.firstChild;
    while (node) {
      var nextNode = node.nextSibling;
      if (node.nodeType == 3 && !/\S/.test(node.nodeValue))
        element.removeChild(node);
      node = nextNode;
    }
    return element;
  },

  empty: function(element) {
    return $(element).innerHTML.blank();
  },

  descendantOf: function(element, ancestor) {
    element = $(element), ancestor = $(ancestor);
    while (element = element.parentNode)
      if (element == ancestor) return true;
    return false;
  },

  scrollTo: function(element) {
    element = $(element);
    var pos = element.cumulativeOffset();
    window.scrollTo(pos[0], pos[1]);
    return element;
  },

  getStyle: function(element, style) {
    element = $(element);
    style = style == 'float' ? 'cssFloat' : style.camelize();
    var value = element.style[style];
    if (!value) {
      var css = document.defaultView.getComputedStyle(element, null);
      value = css ? css[style] : null;
    }
    if (style == 'opacity') return value ? parseFloat(value) : 1.0;
    return value == 'auto' ? null : value;
  },

  getOpacity: function(element) {
    return $(element).getStyle('opacity');
  },

  setStyle: function(element, styles, camelized) {
    element = $(element);
    var elementStyle = element.style;

    for (var property in styles)
      if (property == 'opacity') element.setOpacity(styles[property])
      else
        elementStyle[(property == 'float' || property == 'cssFloat') ?
          (elementStyle.styleFloat === undefined ? 'cssFloat' : 'styleFloat') :
          (camelized ? property : property.camelize())] = styles[property];

    return element;
  },

  setOpacity: function(element, value) {
    element = $(element);
    element.style.opacity = (value == 1 || value === '') ? '' :
      (value < 0.00001) ? 0 : value;
    return element;
  },

  getDimensions: function(element) {
    element = $(element);
    var display = $(element).getStyle('display');
    if (display != 'none' && display != null) // Safari bug
      return {width: element.offsetWidth, height: element.offsetHeight};

    // All *Width and *Height properties give 0 on elements with display none,
    // so enable the element temporarily
    var els = element.style;
    var originalVisibility = els.visibility;
    var originalPosition = els.position;
    var originalDisplay = els.display;
    els.visibility = 'hidden';
    els.position = 'absolute';
    els.display = 'block';
    var originalWidth = element.clientWidth;
    var originalHeight = element.clientHeight;
    els.display = originalDisplay;
    els.position = originalPosition;
    els.visibility = originalVisibility;
    return {width: originalWidth, height: originalHeight};
  },

  makePositioned: function(element) {
    element = $(element);
    var pos = Element.getStyle(element, 'position');
    if (pos == 'static' || !pos) {
      element._madePositioned = true;
      element.style.position = 'relative';
      // Opera returns the offset relative to the positioning context, when an
      // element is position relative but top and left have not been defined
      if (window.opera) {
        element.style.top = 0;
        element.style.left = 0;
      }
    }
    return element;
  },

  undoPositioned: function(element) {
    element = $(element);
    if (element._madePositioned) {
      element._madePositioned = undefined;
      element.style.position =
        element.style.top =
        element.style.left =
        element.style.bottom =
        element.style.right = '';
    }
    return element;
  },

  makeClipping: function(element) {
    element = $(element);
    if (element._overflow) return element;
    element._overflow = element.style.overflow || 'auto';
    if ((Element.getStyle(element, 'overflow') || 'visible') != 'hidden')
      element.style.overflow = 'hidden';
    return element;
  },

  undoClipping: function(element) {
    element = $(element);
    if (!element._overflow) return element;
    element.style.overflow = element._overflow == 'auto' ? '' : element._overflow;
    element._overflow = null;
    return element;
  },

  cumulativeOffset: function(element) {
    var valueT = 0, valueL = 0;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;
      element = element.offsetParent;
    } while (element);
    return Element._returnOffset(valueL, valueT);
  },

  positionedOffset: function(element) {
    var valueT = 0, valueL = 0;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;
      element = element.offsetParent;
      if (element) {
        if (element.tagName == 'BODY') break;
        var p = Element.getStyle(element, 'position');
        if (p == 'relative' || p == 'absolute') break;
      }
    } while (element);
    return Element._returnOffset(valueL, valueT);
  },

  absolutize: function(element) {
    element = $(element);
    if (element.getStyle('position') == 'absolute') return;
    // Position.prepare(); // To be done manually by Scripty when it needs it.

    var offsets = element.positionedOffset();
    var top     = offsets[1];
    var left    = offsets[0];
    var width   = element.clientWidth;
    var height  = element.clientHeight;

    element._originalLeft   = left - parseFloat(element.style.left  || 0);
    element._originalTop    = top  - parseFloat(element.style.top || 0);
    element._originalWidth  = element.style.width;
    element._originalHeight = element.style.height;

    element.style.position = 'absolute';
    element.style.top    = top + 'px';
    element.style.left   = left + 'px';
    element.style.width  = width + 'px';
    element.style.height = height + 'px';
    return element;
  },

  relativize: function(element) {
    element = $(element);
    if (element.getStyle('position') == 'relative') return;
    // Position.prepare(); // To be done manually by Scripty when it needs it.

    element.style.position = 'relative';
    var top  = parseFloat(element.style.top  || 0) - (element._originalTop || 0);
    var left = parseFloat(element.style.left || 0) - (element._originalLeft || 0);

    element.style.top    = top + 'px';
    element.style.left   = left + 'px';
    element.style.height = element._originalHeight;
    element.style.width  = element._originalWidth;
    return element;
  },

  cumulativeScrollOffset: function(element) {
    var valueT = 0, valueL = 0;
    do {
      valueT += element.scrollTop  || 0;
      valueL += element.scrollLeft || 0;
      element = element.parentNode;
    } while (element);
    return Element._returnOffset(valueL, valueT);
  },

  getOffsetParent: function(element) {
    if (element.offsetParent) return $(element.offsetParent);
    if (element == document.body) return $(element);

    while ((element = element.parentNode) && element != document.body)
      if (Element.getStyle(element, 'position') != 'static')
        return $(element);

    return $(document.body);
  },

  viewportOffset: function(forElement) {
    var valueT = 0, valueL = 0;

    var element = forElement;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;

      // Safari fix
      if (element.offsetParent == document.body &&
        Element.getStyle(element, 'position') == 'absolute') break;

    } while (element = element.offsetParent);

    element = forElement;
    do {
      if (!Prototype.Browser.Opera || element.tagName == 'BODY') {
        valueT -= element.scrollTop  || 0;
        valueL -= element.scrollLeft || 0;
      }
    } while (element = element.parentNode);

    return Element._returnOffset(valueL, valueT);
  },

  clonePosition: function(element, source) {
    var options = Object.extend({
      setLeft:    true,
      setTop:     true,
      setWidth:   true,
      setHeight:  true,
      offsetTop:  0,
      offsetLeft: 0
    }, arguments[2] || {});

    // find page position of source
    source = $(source);
    var p = source.viewportOffset();

    // find coordinate system to use
    element = $(element);
    var delta = [0, 0];
    var parent = null;
    // delta [0,0] will do fine with position: fixed elements,
    // position:absolute needs offsetParent deltas
    if (Element.getStyle(element, 'position') == 'absolute') {
      parent = element.getOffsetParent();
      delta = parent.viewportOffset();
    }

    // correct by body offsets (fixes Safari)
    if (parent == document.body) {
      delta[0] -= document.body.offsetLeft;
      delta[1] -= document.body.offsetTop;
    }

    // set position
    if (options.setLeft)   element.style.left  = (p[0] - delta[0] + options.offsetLeft) + 'px';
    if (options.setTop)    element.style.top   = (p[1] - delta[1] + options.offsetTop) + 'px';
    if (options.setWidth)  element.style.width = source.offsetWidth + 'px';
    if (options.setHeight) element.style.height = source.offsetHeight + 'px';
    return element;
  }
};

Object.extend(Element.Methods, {
  childElements: Element.Methods.immediateDescendants
});

Element._attributeTranslations = {
  write: {
    names: {
      className: 'class',
      htmlFor:   'for'
    },
    values: {}
  }
};


if (!document.createRange || Prototype.Browser.Opera) {
  Element.Methods.insert = function(element, insertions) {
    element = $(element);

    if (typeof insertions == 'string' || typeof insertions == 'number' ||
        (insertions && insertions.ownerDocument === document))
          insertions = {bottom:insertions};

    var t = Element._insertionTranslations, content, position, pos, tagName;

    for (position in insertions) {
      content  = insertions[position];
      position = position.toLowerCase();
      pos      = t[position];

      if (content && content.ownerDocument === document) {
        pos.insert(element, content);
        continue;
      }

      content = String.interpret(content);
      tagName = ((position == 'before' || position == 'after')
        ? element.parentNode : element).tagName.toUpperCase();

      if (t.tags[tagName]) {
        var fragments = Element._getContentFromAnonymousElement(tagName, content.stripScripts());
        if (position == 'top' || position == 'after') fragments.reverse();
        fragments.each(pos.insert.curry(element));
      }
      else element.insertAdjacentHTML(pos.adjacency, content.stripScripts());

      content.evalScripts.bind(content).defer();
    }

    return element;
  }
}

if (Prototype.Browser.Opera) {
  Element.Methods._getStyle = Element.Methods.getStyle;
  Element.Methods.getStyle = function(element, style) {
    switch(style) {
      case 'left':
      case 'top':
      case 'right':
      case 'bottom':
        if (Element._getStyle(element, 'position') == 'static') return null;
      default: return Element._getStyle(element, style);
    }
  };
  Element.Methods._readAttribute = Element.Methods.readAttribute;
  Element.Methods.readAttribute = function(element, attribute) {
    if (attribute == 'title') return element.title;
    return Element._readAttribute(element, attribute);
  };
}

else if (Prototype.Browser.IE) {
  Element.Methods.getStyle = function(element, style) {
    element = $(element);
    style = (style == 'float' || style == 'cssFloat') ? 'styleFloat' : style.camelize();
    var value = element.style[style];
    if (!value && element.currentStyle) value = element.currentStyle[style];

    if (style == 'opacity') {
      if (value = (element.getStyle('filter') || '').match(/alpha\(opacity=(.*)\)/))
        if (value[1]) return parseFloat(value[1]) / 100;
      return 1.0;
    }

    if (value == 'auto') {
      if ((style == 'width' || style == 'height') && (element.getStyle('display') != 'none'))
        return element['offset' + style.capitalize()] + 'px';
      return null;
    }
    return value;
  };

  Element.Methods.setOpacity = function(element, value) {
    function stripAlpha(filter){
      return filter.replace(/alpha\([^\)]*\)/gi,'');
    }
    element = $(element);
    var filter = element.getStyle('filter'), style = element.style;
    if (value == 1 || value === '') {
      (filter = stripAlpha(filter)) ?
        style.filter = filter : style.removeAttribute('filter');
      return element;
    } else if (value < 0.00001) value = 0;
    style.filter = stripAlpha(filter) +
      'alpha(opacity=' + (value * 100) + ')';
    return element;
  };

  Element._attributeTranslations = {
    read: {
      names: {
        colspan:   "colSpan",
        rowspan:   "rowSpan",
        valign:    "vAlign",
        datetime:  "dateTime",
        accesskey: "accessKey",
        tabindex:  "tabIndex",
        enctype:   "encType",
        maxlength: "maxLength",
        readonly:  "readOnly",
        longdesc:  "longDesc"
      },
      values: {
        _getAttr: function(element, attribute) {
          return element.getAttribute(attribute, 2);
        },
        _flag: function(element, attribute) {
          return $(element).hasAttribute(attribute) ? attribute : null;
        },
        style: function(element) {
          return element.style.cssText.toLowerCase();
        },
        title: function(element) {
          var node = element.getAttributeNode('title');
          return node.specified ? node.nodeValue : null;
        }
      }
    }
  };

  Element._attributeTranslations.write = {
    names: Object.extend({
        'class': 'className',
        'for':   'htmlFor'
      }, Element._attributeTranslations.read.names),
    values: {
      checked: function(element, value) {
        element.checked = !!value;
      },

      style: function(element, value) {
        element.style.cssText = value ? value : '';
      }
    }
  };

  (function() {
    Object.extend(this, {
      href: this._getAttr,
      src:  this._getAttr,
      type: this._getAttr,
      disabled: this._flag,
      checked:  this._flag,
      readonly: this._flag,
      multiple: this._flag
    });
  }).call(Element._attributeTranslations.read.values);
}

else if (Prototype.Browser.Gecko) {
  Element.Methods.setOpacity = function(element, value) {
    element = $(element);
    element.style.opacity = (value == 1) ? 0.999999 :
      (value === '') ? '' : (value < 0.00001) ? 0 : value;
    return element;
  };
}

else if (Prototype.Browser.WebKit) {
  Element.Methods.setOpacity = function(element, value) {
    element = $(element);
    element.style.opacity = (value == 1 || value === '') ? '' :
      (value < 0.00001) ? 0 : value;

    if (value == 1)
      if(element.tagName == 'IMG' && element.width) {
        element.width++; element.width--;
      } else try {
        var n = document.createTextNode(' ');
        element.appendChild(n);
        element.removeChild(n);
      } catch (e) {}

    return element;
  }

  // Safari returns margins on body which is incorrect if the child is absolutely
  // positioned.  For performance reasons, redefine Position.cumulativeOffset for
  // KHTML/WebKit only.
  Element.Methods.cumulativeOffset = function(element) {
    var valueT = 0, valueL = 0;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;
      if (element.offsetParent == document.body)
        if (Element.getStyle(element, 'position') == 'absolute') break;

      element = element.offsetParent;
    } while (element);

    return [valueL, valueT];
  }
}

if (Prototype.Browser.IE || Prototype.Browser.Opera) {
  // IE and Opera are missing .innerHTML support for TABLE-related and SELECT elements
  Element.Methods.update = function(element, html) {
    element = $(element);
    html = typeof html == 'undefined' ? '' : html.toString();
    var tagName = element.tagName.toUpperCase();

    if (Element._insertionTranslations.tags[tagName]) {
      $A(element.childNodes).each(function(node) { element.removeChild(node) });
      Element._getContentFromAnonymousElement(tagName, html.stripScripts())
        .each(function(node) { element.appendChild(node) });
    }
    else element.innerHTML = html.stripScripts();

    html.evalScripts.bind(html).defer();
    return element;
  };
}

Element._returnOffset = function(l, t) {
  var result = [l, t];
  result.left = l;
  result.top = t;
  return result;
};

Element._getContentFromAnonymousElement = function(tagName, html) {
  var div = new Element('div'); t = Element._insertionTranslations.tags[tagName]
  div.innerHTML = t[0] + html + t[1];
  t[2].times(function() { div = div.firstChild });
  return $A(div.childNodes);
};

Element._insertionTranslations = {
  before: {
    adjacency: 'beforeBegin',
    insert: function(element, node) {
      element.parentNode.insertBefore(node, element);
    },
    initializeRange: function(element, range) {
      range.setStartBefore(element);
    }
  },
  top: {
    adjacency: 'afterBegin',
    insert: function(element, node) {
      element.insertBefore(node, element.firstChild);
    },
    initializeRange: function(element, range) {
      range.selectNodeContents(element);
      range.collapse(true);
    }
  },
  bottom: {
    adjacency: 'beforeEnd',
    insert: function(element, node) {
      element.appendChild(node);
    }
  },
  after: {
    adjacency: 'afterEnd',
    insert: function(element, node) {
      element.parentNode.insertBefore(node, element.nextSibling);
    },
    initializeRange: function(element, range) {
      range.setStartAfter(element);
    }
  },
  tags: {
    TABLE:  ['<table>',                '</table>',                   1],
    TBODY:  ['<table><tbody>',         '</tbody></table>',           2],
    TR:     ['<table><tbody><tr>',     '</tr></tbody></table>',      3],
    TD:     ['<table><tbody><tr><td>', '</td></tr></tbody></table>', 4],
    SELECT: ['<select>',               '</select>',                  1]
  }
};

(function() {
  this.bottom.initializeRange = this.top.initializeRange;
  Object.extend(this.tags, {
    THEAD: this.tags.TBODY,
    TFOOT: this.tags.TBODY,
    TH:    this.tags.TD
  });
}).call(Element._insertionTranslations);

Element.Methods.Simulated = {
  hasAttribute: function(element, attribute) {
    var t = Element._attributeTranslations.read, node;
    attribute = t.names[attribute] || attribute;
    node = $(element).getAttributeNode(attribute);
    return node && node.specified;
  }
};

Element.Methods.ByTag = {};

Object.extend(Element, Element.Methods);

if (!Prototype.BrowserFeatures.ElementExtensions &&
    document.createElement('div').__proto__) {
  window.HTMLElement = {};
  window.HTMLElement.prototype = document.createElement('div').__proto__;
  Prototype.BrowserFeatures.ElementExtensions = true;
}

Element.extend = (function() {
  if (Prototype.BrowserFeatures.SpecificElementExtensions)
    return Prototype.K;

  var Methods = {}, ByTag = Element.Methods.ByTag;

  var extend = Object.extend(function(element) {
    if (!element || element._extendedByPrototype ||
        element.nodeType != 1 || element == window) return element;

    var methods = Object.clone(Methods),
      tagName = element.tagName, property, value;

    // extend methods for specific tags
    if (ByTag[tagName]) Object.extend(methods, ByTag[tagName]);

    for (property in methods) {
      value = methods[property];
      if (typeof value == 'function' && !(property in element))
        element[property] = value.methodize();
    }

    element._extendedByPrototype = Prototype.emptyFunction;
    return element;

  }, {
    refresh: function() {
      // extend methods for all tags (Safari doesn't need this)
      if (!Prototype.BrowserFeatures.ElementExtensions) {
        Object.extend(Methods, Element.Methods);
        Object.extend(Methods, Element.Methods.Simulated);
      }
    }
  });

  extend.refresh();
  return extend;
})();

Element.hasAttribute = function(element, attribute) {
  if (element.hasAttribute) return element.hasAttribute(attribute);
  return Element.Methods.Simulated.hasAttribute(element, attribute);
};

Element.addMethods = function(methods) {
  var F = Prototype.BrowserFeatures, T = Element.Methods.ByTag;

  if (!methods) {
    Object.extend(Form, Form.Methods);
    Object.extend(Form.Element, Form.Element.Methods);
    Object.extend(Element.Methods.ByTag, {
      "FORM":     Object.clone(Form.Methods),
      "INPUT":    Object.clone(Form.Element.Methods),
      "SELECT":   Object.clone(Form.Element.Methods),
      "TEXTAREA": Object.clone(Form.Element.Methods)
    });
  }

  if (arguments.length == 2) {
    var tagName = methods;
    methods = arguments[1];
  }

  if (!tagName) Object.extend(Element.Methods, methods || {});
  else {
    if (tagName.constructor == Array) tagName.each(extend);
    else extend(tagName);
  }

  function extend(tagName) {
    tagName = tagName.toUpperCase();
    if (!Element.Methods.ByTag[tagName])
      Element.Methods.ByTag[tagName] = {};
    Object.extend(Element.Methods.ByTag[tagName], methods);
  }

  function copy(methods, destination, onlyIfAbsent) {
    onlyIfAbsent = onlyIfAbsent || false;
    for (var property in methods) {
      var value = methods[property];
      if (typeof value != 'function') continue;
      if (!onlyIfAbsent || !(property in destination))
        destination[property] = value.methodize();
    }
  }

  function findDOMClass(tagName) {
    var klass;
    var trans = {
      "OPTGROUP": "OptGroup", "TEXTAREA": "TextArea", "P": "Paragraph",
      "FIELDSET": "FieldSet", "UL": "UList", "OL": "OList", "DL": "DList",
      "DIR": "Directory", "H1": "Heading", "H2": "Heading", "H3": "Heading",
      "H4": "Heading", "H5": "Heading", "H6": "Heading", "Q": "Quote",
      "INS": "Mod", "DEL": "Mod", "A": "Anchor", "IMG": "Image", "CAPTION":
      "TableCaption", "COL": "TableCol", "COLGROUP": "TableCol", "THEAD":
      "TableSection", "TFOOT": "TableSection", "TBODY": "TableSection", "TR":
      "TableRow", "TH": "TableCell", "TD": "TableCell", "FRAMESET":
      "FrameSet", "IFRAME": "IFrame"
    };
    if (trans[tagName]) klass = 'HTML' + trans[tagName] + 'Element';
    if (window[klass]) return window[klass];
    klass = 'HTML' + tagName + 'Element';
    if (window[klass]) return window[klass];
    klass = 'HTML' + tagName.capitalize() + 'Element';
    if (window[klass]) return window[klass];

    window[klass] = {};
    window[klass].prototype = document.createElement(tagName).__proto__;
    return window[klass];
  }

  if (F.ElementExtensions) {
    copy(Element.Methods, HTMLElement.prototype);
    copy(Element.Methods.Simulated, HTMLElement.prototype, true);
  }

  if (F.SpecificElementExtensions) {
    for (var tag in Element.Methods.ByTag) {
      var klass = findDOMClass(tag);
      if (typeof klass == "undefined") continue;
      copy(T[tag], klass.prototype);
    }
  }

  Object.extend(Element, Element.Methods);
  delete Element.ByTag;

  if (Element.extend.refresh) Element.extend.refresh();
  Element.cache = {};
};

/*--------------------------------------------------------------------------*/

Element.ClassNames = Class.create();
Element.ClassNames.prototype = {
  initialize: function(element) {
    this.element = $(element);
  },

  _each: function(iterator) {
    this.element.className.split(/\s+/).select(function(name) {
      return name.length > 0;
    })._each(iterator);
  },

  set: function(className) {
    this.element.className = className;
  },

  add: function(classNameToAdd) {
    if (this.include(classNameToAdd)) return;
    this.set($A(this).concat(classNameToAdd).join(' '));
  },

  remove: function(classNameToRemove) {
    if (!this.include(classNameToRemove)) return;
    this.set($A(this).without(classNameToRemove).join(' '));
  },

  toString: function() {
    return $A(this).join(' ');
  }
};

Object.extend(Element.ClassNames.prototype, Enumerable);
/* Portions of the Selector class are derived from Jack Slocum’s DomQuery,
 * part of YUI-Ext version 0.40, distributed under the terms of an MIT-style
 * license.  Please see http://www.yui-ext.com/ for more information. */

var Selector = Class.create();

Selector.prototype = {
  initialize: function(expression) {
    this.expression = expression.strip();
    this.compileMatcher();
  },

  compileMatcher: function() {
    // Selectors with namespaced attributes can't use the XPath version
    if (Prototype.BrowserFeatures.XPath && !(/\[[\w-]*?:/).test(this.expression))
      return this.compileXPathMatcher();

    var e = this.expression, ps = Selector.patterns, h = Selector.handlers,
        c = Selector.criteria, le, p, m;

    if (Selector._cache[e]) {
      this.matcher = Selector._cache[e]; return;
    }
    this.matcher = ["this.matcher = function(root) {",
                    "var r = root, h = Selector.handlers, c = false, n;"];

    while (e && le != e && (/\S/).test(e)) {
      le = e;
      for (var i in ps) {
        p = ps[i];
        if (m = e.match(p)) {
          this.matcher.push(typeof c[i] == 'function' ? c[i](m) :
    	      new Template(c[i]).evaluate(m));
          e = e.replace(m[0], '');
          break;
        }
      }
    }

    this.matcher.push("return h.unique(n);\n}");
    eval(this.matcher.join('\n'));
    Selector._cache[this.expression] = this.matcher;
  },

  compileXPathMatcher: function() {
    var e = this.expression, ps = Selector.patterns,
        x = Selector.xpath, le,  m;

    if (Selector._cache[e]) {
      this.xpath = Selector._cache[e]; return;
    }

    this.matcher = ['.//*'];
    while (e && le != e && (/\S/).test(e)) {
      le = e;
      for (var i in ps) {
        if (m = e.match(ps[i])) {
          this.matcher.push(typeof x[i] == 'function' ? x[i](m) :
            new Template(x[i]).evaluate(m));
          e = e.replace(m[0], '');
          break;
        }
      }
    }

    this.xpath = this.matcher.join('');
    Selector._cache[this.expression] = this.xpath;
  },

  findElements: function(root) {
    root = root || document;
    if (this.xpath) return document._getElementsByXPath(this.xpath, root);
    return this.matcher(root);
  },

  match: function(element) {
    return this.findElements(document).include(element);
  },

  toString: function() {
    return this.expression;
  },

  inspect: function() {
    return "#<Selector:" + this.expression.inspect() + ">";
  }
};

Object.extend(Selector, {
  _cache: {},

  xpath: {
    descendant:   "//*",
    child:        "/*",
    adjacent:     "/following-sibling::*[1]",
    laterSibling: '/following-sibling::*',
    tagName:      function(m) {
      if (m[1] == '*') return '';
      return "[local-name()='" + m[1].toLowerCase() +
             "' or local-name()='" + m[1].toUpperCase() + "']";
    },
    className:    "[contains(concat(' ', @class, ' '), ' #{1} ')]",
    id:           "[@id='#{1}']",
    attrPresence: "[@#{1}]",
    attr: function(m) {
      m[3] = m[5] || m[6];
      return new Template(Selector.xpath.operators[m[2]]).evaluate(m);
    },
    pseudo: function(m) {
      var h = Selector.xpath.pseudos[m[1]];
      if (!h) return '';
      if (typeof h === 'function') return h(m);
      return new Template(Selector.xpath.pseudos[m[1]]).evaluate(m);
    },
    operators: {
      '=':  "[@#{1}='#{3}']",
      '!=': "[@#{1}!='#{3}']",
      '^=': "[starts-with(@#{1}, '#{3}')]",
      '$=': "[substring(@#{1}, (string-length(@#{1}) - string-length('#{3}') + 1))='#{3}']",
      '*=': "[contains(@#{1}, '#{3}')]",
      '~=': "[contains(concat(' ', @#{1}, ' '), ' #{3} ')]",
      '|=': "[contains(concat('-', @#{1}, '-'), '-#{3}-')]"
    },
    pseudos: {
      'first-child': '[not(preceding-sibling::*)]',
      'last-child':  '[not(following-sibling::*)]',
      'only-child':  '[not(preceding-sibling::* or following-sibling::*)]',
      'empty':       "[count(*) = 0 and (count(text()) = 0 or translate(text(), ' \t\r\n', '') = '')]",
      'checked':     "[@checked]",
      'disabled':    "[@disabled]",
      'enabled':     "[not(@disabled)]",
      'not': function(m) {
        var e = m[6], p = Selector.patterns,
            x = Selector.xpath, le, m, v;

        var exclusion = [];
        while (e && le != e && (/\S/).test(e)) {
          le = e;
          for (var i in p) {
            if (m = e.match(p[i])) {
              v = typeof x[i] == 'function' ? x[i](m) : new Template(x[i]).evaluate(m);
              exclusion.push("(" + v.substring(1, v.length - 1) + ")");
              e = e.replace(m[0], '');
              break;
            }
          }
        }
        return "[not(" + exclusion.join(" and ") + ")]";
      },
      'nth-child':      function(m) {
        return Selector.xpath.pseudos.nth("(count(./preceding-sibling::*) + 1) ", m);
      },
      'nth-last-child': function(m) {
        return Selector.xpath.pseudos.nth("(count(./following-sibling::*) + 1) ", m);
      },
      'nth-of-type':    function(m) {
        return Selector.xpath.pseudos.nth("position() ", m);
      },
      'nth-last-of-type': function(m) {
        return Selector.xpath.pseudos.nth("(last() + 1 - position()) ", m);
      },
      'first-of-type':  function(m) {
        m[6] = "1"; return Selector.xpath.pseudos['nth-of-type'](m);
      },
      'last-of-type':   function(m) {
        m[6] = "1"; return Selector.xpath.pseudos['nth-last-of-type'](m);
      },
      'only-of-type':   function(m) {
        var p = Selector.xpath.pseudos; return p['first-of-type'](m) + p['last-of-type'](m);
      },
      nth: function(fragment, m) {
        var mm, formula = m[6], predicate;
        if (formula == 'even') formula = '2n+0';
        if (formula == 'odd')  formula = '2n+1';
        if (mm = formula.match(/^(\d+)$/)) // digit only
          return '[' + fragment + "= " + mm[1] + ']';
        if (mm = formula.match(/^(-?\d*)?n(([+-])(\d+))?/)) { // an+b
          if (mm[1] == "-") mm[1] = -1;
          var a = mm[1] ? Number(mm[1]) : 1;
          var b = mm[2] ? Number(mm[2]) : 0;
          predicate = "[((#{fragment} - #{b}) mod #{a} = 0) and " +
          "((#{fragment} - #{b}) div #{a} >= 0)]";
          return new Template(predicate).evaluate({
            fragment: fragment, a: a, b: b });
        }
      }
    }
  },

  criteria: {
    tagName:      'n = h.tagName(n, r, "#{1}", c);   c = false;',
    className:    'n = h.className(n, r, "#{1}", c); c = false;',
    id:           'n = h.id(n, r, "#{1}", c);        c = false;',
    attrPresence: 'n = h.attrPresence(n, r, "#{1}"); c = false;',
    attr: function(m) {
      m[3] = (m[5] || m[6]);
      return new Template('n = h.attr(n, r, "#{1}", "#{3}", "#{2}"); c = false;').evaluate(m);
    },
    pseudo:       function(m) {
      if (m[6]) m[6] = m[6].replace(/"/g, '\\"');
      return new Template('n = h.pseudo(n, "#{1}", "#{6}", r, c); c = false;').evaluate(m);
    },
    descendant:   'c = "descendant";',
    child:        'c = "child";',
    adjacent:     'c = "adjacent";',
    laterSibling: 'c = "laterSibling";'
  },

  patterns: {
    // combinators must be listed first
    // (and descendant needs to be last combinator)
    laterSibling: /^\s*~\s*/,
    child:        /^\s*>\s*/,
    adjacent:     /^\s*\+\s*/,
    descendant:   /^\s/,

    // selectors follow
    tagName:      /^\s*(\*|[\w\-]+)(\b|$)?/,
    id:           /^#([\w\-\*]+)(\b|$)/,
    className:    /^\.([\w\-\*]+)(\b|$)/,
    pseudo:       /^:((first|last|nth|nth-last|only)(-child|-of-type)|empty|checked|(en|dis)abled|not)(\((.*?)\))?(\b|$|\s|(?=:))/,
    attrPresence: /^\[([\w]+)\]/,
    attr:         /\[((?:[\w-]*:)?[\w-]+)\s*(?:([!^$*~|]?=)\s*((['"])([^\]]*?)\4|([^'"][^\]]*?)))?\]/
  },

  handlers: {
    // UTILITY FUNCTIONS
    // joins two collections
    concat: function(a, b) {
      for (var i = 0, node; node = b[i]; i++)
        a.push(node);
      return a;
    },

    // marks an array of nodes for counting
    mark: function(nodes) {
      for (var i = 0, node; node = nodes[i]; i++)
        node._counted = true;
      return nodes;
    },

    unmark: function(nodes) {
      for (var i = 0, node; node = nodes[i]; i++)
        node._counted = undefined;
      return nodes;
    },

    // mark each child node with its position (for nth calls)
    // "ofType" flag indicates whether we're indexing for nth-of-type
    // rather than nth-child
    index: function(parentNode, reverse, ofType) {
      parentNode._counted = true;
      if (reverse) {
        for (var nodes = parentNode.childNodes, i = nodes.length - 1, j = 1; i >= 0; i--) {
          node = nodes[i];
          if (node.nodeType == 1 && (!ofType || node._counted)) node.nodeIndex = j++;
        }
      } else {
        for (var i = 0, j = 1, nodes = parentNode.childNodes; node = nodes[i]; i++)
          if (node.nodeType == 1 && (!ofType || node._counted)) node.nodeIndex = j++;
      }
    },

    // filters out duplicates and extends all nodes
    unique: function(nodes) {
      if (nodes.length == 0) return nodes;
      var results = [], n;
      for (var i = 0, l = nodes.length; i < l; i++)
        if (!(n = nodes[i])._counted) {
          n._counted = true;
          results.push(Element.extend(n));
        }
      return Selector.handlers.unmark(results);
    },

    // COMBINATOR FUNCTIONS
    descendant: function(nodes) {
      var h = Selector.handlers;
      for (var i = 0, results = [], node; node = nodes[i]; i++)
        h.concat(results, node.getElementsByTagName('*'));
      return results;
    },

    child: function(nodes) {
      var h = Selector.handlers;
      for (var i = 0, results = [], node; node = nodes[i]; i++) {
        for (var j = 0, children = [], child; child = node.childNodes[j]; j++)
          if (child.nodeType == 1 && child.tagName != '!') results.push(child);
      }
      return results;
    },

    adjacent: function(nodes) {
      for (var i = 0, results = [], node; node = nodes[i]; i++) {
        var next = this.nextElementSibling(node);
        if (next) results.push(next);
      }
      return results;
    },

    laterSibling: function(nodes) {
      var h = Selector.handlers;
      for (var i = 0, results = [], node; node = nodes[i]; i++)
        h.concat(results, Element.nextSiblings(node));
      return results;
    },

    nextElementSibling: function(node) {
      while (node = node.nextSibling)
	      if (node.nodeType == 1) return node;
      return null;
    },

    previousElementSibling: function(node) {
      while (node = node.previousSibling)
        if (node.nodeType == 1) return node;
      return null;
    },

    // TOKEN FUNCTIONS
    tagName: function(nodes, root, tagName, combinator) {
      tagName = tagName.toUpperCase();
      var results = [], h = Selector.handlers;
      if (nodes) {
        if (combinator) {
          // fastlane for ordinary descendant combinators
          if (combinator == "descendant") {
            for (var i = 0, node; node = nodes[i]; i++)
              h.concat(results, node.getElementsByTagName(tagName));
            return results;
          } else nodes = this[combinator](nodes);
          if (tagName == "*") return nodes;
        }
        for (var i = 0, node; node = nodes[i]; i++)
          if (node.tagName.toUpperCase() == tagName) results.push(node);
        return results;
      } else return root.getElementsByTagName(tagName);
    },

    id: function(nodes, root, id, combinator) {
      var targetNode = $(id), h = Selector.handlers;
      if (!targetNode) return [];
      if (!nodes && root == document) return [targetNode];
      if (nodes) {
        if (combinator) {
          if (combinator == 'child') {
            for (var i = 0, node; node = nodes[i]; i++)
              if (targetNode.parentNode == node) return [targetNode];
          } else if (combinator == 'descendant') {
            for (var i = 0, node; node = nodes[i]; i++)
              if (Element.descendantOf(targetNode, node)) return [targetNode];
          } else if (combinator == 'adjacent') {
            for (var i = 0, node; node = nodes[i]; i++)
              if (Selector.handlers.previousElementSibling(targetNode) == node)
                return [targetNode];
          } else nodes = h[combinator](nodes);
        }
        for (var i = 0, node; node = nodes[i]; i++)
          if (node == targetNode) return [targetNode];
        return [];
      }
      return (targetNode && Element.descendantOf(targetNode, root)) ? [targetNode] : [];
    },

    className: function(nodes, root, className, combinator) {
      if (nodes && combinator) nodes = this[combinator](nodes);
      return Selector.handlers.byClassName(nodes, root, className);
    },

    byClassName: function(nodes, root, className) {
      if (!nodes) nodes = Selector.handlers.descendant([root]);
      var needle = ' ' + className + ' ';
      for (var i = 0, results = [], node, nodeClassName; node = nodes[i]; i++) {
        nodeClassName = node.className;
        if (nodeClassName.length == 0) continue;
        if (nodeClassName == className || (' ' + nodeClassName + ' ').include(needle))
          results.push(node);
      }
      return results;
    },

    attrPresence: function(nodes, root, attr) {
      var results = [];
      for (var i = 0, node; node = nodes[i]; i++)
        if (Element.hasAttribute(node, attr)) results.push(node);
      return results;
    },

    attr: function(nodes, root, attr, value, operator) {
      if (!nodes) nodes = root.getElementsByTagName("*");
      var handler = Selector.operators[operator], results = [];
      for (var i = 0, node; node = nodes[i]; i++) {
        var nodeValue = Element.readAttribute(node, attr);
        if (nodeValue === null) continue;
        if (handler(nodeValue, value)) results.push(node);
      }
      return results;
    },

    pseudo: function(nodes, name, value, root, combinator) {
      if (nodes && combinator) nodes = this[combinator](nodes);
      if (!nodes) nodes = root.getElementsByTagName("*");
      return Selector.pseudos[name](nodes, value, root);
    }
  },

  pseudos: {
    'first-child': function(nodes, value, root) {
      for (var i = 0, results = [], node; node = nodes[i]; i++) {
        if (Selector.handlers.previousElementSibling(node)) continue;
          results.push(node);
      }
      return results;
    },
    'last-child': function(nodes, value, root) {
      for (var i = 0, results = [], node; node = nodes[i]; i++) {
        if (Selector.handlers.nextElementSibling(node)) continue;
          results.push(node);
      }
      return results;
    },
    'only-child': function(nodes, value, root) {
      var h = Selector.handlers;
      for (var i = 0, results = [], node; node = nodes[i]; i++)
        if (!h.previousElementSibling(node) && !h.nextElementSibling(node))
          results.push(node);
      return results;
    },
    'nth-child':        function(nodes, formula, root) {
      return Selector.pseudos.nth(nodes, formula, root);
    },
    'nth-last-child':   function(nodes, formula, root) {
      return Selector.pseudos.nth(nodes, formula, root, true);
    },
    'nth-of-type':      function(nodes, formula, root) {
      return Selector.pseudos.nth(nodes, formula, root, false, true);
    },
    'nth-last-of-type': function(nodes, formula, root) {
      return Selector.pseudos.nth(nodes, formula, root, true, true);
    },
    'first-of-type':    function(nodes, formula, root) {
      return Selector.pseudos.nth(nodes, "1", root, false, true);
    },
    'last-of-type':     function(nodes, formula, root) {
      return Selector.pseudos.nth(nodes, "1", root, true, true);
    },
    'only-of-type':     function(nodes, formula, root) {
      var p = Selector.pseudos;
      return p['last-of-type'](p['first-of-type'](nodes, formula, root), formula, root);
    },

    // handles the an+b logic
    getIndices: function(a, b, total) {
      if (a == 0) return b > 0 ? [b] : [];
      return $R(1, total).inject([], function(memo, i) {
        if (0 == (i - b) % a && (i - b) / a >= 0) memo.push(i);
        return memo;
      });
    },

    // handles nth(-last)-child, nth(-last)-of-type, and (first|last)-of-type
    nth: function(nodes, formula, root, reverse, ofType) {
      if (nodes.length == 0) return [];
      if (formula == 'even') formula = '2n+0';
      if (formula == 'odd')  formula = '2n+1';
      var h = Selector.handlers, results = [], indexed = [], m;
      h.mark(nodes);
      for (var i = 0, node; node = nodes[i]; i++) {
        if (!node.parentNode._counted) {
          h.index(node.parentNode, reverse, ofType);
          indexed.push(node.parentNode);
        }
      }
      if (formula.match(/^\d+$/)) { // just a number
        formula = Number(formula);
        for (var i = 0, node; node = nodes[i]; i++)
          if (node.nodeIndex == formula) results.push(node);
      } else if (m = formula.match(/^(-?\d*)?n(([+-])(\d+))?/)) { // an+b
        if (m[1] == "-") m[1] = -1;
        var a = m[1] ? Number(m[1]) : 1;
        var b = m[2] ? Number(m[2]) : 0;
        var indices = Selector.pseudos.getIndices(a, b, nodes.length);
        for (var i = 0, node, l = indices.length; node = nodes[i]; i++) {
          for (var j = 0; j < l; j++)
            if (node.nodeIndex == indices[j]) results.push(node);
        }
      }
      h.unmark(nodes);
      h.unmark(indexed);
      return results;
    },

    'empty': function(nodes, value, root) {
      for (var i = 0, results = [], node; node = nodes[i]; i++) {
        // IE treats comments as element nodes
        if (node.tagName == '!' || (node.firstChild && !node.innerHTML.match(/^\s*$/))) continue;
        results.push(node);
      }
      return results;
    },

    'not': function(nodes, selector, root) {
      var h = Selector.handlers, selectorType, m;
      var exclusions = new Selector(selector).findElements(root);
      h.mark(exclusions);
      for (var i = 0, results = [], node; node = nodes[i]; i++)
        if (!node._counted) results.push(node);
      h.unmark(exclusions);
      return results;
    },

    'enabled': function(nodes, value, root) {
      for (var i = 0, results = [], node; node = nodes[i]; i++)
        if (!node.disabled) results.push(node);
      return results;
    },

    'disabled': function(nodes, value, root) {
      for (var i = 0, results = [], node; node = nodes[i]; i++)
        if (node.disabled) results.push(node);
      return results;
    },

    'checked': function(nodes, value, root) {
      for (var i = 0, results = [], node; node = nodes[i]; i++)
        if (node.checked) results.push(node);
      return results;
    }
  },

  operators: {
    '=':  function(nv, v) { return nv == v; },
    '!=': function(nv, v) { return nv != v; },
    '^=': function(nv, v) { return nv.startsWith(v); },
    '$=': function(nv, v) { return nv.endsWith(v); },
    '*=': function(nv, v) { return nv.include(v); },
    '~=': function(nv, v) { return (' ' + nv + ' ').include(' ' + v + ' '); },
    '|=': function(nv, v) { return ('-' + nv.toUpperCase() + '-').include('-' + v.toUpperCase() + '-'); }
  },

  matchElements: function(elements, expression) {
    var matches = new Selector(expression).findElements(), h = Selector.handlers;
    h.mark(matches);
    for (var i = 0, results = [], element; element = elements[i]; i++)
      if (element._counted) results.push(element);
    h.unmark(matches);
    return results;
  },

  findElement: function(elements, expression, index) {
    if (typeof expression == 'number') {
      index = expression; expression = false;
    }
    return Selector.matchElements(elements, expression || '*')[index || 0];
  },

  findChildElements: function(element, expressions) {
    var exprs = expressions.join(','), expressions = [];
    exprs.scan(/(([\w#:.~>+()\s-]+|\*|\[.*?\])+)\s*(,|$)/, function(m) {
      expressions.push(m[1].strip());
    });
    var results = [], h = Selector.handlers;
    for (var i = 0, l = expressions.length, selector; i < l; i++) {
      selector = new Selector(expressions[i].strip());
      h.concat(results, selector.findElements(element));
    }
    return (l > 1) ? h.unique(results) : results;
  }
});

function $$() {
  return Selector.findChildElements(document, $A(arguments));
}
var Form = {
  reset: function(form) {
    $(form).reset();
    return form;
  },

  serializeElements: function(elements, getHash) {
    var data = elements.inject({}, function(result, element) {
      if (!element.disabled && element.name) {
        var key = element.name, value = $(element).getValue();
        if (value != null) {
         	if (key in result) {
            if (result[key].constructor != Array) result[key] = [result[key]];
            result[key].push(value);
          }
          else result[key] = value;
        }
      }
      return result;
    });

    return getHash ? data : Hash.toQueryString(data);
  }
};

Form.Methods = {
  serialize: function(form, getHash) {
    return Form.serializeElements(Form.getElements(form), getHash);
  },

  getElements: function(form) {
    return $A($(form).getElementsByTagName('*')).inject([],
      function(elements, child) {
        if (Form.Element.Serializers[child.tagName.toLowerCase()])
          elements.push(Element.extend(child));
        return elements;
      }
    );
  },

  getInputs: function(form, typeName, name) {
    form = $(form);
    var inputs = form.getElementsByTagName('input');

    if (!typeName && !name) return $A(inputs).map(Element.extend);

    for (var i = 0, matchingInputs = [], length = inputs.length; i < length; i++) {
      var input = inputs[i];
      if ((typeName && input.type != typeName) || (name && input.name != name))
        continue;
      matchingInputs.push(Element.extend(input));
    }

    return matchingInputs;
  },

  disable: function(form) {
    form = $(form);
    Form.getElements(form).invoke('disable');
    return form;
  },

  enable: function(form) {
    form = $(form);
    Form.getElements(form).invoke('enable');
    return form;
  },

  findFirstElement: function(form) {
    return $(form).getElements().find(function(element) {
      return element.type != 'hidden' && !element.disabled &&
        ['input', 'select', 'textarea'].include(element.tagName.toLowerCase());
    });
  },

  focusFirstElement: function(form) {
    form = $(form);
    form.findFirstElement().activate();
    return form;
  },

  request: function(form, options) {
    form = $(form), options = Object.clone(options || {});

    var params = options.parameters;
    options.parameters = form.serialize(true);

    if (params) {
      if (typeof params == 'string') params = params.toQueryParams();
      Object.extend(options.parameters, params);
    }

    if (form.hasAttribute('method') && !options.method)
      options.method = form.method;

    return new Ajax.Request(form.readAttribute('action'), options);
  }
}

/*--------------------------------------------------------------------------*/

Form.Element = {
  focus: function(element) {
    $(element).focus();
    return element;
  },

  select: function(element) {
    $(element).select();
    return element;
  }
}

Form.Element.Methods = {
  serialize: function(element) {
    element = $(element);
    if (!element.disabled && element.name) {
      var value = element.getValue();
      if (value != undefined) {
        var pair = {};
        pair[element.name] = value;
        return Hash.toQueryString(pair);
      }
    }
    return '';
  },

  getValue: function(element) {
    element = $(element);
    var method = element.tagName.toLowerCase();
    return Form.Element.Serializers[method](element);
  },

  clear: function(element) {
    $(element).value = '';
    return element;
  },

  present: function(element) {
    return $(element).value != '';
  },

  activate: function(element) {
    element = $(element);
    try {
      element.focus();
      if (element.select && (element.tagName.toLowerCase() != 'input' ||
        !['button', 'reset', 'submit'].include(element.type)))
        element.select();
    } catch (e) {}
    return element;
  },

  disable: function(element) {
    element = $(element);
    element.blur();
    element.disabled = true;
    return element;
  },

  enable: function(element) {
    element = $(element);
    element.disabled = false;
    return element;
  }
}

/*--------------------------------------------------------------------------*/

var Field = Form.Element;
var $F = Form.Element.Methods.getValue;

/*--------------------------------------------------------------------------*/

Form.Element.Serializers = {
  input: function(element) {
    switch (element.type.toLowerCase()) {
      case 'checkbox':
      case 'radio':
        return Form.Element.Serializers.inputSelector(element);
      default:
        return Form.Element.Serializers.textarea(element);
    }
  },

  inputSelector: function(element) {
    return element.checked ? element.value : null;
  },

  textarea: function(element) {
    return element.value;
  },

  select: function(element) {
    return this[element.type == 'select-one' ?
      'selectOne' : 'selectMany'](element);
  },

  selectOne: function(element) {
    var index = element.selectedIndex;
    return index >= 0 ? this.optionValue(element.options[index]) : null;
  },

  selectMany: function(element) {
    var values, length = element.length;
    if (!length) return null;

    for (var i = 0, values = []; i < length; i++) {
      var opt = element.options[i];
      if (opt.selected) values.push(this.optionValue(opt));
    }
    return values;
  },

  optionValue: function(opt) {
    // extend element because hasAttribute may not be native
    return Element.extend(opt).hasAttribute('value') ? opt.value : opt.text;
  }
}

/*--------------------------------------------------------------------------*/

Abstract.TimedObserver = function() {}
Abstract.TimedObserver.prototype = {
  initialize: function(element, frequency, callback) {
    this.frequency = frequency;
    this.element   = $(element);
    this.callback  = callback;

    this.lastValue = this.getValue();
    this.registerCallback();
  },

  registerCallback: function() {
    setInterval(this.onTimerEvent.bind(this), this.frequency * 1000);
  },

  onTimerEvent: function() {
    var value = this.getValue();
    var changed = ('string' == typeof this.lastValue && 'string' == typeof value
      ? this.lastValue != value : String(this.lastValue) != String(value));
    if (changed) {
      this.callback(this.element, value);
      this.lastValue = value;
    }
  }
}

Form.Element.Observer = Class.create();
Form.Element.Observer.prototype = Object.extend(new Abstract.TimedObserver(), {
  getValue: function() {
    return Form.Element.getValue(this.element);
  }
});

Form.Observer = Class.create();
Form.Observer.prototype = Object.extend(new Abstract.TimedObserver(), {
  getValue: function() {
    return Form.serialize(this.element);
  }
});

/*--------------------------------------------------------------------------*/

Abstract.EventObserver = function() {}
Abstract.EventObserver.prototype = {
  initialize: function(element, callback) {
    this.element  = $(element);
    this.callback = callback;

    this.lastValue = this.getValue();
    if (this.element.tagName.toLowerCase() == 'form')
      this.registerFormCallbacks();
    else
      this.registerCallback(this.element);
  },

  onElementEvent: function() {
    var value = this.getValue();
    if (this.lastValue != value) {
      this.callback(this.element, value);
      this.lastValue = value;
    }
  },

  registerFormCallbacks: function() {
    Form.getElements(this.element).each(this.registerCallback.bind(this));
  },

  registerCallback: function(element) {
    if (element.type) {
      switch (element.type.toLowerCase()) {
        case 'checkbox':
        case 'radio':
          Event.observe(element, 'click', this.onElementEvent.bind(this));
          break;
        default:
          Event.observe(element, 'change', this.onElementEvent.bind(this));
          break;
      }
    }
  }
}

Form.Element.EventObserver = Class.create();
Form.Element.EventObserver.prototype = Object.extend(new Abstract.EventObserver(), {
  getValue: function() {
    return Form.Element.getValue(this.element);
  }
});

Form.EventObserver = Class.create();
Form.EventObserver.prototype = Object.extend(new Abstract.EventObserver(), {
  getValue: function() {
    return Form.serialize(this.element);
  }
});
if (!window.Event) {
  var Event = new Object();
}

Object.extend(Event, {
  KEY_BACKSPACE: 8,
  KEY_TAB:       9,
  KEY_RETURN:   13,
  KEY_ESC:      27,
  KEY_LEFT:     37,
  KEY_UP:       38,
  KEY_RIGHT:    39,
  KEY_DOWN:     40,
  KEY_DELETE:   46,
  KEY_HOME:     36,
  KEY_END:      35,
  KEY_PAGEUP:   33,
  KEY_PAGEDOWN: 34,

  element: function(event) {
    return $(event.target || event.srcElement);
  },

  isLeftClick: function(event) {
    return (((event.which) && (event.which == 1)) ||
            ((event.button) && (event.button == 1)));
  },

  pointerX: function(event) {
    return event.pageX || (event.clientX +
      (document.documentElement.scrollLeft || document.body.scrollLeft));
  },

  pointerY: function(event) {
    return event.pageY || (event.clientY +
      (document.documentElement.scrollTop || document.body.scrollTop));
  },

  stop: function(event) {
    if (event.preventDefault) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.returnValue = false;
      event.cancelBubble = true;
    }
  },

  findElement: function(event, expression) {
    var element = Event.element(event);
    return element.match(expression) ? element : element.up(expression);
  },

  observers: false,

  _observeAndCache: function(element, name, observer, useCapture) {
    if (!this.observers) this.observers = [];
    if (element.addEventListener) {
      this.observers.push([element, name, observer, useCapture]);
      element.addEventListener(name, observer, useCapture);
    } else if (element.attachEvent) {
      this.observers.push([element, name, observer, useCapture]);
      element.attachEvent('on' + name, observer);
    }
  },

  unloadCache: function() {
    if (!Event.observers) return;
    for (var i = 0, length = Event.observers.length; i < length; i++) {
      Event.stopObserving.apply(this, Event.observers[i]);
      Event.observers[i][0] = null;
    }
    Event.observers = false;
  },

  observe: function(element, name, observer, useCapture) {
    element = $(element);
    useCapture = useCapture || false;

    if (name == 'keypress' &&
      (Prototype.Browser.WebKit || element.attachEvent))
      name = 'keydown';

    Event._observeAndCache(element, name, observer, useCapture);
  },

  stopObserving: function(element, name, observer, useCapture) {
    element = $(element);
    useCapture = useCapture || false;

    if (name == 'keypress' &&
        (Prototype.Browser.WebKit || element.attachEvent))
      name = 'keydown';

    if (element.removeEventListener) {
      element.removeEventListener(name, observer, useCapture);
    } else if (element.detachEvent) {
      try {
        element.detachEvent('on' + name, observer);
      } catch (e) {}
    }
  }
});

/* prevent memory leaks in IE */
if (Prototype.Browser.IE)
  Event.observe(window, 'unload', Event.unloadCache, false);
/*------------------------------- DEPRECATED -------------------------------*/

var Toggle = { display: Element.toggle };

Element.Methods.childOf = Element.Methods.descendantOf;

var Insertion = {
  Before: function(element, content) {
    return Element.insert(element, {before:content});
  },

  Top: function(element, content) {
    return Element.insert(element, {top:content});
  },

  Bottom: function(element, content) {
    return Element.insert(element, {bottom:content});
  },

  After: function(element, content) {
    return Element.insert(element, {after:content});
  }
}

var $continue = new Error('"throw $continue" is deprecated, use "return" instead');

// This should be moved to script.aculo.us; notice the deprecated methods
// further below, that map to the newer Element methods.
var Position = {
  // set to true if needed, warning: firefox performance problems
  // NOT neeeded for page scrolling, only if draggable contained in
  // scrollable elements
  includeScrollOffsets: false,

  // must be called before calling withinIncludingScrolloffset, every time the
  // page is scrolled
  prepare: function() {
    this.deltaX =  window.pageXOffset
                || document.documentElement.scrollLeft
                || document.body.scrollLeft
                || 0;
    this.deltaY =  window.pageYOffset
                || document.documentElement.scrollTop
                || document.body.scrollTop
                || 0;
  },

  // caches x/y coordinate pair to use with overlap
  within: function(element, x, y) {
    if (this.includeScrollOffsets)
      return this.withinIncludingScrolloffsets(element, x, y);
    this.xcomp = x;
    this.ycomp = y;
    this.offset = Element.cumulativeOffset(element);

    return (y >= this.offset[1] &&
            y <  this.offset[1] + element.offsetHeight &&
            x >= this.offset[0] &&
            x <  this.offset[0] + element.offsetWidth);
  },

  withinIncludingScrolloffsets: function(element, x, y) {
    var offsetcache = Element.cumulativeScrollOffset(element);

    this.xcomp = x + offsetcache[0] - this.deltaX;
    this.ycomp = y + offsetcache[1] - this.deltaY;
    this.offset = Element.cumulativeOffset(element);

    return (this.ycomp >= this.offset[1] &&
            this.ycomp <  this.offset[1] + element.offsetHeight &&
            this.xcomp >= this.offset[0] &&
            this.xcomp <  this.offset[0] + element.offsetWidth);
  },

  // within must be called directly before
  overlap: function(mode, element) {
    if (!mode) return 0;
    if (mode == 'vertical')
      return ((this.offset[1] + element.offsetHeight) - this.ycomp) /
        element.offsetHeight;
    if (mode == 'horizontal')
      return ((this.offset[0] + element.offsetWidth) - this.xcomp) /
        element.offsetWidth;
  },

  // Deprecation layer -- use newer Element methods now (1.5.2).

  cumulativeOffset: Element.Methods.cumulativeOffset,

  positionedOffset: Element.Methods.positionedOffset,

  absolutize: function(element) {
    Position.prepare();
    return Element.absolutize(element);
  },

  relativize: function(element) {
    Position.prepare();
    return Element.relativize(element);
  },

  realOffset: Element.Methods.cumulativeScrollOffset,

  offsetParent: Element.Methods.getOffsetParent,

  page: Element.Methods.viewportOffset,

  clone: function(source, target, options) {
    options = options || {};
    return Element.clonePosition(target, source, options);
  }
}
/*--------------------------------------------------------------------------*/

Element.addMethods();


/***************************************************
 * library/scriptaculous/effects.js
 ***************************************************/

// Copyright (c) 2005-2007 Thomas Fuchs (http://script.aculo.us, http://mir.aculo.us)
// Contributors:
//  Justin Palmer (http://encytemedia.com/)
//  Mark Pilgrim (http://diveintomark.org/)
//  Martin Bialasinki
// 
// script.aculo.us is freely distributable under the terms of an MIT-style license.
// For details, see the script.aculo.us web site: http://script.aculo.us/ 

// converts rgb() and #xxx to #xxxxxx format,  
// returns self (or first argument) if not convertable  
String.prototype.parseColor = function() {  
  var color = '#';
  if(this.slice(0,4) == 'rgb(') {  
    var cols = this.slice(4,this.length-1).split(',');  
    var i=0; do { color += parseInt(cols[i]).toColorPart() } while (++i<3);  
  } else {  
    if(this.slice(0,1) == '#') {  
      if(this.length==4) for(var i=1;i<4;i++) color += (this.charAt(i) + this.charAt(i)).toLowerCase();  
      if(this.length==7) color = this.toLowerCase();  
    }  
  }  
  return(color.length==7 ? color : (arguments[0] || this));  
}

/*--------------------------------------------------------------------------*/

Element.collectTextNodes = function(element) {  
  return $A($(element).childNodes).collect( function(node) {
    return (node.nodeType==3 ? node.nodeValue : 
      (node.hasChildNodes() ? Element.collectTextNodes(node) : ''));
  }).flatten().join('');
}

Element.collectTextNodesIgnoreClass = function(element, className) {  
  return $A($(element).childNodes).collect( function(node) {
    return (node.nodeType==3 ? node.nodeValue : 
      ((node.hasChildNodes() && !Element.hasClassName(node,className)) ? 
        Element.collectTextNodesIgnoreClass(node, className) : ''));
  }).flatten().join('');
}

Element.setContentZoom = function(element, percent) {
  element = $(element);  
  element.setStyle({fontSize: (percent/100) + 'em'});   
  if(Prototype.Browser.WebKit) window.scrollBy(0,0);
  return element;
}

Element.getInlineOpacity = function(element){
  return $(element).style.opacity || '';
}

Element.forceRerendering = function(element) {
  try {
    element = $(element);
    var n = document.createTextNode(' ');
    element.appendChild(n);
    element.removeChild(n);
  } catch(e) { }
};

/*--------------------------------------------------------------------------*/

Array.prototype.call = function() {
  var args = arguments;
  this.each(function(f){ f.apply(this, args) });
}

/*--------------------------------------------------------------------------*/

var Effect = {
  _elementDoesNotExistError: {
    name: 'ElementDoesNotExistError',
    message: 'The specified DOM element does not exist, but is required for this effect to operate'
  },
  tagifyText: function(element) {
    if(typeof Builder == 'undefined')
      throw("Effect.tagifyText requires including script.aculo.us' builder.js library");
      
    var tagifyStyle = 'position:relative';
    if(Prototype.Browser.IE) tagifyStyle += ';zoom:1';
    
    element = $(element);
    $A(element.childNodes).each( function(child) {
      if(child.nodeType==3) {
        child.nodeValue.toArray().each( function(character) {
          element.insertBefore(
            Builder.node('span',{style: tagifyStyle},
              character == ' ' ? String.fromCharCode(160) : character), 
              child);
        });
        Element.remove(child);
      }
    });
  },
  multiple: function(element, effect) {
    var elements;
    if(((typeof element == 'object') || 
        (typeof element == 'function')) && 
       (element.length))
      elements = element;
    else
      elements = $(element).childNodes;
      
    var options = Object.extend({
      speed: 0.1,
      delay: 0.0
    }, arguments[2] || {});
    var masterDelay = options.delay;

    $A(elements).each( function(element, index) {
      new effect(element, Object.extend(options, { delay: index * options.speed + masterDelay }));
    });
  },
  PAIRS: {
    'slide':  ['SlideDown','SlideUp'],
    'blind':  ['BlindDown','BlindUp'],
    'appear': ['Appear','Fade']
  },
  toggle: function(element, effect) {
    element = $(element);
    effect = (effect || 'appear').toLowerCase();
    var options = Object.extend({
      queue: { position:'end', scope:(element.id || 'global'), limit: 1 }
    }, arguments[2] || {});
    Effect[element.visible() ? 
      Effect.PAIRS[effect][1] : Effect.PAIRS[effect][0]](element, options);
  }
};

var Effect2 = Effect; // deprecated

/* ------------- transitions ------------- */

Effect.Transitions = {
  linear: Prototype.K,
  sinoidal: function(pos) {
    return (-Math.cos(pos*Math.PI)/2) + 0.5;
  },
  reverse: function(pos) {
    return 1-pos;
  },
  flicker: function(pos) {
    var pos = ((-Math.cos(pos*Math.PI)/4) + 0.75) + Math.random()/4;
    return (pos > 1 ? 1 : pos);
  },
  wobble: function(pos) {
    return (-Math.cos(pos*Math.PI*(9*pos))/2) + 0.5;
  },
  pulse: function(pos, pulses) { 
    pulses = pulses || 5; 
    return (
      Math.round((pos % (1/pulses)) * pulses) == 0 ? 
            ((pos * pulses * 2) - Math.floor(pos * pulses * 2)) : 
        1 - ((pos * pulses * 2) - Math.floor(pos * pulses * 2))
      );
  },
  spring: function(pos) { 
    return 1 - (Math.cos(pos * 4.5 * Math.PI) * Math.exp(-pos * 6)); 
  },
  none: function(pos) {
    return 0;
  },
  full: function(pos) {
    return 1;
  }
};

/* ------------- core effects ------------- */

Effect.ScopedQueue = Class.create();
Object.extend(Object.extend(Effect.ScopedQueue.prototype, Enumerable), {
  initialize: function() {
    this.effects  = [];
    this.interval = null;    
  },
  _each: function(iterator) {
    this.effects._each(iterator);
  },
  add: function(effect) {
    var timestamp = new Date().getTime();
    
    var position = (typeof effect.options.queue == 'string') ? 
      effect.options.queue : effect.options.queue.position;
    
    switch(position) {
      case 'front':
        // move unstarted effects after this effect  
        this.effects.findAll(function(e){ return e.state=='idle' }).each( function(e) {
            e.startOn  += effect.finishOn;
            e.finishOn += effect.finishOn;
          });
        break;
      case 'with-last':
        timestamp = this.effects.pluck('startOn').max() || timestamp;
        break;
      case 'end':
        // start effect after last queued effect has finished
        timestamp = this.effects.pluck('finishOn').max() || timestamp;
        break;
    }
    
    effect.startOn  += timestamp;
    effect.finishOn += timestamp;

    if(!effect.options.queue.limit || (this.effects.length < effect.options.queue.limit))
      this.effects.push(effect);
    
    if(!this.interval)
      this.interval = setInterval(this.loop.bind(this), 15);
  },
  remove: function(effect) {
    this.effects = this.effects.reject(function(e) { return e==effect });
    if(this.effects.length == 0) {
      clearInterval(this.interval);
      this.interval = null;
    }
  },
  loop: function() {
    var timePos = new Date().getTime();
    for(var i=0, len=this.effects.length;i<len;i++) 
      this.effects[i] && this.effects[i].loop(timePos);
  }
});

Effect.Queues = {
  instances: $H(),
  get: function(queueName) {
    if(typeof queueName != 'string') return queueName;
    
    if(!this.instances[queueName])
      this.instances[queueName] = new Effect.ScopedQueue();
      
    return this.instances[queueName];
  }
}
Effect.Queue = Effect.Queues.get('global');

Effect.DefaultOptions = {
  transition: Effect.Transitions.sinoidal,
  duration:   1.0,   // seconds
  fps:        100,   // 100= assume 66fps max.
  sync:       false, // true for combining
  from:       0.0,
  to:         1.0,
  delay:      0.0,
  queue:      'parallel'
}

Effect.Base = function() {};
Effect.Base.prototype = {
  position: null,
  start: function(options) {
    function codeForEvent(options,eventName){
      return (
        (options[eventName+'Internal'] ? 'this.options.'+eventName+'Internal(this);' : '') +
        (options[eventName] ? 'this.options.'+eventName+'(this);' : '')
      );
    }
    if(options && options.transition === false) options.transition = Effect.Transitions.linear;
    this.options      = Object.extend(Object.extend({},Effect.DefaultOptions), options || {});
    this.currentFrame = 0;
    this.state        = 'idle';
    this.startOn      = this.options.delay*1000;
    this.finishOn     = this.startOn+(this.options.duration*1000);
    this.fromToDelta  = this.options.to-this.options.from;
    this.totalTime    = this.finishOn-this.startOn;
    this.totalFrames  = this.options.fps*this.options.duration;
    
    eval('this.render = function(pos){ '+
      'if(this.state=="idle"){this.state="running";'+
      codeForEvent(this.options,'beforeSetup')+
      (this.setup ? 'this.setup();':'')+ 
      codeForEvent(this.options,'afterSetup')+
      '};if(this.state=="running"){'+
      'pos=this.options.transition(pos)*'+this.fromToDelta+'+'+this.options.from+';'+
      'this.position=pos;'+
      codeForEvent(this.options,'beforeUpdate')+
      (this.update ? 'this.update(pos);':'')+
      codeForEvent(this.options,'afterUpdate')+
      '}}');
    
    this.event('beforeStart');
    if(!this.options.sync)
      Effect.Queues.get(typeof this.options.queue == 'string' ? 
        'global' : this.options.queue.scope).add(this);
  },
  loop: function(timePos) {
    if(timePos >= this.startOn) {
      if(timePos >= this.finishOn) {
        this.render(1.0);
        this.cancel();
        this.event('beforeFinish');
        if(this.finish) this.finish(); 
        this.event('afterFinish');
        return;  
      }
      var pos   = (timePos - this.startOn) / this.totalTime,
          frame = Math.round(pos * this.totalFrames);
      if(frame > this.currentFrame) {
        this.render(pos);
        this.currentFrame = frame;
      }
    }
  },
  cancel: function() {
    if(!this.options.sync)
      Effect.Queues.get(typeof this.options.queue == 'string' ? 
        'global' : this.options.queue.scope).remove(this);
    this.state = 'finished';
  },
  event: function(eventName) {
    if(this.options[eventName + 'Internal']) this.options[eventName + 'Internal'](this);
    if(this.options[eventName]) this.options[eventName](this);
  },
  inspect: function() {
    var data = $H();
    for(property in this)
      if(typeof this[property] != 'function') data[property] = this[property];
    return '#<Effect:' + data.inspect() + ',options:' + $H(this.options).inspect() + '>';
  }
}

Effect.Parallel = Class.create();
Object.extend(Object.extend(Effect.Parallel.prototype, Effect.Base.prototype), {
  initialize: function(effects) {
    this.effects = effects || [];
    this.start(arguments[1]);
  },
  update: function(position) {
    this.effects.invoke('render', position);
  },
  finish: function(position) {
    this.effects.each( function(effect) {
      effect.render(1.0);
      effect.cancel();
      effect.event('beforeFinish');
      if(effect.finish) effect.finish(position);
      effect.event('afterFinish');
    });
  }
});

Effect.Event = Class.create();
Object.extend(Object.extend(Effect.Event.prototype, Effect.Base.prototype), {
  initialize: function() {
    var options = Object.extend({
      duration: 0
    }, arguments[0] || {});
    this.start(options);
  },
  update: Prototype.emptyFunction
});

Effect.Opacity = Class.create();
Object.extend(Object.extend(Effect.Opacity.prototype, Effect.Base.prototype), {
  initialize: function(element) {
    this.element = $(element);
    if(!this.element) throw(Effect._elementDoesNotExistError);
    // make this work on IE on elements without 'layout'
    if(Prototype.Browser.IE && (!this.element.currentStyle.hasLayout))
      this.element.setStyle({zoom: 1});
    var options = Object.extend({
      from: this.element.getOpacity() || 0.0,
      to:   1.0
    }, arguments[1] || {});
    this.start(options);
  },
  update: function(position) {
    this.element.setOpacity(position);
  }
});

Effect.Move = Class.create();
Object.extend(Object.extend(Effect.Move.prototype, Effect.Base.prototype), {
  initialize: function(element) {
    this.element = $(element);
    if(!this.element) throw(Effect._elementDoesNotExistError);
    var options = Object.extend({
      x:    0,
      y:    0,
      mode: 'relative'
    }, arguments[1] || {});
    this.start(options);
  },
  setup: function() {
    // Bug in Opera: Opera returns the "real" position of a static element or
    // relative element that does not have top/left explicitly set.
    // ==> Always set top and left for position relative elements in your stylesheets 
    // (to 0 if you do not need them) 
    this.element.makePositioned();
    this.originalLeft = parseFloat(this.element.getStyle('left') || '0');
    this.originalTop  = parseFloat(this.element.getStyle('top')  || '0');
    if(this.options.mode == 'absolute') {
      // absolute movement, so we need to calc deltaX and deltaY
      this.options.x = this.options.x - this.originalLeft;
      this.options.y = this.options.y - this.originalTop;
    }
  },
  update: function(position) {
    this.element.setStyle({
      left: Math.round(this.options.x  * position + this.originalLeft) + 'px',
      top:  Math.round(this.options.y  * position + this.originalTop)  + 'px'
    });
  }
});

// for backwards compatibility
Effect.MoveBy = function(element, toTop, toLeft) {
  return new Effect.Move(element, 
    Object.extend({ x: toLeft, y: toTop }, arguments[3] || {}));
};

Effect.Scale = Class.create();
Object.extend(Object.extend(Effect.Scale.prototype, Effect.Base.prototype), {
  initialize: function(element, percent) {
    this.element = $(element);
    if(!this.element) throw(Effect._elementDoesNotExistError);
    var options = Object.extend({
      scaleX: true,
      scaleY: true,
      scaleContent: true,
      scaleFromCenter: false,
      scaleMode: 'box',        // 'box' or 'contents' or {} with provided values
      scaleFrom: 100.0,
      scaleTo:   percent
    }, arguments[2] || {});
    this.start(options);
  },
  setup: function() {
    this.restoreAfterFinish = this.options.restoreAfterFinish || false;
    this.elementPositioning = this.element.getStyle('position');
    
    this.originalStyle = {};
    ['top','left','width','height','fontSize'].each( function(k) {
      this.originalStyle[k] = this.element.style[k];
    }.bind(this));
      
    this.originalTop  = this.element.offsetTop;
    this.originalLeft = this.element.offsetLeft;
    
    var fontSize = this.element.getStyle('font-size') || '100%';
    ['em','px','%','pt'].each( function(fontSizeType) {
      if(fontSize.indexOf(fontSizeType)>0) {
        this.fontSize     = parseFloat(fontSize);
        this.fontSizeType = fontSizeType;
      }
    }.bind(this));
    
    this.factor = (this.options.scaleTo - this.options.scaleFrom)/100;
    
    this.dims = null;
    if(this.options.scaleMode=='box')
      this.dims = [this.element.offsetHeight, this.element.offsetWidth];
    if(/^content/.test(this.options.scaleMode))
      this.dims = [this.element.scrollHeight, this.element.scrollWidth];
    if(!this.dims)
      this.dims = [this.options.scaleMode.originalHeight,
                   this.options.scaleMode.originalWidth];
  },
  update: function(position) {
    var currentScale = (this.options.scaleFrom/100.0) + (this.factor * position);
    if(this.options.scaleContent && this.fontSize)
      this.element.setStyle({fontSize: this.fontSize * currentScale + this.fontSizeType });
    this.setDimensions(this.dims[0] * currentScale, this.dims[1] * currentScale);
  },
  finish: function(position) {
    if(this.restoreAfterFinish) this.element.setStyle(this.originalStyle);
  },
  setDimensions: function(height, width) {
    var d = {};
    if(this.options.scaleX) d.width = Math.round(width) + 'px';
    if(this.options.scaleY) d.height = Math.round(height) + 'px';
    if(this.options.scaleFromCenter) {
      var topd  = (height - this.dims[0])/2;
      var leftd = (width  - this.dims[1])/2;
      if(this.elementPositioning == 'absolute') {
        if(this.options.scaleY) d.top = this.originalTop-topd + 'px';
        if(this.options.scaleX) d.left = this.originalLeft-leftd + 'px';
      } else {
        if(this.options.scaleY) d.top = -topd + 'px';
        if(this.options.scaleX) d.left = -leftd + 'px';
      }
    }
    this.element.setStyle(d);
  }
});

Effect.Highlight = Class.create();
Object.extend(Object.extend(Effect.Highlight.prototype, Effect.Base.prototype), {
  initialize: function(element) {
    this.element = $(element);
    if(!this.element) throw(Effect._elementDoesNotExistError);
    var options = Object.extend({ startcolor: '#ffff99' }, arguments[1] || {});
    this.start(options);
  },
  setup: function() {
    // Prevent executing on elements not in the layout flow
    if(this.element.getStyle('display')=='none') { this.cancel(); return; }
    // Disable background image during the effect
    this.oldStyle = {};
    if (!this.options.keepBackgroundImage) {
      this.oldStyle.backgroundImage = this.element.getStyle('background-image');
      this.element.setStyle({backgroundImage: 'none'});
    }
    if(!this.options.endcolor)
      this.options.endcolor = this.element.getStyle('background-color').parseColor('#ffffff');
    if(!this.options.restorecolor)
      this.options.restorecolor = this.element.getStyle('background-color');
    // init color calculations
    this._base  = $R(0,2).map(function(i){ return parseInt(this.options.startcolor.slice(i*2+1,i*2+3),16) }.bind(this));
    this._delta = $R(0,2).map(function(i){ return parseInt(this.options.endcolor.slice(i*2+1,i*2+3),16)-this._base[i] }.bind(this));
  },
  update: function(position) {
    this.element.setStyle({backgroundColor: $R(0,2).inject('#',function(m,v,i){
      return m+(Math.round(this._base[i]+(this._delta[i]*position)).toColorPart()); }.bind(this)) });
  },
  finish: function() {
    this.element.setStyle(Object.extend(this.oldStyle, {
      backgroundColor: this.options.restorecolor
    }));
  }
});

Effect.ScrollTo = Class.create();
Object.extend(Object.extend(Effect.ScrollTo.prototype, Effect.Base.prototype), {
  initialize: function(element) {
    this.element = $(element);
    this.start(arguments[1] || {});
  },
  setup: function() {
    Position.prepare();
    var offsets = Position.cumulativeOffset(this.element);
    if(this.options.offset) offsets[1] += this.options.offset;
    var max = window.innerHeight ? 
      window.height - window.innerHeight :
      document.body.scrollHeight - 
        (document.documentElement.clientHeight ? 
          document.documentElement.clientHeight : document.body.clientHeight);
    this.scrollStart = Position.deltaY;
    this.delta = (offsets[1] > max ? max : offsets[1]) - this.scrollStart;
  },
  update: function(position) {
    Position.prepare();
    window.scrollTo(Position.deltaX, 
      this.scrollStart + (position*this.delta));
  }
});

/* ------------- combination effects ------------- */

Effect.Fade = function(element) {
  element = $(element);
  var oldOpacity = element.getInlineOpacity();
  var options = Object.extend({
  from: element.getOpacity() || 1.0,
  to:   0.0,
  afterFinishInternal: function(effect) { 
    if(effect.options.to!=0) return;
    effect.element.hide().setStyle({opacity: oldOpacity}); 
  }}, arguments[1] || {});
  return new Effect.Opacity(element,options);
}

Effect.Appear = function(element) {
  element = $(element);
  var options = Object.extend({
  from: (element.getStyle('display') == 'none' ? 0.0 : element.getOpacity() || 0.0),
  to:   1.0,
  // force Safari to render floated elements properly
  afterFinishInternal: function(effect) {
    effect.element.forceRerendering();
  },
  beforeSetup: function(effect) {
    effect.element.setOpacity(effect.options.from).show(); 
  }}, arguments[1] || {});
  return new Effect.Opacity(element,options);
}

Effect.Puff = function(element) {
  element = $(element);
  var oldStyle = { 
    opacity: element.getInlineOpacity(), 
    position: element.getStyle('position'),
    top:  element.style.top,
    left: element.style.left,
    width: element.style.width,
    height: element.style.height
  };
  return new Effect.Parallel(
   [ new Effect.Scale(element, 200, 
      { sync: true, scaleFromCenter: true, scaleContent: true, restoreAfterFinish: true }), 
     new Effect.Opacity(element, { sync: true, to: 0.0 } ) ], 
     Object.extend({ duration: 1.0, 
      beforeSetupInternal: function(effect) {
        Position.absolutize(effect.effects[0].element)
      },
      afterFinishInternal: function(effect) {
         effect.effects[0].element.hide().setStyle(oldStyle); }
     }, arguments[1] || {})
   );
}

Effect.BlindUp = function(element) {
  element = $(element);
  element.makeClipping();
  return new Effect.Scale(element, 0,
    Object.extend({ scaleContent: false, 
      scaleX: false, 
      restoreAfterFinish: true,
      afterFinishInternal: function(effect) {
        effect.element.hide().undoClipping();
      } 
    }, arguments[1] || {})
  );
}

Effect.BlindDown = function(element) {
  element = $(element);
  var elementDimensions = element.getDimensions();
  return new Effect.Scale(element, 100, Object.extend({ 
    scaleContent: false, 
    scaleX: false,
    scaleFrom: 0,
    scaleMode: {originalHeight: elementDimensions.height, originalWidth: elementDimensions.width},
    restoreAfterFinish: true,
    afterSetup: function(effect) {
      effect.element.makeClipping().setStyle({height: '0px'}).show(); 
    },  
    afterFinishInternal: function(effect) {
      effect.element.undoClipping();
    }
  }, arguments[1] || {}));
}

Effect.SwitchOff = function(element) {
  element = $(element);
  var oldOpacity = element.getInlineOpacity();
  return new Effect.Appear(element, Object.extend({
    duration: 0.4,
    from: 0,
    transition: Effect.Transitions.flicker,
    afterFinishInternal: function(effect) {
      new Effect.Scale(effect.element, 1, { 
        duration: 0.3, scaleFromCenter: true,
        scaleX: false, scaleContent: false, restoreAfterFinish: true,
        beforeSetup: function(effect) { 
          effect.element.makePositioned().makeClipping();
        },
        afterFinishInternal: function(effect) {
          effect.element.hide().undoClipping().undoPositioned().setStyle({opacity: oldOpacity});
        }
      })
    }
  }, arguments[1] || {}));
}

Effect.DropOut = function(element) {
  element = $(element);
  var oldStyle = {
    top: element.getStyle('top'),
    left: element.getStyle('left'),
    opacity: element.getInlineOpacity() };
  return new Effect.Parallel(
    [ new Effect.Move(element, {x: 0, y: 100, sync: true }), 
      new Effect.Opacity(element, { sync: true, to: 0.0 }) ],
    Object.extend(
      { duration: 0.5,
        beforeSetup: function(effect) {
          effect.effects[0].element.makePositioned(); 
        },
        afterFinishInternal: function(effect) {
          effect.effects[0].element.hide().undoPositioned().setStyle(oldStyle);
        } 
      }, arguments[1] || {}));
}

Effect.Shake = function(element) {
  element = $(element);
  var oldStyle = {
    top: element.getStyle('top'),
    left: element.getStyle('left') };
    return new Effect.Move(element, 
      { x:  20, y: 0, duration: 0.05, afterFinishInternal: function(effect) {
    new Effect.Move(effect.element,
      { x: -40, y: 0, duration: 0.1,  afterFinishInternal: function(effect) {
    new Effect.Move(effect.element,
      { x:  40, y: 0, duration: 0.1,  afterFinishInternal: function(effect) {
    new Effect.Move(effect.element,
      { x: -40, y: 0, duration: 0.1,  afterFinishInternal: function(effect) {
    new Effect.Move(effect.element,
      { x:  40, y: 0, duration: 0.1,  afterFinishInternal: function(effect) {
    new Effect.Move(effect.element,
      { x: -20, y: 0, duration: 0.05, afterFinishInternal: function(effect) {
        effect.element.undoPositioned().setStyle(oldStyle);
  }}) }}) }}) }}) }}) }});
}

Effect.SlideDown = function(element) {
  element = $(element).cleanWhitespace();
  // SlideDown need to have the content of the element wrapped in a container element with fixed height!
  var oldInnerBottom = element.down().getStyle('bottom');
  var elementDimensions = element.getDimensions();
  return new Effect.Scale(element, 100, Object.extend({ 
    scaleContent: false, 
    scaleX: false, 
    scaleFrom: window.opera ? 0 : 1,
    scaleMode: {originalHeight: elementDimensions.height, originalWidth: elementDimensions.width},
    restoreAfterFinish: true,
    afterSetup: function(effect) {
      effect.element.makePositioned();
      effect.element.down().makePositioned();
      if(window.opera) effect.element.setStyle({top: ''});
      effect.element.makeClipping().setStyle({height: '0px'}).show(); 
    },
    afterUpdateInternal: function(effect) {
      effect.element.down().setStyle({bottom:
        (effect.dims[0] - effect.element.clientHeight) + 'px' }); 
    },
    afterFinishInternal: function(effect) {
      effect.element.undoClipping().undoPositioned();
      effect.element.down().undoPositioned().setStyle({bottom: oldInnerBottom}); }
    }, arguments[1] || {})
  );
}

Effect.SlideUp = function(element) {
  element = $(element).cleanWhitespace();
  var oldInnerBottom = element.down().getStyle('bottom');
  return new Effect.Scale(element, window.opera ? 0 : 1,
   Object.extend({ scaleContent: false, 
    scaleX: false, 
    scaleMode: 'box',
    scaleFrom: 100,
    restoreAfterFinish: true,
    beforeStartInternal: function(effect) {
      effect.element.makePositioned();
      effect.element.down().makePositioned();
      if(window.opera) effect.element.setStyle({top: ''});
      effect.element.makeClipping().show();
    },  
    afterUpdateInternal: function(effect) {
      effect.element.down().setStyle({bottom:
        (effect.dims[0] - effect.element.clientHeight) + 'px' });
    },
    afterFinishInternal: function(effect) {
      effect.element.hide().undoClipping().undoPositioned().setStyle({bottom: oldInnerBottom});
      effect.element.down().undoPositioned();
    }
   }, arguments[1] || {})
  );
}

// Bug in opera makes the TD containing this element expand for a instance after finish 
Effect.Squish = function(element) {
  return new Effect.Scale(element, window.opera ? 1 : 0, { 
    restoreAfterFinish: true,
    beforeSetup: function(effect) {
      effect.element.makeClipping(); 
    },  
    afterFinishInternal: function(effect) {
      effect.element.hide().undoClipping(); 
    }
  });
}

Effect.Grow = function(element) {
  element = $(element);
  var options = Object.extend({
    direction: 'center',
    moveTransition: Effect.Transitions.sinoidal,
    scaleTransition: Effect.Transitions.sinoidal,
    opacityTransition: Effect.Transitions.full
  }, arguments[1] || {});
  var oldStyle = {
    top: element.style.top,
    left: element.style.left,
    height: element.style.height,
    width: element.style.width,
    opacity: element.getInlineOpacity() };

  var dims = element.getDimensions();    
  var initialMoveX, initialMoveY;
  var moveX, moveY;
  
  switch (options.direction) {
    case 'top-left':
      initialMoveX = initialMoveY = moveX = moveY = 0; 
      break;
    case 'top-right':
      initialMoveX = dims.width;
      initialMoveY = moveY = 0;
      moveX = -dims.width;
      break;
    case 'bottom-left':
      initialMoveX = moveX = 0;
      initialMoveY = dims.height;
      moveY = -dims.height;
      break;
    case 'bottom-right':
      initialMoveX = dims.width;
      initialMoveY = dims.height;
      moveX = -dims.width;
      moveY = -dims.height;
      break;
    case 'center':
      initialMoveX = dims.width / 2;
      initialMoveY = dims.height / 2;
      moveX = -dims.width / 2;
      moveY = -dims.height / 2;
      break;
  }
  
  return new Effect.Move(element, {
    x: initialMoveX,
    y: initialMoveY,
    duration: 0.01, 
    beforeSetup: function(effect) {
      effect.element.hide().makeClipping().makePositioned();
    },
    afterFinishInternal: function(effect) {
      new Effect.Parallel(
        [ new Effect.Opacity(effect.element, { sync: true, to: 1.0, from: 0.0, transition: options.opacityTransition }),
          new Effect.Move(effect.element, { x: moveX, y: moveY, sync: true, transition: options.moveTransition }),
          new Effect.Scale(effect.element, 100, {
            scaleMode: { originalHeight: dims.height, originalWidth: dims.width }, 
            sync: true, scaleFrom: window.opera ? 1 : 0, transition: options.scaleTransition, restoreAfterFinish: true})
        ], Object.extend({
             beforeSetup: function(effect) {
               effect.effects[0].element.setStyle({height: '0px'}).show(); 
             },
             afterFinishInternal: function(effect) {
               effect.effects[0].element.undoClipping().undoPositioned().setStyle(oldStyle); 
             }
           }, options)
      )
    }
  });
}

Effect.Shrink = function(element) {
  element = $(element);
  var options = Object.extend({
    direction: 'center',
    moveTransition: Effect.Transitions.sinoidal,
    scaleTransition: Effect.Transitions.sinoidal,
    opacityTransition: Effect.Transitions.none
  }, arguments[1] || {});
  var oldStyle = {
    top: element.style.top,
    left: element.style.left,
    height: element.style.height,
    width: element.style.width,
    opacity: element.getInlineOpacity() };

  var dims = element.getDimensions();
  var moveX, moveY;
  
  switch (options.direction) {
    case 'top-left':
      moveX = moveY = 0;
      break;
    case 'top-right':
      moveX = dims.width;
      moveY = 0;
      break;
    case 'bottom-left':
      moveX = 0;
      moveY = dims.height;
      break;
    case 'bottom-right':
      moveX = dims.width;
      moveY = dims.height;
      break;
    case 'center':  
      moveX = dims.width / 2;
      moveY = dims.height / 2;
      break;
  }
  
  return new Effect.Parallel(
    [ new Effect.Opacity(element, { sync: true, to: 0.0, from: 1.0, transition: options.opacityTransition }),
      new Effect.Scale(element, window.opera ? 1 : 0, { sync: true, transition: options.scaleTransition, restoreAfterFinish: true}),
      new Effect.Move(element, { x: moveX, y: moveY, sync: true, transition: options.moveTransition })
    ], Object.extend({            
         beforeStartInternal: function(effect) {
           effect.effects[0].element.makePositioned().makeClipping(); 
         },
         afterFinishInternal: function(effect) {
           effect.effects[0].element.hide().undoClipping().undoPositioned().setStyle(oldStyle); }
       }, options)
  );
}

Effect.Pulsate = function(element) {
  element = $(element);
  var options    = arguments[1] || {};
  var oldOpacity = element.getInlineOpacity();
  var transition = options.transition || Effect.Transitions.sinoidal;
  var reverser   = function(pos){ return transition(1-Effect.Transitions.pulse(pos, options.pulses)) };
  reverser.bind(transition);
  return new Effect.Opacity(element, 
    Object.extend(Object.extend({  duration: 2.0, from: 0,
      afterFinishInternal: function(effect) { effect.element.setStyle({opacity: oldOpacity}); }
    }, options), {transition: reverser}));
}

Effect.Fold = function(element) {
  element = $(element);
  var oldStyle = {
    top: element.style.top,
    left: element.style.left,
    width: element.style.width,
    height: element.style.height };
  element.makeClipping();
  return new Effect.Scale(element, 5, Object.extend({   
    scaleContent: false,
    scaleX: false,
    afterFinishInternal: function(effect) {
    new Effect.Scale(element, 1, { 
      scaleContent: false, 
      scaleY: false,
      afterFinishInternal: function(effect) {
        effect.element.hide().undoClipping().setStyle(oldStyle);
      } });
  }}, arguments[1] || {}));
};

Effect.Morph = Class.create();
Object.extend(Object.extend(Effect.Morph.prototype, Effect.Base.prototype), {
  initialize: function(element) {
    this.element = $(element);
    if(!this.element) throw(Effect._elementDoesNotExistError);
    var options = Object.extend({
      style: {}
    }, arguments[1] || {});
    if (typeof options.style == 'string') {
      if(options.style.indexOf(':') == -1) {
        var cssText = '', selector = '.' + options.style;
        $A(document.styleSheets).reverse().each(function(styleSheet) {
          if (styleSheet.cssRules) cssRules = styleSheet.cssRules;
          else if (styleSheet.rules) cssRules = styleSheet.rules;
          $A(cssRules).reverse().each(function(rule) {
            if (selector == rule.selectorText) {
              cssText = rule.style.cssText;
              throw $break;
            }
          });
          if (cssText) throw $break;
        });
        this.style = cssText.parseStyle();
        options.afterFinishInternal = function(effect){
          effect.element.addClassName(effect.options.style);
          effect.transforms.each(function(transform) {
            if(transform.style != 'opacity')
              effect.element.style[transform.style] = '';
          });
        }
      } else this.style = options.style.parseStyle();
    } else this.style = $H(options.style)
    this.start(options);
  },
  setup: function(){
    function parseColor(color){
      if(!color || ['rgba(0, 0, 0, 0)','transparent'].include(color)) color = '#ffffff';
      color = color.parseColor();
      return $R(0,2).map(function(i){
        return parseInt( color.slice(i*2+1,i*2+3), 16 ) 
      });
    }
    this.transforms = this.style.map(function(pair){
      var property = pair[0], value = pair[1], unit = null;

      if(value.parseColor('#zzzzzz') != '#zzzzzz') {
        value = value.parseColor();
        unit  = 'color';
      } else if(property == 'opacity') {
        value = parseFloat(value);
        if(Prototype.Browser.IE && (!this.element.currentStyle.hasLayout))
          this.element.setStyle({zoom: 1});
      } else if(Element.CSS_LENGTH.test(value)) {
          var components = value.match(/^([\+\-]?[0-9\.]+)(.*)$/);
          value = parseFloat(components[1]);
          unit = (components.length == 3) ? components[2] : null;
      }

      var originalValue = this.element.getStyle(property);
      return { 
        style: property.camelize(), 
        originalValue: unit=='color' ? parseColor(originalValue) : parseFloat(originalValue || 0), 
        targetValue: unit=='color' ? parseColor(value) : value,
        unit: unit
      };
    }.bind(this)).reject(function(transform){
      return (
        (transform.originalValue == transform.targetValue) ||
        (
          transform.unit != 'color' &&
          (isNaN(transform.originalValue) || isNaN(transform.targetValue))
        )
      )
    });
  },
  update: function(position) {
    var style = {}, transform, i = this.transforms.length;
    while(i--)
      style[(transform = this.transforms[i]).style] = 
        transform.unit=='color' ? '#'+
          (Math.round(transform.originalValue[0]+
            (transform.targetValue[0]-transform.originalValue[0])*position)).toColorPart() +
          (Math.round(transform.originalValue[1]+
            (transform.targetValue[1]-transform.originalValue[1])*position)).toColorPart() +
          (Math.round(transform.originalValue[2]+
            (transform.targetValue[2]-transform.originalValue[2])*position)).toColorPart() :
        transform.originalValue + Math.round(
          ((transform.targetValue - transform.originalValue) * position) * 1000)/1000 + transform.unit;
    this.element.setStyle(style, true);
  }
});

Effect.Transform = Class.create();
Object.extend(Effect.Transform.prototype, {
  initialize: function(tracks){
    this.tracks  = [];
    this.options = arguments[1] || {};
    this.addTracks(tracks);
  },
  addTracks: function(tracks){
    tracks.each(function(track){
      var data = $H(track).values().first();
      this.tracks.push($H({
        ids:     $H(track).keys().first(),
        effect:  Effect.Morph,
        options: { style: data }
      }));
    }.bind(this));
    return this;
  },
  play: function(){
    return new Effect.Parallel(
      this.tracks.map(function(track){
        var elements = [$(track.ids) || $$(track.ids)].flatten();
        return elements.map(function(e){ return new track.effect(e, Object.extend({ sync:true }, track.options)) });
      }).flatten(),
      this.options
    );
  }
});

Element.CSS_PROPERTIES = $w(
  'backgroundColor backgroundPosition borderBottomColor borderBottomStyle ' + 
  'borderBottomWidth borderLeftColor borderLeftStyle borderLeftWidth ' +
  'borderRightColor borderRightStyle borderRightWidth borderSpacing ' +
  'borderTopColor borderTopStyle borderTopWidth bottom clip color ' +
  'fontSize fontWeight height left letterSpacing lineHeight ' +
  'marginBottom marginLeft marginRight marginTop markerOffset maxHeight '+
  'maxWidth minHeight minWidth opacity outlineColor outlineOffset ' +
  'outlineWidth paddingBottom paddingLeft paddingRight paddingTop ' +
  'right textIndent top width wordSpacing zIndex');
  
Element.CSS_LENGTH = /^(([\+\-]?[0-9\.]+)(em|ex|px|in|cm|mm|pt|pc|\%))|0$/;

String.__parseStyleElement = document.createElement('div');
String.prototype.parseStyle = function(){
  String.__parseStyleElement.innerHTML = '<div style="' + this + '"></div>';
  var style = String.__parseStyleElement.childNodes[0].style, styleRules = $H();
  
  Element.CSS_PROPERTIES.each(function(property){
    if(style[property]) styleRules[property] = style[property]; 
  });
  
  if(Prototype.Browser.IE && this.indexOf('opacity') > -1)
    styleRules.opacity = this.match(/opacity:\s*((?:0|1)?(?:\.\d*)?)/)[1];

  return styleRules;
};

Effect.Methods = {
  morph: function(element, style) {
    element = $(element);
    new Effect.Morph(element, Object.extend({ style: style }, arguments[2] || {}));
    return element;
  },
  visualEffect: function(element, effect, options) {
    element = $(element)
    var s = effect.dasherize().camelize(), klass = s.charAt(0).toUpperCase() + s.substring(1);
    new Effect[klass](element, options);
    return element;
  },
  highlight: function(element, options) {
    element = $(element);
    new Effect.Highlight(element, options);
    return element;
  }
};

$w('fade appear grow shrink fold blindUp blindDown slideUp slideDown '+
  'pulsate shake puff squish switchOff dropOut').each(
  function(effect) { 
    Effect.Methods[effect] = function(element, options){
      element = $(element);
      Effect[effect.charAt(0).toUpperCase() + effect.substring(1)](element, options);
      return element;
    }
  }
);

$w('getInlineOpacity forceRerendering setContentZoom collectTextNodes collectTextNodesIgnoreClass').each( 
  function(f) { Effect.Methods[f] = Element[f]; }
);

Element.addMethods(Effect.Methods);


/***************************************************
 * library/scriptaculous/builder.js
 ***************************************************/

// Copyright (c) 2005-2007 Thomas Fuchs (http://script.aculo.us, http://mir.aculo.us)
//
// script.aculo.us is freely distributable under the terms of an MIT-style license.
// For details, see the script.aculo.us web site: http://script.aculo.us/

var Builder = {
  NODEMAP: {
    AREA: 'map',
    CAPTION: 'table',
    COL: 'table',
    COLGROUP: 'table',
    LEGEND: 'fieldset',
    OPTGROUP: 'select',
    OPTION: 'select',
    PARAM: 'object',
    TBODY: 'table',
    TD: 'table',
    TFOOT: 'table',
    TH: 'table',
    THEAD: 'table',
    TR: 'table'
  },
  // note: For Firefox < 1.5, OPTION and OPTGROUP tags are currently broken,
  //       due to a Firefox bug
  node: function(elementName) {
    elementName = elementName.toUpperCase();
    
    // try innerHTML approach
    var parentTag = this.NODEMAP[elementName] || 'div';
    var parentElement = document.createElement(parentTag);
    try { // prevent IE "feature": http://dev.rubyonrails.org/ticket/2707
      parentElement.innerHTML = "<" + elementName + "></" + elementName + ">";
    } catch(e) {}
    var element = parentElement.firstChild || null;
      
    // see if browser added wrapping tags
    if(element && (element.tagName.toUpperCase() != elementName))
      element = element.getElementsByTagName(elementName)[0];
    
    // fallback to createElement approach
    if(!element) element = document.createElement(elementName);
    
    // abort if nothing could be created
    if(!element) return;

    // attributes (or text)
    if(arguments[1])
      if(this._isStringOrNumber(arguments[1]) ||
        (arguments[1] instanceof Array) ||
        arguments[1].tagName) {
          this._children(element, arguments[1]);
        } else {
          var attrs = this._attributes(arguments[1]);
          if(attrs.length) {
            try { // prevent IE "feature": http://dev.rubyonrails.org/ticket/2707
              parentElement.innerHTML = "<" +elementName + " " +
                attrs + "></" + elementName + ">";
            } catch(e) {}
            element = parentElement.firstChild || null;
            // workaround firefox 1.0.X bug
            if(!element) {
              element = document.createElement(elementName);
              for(attr in arguments[1]) 
                element[attr == 'class' ? 'className' : attr] = arguments[1][attr];
            }
            if(element.tagName.toUpperCase() != elementName)
              element = parentElement.getElementsByTagName(elementName)[0];
          }
        } 

    // text, or array of children
    if(arguments[2])
      this._children(element, arguments[2]);

     return element;
  },
  _text: function(text) {
     return document.createTextNode(text);
  },

  ATTR_MAP: {
    'className': 'class',
    'htmlFor': 'for'
  },

  _attributes: function(attributes) {
    var attrs = [];
    for(attribute in attributes)
      attrs.push((attribute in this.ATTR_MAP ? this.ATTR_MAP[attribute] : attribute) +
          '="' + attributes[attribute].toString().escapeHTML().gsub(/"/,'&quot;') + '"');
    return attrs.join(" ");
  },
  _children: function(element, children) {
    if(children.tagName) {
      element.appendChild(children);
      return;
    }
    if(typeof children=='object') { // array can hold nodes and text
      children.flatten().each( function(e) {
        if(typeof e=='object')
          element.appendChild(e)
        else
          if(Builder._isStringOrNumber(e))
            element.appendChild(Builder._text(e));
      });
    } else
      if(Builder._isStringOrNumber(children))
        element.appendChild(Builder._text(children));
  },
  _isStringOrNumber: function(param) {
    return(typeof param=='string' || typeof param=='number');
  },
  build: function(html) {
    var element = this.node('div');
    $(element).update(html.strip());
    return element.down();
  },
  dump: function(scope) { 
    if(typeof scope != 'object' && typeof scope != 'function') scope = window; //global scope 
  
    var tags = ("A ABBR ACRONYM ADDRESS APPLET AREA B BASE BASEFONT BDO BIG BLOCKQUOTE BODY " +
      "BR BUTTON CAPTION CENTER CITE CODE COL COLGROUP DD DEL DFN DIR DIV DL DT EM FIELDSET " +
      "FONT FORM FRAME FRAMESET H1 H2 H3 H4 H5 H6 HEAD HR HTML I IFRAME IMG INPUT INS ISINDEX "+
      "KBD LABEL LEGEND LI LINK MAP MENU META NOFRAMES NOSCRIPT OBJECT OL OPTGROUP OPTION P "+
      "PARAM PRE Q S SAMP SCRIPT SELECT SMALL SPAN STRIKE STRONG STYLE SUB SUP TABLE TBODY TD "+
      "TEXTAREA TFOOT TH THEAD TITLE TR TT U UL VAR").split(/\s+/);
  
    tags.each( function(tag){ 
      scope[tag] = function() { 
        return Builder.node.apply(Builder, [tag].concat($A(arguments)));  
      } 
    });
  }
}



/***************************************************
 * library/scriptaculous/controls.js
 ***************************************************/

// Copyright (c) 2005-2007 Thomas Fuchs (http://script.aculo.us, http://mir.aculo.us)
//           (c) 2005-2007 Ivan Krstic (http://blogs.law.harvard.edu/ivan)
//           (c) 2005-2007 Jon Tirsen (http://www.tirsen.com)
// Contributors:
//  Richard Livsey
//  Rahul Bhargava
//  Rob Wills
// 
// script.aculo.us is freely distributable under the terms of an MIT-style license.
// For details, see the script.aculo.us web site: http://script.aculo.us/

// Autocompleter.Base handles all the autocompletion functionality 
// that's independent of the data source for autocompletion. This
// includes drawing the autocompletion menu, observing keyboard
// and mouse events, and similar.
//
// Specific autocompleters need to provide, at the very least, 
// a getUpdatedChoices function that will be invoked every time
// the text inside the monitored textbox changes. This method 
// should get the text for which to provide autocompletion by
// invoking this.getToken(), NOT by directly accessing
// this.element.value. This is to allow incremental tokenized
// autocompletion. Specific auto-completion logic (AJAX, etc)
// belongs in getUpdatedChoices.
//
// Tokenized incremental autocompletion is enabled automatically
// when an autocompleter is instantiated with the 'tokens' option
// in the options parameter, e.g.:
// new Ajax.Autocompleter('id','upd', '/url/', { tokens: ',' });
// will incrementally autocomplete with a comma as the token.
// Additionally, ',' in the above example can be replaced with
// a token array, e.g. { tokens: [',', '\n'] } which
// enables autocompletion on multiple tokens. This is most 
// useful when one of the tokens is \n (a newline), as it 
// allows smart autocompletion after linebreaks.

if(typeof Effect == 'undefined')
  throw("controls.js requires including script.aculo.us' effects.js library");

var Autocompleter = {}
Autocompleter.Base = function() {};
Autocompleter.Base.prototype = {
  baseInitialize: function(element, update, options) {
    element          = $(element)
    this.element     = element; 
    this.update      = $(update);  
    this.hasFocus    = false; 
    this.changed     = false; 
    this.active      = false; 
    this.index       = 0;     
    this.entryCount  = 0;
    this.oldElementValue = this.element.value;

    if(this.setOptions)
      this.setOptions(options);
    else
      this.options = options || {};

    this.options.paramName    = this.options.paramName || this.element.name;
    this.options.tokens       = this.options.tokens || [];
    this.options.frequency    = this.options.frequency || 0.4;
    this.options.minChars     = this.options.minChars || 1;
    this.options.onShow       = this.options.onShow || 
      function(element, update){ 
        if(!update.style.position || update.style.position=='absolute') {
          update.style.position = 'absolute';
          Position.clone(element, update, {
            setHeight: false, 
            offsetTop: element.offsetHeight
          });
        }
        Effect.Appear(update,{duration:0.15});
      };
    this.options.onHide = this.options.onHide || 
      function(element, update){ new Effect.Fade(update,{duration:0.15}) };

    if(typeof(this.options.tokens) == 'string') 
      this.options.tokens = new Array(this.options.tokens);
    // Force carriage returns as token delimiters anyway
    if (!this.options.tokens.include('\n'))
      this.options.tokens.push('\n');

    this.observer = null;
    
    this.element.setAttribute('autocomplete','off');

    Element.hide(this.update);

    Event.observe(this.element, 'blur', this.onBlur.bindAsEventListener(this));
    Event.observe(this.element, 'keypress', this.onKeyPress.bindAsEventListener(this));

    // Turn autocomplete back on when the user leaves the page, so that the
    // field's value will be remembered on Mozilla-based browsers.
    if(Prototype.Browser.Gecko)
      Event.observe(window, 'beforeunload', function(){
        element.setAttribute('autocomplete', 'on');
      });
  },

  show: function() {
    if(Element.getStyle(this.update, 'display')=='none') this.options.onShow(this.element, this.update);
    if(!this.iefix && 
      (Prototype.Browser.IE) &&
      (Element.getStyle(this.update, 'position')=='absolute')) {
      new Insertion.After(this.update, 
       '<iframe id="' + this.update.id + '_iefix" '+
       'style="display:none;position:absolute;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);" ' +
       'src="javascript:false;" frameborder="0" scrolling="no"></iframe>');
      this.iefix = $(this.update.id+'_iefix');
    }
    if(this.iefix) setTimeout(this.fixIEOverlapping.bind(this), 50);
  },
  
  fixIEOverlapping: function() {
    Position.clone(this.update, this.iefix, {setTop:(!this.update.style.height)});
    this.iefix.style.zIndex = 1;
    this.update.style.zIndex = 2;
    Element.show(this.iefix);
  },

  hide: function() {
    this.stopIndicator();
    if(Element.getStyle(this.update, 'display')!='none') this.options.onHide(this.element, this.update);
    if(this.iefix) Element.hide(this.iefix);
  },

  startIndicator: function() {
    if(this.options.indicator) Element.show(this.options.indicator);
  },

  stopIndicator: function() {
    if(this.options.indicator) Element.hide(this.options.indicator);
  },

  onKeyPress: function(event) {
    if(this.active)
      switch(event.keyCode) {
       case Event.KEY_TAB:
       case Event.KEY_RETURN:
         this.selectEntry();
         Event.stop(event);
       case Event.KEY_ESC:
         this.hide();
         this.active = false;
         Event.stop(event);
         return;
       case Event.KEY_LEFT:
       case Event.KEY_RIGHT:
         return;
       case Event.KEY_UP:
         this.markPrevious();
         this.render();
         if(Prototype.Browser.WebKit) Event.stop(event);
         return;
       case Event.KEY_DOWN:
         this.markNext();
         this.render();
         if(Prototype.Browser.WebKit) Event.stop(event);
         return;
      }
     else 
       if(event.keyCode==Event.KEY_TAB || event.keyCode==Event.KEY_RETURN || 
         (Prototype.Browser.WebKit > 0 && event.keyCode == 0)) return;

    this.changed = true;
    this.hasFocus = true;

    if(this.observer) clearTimeout(this.observer);
      this.observer = 
        setTimeout(this.onObserverEvent.bind(this), this.options.frequency*1000);
  },

  activate: function() {
    this.changed = false;
    this.hasFocus = true;
    this.getUpdatedChoices();
  },

  onHover: function(event) {
    var element = Event.findElement(event, 'LI');
    if(this.index != element.autocompleteIndex) 
    {
        this.index = element.autocompleteIndex;
        this.render();
    }
    Event.stop(event);
  },
  
  onClick: function(event) {
    var element = Event.findElement(event, 'LI');
    this.index = element.autocompleteIndex;
    this.selectEntry();
    this.hide();
  },
  
  onBlur: function(event) {
    // needed to make click events working
    setTimeout(this.hide.bind(this), 250);
    this.hasFocus = false;
    this.active = false;     
  }, 
  
  render: function() {
    if(this.entryCount > 0) {
      for (var i = 0; i < this.entryCount; i++)
        this.index==i ? 
          Element.addClassName(this.getEntry(i),"selected") : 
          Element.removeClassName(this.getEntry(i),"selected");
      if(this.hasFocus) { 
        this.show();
        this.active = true;
      }
    } else {
      this.active = false;
      this.hide();
    }
  },
  
  markPrevious: function() {
    if(this.index > 0) this.index--
      else this.index = this.entryCount-1;
    this.getEntry(this.index).scrollIntoView(true);
  },
  
  markNext: function() {
    if(this.index < this.entryCount-1) this.index++
      else this.index = 0;
    this.getEntry(this.index).scrollIntoView(false);
  },
  
  getEntry: function(index) {
    return this.update.firstChild.childNodes[index];
  },
  
  getCurrentEntry: function() {
    return this.getEntry(this.index);
  },
  
  selectEntry: function() {
    this.active = false;
    this.updateElement(this.getCurrentEntry());
  },

  updateElement: function(selectedElement) {
    if (this.options.updateElement) {
      this.options.updateElement(selectedElement);
      return;
    }
    var value = '';
    if (this.options.select) {
      var nodes = document.getElementsByClassName(this.options.select, selectedElement) || [];
      if(nodes.length>0) value = Element.collectTextNodes(nodes[0], this.options.select);
    } else
      value = Element.collectTextNodesIgnoreClass(selectedElement, 'informal');
    
    var bounds = this.getTokenBounds();
    if (bounds[0] != -1) {
      var newValue = this.element.value.substr(0, bounds[0]);
      var whitespace = this.element.value.substr(bounds[0]).match(/^\s+/);
      if (whitespace)
        newValue += whitespace[0];
      this.element.value = newValue + value + this.element.value.substr(bounds[1]);
    } else {
      this.element.value = value;
    }
    this.oldElementValue = this.element.value;
    this.element.focus();
    
    if (this.options.afterUpdateElement)
      this.options.afterUpdateElement(this.element, selectedElement);
  },

  updateChoices: function(choices) {
    if(!this.changed && this.hasFocus) {
      this.update.innerHTML = choices;
      Element.cleanWhitespace(this.update);
      Element.cleanWhitespace(this.update.down());

      if(this.update.firstChild && this.update.down().childNodes) {
        this.entryCount = 
          this.update.down().childNodes.length;
        for (var i = 0; i < this.entryCount; i++) {
          var entry = this.getEntry(i);
          entry.autocompleteIndex = i;
          this.addObservers(entry);
        }
      } else { 
        this.entryCount = 0;
      }

      this.stopIndicator();
      this.index = 0;
      
      if(this.entryCount==1 && this.options.autoSelect) {
        this.selectEntry();
        this.hide();
      } else {
        this.render();
      }
    }
  },

  addObservers: function(element) {
    Event.observe(element, "mouseover", this.onHover.bindAsEventListener(this));
    Event.observe(element, "click", this.onClick.bindAsEventListener(this));
  },

  onObserverEvent: function() {
    this.changed = false;   
    this.tokenBounds = null;
    if(this.getToken().length>=this.options.minChars) {
      this.getUpdatedChoices();
    } else {
      this.active = false;
      this.hide();
    }
    this.oldElementValue = this.element.value;
  },

  getToken: function() {
    var bounds = this.getTokenBounds();
    return this.element.value.substring(bounds[0], bounds[1]).strip();
  },

  getTokenBounds: function() {
    if (null != this.tokenBounds) return this.tokenBounds;
    var value = this.element.value;
    if (value.strip().empty()) return [-1, 0];
    var diff = arguments.callee.getFirstDifferencePos(value, this.oldElementValue);
    var offset = (diff == this.oldElementValue.length ? 1 : 0);
    var prevTokenPos = -1, nextTokenPos = value.length;
    var tp;
    for (var index = 0, l = this.options.tokens.length; index < l; ++index) {
      tp = value.lastIndexOf(this.options.tokens[index], diff + offset - 1);
      if (tp > prevTokenPos) prevTokenPos = tp;
      tp = value.indexOf(this.options.tokens[index], diff + offset);
      if (-1 != tp && tp < nextTokenPos) nextTokenPos = tp;
    }
    return (this.tokenBounds = [prevTokenPos + 1, nextTokenPos]);
  }
}

Autocompleter.Base.prototype.getTokenBounds.getFirstDifferencePos = function(newS, oldS) {
  var boundary = Math.min(newS.length, oldS.length);
  for (var index = 0; index < boundary; ++index)
    if (newS[index] != oldS[index])
      return index;
  return boundary;
};

Ajax.Autocompleter = Class.create();
Object.extend(Object.extend(Ajax.Autocompleter.prototype, Autocompleter.Base.prototype), {
  initialize: function(element, update, url, options) {
    this.baseInitialize(element, update, options);
    this.options.asynchronous  = true;
    this.options.onComplete    = this.onComplete.bind(this);
    this.options.defaultParams = this.options.parameters || null;
    this.url                   = url;
  },

  getUpdatedChoices: function() {
    this.startIndicator();
    
    var entry = encodeURIComponent(this.options.paramName) + '=' + 
      encodeURIComponent(this.getToken());

    this.options.parameters = this.options.callback ?
      this.options.callback(this.element, entry) : entry;

    if(this.options.defaultParams) 
      this.options.parameters += '&' + this.options.defaultParams;
    
    new Ajax.Request(this.url, this.options);
  },

  onComplete: function(request) {
    this.updateChoices(request.responseText);
  }

});

// The local array autocompleter. Used when you'd prefer to
// inject an array of autocompletion options into the page, rather
// than sending out Ajax queries, which can be quite slow sometimes.
//
// The constructor takes four parameters. The first two are, as usual,
// the id of the monitored textbox, and id of the autocompletion menu.
// The third is the array you want to autocomplete from, and the fourth
// is the options block.
//
// Extra local autocompletion options:
// - choices - How many autocompletion choices to offer
//
// - partialSearch - If false, the autocompleter will match entered
//                    text only at the beginning of strings in the 
//                    autocomplete array. Defaults to true, which will
//                    match text at the beginning of any *word* in the
//                    strings in the autocomplete array. If you want to
//                    search anywhere in the string, additionally set
//                    the option fullSearch to true (default: off).
//
// - fullSsearch - Search anywhere in autocomplete array strings.
//
// - partialChars - How many characters to enter before triggering
//                   a partial match (unlike minChars, which defines
//                   how many characters are required to do any match
//                   at all). Defaults to 2.
//
// - ignoreCase - Whether to ignore case when autocompleting.
//                 Defaults to true.
//
// It's possible to pass in a custom function as the 'selector' 
// option, if you prefer to write your own autocompletion logic.
// In that case, the other options above will not apply unless
// you support them.

Autocompleter.Local = Class.create();
Autocompleter.Local.prototype = Object.extend(new Autocompleter.Base(), {
  initialize: function(element, update, array, options) {
    this.baseInitialize(element, update, options);
    this.options.array = array;
  },

  getUpdatedChoices: function() {
    this.updateChoices(this.options.selector(this));
  },

  setOptions: function(options) {
    this.options = Object.extend({
      choices: 10,
      partialSearch: true,
      partialChars: 2,
      ignoreCase: true,
      fullSearch: false,
      selector: function(instance) {
        var ret       = []; // Beginning matches
        var partial   = []; // Inside matches
        var entry     = instance.getToken();
        var count     = 0;

        for (var i = 0; i < instance.options.array.length &&  
          ret.length < instance.options.choices ; i++) { 

          var elem = instance.options.array[i];
          var foundPos = instance.options.ignoreCase ? 
            elem.toLowerCase().indexOf(entry.toLowerCase()) : 
            elem.indexOf(entry);

          while (foundPos != -1) {
            if (foundPos == 0 && elem.length != entry.length) { 
              ret.push("<li><strong>" + elem.substr(0, entry.length) + "</strong>" + 
                elem.substr(entry.length) + "</li>");
              break;
            } else if (entry.length >= instance.options.partialChars && 
              instance.options.partialSearch && foundPos != -1) {
              if (instance.options.fullSearch || /\s/.test(elem.substr(foundPos-1,1))) {
                partial.push("<li>" + elem.substr(0, foundPos) + "<strong>" +
                  elem.substr(foundPos, entry.length) + "</strong>" + elem.substr(
                  foundPos + entry.length) + "</li>");
                break;
              }
            }

            foundPos = instance.options.ignoreCase ? 
              elem.toLowerCase().indexOf(entry.toLowerCase(), foundPos + 1) : 
              elem.indexOf(entry, foundPos + 1);

          }
        }
        if (partial.length)
          ret = ret.concat(partial.slice(0, instance.options.choices - ret.length))
        return "<ul>" + ret.join('') + "</ul>";
      }
    }, options || {});
  }
});

// AJAX in-place editor
//
// see documentation on http://wiki.script.aculo.us/scriptaculous/show/Ajax.InPlaceEditor

// Use this if you notice weird scrolling problems on some browsers,
// the DOM might be a bit confused when this gets called so do this
// waits 1 ms (with setTimeout) until it does the activation
Field.scrollFreeActivate = function(field) {
  setTimeout(function() {
    Field.activate(field);
  }, 1);
}

Ajax.InPlaceEditor = Class.create();
Ajax.InPlaceEditor.defaultHighlightColor = "#FFFF99";
Ajax.InPlaceEditor.prototype = {
  initialize: function(element, url, options) {
    this.url = url;
    this.element = $(element);

    this.options = Object.extend({
      paramName: "value",
      okButton: true,
      okLink: false,
      okText: "ok",
      cancelButton: false,
      cancelLink: true,
      cancelText: "cancel",
      textBeforeControls: '',
      textBetweenControls: '',
      textAfterControls: '',
      savingText: "Saving...",
      clickToEditText: "Click to edit",
      okText: "ok",
      rows: 1,
      onComplete: function(transport, element) {
        new Effect.Highlight(element, {startcolor: this.options.highlightcolor});
      },
      onFailure: function(transport) {
        alert("Error communicating with the server: " + transport.responseText.stripTags());
      },
      callback: function(form) {
        return Form.serialize(form);
      },
      handleLineBreaks: true,
      loadingText: 'Loading...',
      savingClassName: 'inplaceeditor-saving',
      loadingClassName: 'inplaceeditor-loading',
      formClassName: 'inplaceeditor-form',
      highlightcolor: Ajax.InPlaceEditor.defaultHighlightColor,
      highlightendcolor: "#FFFFFF",
      externalControl: null,
      submitOnBlur: false,
      ajaxOptions: {},
      evalScripts: false
    }, options || {});

    if(!this.options.formId && this.element.id) {
      this.options.formId = this.element.id + "-inplaceeditor";
      if ($(this.options.formId)) {
        // there's already a form with that name, don't specify an id
        this.options.formId = null;
      }
    }
    
    if (this.options.externalControl) {
      this.options.externalControl = $(this.options.externalControl);
    }
    
    this.originalBackground = Element.getStyle(this.element, 'background-color');
    if (!this.originalBackground) {
      this.originalBackground = "transparent";
    }
    
    this.element.title = this.options.clickToEditText;
    
    this.onclickListener = this.enterEditMode.bindAsEventListener(this);
    this.mouseoverListener = this.enterHover.bindAsEventListener(this);
    this.mouseoutListener = this.leaveHover.bindAsEventListener(this);
    Event.observe(this.element, 'click', this.onclickListener);
    Event.observe(this.element, 'mouseover', this.mouseoverListener);
    Event.observe(this.element, 'mouseout', this.mouseoutListener);
    if (this.options.externalControl) {
      Event.observe(this.options.externalControl, 'click', this.onclickListener);
      Event.observe(this.options.externalControl, 'mouseover', this.mouseoverListener);
      Event.observe(this.options.externalControl, 'mouseout', this.mouseoutListener);
    }
  },
  enterEditMode: function(evt) {
    if (this.saving) return;
    if (this.editing) return;
    this.editing = true;
    this.onEnterEditMode();
    if (this.options.externalControl) {
      Element.hide(this.options.externalControl);
    }
    Element.hide(this.element);
    this.createForm();
    this.element.parentNode.insertBefore(this.form, this.element);
    if (!this.options.loadTextURL) Field.scrollFreeActivate(this.editField);
    // stop the event to avoid a page refresh in Safari
    if (evt) {
      Event.stop(evt);
    }
    return false;
  },
  createForm: function() {
    this.form = document.createElement("form");
    this.form.id = this.options.formId;
    Element.addClassName(this.form, this.options.formClassName)
    this.form.onsubmit = this.onSubmit.bind(this);

    this.createEditField();

    if (this.options.textarea) {
      var br = document.createElement("br");
      this.form.appendChild(br);
    }
    
    if (this.options.textBeforeControls)
      this.form.appendChild(document.createTextNode(this.options.textBeforeControls));

    if (this.options.okButton) {
      var okButton = document.createElement("input");
      okButton.type = "submit";
      okButton.value = this.options.okText;
      okButton.className = 'editor_ok_button';
      this.form.appendChild(okButton);
    }
    
    if (this.options.okLink) {
      var okLink = document.createElement("a");
      okLink.href = "#";
      okLink.appendChild(document.createTextNode(this.options.okText));
      okLink.onclick = this.onSubmit.bind(this);
      okLink.className = 'editor_ok_link';
      this.form.appendChild(okLink);
    }
    
    if (this.options.textBetweenControls && 
      (this.options.okLink || this.options.okButton) && 
      (this.options.cancelLink || this.options.cancelButton))
      this.form.appendChild(document.createTextNode(this.options.textBetweenControls));
      
    if (this.options.cancelButton) {
      var cancelButton = document.createElement("input");
      cancelButton.type = "submit";
      cancelButton.value = this.options.cancelText;
      cancelButton.onclick = this.onclickCancel.bind(this);
      cancelButton.className = 'editor_cancel_button';
      this.form.appendChild(cancelButton);
    }

    if (this.options.cancelLink) {
      var cancelLink = document.createElement("a");
      cancelLink.href = "#";
      cancelLink.appendChild(document.createTextNode(this.options.cancelText));
      cancelLink.onclick = this.onclickCancel.bind(this);
      cancelLink.className = 'editor_cancel editor_cancel_link';      
      this.form.appendChild(cancelLink);
    }
    
    if (this.options.textAfterControls)
      this.form.appendChild(document.createTextNode(this.options.textAfterControls));
  },
  hasHTMLLineBreaks: function(string) {
    if (!this.options.handleLineBreaks) return false;
    return string.match(/<br/i) || string.match(/<p>/i);
  },
  convertHTMLLineBreaks: function(string) {
    return string.replace(/<br>/gi, "\n").replace(/<br\/>/gi, "\n").replace(/<\/p>/gi, "\n").replace(/<p>/gi, "");
  },
  createEditField: function() {
    var text;
    if(this.options.loadTextURL) {
      text = this.options.loadingText;
    } else {
      text = this.getText();
    }

    var obj = this;
    
    if (this.options.rows == 1 && !this.hasHTMLLineBreaks(text)) {
      this.options.textarea = false;
      var textField = document.createElement("input");
      textField.obj = this;
      textField.type = "text";
      textField.name = this.options.paramName;
      textField.value = text;
      textField.style.backgroundColor = this.options.highlightcolor;
      textField.className = 'editor_field';
      var size = this.options.size || this.options.cols || 0;
      if (size != 0) textField.size = size;
      if (this.options.submitOnBlur)
        textField.onblur = this.onSubmit.bind(this);
      this.editField = textField;
    } else {
      this.options.textarea = true;
      var textArea = document.createElement("textarea");
      textArea.obj = this;
      textArea.name = this.options.paramName;
      textArea.value = this.convertHTMLLineBreaks(text);
      textArea.rows = this.options.rows;
      textArea.cols = this.options.cols || 40;
      textArea.className = 'editor_field';      
      if (this.options.submitOnBlur)
        textArea.onblur = this.onSubmit.bind(this);
      this.editField = textArea;
    }
    
    if(this.options.loadTextURL) {
      this.loadExternalText();
    }
    this.form.appendChild(this.editField);
  },
  getText: function() {
    return this.element.innerHTML;
  },
  loadExternalText: function() {
    Element.addClassName(this.form, this.options.loadingClassName);
    this.editField.disabled = true;
    new Ajax.Request(
      this.options.loadTextURL,
      Object.extend({
        asynchronous: true,
        onComplete: this.onLoadedExternalText.bind(this)
      }, this.options.ajaxOptions)
    );
  },
  onLoadedExternalText: function(transport) {
    Element.removeClassName(this.form, this.options.loadingClassName);
    this.editField.disabled = false;
    this.editField.value = transport.responseText.stripTags();
    Field.scrollFreeActivate(this.editField);
  },
  onclickCancel: function() {
    this.onComplete();
    this.leaveEditMode();
    return false;
  },
  onFailure: function(transport) {
    this.options.onFailure(transport);
    if (this.oldInnerHTML) {
      this.element.innerHTML = this.oldInnerHTML;
      this.oldInnerHTML = null;
    }
    return false;
  },
  onSubmit: function() {
    // onLoading resets these so we need to save them away for the Ajax call
    var form = this.form;
    var value = this.editField.value;
    
    // do this first, sometimes the ajax call returns before we get a chance to switch on Saving...
    // which means this will actually switch on Saving... *after* we've left edit mode causing Saving...
    // to be displayed indefinitely
    this.onLoading();
    
    if (this.options.evalScripts) {
      new Ajax.Request(
        this.url, Object.extend({
          parameters: this.options.callback(form, value),
          onComplete: this.onComplete.bind(this),
          onFailure: this.onFailure.bind(this),
          asynchronous:true, 
          evalScripts:true
        }, this.options.ajaxOptions));
    } else  {
      new Ajax.Updater(
        { success: this.element,
          // don't update on failure (this could be an option)
          failure: null }, 
        this.url, Object.extend({
          parameters: this.options.callback(form, value),
          onComplete: this.onComplete.bind(this),
          onFailure: this.onFailure.bind(this)
        }, this.options.ajaxOptions));
    }
    // stop the event to avoid a page refresh in Safari
    if (arguments.length > 1) {
      Event.stop(arguments[0]);
    }
    return false;
  },
  onLoading: function() {
    this.saving = true;
    this.removeForm();
    this.leaveHover();
    this.showSaving();
  },
  showSaving: function() {
    this.oldInnerHTML = this.element.innerHTML;
    this.element.innerHTML = this.options.savingText;
    Element.addClassName(this.element, this.options.savingClassName);
    this.element.style.backgroundColor = this.originalBackground;
    Element.show(this.element);
  },
  removeForm: function() {
    if(this.form) {
      if (this.form.parentNode) Element.remove(this.form);
      this.form = null;
    }
  },
  enterHover: function() {
    if (this.saving) return;
    this.element.style.backgroundColor = this.options.highlightcolor;
    if (this.effect) {
      this.effect.cancel();
    }
    Element.addClassName(this.element, this.options.hoverClassName)
  },
  leaveHover: function() {
    if (this.options.backgroundColor) {
      this.element.style.backgroundColor = this.oldBackground;
    }
    Element.removeClassName(this.element, this.options.hoverClassName)
    if (this.saving) return;
    this.effect = new Effect.Highlight(this.element, {
      startcolor: this.options.highlightcolor,
      endcolor: this.options.highlightendcolor,
      restorecolor: this.originalBackground
    });
  },
  leaveEditMode: function() {
    Element.removeClassName(this.element, this.options.savingClassName);
    this.removeForm();
    this.leaveHover();
    this.element.style.backgroundColor = this.originalBackground;
    Element.show(this.element);
    if (this.options.externalControl) {
      Element.show(this.options.externalControl);
    }
    this.editing = false;
    this.saving = false;
    this.oldInnerHTML = null;
    this.onLeaveEditMode();
  },
  onComplete: function(transport) {
    this.leaveEditMode();
    this.options.onComplete.bind(this)(transport, this.element);
  },
  onEnterEditMode: function() {},
  onLeaveEditMode: function() {},
  dispose: function() {
    if (this.oldInnerHTML) {
      this.element.innerHTML = this.oldInnerHTML;
    }
    this.leaveEditMode();
    Event.stopObserving(this.element, 'click', this.onclickListener);
    Event.stopObserving(this.element, 'mouseover', this.mouseoverListener);
    Event.stopObserving(this.element, 'mouseout', this.mouseoutListener);
    if (this.options.externalControl) {
      Event.stopObserving(this.options.externalControl, 'click', this.onclickListener);
      Event.stopObserving(this.options.externalControl, 'mouseover', this.mouseoverListener);
      Event.stopObserving(this.options.externalControl, 'mouseout', this.mouseoutListener);
    }
  }
};

Ajax.InPlaceCollectionEditor = Class.create();
Object.extend(Ajax.InPlaceCollectionEditor.prototype, Ajax.InPlaceEditor.prototype);
Object.extend(Ajax.InPlaceCollectionEditor.prototype, {
  createEditField: function() {
    if (!this.cached_selectTag) {
      var selectTag = document.createElement("select");
      var collection = this.options.collection || [];
      var optionTag;
      collection.each(function(e,i) {
        optionTag = document.createElement("option");
        optionTag.value = (e instanceof Array) ? e[0] : e;
        if((typeof this.options.value == 'undefined') && 
          ((e instanceof Array) ? this.element.innerHTML == e[1] : e == optionTag.value)) optionTag.selected = true;
        if(this.options.value==optionTag.value) optionTag.selected = true;
        optionTag.appendChild(document.createTextNode((e instanceof Array) ? e[1] : e));
        selectTag.appendChild(optionTag);
      }.bind(this));
      this.cached_selectTag = selectTag;
    }

    this.editField = this.cached_selectTag;
    if(this.options.loadTextURL) this.loadExternalText();
    this.form.appendChild(this.editField);
    this.options.callback = function(form, value) {
      return "value=" + encodeURIComponent(value);
    }
  }
});

// Delayed observer, like Form.Element.Observer, 
// but waits for delay after last key input
// Ideal for live-search fields

Form.Element.DelayedObserver = Class.create();
Form.Element.DelayedObserver.prototype = {
  initialize: function(element, delay, callback) {
    this.delay     = delay || 0.5;
    this.element   = $(element);
    this.callback  = callback;
    this.timer     = null;
    this.lastValue = $F(this.element); 
    Event.observe(this.element,'keyup',this.delayedListener.bindAsEventListener(this));
  },
  delayedListener: function(event) {
    if(this.lastValue == $F(this.element)) return;
    if(this.timer) clearTimeout(this.timer);
    this.timer = setTimeout(this.onTimerEvent.bind(this), this.delay * 1000);
    this.lastValue = $F(this.element);
  },
  onTimerEvent: function() {
    this.timer = null;
    this.callback(this.element, $F(this.element));
  }
};



/***************************************************
 * library/scriptaculous/slider.js
 ***************************************************/

// Copyright (c) 2005-2007 Marty Haught, Thomas Fuchs 
//
// script.aculo.us is freely distributable under the terms of an MIT-style license.
// For details, see the script.aculo.us web site: http://script.aculo.us/

if(!Control) var Control = {};
Control.Slider = Class.create();

// options:
//  axis: 'vertical', or 'horizontal' (default)
//
// callbacks:
//  onChange(value)
//  onSlide(value)
Control.Slider.prototype = {
  initialize: function(handle, track, options) {
    var slider = this;
    
    if(handle instanceof Array) {
      this.handles = handle.collect( function(e) { return $(e) });
    } else {
      this.handles = [$(handle)];
    }
    
    this.track   = $(track);
    this.options = options || {};

    this.axis      = this.options.axis || 'horizontal';
    this.increment = this.options.increment || 1;
    this.step      = parseInt(this.options.step || '1');
    this.range     = this.options.range || $R(0,1);
    
    this.value     = 0; // assure backwards compat
    this.values    = this.handles.map( function() { return 0 });
    this.spans     = this.options.spans ? this.options.spans.map(function(s){ return $(s) }) : false;
    this.options.startSpan = $(this.options.startSpan || null);
    this.options.endSpan   = $(this.options.endSpan || null);

    this.restricted = this.options.restricted || false;

    this.maximum   = this.options.maximum || this.range.end;
    this.minimum   = this.options.minimum || this.range.start;

    // Will be used to align the handle onto the track, if necessary
    this.alignX = parseInt(this.options.alignX || '0');
    this.alignY = parseInt(this.options.alignY || '0');
    
    this.trackLength = this.maximumOffset() - this.minimumOffset();

    this.handleLength = this.isVertical() ? 
      (this.handles[0].offsetHeight != 0 ? 
        this.handles[0].offsetHeight : this.handles[0].style.height.replace(/px$/,"")) : 
      (this.handles[0].offsetWidth != 0 ? this.handles[0].offsetWidth : 
        this.handles[0].style.width.replace(/px$/,""));

    this.active   = false;
    this.dragging = false;
    this.disabled = false;

    if(this.options.disabled) this.setDisabled();

    // Allowed values array
    this.allowedValues = this.options.values ? this.options.values.sortBy(Prototype.K) : false;
    if(this.allowedValues) {
      this.minimum = this.allowedValues.min();
      this.maximum = this.allowedValues.max();
    }

    this.eventMouseDown = this.startDrag.bindAsEventListener(this);
    this.eventMouseUp   = this.endDrag.bindAsEventListener(this);
    this.eventMouseMove = this.update.bindAsEventListener(this);

    // Initialize handles in reverse (make sure first handle is active)
    this.handles.each( function(h,i) {
      i = slider.handles.length-1-i;
      slider.setValue(parseFloat(
        (slider.options.sliderValue instanceof Array ? 
          slider.options.sliderValue[i] : slider.options.sliderValue) || 
         slider.range.start), i);
      Element.makePositioned(h); // fix IE
      Event.observe(h, "mousedown", slider.eventMouseDown);
    });
    
    Event.observe(this.track, "mousedown", this.eventMouseDown);
    Event.observe(document, "mouseup", this.eventMouseUp);
    Event.observe(document, "mousemove", this.eventMouseMove);
    
    this.initialized = true;
  },
  dispose: function() {
    var slider = this;    
    Event.stopObserving(this.track, "mousedown", this.eventMouseDown);
    Event.stopObserving(document, "mouseup", this.eventMouseUp);
    Event.stopObserving(document, "mousemove", this.eventMouseMove);
    this.handles.each( function(h) {
      Event.stopObserving(h, "mousedown", slider.eventMouseDown);
    });
  },
  setDisabled: function(){
    this.disabled = true;
  },
  setEnabled: function(){
    this.disabled = false;
  },  
  getNearestValue: function(value){
    if(this.allowedValues){
      if(value >= this.allowedValues.max()) return(this.allowedValues.max());
      if(value <= this.allowedValues.min()) return(this.allowedValues.min());
      
      var offset = Math.abs(this.allowedValues[0] - value);
      var newValue = this.allowedValues[0];
      this.allowedValues.each( function(v) {
        var currentOffset = Math.abs(v - value);
        if(currentOffset <= offset){
          newValue = v;
          offset = currentOffset;
        } 
      });
      return newValue;
    }
    if(value > this.range.end) return this.range.end;
    if(value < this.range.start) return this.range.start;
    return value;
  },
  setValue: function(sliderValue, handleIdx){
    if(!this.active) {
      this.activeHandleIdx = handleIdx || 0;
      this.activeHandle    = this.handles[this.activeHandleIdx];
      this.updateStyles();
    }
    handleIdx = handleIdx || this.activeHandleIdx || 0;
    if(this.initialized && this.restricted) {
      if((handleIdx>0) && (sliderValue<this.values[handleIdx-1]))
        sliderValue = this.values[handleIdx-1];
      if((handleIdx < (this.handles.length-1)) && (sliderValue>this.values[handleIdx+1]))
        sliderValue = this.values[handleIdx+1];
    }
    sliderValue = this.getNearestValue(sliderValue);
    this.values[handleIdx] = sliderValue;
    this.value = this.values[0]; // assure backwards compat
    
    this.handles[handleIdx].style[this.isVertical() ? 'top' : 'left'] = 
      this.translateToPx(sliderValue);
    
    this.drawSpans();
    if(!this.dragging || !this.event) this.updateFinished();
  },
  setValueBy: function(delta, handleIdx) {
    this.setValue(this.values[handleIdx || this.activeHandleIdx || 0] + delta, 
      handleIdx || this.activeHandleIdx || 0);
  },
  translateToPx: function(value) {
    return Math.round(
      ((this.trackLength-this.handleLength)/(this.range.end-this.range.start)) * 
      (value - this.range.start)) + "px";
  },
  translateToValue: function(offset) {
    return ((offset/(this.trackLength-this.handleLength) * 
      (this.range.end-this.range.start)) + this.range.start);
  },
  getRange: function(range) {
    var v = this.values.sortBy(Prototype.K); 
    range = range || 0;
    return $R(v[range],v[range+1]);
  },
  minimumOffset: function(){
    return(this.isVertical() ? this.alignY : this.alignX);
  },
  maximumOffset: function(){
    return(this.isVertical() ? 
      (this.track.offsetHeight != 0 ? this.track.offsetHeight :
        this.track.style.height.replace(/px$/,"")) - this.alignY : 
      (this.track.offsetWidth != 0 ? this.track.offsetWidth : 
        this.track.style.width.replace(/px$/,"")) - this.alignY);
  },  
  isVertical:  function(){
    return (this.axis == 'vertical');
  },
  drawSpans: function() {
    var slider = this;
    if(this.spans)
      $R(0, this.spans.length-1).each(function(r) { slider.setSpan(slider.spans[r], slider.getRange(r)) });
    if(this.options.startSpan)
      this.setSpan(this.options.startSpan,
        $R(0, this.values.length>1 ? this.getRange(0).min() : this.value ));
    if(this.options.endSpan)
      this.setSpan(this.options.endSpan, 
        $R(this.values.length>1 ? this.getRange(this.spans.length-1).max() : this.value, this.maximum));
  },
  setSpan: function(span, range) {
    if(this.isVertical()) {
      span.style.top = this.translateToPx(range.start);
      span.style.height = this.translateToPx(range.end - range.start + this.range.start);
    } else {
      span.style.left = this.translateToPx(range.start);
      span.style.width = this.translateToPx(range.end - range.start + this.range.start);
    }
  },
  updateStyles: function() {
    this.handles.each( function(h){ Element.removeClassName(h, 'selected') });
    Element.addClassName(this.activeHandle, 'selected');
  },
  startDrag: function(event) {
    if(Event.isLeftClick(event)) {
      if(!this.disabled){
        this.active = true;
        
        var handle = Event.element(event);
        var pointer  = [Event.pointerX(event), Event.pointerY(event)];
        var track = handle;
        if(track==this.track) {
          var offsets  = Position.cumulativeOffset(this.track); 
          this.event = event;
          this.setValue(this.translateToValue( 
           (this.isVertical() ? pointer[1]-offsets[1] : pointer[0]-offsets[0])-(this.handleLength/2)
          ));
          var offsets  = Position.cumulativeOffset(this.activeHandle);
          this.offsetX = (pointer[0] - offsets[0]);
          this.offsetY = (pointer[1] - offsets[1]);
        } else {
          // find the handle (prevents issues with Safari)
          while((this.handles.indexOf(handle) == -1) && handle.parentNode) 
            handle = handle.parentNode;
            
          if(this.handles.indexOf(handle)!=-1) {
            this.activeHandle    = handle;
            this.activeHandleIdx = this.handles.indexOf(this.activeHandle);
            this.updateStyles();
            
            var offsets  = Position.cumulativeOffset(this.activeHandle);
            this.offsetX = (pointer[0] - offsets[0]);
            this.offsetY = (pointer[1] - offsets[1]);
          }
        }
      }
      Event.stop(event);
    }
  },
  update: function(event) {
   if(this.active) {
      if(!this.dragging) this.dragging = true;
      this.draw(event);
      if(Prototype.Browser.WebKit) window.scrollBy(0,0);
      Event.stop(event);
   }
  },
  draw: function(event) {
    var pointer = [Event.pointerX(event), Event.pointerY(event)];
    var offsets = Position.cumulativeOffset(this.track);
    pointer[0] -= this.offsetX + offsets[0];
    pointer[1] -= this.offsetY + offsets[1];
    this.event = event;
    this.setValue(this.translateToValue( this.isVertical() ? pointer[1] : pointer[0] ));
    if(this.initialized && this.options.onSlide)
      this.options.onSlide(this.values.length>1 ? this.values : this.value, this);
  },
  endDrag: function(event) {
    if(this.active && this.dragging) {
      this.finishDrag(event, true);
      Event.stop(event);
    }
    this.active = false;
    this.dragging = false;
  },  
  finishDrag: function(event, success) {
    this.active = false;
    this.dragging = false;
    this.updateFinished();
  },
  updateFinished: function() {
    if(this.initialized && this.options.onChange) 
      this.options.onChange(this.values.length>1 ? this.values : this.value, this);
    this.event = null;
  }
}


/***************************************************
 * library/scriptaculous/dragdrop.js
 ***************************************************/

// Copyright (c) 2005-2007 Thomas Fuchs (http://script.aculo.us, http://mir.aculo.us)
//           (c) 2005-2007 Sammi Williams (http://www.oriontransfer.co.nz, sammi@oriontransfer.co.nz)
// 
// script.aculo.us is freely distributable under the terms of an MIT-style license.
// For details, see the script.aculo.us web site: http://script.aculo.us/

if(typeof Effect == 'undefined')
  throw("dragdrop.js requires including script.aculo.us' effects.js library");

var Droppables = {
  drops: [],

  remove: function(element) {
    this.drops = this.drops.reject(function(d) { return d.element==$(element) });
  },

  add: function(element) {
    element = $(element);
    var options = Object.extend({
      greedy:     true,
      hoverclass: null,
      tree:       false
    }, arguments[1] || {});

    // cache containers
    if(options.containment) {
      options._containers = [];
      var containment = options.containment;
      if((typeof containment == 'object') && 
        (containment.constructor == Array)) {
        containment.each( function(c) { options._containers.push($(c)) });
      } else {
        options._containers.push($(containment));
      }
    }
    
    if(options.accept) options.accept = [options.accept].flatten();

    Element.makePositioned(element); // fix IE
    options.element = element;

    this.drops.push(options);
  },
  
  findDeepestChild: function(drops) {
    deepest = drops[0];
      
    for (i = 1; i < drops.length; ++i)
      if (Element.isParent(drops[i].element, deepest.element))
        deepest = drops[i];
    
    return deepest;
  },

  isContained: function(element, drop) {
    var containmentNode;
    if(drop.tree) {
      containmentNode = element.treeNode; 
    } else {
      containmentNode = element.parentNode;
    }
    return drop._containers.detect(function(c) { return containmentNode == c });
  },
  
  isAffected: function(point, element, drop) {
    return (
      (drop.element!=element) &&
      ((!drop._containers) ||
        this.isContained(element, drop)) &&
      ((!drop.accept) ||
        (Element.classNames(element).detect( 
          function(v) { return drop.accept.include(v) } ) )) &&
      Position.within(drop.element, point[0], point[1]) );
  },

  deactivate: function(drop) {
    if(drop.hoverclass)
      Element.removeClassName(drop.element, drop.hoverclass);
    this.last_active = null;
  },

  activate: function(drop) {
    if(drop.hoverclass)
      Element.addClassName(drop.element, drop.hoverclass);
    this.last_active = drop;
  },

  show: function(point, element) {
    if(!this.drops.length) return;
    var affected = [];
    
    if(this.last_active) this.deactivate(this.last_active);
    this.drops.each( function(drop) {
      if(Droppables.isAffected(point, element, drop))
        affected.push(drop);
    });
        
    if(affected.length>0) {
      drop = Droppables.findDeepestChild(affected);
      Position.within(drop.element, point[0], point[1]);
      if(drop.onHover)
        drop.onHover(element, drop.element, Position.overlap(drop.overlap, drop.element));
      
      Droppables.activate(drop);
    }
  },

  fire: function(event, element) {
    if(!this.last_active) return;
    Position.prepare();

    if (this.isAffected([Event.pointerX(event), Event.pointerY(event)], element, this.last_active))
      if (this.last_active.onDrop) {
        this.last_active.onDrop(element, this.last_active.element, event); 
        return true; 
      }
  },

  reset: function() {
    if(this.last_active)
      this.deactivate(this.last_active);
  }
}

var Draggables = {
  drags: [],
  observers: [],
  
  register: function(draggable) {
    if(this.drags.length == 0) {
      this.eventMouseUp   = this.endDrag.bindAsEventListener(this);
      this.eventMouseMove = this.updateDrag.bindAsEventListener(this);
      this.eventKeypress  = this.keyPress.bindAsEventListener(this);
      
      Event.observe(document, "mouseup", this.eventMouseUp);
      Event.observe(document, "mousemove", this.eventMouseMove);
      Event.observe(document, "keypress", this.eventKeypress);
    }
    this.drags.push(draggable);
  },
  
  unregister: function(draggable) {
    this.drags = this.drags.reject(function(d) { return d==draggable });
    if(this.drags.length == 0) {
      Event.stopObserving(document, "mouseup", this.eventMouseUp);
      Event.stopObserving(document, "mousemove", this.eventMouseMove);
      Event.stopObserving(document, "keypress", this.eventKeypress);
    }
  },
  
  activate: function(draggable) {
    if(draggable.options.delay) { 
      this._timeout = setTimeout(function() { 
        Draggables._timeout = null; 
        window.focus(); 
        Draggables.activeDraggable = draggable; 
      }.bind(this), draggable.options.delay); 
    } else {
      window.focus(); // allows keypress events if window isn't currently focused, fails for Safari
      this.activeDraggable = draggable;
    }
  },
  
  deactivate: function() {
    this.activeDraggable = null;
  },
  
  updateDrag: function(event) {
    if(!this.activeDraggable) return;
    var pointer = [Event.pointerX(event), Event.pointerY(event)];
    // Mozilla-based browsers fire successive mousemove events with
    // the same coordinates, prevent needless redrawing (moz bug?)
    if(this._lastPointer && (this._lastPointer.inspect() == pointer.inspect())) return;
    this._lastPointer = pointer;
    
    this.activeDraggable.updateDrag(event, pointer);
  },
  
  endDrag: function(event) {
    if(this._timeout) { 
      clearTimeout(this._timeout); 
      this._timeout = null; 
    }
    if(!this.activeDraggable) return;
    this._lastPointer = null;
    this.activeDraggable.endDrag(event);
    this.activeDraggable = null;
  },
  
  keyPress: function(event) {
    if(this.activeDraggable)
      this.activeDraggable.keyPress(event);
  },
  
  addObserver: function(observer) {
    this.observers.push(observer);
    this._cacheObserverCallbacks();
  },
  
  removeObserver: function(element) {  // element instead of observer fixes mem leaks
    this.observers = this.observers.reject( function(o) { return o.element==element });
    this._cacheObserverCallbacks();
  },
  
  notify: function(eventName, draggable, event) {  // 'onStart', 'onEnd', 'onDrag'
    if(this[eventName+'Count'] > 0)
      this.observers.each( function(o) {
        if(o[eventName]) o[eventName](eventName, draggable, event);
      });
    if(draggable.options[eventName]) draggable.options[eventName](draggable, event);
  },
  
  _cacheObserverCallbacks: function() {
    ['onStart','onEnd','onDrag'].each( function(eventName) {
      Draggables[eventName+'Count'] = Draggables.observers.select(
        function(o) { return o[eventName]; }
      ).length;
    });
  }
}

/*--------------------------------------------------------------------------*/

var Draggable = Class.create();
Draggable._dragging    = {};

Draggable.prototype = {
  initialize: function(element) {
    var defaults = {
      handle: false,
      reverteffect: function(element, top_offset, left_offset) {
        var dur = Math.sqrt(Math.abs(top_offset^2)+Math.abs(left_offset^2))*0.02;
        new Effect.Move(element, { x: -left_offset, y: -top_offset, duration: dur,
          queue: {scope:'_draggable', position:'end'}
        });
      },
      endeffect: function(element) {
        var toOpacity = typeof element._opacity == 'number' ? element._opacity : 1.0;
        new Effect.Opacity(element, {duration:0.2, from:0.7, to:toOpacity, 
          queue: {scope:'_draggable', position:'end'},
          afterFinish: function(){ 
            Draggable._dragging[element] = false 
          }
        }); 
      },
      zindex: 1000,
      revert: false,
      quiet: false,
      scroll: false,
      scrollSensitivity: 20,
      scrollSpeed: 15,
      snap: false,  // false, or xy or [x,y] or function(x,y){ return [x,y] }
      delay: 0
    };
    
    if(!arguments[1] || typeof arguments[1].endeffect == 'undefined')
      Object.extend(defaults, {
        starteffect: function(element) {
          element._opacity = Element.getOpacity(element);
          Draggable._dragging[element] = true;
          new Effect.Opacity(element, {duration:0.2, from:element._opacity, to:0.7}); 
        }
      });
    
    var options = Object.extend(defaults, arguments[1] || {});

    this.element = $(element);
    
    if(options.handle && (typeof options.handle == 'string'))
      this.handle = this.element.down('.'+options.handle, 0);
    
    if(!this.handle) this.handle = $(options.handle);
    if(!this.handle) this.handle = this.element;
    
    if(options.scroll && !options.scroll.scrollTo && !options.scroll.outerHTML) {
      options.scroll = $(options.scroll);
      this._isScrollChild = Element.childOf(this.element, options.scroll);
    }

    Element.makePositioned(this.element); // fix IE    

    this.delta    = this.currentDelta();
    this.options  = options;
    this.dragging = false;   

    this.eventMouseDown = this.initDrag.bindAsEventListener(this);
    Event.observe(this.handle, "mousedown", this.eventMouseDown);
    
    Draggables.register(this);
  },
  
  destroy: function() {
    Event.stopObserving(this.handle, "mousedown", this.eventMouseDown);
    Draggables.unregister(this);
  },
  
  currentDelta: function() {
    return([
      parseInt(Element.getStyle(this.element,'left') || '0'),
      parseInt(Element.getStyle(this.element,'top') || '0')]);
  },
  
  initDrag: function(event) {
    if(typeof Draggable._dragging[this.element] != 'undefined' &&
      Draggable._dragging[this.element]) return;
    if(Event.isLeftClick(event)) {    
      // abort on form elements, fixes a Firefox issue
      var src = Event.element(event);
      if((tag_name = src.tagName.toUpperCase()) && (
        tag_name=='INPUT' ||
        tag_name=='SELECT' ||
        tag_name=='OPTION' ||
        tag_name=='BUTTON' ||
        tag_name=='TEXTAREA')) return;
        
      var pointer = [Event.pointerX(event), Event.pointerY(event)];
      var pos     = Position.cumulativeOffset(this.element);
      this.offset = [0,1].map( function(i) { return (pointer[i] - pos[i]) });
      
      Draggables.activate(this);
      Event.stop(event);
    }
  },
  
  startDrag: function(event) {
    this.dragging = true;
    
    if(this.options.zindex) {
      this.originalZ = parseInt(Element.getStyle(this.element,'z-index') || 0);
      this.element.style.zIndex = this.options.zindex;
    }
    
    if(this.options.ghosting) {
      this._clone = this.element.cloneNode(true);
      this.element._originallyAbsolute = (this.element.getStyle('position') == 'absolute');
      if (!this.element._originallyAbsolute)
        Position.absolutize(this.element);
      this.element.parentNode.insertBefore(this._clone, this.element);
    }
    
    if(this.options.scroll) {
      if (this.options.scroll == window) {
        var where = this._getWindowScroll(this.options.scroll);
        this.originalScrollLeft = where.left;
        this.originalScrollTop = where.top;
      } else {
        this.originalScrollLeft = this.options.scroll.scrollLeft;
        this.originalScrollTop = this.options.scroll.scrollTop;
      }
    }
    
    Draggables.notify('onStart', this, event);
        
    if(this.options.starteffect) this.options.starteffect(this.element);
  },
  
  updateDrag: function(event, pointer) {
    if(!this.dragging) this.startDrag(event);
    
    if(!this.options.quiet){
      Position.prepare();
      Droppables.show(pointer, this.element);
    }
    
    Draggables.notify('onDrag', this, event);
    
    this.draw(pointer);
    if(this.options.change) this.options.change(this);
    
    if(this.options.scroll) {
      this.stopScrolling();
      
      var p;
      if (this.options.scroll == window) {
        with(this._getWindowScroll(this.options.scroll)) { p = [ left, top, left+width, top+height ]; }
      } else {
        p = Position.page(this.options.scroll);
        p[0] += this.options.scroll.scrollLeft + Position.deltaX;
        p[1] += this.options.scroll.scrollTop + Position.deltaY;
        p.push(p[0]+this.options.scroll.offsetWidth);
        p.push(p[1]+this.options.scroll.offsetHeight);
      }
      var speed = [0,0];
      if(pointer[0] < (p[0]+this.options.scrollSensitivity)) speed[0] = pointer[0]-(p[0]+this.options.scrollSensitivity);
      if(pointer[1] < (p[1]+this.options.scrollSensitivity)) speed[1] = pointer[1]-(p[1]+this.options.scrollSensitivity);
      if(pointer[0] > (p[2]-this.options.scrollSensitivity)) speed[0] = pointer[0]-(p[2]-this.options.scrollSensitivity);
      if(pointer[1] > (p[3]-this.options.scrollSensitivity)) speed[1] = pointer[1]-(p[3]-this.options.scrollSensitivity);
      this.startScrolling(speed);
    }
    
    // fix AppleWebKit rendering
    if(Prototype.Browser.WebKit) window.scrollBy(0,0);
    
    Event.stop(event);
  },
  
  finishDrag: function(event, success) {
    this.dragging = false;
    
    if(this.options.quiet){
      Position.prepare();
      var pointer = [Event.pointerX(event), Event.pointerY(event)];
      Droppables.show(pointer, this.element);
    }

    if(this.options.ghosting) {
      if (!this.element._originallyAbsolute)
        Position.relativize(this.element);
      delete this.element._originallyAbsolute;
      Element.remove(this._clone);
      this._clone = null;
    }

    var dropped = false; 
    if(success) { 
      dropped = Droppables.fire(event, this.element); 
      if (!dropped) dropped = false; 
    }
    if(dropped && this.options.onDropped) this.options.onDropped(this.element);
    Draggables.notify('onEnd', this, event);

    var revert = this.options.revert;
    if(revert && typeof revert == 'function') revert = revert(this.element);
    
    var d = this.currentDelta();
    if(revert && this.options.reverteffect) {
      if (dropped == 0 || revert != 'failure')
        this.options.reverteffect(this.element,
          d[1]-this.delta[1], d[0]-this.delta[0]);
    } else {
      this.delta = d;
    }

    if(this.options.zindex)
      this.element.style.zIndex = this.originalZ;

    if(this.options.endeffect) 
      this.options.endeffect(this.element);
      
    Draggables.deactivate(this);
    Droppables.reset();
  },
  
  keyPress: function(event) {
    if(event.keyCode!=Event.KEY_ESC) return;
    this.finishDrag(event, false);
    Event.stop(event);
  },
  
  endDrag: function(event) {
    if(!this.dragging) return;
    this.stopScrolling();
    this.finishDrag(event, true);
    Event.stop(event);
  },
  
  draw: function(point) {
    var pos = Position.cumulativeOffset(this.element);
    if(this.options.ghosting) {
      var r   = Position.realOffset(this.element);
      pos[0] += r[0] - Position.deltaX; pos[1] += r[1] - Position.deltaY;
    }
    
    var d = this.currentDelta();
    pos[0] -= d[0]; pos[1] -= d[1];
    
    if(this.options.scroll && (this.options.scroll != window && this._isScrollChild)) {
      pos[0] -= this.options.scroll.scrollLeft-this.originalScrollLeft;
      pos[1] -= this.options.scroll.scrollTop-this.originalScrollTop;
    }
    
    var p = [0,1].map(function(i){ 
      return (point[i]-pos[i]-this.offset[i]) 
    }.bind(this));
    
    if(this.options.snap) {
      if(typeof this.options.snap == 'function') {
        p = this.options.snap(p[0],p[1],this);
      } else {
      if(this.options.snap instanceof Array) {
        p = p.map( function(v, i) {
          return Math.round(v/this.options.snap[i])*this.options.snap[i] }.bind(this))
      } else {
        p = p.map( function(v) {
          return Math.round(v/this.options.snap)*this.options.snap }.bind(this))
      }
    }}
    
    var style = this.element.style;
    if((!this.options.constraint) || (this.options.constraint=='horizontal'))
      style.left = p[0] + "px";
    if((!this.options.constraint) || (this.options.constraint=='vertical'))
      style.top  = p[1] + "px";
    
    if(style.visibility=="hidden") style.visibility = ""; // fix gecko rendering
  },
  
  stopScrolling: function() {
    if(this.scrollInterval) {
      clearInterval(this.scrollInterval);
      this.scrollInterval = null;
      Draggables._lastScrollPointer = null;
    }
  },
  
  startScrolling: function(speed) {
    if(!(speed[0] || speed[1])) return;
    this.scrollSpeed = [speed[0]*this.options.scrollSpeed,speed[1]*this.options.scrollSpeed];
    this.lastScrolled = new Date();
    this.scrollInterval = setInterval(this.scroll.bind(this), 10);
  },
  
  scroll: function() {
    var current = new Date();
    var delta = current - this.lastScrolled;
    this.lastScrolled = current;
    if(this.options.scroll == window) {
      with (this._getWindowScroll(this.options.scroll)) {
        if (this.scrollSpeed[0] || this.scrollSpeed[1]) {
          var d = delta / 1000;
          this.options.scroll.scrollTo( left + d*this.scrollSpeed[0], top + d*this.scrollSpeed[1] );
        }
      }
    } else {
      this.options.scroll.scrollLeft += this.scrollSpeed[0] * delta / 1000;
      this.options.scroll.scrollTop  += this.scrollSpeed[1] * delta / 1000;
    }
    
    Position.prepare();
    Droppables.show(Draggables._lastPointer, this.element);
    Draggables.notify('onDrag', this);
    if (this._isScrollChild) {
      Draggables._lastScrollPointer = Draggables._lastScrollPointer || $A(Draggables._lastPointer);
      Draggables._lastScrollPointer[0] += this.scrollSpeed[0] * delta / 1000;
      Draggables._lastScrollPointer[1] += this.scrollSpeed[1] * delta / 1000;
      if (Draggables._lastScrollPointer[0] < 0)
        Draggables._lastScrollPointer[0] = 0;
      if (Draggables._lastScrollPointer[1] < 0)
        Draggables._lastScrollPointer[1] = 0;
      this.draw(Draggables._lastScrollPointer);
    }
    
    if(this.options.change) this.options.change(this);
  },
  
  _getWindowScroll: function(w) {
    var T, L, W, H;
    with (w.document) {
      if (w.document.documentElement && documentElement.scrollTop) {
        T = documentElement.scrollTop;
        L = documentElement.scrollLeft;
      } else if (w.document.body) {
        T = body.scrollTop;
        L = body.scrollLeft;
      }
      if (w.innerWidth) {
        W = w.innerWidth;
        H = w.innerHeight;
      } else if (w.document.documentElement && documentElement.clientWidth) {
        W = documentElement.clientWidth;
        H = documentElement.clientHeight;
      } else {
        W = body.offsetWidth;
        H = body.offsetHeight
      }
    }
    return { top: T, left: L, width: W, height: H };
  }
}

/*--------------------------------------------------------------------------*/

var SortableObserver = Class.create();
SortableObserver.prototype = {
  initialize: function(element, observer) {
    this.element   = $(element);
    this.observer  = observer;
    this.lastValue = Sortable.serialize(this.element);
  },
  
  onStart: function() {
    this.lastValue = Sortable.serialize(this.element);
  },
  
  onEnd: function() {
    Sortable.unmark();
    if(this.lastValue != Sortable.serialize(this.element))
      this.observer(this.element)
  }
}

var Sortable = {
  SERIALIZE_RULE: /^[^_\-](?:[A-Za-z0-9\-\_]*)[_](.*)$/,
  
  sortables: {},
  
  _findRootElement: function(element) {
    while (element.tagName.toUpperCase() != "BODY") {  
      if(element.id && Sortable.sortables[element.id]) return element;
      element = element.parentNode;
    }
  },

  options: function(element) {
    element = Sortable._findRootElement($(element));
    if(!element) return;
    return Sortable.sortables[element.id];
  },
  
  destroy: function(element){
    var s = Sortable.options(element);
    
    if(s) {
      Draggables.removeObserver(s.element);
      s.droppables.each(function(d){ Droppables.remove(d) });
      s.draggables.invoke('destroy');
      
      delete Sortable.sortables[s.element.id];
    }
  },

  create: function(element) {
    element = $(element);
    var options = Object.extend({ 
      element:     element,
      tag:         'li',       // assumes li children, override with tag: 'tagname'
      dropOnEmpty: false,
      tree:        false,
      treeTag:     'ul',
      overlap:     'vertical', // one of 'vertical', 'horizontal'
      constraint:  'vertical', // one of 'vertical', 'horizontal', false
      containment: element,    // also takes array of elements (or id's); or false
      handle:      false,      // or a CSS class
      only:        false,
      delay:       0,
      hoverclass:  null,
      ghosting:    false,
      quiet:       false, 
      scroll:      false,
      scrollSensitivity: 20,
      scrollSpeed: 15,
      format:      this.SERIALIZE_RULE,
      
      // these take arrays of elements or ids and can be 
      // used for better initialization performance
      elements:    false,
      handles:     false,
      
      onChange:    Prototype.emptyFunction,
      onUpdate:    Prototype.emptyFunction
    }, arguments[1] || {});

    // clear any old sortable with same element
    this.destroy(element);

    // build options for the draggables
    var options_for_draggable = {
      revert:      true,
      quiet:       options.quiet,
      scroll:      options.scroll,
      scrollSpeed: options.scrollSpeed,
      scrollSensitivity: options.scrollSensitivity,
      delay:       options.delay,
      ghosting:    options.ghosting,
      constraint:  options.constraint,
      handle:      options.handle };

    if(options.starteffect)
      options_for_draggable.starteffect = options.starteffect;

    if(options.reverteffect)
      options_for_draggable.reverteffect = options.reverteffect;
    else
      if(options.ghosting) options_for_draggable.reverteffect = function(element) {
        element.style.top  = 0;
        element.style.left = 0;
      };

    if(options.endeffect)
      options_for_draggable.endeffect = options.endeffect;

    if(options.zindex)
      options_for_draggable.zindex = options.zindex;

    // build options for the droppables  
    var options_for_droppable = {
      overlap:     options.overlap,
      containment: options.containment,
      tree:        options.tree,
      hoverclass:  options.hoverclass,
      onHover:     Sortable.onHover
    }
    
    var options_for_tree = {
      onHover:      Sortable.onEmptyHover,
      overlap:      options.overlap,
      containment:  options.containment,
      hoverclass:   options.hoverclass
    }

    // fix for gecko engine
    Element.cleanWhitespace(element); 

    options.draggables = [];
    options.droppables = [];

    // drop on empty handling
    if(options.dropOnEmpty || options.tree) {
      Droppables.add(element, options_for_tree);
      options.droppables.push(element);
    }

    (options.elements || this.findElements(element, options) || []).each( function(e,i) {
      var handle = options.handles ? $(options.handles[i]) :
        (options.handle ? $(e).getElementsByClassName(options.handle)[0] : e); 
      options.draggables.push(
        new Draggable(e, Object.extend(options_for_draggable, { handle: handle })));
      Droppables.add(e, options_for_droppable);
      if(options.tree) e.treeNode = element;
      options.droppables.push(e);      
    });
    
    if(options.tree) {
      (Sortable.findTreeElements(element, options) || []).each( function(e) {
        Droppables.add(e, options_for_tree);
        e.treeNode = element;
        options.droppables.push(e);
      });
    }

    // keep reference
    this.sortables[element.id] = options;

    // for onupdate
    Draggables.addObserver(new SortableObserver(element, options.onUpdate));

  },

  // return all suitable-for-sortable elements in a guaranteed order
  findElements: function(element, options) {
    return Element.findChildren(
      element, options.only, options.tree ? true : false, options.tag);
  },
  
  findTreeElements: function(element, options) {
    return Element.findChildren(
      element, options.only, options.tree ? true : false, options.treeTag);
  },

  onHover: function(element, dropon, overlap) {
    if(Element.isParent(dropon, element)) return;

    if(overlap > .33 && overlap < .66 && Sortable.options(dropon).tree) {
      return;
    } else if(overlap>0.5) {
      Sortable.mark(dropon, 'before');
      if(dropon.previousSibling != element) {
        var oldParentNode = element.parentNode;
        element.style.visibility = "hidden"; // fix gecko rendering
        dropon.parentNode.insertBefore(element, dropon);
        if(dropon.parentNode!=oldParentNode) 
          Sortable.options(oldParentNode).onChange(element);
        Sortable.options(dropon.parentNode).onChange(element);
      }
    } else {
      Sortable.mark(dropon, 'after');
      var nextElement = dropon.nextSibling || null;
      if(nextElement != element) {
        var oldParentNode = element.parentNode;
        element.style.visibility = "hidden"; // fix gecko rendering
        dropon.parentNode.insertBefore(element, nextElement);
        if(dropon.parentNode!=oldParentNode) 
          Sortable.options(oldParentNode).onChange(element);
        Sortable.options(dropon.parentNode).onChange(element);
      }
    }
  },
  
  onEmptyHover: function(element, dropon, overlap) {
    var oldParentNode = element.parentNode;
    var droponOptions = Sortable.options(dropon);
        
    if(!Element.isParent(dropon, element)) {
      var index;
      
      var children = Sortable.findElements(dropon, {tag: droponOptions.tag, only: droponOptions.only});
      var child = null;
            
      if(children) {
        var offset = Element.offsetSize(dropon, droponOptions.overlap) * (1.0 - overlap);
        
        for (index = 0; index < children.length; index += 1) {
          if (offset - Element.offsetSize (children[index], droponOptions.overlap) >= 0) {
            offset -= Element.offsetSize (children[index], droponOptions.overlap);
          } else if (offset - (Element.offsetSize (children[index], droponOptions.overlap) / 2) >= 0) {
            child = index + 1 < children.length ? children[index + 1] : null;
            break;
          } else {
            child = children[index];
            break;
          }
        }
      }
      
      dropon.insertBefore(element, child);
      
      Sortable.options(oldParentNode).onChange(element);
      droponOptions.onChange(element);
    }
  },

  unmark: function() {
    if(Sortable._marker) Sortable._marker.hide();
  },

  mark: function(dropon, position) {
    // mark on ghosting only
    var sortable = Sortable.options(dropon.parentNode);
    if(sortable && !sortable.ghosting) return; 

    if(!Sortable._marker) {
      Sortable._marker = 
        ($('dropmarker') || Element.extend(document.createElement('DIV'))).
          hide().addClassName('dropmarker').setStyle({position:'absolute'});
      document.getElementsByTagName("body").item(0).appendChild(Sortable._marker);
    }    
    var offsets = Position.cumulativeOffset(dropon);
    Sortable._marker.setStyle({left: offsets[0]+'px', top: offsets[1] + 'px'});
    
    if(position=='after')
      if(sortable.overlap == 'horizontal') 
        Sortable._marker.setStyle({left: (offsets[0]+dropon.clientWidth) + 'px'});
      else
        Sortable._marker.setStyle({top: (offsets[1]+dropon.clientHeight) + 'px'});
    
    Sortable._marker.show();
  },
  
  _tree: function(element, options, parent) {
    var children = Sortable.findElements(element, options) || [];
  
    for (var i = 0; i < children.length; ++i) {
      var match = children[i].id.match(options.format);

      if (!match) continue;
      
      var child = {
        id: encodeURIComponent(match ? match[1] : null),
        element: element,
        parent: parent,
        children: [],
        position: parent.children.length,
        container: $(children[i]).down(options.treeTag)
      }
      
      /* Get the element containing the children and recurse over it */
      if (child.container)
        this._tree(child.container, options, child)
      
      parent.children.push (child);
    }

    return parent; 
  },

  tree: function(element) {
    element = $(element);
    var sortableOptions = this.options(element);
    var options = Object.extend({
      tag: sortableOptions.tag,
      treeTag: sortableOptions.treeTag,
      only: sortableOptions.only,
      name: element.id,
      format: sortableOptions.format
    }, arguments[1] || {});
    
    var root = {
      id: null,
      parent: null,
      children: [],
      container: element,
      position: 0
    }
    
    return Sortable._tree(element, options, root);
  },

  /* Construct a [i] index for a particular node */
  _constructIndex: function(node) {
    var index = '';
    do {
      if (node.id) index = '[' + node.position + ']' + index;
    } while ((node = node.parent) != null);
    return index;
  },

  sequence: function(element) {
    element = $(element);
    var options = Object.extend(this.options(element), arguments[1] || {});
    
    return $(this.findElements(element, options) || []).map( function(item) {
      return item.id.match(options.format) ? item.id.match(options.format)[1] : '';
    });
  },

  setSequence: function(element, new_sequence) {
    element = $(element);
    var options = Object.extend(this.options(element), arguments[2] || {});
    
    var nodeMap = {};
    this.findElements(element, options).each( function(n) {
        if (n.id.match(options.format))
            nodeMap[n.id.match(options.format)[1]] = [n, n.parentNode];
        n.parentNode.removeChild(n);
    });
   
    new_sequence.each(function(ident) {
      var n = nodeMap[ident];
      if (n) {
        n[1].appendChild(n[0]);
        delete nodeMap[ident];
      }
    });
  },
  
  serialize: function(element) {
    element = $(element);
    var options = Object.extend(Sortable.options(element), arguments[1] || {});
    var name = encodeURIComponent(
      (arguments[1] && arguments[1].name) ? arguments[1].name : element.id);
    
    if (options.tree) {
      return Sortable.tree(element, arguments[1]).children.map( function (item) {
        return [name + Sortable._constructIndex(item) + "[id]=" + 
                encodeURIComponent(item.id)].concat(item.children.map(arguments.callee));
      }).flatten().join('&');
    } else {
      return Sortable.sequence(element, arguments[1]).map( function(item) {
        return name + "[]=" + encodeURIComponent(item);
      }).join('&');
    }
  }
}

// Returns true if child is contained within element
Element.isParent = function(child, element) {
  if (!child.parentNode || child == element) return false;
  if (child.parentNode == element) return true;
  return Element.isParent(child.parentNode, element);
}

Element.findChildren = function(element, only, recursive, tagName) {   
  if(!element.hasChildNodes()) return null;
  tagName = tagName.toUpperCase();
  if(only) only = [only].flatten();
  var elements = [];
  $A(element.childNodes).each( function(e) {
    if(e.tagName && e.tagName.toUpperCase()==tagName &&
      (!only || (Element.classNames(e).detect(function(v) { return only.include(v) }))))
        elements.push(e);
    if(recursive) {
      var grandchildren = Element.findChildren(e, only, recursive, tagName);
      if(grandchildren) elements.push(grandchildren);
    }
  });

  return (elements.length>0 ? elements.flatten() : []);
}

Element.offsetSize = function (element, type) {
  return element['offset' + ((type=='vertical' || type=='height') ? 'Height' : 'Width')];
}



/***************************************************
 * library/livecart.js
 ***************************************************/

/**
 *	@author Integry Systems
 */

Function.prototype.inheritsFrom = function( parentClassOrObject )
{
	if ( parentClassOrObject.constructor == Function )
	{
		//Normal Inheritance
		var c = function() {}
		c.prototype = parentClassOrObject.prototype;
		this.prototype = new c();
		this.prototype.constructor = this;
		this.prototype.parent = parentClassOrObject.prototype;
	}
	else
	{
		//Pure Virtual Inheritance
		this.prototype = parentClassOrObject;
		this.prototype.constructor = this;
		this.prototype.parent = parentClassOrObject;
	}

	this.parent = this.prototype.parent;
	this.prototype.parentConstructor = parentClassOrObject;

	this.prototype.callConstructor = function(args)
	{
		return this.parentConstructor.apply(this, args);
	};

	if (this.methods)
	{
		$H(this.methods).each(function(func)
		{
			this.prototype[func[0]] = func[1];
		}.bind(this)
		);
	}

	return this;
}

// not really working yet
Function.prototype.inherit = function()
{
	var extendedClass = function()
	{
		this.callConstructor(arguments);
	}

	var c = function() {}
	c.prototype = this.prototype;
	extendedClass.prototype = new c();
	extendedClass.prototype.constructor = this;
	extendedClass.prototype.parent = this.prototype;

	extendedClass.parent = this.prototype.parent;
	this.prototype.parentConstructor = this;

	return extendedClass;
}

var LiveCart = {
	ajaxUpdaterInstance: null
}

LiveCart.AjaxRequest = Class.create();
LiveCart.AjaxRequest.prototype = {
	requestCount: 0,

	onComplete: false,

	indicatorContainerId: false,

	request: false,

	initialize: function(formOrUrl, indicatorId, onComplete, options)
	{
		var url = "";
		var method = "";
		var params = "";

		this.onComplete = onComplete;

		if (typeof formOrUrl == "object")
		{
			if (window.tinyMCE)
			{
				Element.saveTinyMceFields();
			}

			var form = formOrUrl;
			url = form.action;
			method = form.method;
			params = Form.serialize(form);

			if (!indicatorId)
			{
				var controls = form.down('fieldset.controls');
				if (controls)
				{
					indicatorId = controls.down('.progressIndicator');
				}
				else
				{
					indicatorId = form.down('.progressIndicator');
				}
			}
		}
		else
		{
			url = formOrUrl;
			method = "post";
		}

		url = this.fixUrl(url);

		if (indicatorId && $(indicatorId))
		{
			this.adjustIndicatorVisibility = ($(indicatorId).style.visibility == 'hidden');

			if ('SELECT' == indicatorId.tagName)
			{
				var selectIndicator = document.createElement('span');
				selectIndicator.className = 'progressIndicator';
				var nextSibling = indicatorId.nextSibling;
				if (nextSibling)
				{
					nextSibling.parentNode.insertBefore(selectIndicator, nextSibling);
				}
				else
				{
					indicatorId.parentNode.appendChild(selectIndicator);
				}

				indicatorId = selectIndicator;

				this.adjustIndicatorVisibility = true;
			}
			else if (('INPUT' == indicatorId.tagName) && (('checkbox' == indicatorId.type) || ('radio' == indicatorId.type)))
			{
				this.replacedIndicator = indicatorId;
				indicatorId = $(document.createElement('span'));
				indicatorId.className = this.replacedIndicator.className;
				indicatorId.id = this.replacedIndicator.id;
				indicatorId.addClassName('checkbox');
				indicatorId.checked = this.replacedIndicator.checked;

				if (this.replacedIndicator.parentNode)
				{
					this.replacedIndicator.parentNode.replaceChild(indicatorId, this.replacedIndicator);
				}
			}

			this.indicatorContainerId = indicatorId;
			this.showIndicator();
		}

		if (!options)
		{
			options = {};
		}

		options.method = method;

		if (!options.parameters)
		{
			options.parameters = params;
		}

		options.parameters += (escape(options.parameters) ? '&' : '') + 'ajax=true';

		options.onComplete = this.postProcessResponse.bind(this, this.parseURI(url));
		options.onFailure = this.reportError;

		document.body.style.cursor = 'progress';

		this.request = new Ajax.Request(url, options);
	},

	fixUrl: function(url)
	{
		if (!url) { return; }

		// fix repeting ? in URLs
		var urlParts = url.split(/\?/);
		var url = urlParts.shift();
		if (urlParts.length)
		{
			url += '?' + urlParts.join('&');
		}

		// fix &amp;s
		url = url.replace(/&amp;/, '&');

		return url;
	},

	parseURI: function(URI)
	{
		if(!URI) return {};

		var splitedURI = URI.split("?");
		var URL = splitedURI[0];
		var queryString = splitedURI[1];
		var query = {};

		if(queryString)
		{
			$A(queryString.split("&")).each(function(paramString) {
				var params = paramString.split("=");

				var match = params[0].match(/(.*)\[(\d*)\]$/);
				if(match)
				{
					if(!query[match[1]]) query[match[1]] = $H({});

					if(match[2] == "")
					{
						match[2] = query[match[1]].size();
					}

					query[match[1]][match[2]] = params[1];
				}
				else
				{
					query[params[0]] = params[1];
				}
			});
		}

		return {
			'url': URL,
			'queryString': queryString,
			'query': query
		};
	},

	hideIndicator: function()
	{
		if (!this.indicatorContainerId)
		{
			return;
		}

		if (this.replacedIndicator && this.indicatorContainerId.parentNode)
		{
			this.indicatorContainerId.parentNode.replaceChild(this.replacedIndicator, this.indicatorContainerId);
			this.replacedIndicator.checked = this.indicatorContainerId.checked;
			Element.show(this.replacedIndicator);
			this.adjustIndicatorVisibility = true;
		}

		if (this.adjustIndicatorVisibility)
		{
			Element.hide(this.indicatorContainerId);
		}

		$(this.indicatorContainerId).removeClassName('progressIndicator');
	},

	showIndicator: function()
	{
		if (this.indicatorContainerId)
		{
			$(this.indicatorContainerId).addClassName('progressIndicator');
			Element.show(this.indicatorContainerId);
		}
	},

	postProcessResponse: function(url, response)
	{
		document.body.style.cursor = 'default';
		this.hideIndicator();

		var contentType = response.getResponseHeader('Content-type');

		if (contentType && contentType.match(/text\/javascript/))
		{
			var responseData = response.responseText.evalJSON();
			try
			{
				response.responseData = responseData;
			}
			catch (e)
			{
				// IE 6 won't let add new properties to the request object
				response = { responseData: responseData }
			}

			if (responseData.__redirect)
			{
				window.location.href = responseData.__redirect;
			}

			Observer.processArray(responseData);
		}

		if (contentType && contentType.match(/text\/javascript/) && $('confirmations'))
		{
			var confirmations = $('confirmations');
			if(!confirmations.down('#yellowZone')) new Insertion.Top('confirmations', '<div id="yellowZone"></div>');
			if(!confirmations.down('#redZone')) new Insertion.Top('confirmations', '<div id="redZone"></div>');
			if(!confirmations.down('#bugZone')) new Insertion.Top('confirmations', '<div id="bugZone"></div>');

			try
			{
				if(window.selectPopupWindow && window.selectPopupWindow.document)
				{
					var win = window.selectPopupWindow;

					var confirmations = win.$('confirmations');
					if(confirmations)
					{
						if(!confirmations.down('#yellowZone')) new win.Insertion.Top('confirmations', '<div id="yellowZone"></div>');
						if(!confirmations.down('#redZone')) new win.Insertion.Top('confirmations', '<div id="redZone"></div>');
						if(!confirmations.down('#bugZone')) new win.Insertion.Top('confirmations', '<div id="bugZone"></div>');
					}
				}
			}
			catch(e)
			{

			}

			try
			{
				// Show confirmation
				if(response.responseData.status)
				{
					this.showConfirmation(response.responseData);
				}
			}
			catch (e)  { this.showBug(); }
		}

		if (this.onComplete)
		{
			this.onComplete(response, url);
		}
	},

	showBug: function()
	{
		new Insertion.Top('bugZone',
		'<div style="display: none;" id="confirmation_' + (++LiveCart.AjaxRequest.prototype.requestCount) + '" class="bugMessage">' +
			'<img class="closeMessage" src="image/silk/cancel.png"/>' +
			'<div>' + Backend.internalErrorMessage + '</div>' +
		'</div>');

		new Backend.SaveConfirmationMessage($('confirmation_' + LiveCart.AjaxRequest.prototype.requestCount));

		try
		{
			if(window.selectPopupWindow)
			{
				var win = window.selectPopupWindow;
				if(win.$('confirmations'))
				{
					new win.Insertion.Top('bugZone',
					'<div style="display: none;" id="confirmation_' + (++LiveCart.AjaxRequest.prototype.requestCount) + '" class="bugMessage">' +
						'<img class="closeMessage" src="image/silk/cancel.png"/>' +
						'<div>' + Backend.internalErrorMessage + '</div>' +
					'</div>');

					new Backend.SaveConfirmationMessage(win.$('confirmation_' + LiveCart.AjaxRequest.prototype.requestCount));
				}
			}
		}
		catch(e)
		{

		}
	},

	showConfirmation: function(responseData)
	{
		if(!responseData.message) return;

		var color = null;
		if('success' == responseData.status) color = 'yellow';
		if('failure' == responseData.status) color = 'red';

		new Insertion.Top('confirmations',
		'<div style="display: none;" id="confirmation_' + (++LiveCart.AjaxRequest.prototype.requestCount) + '" class="' + color + 'Message">' +
			'<img class="closeMessage" src="image/silk/cancel.png"/>' +
			'<div>' + responseData.message + '</div>' +
		'</div>');

		new Backend.SaveConfirmationMessage($('confirmation_' + LiveCart.AjaxRequest.prototype.requestCount));

		try
		{
			if(window.selectPopupWindow && window.selectPopupWindow.document)
			{
				var win = window.selectPopupWindow;

				new win.Insertion.Top(color + 'Zone',
				'<div style="display: none;" id="confirmation_' + (++LiveCart.AjaxRequest.prototype.requestCount) + '" class="' + color + 'Message">' +
					'<img class="closeMessage" src="image/silk/cancel.png"/>' +
					'<div>' + responseData.message + '</div>' +
				'</div>');

				new win.Backend.SaveConfirmationMessage(win.$('confirmation_' + LiveCart.AjaxRequest.prototype.requestCount));
			}
		}
		catch(e)
		{

		}
	},

	getResponseChunks: function(originalRequest)
	{
		if (!originalRequest.formerLength)
		{
			originalRequest.formerLength = 0;
		}

		var response = originalRequest.responseText.substr(originalRequest.formerLength);
		originalRequest.formerLength = originalRequest.responseText.length;

		var ret = [];
		var portions = response.split('|');

		for (var k = 0; k < portions.length; k++)
		{
			if (0 == portions[k].length)
			{
				continue;
			}

			ret.push(eval('(' + decode64(portions[k]) + ')'));
		}

		return ret;
	},

	reportError: function(response)
	{
		alert('Error!\n\n' + response.responseText);
	}
}

LiveCart.AjaxUpdater = Class.create();
LiveCart.AjaxUpdater.prototype = {

	indicatorContainerId: null,

	initialize: function(formOrUrl, container, indicator, insertionPosition, onComplete, options)
	{
		var url = "";
		var method = "";
		var params = options ? (options.parameters || '') : '';
		this.onComplete = onComplete;

		var containerId = $(container);
		var indicatorId = $(indicator);

		if (typeof formOrUrl == "object")
		{
			if (window.tinyMCE)
			{
				tinyMCE.triggerSave();
			}

			var form = formOrUrl;
			url = form.action;
			method = form.method;
			params = Form.serialize(form);

			if (!indicatorId)
			{
				var controls = form.down('fieldset.controls');
				if (controls)
				{
					indicatorId = controls.down('.progressIndicator');
					if(indicatorId.style.visibility == 'hidden')
					{
						this.adjustIndicatorVisibility = true;
					}
				}
			}
		}
		else
		{
			url = formOrUrl;
			method = "post";
		}

		url = LiveCart.AjaxRequest.prototype.fixUrl(url);

		LiveCart.ajaxUpdaterInstance = this;

		if (indicatorId)
		{
			this.indicatorContainerId = indicatorId;
			this.adjustIndicatorVisibility = !Element.visible(this.indicatorContainerId);
			this.showIndicator();
		}

		if (!options)
		{
			options = {};
		}

		options.method = method;
		options.parameters = params;
		options.onComplete = this.postProcessResponse.bind(this);
		options.onFailure = this.reportError.bind(this);
		options.onSuccess = function()
			{
				if (window.ActiveForm && $(container))
				{
					ActiveForm.prototype.destroyTinyMceFields($(container));
				}
			}

		options.parameters += (options.parameters ? '&' : '') + 'ajax=true';

		if (insertionPosition != undefined && insertionPosition != false)
		{
			switch(insertionPosition)
			{
				case 'top':
					options.insertion = Insertion.Top;
				break;

				case 'bottom':
					options.insertion = Insertion.Bottom;
				break;

				case 'before':
					options.insertion = Insertion.Before;
				break;

				case 'after':
					options.insertion = Insertion.After;
				break;

				default:
					alert('Invalid insertion position value in AjaxUpdater'); // ?
				break;
			}
		}

		document.body.style.cursor = 'progress';

		var ajax = new Ajax.Updater({success: containerId},
						 url,
						 options);

	},

	hideIndicator: function()
	{
		if (!this.indicatorContainerId)
		{
			return;
		}

		$(this.indicatorContainerId).removeClassName('progressIndicator');

		if (this.adjustIndicatorVisibility)
		{
			Element.hide(this.indicatorContainerId);
		}
	},

	showIndicator: function()
	{
		if (this.indicatorContainerId)
		{
			$(this.indicatorContainerId).addClassName('progressIndicator');
			Element.show(this.indicatorContainerId);
		}
	},

	postProcessResponse: function(response)
	{
		document.body.style.cursor = 'default';
		response.responseText.evalScripts();
		this.hideIndicator();

		if (this.onComplete)
		{
		  	this.onComplete(response);
		}
	},

	reportError: function(response)
	{
		alert('Error!\n\n' + response.responseText);
	}
}

LiveCart.FileUpload = Class.create();
LiveCart.FileUpload.prototype =
{
	upload: null,
	url: null,
	onComplete: null,
	cloned: null,

	initialize: function(upload, url, onComplete)
	{
		this.upload = upload;
		this.url = url;
		this.onComplete = onComplete;

		Event.observe(upload, 'change', this.submit.bindAsEventListener(this));
	},

	submit: function(el)
	{
		var upload = this.upload;

		var target = document.createElement('iframe');
		target.setAttribute('name', 'upload_iframe_' + Math.round(Math.random() * 1000000000000000));
		target.setAttribute('style', 'display: none;');

		document.body.appendChild(target);

		target.onload =
			function()
			{
				var oDoc = target.contentWindow || target.contentDocument;
				if (oDoc.document)
				{
					oDoc = oDoc.document;
    			}

				var res = oDoc.body.innerHTML;
				if (res.substr(0, 5) == '<pre>')
				{
					res = res.substr(5, res.length - 11);
				}

				res = res.length > 0 ? res.evalJSON() : {}

				if (this.onComplete)
				{
					this.onComplete(this.cloned, res);
				}
			}.bind(this);

		var uploadForm = document.createElement('form');
		uploadForm.setAttribute('method', 'POST');
		uploadForm.setAttribute('enctype', 'multipart/form-data');
		uploadForm.setAttribute('action', this.url.replace(/\&amp\;/g, '&'));
		uploadForm.setAttribute('target', target.getAttribute('name'));
		$(uploadForm).hide();

		document.body.appendChild(uploadForm);

		var cloned = this.upload.cloneNode(true);
		cloned.id += Math.round(Math.random() * 1000);

		$(upload).hide();
		upload.parentNode.insertBefore(cloned, upload);
		$(cloned).show();

		uploadForm.appendChild(upload);

		uploadForm.submit();

		new LiveCart.FileUpload(cloned, this.url, this.onComplete);
		this.cloned = cloned;
	}
}

/********************************************************************
 * Router / Url manipulator
 ********************************************************************/
Router =
{
	urlTemplate: '',

	setUrlTemplate: function(url)
	{
		url = url.replace(/controller/, '__c__');
		this.urlTemplate = url.replace(/action/, '__a__');
	},

	createUrl: function(controller, action, params)
	{
		var url = this.urlTemplate.replace(/__c__/, controller);
		url = url.replace(/__a__/, action);

		if (params)
		{
			$H(params).each(function(param)
			{
				url = this.setUrlQueryParam(url, param[0], param[1])
			}.bind(this));
		}

		return url;
	},

	setUrlQueryParam: function(url, key, value)
	{
		return url + (url.match(/\?/) ? '&' : '?') + key + '=' + value;
	}
}


Observer =
{
	observers: {},

	add: function(key, method, params)
	{
		if (!this.observers[key])
		{
			this.observers[key] = [];
		}

		this.observers[key].push([method, params]);
	},

	process: function(key, value)
	{
		if (!this.observers[key])
		{
			return;
		}

		$A(this.observers[key]).each(function(observer)
		{
			observer[0](value, observer[1]);
		});
	},

	processArray: function(responseData)
	{
		$H(responseData).each(function(v)
		{
			this.process(v[0], v[1]);
		}.bind(this));
	}
}

function decode64(inp)
{

var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZ" + //all caps
"abcdefghijklmnopqrstuvwxyz" + //all lowercase
"0123456789+/=";

var out = ""; //This is the output
var chr1, chr2, chr3 = ""; //These are the 3 decoded bytes
var enc1, enc2, enc3, enc4 = ""; //These are the 4 bytes to be decoded
var i = 0; //Position counter

// remove all characters that are not A-Z, a-z, 0-9, +, /, or =
var base64test = /[^A-Za-z0-9\+\/\=]/g;

if (base64test.exec(inp)) { //Do some error checking

	return false;

}
inp = inp.replace(/[^A-Za-z0-9\+\/\=]/g, "");

do { //Here?s the decode loop.

//Grab 4 bytes of encoded content.
enc1 = keyStr.indexOf(inp.charAt(i++));
enc2 = keyStr.indexOf(inp.charAt(i++));
enc3 = keyStr.indexOf(inp.charAt(i++));
enc4 = keyStr.indexOf(inp.charAt(i++));

//Heres the decode part. There?s really only one way to do it.
chr1 = (enc1 << 2) | (enc2 >> 4);
chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
chr3 = ((enc3 & 3) << 6) | enc4;

//Start to output decoded content
out = out + String.fromCharCode(chr1);

if (enc3 != 64) {
out = out + String.fromCharCode(chr2);
}
if (enc4 != 64) {
out = out + String.fromCharCode(chr3);
}

//now clean out the variables used
chr1 = chr2 = chr3 = "";
enc1 = enc2 = enc3 = enc4 = "";

} while (i < inp.length); //finish off the loop

//Now return the decoded values.
//return out;
return _utf8_decode(out);
}

 // private method for UTF-8 decoding
function _utf8_decode(utftext) {
	 var string = "";
	 var i = 0;
	 var c, c1, c2 = 0;

	 while ( i < utftext.length ) {

		 c = utftext.charCodeAt(i);

		 if (c < 128) {
			 string += String.fromCharCode(c);
			 i++;
		 }
		 else if((c > 191) && (c < 224)) {
			 c2 = utftext.charCodeAt(i+1);
			 string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
			 i += 2;
		 }
		 else {
			 c2 = utftext.charCodeAt(i+1);
			 c3 = utftext.charCodeAt(i+2);
			 string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
			 i += 3;
		 }

	 }

	 return string;
}

function sendEvent(element,event)
{
    if (document.createEventObject)
    {
        // dispatch for IE
        var evt = document.createEventObject();
        return element.fireEvent('on'+event/*,  evt */)
    }
    else
    {
        // dispatch for firefox + others
        var evt = document.createEvent("HTMLEvents");
        evt.initEvent(event, true, true ); // event type,bubbling,cancelable
        return !element.dispatchEvent(evt);
    }
}

Prototype.Browser.IE6 = Prototype.Browser.IE && parseInt(navigator.userAgent.substring(navigator.userAgent.indexOf("MSIE")+5)) == 6;
Prototype.Browser.IE7 = Prototype.Browser.IE && parseInt(navigator.userAgent.substring(navigator.userAgent.indexOf("MSIE")+5)) == 7;
Prototype.Browser.IE8 = Prototype.Browser.IE && !Prototype.Browser.IE6 && !Prototype.Browser.IE7;


/***************************************************
 * library/FooterToolbar.js
 ***************************************************/

//
//   API requires:
//  - ability to call hide on all menus.
//

var FooterToolbar = Class.create();
FooterToolbar.prototype = {
	nodes : {},

	properties: {},

	// draggable menu items contains <a> tags, clicking on them reloads page
	// this flag is used for workround
	draggingItem: false,

	isBackend: false,

	afterInit: function()
	{
	},

	nodes: function()
	{
	},

	initialize: function(rootNode, properties)
	{
		this.nodes.root = $(rootNode);
		this.nodes.mainpanel = this.nodes.root.down("ul");
		this.properties = $H(properties || null);

		this.nodes(); // find nodes used only by frontend or backend.
		this.afterInit(); // constructor only for frontend or backend.
	},

	getPorperty: function(key)
	{
		return this.properties[key];
	},

	getSubPanels: function(node)
	{
		return $A(node.getElementsByClassName("subpanel"));
	},

	adjustPanel: function (panel)
	{
		panel = $(panel);
		var
			windowHeight = window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight),
			subpanel = $(panel.getElementsBySelector(".subpanel")[0]),
			ul = $(panel.getElementsBySelector("ul")[0]);

		subpanel.style.height="auto";
		ul.style.height="auto";

		var
			panelsub = subpanel.getHeight(),
			panelAdjust = windowHeight - 196,
			ulAdjust =  panelAdjust - 25;

		if (panelsub > panelAdjust)
		{
			subpanel.style.height=panelAdjust+"px";
			ul.style.height=panelAdjust+"px";
		}
		else
		{
			ul.style.height="auto";
		}
	},

	cancelClickEventOnDrag: function(event)
	{
		if (this.draggingItem == true)
		{
			// drag fires only one click event, setting flag to false will allow next clicks on menu to operate normally
			this.draggingItem = false;
			Event.stop(event);
		}
	}
}


/***************************************************
 * backend/Backend.js
 ***************************************************/

/**
 *	@author Integry Systems
 */

var Backend =
{
	idCounter: 0,

	setTranslations: function(translations)
	{
		Backend.translations = translations;
	},

	getTranslation: function(key)
	{
		return this.translations[key];
	},

	sendKeepAlivePing: function()
	{
		new LiveCart.AjaxRequest(Backend.Router.createUrl('backend.index', 'keepAlive'));
	},

	setUniqueID: function(element)
	{
		element.id = 'generatedId_' + ++this.idCounter;
		return element.id;
	},

	getHash: function()
	{
		return Backend.AjaxNavigationHandler.prototype.getHash();
	},

	onLoad: function()
	{
		// AJAX navigation
		dhtmlHistory.initialize();
		dhtmlHistory.addListener(Backend.ajaxNav.handle);
		dhtmlHistory.handleBookmark();

		setInterval("Backend.sendKeepAlivePing();", 300 * 1000);
		if (!$('confirmations'))
		{
			var el = document.createElement('div');
			el.id = 'confirmations';
			document.body.appendChild(el);
		}
	}
};

// set default locale
Backend.locale = 'en';

Backend.openedContainersStack = [];
Backend.showContainer = function(containerID)
{
	if(Backend.openedContainersStack.length == 0)
	{
		Backend.openedContainersStack[0] = containerID;
	}
	else if(Backend.openedContainersStack[Backend.openedContainersStack.length - 1] != containerID)
	{
		Backend.openedContainersStack[Backend.openedContainersStack.length] = containerID;
		$(Backend.openedContainersStack[Backend.openedContainersStack.length - 2]).hide();
	}

	$(Backend.openedContainersStack[Backend.openedContainersStack.length - 1]).show();
}

Backend.hideContainer = function()
{
	if(Backend.openedContainersStack.length  > 0) $(Backend.openedContainersStack[Backend.openedContainersStack.length - 1]).hide();
	Backend.openedContainersStack.splice(Backend.openedContainersStack.length - 1, 1);

	var lastContainer = $(Backend.openedContainersStack[Backend.openedContainersStack.length - 1]);
	if(lastContainer)
	{
		lastContainer.show();
	}
}

/*************************************************
	Help context handler
**************************************************/
Backend.setHelpContext = function(context)
{
	var help = $('help');
	if (help)
	{
		help.href = 'http://doc.livecart.com/help/' + context;
	}
}

/*************************************************
	AJAX back/forward navigation
**************************************************/
Backend.AjaxNavigationHandler = Class.create();
Backend.AjaxNavigationHandler.prototype =
{
	ignoreNextAdd: false,

	initialize: function()
	{
	},

	/**
	 * The AJAX history consists of clicks on certain elements (traditional history uses URL's)
	 * To register a history event, you only have to pass in an element ID, which was clicked. When
	 * the user navigates backward or forward using the browser navigation, these clicks are simply
	 * repeated by calling the onclick() function for the particular element.
	 *
	 * Sometimes it is necessary to perform more than one "click" to return to previous state. In such case
	 * you can pass in several element ID's delimited with # sign. For example: cat_44#tabImages - would first
	 * emulate a click on cat_44 element and then on tabImages element. This is also useful for bookmarking,
	 * which allows to easily reference certain content on complex pages.
	 *
	 * @param element string Element ID, which would be clicked
	 * @param params Probably obsolete, but perhaps we'll find some use for it
	 */
	add: function(element, params)
	{
		if (true == this.ignoreNextAdd)
		{
			this.ignoreNextAdd = false;
			return false;
		}

		dhtmlHistory.add(element + '__');
		return true;
	},

	getHash: function()
	{
		var hash = document.location.hash;

		// Safari
		hash = hash.replace(/%23/, '#');

		return ("#" == hash[0]) ? ('__' == hash.substring(-2) ? hash.substring(1, hash.length - 2) : hash) : hash.substring(0, hash.length - 1);
	},

	handle: function(element, params)
	{
		if(!params) params = {};
		if(!params.recoverFromIndex) params.recoverFromIndex = 0;

		var elementId = element.substr(0, element.length - 2);

		// Safari
		elementId = elementId.replace(/%23/, '#');

		var hashElements = elementId.split('#');

		for (var hashPart = params.recoverFromIndex; hashPart < hashElements.length; hashPart++)
		{
			if ($(hashElements[hashPart]))
			{
				// only register the click for the last element
				if (hashPart < hashElements.length - 1)
				{
					Backend.ajaxNav.ignoreNext();
				}

				if ($(hashElements[hashPart]).onclick)
				{
					$(hashElements[hashPart]).onclick();
				}
			}

			/*
			// This is in case element is not yet loaded. If so we wait for all requests to finish and the continue.
			else if(Ajax.activeRequestCount > 0)
			{
				setInterval(function()
				{
					if(this.handle)
					{
						this.handle(element, { recoverFromIndex: hashPart });
					}
				}.bind(this), 10);

				return;
			}
			*/

		}
	},


	ignoreNext: function()
	{
		this.ignoreNextAdd = true;
	}
}

Backend.ajaxNav = new Backend.AjaxNavigationHandler();

/*************************************************
	Layout Control
**************************************************/
Backend.LayoutManager = Class.create();

/**
 * Manage 100% heights
 *
 * IE does this pretty good natively (only the main content div height is changed on window resize),
 * however FF won't handle cascading 100% heights unless the page is being rendered in quirks mode.
 *
 * You can specify a block to take 100% height by assigning a "maxHeight" CSS class to it
 * This class also simulates an "extension" of CSS, that allows to add or substract some height
 * in pixels from percentage defined height (for example 100% minus 40px). This will often be needed
 * to compensate for parent elements padding. For example, if the parent element has a top and bottom
 * padding of 10px, you'll have to substract 20px from child block size. This will also be needed when
 * there are other siblings that consume some known height (like TabControl, which contains a
 * tab bar with known height and content div, which must take 100% of the rest of the available height).
 *
 * Example:
 *
 * <code>
 *	  <div class="maxHeight h--50">
 *		  This div will take 100% of available space minus 50 pixels
 *	  </div>
 * </code>
 *
 * @todo automatically substract parent padding
 */
Backend.LayoutManager.prototype =
{
	initialize: function()
	{
		window.onresize = this.onresize.bindAsEventListener(this);
		this.onresize();
	},

	redraw: function()
	{
		document.body.hide();
		document.body.show();
	},

	/**
	 * Set the minimum possible height to all involved elements, so that
	 * their height could be enlarged to necessary size
	 */
	collapseAll: function(cont)
	{
		var el = document.getElementsByClassName("maxHeight", document);

		for (k = 0; k < el.length; k++)
		{
			el[k].style.minHeight = '0px';

			if (document.all)
			{
				el[k].style.height = '0px';
			}
			else
			{
				el[k].style.minHeight = '0px';
			}

		}
	},

	/**
	 * @todo Figure out why IE needs additional 2px offset
	 * @todo Figure out a better way to determine the body height for all browsers
	 */
	onresize: function()
	{
		if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version == 7) return;

		if (document.all)
		{
			$('pageContentContainer').style.height = '0px';
		}

		// calculate content area height
		var ph = new PopupMenuHandler();
		var w = ph.getWindowHeight();
		var h = w - 185 - (document.all ? 1 : 0);
		var cont = $('pageContentContainer');

		if (BrowserDetect.browser == 'Explorer')
		{
			cont.style.height = h + 'px';

			// force re-render for IE
			$('pageContainer').style.display = 'none';
			$('pageContainer').style.display = 'block';
			$('nav').style.display = 'none';
			$('nav').style.display = 'block';
		}
		else // Good browsers
		{
			cont.style.minHeight = h + 'px';

			this.collapseAll(cont);
			this.setMaxHeight(cont);
		}
	},

	setMaxHeight: function(parent)
	{
		var el = document.getElementsByClassName('maxHeight', parent);
		for (k = 0; k < el.length; k++)
		{
			var parentHeight = el[k].parentNode.offsetHeight;

			offset = 0;
			if (el[k].className.indexOf(' h-') > 0)
			{
				offset = el[k].className.substr(el[k].className.indexOf(' h-') + 3, 10);
				if (offset.indexOf(' ') > 0)
				{
					offset = offset.substr(0, offset.indexOf(' '));
				}
			}
			offset = parseInt(offset);
			newHeight = parentHeight + offset;
			el[k].style.minHeight = newHeight + 'px';
		}
	}
}

/*************************************************
	Breadcrumb navigation
**************************************************/
Backend.Breadcrumb =
{
	loadedIDs: $A([]),
	selectedItemId: 0,
	pageTitle: $("pageTitle"),
	template: $("breadcrumb_template"),

	display: function(id, additional)
	{
		if (!Backend.Breadcrumb.pageTitle)
		{
			Backend.Breadcrumb.pageTitle = $("pageTitle");
		}

		Backend.Breadcrumb.template = $("breadcrumb_template");
		Backend.Breadcrumb.createPath(id, additional);
	},

	createPath: function(id, additional)
	{
		if(!Backend.Breadcrumb.treeBrowser && Backend.Breadcrumb.treeBrowser.getSelectedItemId) return;
		var parentId = id;

		if (!Backend.Breadcrumb.treeBrowser)
		{
			return false;
		}

		Backend.Breadcrumb.selectedItemId = Backend.Breadcrumb.treeBrowser.getSelectedItemId();

		if (!Backend.Breadcrumb.pageTitle)
		{
			return false;
		}

		Backend.Breadcrumb.pageTitle.innerHTML = "";

		if(typeof(id) != 'object')
		{
			do
			{
				Backend.Breadcrumb.addCrumb(Backend.Breadcrumb.treeBrowser.getItemText(parentId), parentId, true);
				parentId = Backend.Breadcrumb.treeBrowser.getParentId(parentId);
			}
			while(parentId != 0);
		}
		else
		{
			$A(id).each(function(node) {
				Backend.Breadcrumb.addCrumb(node.name, node.ID);
			});
		}

		if(additional)
		{
			if(typeof(additional) != "object")
			{
				new Insertion.Bottom(Backend.Breadcrumb.pageTitle, "<span class=\"breadcrumb\">" + Backend.Breadcrumb.template.innerHTML + "</span>");
				$$("#pageTitle a").last().innerHTML = additional;
			}
			else
			{
				$A(additional).each(function(crumb)
				{
					if(typeof(crumb) == "string")
					{
						Backend.Breadcrumb.addCrumb(crumb, false)
					}
					else
					{
					   Backend.Breadcrumb.addCrumb(crumb[0], crumb[1])
					}
				});
			}
		}

		var lastSeparator = $$("#pageTitle .breadcrumb").last().down('.breadcrumb_separator');
		if(lastSeparator)
		{
			lastSeparator.hide();
		}

		var lastLink = $$("#pageTitle .breadcrumb").last().down('a');
		if(lastLink)
		{
			Backend.Breadcrumb.convertLinkToText(lastLink);
		}
	},

	addCrumb: function(nodeStr, parentId, reverse) {
		var template = "<span class=\"breadcrumb\">" + Backend.Breadcrumb.template.innerHTML + "</span>";
		var link = null;

		if(reverse)
		{
			new Insertion.Top(Backend.Breadcrumb.pageTitle, template);
			link = Backend.Breadcrumb.pageTitle.childElements().first().down('a');
		}
		else
		{
			new Insertion.Bottom(Backend.Breadcrumb.pageTitle, template);
			link = Backend.Breadcrumb.pageTitle.childElements().last().down('a');
		}


		link.innerHTML = nodeStr;

		if(typeof(parentId) == "function")
		{
			Event.observe(link, "click", parentId);
		}
		else if(parentId !== false)
		{
			link.catId = parentId;
			link.href = "#cat_" + parentId;
			Event.observe(link, "click", function(e) {
				Event.stop(e);
				Backend.hideContainer();

				if(Backend.Breadcrumb.treeBrowser.getIndexById(this.catId) == null)
				{
					Backend.Category.treeBrowser.loadXML(Backend.Router.setUrlQueryParam(Backend.Category.links.categoryRecursiveAutoloading, "id", this.catId));
				}
				else
				{
					Backend.Breadcrumb.treeBrowser.selectItem(this.catId, true);
				}
			});
		}
	},

	setTree: function(treeBrowser) {
		Backend.Breadcrumb.treeBrowser = treeBrowser;
	},

	convertLinkToText: function(link) {
		new Insertion.After(link, link.innerHTML);
		Element.remove(link);
	}
}

/*************************************************
	Backend menu
**************************************************/
Backend.NavMenu = Class.create();

/**
 * Builds navigation menu from passed JSON array
 */
Backend.NavMenu.prototype =
{
	initialize: function(menuArray, controller, action)
	{
		var index = -1;
		var subIndex = 0;
		var subItemIndex = 0;
		var match = false;

		// find current menu items
		for (topIndex in menuArray)
		{
			if('object' == typeof menuArray[topIndex])
			{
				mItem = menuArray[topIndex];

				if (mItem['controller'] == controller)
				{
					index = topIndex;
				}

				if (mItem['controller'] == controller && mItem['action'] == action)
				{
					index = topIndex;
					subItemIndex = 0;
					match = true;
					break;
				}

				match = false;

				if ('object' == typeof mItem['items'])
				{
					for (subIndex in mItem['items'])
					{
						subItem = mItem['items'][subIndex];

						if (subItem['controller'] == controller && subItem['action'] == action)
						{
							index = topIndex;
							subItemIndex = subIndex;
							match = true;
							break;
						}
						else if (controller == subItem['controller'])
						{
							index = topIndex;
							subItemIndex = subIndex;
						}
					}

					if (match)
					{
						break;
					}
				}
			}
		}

		// add current menu items to breadcrumb
		/*
		breadcrumb.addItem(menuArray[index]['title'], menuArray[index]['url']);
		if (subItemIndex > 0)
		{
			breadcrumb.addItem(menuArray[index]['items'][subItemIndex]['title'],
							   menuArray[index]['items'][subItemIndex]['url']);
		}
		*/

		// build menu
		var topItem = $('navTopItem-template');
		var subItem = $('navSubItem-template');
		var nr = 0, subNr;
		navCont = $('nav');

		for (topIndex in menuArray)
		{
			if('object' == typeof menuArray[topIndex])
			{
				mItem = menuArray[topIndex];

				menuItem = topItem.cloneNode(true);

				var a = menuItem.getElementsByTagName('a')[0];
				a.href = mItem['url'];
				a.descr = mItem['descr'];
				a.id="menu_"+nr;
				if(!mItem['url'])
				{
					a.onclick = function() { return false; }
					a.className = 'topItem';
				}
				a.innerHTML = mItem['title'];
				menuItem.style.display = 'block';
				if ('' != mItem['icon'])
				{
					a.style.backgroundImage = 'url(' + mItem['icon'] + ')';
				}

				if (topIndex == index)
				{
					menuItem.id = 'navSelected';
				}
				else
				{
					Event.observe(menuItem, 'mouseover', this.hideCurrentSubMenu);
					Event.observe(menuItem, 'mouseout', this.showCurrentSubMenu);
				}

				// submenu container
				ul = menuItem.getElementsByTagName('ul')[0];

				if ('object' == typeof mItem['items'])
				{
					subNr = 0;
					for (subIndex in mItem['items'])
					{
						sub = mItem['items'][subIndex];

						if ('object' == typeof sub)
						{
							subNode = subItem.cloneNode(true);
							var a = subNode.getElementsByTagName('a')[0];
							if ('' != sub['icon'])
							{
								a.style.backgroundImage = 'url(' + sub['icon'] + ')';
							}

							a.href = sub['url'];
							a.innerHTML = sub['title'];
							a.descr = sub['descr'];
							a.id="menu_"+nr+"_"+subNr;
							subNr++;
							if ((topIndex == index) && (subIndex == subItemIndex))
							{
								subNode.id = 'navSubSelected';
							}

							ul.appendChild(subNode);
						}
					}
				}
				else
				{
					// no subitems
					ul.parentNode.removeChild(ul);
				}

				// do not show empty menus
				if (menuItem.getElementsByTagName('ul').length || mItem['url'])
				{
					navCont.appendChild(menuItem);
				}
			}
			nr++;
		}

		Event.observe(navCont, 'mouseover', this.showDescription.bind(this));
		Event.observe(navCont, 'mouseout', this.hideDescription.bind(this));
	},

	hideCurrentSubMenu: function()
	{
		if ($('navSelected') && $('navSelected').getElementsByTagName('ul')[0])
		{
			$('navSelected').getElementsByTagName('ul')[0].style.visibility = 'hidden';
		}
	},

	showCurrentSubMenu: function()
	{
		if ($('navSelected') && $('navSelected').getElementsByTagName('ul')[0])
		{
			$('navSelected').getElementsByTagName('ul')[0].style.visibility = 'visible';
		}
	},

	showDescription: function(e)
	{
		var a = Event.element(e);
		if ((a.tagName != 'A') || !a.descr)
		{
			this.hideDescription();
			return;
		}

		this.getDescrContainer().update(a.descr);
		this.getDescrContainer().show();
	},

	hideDescription: function()
	{
		this.getDescrContainer().hide();
	},

	getDescrContainer: function()
	{
		if (!this.descrContainer)
		{
			this.descrContainer = $('menuDescription');
		}

		return this.descrContainer;
	}
}

Backend.ThemePreview = Class.create();
Backend.ThemePreview.prototype =
{
	initialize: function(container, select)
	{
		var img = document.createElement('img');
		img.addClassName('themePreview');
		container.appendChild(img);
		select.image = img;

		var change =
			function()
			{
				var img = this.image;

				if (!this.value || 0 == this.value)
				{
					img.hide();
					return;
				}
				else
				{
					img.show();
				}

				img.href = 'theme' + (this.value != 'barebone' ? '/' + this.value : '') + '/preview.png';
				img.title = this.value;
				img.onclick =
					function()
					{
						img.rel = 'lightbox';
						Lightbox.prototype.getInstance().start(img.href);
					}

				img.onload =
					function()
					{
						this.show();
					}

				img.onerror =
					function()
					{
						this.hide();
					}

				img.src = 'theme' + (this.value != 'barebone' ? '/' + this.value : '') + '/preview_small.png';
			}

		change.bind(select)();

		Event.observe(select, 'change', change);
	}
}

/*************************************************
	Language switch menu
*************************************************/
function showLangMenu(display) {
	menu = $('langMenuContainer');
	if (display)
	{
		menu.style.display = 'block';
		new Ajax.Updater('langMenuContainer', langMenuUrl);

		setTimeout("Event.observe(document, 'click', hideLangMenu, true);", 500);
	}
	else
	{
		menu.style.display = 'none';
		Event.stopObserving(document, 'click', hideLangMenu, true);
	}
}

function hideLangMenu()
{
	showLangMenu(false);
}

/*************************************************
	Popup Menu Handler
*************************************************/
/**
 * Popup menu (absolutely positioned DIV's) position handling
 * This class calculates the optimal menu position, so that the
 * menu would always be within visible window boundaries
 **/
PopupMenuHandler = Class.create();
PopupMenuHandler.prototype =
{
	x: 0,
	y: 0,

	initialize: function(xPos, yPos, width, height)
	{
		scrollX = this.getScrollX();
		scrollY = this.getScrollY();

		if ((xPos + width) > (scrollX + this.getWindowWidth()))
		{
			xPos = scrollX + this.getWindowWidth() - width - 40;
		}

		if (xPos < scrollX)
		{
			xPos = scrollX + 1;
		}

		if ((yPos + height) > (scrollY + this.getWindowHeight()))
		{
			yPos = scrollY + this.getWindowHeight() - height - 40;
		}

		if (yPos < scrollY)
		{
			yPos = scrollY + 1;
		}

		this.x = xPos;
		this.y = yPos;
	},

	getByElement: function(element, x, y)
	{
		var inst = new PopupMenuHandler(x, y, element.offsetWidth, element.offsetHeight);
		element.style.left = inst.x + 'px';
		element.style.top = inst.y + 'px';
	},

	getScrollX: function()
	{
		var scrOfX = 0;
		if( typeof( window.pageYOffset ) == 'number' ) {
			//Netscape compliant
			scrOfX = window.pageXOffset;
		}
		else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) )
		{
			//DOM compliant
			scrOfX = document.body.scrollLeft;
		} else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) )
		{
			//IE6 standards compliant mode
			scrOfX = document.documentElement.scrollLeft;
		}
		return scrOfX;
	},

	getScrollY: function()
	{
		var scrOfY = 0;
		if( typeof( window.pageYOffset ) == 'number' ) {
			//Netscape compliant
			scrOfY = window.pageYOffset;
		}
		else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) )
		{
			//DOM compliant
			scrOfY = document.body.scrollTop;
		} else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) )
		{
			//IE6 standards compliant mode
			scrOfY = document.documentElement.scrollTop;
		}
		return scrOfY;
	},

	getWindowWidth: function()
	{
		var myWidth = 0;
		if( typeof( window.innerWidth ) == 'number' )
		{
			//Non-IE
			myWidth = window.innerWidth;
		}
		else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) )
		{
			//IE 6+ in 'standards compliant mode'
			myWidth = document.documentElement.clientWidth;
		}
		else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) )
		{
			//IE 4 compatible
			myWidth = document.body.clientWidth;
		}
		return myWidth;
	},

	getWindowHeight: function()
	{
		var myHeight = 0;
		if( typeof( window.innerWidth ) == 'number' )
		{
			//Non-IE
			myHeight = window.innerHeight;
		}
		else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) )
		{
			//IE 6+ in 'standards compliant mode'
			myHeight = document.documentElement.clientHeight;
		}
		else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) )
		{
			//IE 4 compatible
			myHeight = document.body.clientHeight;
		}
		return myHeight;
	}
}


/*************************************************
	Browser detector
*************************************************/

/**
 * Browser detector
 * @link http://www.quirksmode.org/js/detect.html
 */
var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++) {
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{   string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{	   // for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{	   // for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};

BrowserDetect.init();

/*************************************************
	Save confirmation message animation
*************************************************/
Backend.SaveConfirmationMessage = Class.create();
Backend.SaveConfirmationMessage.prototype =
{
	counter: 0,
	timers: {},
	options: {},

	initialize: function(element, options)
	{
		this.element = $(element);

		if(!this.element.id)
		{
			this.element.id = this.getGeneratedId();
		}

		if(!Backend.SaveConfirmationMessage.prototype.timers[this.element.id])
		{
			Backend.SaveConfirmationMessage.prototype.timers[this.element.id] = {};
		}

		if(!this.element.down('div')) this.element.appendChild(document.createElement('div'));
		this.innerElement = this.element.down('div');

		if(options && options.type)
		{
			Element.addClassName(this.element, options.type + 'Message')
		}

		if(options && options.message)
		{
			if(this.innerElement.firstChild) this.innerElement.firstChild.value = options.message;
			else this.innerElement.appendChild(document.createTextNode(options.message));
		}

		var closeButton = this.element.down('.closeMessage');
		if(closeButton)
		{
			this.hideCloseButton(closeButton);

			Event.observe(closeButton, 'mouseover', function(e) { this.showCloseButton(closeButton) }.bind(this) )
			Event.observe(closeButton, 'mouseout', function(e) { this.hideCloseButton(closeButton) }.bind(this) )
			Event.observe(closeButton, 'click', function(e) { this.hide() }.bind(this) )
		}

		this.options = options;

		this.show();
	},

	showCloseButton: function(closeButton)
	{
		try {
			closeButton.setOpacity(1);
		} catch(e) {
			closeButton.style.visibility = 'visible';
		}
	},

	hideCloseButton: function(closeButton)
	{
		try {
			closeButton.setOpacity(0.5);
		} catch(e) {
			closeButton.style.visibility = 'hidden';
		}
	},

	show: function()
	{
		this.stopTimers();
		this.element.hide();

		this.displaying = true;

		//Backend.SaveConfirmationMessage.prototype.timers[this.element.id].scrollEffect = new Effect.ScrollTo(this.element, {offset: -24});
		Backend.SaveConfirmationMessage.prototype.timers[this.element.id].appearEffect = new Effect.Appear(this.element, {duration: 0.4, afterFinish: this.highlight.bind(this)});
	},

	highlight: function()
	{
		//this.innerElement.focus();
		Backend.SaveConfirmationMessage.prototype.timers[this.element.id].effectHighlight = new Effect.Highlight(this.innerElement, { duration: 0.4 });

		// do not hide error or permanent confirmation messages
		if (!this.element.hasClassName('redMessage') && !this.element.hasClassName('bugMessage') && !this.element.hasClassName('stick'))
		{
			Backend.SaveConfirmationMessage.prototype.timers[this.element.id].hideTimeout = setTimeout(function() { this.hide() }.bind(this), 4000);
		}
	},

	hide: function()
	{
		Backend.SaveConfirmationMessage.prototype.timers[this.element.id].fadeEffect = Effect.Fade(this.element, {duration: 0.4});
		Backend.SaveConfirmationMessage.prototype.timers[this.element.id].fadeTimeout = setTimeout(function() { this.displaying = false; }.bind(this), 4000);

		if (this.options && this.options.del/* && this.options.delete !KONQUEROR */)
		{
			this.element.parentNode.removeChild(this.element);
		}
	},

	stopTimers: function()
	{
		if(Backend.SaveConfirmationMessage.prototype.timers[this.element.id].hideTimeout) clearTimeout(Backend.SaveConfirmationMessage.prototype.timers[this.element.id].hideTimeout);
		if(Backend.SaveConfirmationMessage.prototype.timers[this.element.id].fadeTimeout) clearTimeout(Backend.SaveConfirmationMessage.prototype.timers[this.element.id].fadeTimeout);
		if(Backend.SaveConfirmationMessage.prototype.timers[this.element.id].appearEffect) Backend.SaveConfirmationMessage.prototype.timers[this.element.id].appearEffect.cancel();
		if(Backend.SaveConfirmationMessage.prototype.timers[this.element.id].fadeEffect) Backend.SaveConfirmationMessage.prototype.timers[this.element.id].fadeEffect.cancel();
		if(Backend.SaveConfirmationMessage.prototype.timers[this.element.id].effectHighlight) Backend.SaveConfirmationMessage.prototype.timers[this.element.id].effectHighlight.cancel();
	},

	getGeneratedId: function()
	{
		return 'saveConfirmationMessage_' + (Backend.SaveConfirmationMessage.prototype.counter++);
	},

	showMessage: function(message, type)
	{
		if (!type)
		{
			type = 'yellow';
		}

		var el = document.createElement('div');
		el.className = type + 'Message';
		var close = document.createElement('img');
		close.className = 'closeMessage';
		close.src = 'image/silk/cancel.png';

		var confirmations = $('confirmations');
		if (!confirmations)
		{
			confirmations = document.createElement('div');
			confirmations.id = 'confirmations';
			document.body.appendChild(confirmations);
		}

		confirmations.appendChild(el);
		el.appendChild(close);
		new Backend.SaveConfirmationMessage(el, {del: true, message: message});
	}
}

/**
 * Converts between metric and English units
 */
Backend.UnitConventer = Class.create();
Backend.UnitConventer.prototype =
{
	Instances: {},

	initialize: function(root)
	{
		// Get all nodes
		this.nodes = {};
		this.nodes.root = $(root);
		this.nodes.normalizedWeightField = this.nodes.root.down(".UnitConventer_NormalizedWeight");
		this.nodes.unitsTypeField = this.nodes.root.down(".UnitConventer_UnitsType");
		this.nodes.hiValue = this.nodes.root.down('.UnitConventer_HiValue');
		this.nodes.loValue = this.nodes.root.down('.UnitConventer_LoValue');
		this.nodes.switchUnits = this.nodes.root.down('.UnitConventer_SwitchUnits');

		// Add units after fields
		if(!this.nodes.root.down('.UnitConventer_HiUnit'))
		{
		   new Insertion.After(this.nodes.hiValue, '<span class="UnitConventer_HiUnit"> </span>');
		}

		if(!this.nodes.root.down('.UnitConventer_LoUnit'))
		{
			new Insertion.After(this.nodes.loValue, '<span class="UnitConventer_LoUnit"> </span>');
		}

		this.reset();

		// Bind events
		Event.observe(this.nodes.hiValue, "keyup", function(e){ NumericFilter(this); });
		Event.observe(this.nodes.loValue, "keyup", function(e){ NumericFilter(this); });

		Event.observe(this.nodes.hiValue, 'keyup', function(e) { this.updateShippingWeight() }.bind(this));
		Event.observe(this.nodes.loValue, 'keyup', function(e) { this.updateShippingWeight() }.bind(this));
		Event.observe(this.nodes.switchUnits, 'click', function(e) { Event.stop(e); this.switchUnitTypes() }.bind(this));

		this.switchUnitTypes();
		this.switchUnitTypes();
	},

	reset: function()
	{
		this.nodes.switchUnits.update(this.nodes.root.down('.UnitConventer_SwitcgTo' + (this.nodes.unitsTypeField.value == 'ENGLISH' ? 'METRIC' : 'ENGLISH').capitalize() + 'Title').innerHTML);
		this.nodes.root.down('.UnitConventer_HiUnit').innerHTML = this.nodes.root.down('.UnitConventer_'  + this.nodes.unitsTypeField.value.capitalize() + 'HiUnit').innerHTML;
		this.nodes.root.down('.UnitConventer_LoUnit').innerHTML = this.nodes.root.down('.UnitConventer_'  + this.nodes.unitsTypeField.value.capitalize() + 'LoUnit').innerHTML;

		this.nodes.hiValue.value = 0;
		this.nodes.loValue.value = 0;
	},

	getInstance: function(root)
	{
		if (!$(root))
		{
			return false;
		}

		if(!Backend.UnitConventer.prototype.Instances[$(root).id])
		{
			Backend.UnitConventer.prototype.Instances[$(root).id] = new Backend.UnitConventer(root);
		}

		return Backend.UnitConventer.prototype.Instances[$(root).id];
	},

	switchUnitTypes: function()
	{
		this.nodes.switchUnits.update(this.nodes.root.down('.UnitConventer_SwitcgTo' + this.nodes.unitsTypeField.value.capitalize() + 'Title').innerHTML);

		this.nodes.unitsTypeField.value = (this.nodes.unitsTypeField.value == 'ENGLISH') ? 'METRIC' : 'ENGLISH';

		// Change captions
		this.nodes.root.down('.UnitConventer_HiUnit').innerHTML = this.nodes.root.down('.UnitConventer_'  + this.nodes.unitsTypeField.value.capitalize() + 'HiUnit').innerHTML;
		this.nodes.root.down('.UnitConventer_LoUnit').innerHTML = this.nodes.root.down('.UnitConventer_'  + this.nodes.unitsTypeField.value.capitalize() + 'LoUnit').innerHTML;

		var multipliers = this.getWeightMultipliers();

		var hiValue = Math.floor(this.nodes.normalizedWeightField.value / multipliers[0]);
		var loValue = (this.nodes.normalizedWeightField.value - (hiValue * multipliers[0])) / multipliers[1];

		// allow to enter one decimal number for ounces
		var precision = 'ENGLISH' == this.nodes.unitsTypeField.value ? 10 : 1;

		loValue = Math.round(loValue * precision) / precision;

		if ('english' == this.nodes.unitsTypeField.value)
		{
			loValue = loValue.toFixed(0);
		}

		this.nodes.hiValue.value = hiValue;
		this.nodes.loValue.value = loValue;
	},

	getWeightMultipliers: function()
	{
		switch(this.nodes.unitsTypeField.value)
		{
			case 'ENGLISH':
				return [0.45359237, 0.0283495231];

			case 'METRIC':
			default:
				return [1, 0.001]
		}
	},

	updateShippingWeight: function(field)
	{
		var multipliers = this.getWeightMultipliers();
		this.nodes.normalizedWeightField.value = (this.nodes.hiValue.value * multipliers[0]) + (this.nodes.loValue.value * multipliers[1]);
	}
}

/*************************************************
	...
*************************************************/

function slideForm(id, menuId)
{
	Effect.Appear(id, {duration: 0.50});
	Element.hide($(menuId));
}

function restoreMenu(blockId, menuId)
{
	Element.hide($(blockId));
	Element.show($(menuId));
}

/***************************************************
 * Language form
 **************************************************/
Backend.LanguageForm = Class.create();
Backend.LanguageForm.prototype =
{
	initialize: function(root)
	{
		if (root && root.hasClassName('languageForm'))
		{
			var forms = [root];
		}
		else
		{
			var forms = document.getElementsByClassName('languageForm', root);
		}

		for (var k = 0; k < forms.length; k++)
		{
			new TabCustomize(forms[k]);
			var tabs = forms[k].down('ul.languageFormTabs').getElementsByTagName('li');
			for (var t = 0; t < tabs.length; t++)
			{
				if (tabs[t].hasClassName('langTab'))
				{
					tabs[t].onclick = this.handleTabClick.bindAsEventListener(this);
				}
			}
		}
	},

	handleTabClick: function(e)
	{
		var tab = e.innerHTML ? e : Event.element(e);

		// make other tabs inactive
		var tabs = tab.parentNode.getElementsByTagName('li');
		for (var k = 0; k < tabs.length; k++)
		{
			if (tabs[k] != tab)
			{
				Element.removeClassName(tabs[k], 'active');
			}
		}

		Element.toggleClassName(tab, 'active');

		// hide tab contents
		var cont = tab.up('.languageForm').down('.languageFormContent');
		if (cont)
		{
			cont = cont.getElementsByClassName('languageFormContainer');
			for (var k = 0; k < cont.length; k++)
			{
				Element.removeClassName(cont[k], 'active');
			}
		}

		if (Element.hasClassName(tab, 'langTab') && Element.hasClassName(tab, 'active'))
		{
			// get language code
			var id = tab.className.match(/languageFormTabs_([a-z]{2})/)[1];
			Element.addClassName(tab.up('.languageForm').down('.languageFormContainer_' + id), 'active');
		}
	},

	closeTabs: function(container)
	{
		// make other tabs inactive
		var tabs = container.getElementsByTagName('li');
		for (var k = 0; k < tabs.length; k++)
		{
			Element.removeClassName(tabs[k], 'active');
		}

		// hide tab contents
		var cont = container.down('.languageFormContent');
		if (cont)
		{
			cont = cont.getElementsByClassName('languageFormContainer');
			for (var k = 0; k < cont.length; k++)
			{
				Element.removeClassName(cont[k], 'active');
			}
		}
	}
}

/***************************************************
 * MVC
 **************************************************/

MVC = {}
MVC.Model = function() {}
MVC.Model.prototype =
{
	controller: null,

	setController: function(controller)
	{
		this.controller = controller;
		this.notifyAllData(this.controller);
	},

	store: function(name, value)
	{
		if(arguments.length == 1)
		{
			this._data = name;
			if (this.controller)
			{
				this.notifyAllData(this.controller);
			}
		}
		else
		{
			this._data[name] = value;
			if (this.controller)
			{
				this.controller.notifyDataChange(name, value);
			}
		}
	},

	/**
	 *	Notify observers (controllers) that all data has been changed (usually on initial state)
	 */
	notifyAllData: function(recipient, data, prefix)
	{
		if (!data)
		{
			data = this._data;
		}

		if (!prefix)
		{
			prefix = '';
		}

		$H(data).each(function(val)
		{
			if (val[1] instanceof Object)
			{
				this.notifyAllData(recipient, val[1], prefix + val[0] + '.');
			}
			recipient.notifyDataChange(prefix + val[0], val[1]);
		}.bind(this));
	},

	save: function(form, onSaveResponse)
	{
		if(true == this.saving) return;
		this.saving = true;
		this.serverError = false;

		var self = this;

		new LiveCart.AjaxRequest(
			form,
			false,
			function(response)
			{
				var responseHash = {};
				try
				{
					responseHash = eval("(" + response.responseText + ")");
				}
				catch(e)
				{
					responseHash['status'] = 'serverError';
					responseHash['responseText'] = response.responseText;
				}

				this.afterSave(responseHash, onSaveResponse);
			}.bind(this)
		);
	},

	afterSave: function(response, onSaveResponse)
	{
		switch(response.status)
		{
			case 'success':
				this.store('ID', response.ID);
				if (response.data)
				{
					this.store(response.data);
				}
				break;
			case 'failure':
				this.errors = response.errors;
				break;
			case 'serverError':
				this.serverError = response.responseText;
				break;
		}

		onSaveResponse.call(this, response.status);
		this.saving = false;
	}
}

MVC.View = function() {}
MVC.View.prototype =
{
	form: null,

	boundVariables: {},

	assign: function(name, value)
	{
		if(arguments.length == 1)
		{
			this._data = name;
		}
		else
		{
			this._data[name] = value;
		}
	},

	bindForm: function(form)
	{
		this.form = form;
	},

	bindVariable: function(element, variableName)
	{
		if (!element)
		{
			return false;
		}

		this.boundVariables[variableName] = element;
	},

	notifyDataChange: function(name, value)
	{
		if (this.form)
		{
			var element = this.form.elements.namedItem(name);

			if (element)
			{
				element.value = value;
			}
		}

		if (this.boundVariables[name])
		{
			var element = this.boundVariables[name];

			// set value to form elements
			if (element instanceof HTMLInputElement ||
				element instanceof HTMLTextAreaElement ||
				element instanceof HTMLSelectElement ||
				element instanceof HTMLButtonElement)
			{
				element.value = value;
			}

			// innerHTML to others
			else
			{
				element.innerHTML = value;
			}
		}
	}
}

Backend.RegisterMVC = function(MVC)
{
	MVC.Messages = {};
	MVC.Links = {};

	MVC.Model.prototype.defaultLanguage = false;

	MVC.Controller.prototype.notifyDataChange = function(name, value)
	{
		if(this.view)
		{
			this.view.notifyDataChange(name, value);
		}
	}

	MVC.Model.prototype.clear = MVC.View.prototype.clear = function()
	{
		this._data = {};
	}

	MVC.Model.prototype.get = MVC.View.prototype.get = function(name, defaultValue)
	{
		var keys = name.split('.');
		var destination = this._data;
		var found = true;

		try
		{
			$A(keys).each(function(key)
			{
				if(destination[key] === undefined) throw new Error('not found');
				destination = destination[key];
			});
		}
		catch(e)
		{
			found = false;
		}

		return found ? destination : defaultValue;
	}
}

/********************************************************************
 * Select popup
 ********************************************************************/
Backend.SelectPopup = Class.create();
Backend.SelectPopup.prototype = {
	height: 520,
	width:  1000,
	location:  0,
	toolbar:  0,
	onObjectSelect: function() {},

	initialize: function(link, title, options)
	{
		this.link = link;
		this.title = title;

		if(options.onObjectSelect) this.onObjectSelect = options.onObjectSelect;
		this.height = options.height || this.height;
		this.width = options.width || this.width;
		this.location = options.location || this.location;
		this.toolbar = options.toolbar || this.toolbar;

		this.createPopup();
	},

	createPopup: function()
	{
		var createWindow = true;

		try
		{
			if(window.selectPopupWindow && this.link == window.selectPopupWindow.location.pathname)
			{
			   window.selectPopupWindow.focus();
			   createWindow = false;
			}
		}
		catch(e) { }

		if(createWindow)
		{
			Backend.SelectPopup.prototype.popup = window.open(this.link, this.title, 'resizable=1,toolbar=' + this.toolbar + ',location=' + this.location + ',width=' + this.width + ',height=' + this.height);

			Event.observe(window, 'unload', function()
			{
				if(window.selectPopupWindow)
				{
					window.selectPopupWindow.close();
				}
			}, false);

			Backend.SelectPopup.prototype.popup.focus();

			var interval = setInterval(function()
			{
				if(!Backend.SelectPopup.prototype.popup || !Backend.SelectPopup.prototype.popup.Event || !Backend.SelectPopup.prototype.popup.Event.observe)
				{
					return;
				}
				else
				{
					clearInterval(interval)
				}

				Backend.SelectPopup.prototype.popup.Event.observe(Backend.SelectPopup.prototype.popup, "unload", function()
				{
					window.selectPopupWindow = null;
				}.bind(this));

				window.selectPopupWindow = Backend.SelectPopup.prototype.popup;
				window.selectProductPopup = this;


			}.bind(this), 500);
		}
	},

	getSelectedObject: function(objectID, downloadable, indicator)
	{
		this.objectID = objectID;
		this.downloadable = downloadable;
		this.onObjectSelect.call(this, objectID, downloadable, indicator);
	}
}

/********************************************************************
 * Router / Url manipulator
 ********************************************************************/
Backend.Router = Router;

/********************************************************************
 * Progress bar
 ********************************************************************/
Backend.ProgressBar = Class.create();
Backend.ProgressBar.prototype =
{
	container: null,
	counter: null,
	total: null,
	progressBar: null,
	progressBarIndicator: null,

	initialize: function(container)
	{
		this.container = container;

		if (!container.down('.progressCount'))
		{
			this.createHTML();
		}

		this.counter = container.down('.progressCount');
		this.total = container.down('.progressTotal');
		this.progressBar = container.down('.progressBar');
		this.progressBarIndicator = container.down('.progressBarIndicator');
		this.update(0, 0);
	},

	createHTML: function()
	{
		this.container.innerHTML = '<div class="progressBarIndicator"></div><div class="progressBar"><span class="progressCount"></span><span class="progressSeparator"> / </span><span class="progressTotal"></span></div>';
	},

	update: function(progress, total)
	{
		if (progress < 0)
		{
			progress = 0;
		}

		this.counter.update(progress);
		this.total.update(total);

		if (parseFloat(total))
		{
			var progressWidth = (parseFloat(progress) / parseFloat(total)) * this.progressBar.clientWidth;
		}
		else
		{
			var progressWidth = 0;
		}

		this.progressBarIndicator.style.width = progressWidth + 'px';
	},

	getProgress: function()
	{
		return this.counter.innerHTML;
	},

	getTotal: function()
	{
		return this.total.innerHTML;
	},

	rewind: function(progress, total, step, onComplete)
	{
		if (progress > 0)
		{
			progress -= step;
			this.update(progress, total);
			setTimeout(function() { this.rewind(progress, total, step, onComplete) }.bind(this), 40);
		}
		else
		{
			if (onComplete)
			{
				onComplete();
			}
		}
	},

}

/*****************************************
	Multi-instance editor
******************************************/

Backend.MultiInstanceEditor = function(id, owner)
{
	this.id = id ? id : '';
	this.owner = owner;

	this.findUsedNodes();
	this.bindEvents();

	Form.State.backup(this.nodes.form, false, false);
}

Backend.MultiInstanceEditor.prototype =
{
	Links: {},
	Messages: {},
	Instances: {},
	CurrentId: null,

	namespace: null,

	hasInstance: function(id)
	{
		return this.Instances[id] ? true : false;
	},

	getCurrentId: function()
	{
		return this.namespace.prototype.CurrentId;
	},

	setCurrentId: function(id)
	{
		this.namespace.prototype.CurrentId = id;
	},

	craftTabUrl: function(url)
	{
		return url.replace(/_id_/, this.namespace.prototype.getCurrentId());
	},

	craftContentId: function(tabId)
	{
		return tabId + '_' +  this.namespace.prototype.getCurrentId() + 'Content'
	},

	getInstance: function(id, doInit, owner)
	{
		var root = this.namespace.prototype;

		if(!root.Instances[id])
		{
			root.Instances[id] = new this.namespace(id, owner);
		}

		if(doInit !== false)
		{
			root.Instances[id].init();
		}

		root.setCurrentId(id);

		return root.Instances[id];
	},

	getAddInstance: function()
	{
		return new this.namespace('');
	},

	getInstanceContainer: function(id)
	{
		throw 'Implement me';
	},

	getMainContainerId: function()
	{
		throw 'Implement me';
	},

	getAddContainerId: function()
	{
		throw 'Implement me';
	},

	getNavHashPrefix: function()
	{
		throw 'Implement me';
	},

	getListContainer: function()
	{
		throw 'Implement me';
	},

	getActiveGrid: function()
	{
		return false;
	},

	getNavHash: function(id)
	{
		var prefix = this.getNavHashPrefix();
		if (prefix)
		{
			return prefix + id;
		}
	},

	findUsedNodes: function()
	{
		this.nodes = {};
		this.nodes.parent = this.getInstanceContainer(this.id);
		this.nodes.form = this.nodes.parent.down("form");
		this.nodes.cancel = this.nodes.form.down('a.cancel');
		this.nodes.submit = this.nodes.form.down('input.submit');
	},

	bindEvents: function(args)
	{
		Event.observe(this.nodes.cancel, 'click', function(e) { Event.stop(e); this.cancelForm()}.bind(this));
	},

	init: function(args)
	{
		this.namespace.prototype.setCurrentId(this.id);

		Backend.showContainer(this.getMainContainerId());
		this.getListContainer(this.owner).hide();

		this.tabControl = TabControl.prototype.getInstance(this.getMainContainerId(), false);

		this.setPath();
	},

	setPath: function()
	{

	},

	cancelForm: function()
	{
		ActiveForm.prototype.resetErrorMessages(this.nodes.form);
		//Form.restore(this.nodes.form, false, false);

		Backend.hideContainer(this.getMainContainerId());
		this.getListContainer(this.owner).show();

		this.namespace.prototype.setCurrentId(0);
	},

	submitForm: function()
	{
		new LiveCart.AjaxRequest(
			this.nodes.form,
			false,
			function(responseJSON) {
				ActiveForm.prototype.resetErrorMessages(this.nodes.form);
				var responseObject = eval("(" + responseJSON.responseText + ")");
				this.afterSubmitForm(responseObject);
		   }.bind(this)
		);
	},

	afterSubmitForm: function(response)
	{
		if(response.status == 'success')
		{
			var grid = this.getActiveGrid();
			if (grid)
			{
				grid.reloadGrid();
			}

			Form.State.backup(this.nodes.form, false, false);
		}
		else
		{
			ActiveForm.prototype.setErrorMessages(this.nodes.form, response.errors)
		}
	},

	open: function(id, e, onComplete, owner)
	{
		if (e)
		{
			Event.stop(e);

			if(!e.target)
			{
				e.target = e.srcElement
			}

			var progressIndicator = e.target.up('td').down('.progressIndicator');

			progressIndicator.show();
		}

		if (window.opener && window.opener.selectProductPopup)
		{
			window.opener.selectProductPopup.getSelectedObject(id);
			return;
		}

		var root = this.namespace.prototype;

		root.setCurrentId(id);

		var tabControl = TabControl.prototype.getInstance(
			root.getMainContainerId(owner),
			root.craftTabUrl.bind(this),
			root.craftContentId.bind(this)
		);

		tabControl.activateTab(null,
								   function(response)
								   {
										root.getInstance(id, true, owner);
										var navHash = root.getNavHash(id);
										if (navHash)
										{
											Backend.ajaxNav.add(navHash);
										}

										if (progressIndicator)
										{
											progressIndicator.hide();
										}
								   });

		if(root.hasInstance(id))
		{
			root.getInstance(id);
		}
	},

	resetEditors: function()
	{
		this.namespace.prototype.Instances = {};
		this.namespace.prototype.CurrentId = null;

		$(this.getMainContainerId(this.ownerID)).down('.sectionContainer').innerHTML = '';

		TabControl.prototype.__instances__ = {};
	},

	showAddForm: function(caller)
	{
		var container = $(this.getAddContainerId());

		// product form has already been downloaded
		if (this.formTabCopy)
		{
			container.update('');
			container.appendChild(this.formTabCopy);
			this.initAddForm();
		}

		// retrieve product form
		else
		{
			var url = this.Links.add;
			new LiveCart.AjaxUpdater(url, container, caller.up('.menu').down('.progressIndicator'), null, this.initAddForm.bind(this));
		}
	},

	hideAddForm: function()
	{
		if ($(this.getAddContainerId()))
		{
			Element.hide($(this.getAddContainerId()));
		}

		if (this.getListContainer())
		{
			Element.show(this.getListContainer());
		}
	},

	cancelAdd: function(noHide)
	{
		container = $(this.getAddContainerId());

		if (!noHide)
		{
			Element.hide(container);
			Element.show(this.getListContainer());
		}

		ActiveForm.prototype.destroyTinyMceFields(container);
		this.formTabCopy = container.down('form');
	},

	resetAddForm: function(form)
	{
		ActiveForm.prototype.resetTinyMceFields(form);
	},

	initAddForm: function()
	{
		container = $(this.getAddContainerId());

		Element.hide(this.getListContainer());
		Element.show(container);

		if (window.tinyMCE)
		{
			tinyMCE.idCounter = 0;
		}

		ActiveForm.prototype.initTinyMceFields(container);

		this.reInitAddForm(container);

		ActiveForm.prototype.resetErrorMessages(container.down('form'));

		var cancel = container.down('a.cancel');
		if (cancel)
		{
			Event.observe(cancel, 'click', function(e) { this.cancelAdd(); Event.stop(e); }.bind(this));
		}
	},

	saveAdd: function(e)
	{
		Event.stop(e);
		var instance = this.getAddInstance();
		instance.submitForm();
		return instance;
	},

	reInitAddForm: function(container)
	{
	}
}

var TabCustomize = Class.create();
TabCustomize.prototype =
{
	tabList: null,

	moreTabs: null,

	moreTabsMenu: null,

	saveUrl: null,

	initialize: function(tabList)
	{
		this.tabList = tabList;

		if (!(this.tabList instanceof HTMLUListElement))
		{
			this.tabList = this.tabList.down('ul');
		}

		this.moreTabs = tabList.parentNode.down('.moreTabs');

		if (this.moreTabs)
		{
			this.moreTabsMenu = this.moreTabs.down('.moreTabsMenu');
			Event.observe(this.moreTabs, 'click', this.toggleMenu.bindAsEventListener(this));

			// set background for moreTabs
			var el = this.moreTabs.parentNode;
			while (el && el.getStyle('background-color') == 'transparent')
			{
				el = el.parentNode;
			}

			if (el)
			{
				this.moreTabs.style.backgroundColor = el.getStyle('background-color');
			}
		}

		this.setPrefsSaveUrl(Backend.Router.createUrl('backend.index', 'setUserPreference'));
	},

	setPrefsSaveUrl: function(url)
	{
		this.saveUrl = url;
	},

	toggleMenu: function(e)
	{
		Event.stop(e);

		this.moreTabsMenu.innerHTML = '';
		var cloned = this.tabList.cloneNode(true);
		this.moreTabsMenu.appendChild(cloned);
		cloned.removeClassName('languageFormTabs');

		$A(cloned.getElementsBySelector('li.hidden')).reverse().each(function(el)
		{
			el.parentNode.insertBefore(el, el.parentNode.firstChild);
		});

		$A(cloned.getElementsBySelector('li')).each(function(el)
		{
			var anchor = el.down('a');
			if (anchor)
			{
				anchor.parentNode.replaceChild(document.createTextNode(anchor.firstChild.data), anchor);
			}

			el.id = 'toggle_' + el.id;
			Event.observe(el, 'click', this.toggleVisibility.bindAsEventListener(this));

			if (el.hasClassName('languageFormCaption'))
			{
				el.parentNode.removeChild(el);
			}
		}.bind(this));

		this.moreTabsMenu.show();

		Event.observe(document, 'click', this.hideMenu.bindAsEventListener(this), true);
	},

	toggleVisibility: function(e)
	{
		Event.stop(e);

		var li = Event.element(e);
		if ('LI' != li.tagName)
		{
			li = li.up('li');
		}

		var id = li.id.substr(7);

		var tab = this.tabList.down('#' + id);

		if (li.hasClassName('hidden'))
		{
			this.setVisible(tab, e);
		}
		else
		{
			this.setHidden(tab);
		}

		this.setPreference(tab);
		this.hideMenu();
	},

	setVisible: function(tab, e)
	{
		tab.removeClassName('hidden');
		tab.onclick(tab);
	},

	setHidden: function(tab)
	{
		tab.addClassName('hidden');
	},

	hideMenu: function()
	{
		this.moreTabsMenu.hide();
		this.moreTabsMenu.innerHTML = '';

		Event.stopObserving(document, 'click', this.hideMenu.bindAsEventListener(this), true);
	},

	setPreference: function(li)
	{
		var id = li.id.split(/__/).pop();

		var url = Backend.Router.setUrlQueryParam(this.saveUrl, 'key', 'tab_' + id);
		var url = Backend.Router.setUrlQueryParam(url, 'value', !li.hasClassName('hidden'));
		new LiveCart.AjaxRequest(url);
	}
}

/************* Tooltips **************/

var tooltip=function(){
 var id = 'tt';
 var top = 3;
 var left = 3;
 var maxw = 350;
 var speed = 10;
 var timer = 20;
 var endalpha = 95;
 var alpha = 0;
 var tt,t,c,b,h;
 var ie = document.all ? true : false;
 return{
  show:function(v,w){
   if(tt == null){
    tt = document.createElement('div');
    tt.setAttribute('id',id);
    t = document.createElement('div');
    t.setAttribute('id',id + 'top');
    c = document.createElement('div');
    c.setAttribute('id',id + 'cont');
    b = document.createElement('div');
    b.setAttribute('id',id + 'bot');
    tt.appendChild(t);
    tt.appendChild(c);
    tt.appendChild(b);
    document.body.appendChild(tt);
    tt.style.opacity = 0;
    tt.style.filter = 'alpha(opacity=0)';
    document.onmousemove = this.pos;
   }
   tt.style.display = 'block';
   c.innerHTML = v;
   tt.style.width = w ? w + 'px' : 'auto';
   if(!w && ie){
    t.style.display = 'none';
    b.style.display = 'none';
    tt.style.width = tt.offsetWidth;
    t.style.display = 'block';
    b.style.display = 'block';
   }
  if(tt.offsetWidth > maxw){tt.style.width = maxw + 'px'}
  h = parseInt(tt.offsetHeight) + top;
  clearInterval(tt.timer);
  tt.timer = setInterval(function(){tooltip.fade(1)},timer);
  },
  pos:function(e){
   var u = ie ? event.clientY + document.documentElement.scrollTop : e.pageY;
   var l = ie ? event.clientX + document.documentElement.scrollLeft : e.pageX;
   var y = u - h;
   var x = l + left;

   if (y < 0)
   {
	   y = 0;
   }

   if (x < 0)
   {
	   x = 0;
   }

   tt.style.top = y + 'px';
   tt.style.left = x + 'px';
  },
  fade:function(d){
   var a = alpha;
   if((a != endalpha && d == 1) || (a != 0 && d == -1)){
    var i = speed;
   if(endalpha - a < speed && d == 1){
    i = endalpha - a;
   }else if(alpha < speed && d == -1){
     i = a;
   }
   alpha = a + (i * d);
   tt.style.opacity = alpha * .01;
   tt.style.filter = 'alpha(opacity=' + alpha + ')';
  }else{
    clearInterval(tt.timer);
     if(d == -1){tt.style.display = 'none'}
  }
 },
 hide:function(){
  clearInterval(tt.timer);
   tt.timer = setInterval(function(){tooltip.fade(-1)},timer);
  }
 };
}();



/***************************************************
 * library/KeyboardEvent.js
 ***************************************************/

/**
 * KeyboardEvent's task is to provide cross-browser suport for handling keyboard
 * events. It provides function to get current button code and char, shift status, etc
 *
 * @todo Caps lock support
 *
 * @author   Integry Systems
 *
 */
var KeyboardEvent = Class.create();
KeyboardEvent.prototype = {
	/**
	 * Tab key
	 *
	 * @var int
	 */
	KEY_TAB:	9,

	/**
	 * Enter key
	 *
	 * @var int
	 */
	KEY_ENTER:  13,

	/**
	 * Shift key
	 *
	 * @var int
	 */
	KEY_SHIFT:  16,

	/**
	 * Escape key
	 *
	 * @var int
	 */
	KEY_ESC:	27,

	/**
	 * Up key
	 *
	 * @var int
	 */
	KEY_UP:	 38,

	/**
	 * Down key
	 *
	 * @var int
	 */
	KEY_DOWN:   40,

	/**
	 * Left key
	 *
	 * @var int
	 */
	KEY_LEFT:	 37,

	/**
	 * Right key
	 *
	 * @var int
	 */
	KEY_RIGHT:   39,

	/**
	 * Delete key
	 *
	 * @var int
	 */
	KEY_DEL:	46,

	/**
	 * Constructor
	 *
	 * @param WindowEvent e Event object (for explorer it will be auto-detected. If you decide to pass it anyway then passed event will be used)
	 *
	 * @access public
	 */
	initialize: function(e)
	{
		if (!e && window.event)
		{
			e = window.event; // IE
			e.target = e.srcElement;
		}

		this.event = e;
	},
	
	init: function(e)
	{
		return new KeyboardEvent(e);
	},

	/**
	 * Determines which key (number) was pressed
	 *
	 * @access public
	 *
	 * @return int Key number
	 */
	getKey: function()
	{
		return this.event.which ? this.event.which : ( this.event.keyCode ? this.event.keyCode : ( this.event.charCode ? this.event.charCode : 0 ) );
	},


	/**
	 * Determines which char was pressed. It will also check if shift button
	 * was hold and return upercase if it was. So far no support for caps lock
	 *
	 * @access public
	 *
	 * @todo Caps lock support
	 *
	 * @return int Key number
	 */
	getChar: function()
	{
		var string = String.fromCharCode(this.getKey());

		if(!this.isShift()) string = string.toLowerCase();

		return string;
	},

	/**
	 * Check if shift was pressed while inputing the letter
	 *
	 * @access public
	 *
	 * @return bool
	 */
	isShift: function()
	{
		return this.event.shiftKey || ( this.event.modifiers && ( this.event.modifiers & 4 ) );;
	},

	isPrintable: function()
	{
		var key = this.getKey();

		// [A-Za-z0-9]
		return (key > 64 && key < 91) || (key > 96 && key < 123) || (key > 47 && key < 58);
	},

	/**
	 * Deselects any window text (except in controls)
	 *
	 * @access public
	 */
	deselectText: function()
	{
		if (document.selection)
		{
			document.selection.empty();
		}
		else if (window.getSelection)
		{
			window.getSelection().removeAllRanges();
		}
	},

	/**
	 * Get cursor position in the text
	 *
	 * @access public
	 */
	getCursorPosition: function()
	{
		if(document.selection)
		{
			return document.selection;
		}
		else if(this.event.target.selectionStart)
		{
			return this.event.target.selectionStart;
		}
		else
		{
			return false;
		}
	},
	
	isEnter: function()
	{
		return this.getKey() == this.KEY_ENTER;
	}
}




/***************************************************
 * library/ActiveGrid.js
 ***************************************************/

/**
 *	@author Integry Systems
 */

/**
 *	Requires rico.js
 *
 */

ActiveGrid = Class.create();

ActiveGrid.prototype =
{
	/**
	 *	Data table element instance
	 */
	tableInstance: null,

	/**
	 *	Select All checkbox instance
	 */
	selectAllInstance: null,

	/**
	 *	Data feed URL
	 */
  	dataUrl: null,

	/**
	 *	Rico LiveGrid instance
	 */
	ricoGrid: null,

	/**
	 *	Array containing IDs of selected rows
	 */
	selectedRows: {},

	/**
	 *	Set to true when Select All is used (so all records are selected by default)
	 */
	inverseSelection: false,

	/**
	 *	Object that handles data transformation for presentation
	 */
	dataFormatter: null,

	filters: {},

	loadIndicator: null,

	rowCount: 15,

	quickEditUrlTemplate: null,

	quickEditIdToken : null,

	quickEditContainerState: "hidden",

	activeGridInstanceID : null,

	initialize: function(tableInstance, dataUrl, totalCount, loadIndicator, rowCount, filters)
	{
		this.tableInstance = tableInstance;
		this.activeGridInstanceID=this.tableInstance.id;
		this.tableInstance.gridInstance = this;
		this.dataUrl = dataUrl;
		this.setLoadIndicator(loadIndicator);
		this.filters = {};
		this.selectedRows = {};

		if (!rowCount)
		{
			rowCount = this.rowCount;
		}

		if (filters)
		{
			this.filters = filters;
		}

		this.ricoGrid = new Rico.LiveGrid(this.tableInstance.id, rowCount, totalCount, dataUrl,
								{
								  prefetchBuffer: true,
								  onscroll: this.onScroll.bind(this),
								  sortAscendImg: $("bullet_arrow_up").src,
								  sortDescendImg: $("bullet_arrow_down").src
								}
							);

		this.ricoGrid.activeGrid = this;

		var headerRow = this._getHeaderRow();
		this.selectAllInstance = headerRow.down('input');
		this.selectAllInstance.onclick = this.selectAll.bindAsEventListener(this);
		this.selectAllInstance.parentNode.onclick = function(e){Event.stop(e);}.bindAsEventListener(this);

		this.ricoGrid.onUpdate = this.onUpdate.bind(this);
		this.ricoGrid.onBeginDataFetch = this.showFetchIndicator.bind(this);
		this.ricoGrid.options.onRefreshComplete = this.hideFetchIndicator.bind(this);

		this.onScroll(this.ricoGrid, 0);

		this.setRequestParameters();
		this.ricoGrid.init();

		var rows = this.tableInstance.down('tbody').getElementsByTagName('tr');
		for (k = 0; k < rows.length; k++)
		{
			Event.observe(rows[k], 'click', this.selectRow.bindAsEventListener(this));

			var cells = rows[k].getElementsByTagName('td');
			for (i = 0; i < cells.length; i++)
			{
				Event.observe(cells[i], 'mouseover', this.highlightRow.bindAsEventListener(this));
			}

			Event.observe(rows[k], 'mouseout', this.removeRowHighlight.bindAsEventListener(this));
		}
	},

	initAdvancedSearch: function(id, availableColumns, advancedSearchColumns, properties)
	{
		this.advancedSearchHandler = new ActiveGridAdvancedSearch(id);
		this.advancedSearchHandler.createAvailableColumnConditions(advancedSearchColumns);
		this.advancedSearchHandler.createAvailableColumnConditions(availableColumns, properties);
		this.advancedSearchHandler.findNodes();
		this.advancedSearchHandler.bindEvents();
	},

	getAdvancedSearchHandler: function()
	{
		return this.advancedSearchHandler;
	},

	initQuickEdit: function(urlTemplate, idToken)
	{
		this.quickEditUrlTemplate = urlTemplate;
		this.quickEditIdToken = idToken;

		$A(this.tableInstance.down('tbody').getElementsByTagName('tr')).each(function(row)
		{
			Event.observe(row, 'mouseover',
				function(e)
				{
					window.lastQuickEditNode = Event.element(e);
					window.setTimeout(function() { this.quickEdit(e); }.bind(this), 200);
				}.bindAsEventListener(this) );
		}.bind(this));

		Event.observe(this.tableInstance.down('tbody'), 'mouseout', function() { window.lastQuickEditNode = null; } );
		Event.observe(document.body, 'mouseover', this.quickEditMouseover.bindAsEventListener(this) );
		Event.observe(this._getQuickEditContainer(), 'click', this.quickEditContainerClicked.bindAsEventListener(this) );
	},

	quickEdit: function(event)
	{
		var
			node = Event.element(event),
			recordID = null,
			m;

		if (window.lastQuickEditNode != node)
		{
			return;
		}

		if (this.activeRow)
		{
			this.activeRow.removeClassName('activeGrid_highlightQuickEdit');
		}

		if (node.tagName.toLowerCase != "tr")
		{
			node = node.up("tr");
		}

		do {
			input = node.down("input");
			if (input && input.name)
			{
				m = node.down("input").name.match(/item\[(\d+)\]/);
			}
			else
			{
				m = [];
			}
			if (m && m.length == 2)
			{
				recordID = m[1];
			}
			else
			{
				node=$(node.up("tr"));
			}
		} while(recordID == null && node);

		if (recordID == null)
		{
			return;
		}

		this.node = node;

		new LiveCart.AjaxRequest(
			this.quickEditUrlTemplate.replace(this.quickEditIdToken, recordID),
			null,
			function(transport)
			{
				var container = this._getQuickEditContainer();
				if(container)
				{
					container.innerHTML = transport.responseText;
					var pos = Position.cumulativeOffset(this.node);

					// translate from grid upper/left corner to page upper/left corner
					var offset = Position.cumulativeOffset(this.node.up(".activeGridContainer"));
					offset[0] *= -1;
					offset[1] *= -1;
					pos = [pos[0] + offset[0], pos[1] + offset[1]];
					container.style.left=(pos[0])+"px";
					container.style.top=(pos[1])+"px";
					container.show();
					node.addClassName('activeGrid_highlightQuickEdit');
					this.activeRow = node;

					if (this.quickEditContainerState == "hidden") // ignore "changed" state!
					{
						this.quickEditContainerState = "shown";
					}
				}

			}.bind(this)
		);
	},

	quickEditMouseover: function(event)
	{
		if (this.quickEditContainerState != "shown")
		{
			return;
		}
		element = Event.element(event);
		if(element.up(".activeGridContainer") == null)
		{
			this.hideQuickEditContainer();
		}
	},

	quickEditContainerClicked: function(event)
	{
		// any click (except on cancel link) in quick edit container set container to clicked state
		if (Event.element(event).hasClassName("cancel") == false)
		{
			this.quickEditContainerState = "clicked";
		}
		else
		{
			this.quickEditContainerState = "shown";
		}
	},

	hideQuickEditContainer : function()
	{
		var container = this._getQuickEditContainer();
		if (!container)
		{
			return;
		}

		if (this.activeRow)
		{
			this.activeRow.removeClassName('activeGrid_highlightQuickEdit');
		}

		container.innerHTML = "";
		container.hide();

		this.containerState = "hidden";
	},

	updateQuickEditGrid: function(jsonData)
	{
		var
			buffer = this.ricoGrid.buffer,
			i,
			rows,
			row,
			done = false;

		rows = this.getRows(jsonData);
		row = rows.data[0];

		for(i=0; i<buffer.rows.length; i++)
		{
			if(row.ID == buffer.rows[i].id)
			{
				buffer.rows[i] = row;
				break;
			}
		}
		for(page in buffer.rowCache)
		{
			if(done)
			{
				break;
			}
			for(rowNr in buffer.rowCache[page])
			{
				if("id" in buffer.rowCache[page][rowNr] == false)
				{
					continue;
				}
				if(done)
				{
					break;
				}

				if(buffer.rowCache[page][rowNr].id == row.id)
				{
					buffer.rowCache[page][rowNr] = row;
					done=true;
				}
			}
		}

		// redraw grid
		this.ricoGrid.viewPort.bufferChanged();
		this.ricoGrid.viewPort.refreshContents(this.ricoGrid.viewPort.lastRowPos);

		$A(document.getElementsByName("item["+row.id+"]")).each(function(input) {
			new Effect.Highlight($(input).up("tr"));
		});
	},

	_getQuickEditContainer: function()
	{
		var parent = $(this.tableInstance), node=null, i=0;

		while (i<25 && parent && parent.hasClassName("activeGridContainer") == false)
		{
			i++;
			parent = $(parent.up("div"));
		}
		if (parent)
		{
			node = parent.getElementsByClassName("quickEditContainer");
		}

		if(node == null || node.length!=1)
		{
			return null;
		}
		return $(node[0]);
	},

	setInitialData: function(data)
	{
		if (data)
		{
			this.ricoGrid.buffer.update(data, 0);
			this.ricoGrid.viewPort.bufferChanged();
			this.ricoGrid.viewPort.refreshContents(0);
		}
		else
		{
			this.ricoGrid.requestContentRefresh(0);
		}
	},

	getRows: function(data)
	{
		var HTML = '';
		var rowHTML = '';

		var data = eval('(' + data + ')');

		for(k = 0; k < data['data'].length; k++)
		{
			var id = data['data'][k][0];

			data['data'][k][0] = '<input type="checkbox" class="checkbox" name="item[' + id + ']" />';
			data['data'][k].id = id;

			if (this.dataFormatter)
			{
				for(i = 1; i < data['data'][k].length; i++)
				{
					if(i > 0)
					{
						data['data'][k][i] = stripHtml(data['data'][k][i]);
					}

					var filter = this.filters['filter_' + data['columns'][i]];
					if (filter && data['data'][k][i].replace)
					{
						data['data'][k][i] = data['data'][k][i].replace(new RegExp('(' + filter + ')', 'gi'), '<span class="activeGrid_searchHighlight">$1</span>');
					}

					var value = this.dataFormatter.formatValue(data['columns'][i], data['data'][k][i], id) || '';
					data['data'][k][i] = '<span>' + value + '</span>';
				}
			}
		}

		return data;
	},

	setDataFormatter: function(dataFormatterInstance)
	{
		this.dataFormatter = dataFormatterInstance;
	},

	setLoadIndicator: function(indicatorElement)
	{
		this.loadIndicator = $(indicatorElement);
	},

	onScroll: function(liveGrid, offset)
	{
		this.ricoGrid.onBeginDataFetch = this.showFetchIndicator.bind(this);

		this.updateHeader(offset);

		this._markSelectedRows();
	},

	updateHeader: function (offset)
	{
		var liveGrid = this.ricoGrid;

		var totalCount = liveGrid.metaData.getTotalRows();
		var from = offset + 1;
		var to = offset + liveGrid.metaData.getPageSize();

		if (to > totalCount)
		{
			to = totalCount;
		}

		if (!this.countElement)
		{
			this.countElement = this.loadIndicator.parentNode.up('div').down('.rangeCount');
			this.notFound = this.loadIndicator.parentNode.up('div').down('.notFound');
		}

		if (!this.countElement)
		{
			return false;
		}

		if (totalCount > 0)
		{
			if (!this.countElement.strTemplate)
			{
				this.countElement.strTemplate = this.countElement.innerHTML;
			}

			var str = this.countElement.strTemplate;
			str = str.replace(/\$from/, from);
			str = str.replace(/\$to/, to);
			str = str.replace(/\$count/, totalCount);

			this.countElement.innerHTML = str;
			this.notFound.style.display = 'none';
			this.countElement.style.display = '';
		}
		else
		{
			this.notFound.style.display = '';
			this.countElement.style.display = 'none';
		}
	},

	onUpdate: function()
	{
		this._markSelectedRows();
	},

	setRequestParameters: function()
	{
		this.ricoGrid.options.requestParameters = [];
		var i = 0;

		for (k in this.filters)
		{
			if (k.substr(0, 7) == 'filter_')
			{
				this.ricoGrid.options.requestParameters[i++] = 'filters[' + k.substr(7, 1000) + ']' + '=' + encodeURIComponent(this.filters[k]);
			}
		}
	},

	reloadGrid: function()
	{
		this.setRequestParameters();
		this.ricoGrid.buffer.clear();
		this.ricoGrid.resetContents();
		this.ricoGrid.requestContentRefresh(0, true);
		this.ricoGrid.fetchBuffer(0, false, true);

		this._markSelectedRows();
	},

	getFilters: function()
	{
		var res = {};

		for (k in this.filters)
		{
			if (k.substr(0, 7) == 'filter_')
			{
				res[k.substr(7, 1000)] = this.filters[k];
			}
		}

		return res;
	},

	getSelectedIDs: function()
	{
		var selected = [];

		for (k in this.selectedRows)
		{
			if (true == this.selectedRows[k])
			{
				selected[selected.length] = k;
			}
		}

		return selected;
	},

	isInverseSelection: function()
	{
		return this.inverseSelection;
	},

	/**
	 *	Select all rows
	 */
	selectAll: function(e)
	{
		this.selectedRows = new Object;
		this.inverseSelection = this.selectAllInstance.checked;
		this._markSelectedRows();

		e.stopPropagation();
	},

	/**
	 *	Mark rows checkbox when a row is clicked
	 */
	selectRow: function(e)
	{
		var row = this._getTargetRow(e);

		id = this._getRecordId(row);

		if (!this.selectedRows[id])
		{
			this.selectedRows[id] = 0;
		}

		this.selectedRows[id] = !this.selectedRows[id];

		this._selectRow(row);
	},

	/**
	 *	Highlight a row when moving a mouse over it
	 */
	highlightRow: function(event)
	{
		var cell = this._getTargetCell(event);
		var row = cell ? cell.parentNode : this._getTargetRow(event);
		Element.addClassName(row, 'activeGrid_highlight');

		if (cell)
		{
			var value = cell.down('span');
			if (value && value.offsetWidth > cell.offsetWidth)
			{
				if (!this.cellContentContainer)
				{
					var cont = cell.up('.activeGridContainer');
					this.cellContentContainer = cont.down('.activeGridCellContent');
				}

				var xPos = Event.pointerX(event) - 50 - window.scrollX;
				var yPos = Event.pointerY(event) + 25 - window.scrollY;
				this.cellContentContainer.innerHTML = value.innerHTML;

				// remove progress indicator
				var pI = this.cellContentContainer.down('.progressIndicator');
				if (pI)
				{
					pI.parentNode.removeChild(pI);
				}

				this.cellContentContainer.style.visibility = 'none';
				this.cellContentContainer.style.display = 'block';

				PopupMenuHandler.prototype.getByElement(this.cellContentContainer, xPos, yPos);

				this.cellContentContainer.style.visibility = 'visible';
			}
		}
	},

	/**
	 *	Remove row highlighting when mouse is moved out of the row
	 */
	removeRowHighlight: function(event)
	{
		if (this.cellContentContainer)
		{
			// hide() not used intentionally
			this.cellContentContainer.style.display = 'none';
		}

		Element.removeClassName(this._getTargetRow(event), 'activeGrid_highlight');
	},

	setFilterValue: function(key, value)
	{
		this.filters[key] = value;
	},

	getFilterValue: function(key)
	{
		return this.filters[key];
	},

	showFetchIndicator: function()
	{
		this.loadIndicator.style.display = '';
		this.loadIndicator.parentNode.up('div').down('.notFound').hide();
	},

	hideFetchIndicator: function()
	{
		this.loadIndicator.style.display = 'none';
	},

	resetSelection: function()
	{
		this.selectedRows = new Object;
		this.inverseSelection = false;
	},

	_markSelectedRows: function()
	{
		var rows = this.tableInstance.getElementsByTagName('tr');
		for (k = 0; k < rows.length; k++)
		{
			this._selectRow(rows[k]);
		}
	},

	_selectRow: function(rowInstance)
	{
		var id = this._getRecordId(rowInstance);

		if (!rowInstance.checkBox)
		{
			rowInstance.checkBox = rowInstance.down('input');
		}

		if (rowInstance.checkBox)
		{
			var checked = this.selectedRows[id];
			if (this.inverseSelection)
			{
				checked = !checked;
			}

			rowInstance.checkBox.checked = checked;

			if (checked)
			{
				rowInstance.addClassName('selected');
			}
			else
			{
				rowInstance.removeClassName('selected');
			}
		}
	},

	_getRecordId: function(rowInstance)
	{
		return rowInstance.recordId;
	},

	/**
	 *	Return event target row element
	 */
	_getTargetRow: function(event)
	{
		return Event.element(event).up('tr');
	},

	/**
	 *	Return event target cell element
	 */
	_getTargetCell: function(event)
	{
		return Event.element(event).up('td');
	},

	_getHeaderRow: function()
	{
		return this.tableInstance.down('tr');
	}
}

ActiveGridFilter = Class.create();

ActiveGridFilter.prototype =
{
	element: null,

	activeGridInstance: null,

	focusValue: null,

	initialize: function(element, activeGridInstance)
	{
		this.element = element;
		this.activeGridInstance = activeGridInstance;
		this.element.onclick = Event.stop.bindAsEventListener(this);
		this.element.onfocus = this.filterFocus.bindAsEventListener(this);
		this.element.onblur = this.filterBlur.bindAsEventListener(this);
		// this.element.onchange = this.setFilterValue.bindAsEventListener(this);
		this.element.onchange = this.filterOnChange.bindAsEventListener(this);
		this.element.onkeyup = this.checkExit.bindAsEventListener(this);

		this.element.filter = this;

   		Element.addClassName(this.element, 'activeGrid_filter_blur');

		this.element.columnName = this.element.value;
	},

	filterOnChange: function(e)
	{
		var
			element = Event.element(e),
			th = element.up("th"),
			drd = th.down(".dateRange")
		if (th.hasClassName("cellt_date"))
		{
			if("daterange" == element.value.substr(0, 9) && element.tagName.toLowerCase() == "select")
			{
				drd.show();
				return;
			}
			else
			{
				drd.hide();
			}

		}
		this.setFilterValue();
	},

	filterFocus: function(e)
	{
		if (this.element.value == this.element.columnName)
		{
			this.element.value = '';
		}

		this.focusValue = this.element.value;

  		Element.removeClassName(this.element, 'activeGrid_filter_blur');
		Element.addClassName(this.element, 'activeGrid_filter_select');

		Element.addClassName(this.element.up('th'), 'activeGrid_filter_select');

		Event.stop(e);
	},

	filterBlur: function()
	{
		if ('' == this.element.value.replace(/ /g, ''))
		{
			// only update filter value if it actually has changed
			if ('' != this.focusValue)
			{
				this.setFilterValue();
			}

			this.element.value = this.element.columnName;
		}

		if (this.element.value == this.element.columnName)
		{
			Element.addClassName(this.element, 'activeGrid_filter_blur');
			Element.removeClassName(this.element, 'activeGrid_filter_select');
			Element.removeClassName(this.element.up('th'), 'activeGrid_filter_select');
		}
	},

	/**
	 *  Clear filter value on ESC key
	 */
	checkExit: function(e)
	{
		if (27 == e.keyCode || (13 == e.keyCode && !this.element.value))
		{
			this.element.value = '';

			if (this.activeGridInstance.getFilterValue(this.getFilterName()))
			{
				this.setFilterValue();
				this.filterBlur();
			}

			this.element.blur();
		}

		else if (13 == e.keyCode)
		{
			this.filterBlur();
			this.setFilterValue();
		}
	},

	setFilterValue: function()
	{
		this.setFilterValueManualy(this.getFilterName(), this.element.value);
	},

	setFilterValueManualy: function(filterName, value)
	{
		this.activeGridInstance.setFilterValue(filterName, value);
		this.activeGridInstance.reloadGrid();
	},

	getFilterName: function()
	{
		return this.element.id.substr(0, this.element.id.indexOf('_', 7));
	},

	initFilter: function(e)
	{
		Event.stop(e);

		var element = Event.element(e);
		if ('LI' != element.tagName && element.up('li'))
		{
			element = element.up('li');
		}

		this.filterFocus(e);

		if (element.attributes.getNamedItem('symbol'))
		{
			this.element.value = element.attributes.getNamedItem('symbol').nodeValue;
		}

		// range fields
		var cont = element.up('th');
		var min = cont.down('.min');
		var max = cont.down('.max');

		// show/hide input fields
		if ('><' == this.element.value)
		{
			Element.hide(this.element);
			Element.show(this.element.next('div.rangeFilter'));
			min.focus();
		}
		else
		{
			Element.show(this.element);
			Element.hide(this.element.next('div.rangeFilter'));

			min.value = '';
			max.value = '';
			this.element.focus();

			if ('' == this.element.value)
			{
				this.element.blur();
				this.setFilterValue();
			}
		}

		// hide menu
		if (element.up('div.filterMenu'))
		{
			Element.hide(element.up('div.filterMenu'));
			window.setTimeout(function() { Element.show(this.up('div.filterMenu')); }.bind(element), 200);
		}
	},

	updateDateRangeFilter: function(element) // calendar does not generate event, therefore passing node
	{
		var
			element = $(element).up("div.dateRange"),
			// format: "daterange [<datefrom>] | [<dateto>]"
			queryValue = ["daterange", $(element.down(".min").id+"_real").value , "|", $(element.down(".max").id+"_real").value].join(" ").replace(/\s{2,}/, " "),
			select = element.up("th").down("select");

		// find option with value daterange.*, and set its value to queryValue
		$A(select.getElementsByTagName("option")).find(
			function(element)
			{
				return element.value.substr(0,9) == "daterange";
			}
		).value = queryValue;

		select.filter.setFilterValue();
	},

	updateRangeFilter: function(e)
	{
		var cont = Event.element(e).up('div.rangeFilter');
		var min = cont.down('.min');
		var max = cont.down('.max');

		if ((parseInt(min.value) > parseInt(max.value)) && max.value.length > 0)
		{
			var temp = min.value;
			min.value = max.value;
			max.value = temp;
		}

		this.element.value = (min.value.length > 0 ? '>=' + min.value + ' ' : '') + (max.value.length > 0 ? '<=' + max.value : '');

		this.element.filter.setFilterValue();

		if ('' == this.element.value)
		{
			this.initFilter(e);
		}
	}
}

ActiveGrid.MassActionHandler = Class.create();
ActiveGrid.MassActionHandler.prototype =
{
	handlerMenu: null,
	actionSelector: null,
	valueEntryContainer: null,
	form: null,
	button: null,
	cancelLink: null,
	cancelUrl: '',

	grid: null,
	pid: null,

	initialize: function(handlerMenu, activeGrid, params)
	{
		this.handlerMenu = handlerMenu;
		this.actionSelector = handlerMenu.down('select');
		this.valueEntryContainer = handlerMenu.down('.bulkValues');
		this.form = this.actionSelector.form;
		this.form.handler = this;
		this.button = this.form.down('.submit');

		Event.observe(this.actionSelector, 'change', this.actionSelectorChange.bind(this));
		Event.observe(this.actionSelector.form, 'submit', this.submit.bindAsEventListener(this));

		this.grid = activeGrid;
		this.params = params;
		this.paramz = params;
	},

	actionSelectorChange: function()
	{
		if (!this.valueEntryContainer)
		{
			return false;
		}

		for (k = 0; k < this.valueEntryContainer.childNodes.length; k++)
		{
			if (this.valueEntryContainer.childNodes[k].style)
			{
				Element.hide(this.valueEntryContainer.childNodes[k]);
			}
		}

		Element.show(this.valueEntryContainer);

		if (this.actionSelector.form.elements.namedItem(this.actionSelector.value))
		{
			var el = this.form.elements.namedItem(this.actionSelector.value);
			if (el)
			{
				Element.show(el);
				this.form.elements.namedItem(this.actionSelector.value).focus();
			}
		}
		else if (document.getElementsByClassName(this.actionSelector.value, this.handlerMenu))
		{
			var el = document.getElementsByClassName(this.actionSelector.value, this.handlerMenu)[0];
			if (el)
			{
				Element.show(el);
			}
		}
	},

	submit: function(e)
	{
		if (e)
		{
			Event.stop(e);
		}

		if ('delete' == this.actionSelector.value)
		{
			if (!confirm(this.deleteConfirmMessage))
			{
				return false;
			}
		}
		var filters = this.grid.getFilters();
		this.form.elements.namedItem('filters').value = filters ? Object.toJSON(filters) : '';
		this.form.elements.namedItem('selectedIDs').value = Object.toJSON(this.grid.getSelectedIDs());
		this.form.elements.namedItem('isInverse').value = this.grid.isInverseSelection() ? 1 : 0;

		if ((0 == this.grid.getSelectedIDs().length) && !this.grid.isInverseSelection())
		{
			this.blurButton();
			alert(this.nothingSelectedMessage);
			return false;
		}

		var indicator = this.handlerMenu.down('.massIndicator');
		if (!indicator)
		{
			indicator = this.handlerMenu.down('.progressIndicator');
		}

		this.formerLength = 0;

		if ('blank' == this.actionSelector.options[this.actionSelector.selectedIndex].getAttribute('rel'))
		{
			this.form.target = '_blank';
			this.form.submit();
			return;
		}

		this.request = new LiveCart.AjaxRequest(this.form, indicator , this.dataResponse.bind(this),  {onInteractive: function(func, arg) {window.setTimeout(func.bind(this, arg), 1000); }.bind(this, this.dataResponse.bind(this)) });

		this.progressBarContainer = this.handlerMenu.up('div').down('.activeGrid_massActionProgress');
		this.cancelLink = this.progressBarContainer.down('a.cancel');
		this.cancelUrl = this.cancelLink.href;
		this.cancelLink.onclick = this.cancel.bind(this);

		this.progressBarContainer.show();
		this.progressBar = new Backend.ProgressBar(this.progressBarContainer);

		this.grid.resetSelection();
	},

	dataResponse: function(originalRequest)
	{
		var response = originalRequest.responseText.substr(this.formerLength + 1);
		this.formerLength = originalRequest.responseText.length;
		var portions = response.split('|');

		for (var k = 0; k < portions.length; k++)
		{
			if (!portions[k])
			{
				continue;
			}
			if ('}' == portions[k].substr(-1))
			{
				if ('{' != portions[k].substr(0, 1))
				{
					portions[k] = '{' + portions[k];
				}

				this.submitCompleted(eval('(' + portions[k] + ')'));

				return;
			}

			response = eval('(' + decode64(portions[k]) + ')');

			// progress
			if (response.progress != undefined)
			{
				this.progressBar.update(response.progress, response.total);
				this.pid = response.pid;
			}
		}
	},

	cancel: function(e)
	{
		this.request.request.transport.abort();
		new LiveCart.AjaxRequest(Backend.Router.setUrlQueryParam(this.cancelUrl, 'pid', this.pid), null, this.completeCancel.bind(this));
		Event.stop(e);
	},

	completeCancel: function(originalRequest)
	{
		var resp = originalRequest.responseData;

		if (resp.isCancelled)
		{
			var progress = this.progressBar.getProgress();
			this.cancelLink.hide();
			this.progressBar.rewind(progress, this.progressBar.getTotal(), Math.round(progress/50), this.submitCompleted.bind(this));
		}
	},

	submitCompleted: function(responseData)
	{
		if (responseData)
		{
			this.request.showConfirmation(responseData);
		}

		this.progressBarContainer.hide();
		this.cancelLink.show();

		this.grid.reloadGrid();
		this.blurButton();

		if (this.params && this.params.onComplete)
		{
			this.params.onComplete();
		}

		if (this.customComplete)
		{
			this.customComplete();
		}
	},

	blurButton: function()
	{
		this.button.disable();
		this.button.enable();
	}
}

ActiveGrid.QuickEdit =
{
	onSubmit: function(obj)
	{
		var form;
		form = $(obj).up("form");
		if(validateForm(form))
		{
			new LiveCart.AjaxRequest(form, null, function(transport) {
				var response = eval( "("+transport.responseText + ")");
				if(response.status == "success")
				{
					this.instance._getGridInstaceFromControl(this.obj).updateQuickEditGrid(transport.responseText);
					this.instance.onCancel(this.obj);
				}
				else
				{
					ActiveForm.prototype.setErrorMessages(this.obj.up("form"), response.errors)
				}
			}.bind({instance: this, obj:obj}));
		}
		return false;
	},

	onCancel: function(obj)
	{
		var gridInstance = this._getGridInstaceFromControl(obj);
		gridInstance.hideQuickEditContainer();
		return false;
	},

	_getGridInstaceFromControl: function(control)
	{
		try {
			// up 3 div's, then get all elements with class name activeGrid,
			// first table should be grid instance.
			// This works for current uses, some future cases may require to rewrite this function.
			return $A($(control).up("div",3).getElementsByClassName("activeGrid")).find(
				function(node)
				{
					return node.tagName.toLowerCase() == "table";
				}
			).gridInstance;

		} catch(e) {
			return null;
		}
	}
}

ActiveGridAdvancedSearch = Class.create();
ActiveGridAdvancedSearch.prototype =
{
	addCondition: function(condition)
	{
		this.conditions[condition.getId()] = condition;
	},

	initialize: function(id)
	{
		this.id = id;
		this.conditions = $H({});
		this.filterString = "";
		if(ActiveGridAdvancedSearch.prototype.initCallbacks)
		{
			$A(ActiveGridAdvancedSearch.prototype.initCallbacks).each(
				function(callback)
				{
					callback(this);
				}.bind(this)
			);
		}
	},

	createAvailableColumnConditions: function(availableColumns, properties)
	{
		var
			conditionProperties;
		this.availableColumns = $H(availableColumns);
		this.availableColumns.each(function(item)
		{
			if (item[1].type == null || item[0] == 'hiddenType')
			{
				return;
			}
			conditionProperties = {type: item[1].type};
			if(conditionProperties.type == 'date')
			{
				// date type filter values (same as in ActiveGrid)
				conditionProperties.dateFilterValues = properties.dateFilterValues;
			}
			this.addCondition
			(
				new ActiveGridAdvancedSearchCondition(item[0], item[1].name, conditionProperties)
			);
		}.bind(this));
	},

	findNodes: function()
	{
		if (typeof this.nodes == "undefined")
		{
			this.nodes = {};
		}
		this.nodes.root = $(this.id + "_AdvancedSearch");
		this.nodes.queryContainer = this.nodes.root.down(".advancedSearchQueryContainer");
		this.nodes.searchLink = this.nodes.root.down(".advancedSearchLink");

		this.nodes.queryItems = this.nodes.root.down(".advancedQueryItems");
	},

	bindEvents: function()
	{
		Event.observe(this.nodes.searchLink, "click", this.linkClicked.bindAsEventListener(this));
		Event.observe(this.nodes.queryItems, "change", this.conditionItemChanged.bindAsEventListener(this));
		Event.observe(this.nodes.queryItems, "click", this.conditionItemClick.bindAsEventListener(this))
	},

	getCondition: function(id)
	{
		return typeof this.conditions[id] == "undefined"
			? null
			: this.conditions[id];
	},

	linkClicked: function()
	{
		this.appendCondition();
	},

	appendCondition: function()
	{
		var li = this.appendConditionPlaceholder();
		this.getCondition(li.down(".condition").value).draw(li);
	},

	conditionItemChanged: function(event)
	{
		var
			element = Event.element(event),
			condition = this.getCondition( element.up("li").down(".condition").value );
		if(element.hasClassName('condition'))
		{
			condition.draw(element.up("li"));
		}
		if(element.hasClassName('comparision'))
		{
			condition.comparisionChanged(element.up("li"));
		}
		this.appendConditionIfLastFilled(element);
		this.setActiveGridFilterValues();
	},

	conditionItemClick: function(event)
	{
		var element = Event.element(event);
		if(element.hasClassName("deleteCross"))
		{
			this.removeConditionPlaceholder(element);
		}
	},

	appendConditionIfLastFilled: function(element)
	{
		var
			container = element.up('li'),
			condition = this.getCondition(container.down('.condition').value);

		if(this.lastConditionContainer == container && condition.isFilled(container))
		{
			this.appendCondition();
		}
	},

	setActiveGridFilterValues: function()
	{
		var
			gridInstance = window.activeGrids[this.id],
			containers = $A(this.nodes.queryItems.getElementsByTagName("li")).findAll(function(itemContainer, item) { return itemContainer == item.parentNode; }.bind(this, this.nodes.queryItems)), // only 'top' level child nodes.
			condition,
			key, value, comparision,
			z = [];

		gridInstance.filters = {};

		while(container = $(containers.shift()))
		{
			condition = this.getCondition(container.down(".condition").value );
			if(condition && condition.isFilled(container))
			{
				key = 'filter_' + condition.getId();
				comparision = condition.getComparision(container);
				if(comparision == '><')
				{
					comparision = '';
				}
				value = comparision + condition.getValue(container);
				gridInstance.setFilterValue(key, value);
				z.push(key+'__'+value);
			}
		}

		// if something changed in filter, reload
		value = z.join('|');
		if(value != this.filterString)
		{
			gridInstance.reloadGrid();
			this.filterString = value
		}
	},

	appendConditionPlaceholder: function()
	{
		var
			li = document.createElement("li"),
			select = document.createElement("select"),
			a = document.createElement("a");
		this.nodes.queryItems.appendChild(li);
		li.appendChild(a);
		a.addClassName("deleteCross");
		a.href="javascript:void(0);";
		li.appendChild(select);

		this.conditions.each(
			function(select, item)
			{
				var condition = item[1];
				addOption(select, condition.getId(), condition.getName());
			}.bind(this, select)
		);
		select.addClassName("condition");
		this.lastConditionContainer = $(li);

		this.nodes.root.addClassName('hasConditions');

		return this.lastConditionContainer;
	},

	removeConditionPlaceholder: function(element)
	{
		if (element.up("ul").getElementsByTagName("li").length > 1)
		{
			this.nodes.root.addClassName('hasConditions');
		}
		else
		{
			this.nodes.root.removeClassName('hasConditions');
		}

		element.up("ul").removeChild(element.up("li"));
		this.setActiveGridFilterValues();
	},

	registerInitCallback: function(callback)
	{
		if(!ActiveGridAdvancedSearch.prototype.initCallbacks)
		{
			ActiveGridAdvancedSearch.prototype.initCallbacks = [];
		}
		ActiveGridAdvancedSearch.prototype.initCallbacks.push(callback);
	}
}

ActiveGridAdvancedSearchCondition = Class.create();
ActiveGridAdvancedSearchCondition.prototype =
{
	TEXT: 'text',
	NUMERIC: 'numeric',
	BOOL: 'bool',
	DATE: 'date',

	initialize: function(id, name, properties)
	{
		this.id = id;
		this.name = name;
		this.properties = properties;
	},

	getName: function()
	{
		return this.name;
	},

	getId: function()
	{
		return this.id;
	},

	getProperty: function(key)
	{
		if(typeof this.properties == "undefined")
		{
			this.properties = $H({});
		}
		if(key == 'type' && this.properties[key] == "number") // 'number' and 'numeric' means the same.
		{
			this.properties[key] = this.NUMERIC;
		}
		return typeof this.properties[key] == "undefined"
			? arguments.length <= 2 ? arguments[1] : null
			: this.properties[key];
	},

	setType: function(type)
	{
		if(this.getProperty('type') != type) // getProperty() also initializes this.properties to hashmap, if it is broken.
		{
			if(type == 'number')
			{
				type = this.NUMERIC;
			}
			this.properties['type'] = type;
		}
	},

	draw: function(container) // This drawing is for 'field value' conditions. Replace with custom draw.
	{
		this.container = container;
		var
			comparision = container.down(".comparision"),
			value = container.down(".value"),
			value2 = container.down(".value2"),
			type;
		if (comparision /* not found */) { } else
		{
			comparision = document.createElement('select');
			container.appendChild(comparision);
			comparision = $(comparision);
			comparision.addClassName('comparision');
			value = document.createElement('input');
			container.appendChild(value);
			value = $(value);
			value.addClassName('value');
			value2 = document.createElement('input');
			container.appendChild(value2);
			value2 = $(value2);
			value2.addClassName('value2');
		}

		// change comparision dropdown for this condition
		comparision.innerHTML = '';
		comparision.show();
		value.show();
		value2.hide();
		type = this.getProperty('type');
		if (type == 'text')
		{
			addOption(comparision, '=', $T("_grid_equals"));
			comparision.hide();
			value.focus();
		}
		else if(type == 'numeric')
		{
			value.show();
			addOption(comparision, '=',  $T("_grid_equals"));
			addOption(comparision, '<>', $T("_grid_not_equal"));
			addOption(comparision, '>',  $T("_grid_greater"));
			addOption(comparision, '<',  $T("_grid_less"));
			addOption(comparision, '>=', $T("_grid_greater_or_equal"));
			addOption(comparision, '<=', $T("_grid_less_or_equal"));
			addOption(comparision, '><', $T("_grid_range"));
			value.focus();
		}
		else if(type == 'bool')
		{
			addOption(comparision, '1', $T("_yes"));
			addOption(comparision, '0', $T("_no"));
			comparision.focus();
			value.hide();
		}
		else if(type == 'date')
		{
			$H(this.getProperty('dateFilterValues')).each(function(comparision, f) {
				var key = 0, value=1
				addOption(comparision, f[value], $T(f[key]));
			}.bind(this, comparision));
			comparision.focus();
			value.hide();
		}
	},

	comparisionChanged: function(container)
	{
		if(this.getComparision(container) == '><')
		{
			container.down(".value2").show();
		}
		else
		{
			container.down(".value2").hide();
		}
	},

	isFilled: function(container)
	{
		type = this.getProperty('type');

		// ???
		if(this.getComparision(container) == '><')
		{
			return !!container.down(".value").value &&  !!container.down(".value2").value;
		}
		// ???

		else if (type == this.TEXT || type == this.NUMERIC)
		{
			return !!container.down(".value").value;
		}
		else if(type == this.BOOL || type == this.DATE)
		{
			return true;
		}
	},

	getValue: function(container)
	{
		if(this.getComparision(container) == '><')
		{
			return '>=' + container.down(".value").value +' <=' +container.down(".value2").value;
		}
		else
		{
			return container.down(".value").value;
		}
	},

	getComparision: function(container)
	{
		var v = container.down(".comparision").value;
		if(v == '=')
		{
			v = '';
		}
		return v ? v : "";
	}
}

function $T()
{
	if(arguments.length == 2)
	{
		this[arguments[0]] = arguments[1];
	}
	else
	{
		return this[arguments[0]] ? this[arguments[0]] : arguments[0];
	}
}

function addOption(dropdown, value, text)
{
	var option = document.createElement('option');
	dropdown.appendChild(option);
	option.value = value;
	option.innerHTML = text;
	return option;
}

function RegexFilter(element, params)
{
	var regex = new RegExp(params['regex'], 'gi');
	element.value = element.value.replace(regex, '');
}

function stripHtml(value)
{
	if (!value || !value.replace)
	{
		return value;
	}

	return value.replace(/<[ \/]*?\w+((\s+\w+(\s*=\s*(?:".*?"|'.*?'|[^'">\s]+))?)+\s*|\s*)[ \/]*>/g, '');
}


/***************************************************
 * library/dhtmlxtree/dhtmlXCommon.js
 ***************************************************/

/*
Copyright Scand LLC http://www.scbr.com
To use this component please contact info@scbr.com to obtain license
*/
		/**
          *     @desc: xmlLoader object
          *     @type: private
          *     @param: funcObject - xml parser function
          *     @param: object - jsControl object
          *     @param: async - sync/async mode (async by default)
          *     @param: rSeed - enable/disable random seed ( prevent IE caching)
		  *     @topic: 0
          */	
function dtmlXMLLoaderObject(funcObject, dhtmlObject,async,rSeed){
	this.xmlDoc="";
	if(arguments.length==2)
		this.async=false;
	else
		this.async=async;
	this.onloadAction=funcObject||null;
	this.mainObject=dhtmlObject||null;
    this.waitCall=null;
	this.rSeed=rSeed||false;
	return this;
};
		/**
          *     @desc: xml loading handler
          *     @type: private
          *     @param: dtmlObject - xmlLoader object
		  *     @topic: 0
          */
	dtmlXMLLoaderObject.prototype.waitLoadFunction=function(dhtmlObject){
		this.check=function (){
			if(dhtmlObject.onloadAction!=null){
				if  ((!dhtmlObject.xmlDoc.readyState)||(dhtmlObject.xmlDoc.readyState == 4)){                       
					dhtmlObject.onloadAction(dhtmlObject.mainObject,null,null,null,dhtmlObject);
                    if (dhtmlObject.waitCall) { dhtmlObject.waitCall(); dhtmlObject.waitCall=null; }
                    dhtmlObject=null;
                    }
			}
		};
		return this.check;
	};

		/**
          *     @desc: return XML top node
		  *     @param: tagName - top XML node tag name (not used in IE, required for Safari and Mozilla)
          *     @type: private
		  *     @returns: top XML node
		  *     @topic: 0  
          */
	dtmlXMLLoaderObject.prototype.getXMLTopNode=function(tagName){ 
			if (this.xmlDoc.responseXML)  { 
				var temp=this.xmlDoc.responseXML.getElementsByTagName(tagName);
				var z=temp[0];  
			}else
				var z=this.xmlDoc.documentElement;
			if (z){
				this._retry=false;
				return z;
				}

            if ((_isIE)&&(!this._retry)){    
                //fall back to MS.XMLDOM
                var xmlString=this.xmlDoc.responseText;
                this._retry=true;
           			this.xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
           			this.xmlDoc.async=false;
            		this.xmlDoc.loadXML(xmlString);

                    return this.getXMLTopNode(tagName);
            }
            dhtmlxError.throwError("LoadXML","Incorrect XML",[this.xmlDoc,this.mainObject]);
			return document.createElement("DIV");
	};

		/**
          *     @desc: load XML from string
          *     @type: private
          *     @param: xmlString - xml string
		  *     @topic: 0  
          */
	dtmlXMLLoaderObject.prototype.loadXMLString=function(xmlString){
     try
	 {
		 var parser = new DOMParser();
		 this.xmlDoc = parser.parseFromString(xmlString,"text/xml");
 }
	 catch(e){
		this.xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		this.xmlDoc.async=this.async;
		this.xmlDoc.loadXML(xmlString);
	 }
	  this.onloadAction(this.mainObject);
      if (this.waitCall) { this.waitCall(); this.waitCall=null; }
	}
		/**
          *     @desc: load XML
          *     @type: private
          *     @param: filePath - xml file path
          *     @param: postMode - send POST request
          *     @param: postVars - list of vars for post request
		  *     @topic: 0
          */
	dtmlXMLLoaderObject.prototype.loadXML=function(filePath,postMode,postVars){
	 if (this.rSeed) filePath+=((filePath.indexOf("?")!=-1)?"&":"?")+"a_dhx_rSeed="+(new Date()).valueOf();
     this.filePath=filePath;

     if (window.XMLHttpRequest){
	 	this.xmlDoc = new XMLHttpRequest();
		this.xmlDoc.open(postMode?"POST":"GET",filePath,this.async);
        if (postMode)
              this.xmlDoc.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		this.xmlDoc.onreadystatechange=new this.waitLoadFunction(this);
		this.xmlDoc.send(null||postVars);
	}
	else{

    		if (document.implementation && document.implementation.createDocument)
    		{
    			this.xmlDoc = document.implementation.createDocument("", "", null);
    			this.xmlDoc.onload = new this.waitLoadFunction(this);
				this.xmlDoc.load(filePath);
    		}
    		else
    		{
        			this.xmlDoc = new ActiveXObject("Microsoft.XMLHTTP");
            		this.xmlDoc.open(postMode?"POST":"GET",filePath,this.async);
                    if (postMode) this.xmlDoc.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        			this.xmlDoc.onreadystatechange=new this.waitLoadFunction(this);
            		this.xmlDoc.send(null||postVars);
    		}
  		}
	};
		/**
          *     @desc: destructor, cleans used memory
          *     @type: private
		  *     @topic: 0
          */
    dtmlXMLLoaderObject.prototype.destructor=function(){
        this.onloadAction=null;
	    this.mainObject=null;
        this.xmlDoc=null;
        return null;
    }
	
		/**  
          *     @desc: Call wrapper
          *     @type: private
          *     @param: funcObject - action handler
          *     @param: dhtmlObject - user data
		  *     @returns: function handler
		  *     @topic: 0  
          */
function callerFunction(funcObject,dhtmlObject){
	this.handler=function(e){
		if (!e) e=event;
		funcObject(e,dhtmlObject);
		return true;
	};
	return this.handler;
};

		/**  
          *     @desc: Calculate absolute position of html object
          *     @type: private
          *     @param: htmlObject - html object
		  *     @topic: 0  
          */
function getAbsoluteLeft(htmlObject){
        var xPos = htmlObject.offsetLeft;
        var temp = htmlObject.offsetParent;
        while (temp != null) {
            xPos += temp.offsetLeft;
            temp = temp.offsetParent;
        }
        return xPos;
    }
		/**
          *     @desc: Calculate absolute position of html object
          *     @type: private
          *     @param: htmlObject - html object
		  *     @topic: 0  
          */	
function getAbsoluteTop(htmlObject) {
        var yPos = htmlObject.offsetTop;
        var temp = htmlObject.offsetParent;
        while (temp != null) {
            yPos += temp.offsetTop;
            temp = temp.offsetParent;
        }
        return yPos;
   }
   
   
/**  
*     @desc: Convert string to it boolean representation
*     @type: private
*     @param: inputString - string for covertion
*     @topic: 0  
*/	  
function convertStringToBoolean(inputString){ if (typeof(inputString)=="string") inputString=inputString.toLowerCase();
	switch(inputString){
		case "1":
		case "true":
		case "yes":
		case "y":
		case 1:		
		case true:		
					return true; 
					break;
		default: 	return false;
	}
}

/**  
*     @desc: find out what symbol to use as url param delimiters in further params
*     @type: private
*     @param: str - current url string
*     @topic: 0  
*/
function getUrlSymbol(str){
		if(str.indexOf("?")!=-1)
			return "&"
		else
			return "?"
	}
	
	
function dhtmlDragAndDropObject(){
		this.lastLanding=0;
		this.dragNode=0;
		this.dragStartNode=0;
		this.dragStartObject=0;
		this.tempDOMU=null;
		this.tempDOMM=null;
		this.waitDrag=0;
		if (window.dhtmlDragAndDrop) return window.dhtmlDragAndDrop;
		window.dhtmlDragAndDrop=this;

		return this;
	};
	
	dhtmlDragAndDropObject.prototype.removeDraggableItem=function(htmlNode){
		htmlNode.onmousedown=null;
		htmlNode.dragStarter=null;
		htmlNode.dragLanding=null;
	}
	dhtmlDragAndDropObject.prototype.addDraggableItem=function(htmlNode,dhtmlObject){
		htmlNode.onmousedown=this.preCreateDragCopy;
		htmlNode.dragStarter=dhtmlObject;
		this.addDragLanding(htmlNode,dhtmlObject);
	}
	dhtmlDragAndDropObject.prototype.addDragLanding=function(htmlNode,dhtmlObject){
		htmlNode.dragLanding=dhtmlObject;
	}
	dhtmlDragAndDropObject.prototype.preCreateDragCopy=function(e)
	{
		if (window.dhtmlDragAndDrop.waitDrag) {
			 window.dhtmlDragAndDrop.waitDrag=0;
			 document.body.onmouseup=window.dhtmlDragAndDrop.tempDOMU;
			 document.body.onmousemove=window.dhtmlDragAndDrop.tempDOMM;
			 return false;
		}

		window.dhtmlDragAndDrop.waitDrag=1;
		window.dhtmlDragAndDrop.tempDOMU=document.body.onmouseup;
		window.dhtmlDragAndDrop.tempDOMM=document.body.onmousemove;
		window.dhtmlDragAndDrop.dragStartNode=this;
		window.dhtmlDragAndDrop.dragStartObject=this.dragStarter;
		document.body.onmouseup=window.dhtmlDragAndDrop.preCreateDragCopy;
		document.body.onmousemove=window.dhtmlDragAndDrop.callDrag;

            	if ((e)&&(e.preventDefault)) { e.preventDefault(); return false; }
            	return false;
	};
	dhtmlDragAndDropObject.prototype.callDrag=function(e){
		if (!e) e=window.event;
		dragger=window.dhtmlDragAndDrop;

	   	if ((e.button==0)&&(_isIE)) return dragger.stopDrag();
		if (!dragger.dragNode) {
			dragger.dragNode=dragger.dragStartObject._createDragNode(dragger.dragStartNode,e);
            if (!dragger.dragNode) return dragger.stopDrag();
			dragger.gldragNode=dragger.dragNode;
			document.body.appendChild(dragger.dragNode);
			document.body.onmouseup=dragger.stopDrag;
			dragger.waitDrag=0;
			dragger.dragNode.pWindow=window;
		   	dragger.initFrameRoute();
			}


		if (dragger.dragNode.parentNode!=window.document.body){
			var grd=dragger.gldragNode;
			if (dragger.gldragNode.old) grd=dragger.gldragNode.old;

			//if (!document.all) dragger.calculateFramePosition();
			grd.parentNode.removeChild(grd);
			var oldBody=dragger.dragNode.pWindow;
			if (_isIE){
			var div=document.createElement("Div");
			div.innerHTML=dragger.dragNode.outerHTML;
			dragger.dragNode=div.childNodes[0];	}
			else dragger.dragNode=dragger.dragNode.cloneNode(true);
			dragger.dragNode.pWindow=window;
			dragger.gldragNode.old=dragger.dragNode;
			document.body.appendChild(dragger.dragNode);
			oldBody.dhtmlDragAndDrop.dragNode=dragger.dragNode;
		}

			dragger.dragNode.style.left=e.clientX+15+(dragger.fx?dragger.fx*(-1):0)+(document.body.scrollLeft||document.documentElement.scrollLeft)+"px";
			dragger.dragNode.style.top=e.clientY+3+(dragger.fy?dragger.fy*(-1):0)+(document.body.scrollTop||document.documentElement.scrollTop)+"px";
		if (!e.srcElement) 	var z=e.target; 	else 	z=e.srcElement;
		dragger.checkLanding(z,e.clientX, e.clientY );
	}
	
	dhtmlDragAndDropObject.prototype.calculateFramePosition=function(n){
		//this.fx = 0, this.fy = 0;
		if (window.name)  {
		  var el =parent.frames[window.name].frameElement.offsetParent;
		  var fx=0;
		  var fy=0;
		  while (el)	{      fx += el.offsetLeft;      fy += el.offsetTop;      el = el.offsetParent;   }
		  if 	((parent.dhtmlDragAndDrop))	{ 	 var ls=parent.dhtmlDragAndDrop.calculateFramePosition(1);  fx+=ls.split('_')[0]*1;  fy+=ls.split('_')[1]*1;  }
		  if (n) return fx+"_"+fy;
		  else this.fx=fx; this.fy=fy;
		  }
		  return "0_0";
	}
	dhtmlDragAndDropObject.prototype.checkLanding=function(htmlObject,x,y){

		if ((htmlObject)&&(htmlObject.dragLanding)) { if (this.lastLanding) this.lastLanding.dragLanding._dragOut(this.lastLanding);
										 this.lastLanding=htmlObject; this.lastLanding=this.lastLanding.dragLanding._dragIn(this.lastLanding,this.dragStartNode,x,y); }
		else {
			 if ((htmlObject)&&(htmlObject.tagName!="BODY")) this.checkLanding(htmlObject.parentNode,x,y);
			 else  {
			 	 if (this.lastLanding) this.lastLanding.dragLanding._dragOut(this.lastLanding,x,y); this.lastLanding=0;
				 if (this._onNotFound) this._onNotFound();
				 }
			 }
	}
	dhtmlDragAndDropObject.prototype.stopDrag=function(e,mode){
		dragger=window.dhtmlDragAndDrop;
		if (!mode)
			{
			  dragger.stopFrameRoute();
              var temp=dragger.lastLanding;
        	  dragger.lastLanding=null;
			  if (temp) temp.dragLanding._drag(dragger.dragStartNode,dragger.dragStartObject,temp);
			}
        dragger.lastLanding=null;
		if ((dragger.dragNode)&&(dragger.dragNode.parentNode==document.body)) dragger.dragNode.parentNode.removeChild(dragger.dragNode);
		dragger.dragNode=0;
		dragger.gldragNode=0;
		dragger.fx=0;
		dragger.fy=0;
		dragger.dragStartNode=0;
		dragger.dragStartObject=0;
		document.body.onmouseup=dragger.tempDOMU;
		document.body.onmousemove=dragger.tempDOMM;
		dragger.tempDOMU=null;
		dragger.tempDOMM=null;
		dragger.waitDrag=0;
	}	
	
	dhtmlDragAndDropObject.prototype.stopFrameRoute=function(win){
		if (win)
			window.dhtmlDragAndDrop.stopDrag(1,1);
				
		for (var i=0; i<window.frames.length; i++)
			if ((window.frames[i]!=win)&&(window.frames[i].dhtmlDragAndDrop))
				window.frames[i].dhtmlDragAndDrop.stopFrameRoute(window);
		if ((parent.dhtmlDragAndDrop)&&(parent!=window)&&(parent!=win)) 
				parent.dhtmlDragAndDrop.stopFrameRoute(window);	
	}
	dhtmlDragAndDropObject.prototype.initFrameRoute=function(win,mode){
		if (win)	{


        			    window.dhtmlDragAndDrop.preCreateDragCopy();
					window.dhtmlDragAndDrop.dragStartNode=win.dhtmlDragAndDrop.dragStartNode;
					window.dhtmlDragAndDrop.dragStartObject=win.dhtmlDragAndDrop.dragStartObject;
					window.dhtmlDragAndDrop.dragNode=win.dhtmlDragAndDrop.dragNode;
					window.dhtmlDragAndDrop.gldragNode=win.dhtmlDragAndDrop.dragNode;
					window.document.body.onmouseup=window.dhtmlDragAndDrop.stopDrag;
					window.waitDrag=0;
					if (((!_isIE)&&(mode))&&((!_isFF)||(_FFrv<1.8)))
                         window.dhtmlDragAndDrop.calculateFramePosition();
				}
	if ((parent.dhtmlDragAndDrop)&&(parent!=window)&&(parent!=win))
				parent.dhtmlDragAndDrop.initFrameRoute(window);
		for (var i=0; i<window.frames.length; i++)
			if ((window.frames[i]!=win)&&(window.frames[i].dhtmlDragAndDrop))
				window.frames[i].dhtmlDragAndDrop.initFrameRoute(window,((!win||mode)?1:0));

	}

var _isFF=false; var _isIE=false; var _isOpera=false; var _isKHTML=false; var _isMacOS=false;

if (navigator.userAgent.indexOf('Macintosh') != -1) _isMacOS=true;
if ((navigator.userAgent.indexOf('Safari') != -1)||(navigator.userAgent.indexOf('Konqueror')!= -1))
    _isKHTML=true;
else if (navigator.userAgent.indexOf('Opera') != -1){
    _isOpera=true;
    _OperaRv=parseFloat(navigator.userAgent.substr(navigator.userAgent.indexOf('Opera')+6,3));
    }
else if(navigator.appName.indexOf("Microsoft")!=-1)
    _isIE=true;
else {
    _isFF=true;
    var _FFrv=parseFloat(navigator.userAgent.split("rv:")[1])
    }

//deprecated, use global constant instead
//determines if current browser is IE
function isIE(){
	if(navigator.appName.indexOf("Microsoft")!=-1)
        if (navigator.userAgent.indexOf('Opera') == -1)
    		return true;
	return false;
}

//multibrowser Xpath processor
dtmlXMLLoaderObject.prototype.doXPath = function(xpathExp,docObj){  
    if ((_isOpera)||(_isKHTML)) return this.doXPathOpera(xpathExp,docObj);
	if(_isIE){//IE
		if(!docObj)
			if(!this.xmlDoc.nodeName)
				docObj = this.xmlDoc.responseXML
			else
				docObj = this.xmlDoc;
		return docObj.selectNodes(xpathExp);
	}else{//Mozilla
		var nodeObj = docObj;
		if(!docObj){
			if(!this.xmlDoc.nodeName){
			docObj = this.xmlDoc.responseXML
			}else{
			docObj = this.xmlDoc;
			}
		}
		if(docObj.nodeName.indexOf("document")!=-1){
			nodeObj = docObj;
		}else{
			nodeObj = docObj;
			docObj = docObj.ownerDocument;

		}
		var rowsCol = new Array();
    		var col = docObj.evaluate(xpathExp, nodeObj, null, XPathResult.ANY_TYPE,null);
    		var thisColMemb = col.iterateNext();
	    	while (thisColMemb) {
		    	rowsCol[rowsCol.length] = thisColMemb;
			    thisColMemb = col.iterateNext();
    		}
	    	return rowsCol;
	}
}
   
if  (( window.Node )&&(!_isKHTML))
Node.prototype.removeNode = function( removeChildren )
{
	var self = this;
	if ( Boolean( removeChildren ) )
	{
		return this.parentNode.removeChild( self );
	}
	else
	{
		var range = document.createRange();
		range.selectNodeContents( self );
		return this.parentNode.replaceChild( range.extractContents(), self );
	}
}

function _dhtmlxError(type,name,params){
    if (!this.catches)
        this.catches=new Array();

    return this;
}

_dhtmlxError.prototype.catchError=function(type,func_name){
    this.catches[type]=func_name;
}
_dhtmlxError.prototype.throwError=function(type,name,params){
        if (this.catches[type]) return  this.catches[type](type,name,params);
        if (this.catches["ALL"]) return  this.catches["ALL"](type,name,params);
        alert("Error type: " + arguments[0]+"\nDescription: " + arguments[1] );
        return null;
}

window.dhtmlxError=new  _dhtmlxError();


//opera fake, while 9.0 not released
//multibrowser Xpath processor
dtmlXMLLoaderObject.prototype.doXPathOpera = function(xpathExp,docObj){
    //this is fake for Opera
    var z=xpathExp.replace(/[\/]+/gi,"/").split('/');
    var obj=null;
    var i=1;

    if (!z.length) return [];
    if (z[0]==".")
        obj=[docObj];
    else if (z[0]=="")
        {
        obj=this.xmlDoc.responseXML.getElementsByTagName(z[i].replace(/\[[^\]]*\]/g,""));
        i++;
        }
    else return [];

    for (i; i<z.length; i++)
        obj=this._getAllNamedChilds(obj,z[i]);

    if (z[i-1].indexOf("[")!=-1)
        obj=this._filterXPath(obj,z[i-1]);
    return obj;
}

dtmlXMLLoaderObject.prototype._filterXPath = function(a,b){
    var c=new Array();
    var b=b.replace(/[^\[]*\[\@/g,"").replace(/[\[\]\@]*/g,"");
    for (var i=0; i<a.length; i++)
        if (a[i].getAttribute(b))
            c[c.length]=a[i];

    return c;
}
dtmlXMLLoaderObject.prototype._getAllNamedChilds = function(a,b){
    var c=new Array();
    for (var i=0; i<a.length; i++)
        for (var j=0; j<a[i].childNodes.length; j++)
            if (a[i].childNodes[j].tagName==b) c[c.length]=a[i].childNodes[j];

    return c;
}

function dhtmlXHeir(a,b){
	for (c in b)
		if (typeof(b[c])=="function") a[c]=b[c];
	return a;
}
function dhtmlxEvent(el,event,handler){
    if (el.addEventListener)
		el.addEventListener(event,handler,false);
	else if (el.attachEvent)
		el.attachEvent("on"+event,handler);
}



/***************************************************
 * library/dhtmlxtree/dhtmlXTree.js
 ***************************************************/

/*
Copyright Scand LLC http://www.scbr.com
To use this component please contact info@scbr.com to obtain license
*/

/*_TOPICS_
@0:Initialization
@1:Selection control
@2:Add/delete
@3:Private
@4:Node/level control
@5:Checkboxes/user data manipulation
@6:Appearence control
@7:Event Handlers
*/

/**
*     @desc: tree constructor
*     @param: htmlObject - parent html object or id of parent html object
*     @param: width - tree width
*     @param: height - tree height
*     @param: rootId - id of virtual root node
*     @type: public
*     @topic: 0
*/
function dhtmlXTreeObject(htmlObject, width, height, rootId){
	if (_isIE) try { document.execCommand("BackgroundImageCache", false, true); } catch (e){}
	if (typeof(htmlObject)!="object")
      this.parentObject=document.getElementById(htmlObject);
	else
      this.parentObject=htmlObject;

   	this._itim_dg=true;
    this.dlmtr=",";
    this.dropLower=false;
   this.xmlstate=0;
   this.mytype="tree";
   this.smcheck=true;   //smart checkboxes
   this.width=width;
   this.height=height;
   this.rootId=rootId;
   this.childCalc=null;
      this.def_img_x="18px";
      this.def_img_y="18px";

    this._dragged=new Array();
   this._selected=new Array();

   this.style_pointer="pointer";
   if (navigator.appName == 'Microsoft Internet Explorer')  this.style_pointer="hand";

   this._aimgs=true;
   this.htmlcA=" [";
   this.htmlcB="]";
   this.lWin=window;
   this.cMenu=0;
   this.mlitems=0;
   this.dadmode=0;
   this.slowParse=false;
   this.autoScroll=true;
   this.hfMode=0;
   this.nodeCut=new Array();
   this.XMLsource=0;
   this.XMLloadingWarning=0;
   this._globalIdStorage=new Array();
   this.globalNodeStorage=new Array();
   this._globalIdStorageSize=0;
   this.treeLinesOn=true;
   this.checkFuncHandler=0;
   this._spnFH=0;
   this.dblclickFuncHandler=0;
   this.tscheck=false;
   this.timgen=true;

   this.dpcpy=false;
    this._ld_id=null;

   this.imPath="treeGfx/";
   this.checkArray=new Array("iconUnCheckAll.gif","iconCheckAll.gif","iconCheckGray.gif","iconUncheckDis.gif","iconCheckDis.gif","iconCheckDis.gif");
   this.radioArray=new Array("radio_off.gif","radio_on.gif","radio_on.gif","radio_off.gif","radio_on.gif","radio_on.gif");

   this.lineArray=new Array("line2.gif","line3.gif","line4.gif","blank.gif","blank.gif","line1.gif");
   this.minusArray=new Array("minus2.gif","minus3.gif","minus4.gif","minus.gif","minus5.gif");
   this.plusArray=new Array("plus2.gif","plus3.gif","plus4.gif","plus.gif","plus5.gif");
   this.imageArray=new Array("leaf.gif","folderOpen.gif","folderClosed.gif");
   this.cutImg= new Array(0,0,0);
   this.cutImage="but_cut.gif";

   this.dragger= new dhtmlDragAndDropObject();
//create root
   this.htmlNode=new dhtmlXTreeItemObject(this.rootId,"",0,this);
   this.htmlNode.htmlNode.childNodes[0].childNodes[0].style.display="none";
   this.htmlNode.htmlNode.childNodes[0].childNodes[0].childNodes[0].className="hiddenRow";
//init tree structures
   this.allTree=this._createSelf();
   this.allTree.appendChild(this.htmlNode.htmlNode);
    if(_isFF) this.allTree.childNodes[0].width="100%";

   this.allTree.onselectstart=new Function("return false;");
   this.XMLLoader=new dtmlXMLLoaderObject(this._parseXMLTree,this,true,this.no_cashe);
   if (_isIE) this.preventIECashing(true);

//#__pro_feature:01112006{
//#complex_move:01112006{
   this.selectionBar=document.createElement("DIV");
   this.selectionBar.className="selectionBar";
   this.selectionBar.innerHTML="&nbsp;";
   this.selectionBar.style.display="none";
   this.allTree.appendChild(this.selectionBar);
//#}
//#}

    var self=this;
    if (window.addEventListener) window.addEventListener("unload",function(){try{  self.destructor(); } catch(e){}},false);
    if (window.attachEvent) window.attachEvent("onunload",function(){ try{ self.destructor(); } catch(e){}});

   return this;
};

dhtmlXTreeObject.prototype.destructor=function(){
    for (var i=0; i<this._globalIdStorageSize; i++){
        var z=this.globalNodeStorage[i];
        z.parentObject=null;z.treeNod=null;z.childNodes=null;z.span=null;z.tr.nodem=null;z.tr=null;z.htmlNode.objBelong=null;z.htmlNode=null;
        this.globalNodeStorage[i]=null;
        }
    this.allTree.innerHTML="";
    this.XMLLoader.destructor();
    for(var a in this){
        this[a]=null;
        }
}

function cObject(){
    return this;
}
cObject.prototype= new Object;
cObject.prototype.clone = function () {
       function _dummy(){};
       _dummy.prototype=this;
       return new _dummy();
    }

/**
*   @desc: tree node constructor
*   @param: itemId - node id
*   @param: itemText - node label
*   @param: parentObject - parent item object
*   @param: treeObject - tree object
*   @param: actionHandler - onclick event handler(optional)
*   @param: mode - do not show images
*   @type: private
*   @topic: 0
*/
function dhtmlXTreeItemObject(itemId,itemText,parentObject,treeObject,actionHandler,mode){
   this.htmlNode="";
   this.acolor="";
   this.scolor="";
   this.tr=0;
   this.childsCount=0;
   this.tempDOMM=0;
   this.tempDOMU=0;
   this.dragSpan=0;
   this.dragMove=0;
   this.span=0;
   this.closeble=1;
   this.childNodes=new Array();
   this.userData=new cObject();


   this.checkstate=0;
   this.treeNod=treeObject;
   this.label=itemText;
   this.parentObject=parentObject;
   this.actionHandler=actionHandler;
   this.images=new Array(treeObject.imageArray[0],treeObject.imageArray[1],treeObject.imageArray[2]);


   this.id=treeObject._globalIdStorageAdd(itemId,this);
   if (this.treeNod.checkBoxOff ) this.htmlNode=this.treeNod._createItem(1,this,mode);
   else  this.htmlNode=this.treeNod._createItem(0,this,mode);
      
   this.htmlNode.objBelong=this;
   return this;
   };   


/**
*     @desc: register node
*     @type: private
*     @param: itemId - node id
*     @param: itemObject - node object
*     @topic: 3  
*/
   dhtmlXTreeObject.prototype._globalIdStorageAdd=function(itemId,itemObject){
      if (this._globalIdStorageFind(itemId,1,1)) {     d=new Date(); itemId=d.valueOf()+"_"+itemId; return this._globalIdStorageAdd(itemId,itemObject); }
         this._globalIdStorage[this._globalIdStorageSize]=itemId;
         this.globalNodeStorage[this._globalIdStorageSize]=itemObject;
         this._globalIdStorageSize++;
      return itemId;
   };

/**
*     @desc: unregister node
*     @type: private
*     @param: itemId - node id
*     @topic: 3
*/
   dhtmlXTreeObject.prototype._globalIdStorageSub=function(itemId){
      for (var i=0; i<this._globalIdStorageSize; i++)
         if (this._globalIdStorage[i]==itemId)
            {
      this._globalIdStorage[i]=this._globalIdStorage[this._globalIdStorageSize-1];
      this.globalNodeStorage[i]=this.globalNodeStorage[this._globalIdStorageSize-1];
      this._globalIdStorageSize--;
      this._globalIdStorage[this._globalIdStorageSize]=0;
      this.globalNodeStorage[this._globalIdStorageSize]=0;
            }
   };
   
/**
*     @desc: return node object
*     @param: itemId - node id
*     @type: private
*     @topic: 3
*/
   dhtmlXTreeObject.prototype._globalIdStorageFind=function(itemId,skipXMLSearch,skipParsing,isreparse){
//   if (confirm(itemId)) { window.asdasd.asdasd(); }
      for (var i=0; i<this._globalIdStorageSize; i++)
         if (this._globalIdStorage[i]==itemId)
            {
//#__pro_feature:01112006{
//#smart_parsing:01112006{
            if ((this.globalNodeStorage[i].unParsed)&&(!skipParsing))
                    {
                    this.reParse(this.globalNodeStorage[i],0);
                    }
                if ((isreparse)&&(this._edsbpsA)){
                    for (var j=0; j<this._edsbpsA.length; j++)
                        if (this._edsbpsA[j][2]==itemId){
                            dhtmlxError.throwError("getItem","Requested item still in parsing process.",itemId);
                            return null;
                        }
                    }
//#}
//#}
            return this.globalNodeStorage[i];
            }
//#__pro_feature:01112006{
//#smart_parsing:01112006{
      if ((this.slowParse)&&(itemId!=0)&&(!skipXMLSearch)) return this.preParse(itemId);
      else
//#}
//#}
	  	return null;
   };
//#__pro_feature:01112006{
//#smart_parsing:01112006{

    dhtmlXTreeObject.prototype._getSubItemsXML=function(temp){
      var z="";
        for (var i=0; i<temp.childNodes.length; i++)
        {
            if (temp.childNodes[i].tagName=="item")
            {
         if (!z) z=temp.childNodes[i].getAttribute("id");
            else z+=this.dlmtr+temp.childNodes[i].getAttribute("id");
            }
        }
        return z;
    }

/**
*     @desc: enable/disable smart XML parsing mode (usefull for big, well structured XML)
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableSmartXMLParsing=function(mode) { this.slowParse=convertStringToBoolean(mode); };

/**
*     @desc: search data in xml
*     @param: node - XML node
*     @param: par - attribute name
*     @param: val - attribute value
*     @type: private
*     @edition: Professional
*     @topic: 3
*/
   dhtmlXTreeObject.prototype.findXML=function(node,par,val){

      for (var i=0; i<node.childNodes.length; i++)
            if (node.childNodes[i].nodeType==1)
            {
               if (node.childNodes[i].getAttribute(par)==val)
                  return node;
                  var z=this.findXML(node.childNodes[i],par,val);
                  if (z) return (z);
            }
      return false;
   }

dhtmlXTreeObject.prototype._getAllCheckedXML=function(htmlNode,list,mode){
      var j=htmlNode.childNodes.length;

      for (var i=0; i<j; i++)
      {
            var tNode=htmlNode.childNodes[i];
            if (tNode.tagName=="item")
            {
            var z=tNode.getAttribute("checked");

            var flag=false;

                if (mode==2){
                     if (z=="-1")
                        flag=true;
                }
                else
                if (mode==1){
                    if ((z)&&(z!="0")&&(z!="-1"))
                        flag=true;
                }
                else
                if (mode==0){
                    if ((!z)||(z=="0"))
                        flag=true;
                }

                if (flag)
                    {
                 if (list) list+=this.dlmtr+tNode.getAttribute("id");
                    else list=tNode.getAttribute("id");
                    }
         list=this._getAllCheckedXML(tNode,list,mode);
            }
      };

      if (list) return list; else return "";
   };


/**
*     @desc: change state of node's checkbox and all childnodes checkboxes
*     @type: private
*     @param: itemId - target node id
*     @param: state - checkbox state
*     @param: sNode - target node object (optional, used by private methods)
*     @topic: 5
*/
dhtmlXTreeObject.prototype._setSubCheckedXML=function(state,sNode){
   if (!sNode) return;
    if (!_isOpera){
        var val= state?"1":"";
        var z=this.XMLLoader.doXPath(".//item",sNode);
        for (var i=0; i<z.length; i++)
            z[i].setAttribute("checked",val);
        }
    else
    for (var i=0; i<sNode.childNodes.length; i++){
      var tag=sNode.childNodes[i];
      if ((tag)&&(tag.tagName=="item")) {
         if (state) tag.setAttribute("checked",1);
         else  tag.setAttribute("checked","");
         this._setSubCheckedXML(state,tag);
         }
      }
}

       dhtmlXTreeObject.prototype._getAllScraggyItemsXML=function(node,x){
        var z="";
        var flag=false;
        for (var i=0; i<node.childNodes.length; i++)
            if ((node.childNodes[i].tagName=="item")){
                flag=true;
                var zb=this._getAllScraggyItemsXML(node.childNodes[i],0);
                if (zb!="")
                    if (z)
                        z+=this.dlmtr+zb;
                    else
                        z=zb;
                }
        if ((!x)&&(!flag))
            if (z)
                z+=this.dlmtr+ node.getAttribute("id");
            else z=node.getAttribute("id");

        return z;
    }
    dhtmlXTreeObject.prototype._getAllFatItemsXML=function(node,x){
        var z="";
        var flag=false;
        for (var i=0; i<node.childNodes.length; i++)
            if ((node.childNodes[i].tagName=="item")){
                flag=true;
                var zb=this._getAllFatItemsXML(node.childNodes[i],0);
                if (zb!="")
                    if (z)
                        z+=this.dlmtr+zb;
                    else
                        z=zb;
                }
        if ((!x)&&(flag))
            if (z)
                z+=this.dlmtr+ node.getAttribute("id");
            else z=node.getAttribute("id");

        return z;
    }

    dhtmlXTreeObject.prototype._getAllSubItemsXML=function(itemId,z,node){
        for (var i=0; i<node.childNodes.length; i++)
            if (node.childNodes[i].tagName=="item"){
                if (!z) z=node.childNodes[i].getAttribute("id");
                else    z+=this.dlmtr+ node.childNodes[i].getAttribute("id");
                z=this._getAllSubItemsXML(itemId,z,node.childNodes[i]);
                }
        return z;
    }

/**
*     @desc: parse stored xml
*     @param: node - XML node
*     @type: private
*     @edition: Professional
*     @topic: 3  
*/
   dhtmlXTreeObject.prototype.reParse=function(node){
        var that=this;
      if ((this.onXLS)&&(!this.parsCount)) that.onXLS(that,node.id);
      this.xmlstate=1;

      var tmp=node.unParsed;
      node.unParsed=0;
//               if (confirm("reParse "+node.id)) { window.asdasd.asdasd(); }
      this.XMLloadingWarning=1;
        var oldpid=this.parsingOn;
      this.parsingOn=node.id;
      this.parsedArray=new Array();

         this.setCheckList="";
         this._parseXMLTree(this,tmp,node.id,2,node);
         var chArr=this.setCheckList.split(this.dlmtr);

      for (var i=0; i<this.parsedArray.length; i++)
         node.htmlNode.childNodes[0].appendChild(this.parsedArray[i]);

            this.oldsmcheck=this.smcheck;
            this.smcheck=false;

         for (var n=0; n<chArr.length; n++)
            if (chArr[n])  this.setCheck(chArr[n],1);
            this.smcheck=this.oldsmcheck;

      this.parsingOn=oldpid;
      this.XMLloadingWarning=0;
      this._redrawFrom(this,node);
      return true;
   }

/**
*     @desc: search for item in unparsed chunks
*     @param: itemId - item ID
*     @type: private
*     @edition: Professional
*     @topic: 3
*/
   dhtmlXTreeObject.prototype.preParse=function(itemId){
   if (!itemId) return null;
      var z=this.XMLLoader.getXMLTopNode("tree");
      var i=0;
      var k=0;

            if (!z) return;
         for (i=0; i<z.childNodes.length; i++)
            if (z.childNodes[i].nodeType==1)
               {
                 var zNode=this.findXML(z.childNodes[i],"id",itemId);
                 if (zNode!==false)
                 {
                        var nArr=new Array();
                        while (1){
                            nArr[nArr.length]=zNode.getAttribute("id");
                        z=this._globalIdStorageFind(zNode.getAttribute("id"),true,true,true);
                            if (z) break;
                            zNode=zNode.parentNode;
                        }
                        for (var i=nArr.length-1; i>=0; i--)
                             this._globalIdStorageFind(nArr[i],true,false);

                        z=this._globalIdStorageFind(itemId,true,false);
                        if (!z) dhtmlxError.throwError("getItem","The item "+itemId+" not operable. Seems you have non-unique IDs in tree's XML.",itemId);
                        return z;
                 }
                }

         return null;
   }

//#}
//#}

/**
*     @desc: escape string
*     @param: itemId - item ID
*     @type: private
*     @topic: 3
*/
   dhtmlXTreeObject.prototype._escape=function(str){
        switch(this.utfesc){
        case "none":
            return str;
            break;
        case "utf8":
         return encodeURI(str);
            break;
        default:
         return escape(str);
            break;
        }
   }



/**
*     @desc: create and return  new line in tree
*     @type: private
*     @param: htmlObject - parent Node object
*     @param: node - item object
*     @topic: 2  
*/
   dhtmlXTreeObject.prototype._drawNewTr=function(htmlObject,node)
   {
      var tr =document.createElement('tr');
      var td1=document.createElement('td');
      var td2=document.createElement('td');
      td1.appendChild(document.createTextNode(" "));
       td2.colSpan=3;
      td2.appendChild(htmlObject);
      tr.appendChild(td1);  tr.appendChild(td2);
      return tr;
   };
/**
*     @desc: load tree from xml string
*     @type: public
*     @param: xmlString - XML string
*     @param: afterCall - function which will be called after xml loading
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.loadXMLString=function(xmlString,afterCall){
        var that=this;
      if ((this.onXLS)&&(!this.parsCount)) that.onXLS(that,null);
      this.xmlstate=1;

        if (afterCall) this.XMLLoader.waitCall=afterCall;
      this.XMLLoader.loadXMLString(xmlString);  };
/**
*     @desc: load tree from xml file
*     @type: public
*     @param: file - link to XML file
*     @param: afterCall - function which will be called after xml loading
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.loadXML=function(file,afterCall){
        var that=this;
      if ((this.onXLS)&&(!this.parsCount)) that.onXLS(that,this._ld_id);
        this._ld_id=null;
      this.xmlstate=1;
       this.XMLLoader=new dtmlXMLLoaderObject(this._parseXMLTree,this,true,this.no_cashe);

        if (afterCall) this.XMLLoader.waitCall=afterCall;
      this.XMLLoader.loadXML(file);  };
/**
*     @desc: create new child node
*     @type: private
*     @param: parentObject - parent node object
*     @param: itemId - new node id
*     @param: itemText - new node text
*     @param: itemActionHandler - function fired on node select event
*     @param: image1 - image for node without childrens;
*     @param: image2 - image for closed node;
*     @param: image3 - image for opened node
*     @param: optionStr - string of otions
*     @param: childs - node childs flag (for dynamical trees) (optional)
*     @param: beforeNode - node, after which new node will be inserted (optional)
*     @topic: 2
*/
   dhtmlXTreeObject.prototype._attachChildNode=function(parentObject,itemId,itemText,itemActionHandler,image1,image2,image3,optionStr,childs,beforeNode,afterNode){

         if (beforeNode) parentObject=beforeNode.parentObject;
         if (((parentObject.XMLload==0)&&(this.XMLsource))&&(!this.XMLloadingWarning))
         {
            parentObject.XMLload=1;
                this._loadDynXML(parentObject.id);

         }

         var Count=parentObject.childsCount;
         var Nodes=parentObject.childNodes;


            if (afterNode){
            if (afterNode.tr.previousSibling.previousSibling){
               beforeNode=afterNode.tr.previousSibling.nodem;
               }
            else
               optionStr=optionStr.replace("TOP","")+",TOP";
               }

         if (beforeNode)
            {
            var ik,jk;
            for (ik=0; ik<Count; ik++)
               if (Nodes[ik]==beforeNode)
               {
               for (jk=Count; jk!=ik; jk--)
                  Nodes[1+jk]=Nodes[jk];
               break;
               }
            ik++;
            Count=ik;
            }


         if ((!itemActionHandler)&&(this.aFunc))   itemActionHandler=this.aFunc;

         if (optionStr) {
             var tempStr=optionStr.split(",");
            for (var i=0; i<tempStr.length; i++)
            {
               switch(tempStr[i])
               {
                  case "TOP": if (parentObject.childsCount>0) { beforeNode=new Object; beforeNode.tr=parentObject.childNodes[0].tr.previousSibling; }
				  	 parentObject._has_top=true;
                     for  (ik=Count; ik>0; ik--)
                        Nodes[ik]=Nodes[ik-1];
                        Count=0;
                     break;
               }
            };
          };

         Nodes[Count]=new dhtmlXTreeItemObject(itemId,itemText,parentObject,this,itemActionHandler,1);
		 itemId = Nodes[Count].id;

         if(image1) Nodes[Count].images[0]=image1;
         if(image2) Nodes[Count].images[1]=image2;
         if(image3) Nodes[Count].images[2]=image3;

         parentObject.childsCount++;
         var tr=this._drawNewTr(Nodes[Count].htmlNode);
         if ((this.XMLloadingWarning)||(this._hAdI))
            Nodes[Count].htmlNode.parentNode.parentNode.style.display="none";


            if ((beforeNode)&&(beforeNode.tr.nextSibling))
               parentObject.htmlNode.childNodes[0].insertBefore(tr,beforeNode.tr.nextSibling);
            else
               if (this.parsingOn==parentObject.id){
                  this.parsedArray[this.parsedArray.length]=tr;
                        }
               else
                   parentObject.htmlNode.childNodes[0].appendChild(tr);


               if ((beforeNode)&&(!beforeNode.span)) beforeNode=null;

            if (this.XMLsource) if ((childs)&&(childs!=0)) Nodes[Count].XMLload=0; else Nodes[Count].XMLload=1;
            Nodes[Count].tr=tr;
            tr.nodem=Nodes[Count];

            if (parentObject.itemId==0)
                tr.childNodes[0].className="hiddenRow";

            if ((parentObject._r_logic)||(this._frbtr))
                    Nodes[Count].htmlNode.childNodes[0].childNodes[0].childNodes[1].childNodes[0].src=this.imPath+this.radioArray[0];


          if (optionStr) {
             var tempStr=optionStr.split(",");

            for (var i=0; i<tempStr.length; i++)
            {
               switch(tempStr[i])
               {
                     case "SELECT": this.selectItem(itemId,false); break;
                  case "CALL": this.selectItem(itemId,true);   break;
                  case "CHILD":  Nodes[Count].XMLload=0;  break;
                  case "CHECKED":
                     if (this.XMLloadingWarning)
                        this.setCheckList+=this.dlmtr+itemId;
                     else
                        this.setCheck(itemId,1);
                        break;
                  case "HCHECKED":
                        this._setCheck(Nodes[Count],"unsure");
                        break;                        
                  case "OPEN": Nodes[Count].openMe=1;  break;
               }
            };
          };

      if (!this.XMLloadingWarning)
      {
             if ((this._getOpenState(parentObject)<0)&&(!this._hAdI)) this.openItem(parentObject.id);

             if (beforeNode)
                {
             this._correctPlus(beforeNode);
             this._correctLine(beforeNode);
                }
             this._correctPlus(parentObject);
             this._correctLine(parentObject);
             this._correctPlus(Nodes[Count]);
             if (parentObject.childsCount>=2)
             {
                   this._correctPlus(Nodes[parentObject.childsCount-2]);
                   this._correctLine(Nodes[parentObject.childsCount-2]);
             }
             if (parentObject.childsCount!=2) this._correctPlus(Nodes[0]);

         if (this.tscheck) this._correctCheckStates(parentObject);

            if (this._onradh) {
				if (this.xmlstate==1){
					var old=this.onXLE;
					this.onXLE=function(id){ this._onradh(itemId); if (old) old(id); }
					}
				else
					this._onradh(itemId);
			}

      }
//#__pro_feature:01112006{
//#context_menu:01112006{
      if (this.cMenu) this.cMenu.setContextZone(Nodes[Count].span,Nodes[Count].id);
//#}
//#}
   return Nodes[Count];
};


//#__pro_feature:01112006{
//#context_menu:01112006{

/**
*     @desc: enable context menu
*     @param: menu - dhtmlXmenu object
*     @edition: Professional
*     @type: public
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableContextMenu=function(menu){  if (menu) this.cMenu=menu; };

/**
*     @desc: set context menu to individual nodes
*     @type: public
*     @param: itemId - node id
*     @param: cMenu - context menu object
*     @edition: Professional
*     @topic: 2
*/
dhtmlXTreeObject.prototype.setItemContextMenu=function(itemId,cMenu){
   var l=itemId.split(this.dlmtr);
   for (var i=0; i<l.length; i++)
      {
      var temp=this._globalIdStorageFind(l[i]);
      if (!temp) continue;
      cMenu.setContextZone(temp.span,temp.id);
      }
}

//#}
//#}

/**
*     @desc: create new node as a child to specified with parentId
*     @type: deprecated
*     @param: parentId - parent node id
*     @param: itemId - new node id
*     @param: itemText - new node text
*     @param: itemActionHandler - function fired on node select event (optional)
*     @param: image1 - image for node without childrens; (optional)
*     @param: image2 - image for closed node; (optional)
*     @param: image3 - image for opened node (optional)
*     @param: optionStr - options string (optional)            
*     @param: childs - node childs flag (for dynamical trees) (optional)
*     @topic: 2  
*/
   dhtmlXTreeObject.prototype.insertNewItem=function(parentId,itemId,itemText,itemActionHandler,image1,image2,image3,optionStr,childs){
      var parentObject=this._globalIdStorageFind(parentId);
      if (!parentObject) return (-1);
      var nodez=this._attachChildNode(parentObject,itemId,itemText,itemActionHandler,image1,image2,image3,optionStr,childs);
//#__pro_feature:01112006{
//#child_calc:01112006{
      if ((!this.XMLloadingWarning)&&(this.childCalc))  this._fixChildCountLabel(parentObject);
//#}
//#}
        return nodez;
   };
/**
*     @desc: create new node as a child to specified with parentId
*     @type: public
*     @param: parentId - parent node id
*     @param: itemId - new node id
*     @param: itemText - new node label
*     @param: itemActionHandler - function fired on node select event (optional)
*     @param: image1 - image for node without childrens; (optional)
*     @param: image2 - image for closed node; (optional)
*     @param: image3 - image for opened node (optional)
*     @param: optionStr - options string (optional)            
*     @param: childs - node children flag (for dynamical trees) (optional)
*     @topic: 2  
*/
   dhtmlXTreeObject.prototype.insertNewChild=function(parentId,itemId,itemText,itemActionHandler,image1,image2,image3,optionStr,childs){
      return this.insertNewItem(parentId,itemId,itemText,itemActionHandler,image1,image2,image3,optionStr,childs);
   }   
/**  
*     @desc: parse xml
*     @type: private
*     @param: dhtmlObject - jsTree object
*     @param: node - top XML node
*     @param: parentId - parent node id
*     @param: level - level of tree
*     @topic: 2
*/
   dhtmlXTreeObject.prototype._parseXMLTree=function(dhtmlObject,node,parentId,level,xml_obj,start){
    if (!xml_obj) xml_obj=dhtmlObject.XMLLoader;
    dhtmlObject.skipLock=true;
      if (!dhtmlObject.parsCount)  dhtmlObject.parsCount=1; else dhtmlObject.parsCount++;
      dhtmlObject.XMLloadingWarning=1;
      var nodeAskingCall="";
      if (!node) {
         node=xml_obj.getXMLTopNode("tree");
         parentId=node.getAttribute("id");
            if (node.getAttribute("radio"))
                 dhtmlObject.htmlNode._r_logic=true;
         dhtmlObject.parsingOn=parentId;
         dhtmlObject.parsedArray=new Array();
         dhtmlObject.setCheckList="";
         }

      var temp=dhtmlObject._globalIdStorageFind(parentId);

        if ((temp.childsCount)&&(!start)&&(!dhtmlObject._edsbps)&&(!temp._has_top))
            var preNode=temp.childNodes[temp.childsCount-1];
        else
            var preNode=0;

      if (node.getAttribute("order"))
                 dhtmlObject._reorderXMLBranch(node);

        var npl=0;

      for(var i=start||0; i<node.childNodes.length; i++)
      {

           if ((node.childNodes[i].nodeType==1)&&(node.childNodes[i].tagName == "item"))
         {
                temp.XMLload=1;
                if ((dhtmlObject._epgps)&&(dhtmlObject._epgpsC==npl)){
                    this._setNextPageSign(temp,npl+1*(start||0),level,node);
                    break;
                }

            var nodx=node.childNodes[i];
            var name=nodx.getAttribute("text");
//#__pro_feature:01112006{
//#data_from_xml:01112006{
			if ((name===null)||(typeof(name)=="unknown"))
				for (var ci=0; ci<nodx.childNodes.length; ci++)
					if (nodx.childNodes[ci].tagName=="itemtext"){
						name=nodx.childNodes[ci].firstChild.data;
						break;
					}
//#}
//#}
              var cId=nodx.getAttribute("id");

              if ((typeof(dhtmlObject.waitUpdateXML)=="object")&&(!dhtmlObject.waitUpdateXML[cId])){
                dhtmlObject._parseXMLTree(dhtmlObject,node.childNodes[i],cId,1,xml_obj);
			  	continue;
				}

              var im0=nodx.getAttribute("im0");
              var im1=nodx.getAttribute("im1");
              var im2=nodx.getAttribute("im2");
            
              var aColor=nodx.getAttribute("aCol");
              var sColor=nodx.getAttribute("sCol");
            
              var chd=nodx.getAttribute("child");

            var imw=nodx.getAttribute("imwidth");
              var imh=nodx.getAttribute("imheight");

              var atop=nodx.getAttribute("top");
              var aradio=nodx.getAttribute("radio");
                var topoffset=nodx.getAttribute("topoffset");
              var aopen=nodx.getAttribute("open"); //can be disabled, because we have another code for open via Xpaths
              var aselect=nodx.getAttribute("select");
              var acall=nodx.getAttribute("call");
              var achecked=nodx.getAttribute("checked");
              var closeable=nodx.getAttribute("closeable");
            var tooltip = nodx.getAttribute("tooltip");
            var nocheckbox = nodx.getAttribute("nocheckbox");
            var disheckbox = nodx.getAttribute("disabled");
            var style = nodx.getAttribute("style");

            var locked = nodx.getAttribute("locked");

                  var zST="";
                  if (aselect) zST+=",SELECT";
                  if (atop) zST+=",TOP";
                  //if (acall) zST+=",CALL";
                  if (acall) nodeAskingCall=cId;

                  if (achecked==-1) zST+=",HCHECKED";
                     else if (achecked) zST+=",CHECKED";
                  if (aopen) zST+=",OPEN";

    	          if (dhtmlObject.waitUpdateXML){
				  		if (dhtmlObject._globalIdStorageFind(cId))
	    	            	var newNode=dhtmlObject.updateItem(cId,name,im0,im1,im2,achecked);
						else{
							if (npl==0) zST+=",TOP";
							else preNode=temp.childNodes[npl];

		                    var newNode=dhtmlObject._attachChildNode(temp,cId,name,0,im0,im1,im2,zST,chd,0,preNode);
							preNode=null;
						}
					 }
                  else
                     var newNode=dhtmlObject._attachChildNode(temp,cId,name,0,im0,im1,im2,zST,chd,0,preNode);
                  if (tooltip)
//#__pro_feature:01112006{
//#dhtmlxtootip:01112006{
				  	  if (dhtmlObject._dhxTT) dhtmlxTooltip.setTooltip(newNode.span.parentNode,tooltip);
					  else
//#}
//#}
					  	newNode.span.parentNode.title=tooltip;
                  if (style)
                            if (newNode.span.style.cssText)
                                newNode.span.style.cssText+=(";"+style);
                            else
                                newNode.span.setAttribute("style",newNode.span.getAttribute("style")+"; "+style);

                        if (aradio) newNode._r_logic=true;

                  if (nocheckbox){
                     newNode.span.parentNode.previousSibling.previousSibling.childNodes[0].style.display='none';
                     newNode.nocheckbox=true;
                  }
                        if (disheckbox){
                            if (achecked!=null) dhtmlObject._setCheck(newNode,convertStringToBoolean(achecked));
                            dhtmlObject.disableCheckbox(newNode,1);
                            }


                  newNode._acc=chd||0;

                  if (dhtmlObject.parserExtension) dhtmlObject.parserExtension._parseExtension(node.childNodes[i],dhtmlObject.parserExtension,cId,parentId);

                  dhtmlObject.setItemColor(newNode,aColor,sColor);
                        if (locked=="1")    dhtmlObject._lockItem(newNode,true,true);

                  if ((imw)||(imh))   dhtmlObject.setIconSize(imw,imh,newNode);
                  if ((closeable=="0")||(closeable=="1"))  dhtmlObject.setItemCloseable(newNode,closeable);
                  var zcall="";
                        if (topoffset) this.setItemTopOffset(newNode,topoffset);
                  if (!dhtmlObject.slowParse)
                    zcall=dhtmlObject._parseXMLTree(dhtmlObject,node.childNodes[i],cId,1,xml_obj);
//#__pro_feature:01112006{
//#smart_parsing:01112006{
                  else{
                   if (node.childNodes[i].childNodes.length>0) {
                      for (var a=0; a<node.childNodes[i].childNodes.length; a++)
                        if (node.childNodes[i].childNodes[a].tagName=="item")
                           newNode.unParsed=node.childNodes[i];
                                else
                                    dhtmlObject.checkUserData(node.childNodes[i].childNodes[a],newNode.id);
                     }
                   }
//#}
//#}

                  if (zcall!="") nodeAskingCall=zcall;




//#__pro_feature:01112006{
//#distributed_load:01112006{
              if ((dhtmlObject._edsbps)&&(npl==dhtmlObject._edsbpsC)){
                dhtmlObject._distributedStart(node,i+1,parentId,level,temp.childsCount);
                break;
              }
//#}
//#}
              npl++;
         }
         else
                 dhtmlObject.checkUserData(node.childNodes[i],parentId);
      };

      if (!level) {
         if (dhtmlObject.waitUpdateXML){
            dhtmlObject.waitUpdateXML=false;
			for (var i=temp.childsCount-1; i>=0; i--)
				if (temp.childNodes[i]._dmark)
					dhtmlObject.deleteItem(temp.childNodes[i].id);
			}

         var parsedNodeTop=dhtmlObject._globalIdStorageFind(dhtmlObject.parsingOn);

         for (var i=0; i<dhtmlObject.parsedArray.length; i++)
               parsedNodeTop.htmlNode.childNodes[0].appendChild(dhtmlObject.parsedArray[i]);

         dhtmlObject.lastLoadedXMLId=parentId;
         dhtmlObject.XMLloadingWarning=0;

         var chArr=dhtmlObject.setCheckList.split(dhtmlObject.dlmtr);
         for (var n=0; n<chArr.length; n++)
            if (chArr[n]) dhtmlObject.setCheck(chArr[n],1);

               if ((dhtmlObject.XMLsource)&&(dhtmlObject.tscheck)&&(dhtmlObject.smcheck)&&(temp.id!=dhtmlObject.rootId)){
                if (temp.checkstate===0)
                    dhtmlObject._setSubChecked(0,temp);
                else if (temp.checkstate===1)
                    dhtmlObject._setSubChecked(1,temp);
            }


         //special realization for IE 5.5 (should avoid IE crash for autoloading. In other cases probably will not help)
         if(navigator.appVersion.indexOf("MSIE")!=-1 && navigator.appVersion.indexOf("5.5")!=-1){
            window.setTimeout(function(){dhtmlObject._redrawFrom(dhtmlObject,null,start)},10);
         }else{
            dhtmlObject._redrawFrom(dhtmlObject,null,start)
         }

         if (nodeAskingCall!="")   dhtmlObject.selectItem(nodeAskingCall,true);

      }


      if (dhtmlObject.parsCount==1) {
//#__pro_feature:01112006{
//#smart_parsing:01112006{
          if ((dhtmlObject.slowParse)&&(dhtmlObject.parsingOn==dhtmlObject.rootId))
            {
            var nodelist=xml_obj.doXPath("//item[@open]",xml_obj.xmlDoc.responseXML);
            for (var i=0; i<nodelist.length; i++)
                dhtmlObject.openItem(nodelist[i].getAttribute("id"));
            }
//#}
//#}
         dhtmlObject.parsingOn=null;
         if ((!dhtmlObject._edsbps)||(!dhtmlObject._edsbpsA.length)){
                if (dhtmlObject.onXLE)
                 window.setTimeout( function(){dhtmlObject.onXLE(dhtmlObject,parentId)},1);
                dhtmlObject.xmlstate=0;
                }
             dhtmlObject.skipLock=false;
         }
      dhtmlObject.parsCount--;

//#__pro_feature:01112006{
//#distributed_load:01112006{
        if (dhtmlObject._edsbps) window.setTimeout(function(){ dhtmlObject._distributedStep(parentId); },dhtmlObject._edsbpsD);
//#}
//#}

        if ((dhtmlObject._epgps)&&(start))
            this._setPrevPageSign(temp,(start||0),level,node);

      return nodeAskingCall;
   };


  dhtmlXTreeObject.prototype.checkUserData=function(node,parentId){
      if ((node.nodeType==1)&&(node.tagName == "userdata"))
      {
         var name=node.getAttribute("name");
            if ((name)&&(node.childNodes[0]))
               this.setUserData(parentId,name,node.childNodes[0].data);
      }
  }




/**  
*     @desc: reset tree images from selected level
*     @type: private
*     @param: dhtmlObject - tree
*     @param: itemObject - current item
*     @topic: 6
*/
   dhtmlXTreeObject.prototype._redrawFrom=function(dhtmlObject,itemObject,start,visMode){
      if (!itemObject) {
      var tempx=dhtmlObject._globalIdStorageFind(dhtmlObject.lastLoadedXMLId);
      dhtmlObject.lastLoadedXMLId=-1;
      if (!tempx) return 0;
      }
      else tempx=itemObject;
      var acc=0;

      for (var i=(start?start-1:0); i<tempx.childsCount; i++)
      {
         if ((!itemObject)||(visMode==1)) tempx.childNodes[i].htmlNode.parentNode.parentNode.style.display="";
         if (tempx.childNodes[i].openMe==1)
            {
            this._openItem(tempx.childNodes[i]);
            tempx.childNodes[i].openMe=0;
            }

         dhtmlObject._redrawFrom(dhtmlObject,tempx.childNodes[i]);
//#__pro_feature:01112006{
//#child_calc:01112006{
      if (this.childCalc!=null){

      if ((tempx.childNodes[i].unParsed)||((!tempx.childNodes[i].XMLload)&&(this.XMLsource)))
      {

         if (tempx.childNodes[i]._acc)
         tempx.childNodes[i].span.innerHTML=tempx.childNodes[i].label+this.htmlcA+tempx.childNodes[i]._acc+this.htmlcB;
         else
         tempx.childNodes[i].span.innerHTML=tempx.childNodes[i].label;
      }
         if ((tempx.childNodes[i].childNodes.length)&&(this.childCalc))
         {
            if (this.childCalc==1)
               {
               tempx.childNodes[i].span.innerHTML=tempx.childNodes[i].label+this.htmlcA+tempx.childNodes[i].childsCount+this.htmlcB;
               }
            if (this.childCalc==2)
               {
               var zCount=tempx.childNodes[i].childsCount-(tempx.childNodes[i].pureChilds||0);
               if (zCount)
                  tempx.childNodes[i].span.innerHTML=tempx.childNodes[i].label+this.htmlcA+zCount+this.htmlcB;
               if (tempx.pureChilds) tempx.pureChilds++; else tempx.pureChilds=1;
               }
            if (this.childCalc==3)
               {
               tempx.childNodes[i].span.innerHTML=tempx.childNodes[i].label+this.htmlcA+tempx.childNodes[i]._acc+this.htmlcB;
               }
            if (this.childCalc==4)
               {
               var zCount=tempx.childNodes[i]._acc;
               if (zCount)
                  tempx.childNodes[i].span.innerHTML=tempx.childNodes[i].label+this.htmlcA+zCount+this.htmlcB;
               }               
         }
            else if (this.childCalc==4)   {
               acc++;
               }   
            
         acc+=tempx.childNodes[i]._acc;
         
         if (this.childCalc==3){
            acc++;
         }

         }
//#}
//#}

      };

      if ((!tempx.unParsed)&&((tempx.XMLload)||(!this.XMLsource)))
      tempx._acc=acc;
      dhtmlObject._correctLine(tempx);
      dhtmlObject._correctPlus(tempx);
//#__pro_feature:01112006{
//#child_calc:01112006{
      if ((this.childCalc)&&(!itemObject)) dhtmlObject._fixChildCountLabel(tempx);
//#}
//#}
   };

/**
*     @desc: create and return main html element of tree
*     @type: private
*     @topic: 0  
*/
   dhtmlXTreeObject.prototype._createSelf=function(){
      var div=document.createElement('div');
      div.className="containerTableStyle";
      div.style.width=this.width;
      div.style.height=this.height;
      this.parentObject.appendChild(div);
      return div;
   };

/**
*     @desc: collapse target node
*     @type: private
*     @param: itemObject - item object
*     @topic: 4  
*/
   dhtmlXTreeObject.prototype._xcloseAll=function(itemObject)
   {
        if (itemObject.unParsed) return;
      if (this.rootId!=itemObject.id) {
          var Nodes=itemObject.htmlNode.childNodes[0].childNodes;
            var Count=Nodes.length;

          for (var i=1; i<Count; i++)
             Nodes[i].style.display="none";

          this._correctPlus(itemObject);
      }

       for (var i=0; i<itemObject.childsCount; i++)
            if (itemObject.childNodes[i].childsCount)
             this._xcloseAll(itemObject.childNodes[i]);
   };
/**
*     @desc: expand target node
*     @type: private
*     @param: itemObject - item object
*     @topic: 4
*/      
   dhtmlXTreeObject.prototype._xopenAll=function(itemObject)
   {
      this._HideShow(itemObject,2);
      for (var i=0; i<itemObject.childsCount; i++)
         this._xopenAll(itemObject.childNodes[i]);
   };      
/**  
*     @desc: set correct tree-line and node images
*     @type: private
*     @param: itemObject - item object
*     @topic: 6  
*/
   dhtmlXTreeObject.prototype._correctPlus=function(itemObject){
        var imsrc=itemObject.htmlNode.childNodes[0].childNodes[0].childNodes[0].lastChild;
        var imsrc2=itemObject.htmlNode.childNodes[0].childNodes[0].childNodes[2].childNodes[0];

       var workArray=this.lineArray;
      if ((this.XMLsource)&&(!itemObject.XMLload))
      {
            var workArray=this.plusArray;
            imsrc2.src=this.imPath+itemObject.images[2];
                if (this._txtimg) return (imsrc.innerHTML="[+]");
      }
      else
      if ((itemObject.childsCount)||(itemObject.unParsed))
      {
         if ((itemObject.htmlNode.childNodes[0].childNodes[1])&&( itemObject.htmlNode.childNodes[0].childNodes[1].style.display!="none" ))
            {
            if (!itemObject.wsign) var workArray=this.minusArray;
            imsrc2.src=this.imPath+itemObject.images[1];
                if (this._txtimg) return (imsrc.innerHTML="[-]");
            }
         else
            {
            if (!itemObject.wsign) var workArray=this.plusArray;
            imsrc2.src=this.imPath+itemObject.images[2];
                if (this._txtimg) return (imsrc.innerHTML="[+]");
            }
      }
      else
      {
         imsrc2.src=this.imPath+itemObject.images[0];
       }


      var tempNum=2;
      if (!itemObject.treeNod.treeLinesOn) imsrc.src=this.imPath+workArray[3];
      else {
          if (itemObject.parentObject) tempNum=this._getCountStatus(itemObject.id,itemObject.parentObject);
         imsrc.src=this.imPath+workArray[tempNum];
         }
   };

/**
*     @desc: set correct tree-line images
*     @type: private
*     @param: itemObject - item object
*     @topic: 6
*/
   dhtmlXTreeObject.prototype._correctLine=function(itemObject){
      var sNode=itemObject.parentObject;
      if (sNode)
         if ((this._getLineStatus(itemObject.id,sNode)==0)||(!this.treeLinesOn))
               for(var i=1; i<=itemObject.childsCount; i++)
                                 {
                  itemObject.htmlNode.childNodes[0].childNodes[i].childNodes[0].style.backgroundImage="";
                   itemObject.htmlNode.childNodes[0].childNodes[i].childNodes[0].style.backgroundRepeat="";
                                  }
            else
               for(var i=1; i<=itemObject.childsCount; i++)
                           {
                itemObject.htmlNode.childNodes[0].childNodes[i].childNodes[0].style.backgroundImage="url("+this.imPath+this.lineArray[5]+")";
               itemObject.htmlNode.childNodes[0].childNodes[i].childNodes[0].style.backgroundRepeat="repeat-y";
                   }
   };
/**
*     @desc: return type of node
*     @type: private
*     @param: itemId - item id
*     @param: itemObject - parent node object
*     @topic: 6
*/
   dhtmlXTreeObject.prototype._getCountStatus=function(itemId,itemObject){

      if (itemObject.childsCount<=1) { if (itemObject.id==this.rootId) return 4; else  return 0; }

      if (itemObject.childNodes[0].id==itemId) if (!itemObject.id) return 2; else return 1;
      if (itemObject.childNodes[itemObject.childsCount-1].id==itemId) return 0;

      return 1;
   };
/**
*     @desc: return type of node
*     @type: private
*     @param: itemId - node id        
*     @param: itemObject - parent node object
*     @topic: 6
*/      
   dhtmlXTreeObject.prototype._getLineStatus =function(itemId,itemObject){
         if (itemObject.childNodes[itemObject.childsCount-1].id==itemId) return 0;
         return 1;
      }

/**  
*     @desc: open/close node 
*     @type: private
*     @param: itemObject - node object        
*     @param: mode - open/close mode [1-close 2-open](optional)
*     @topic: 6
*/      
   dhtmlXTreeObject.prototype._HideShow=function(itemObject,mode){
      if ((this.XMLsource)&&(!itemObject.XMLload)) {
            if (mode==1) return; //close for not loaded node - ignore it
            itemObject.XMLload=1;
            this._loadDynXML(itemObject.id);
            return; };
//#__pro_feature:01112006{
//#smart_parsing:01112006{
        if (itemObject.unParsed) this.reParse(itemObject);
//#}
//#}
      var Nodes=itemObject.htmlNode.childNodes[0].childNodes; var Count=Nodes.length;
      if (Count>1){
         if ( ( (Nodes[1].style.display!="none") || (mode==1) ) && (mode!=2) ) {
//nb:solves standard doctype prb in IE
          this.allTree.childNodes[0].border = "1";
          this.allTree.childNodes[0].border = "0";
         nodestyle="none";
         }
         else  nodestyle="";

      for (var i=1; i<Count; i++)
         Nodes[i].style.display=nodestyle;
      }
      this._correctPlus(itemObject);
   }

/**
*     @desc: return node state
*     @type: private
*     @param: itemObject - node object        
*     @topic: 6
*/      
   dhtmlXTreeObject.prototype._getOpenState=function(itemObject){
      var z=itemObject.htmlNode.childNodes[0].childNodes;
      if (z.length<=1) return 0;
      if    (z[1].style.display!="none") return 1;
      else return -1;
   }

   
   
/**  
*     @desc: ondblclick item  event handler
*     @type: private
*     @topic: 0  
*/      
   dhtmlXTreeObject.prototype.onRowClick2=function(){
   if    (this.parentObject.treeNod.dblclickFuncHandler) if (!this.parentObject.treeNod.dblclickFuncHandler(this.parentObject.id,this.parentObject.treeNod)) return 0;
      if ((this.parentObject.closeble)&&(this.parentObject.closeble!="0"))
         this.parentObject.treeNod._HideShow(this.parentObject);
      else
         this.parentObject.treeNod._HideShow(this.parentObject,2);
   };
/**
*     @desc: onclick item event handler
*     @type: private
*     @topic: 0  
*/
   dhtmlXTreeObject.prototype.onRowClick=function(){
    var that=this.parentObject.treeNod;
   if    (that._spnFH) if (!that._spnFH(this.parentObject.id,that._getOpenState(this.parentObject))) return 0;
      if ((this.parentObject.closeble)&&(this.parentObject.closeble!="0"))
         that._HideShow(this.parentObject);
      else
         that._HideShow(this.parentObject,2);

//#on_open_end_event:11052006{
   if    (that._epnFH)
           if (!that.xmlstate)
                that._epnFH(this.parentObject.id,that._getOpenState(this.parentObject));
            else{
                that._oie_onXLE=that.onXLE;
                that.onXLE=that._epnFHe;
                }
//#}
   };
//#on_open_end_event:11052006{
      dhtmlXTreeObject.prototype._epnFHe=function(that,id){
        if (that._epnFH)
            that._epnFH(id,that.getOpenState(id));
        that.onXLE=that._oie_onXLE;
        if (that.onXLE) that.onXLE(that,id);
    }

//#}

/**
*     @desc: onclick item image event handler
*     @type: private
*     @edition: Professional
*     @topic: 0  
*/
   dhtmlXTreeObject.prototype.onRowClickDown=function(e){
            e=e||window.event;
         var that=this.parentObject.treeNod;
         that._selectItem(this.parentObject,e);
      };


/*****
SELECTION
*****/

/**
*     @desc: retun selected item id
*     @type: public
*     @return: id of selected item
*     @topic: 1
*/
   dhtmlXTreeObject.prototype.getSelectedItemId=function()
   {
        var str=new Array();
        for (var i=0; i<this._selected.length; i++) str[i]=this._selected[i].id;
      return (str.join(this.dlmtr));
   };

/**
*     @desc: visual select item in tree
*     @type: private
*     @param: node - tree item object
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype._selectItem=function(node,e){
//#__pro_feature:01112006{
//#multiselect:01112006{
        if ((!this._amsel)||(!e)||((!e.ctrlKey)&&(!e.shiftKey)))
//#}
//#}
            this._unselectItems();
//#__pro_feature:01112006{
//#multiselect:01112006{
            if ((node.i_sel)&&(this._amsel)&&(e)&&(e.ctrlKey))
                this._unselectItem(node);
            else
            if ((!node.i_sel)&&((!this._amselS)||(this._selected.length==0)||(this._selected[0].parentObject==node.parentObject)))
                if ((this._amsel)&&(e)&&(e.shiftKey)&&(this._selected.length!=0)&&(this._selected[this._selected.length-1].parentObject==node.parentObject)){
                    var a=this._getIndex(this._selected[this._selected.length-1]);
                    var b=this._getIndex(node);
                    if (b<a) { var c=a; a=b; b=c; }
                    for (var i=a; i<=b; i++)
                        if (!node.parentObject.childNodes[i].i_sel)
                            this._markItem(node.parentObject.childNodes[i]);
                    }
                else
//#}
//#}
					this._markItem(node);
         }
    dhtmlXTreeObject.prototype._markItem=function(node){
              if (node.scolor)  node.span.style.color=node.scolor;
              node.span.className="selectedTreeRow";
             node.i_sel=true;
             this._selected[this._selected.length]=node;
    }

/**
*     @desc: retun node index in childs collection by Id
*     @type: public
*     @param: itemId - node id
*     @return: node index
*     @topic: 2
*/
   dhtmlXTreeObject.prototype.getIndexById=function(itemId){
         var z=this._globalIdStorageFind(itemId);
         if (!z) return null;
         return this._getIndex(z);
   };
   dhtmlXTreeObject.prototype._getIndex=function(w){
        var z=w.parentObject;
        for (var i=0; i<z.childsCount; i++)
            if (z.childNodes[i]==w) return i;
   };





/**
*     @desc: visual unselect item in tree
*     @type: private
*     @param: node - tree item object
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype._unselectItem=function(node){
        if ((node)&&(node.i_sel))
            {

          node.span.className="standartTreeRow";
          if (node.acolor)  node.span.style.color=node.acolor;
            node.i_sel=false;
            for (var i=0; i<this._selected.length; i++)
                    if (!this._selected[i].i_sel) {
                        this._selected.splice(i,1);
                        break;
                 }

            }
       }

/**
*     @desc: visual unselect item in tree
*     @type: private
*     @param: node - tree item object
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype._unselectItems=function(){
      for (var i=0; i<this._selected.length; i++){
            var node=this._selected[i];
         node.span.className="standartTreeRow";
          if (node.acolor)  node.span.style.color=node.acolor;
         node.i_sel=false;
         }
         this._selected=new Array();
       }


/**  
*     @desc: select node text event handler
*     @type: private
*     @param: e - event object
*     @param: htmlObject - node object     
*     @param: mode - if false - call onSelect event
*     @topic: 0  
*/
   dhtmlXTreeObject.prototype.onRowSelect=function(e,htmlObject,mode){
      e=e||window.event;

        var obj=this.parentObject;
      if (htmlObject) obj=htmlObject.parentObject;
        var that=obj.treeNod;

        var lastId=that.getSelectedItemId();
		if ((!e)||(!e.skipUnSel))
	        that._selectItem(obj,e);

      if (!mode) {
         if ((e)&&(e.button==2)&&(that.arFunc)) that.arFunc(obj.id,e);
         if (obj.actionHandler) obj.actionHandler(obj.id,lastId);
         }
   };




   
/**
*     @desc: fix checkbox state
*     @type: private
*     @topic: 0
*/
dhtmlXTreeObject.prototype._correctCheckStates=function(dhtmlObject){
   if (!this.tscheck) return;
   if (dhtmlObject.id==this.rootId) return;
   //calculate state
   var act=dhtmlObject.childNodes;
   var flag1=0; var flag2=0;
   if (dhtmlObject.childsCount==0) return;
   for (var i=0; i<dhtmlObject.childsCount; i++){
   	  if (act[i].dscheck) continue;
      if (act[i].checkstate==0) flag1=1;
      else if (act[i].checkstate==1) flag2=1;
         else { flag1=1; flag2=1; break; }
		 }

   if ((flag1)&&(flag2)) this._setCheck(dhtmlObject,"unsure");
   else if (flag1)  this._setCheck(dhtmlObject,false);
      else  this._setCheck(dhtmlObject,true);

      this._correctCheckStates(dhtmlObject.parentObject);
}

/**  
*     @desc: checbox select action
*     @type: private
*     @topic: 0
*/   
   dhtmlXTreeObject.prototype.onCheckBoxClick=function(e)   {
      if (this.parentObject.dscheck) return true;
      if (this.treeNod.tscheck)
         if (this.parentObject.checkstate==1) this.treeNod._setSubChecked(false,this.parentObject);
         else this.treeNod._setSubChecked(true,this.parentObject);
      else
         if (this.parentObject.checkstate==1) this.treeNod._setCheck(this.parentObject,false);
         else this.treeNod._setCheck(this.parentObject,true);
      this.treeNod._correctCheckStates(this.parentObject.parentObject);

      if (this.treeNod.checkFuncHandler) return (this.treeNod.checkFuncHandler(this.parentObject.id,this.parentObject.checkstate));
      else return true;
   };
/**
*     @desc: create HTML elements for tree node
*     @type: private
*     @param: acheck - enable/disable checkbox
*     @param: itemObject - item object
*     @param: mode - mode
*     @topic: 0
*/
   dhtmlXTreeObject.prototype._createItem=function(acheck,itemObject,mode){
      var table=document.createElement('table');
         table.cellSpacing=0;table.cellPadding=0;
         table.border=0;
          if (this.hfMode) table.style.tableLayout="fixed";
         table.style.margin=0; table.style.padding=0;

      var tbody=document.createElement('tbody');
      var tr=document.createElement('tr');
//            tr.height="16px"; tr.style.overflow="hidden";
      var td1=document.createElement('td');
         td1.className="standartTreeImage";

            if (this._txtimg){
         var img0=document.createElement("div");
            td1.appendChild(img0);
                img0.className="dhx_tree_textSign";
            }
            else
            {
         var img0=document.createElement((itemObject.id==this.rootId)?"div":"img");
            img0.border="0"; //img0.src='treeGfx/line1.gif';
            if (itemObject.id!=this.rootId) img0.align="absmiddle";
            td1.appendChild(img0); img0.style.padding=0; img0.style.margin=0;
            }

      var td11=document.createElement('td');
//         var inp=document.createElement("input");            inp.type="checkbox"; inp.style.width="12px"; inp.style.height="12px";
         var inp=document.createElement(((this.cBROf)||(itemObject.id==this.rootId))?"div":"img");
         inp.checked=0; inp.src=this.imPath+this.checkArray[0]; inp.style.width="16px"; inp.style.height="16px";
            //can cause problems with hide/show check
         if (!acheck) (((_isOpera)||(_isKHTML))?td11:inp).style.display="none";

         // td11.className="standartTreeImage";
               //if (acheck)
            td11.appendChild(inp);
            if ((!this.cBROf)&&(itemObject.id!=this.rootId)) inp.align="absmiddle";
            inp.onclick=this.onCheckBoxClick;
            inp.treeNod=this;
            inp.parentObject=itemObject;
            td11.width="20px";

      var td12=document.createElement('td');
         td12.className="standartTreeImage";
         var img=document.createElement((itemObject.id==this.rootId)?"div":"img"); img.onmousedown=this._preventNsDrag; img.ondragstart=this._preventNsDrag;
            img.border="0";
            if (this._aimgs){
               img.parentObject=itemObject;
               if (itemObject.id!=this.rootId) img.align="absmiddle";
               img.onclick=this.onRowSelect; }
            if (!mode) img.src=this.imPath+this.imageArray[0];
            td12.appendChild(img); img.style.padding=0; img.style.margin=0;
         if (this.timgen)
            {  img.style.width=this.def_img_x; img.style.height=this.def_img_y; }
         else
            {
                img.style.width="0px"; img.style.height="0px";
                if (_isOpera)    td12.style.display="none";
                }


      var td2=document.createElement('td');
         td2.className="standartTreeRow";

            itemObject.span=document.createElement('span');
            itemObject.span.className="standartTreeRow";
            if (this.mlitems) {
				itemObject.span.style.width=this.mlitems;
			   //	if (!_isIE)
					itemObject.span.style.display="block";
				}
            else td2.noWrap=true;
                if (!_isKHTML) td2.style.width="100%";

//      itemObject.span.appendChild(document.createTextNode(itemObject.label));
         itemObject.span.innerHTML=itemObject.label;
      td2.appendChild(itemObject.span);
      td2.parentObject=itemObject;        td1.parentObject=itemObject;
      td2.onclick=this.onRowSelect; td1.onclick=this.onRowClick; td2.ondblclick=this.onRowClick2;
      if (this.ettip)
//#__pro_feature:01112006{
//#dhtmlxtootip:01112006{
	  	  if (this._dhxTT) dhtmlxTooltip.setTooltip(td2,itemObject.label);
		  else
//#}
//#}
		  	td2.title=itemObject.label;

      if (this.dragAndDropOff) {
         if (this._aimgs) { this.dragger.addDraggableItem(td12,this); td12.parentObject=itemObject; }
         this.dragger.addDraggableItem(td2,this);
         }

      itemObject.span.style.paddingLeft="5px";      itemObject.span.style.paddingRight="5px";   td2.style.verticalAlign="";
       td2.style.fontSize="10pt";       td2.style.cursor=this.style_pointer;
      tr.appendChild(td1);            tr.appendChild(td11);            tr.appendChild(td12);
      tr.appendChild(td2);
      tbody.appendChild(tr);
      table.appendChild(tbody);
	  if (this.ehlt){//highlighting
		tr.onmousemove=this._itemMouseIn;
        tr[(_isIE)?"onmouseleave":"onmouseout"]=this._itemMouseOut;
      }

      if (this.arFunc){
         //disable context handler
         tr.oncontextmenu=function(e){ this.childNodes[0].parentObject.treeNod.arFunc(this.childNodes[0].parentObject.id,(e||event)); return false; };
      }
      return table;
   };
   

/**  
*     @desc: set path to image directory
*     @param: newPath - path to image directory
*     @type: public
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.setImagePath=function( newPath ){ this.imPath=newPath; };

//#__pro_feature:01112006{
//#child_calc:01112006{

/**
*     @desc: return count of leafs
*     @param: itemNode -  node object
*     @type: private
*     @edition: Professional
*     @topic: 4
*/
   dhtmlXTreeObject.prototype._getLeafCount=function(itemNode){
      var a=0;
      for (var b=0; b<itemNode.childsCount; b++)
         if (itemNode.childNodes[b].childsCount==0) a++;
      return a;
   }

/**
*     @desc: get value of child counter (child counter must be enabled)
*     @type: private
*     @param: itemId - id of selected item
*     @edition: Professional
*     @return: counter value (related to counter mode)
*     @topic: 6
*/
   dhtmlXTreeObject.prototype._getChildCounterValue=function(itemId){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      if ((temp.unParsed)||((!temp.XMLload)&&(this.XMLsource)))
      return temp._acc
      switch(this.childCalc)
      {
         case 1: return temp.childsCount; break;
         case 2: return this._getLeafCount(temp); break;
         case 3: return temp._acc; break;
         case 4: return temp._acc; break;
      }
   }

  /**
*     @desc: fix node child counter
*     @param: itemNode -  node object
*     @type: private
*     @edition: Professional
*     @topic: 4
*/
   dhtmlXTreeObject.prototype._fixChildCountLabel=function(itemNode,index){
      if (this.childCalc==null) return;
      if ((itemNode.unParsed)||((!itemNode.XMLload)&&(this.XMLsource)))
      {
         if (itemNode._acc)
         itemNode.span.innerHTML=itemNode.label+this.htmlcA+itemNode._acc+this.htmlcB;
         else
         itemNode.span.innerHTML=itemNode.label;

      return;
      }

      switch(this.childCalc){
         case 1:
            if (itemNode.childsCount!=0)
               itemNode.span.innerHTML=itemNode.label+this.htmlcA+itemNode.childsCount+this.htmlcB;
            else itemNode.span.innerHTML=itemNode.label;
            break;
         case 2:
            var z=this._getLeafCount(itemNode);
            if (z!=0)
               itemNode.span.innerHTML=itemNode.label+this.htmlcA+z+this.htmlcB;
            else itemNode.span.innerHTML=itemNode.label;
            break;
         case 3:
            if (itemNode.childsCount!=0)
               {
               var bcc=0;
               for (var a=0; a<itemNode.childsCount; a++)   {
                  if (!itemNode.childNodes[a]._acc) itemNode.childNodes[a]._acc=0;
                  bcc+=itemNode.childNodes[a]._acc*1;      }
                  bcc+=itemNode.childsCount*1;

               itemNode.span.innerHTML=itemNode.label+this.htmlcA+bcc+this.htmlcB;
               itemNode._acc=bcc;
               }
            else { itemNode.span.innerHTML=itemNode.label;   itemNode._acc=1; }
            if ((itemNode.parentObject)&&(itemNode.parentObject!=this.htmlNode))
               this._fixChildCountLabel(itemNode.parentObject);
            break;
         case 4:
            if (itemNode.childsCount!=0)
               {
               var bcc=0;
               for (var a=0; a<itemNode.childsCount; a++)   {
                  if (!itemNode.childNodes[a]._acc) itemNode.childNodes[a]._acc=1;
                  bcc+=itemNode.childNodes[a]._acc*1;      }

               itemNode.span.innerHTML=itemNode.label+this.htmlcA+bcc+this.htmlcB;
               itemNode._acc=bcc;
               }
            else { itemNode.span.innerHTML=itemNode.label;   itemNode._acc=1; }
            if ((itemNode.parentObject)&&(itemNode.parentObject!=this.htmlNode))
               this._fixChildCountLabel(itemNode.parentObject);
            break;
      }
   }

/**
*     @desc: set child calculation mode
*     @param: mode - mode name as string . Possible values: child - child, no recursive; leafs - child without subchilds, no recursive;  ,childrec - child, recursive; leafsrec - child without subchilds, recursive; disabled (disabled by default)
*     @type: public
*     @edition: Professional
*     @topic: 0
*/ 
   dhtmlXTreeObject.prototype.setChildCalcMode=function( mode ){
      switch(mode){
         case "child": this.childCalc=1; break;
         case "leafs": this.childCalc=2; break;
         case "childrec": this.childCalc=3; break;
         case "leafsrec": this.childCalc=4; break;
         case "disabled": this.childCalc=null; break;
         default: this.childCalc=4;
      }
    }
/**  
*     @desc: set child calculation prefix and postfix
*     @param: htmlA - postfix ([ - by default)
*     @param: htmlB - postfix (] - by default)
*     @type: public
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.setChildCalcHTML=function( htmlA,htmlB ){
      this.htmlcA=htmlA;      this.htmlcB=htmlB;
    }
//#}
//#}

/**
*     @desc: set function called when tree node selected
*     @param: (function) func - event handling function
*     @type: public
*     @topic: 0,7
*     @event: onRightClick
*     @eventdesc:  Event occured after right mouse button was clicked.
         Assigning this handler can disable default context menu, and noncompattible with dhtmlXMenu integration.
*     @eventparam: (string) ID of clicked item
*     @eventparam: (object) event object
*/
   dhtmlXTreeObject.prototype.setOnRightClickHandler=function(func){  if (typeof(func)=="function") this.arFunc=func; else this.arFunc=eval(func);  };

/**
*     @desc: set function called when tree node selected
*     @param: func - event handling function
*     @type: public
*     @topic: 0,7
*     @event: onClick
*     @eventdesc: Event raised immideatly after text part of item in tree was clicked, but after default onClick functionality was processed.
              Richt mouse button click can be catched by onRightClick handler.
*     @eventparam:  ID of clicked item
*/
   dhtmlXTreeObject.prototype.setOnClickHandler=function(func){  if (typeof(func)=="function") this.aFunc=func; else this.aFunc=eval(func);  };


/**
*     @desc: enables dynamic loading from XML
*     @type: public
*     @param: filePath - name of script returning XML; in case of virtual loading - user defined function
*     @topic: 0  
*/
   dhtmlXTreeObject.prototype.setXMLAutoLoading=function(filePath){  this.XMLsource=filePath; };

   /**
*     @desc: set function called before checkbox checked/unchecked
*     @param: func - event handling function
*     @type: public
*     @topic: 0,7
*     @event: onCheck
*     @eventdesc: Event raised immideatly after item in tree was checked/unchecked.
*     @eventparam: ID of item which will be checked/unchecked
*     @eventparam: Current checkbox state. 1 - item checked, 0 - item unchecked.
*/
   dhtmlXTreeObject.prototype.setOnCheckHandler=function(func){  if (typeof(func)=="function") this.checkFuncHandler=func; else this.checkFuncHandler=eval(func); };


/**
*     @desc: set function called before tree node opened/closed
*     @param: func - event handling function
*     @type: deprecated
*     @topic: 0,7
*     @event:  onOpen
*     @eventdesc: Event raised immideatly after item in tree got command to open/close , and before item was opened//closed. Event also raised for unclosable nodes and nodes without open/close functionality - in that case result of function will be ignored.
            Event not raised if node opened by dhtmlXtree API.
*     @eventparam: ID of node which will be opened/closed
*     @eventparam: Current open state of tree item. 0 - item has not childs, -1 - item closed, 1 - item opened.
*     @eventreturn: true - confirm opening/closing; false - deny opening/closing;
*/
   dhtmlXTreeObject.prototype.setOnOpenHandler=function(func){  if (typeof(func)=="function") this._spnFH=func; else this._spnFH=eval(func);  };
/**
*     @desc: set function called before tree node opened/closed
*     @param: func - event handling function
*     @type: public
*     @topic: 0,7
*     @event:  onOpenStart
*     @eventdesc: Event raised immideatly after item in tree got command to open/close , and before item was opened//closed. Event also raised for unclosable nodes and nodes without open/close functionality - in that case result of function will be ignored.
            Event not raised if node opened by dhtmlXtree API.
*     @eventparam: ID of node which will be opened/closed
*     @eventparam: Current open state of tree item. 0 - item has not childs, -1 - item closed, 1 - item opened.
*     @eventreturn: true - confirm opening/closing; false - deny opening/closing;
*/
   dhtmlXTreeObject.prototype.setOnOpenStartHandler=function(func){  if (typeof(func)=="function") this._spnFH=func; else this._spnFH=eval(func);  };

/**
*     @desc: set function called after tree node opened/closed
*     @param: func - event handling function
*     @type: public
*     @topic: 0,7
*     @event:  onOpenEnd
*     @eventdesc: Event raised immideatly after item in tree got command to open/close , and before item was opened//closed. Event also raised for unclosable nodes and nodes without open/close functionality - in that case result of function will be ignored.
            Event not raised if node opened by dhtmlXtree API.
*     @eventparam: ID of node which will be opened/closed
*     @eventparam: Current open state of tree item. 0 - item has not childs, -1 - item closed, 1 - item opened.
*/
   dhtmlXTreeObject.prototype.setOnOpenEndHandler=function(func){  if (typeof(func)=="function") this._epnFH=func; else this._epnFH=eval(func);  };

   /**
*     @desc: set function called when tree node double clicked
*     @param: func - event handling function
*     @type: public
*     @topic: 0,7
*     @event: onDblClick
*     @eventdesc: Event raised immideatly after item in tree was doubleclicked, before default onDblClick functionality was processed.
         Beware using both onClick and onDblClick events, because component can  generate onClick event before onDblClick event while doubleclicking item in tree.
         ( that behavior depend on used browser )
*     @eventparam:  ID of item which was doubleclicked
*     @eventreturn:  true - confirm opening/closing; false - deny opening/closing;
*/
   dhtmlXTreeObject.prototype.setOnDblClickHandler=function(func){  if (typeof(func)=="function") this.dblclickFuncHandler=func; else this.dblclickFuncHandler=eval(func); };









   /**
*     @desc: expand target node and all child nodes
*     @type: public
*     @param: itemId - node id
*     @topic: 4
*/
   dhtmlXTreeObject.prototype.openAllItems=function(itemId)
   {
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      this._xopenAll(temp);
   };
   
/**
*     @desc: return open/close state
*     @type: public
*     @param: itemId - node id
*     @return: -1 - close, 1 - opened, 0 - node doen't have childs
*     @topic: 4
*/   
   dhtmlXTreeObject.prototype.getOpenState=function(itemId){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return "";
      return this._getOpenState(temp);
   };

/**  
*     @desc: collapse target node and all child nodes
*     @type: public
*     @param: itemId - node id
*     @topic: 4  
*/      
   dhtmlXTreeObject.prototype.closeAllItems=function(itemId)
   {
        if (itemId===window.undefined) itemId=this.rootId;
        
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      this._xcloseAll(temp);

//nb:solves standard doctype prb in IE
         this.allTree.childNodes[0].border = "1";
       this.allTree.childNodes[0].border = "0";

   };
   
   
/**
*     @desc: set user data for target node
*     @type: public
*     @param: itemId - target node id
*     @param: name - key for user data
*     @param: value - user data
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.setUserData=function(itemId,name,value){
      var sNode=this._globalIdStorageFind(itemId,0,true);
         if (!sNode) return;
         if(name=="hint")
//#__pro_feature:01112006{
//#dhtmlxtootip:01112006{
		 if (this._dhxTT) dhtmlxTooltip.setTooltip(sNode.htmlNode.childNodes[0].childNodes[0],value);
		 else
//#}
//#}
			 sNode.htmlNode.childNodes[0].childNodes[0].title=value;
            if (sNode.userData["t_"+name]===undefined){
                 if (!sNode._userdatalist) sNode._userdatalist=name;
                else sNode._userdatalist+=","+name;
            }
            sNode.userData["t_"+name]=value;
   };
   
/**  
*     @desc: return user data from target node
*     @type: public
*     @param: itemId - target node id
*     @param: name - key for user data
*     @return: value of user data
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.getUserData=function(itemId,name){
      var sNode=this._globalIdStorageFind(itemId,0,true);
      if (!sNode) return;
      return sNode.userData["t_"+name];
   };




/**
*     @desc: get node color
*     @param: itemId - id of node
*     @type: public
*     @return: color of node (empty string for default color);
*     @topic: 6  
*/   
   dhtmlXTreeObject.prototype.getItemColor=function(itemId)
   {
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;

      var res= new Object();
      if (temp.acolor) res.acolor=temp.acolor;
      if (temp.acolor) res.scolor=temp.scolor;      
      return res;
   };
/**  
*     @desc: set node color
*     @param: itemId - id of node
*     @param: defaultColor - node color
*     @param: selectedColor - selected node color
*     @type: public
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.setItemColor=function(itemId,defaultColor,selectedColor)
   {
      if ((itemId)&&(itemId.span))
         var temp=itemId;
      else
         var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
         else {
         if (temp.i_sel)
            {  if (selectedColor) temp.span.style.color=selectedColor; }
         else
            {  if (defaultColor) temp.span.style.color=defaultColor;  }

         if (selectedColor) temp.scolor=selectedColor;
         if (defaultColor) temp.acolor=defaultColor;
         }
   };

/**
*     @desc: return item text
*     @param: itemId - id of node
*     @type: public
*     @return: text of item (with HTML formatting, if any)
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.getItemText=function(itemId)
   {
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      return(temp.htmlNode.childNodes[0].childNodes[0].childNodes[3].childNodes[0].innerHTML);
   };
/**  
*     @desc: return parent item id
*     @param: itemId - id of node
*     @type: public
*     @return: id of parent item
*     @topic: 4
*/         
   dhtmlXTreeObject.prototype.getParentId=function(itemId)
   {
      var temp=this._globalIdStorageFind(itemId);
      if ((!temp)||(!temp.parentObject)) return "";
      return temp.parentObject.id;
   };



/**  
*     @desc: change item id
*     @type: public
*     @param: itemId - old node id
*     @param: newItemId - new node id        
*     @topic: 4
*/    
   dhtmlXTreeObject.prototype.changeItemId=function(itemId,newItemId)
   {
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      temp.id=newItemId;
        temp.span.contextMenuId=newItemId;
      for (var i=0; i<this._globalIdStorageSize; i++)
         if (this._globalIdStorage[i]==itemId) 
            {
            this._globalIdStorage[i]=newItemId;
            }
   };


/**
*     @desc: mark selected item as cutted
*     @type: public
*     @topic: 2  
*/    
   dhtmlXTreeObject.prototype.doCut=function(){
      if (this.nodeCut) this.clearCut();
      this.nodeCut=(new Array()).concat(this._selected);
        for (var i=0; i<this.nodeCut.length; i++){
          var tempa=this.nodeCut[i];
            tempa._cimgs=new Array();
          tempa._cimgs[0]=tempa.images[0];
          tempa._cimgs[1]=tempa.images[1];
          tempa._cimgs[2]=tempa.images[2];
          tempa.images[0]=tempa.images[1]=tempa.images[2]=this.cutImage;
          this._correctPlus(tempa);
        }
   };

/**
*     @desc: insert previously cutted branch
*     @param: itemId - id of new parent node
*     @type: public
*     @topic: 2  
*/    
   dhtmlXTreeObject.prototype.doPaste=function(itemId){
      var tobj=this._globalIdStorageFind(itemId);
      if (!tobj) return 0;
        for (var i=0; i<this.nodeCut.length; i++){
               if (this._checkPNodes(tobj,this.nodeCut[i])) continue;
                this._moveNode(this.nodeCut[i],tobj);
               }
      this.clearCut();
   };

/**  
*     @desc: clear cut
*     @type: public
*     @topic: 2  
*/
   dhtmlXTreeObject.prototype.clearCut=function(){
      for (var i=0; i<this.nodeCut.length; i++)
         {
          var tempa=this.nodeCut[i];
          tempa.images[0]=tempa._cimgs[0];
          tempa.images[1]=tempa._cimgs[1];
          tempa.images[2]=tempa._cimgs[2];
          this._correctPlus(tempa);
         }
          this.nodeCut=new Array();
   };
   


   /**  
*     @desc: move node with subnodes
*     @type: private
*     @param: itemObject - moved node object
*     @param: targetObject - new parent node
*     @topic: 2  
*/
   dhtmlXTreeObject.prototype._moveNode=function(itemObject,targetObject){
//#__pro_feature:01112006{
//#complex_move:01112006{
      var mode=this.dadmodec;
      if (mode==1)
        {
            var z=targetObject;
         if (this.dadmodefix<0)
         {

                while (true){
            z=this._getPrevNode(z);
            if ((z==-1)) { z=this.htmlNode; break; }
                if ((z.tr==0)||(z.tr.style.display=="")||(!z.parentObject)) break;
                }

                var nodeA=z;
                var nodeB=targetObject;

            }
            else
            {
                while (true){
            z=this._getNextNode(z);
            if ((z==-1)) { z=this.htmlNode; break; }
                if ((z.tr.style.display=="")||(!z.parentObject)) break;
                }

                var nodeB=z;
                var nodeA=targetObject;
            }


            if (this._getNodeLevel(nodeA,0)>this._getNodeLevel(nodeB,0))
                {
                if (!this.dropLower)
                    return this._moveNodeTo(itemObject,nodeA.parentObject);
                else
                    if  (nodeB.id!=this.rootId)
                        return this._moveNodeTo(itemObject,nodeB.parentObject,nodeB);
                    else
                        return this._moveNodeTo(itemObject,this.htmlNode,null);
                }
            else
                {
                return this._moveNodeTo(itemObject,nodeB.parentObject,nodeB);
                }


      }
      else
//#}
//#}
	  return this._moveNodeTo(itemObject,targetObject);

   }

   /**
*     @desc: fix order of nodes in collection
*     @type: private
*     @param: target - parent item node
*     @param: zParent - before node
*     @edition: Professional
*     @topic: 2
*/

dhtmlXTreeObject.prototype._fixNodesCollection=function(target,zParent){
      var flag=0; var icount=0;
      var Nodes=target.childNodes;
      var Count=target.childsCount-1;

      if (zParent==Nodes[Count]) return;
      for (var i=0; i<Count; i++)
         if (Nodes[i]==Nodes[Count]) {  Nodes[i]=Nodes[i+1]; Nodes[i+1]=Nodes[Count]; }

//         Count=target.childsCount;
      for (var i=0; i<Count+1; i++)      
         {
         if (flag) { 
            var temp=Nodes[i];
            Nodes[i]=flag; 
            flag=temp; 
               }
         else 
         if (Nodes[i]==zParent) {   flag=Nodes[i]; Nodes[i]=Nodes[Count];  }
         }
   };
   
/**  
*     @desc: recreate branch
*     @type: private
*     @param: itemObject - moved node object
*     @param: targetObject - new parent node
*     @param: level - top level flag
*     @param: beforeNode - node for sibling mode
*     @mode: mode - DragAndDrop mode (0 - as child, 1 as sibling)
*     @edition: Professional
*     @topic: 2
*/
dhtmlXTreeObject.prototype._recreateBranch=function(itemObject,targetObject,beforeNode,level){
    var i; var st="";
    if (beforeNode){
    for (i=0; i<targetObject.childsCount; i++)
        if (targetObject.childNodes[i]==beforeNode) break;

    if (i!=0)
        beforeNode=targetObject.childNodes[i-1];
    else{
        st="TOP";
        beforeNode="";
        }
    }

   var newNode=this._attachChildNode(targetObject,itemObject.id,itemObject.label,0,itemObject.images[0],itemObject.images[1],itemObject.images[2],st,0,beforeNode);

   //copy user data
   newNode._userdatalist=itemObject._userdatalist;
   newNode.userData=itemObject.userData.clone();
    newNode.XMLload=itemObject.XMLload;

//#__pro_feature:01112006{
//#smart_parsing:01112006{
   //copy unparsed chunk
   if (itemObject.unParsed)
      {
      newNode.unParsed=itemObject.unParsed;
      this._correctPlus(newNode);
      //this._correctLine(newNode);
      }
   else
//#}
//#}
   for (var i=0; i<itemObject.childsCount; i++)
      this._recreateBranch(itemObject.childNodes[i],newNode,0,1);

//#__pro_feature:01112006{
//#child_calc:01112006{
      if ((!level)&&(this.childCalc)) { this._redrawFrom(this,targetObject);  }
//#}
//#}
   return newNode;
}

/**
*     @desc: move single node
*     @type: private
*     @param: itemObject - moved node object
*     @param: targetObject - new parent node
*     @edition: Professional
*     @mode: mode - DragAndDrop mode (0 - as child, 1 as sibling)
*     @topic: 2
*/
   dhtmlXTreeObject.prototype._moveNodeTo=function(itemObject,targetObject,beforeNode){
    //return;
    if   (itemObject.treeNod._nonTrivialNode)
        return itemObject.treeNod._nonTrivialNode(this,targetObject,beforeNode,itemObject);

    if    (targetObject.mytype)
       var framesMove=(itemObject.treeNod.lWin!=targetObject.lWin);
    else
          var framesMove=(itemObject.treeNod.lWin!=targetObject.treeNod.lWin);

   if (this.dragFunc) if (!this.dragFunc(itemObject.id,targetObject.id,(beforeNode?beforeNode.id:null),itemObject.treeNod,targetObject.treeNod)) return false;
      if ((targetObject.XMLload==0)&&(this.XMLsource))
         {
         targetObject.XMLload=1;
            this._loadDynXML(targetObject.id);
         }
      this.openItem(targetObject.id);

   var oldTree=itemObject.treeNod;
   var c=itemObject.parentObject.childsCount;
   var z=itemObject.parentObject;

   if ((framesMove)||(oldTree.dpcpy)) {//interframe drag flag
        var _otiid=itemObject.id;
      itemObject=this._recreateBranch(itemObject,targetObject,beforeNode);
        if (!oldTree.dpcpy) oldTree.deleteItem(_otiid);
        }
   else
      {

      var Count=targetObject.childsCount; var Nodes=targetObject.childNodes;
           Nodes[Count]=itemObject;
            itemObject.treeNod=targetObject.treeNod;
            targetObject.childsCount++;         

            var tr=this._drawNewTr(Nodes[Count].htmlNode);

            if (!beforeNode)
               {
                  targetObject.htmlNode.childNodes[0].appendChild(tr);
               if (this.dadmode==1) this._fixNodesCollection(targetObject,beforeNode);
               }
            else
               {
               targetObject.htmlNode.childNodes[0].insertBefore(tr,beforeNode.tr);
               this._fixNodesCollection(targetObject,beforeNode);
               Nodes=targetObject.childNodes;
               }


         }

            if ((!oldTree.dpcpy)&&(!framesMove))   {
                var zir=itemObject.tr;

                if ((document.all)&&(navigator.appVersion.search(/MSIE\ 5\.0/gi)!=-1))
                    {
                    window.setTimeout(function() { zir.removeNode(true); } , 250 );
                    }
                else   //if (zir.parentNode) zir.parentNode.removeChild(zir,true);

                itemObject.parentObject.htmlNode.childNodes[0].removeChild(itemObject.tr);

                //itemObject.tr.removeNode(true);
            if ((!beforeNode)||(targetObject!=itemObject.parentObject)){
               for (var i=0; i<z.childsCount; i++){
                  if (z.childNodes[i].id==itemObject.id) {
                  z.childNodes[i]=0;
                  break;            }}}
               else z.childNodes[z.childsCount-1]=0;

            oldTree._compressChildList(z.childsCount,z.childNodes);
            z.childsCount--;
            }


      if ((!framesMove)&&(!oldTree.dpcpy)) {
       itemObject.tr=tr;
      tr.nodem=itemObject;
      itemObject.parentObject=targetObject;

      if (oldTree!=targetObject.treeNod) {   if(itemObject.treeNod._registerBranch(itemObject,oldTree)) return;      this._clearStyles(itemObject);  this._redrawFrom(this,itemObject.parentObject);   };

      this._correctPlus(targetObject);
      this._correctLine(targetObject);

      this._correctLine(itemObject);
      this._correctPlus(itemObject);

         //fix target siblings
      if (beforeNode)
      {

         this._correctPlus(beforeNode);
         //this._correctLine(beforeNode);
      }
      else 
      if (targetObject.childsCount>=2)
      {

         this._correctPlus(Nodes[targetObject.childsCount-2]);
         this._correctLine(Nodes[targetObject.childsCount-2]);
      }
      
      this._correctPlus(Nodes[targetObject.childsCount-1]);
      //this._correctLine(Nodes[targetObject.childsCount-1]);


      if (this.tscheck) this._correctCheckStates(targetObject);
      if (oldTree.tscheck) oldTree._correctCheckStates(z);

      }

      //fix source parent

      if (c>1) { oldTree._correctPlus(z.childNodes[c-2]);
               oldTree._correctLine(z.childNodes[c-2]);
               }


//      if (z.childsCount==0)
          oldTree._correctPlus(z);
            oldTree._correctLine(z);

//#__pro_feature:01112006{
//#child_calc:01112006{
      this._fixChildCountLabel(targetObject);
      oldTree._fixChildCountLabel(z);
//#}
//#}
      if (this.dropFunc) this.dropFunc(itemObject.id,targetObject.id,(beforeNode?beforeNode.id:null),oldTree,targetObject.treeNod);
      return itemObject.id;
   };

   

/**
*     @desc: recursive set default styles for node
*     @type: private
*     @param: itemObject - target node object
*     @topic: 6  
*/   
   dhtmlXTreeObject.prototype._clearStyles=function(itemObject){
         var td1=itemObject.htmlNode.childNodes[0].childNodes[0].childNodes[1];
         var td3=td1.nextSibling.nextSibling;

         itemObject.span.innerHTML=itemObject.label;
		 itemObject.i_sel=false;

         if (this.checkBoxOff) { td1.childNodes[0].style.display=""; td1.childNodes[0].onclick=this.onCheckBoxClick;  }
         else td1.childNodes[0].style.display="none";
         td1.childNodes[0].treeNod=this;
//#__pro_feature:01112006{
//#context_menu:01112006{
            if (this.cMenu) {
                itemObject.onmousedown=itemObject.contextOnclick||null;
                this.cMenu.setContextZone(itemObject.span,itemObject.id);
                }
            else
//#}
//#}
			itemObject.span.onmousedown=function(){};

         this.dragger.removeDraggableItem(td3);
         if (this.dragAndDropOff) this.dragger.addDraggableItem(td3,this);
         td3.childNodes[0].className="standartTreeRow";
         td3.onclick=this.onRowSelect; td3.ondblclick=this.onRowClick2;
         td1.previousSibling.onclick=this.onRowClick;

         this._correctLine(itemObject);
         this._correctPlus(itemObject);
         for (var i=0; i<itemObject.childsCount; i++) this._clearStyles(itemObject.childNodes[i]); 

   };
/**
*     @desc: register node and all childs nodes
*     @type: private
*     @param: itemObject - node object
*     @topic: 2  
*/
   dhtmlXTreeObject.prototype._registerBranch=function(itemObject,oldTree){
   /*for (var i=0; i<itemObject.childsCount; i++)
      if (confirm(itemObject.childNodes[i].id)) return;*/
      itemObject.id=this._globalIdStorageAdd(itemObject.id,itemObject);
      itemObject.treeNod=this;
         if (oldTree) oldTree._globalIdStorageSub(itemObject.id);
         for (var i=0; i<itemObject.childsCount; i++)
            this._registerBranch(itemObject.childNodes[i],oldTree);
      return 0;
   };

   
/**  
*     @desc: enable three state checkboxes
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @topic: 0  
*/
   dhtmlXTreeObject.prototype.enableThreeStateCheckboxes=function(mode) { this.tscheck=convertStringToBoolean(mode); };


/**
*     @desc: set function called when mouse is over tree node
*     @param: func - event handling function
*     @type: public
*     @topic: 0,7
*     @event: onMouseIN
*     @eventdesc: Event raised immideatly after mouse hovered over item
*     @eventparam:  ID of item
*/
   dhtmlXTreeObject.prototype.setOnMouseInHandler=function(func){
    	this.ehlt=true;
   		if (typeof(func)=="function") this._onMSI=func; else this.aFunc=eval(func);  };

/**
*     @desc: set function called when mouse is out of tree node
*     @param: func - event handling function
*     @type: public
*     @topic: 0,7
*     @event: onMouseOut
*     @eventdesc: Event raised immideatly after mouse moved out of item
*     @eventparam:  ID of clicked item
*/
   dhtmlXTreeObject.prototype.setOnMouseOutHandler=function(func){
		this.ehlt=true;
		if (typeof(func)=="function") this._onMSO=func; else this.aFunc=eval(func);  };





//#__pro_feature:01112006{
//#mercy_drag:01112006{
/**
*     @desc: enable drag without removing (copy instead of move)
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @edition:Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableMercyDrag=function(mode){ this.dpcpy=convertStringToBoolean(mode); };
//#}
//#}



/**
*     @desc: enable tree images
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @topic: 0  
*/         
   dhtmlXTreeObject.prototype.enableTreeImages=function(mode) { this.timgen=convertStringToBoolean(mode); };
   

   
/**
*     @desc: enable mode with fixed tables (look better, but hasn't horisontal scrollbar)
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @type: private
*     @topic: 0  
*/
   dhtmlXTreeObject.prototype.enableFixedMode=function(mode) { this.hfMode=convertStringToBoolean(mode); };
   
/**  
*     @desc: hide checkboxes (all checkboxes in tree)
*     @type: public
*     @param: mode - enabled/disabled
*     @param: hidden - if set to true, checkboxes not rendered but can be shown by showItemCheckbox
*     @topic: 0  
*/
   dhtmlXTreeObject.prototype.enableCheckBoxes=function(mode, hidden){ this.checkBoxOff=convertStringToBoolean(mode); this.cBROf=(!(this.checkBoxOff||convertStringToBoolean(hidden))); };
/**
*     @desc: set default images for nodes (must be called before XML loading)
*     @type: public
*     @param: a0 - image for node without childrens;
*     @param: a1 - image for closed node;
*     @param: a2 - image for opened node                  
*     @topic: 6  
*/
   dhtmlXTreeObject.prototype.setStdImages=function(image1,image2,image3){
                  this.imageArray[0]=image1; this.imageArray[1]=image2; this.imageArray[2]=image3;};

/**
*     @desc: enable/disable tree lines (parent-child threads)
*     @type: public
*     @param: mode - enable/disable tree lines
*     @topic: 6
*/                  
   dhtmlXTreeObject.prototype.enableTreeLines=function(mode){
      this.treeLinesOn=convertStringToBoolean(mode);
   }

/**
*     @desc: set images used for parent-child threads drawing
*     @type: public
*     @param: arrayName - name of array: plus, minus
*     @param: image1 - line crossed image
*     @param: image2 - image with top line
*     @param: image3 - image with bottom line
*     @param: image4 - image without line
*     @param: image5 - single root image
*     @topic: 6
*/      
   dhtmlXTreeObject.prototype.setImageArrays=function(arrayName,image1,image2,image3,image4,image5){
      switch(arrayName){
      case "plus": this.plusArray[0]=image1; this.plusArray[1]=image2; this.plusArray[2]=image3; this.plusArray[3]=image4; this.plusArray[4]=image5; break;
      case "minus": this.minusArray[0]=image1; this.minusArray[1]=image2; this.minusArray[2]=image3; this.minusArray[3]=image4;  this.minusArray[4]=image5; break;
      }
   };

/**  
*     @desc: expand node
*     @param: itemId - id of node
*     @type: public
*     @topic: 4  
*/ 
   dhtmlXTreeObject.prototype.openItem=function(itemId){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      else return this._openItem(temp);
   };

/**  
*     @desc: expand node
*     @param: item - tree node object
*     @type: private
*     @editing: pro
*     @topic: 4  
*/ 
   dhtmlXTreeObject.prototype._openItem=function(item){
           if    ((this._spnFH)&&(!this._spnFH(item.id,this._getOpenState(item)))) return 0;
           this._HideShow(item,2);
            //#on_open_end_event:11052006{
               if    (this._epnFH)
                       if (!this.xmlstate)
                            this._epnFH(item.id,this._getOpenState(item));
                        else{
                            this._oie_onXLE=this.onXLE;
                            this.onXLE=this._epnFHe;
                            }
            //#}

         if ((item.parentObject)&&(this._getOpenState(item.parentObject)<0))
               this._openItem(item.parentObject);
   };
   
/**  
*     @desc: collapse node
*     @param: itemId - id of node
*     @type: public
*     @topic: 4  
*/ 
   dhtmlXTreeObject.prototype.closeItem=function(itemId){
      if (this.rootId==itemId) return 0;
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
         if (temp.closeble)
            this._HideShow(temp,1);
   };
   
   

   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
      
/**
*     @desc: return node level (position in hierarchy)
*     @param: itemId - id of node
*     @type: public
*     @return: node level
*     @topic: 4
*/
   dhtmlXTreeObject.prototype.getLevel=function(itemId){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      return this._getNodeLevel(temp,0);
   };
   
      

/**  
*     @desc: prevent node from closing
*     @param: itemId - id of node
*     @param: flag -  if 0 - node can't be closed, else node can be closed
*     @type: public
*     @topic: 4  
*/ 
   dhtmlXTreeObject.prototype.setItemCloseable=function(itemId,flag)
   {
      flag=convertStringToBoolean(flag);
      if ((itemId)&&(itemId.span)) 
         var temp=itemId;
      else      
         var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
         temp.closeble=flag;
   };

   /**  
*     @desc: recursive function used fo node level calculation
*     @param: itemObject - pointer to node object
*     @param: count - counter of levels        
*     @type: private
*     @topic: 4  
*/   
   dhtmlXTreeObject.prototype._getNodeLevel=function(itemObject,count){
      if (itemObject.parentObject) return this._getNodeLevel(itemObject.parentObject,count+1);
      return(count);
   };
   
   /**  
*     @desc: return number of childrens
*     @param: itemId - id of node
*     @type: public
*     @return: count of child items; true - for not loaded branches
*     @topic: 4
*/
   dhtmlXTreeObject.prototype.hasChildren=function(itemId){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      else 
         {
            if ( (this.XMLsource)&&(!temp.XMLload) ) return true;
            else 
               return temp.childsCount;
         };
   };
   

   /**
*     @desc: return count of leafs
*     @param: itemNode -  node object
*     @type: private
*     @edition: Professional
*     @topic: 4
*/
   dhtmlXTreeObject.prototype._getLeafCount=function(itemNode){
      var a=0;
      for (var b=0; b<itemNode.childsCount; b++)
         if (itemNode.childNodes[b].childsCount==0) a++;
      return a;
   }

   
/**
*     @desc: set new node text (HTML allowed)
*     @param: itemId - id of node
*     @param: newLabel - node text
*     @param: newTooltip - (optional)tooltip for the node
*     @type: public
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.setItemText=function(itemId,newLabel,newTooltip)
   {
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      temp.label=newLabel;
      temp.span.innerHTML=newLabel;
//#__pro_feature:01112006{
//#child_calc:01112006{
        if (this.childCalc) this._fixChildCountLabel(temp);
//#}

//#dhtmlxtootip:01112006{
	  if (this._dhxTT)
	      dhtmlxTooltip.setTooltip(temp.span.parentNode,(newTooltip||""));
	  else
//#}
//#}
	      temp.span.parentNode.title=newTooltip||"";
   };

/**
*     @desc: get item's tooltip
*     @param: itemId - id of node
*     @type: public
*     @topic: 6
*/
    dhtmlXTreeObject.prototype.getItemTooltip=function(itemId){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return "";
	  return (temp.span.parentNode.title||"");
   };

/**  
*     @desc: refresh tree branch from xml (XML with description of child nodes rerequested from server)
*     @param: itemId - id of node, if not defined tree super root used.
*     @type: public
*     @topic: 6  
*/
   dhtmlXTreeObject.prototype.refreshItem=function(itemId){
      if (!itemId) itemId=this.rootId;
      var temp=this._globalIdStorageFind(itemId);
      this.deleteChildItems(itemId);
        this._loadDynXML(itemId);
   };

   /**  
*     @desc: set item images
*     @param: itemId - id of node
*     @param: image1 - node without childrens image
*     @param: image2 - closed node image          
*     @param: image3 - open node image         
*     @type: public
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.setItemImage2=function(itemId, image1,image2,image3){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
            temp.images[1]=image2;
            temp.images[2]=image3;
            temp.images[0]=image1;
      this._correctPlus(temp);
   };
/**
*     @desc: set item images
*     @param: itemId - id of node
*     @param: image1 - node without childrens image or closed node image (if image2 specified)
*     @param: image2 - open node image (optional)        
*     @type: public
*     @topic: 6  
*/   
   dhtmlXTreeObject.prototype.setItemImage=function(itemId,image1,image2)
   {
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
         if (image2)
         {
            temp.images[1]=image1;
            temp.images[2]=image2;
         }
         else temp.images[0]=image1;
      this._correctPlus(temp);
   };


/**
*     @desc: Returns the list of all children items from the next level of tree, separated by commas.
*     @param: itemId - id of node
*     @type: public
*     @return: list of all children items from the next level of tree, separated by commas.
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.getSubItems =function(itemId)
   {
      var temp=this._globalIdStorageFind(itemId,0,1);
      if (!temp) return 0;
//#__pro_feature:01112006{
//#smart_parsing:01112006{
        if(temp.unParsed)
            return (this._getSubItemsXML(temp.unParsed));
//#}
//#}
      var z="";
      for (i=0; i<temp.childsCount; i++){
         if (!z) z=temp.childNodes[i].id;
            else z+=this.dlmtr+temp.childNodes[i].id;

                                                         }

      return z;
   };




/**
*     @desc: Returns the list of all children items from all next levels of tree, separated by commas.
*     @param: itemId - id of node
*     @edition: Professional
*     @type: private
*     @topic: 6
*/
   dhtmlXTreeObject.prototype._getAllScraggyItems =function(node)
   {
      var z="";
      for (var i=0; i<node.childsCount; i++)
        {
            if ((node.childNodes[i].unParsed)||(node.childNodes[i].childsCount>0))
            {
                    if (node.childNodes[i].unParsed)
                        var zb=this._getAllScraggyItemsXML(node.childNodes[i].unParsed,1);
                    else
                       var zb=this._getAllScraggyItems(node.childNodes[i])

                 if (zb)
                        if (z) z+=this.dlmtr+zb;
                        else z=zb;
         }
            else
               if (!z) z=node.childNodes[i].id;
             else z+=this.dlmtr+node.childNodes[i].id;
         }
          return z;
   };





/**
*     @desc: Returns the list of all children items from all next levels of tree, separated by commas.
*     @param: itemId - id of node
*     @type: private
*     @edition: Professional
*     @topic: 6
*/

   dhtmlXTreeObject.prototype._getAllFatItems =function(node)
   {
      var z="";
      for (var i=0; i<node.childsCount; i++)
        {
            if ((node.childNodes[i].unParsed)||(node.childNodes[i].childsCount>0))
            {
             if (!z) z=node.childNodes[i].id;
                else z+=this.dlmtr+node.childNodes[i].id;

                    if (node.childNodes[i].unParsed)
                        var zb=this._getAllFatItemsXML(node.childNodes[i].unParsed,1);
                    else
                       var zb=this._getAllFatItems(node.childNodes[i])

                 if (zb) z+=this.dlmtr+zb;
         }
         }
          return z;
   };


/**
*     @desc: Returns the list of all children items from all next levels of tree, separated by commas.
*     @param: itemId - id of node
*     @type: private
*     @topic: 6
*/
   dhtmlXTreeObject.prototype._getAllSubItems =function(itemId,z,node)
   {
      if (node) temp=node;
      else {
      var temp=this._globalIdStorageFind(itemId);
         };
      if (!temp) return 0;

      z="";
      for (var i=0; i<temp.childsCount; i++)
         {
         if (!z) z=temp.childNodes[i].id;
            else z+=this.dlmtr+temp.childNodes[i].id;
         var zb=this._getAllSubItems(0,z,temp.childNodes[i])

         if (zb) z+=this.dlmtr+zb;
         }

//#__pro_feature:01112006{
//#smart_parsing:01112006{
        if (temp.unParsed)
            z=this._getAllSubItemsXML(itemId,z,temp.unParsed);
//#}
//#}
          return z;
   };




   
/**  
*     @desc: select node ( and optionaly fire onselect event)
*     @type: public
*     @param: itemId - node id
*     @param: mode - If true, script function for selected node will be called.
*     @param: preserve - preserve earlie selected nodes
*     @topic: 1
*/
   dhtmlXTreeObject.prototype.selectItem=function(itemId,mode,preserve){
      mode=convertStringToBoolean(mode);
         var temp=this._globalIdStorageFind(itemId);
      if ((!temp)||(!temp.parentObject)) return 0;


      if (this._getOpenState(temp.parentObject)==-1)
            if (this.XMLloadingWarning)
                temp.parentObject.openMe=1;
            else
             this._openItem(temp.parentObject);

      //temp.onRowSelect(0,temp.htmlNode.childNodes[0].childNodes[0].childNodes[3],mode);
        var ze=null;
        if (preserve)  {
			ze=new Object; ze.ctrlKey=true;
			if (temp.i_sel) ze.skipUnSel=true;
		}
      if (mode)
         this.onRowSelect(ze,temp.htmlNode.childNodes[0].childNodes[0].childNodes[3],false);
      else
         this.onRowSelect(ze,temp.htmlNode.childNodes[0].childNodes[0].childNodes[3],true);
   };
   
/**
*     @desc: retun selected node text
*     @type: public
*     @return: text of selected node
*     @topic: 1
*/
   dhtmlXTreeObject.prototype.getSelectedItemText=function()
   {
        var str=new Array();
        for (var i=0; i<this._selected.length; i++) str[i]=this._selected[i].span.innerHTML;
      return (str.join(this.dlmtr));
   };




/**  
*     @desc: correct childNode list after node deleting
*     @type: private
*     @param: Count - childNodes collection length        
*     @param: Nodes - childNodes collection
*     @topic: 4  
*/   
   dhtmlXTreeObject.prototype._compressChildList=function(Count,Nodes)
   {
      Count--;
      for (var i=0; i<Count; i++)
      {
         if (Nodes[i]==0) { Nodes[i]=Nodes[i+1]; Nodes[i+1]=0;}
      };
   };
/**  
*     @desc: delete node
*     @type: private
*     @param: itemId - target node id
*     @param: htmlObject - target node object        
*     @param: skip - node unregistration mode (optional, used by private methods)
*     @topic: 2
*/      
   dhtmlXTreeObject.prototype._deleteNode=function(itemId,htmlObject,skip){

      if (!skip) {
        this._globalIdStorageRecSub(htmlObject);
                 }
                  
   if ((!htmlObject)||(!htmlObject.parentObject)) return 0;
   var tempos=0; var tempos2=0;
   if (htmlObject.tr.nextSibling)  tempos=htmlObject.tr.nextSibling.nodem;
   if (htmlObject.tr.previousSibling)  tempos2=htmlObject.tr.previousSibling.nodem;
   
      var sN=htmlObject.parentObject;
      var Count=sN.childsCount;
      var Nodes=sN.childNodes;
            for (var i=0; i<Count; i++)
            {
               if (Nodes[i].id==itemId) { 
               if (!skip) sN.htmlNode.childNodes[0].removeChild(Nodes[i].tr);
               Nodes[i]=0;
               break;
               }
            }
      this._compressChildList(Count,Nodes);
      if (!skip) {
        sN.childsCount--;
                 }

      if (tempos) {
      this._correctPlus(tempos);
      this._correctLine(tempos);
               }
      if (tempos2) {
      this._correctPlus(tempos2);
      this._correctLine(tempos2);
               }   
      if (this.tscheck) this._correctCheckStates(sN);
   };
/**
*     @desc: change state of node's checkbox
*     @type: public
*     @param: itemId - target node id
*     @param: state - checkbox state (0/1/unsure)
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.setCheck=function(itemId,state){
      var sNode=this._globalIdStorageFind(itemId,0,1);
      if (!sNode) return;

        if (state==="unsure")
            this._setCheck(sNode,state);
        else
        {
      state=convertStringToBoolean(state);
        if ((this.tscheck)&&(this.smcheck)) this._setSubChecked(state,sNode);
      else this._setCheck(sNode,state);
        }
      if (this.smcheck)
         this._correctCheckStates(sNode.parentObject);
   };

   dhtmlXTreeObject.prototype._setCheck=function(sNode,state){
        if (((sNode.parentObject._r_logic)||(this._frbtr))&&(state))
			if (this._frbtrs){
				if (this._frbtrL)   this._setCheck(this._frbtrL,0);
				this._frbtrL=sNode;
			} else
    	        for (var i=0; i<sNode.parentObject.childsCount; i++)
	                this._setCheck(sNode.parentObject.childNodes[i],0);

      var z=sNode.htmlNode.childNodes[0].childNodes[0].childNodes[1].childNodes[0];

      if (state=="unsure") sNode.checkstate=2;
      else if (state) sNode.checkstate=1; else sNode.checkstate=0;
      if (sNode.dscheck) sNode.checkstate=sNode.dscheck;
      z.src=this.imPath+((sNode.parentObject._r_logic||this._frbtr)?this.radioArray:this.checkArray)[sNode.checkstate];
   };

/**
*     @desc: change state of node's checkbox and all childnodes checkboxes
*     @type: public
*     @param: itemId - target node id
*     @param: state - checkbox state
*     @topic: 5  
*/
dhtmlXTreeObject.prototype.setSubChecked=function(itemId,state){
   var sNode=this._globalIdStorageFind(itemId);
   this._setSubChecked(state,sNode);
   this._correctCheckStates(sNode.parentObject);
}



/**  
*     @desc: change state of node's checkbox and all childnodes checkboxes
*     @type: private
*     @param: itemId - target node id
*     @param: state - checkbox state
*     @param: sNode - target node object (optional, used by private methods)
*     @topic: 5  
*/
   dhtmlXTreeObject.prototype._setSubChecked=function(state,sNode){
      state=convertStringToBoolean(state);
      if (!sNode) return;
        if (((sNode.parentObject._r_logic)||(this._frbtr))&&(state))
            for (var i=0; i<sNode.parentObject.childsCount; i++)
                this._setSubChecked(0,sNode.parentObject.childNodes[i]);

//#__pro_feature:01112006{
//#smart_parsing:01112006{
      if (sNode.unParsed)
         this._setSubCheckedXML(state,sNode.unParsed)
//#}
//#}
        if (sNode._r_logic||this._frbtr)
           this._setSubChecked(state,sNode.childNodes[0]);
        else
      for (var i=0; i<sNode.childsCount; i++)
         {
             this._setSubChecked(state,sNode.childNodes[i]);
         };
      var z=sNode.htmlNode.childNodes[0].childNodes[0].childNodes[1].childNodes[0];

      if (state) sNode.checkstate=1;
      else    sNode.checkstate=0;
      if (sNode.dscheck)  sNode.checkstate=sNode.dscheck;



      z.src=this.imPath+((sNode.parentObject._r_logic||this._frbtr)?this.radioArray:this.checkArray)[sNode.checkstate];
   };

/**
*     @desc: return state of nodes's checkbox
*     @type: public
*     @param: itemId - target node id
*     @return: node state (0 - unchecked,1 - checked, 2 - third state)
*     @topic: 5  
*/      
   dhtmlXTreeObject.prototype.isItemChecked=function(itemId){
      var sNode=this._globalIdStorageFind(itemId);
      if (!sNode) return;      
      return   sNode.checkstate;
   };







/**
*     @desc: delete all children of node
*     @type: public
*     @param: itemId - node id
*     @topic: 2
*/
    dhtmlXTreeObject.prototype.deleteChildItems=function(itemId)
   {
      var sNode=this._globalIdStorageFind(itemId);
      if (!sNode) return;
      var j=sNode.childsCount;
      for (var i=0; i<j; i++)
      {
         this._deleteNode(sNode.childNodes[0].id,sNode.childNodes[0]);
      };
   };

/**
*     @desc: delete node
*     @type: public
*     @param: itemId - node id
*     @param: selectParent - If true parent of deleted item get selection, else no selected items leaving in tree.
*     @topic: 2  
*/      
dhtmlXTreeObject.prototype.deleteItem=function(itemId,selectParent){
    if ((!this._onrdlh)||(this._onrdlh(itemId))){
		var z=this._deleteItem(itemId,selectParent);
//#__pro_feature:01112006{
//#child_calc:01112006{
   		this._fixChildCountLabel(z);
//#}
//#}
	}

    //nb:solves standard doctype prb in IE
      this.allTree.childNodes[0].border = "1";
      this.allTree.childNodes[0].border = "0";
}
/**
*     @desc: delete node
*     @type: private
*     @param: id - node id
*     @param: selectParent - If true parent of deleted item get selection, else no selected items leaving in tree.
*     @param: skip - unregistering mode (optional, used by private methods)        
*     @topic: 2  
*/      
dhtmlXTreeObject.prototype._deleteItem=function(itemId,selectParent,skip){
      selectParent=convertStringToBoolean(selectParent);
      var sNode=this._globalIdStorageFind(itemId);
      if (!sNode) return;
        var pid=this.getParentId(itemId);
      if  ((selectParent)&&(pid!=this.rootId)) this.selectItem(pid,1);
      else
           this._unselectItem(sNode);

      if (!skip)
         this._globalIdStorageRecSub(sNode);

      var zTemp=sNode.parentObject;
      this._deleteNode(itemId,sNode,skip);
      this._correctPlus(zTemp);
      this._correctLine(zTemp);
      return    zTemp;
   };

/**  
*     @desc: uregister all child nodes of target node
*     @type: private
*     @param: itemObject - node object
*     @topic: 3  
*/      
   dhtmlXTreeObject.prototype._globalIdStorageRecSub=function(itemObject){
      for(var i=0; i<itemObject.childsCount; i++)
      {
         this._globalIdStorageRecSub(itemObject.childNodes[i]);
         this._globalIdStorageSub(itemObject.childNodes[i].id);
      };
      this._globalIdStorageSub(itemObject.id);
   };

/**  
*     @desc: create new node next to specified
*     @type: public
*     @param: itemId - node id
*     @param: newItemId - new node id
*     @param: itemText - new node text
*     @param: itemActionHandler - function fired on node select event (optional)
*     @param: image1 - image for node without childrens; (optional)
*     @param: image2 - image for closed node; (optional)
*     @param: image3 - image for opened node (optional)    
*     @param: optionStr - options string (optional)            
*     @param: childs - node childs flag (for dynamical trees) (optional)
*     @topic: 2  
*/
   dhtmlXTreeObject.prototype.insertNewNext=function(itemId,newItemId,itemText,itemActionHandler,image1,image2,image3,optionStr,childs){
      var sNode=this._globalIdStorageFind(itemId);
      if ((!sNode)||(!sNode.parentObject)) return (0);

      var nodez=this._attachChildNode(0,newItemId,itemText,itemActionHandler,image1,image2,image3,optionStr,childs,sNode);
//#__pro_feature:01112006{
//#child_calc:01112006{
      if ((!this.XMLloadingWarning)&&(this.childCalc))  this._fixChildCountLabel(sNode.parentObject);
//#}
//#}
        return nodez;
   };


   
/**
*     @desc: retun node id by index
*     @type: public
*     @param: itemId - parent node id
*     @param: index - index of node, 0 based
*     @return: node id
*     @topic: 1
*/
   dhtmlXTreeObject.prototype.getItemIdByIndex=function(itemId,index){
       var z=this._globalIdStorageFind(itemId);
       if ((!z)||(index>z.childsCount)) return null;
          return z.childNodes[index].id;
   };

/**
*     @desc: retun child node id by index
*     @type: public
*     @param: itemId - parent node id        
*     @param: index - index of child node
*     @return: node id
*     @topic: 1
*/      
   dhtmlXTreeObject.prototype.getChildItemIdByIndex=function(itemId,index){
       var z=this._globalIdStorageFind(itemId);
       if ((!z)||(index>=z.childsCount)) return null;
          return z.childNodes[index].id;
   };



   

/**
*     @desc: set function called when drag-and-drop event occured
*     @param: aFunc - event handling function
*     @type: public
*     @topic: 0,7
*     @event:    onDrag
*     @eventdesc: Event occured after item was dragged and droped on another item, but before item moving processed.
      Event also raised while programmatic moving nodes.
*     @eventparam:  ID of source item
*     @eventparam:  ID of target item
*     @eventparam:  if node droped as sibling then contain id of item before whitch source node will be inserted
*     @eventparam:  source Tree object
*     @eventparam:  target Tree object
*     @eventreturn:  true - confirm drag-and-drop; false - deny drag-and-drop;
*/
   dhtmlXTreeObject.prototype.setDragHandler=function(func){  if (typeof(func)=="function") this.dragFunc=func; else this.dragFunc=eval(func);  };
   
   /**
*     @desc: clear selection from node
*     @param: htmlNode - pointer to node object
*     @type: private
*     @topic: 1
*/
    dhtmlXTreeObject.prototype._clearMove=function(){
		if (this._lastMark){
	   		this._lastMark.className=this._lastMark.className.replace(/dragAndDropRow/g,"");
	   		this._lastMark=null;
		}
//#__pro_feature:01112006{
//#complex_move:01112006{
		this.selectionBar.style.display="none";
//#}
//#}
		this.allTree.className=this.allTree.className.replace(" selectionBox","");
   };

   /**  
*     @desc: enable/disable drag-and-drop
*     @type: public
*     @param: mode - enabled/disabled [ can be true/false/temporary_disabled - last value mean that tree can be D-n-D can be switched to true later ]
*     @param: rmode - enabled/disabled drag and drop on super root
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableDragAndDrop=function(mode,rmode){
        if  (mode=="temporary_disabled"){
            this.dADTempOff=false;
            mode=true;                  }
        else
            this.dADTempOff=true;

      this.dragAndDropOff=convertStringToBoolean(mode);
         if (this.dragAndDropOff) this.dragger.addDragLanding(this.allTree,this);
        if (arguments.length>1)
            this._ddronr=(!convertStringToBoolean(rmode));
       };   

/**
*     @desc: set selection on node
*     @param: node - pointer to node object
*     @type: private
*     @topic: 1
*/    
   dhtmlXTreeObject.prototype._setMove=function(htmlNode,x,y){
      if (htmlNode.parentObject.span) {
      //window.status=x;
      var a1=getAbsoluteTop(htmlNode);
      var a2=getAbsoluteTop(this.allTree);

      this.dadmodec=this.dadmode;//this.dadmode;
      this.dadmodefix=0;
//#__pro_feature:01112006{
//#complex_move:01112006{
      if (this.dadmode==2)
      {

      var z=y-a1+this.allTree.scrollTop+(document.body.scrollTop||document.documentElement.scrollTop)-2-htmlNode.offsetHeight/2;
      if ((Math.abs(z)-htmlNode.offsetHeight/6)>0)
      {
         this.dadmodec=1;
         //sibbling zone
         if (z<0)
            this.dadmodefix=0-htmlNode.offsetHeight;
      }
      else this.dadmodec=0;

      }
      if (this.dadmodec==0)
         {
//#}
//#}

			var zN=htmlNode.parentObject.span;
			zN.className+=" dragAndDropRow";
			this._lastMark=zN;
//#__pro_feature:01112006{
//#complex_move:01112006{
         }
      else{
 	  	 this._clearMove();
         this.selectionBar.style.top=(a1-a2+((parseInt(htmlNode.parentObject.span.parentNode.previousSibling.childNodes[0].style.height)||18)-1)+this.dadmodefix)+"px";
         this.selectionBar.style.left="5px";
           if (this.allTree.offsetWidth>20)
                this.selectionBar.style.width=(this.allTree.offsetWidth-(_isFF?30:25))+"px";
         this.selectionBar.style.display="";
         }
//#}
//#}
         if (this.autoScroll)
         {
               //scroll down
               if ( (a1-a2-parseInt(this.allTree.scrollTop))>(parseInt(this.allTree.offsetHeight)-50) )
                  this.allTree.scrollTop=parseInt(this.allTree.scrollTop)+20;
               //scroll top
               if ( (a1-a2)<(parseInt(this.allTree.scrollTop)+30) )
                  this.allTree.scrollTop=parseInt(this.allTree.scrollTop)-20;
         }
      }
   };



/**
*     @desc: create html element for dragging
*     @type: private
*     @param: htmlObject - html node object
*     @topic: 1
*/
dhtmlXTreeObject.prototype._createDragNode=function(htmlObject,e){
      if (!this.dADTempOff) return null;

     var obj=htmlObject.parentObject;
    if (!obj.i_sel)
         this._selectItem(obj,e);

//#__pro_feature:01112006{
//#multiselect:01112006{
      this._checkMSelectionLogic();
//#}
//#}
      var dragSpan=document.createElement('div');

            var text=new Array();
            if (this._itim_dg)
                    for (var i=0; i<this._selected.length; i++)
                        text[i]="<table cellspacing='0' cellpadding='0'><tr><td><img width='18px' height='18px' src='"+this._selected[i].span.parentNode.previousSibling.childNodes[0].src+"'></td><td>"+this._selected[i].span.innerHTML+"</td></tr><table>";
            else
                text=this.getSelectedItemText().split(this.dlmtr);

            dragSpan.innerHTML=text.join("");
         dragSpan.style.position="absolute";
         dragSpan.className="dragSpanDiv";
      this._dragged=(new Array()).concat(this._selected);
     return dragSpan;
}



/**  
*     @desc: focus item in tree
*     @type: private
*     @param: item - node object
*     @edition: Professional
*     @topic: 0  
*/
dhtmlXTreeObject.prototype._focusNode=function(item){
      var z=getAbsoluteTop(item.htmlNode)-getAbsoluteTop(this.allTree);
      if ((z>(this.allTree.scrollTop+this.allTree.offsetHeight-30))||(z<this.allTree.scrollTop))
      this.allTree.scrollTop=z;
   };




              








///DragAndDrop

dhtmlXTreeObject.prototype._preventNsDrag=function(e){
   if ((e)&&(e.preventDefault)) { e.preventDefault(); return false; }
   return false;
}

dhtmlXTreeObject.prototype._drag=function(sourceHtmlObject,dhtmlObject,targetHtmlObject){

      if (this._autoOpenTimer) clearTimeout(this._autoOpenTimer);

      if (!targetHtmlObject.parentObject){
            targetHtmlObject=this.htmlNode.htmlNode.childNodes[0].childNodes[0].childNodes[1].childNodes[0];
            this.dadmodec=0;
            }

      this._clearMove();
      var z=sourceHtmlObject.parentObject.treeNod;
        if ((z)&&(z._clearMove))   z._clearMove("");

       if ((!this.dragMove)||(this.dragMove()))
          {
              if ((!z)||(!z._clearMove)||(!z._dragged)) var col=new Array(sourceHtmlObject.parentObject);
              else var col=z._dragged;

                for (var i=0; i<col.length; i++){
                   var newID=this._moveNode(col[i],targetHtmlObject.parentObject);

                   if ((newID)&&(!this._sADnD)) this.selectItem(newID,0,1);
                }

         }
        if (z) z._dragged=new Array();


}

dhtmlXTreeObject.prototype._dragIn=function(htmlObject,shtmlObject,x,y){

                    if (!this.dADTempOff) return 0;
                    var fobj=shtmlObject.parentObject;
                    var tobj=htmlObject.parentObject;
	                if ((!tobj)&&(this._ddronr)) return;
                    if ((this._onDrInFunc)&&(!this._onDrInFunc(fobj.id,tobj?tobj.id:null,fobj.treeNod,this)))
						return 0;


					if (!tobj)
		               this.allTree.className+=" selectionBox";
					else
					{
	                    if (fobj.childNodes==null){
		                	this._setMove(htmlObject,x,y);
        	             	return htmlObject;
                    	}

	                    var stree=fobj.treeNod;
    	                for (var i=0; i<stree._dragged.length; i++)
                        if (this._checkPNodes(tobj,stree._dragged[i]))
                            return 0;
//#__pro_feature:01112006{
//#complex_move:01112006{
                       tobj.span.parentNode.appendChild(this.selectionBar);
//#}
//#}
                       this._setMove(htmlObject,x,y);
                       if (this._getOpenState(tobj)<=0){
                           this._autoOpenId=tobj.id;
                             this._autoOpenTimer=window.setTimeout(new callerFunction(this._autoOpenItem,this),1000);
                                    }
					}

				return htmlObject;

}
dhtmlXTreeObject.prototype._autoOpenItem=function(e,treeObject){
   treeObject.openItem(treeObject._autoOpenId);
};
dhtmlXTreeObject.prototype._dragOut=function(htmlObject){
this._clearMove();
if (this._autoOpenTimer) clearTimeout(this._autoOpenTimer);
 }


//#__pro_feature:01112006{

/**  
*     @desc: return next node
*     @type: private
*     @param: item - node object
*     @param: mode - inner flag
*     @return: next node or -1
*     @topic: 2
*/
dhtmlXTreeObject.prototype._getNextNode=function(item,mode){
   if ((!mode)&&(item.childsCount)) return item.childNodes[0];
   if (item==this.htmlNode)
      return -1;
   if ((item.tr)&&(item.tr.nextSibling)&&(item.tr.nextSibling.nodem))
   return item.tr.nextSibling.nodem;

   return this._getNextNode(item.parentObject,true);
};

/**  
*     @desc: return last child of item (include all sub-child collections)
*     @type: private
*     @param: item - node object
*     @topic: 2  
*/
dhtmlXTreeObject.prototype._lastChild=function(item){
   if (item.childsCount)
      return this._lastChild(item.childNodes[item.childsCount-1]);
   else return item;
};

/**  
*     @desc: return previous node
*     @type: private
*     @param: item - node object
*     @param: mode - inner flag
*     @return: previous node or -1
*     @topic: 2  
*/
dhtmlXTreeObject.prototype._getPrevNode=function(node,mode){
   if ((node.tr)&&(node.tr.previousSibling)&&(node.tr.previousSibling.nodem))
   return this._lastChild(node.tr.previousSibling.nodem);

   if (node.parentObject)
      return node.parentObject;
   else return -1;
};



//#find_item:01112006{

/**
*     @desc: find tree item by text, select and focus it
*     @type: public
*     @param: searchStr - search text
*     @param: direction - 0: top -> bottom; 1: bottom -> top
*     @param: top - 1: start searching from top
*     @return: node id
*     @edition: Professional
*     @topic: 2
*/
dhtmlXTreeObject.prototype.findItem=function(searchStr,direction,top){
   var z=this._findNodeByLabel(searchStr,direction,(top?this.htmlNode:null));
   if (z){
      this.selectItem(z.id,true);
      this._focusNode(z);
      return z.id;
      }
      else return null;
}

/**  
*     @desc: find tree item by text
*     @type: public
*     @param: searchStr - search text
*     @param: direction - 0: top -> bottom; 1: bottom -> top
*     @param: top - 1: start searching from top
*     @return: node id
*     @edition: Professional
*     @topic: 2  
*/
dhtmlXTreeObject.prototype.findItemIdByLabel=function(searchStr,direction,top){
   var z=this._findNodeByLabel(searchStr,direction,(top?this.htmlNode:null));
   if (z)
      return z.id
   else return null;
}

//#smart_parsing:01112006{
/**  
*     @desc: find tree item by text in unParsed XML
*     @type: private
*     @param: node - start xml node
*     @param: field - name of xml attribute
*     @param: cvalue - search text
*     @return: true/false
*     @topic: 2  
*/
dhtmlXTreeObject.prototype.findStrInXML=function(node,field,cvalue){
   for (var i=0; i<node.childNodes.length; i++)
   {
   if (node.childNodes[i].nodeType==1)
      {
        var z=node.childNodes[i].getAttribute(field);
      if ((z)&&(z.toLowerCase().search(cvalue)!=-1))
         return true;
      if (this.findStrInXML(node.childNodes[i],field,cvalue)) return true;
      }
   }
   return false;
}
//#}

/**  
*     @desc: find tree item by text
*     @type: private
*     @param: searchStr - search text
*     @param: direction - 0: top -> bottom; 1: bottom -> top
*     @param: fromNode - node from which search begin
*     @return: node id
*     @topic: 2  
*/
dhtmlXTreeObject.prototype._findNodeByLabel=function(searchStr,direction,fromNode){
   //trim
   var searchStr=searchStr.replace(new RegExp("^( )+"),"").replace(new RegExp("( )+$"),"");
   searchStr =  new RegExp(searchStr.replace(/([\*\+\\\[\]\(\)]{1})/gi,"\\$1").replace(/ /gi,".*"),"gi");

   //get start node
   if (!fromNode)
      {
      fromNode=this._selected[0];
      if (!fromNode) fromNode=this.htmlNode;
      }

   var startNode=fromNode;

   //first step
   if (!direction){
      if ((fromNode.unParsed)&&(this.findStrInXML(fromNode.unParsed,"text",searchStr)))
      this.reParse(fromNode);
   fromNode=this._getNextNode(startNode);
   if (fromNode==-1) fromNode=this.htmlNode.childNodes[0];
   }
   else
   {
      var z2=this._getPrevNode(startNode);
      if (z2==-1) z2=this._lastChild(this.htmlNode);
      if ((z2.unParsed)&&(this.findStrInXML(z2.unParsed,"text",searchStr)))
      {   this.reParse(z2); fromNode=this._getPrevNode(startNode); }
      else fromNode=z2;
      if (fromNode==-1) fromNode=this._lastChild(this.htmlNode);
   }



   while ((fromNode)&&(fromNode!=startNode)){
      if ((fromNode.label)&&(fromNode.label.search(searchStr)!=-1))
            return (fromNode);

      if (!direction){
      if (fromNode==-1) { if (startNode==this.htmlNode) break; fromNode=this.htmlNode.childNodes[0]; }
      if ((fromNode.unParsed)&&(this.findStrInXML(fromNode.unParsed,"text",searchStr)))
         this.reParse(fromNode);
      fromNode=this._getNextNode(fromNode);
      }
      else
      {
      var z2=this._getPrevNode(fromNode);
      if (z2==-1) z2=this._lastChild(this.htmlNode);
      if ((z2.unParsed)&&(this.findStrInXML(z2.unParsed,"text",searchStr)))
         {   this.reParse(z2); fromNode=this._getPrevNode(fromNode); }
      else fromNode=z2;
      if (fromNode==-1) fromNode=this._lastChild(this.htmlNode);
      }
   }
   return null;
};

//#}
//#}

//#__pro_feature:01112006{
//#complex_move:01112006{

/**
*     @desc: set Drag-And-Drop behavior (child - drop as chils, sibling - drop as sibling, complex - complex drop behaviour )
*     @type: public
*     @edition: Professional
*     @param: mode - behavior name (child,sibling,complex)
*     @param: select - select droped node after drag-n-drop, true by default
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.setDragBehavior=function(mode,select){
		this._sADnD=(!convertStringToBoolean(select));
		switch (mode) {
			case "child": this.dadmode=0; break;
			case "sibling": this.dadmode=1; break;
			case "complex": this.dadmode=2; break;
		}    };


/**  
*     @desc: move item (inside of tree)
*     @type:  public
*     @param: itemId - item Id
*     @param: mode - moving mode (left,up,down,item_child,item_sibling,item_sibling_next,up_strict,down_strict)
*     @param: targetId - target Node in item_child and item_sibling mode
*     @param: targetTree - used for moving between trees (optional)
*     @return: node id
*     @edition: Professional
*     @topic: 2
*/
dhtmlXTreeObject.prototype.moveItem=function(itemId,mode,targetId,targetTree)
{
      var sNode=this._globalIdStorageFind(itemId);
      if (!sNode) return (0);

      switch(mode){
      case "right": alert('Not supported yet');
         break;
      case "item_child":
              var tNode=(targetTree||this)._globalIdStorageFind(targetId);
              if (!tNode) return (0);
            (targetTree||this)._moveNodeTo(sNode,tNode,0);
         break;
      case "item_sibling":
              var tNode=(targetTree||this)._globalIdStorageFind(targetId);
              if (!tNode) return (0);
            (targetTree||this)._moveNodeTo(sNode,tNode.parentObject,tNode);
         break;
      case "item_sibling_next":
              var tNode=(targetTree||this)._globalIdStorageFind(targetId);
              if (!tNode) return (0);
                  if ((tNode.tr)&&(tNode.tr.nextSibling)&&(tNode.tr.nextSibling.nodem))
                (targetTree||this)._moveNodeTo(sNode,tNode.parentObject,tNode.tr.nextSibling.nodem);
                else
                    (targetTree||this)._moveNodeTo(sNode,tNode.parentObject);
         break;
      case "left": if (sNode.parentObject.parentObject)
            this._moveNodeTo(sNode,sNode.parentObject.parentObject,sNode.parentObject);
         break;
      case "up": var z=this._getPrevNode(sNode);
               if ((z==-1)||(!z.parentObject)) return;
               this._moveNodeTo(sNode,z.parentObject,z);
         break;
      case "up_strict": var z=this._getIndex(sNode);
                          if (z!=0)
                         this._moveNodeTo(sNode,sNode.parentObject,sNode.parentObject.childNodes[z-1]);
         break;
      case "down_strict": var z=this._getIndex(sNode);
                            var count=sNode.parentObject.childsCount-2;
                            if (z==count)
                             this._moveNodeTo(sNode,sNode.parentObject);
                            else if (z<count)
                             this._moveNodeTo(sNode,sNode.parentObject,sNode.parentObject.childNodes[z+2]);
         break;
      case "down": var z=this._getNextNode(this._lastChild(sNode));
               if ((z==-1)||(!z.parentObject)) return;
               if (z.parentObject==sNode.parentObject)
                  var z=this._getNextNode(z);
                        if (z==-1){
                        this._moveNodeTo(sNode,sNode.parentObject);
                        }
                        else
                        {
                       if ((z==-1)||(!z.parentObject)) return;
                       this._moveNodeTo(sNode,z.parentObject,z);
                        }
         break;                           
      }
}

//#}
//#}







/**
*     @desc: load xml for tree branch
*     @param: id - id of parent node
*     @param: src - path to xml, optional
*     @type: private
*     @topic: 1
*/
   dhtmlXTreeObject.prototype._loadDynXML=function(id,src) {
   		src=src||this.XMLsource;
        var sn=(new Date()).valueOf();
        this._ld_id=id;
//#__pro_feature:01112006{
        if (this.xmlalb=="function"){
            if (src) src(this._escape(id));
            }
        else
        if (this.xmlalb=="name")
            this.loadXML(src+this._escape(id));
        else
        if (this.xmlalb=="xmlname")
            this.loadXML(src+this._escape(id)+".xml?uid="+sn);
        else
//#}
            this.loadXML(src+getUrlSymbol(src)+"uid="+sn+"&id="+this._escape(id));
        };


//#__pro_feature:01112006{
//#multiselect:01112006{
/**
*     @desc: enable multiselection
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @param: strict - 1 - on, 0 - off; in strict mode only items on the same level can be selected
*     @type: public
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableMultiselection=function(mode,strict) {
        this._amsel=convertStringToBoolean(mode);
        this._amselS=convertStringToBoolean(strict);
        };

/**
*     @desc: check logic of selection
*     @type: private
*     @edition: Professional
*     @topic: 0
*/
dhtmlXTreeObject.prototype._checkMSelectionLogic=function() {
            var usl=new Array();
         for (var i=0; i<this._selected.length; i++)
            for (var j=0; j<this._selected.length; j++)
                  if ((i!=j)&&(this._checkPNodes(this._selected[j],this._selected[i])))
                            usl[usl.length]=this._selected[j];

         for (var i=0; i<usl.length; i++)
             this._unselectItem(usl[i]);

         };
//#}
//#}




/**
*     @desc: check possibility of drag-and-drop
*     @type: private
*     @param: itemId - draged node id
*     @param: htmlObject - droped node object
*     @param: shtmlObject - sourse node object
*     @topic: 6
*/
    dhtmlXTreeObject.prototype._checkPNodes=function(item1,item2){
      if (item2==item1) return 1
      if (item1.parentObject) return this._checkPNodes(item1.parentObject,item2); else return 0;
   };



//#__pro_feature:01112006{
//#distributed_load:01112006{

/**
*     @desc: enable distributed parsing of long items list
*     @type: public
*     @edition: Professional
*     @param: mode - true/false
*     @param: count - critical count to start distibuting (optional)
*     @param: delay - delay between distributed calls, ms (optional)
*     @topic: 2
*/
dhtmlXTreeObject.prototype.enableDistributedParsing=function(mode,count,delay){
    this._edsbps=convertStringToBoolean(mode);
    this._edsbpsA=new Array();
    this._edsbpsC=count||10;
    this._edsbpsD=delay||250;
}
/**
*     @desc: get current state of distributed parsing
*     @type: public
*     @edition: Professional
*     @returns: true - still parsing; false - parsing finished
*     @topic: 2
*/
dhtmlXTreeObject.prototype.getDistributedParsingState=function(){
    return (!((!this._edsbpsA)||(!this._edsbpsA.length)));
}
/**
*     @desc: get current parsing state of item
*     @type: public
*     @edition: Professional
*     @returns: 1 - item already parsed; 0 - item not parsed yet; -1 - item in parsing process
*     @topic: 2
*/
dhtmlXTreeObject.prototype.getItemParsingState=function(itemId){
    var z=this._globalIdStorageFind(itemId,true,true)
    if (!z) return 0;
    if (this._edsbpsA)
        for (var i=0; i<this._edsbpsA.length; i++)
            if (this._edsbpsA[i][2]==itemId) return -1;

    return 1;
}

dhtmlXTreeObject.prototype._distributedStart=function(node,start,parentId,level,start2){
    if (!this._edsbpsA)
        this._edsbpsA=new Array();
    this._edsbpsA[this._edsbpsA.length]=[node,start,parentId,level,start2];
}

dhtmlXTreeObject.prototype._distributedStep=function(pId){
    var self=this;
    if ((!this._edsbpsA)||(!this._edsbpsA.length)) {
         self.XMLloadingWarning=0;
         return;
         }
    var z=this._edsbpsA[0];
    this.parsedArray=new Array();
    this._parseXMLTree(this,z[0],z[2],z[3],null,z[1]);
    var zkx=this._globalIdStorageFind(z[2]);
   this._redrawFrom(this,zkx,z[4],this._getOpenState(zkx));
    var chArr=this.setCheckList.split(this.dlmtr);
   for (var n=0; n<chArr.length; n++)
      if (chArr[n]) this.setCheck(chArr[n],1);

    this._edsbpsA=(new Array()).concat(this._edsbpsA.slice(1));


    if ((!this._edsbpsA.length)&&(this.onXLE)){
         window.setTimeout( function(){self.onXLE(self,pId)},1);
            self.xmlstate=0;
            }
}

dhtmlXTreeObject.prototype.enablePaging=function(mode,page_size){
    this._epgps=convertStringToBoolean(mode);
    this._epgpsC=page_size||50;
}


dhtmlXTreeObject.prototype._setPrevPageSign=function(node,pos,level,xmlnode){
    var z=document.createElement("DIV");
    z.innerHTML="Previous "+this._epgpsC+" items";
    z.className="dhx_next_button";
    var self=this;
    z.onclick=function(){
        self._prevPageCall(this);
    }
    z._pageData=[node,pos,level,xmlnode];
    var w=node.childNodes[0];
    var w2=w.span.parentNode.parentNode.parentNode.parentNode.parentNode;
    w2.insertBefore(z,w2.firstChild);
}

dhtmlXTreeObject.prototype._setNextPageSign=function(node,pos,level,xmlnode){
    var z=document.createElement("DIV");
    z.innerHTML="Next "+this._epgpsC+" items";
    z.className="dhx_next_button";
    var self=this;
    z.onclick=function(){
        self._nextPageCall(this);
    }
    z._pageData=[node,pos,level,xmlnode];
    var w=node.childNodes[node.childsCount-1];
    w.span.parentNode.parentNode.parentNode.parentNode.parentNode.appendChild(z);
}

dhtmlXTreeObject.prototype._nextPageCall=function(node){
    //delete all existing nodes
    tree.deleteChildItems(node._pageData[0].id);
    node.parentNode.removeChild(node);
    var f=this._getOpenState(node._pageData[0]);
    this._parseXMLTree(this,node._pageData[3],node._pageData[0].id,node._pageData[2],null,node._pageData[1]);
   this._redrawFrom(this,node._pageData[0],0);
    if (f>-1) this._openItem(node._pageData[0]);
    node._pageData=null;
}

dhtmlXTreeObject.prototype._prevPageCall=function(node){
    //delete all existing nodes
    tree.deleteChildItems(node._pageData[0].id);
    node.parentNode.removeChild(node);
    var f=this._getOpenState(node._pageData[0]);
    var xz=node._pageData[1]-this._epgpsC;
    if (xz<0) xz=0;
    this._parseXMLTree(this,node._pageData[3],node._pageData[0].id,node._pageData[2],null,xz);
   this._redrawFrom(this,node._pageData[0],0);
    if (f>-1) this._openItem(node._pageData[0]);
    node._pageData=null;
}

//#}
//#}




//#__pro_feature:01112006{
//#text_tree:01112006{
/**
*     @desc: replace images with text signs
*     @type: public
*     @param: mode - true/false
*     @edition: Professional
*     @topic: 1
*/
dhtmlXTreeObject.prototype.enableTextSigns=function(mode){
    this._txtimg=convertStringToBoolean(mode);
}
//#}
//#}

/**
*   @desc:  prevent caching in IE  by adding random seed to URL string
*   @param: mode - enable/disable random seed ( disabled by default )
*   @type: public
*   @topic: 0
*/
dhtmlXTreeObject.prototype.preventIECashing=function(mode){
      this.no_cashe = convertStringToBoolean(mode);
      this.XMLLoader.rSeed=this.no_cashe;
}



//#tree_extra:01112006{
//#__pro_feature:01112006{


/**
*     @desc: refresh specified tree branch (get XML from server, add new nodes, remove not used nodes)
*     @param: itemId -  top node in branch
*     @param: source - server side script , optional
*     @type: public
*     @edition: Professional
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.smartRefreshItem=function(itemId,source){
		var sNode=this._globalIdStorageFind(itemId);
		for (var i=0; i<sNode.childsCount; i++)
			sNode.childNodes[i]._dmark=true;

		this.waitUpdateXML=true;
		this._loadDynXML(itemId,source);
   };


/**
*     @desc: refresh specified tree nodes (get XML from server and updat only nodes included in itemIdList)
*     @param: itemIdList - list of node identificators
*     @param: source - server side script
*     @type: public
*     @edition: Professional
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.refreshItems=function(itemIdList,source){
   		var z=itemIdList.toString().split(this.dlmtr);
		this.waitUpdateXML=new Array();
		for (var i=0; i<z.length; i++)
			this.waitUpdateXML[z[i]]=true;
        this.loadXML((source||this.XMLsource)+getUrlSymbol(source||this.XMLsource)+"ids="+this._escape(itemIdList));
   };


/**
*     @desc: update item properties
*     @param: itemId - list of node identificators
*     @param: name - list of node identificators, optional
*     @param: im0 - list of node identificators, optional
*     @param: im1 - list of node identificators, optional
*     @param: im2 - list of node identificators, optional
*     @param: achecked - list of node identificators, optional
*     @type: public
*     @edition: Professional
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.updateItem=function(itemId,name,im0,im1,im2,achecked){
      var sNode=this._globalIdStorageFind(itemId);
      if (name) sNode.label=name;
      sNode.images=new Array(im0||this.imageArray[0],im1||this.imageArray[1],im2||this.imageArray[2]);
	  this.setItemText(itemId,name);
      if (achecked) this._setCheck(sNode,true);
      this._correctPlus(sNode);
	  sNode._dmark=false;
      return sNode;
   };

/**
*     @desc: set function called after drag-and-drap event occured
*     @param: func - event handling function
*     @type: public
*     @edition: Professional
*     @topic: 0,7
*     @event:  onDrop
*     @eventdesc:  Event raised after drag-and-drop processed. Event also raised while programmatic moving nodes.
*     @eventparam:  ID of source item (ID after inserting in tree, my be not equal to initial ID)
*     @eventparam:  ID of target item
*     @eventparam:  if node droped as sibling then contain id of item before whitch source node will be inserted
*     @eventparam:  source Tree object
*     @eventparam:  target Tree object
*/
   dhtmlXTreeObject.prototype.setDropHandler=function(func){  if (typeof(func)=="function") this.dropFunc=func; else this.dropFunc=eval(func);  };

/**
*     @desc: set function called before xml loading/parsing started
*     @param: func - event handling function
*     @type: public
*     @edition: Professional
*     @topic: 0,7
*     @event:  onXMLLoadingStart
*     @eventdesc: event fired simultaneously with starting XML parsing
*     @eventparam: tree object
*     @eventparam: item id, for which xml loaded
*/
   dhtmlXTreeObject.prototype.setOnLoadingStart=function(func){  if (typeof(func)=="function") this.onXLS=func; else this.onXLS=eval(func); };
      /**
*     @desc: set function called after xml loading/parsing ended
*     @param: func - event handling function
*     @type: public
*     @edition: Professional
*     @topic: 0,7
*     @event:  onXMLLoadingEnd
*     @eventdesc: event fired simultaneously with ending XML parsing, new items already available in tree
*     @eventparam: tree object
*     @eventparam: last parsed parent id
*/
     dhtmlXTreeObject.prototype.setOnLoadingEnd=function(func){  if (typeof(func)=="function") this.onXLE=func; else this.onXLE=eval(func); };

/**
*     @desc: disable checkbox
*     @param: itemId - Id of tree item
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @edition: Professional
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.disableCheckbox=function(itemId,mode) {
            if (typeof(itemId)!="object")
             var sNode=this._globalIdStorageFind(itemId,0,1);
            else
                var sNode=itemId;
         if (!sNode) return;
            sNode.dscheck=convertStringToBoolean(mode)?(((sNode.checkstate||0)%3)+3):((sNode.checkstate>2)?(sNode.checkstate-3):sNode.checkstate);
            this._setCheck(sNode);
                if (sNode.dscheck<3) sNode.dscheck=false;
         };

/**
*     @desc: define which script be called on dynamic loading
*     @param: mode - id for some_script?id=item_id ;  name for  some_scriptitem_id, xmlname for  some_scriptitem_id.xml ; function for calling user defined handler
*     @type: public
*     @edition: Professional
*     @topic: 1
*/
   dhtmlXTreeObject.prototype.setXMLAutoLoadingBehaviour=function(mode) {
            this.xmlalb=mode;
         };


/**
*     @desc: enable smart checkboxes ,true by default (auto checking childs and parents for 3-state checkboxes)
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableSmartCheckboxes=function(mode) { this.smcheck=convertStringToBoolean(mode); };

/**
*     @desc: return current state of XML loading
*     @type: public
*     @edition: Professional
*     @return: current state, true - xml loading now
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.getXMLState=function(){ return (this.xmlstate==1); };

/**
*     @desc: set top offset for item
*     @type: public
*     @param: itemId - id of item
*     @param: value - value of top offset
*     @edition: Professional
*     @topic: 2
*/
dhtmlXTreeObject.prototype.setItemTopOffset=function(itemId,value){
  if (typeof(itemId)=="string")
    var node=this._globalIdStorageFind(itemId);
  else
    var node=itemId;

  var z=node.span.parentNode.parentNode;
  for (var i=0; i<z.childNodes.length; i++){
    if (i!=0)
      z.childNodes[i].style.height=18+parseInt(value)+"px";
    else{
      var w=z.childNodes[i].firstChild;
      if (z.childNodes[i].firstChild.tagName!='DIV'){
          w=document.createElement("DIV");
          z.childNodes[i].insertBefore(w,z.childNodes[i].firstChild);
      }
      w.style.height=parseInt(value)+"px";
      w.style.backgroundImage="url("+this.imPath+this.lineArray[5]+")";
      w.innerHTML="&nbsp;";
      w.style.overflow='hidden';
          if (parseInt(value)==0)
            z.childNodes[i].removeChild(w);
    }
      z.childNodes[i].vAlign="bottom";
  }

}

/**
*     @desc: set size of gfx icons
*     @type:  public
*     @param: newWidth - new icon width
*     @param: newHeight - new icon height
*     @param: itemId - item Id, if skipped set default value for all new icons, optional
*     @edition: Professional
*     @topic: 2
*/
dhtmlXTreeObject.prototype.setIconSize=function(newWidth,newHeight,itemId)
{
      if (itemId){
         if ((itemId)&&(itemId.span))
            var sNode=itemId;
         else
            var sNode=this._globalIdStorageFind(itemId);

         if (!sNode) return (0);
         var img=sNode.span.parentNode.previousSibling.childNodes[0];
            img.style.width=newWidth;
            img.style.height=newHeight;
         }
      else{
         this.def_img_x=newWidth;
         this.def_img_y=newHeight;
      }
}

/**
*     @desc: get source of item's image
*     @type: public
*     @param: itemId - id of item
*     @param: imageInd - index of image ( 0 - leaf, 1 - closed folder, 2 - opened folder)
*     @param: value - value of top offset
*     @edition: Professional
*     @topic: 2
*/
dhtmlXTreeObject.prototype.getItemImage=function(itemId,imageInd,fullPath){
    var node=this._globalIdStorageFind(itemId);
    if (!node) return "";
    var img=node.images[imageInd||0];
    if (fullPath) img=this.imPath+img;
    return img;
}

/**
*     @desc: replace checkboxes with radio buttons
*     @type: public
*     @param: mode - true/false
*     @param: itemId - node for which replacement called (optional)
*     @edition: Professional
*     @topic: 1
*/
dhtmlXTreeObject.prototype.enableRadioButtons=function(itemId,mode){
    if (arguments.length==1){
        this._frbtr=convertStringToBoolean(itemId);
        this.checkBoxOff=this.checkBoxOff||this._frbtr;
        return;
        }


    var node=this._globalIdStorageFind(itemId);
    if (!node) return "";
    mode=convertStringToBoolean(mode);
    if ((mode)&&(!node._r_logic)){
            node._r_logic=true;
            for (var i=0; i<node.childsCount; i++)
                this._setCheck(node.childNodes[i],node.childNodes[i].checkstate);
        }

    if ((!mode)&&(node._r_logic)){
            node._r_logic=false;
            for (var i=0; i<node.childsCount; i++)
                this._setCheck(node.childNodes[i],node.childNodes[i].checkstate);
        }
}
/**
*     @desc: replace checkboxes with radio buttons
*     @type: public
*     @param: mode - true/false
*     @param: itemId - node for which replacement called (optional)
*     @edition: Professional
*     @topic: 1
*/
dhtmlXTreeObject.prototype.enableSingleRadioMode=function(mode){
     this._frbtrs=convertStringToBoolean(mode);
}


/**
*     @desc: configure if parent node will be expanded immideatly after child item adding
*     @type: public
*     @param: mode - true/false
*     @edition: Professional
*     @topic: 2
*/
dhtmlXTreeObject.prototype.openOnItemAdding=function(mode){
    this._hAdI=!convertStringToBoolean(mode);
}

/**
*     @desc: enable multi line items
*     @beforeInit: 1
*     @param: width - text width, if equls zero then use single lines items;
*     @type: public
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableMultiLineItems=function(width) { if (width===true) this.mlitems="100%"; else this.mlitems=width; }

/**
*     @desc: enable auto tooltips (node text as tooltip)
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @edition:Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableAutoTooltips=function(mode) { this.ettip=convertStringToBoolean(mode); };


//#dhtmlxtootip:01112006{
/**
*     @desc: enable DHTMLX tootltips
*     @param: mode - true/false
*     @edition: Professional
*     @type: public
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableDHTMLXTooltips=function(mode){  this._dhxTT=convertStringToBoolean(mode); };
//#}


/**
*     @desc: unselect item in tree
*     @type: public
*     @param: itemId - used in multi selection tree
*     @edition: Professional
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.clearSelection=function(itemId){
       if (itemId)
            this._unselectItem(this._globalIdStorageFind(itemId));
            else
            this._unselectItems();
            }

/**
*     @desc: show/hide (+/-) icon (work only for individual items, not for all tree )
*     @type: public
*     @param: itemId - id of selected item
*     @param: state - show state : 0/1
*     @edition: Professional
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.showItemSign=function(itemId,state){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;

      var z=temp.span.parentNode.previousSibling.previousSibling.previousSibling;
      if (!convertStringToBoolean(state)){
         this._openItem(temp)
         temp.closeble=false;
         temp.wsign=true;
      }
      else
      {
         temp.closeble=true;
         temp.wsign=false;
      }
      this._correctPlus(temp);
   }
/**
*     @desc: show/hide checkbox for tree item (work only for individual items, not for all tree )
*     @type: public
*     @param: itemId - id of selected item, optional, set null to change states of all items
*     @param: state - checkbox show state : 0/1
*     @edition: Professional
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.showItemCheckbox=function(itemId,state){
      if (!itemId)
		for (var i=0; i<this._globalIdStorageSize; i++)
			this.showItemCheckbox(this.globalNodeStorage[i],state);

      if (typeof(itemId)!="object")
	      itemId=this._globalIdStorageFind(itemId,0,1);

      if (!itemId) return 0;
   	  itemId.nocheckbox=!convertStringToBoolean(state);
      itemId.span.parentNode.previousSibling.previousSibling.childNodes[0].style.display=(!itemId.nocheckbox)?"":"none";
   }

/**
*     @desc: set list separator (comma by default)
*     @type: public
*     @param: separator - char or string using for separating items in lists
*     @edition: Professional
*     @topic: 0
*/
dhtmlXTreeObject.prototype.setListDelimeter=function(separator){
    this.dlmtr=separator;
}

//#}


/**
*     @desc: set escaping mode (used for escaping ID in server requests)
*     @param: mode - escaping mode ("utf8" for UTF escaping)
*     @type: public
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.setEscapingMode=function(mode){
        this.utfesc=mode;
        }


/**
*     @desc: enable item highlighting (item text highlited on mouseover)
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableHighlighting=function(mode) { this.ehlt=true; this.ehlta=convertStringToBoolean(mode); };

/**
*     @desc: called on mouse out
*     @type: private
*     @topic: 0
*/
   dhtmlXTreeObject.prototype._itemMouseOut=function(){
   		var that=this.childNodes[3].parentObject;
		var tree=that.treeNod;
 		if (tree._onMSO) that.treeNod._onMSO(that.id);
		if (that.id==tree._l_onMSI) tree._l_onMSI=null;
        if (!tree.ehlt) return;
 	    that.span.className=that.span.className.replace("_lor","");
   }
/**
*     @desc: called on mouse in
*     @type: private
*     @topic: 0
*/
   dhtmlXTreeObject.prototype._itemMouseIn=function(){
   		var that=this.childNodes[3].parentObject;
		var tree=that.treeNod;

		if ((tree._onMSI)&&(tree._l_onMSI!=that.id)) tree._onMSI(that.id);
		tree._l_onMSI=that.id;
        if (!tree.ehlt) return;
 	    that.span.className=that.span.className.replace("_lor","");
 	    that.span.className=that.span.className.replace(/((standart|selected)TreeRow)/,"$1_lor");
   }

/**
*     @desc: enable active images (clickable and dragable)
*     @beforeInit: 1
*     @param: mode - 1 - on, 0 - off;
*     @type: public
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableActiveImages=function(mode){this._aimgs=convertStringToBoolean(mode); };

/**
*     @desc: focus item in tree
*     @type: public
*     @param: itemId - item Id
*     @topic: 0
*/
dhtmlXTreeObject.prototype.focusItem=function(itemId){
      var sNode=this._globalIdStorageFind(itemId);
      if (!sNode) return (0);
      this._focusNode(sNode);
   };


/**
*     @desc: Returns the list of all children items from all next levels of tree, separated by commas.
*     @param: itemId - id of node
*     @type: public
*     @return: list of all children items from all next levels of tree, separated by commas
*     @topic: 6
*/
   dhtmlXTreeObject.prototype.getAllSubItems =function(itemId){
      return this._getAllSubItems(itemId);
   }

/**
*     @desc: Returns the list of all items which doesn't have child nodes.
*     @type: public
*     @return: list of all items which doesn't have child nodes.
*     @topic: 6
*/
	dhtmlXTreeObject.prototype.getAllChildless =function(){
		return this._getAllScraggyItems(this.htmlNode);
	}
	dhtmlXTreeObject.prototype.getAllLeafs=dhtmlXTreeObject.prototype.getAllChildless;


/**
*     @desc: Returns the list of all children items from all next levels of tree, separated by commas.
*     @param: itemId - id of node
*     @edition: Professional
*     @type: private
*     @topic: 6
*/
   dhtmlXTreeObject.prototype._getAllScraggyItems =function(node)
   {
      var z="";
      for (var i=0; i<node.childsCount; i++)
        {
            if ((node.childNodes[i].unParsed)||(node.childNodes[i].childsCount>0))
            {
                    if (node.childNodes[i].unParsed)
                        var zb=this._getAllScraggyItemsXML(node.childNodes[i].unParsed,1);
                    else
                       var zb=this._getAllScraggyItems(node.childNodes[i])

                 if (zb)
                        if (z) z+=this.dlmtr+zb;
                        else z=zb;
         }
            else
               if (!z) z=node.childNodes[i].id;
             else z+=this.dlmtr+node.childNodes[i].id;
         }
          return z;
   };





/**
*     @desc: Returns the list of all children items from all next levels of tree, separated by commas.
*     @param: itemId - id of node
*     @type: private
*     @edition: Professional
*     @topic: 6
*/
   dhtmlXTreeObject.prototype._getAllFatItems =function(node)
   {
      var z="";
      for (var i=0; i<node.childsCount; i++)
        {
            if ((node.childNodes[i].unParsed)||(node.childNodes[i].childsCount>0))
            {
             if (!z) z=node.childNodes[i].id;
                else z+=this.dlmtr+node.childNodes[i].id;

                    if (node.childNodes[i].unParsed)
                        var zb=this._getAllFatItemsXML(node.childNodes[i].unParsed,1);
                    else
                       var zb=this._getAllFatItems(node.childNodes[i])

                 if (zb) z+=this.dlmtr+zb;
         }
         }
          return z;
   };

/**
*     @desc: Returns the list of all items which has child nodes, separated by commas.
*     @type: public
*     @return: list of all items which has child nodes, separated by commas.
*     @topic: 6
*/
	dhtmlXTreeObject.prototype.getAllItemsWithKids =function(){
		return this._getAllFatItems(this.htmlNode);
	}
	dhtmlXTreeObject.prototype.getAllFatItems=dhtmlXTreeObject.prototype.getAllItemsWithKids;



/**
*     @desc: return list of identificators of nodes with checked checkboxes, separated by comma
*     @type: public
*     @return: list of ID of items with checked checkboxes, separated by comma
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.getAllChecked=function(){
      return this._getAllChecked("","",1);
   }
/**
*     @desc: return list of identificators of nodes with unchecked checkboxes, separated by comma
*     @type: public
*     @return: list of ID of items with unchecked checkboxes, separated by comma
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.getAllUnchecked=function(itemId){
        if (itemId)
            itemId=this._globalIdStorageFind(itemId);
      return this._getAllChecked(itemId,"",0);
    }


/**
*     @desc: return list of identificators of nodes with third state checkboxes, separated by comma
*     @type: public
*     @return: list of ID of items with third state checkboxes, separated by comma
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.getAllPartiallyChecked=function(){
      return this._getAllChecked("","",2);
   }


/**
*     @desc: return list of identificators of nodes with checked and third state checkboxes, separated by comma
*     @type: public
*     @return: list of ID of items with checked and third state checkboxes, separated by comma
*     @topic: 5
*/
   dhtmlXTreeObject.prototype.getAllCheckedBranches=function(){
        var temp= this._getAllChecked("","",1);
        if (temp!="") temp+=this.dlmtr;
         return temp+this._getAllChecked("","",2);
   }

/**
*     @desc: return list of identificators of nodes with checked checkboxes
*     @type: private
*     @param: node - node object (optional, used by private methods)
*     @param: list - initial identificators list (optional, used by private methods)
*     @topic: 5
*/
   dhtmlXTreeObject.prototype._getAllChecked=function(htmlNode,list,mode){
      if (!htmlNode) htmlNode=this.htmlNode;

      if (htmlNode.checkstate==mode)
         if (!htmlNode.nocheckbox)  { if (list) list+=this.dlmtr+htmlNode.id; else list=htmlNode.id;  }
      var j=htmlNode.childsCount;
      for (var i=0; i<j; i++)
      {
         list=this._getAllChecked(htmlNode.childNodes[i],list,mode);
      };
//#__pro_feature:01112006{
//#smart_parsing:01112006{
        if  (htmlNode.unParsed)
            list=this._getAllCheckedXML(htmlNode.unParsed,list,mode);
//#}
//#}

      if (list) return list; else return "";
   };

/**
*     @desc: set individual item style
*     @type: public
*     @param: itemId - node id
*     @param: style_string - valid CSS string
*     @topic: 2
*/
dhtmlXTreeObject.prototype.setItemStyle=function(itemId,style_string){
      var temp=this._globalIdStorageFind(itemId);
      if (!temp) return 0;
      if (!temp.span.style.cssText)
            temp.span.setAttribute("style",temp.span.getAttribute("style")+"; "+style_string);
        else
          temp.span.style.cssText+=(";"+style_string);
}

/**
*     @desc: create enable draging of item image with item text
*     @type: public
*     @param: mode - true/false
*     @topic: 1
*/
dhtmlXTreeObject.prototype.enableImageDrag=function(mode){
    this._itim_dg=convertStringToBoolean(mode);
}

/**
*     @desc: set function called when tree item draged over another item
*     @param: func - event handling function
*     @type: public
*     @edition: Professional
*     @topic: 4
*     @event: onDragIn
*     @eventdesc: Event raised when item draged other other dropable target
*     @eventparam:  ID draged item
*     @eventparam:  ID potencial drop landing
*     @eventparam:  source object
*     @eventparam:  target object
*     @eventreturn: true - allow drop; false - deny drop;
*/
	dhtmlXTreeObject.prototype.setOnDragIn=function(func){
        if (typeof(func)=="function") this._onDrInFunc=func; else this._onDrInFunc=eval(func);
        };

/**
*     @desc: enable/disable auto scrolling while drag-and-drop
*     @type: public
*     @param: mode - enabled/disabled
*     @topic: 0
*/
   dhtmlXTreeObject.prototype.enableDragAndDropScrolling=function(mode){ this.autoScroll=convertStringToBoolean(mode); };

//#}



/***************************************************
 * library/TabControl.js
 ***************************************************/

/**
 *	@author Integry Systems
 */

Event.fire = function(element, event)
{
   Event.observers.each(function(observer)
   {
		if(observer[1] == event && observer[0] == element)
		{
			var func = observer[2];
			func();
		}
   });
};


var TabControl = Class.create();
TabControl.prototype = {
	__instances__: {},
	activeTab: null,
	indicatorImageName: "image/indicator.gif",

	initialize: function(tabContainerName, urlParserCallback, idParserCallback, callbacks)
	{
		this.tabContainerName = tabContainerName;
		this.urlParserCallback = urlParserCallback || this.getTabUrl;
		this.idParserCallback = idParserCallback || this.getContentTabId;
		this.callbacks = callbacks ? callbacks : {};
		this.loadedContents = {};

		this.__nodes__();
		this.__bind__();

		this.decorateTabs();
		this.countersCache = {};
	},

	__nodes__: function()
	{
		this.nodes = {};
		this.nodes.tabContainer = $(this.tabContainerName);
		this.nodes.tabList = this.nodes.tabContainer.down(".tabList");
		this.nodes.tabListElements = document.getElementsByClassName("tab", this.nodes.tabList);
		this.nodes.sectionContainer = this.nodes.tabContainer.down(".sectionContainer");
		this.nodes.notabsContainer = this.nodes.tabContainer.down(".notabsContainer");
	},

	__bind__: function()
	{
		var self = this;
		this.nodes.tabListElements.each(function(li)
		{
			var link = li.down('a');
			var indicator = '<img src="' + self.indicatorImageName + '" class="tabIndicator" alt="Tab indicator" style="display: none" /> ';

			if(link.hasClassName("observed") == false)
			{
				Event.observe(link, 'click', function(e) { if(e) Event.stop(e); });
				link.addClassName("observed");
			}

			if(li.hasClassName("observed"))
			{
				return;
			}
			link.addClassName("li");
			li.onclick = function(e) {
				if(!e) e = window.event;
				if(e) Event.stop(e);

				if (e)
				{
					var keyboard = new KeyboardEvent(e);
					if (keyboard.isShift())
					{
						self.resetContent(Event.element(e).up('li'));
					}
				}

				self.handleTabClick({'target': li});

				if(Backend.Produc)
				{
					Backend.Product.hideAddForm();
				}
			}

			Event.observe(li, 'mouseover', function(e) {
				if(e) Event.stop(e);
				self.handleTabMouseOver({'target': li})
			});
			Event.observe(li, 'mouseout', function(e) {
				if(e) Event.stop(e);
				self.handleTabMouseOut({'target': li})
			});

			li.update(indicator + li.innerHTML);
		});
	},

	decorateTabs: function()
	{
		this.nodes.tabListElements.each(function(tab)
		{
			if (!tab.down('.tabCounter'))
			{
				var firstLink = tab.down('a');
				new Insertion.After(firstLink, '<span class="tabCounter"> </span>');
			}
		});
	},

	getInstance: function(tabContainerName, urlParserCallback, idParserCallback, callbacks)
	{
		if(!TabControl.prototype.__instances__[tabContainerName])
		{
			TabControl.prototype.__instances__[tabContainerName] = new TabControl(tabContainerName, urlParserCallback, idParserCallback, callbacks);
		}

		return TabControl.prototype.__instances__[tabContainerName];
	},

	handleTabMouseOver: function(args)
	{
		if (this.activeTab != args.target)
		{
			Element.removeClassName(args.target, 'inactive');
			Element.addClassName(args.target, 'hover');
		}
	},

	handleTabMouseOut: function(args)
	{
		if (this.activeTab != args.target)
		{
			Element.removeClassName(args.target, 'hover');
			Element.addClassName(args.target, 'inactive');
		}
	},

	handleTabClick: function(args)
	{
		// hide all error messages within a background process (to avoid potential tab switching delays)
		window.setTimeout(function()
			{
				document.getElementsByClassName('redMessage').each(function(message){ message.hide(); });
				document.getElementsByClassName('bugMessage').each(function(message){ message.hide(); });
			}, 10);

		if(this.callbacks.beforeClick) this.callbacks.beforeClick.call(this);
		this.activateTab(args.target);
		if(this.callbacks.afterClick) this.callbacks.afterClick.call(this);
	},

	addHistory: function()
	{
		setTimeout(function()
		{
			var locationHash = "#" + Backend.ajaxNav.getHash();
			var updateHistory = false;
			this.nodes.tabListElements.each(function(tab)
			{
				if(locationHash.indexOf("#" + tab.id) !== -1)
				{
					locationHash = locationHash.substring(0, locationHash.indexOf(tab.id) - 1);
					updateHistory = true;
					throw $break;
				}
			});

			if(locationHash.match(/__/))
			{
				locationHash = locationHash.substr(0, locationHash.length - 2);
			}

			Backend.ajaxNav.add(locationHash.substring(1) + "#" + this.activeTab.id);
		}.bind(this), dhtmlHistory.currentWaitTime * 2);
	},

	/**
	 * Reloades tab content in background (does not activate tab)
	 * 
	 * When reloading:
	 *              Existing tab content container is removed
	 *              If not active tab, content container is set to absolute position and positioned
	 *                                 outside page, because some controls can't initalize in invisible
	 *                                 container (for example editArea)
	 *              AjaxUpdater request is executed.
	 * 
	 * If tab content is not yet loaded, this will load tab content.
	 * 
	 */
	reloadTabContent: function(targetTab, onComplete)
	{
		targetTab = $(targetTab);
		if(!targetTab)
		{
			targetTab = this.nodes.tabListElements[0];
		}
		var contentId = this.idParserCallback(targetTab.id);
		if(!contentId)
		{
			return;
		}
		this.resetContent(targetTab);
		if ($(contentId))
		{
			$(contentId).remove();
		}
		new Insertion.Top(this.nodes.sectionContainer, '<div id="' + contentId + '" class="tabPageContainer ' + targetTab.id + 'Content loadedInBackgroundTab"></div>');
		this.activeContent = $(contentId);
		
		if (this.activeTab.id == targetTab.id )
		{
			this.activeContent.removeClassName("loadedInBackgroundTab");
		}
		if(!onComplete && this.callbacks.onComplete)
		{
			onComplete = this.callbacks.onComplete;
		}
		this.loadedContents[this.urlParserCallback(targetTab.down('a').href) + contentId] = true;
		new LiveCart.AjaxUpdater(
			this.urlParserCallback(targetTab.down('a').href),
			contentId, 
			targetTab.down('.tabIndicator'),
			'bottom',
			function(activeContent, onComplete, response)
			{
				if (onComplete)
				{
					onComplete(response);
				}
			}.bind(this, this.activeContent, onComplete)
		);
	},

	activateTab: function(targetTab, onComplete)
	{
		targetTab = $(targetTab);

		if(!targetTab)
		{
			targetTab = this.nodes.tabListElements[0];
		}

		// get help context
		var helpContext = document.getElementsByClassName('tabHelp', targetTab);
		if ((helpContext.length > 0) && helpContext[0].firstChild)
		{
			Backend.setHelpContext(helpContext[0].firstChild.nodeValue);
		}

		var contentId = this.idParserCallback(targetTab.id);

		// Cancel loading tab if false was returned
		if(!contentId)
		{
			return;
		}

		if(!$(contentId)) new Insertion.Top(this.nodes.sectionContainer, '<div id="' + contentId + '" class="tabPageContainer ' + targetTab.id + 'Content"></div>');

		var self = this;
		$A(this.nodes.tabListElements).each(function(tab) {
			if (tab.hasClassName('tab'))
			{
				Element.removeClassName(tab, 'active');
				Element.addClassName(tab, 'inactive');
			}
		});

		document.getElementsByClassName("tabPageContainer", this.nodes.sectionContainer).each(function(container) {
			Element.hide(container);
		})

		this.activeTab = targetTab;
		this.activeContent = $(contentId);
		this.activeContent.removeClassName("loadedInBackgroundTab");

		Element.removeClassName(this.activeTab, 'hover');
		Element.addClassName(this.activeTab, 'active');
		Element.show(contentId);

		if(!onComplete && this.callbacks.onComplete)
		{
			onComplete = this.callbacks.onComplete;
		}

		if (!this.loadedContents[this.urlParserCallback(targetTab.down('a').href) + contentId] && Element.empty($(contentId)))
		{
			this.loadedContents[this.urlParserCallback(targetTab.down('a').href) + contentId] = true;
			new LiveCart.AjaxUpdater(this.urlParserCallback(targetTab.down('a').href), contentId, targetTab.down('.tabIndicator'), 'bottom', function(activeContent, onComplete, response)
			{
				if (Form.focus)
				{
					setTimeout(function() { Form.focus(activeContent) }.bind(this, activeContent), 20);
				}

				if (onComplete)
				{
					onComplete(response);
				}

			}.bind(this, this.activeContent, onComplete));
			
			
		}
		else if(onComplete)
		{
			if (Form.focus)
			{
				Form.focus(this.activeContent);
			}

			onComplete();
		}
		else
		{
			if (Form.focus)
			{
				Form.focus(this.activeContent);
			}
		}

		this.addHistory();

		// Hide tabs if only one is visible
		this.nodes.tabList.show();
		this.hideAllTabs = true;
		this.nodes.tabListElements.each(function(tab) {
			if(targetTab != tab && tab.style.display != 'none')
			{
				this.hideAllTabs = false;
				throw $break;
			}
		}.bind(this));

		if(this.hideAllTabs)
		{
			this.nodes.tabList.hide();
		}
	},

	/**
	 * Reset content related to a given tab. When tab will be activated content must
	 * be resent
	 */
	resetContent: function(tabObj)
	{
		if (!tabObj)
		{
			return false;
		}

		var id = this.idParserCallback(tabObj.id);
		this.loadedContents[this.urlParserCallback(tabObj.down('a').href) + id] = false;
		if ($(id))
		{
			$(id).update();
		}
	},

	reloadActiveTab: function()
	{
		this.resetContent(this.activeTab);
		this.activateTab(this.activeTab);
	},

	getActiveTab: function()
	{
		return this.activeTab;
	},

	setTabUrl: function(tabId, url)
	{
		$(tabId).url = url;
	},

	setCounter: function(tab, value, hashId)
	{
		if(!this.countersCache[hashId]) this.countersCache[hashId] = {};

		tab = $(tab);

		if(!tab) return; //throw new Error('Could not find tab!');

		var counter = tab.down('.tabCounter');
		if(false === value)
		{
			counter.update('');
			delete this.countersCache[hashId][tab.id];
		}
		else
		{
			if (null == value)
			{
				value = 0;
			}

			counter.update("(" + value + ")");
			this.countersCache[hashId][tab.id] = value;
		}
	},

	setAllCounters: function(counters, hashId)
	{
		var self = this;
		$H(counters).each(function(tab) {
			self.setCounter(tab[0], tab[1], hashId);
		});
	},

	restoreCounter: function(tab, hashId)
	{
		tab = $(tab);

		if(tab && this.countersCache[hashId][tab.id] !== undefined)
		{
			this.setCounter(tab.id, this.countersCache[hashId][tab.id]);
			return true;
		}

		return false;
	},

	restoreAllCounters: function(hashId)
	{
		var restored = false;
		if(this.countersCache[hashId])
		{
			$A(this.nodes.tabListElements).each(function(tab) {
				restored = this.restoreCounter(tab, hashId) ? true : restored;
			}.bind(this));
		}

		return restored;
	},

	getCounter: function(tab)
	{
		tab = $(tab);

		if(!tab) throw new Error('Could not find tab!');

		var counter = tab.down('.tabCounter');
		var match = counter.innerHTML.match(/\((\d+)\)/);
		return match ? parseInt(match[1]) : 0;
	},

	getTabUrl: function(url)
	{
		return url;
	},

	getContentTabId: function(id)
	{
		return id + 'Content';
	},

	addNewTab: function(title)
	{
		var
			id = ["tab",new Date().getTime(), Math.round(Math.random() * 100000000)].join(""),
			li = document.createElement('li'),
			div = document.createElement('div');

		this.nodes.tabList.appendChild(li);
		li.innerHTML = '<a href="#" class="li">'+title+'</a>';
		li.addClassName("tab inactive");
		this.nodes.sectionContainer.appendChild(div);
		div.id=this.getContentTabId(id);
		div.addClassName("tabPageContainer");
		li.id = id;
		this.__nodes__();
		this.__bind__();
		this.decorateTabs();
		this.activateTab(id);
		if(this.nodes.notabsContainer)
		{
			this.nodes.sectionContainer.show();
			this.nodes.notabsContainer.hide();
		}
		return id;
	},

	setTitle: function(id, title)
	{
		$(id).down("a").innerHTML = title;
	},

	removeTab: function(id)
	{
		var
			tab = $(id),
			content = $(this.getContentTabId(id)),
			newActiveTab = tab.previous();

		tab.parentNode.removeChild(tab);
		content.parentNode.removeChild(content);
		this.__nodes__();
		if(this.nodes.tabListElements.length == 0 && this.nodes.notabsContainer)
		{
			this.nodes.sectionContainer.hide();
			this.nodes.notabsContainer.show();
			return null;
		}
		else
		{
			this.activateTab(newActiveTab);
			return this.getActiveTab();
		}
	}
}



/***************************************************
 * library/rico/ricobase.js
 ***************************************************/


//-------------------- rico.js
var Rico = {
  Version: 'current_build-54'
}

Rico.Effect = {};

Rico.URL = Class.create();
Rico.URL.prototype = {
	initialize : function(url){ 
	  pair = url.split('?')
	  this.basePath =  pair[0];
	  this.params = this.extractParams(pair[1]);
	},
	extractParams: function (paramString) {
	  if (!paramString) return {};
	  return paramString.split('&').map(function(p){return p.split('amp;').last()});
	},
	getParamValue: function (name) {
	  var matchName = name
	  var param = $A(this.params).find(function(p){return matchName==p.split('=')[0]});
	  return param ? param.split('=')[1] : null;
	},
	addParam: function(name, value){
	  this.params.push(name +"="+ value)
	},
	setParam: function(name, value){
	  var matchName = name
	  this.params = $A(this.params).reject(function(p){return matchName==p.split('=')[0]});		
	  this.addParam(name,value);
	},
	toS: function(){
	  var paramString = this.params.join('&');
	  return this.basePath + ((paramString != "") ? ("?" + paramString) : "");
	}	
}



//Rico.layout = {
//  makeYClipping: function(element) {
//	element = $(element);
//	if (element._overflowY) return;
//	element._overflow = element.style.overflow;
//	if ((Element.getStyle(element, 'yoverflow') || 'visible') != 'hidden')
//	 ;
//	  element.style.overflow-y = 'hidden';
//  },
//  undoYClipping: function(element) {
//	element = $(element);
//	if (element._overflowY) return;
//	element.style.overflow = element._overflowY;
//	element._overflowY = undefined;
//  }
//}


var RicoUtil = {

   getElementsComputedStyle: function ( htmlElement, cssProperty, mozillaEquivalentCSS) {
	  if ( arguments.length == 2 )
		 mozillaEquivalentCSS = cssProperty;

	  var el = $(htmlElement);
	  if ( el.currentStyle )
		 return el.currentStyle[cssProperty];
	  else
		 return document.defaultView.getComputedStyle(el, null).getPropertyValue(mozillaEquivalentCSS);
   },
   createXmlDocument: function() {
	  if (document.implementation && document.implementation.createDocument) {
		 var doc = document.implementation.createDocument("", "", null);

		 if (doc.readyState == null) {
			doc.readyState = 1;
			doc.addEventListener("load", function () {
			   doc.readyState = 4;
			   if (typeof doc.onreadystatechange == "function")
				  doc.onreadystatechange();
			}, false);
		 }
		 return doc;
	  }
	  if (window.ActiveXObject)
		  return Try.these(
			function() { return new ActiveXObject('MSXML2.DomDocument')   },
			function() { return new ActiveXObject('Microsoft.DomDocument')},
			function() { return new ActiveXObject('MSXML.DomDocument')	},
			function() { return new ActiveXObject('MSXML3.DomDocument')   }
		  ) || false;

	  return null;
   },

   getContentAsString: function( parentNode ) {
	  return parentNode.xml != undefined ? 
		 this._getContentAsStringIE(parentNode) :
		 this._getContentAsStringMozilla(parentNode);
   },

  _getContentAsStringIE: function(parentNode) {
	 var contentStr = "";
	 for ( var i = 0 ; i < parentNode.childNodes.length ; i++ ) {
		 var n = parentNode.childNodes[i];
		 if (n.nodeType == 4) {
			 contentStr += n.nodeValue;
		 }
		 else {
		   contentStr += n.xml;
	   }
	 }
	 return contentStr;
  },

  _getContentAsStringMozilla: function(parentNode) {
	 var xmlSerializer = new XMLSerializer();
	 var contentStr = "";
	 for ( var i = 0 ; i < parentNode.childNodes.length ; i++ ) {
		  var n = parentNode.childNodes[i];
		  if (n.nodeType == 4) { // CDATA node
			  contentStr += n.nodeValue;
		  }
		  else {
			contentStr += xmlSerializer.serializeToString(n);
		}
	 }
	 return contentStr;
  },

   toViewportPosition: function(element) {
	  return this._toAbsolute(element,true);
   },

   toDocumentPosition: function(element) {
	  return this._toAbsolute(element,false);
   }
}

//-------------------- ricoAjaxEngine.js
Rico.AjaxEngine = Class.create();

Rico.AjaxEngine.prototype = {

   initialize: function() {
	  this.ajaxElements = new Array();
	  this.ajaxObjects  = new Array();
	  this.requestURLS  = new Array();
	  this.options = {};
   },

   registerAjaxElement: function( anId, anElement ) {
	  if ( !anElement )
		 anElement = $(anId);
	  this.ajaxElements[anId] = anElement;
   },

   registerAjaxObject: function( anId, anObject ) {
	  this.ajaxObjects[anId] = anObject;
   },

   registerRequest: function (requestLogicalName, requestURL) {
	  this.requestURLS[requestLogicalName] = requestURL;
   },

   sendRequest: function(requestName, options) {
	  // Allow for backwards Compatibility
	  if ( arguments.length >= 2 )
	   if (typeof arguments[1] == 'string')
		 options = {parameters: this._createQueryString(arguments, 1)};
	  this.sendRequestWithData(requestName, null, options);
   },

   sendRequestWithData: function(requestName, xmlDocument, options) {
	  var requestURL = this.requestURLS[requestName];
	  if ( requestURL == null )
		 return;

	  // Allow for backwards Compatibility
	  if ( arguments.length >= 3 )
		if (typeof arguments[2] == 'string')
		  options.parameters = this._createQueryString(arguments, 2);

	  new Ajax.Request(requestURL, this._requestOptions(options,xmlDocument));
   },

   sendRequestAndUpdate: function(requestName,container,options) {
	  // Allow for backwards Compatibility
	  if ( arguments.length >= 3 )
		if (typeof arguments[2] == 'string')
		  options.parameters = this._createQueryString(arguments, 2);

	  this.sendRequestWithDataAndUpdate(requestName, null, container, options);
   },

   sendRequestWithDataAndUpdate: function(requestName,xmlDocument,container,options) {
	  var requestURL = this.requestURLS[requestName];
	  if ( requestURL == null )
		 return;

	  // Allow for backwards Compatibility
	  if ( arguments.length >= 4 )
		if (typeof arguments[3] == 'string')
		  options.parameters = this._createQueryString(arguments, 3);

	  var updaterOptions = this._requestOptions(options,xmlDocument);

	  new Ajax.Updater(container, requestURL, updaterOptions);
   },

   // Private -- not part of intended engine API --------------------------------------------------------------------

   _requestOptions: function(options,xmlDoc) {
	  var requestHeaders = ['X-Rico-Version', Rico.Version ];
	  var sendMethod = 'post';
	  if ( xmlDoc == null )
		if (Rico.prototypeVersion < 1.4)
		requestHeaders.push( 'Content-type', 'text/xml' );
	  else
		  sendMethod = 'get';
	  (!options) ? options = {} : '';

	  if (!options._RicoOptionsProcessed){
	  // Check and keep any user onComplete functions
		if (options.onComplete)
			 options.onRicoComplete = options.onComplete;
		// Fix onComplete
		if (options.overrideOnComplete)
		  options.onComplete = options.overrideOnComplete;
		else
		  options.onComplete = this._onRequestComplete.bind(this);
		options._RicoOptionsProcessed = true;
	  }

	 // Set the default options and extend with any user options
	 this.options = {
					 requestHeaders: requestHeaders,
					 parameters:	 options.parameters,
					 postBody:	   xmlDoc,
					 method:		 sendMethod,
					 onComplete:	 options.onComplete
					};
	 // Set any user options:
	 Object.extend(this.options, options);
	 return this.options;
   },

   _createQueryString: function( theArgs, offset ) {
	  var queryString = ""
	  for ( var i = offset ; i < theArgs.length ; i++ ) {
		  if ( i != offset )
			queryString += "&";

		  var anArg = theArgs[i];

		  if ( anArg.name != undefined && anArg.value != undefined ) {
			queryString += anArg.name +  "=" + escape(anArg.value);
		  }
		  else {
			 var ePos  = anArg.indexOf('=');
			 var argName  = anArg.substring( 0, ePos );
			 var argValue = anArg.substring( ePos + 1 );
			 queryString += argName + "=" + escape(argValue);
		  }
	  }
	  return queryString;
   },

   _onRequestComplete : function(request) {

	  if(!request)
		  return;

	  // User can set an onFailure option - which will be called by prototype
	  if (request.status != 200)
		return;

//	  var response = request.responseXML.getElementsByTagName("ajax-response");
	  var response = eval('(' + request.responseText + ')');
	  if (response == null)
	  {
		 return;		
	  }
	  this._processAjaxResponse( response);
	  
	  // Check if user has set a onComplete function
	  var onRicoComplete = this.options.onRicoComplete;
	  if (onRicoComplete != null)
		  onRicoComplete();
   },

   _processAjaxResponse: function( xmlResponseElements ) {

	  for ( var i = 0 ; i < xmlResponseElements.length ; i++ ) {
		 var responseElement = xmlResponseElements[i];

		 // only process nodes of type element.....
		 if ( responseElement.nodeType != 1 )
			continue;

		 var responseType = responseElement.getAttribute("type");
		 var responseId   = responseElement.getAttribute("id");

		 if ( responseType == "object" )
			this._processAjaxObjectUpdate( this.ajaxObjects[ responseId ], responseElement );
		 else if ( responseType == "element" )
			this._processAjaxElementUpdate( this.ajaxElements[ responseId ], responseElement );
		 else
			alert('unrecognized AjaxResponse type : ' + responseType );
	  }
   },

   _processAjaxObjectUpdate: function( ajaxObject, responseElement ) {
	  ajaxObject.ajaxUpdate( responseElement );
   },

   _processAjaxElementUpdate: function( ajaxElement, responseElement ) {
	  ajaxElement.innerHTML = RicoUtil.getContentAsString(responseElement);
   }

}

var ajaxEngine = new Rico.AjaxEngine();





/***************************************************
 * library/rico/ricoLiveGrid.js
 ***************************************************/

// Rico.LiveGridMetaData -----------------------------------------------------

Rico.LiveGridMetaData = Class.create();

Rico.LiveGridMetaData.prototype = {

	initialize: function( pageSize, totalRows, columnCount, options ) {
		this.pageSize  = pageSize;
		this.totalRows = totalRows;
		this.setOptions(options);
		this.ArrowHeight = 16;
		this.columnCount = columnCount;
	},

	setOptions: function(options) {
		this.options = {
		 largeBufferSize	: 3.0,	// 3 pages
		 nearLimitFactor	: 0.3	// 30% of buffer
		};
		Object.extend(this.options, options || {});
	},

	getPageSize: function() {
		return this.pageSize;
	},

	getTotalRows: function() {
		return this.totalRows;
	},

	setTotalRows: function(n) {
		this.totalRows = n;
	},

	getLargeBufferSize: function() {
		return parseInt(this.options.largeBufferSize * this.pageSize);
	},

	getLimitTolerance: function() {
		return parseInt(this.getLargeBufferSize() * this.options.nearLimitFactor);
	}
};

// Rico.LiveGridScroller -----------------------------------------------------

Rico.LiveGridScroller = Class.create();

Rico.LiveGridScroller.prototype = {

	initialize: function(liveGrid, viewPort) {
		this.isIE = navigator.userAgent.toLowerCase().indexOf("msie") >= 0;
		this.liveGrid = liveGrid;
		this.liveGrid.scroller = this;
		this.metaData = liveGrid.metaData;
		this.createScrollBar();
		this.scrollTimeout = null;
		this.lastScrollPos = 0;
		this.viewPort = viewPort;
		this.rows = new Array();
	},

	isUnPlugged: function() {
		return this.scrollerDiv.onscroll == null;
	},

	plugin: function() {
		this.scrollerDiv.onscroll = this.handleScroll.bindAsEventListener(this);
	},

	unplug: function() {
		this.scrollerDiv.onscroll = null;
	},

	sizeIEHeaderHack: function() {
		if ( !this.isIE ) return;
		var headerTable = $(this.liveGrid.tableId + "_header");
		if ( headerTable )
		 headerTable.rows[0].cells[0].style.width =
			(headerTable.rows[0].cells[0].offsetWidth + 1) + "px";
	},

	createScrollBar: function() {
		var visibleHeight = this.liveGrid.viewPort.visibleHeight();
		// create the outer div...
		this.scrollerDiv  = document.createElement("div");
		this.scrollerDiv.className = 'activeGridScroller';

		var scrollerStyle = this.scrollerDiv.style;
		scrollerStyle.float	= "right";
		/*scrollerStyle.left		= this.isIE ? "-6px" : "-4px";*/
		/*scrollerStyle.width		 = "19px";*/
		scrollerStyle.height		= (visibleHeight - 30) + "px";

		// create the inner div...
		this.heightDiv = document.createElement("div");
		this.heightDiv.style.width  = "1px";

		this.heightDiv.style.height = (parseInt(visibleHeight *
						this.metaData.getTotalRows()/this.metaData.getPageSize()) - 3) + "px" ;

		this.scrollerDiv.appendChild(this.heightDiv);
		this.scrollerDiv.onscroll = this.handleScroll.bindAsEventListener(this);

	 var table = this.liveGrid.table;
	 table.parentNode.parentNode.insertBefore( this.scrollerDiv, table.parentNode.nextSibling );

		// mouse scroll
		var eventName = this.isIE ? "mousewheel" : "DOMMouseScroll";
		Event.observe(table, eventName,
					function(evt) {
						 if (evt.wheelDelta>=0 || evt.detail < 0) //wheel-up
							this.scrollerDiv.scrollTop -= (2*this.viewPort.rowHeight);
						 else
							this.scrollerDiv.scrollTop += (2*this.viewPort.rowHeight);
						 this.handleScroll(false);
					}.bindAsEventListener(this),
					false);

		// keyboard scroll
		table.tabIndex = 0;
		Event.observe(table.down('tbody'), 'click', table.focus.bind(table));
		Event.observe(table, 'keypress', this.handleKeyboardScroll.bind(this));
	 },

	handleKeyboardScroll: function(e)
	{
		if (e.keyCode == Event.KEY_UP)
		{
			this.scrollerDiv.scrollTop -= (2*this.viewPort.rowHeight);
		}
		else if (e.keyCode == Event.KEY_DOWN)
		{
			this.scrollerDiv.scrollTop += (2*this.viewPort.rowHeight);
		}

		this.handleScroll(false);
	},

	updateSize: function() {
		var table = this.liveGrid.table;
		var visibleHeight = this.viewPort.visibleHeight();
		this.heightDiv.style.height = parseInt(visibleHeight *
									this.metaData.getTotalRows()/this.metaData.getPageSize()) + "px";
	},

	rowToPixel: function(rowOffset) {
		return (rowOffset / this.metaData.getTotalRows()) * this.heightDiv.offsetHeight
	},

	moveScroll: function(rowOffset) {
		this.scrollerDiv.scrollTop = this.rowToPixel(rowOffset);
		if ( this.metaData.options.onscroll )
		 this.metaData.options.onscroll( this.liveGrid, rowOffset );
	},

	handleScroll: function(noRefresh) {

	if ( this.scrollTimeout )
		 clearTimeout( this.scrollTimeout );

	var scrollDiff = this.lastScrollPos-this.scrollerDiv.scrollTop;
	if (scrollDiff != 0.00) {
		 var r = this.scrollerDiv.scrollTop % this.viewPort.rowHeight;
		 if (r != 0) {
			this.unplug();
			if ( scrollDiff < 0 ) {
			 this.scrollerDiv.scrollTop += (this.viewPort.rowHeight-r);
			} else {
			 this.scrollerDiv.scrollTop -= r;
			}
			this.plugin();
		 }
	}
	var contentOffset = parseInt(this.scrollerDiv.scrollTop / this.viewPort.rowHeight);

	if (typeof(noRefresh) == 'object')
	{
		this.liveGrid.requestContentRefresh(contentOffset);
	}

	this.viewPort.scrollTo(this.scrollerDiv.scrollTop);

	if ( this.metaData.options.onscroll )
		 this.metaData.options.onscroll( this.liveGrid, contentOffset );

	this.scrollTimeout = setTimeout(this.scrollIdle.bind(this), 300 );
	this.lastScrollPos = this.scrollerDiv.scrollTop;

	},

	scrollIdle: function() {
		if ( this.metaData.options.onscrollidle )
		 this.metaData.options.onscrollidle();
	},

	getOffset: function()
	{
		return parseInt(this.scrollerDiv.scrollTop / this.viewPort.rowHeight);
	}
};

// Rico.LiveGridBuffer -----------------------------------------------------

Rico.LiveGridBuffer = Class.create();

Rico.LiveGridBuffer.prototype = {

	initialize: function(metaData, viewPort) {
		this.startPos = 0;
		this.size	 = 0;
		this.metaData = metaData;
		this.rows	 = new Array();
		this.rowCache = new Object();
		this.updateInProgress = false;
		this.viewPort = viewPort;
		this.maxBufferSize = metaData.getLargeBufferSize() * 2;
		this.maxFetchSize = metaData.getLargeBufferSize();
		this.lastOffset = 0;
	},

	getBlankRow: function() {
		if (!this.blankRow ) {
		 this.blankRow = new Array();
		 for ( var i=0; i < this.metaData.columnCount ; i++ )
			this.blankRow[i] = "&nbsp;";
	 }
	 return this.blankRow;
	},

	loadRows: function(data)
	{
		var data = this.viewPort.liveGrid.activeGrid.getRows(data);

		var newRows = data['data'];

		if ((data["totalCount"] != undefined) && (data["totalCount"] != null))
		{
			this.viewPort.liveGrid.setTotalRows(data["totalCount"]);
			this.size = data["totalCount"];
		}

		// Check if user has set a onRefreshComplete function
		var onRefreshComplete = this.viewPort.liveGrid.options.onRefreshComplete;
		if (onRefreshComplete != null)
		{
			onRefreshComplete();
		}

		return newRows;
	},

	update: function(ajaxResponse, start)
	{
		var newRows = this.loadRows(ajaxResponse);

		var bufferSize = this.metaData.getLargeBufferSize();

		var chunks = this.getChunkIDs(start);
		var chunk;

		if (newRows.length > bufferSize)
		{
			chunks[1]++;
		}

		for (k = 0; k <= 1; k++)
		{
			if ((1 == k) && (chunks[0] == chunks[1]))
			{
				continue;
			}

			if (!this.isCached(chunks[k]))
			{
				chunk = new Array();
				i = -1;
				for (c = (k * bufferSize); i <= bufferSize; c++)
				{
					if (!newRows[c])
					{
						break;
					}

					i++;
					chunk[i] = newRows[c];
				}

				if (chunk.length > bufferSize)
				{
					chunk = chunk.slice(0, bufferSize);
				}
				//chunk = newRows.slice((k * bufferSize), bufferSize);

				// do not store incomplete chunks
				if (0 == k || (chunk.length == bufferSize))
				{
					this.setCache(chunks[k], chunk);
				}
			}
		}

		this.startPos = 0;

		this.rows = this.getRows(start, this.viewPort.rows.length);
	},

	clear: function()
	{
		this.rows = new Array();
		this.rowCache = new Object();
		this.startPos = 0;
		this.size = 0;
	},

	isOverlapping: function(start, size) {
		return ((start < this.endPos()) && (this.startPos < start + size)) || (this.endPos() == 0)
	},

	isNearingTopLimit: function(position)
	{
		var chunks = getChunkIDs(position);
		return (this.isCached(chunks[0]) && this.isCached(chunks[1]));
	},

	endPos: function() {
		return this.startPos + this.rows.length;
	},

	isNearingBottomLimit: function(position) {
		return this.endPos() - (position + this.metaData.getPageSize()) < this.metaData.getLimitTolerance();
	},

	isAtTop: function() {
		return this.startPos == 0;
	},

	isAtBottom: function() {
		return this.endPos() == this.metaData.getTotalRows();
	},

	isNearingLimit: function(position) {
		return ( !this.isAtTop()	&& this.isNearingTopLimit(position)) ||
			 ( !this.isAtBottom() && this.isNearingBottomLimit(position) )
	},

	getFetchSize: function(offset)
	{
		// determine which chunks are required
		var chunks = this.getChunkIDs(offset);

		var bufferSize = this.metaData.getLargeBufferSize();

		var size = $H();

		for (k = 0; k <= 1; k++)
		{
			if (!this.isCached(chunks[k]))
			{
				size[chunks[k]] = bufferSize;
			}
		}

		var totalSize = 0;
		size.each(function(k)
		{
			totalSize += k.value;
		});

		return totalSize;
	},

	getFetchOffset: function(offset)
	{
		// determine which chunks are required
		var chunks = this.getChunkIDs(offset);

		// check if this offset hasn't been cached already
		offset = -1;

		// determine offset start
		for (k = 1; k >= 0; k--)
		{
			if (!this.isCached(chunks[k]))
			{
				offset = this.getChunkOffset(chunks[k]);
				if (this.size && (offset >= this.size))
				{
					offset = -1;
				}
			}
		}

		this.lastOffset = offset;
		return offset;
	},

	/**
	 *  Determine if the chunk has already been cached
	 */
	isCached: function(chunkID)
	{
		return (this.rowCache[chunkID] != undefined);
	},

	getChunkOffset: function(chunkID)
	{
		return chunkID * this.metaData.getLargeBufferSize();
	},

	/**
	 *  Get grid data chunk IDs by offset row ID
	 */
	getChunkIDs: function(offset)
	{
		if (offset >= this.size && this.size > 0)
		{
			offset = this.size - this.metaData.getPageSize() - 1;
		}

		var bufferSize = this.metaData.getLargeBufferSize();

		if (offset < 0)
		{
			offset = 0;
		}

		var startBufferId = Math.floor(offset / bufferSize);

		var endOffset = offset + this.metaData.getPageSize();

		if (endOffset > this.size)
		{
			endOffset = this.size - 1;
		}

		if (endOffset < 0)
		{
			endOffset = 0;
		}

		var endBufferId = Math.floor(endOffset / bufferSize);

		return new Array(startBufferId, endBufferId);
	},

	/**
	 *  Store chunk data to cache
	 */
	setCache: function(chunkID, rowData)
	{
		this.rowCache[chunkID] = rowData;
	},

	getChunk: function(chunkID)
	{
		return this.rowCache[chunkID];
	},

	getRows: function(start, count)
	{
		if (this.size <= start)
		{
			start = this.size - this.metaData.getLargeBufferSize();
			//start = start - this.metaData.getLargeBufferSize();
		}

		var chunks = this.getChunkIDs(start);

		// make sure the chunks are cached
		for (k = 0; k <= 1; k++)
		{
			if (!this.isCached(chunks[k]))
			{
				this.viewPort.liveGrid.requestContentRefresh(start);
				return new Array();
			}
		}

		var rows = $H();

		for (k = 0; k <= 1; k++)
		{
			var chunkOffset = start - this.getChunkOffset(chunks[k]);

			var chunk = this.getChunk(chunks[k]);

			if (chunkOffset >= 0)
			{
				rows[chunks[k]] = chunk.slice(chunkOffset);
			}
			else
			{
				rows[chunks[k]] = chunk.slice(0, 15 + chunkOffset);
			}
		}

		var allRows = new Array();
		rows.each(function(k)
		{
			allRows = allRows.concat(k.value);
		});

		return allRows;
	}
};


//Rico.GridViewPort --------------------------------------------------
Rico.GridViewPort = Class.create();

Rico.GridViewPort.prototype = {

	initialize: function(table, rowHeight, visibleRows, buffer, liveGrid) {
		this.lastDisplayedStartPos = 0;
		this.div = table.parentNode;
		this.table = table
		this.rowHeight = rowHeight;
		this.div.style.height = (this.rowHeight * visibleRows) + "px";
//		this.div.style.overflow = "hidden";
		this.buffer = buffer;
		this.buffer.viewPort = this;
		this.liveGrid = liveGrid;
		this.visibleRows = visibleRows + 1;
		this.lastPixelOffset = 0;
		this.startPos = 0;

		this.rows = this.table.down('tbody').getElementsByTagName('tr');
	},

	populateRow: function(htmlRow, row)
	{
		if (!htmlRow || !row)
		{
			return false;
		}

		if (!htmlRow.checkBox && row[0])
		{
			htmlRow.cells[0].innerHTML = row[0];
			htmlRow.checkBox = htmlRow.cells[0].down('input');
		}

		if (row[0] != '&nbsp;')
		{
			if (!htmlRow.cells[0].firstChild)
			{
				htmlRow.cells[0].appendChild(htmlRow.checkBox);
			}
		}
		else
		{
			htmlRow.cells[0].innerHTML = '';
		}

		for (var j=1; j < row.length; j++)
		{
			htmlRow.cells[j].innerHTML = row[j]
		}

		if (row.id)
		{
			htmlRow.recordId = row.id;
			htmlRow.checkBox.name = 'item[' + row.id + ']';
		}
	},

	bufferChanged: function() {
		this.refreshContents( parseInt(this.lastPixelOffset / this.rowHeight));
	},

	clearRows: function() {
		if (!this.isBlank) {
		 this.liveGrid.table.className = this.liveGrid.options.loadingClass;
		 for (var i=0; i < this.visibleRows; i++)
			this.populateRow(this.rows[i], this.buffer.getBlankRow());
		 this.isBlank = true;
		}
	},

	clearContents: function() {
		this.clearRows();
		this.scrollTo(0);
		this.startPos = 0;
		this.lastStartPos = -1;
	},

	refreshContents: function(startPos) {

		this.isBlank = false;
		var viewPrecedesBuffer = this.buffer.startPos > startPos
		var contentStartPos = viewPrecedesBuffer ? this.buffer.startPos: startPos;
		var contentEndPos = (this.buffer.startPos + this.buffer.size < startPos + this.visibleRows)
								 ? this.buffer.startPos + this.buffer.size
								 : startPos + this.visibleRows;
		var rowSize = contentEndPos - contentStartPos;
		var rows = this.buffer.getRows(contentStartPos, rowSize );
		var blankSize = this.visibleRows - rowSize;
		var blankOffset = viewPrecedesBuffer ? 0: rowSize;
		var contentOffset = viewPrecedesBuffer ? blankSize: 0;

		for (var i=0; i < rows.length; i++) {//initialize what we have
		this.populateRow(this.rows[i + contentOffset], rows[i]);
		}

		for (var i=0; (i < blankSize + 5) && (i < this.rows.length); i++) {// blank out the rest
		this.populateRow(this.rows[i + blankOffset], this.buffer.getBlankRow());
		}

		this.isPartialBlank = blankSize > 0;
		this.lastRowPos = startPos;

		 this.liveGrid.table.className = this.liveGrid.options.tableClass;
		 this.liveGrid.onUpdate();

		// there are some problems with cell content alignment in Firefox,
		// which can be fixed by redrawing the table
		this.rows[0].style.border = '3px solid grey;';
		this.rows[0].style.border = '';

	},

	scrollTo: function(pixelOffset) {
		if (this.lastPixelOffset == pixelOffset)
		 return;

		this.refreshContents(parseInt(pixelOffset / this.rowHeight))

		this.lastPixelOffset = pixelOffset;
	},

	visibleHeight: function() {
		return parseInt(RicoUtil.getElementsComputedStyle(this.div, 'height'));
	}

};


Rico.LiveGridRequest = Class.create();
Rico.LiveGridRequest.prototype = {
	initialize: function( requestOffset, options ) {
		this.requestOffset = requestOffset;
	}
};

// Rico.LiveGrid -----------------------------------------------------

Rico.LiveGrid = Class.create();

Rico.LiveGrid.prototype = {

	fetchRequests: new Object(),

	initialize: function( tableId, visibleRows, totalRows, url, options, ajaxOptions ) {

	 this.options = {
				tableClass:			 $(tableId).className,
				loadingClass:		 $(tableId).className,
				scrollerBorderRight: '1px solid #ababab',
				bufferTimeout:		20000,
				sortAscendImg:		'images/sort_asc.gif',
				sortDescendImg:		 'images/sort_desc.gif',
				ajaxSortURLParms:	 [],
				onRefreshComplete:	null,
				requestParameters:	null,
				inlineStyles:		 true
				};
		Object.extend(this.options, options || {});

		this.ajaxOptions = {parameters: null};
		Object.extend(this.ajaxOptions, ajaxOptions || {});

		this.sort = new Rico.LiveGridSort(tableId, this.options)

		this.tableId	 = tableId;
		this.table		 = $(tableId);

		this.addLiveGridHtml();

		var columnCount  = this.sort.headerTable.rows[0].cells.length;
		this.metaData	= new Rico.LiveGridMetaData(visibleRows, totalRows, columnCount, options);
		this.buffer		= new Rico.LiveGridBuffer(this.metaData);

		var rowCount = this.table.down('tbody').rows.length;
		this.viewPort =  new Rico.GridViewPort(this.table,
											'30',
											visibleRows,
											this.buffer, this);
		this.scroller	= new Rico.LiveGridScroller(this,this.viewPort);
		this.options.sortHandler = this.sortHandler.bind(this);

		this.processingRequest = null;
		this.unprocessedRequest = null;

		this.url = url;
	},

	init: function()
	{
		this.initAjax(this.url);
		if ( this.options.prefetchBuffer || this.options.prefetchOffset > 0) {
		 var offset = 0;
		 if (this.options.offset ) {
			offset = this.options.offset;
			this.scroller.moveScroll(offset);
			this.viewPort.scrollTo(this.scroller.rowToPixel(offset));
		 }
		 if (this.options.sortCol) {
			 this.sortCol = options.sortCol;
			 this.sortDir = options.sortDir;
		 }
		}
	},

	onUpdate: function()
	{
	},

	onBeginDataFetch: function()
	{
	},

	addLiveGridHtml: function() {

/*
	 // Check to see if need to create a header table.
	 if (this.table.getElementsByTagName("thead").length > 0 && !'this code sucks'){
		 // Create Table this.tableId+'_header'
		 var tableHeader = this.table.cloneNode(true);
		 tableHeader.setAttribute('id', this.tableId+'_header');
		 tableHeader.setAttribute('class', this.table.className+'_header');

		 // Clean up and insert
		 for( var i = 0; i < tableHeader.tBodies.length; i++ )
		 tableHeader.removeChild(tableHeader.tBodies[i]);
		 this.table.deleteTHead();
		 this.table.parentNode.insertBefore(tableHeader,this.table);
	 }
*/
	this.table.setAttribute('id', this.tableId+'_header');
	this.table.setAttribute('class', this.table.className+'_header');

	new Insertion.Before(this.table, "<div id='"+this.tableId+"_container'></div>");
	this.table.previousSibling.appendChild(this.table);
	new Insertion.Before(this.table,"<div id='"+this.tableId+"_viewport' class='activeGrid_viewport' style='float:left;'></div>");
	this.table.previousSibling.appendChild(this.table);
	},


	resetContents: function() {
		this.scroller.moveScroll(0);
		this.buffer.clear();
		this.viewPort.clearContents();
		this.fetchRequests = new Object()
	},

	sortHandler: function(column) {
		if(!column) return ;
		this.sortCol = column.name;
		this.sortDir = column.currentSort;

		$A(this.table.getElementsByClassName('sortedColumn')).each
		(
			function(element)
			{
				element.removeClassName('sortedColumn');
			}
		);

		var cells = $A(this.table.getElementsByClassName('cell_' + column.name.replace('.', '_')));
		var sortDirection = this.sortDir == 'ASC' ? 0 : cells.length;
		cells.each
		(
			function(element, index)
			{
				$A(element.className.match(/sort[0-9]+/g)).each
				(
					function(className)
					{
						element.removeClassName(className);
					}
				)

				element.addClassName('sortedColumn');
				element.addClassName('sort' + Math.abs(sortDirection - index));
			}
		);

		this.resetContents();
		this.requestContentRefresh(0)
	},

	adjustRowSize: function() {

	},

	setTotalRows: function( newTotalRows ) {
		this.metaData.setTotalRows(newTotalRows);
		this.resetContents();
		this.scroller.updateSize();
		this.scroller.handleScroll(true);
	},

	initAjax: function(url) {
		ajaxEngine.registerRequest( this.tableId + '_request', url );
		ajaxEngine.registerAjaxObject( this.tableId + '_updater', this );
	},

	invokeAjax: function() {
	},

	handleTimedOut: function() {
		//server did not respond in 4 seconds... assume that there could have been
		//an error or something, and allow requests to be processed again...
		this.processingRequest = null;
		//this.processQueuedRequest();
	},

	getQueryString: function(fetchSize, bufferStartPos)
	{
		var queryString = null;

		if (this.options.requestParameters)
		{
			queryString = this._createQueryString(this.options.requestParameters, 0);
		}

		queryString = (queryString == null) ? '' : queryString+'&';

		queryString = queryString+'id='+this.tableId;

		if (fetchSize)
		{
			queryString += '&page_size=' + fetchSize;
		}

		if (bufferStartPos)
		{
			queryString += '&offset=' + bufferStartPos;
		}

		if (this.sortCol)
		{
			queryString = queryString+'&sort_col='+escape(this.sortCol)+'&sort_dir='+this.sortDir;
		}

		return queryString;
	},

	fetchBuffer: function(offset)
	{
		var bufferStartPos = this.buffer.getFetchOffset(offset);

		if (bufferStartPos < 0)
		{
			return false;
		}

		if (this.fetchRequests[bufferStartPos])
		{
			return false;
		}

		var fetchSize = this.buffer.getFetchSize(offset);
		var partialLoaded = false;

		var queryString = this.getQueryString(fetchSize, bufferStartPos);

		if (fetchSize < 1)
		{
			return false;
		}

		this.ajaxOptions.parameters = queryString;
		this.ajaxOptions.method = 'post';

		var url = ajaxEngine.requestURLS[this.tableId + '_request'];

		this.fetchRequests[bufferStartPos] = new RicoGridUpdate(url, this, bufferStartPos);

		this.timeoutHandler = setTimeout( this.handleTimedOut.bind(this), this.options.bufferTimeout);
	},

	onRequestComplete: function(ajaxRequest, bufferStartPos)
	{
		this.fetchRequests[bufferStartPos] = 0;
		this.ajaxUpdate(ajaxRequest, bufferStartPos);
	},

	setRequestParams: function() {
		this.options.requestParameters = [];
		for ( var i=0 ; i < arguments.length ; i++ )
		 this.options.requestParameters[i] = arguments[i];
	},

	requestContentRefresh: function(contentOffset) {
		this.fetchBuffer(contentOffset);
	},

	ajaxUpdate: function(ajaxResponse, bufferStartPos) {
		try {
		 clearTimeout( this.timeoutHandler );
		 this.buffer.update(ajaxResponse.responseText, bufferStartPos);
		 this.viewPort.bufferChanged();
		}
		catch(err) {
		 //console. log(err);
		}
	},

	_createQueryString: function( theArgs, offset ) {
		var queryString = ""
		if (!theArgs)
			return queryString;

		for ( var i = offset ; i < theArgs.length ; i++ ) {
			if ( i != offset )
			queryString += "&";

			var anArg = theArgs[i];

			if ( anArg.name != undefined && anArg.value != undefined ) {
			queryString += anArg.name +  "=" + escape(anArg.value);
			}
			else {
			 var ePos  = anArg.indexOf('=');
			 var argName  = anArg.substring( 0, ePos );
			 var argValue = anArg.substring( ePos + 1 );
			 queryString += argName + "=" + escape(argValue);
			}
		}
		return queryString;
	}

};

//-------------------- ricoLiveGridSort.js
Rico.LiveGridSort = Class.create();

Rico.LiveGridSort.prototype = {

	initialize: function(headerTableId, options) {
		this.headerTableId = headerTableId;
		this.headerTable	= $(headerTableId);
		this.options = options;
		this.setOptions();
		this.applySortBehavior();

		if ( this.options.sortCol ) {
		 this.setSortUI( this.options.sortCol, this.options.sortDir );
		}
	},

	setSortUI: function( columnName, sortDirection ) {
		var cols = this.options.columns;
		for ( var i = 0 ; i < cols.length ; i++ ) {
		 if ( cols[i].name == columnName ) {
			this.setColumnSort(i, sortDirection);
			break;
		 }
		}
	},

	setOptions: function() {
		// preload the images...
		new Image().src = this.options.sortAscendImg;
		new Image().src = this.options.sortDescendImg;

		this.sort = this.options.sortHandler;
		if ( !this.options.columns )
		 this.options.columns = this.introspectForColumnInfo();
		else {
		 // allow client to pass { columns: [ ["a", true], ["b", false] ] }
		 // and convert to an array of Rico.TableColumn objs...
		 this.options.columns = this.convertToTableColumns(this.options.columns);
		}
	},

	applySortBehavior: function() {
		var headerRow	= this.headerTable.rows[0];
		var headerCells = headerRow.cells;
		for ( var i = 0 ; i < headerCells.length ; i++ ) {
		 this.addSortBehaviorToColumn( i, headerCells[i] );
		}
	},

	addSortBehaviorToColumn: function( n, cell ) {
		if ( this.options.columns[n].isSortable() ) {
		 cell.id			= this.headerTableId + '_' + n;
		 cell.style.cursor  = 'pointer';
		 cell.onclick		 = this.headerCellClicked.bindAsEventListener(this);
		 var sortImg = document.createElement('div');
		 sortImg.innerHTML = '<span class="sortImg" id="' + this.headerTableId + '_img_' + n + '"></span>';
		 cell.firstDescendant().appendChild(sortImg.firstChild);
		}
	},

	/**
	 *  Handles onclick event for header cell - triggers list sorting
	 */
	headerCellClicked: function(evt)
	{
		var eventTarget = Event.element(evt);
		while ('TH' != eventTarget.tagName)
		{
			eventTarget = eventTarget.parentNode;
		}

		var cellId = eventTarget.id;
		var columnNumber = parseInt(cellId.substring( cellId.lastIndexOf('_') + 1 ));
		var sortedColumnIndex = this.getSortedColumnIndex();

		if ( sortedColumnIndex != -1 )
		{
			if ( sortedColumnIndex != columnNumber )
			{
				this.removeColumnSort(sortedColumnIndex);
				this.setColumnSort(columnNumber, Rico.TableColumn.SORT_ASC);
			}
			else
			{
				this.toggleColumnSort(sortedColumnIndex);
			}
		}
		else
		{
			this.setColumnSort(columnNumber, Rico.TableColumn.SORT_ASC);
		}

		if (this.options.sortHandler)
		{
			this.options.sortHandler(this.options.columns[columnNumber]);
		}
	},

	removeColumnSort: function(n) {
		$(this.headerTableId + '_' + n).removeClassName('sorted');
		this.options.columns[n].setUnsorted();
		this.setSortImage(n);
	},

	setColumnSort: function(n, direction) {
		if(isNaN(n)) return ;
		$(this.headerTableId + '_' + n).addClassName('sorted');
		this.options.columns[n].setSorted(direction);
		this.setSortImage(n);
	},

	toggleColumnSort: function(n) {
		this.options.columns[n].toggleSort();
		this.setSortImage(n);
	},

	setSortImage: function(n) {
		var sortDirection = this.options.columns[n].getSortDirection();

		var sortImageSpan = $( this.headerTableId + '_img_' + n );
		if ( sortDirection == Rico.TableColumn.UNSORTED )
		 sortImageSpan.innerHTML = '';
		else if ( sortDirection == Rico.TableColumn.SORT_ASC )
		 sortImageSpan.innerHTML = '<img src="'	+ this.options.sortAscendImg + '"/>';
		else if ( sortDirection == Rico.TableColumn.SORT_DESC )
		 sortImageSpan.innerHTML = '<img src="'	+ this.options.sortDescendImg + '"/>';
	},

	getSortedColumnIndex: function() {
		var cols = this.options.columns;
		for ( var i = 0 ; i < cols.length ; i++ ) {
		 if ( cols[i].isSorted() )
			return i;
		}

		return -1;
	},

	introspectForColumnInfo: function() {
		var columns = new Array();
		var headerRow	= this.headerTable.rows[0];
		var headerCells = headerRow.cells;
		for ( var i = 0 ; i < headerCells.length ; i++ )
		 columns.push( new Rico.TableColumn( this.deriveColumnNameFromCell(headerCells[i],i), true ) );
		return columns;
	},

	convertToTableColumns: function(cols) {
		var columns = new Array();
		for ( var i = 0 ; i < cols.length ; i++ )
		 columns.push( new Rico.TableColumn( cols[i][0], cols[i][1] ) );
		return columns;
	},

	deriveColumnNameFromCell: function(cell,columnNumber) {
		if (document.getElementsByClassName('fieldName', cell).length > 0)
		{
			return document.getElementsByClassName('fieldName', cell)[0].firstChild.nodeValue;
		}
	}
};

Rico.TableColumn = Class.create();

Rico.TableColumn.UNSORTED  = 0;
Rico.TableColumn.SORT_ASC  = "ASC";
Rico.TableColumn.SORT_DESC = "DESC";

Rico.TableColumn.prototype = {
	initialize: function(name, sortable) {
		this.name		= name;
		this.sortable	= sortable;
		this.currentSort = Rico.TableColumn.UNSORTED;
	},

	isSortable: function() {
		return this.sortable;
	},

	isSorted: function() {
		return this.currentSort != Rico.TableColumn.UNSORTED;
	},

	getSortDirection: function() {
		return this.currentSort;
	},

	toggleSort: function() {
		if ( this.currentSort == Rico.TableColumn.UNSORTED || this.currentSort == Rico.TableColumn.SORT_DESC )
		 this.currentSort = Rico.TableColumn.SORT_ASC;
		else if ( this.currentSort == Rico.TableColumn.SORT_ASC )
		 this.currentSort = Rico.TableColumn.SORT_DESC;
	},

	setUnsorted: function(direction) {
		this.setSorted(Rico.TableColumn.UNSORTED);
	},

	setSorted: function(direction) {
		// direction must by one of Rico.TableColumn.UNSORTED, .SORT_ASC, or .SORT_DESC...
		this.currentSort = direction;
	}

};

/**
 *  Grid data download handler
 */
RicoGridUpdate = Class.create();
RicoGridUpdate.prototype =
{
	bufferStartPos: 0,

	grid: null,

	opts: null,

	url: '',

	/**
	 *  @todo	Instead of (or in addition of) using the timeout, check the mouse button click status.
	 *			As soon as the mouse button is released, it means (?) that the grid is no longer being scrolled
	 *			and the data download could start right away
	 */
	initialize: function(url, grid, bufferStartPos)
	{
		this.bufferStartPos = bufferStartPos;
		this.grid = grid;
		this.opts = grid.ajaxOptions;
		this.opts.onComplete = this.onComplete.bind(this);
		this.url = url;

		if (0 == bufferStartPos)
		{
			// initial load - without delay
			this.process();
		}
		else
		{
			// download the data after 0.3 seconds
			setTimeout(this.process.bind(this), 150);
		}
	},

	process: function()
	{
		var currentOffset = this.grid.buffer.getFetchOffset(this.grid.scroller.getOffset());
		var chunk1 = this.grid.buffer.getChunkIDs(currentOffset);
		var chunk2 = this.grid.buffer.getChunkIDs(this.bufferStartPos);

		// make sure the offset hasn't changed already
		if ((chunk1[0] == chunk2[0]) && (chunk1[1] == chunk2[1]))
		{
			this.grid.onBeginDataFetch();
			new Ajax.Request(this.url, this.opts);
		}
		else
		{
			this.grid.fetchRequests[this.bufferStartPos] = null;
		}
	},

	onComplete: function(ajaxRequest)
	{
		this.grid.onRequestComplete(ajaxRequest, this.bufferStartPos);
	}
}


/***************************************************
 * backend/Category.js
 ***************************************************/

/**
 *	@author Integry Systems
 */

if (Backend == undefined)
{
	var Backend = {}
}

Backend.Category = {

	/**
	 * category tab controll instance
	 */
	tabControl: null,

	/**
	 * Category tree browser instance
	 */
	treeBrowser: null,

	/**
	 * Id of currenty selected category. Used for category tab content switching
	 */
	activeCategoryId: null,

	links: {},

	/**
	 * Category module initialization
	 */
	init: function()
	{
		this.initCategoryBrowser();
		this.initTabs();
		this.initTreeControls();
	},

	initPage: function()
	{
		// check for bookmark
		if (!Backend.getHash())
		{
			window.location.hash = $('tabProducts') ?  'cat_1#tabProducts__' : 'cat_1#tabMainDetails__';
			Backend.Breadcrumb.display(1);
		}

		Backend.Category.treeBrowser.showFeedback =
			function(itemId)
			{
				if (!this.iconUrls)
				{
					this.iconUrls = new Object();
				}

				if (!this.iconUrls[itemId])
				{
					this.iconUrls[itemId] = this.getItemImage(itemId, 0, 0);
					var img = this._globalIdStorageFind(itemId).htmlNode.down('img', 2);
					img.originalSrc = img.src;
					img.src = 'image/indicator.gif';
				}
			}

		Backend.Category.treeBrowser.hideFeedback =
			function(itemId)
			{
				if (null != this.iconUrls[itemId])
				{
					this.iconUrls[itemId] = this.getItemImage(itemId, 0, 0);
					var img = this._globalIdStorageFind(itemId).htmlNode.down('img', 2);
					img.src = img.originalSrc;
					this.iconUrls[itemId] = null;
				}
			}

		var elements = Backend.getHash().split('#');

		if (elements[1].substr(0, 4) == 'cat_')
		{
			var parts = elements[1].split('_');
			var categoryId = parts[1];

			Backend.Category.activeCategoryId = categoryId;
			Backend.Category.treeBrowser.selectItem(categoryId, false, false);

			return true;
		}

		if($('categoryBrowser').getElementsByClassName('selectedTreeRow')[0])
		{
			var treeNode = $('categoryBrowser').getElementsByClassName('selectedTreeRow')[0].parentNode;
			Backend.ajaxNav.add('cat_' + treeNode.parentObject.id + '#tabProducts');
		}
	},

	initTreeControls: function()
	{
		if($("categoryBrowserActions"))
		{
			if ($('createNewCategoryLink'))
			{
				Event.observe($("createNewCategoryLink"), "click", function(e) {
					Event.stop(e);
					Backend.Category.createNewBranch();
				}.bind(this));
			}

			if ($("removeCategoryLink"))
			{
				Event.observe($("removeCategoryLink"), "click", function(e) {
					Event.stop(e);
					if (confirm(Backend.Category.messages._confirm_category_remove))
					{
						Backend.Category.removeBranch();
					}
				}.bind(this));
			}

			if ($("moveCategoryUp"))
			{
				Event.observe($("moveCategoryUp"), "click", function(e) {
					Event.stop(e);
					this.moveCategory(Backend.Category.activeCategoryId, 'up_strict');
				}.bind(this));
			}

			if ($("moveCategoryDown"))
			{
				Event.observe($("moveCategoryDown"), "click", function(e) {
					Event.stop(e);
					this.moveCategory(Backend.Category.activeCategoryId, 'down_strict');
				}.bind(this));
			}
		}
	},

	/**
	 * Builds category tree browser object (dhtmlxTree) and initializes its params
	 */
	initCategoryBrowser: function()
	{
		this.treeBrowser = new dhtmlXTreeObject("categoryBrowser","","", 0);

		Backend.Category.treeBrowser.setCategoryStyle =
			function(category)
			{
				this.setItemColor(category.ID, (category.isEnabled < 1 ? '#999' : '#000'), (category.isEnabled < 1 ? '#999' : '#fff'));
			}

		Backend.Breadcrumb.setTree(this.treeBrowser);

		this.treeBrowser.setImagePath("image/backend/dhtmlxtree/");
		this.treeBrowser.setOnClickHandler(this.activateCategory);
		if(Backend.Category.allowSorting)
		{
			this.treeBrowser.setDragHandler(this.reorderCategory);
			this.treeBrowser.enableDragAndDrop(1);
		}
	},

	initTabs: function()
	{
		this.tabControl = new CategoryTabControl(this.treeBrowser, 'tabList', 'sectionContainer', 'image/indicator.gif');
	},

	showControls: function()
	{
		// popup window
		if (!$("categoryBrowserActions"))
		{
			return false;
		}

		var categoryId = Backend.Category.treeBrowser.getSelectedItemId();

		if(categoryId == '1')
		{
			if ($("removeCategoryLink"))
			{
				$("removeCategoryLink").parentNode.hide();
			}

			if ($("moveCategoryUp"))
			{
				$("moveCategoryUp").parentNode.hide();
				$("moveCategoryDown").parentNode.hide();
			}
		}
		else
		{
			if ($("removeCategoryLink"))
			{
				$("removeCategoryLink").parentNode.show();
			}

			if ($("moveCategoryUp"))
			{
				parentId = Backend.Category.treeBrowser.getParentId(categoryId)
				categoryIndex = Backend.Category.treeBrowser.getIndexById(categoryId)
				if(parentId)
				{
					nextCategoryId = Backend.Category.treeBrowser.getChildItemIdByIndex(parentId, parseInt(categoryIndex) + 1)

					if(nextCategoryId) $("moveCategoryDown").parentNode.show();
					else $("moveCategoryDown").parentNode.hide();

					if(categoryIndex > 0) $("moveCategoryUp").parentNode.show();
					else $("moveCategoryUp").parentNode.hide();
				}
			}
		}
	},

	/**
	 * Tree browser onClick handler. Activates selected category by realoading active
	 * tab with category specific data
	 *
	 * @todo Find some better way to reference/retrieve the DOM nodes from tree by category ID's
	 * (automatically assign ID's somehow?). Also necessary for bookmarking (the ID's have to be preassigned).
	 */
	activateCategory: function(categoryId)
	{
		Backend.Product.hideAddForm();
		Backend.Breadcrumb.display(categoryId);

		Backend.Category.showControls();

		if(Backend.Product) Backend.Product.Editor.prototype.showCategoriesContainer();

		if (Backend.Category.activeCategoryId == categoryId)
		{
			return false;
		}

		Backend.Category.tabControl.switchCategory(categoryId, Backend.Category.activeCategoryId);
		Backend.Category.activeCategoryId = categoryId;

		// set ID for the current tree node element
		$('categoryBrowser').getElementsByClassName('selectedTreeRow')[0].parentNode.id = 'cat_' + categoryId;

		// and register browser history event to enable backwar/forward navigation
		// Backend.ajaxNav.add('cat_' + categoryId);

		if (!Backend.Category.tabControl.activeTab)
		{
			var tabList = $('tabList');
			if (tabList)
			{
				Backend.Category.tabControl.activeTab = tabList.down('li.tab');
			}
		}

		if (!Backend.Category.tabControl.activeTab)
		{
			return false;
		}

		Backend.Category.tabControl.activeTab.onclick();

		var currentProductId = Backend.Product.Editor.prototype.getCurrentProductId();
		if(currentProductId)
		{
			Backend.Product.Editor.prototype.getInstance(currentProductId, false).removeTinyMce();
		}
	},

	createNewBranch: function()
	{
		new LiveCart.AjaxRequest(
			this.getUrlForNewNode(this.treeBrowser.getSelectedItemId()),
			false,
			function(response) { this.afterNewBranchCreated(response) }.bind(this)
		);
	},

	moveCategory: function(categoryID, direction)
	{
		if('up_strict' == direction)
		{
			Backend.Category.treeBrowser._reorderDirection = 'left';
		}
		else
		{
			Backend.Category.treeBrowser._reorderDirection = 'right';
		}

		Backend.Category.treeBrowser.moveItem(categoryID, direction);
		Backend.Category.treeBrowser._reorderDirection = false;
		Backend.Category.showControls();

		return;

	},

	afterNewBranchCreated: function(response)
	{
		var newCategory = eval('(' + response.responseText + ')');
		var parentCategoryId = Backend.Category.treeBrowser.getSelectedItemId();

		if(Backend.Category.treeBrowser.hasChildren(parentCategoryId) === true)
		{
			Backend.Category.treeBrowser.openItem(parentCategoryId);

			this.createNewCatInterval = setInterval(function()
			{
				if(Backend.Category.treeBrowser.getIndexById(newCategory.ID) !== null)
				{
					Backend.Category.treeBrowser.selectItem(newCategory.ID, true);
					this.tabControl.activateTab("tabMainDetails", newCategory.ID);

					Backend.Breadcrumb.display(newCategory.ID);
					Backend.Category.showControls();

					clearInterval(this.createNewCatInterval);
				}
			}.bind(this)
			, 200);
		}
		else
		{
			 this.treeBrowser.insertNewItem(parentCategoryId, newCategory.ID, newCategory.name_lang, null, 0, 0, 0, '', 1);
			 this.treeBrowser.showItemSign(newCategory.ID, 0);
			 this.treeBrowser.selectItem(newCategory.ID, true);
			 this.tabControl.activateTab("tabMainDetails", newCategory.ID);

			Backend.Breadcrumb.display(newCategory.ID);
			Backend.Category.showControls();

		}
		Backend.Category.treeBrowser.setCategoryStyle(newCategory);

	},

	/**
	 * Updating category branch via ajax request
	 */
	updateBranch: function(formObj)
	{
		new LiveCart.AjaxRequest(formObj, null, this.afterBranchUpdate.bind(this));
	},

	/**
	 * Post-processing request
	 */
	afterBranchUpdate: function(response)
	{
		var categoryData = eval('(' + response.responseText + ')');

		Backend.Category.treeBrowser.setItemText(categoryData.ID, categoryData.name_lang);
		Backend.Category.treeBrowser.setCategoryStyle(categoryData);
	},

	/**
	 * Gets an URL for creating a new node (uses a globaly defined variable "newNodeUrl")
	 */
	getUrlForNewNode: function(parentNodeId)
	{
		return this.buildUrl(this.links.create, parentNodeId);
	},

	getUrlItemsInTabsCount: function(categoryId)
	{
		return this.buildUrl(Backend.Category.links.countTabsItems, categoryId);
	},

	getUrlForNodeRemoval: function(nodeId)
	{
		return this.buildUrl(this.links.remove, nodeId);
	},

	getUrlForNodeReorder: function(id, pid, direction)
	{
		direction = direction || '';
		return Backend.Category.links.reorder
				.replace('_id_', id)
				.replace('_pid_', pid)
				.replace('_direction_', direction);
	},

	buildUrl: function(urlPattern, id)
	{
		return urlPattern.replace('_id_', id);
	},

	/**
	 * Removes a selected category (including sub-trees) from a store
	 */
	removeBranch: function()
	{
		var nodeIdToRemove = this.treeBrowser.getSelectedItemId();
		var parentNodeId = this.treeBrowser.getParentId(nodeIdToRemove);

		new LiveCart.AjaxRequest(this.getUrlForNodeRemoval(nodeIdToRemove), null,
			function(transport)
			{
				if(transport.responseData.status == "confirm" && confirm(transport.responseData.confirmMessage))
				{
					new LiveCart.AjaxRequest(transport.responseData.url, null,
						function(transport)
						{
							if(transport.responseData.status == "success")
							{
								this.successCallback();
							}
						}.bind(this)
					);
				}
				else if(transport.responseData.status == "success")
				{
					this.successCallback();
				}
			}.bind({
				successCallback:function(nodeIdToRemove, parentNodeId)
				{
					return function()
					{
						this.removeBranchSuccess(nodeIdToRemove, parentNodeId)
					}.bind(this);
				}.bind(this)(nodeIdToRemove, parentNodeId)
			})
		);
	},

	removeBranchSuccess: function(nodeIdToRemove, parentNodeId)
	{
		this.activateCategory(parentNodeId);
		this.tabControl.activateTab($('tabProducts'), parentNodeId);
		this.treeBrowser.deleteItem(nodeIdToRemove, true);
	},

	reorderCategory: function(targetId, parentId, siblingNodeId)
	{
		if (!parentId)
		{
			return false;
		}

		new LiveCart.AjaxRequest(Backend.Category.getUrlForNodeReorder(targetId, parentId, Backend.Category.treeBrowser._reorderDirection));

		return true;
	},

	/**
	 * Insert array of categories into tree
	 *
	 * @param array categories Array of category objects. Every category object should contain these elements
	 *	 parent - Id of parent category
	 *	 ID - Id o category
	 *	 name - Category name in current language
	 *	 options - Advanced options
	 *	 childrenCount - Indicates that this node has N childs
	 */
	addCategories: function(categories)
	{
		$A(categories).each(function(category) {
			if(!category.parent || 0 == category.parent)
			{
				category.options = "";
				category.parent = 0;
			}
			else if(!category.option)
			{
				category.options = "";
			}

			// strip HTML
			category.name = '<b>' + category.name_lang + '</b>';
			category.name = category.name.replace(/<(?:.|\s)*?>/g, "");

			Backend.Category.treeBrowser.insertNewItem(category.parent,category.ID,category.name, null, 0, 0, 0, category.options, !category.childrenCount ? 0 : category.childrenCount);
			Backend.Category.treeBrowser.setCategoryStyle(category);
		});
	},

	loadBookmarkedCategory: function(categoryID)
	{
		var match = Backend.getHash().match(/cat_(\d+)/);

		if(match)
		{
			var alreadyLoaded = false;
			try
			{
				$A(Backend.Category.treeBrowser._globalIdStorage).each(function(id)
				{
					if(id == match[1])
					{
					   alreadyLoaded = true;
					   throw $break;
					}
				});
			}
			catch(e) { }

			if(!alreadyLoaded)
			{
				Backend.Category.treeBrowser.loadXML(Backend.Router.setUrlQueryParam(Backend.Category.links.categoryRecursiveAutoloading, "id", match[1]), function() { this.activeCategoryId = null; this.activateCategory(match[1]);}.bind(this));
			}
		}
	},

	loadBookmarkedProduct: function()
	{
		var productID = Backend.getHash().match(/product_(\d+)/);
		if (productID && productID[1])
		{
			Element.show($('loadingProduct'));
			Backend.Product.openProduct(productID[1], null, function() { Element.hide($('loadingProduct')); });
		}
	}
}



var CategoryTabControl = Class.create();

/**
 * Category manager tab control
 */
CategoryTabControl.prototype = {

	tabItemsCounts: { },
	activeTab: null,
	indicatorImageName: null,
	treeBrowser: null,
	sectionContainerName: null,

	initialize: function(treeBrowser, tabContainerName, sectionContainerName, indicatorImageName)
	{
		this.treeBrowser = treeBrowser;
		Backend.Breadcrumb.setTree(this.treeBrowser);

		this.sectionContainerName = sectionContainerName;

		if (indicatorImageName != undefined)
		{
			this.indicatorImageName = indicatorImageName;
		}

		var tabList = document.getElementsByClassName("tab");
		for (var i = 0; i < tabList.length; i++)
		{
			tabList[i].onclick = this.handleTabClick;
			tabList[i].onmouseover = this.handleTabMouseOver.bindAsEventListener(this);
			tabList[i].onmouseout = this.handleTabMouseOut.bindAsEventListener(this);

			tabList[i].tabControl = this;

			aElementList = tabList[i].getElementsByTagName('a');
			if (aElementList.length > 0)
			{
				// Getting an URL pattern that tab is pointing to by analysing "<A>" element
				tabList[i].url = aElementList[0].href;
				new Insertion.After(aElementList[0], aElementList[0].innerHTML);
				// inserting indicator element which will be show on tab activation
				new Insertion.Before(aElementList[0], '<img src="' + this.indicatorImageName + '" class="tabIndicator" id="' + tabList[i].id + 'Indicator" alt="Tab indicator" style="display:none"/> ');
				Element.remove(aElementList[0]);
			}

			if (tabList[i].id == '')
			{
				tabList[i].id = 'tab' + i;
			}

			if (Element.hasClassName(tabList[i], 'active'))
			{
				this.activeTab = tabList[i];
				var containerId = this.getContainerId(tabList[i].id, treeBrowser.getSelectedItemId());
				if ($(containerId) != undefined)
				{
					Element.show(containerId);
				}
			}
			else
			{
				//Element.hide(this.getContainerId(tabList[i].id, treeBrowser.getSelectedItemId()));
			}
		}

		// register for AJAX browser navigation handler
		//this.activeTab.onclick();
	},

	handleTabMouseOver: function(evt)
	{
		var target = "";
		if (evt.target == undefined)
		{
			target = evt.srcElement;
		}
		else
		{
			target = evt.target;
		}
		if (this.activeTab != target)
		{
			Element.removeClassName(target, 'inactive');
			Element.addClassName(target, 'hover');
		}
	},

	handleTabMouseOut: function(evt)
	{
		var target = "";
		if (evt.target == undefined)
		{
			target = evt.srcElement;
		}
		else
		{
			target = evt.target;
		}

		if (this.activeTab != target)
		{
			Element.removeClassName(target, 'hover');
			Element.addClassName(target, 'inactive');
		}
	},

	/**
	 * Tab click event handler (performs tab styling and content activation)
	 */
	handleTabClick: function()
	{
		this.tabControl.activateTab(this);

		Backend.ajaxNav.add('cat_' + Backend.Category.activeCategoryId + '#' + this.id, this.id);
	},

	/**
	 * Activates a given tab of currenty selected category
	 */
	activateTab: function(targetTab, categoryIdToActivate)
	{
		targetTab = $(targetTab);

		var tab = targetTab;
		var id = categoryIdToActivate;

		var categoryId = (categoryIdToActivate == undefined ? this.treeBrowser.getSelectedItemId() : categoryIdToActivate);
		this.updateTabItemsCount(categoryId);

		$(this.sectionContainerName).childElements().invoke("hide");

		// get help context
		var helpContext = document.getElementsByClassName('tabHelp', targetTab);
		if (helpContext.length > 0)
		{
			Backend.setHelpContext(helpContext[0].firstChild.nodeValue);
		}

		var tabId = targetTab.id;

		if (this.activeTab == targetTab)
		{
			var containerId = this.getContainerId(targetTab.id, categoryId)
			if ($(containerId) != undefined)
			{
				if (!Element.empty(containerId))
				{
					Element.show(this.getContainerId(targetTab.id, categoryId));
					return;
				}
			}
		}

		if (this.activeTab != null)
		{
			Element.removeClassName(this.activeTab, 'active');
			Element.addClassName(this.activeTab, 'inactive');
			var activeContainerId = this.getContainerId(this.activeTab.id, categoryId);
			if ($(activeContainerId) != undefined)
			{
				Element.hide(activeContainerId);
			}
		}

		this.activeTab = targetTab;
		Element.removeClassName(this.activeTab, 'hover');
		Element.addClassName(this.activeTab, 'active');

		this.loadTabContent(tabId, categoryId);

		$(this.sectionContainerName).immediateDescendants().each(function(container)
		{
			container.hide();
		});

		Element.show(this.getContainerId(this.activeTab.id, categoryId));
	},

	loadTabContent: function(tabId, categoryId)
	{
		var containerId = this.getContainerId(tabId, categoryId);

		if ($(containerId) == undefined)
		{
			new Insertion.Bottom(this.sectionContainerName, '<div class="' + tabId + ' tabPageContainer" id="' + containerId + '"></div>');
		}
		if (categoryId != "" && Element.empty(containerId))
		{
			// temporary "content" to avoid the content to be loaded twice
			$(containerId).update('&nbsp;');

			Backend.Category.treeBrowser.showFeedback(parseInt(categoryId));

			new LiveCart.AjaxUpdater(
				this.getTabUrl(tabId, categoryId),
				this.getContainerId(tabId, categoryId),
				this.getIndicatorId(tabId),
				undefined,
				function()
				{
					Backend.Category.treeBrowser.hideFeedback(categoryId);
					if ('tabMainDetails' == tabId)
					{
						var nameField = $(containerId).down('form').elements.namedItem('name');
						if ('New Category ' == nameField.value.substr(0, 13))
						{
							nameField.select();
							nameField.focus();
						}
					}
				}
			);
		}
	},

	getIndicatorId: function(tabName)
	{
		return tabName + 'Indicator';
	},

	getContainerId: function(tabName, categoryId)
	{
		return tabName + 'Content_' + categoryId;
	},

	getTabUrl: function(tabName, categoryId)
	{
		var url = $(tabName).url.replace('_id_', categoryId);
		return url;
	},

	/**
	 * Reset content related to a given tab. When tab will be activated content must
	 * be resent
	 */
	resetContent: function(tabObj, categoryId)
	{
		var contentContainerId = this.getContainerId(tabObj.id, categoryId);
		if ($(contentContainerId) != undefined)
		{
			$(contentContainerId).innerHTML = '';
			Element.hide(contentContainerId);
		}
	},

	reloadActiveTab: function()
	{
		categoryId = this.treeBrowser.getSelectedItemId();
		this.resetContent(this.activeTab, categoryId);
		this.activateTab(this.activeTab, categoryId);
	},

	switchCategory: function(currentCategory, previousActiveCategoryId)
	{
		if (previousActiveCategoryId != null && this.activeTab)
		{
			var prevContainer = this.getContainerId(this.activeTab.id, previousActiveCategoryId);
			if ($(prevContainer) != undefined)
			{
				Element.hide(prevContainer);
			}
		}
	},

	loadCategoryTabsCount: function(categories)
	{
		$H(categories).each(function(category) {
			CategoryTabControl.prototype.tabItemsCounts[category.key] = category.value;
		});
	},

	updateTabItemsCount: function(categoryID)
	{
		if(categoryID != "" && !CategoryTabControl.prototype.tabItemsCounts[categoryID])
		{
			new LiveCart.AjaxRequest(
				Backend.Category.getUrlItemsInTabsCount(categoryID),
				false,
				function(response)
				{
					CategoryTabControl.prototype.tabItemsCounts[categoryID] = eval("(" + response.responseText + ")");
					CategoryTabControl.prototype.setTabItemsCount(categoryID);
				}
			);
		}
		else
		{
			CategoryTabControl.prototype.setTabItemsCount(categoryID);
		}
	},

	setTabItemsCount: function(categoryID)
	{
		$H(CategoryTabControl.prototype.tabItemsCounts[categoryID]).each(function(tab) {
			if ($(tab.key))
			{
				$(tab.key).getElementsByTagName('span')[0].firstChild.nodeValue = ' (' + tab.value + ')';
			}
		});
	},

	resetTabItemsCount: function(categoryID)
	{
		CategoryTabControl.prototype.tabItemsCounts[categoryID] = null;
		CategoryTabControl.prototype.updateTabItemsCount(categoryID);
	},

	getActiveTab: function()
	{
		return this.activeTab;
	},

	setTabUrl: function(tabId, url)
	{
		$('tabId').url = url;
	}
}


Backend.Category.PopupSelector = Class.create();
Backend.Category.PopupSelector.prototype =
{
	onAccept: null,
	onCancel: null,

	initialize: function(onAccept, onCancel, categoryID)
	{
		this.onAccept = onAccept;
		this.onCancel = onCancel;

		if (!Backend.Category.links.popup)
		{
			Backend.Category.links.popup = Backend.Router.createUrl('backend.category', 'popup');
		}

		var w = window.open(Backend.Category.links.popup + (categoryID ? '#cat_' + categoryID : ''), 'selectCategory', 'width=260, height=450');

		this.window = w;

		window.popupOnload =
			function()
			{
				Event.observe(w.document.getElementById('select'), 'click', function()
					{
						var tree = w.Backend.Category.treeBrowser;

						var pathAsText = '';
						var path = {};

						var parentId = tree.getSelectedItemId();
						do
						{
							var name = tree.getItemText(parentId)
							pathAsText = name + pathAsText;
							path[parentId] = name;

							parentId = tree.getParentId(parentId);

							if (parentId)
							{
								pathAsText = ' > ' + pathAsText;
							}
						}
						while(parentId != 0);

						var res = true;

						if (this.onAccept)
						{
							res = this.onAccept(tree.getSelectedItemId(), pathAsText, path, w);
						}

						if (res)
						{
							w.close();
						}

					}.bindAsEventListener(this) );

				Event.observe(w.document.getElementById('cancel'), 'click', function(e)
					{
						var res = true;

						if (this.onCancel)
						{
							res = this.onCancel(this);
						}

						if (res)
						{
							w.close();
						}

						Event.stop(e);
					}.bindAsEventListener(this) );
			}.bind(this);

		// close the popup automatically if closing/reloading page
		Event.observe(window, 'unload', function()
		{
			w.close();
		});
	}
}



/***************************************************
 * backend/Product.js
 ***************************************************/

/**
 *	@author Integry Systems
 */

Backend.Product =
{
	productTabCopies: new Array(),

	formTabCopies: new Array(),

	categoryPaths: {},

	showAddForm: function(categoryID, caller)
	{
		var container = $('addProductContainer');

		// product form has already been downloaded
		if (this.formTabCopies[categoryID])
		{
			container.update('');
			container.appendChild(this.formTabCopies[categoryID]);
			this.initAddForm(categoryID);
		}

		// retrieve product form
		else
		{
			var url = Backend.Category.links.addProduct.replace('_id_', categoryID);
			new LiveCart.AjaxUpdater(url, container, caller.up('.menu').down('.progressIndicator'));
		}
	},

	hideAddForm: function()
	{
		if ($('addProductContainer'))
		{
			Element.hide($('addProductContainer'));
		}

		if ($('categoryTabs'))
		{
			Element.show($('categoryTabs'));
		}
	},

	cancelAddProduct: function(categoryID, noHide)
	{
		container = $('addProductContainer');

		if (!noHide)
		{
			Element.hide(container);
			Element.show($('categoryTabs'));
		}

		ActiveForm.prototype.destroyTinyMceFields(container);
		this.formTabCopies[categoryID] = container.down('.productForm');
	},

	resetAddForm: function(form)
	{
		ActiveForm.prototype.resetTinyMceFields(form);
	},

	initAddForm: function(categoryID)
	{
		container = $('addProductContainer');

		Element.hide($('categoryTabs'));
		Element.show(container);

		if (window.tinyMCE)
		{
			tinyMCE.idCounter = 0;
		}

		ActiveForm.prototype.initTinyMceFields(container);
		this.toggleSkuField(container.down('form').elements.namedItem('autosku'));

		this.initSpecFieldControls(0);
		this.initInventoryControls(container.down('.inventory'));

		// init type selector logic
		var typeSel = container.down('select.productType');
		typeSel.onchange =
			function(e)
			{
				var el = e ? Event.element(e) : this;
				var cont = el.up('div.productForm');
				if (1 == el.value)
				{
					cont.addClassName('intangible');
				}
				else
				{
					cont.removeClassName('intangible');
				}
			}

		this.reInitAddForm();

		ActiveForm.prototype.resetErrorMessages(container.down('form'));
	},

	reInitAddForm: function()
	{
		container = $('addProductContainer');
		var typeSel = container.down('select.productType');
		typeSel.onchange();

		// focus Product Name field
		container.down('form').elements.namedItem('name').focus();
	},

	initSpecFieldControls: function(categoryID)
	{
		var container = (0 == categoryID) ? $('addProductContainer') : $('tabProductsContent_' + categoryID);
		new Backend.Eav(container);
	},

	initInventoryControls: function(container)
	{
	  	var stockCountContainer = container.down('div.stockCount');
	  	var stockCountField = stockCountContainer.down('input');
	  	var unlimitedCb = container.down('input.isUnlimitedStock');

	  	var onchange = function()
	  	{
			if (unlimitedCb.checked)
			{
				stockCountField._backedUpValue = stockCountField.value;
				stockCountField.value = '1';
				$(stockCountContainer).hide();
			}
			else
			{
				if (stockCountField._backedUpValue)
				{
					stockCountField.value = stockCountField._backedUpValue;
				}

				$(stockCountContainer).show();
			}
		}

		onchange();
		unlimitedCb.onchange = onchange;
	},

	toggleSkuField: function(checkbox)
	{
	  	var skuField = checkbox.form.elements.namedItem('sku');
	  	skuField.disabled = checkbox.checked;
	  	if (checkbox.checked)
	  	{
			skuField._backedUpValue = skuField.value;
			skuField.value = '';
		}
		else
		{
		  	if(skuField._backedUpValue) skuField.value = skuField._backedUpValue;
			skuField.focus();
		}
	},

	saveForm: function(form)
	{
		var saveHandler = new Backend.Product.saveHandler(form);
		new LiveCart.AjaxRequest(form, null, saveHandler.saveComplete.bind(saveHandler));
	},

	openProduct: function(id, e, onComplete)
	{
		if ($('productIndicator_' + id))
		{
			var indicator = $('productIndicator_' + id);
		}
		else if (e)
		{
			var indicator = Event.element(e).parentNode.down('.progressIndicator');
			if (indicator)
			{
				// ugly hack
				setTimeout(function() { indicator.hide() }, 5000);
			}
		}

		if (indicator)
		{
			Element.show(indicator);
		}

		if (window.opener && window.opener.selectProductPopup)
		{
			var downloadable = parseInt(e.target.up('tr').down(".cell_hiddenType").innerHTML) == 1;

			window.opener.selectProductPopup.getSelectedObject(id, downloadable, indicator);
		}
		else
		{
			Backend.Product.Editor.prototype.setCurrentProductId(id);

			var tabControl = TabControl.prototype.getInstance('productManagerContainer', Backend.Product.Editor.prototype.craftProductUrl, Backend.Product.Editor.prototype.craftProductId, {
				afterClick: function()
				{
					if (Backend.SelectPopup.prototype.popup && Backend.SelectPopup.prototype.popup.opener)
					{
						Backend.SelectPopup.prototype.popup.opener.focus();
						Backend.SelectPopup.prototype.popup.close();
					}
				}
			});

			tabControl.activateTab(null, function(response)
			{
				if(onComplete)
				{
					onComplete(response);
				}

				Backend.ajaxNav.add("#product_" + id);
			}.bind(this));

			if(Backend.Product.Editor.prototype.hasInstance(id))
			{
				Backend.Product.Editor.prototype.getInstance(id);
			}
		}

		if (e)
		{
			Event.stop(e);
		}
	 },

	setPath: function(categoryID, path)
	{
		this.categoryPaths[categoryID] = path;
	},

	resetEditors: function()
	{
		Backend.Product.productTabCopies = new Array();
		Backend.Product.formTabCopies = new Array();
		Backend.Product.Editor.prototype.__instances__ = {};
		Backend.Product.Editor.prototype.__currentId__ = null;

		$('productManagerContainer').down('.sectionContainer').innerHTML = '';

		TabControl.prototype.__instances__ = {};
	},

	massActionChanged: function(element)
	{
		if ('move' == element.value || 'copy' == element.value || 'addCat' == element.value)
		{
			var moveElement = element.up('form').down('.move');
			new Backend.Category.PopupSelector(
				function(categoryID, pathAsText, path)
				{
					var conf = 'move' == element.value ? Backend.Category.messages._confirm_move : '';
					if (conf && !confirm(conf + "\n\n" + pathAsText))
					{
						return false;
					}

					moveElement.down('input').value = categoryID;

					moveElement.up('form').down('input.submit').click();

					var select = moveElement.up('form').down('.select');
					select.value = 'enable_isEnabled';

					return true;
				},
				function()
				{
					var select = moveElement.up('form').down('.select');
					select.value = 'enable_isEnabled';
					return true;
				}
			);
		}
	},

	reloadGrid: function(categoryID)
	{
		var table = $('products_' + categoryID + '_header');

		if (!table && Backend.Product.productTabCopies[categoryID])
		{
			table = Backend.Product.productTabCopies[categoryID].getElementsByTagName('table')[0];
		}

		if (table)
		{
			table.gridInstance.reloadGrid();
		}
	},

	onQuickEditSubmit: function(obj)
	{
		var form;
		form = $(obj).up("form");
		if(validateForm(form))
		{
			new LiveCart.AjaxRequest(form, null, function(transport) {
				var response = eval( "("+transport.responseText + ")");
				if(response.status == "saved")
				{
					this.instance._getGridInstaceFromControl(this.obj).updateQuickEditGrid(transport.responseText);
					this.instance.onQuickEditCancel(this.obj);
				}
				else
				{
					ActiveForm.prototype.setErrorMessages(this.obj.up("form"), response.errors)
				}
			}.bind({instance: this, obj:obj}));
		}
		return false;
	},

	onQuickEditCancel: function(obj)
	{
		var gridInstance = this._getGridInstaceFromControl(obj);
		gridInstance.onQuickEditCancel();
		return false;
	},

	_getGridInstaceFromControl: function(control)
	{
		try {
			return $(control).up("div", 2).down("table").gridInstance;
		} catch(e) {
			return null;
		}
	},

	showQuickEditAddImageForm: function(control, productID, formUrl)
	{
		control = $(control);
		this._menuVisibility(control, ['hide', 'show']);
		// todo: do we have container?
		// if not- request and create
		new LiveCart.AjaxRequest(
			formUrl,
			null,
			function(transport)
			{
				var container = $("productImageUploadForm_"+this.productID);
				container.innerHTML = transport.responseText;
				container.style.position="absolute";
				container.show();
			}.bind({productID:productID})
		);
		return false;
	},

	hideQuickEditAddImageForm: function(control, productID)
	{
		control = $(control);
		this._menuVisibility(control, ['show', 'hide']);
		var container = $("productImageUploadForm_"+productID);
		container.hide();
		return false;
	},

	_menuVisibility: function(node, visibility)
	{
		menuNode=node.up("ul");
		for(i=0; i<visibility.length; i++)
		{
			$(menuNode.down("li",i))[visibility[i]]();
		}
	}
}

Backend.Product.saveHandler = Class.create();
Backend.Product.saveHandler.prototype =
{
  	initialize: function(form)
  	{
		this.form = form;
	},

	saveComplete: function(originalRequest)
	{
	  	ActiveForm.prototype.resetErrorMessages(this.form);
		var response = eval('(' + originalRequest.responseText + ")");

		if (response.errors)
		{
			ActiveForm.prototype.setErrorMessages(this.form, response.errors);
		}
		else
		{
			var categoryID = this.form.elements.namedItem('categoryID').value;

			if (response.specFieldHtml)
			{
				var specFieldContainer = this.form.down('div.specFieldContainer');
				if (specFieldContainer)
				{
					ActiveForm.prototype.destroyTinyMceFields(container);
					specFieldContainer.innerHTML = response.specFieldHtml;
					Backend.Product.initSpecFieldControls(categoryID);
					response.specFieldHtml.evalScripts();
				}
			}

			// reload product grids
			var path = Backend.Product.categoryPaths[categoryID]
			if (path)
			{
				for (var k = 0; k <= path.length; k++)
				{
					var category = path[k] ? path[k].ID : 1;
					Backend.Product.reloadGrid(category);
				}
			}

			// reset form and add more products
			if (this.form.elements.namedItem('afterAdding').checked)
			{
				try { footerToolbar.invalidateLastViewed(); } catch(e) {}
				this.form.reset();
				document.getElementsByClassName('product_sku', this.form)[0].disabled = false;
				Backend.Product.reInitAddForm();
			}

			// continue to edit the newly added product
			else
			{
				Element.show($('loadingProduct'));
				Backend.Product.openProduct(response.id,
											null,
											function()
											{
												Element.hide($('loadingProduct'));
												Backend.Product.cancelAddProduct(categoryID);
												this.form.reset();
											}.bind(this)
											);
  			}
 		}
	}
}

Backend.Product.Editor = Class.create();
Backend.Product.Editor.prototype =
{
	__currentId__: null,
	__instances__: {},

	initialize: function(id, path)
	{
		try { footerToolbar.invalidateLastViewed(); } catch(e) {}
		this.id = id;
		this.path = path;

		this.__nodes__();
		this.__bind__();

		Form.State.backup(this.nodes.form);

		var self = this;
	},

	__nodes__: function()
	{
		this.nodes = {};
		this.nodes.parent = $("tabProductBasic_" + this.id + "Content");
		this.nodes.form = this.nodes.parent.down("form");
		this.nodes.cancel = this.nodes.form.down('a.cancel');
		this.nodes.submit = this.nodes.form.down('input.submit');
	},

	__bind__: function(args)
	{
		var self = this;
		Event.observe(this.nodes.cancel, 'click', function(e) { Event.stop(e); self.cancelForm()});
	},

	__init__: function(tabs)
	{
		Backend.Product.Editor.prototype.setCurrentProductId(this.id);

		if ($('productIndicator_' + this.id))
		{
			Element.hide($('productIndicator_' + this.id));
		}

		this.showProductForm();
		this.tabControl = TabControl.prototype.getInstance("productManagerContainer", false);

		this.setPath();

		this.addTinyMce();

		if(tabs)
		{
			this.tabControl.setAllCounters(tabs, this.id);
		}
		else
		{
			this.setTabCounters()
		}

		this.initSpecFieldControls();

		Backend.Product.initInventoryControls(this.nodes.form.down('.inventory'));

		var typeSel = this.nodes.form.elements.namedItem("type");
		typeSel.onchange = this.changeType;
		typeSel.onchange();
	},

	setPath: function() {
		Backend.Breadcrumb.display(
			this.path,
			this.nodes.form.elements.namedItem("name").value
		);
	},

	changeType: function()
	{
		if (2 == this.value)
		{
			$('tabProductBundle').show();
			$('tabProductBundle').removeClassName('hidden');
		}
		else
		{
			$('tabProductBundle').hide();
		}
	},

	initSpecFieldControls: function()
	{
		new Backend.Eav($('tabProductsContent_' + this.id));
	},

	setTabCounters: function()
	{
		if(!this.tabControl.restoreAllCounters(this.id))
		{
			new LiveCart.AjaxRequest(
				Backend.Product.Editor.prototype.links.countTabsItems + "/" + this.id,
				false,
				function(reply)
				{
					var counters = eval("(" + reply.responseText + ")");
					this.tabControl.setAllCounters(counters, this.id);
				}.bind(this)
			);
		}
	},

	craftProductUrl: function(url)
	{
		return url.replace(/_categoryID_/, Backend.Category.treeBrowser.getSelectedItemId()).replace(/_id_/, Backend.Product.Editor.prototype.getCurrentProductId());
	},

	craftProductId: function(tabId)
	{
		return tabId + '_' +  Backend.Product.Editor.prototype.getCurrentProductId() + 'Content'
	},

	getCurrentProductId: function()
	{
		return Backend.Product.Editor.prototype.__currentId__;
	},

	setCurrentProductId: function(id)
	{
		Backend.Product.Editor.prototype.__currentId__ = id;
	},

	getInstance: function(id, doInit, path, tabs)
	{
		if(!Backend.Product.Editor.prototype.__instances__[id])
		{
			Backend.Product.Editor.prototype.__instances__[id] = new Backend.Product.Editor(id, path);
		}

		if(doInit !== false)
		{
			Backend.Product.Editor.prototype.__instances__[id].__init__(tabs);
		}

		return Backend.Product.Editor.prototype.__instances__[id];
	},

	hasInstance: function(id)
	{
		return this.__instances__[id] ? true : false;
	},

	showProductForm: function(args)
	{
		this.hideCategoriesContainer();
	},

	cancelForm: function()
	{
		ActiveForm.prototype.resetErrorMessages(this.nodes.form);
		Form.restore(this.nodes.form);
		ActiveForm.prototype.resetTinyMceFields(this.nodes.form);
	},

	submitForm: function()
	{
		new LiveCart.AjaxRequest(this.nodes.form, null, this.formSaved.bind(this));
	},

	formSaved: function(responseJSON)
	{
		ActiveForm.prototype.resetErrorMessages(this.nodes.form);
		var responseObject = eval("(" + responseJSON.responseText + ")");
		this.afterSubmitForm(responseObject);
	},

	afterSubmitForm: function(response)
	{
		if(!response.errors || 0 == response.errors.length)
		{
			try { footerToolbar.invalidateLastViewed(); } catch(e) {}
			Form.State.backup(this.nodes.form);
			if (response.specFieldHtml)
			{
				var specFieldContainer = this.nodes.form.down('div.specFieldContainer');
				if (specFieldContainer)
				{
					ActiveForm.prototype.destroyTinyMceFields(specFieldContainer);
					specFieldContainer.innerHTML = response.specFieldHtml;
					this.initSpecFieldControls();
					response.specFieldHtml.evalScripts();
				}
			}

			for (var k = 0; k < this.path.length; k++)
			{
				var category = this.path[k] ? this.path[k].ID : 1;
				Backend.Product.reloadGrid(category);
			}

			this.resetPricingTab();
		}
		else
		{
			ActiveForm.prototype.setErrorMessages(this.nodes.form, response.errors)
		}
	},

	resetPricingTab: function()
	{
		this.tabControl.resetContent($('tabProductDiscounts'));
	},

	hideCategoriesContainer: function(args)
	{
		Element.hide($("catgegoryContainer"));
		Element.hide($("managerContainer"));
		Element.show($("productManagerContainer"));
		$('productManagerContainer').removeClassName('treeManagerContainer');
	},

	showCategoriesContainer: function(args)
	{
		var container = $("catgegoryContainer");
		if (!container)
		{
			return;
		}

		Element.show(container);

		if($("productManagerContainer")) Element.hide($("productManagerContainer"));
		if($("managerContainer")) Element.show($("managerContainer"));

		if (!Backend.Category.treeBrowser.getSelectedItemId())
		{
			Backend.Category.treeBrowser.selectItem(1, false);
			Backend.Category.activateCategory(1);
		}

		// container element height may not be reduced automatically when closing a longer product form,
		// so sometimes extra whitespace remains below the product list
		Backend.LayoutManager.prototype.collapseAll($('pageContentInnerContainer'));
	},

	removeTinyMce: function()
	{
		ActiveForm.prototype.destroyTinyMceFields(this.nodes.parent);
	},

	addTinyMce: function()
	{
		ActiveForm.prototype.initTinyMceFields(this.nodes.parent);
	},

	goToProductPage: function()
	{
		var node = $('productPage');
		if (!node.urlTemplate)
		{
			node.urlTemplate = node.href;
		}

		node.href = node.urlTemplate.replace('_id_', Backend.Product.Editor.prototype.getCurrentProductId());
	}
}

Backend.Product.Prices = Class.create();
Backend.Product.Prices.prototype =
{
	__instances__: {},

	initialize: function(parent, product)
	{
		this.product = product;

		this.__nodes__($(parent));
		this.__bind__();

		$A(this.nodes.form.down('fieldset.pricing').getElementsByClassName('price')).each(function(price)
		{
			var listPrice = price.form.elements.namedItem('listPrice_' + price.name.substr(6));

			price.onchange = function()
			{
				listPrice.disabled = this.value.length == 0;
			}

			price.onkeyup = price.onchange;

			price.onchange();
		});

		Backend.Product.initInventoryControls(this.nodes.form.down('.inventory'));

		Form.State.backup(this.nodes.form);
	},

	getInstance: function(parent, product)
	{
		var parentNode = $(parent);
		if(!Backend.Product.Prices.prototype.__instances__[parentNode.id])
		{
			Backend.Product.Prices.prototype.__instances__[parentNode.id] = new Backend.Product.Prices(parentNode.id, product);
		}

		Backend.Product.Prices.prototype.__instances__[parentNode.id].__init__();
		return Backend.Product.Prices.prototype.__instances__[parentNode.id];
	},

	__nodes__: function(parent)
	{
		this.nodes = {};
		this.nodes.parent = parent;
		this.nodes.form = parent;

		this.nodes.submit = this.nodes.parent.down("input.submit");
		this.nodes.cancel = this.nodes.parent.down("a.cancel");
	},

	__bind__: function(args)
	{
		var self = this;
		Event.observe(this.nodes.cancel, "click", function(e) {
			Event.stop(e);
			self.resetForm();
		});
	},

	__init__: function(args)
	{
	},

	submitForm: function()
	{
		new LiveCart.AjaxRequest(this.nodes.form, null, this.saveComplete.bind(this));
	},

	resetForm: function(response)
	{
		ActiveForm.prototype.resetErrorMessages(this.nodes.form);
		Form.State.restore(this.nodes.form);
	},

	saveComplete: function(responseJSON)
	{
		ActiveForm.prototype.resetErrorMessages(this.nodes.form);

		var responseObject = eval("(" + responseJSON.responseText + ")");

		this.afterSubmitForm(responseObject);
	},

	afterSubmitForm: function(response)
	{
		if('success' == response.status)
		{
			var self = this;
			$H(response.prices).each(function(price) {
				self.nodes.form.elements.namedItem(price.key).value = price.value;
			});

			Form.State.backup(this.nodes.form);
		}
		else
		{
			ActiveForm.prototype.setErrorMessages(this.nodes.form, response.errors)
		}
	}
}

Backend.Product.QuantityPrice = function(container, rules)
{
	this.rules = rules;
	this.container = container;
	this.hiddenValue = container.parentNode.down('.hiddenValue');
	this.headRow = container.down('thead').down('tr');

	var hasSerialized = false;

	if (this.rules && this.rules.serializedRules)
	{
		$H(this.rules.serializedRules).each(function(s) {hasSerialized = true;});
	}

	if (hasSerialized)
	{
		$H(this.rules.serializedRules).each(function(pair, index)
		{
			var quant = pair[0];
			var prices = pair[1];
			var col = this.createColumn();
			this.headRow.lastChild.down('input').value = quant;

			if (prices instanceof Array)
			{
				var obj = {};
				for (k = 0; k < prices.length; k++)
				{
					obj[k] = prices[k];
				}
				prices = obj;
			}

			$H(prices).each(function(pair)
			{
				var group = pair[0];
				var price = pair[1];
				var row = this.getGroupRow(group);
				row.getElementsByTagName('input')[index + 1].value = price;
			}.bind(this));
		}.bind(this));

		this.createRow();
		this.createColumn();
		this.deleteColumn(1);
		this.deleteRow(this.container.down('select'));

		$A(this.container.getElementsByTagName('select')).each(this.changeGroup.bind(this));

		this.container.parentNode.show();
	}
	else
	{
		this.container.parentNode.hide();
		this.menuLink = this.container.up('fieldset').down('a.menu');
		this.menuLink.onclick = this.showForm.bind(this);
		this.menuLink.show();
	}

	this.initCells(this.container);
}

Backend.Product.QuantityPrice.prototype =
{
	showForm: function(e)
	{
		Event.stop(e);
		this.menuLink.hide();
		this.container.parentNode.show();
	},

	initCells: function(container)
	{
		$A(container.getElementsByClassName('quantity')).each(function(field) { field.onchange = this.changeQuantity.bindAsEventListener(this); field.onkeyup = function(){NumericFilter(field);}}.bind(this));
		$A(container.getElementsByTagName('select')).each(function(field) { field.onchange = this.changeGroup.bindAsEventListener(this);}.bind(this));
		$A(container.getElementsByClassName('qprice')).each(function(field) { field.onchange = this.changePrice.bindAsEventListener(this); field.onkeyup = function(){NumericFilter(field);}}.bind(this));
	},

	getGroupRow: function(groupID)
	{
		var row = null;
		$A(this.container.getElementsByTagName('select')).each(function(field)
		{
			if (field.value == groupID)
			{
				row = field.up('tr');
				return;
			}
		});

		if (!row)
		{
			row = this.createRow();
			row.down('select').value = groupID;
		}

		return row;
	},

	changeQuantity: function(field)
	{
		if (field instanceof Event)
		{
			field = Event.element(field);
		}

		// last column
		if (this.getColumnNumber(field) == this.getColumnCount() -1)
		{
			if (field.value != '')
			{
				this.createColumn();
			}
		}

		if (field.value == '')
		{
			this.deleteColumn(this.getColumnNumber(field));
		}

		this.indexForm();
	},

	changePrice: function()
	{
		this.indexForm();
	},

	changeGroup: function(field)
	{
		if (field instanceof Event)
		{
			field = Event.element(field);
		}

		if (field.value == '')
		{
			if (this.getRowNumber(field) != this.getRowCount() - 1)
			{
				this.deleteRow(field);
			}
		}
		else
		{
			// last column
			if (this.getRowNumber(field) == this.getRowCount() - 1)
			{
				this.createRow();
			}
		}

		var selectedGroups = {};
		var selects = this.container.getElementsByTagName('select');
		$A(selects).each(function(sel)
		{
			if (0 == sel.value.length)
			{
				return;
			}

			selectedGroups[sel.value] = sel;
		});

		$A(selects).each(function(sel)
		{
			var opts = sel.getElementsByTagName('option');
			$A(opts).each(function(opt)
			{
				if (selectedGroups[opt.value] && (selectedGroups[opt.value] != sel))
				{
					opt.hide();
				}
				else
				{
					opt.show();
				}
			});
		}.bind(this));

		this.indexForm();
	},

	getColumnNumber: function(field)
	{
		return this.getNodeIndex(field.up('td'));
	},

	getRowNumber: function(field)
	{
		return this.getNodeIndex(field.up('tr')) + 1;
	},

	getColumnCount: function()
	{
		return this.container.down('tr').getElementsByTagName('td').length;
	},

	getRowCount: function()
	{
		return this.container.getElementsByTagName('tr').length;
	},

	deleteColumn: function(columnID)
	{
		var rows = this.container.getElementsByTagName('tr');
		for (var k = 0; k < rows.length; k++)
		{
			var cell = rows[k].getElementsByTagName('td')[columnID];
			cell.parentNode.removeChild(cell);
		}
	},

	deleteRow: function(field)
	{
		var row = field.up('tr');
		row.parentNode.removeChild(row);
	},

	createColumn: function()
	{
		var rows = this.container.getElementsByTagName('tr');
		for (var k = 0; k < rows.length; k++)
		{
			var cell = rows[k].lastChild.cloneNode(true);
			rows[k].appendChild(cell);
			cell.down('input').value = '';
			this.initCells(cell);
		}
	},

	createRow: function()
	{
		var row = $A(this.container.getElementsByTagName('tr')).pop();
		var cloned = row.cloneNode(true);
		this.container.down('tbody').appendChild(cloned);
		$A(cloned.getElementsByTagName('input')).each(function(f) {f.value = '';});
		this.initCells(cloned);

		return cloned;
	},

	// there should be an existing function for that
	getNodeIndex: function(node)
	{
		var nodes = node.parentNode.getElementsByTagName(node.tagName);
		for (k = 0; k < nodes.length; k++)
		{
			if (nodes[k] == node)
			{
				return k;
			}
		}
	},

	indexForm: function()
	{
		var val = {quant: [], group: [], price: []};
		$A(this.container.getElementsByClassName('quantity')).each(function(f){val.quant.push(f.value); });
		$A(this.container.getElementsByTagName('select')).each(function(f){val.group.push(f.value); });
		$A(this.container.getElementsByClassName('qprice')).each(function(f){val.price.push(f.value); });
		this.hiddenValue.value = Object.toJSON(val);
	}
}

Backend.Product.GridFormatter =
{
	productUrl: '',

	getClassName: function(field, value)
	{

	},

	formatValue: function(field, value, id)
	{
		if ('Product.name' == field && Backend.Product.productsMiscPermision)
		{
			value = '<span>' +
						'<span class="progressIndicator" id="productIndicator_' + id + '" style="display: none;"></span>' +
					'</span>' +
					'<a href="' + this.productUrl + id + '" id="product_' + id + '" onclick="Backend.Product.openProduct(' + id + ', event); return false;">' +
						value +
					'</a>';
		}

		return value;
	}
}


/***************************************************
 * backend/QuickSearch.js
 ***************************************************/

/**
 *
 * @author Integry Systems
 */

window.quickSearchInstances = {};

Backend.QuickSearch = Class.create();
Backend.QuickSearch.prototype = {
	// timeout values
	TIMEOUT_WHEN_WAITING : 500,
	TIMEOUT_WHEN_TYPING : 1000,

	// --
	query : "",
	previousQuery: null,
	timer : {typing: null, waiting:null},
	popupHideObserved: false,
	nodes : null,
	hasResponse : false,
	prefix: null,
	defaultOptions:{},

	initialize: function(prefix, options)
	{
		if(options)
		{
			this.defaultOptions = options;
		}
		this.prefix = prefix;
		this.initNodes();
		Event.observe(this.nodes.Query, "keyup", this.onKeyUp.bindAsEventListener(this));
		Event.observe(this.nodes.Query, 'focus', this.onFocus.bindAsEventListener(this));
		Event.observe(this.nodes.Query, 'blur', this.onBlur.bindAsEventListener(this));
	},

	initNodes : function()
	{
		if(this.nodes == null)
		{
			this.nodes = {};
			$A([
				"Class",
				"From",
				"To",
				"Direction",
				"Form",
				"Query",
				"Result",
				"Container"
			]).each(
				function(id)
				{
					this.nodes[id]=$(this.prefix + id);
				}.bind(this)
			);

			this.nodes.Result = this.nodes.Result.parentNode;
		}
	},

	onFocus: function(event)
	{
		var obj = Event.element(event);
		if (obj.hint == undefined)
		{
			obj.hint = obj.value;
		}

		if (obj.value == obj.hint)
		{
			obj.value = '';
			obj.removeClassName('hasHint');
		}
	},

	onBlur: function(event)
	{
		var obj = Event.element(event);

		if (!obj.value)
		{
			obj.value = obj.hint;
			obj.addClassName('hasHint');
		}
	},

	onKeyUp:function(event)
	{
		var obj = Event.element(event);
		this.query=obj.value;

		// instant requests
		if(this.TIMEOUT_WHEN_TYPING == 0)
		{
			this.doRequest();
			return;
		}

		// When stop typing make request after TIMEOUT_WHEN_WAITING.
		if(this.timer.waiting)
		{
			window.clearTimeout(this.timer.waiting);
		}
		this.timer.waiting = window.setTimeout(this.doRequest.bind(this), this.TIMEOUT_WHEN_WAITING);

		// When typing make requests every TIMEOUT_WHEN_TYPING.
		if(this.timer.typing == null)
		{
			// using setTimeout instead of setInterval allows to restart interval
			// and make request every time user start typing after pause.
			this.timer.typing = window.setTimeout(
				function()
				{
					if(this.timer.typing)
					{
						window.clearTimeout(this.timer.typing);
						this.timer.typing = null;
					}
				}.bind(this),
				this.TIMEOUT_WHEN_TYPING
			);
			this.doRequest();
		}
	},

	doRequest: function(t)
	{
		if(this.query.length < 3)
		{
			return;
		}

		this.initNodes(); // move to 'constructor'

		if(this.query != this.previousQuery)
		{
			this._setFormOptions(this.defaultOptions);
			new LiveCart.AjaxRequest(
				this.nodes.Form,
				this.nodes.Query,
				this.onResponse.bind(this)
			);
			this.previousQuery = this.query;
		}
	},

	onResponse: function(transport)
	{
		this.initNodes(); // move to 'constructor'
		this.nodes.Result.innerHTML = transport.responseText;
		this.hasResponse = true; // flag needed to allow reopen closed result popup when clicking on search query input field.
		this.showResultContainer();
	},

	showResultContainer: function()
	{
		if(this.hasResponse == false)
		{
			return;
		}
		this.initNodes();
		this.nodes.Result.show();
		if(this.popupHideObserved == false)
		{
			Event.observe(document, 'click', this.hideResultContainer.bindAsEventListener(this));
			Event.observe(this.nodes.Container, 'click',
				function(event)
				{
					var element = Event.element(event);
					if(element.tagName.toLowerCase() != "a" || element.hasClassName("qsNext") || element.hasClassName("qsPrevious"))
					{
						Event.stop(event);
					}
				}
			);
			Event.observe(this.nodes.Query, 'focus', this.showResultContainer.bindAsEventListener(this));
			this.popupHideObserved = true;
		}

		if (this.callbacks && this.callbacks.showResultContainer && typeof this.callbacks.showResultContainer == "function")
		{
			this.callbacks.showResultContainer(this);
		}
	},

	onShowResultContainer: function(callback)
	{
		if (typeof this.callbacks == "undefined")
		{
			this.callbacks = {};
		}
		this.callbacks.showResultContainer = callback;
	},

	hideResultContainer: function()
	{
		this.initNodes();
		this.nodes.Result.hide();
	},

	next: function(obj, cn)
	{
		this.changePage(obj, cn, 'next');
	},

	previous: function(obj, cn)
	{
		this.changePage(obj, cn, 'previous');
	},

	changePage: function(obj, cn, direction)
	{
		var
			container = $(obj).up("div")
			from = parseInt($A(container.getElementsByClassName("qsFromCount"))[0].innerHTML, 10);
			to = parseInt($A(container.getElementsByClassName("qsToCount"))[0].innerHTML, 10);

		this.initNodes();
		this._setFormOptions({
			cn:cn,
			from:from,
			to:to,
			direction:direction
		});
		new LiveCart.AjaxRequest(
			this.nodes.Form,
			this.nodes.Query,
			function(classContainer, transport)
			{
				classContainer.innerHTML = transport.responseText;
				// also trigger onShowResultContainer callback, because common use for this callback is position result and this can change result container size.
				if (this.callbacks && this.callbacks.showResultContainer && typeof this.callbacks.showResultContainer == "function")
				{
					this.callbacks.showResultContainer(this);
				}
			}.bind(this, container.up("div"))
		);
	},

	_setFormOptions: function(options)
	{
		this.nodes.Class.value=options.cn ? options.cn : "";
		this.nodes.From.value=options.from ? options.from : "";
		this.nodes.To.value=options.to ? options.to: "";
		this.nodes.Direction.value=options.direction ? options.direction : "";
	}
}

Backend.QuickSearch.createInstance = function(name, enabledClassNames)
{
	window.quickSearchInstances[name] = new Backend.QuickSearch(name, enabledClassNames);
	return window.quickSearchInstances[name];
}

Backend.QuickSearch.getInstance = function(obj)
{
	var
		i = 0,
		id;
	obj = $(obj);

	// quick search container div has id <instance name>Container
	// remove Container and get instance name.
	while(obj.id.match(/ResultOuterContainer$/) == null)
	{
		if(i>10)
		{
			throw "Can't find QuickSearch instance from passed node";
		}
		obj = obj.up("div");
	}
	id = obj.id.replace(/ResultOuterContainer$/, '');

	if(typeof window.quickSearchInstances[id] == "undefined")
	{
		throw "Can't find QuickSearch instance, probably not initalized";
	}
	return window.quickSearchInstances[id];
}



/***************************************************
 * library/dhtmlHistory/dhtmlHistory.js
 ***************************************************/

/**
   Copyright (c) 2005, Brad Neuberg, bkn3@columbia.edu
   http://codinginparadise.org

   Permission is hereby granted, free of charge, to any person obtaining
   a copy of this software and associated documentation files (the "Software"),
   to deal in the Software without restriction, including without limitation
   the rights to use, copy, modify, merge, publish, distribute, sublicense,
   and/or sell copies of the Software, and to permit persons to whom the
   Software is furnished to do so, subject to the following conditions:

   The above copyright notice and this permission notice shall be
   included in all copies or substantial portions of the Software.

   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
   OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
   OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR
   THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/** An object that provides DHTML history, history data, and bookmarking
	for AJAX applications. */
window.dhtmlHistory = {
   /** Initializes our DHTML history. You should
	   call this after the page is finished loading. */
   /** public */ initialize: function() {
	  // only Internet Explorer needs to be explicitly initialized;
	  // other browsers don't have its particular behaviors.
	  // Basicly, IE doesn't autofill form data until the page
	  // is finished loading, which means historyStorage won't
	  // work until onload has been fired.
	  if (this.isInternetExplorer() == false) {
		 return;
	  }

	  // if this is the first time this page has loaded...
	  if (historyStorage.hasKey("DhtmlHistory_pageLoaded") == false) {
		 this.fireOnNewListener = false;
		 this.firstLoad = true;
		 historyStorage.put("DhtmlHistory_pageLoaded", true);
	  }
	  // else if this is a fake onload event
	  else {
		 this.fireOnNewListener = true;
		 this.firstLoad = false;
	  }
   },

   /** Adds a history change listener. Note that
	   only one listener is supported at this
	   time. */
   /** public */ addListener: function(callback) {
	  this.listener = callback;

	  // if the page was just loaded and we
	  // should not ignore it, fire an event
	  // to our new listener now
	  if (this.fireOnNewListener == true) {
		 //this.fireHistoryEvent(this.currentLocation);
		 //this.fireOnNewListener = false;
	  }
   },

	/**
	 * @author Integry Systems
	 */
	handleBookmark: function()
	{
		hash = window.location.hash.substr(1);
		if(window.historyStorage.hasKey(hash))
		{
			this.fireHistoryEvent(hash);
		}
		else
		{
			Backend.ajaxNav.handle(hash);
		}
	},

   /** public */ add: function(newLocation, historyData) {
	  // most browsers require that we wait a certain amount of time before changing the
	  // location, such as 200 milliseconds; rather than forcing external callers to use
	  // window.setTimeout to account for this to prevent bugs, we internally handle this
	  // detail by using a 'currentWaitTime' variable and have requests wait in line
	  var self = this;
	  var addImpl = function() {
		 // indicate that the current wait time is now less
		 if (self.currentWaitTime > 0)
			self.currentWaitTime = self.currentWaitTime - self.WAIT_TIME;

		 // remove any leading hash symbols on newLocation
		 newLocation = self.removeHash(newLocation);

		 // IE has a strange bug; if the newLocation
		 // is the same as _any_ preexisting id in the
		 // document, then the history action gets recorded
		 // twice; throw a programmer exception if there is
		 // an element with this ID
		 var idCheck = document.getElementById(newLocation);
		 if (idCheck != undefined || idCheck != null) {
			var message =
			   "Exception: History locations can not have "
			   + "the same value as _any_ id's "
			   + "that might be in the document, "
			   + "due to a bug in Internet "
			   + "Explorer; please ask the "
			   + "developer to choose a history "
			   + "location that does not match "
			   + "any HTML id's in this "
			   + "document. The following ID "
			   + "is already taken and can not "
			   + "be a location: "
			   + newLocation;

			throw message;
		 }

		 // store the history data into history storage
		 historyStorage.put(newLocation, historyData);

		 // indicate to the browser to ignore this upcomming
		 // location change
		 self.ignoreLocationChange = true;

		 // indicate to IE that this is an atomic location change
		 // block
		 this.ieAtomicLocationChange = true;

		 // save this as our current location
		 self.currentLocation = newLocation;

		 // change the browser location
		 window.location.hash = newLocation;

		 // change the hidden iframe's location if on IE
		 if (self.isInternetExplorer())
			self.iframe.src = "javascript/library/dhtmlhistory/history.php?" + newLocation;

		 // end of atomic location change block
		 // for IE
		 this.ieAtomicLocationChange = false;
	  };

	  // now execute this add request after waiting a certain amount of time, so as to
	  // queue up requests
	  window.setTimeout(addImpl, this.currentWaitTime);

	  // indicate that the next request will have to wait for awhile
	  this.currentWaitTime = this.currentWaitTime + this.WAIT_TIME;
   },

   /** public */ isFirstLoad: function() {
	  if (this.firstLoad == true) {
		 return true;
	  }
	  else {
		 return false;
	  }
   },

   /** public */ isInternational: function() {
	  return false;
   },

   /** public */ getVersion: function() {
	  return "0.05";
   },

   /** Gets the current hash value that is in the browser's
	   location bar, removing leading # symbols if they are present. */
   /** public */ getCurrentLocation: function() {
	  var currentLocation = this.removeHash(window.location.hash);

	  return currentLocation;
   },





   /** Our current hash location, without the "#" symbol. */
   /** private */ currentLocation: null,

   /** Our history change listener. */
   /** private */ listener: null,

   /** A hidden IFrame we use in Internet Explorer to detect history
	   changes. */
   /** private */ iframe: null,

   /** Indicates to the browser whether to ignore location changes. */
   /** private */ ignoreLocationChange: null,

   /** The amount of time in milliseconds that we should wait between add requests.
	   Firefox is okay with 200 ms, but Internet Explorer needs 400. */
   /** private */ WAIT_TIME: 1000,

   /** The amount of time in milliseconds an add request has to wait in line before being
	   run on a window.setTimeout. */
   /** private */ currentWaitTime: 0,

   /** A flag that indicates that we should fire a history change event
	   when we are ready, i.e. after we are initialized and
	   we have a history change listener. This is needed due to
	   an edge case in browsers other than Internet Explorer; if
	   you leave a page entirely then return, we must fire this
	   as a history change event. Unfortunately, we have lost
	   all references to listeners from earlier, because JavaScript
	   clears out. */
   /** private */ fireOnNewListener: null,

   /** A variable that indicates whether this is the first time
	   this page has been loaded. If you go to a web page, leave
	   it for another one, and then return, the page's onload
	   listener fires again. We need a way to differentiate
	   between the first page load and subsequent ones.
	   This variable works hand in hand with the pageLoaded
	   variable we store into historyStorage.*/
   /** private */ firstLoad: null,

   /** A variable to handle an important edge case in Internet
	   Explorer. In IE, if a user manually types an address into
	   their browser's location bar, we must intercept this by
	   continiously checking the location bar with an timer
	   interval. However, if we manually change the location
	   bar ourselves programmatically, when using our hidden
	   iframe, we need to ignore these changes. Unfortunately,
	   these changes are not atomic, so we surround them with
	   the variable 'ieAtomicLocationChange', that if true,
	   means we are programmatically setting the location and
	   should ignore this atomic chunked change. */
   /** private */ ieAtomicLocationChange: null,

   /** Creates the DHTML history infrastructure. */
   /** private */ create: function() {
	  // get our initial location
	  var initialHash = this.getCurrentLocation();

	  // save this as our current location
	  this.currentLocation = initialHash;

	  // write out a hidden iframe for IE and
	  // set the amount of time to wait between add() requests
	  if (this.isInternetExplorer()) {
		 document.write("<iframe style='border: 0px; width: 200px;"
							   + "height: 100px; position: absolute; top: 0px; "
							   + "left: 500px; z-index: 50000; visibility: visible; display: none;' "
							   + "name='DhtmlHistoryFrame' id='DhtmlHistoryFrame'  onload='window.dhtmlHistory.frameLoad(this);' "
							   + "src='javascript/library/dhtmlhistory/history.php?" + initialHash + "'>"
							   + "</iframe>");
		 // wait 400 milliseconds between history
		 // updates on IE, versus 200 on Firefox
		 this.WAIT_TIME = 400;
	  }

	  // add an unload listener for the page; this is
	  // needed for Firefox 1.5+ because this browser caches all
	  // dynamic updates to the page, which can break some of our
	  // logic related to testing whether this is the first instance
	  // a page has loaded or whether it is being pulled from the cache
	  //var self = this;
	  //window.onunload = function() {
	  //   self.firstLoad = null;
	  //};

	  // determine if this is our first page load;
	  // for Internet Explorer, we do this in
	  // this.iframeLoaded(), which is fired on
	  // page load. We do it there because
	  // we have no historyStorage at this point
	  // in IE, which only exists after the page
	  // is finished loading for that browser
	  if (this.isInternetExplorer() == false) {
		 if (historyStorage.hasKey("DhtmlHistory_pageLoaded") == false) {
			this.ignoreLocationChange = true;
			this.firstLoad = true;
			historyStorage.put("DhtmlHistory_pageLoaded", true);
		 }
		 else {
			// indicate that we want to pay attention
			// to this location change
			this.ignoreLocationChange = false;
			// For browser's other than IE, fire
			// a history change event; on IE,
			// the event will be thrown automatically
			// when it's hidden iframe reloads
			// on page load.
			// Unfortunately, we don't have any
			// listeners yet; indicate that we want
			// to fire an event when a listener
			// is added.
			this.fireOnNewListener = true;
		 }
	  }
	  else { // Internet Explorer
		 // the iframe will get loaded on page
		 // load, and we want to ignore this fact
		 this.ignoreLocationChange = true;
	  }

	  if (this.isInternetExplorer()) {
			this.iframe = document.getElementById("DhtmlHistoryFrame");
	  }

	  // other browsers can use a location handler that checks
	  // at regular intervals as their primary mechanism;
	  // we use it for Internet Explorer as well to handle
	  // an important edge case; see checkLocation() for
	  // details
	  var self = this;
	  var locationHandler = function() {
		 self.checkLocation();
	  };
	  setInterval(locationHandler, 1000);
   },

   /** Notify the listener of new history changes. */
   /** private */ fireHistoryEvent: function(newHash) {
	  // extract the value from our history storage for
	  // this hash
	  var historyData = historyStorage.get(newHash);

	  // call our listener
	  if (this.listener)
	  {
		  this.listener(newHash, historyData);
	  }
   },

	  /**
	   * @author Integry Systems
	   */
	  frameLoad: function(frame)
	  {
		  var hash = window.frames[frame.id].document.body.firstChild.nodeValue;
		  if (window.location.hash == '#' + hash)
		  {
  		  	  return false;
		  }
//		  addlog(hash);
		  window.dhtmlHistory.fireHistoryEvent(hash);
	  },

   /** Sees if the browsers has changed location.  This is the primary history mechanism
	   for Firefox. For Internet Explorer, we use this to handle an important edge case:
	   if a user manually types in a new hash value into their Internet Explorer location
	   bar and press enter, we want to intercept this and notify any history listener. */
   /** private */ checkLocation: function() {
	  // ignore any location changes that we made ourselves
	  // for browsers other than Internet Explorer
	  if (this.isInternetExplorer() == false
		 && this.ignoreLocationChange == true) {
		 this.ignoreLocationChange = false;
		 return;
	  }

	  // if we are dealing with Internet Explorer
	  // and we are in the middle of making a location
	  // change from an iframe, ignore it
	  if (this.isInternetExplorer() == false
		  && this.ieAtomicLocationChange == true) {
		 return;
	  }

	  // get hash location
	  var hash = this.getCurrentLocation();

	  // see if there has been a change
	  if (hash == this.currentLocation)
		 return;

	  // on Internet Explorer, we need to intercept users manually
	  // entering locations into the browser; we do this by comparing
	  // the browsers location against the iframes location; if they
	  // differ, we are dealing with a manual event and need to
	  // place it inside our history, otherwise we can return
	  this.ieAtomicLocationChange = true;

	  if (this.isInternetExplorer()
		  && this.getIFrameHash() != hash) {
		 this.iframe.src = "javascript/library/dhtmlhistory/history.php?" + hash;
	  }
	  else if (this.isInternetExplorer()) {
		 // the iframe is unchanged
		 return;
	  }

	  // save this new location
	  this.currentLocation = hash;

	  this.ieAtomicLocationChange = false;

	  // notify listeners of the change
	  this.fireHistoryEvent(hash);
   },

   /** Gets the current location of the hidden IFrames
	   that is stored as history. For Internet Explorer. */
   /** private */ getIFrameHash: function() {
	  // get the new location
	  var historyFrame = document.getElementById("DhtmlHistoryFrame");
	  var doc = historyFrame.contentWindow.document;
	  var hash = new String(doc.location.search);

	  if (hash.length == 1 && hash.charAt(0) == "?")
		 hash = "";
	  else if (hash.length >= 2 && hash.charAt(0) == "?")
		 hash = hash.substring(1);


	  return hash;
   },

   /** Removes any leading hash that might be on a location. */
   /** private */ removeHash: function(hashValue) {
	  if (hashValue == null || hashValue == undefined)
		 return null;
	  else if (hashValue == "")
		 return "";
	  else if (hashValue.length == 1 && hashValue.charAt(0) == "#")
		 return "";
	  else if (hashValue.length > 1 && hashValue.charAt(0) == "#")
		 return hashValue.substring(1);
	  else
		 return hashValue;
   },

   /** For IE, says when the hidden iframe has finished loading. */
   /** private */ iframeLoaded: function(newLocation) {
	  // ignore any location changes that we made ourselves
	  if (this.ignoreLocationChange == true) {
		 this.ignoreLocationChange = false;
		 return;
	  }

	  // get the new location
	  var hash = new String(newLocation.search);
	  if (hash.length == 1 && hash.charAt(0) == "?")
		 hash = "";
	  else if (hash.length >= 2 && hash.charAt(0) == "?")
		 hash = hash.substring(1);

	  // move to this location in the browser location bar
	  // if we are not dealing with a page load event
	  if (this.pageLoadEvent != true) {
		 window.location.hash = hash;
	  }

	  // notify listeners of the change
	  this.fireHistoryEvent(hash);
   },

   /** Determines if this is Internet Explorer. */
   /** private */ isInternetExplorer: function() {
	  return false;
	  var userAgent = navigator.userAgent.toLowerCase();
	  if (document.all && userAgent.indexOf('msie')!=-1) {
		 return true;
	  }
	  else {
		 return false;
	  }
   }
};












/** An object that uses a hidden form to store history state
	across page loads. The chief mechanism for doing so is using
	the fact that browser's save the text in form data for the
	life of the browser and cache, which means the text is still
	there when the user navigates back to the page. See
	http://codinginparadise.org/weblog/2005/08/ajax-tutorial-saving-session-across.html
	for full details. */
window.historyStorage = {
   /** If true, we are debugging and show the storage textfield. */
   /** public */ debugging: false,

   /** Our hash of key name/values. */
   /** private */ storageHash: {},

   /** If true, we have loaded our hash table out of the storage form. */
   /** private */ hashLoaded: false,

   /** public */ put: function(key, value) {
	   this.assertValidKey(key);

	   // if we already have a value for this,
	   // remove the value before adding the
	   // new one
	   if (this.hasKey(key)) {
		 this.remove(key);
	   }

	   if (!this.storageHash)
	   {
			this.storageHash = {};
	   }

	   // store this new key
	   this.storageHash[key] = value;

	   // save and serialize the hashtable into the form
	   this.saveHashTable();
   },

   /** public */ get: function(key) {
	  this.assertValidKey(key);

	  // make sure the hash table has been loaded
	  // from the form
	  this.loadHashTable();

	  var value = this.storageHash[key];

	  if (value == undefined)
		 return null;
	  else
		 return value;
   },

   /** public */ remove: function(key) {
	  this.assertValidKey(key);

	  // make sure the hash table has been loaded
	  // from the form
	  this.loadHashTable();

	  // delete the value
	  delete this.storageHash[key];

	  // serialize and save the hash table into the
	  // form
	  this.saveHashTable();
   },

   /** Clears out all saved data. */
   /** public */ reset: function() {
	  this.storageField.value = "";
	  this.storageHash = new Object();
   },

   /** public */ hasKey: function(key) {
	  this.assertValidKey(key);

	  // make sure the hash table has been loaded
	  // from the form
	  this.loadHashTable();

	  if (!this.storageHash || !this.storageHash[key])
		 return false;
	  else
		 return true;
   },

   /** Determines whether the key given is valid;
	   keys can only have letters, numbers, the dash,
	   underscore, spaces, or one of the
	   following characters:
	   !@#$%^&*()+=:;,./?|\~{}[] */
   /** public */ isValidKey: function(key) {
	  // allow all strings, since we don't use XML serialization
	  // format anymore
	  return (typeof key == "string");

	  /*
	  if (typeof key != "string")
		 key = key.toString();


	  var matcher =
		 /^[a-zA-Z0-9_ \!\@\#\$\%\^\&\*\(\)\+\=\:\;\,\.\/\?\|\\\~\{\}\[\]]*$/;

	  return matcher.test(key);*/
   },




   /** A reference to our textarea field. */
   /** private */ storageField: null,

   /** private */ init: function() {
	  // write a hidden form into the page
	  var styleValue = "position: absolute; top: -1000px; left: -1000px;";
	  if (this.debugging == true) {
		 styleValue = "width: 30em; height: 30em;";
	  }

	  var newContent =
		 "<form id='historyStorageForm' "
			   + "method='GET' "
			   + "style='" + styleValue + "'>"
			+ "<textarea id='historyStorageField' "
					  + "style='" + styleValue + "'"
							  + "left: -1000px;' "
					  + "name='historyStorageField'></textarea>"
		 + "</form>";
	  document.write(newContent);

	  this.storageField = document.getElementById("historyStorageField");
   },

   /** Asserts that a key is valid, throwing
	   an exception if it is not. */
   /** private */ assertValidKey: function(key) {
	  if (this.isValidKey(key) == false) {
		 throw "Please provide a valid key for "
			   + "window.historyStorage, key= "
			   + key;
	   }
   },

   /** Loads the hash table up from the form. */
   /** private */ loadHashTable: function() {
	  if (this.hashLoaded == false) {
		 // get the hash table as a serialized
		 // string
		 var serializedHashTable = this.storageField.value;

		 if (serializedHashTable != "" &&
			 serializedHashTable != null) {
			// destringify the content back into a
			// real JavaScript object
			this.storageHash = eval('(' + serializedHashTable + ')');
		 }

		 this.hashLoaded = true;
	  }
   },

   /** Saves the hash table into the form. */
   /** private */ saveHashTable: function() {
	  this.loadHashTable();

	  // serialized the hash table
	  var serializedHashTable = Object.toJSON(this.storageHash);

	  // save this value
	  this.storageField.value = serializedHashTable;
   }
};


/***************************************************
 * backend/BackendToolbar.js
 ***************************************************/

var BackendToolbar = Class.create();
BackendToolbar.prototype = {

	isBackend: true,

	nodes: function()
	{
		this.nodes.lastviewed = this.nodes.root.down(".lastviewed");
		this.nodes.lastViewedIndicator = $("lastViewedIndicator");
		this.nodes.quickSearchResult = $("TBQuickSearchResultOuterContainer");
		this.nodes.quickSearchQuery = $("TBQuickSearchQuery");
	},

	afterInit: function()
	{
		// remove button from toolbar, if it is droped outside any droppable area
		Droppables.add($(document.body), {
			onDrop: function(from, to, event) {
				from = $(from);
				if (from.hasClassName("dropButton"))
				{
					this.removeIcon(from);
				}
			}.bind(this)
		});
		// --

		$A($("navContainer").getElementsByTagName("li")).each(
			function(element)
			{
				element = $(element);
				var
					a = element.down("a"),
					menuItem = this.getMenuItem(a.id);
				if (!menuItem || typeof menuItem.url == "undefined" || menuItem.url == "")
				{
					return; // menu items without url are not draggable!
				}
				Event.observe(a, "click", this.cancelClickEventOnDrag.bindAsEventListener(this));
				new Draggable(element,
					{
						onStart: function(inst)
						{
							var
								element = $(inst.element),
								ul = element.up("ul");
							this.draggingItem = true;
							if (ul)
							{
								ul.addClassName("importantVisible"); // make sure draggable item stay visible while dragging.
							}
						}.bind(this),

						onEnd: function(inst, event)
						{
							var
								element = $(inst.element),
								ul = element.up("ul");
							if (ul)
							{
								ul.removeClassName("importantVisible");
							}
						},
						ghosting:true,
						revert:true,
						zindex:9999
					}
				);
			}.bind(this)
		);

		// init unitialized drop buttons
		dropButtons = $A(this.nodes.mainpanel.getElementsByClassName("uninitializedDropButton"));
		dropButtons.each(this.fillDropButtonWithData.bind(this));
		this.updateDroppables();

		// -- last viewed
		this.adjustPanel(this.nodes.lastviewed);
		Event.observe(window, "resize", function()
			{
				this.adjustPanel(this.nodes.lastviewed);
			}.bind(this)
		);
		Event.observe(document.body, "click",this.hideLastViewedMenu.bind(this));
		Event.observe(this.nodes.lastviewed.down("a"), "click", function(event) {
			Event.stop(event);
			this[["hideLastViewedMenu", "openLastViewedMenu"][this.nodes.lastviewed.down("a").hasClassName("active")?0:1]]();
		}.bindAsEventListener(this));

		// quick search result bottom relative to toolbar
		Backend.QuickSearch.getInstance(this.nodes.quickSearchResult).onShowResultContainer(this.adjustQuickSearchResult.bind(this));

		Event.observe(this.nodes.quickSearchQuery, "focus", this.hideLastViewedMenu.bind(this));
	},

	openLastViewedMenu: function()
	{
		this.nodes.quickSearchResult.hide();
		if (this.nodes.lastviewed.hasClassName("invalid"))
		{
			$A(this.nodes.lastviewed.getElementsBySelector("ul li")).each(Element.remove);
			this.adjustPanel(this.nodes.lastviewed);
			this.nodes.lastViewedIndicator.show();
			this.nodes.lastViewedIndicator.addClassName("progressIndicator");
			new LiveCart.AjaxUpdater(
				this.getPorperty("lastViewed"),
				this.nodes.lastviewed.down("ul"),
				this.nodes.lastViewedIndicator,
				false,
				function() {
					this.nodes.lastviewed.removeClassName("invalid");
					this.adjustPanel(this.nodes.lastviewed);
				}.bind(this)
			);
		}

		var a = this.nodes.lastviewed.down("a");
		a.addClassName("active");
		this.getSubPanels(this.nodes.lastviewed).each(
			function(subpanel) {
				$(subpanel).addClassName("importantVisible");
			}
		);
	},
	
	
	hideLastViewedMenu: function()
	{
		if(this.isBackend == false)
		{
			return;
		}
		var a = this.nodes.lastviewed.down("a");
		a.removeClassName("active");
		this.getSubPanels(this.nodes.lastviewed).each(
			function(subpanel) {
				$(subpanel).removeClassName("importantVisible");
			}
		);
	},

	fillDropButtonWithData: function(node)
	{
		var
			menuItem = this.getMenuItem(node.id),
			a = node.down("a"),
			node = $(node);

		a.href = menuItem.url;
		a.down("small").innerHTML = menuItem.title;
		a.innerHTML = menuItem.title + a.innerHTML;
		a.style.background = "url(" +menuItem.icon+") no-repeat center center";
		node.removeClassName("uninitializedDropButton");
		node.addClassName("dropButton");

		Event.observe(node.down("a"), "click", this.cancelClickEventOnDrag.bindAsEventListener(this));
		new Draggable(node, {
			ghosting:true,
			revert:true,
			onStart: function(inst)
			{
				this.draggingItem = true;
			}.bind(this)
		});
		node.show();
	},

	updateDroppables: function()
	{
		var droppTargets = $A(this.nodes.mainpanel.getElementsByClassName("dropButton")); // all buttons
		droppTargets.push(this.nodes.mainpanel) // + mainpanel (ul tag), if dropped outside button
		droppTargets.each(function(element){
			element = $(element);
			if(element.hasClassName("droppable"))
			{
				return;
			}

			Droppables.add(
				element,
				{
					onDrop: function(from, to, event)
					{
						from = $(from);
						if (from.hasClassName("dropButton"))
						{
							// dragging button,
							this.sortIcons(from, to);
						}
						else
						{
							this.addIcon(from, to);
						}
					}.bind(this)
				}
			);
			element.addClassName("droppable");
		}.bind(this));
	},

	getButtonPosition: function(node)
	{
		var position;

		$A($(node).up("ul").getElementsByClassName("dropButton")).find(
			function(item,i)
			{
				position = i;
				return node == item;
			}
		);
		return position;
	},

	addIcon: function(li, insertBeforeLi)
	{
		// 1. add icon
		// 2. send ajax update
		// 3. if adding icon failed -remove

		if ($('noToolbarButtons'))
		{
			$('noToolbarButtons').hide();
		}

		node = $("dropButtonTemplate").cloneNode(true);
		node.id="button"+$(li).down("a").id;
		if ($(insertBeforeLi).hasClassName("dropButton"))
		{
			this.nodes.mainpanel.insertBefore(node, insertBeforeLi);
		}
		else
		{
			this.nodes.mainpanel.appendChild(node);
		}
		this.fillDropButtonWithData(node);
		this.updateDroppables();
		new LiveCart.AjaxRequest(
			this.getPorperty("addIcon").replace("_id_", node.id.replace("button", "")).replace("_position_",this.getButtonPosition(node)),
			null,
			function(node, transport)
			{
				var responseData = eval("(" + transport.responseText + ")");
				if (responseData.status != "success")
				{
					node.parentNode.removeChild(node);
				}
			}.bind(this, node)
		);
	},

	removeIcon: function(node)
	{
		// todo: stop observing
		node = $(node);
		if (node.tagName.toLowerCase() != "li")
		{
			node = node.up("li");
		}

		var
			id = node.id.replace("button", ""),
			menuItem = this.getMenuItem(id);

		new LiveCart.AjaxRequest
		(
			this.getPorperty("removeIcon").replace("_id_", id).replace("_position_",this.getButtonPosition(node)),
			null,
			function(node, transport)
			{
				var responseData = eval("(" + transport.responseText + ")");
				if (responseData.status == "success")
				{
					node.parentNode.removeChild(node);
				}
			}.bind(this, node)
		);
	},

	getMenuItem: function(id)
	{
		if (id.length == 0)
		{
			return null;
		}

		// window.menuArray;
		chunks = id.split("_");
		item = window.menuArray[chunks[1]];
		if(chunks.length == 3)
		{
			item = item.items[chunks[2]];
		}
		return item;
	},

	sortIcons: function(li, sortBefore)
	{
		if ($(sortBefore).hasClassName("dropButton"))
		{
			this.nodes.mainpanel.insertBefore(li, sortBefore);
		}
		else
		{
			this.nodes.mainpanel.appendChild(li); // move to end
		}
		r = $A(this.nodes.mainpanel.getElementsByClassName("dropButton")).inject([], function(r, item) {
			r.push(item.id.replace("button", ""));
			return r;
		});
		new LiveCart.AjaxRequest(this.getPorperty("sortIcons").replace('_order_', r.join(",")), null);
	},

	adjustQuickSearchResult: function(quickSearch)
	{
		var height = quickSearch.nodes.Result.getHeight();
		quickSearch.nodes.Result.style.marginTop = "-" + (height + 40) + "px";
	},

	// footerToolbar.invalidateLastViewed();
	invalidateLastViewed: function()
	{
		this.nodes.lastviewed.addClassName("invalid");
	}
}

BackendToolbar.prototype = Object.extend(FooterToolbar.prototype, BackendToolbar.prototype);
