<?php

namespace Magenest\Movie\Block;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as CollectionMovieFactory;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as CollectionActorFactory;
use Magento\Framework\View\Element\Template;

class MovieList extends Template
{
    protected $moviesFactory;
    protected $actorsFactory;

    public function __construct(
        Template\Context  $context,
        CollectionMovieFactory $moviesFactory,
        CollectionActorFactory $actorsFactory
    )
    {
        $this->moviesFactory = $moviesFactory;
        $this->actorsFactory = $actorsFactory;
        parent::__construct($context);
    }

    public function getMovie()
    {
        $movie = $this->moviesFactory->create()->joinTable();
        return $movie;
    }

    public function getActorByMovie($movieId)
    {
        $actor = $this->actorsFactory->create()->allActors($movieId);
        return implode(', ', $actor->getColumnValues('name'));
    }
}
