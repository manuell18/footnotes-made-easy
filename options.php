<?php
/**
* General Options Page
*
* Screen for specifying general options for the plugin
*
* @package	footnotes-made-easy
* @since	1.0
*/
?>

<div class="wrap">

<h1><?php _e( 'Footnotes Made Easy', 'footnotes-made-easy' ); ?></h1>

<?php
if ( !empty( $_POST[ 'save_options' ] ) && ( check_admin_referer( 'footnotes-nonce', 'footnotes_nonce' ) ) ) {
	$message = __( 'Settings saved successfully.', 'footnotes-made-easy' );
} else {
	$message = '';
}
?>

<?php if ( $message !== '' ) { ?>
<div class="updated"><p><strong><?php echo $message; ?></strong></p></div>
<?php } ?>

<div class="footnotes-layout">
	
	<!-- Left Column - Plugin Settings (70%) -->
	<div class="footnotes-left-column">
		
		<form method="post">
			
			<!-- Display Settings Section -->
			<div class="footnotes-settings-section">
				<h2><?php _e( 'Display Settings', 'footnotes-made-easy' ); ?></h2>
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
					<th scope="row"><label for="pre_identifier"><?php echo ucwords( __( 'identifier', 'footnotes-made-easy' ) ); ?></label></th>

					<td>
					<input type="text" size="3" name="pre_identifier" value="<?php echo esc_attr(  $this->current_options[ 'pre_identifier' ] ); ?>" />
					<input type="text" size="3" name="inner_pre_identifier" value="<?php echo esc_attr(  $this->current_options[ 'inner_pre_identifier' ] ); ?>" />
					<select name="list_style_type">
						<?php foreach ( $this->styles as $key => $val ): ?>
						<option value="<?php echo $key; ?>" <?php if ( $this->current_options[ 'list_style_type' ] === $key ) echo 'selected="selected"'; ?> ><?php echo esc_attr( $val ); ?></option>
						<?php endforeach; ?>
					</select>
					<input type="text" size="3" name="inner_post_identifier" value="<?php echo esc_attr(  $this->current_options[ 'inner_post_identifier' ] ); ?>" />
					<input type="text" size="3" name="post_identifier" value="<?php echo esc_attr( $this->current_options[ 'post_identifier' ] ); ?>" />
					<p class="description"><?php _e( 'This defines how the link to the footnote will be displayed. The outer text will not be linked to.', 'footnotes-made-easy' ); ?></p></td>
					</tr>

					<tr>
					<th scope="row"><label for="list_style_symbol"><?php echo ucwords( __( 'symbol', 'footnotes-made-easy' ) ); ?></label></th>
					<td><input type="text" size="8" name="list_style_symbol" value="<?php echo $this->current_options[ 'list_style_symbol' ]; ?>" /><?php _e( 'If you have chosen a symbol as your list style.', 'footnotes-made-easy' ); ?>
					<p class="description"><?php _e( 'It\'s not usually a good idea to choose this type unless you never have more than a couple of footnotes per post', 'footnotes-made-easy' ); ?></p></td>
					</tr>

					<tr>
						<th scope="row"><label for="superscript"><?php echo ucwords( __( 'superscript', 'footnotes-made-easy' ) ); ?></label></th>
						<td>
							<div class="toggle-switch">
								<input type="checkbox" name="superscript" id="superscript" <?php checked( $this->current_options[ 'superscript' ], true ); ?> />
								<label for="superscript" class="toggle-label">
									<span class="toggle-slider"></span>
								</label>
								<span class="toggle-text"><?php _e( 'Show identifier as superscript', 'footnotes-made-easy' ); ?></span>
							</div>
						</td>
					</tr>

					<tr>
					<th scope="row"><label for="pre_backlink"><?php echo ucwords( __( 'back-link', 'footnotes-made-easy' ) ); ?></label></th>
					<td>
					<input type="text" size="3" name="pre_backlink" value="<?php echo esc_attr( $this->current_options[ 'pre_backlink' ] ); ?>" />
					<input type="text" size="10" name="backlink" value="<?php echo $this->current_options[ 'backlink' ]; ?>" />
					<input type="text" size="3" name="post_backlink" value="<?php echo esc_attr( $this->current_options[ 'post_backlink' ] ); ?>" />

					<!--  translators: %s is the suggested back-link character (↩). -->
					<p class="description"><?php printf( __( 'These affect how the back-links after each footnote look. A good back-link character is %s. If you want to remove the back-links all together, you can effectively do so by making all these settings blank.', 'footnotes-made-easy' ), '&#8617; (↩)' ); ?></p></td>

					</tr>
				</table>
						</div>
			</div>

			<!-- Content Settings Section -->
			<div class="footnotes-settings-section">
				<h2><?php _e( 'Content Settings', 'footnotes-made-easy' ); ?></h2>
				
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
					<th scope="row"><label for="pre_footnotes"><?php echo ucwords( __( 'Footnotes header', 'footnotes-made-easy' ) ); ?></label></th>
					<td><textarea name="pre_footnotes" rows="3" cols="60" class="large-text code"><?php echo $this->current_options[ 'pre_footnotes' ]; ?></textarea>
					<p class="description"><?php _e( 'Anything to be displayed before the footnotes at the bottom of the post can go here.', 'footnotes-made-easy' ); ?></p></td>
					</tr>

					<tr>
					<th scope="row"><label for="post_footnotes"><?php echo ucwords( __( 'Footnotes footer', 'footnotes-made-easy' ) ); ?></label></th>
					<td><textarea name="post_footnotes" rows="3" cols="60" class="large-text code"><?php echo $this->current_options[ 'post_footnotes' ]; ?></textarea>
					<p class="description"><?php _e( 'Anything to be displayed after the footnotes at the bottom of the post can go here.', 'footnotes-made-easy' ); ?></p></td>
					</tr>
				</table>
						</div>
			</div>

			<!-- Behavior Settings Section -->
			<div class="footnotes-settings-section">
				<h2><?php _e( 'Behavior Settings', 'footnotes-made-easy' ); ?></h2>
				
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
						<th scope="row"><?php echo ucwords( __( 'pretty tooltips', 'footnotes-made-easy' ) ); ?></th>
						<td>
							<div class="toggle-switch">
								<input type="checkbox" name="pretty_tooltips" id="pretty_tooltips" <?php checked( $this->current_options[ 'pretty_tooltips' ], true ); ?> />
								<label for="pretty_tooltips" class="toggle-label">
									<span class="toggle-slider"></span>
								</label>
								<span class="toggle-text"><?php _e( 'Uses jQuery UI to show pretty tooltips', 'footnotes-made-easy' ); ?></span>
							</div>
						</td>
					</tr>

					<!-- Combine Notes Toggle -->
					<tr>
						<th scope="row"><?php echo ucwords( __( 'combine notes', 'footnotes-made-easy' ) ); ?></th>
						<td>
							<div class="toggle-switch">
								<input type="checkbox" name="combine_identical_notes" id="combine_identical_notes" <?php checked( $this->current_options[ 'combine_identical_notes' ], true ); ?> />
								<label for="combine_identical_notes" class="toggle-label">
									<span class="toggle-slider"></span>
								</label>
								<span class="toggle-text"><?php _e( 'Combine identical footnotes', 'footnotes-made-easy' ); ?></span>
							</div>
						</td>
					</tr>

					<tr>
					<th scope="row"><label for="priority"><?php echo ucwords( __( 'priority', 'footnotes-made-easy' ) ); ?></label></th>
					<td><input type="text" size="3" name="priority" id="priority" value="<?php echo esc_attr( $this->current_options[ 'priority' ] ); ?>" />
					<?php _e( 'The default is 11', 'footnotes-made-easy' ); ?><p class="description"><?php _e( 'This setting controls the order in which this plugin executes in relation to others. Modifying this setting may therefore affect the behavior of other plugins.', 'footnotes-made-easy' ); ?></p></td>
					</tr>
				</table>
						</div>
			</div>

			<!-- Suppress Footnotes Section -->
			<div class="footnotes-settings-section">
				<h2><?php echo ucwords( __( 'suppress Footnotes', 'footnotes-made-easy' ) ); ?></h2>
				
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
					<th scope="row"><?php _e( 'Hide footnotes in these contexts:', 'footnotes-made-easy' ); ?></th>
					<td>
					<label for="no_display_home"><input type="checkbox" name="no_display_home" id="no_display_home" <?php checked( $this->current_options[ 'no_display_home' ], true ); ?> />&nbsp;<?php ucwords( __( 'on the home page', 'footnotes-made-easy' ) ); ?></label><br>
					<label for="no_display_preview"><input type="checkbox" name="no_display_preview" id="no_display_preview" <?php checked( $this->current_options[ 'no_display_preview' ], true ); ?> />&nbsp;<?php echo ucwords( __( 'when displaying a preview', 'footnotes-made-easy' ) ); ?></label><br>
					<label for="no_display_search"><input type="checkbox" name="no_display_search" id="no_display_search" <?php checked( $this->current_options[ 'no_display_search' ], true ); ?> />&nbsp;<?php echo ucwords( __( 'in search results', 'footnotes-made-easy' ) ); ?></label><br>
					<label for="no_display_feed"><input type="checkbox" name="no_display_feed" id="no_display_feed" <?php checked( $this->current_options[ 'no_display_feed' ], true ); ?> />&nbsp;<?php _e( 'In the feed (RSS, Atom, etc.)', 'footnotes-made-easy' ); ?></label><br>
					<label for="no_display_archive"><input type="checkbox" name="no_display_archive" id="no_display_archive" <?php checked( $this->current_options[ 'no_display_archive' ], true ); ?> />&nbsp;<?php echo ucwords( __( 'in any kind of archive', 'footnotes-made-easy' ) ); ?></label><br>
					<label for="no_display_category"><input type="checkbox" name="no_display_category" id="no_display_category" <?php checked( $this->current_options[ 'no_display_category' ], true ); ?> />&nbsp;<?php echo ucwords( __( 'in category archives', 'footnotes-made-easy' ) ); ?></label><br>
					<label for="no_display_date"><input type="checkbox" name="no_display_date" id="no_display_date" <?php checked( $this->current_options[ 'no_display_date' ], true ); ?> />&nbsp;<?php _e( 'in date-based archives', 'footnotes-made-easy' ); ?></label><br>
					</td>
					</tr>
				</table>
						</div>
			</div>

			<!-- Advanced Settings Section -->
			<div class="footnotes-settings-section">
				<h2><?php _e( 'Advanced Settings', 'footnotes-made-easy' ); ?></h2>
				
				<div class="footnotes-warning">
					<strong><?php _e( 'Warning:', 'footnotes-made-easy' ); ?></strong> 
					<?php _e( 'Changing the following settings will change functionality in a way which may stop footnotes from displaying correctly. For footnotes to work as expected after updating these settings, you will need to manually update all existing posts with footnotes.', 'footnotes-made-easy' ); ?>
				</div>
				
				<div class="footnotes-settings-text">
				<table class="form-table">
					<tr>
					<th scope="row"><label for="footnotes_open"><?php echo ucwords( __( 'begin a footnote', 'footnotes-made-easy' ) ); ?></label></th>
					<td><input type="text" size="3" name="footnotes_open" id="footnotes_open" value="<?php echo esc_attr( $this->current_options[ 'footnotes_open' ] ); ?>" /></td>
					</tr>

					<tr>
					<th scope="row"><label for="footnotes_close"><?php echo ucwords( __( 'end a Footnote', 'footnotes-made-easy' ) ); ?></label></th>
					<td><input type="text" size="3" name="footnotes_close" id="footnotes_close" value="<?php echo esc_attr( $this->current_options[ 'footnotes_close' ] ); ?>" /></td> 
					</tr>
				</table>
						</div>
			</div>

			<?php wp_nonce_field( 'footnotes-nonce','footnotes_nonce' ); ?>

			<div class="footnotes-submit">
				<p class="submit"><input type="submit" name="save_options" value="<?php echo ucwords( __( 'save changes', 'footnotes-made-easy' ) ); ?>" class="button-primary" /></p>
				<input type="hidden" name="save_footnotes_made_easy_options" value="1" />
			</div>

		</form>
		
	</div>

	<!-- Right Column - Info Cards (30%) -->
	<div class="footnotes-right-column">
		
		<!-- Usage Guide Card -->
		<div class="footnotes-card">
			<h3><?php _e( 'Show Us Some Love', 'footnotes-made-easy' ); ?></h3>
			<p><?php _e('I am so grateful you chose Footnotes Made Easy! If this plugin has made your work easier, please consider giving back. Your donation helps us maintain this free resource, implement user-requested features, and provide reliable support to our growing community.', 'footnotes-made-easy'); ?></p>

					<p><a href="https://profiles.wordpress.org/lumiblog/#content-plugins" target="_blank"><?php _e('Check out my other plugins.', 'footnotes-made-easy'); ?></a></p>
					<div class="footnotes-submit">
					<p><a href="https://github.com/sponsors/lumumbapl" class="button button-primary" target="_blank"><?php _e('Donate Now', 'footnotes-made-easy'); ?></a></p>
						</div>
		</div>

		<!-- Quick Access Card -->
		<div class="footnotes-card quick-access-card">
			<h3><?php _e( 'Quick Access', 'footnotes-made-easy' ); ?></h3>
			
			<div class="quick-access-items">
				<a href="https://wordpress.org/support/plugin/footnotes-made-easy/" target="_blank" class="quick-access-item">
					<div class="quick-access-icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
						</svg>
					</div>
					<span><?php _e( 'Get Support', 'footnotes-made-easy' ); ?></span>
				</a>
				
				<a href="https://lumumbas.blog/" target="_blank" class="quick-access-item">
					<div class="quick-access-icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
						</svg>
					</div>
					<span><?php _e( 'Read My Blog', 'footnotes-made-easy' ); ?></span>
				</a>
				
				<a href="https://github.com/lumumbapl/footnotes-made-easy/issues" target="_blank" class="quick-access-item">
					<div class="quick-access-icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="12" cy="12" r="10"/>
							<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
							<line x1="12" y1="17" x2="12.01" y2="17"/>
						</svg>
					</div>
					<span><?php _e( 'Feature Request', 'footnotes-made-easy' ); ?></span>
				</a>
				
				<a href="http://wordpress.org/support/plugin/footnotes-made-easy/reviews/#new-post" target="_blank" class="quick-access-item">
					<div class="quick-access-icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
						</svg>
					</div>
					<span><?php _e( 'Leave Us a Review', 'footnotes-made-easy' ); ?></span>
				</a>
			</div>
		</div>

		
		
	</div>

</div>

</div>
