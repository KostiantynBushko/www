function showMirror(id, event)
{
	event.preventDefault();
	
	if (!$('mirror-container'))
	{
		var el = document.createElement('div');
		el.id = 'mirror-container';
		document.body.appendChild(el);
	}
	
	$('mirror-container').show();
	$('mirror-container').innerHTML = '<span id="mirror-indicator"></span>';
	
	var indicator = $('mirror-indicator');
	window.setInterval(function()
	{
		indicator.innerHTML = indicator.innerHTML + ' .';
	}, 20);
	new LiveCart.AjaxUpdater('../mirror/' + id, 'mirror-container');
};

function hideMirror()
{
	$('mirror-container').innerHTML = '';
	$('mirror-container').hide();
};

window.setInterval(function()
{
	function getClosest(el, tag) 
	{
		// this is necessary since nodeName is always in upper case
		tag = tag.toUpperCase();
		do {
		if (el.nodeName === tag) {
		  // tag name is found! let's return it. :)
		  return el;
		}
		} while (el = el.parentNode);

		// not found :(
		return null;
	}

	// lens type
	var types = document.querySelectorAll('select[name$="_2525"]');
	for (var k = 0; k < types.length; k++)
	{
		var sel = types[k];
		sel.table = getClosest(sel, 'td');
		
		var colorSel = sel.table.querySelector('select[name$="_2528"]');
		
		sel.onchange = function()
		{
			var grey_cheap = colorSel.querySelector('option[value="18085"]');
			var grey_exp = colorSel.querySelector('option[value="19306"]');
			var brown = colorSel.querySelector('option[value="18084"]');
			
			if ((sel.value == '18075') || (sel.value == '18076'))
			{
				brown.style.display = 'none';
				grey_cheap.style.display = 'none';
				grey_exp.style.display = 'block';
				
				if (colorSel.value == grey_cheap.value)
				{
					colorSel.value = grey_exp.value;
				}
			}
			else
			{
				brown.style.display = 'block';
				grey_cheap.style.display = 'block';
				grey_exp.style.display = 'none';

				if (colorSel.value == grey_exp.value)
				{
					colorSel.value = grey_cheap.value;
				}
			}
		};
		
		[2652, 2655].each(function(i)
		{
			var sphere = sel.table.querySelector('select[name$="_' + i + '"]');
			sphere.onchange = function()
			{
				var opt = sphere.querySelector('option[value="' + sphere.value + '"]');
				var val = 0;
				if (opt)
				{
					val = parseFloat(opt.innerHTML);
				}
				
				var descr = sphere.parentNode.querySelector('p');
				if (descr && !descr.querySelector('.recommend'))
				{
					descr.innerHTML += '<div class="recommend" style="display: none;"><strong>We recommend Thin Lenses!</strong></div>';
				}
				
				var recommend = descr.querySelector('.recommend');
				recommend.style.display = (val <= -3) ? 'block' : 'none';
			};
		});
		
		
		sel.onchange();
	}

}, 1000);
