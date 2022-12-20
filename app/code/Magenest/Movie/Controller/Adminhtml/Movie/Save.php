<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magenest\Movie\Model\MovieFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Event\ManagerInterface;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    private $movieFactory;
    protected $_resource;
    protected $eventManager;
    public function __construct(
        Action\Context $context,
        ResourceConnection $resource,
        ManagerInterface $eventManager,
        MovieFactory $movieFactory = null,
    ) {
        $this->movieFactory = $movieFactory ?: ObjectManager::getInstance()->get(movieFactory::class);
        $this->_resource = $resource;
        $this->eventManager = $eventManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (empty($data['movie_id'])) {
                $data['movie_id'] = null;
            }

            $model = $this->movieFactory->create();
            $id = $this->getRequest()->getParam('movie_id');
            if($id){

            } else {
                $postdata = [
                'description' => $data['description'],
                'name' => $data['name'],
                'director_id' => $data['director_id'],
                ];
                $model->setData($postdata);
                $idsave = $model->save()->getId();
                $connection  = $this->_resource->getConnection();
                $actors = $data['actor_id'];
                foreach($actors as $actor) {
                    $datafrk[] = [
                        'movie_id' => $idsave,
                        'actor_id' => $actor,
                    ];
                }
                $connection->insertMultiple('magenest_movie_actor', $datafrk);
            }
        }
        $this->eventManager->dispatch(
            'save_a_movie',
            [
                'movie_data' => $model,
            ]
        );
        return $resultRedirect->setPath('grid/grid/movie');
    }
}
