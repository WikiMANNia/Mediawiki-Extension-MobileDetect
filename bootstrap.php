<?php

// Kompatibilitäts-Aliase für verschiedene MediaWiki-Versionen
// Compatibility aliases for different MediaWiki versions
require_once __DIR__ . '/src/Compat.php';
\MediaWiki\Extension\MobileDetect\Compat::init();

// Die Klasse mit der eigentlichen Erkennungslogik
// The class containing the actual recognition logic
require_once __DIR__ . '/src/Hooks.php';

// Die globale Funktion wfMobileDetect()
// The global function wfMobileDetect()
require_once __DIR__ . '/lib/MobileDetect.php';
