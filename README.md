# SVGenericons

SVGenericons is a fork of Genericons using inline SVG for future-friendliness. Eventually my plan is to overhaul the icons themselves, but for now, this allows us to easily use Genericons in an SVG format, which will ideally make it easier to revamp the iconset.

## Usage

SVG is a bit of a strange beast, so I've built a micro-plugin to make usage in your themes super-simple. It relies on Jetpack, so you'll need to use that in order to make use of this. (Instructions for manual usage coming!)

First, you'll need to add the plugin to Jetpack. Do this by downloading the `svgenericons` folder here directly into your 	`jetpack/modules/theme-tools` directory.

You'll need to hook it up to Jetpack by adding the following to the `$tools` array in your `jetpack/modules/modules-extra.php` file:

```
'theme-tools/svgenericons/svgenericons.php',
```

Then, you'll want to declare support for SVGenericons in your theme:

```
// Add theme support for SVGenericons
add_theme_support( 'jetpack-svgenericons' );
```

Okay, now you're cooking with gas! To add an icon, use the following shortcut:

`<?php jetpack_svgenericon( '<icon-name>' ); ?>`

where `<icon-name>` is the filename of the original source icon, minus the `svg` suffix.

To add a paintbrush, for instance:

`<?php jetpack_svgenericon( '<icon-name>' ); ?>`

That's all! Icons can then be styled via CSS. For example, to style the paintbrush above:

```
.svgenericons-paintbrush {
	background: white;
	border-radius: 50%;
	fill: pink;
}
```

## Building your own SVGenericons

In the `source` directory, you'll find all Genericons source icons in SVG format. This allows you to easily add and edit your own symbols. Perhaps you need more logos than are available in the base Genericons package? Just add those logos and bake your own expanded set. Maybe you need just a few of the icons Genericons provides, but would like to trim the fat? Remove the ones you won't need!

Fork the repo, run `npm install` to install dependencies, change SVGs to your liking, run the default `grunt` task in your command line, and update your `svgenericons` folder within Jetpack. Ta-da! New icons for you!

## Notes

**Pixel grid**

Genericons has been designed for a 16x16px grid. That means it'll look sharp at font-size: 16px exactly. It'll also be crisp at multiples thereof, such as 32px or 64px. It'll look reasonably crisp at in-between font sizes such as 24px or 48px, but not quite as crisp as 16 or 32. Please don't set the font-size to 17px, though, that'll just look terribly blurry.

**Updates**

Genericons is largely unmaintained. The hope is that, with a newer icon set, we might be able to start updating and maintaining the icon set. This is a future task though.
