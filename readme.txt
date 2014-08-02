=== Plugin Name ===
Contributors: sergey.s.betke@yandex.ru
Donate link:
Tags: cache, cache-control
Requires at least: 3.9.0
Tested up to: 3.9.1
Stable tag: trunk

Automatically send HTTP 1.1 headers "Cache-control", "Pragma" and "Expires".

== Description ==

Automatically send HTTP 1.1 headers "Cache-control", "Pragma" and "Expires".
You can set cache TTL in options page.

Check plugin options on options page.

For more information, please visit the [Sergey S. Betke blog](http://sergey-s-betke.blogs.csm.nov.ru/category/web/wordpress/).

== Upgrade Notice ==

= 0.1.0 =
* Initial Release

== Installation ==

Simple:

1. Upload the `cache-control-headers` directory ("unzipped") to the `/wp-content/plugins/` directory
2. Find "Cache-Control headers in the 'Plugins' menu in WordPress and click "Activate"

== Frequently Asked Questions ==

= Requirements? =

Just read "installation" section.

== Screenshots ==

1. HTTP response headers in browser.

== ToDo ==
The next version or later:
* optional http cache-control **max-age** header value and **must-revalidate**
* just private cache headers, when post has limited access
* cache-control and Last-Modification headers - to separate plugins
* **if-modified** http request support (separate plugins)
