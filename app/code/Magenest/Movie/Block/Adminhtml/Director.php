<?php
namespace Magenest\Movie\Block\Adminhtml;

class Director extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_';
        $this->_blockGroup = 'Magenest_Movie';
        $this->_headerText = __('Director');
        $this->_addButtonLabel = __('Add new Director');
        parent::_construct();
    }
}
