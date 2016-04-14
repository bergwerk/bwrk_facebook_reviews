<?php
$EM_CONF[$_EXTKEY] = array(
    'title' => 'BERGWERK Facebook Reviews',
    'description' => 'Fetch facebook reviews for TYPO3 usage',
    'category' => 'plugin',
    'version' => '1.1.2',
    'state' => 'stable',
    'clearcacheonload' => 0,
    'author' => 'Georg Dümmler',
    'author_email' => 'gd@bergwerk.ag',
    'author_company' => 'BERGWERK Werbeagentur GmbH',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.0-7.6.99',
            'bwrk_utility' => '1.0.0-1.9.99'
        ),
        'conflicts' => array(),
        'suggests' => array(
        )
    )
);
