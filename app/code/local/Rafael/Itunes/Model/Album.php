<?php
/**
 * Entity class for Itunes_Album Table.
 *
 * Class Rafael_Itunes_Model_Artist
 */
class Rafael_Itunes_Model_Album extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/album');
    }

    /**
     * Method that will create a new album instance on Itunes_Album
     *
     * @param $album
     * @throws Mage_Core_Exception
     */
    public function createAlbum($album)
    {
        try
        {
            // setting the data
            $this->setData(array(
                "collectionId" => $album['collectionId'],
                "collectionName" => $album['collectionName'],
                "artworkUrl100" => $album['artworkUrl100'],
                "currency" => $album['currency'],
                "collectionPrice" => $album['collectionPrice'],
                "trackCount" => $album['trackCount'],
                "artistId" => $album['artistId'],
            ));

            $this->save();

        } catch (Exception $exception) {

            throw Mage::exception('Rafael_Itunes_Exception_CantCreateArtist', $album['collectionName']);

        }

    }

}