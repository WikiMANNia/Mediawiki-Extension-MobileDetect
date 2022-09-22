<?php

$wgExtensionCredits['parserhook'][] = array(
	'name' => 'MobileDetect',
	'version' => '3.0',
	'license-name' => 'GPL-2.0+',
	'descriptionmsg' => 'mobiledetect-desc',
	'author' => array( 'Matthew Tran', 'Luis Felipe Schenone' ),
	'url' => 'https://www.mediawiki.org/wiki/Extension:MobileDetect',
);

$wgExtensionMessagesFiles['MobileDetect'] = __DIR__ . '/MobileDetect.i18n.php';
$wgMessagesDirs['MobileDetect'] = __DIR__ . '/i18n';

$wgAutoloadClasses['MobileDetect'] = __DIR__ . '/MobileDetect.body.php';

$wgHooks['BeforePageDisplay'][] = 'MobileDetect::addModule';
$wgHooks['ParserFirstCallInit'][] = 'MobileDetect::setParserHook';

$wgResourceModules['ext.MobileDetect'] = array(
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'MobileDetect',
);
if ( MobileDetect::isMobile() ) {
	$wgResourceModules['ext.MobileDetect']['styles'] = 'MobileDetect.mobileonly.css';
} else {
	$wgResourceModules['ext.MobileDetect']['styles'] = 'MobileDetect.nomobile.css';
}

// Backwards compatibility
function mobiledetect() {
	return MobileDetect::isMobile();
}