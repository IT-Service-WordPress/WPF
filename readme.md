=== Plugin Name ===
Contributors: sergey.s.betke@yandex.ru
Donate link:
Tags: cache, cache-control
Requires at least: 3.9.0
Tested up to: 3.9.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

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

This section describes how to install the plugin and get it working.

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'plugin-name'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard


= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `plugin-name.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard


= Using FTP =

1. Download `plugin-name.zip`
2. Extract the `plugin-name` directory to your computer
3. Upload the `plugin-name` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard

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
