<?php

namespace Magenest\Knockout\Block\Adminhtml\Blocks\Edit\Tab;

class ColorRenderer extends \Magento\Framework\View\Element\AbstractBlock
{
    protected function _toHtml()
    {
        $html = '<input type="text" name="' . $this->getInputName() . '" id="' . $this->getInputId() . '" ';
        $html .= '<script type="text/javascript">
                require(["jquery","jquery/colorpicker/js/colorpicker"], function ($) {
                    $(document).ready(function () {
                        var $el = $("#'.$this->getInputId().'");
                        var $hex = $el.val();
                        $el.css("backgroundColor", $hex);
                        // Attach the color picker
                        $el.ColorPicker({
                            onChange: function (hsb, hex, rgb) {
                                $el.css("backgroundColor", "#" + hex).val("#" + hex);
                            }
                        });
                    });
                });
                </script>';

        return $html;
    }
}
