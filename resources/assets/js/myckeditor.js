CKEDITOR.editorConfig = function(config) {
  var $currentElement = $(this.element);
  config.autoParagraph = false;
  config.removeButtons = 'Anchor,HorizontalRule';
  config.format_tags = config.format_tags + ';div';
  config.allowedContent = true;
  config.extraAllowedContent = 'div(col-md-*,container,container-fluid,row)';
  config.contentsCss = [config.contentsCss, '/packages/sleeping-owl/admin/default/css/bootstrap.min.css'];
  config.entities = false;
};