<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_pbtoto_domain_model_result'] = array(
	'ctrl' => $TCA['tx_pbtoto_domain_model_result']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name_team1, name_team2, icon_url_team1, icon_url_team2, match_is_finished, points_team1, points_team2, trend, match_i_d',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name_team1, name_team2, icon_url_team1, icon_url_team2, match_is_finished, points_team1, points_team2, trend, match_i_d,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_pbtoto_domain_model_result',
				'foreign_table_where' => 'AND tx_pbtoto_domain_model_result.pid=###CURRENT_PID### AND tx_pbtoto_domain_model_result.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' =>array(
				'type' =>'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
			'type' => 'input',
			'size' => '30',
			'max' => '255',
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0',
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0',
				'range' => array(
					'upper' => mktime(0, 0, 0, 12, 31, date('Y') + 10),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				),
			),
		),
		'name_team1' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.name_team1',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'name_team2' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.name_team2',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'icon_url_team1' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.icon_url_team1',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'icon_url_team2' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.icon_url_team2',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'match_is_finished' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.match_is_finished',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'points_team1' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.points_team1',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'points_team2' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.points_team2',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'trend' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.trend',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'match_i_d' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result.match_i_d',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'resultset' => array(
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_pbtoto_domain_model_resultset',
				'maxitems' => 1
			),
		),
		
	
		
		
	),
);
?>