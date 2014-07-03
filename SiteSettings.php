<?php

if ( !defined( 'MEDIAWIKI' ) ) die();

###
# This is the path to your installation of Site Settings as
# seen from the web. Change it if required ($wgScriptPath is the
# path to the base directory of your wiki). No final slash.
##
$wgSiteSettingsScriptPath = $wgScriptPath . '/extensions/SiteSettings';
##

###
# This is the path to your installation of Site Settings as
# seen on your local filesystem.
##
$dir = $IP . '/extensions/SiteSettings';
##

define( 'SITE_SETTINGS_VERSION', '0.6' );

/**********************************************/
/***** credits (see "Special:Version")    *****/
/**********************************************/
$wgExtensionCredits['other'][]= array(
	'path' => __FILE__,
	'name' => 'Site Settings',
	'version' => SITE_SETTINGS_VERSION,
	'author' => 'Yaron Koren',
	'url' => 'https://www.mediawiki.org/wiki/Extension:Site_Settings',
	'descriptionmsg' => 'sitesettings-desc',
);

$wgMessagesDirs['SiteSettings'] = $dir . '/i18n';
$wgExtensionMessagesFiles['SiteSettings'] = $dir . '/SiteSettings.i18n.php';

$wgExtensionFunctions[] = 'SSUtils::initializeSite';

$wgHooks['LoadExtensionSchemaUpdates'][] = 'SSUtils::describeDBSchema';
$wgHooks['PersonalUrls'][] = 'SSUtils::addTopSiteSettingsLink';
$wgHooks['UserGetRights'][] = 'SSUtils::blockFromReading';

// Register all special pages and other classes.
$wgSpecialPages['SiteSettings'] = 'SpecialSiteSettings';
$wgAutoloadClasses['SpecialSiteSettings'] = $dir . '/SpecialSiteSettings.php';

$wgAutoloadClasses['SiteSettings'] = $dir . '/SiteSettings_body.php';
$wgAutoloadClasses['SSUtils'] = $dir . '/SS_Utils.php';
$wgAutoloadClasses['SSFieldLevel'] = $dir . '/SS_FieldLevel.php';
$wgAutoloadClasses['SSStore'] = $dir . '/SS_Store.php';

$wgAvailableRights[] = 'sitesettings';
$wgGroupPermissions['sysop']['sitesettings'] = true;

$wgSiteSettingsResourceTemplate = array(
	'localBasePath' => $dir,
	'remoteExtPath' => 'SiteSettings'
);
$wgResourceModules += array(
	'ext.sitesettings.main' => $wgSiteSettingsResourceTemplate + array(
		'styles' => array(
			'SiteSettings.css',
		),
	),
);

###
# Global variables
##
// Should be set to true before the DB table has been created, so that
// update.php (or something similar) can be called.
$wgSiteSettingsSetupMode = false;
