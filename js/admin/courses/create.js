// Generated by CoffeeScript 1.4.0
var create;

create = {
  init: function() {
    this.detect_elements();
    return this.bind_events();
  },
  detect_elements: function() {
    return this.form = $("form");
  },
  bind_events: function() {
    this.init_redactor();
    return this.form_validation();
  },
  init_redactor: function() {
    return $('.textarea').wysihtml5();
  },
  form_validation: function() {
    return this.form.validationEngine('attach');
  }
};

$(document).ready(function() {
  return create.init();
});
