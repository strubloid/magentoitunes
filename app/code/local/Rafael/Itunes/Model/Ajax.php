<?php

class Rafael_Itunes_Model_Ajax extends Varien_Object
{

    public $response = null;

    /**
     * Loading the response variable from a controller
     * when we start this object.
     *
     * Rafael_Itunes_Model_Ajax constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }


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
     * Method that will return a success value with encoded data.
     *
     * @param array $return
     * @return string
     */
    public function successWithData($return = array())
    {
        $return['success'] = true;

        $this->response->setBody($this->_jsonEncode($return));
    }

    /**
     * Method that will respond with success value for an ajax call.
     *
     * @param string $msg
     * @return string
     */
    public function success($msg)
    {
        $return['success'] = true;
        $return['msg'] = "<ul class='messages'><li class='success-msg'><ul><li><span>{$msg}</span></li></ul></li></ul>";

        $this->response->setBody($this->_jsonEncode($return));
    }

    /**
     * @param $msg
     * @return string
     */
    public function notice($msg)
    {
        $return['success'] = false;
        $return['notice'] = true;
        $return['msg'] = "<ul class='messages'><li class='notice-msg'><ul><li><span>{$msg}</span></li></ul></li></ul>";

        $this->response->setBody($this->_jsonEncode($return));
    }

    /**
     * Method that will respond with failure value for an ajax call.
     *
     * @param string $msg
     * @return string
     */
    public function failure($msg)
    {
        $return['success'] = false;
        $return['failure'] = true;
        $return['msg'] = "<ul class='messages'><li class='error-msg'><ul><li><span>{$msg}</span></li></ul></li></ul>";

        $this->response->setHeader('HTTP/1.0','400',true)->setBody($this->_jsonEncode($return));
    }

}