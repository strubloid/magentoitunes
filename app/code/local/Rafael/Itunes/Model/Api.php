<?php

abstract class Rafael_Itunes_Model_Api extends Mage_Core_Model_Abstract
{

    public abstract function getAPiUrl();

    public abstract function itunesParams($request);

    public function buildSearchParams($request)
    {
        if(!$request->has('itunes-search') || empty($request->getParam('itunes-search'))){
            throw Mage::exception('Rafael_Itunes_Exception_MissingSearchParam');
        }

        return $this->itunesParams($request);
    }

    public abstract function search($params);

}