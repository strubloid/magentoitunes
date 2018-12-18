<?php

abstract class Rafael_Itunes_Model_Api extends Mage_Core_Model_Abstract
{

    public abstract function getAPiUrl();

    public abstract function itunesParams($request);

    public function requestSearchParam($request)
    {
        return $request->getParam('itunes-search');
    }

    public function buildSearchParams($request)
    {
        if(!$request->has('itunes-search') || empty($request->getParam('itunes-search'))){
            throw Mage::exception('Rafael_Itunes_Exception_MissingSearchParam');
        }

        return http_build_query($this->itunesParams($request));
    }

    public abstract function search($request);

    public function filterResult($output, $request)
    {
        return $output;
    }

}