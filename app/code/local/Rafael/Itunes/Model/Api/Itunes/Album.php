<?php
/**
 * Api class for Itunes service related to Album queries.
 *
 * Class Rafael_Itunes_Model_Api_Itunes_Album
 */
class Rafael_Itunes_Model_Api_Itunes_Album extends Rafael_Itunes_Model_Api_Itunes
{
    /**
     * Method that will format a request for the Itunes API.
     *
     * @param $request
     * @return string
     */
    public function itunesParams($request)
    {
        return array(
            'term' => $request->getParam('itunes-search'),
            'entity' => 'album',
        );
    }

    /**
     * Making sure that the artist will be the same as requested from the search box.
     *
     * @param $output
     * @param $request
     * @return mixed
     */
    public function filterResult($output, $request)
    {
        $output = parent::filterResult($output);

        $results = $output['results'];

        foreach ($results as $index => $result)
        {
            if(strtolower($result['artistName']) != strtolower($this->requestSearchParam($request))){
                unset($output['results'][$index]);
                $output['resultCount']--;
            }
        }

        // TODO: throw an exception if cant find results

        return $output;
    }



}