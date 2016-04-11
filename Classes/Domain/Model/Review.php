<?php

namespace BERGWERK\BwrkFacebookReviews\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Review extends AbstractEntity
{
    /**
     * @var string
     */
    protected $createdTime = '';
    /**
     * @var int
     */
    protected $userId = 0;
    /**
     * @var string
     */
    protected $userName = '';
    /**
     * @var float
     */
    protected $rating = 0.0;
    /**
     * @var string
     */
    protected $reviewText = '';

    /**
     * @var string
     */
    protected $reviewHash = '';

    /**
     * @var int
     */
    protected $hidden = 0;

    /**
     * @var int
     */
    protected $deleted = 0;

    /**
     * @return string
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * @param string $createdTime
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getReviewText()
    {
        return $this->reviewText;
    }

    /**
     * @param string $reviewText
     */
    public function setReviewText($reviewText)
    {
        $this->reviewText = $reviewText;
    }

    /**
     * @return string
     */
    public function getReviewHash()
    {
        return $this->reviewHash;
    }

    /**
     * @param string $reviewHash
     */
    public function setReviewHash($reviewHash)
    {
        $this->reviewHash = $reviewHash;
    }

    /**
     * @return int
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * @param int $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * @return int
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param int $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }


}