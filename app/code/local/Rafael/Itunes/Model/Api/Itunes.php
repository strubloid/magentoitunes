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

    /**
     * Method that will format a request for the Itunes API.
     *
     * @param $request
     * @return string
     */
    public function itunesParams($request)
    {
        return http_build_query(['term' => $request->getParam('itunes-search'), 'limit' => 2]);
    }

    /**
     * Method that will search into the Itunes API.
     *
     * @param $params
     * @return bool|mixed|string
     * @throws Mage_Core_Exception
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

        if($output['resultCount'] <= 0)
        {
            throw Mage::exception('Rafael_Itunes_Exception_NoResultsFromApi');
        }

        return $output;
    }

}