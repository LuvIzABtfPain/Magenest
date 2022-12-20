<?php

namespace Magenest\Movie\Model\ResourceModel\Actor;

use Magenest\Movie\Model\ResourceModel\Actor;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'actor_id';

    protected function _construct()
    {
        $this->_init(\Magenest\Movie\Model\Actor::class, Actor::class);
    }
    public function allActors($movieId)
    {
        //select * from actors as a join movie_actor as b on (movie_id = $movie_id and a.actor_id = b.actor_id)
        $actorMovieTable = $this->getTable('magenest_movie_actor');
        $result = $this->join(
            ['mma' => $actorMovieTable],
            'main_table.actor_id = mma.actor_id',
            []
        )
            ->addFieldToSelect('name')->addFieldToFilter('mma.movie_id', $movieId);
        return $result;
    }
    public function getOptionSelect()
    {
        return $this->_toOptionArray();
    }
}
