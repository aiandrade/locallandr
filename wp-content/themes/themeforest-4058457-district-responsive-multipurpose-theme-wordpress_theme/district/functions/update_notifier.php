<?php
/**
 * Provides a notification everytime the theme is updated
 * Original code courtesy of João Araújo of Unisphere Design - http://themeforest.net/user/unisphere
 */


function update_notifier_menu() {  
	$xml = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want)
	
	if(version_compare($theme_data['Version'], $xml->latest) == -1) {
		add_dashboard_page( $theme_data['Name'] . 'Theme Updates', 'Theme Updates<span class="update-plugins count-1"><span class="update-count">1</span></span>', 'administrator', strtolower($theme_data['Name']) . '-updates', 'update_notifier');
	}
}  

add_action('admin_menu', 'update_notifier_menu');

function update_notifier() { 
	$xml = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$theme_data = wp_get_theme(); // Get theme data from style.css (current version is what we want) ?>
	
	<style>
		.update-nag {display: none;}
		#instructions {max-width: 800px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo $theme_data['Name']; ?> Theme Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo $theme_data['Name']; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>
        
        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_template_directory_uri . '/screenshot.png'; ?>" />
        
        <div id="instructions" style="max-width: 800px; float:left;">
            <h3 style="margin-top:0">Update Download and Instructions</h3>
            <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo strtolower($theme_data['Name']); ?>/</strong></p>
            <p>To update the Theme:</p>
            <ol>
            	<li>Login to your Themeforest account, head over to your <strong>downloads</strong> section and re-download the theme</li>
            	<li>Make sure you've backed up your data via Tools > Export</li>
            	<li>Switch Back to the default Theme (Twenty Twelve) momentarily</li>
            	<li>Delete your current version of "<?php echo $theme_data['Name']; ?>". (this is why it's important to backup any changes you've made to the theme files)</li>
            	<li>Install the Theme Via your Wordpress Dashboard. <a href="http://themewich.com/how-to-install-your-theme/" target="_blank">How to Install your Theme Video</a></li> 
            </ol>
            <p>If you didn't make any changes to the theme files, you are free to update withou risk of losing theme settings, pages, posts, and other content.</p>
        </div>
        
            <div class="clear"></div>
	    
	    <h3 class="title">Changelog</h3>
	    <?php echo $xml->changelog; ?>

	</div>
    
<?php } 

// This function retrieves a remote xml file on my server to see if there's a new update 
// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)
function get_latest_theme_version($interval) {
	
	// remote xml file location
	$notifier_file_url = 'https://dl.dropbox.com/u/32356665/update%20notifiers/district-notifier.xml';
	
	$db_cache_field = 'contempo-notifier-cache';
	$db_cache_field_last_updated = 'contempo-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		if( function_exists('curl_init') ) { // if cURL is available, use it...
			$ch = curl_init($notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
		} else {
			$cache = @file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
		}
		
		if ($cache) {			
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );			
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	libxml_use_internal_errors(true); // !!!
	
	$xml = simplexml_load_string($notifier_data); 
	
	if($xml !== false)
	{
		return $xml; // Process XML structure here
	}
	else
	{
		foreach(libxml_get_errors() as $error)
		{
			error_log('Error parsing XML file: ' . $error->message);
		}
	}
}

?>