<?php

class Rafael_Itunes_Model_Ajax extends Mage_Core_Model_Abstract
{
    /**
     * Method that will encode to JSON the data.
     *
     * @param $data
     * @return string
     */
    private function _jsonEncode($data)
    {
        return  Mage::helper('core')->jsonEncode($data);
    }

    /**
     * Method that will respond with success value for an ajax call.
     *
     * @param array $return
     * @return string
     */
    public function returnSuccessAjax($return = array())
    {
        $return['success'] = true;

        return $this->_jsonEncode($return);

    }

    /**
     * Method that will respond with failure value for an ajax call.
     *
     * @param string $msg
     * @return string
     */
    public function returnFailureAjax($msg)
    {
        $return['success'] = false;
        $return['msg'] = $msg;

        return $this->_jsonEncode($return);

    }

}