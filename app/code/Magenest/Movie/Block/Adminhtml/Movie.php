<?php
namespace Magenest\Movie\Block\Adminhtml;

class Movie extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_';
        $this->_blockGroup = 'Magenest_Movie';
        $this->_headerText = __('Movie');
        $this->_addButtonLabel = __('Add new Movie');
        parent::_construct();
    }
}
