# Table of Contents WordPress Plugin

This WordPress plugin adds a shortcode called `[collapsible]` which wraps content within a container to be toggled opened and closed. 

## Usage

Wrap your text with opening and closing `[collapsible]` shortcode tags. Be sure to add a heading which will be used to toggle the content opened and closed. If there are multiple headings, the first heading is the one that will be used as the toggle control.

```
Some intro text blah blah blah.

[collapsible]
<h2>Heading</h2>

This is text that will be initially hidden until the Heading is clicked when it will be expanded.

<h2>Second Heading</h2>
The second heading will also be hidden because only the first heading will be used as the toggle to open/close the collapsible content.
[/collapsible]
```

### Extending

#### CSS

There are no default styles set by this plugin. Styling is up to you.

Reccomended styling:

```
.f1-collapsible {
	padding:1em 0 0.2em;
	margin-bottom:1.3em;
	border-top:0.1em solid #e2e2e2;
	clear:both;
}
.f1-collapsible-icon {
	display:none;
	margin-right:0.3em;
	margin-left:0.1em;
}
.f1-collapsible .f1-collapsible-header {
	cursor: pointer;
	padding-top:0;

	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.f1-collapsible-collapsed .f1-collapsible-header {
	margin-bottom:0;
}
.f1-collapsible-header .f1-collapsible-icon {
	-webkit-transform: rotate(90deg);
	-moz-transform: rotate(90deg);
	-ms-transform: rotate(90deg);
	-o-transform: rotate(90deg);
	filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
	display:inline-block;
}
.f1-collapsible-collapsed .f1-collapsible-header .f1-collapsible-icon {
	display:inline;
}
.f1-collapsible-header:focus {
	outline:none;
}
.f1-collapsible-collapsed .f1-collapsible-content {
	display:none;
}
```

#### Filter Hooks

`f1_collapsible_icon` allows you to change the icon inserted before the first heading's text to indicated open/close states. By default the collapisble icon is `»`

### Examples