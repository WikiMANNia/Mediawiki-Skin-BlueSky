<?php

namespace MediaWiki\Skin\BlueSky;

use MediaWiki\Language\Language;
use MediaWiki\Languages\LanguageNameUtils;
use MediaWiki\Linker\LinkRenderer;
use MediaWiki\MediaWikiServices;
use MediaWiki\Permissions\PermissionManager;
use MediaWiki\Revision\RevisionLookup;
use MediaWiki\Skin\SkinTemplate;
use MediaWiki\User\TalkPageNotificationManager;
use MediaWiki\Utils\UrlUtils;

class SkinBlueSky extends SkinTemplate {

	protected $validProtocols;

	public function __construct(
		public readonly Language $contentLanguage,
		public readonly LanguageNameUtils $languageNameUtils,
		public readonly LinkRenderer $linkRenderer,
		public readonly PermissionManager $permissionManager,
		public readonly RevisionLookup $revisionLookup,
		public readonly TalkPageNotificationManager $talkPageNotificationManager,
		array $options = [],
	) {
		parent::__construct( $options );

		if ( method_exists( \MediaWiki\MediaWikiServices::class, 'getUrlUtils' ) ) {
			// Works with mediawiki version >= 1.39
			$urlUtils = MediaWikiServices::getInstance()->getUrlUtils();
			$this->validProtocols = $urlUtils->validProtocols();
		} else {
			$this->validProtocols = wfUrlProtocols();
		}
	}
}
