<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_pbtoto_domain_model_tipset'] = array(
	'ctrl' => $TCA['tx_pbtoto_domain_model_tipset']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, fe_user, resultset, tip',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, fe_user, resultset, tip,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_pbtoto_domain_model_tipset',
				'foreign_table_where' => 'AND tx_pbtoto_domain_model_tipset.pid=###CURRENT_PID### AND tx_pbtoto_domain_model_tipset.sys_language_uid IN (-1,0)',
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
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_tipset.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'fe_user' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_tipset.fe_user',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'resultset' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_tipset.resultset',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'tip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_tipset.tip',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_pbtoto_domain_model_tip',
				'foreign_field' => 'tipset',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'both',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
	),
);
?>