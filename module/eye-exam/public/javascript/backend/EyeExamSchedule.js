/**
 *	@author Integry Systems
 */

Backend.EyeExamSchedule = Class.create();
Backend.EyeExamSchedule.prototype =
{
	initialize: function(eyeExamList, container, template)
	{
		if ($("addEyeExamScheduleLink"))
		{
			Element.observe("addEyeExamScheduleLink", "click", function(e)
			{
				Event.stop(e);
				Backend.EyeExamSchedule.prototype.showAddForm();
			});

			Element.observe("addEyeExamScheduleCancelLink", "click", function(e)
			{
				Event.stop(e);
				Backend.EyeExamSchedule.prototype.hideAddForm();
			});
		}

		ActiveList.prototype.getInstance('eyeExamList', {
			 beforeEdit:	 function(li)
			 {
				 if (!this.isContainerEmpty(li, 'edit'))
				 {
					 li.handler.cancelEditForm();
					 return;
				 }
				 li.handler.showEditForm();
				 return false;
			 },
			 beforeDelete:   function(li)
			 {
				 if (confirm($('confirmDelete').innerHTML)) return $('deleteUrl').innerHTML + this.getRecordId(li)
			 },
			 afterEdit: function(li, response) { li.handler.update(response);},
			 //afterSort: function(li, response) {  },
			 afterDelete: function(li, response)
			 {
				 try
				 {
					response = eval('(' + response + ')');
				 }
				 catch(e)
				 {
					return false;
				 }
			 }
		 }, []);

		var
			match = Backend.getHash().match(/eyeExam_(\d+)/),
			id=null;
		if(match)
		{
			id = match.pop();
		}
		eyeExamList.each(function(id, el)
		{
			var
				entry = new Backend.EyeExamSchedule.PostEntry(container, template, el, false);
			if(id && entry.data.ID == id)
			{
				entry.showEditForm();
			}
		}.bind(this, id));
		ActiveList.prototype.getInstance('eyeExamList').touch(true);
	},

	showAddForm: function()
	{
		$H($('eyeExamList').getElementsByTagName('li')).each(function(li)
		{
			if (li && li[1] && li[1].handler)
			{
				li[1].handler.cancelEditForm();
			}
		});

		var menu = new ActiveForm.Slide('eyeExamMenu');
		menu.show("addEyeExamSchedule", 'addEyeExamSchedule');
	},

	hideAddForm: function()
	{
		var menu = new ActiveForm.Slide('eyeExamMenu');
		menu.hide("addEyeExamSchedule", 'addEyeExamSchedule');
	}
}

Backend.EyeExamSchedule.PostEntry = Class.create();
Backend.EyeExamSchedule.PostEntry.prototype =
{
	data: null,

	node: null,

	list: null,

	initialize: function(container, template, data, highlight, isNew)
	{
		this.data = data;

		this.list = ActiveList.prototype.getInstance('eyeExamList');

		this.node = this.list.addRecord(data.ID, template.innerHTML, highlight);

		if (isNew)
		{
			this.node.parentNode.insertBefore(this.node, this.node.parentNode.firstChild);
		}

		this.updateHtml();

		this.node.handler = this;

		Element.show(this.node);
	},

	showEditForm: function()
	{
		Backend.EyeExamSchedule.prototype.hideAddForm();

		var nodes = this.node.parentNode.getElementsByTagName('li');
		$H(nodes).each(function(li)
		{
			if (li && li[1] && li[1].handler && li != this.node)
			{
				li[1].handler.cancelEditForm();
			}
		});

		var form = $('eyeExamForm').cloneNode(true);
		this.node.down('div.formContainer').appendChild(form);

		$H(this.data).each(function(el)
		{
			if (form.elements.namedItem(el[0]))
		 	{
				form.elements.namedItem(el[0]).value = el[1];
			}
		});

		form.elements.namedItem('id').value = this.data['ID'];

        // set proper time
        form.elements.namedItem('time').value = this.data['time'];

		// set up calendar field
		var date = this.node.down('#examDate');
		var date_real = this.node.down('#examDate_real');
		var date_button = this.node.down('#examDate_button');

		date_button.realInput = date_real;
		date_button.showInput = date;

		date.realInput = date_real;
		date.showInput = date;

		date_real.value = this.data['date'];

		Event.observe(date,		"keyup",	 Calendar.updateDate );
		Event.observe(date,		"blur",	  Calendar.updateDate );
		Event.observe(date_button, "mousedown", Calendar.updateDate );

		Calendar.setup({
			inputField:	 date,
			inputFieldReal: date_real,
			ifFormat:	   "%d-%b-%Y",
			button:		 date_button,
			align:		  "BR",
			singleClick:	true
		});

		if (window.tinyMCE)
		{
			tinyMCE.idCounter = 0;
		}

		ActiveForm.prototype.initTinyMceFields(this.node.down('div.formContainer'));

		form.down('a.cancel').onclick = this.cancelEditForm.bindAsEventListener(this);
		form.onsubmit = this.save.bindAsEventListener(this);

		new Backend.LanguageForm(form);

		this.list.toggleContainerOn(this.list.getContainer(this.node, 'edit'));
	},

	cancelEditForm: function(e)
	{
		if (!this.list.isContainerEmpty(this.node, 'edit'))
		{
			this.list.toggleContainerOff(this.list.getContainer(this.node, 'edit'));
		}

		var formContainer = this.node.down('div.formContainer');

		if (!formContainer.firstChild)
		{
			return;
		}

		ActiveForm.prototype.destroyTinyMceFields(formContainer);

		formContainer.innerHTML = '';

		if (e)
		{
			Event.stop(e);
		}
	},

	save: function(e)
	{
		Element.saveTinyMceFields(this.node);
		var form = this.node.down('form');
		form.action = $('saveUrl').innerHTML;
		new LiveCart.AjaxRequest(form, null, this.update.bind(this));
		Event.stop(e);
	},

	update: function(originalRequest)
	{
		this.data = originalRequest.responseData;
		this.updateHtml();
		this.cancelEditForm();
		Element.show(this.node.down('.checkbox'));
		ActiveList.prototype.highlight(this.node, 'yellow');
	},

	del: function()
	{

	},

	updateHtml: function()
	{
		if (this.data.eyeExamRequestID)
		{
            Element.removeClassName(this.node, 'disabled');
        }
		else
		{
            Element.addClassName(this.node, 'disabled');
        }

		this.node.down('.eyeExamDoctorName').innerHTML = this.data.doctorName;

		if (this.data.formatted_date)
		{
			this.node.down('.eyeExamDate').innerHTML = this.data.formatted_date.date_long + " " + this.data.time.substr(0, 5);
		}

		this.node.down('.eyeExamComment').innerHTML = this.data.comment;
		this.node.down('.eyeExamIsVisible').innerHTML = this.data.isVisible;
		this.node.down('.eyeExamTime').innerHTML = this.data.time.substr(0, 5);
		this.node.down('.eyeExamEyeExamRequestID').innerHTML = this.data.eyeExamRequestID;
		this.node.id = 'eyeExamEntry_' + this.data.ID;

        var eyeExamRequest = "<br />"
        if (this.data.EyeExamRequest){
            var o = this.data.EyeExamRequest;

            if (o.specialFields) {
                for (var key in o.specialFields) {
                    if (o.specialFields.hasOwnProperty(key)) {
                        eyeExamRequest += key + ": " + o.specialFields[key] + "<br />";
                    }
                }
            }
            this.node.down('.eyeExamEyeExamRequest').innerHTML = eyeExamRequest;
        }
	}
}

Backend.EyeExamSchedule.Add = Class.create();
Backend.EyeExamSchedule.Add.prototype =
{
	form: null,

	initialize: function(form)
	{
		new LiveCart.AjaxRequest(form, null, this.onComplete.bind(this));
	},

	onComplete: function(originalRequest)
	{
		new Backend.EyeExamSchedule.PostEntry($('eyeExamList'), $('eyeExamList_template'), originalRequest.responseData, true, true);
		Backend.EyeExamSchedule.prototype.hideAddForm();
		$("eyeExamForm").reset();
		ActiveForm.prototype.resetTinyMceFields($("eyeExamForm"));
	}
}
