<?php
/*$GLOBALS['TCA']['fe_users'] = array(
	'ctrl' => array(
		'external' => array(
			0 => array(
				'connector' => 'csv',
				'parameters' => array(
					'filename' => 'res/departments.txt',
					'delimiter' => "\t",
					'text_qualifier' => '"',
					'skip_rows' => 1,
					'encoding' => 'latin1'
				),
				'data' => 'array',
				'reference_uid' => 'code',
				'priority' => 10,
				'description' => 'Import of all company departments'
			)
		)
	)
);*/




$tca = array(
	'ctrl' => array(
		'tx_dataport' => array(
			123 => array(
				'description' => 'Example',
				'identifier' => array('username'),
			),
		),
	),
	'columns' => array(
		'username' => array (
			'tx_dataport' => array(
				123 => array(
					'value' => '[Vorname].[Nachname]',
					'convert' => array(
						'Lowercase',
						'Alphanumeric'
					),
				),
			),
		),
		'usergroup' => array (
			'tx_dataport' => array(
				123 => array(
					'value' => '[Gruppe]',
				),
			),
		),
	),
);

\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($GLOBALS['TCA']['fe_users'], $tca);