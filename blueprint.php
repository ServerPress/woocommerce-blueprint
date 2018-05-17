<?php
/**
 * WooCommerce Blueprint
 */

/** Download, unzip WordPress, and move the contents into root. */
ds_cli_exec( "wp core download" );

//** Install WordPress
ds_cli_exec( "wp core install --url=$siteName --title='WooCommerce Blueprint' --admin_user=testadmin --admin_password=password --admin_email=pleaseupdate@$siteName" );

//** Set the WordPress Address(URL) and Site Address(URL)
ds_cli_exec( "wp option update siteurl 'https://$siteName'" );
ds_cli_exec( "wp option update home 'https://$siteName'" );

//** Change the tagline
ds_cli_exec( "wp option update blogdescription 'My Ecommerce Store'" );

//** Change Permalink structure
ds_cli_exec( "wp rewrite structure '/%postname%' --quiet" );

/** Download, unzip WooCommerce, and move the plugin into the plugin folder. */
ds_cli_exec( "wp plugin install woocommerce --activate" );

/** Download, unzip Child Theme Configurator, and move the plugin into the plugin folder. */
ds_cli_exec( "wp plugin install child-theme-configurator --activate" );

//** Download & Activate StoreFront Theme
ds_cli_exec( "wp theme install storefront --activate");

//** Remove Default Themes (Except twentyseventeen)
ds_cli_exec( "wp theme delete twentyfifteen" );
ds_cli_exec( "wp theme delete twentysixteen" );

//** Remove Plugins
ds_cli_exec( "wp plugin delete akismet" );
ds_cli_exec( "wp plugin delete hello" );

//** Remove Default Post/Page
ds_cli_exec( "wp post delete 1 --force" ); // Hello World!
ds_cli_exec( "wp post delete 2 --force" ); // Sample Page

//** Delete First Comment
ds_cli_exec( "wp comment delete 1" );

//** Download GeoIP.dat and place in the uploads folder
ds_cli_exec( "wget http://geolite.maxmind.com/download/geoip/database/GeoLiteCountry/GeoIP.dat.gz && gunzip GeoIP.dat.gz && mv GeoIP.dat ./wp-content/uploads/" );

//** Check if index.php unpacked okay
if ( is_file( "index.php" ) ) {

	//** Cleanup the empty folder, download, and this script.
	ds_cli_exec( "rm blueprint.php" );	

}
