<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}


Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Resultset' => 'index,list, show, new, create, edit, update, delete,showCurrent,showPreviewFirst,showPreviewSecond',
		'Result' => 'list, show, new, create, edit, update, delete',
		'Tipset' => 'list, show, new, create, edit, update, delete, multiTipsetsList,multiTipsetsUpdate,showTable,error',
																						
		'Tip' => 'list, show, new, create, edit, update, delete',
		
	),
	array(
		'Resultset' => 'create, update, delete,showCurrent,showPreviewFirst,showPreviewSecond',
		'Result' => 'create, update, delete',
		'Tipset' => 'list, create, update, delete,multiTipsetsList,multiTipsetsUpdate,showTable,error',
		'Tip' => 'create, update, delete',
		
	)
);


?>

