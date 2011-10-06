<?php
/**
 * @file
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It should be placed within the <body> tag. When selecting through CSS
 *   it's recommended that you use the body tag, e.g., "body.front". It can be
 *   manipulated through the variable $classes_array from preprocess functions.
 *   The default values can be one or more of the following:
 *   - front: Page is the home page.
 *   - not-front: Page is not the home page.
 *   - logged-in: The current viewer is logged in.
 *   - not-logged-in: The current viewer is not logged in.
 *   - node-type-[node type]: When viewing a single node, the type of that node.
 *     For example, if the node is a "Blog entry" it would result in "node-type-blog".
 *     Note that the machine name will often be in a short form of the human readable label.
 *   - page-views: Page content is generated from Views. Note: a Views block
 *     will not cause this class to appear.
 *   - page-panels: Page content is generated from Panels. Note: a Panels block
 *     will not cause this class to appear.
 *   The following only apply with the default 'sidebar_first' and 'sidebar_second' block regions:
 *     - two-sidebars: When both sidebars have content.
 *     - no-sidebars: When no sidebar content exists.
 *     - one-sidebar and sidebar-first or sidebar-second: A combination of the
 *       two classes when only one of the two sidebars have content.
 * - $node: Full node object. Contains data that may not be safe. This is only
 *   available if the current page is on the node's primary url.
 * - $menu_item: (array) A page's menu item. This is only available if the
 *   current page is in the menu.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing the Primary menu links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title: The page title, for use in the actual HTML content.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the
 *   view and edit tabs when displaying a node).
 * - $help: Dynamic help text, mostly for admin pages.
 * - $content: The main content of the current page.
 * - $feed_icons: A string of all feed icons for the current page.
 *
 * Footer/closing data:
 * - $footer_message: The footer message as defined in the admin settings.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * Regions:
 * - $content_top: Items to appear above the main content of the current page.
 * - $content_bottom: Items to appear below the main content of the current page.
 * - $navigation: Items for the navigation bar.
 * - $sidebar_first: Items for the first sidebar.
 * - $sidebar_second: Items for the second sidebar.
 * - $header: Items for the header region.
 * - $footer: Items for the footer region.
 * - $page_closure: Items to appear below the footer.
 *
 * The following variables are deprecated and will be removed in Drupal 7:
 * - $body_classes: This variable has been renamed $classes in Drupal 7.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess()
 * @see zen_process()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
	<script type="text/javascript"> 
    $(document).ready(function() {
      $("#superfish-menu ul.menu").superfish();
    });
  </script>
</head>

<?php global $theme_path;  ?>

<body class="<?php print $classes; ?>">
	<div class="top_bar_container">
		<div id="top_bar">
			<div class="user_menu">
				<?php global $user; ?>
				<div style="display: inline-block; padding-top: 2px;">
				<?php
					if ($user->uid == 0) {
						echo '<strong>' . l(t('Login'), 'user') . ' &nbsp;&nbsp;&nbsp;&nbsp; ' . l(t('Register'), 'user/register') . '</strong>';
					} else {
						echo t('Welcome ') . '<strong>' . l($user->name, 'user') . '</strong>! &nbsp;&nbsp;&nbsp;&nbsp; ' . l(t('Logout'), 'logout');
					}
				?>
				</div>
        <?php echo $search_box; ?>
			</div>
		</div>
	</div>

  <div id="container">
		<div class="header_bar">
      <div class="header">
        <div class="logo_top">
          <!--<a href="<?php print $front_page; ?>" title="FUDCon Pune 2011" rel="home" id="logo"><img src="<?php echo $base_url . 'sites/all/themes/fudcon/images/fudcon/logo-pune-long.png'; ?>" height="82" /></a>-->
					<?php global $base_url; ?>
          <a href="<?php print $front_page; ?>" title="FUDCon Pune 2011" rel="home" id="logo"><img src="<?php echo $base_url . '/sites/all/themes/fudcon/images/fudcon/logo-pune-long.png'; ?>" height="82" /></a>
        </div>
        <div class="main_menu">

          <?php if ($primary_links): ?>
            <?php $menu = fudcon_filter_menu_tree('primary-links'); ?>
						<div id="superfish-menu">
      	      <ul class="sf-menu">
    	          <?php foreach($menu as $link): ?>
  	              <li>
										<?php
											echo l($link['title'], $link['href']);
										?>
                  	<?php if ($link['below']): ?>
                	    <ul>
              	        <?php foreach($link['below'] as $blink): ?>
            	            <li><?php echo l($blink['title'], $blink['href']); ?></li>
          	            <?php endforeach; ?>
        	            </ul>
      	            <?php endif; ?>
    	            </li>
  	            <?php endforeach; ?>
	            </ul>
						</div>
          <?php endif; ?>
        </div>
      </div>
    </div>

		<?php if ($splash_left || $splash_right): ?>
    <div class="splash_container">
      <div id="splash_content">
        <div id="splash_text"<?php if (!$splash_right) { echo " style=\"width: 100%;\""; } ?>>
          <?php echo $splash_left; ?>
        </div>
        <div class="splash_img_mil"<?php if (!$splash_left) { echo " style=\"width: 100%;\""; } ?>>
          <?php echo $splash_right; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

		<div style="clear: both;"></div>
		<div style="border-top: 1px solid #ccc; height: 35px;"></div>

    <div class="central_container">

      <div class="central_content">
        <?php if ($title): ?>
          <h1 class="title"><?php print $title; ?></h1>
        <?php endif; ?>

        <?php if ($messages): ?>
          <div class="messages"><?php echo $messages; ?></div>
        <?php endif; ?>

        <div class="content_container">
          <?php if ($tabs): ?>
            <div class="tabs"><?php print $tabs; ?></div>
            <div style="clear: both;"></div>
          <?php endif; ?>

          <div><?php print $content_top; ?></div>

          <div id="content-area">
            <?php print $content; ?>
          </div>

          <?php print $content_bottom; ?>
        </div>

        <?php if ($sidebar_first): ?>
          <div class="sidebar_first">
            <?php echo $sidebar_first; ?>
          </div>
        <?php endif; ?>

        <div style="clear: both;"></div>

      </div>

    </div>

    <div class="footer_container">
      <div class="footer_content">
        <?php if ($footer_first || $footer_second || $footer_third || $footer_fourth): ?>
        <div class="footer_columns">
          <div class="footer_contact_item">
            <?php echo $footer_first; ?>
          </div>
          <div class="footer_contact_item">
            <?php echo $footer_second; ?>
          </div>
          <div class="footer_contact_item">
            <?php echo $footer_third; ?>
          </div>
          <div class="footer_contact_item" style="margin-right: 0;">
            <?php echo $footer_fourth; ?>
					</div>
          <div style="clear: both; border-bottom: thin solid #011847; padding-top: 15px; margin-bottom: 16px;"></div>
        </div>
        <?php endif; ?>

        <?php if ($footer): ?>
          <div class="footer">
            <?php echo $footer; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>

  </div><!-- /#page, /#page-wrapper -->

  <?php print $page_closure; ?>

  <?php print $closure; ?>

</body>
</html>
