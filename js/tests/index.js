// Generated by CoffeeScript 1.4.0
var index;

index = {
  init: function() {
    this.detectElements();
    return this.bindEvents();
  },
  detectElements: function() {
    this.next_btn = $(".next");
    return this.prev_btn = $(".prev");
  },
  bindEvents: function() {
    this.next();
    return this.prev();
  },
  prev: function() {
    var _this = this;
    return this.prev_btn.click(function(e) {
      var el;
      e.preventDefault();
      el = $(e.currentTarget);
      return $("#atab" + (el.parents(".tab-pane").data("id") - 1)).click();
    });
  },
  next: function() {
    var _this = this;
    return this.next_btn.click(function(e) {
      var el;
      e.preventDefault();
      el = $(e.currentTarget);
      return $("#atab" + (el.parents(".tab-pane").data("id") + 1)).click();
    });
  }
};

$(document).ready(function() {
  return index.init();
});
