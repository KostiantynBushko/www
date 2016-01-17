Backend.ProductVariationItem.prototype._pre_cloning_initFields = Backend.ProductVariationItem.prototype.initFields;

Backend.ProductVariationItem.prototype.initFields = function()
{
	this._pre_cloning_initFields();
	this.row.fieldCells['custom'].getElementsByTagName('textarea')[0].value = this.data['custom'] ? this.data['custom'] : '';
}
