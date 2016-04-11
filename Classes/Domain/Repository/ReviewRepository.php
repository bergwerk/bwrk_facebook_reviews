<?php
namespace BERGWERK\BwrkFacebookReviews\Domain\Repository;
ini_set('display_errors', 1);

use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class ReviewRepository extends Repository
{
    public function findOneByReviewHash($reviewHash)
    {
        /** @var QuerySettingsInterface $querySettings */
        $query = $this->createQuery();

        $querySettings = $query->getQuerySettings();
        $querySettings->setIgnoreEnableFields(true);
        $querySettings->setIncludeDeleted(true);
        $this->setDefaultQuerySettings($querySettings);

        $query->matching(
            $query->equals('review_hash', $reviewHash)
        );
        return $query->execute()[0];
    }
}