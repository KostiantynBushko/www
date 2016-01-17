;

if (Backend == undefined)
{
	var Backend = {}
};

Backend.ClonedStore = function(data)
{
	this.data = data;
	this.container = $('tabUserInfo_' + data.ID + 'Content');
//	this.findUsedNodes();
//	this.bindEvents();

	// for Discount.js functions
	this.condition = this.data;
};

Backend.ClonedStore.prototype =
{
	controller: 'backend.clonedStore',

	namespace: Backend.ClonedStore,

	add: function(e)
	{
		Event.stop(e);
		var link = Event.element(e);
		new LiveCart.AjaxRequest(link.href, link, this.addComplete.bind(this));
	},

	addComplete: function(req)
	{
		var clonedStore = req.responseData;
		window.activeGrids['clonedStore_'].reloadGrid();
		Backend.ClonedStore.Editor.prototype.open(clonedStore.ID);
	},

	save: function(form)
	{
		new LiveCart.AjaxRequest(form, null, this.saveComplete.bind(this));
	},

	saveComplete: function(req)
	{
		window.activeGrids['clonedStore_'].reloadGrid();
	}
};

Backend.ClonedStore.Editor = function()
{
	this.callConstructor(arguments);
};

Backend.ClonedStore.Editor.methods =
{
	namespace: Backend.ClonedStore.Editor,

	getMainContainerId: function()
	{
		return 'clonedStoreManagerContainer';
	},

	getInstanceContainer: function(id)
	{
		return $("tabUserInfo_" + id + "Content");
	},

	getListContainer: function()
	{
		return $('mainAdvContainer');
	},

	getNavHashPrefix: function()
	{
		return '#clonedStore_';
	},

	getActiveGrid: function()
	{
		return window.activeGrids["clonedStore_"];
	}
};

Backend.ClonedStore.Editor.inheritsFrom(Backend.MultiInstanceEditor);

Backend.ClonedStore.GridFormatter =
{
	formatValue: function(field, value, id)
	{
		if ('ClonedStore.domain' == field)
		{
			if (!this.url)
			{
				this.url = Backend.Router.createUrl('backend.clonedStore', 'index');
			}

			value = '<span><span class="progressIndicator clonedStoreIndicator" id="clonedStoreIndicator_' + id + '" style="display: none;"></span></span>' +
				'<a href="' + this.url + '#clonedStore_' + id + '" id="clonedStore_' + id + '" onclick="Backend.ClonedStore.Editor.prototype.open(' + id + ', event); return false;">' +
					 value +
				'</a> <a style="font-size: smaller; color: green; margin-left: 1em;" href="' + Backend.Router.createUrl('backend.cloneSync', 'sync', {id: id}) + '">[init synchronization]</a>' +
				'<a style="font-size: smaller; color: #d00; position: relative; z-index: 10; margin-left: 1em;" href="' + Backend.Router.createUrl('backend.cloneSync', 'sync', {id: id, override: true}) + '">[override changes]</a>';
		}

		return value;
	}
};

Backend.ClonedStore.saveCategories = function(form)
{
	new LiveCart.AjaxRequest(form);
};

Backend.ClonedStore.initTextRules = function(container, rules)
{
	var $ = jQuery;
	var tpl = $('#textRuleTemplate')[0];
	var container = $('#' + container)[0];

	var addRule = function(rule)
	{
		var node = tpl.cloneNode(true);
		container.appendChild(node);
		node.style.display = '';

		$('.field select', node).val(rule.field);
		['find', 'repl', 'query'].each(function(value)
		{
			$('.' + value + ' textarea', node).val(rule[value]).blur(function()
			{
				var textareas = $(this).closest('.rule').find('textarea:empty').filter(function()
				{
					return this.value == '';
				});

				if ((textareas.length < 3) &&
					 $(this).closest('.rule').is($('.rule:last', container)))
				{
					addRule({});
				}
			});
		});

		$('a.delete', node).click(function(e)
		{
			e.preventDefault();

			if ($(node).closest('.rules').find('.rule').length == 1)
			{
				addRule({});
			}

			node.parentNode.removeChild(node);
		});

		$('a.moveDown', node).click(function(e)
		{
			e.preventDefault();

			var rule = $(node).closest('.rule');
			var next = rule.next('.rule');

			if (next.length)
			{
				rule.insertAfter(next);
			}
		});

		$('a.moveUp', node).click(function(e)
		{
			e.preventDefault();

			var rule = $(node).closest('.rule');
			var next = rule.prev('.rule');

			if (next.length)
			{
				rule.insertBefore(next);
			}
		});
	}

	$.each(rules, function(i, rule) { addRule(rule); });
	addRule({});
};

Backend.ClonedStore.saveCategories = function(form)
{
	new LiveCart.AjaxRequest(form);
};

Backend.ClonedStore.initSqlRules = function(container, rules)
{
	var $ = jQuery;
	var tpl = $('#sqlRuleTemplate')[0];
	var container = $('#' + container)[0];

	var addRule = function(rule)
	{
		var node = tpl.cloneNode(true);
		container.appendChild(node);
		node.style.display = '';

		$('.field select', node).val(rule.field);
		['query'].each(function(value)
		{
			$('.' + value + ' textarea', node).val(rule[value]).keyup(function()
			{
				if (($(this).val().length > 0) &&
					 $(this).closest('.rule').is($('.rule:last', container)))
				{
					addRule({});
				}
			});
		});

		$('a.delete', node).click(function(e)
		{
			e.preventDefault();

			if ($(node).closest('.rules').find('.rule').length == 1)
			{
				addRule({});
			}

			node.parentNode.removeChild(node);
		});

		$('a.moveDown', node).click(function(e)
		{
			e.preventDefault();

			var rule = $(node).closest('.rule');
			var next = rule.next('.rule');

			if (next.length)
			{
				rule.insertAfter(next);
			}
		});

		$('a.moveUp', node).click(function(e)
		{
			e.preventDefault();

			var rule = $(node).closest('.rule');
			var next = rule.prev('.rule');

			if (next.length)
			{
				rule.insertBefore(next);
			}
		});
	}

	$.each(rules, function(i, rule) { addRule(rule); });
	addRule({});
};

Backend.ClonedStore.saveRules = function(form)
{
	new LiveCart.AjaxRequest(form);
};

;
