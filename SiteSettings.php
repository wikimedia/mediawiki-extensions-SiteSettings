<?php

if ( !defined( 'MEDIAWIKI' ) ) die();

###
# This is the path to your installation of Site Settings as
# seen from the web. Change it if required ($wgScriptPath is the
# path to the base directory of your wiki). No final slash.
##
$wgSiteSettingsScriptPath = $wgScriptPath . '/extensions/SiteSettings';
##

define( 'SITE_SETTINGS_VERSION', '0.7-alpha' );

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

$wgMessagesDirs['SiteSettings'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['SiteSettingsAliases'] = __DIR__ . '/SiteSettings.alias.php';

$wgExtensionFunctions[] = 'SSUtils::initializeSite';

$wgHooks['LoadExtensionSchemaUpdates'][] = 'SSUtils::describeDBSchema';
$wgHooks['PersonalUrls'][] = 'SSUtils::addTopSiteSettingsLink';
$wgHooks['UserGetRights'][] = 'SSUtils::blockFromReading';

// Register all special pages and other classes.
$wgSpecialPages['SiteSettings'] = 'SpecialSiteSettings';
$wgAutoloadClasses['SpecialSiteSettings'] = __DIR__ . '/SpecialSiteSettings.php';

$wgAutoloadClasses['SiteSettings'] = __DIR__ . '/SiteSettings_body.php';
$wgAutoloadClasses['SSUtils'] = __DIR__ . '/SS_Utils.php';
$wgAutoloadClasses['SSFieldLevel'] = __DIR__ . '/SS_FieldLevel.php';
$wgAutoloadClasses['SSStore'] = __DIR__ . '/SS_Store.php';

$wgAvailableRights[] = 'sitesettings';
$wgGroupPermissions['sysop']['sitesettings'] = true;

$wgSiteSettingsResourceTemplate = array(
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'SiteSettings'
);
$wgResourceModules += array(
	'ext.sitesettings.main' => $wgSiteSettingsResourceTemplate + array(
		'styles' => array(
			'SiteSettings.css',
		),
	),
);