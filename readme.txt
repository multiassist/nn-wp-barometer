=== Nakamoto Notes Bitcoin Barometer ===
Contributors: nakamotonotes
Tags: bitcoin, crypto, indicator, widget, shortcode
Requires at least: 6.7
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Show the Bitcoin Barometer, a 0 to 100 Bitcoin market reading, on your site with a shortcode or a block.

== Description ==

The Bitcoin Barometer combines on-chain and market indicators into one score from 0 to 100 and names the zone the score sits in. This plugin shows that reading on your page with a shortcode or a block.

The widget is read-only. It has no trading features, no wallet and no ads. Educational information only, not financial advice.

Shortcode:

`[nn_barometer style="full" height="470"]`

* `style`: `full` or `compact`. Default `full`.
* `height`: frame height in pixels. Default 470 for full, 185 for compact.

Block: search for "Bitcoin Barometer" in the block inserter.

Settings (Settings, Bitcoin Barometer): an optional "Powered by NakamotoNotes" link below the widget. It is off by default.

== External services ==

The widget is an iframe. The visitor's browser loads it from https://nakamotonotes.com/embed/barometer, which is run by NakamotoNotes. The plugin itself makes no request to that site.

When a page with the widget is viewed, nakamotonotes.com receives the visitor's IP address and the standard browser request headers, as with any embedded frame. Privacy policy: https://nakamotonotes.com/privacy.html

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`, or install it from the Plugins screen.
2. Activate it.
3. Add the `[nn_barometer]` shortcode or the Bitcoin Barometer block to a page.

== Frequently Asked Questions ==

= Does the plugin track visitors? =

No. The plugin sets no cookies and loads no script. The only network contact is the iframe described under External services.

= What if the Barometer is unavailable? =

The frame shows its own "temporarily unavailable" message and shows no number. Visitors without scripts see a link to the Barometer page.

== Changelog ==

= 1.0.0 =
* First release.
