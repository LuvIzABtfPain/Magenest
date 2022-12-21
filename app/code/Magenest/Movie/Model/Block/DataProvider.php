<?php

namespace Magenest\Movie\Model\Block;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magenest\Movie\Model\ResourceModel\MovieActor\CollectionFactory as MovieActorFactory;

class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{

    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    protected $movieActorCollection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $movieCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $movieCollectionFactory,
        MovieActorFactory $movieActorCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $movieCollectionFactory->create();
        $this->movieActorCollection = $movieActorCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $movie) {
            $actors = $this->movieActorCollection->addFieldtoSelect('actor_id')->addFieldtoFilter('movie_id', $movie->getId());
            $actors_id = [];
                foreach($actors as $actor){
                    array_push($actors_id, $actor->getActor_id());
            }

            $this->loadedData[$movie->getId()] = [
                ...$movie->getData(),
                'actor_id' => $actors_id
            ];
        }

        $data = $this->dataPersistor->get('magenest_movie');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('magenest_movie');
        }

        return $this->loadedData;
    }
}
