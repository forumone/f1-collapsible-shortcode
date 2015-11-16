/*
 * Toggle widget
 * https://github.com/filamentgroup/toggle
 * Copyright (c) 2013 Filament Group, Inc.
 * Licensed under the MIT, GPL licenses.
 */
(function(e,t,n,r){function o(t,n){this.element=e(t);var o=this,u={};if(this.element.is("[data-config]")){e.each(s,function(e){var t=o.element.attr("data-"+e.replace(/[A-Z]/g,function(e){return"-"+e.toLowerCase()}));if(t!==r){if(t==="true"||t==="false"){u[e]=t==="true"}else{u[e]=t}}})}this.options=e.extend({},s,u,n);this._defaults=s;this._name=i;this.init()}var i="f1-collapsible";var s={pluginClass:i,collapsedClass:i+"-collapsed",headerClass:i+"-header",contentClass:i+"-content",instructions:"Interact to toggle content",collapsed:true};o.prototype={init:function(){this.header=this.element.children().eq(0);this.content=this.header.next();this._addAttributes();this._bindEvents()},_addAttributes:function(){this.element.addClass(this.options.pluginClass);this.header.addClass(this.options.headerClass);this.header.attr("title",this.options.instructions);this.header.attr("role","button");this.header.attr("aria-expanded","true");this.header.attr("tabindex","0");this.content.addClass(this.options.contentClass)},_bindEvents:function(){var e=this;this.element.on("expand",this.expand).on("collapse",this.collapse).on("toggle",this.toggle);this.header.on("mouseup",function(){e.element.trigger("toggle")}).on("keyup",function(t){if(t.which===13||t.which===32){e.element.trigger("toggle")}});if(this.options.collapsed){this.collapse()}},collapsed:false,expand:function(){var t=e.data(this,"plugin_"+i)||this;t.element.removeClass(t.options.collapsedClass);t.collapsed=false;t.header.attr("aria-expanded","true")},collapse:function(){var t=e.data(this,"plugin_"+i)||this;t.element.addClass(t.options.collapsedClass);t.collapsed=true;t.header.attr("aria-expanded","false")},toggle:function(){var t=e.data(this,"plugin_"+i);t.element.trigger(t.collapsed?"expand":"collapse")}};e.fn[i]=function(t){return this.each(function(){if(!e.data(this,"plugin_"+i)){e.data(this,"plugin_"+i,new o(this,t))}})};e(function(){e("."+i)[i]()})})(jQuery,window,document)

// If we're linking to an anchor link within a collapsible element, expand the collapsible element first.
jQuery(document).ready(function($) {
	var hash = window.location.href.split('#')[1];
	if( !hash ) {
		return;
	}

	var $anchor = $('#' + hash + ',a[name="' + hash + '"]').eq(0);
	var	$parent = $anchor.parents('.f1-collapsible');
	if( $parent.length > 0 ) {
		$parent.find('.f1-collapsible-header').trigger('expand');
	}
});
