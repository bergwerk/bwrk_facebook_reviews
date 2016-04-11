<?php

$configuration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$configuration->setExt('bwrk_facebook_reviews');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($configuration);

$tca->addCheckField('deleted');
$tca->addCheckField('hidden');
$tca->addInputField('review_hash');
$tca->addInputField('created_time');
$tca->addInputField('user_id');
$tca->addInputField('user_name');
$tca->addInputField('rating');
$tca->addTextField('review_text');

return $tca->createTca();