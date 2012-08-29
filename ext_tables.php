<?php
if (!defined ('TYPO3_MODE')){
	die ('Access denied.');
}



Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Toto'
);




//$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

$pi1Signature = strtolower(str_replace('_', '', $_EXTKEY) . '_Pi1');
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pi1Signature] = 'pi_flexform';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pi1Signature] = 'layout,select_key';
t3lib_extMgm::addPiFlexFormValue($pi1Signature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');


if (TYPO3_MODE === 'BE') {

	/**
	* Registers a Backend Module
	*/
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'mod1',	// Submodule key
		'',						// Position
		array(
			'Resultset' => 'list, show, new, create, edit, update, delete',
			'Result' => 'list, show, new, create, edit, update, delete',
			'Tipset' => 'list, show, new, create, edit, update, delete,tip',
			'Tip' => 'myTip','list, show, new, create, edit, update, delete',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod1.xml',
		)
	);

}


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Toto');


t3lib_extMgm::addLLrefForTCAdescr('tx_pbtoto_domain_model_resultset', 'EXT:pb_toto/Resources/Private/Language/locallang_csh_tx_pbtoto_domain_model_resultset.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_pbtoto_domain_model_resultset');
$TCA['tx_pbtoto_domain_model_resultset'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_resultset',
		'label' 			=> 'is_finished',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Resultset.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_pbtoto_domain_model_resultset.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_pbtoto_domain_model_result', 'EXT:pb_toto/Resources/Private/Language/locallang_csh_tx_pbtoto_domain_model_result.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_pbtoto_domain_model_result');
$TCA['tx_pbtoto_domain_model_result'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_result',
		'label' 			=> 'name_team1',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Result.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_pbtoto_domain_model_result.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_pbtoto_domain_model_tipset', 'EXT:pb_toto/Resources/Private/Language/locallang_csh_tx_pbtoto_domain_model_tipset.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_pbtoto_domain_model_tipset');
$TCA['tx_pbtoto_domain_model_tipset'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_tipset',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Tipset.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_pbtoto_domain_model_tipset.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_pbtoto_domain_model_tip', 'EXT:pb_toto/Resources/Private/Language/locallang_csh_tx_pbtoto_domain_model_tip.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_pbtoto_domain_model_tip');
$TCA['tx_pbtoto_domain_model_tip'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:pb_toto/Resources/Private/Language/locallang_db.xml:tx_pbtoto_domain_model_tip',
		'label' 			=> 'trend',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' => true,
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l10n_parent',
		'transOrigDiffSourceField' 	=> 'l10n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Tip.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_pbtoto_domain_model_tip.gif'
	),
);

?>