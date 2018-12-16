<?php
/**
 * Api class for Itunes service.
 *
 * User: strubloid
 */ 
class Rafael_Itunes_Model_Api_Itunes extends Rafael_Itunes_Model_Api
{

    public function getAPiUrl()
    {
        return 'https://itunes.apple.com';
    }

    public function getAPISearch()
    {
        return ;
    }

    /**
     * Method that will build the search params.
     *
     * @param $request
     * @return string
     * @throws Mage_Core_Exception
     */
    function buildSearchParams($request)
    {
        if(!$request->has('itunes-search') || empty($request->getParam('itunes-search'))){
            throw Mage::exception('Rafael_Itunes_Exception_MissingSearchParam');
        }

        return http_build_query(['term' => $request->getParam('itunes-search')]);
    }

    /**
     * Method that will search into the Itunes API.
     *
     * @param $params
     * @return mixed
     */
    public function search($params)
    {

        $handle = curl_init();

        // building the url
        $url = "{$this->getAPiUrl()}/search?{$params}";

        // set of the url
        curl_setopt($handle, CURLOPT_URL, $url);

        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        // getting the response from the CURL
        if($output = curl_exec($handle))
        {
            $output = json_decode($output, true);
        }

        curl_close($handle);

        return $output;
    }


}