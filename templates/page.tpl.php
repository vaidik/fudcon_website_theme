<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
	<script type="text/javascript"> 
		$(document).ready(function() {
  	  $("#superfish ul.menu").superfish();
	  });
	</script>
	
</head>

<?php
	$theme_path = path_to_theme();
?>

<body class="<?php print $classes; ?>">
	<div class="container">
		<div class="header_bar">
			<div class="header">
				<div class="logo_top">
					<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php echo $theme_path . '/images/fudcon/logo-pune-long.png'; ?>" height="82" /></a>
				</div>
				<div class="main_menu">
					<?php if ($primary_links): ?>
						<?php $menu = fudcon_filter_menu_tree('primary-links'); ?>
						<ul class="sf-menu">
							<?php foreach($menu as $link): ?>
								<li>
									<a href="<?php echo $link['href']; ?>"><?php echo $link['title']; ?></a>
									<?php if ($link['below']): ?>
										<ul>
											<?php foreach($link['below'] as $blink): ?>
												<li><a href="<?php echo $blink['href']; ?>"><?php echo $blink['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
	      	<?php endif; ?>
				</div>
			</div>
		</div>

		<?php if ($splash_left || $splash_right): ?>
		<div class="splash_container">
			<div class="splash_content">
				<div class="splash_text<?php if (!$splash_right) { echo " splash_text_complete"; } ?>">
					<?php echo $splash_left; ?>
				</div>
				<div class="splash_img_mil">
					<?php echo $splash_right; ?>
					<!--<img src="<?php echo $theme_path . '/images/fudcon/FudconPune.png'; ?>" />-->
				</div>
			</div>
		</div>
		<?php endif; ?>

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

				<?php if ($footer_message): ?>
	  	    <div id="footer-message"><?php print $footer_message; ?></div>
      	<?php endif; ?>
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

	</div>

	<?php print $page_closure; ?>

  <?php print $closure; ?>
</body>
</html>
