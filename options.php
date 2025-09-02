<?php

/**
<<<<<<< HEAD
 * General Options Page
 *
 * Screen for specifying general options for the plugin
 *
 * @package	footnotes-made-easy
 * @since	1.0
 */
=======
* General Options Page
*
* Screen for specifying general options for the plugin
*
* @package	footnotes-made-easy
* @since	1.0
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Process form submission with proper input sanitization
if (!empty($_POST['save_options']) && check_admin_referer('footnotes-nonce', 'footnotes_nonce')) {
    
    // Initialize sanitized options array
    $sanitized_options = array();
    
    // Sanitize text field inputs
    $text_fields = array(
        'pre_identifier',
        'inner_pre_identifier', 
        'inner_post_identifier',
        'post_identifier',
        'list_style_symbol',
        'pre_backlink',
        'backlink',
        'post_backlink',
        'footnotes_open',
        'footnotes_close'
    );
    
    foreach ($text_fields as $field) {
        if (isset($_POST[$field])) {
            $sanitized_options[$field] = sanitize_text_field($_POST[$field]);
        }
    }
    
    // Sanitize textarea content (allows some HTML but strips dangerous content)
    $textarea_fields = array('pre_footnotes', 'post_footnotes');
    foreach ($textarea_fields as $field) {
        if (isset($_POST[$field])) {
            // Use wp_kses_post to allow safe HTML tags in footnote headers/footers
            $sanitized_options[$field] = wp_kses_post($_POST[$field]);
        }
    }
    
    // Sanitize dropdown selection (validate against allowed values)
    if (isset($_POST['list_style_type'])) {
        $allowed_styles = array_keys($this->styles); // Assuming $this->styles contains valid options
        $submitted_style = sanitize_text_field($_POST['list_style_type']);
        if (in_array($submitted_style, $allowed_styles, true)) {
            $sanitized_options['list_style_type'] = $submitted_style;
        } else {
            // Fallback to default if invalid value submitted
            $sanitized_options['list_style_type'] = 'decimal';
        }
    }
    
    // Sanitize numeric priority field
    if (isset($_POST['priority'])) {
        $priority = absint($_POST['priority']);
        // Ensure priority is within reasonable range (1-999)
        if ($priority >= 1 && $priority <= 999) {
            $sanitized_options['priority'] = $priority;
        } else {
            $sanitized_options['priority'] = 11; // Default value
        }
    }
    
    // Sanitize boolean checkboxes
    $boolean_fields = array(
        'superscript',
        'pretty_tooltips',
        'combine_identical_notes',
        'no_display_home',
        'no_display_preview',
        'no_display_search',
        'no_display_feed',
        'no_display_archive',
        'no_display_category',
        'no_display_date'
    );
    
    foreach ($boolean_fields as $field) {
        // Checkbox values: if present = true, if not present = false
        $sanitized_options[$field] = isset($_POST[$field]) ? true : false;
    }
    
    // Update options in database (this would typically call update_option())
    // Assuming this updates $this->current_options
    $this->current_options = array_merge($this->current_options, $sanitized_options);
    
    // Save to database
    update_option('footnotes_made_easy_options', $this->current_options);
    
    $message = __('Settings saved successfully.', 'footnotes-made-easy');
} else {
    $message = '';
}
>>>>>>> 04eb4f9e6857c2377a32b8ab356a1d429b24b988
?>

<div class="wrap">

<<<<<<< HEAD
    <h1><?php _e('Footnotes Made Easy', 'footnotes-made-easy'); ?></h1>

    <div class="db-ad">
        <h3><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 68 68">
                <defs />
                <rect width="100%" height="100%" fill="none" />
                <g class="currentLayer">
                    <path fill="#313457"
                        d="M34.76 33C22.85 21.1 20.1 13.33 28.23 5.2 36.37-2.95 46.74.01 50.53 3.8c3.8 3.8 5.14 17.94-5.04 28.12-2.95 2.95-5.97 5.84-5.97 5.84L34.76 33" />
                    <path fill="#313457"
                        d="M43.98 42.21c5.54 5.55 14.59 11.06 20.35 5.3 5.76-5.77 3.67-13.1.98-15.79-2.68-2.68-10.87-5.25-18.07 1.96-2.95 2.95-5.96 5.84-5.96 5.84l2.7 2.7m-1.76 1.75c5.55 5.54 11.06 14.59 5.3 20.35-5.77 5.76-13.1 3.67-15.79.98-2.69-2.68-5.25-10.87 1.95-18.07 2.85-2.84 5.84-5.96 5.84-5.96l2.7 2.7" />
                    <path fill="#313457"
                        d="M33 34.75c-11.9-11.9-19.67-14.67-27.8-6.52-8.15 8.14-5.2 18.5-1.4 22.3 3.8 3.79 17.95 5.13 28.13-5.05 3.1-3.11 5.84-5.97 5.84-5.97L33 34.75" />
                </g>
            </svg> Thank you for using Footnotes Made Easy!</h3>
        <p>If you enjoy this plugin, do not forget to <a
                href="https://wordpress.org/support/plugin/footnotes-made-easy/reviews/?filter=5" rel="external">rate
                it</a>! We work hard to update it, fix bugs, add new features and make it compatible with the latest web
            technologies.</p>
        <p></p>
        <p style="font-size:14px">
            <b>Featured Plugins:</b>&#32;
            🔥 <a href="https://wordpress.org/plugins/quick-event-calendar/" target="_blank"
                rel="external noopener">Quick Event Calendar</a> and&#32;
            🚀 <a href="https://wordpress.org/plugins/search-engines-blocked-in-header/" target="_blank"
                rel="external noopener">Search Engines Blocked in Header</a>.&#32;
        </p>
        <p>To learn how to use this plugin, please refer to <a
                href="https://divibanks.io/wordpress-plugins/footnotes-made-easy/" rel="external">the documentation</a>.
        </p>
        <p>If you find this plugin helpful and enjoy using it, consider <a href="https://divibanks.io/sponsor/"
                rel="external">supporting our work with a donation</a>.</p>
        <p style="font-size:14px">
            For WordPress and Divi related content, check out <a href="https://divibanks.io/blog/">Divi Banks' Blog</a>.
        </p>
    </div>

    <?php
	if (!empty($_POST['save_options']) && (check_admin_referer('footnotes-nonce', 'footnotes_nonce'))) {
		$message = __('Options saved.', 'footnotes-made-easy');
	} else {
		$message = '';
	}
	?>
    <?php if ($message !== '') { ?>
    <div class="updated">
        <p><strong><?php echo $message; ?></strong></p>
    </div>
    <?php } ?>

    <form method="post">

        <table class="form-table">

            <tr>
                <th scope="row"><label
                        for="pre_identifier"><?php echo __(ucwords('identifier'), 'footnotes-made-easy'); ?></label>
                </th>
                <td>
                    <input type="text" size="3" name="pre_identifier"
                        value="<?php echo esc_attr($this->current_options['pre_identifier']); ?>" />
                    <input type="text" size="3" name="inner_pre_identifier"
                        value="<?php echo esc_attr($this->current_options['inner_pre_identifier']); ?>" />
                    <select name="list_style_type">
                        <?php foreach ($this->styles as $key => $val): ?>
                        <option value="<?php echo $key; ?>"
                            <?php if ($this->current_options['list_style_type'] === $key) echo 'selected="selected"'; ?>>
                            <?php echo esc_attr($val); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" size="3" name="inner_post_identifier"
                        value="<?php echo esc_attr($this->current_options['inner_post_identifier']); ?>" />
                    <input type="text" size="3" name="post_identifier"
                        value="<?php echo esc_attr($this->current_options['post_identifier']); ?>" />
                    <p class="description">
                        <?php _e('This defines how the link to the footnote will be displayed. The outer text will not be linked to.', 'footnotes-made-easy'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label
                        for="list_style_symbol"><?php echo __(ucwords('symbol'), 'footnotes-made-easy'); ?></label></th>
                <td><input type="text" size="8" name="list_style_symbol"
                        value="<?php echo $this->current_options['list_style_symbol']; ?>" /><?php _e('If you have chosen a symbol as your list style.', 'footnotes-made-easy'); ?>
                    <p class="description">
                        <?php _e('It\'s not usually a good idea to choose this type unless you never have more than a couple of footnotes per post', 'footnotes-made-easy'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label
                        for="superscript"><?php echo __(ucwords('superscript'), 'footnotes-made-easy'); ?></label></th>
                <td><input type="checkbox" name="superscript"
                        <?php checked($this->current_options['superscript'], true); ?> /><?php _e('Show identifier as superscript', 'footnotes-made-easy'); ?>
                </td>
            </tr>

            <tr>
                <th scope="row"><label
                        for="pre_backlink"><?php echo __(ucwords('back-link'), 'footnotes-made-easy'); ?></label></th>
                <td>
                    <input type="text" size="3" name="pre_backlink"
                        value="<?php echo esc_attr($this->current_options['pre_backlink']); ?>" />
                    <input type="text" size="10" name="backlink"
                        value="<?php echo $this->current_options['backlink']; ?>" />
                    <input type="text" size="3" name="post_backlink"
                        value="<?php echo esc_attr($this->current_options['post_backlink']); ?>" />
                    <p class="description">
                        <?php _e(sprintf('These affect how the back-links after each footnote look. A good back-link character is %s. If you want to remove the back-links all together, you can effectively do so by making all these settings blank.', '&amp;#8617; (↩)'), 'footnotes-made-easy'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label
                        for="pre_footnotes"><?php echo __(ucwords('Footnotes header'), 'footnotes-made-easy'); ?></label>
                </th>
                <td><textarea name="pre_footnotes" rows="3" cols="60"
                        class="large-text code"><?php echo $this->current_options['pre_footnotes']; ?></textarea>
                    <p class="description">
                        <?php _e('Anything to be displayed before the footnotes at the bottom of the post can go here.', 'footnotes-made-easy'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><label
                        for="post_footnotes"><?php echo __(ucwords('Footnotes footer'), 'footnotes-made-easy'); ?></label>
                </th>
                <td><textarea name="post_footnotes" rows="3" cols="60"
                        class="large-text code"><?php echo $this->current_options['post_footnotes']; ?></textarea>
                    <p class="description">
                        <?php _e('Anything to be displayed after the footnotes at the bottom of the post can go here.', 'footnotes-made-easy'); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo __(ucwords('pretty tooltips'), 'footnotes-made-easy'); ?></th>
                <td><label for="pretty_tooltips"><input type="checkbox" name="pretty_tooltips" id="pretty_tooltips"
                            <?php checked($this->current_options['pretty_tooltips'], true); ?> />
                        <?php _e('Uses jQuery UI to show pretty tooltips', 'footnotes-made-easy'); ?></label></td>
            </tr>

            <tr>
                <th scope="row"><?php echo __('Shortcode Behavior', 'footnotes-made-easy'); ?></th>
                <td><label for="suppress_when_shortcode"><input type="checkbox" name="suppress_when_shortcode"
                            id="suppress_when_shortcode"
                            <?php checked($this->current_options['suppress_when_shortcode'], true); ?> />
                        <?php _e('Suppress automatic footnotes when [footnotes] shortcode is used', 'footnotes-made-easy'); ?></label>
                    <p class="description">
                        <?php _e('When enabled, footnotes will not appear at the bottom of posts that contain the [footnotes] shortcode. This prevents duplicate footnotes from appearing.', 'footnotes-made-easy'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php echo __(ucwords('combine notes'), 'footnotes-made-easy'); ?></th>

            <tr>
                <th scope="row"><?php echo __(ucwords('combine notes'), 'footnotes-made-easy'); ?></th>
                <td><label for="combine_identical_notes"><input type="checkbox" name="combine_identical_notes"
                            id="combine_identical_notes"
                            <?php checked($this->current_options['combine_identical_notes'], true); ?> />
                        <?php _e('Combine identical footnotes', 'footnotes-made-easy'); ?></label></td>
            </tr>

            <tr>
                <th scope="row"><label
                        for="priority"><?php echo __(ucwords('priority'), 'footnotes-made-easy'); ?></label></th>
                <td><input type="text" size="3" name="priority" id="priority"
                        value="<?php echo esc_attr($this->current_options['priority']); ?>" />
                    <?php _e('The default is 11', 'footnotes-made-easy'); ?><p class="description">
                        <?php _e('This setting controls the order in which this plugin executes in relation to others. Modifying this setting may therefore affect the behavior of other plugins.', 'footnotes-made-easy'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php echo __(ucwords('suppress Footnotes'), 'footnotes-made-easy'); ?></th>
                <td>
                    <label for="no_display_home"><input type="checkbox" name="no_display_home" id="no_display_home"
                            <?php checked($this->current_options['no_display_home'], true); ?> />&nbsp;<?php echo __(ucwords('on the home page'), 'footnotes-made-easy'); ?></label></br>
                    <label for="no_display_preview"><input type="checkbox" name="no_display_preview"
                            id="no_display_preview"
                            <?php checked($this->current_options['no_display_preview'], true); ?> />&nbsp;<?php echo __(ucwords('when displaying a preview'), 'footnotes-made-easy'); ?></label></br>
                    <label for="no_display_search"><input type="checkbox" name="no_display_search"
                            id="no_display_search"
                            <?php checked($this->current_options['no_display_search'], true); ?> />&nbsp;<?php echo __(ucwords('in search results'), 'footnotes-made-easy'); ?></label></br>
                    <label for="no_display_feed"><input type="checkbox" name="no_display_feed" id="no_display_feed"
                            <?php checked($this->current_options['no_display_feed'], true); ?> />&nbsp;<?php _e('In the feed (RSS, Atom, etc.)', 'footnotes-made-easy'); ?></label></br>
                    <label for="no_display_archive"><input type="checkbox" name="no_display_archive"
                            id="no_display_archive"
                            <?php checked($this->current_options['no_display_archive'], true); ?> />&nbsp;<?php echo __(ucwords('in any kind of archive'), 'footnotes-made-easy'); ?></label></br>
                    <label for="no_display_category"><input type="checkbox" name="no_display_category"
                            id="no_display_category"
                            <?php checked($this->current_options['no_display_category'], true); ?> />&nbsp;<?php echo __(ucwords('in category archives'), 'footnotes-made-easy'); ?></label></br>
                    <label for="no_display_date"><input type="checkbox" name="no_display_date" id="no_display_date"
                            <?php checked($this->current_options['no_display_date'], true); ?> />&nbsp;<?php _e('in date-based archives', 'footnotes-made-easy'); ?></label></br>

                </td>
            </tr>

        </table>

        <p><?php _e('Changing the following settings will change functionality in a way which may stop footnotes from displaying correctly. For footnotes to work as expected after updating these settings, you will need to manually update all existing posts with footnotes.', 'footnotes-made-easy'); ?>
        </p>

        <table class="form-table">

            <tr>
                <th scope="row"><label
                        for="footnotes_open"><?php echo __(ucwords('begin a footnote'), 'footnotes-made-easy'); ?></label>
                </th>
                <td><input type="text" size="3" name="footnotes_open" id="footnotes_open"
                        value="<?php echo esc_attr($this->current_options['footnotes_open']); ?>" /></td>
            </tr>

            <tr>
                <th scope="row"><label
                        for="footnotes_close"><?php echo __(ucwords('end a Footnote'), 'footnotes-made-easy'); ?></label>
                </th>
                <td><input type="text" size="3" name="footnotes_close" id="footnotes_close"
                        value="<?php echo esc_attr($this->current_options['footnotes_close']); ?>" /></td>
            </tr>

        </table>

        <?php wp_nonce_field('footnotes-nonce', 'footnotes_nonce'); ?>

        <p class="submit"><input type="submit" name="save_options"
                value="<?php echo __(ucwords('save changes'), 'footnotes-made-easy'); ?>" class="button-primary" /></p>
        <input type="hidden" name="save_footnotes_made_easy_options" value="1" />

    </form>

    <div class="db-ad">
        <div class="inside">
            <p>For support, feature requests and bug reporting, please open an issue on <a
                    href="https://github.com/divibanks/footnotes-made-easy/issues/" rel="external">GitHub</a>.</p>
            <p>&copy;<?php echo gmdate('Y'); ?> <a href="https:divibanks.io" rel="external"><strong>Divi
                        Banks</strong></a> &middot; Building tools that make the lives of WordPress users easy.</p>
        </div>

    </div>
=======
<h1><?php esc_html_e( 'Footnotes Made Easy', 'footnotes-made-easy' ); ?></h1>

<?php if ( $message !== '' ) { ?>
<div class="updated"><p><strong><?php echo esc_html($message); ?></strong></p></div>
<?php } ?>

<div class="footnotes-layout">
	
	<!-- Left Column - Plugin Settings (70%) -->
	<div class="footnotes-left-column">
		
		<form method="post">
			
			<!-- Display Settings Section -->
			<div class="footnotes-settings-section">
				<h2><?php esc_html_e( 'Display Settings', 'footnotes-made-easy' ); ?></h2>
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
					<th scope="row"><label for="pre_identifier"><?php echo esc_html( ucwords( __( 'identifier', 'footnotes-made-easy' ) ) ); ?></label></th>

					<td>
					<input type="text" size="3" name="pre_identifier" value="<?php echo esc_attr(  $this->current_options[ 'pre_identifier' ] ); ?>" />
					<input type="text" size="3" name="inner_pre_identifier" value="<?php echo esc_attr(  $this->current_options[ 'inner_pre_identifier' ] ); ?>" />
					<select name="list_style_type">
						<?php foreach ( $this->styles as $key => $val ): ?>
						<option value="<?php echo esc_attr($key); ?>" <?php if ( $this->current_options[ 'list_style_type' ] === $key ) echo 'selected="selected"'; ?> ><?php echo esc_html( $val ); ?></option>
						<?php endforeach; ?>
					</select>
					<input type="text" size="3" name="inner_post_identifier" value="<?php echo esc_attr(  $this->current_options[ 'inner_post_identifier' ] ); ?>" />
					<input type="text" size="3" name="post_identifier" value="<?php echo esc_attr( $this->current_options[ 'post_identifier' ] ); ?>" />
					<p class="description"><?php esc_html_e( 'This defines how the link to the footnote will be displayed. The outer text will not be linked to.', 'footnotes-made-easy' ); ?></p></td>
					</tr>

					<tr>
					<th scope="row"><label for="list_style_symbol"><?php echo esc_html( ucwords( __( 'symbol', 'footnotes-made-easy' ) ) ); ?></label></th>
					<td><input type="text" size="8" name="list_style_symbol" value="<?php echo esc_attr($this->current_options[ 'list_style_symbol' ]); ?>" /><?php esc_html_e( 'If you have chosen a symbol as your list style.', 'footnotes-made-easy' ); ?>
					<p class="description"><?php esc_html_e( 'It\'s not usually a good idea to choose this type unless you never have more than a couple of footnotes per post', 'footnotes-made-easy' ); ?></p></td>
					</tr>

					<tr>
						<th scope="row"><label for="superscript"><?php echo esc_html( ucwords( __( 'superscript', 'footnotes-made-easy' ) ) ); ?></label></th>
						<td>
							<div class="toggle-switch">
								<input type="checkbox" name="superscript" id="superscript" <?php checked( $this->current_options[ 'superscript' ], true ); ?> />
								<label for="superscript" class="toggle-label">
									<span class="toggle-slider"></span>
								</label>
								<span class="toggle-text"><?php esc_html_e( 'Show identifier as superscript', 'footnotes-made-easy' ); ?></span>
							</div>
						</td>
					</tr>

					<tr>
					<th scope="row"><label for="pre_backlink"><?php echo esc_html( ucwords( __( 'back-link', 'footnotes-made-easy' ) ) ); ?></label></th>
					<td>
					<input type="text" size="3" name="pre_backlink" value="<?php echo esc_attr( $this->current_options[ 'pre_backlink' ] ); ?>" />
					<input type="text" size="10" name="backlink" value="<?php echo esc_attr($this->current_options[ 'backlink' ]); ?>" />
					<input type="text" size="3" name="post_backlink" value="<?php echo esc_attr( $this->current_options[ 'post_backlink' ] ); ?>" />

					<!--  translators: %s is the suggested back-link character (↩). -->
					<p class="description"><?php printf( esc_html__( 'These affect how the back-links after each footnote look. A good back-link character is %s. If you want to remove the back-links all together, you can effectively do so by making all these settings blank.', 'footnotes-made-easy' ), '&#8617; (↩)' ); ?></p></td>

					</tr>
				</table>
						</div>
			</div>

			<!-- Content Settings Section -->
			<div class="footnotes-settings-section">
				<h2><?php esc_html_e( 'Content Settings', 'footnotes-made-easy' ); ?></h2>
				
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
					<th scope="row"><label for="pre_footnotes"><?php echo esc_html( ucwords( __( 'Footnotes header', 'footnotes-made-easy' ) ) ); ?></label></th>
					<td><textarea name="pre_footnotes" rows="3" cols="60" class="large-text code"><?php echo esc_textarea($this->current_options[ 'pre_footnotes' ]); ?></textarea>
					<p class="description"><?php esc_html_e( 'Anything to be displayed before the footnotes at the bottom of the post can go here.', 'footnotes-made-easy' ); ?></p></td>
					</tr>

					<tr>
					<th scope="row"><label for="post_footnotes"><?php echo esc_html( ucwords( __( 'Footnotes footer', 'footnotes-made-easy' ) ) ); ?></label></th>
					<td><textarea name="post_footnotes" rows="3" cols="60" class="large-text code"><?php echo esc_textarea($this->current_options[ 'post_footnotes' ]); ?></textarea>
					<p class="description"><?php esc_html_e( 'Anything to be displayed after the footnotes at the bottom of the post can go here.', 'footnotes-made-easy' ); ?></p></td>
					</tr>
				</table>
						</div>
			</div>

			<!-- Behavior Settings Section -->
			<div class="footnotes-settings-section">
				<h2><?php esc_html_e( 'Behavior Settings', 'footnotes-made-easy' ); ?></h2>
				
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
						<th scope="row"><?php echo esc_html( ucwords( __( 'pretty tooltips', 'footnotes-made-easy' ) ) ); ?></th>
						<td>
							<div class="toggle-switch">
								<input type="checkbox" name="pretty_tooltips" id="pretty_tooltips" <?php checked( $this->current_options[ 'pretty_tooltips' ], true ); ?> />
								<label for="pretty_tooltips" class="toggle-label">
									<span class="toggle-slider"></span>
								</label>
								<span class="toggle-text"><?php esc_html_e( 'Uses jQuery UI to show pretty tooltips', 'footnotes-made-easy' ); ?></span>
							</div>
						</td>
					</tr>

					<!-- Combine Notes Toggle -->
					<tr>
						<th scope="row"><?php echo esc_html( ucwords( __( 'combine notes', 'footnotes-made-easy' ) ) ); ?></th>
						<td>
							<div class="toggle-switch">
								<input type="checkbox" name="combine_identical_notes" id="combine_identical_notes" <?php checked( $this->current_options[ 'combine_identical_notes' ], true ); ?> />
								<label for="combine_identical_notes" class="toggle-label">
									<span class="toggle-slider"></span>
								</label>
								<span class="toggle-text"><?php esc_html_e( 'Combine identical footnotes', 'footnotes-made-easy' ); ?></span>
							</div>
						</td>
					</tr>

					<tr>
					<th scope="row"><label for="priority"><?php echo esc_html( ucwords( __( 'priority', 'footnotes-made-easy' ) ) ); ?></label></th>
					<td><input type="text" size="3" name="priority" id="priority" value="<?php echo esc_attr( $this->current_options[ 'priority' ] ); ?>" />
					<?php esc_html_e( 'The default is 11', 'footnotes-made-easy' ); ?><p class="description"><?php esc_html_e( 'This setting controls the order in which this plugin executes in relation to others. Modifying this setting may therefore affect the behavior of other plugins.', 'footnotes-made-easy' ); ?></p></td>
					</tr>
				</table>
						</div>
			</div>

			<!-- Suppress Footnotes Section -->
			<div class="footnotes-settings-section">
				<h2><?php echo esc_html( ucwords( __( 'suppress Footnotes', 'footnotes-made-easy' ) ) ); ?></h2>
				
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
					<th scope="row"><?php esc_html_e( 'Hide footnotes in these contexts:', 'footnotes-made-easy' ); ?></th>
					<td>
						<div class="toggle-switch">
							<input type="checkbox" name="no_display_home" id="no_display_home" <?php checked( $this->current_options[ 'no_display_home' ], true ); ?> />
							<label for="no_display_home" class="toggle-label">
								<span class="toggle-slider"></span>
							</label>
							<span class="toggle-text"><?php echo esc_html( ucwords( __( 'on the home page', 'footnotes-made-easy' ) ) ); ?></span>
						</div>
						
						<div class="toggle-switch">
							<input type="checkbox" name="no_display_preview" id="no_display_preview" <?php checked( $this->current_options[ 'no_display_preview' ], true ); ?> />
							<label for="no_display_preview" class="toggle-label">
								<span class="toggle-slider"></span>
							</label>
							<span class="toggle-text"><?php echo esc_html( ucwords( __( 'when displaying a preview', 'footnotes-made-easy' ) ) ); ?></span>
						</div>
						
						<div class="toggle-switch">
							<input type="checkbox" name="no_display_search" id="no_display_search" <?php checked( $this->current_options[ 'no_display_search' ], true ); ?> />
							<label for="no_display_search" class="toggle-label">
								<span class="toggle-slider"></span>
							</label>
							<span class="toggle-text"><?php echo esc_html( ucwords( __( 'in search results', 'footnotes-made-easy' ) ) ); ?></span>
						</div>
						
						<div class="toggle-switch">
							<input type="checkbox" name="no_display_feed" id="no_display_feed" <?php checked( $this->current_options[ 'no_display_feed' ], true ); ?> />
							<label for="no_display_feed" class="toggle-label">
								<span class="toggle-slider"></span>
							</label>
							<span class="toggle-text"><?php esc_html_e( 'In the feed (RSS, Atom, etc.)', 'footnotes-made-easy' ); ?></span>
						</div>
						
						<div class="toggle-switch">
							<input type="checkbox" name="no_display_archive" id="no_display_archive" <?php checked( $this->current_options[ 'no_display_archive' ], true ); ?> />
							<label for="no_display_archive" class="toggle-label">
								<span class="toggle-slider"></span>
							</label>
							<span class="toggle-text"><?php echo esc_html( ucwords( __( 'in any kind of archive', 'footnotes-made-easy' ) ) ); ?></span>
						</div>
						
						<div class="toggle-switch">
							<input type="checkbox" name="no_display_category" id="no_display_category" <?php checked( $this->current_options[ 'no_display_category' ], true ); ?> />
							<label for="no_display_category" class="toggle-label">
								<span class="toggle-slider"></span>
							</label>
							<span class="toggle-text"><?php echo esc_html( ucwords( __( 'in category archives', 'footnotes-made-easy' ) ) ); ?></span>
						</div>
						
						<div class="toggle-switch">
							<input type="checkbox" name="no_display_date" id="no_display_date" <?php checked( $this->current_options[ 'no_display_date' ], true ); ?> />
							<label for="no_display_date" class="toggle-label">
								<span class="toggle-slider"></span>
							</label>
							<span class="toggle-text"><?php  echo esc_html( ucwords( __('in date-based archives', 'footnotes-made-easy' ) ) ); ?></span>
						</div>
					</td>
					</tr>
				</table>
				</div>
			</div>

			<!-- Advanced Settings Section -->
			<div class="footnotes-settings-section">
				<h2><?php esc_html_e( 'Advanced Settings', 'footnotes-made-easy' ); ?></h2>
				
				<div class="footnotes-warning">
					<strong><?php esc_html_e( 'Warning:', 'footnotes-made-easy' ); ?></strong> 
					<?php esc_html_e( 'Changing the following settings will change functionality in a way which may stop footnotes from displaying correctly. For footnotes to work as expected after updating these settings, you will need to manually update all existing posts with footnotes.', 'footnotes-made-easy' ); ?>
				</div>
				
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
					<th scope="row"><label for="footnotes_open"><?php echo esc_html( ucwords( __( 'begin a footnote', 'footnotes-made-easy' ) ) ); ?></label></th>
					<td><input type="text" size="3" name="footnotes_open" id="footnotes_open" value="<?php echo esc_attr( $this->current_options[ 'footnotes_open' ] ); ?>" /></td>
					</tr>

					<tr>
					<th scope="row"><label for="footnotes_close"><?php echo esc_html( ucwords( __( 'end a Footnote', 'footnotes-made-easy' ) ) ); ?></label></th>
					<td><input type="text" size="3" name="footnotes_close" id="footnotes_close" value="<?php echo esc_attr( $this->current_options[ 'footnotes_close' ] ); ?>" /></td> 
					</tr>
				</table>
						</div>
			</div>

			<?php wp_nonce_field( 'footnotes-nonce','footnotes_nonce' ); ?>

			<div class="footnotes-submit">
				<p class="submit"><input type="submit" name="save_options" value="<?php echo esc_attr( ucwords( __( 'save changes', 'footnotes-made-easy' ) ) ); ?>" class="button-primary" /></p>
				<input type="hidden" name="save_footnotes_made_easy_options" value="1" />
			</div>

		</form>
		
	</div>

	<!-- Right Column - Info Cards (30%) -->
	<div class="footnotes-right-column">
		
		<!-- Usage Guide Card -->
		<div class="footnotes-card">
			<h3><?php esc_html_e( 'Show Us Some Love', 'footnotes-made-easy' ); ?></h3>
			<p><?php esc_html_e('I am so grateful you chose Footnotes Made Easy! If this plugin has made your work easier, please consider giving back. Your donation helps us maintain this free resource, implement user-requested features, and provide reliable support to our growing community.', 'footnotes-made-easy'); ?></p>

					<p><a href="https://profiles.wordpress.org/lumiblog/#content-plugins" target="_blank"><?php esc_html_e('Check out my other plugins.', 'footnotes-made-easy'); ?></a></p>
					<div class="footnotes-submit">
					<p><a href="https://github.com/sponsors/lumumbapl" class="button button-primary" target="_blank"><?php esc_html_e('Donate Now', 'footnotes-made-easy'); ?></a></p>
						</div>
		</div>

		<!-- Quick Access Card -->
		<div class="footnotes-card quick-access-card">
			<h3><?php esc_html_e( 'Quick Access', 'footnotes-made-easy' ); ?></h3>
			
			<div class="quick-access-items">
				<a href="https://wordpress.org/support/plugin/footnotes-made-easy/" target="_blank" class="quick-access-item">
					<div class="quick-access-icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
						</svg>
					</div>
					<span><?php esc_html_e( 'Get Support', 'footnotes-made-easy' ); ?></span>
				</a>
				
				<a href="https://lumumbas.blog/" target="_blank" class="quick-access-item">
					<div class="quick-access-icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
						</svg>
					</div>
					<span><?php esc_html_e( 'Read My Blog', 'footnotes-made-easy' ); ?></span>
				</a>
				
				<a href="https://github.com/lumumbapl/footnotes-made-easy/issues" target="_blank" class="quick-access-item">
					<div class="quick-access-icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="12" cy="12" r="10"/>
							<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
							<line x1="12" y1="17" x2="12.01" y2="17"/>
						</svg>
					</div>
					<span><?php esc_html_e( 'Feature Request', 'footnotes-made-easy' ); ?></span>
				</a>
				
				<a href="http://wordpress.org/support/plugin/footnotes-made-easy/reviews/#new-post" target="_blank" class="quick-access-item">
					<div class="quick-access-icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
						</svg>
					</div>
					<span><?php esc_html_e( 'Leave Us a Review', 'footnotes-made-easy' ); ?></span>
				</a>
			</div>
		</div>

		
		
	</div>

</div>

</div>
>>>>>>> 04eb4f9e6857c2377a32b8ab356a1d429b24b988
