<?php
/**
 * Abstract class to create the idea of connect with API's.
 *
 * Class Rafael_Itunes_Model_Api
 */
abstract class Rafael_Itunes_Model_Api extends Mage_Core_Model_Abstract
{
    public $searchType = 'search';

    public abstract function getAPiUrl();
    public abstract function itunesParams($request, $extraParams = null);
    public abstract function search($request);
    public abstract function searchParam();
    public abstract function requestSearchParam($request);

    /**
     * Method that will build search params.
     *
     * @param $request
     * @param null $extraParams
     * @return string
     * @throws Mage_Core_Exception
     */
    public function buildSearchParams($request, $extraParams = null)
    {
        if(!$request->has($this->searchParam()) || empty($request->getParam($this->searchParam()))){
            throw Mage::exception('Rafael_Itunes_Exception_MissingSearchParam');
        }

        // building params
        $params = http_build_query($this->itunesParams($request, $extraParams));

        return "{$this->searchType}?{$params}";
    }

    /**
     * Method that will be possible filter the result.
     *
     * @param $output
     * @param $request
     * @return mixed
     */
    public function filterResult($output, $request)
    {
        return $output;
    }

}