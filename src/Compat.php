<?php

namespace MediaWiki\Extension\MobileDetect;

class Compat {

    public static function init(): void {
        self::aliasCoreClasses();
    }

    private static function aliasCoreClasses(): void {

		// Class aliases for multi-version compatibility.
		// These need to be in global scope so phan can pick up on them,
		// and before any use statements that make use of the namespaced names.

		if ( class_exists( \OutputPage::class ) && /* < 1.41 */
			!class_exists( 'MediaWiki\\Output\\OutputPage', false ) ) {
			class_alias(
				\OutputPage::class,
				'MediaWiki\\Output\\OutputPage'
			);
		}
		if ( class_exists( \Parser::class ) && /* < 1.42 */
			!class_exists( 'MediaWiki\\Parser\\Parser', false ) ) {
			class_alias(
				\Parser::class,
				'MediaWiki\\Parser\\Parser'
			);
		}
		if ( class_exists( \PPFrame::class ) && /* < 1.43 */
			!class_exists( 'MediaWiki\\Parser\\PPFrame', false ) ) {
			class_alias(
				\PPFrame::class,
				'MediaWiki\\Parser\\PPFrame'
			);
		}
		if ( class_exists( \Skin::class ) && /* < 1.44 */
			!class_exists( 'MediaWiki\\Skin\\Skin', false ) ) {
			class_alias(
				\Skin::class,
				'MediaWiki\\Skin\\Skin'
			);
		}
    }
}