<?php

namespace BERGWERK\BwrkFacebookReviews\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ViewController extends ActionController
{
    /**
     * @var \BERGWERK\BwrkFacebookReviews\Domain\Repository\ReviewRepository
     * @inject
     */
    protected $reviewRepository;

    public function indexAction()
    {
        $reviews = $this->reviewRepository->findAll();

        $this->view->assign('reviews', $reviews);
    }
}