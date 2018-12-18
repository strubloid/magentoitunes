<?php
/**
 * Api class for Itunes service related to Tracks of the Album.
 *
 * Class Rafael_Itunes_Model_Api_Itunes_Track
 */
class Rafael_Itunes_Model_Api_Itunes_Track extends Rafael_Itunes_Model_Api_Itunes
{
    public $searchType = 'lookup';

    /**
     * Method that will format a request for the Itunes API.
     *
     * @param $request
     * @param null $extraParams
     * @return array|string
     */
    public function itunesParams($request, $extraParams = null)
    {
        return array(
            'id' => $extraParams,
            'entity' => 'song',
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
            if(!array_key_exists('trackId', $result)){
                unset($output['results'][$index]);
                $output['resultCount']--;
            }
        }

        return $output;
    }
}