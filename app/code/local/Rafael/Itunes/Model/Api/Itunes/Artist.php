<?php
/**
 * Api class for Itunes service related to Artists queries.
 *
 * User: strubloid
 */ 
class Rafael_Itunes_Model_Api_Itunes_Artist extends Rafael_Itunes_Model_Api_Itunes
{

    /**
     * Method that will format a request for the Itunes API.
     *
     * @param $request
     * @return string
     */
    public function itunesParams($request)
    {
        return http_build_query([
            'term' => $request->getParam('itunes-search'),
            'entity' => 'album',
            'limit' => 20,
        ]);
    }

}