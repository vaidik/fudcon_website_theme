<?php
/**
 * @file
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $submitted: Themed submission information output from
 *   theme_node_submitted().
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $build_mode: Build mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $build_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * The following variable is deprecated and will be removed in Drupal 7:
 * - $picture: This variable has been renamed $user_picture in Drupal 7.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess()
 * @see zen_preprocess_node()
 * @see zen_process()
 */
?>

<?php
function get_month($month) {
	switch ($month) {
		case 1:
			$mon = 'Jan';
			break;
		case 2:
			$mon = 'Feb';
			break;
		case 3:
			$mon = 'Mar';
			break;
		case 4:
			$mon = 'Apr';
			break;
		case 5:
			$mon = 'May';
			break;
		case 6:
			$mon = 'Jun';
			break;
		case 7:
			$mon = 'Jul';
			break;
		case 8:
			$mon = 'Aug';
			break;
		case 9:
			$mon = 'Sep';
			break;
		case 10:
			$mon = 'Oct';
			break;
		case 11:
			$mon = 'Nov';
			break;
		case 12:
			$mon = 'Dec';
			break;
		
	}
	return $mon;
}
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">
  <?php print $user_picture; ?>

  <?php if (!$page && $title): ?>
    <h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title . ' ad'; ?></a></h2>
  <?php endif; ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <?php if ($display_submitted || $terms): ?>
    <div class="meta">
      <?php if ($display_submitted): ?>
        <span class="submitted">
          <?php print $submitted; ?>
        </span>
      <?php endif; ?>

      <?php if ($terms): ?>
        <div class="terms terms-inline"><?php print $terms; ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="content">
		<?php $content = $node->content; ?>

		<?php
			$dates = $content['field_dates']['field']['#node']->field_dates;

			$date1 = explode('T', $dates[0]['value']);
			$date1[0] = explode('-', $date1[0]);
			if ($date1[1] != '00:00:00') {
				$date1[1] = explode(':', $date1[1]);
			} else {
				$date1[1] = NULL;
			}

			$date2 = explode('T', $dates[0]['value2']);
			$date2[0] = explode('-', $date2[0]);
			if ($date2[1] != '00:00:00') {
				$date2[1] = explode(':', $date2[1]);
			} else {
				$date2[1] = NULL;
			}

			//var_dump($date1); var_dump($date2);
		?>

		<!--<div style="float: right; width: 200px; border: 1px solid red; margin-left: 10px; text-align: center;">-->
		<div style="float: right;cursor: default; background: #1A2846; font-weight: bold; width: auto; padding: 0px; color: white; font-size: 13px; text-transform: uppercase; text-align:center; -moz-box-shadow: 0 1px 3px #272727; -webkit-box-shadow: 0 1px 3px #272727; box-shadow: 0 1px 3px #272727; margin-left: 8px; text-shadow: black 0 1px 1px;">
			<div style="font-size: 22px; padding-bottom: 0px; background: #294172; margin: 0px;">Date</div>
			<div style="line-height: 14px; padding: 8px;">
				<div style="display: inline-block; width: 50px; border: 0px red solid;">
					<div><?php echo get_month($date1[0][1]); ?></div>
					<div style="font-size: 28px; font-weight: normal; margin-top: 6px; margin-bottom: 5px;"><?php echo $date1[0][2]; ?></div>
					<div><?php echo $date1[0][0]; ?></div>
					<?php if ($date1[1]): ?>
						<div style="border-top: 1px dotted #e2e2e2; padding-top: 3px; margin-top: 4px;"><?php echo $date1[1][0] . ':' . $date1[1][1] . ':' .$date1[1][2]; ?></div>
					<?php endif; ?>
				</div>
				<div style="display: inline-block; width: 30px; margin-left: 10px; margin-right: 10px; border: 0px red solid; height: 50%; position: relative; top: -30px;">TO</div>
				<div style="display: inline-block; width: 50px; border: 0px red solid;">
					<div><?php echo get_month($date2[0][1]); ?></div>
					<div style="font-size: 28px; font-weight: normal; margin-top: 6px; margin-bottom: 5px;"><?php echo $date2[0][2]; ?></div>
					<div><?php echo $date2[0][0]; ?></div>
					<?php if ($date2[1]): ?>
						<div style="border-top: 1px dotted #e2e2e2; padding-top: 3px; margin-top: 4px;"><?php echo $date2[1][0] . ':' . $date2[1][1] . ':' .$date2[1][2]; ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="event-body">
			<?php echo $content['body']['#value']; ?>
		</div>
		<div class="event-signup">
			<?php echo $content['signup']['#value']; ?>
		</div>


		<?php //var_dump($content['field_dates']['field']['#node']->field_dates); ?>

  </div>

  <?php print $links; ?>
</div><!-- /.node -->
