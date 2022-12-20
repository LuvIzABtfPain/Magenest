<?php

namespace Magenest\Movie\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class ConfigObserver implements ObserverInterface
{
    private $request;

    /**
     * ConfigChange constructor.
     * @param RequestInterface $request
     * @param WriterInterface $configWriter
     */
    public function __construct(
        RequestInterface $request,
        WriterInterface $configWriter
    ) {
        $this->request = $request;
        $this->configWriter = $configWriter;

    }

    public function execute(EventObserver $observer)
    {
        $Params = $this->request->getParam('groups');
        $textfield = $Params['general']['fields']['text_field']['value'];
        if($textfield == 'Ping'){
            $textfield = 'Pong';
        }
        $this->configWriter->save('movie/general/text_field', $textfield);
        return $this;
    }
}
