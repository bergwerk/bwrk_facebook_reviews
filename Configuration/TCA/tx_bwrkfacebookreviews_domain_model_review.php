<?php

$configuration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$configuration->setExt('bwrk_facebook_reviews');
$configuration->setModel('tx_bwrkfacebookreviews_domain_model_review');
$configuration->setLabelField('user_name');
$configuration->setIconFile('EXT:bwrk_facebook_reviews/ext_icon.png');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($configuration);

$tca->addPassThrough('deleted');
$tca->addPassThrough('review_hash');
$tca->addPassThrough('user_id');

$tca->addCheckField('hidden');
$tca->addInputField('created_time', $tca->getFieldLabel('created_time'), 0, 30, 255, 1, 'trim');
$tca->addInputField('user_name', $tca->getFieldLabel('user_name'), 0, 30, 255, 1, 'trim');
$tca->addInputField('rating', $tca->getFieldLabel('rating'), 0, 30, 255, 1, 'trim');
$tca->addTextField('review_text');

return $tca->createTca();