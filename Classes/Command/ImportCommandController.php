<?php
namespace BERGWERK\BwrkFacebookReviews\Command;

use BERGWERK\BwrkFacebookReviews\Domain\Model\Review;
use Facebook\Facebook;
use Facebook\FacebookRequest;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

class ImportCommandController extends CommandController
{
    /**
     * @var \BERGWERK\BwrkFacebookReviews\Domain\Repository\ReviewRepository
     * @inject
     */
    protected $reviewRepository;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     * @inject
     */
    protected $configurationManager;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * @var int
     */
    protected $storagePid = 0;

    /**
     * @var array
     */
    protected $settings = array();

    public function runCommand()
    {
        $this->settings = $this->getSettings();

        $this->storagePid = $this->settings['storagePid'];

        $this->persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');

        $accessToken = $this->settings['facebook.']['accessToken'];
        $pageId = $this->settings['facebook.']['pageId'];
        $graphUrl = 'https://graph.facebook.com/' . $pageId . '/ratings?access_token=' . $accessToken;

        if(empty($pageId) || empty($accessToken))
        {
            echo "No TypoScript configured\r\n";
            return false;
        }
        $this->saveData($graphUrl);
    }

    private function saveData($graphUrl)
    {
        $jsonData = json_decode(file_get_contents($graphUrl));
        $data = $jsonData->data;
        if (count($data) > 0) {
            foreach ($data as $object) {
                $reviewHash = md5($object->created_time . $object->reviewer->id);

                if(!property_exists($object, 'review_text')) $object->review_text = '';

                /** @var Review $reviewByHash */
                $reviewByHash = $this->reviewRepository->findOneByReviewHash($reviewHash);
                if(is_null($reviewByHash))
                {
                    $review = new Review();
                    $review->setPid($this->storagePid);

                    $review->setCreatedTime($object->created_time);
                    $review->setUserId($object->reviewer->id);
                    $review->setUserName($object->reviewer->name);
                    $review->setRating($object->rating);
                    $review->setReviewText($object->review_text);
                    $review->setReviewHash($reviewHash);
                    $review->setHidden(1);

                    $this->reviewRepository->add($review);
                    $this->persistenceManager->persistAll();

                    $this->logger('Inserted Review '.$review->getUserName().' '.$review->getCreatedTime());
                } else {
                    $reviewByHash->setCreatedTime($object->created_time);
                    $reviewByHash->setUserId($object->reviewer->id);
                    $reviewByHash->setUserName($object->reviewer->name);
                    $reviewByHash->setRating($object->rating);
                    $reviewByHash->setReviewText($object->review_text);
                    $reviewByHash->setReviewHash($reviewHash);

                    $this->reviewRepository->update($reviewByHash);
                    $this->persistenceManager->persistAll();

                    $this->logger('Updated Review '.$reviewByHash->getUserName().' '.$reviewByHash->getCreatedTime());
                }
            }
        }
        if(property_exists($jsonData->paging, 'next'))
        {
            $this->saveData($jsonData->paging->next);
        }
    }

    private function logger($msg)
    {
        echo date("d.m.Y H:i").": ".$msg . "\r\n";
    }

    private function getSettings()
    {
        $settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        return $settings['plugin.']['tx_bwrkfacebookreviews.']['settings.'];

    }
}