<?php
namespace Magenest\Movie\Block\Adminhtml;

class Actor extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_';
        $this->_blockGroup = 'Magenest_Movie';
        $this->_headerText = __('Actors');
        $this->_addButtonLabel = __('Add new actor');
        parent::_construct();
    }
}
