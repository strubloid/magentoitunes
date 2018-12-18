<?php
/**
 * Abstract class for the API collection from Itunes.
 *
 * Class Rafael_Itunes_Model_Api_Itunes
 */
abstract class Rafael_Itunes_Model_Api_Itunes extends Rafael_Itunes_Model_Api
{
    /**
     * Method that will return the Itunes API URL.
     *
     * @return string
     */
    public function getAPiUrl()
    {
        return 'https://itunes.apple.com';
    }

    /**
     * Method that will get the main search param from the itunes->tracks.
     *
     * @param $request
     * @return mixed
     */
    public function searchParam()
    {
        return 'itunes-search';
    }

    /**
     * Method that will get the main search param from the itunes->tracks.
     *
     * @param $request
     * @return mixed
     */
    public function requestSearchParam($request)
    {
        return $request->getParam($this->searchParam());
    }

    /**
     * Method that will format a request for the Itunes API.
     *
     * @param $request
     * @param null $extraParams
     * @return array
     */
    public function itunesParams($request, $extraParams = null)
    {
        return array(
            'term' => $this->requestSearchParam(),
        );
    }

    /**
     * Method that will search into the Itunes API.
     *
     * @param $request
     * @return bool|mixed|string
     * @throws Mage_Core_Exception
     */
    public function search($request, $extraParams = null)
    {
        $handle = curl_init();

        // building the url
        $url = "{$this->getAPiUrl()}/{$this->buildSearchParams($request, $extraParams)}";

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

        // this might have a filter or will be using the function from the abstract class
        $output = $this->filterResult($output, $request);

        return $output;
    }

}