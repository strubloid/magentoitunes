<?php

abstract class Rafael_Itunes_Model_Api extends Mage_Core_Model_Abstract
{
    public $searchType = 'search';

    public abstract function getAPiUrl();

    public abstract function itunesParams($request, $extraParams = null);

    public function requestSearchParam($request)
    {
        return $request->getParam('itunes-search');
    }

    public function buildSearchParams($request, $extraParams = null)
    {
        if(!$request->has('itunes-search') || empty($request->getParam('itunes-search'))){
            throw Mage::exception('Rafael_Itunes_Exception_MissingSearchParam');
        }

        // building params
        $params = http_build_query($this->itunesParams($request, $extraParams));

        return "{$this->searchType}?{$params}";
    }

    public abstract function search($request);

    public function filterResult($output, $request)
    {
        return $output;
    }

}