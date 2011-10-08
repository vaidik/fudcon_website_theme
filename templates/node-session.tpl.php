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
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">
  <?php print $user_picture; ?>

  <?php if (!$page && $title): ?>
    <h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
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
		<?php
			$content = $node->content;
		?>

		<?php
			if (isset($node->content['field_speakers']['field']['items']['#node']->field_session_slot[0]['safe']['title'])) {
				$slot = $node->content['field_speakers']['field']['items']['#node']->field_session_slot[0]['safe']['title'];
				$slot = explode(' ', $slot);
				if (strlen($slot[0]) == 1) {
					$slot[0] = "0" . $slot[0];
				}
			}
		?>

		<div style="border: 0px solid red; width: auto; float: right;">
      <div style="float: right;cursor: default; background: #1A2846; font-weight: bold; width: auto; padding: 0px; color: white; font-size: 13px; text-transform: uppercase; text-align:center; -moz-box-shadow: 0 1px 3px #272727; -webkit-box-shadow: 0 1px 3px #272727; box-shadow: 0 1px 3px #272727; margin-left: 8px; text-shadow: black 0 1px 1px;">
        <div style="font-size: 22px; padding-bottom: 0px; padding-left: 6px; padding-right: 6px; background: #294172; margin: 0px;">Schedule</div>
        <div style="line-height: 14px; padding: 8px;">
          <div style="display: inline-block; width: 50px; border: 0px red solid;">
            <div><?php echo substr($slot[1], 0, 3); ?></div>
            <div style="font-size: 28px; font-weight: normal; margin-top: 6px; margin-bottom: 5px;"><?php echo $slot[0]; ?></div>
            <div>2011</div>
          </div>

          <div style="display: inline-block; width: 50px; border: 0px red solid;">
            <div><?php echo $slot[2]; ?></div>
            <div style="font-size: 28px; font-weight: normal; margin-top: 6px; margin-bottom: 5px;">To</div>
            <div><?php echo $slot[4]; ?></div>
          </div>
        </div>

        <?php
          if (isset($node->content['field_speakers']['field']['items']['#node']->field_session_room[0]['safe']['title'])) {
            $rooms = $node->content['field_speakers']['field']['items']['#node']->field_session_room;
        ?>
          <div style="font-size: 22px; padding-bottom: 0px; padding-left: 6px; padding-right: 6px; background: #294172; margin: 0px;">Rooms</div>
        <?php
          foreach($rooms as $room) {
        ?>
            <div style=""><strong><?php echo $room['safe']['title']; ?></strong></div>
        <?php
            }
          }
        ?>
        </div>
      </div>

		<h3>Presented by:</h3>
		<?php
			$speakers = $content['field_speakers']['field']['#children'];

			$speakers = explode(', ', $speakers);
		?>
		<?php foreach($speakers as $speaker): ?>
			<div><?php echo $speaker; ?></div>
		<?php endforeach; ?>

	</div>
		
		<p><?php echo $content['body']['#value']; ?></p>

		<?php $slides = $node->content['field_speakers']['field']['items']['#node']->field_slides; ?>
		<h3>Slides</h3>

		<?php $slide_flag = 0; ?>
		<?php foreach($slides as $slide): ?>
			<?php if(isset($slide['list']) && $slide['list'] != '0'): ?>
				<div><a href="<?php echo $slide['filepath']; ?>"><?php echo $slide['filename']; ?></a></div>
				<?php $slide_flag = 1; ?>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php if($slide_flag == 0): ?>
			<div><strong><em>No slides provided.</em></strong></div>
		<?php endif; ?>

  </div>

  <?php print $links; ?>
</div><!-- /.node -->
