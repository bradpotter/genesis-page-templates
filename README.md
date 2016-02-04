# Genesis Page Templates

Genesis Page Templates is a plugin that adds additional unique page templates to the Genesis Framework.

## Description

Genesis Page Templates takes advantage of a [new filter](https://core.trac.wordpress.org/changeset/34995/) introduced in WordPress 4.4.0. The first page template included in the plugin is a custom loop page template which allows a user to conveniently modify the loop on a per page basis by selecting the "Custom Loop" page template in the page editor and then entering Custom Loop settings into a meta box.


## Custom Loop Settings

* Post Type (Enter post, page or custom post type) 

* Taxonomy (Enter taxonomy, example: category, post_tag, etc.)

* Taxonomy Term (Enter taxonomy term, example: featured, blog, etc. )

* Post Per Page (Enter number of posts to display)

* Order By (Enter author, title, name, type, date, rand, etc.)

* Order (Enter ASC or DESC)


## Requirements

* Genesis Framework 2.0.0 or later
* WordPress 4.4.0

## Installation

### Upload

1. Download the latest tagged archive (choose the "zip" option).
2. Go to the __Plugins -> Add New__ screen and click the __Upload__ tab.
3. Upload the zipped archive directly.
4. Go to the Plugins screen and click __Activate__.

### Manual

1. Download the latest tagged archive (choose the "zip" option).
2. Unzip the archive.
3. Copy the folder to your `/wp-content/plugins/` directory.
4. Go to the Plugins screen and click __Activate__.

Check out the Codex for more information about [installing plugins manually](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

### Git

Using git, browse to your `/wp-content/plugins/` directory and clone this repository:

`git clone git@github.com:bradpotter/genesis-page-templates.git`

Then go to your Plugins screen and click __Activate__.

## Usage

Activate the Genesis Page Templates plugin. Choose a page to edit. When in the "Edit Page" screen, select the "Custom Loop" template from Page Attributes drop down menu and click the Update button. A new meta box titled "Custom Loop Settings" will be added to the Edit Page screen below the content editor.  Enter the appropriate parameters in the Custom Loop Settings meta box to modify the custom loop and click the Update button. View page to see the results of your custom loop.

Note: Since this is the initial release of the plugin I discourage using it on a production website until it has been thoroughly tested.

## Future Development

Introduce additional page templates. Update post type, taxonomy and taxonomy terms to accept multiple parameters. Add additional settings options. Change some settings options to drop down menus.

## Credits

Thanks to to [Ryan Hellyer](https://twitter.com/ryanhellyer) for his [recent post](https://geek.hellyer.kiwi/2016/01/20/dynamic-page-templates-in-wordpress-4-4/) on how to use the theme_page_templates filter.
Thanks to [Rob Nue](https://twitter.com/rob_neu) who has helped to improve the plugin's code.
Thanks to [Tonya Mork](https://twitter.com/hellofromTonya) who is always willing to explain the code.
Thanks to [Gary Jones](http://gamajo.com) for his encouragement to make my very first plugin 3 years ago.

Copyright © 2016 [Brad Potter](http://bradpotter.com). All rights reserved.
