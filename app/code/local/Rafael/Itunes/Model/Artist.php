<?php
/**
 * Entity class for Itunes_Artist Table.
 *
 * Class Rafael_Itunes_Model_Artist
 */
class Rafael_Itunes_Model_Artist extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/artist');
    }

    /**
     * Method that will try to find an artist by the request param itunes-search.
     *
     * @param $request
     * @return bool|Mage_Core_Model_Abstract
     */
    public function find($request)
    {
        // trying to load the artist by the artistName
        $artist = $this->load($request->getParam('itunes-search'), 'artistName');

        return $artist->hasData() ? $artist : false;
    }

    /**
     * Method that will create an artist.
     *
     * @param $albumCollectionArray
     * @throws Mage_Core_Exception
     */
    public function createArtist($albumCollectionArray)
    {
        try
        {
            // loading the first result of the $albumCollection
            $albumInstance = current($albumCollectionArray['results']);

            // setting the data
            $this->setData(array(
                'artistId' => $albumInstance['artistId'],
                'artistName' => $albumInstance['artistName'],
            ));

            $this->save();

        } catch (Exception $exception) {

            throw Mage::exception('Rafael_Itunes_Exception_CantCreateAlbum', $albumInstance['artistName']);

        }

    }

}