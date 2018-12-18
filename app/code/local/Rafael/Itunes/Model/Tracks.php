<?php
/**
 * Model class of Itunes Track.
 * User: strubloid
 */ 
class Rafael_Itunes_Model_Tracks extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/tracks');
    }

    /**
     * Method that will load the first 20 items from tracks collection.
     *
     * @param $request
     * @param int $quantity
     * @param int $page
     * @return object|Rafael_Itunes_Model_Resource_Tracks_Collection
     * @throws Mage_Core_Exception
     */
    public function loadIndexTracks($request, $quantity = 10, $page =1)
    {
        // loading the collection
        $collection = $this->getCollection();

        if($sort = $request->getParam('sort'))
        {
            $collection->setOrder(key($sort), $sort[key($sort)]);
        }

        // loading the collection
        $collection->setPageSize($quantity)->setCurPage($page);

        // Checking if the collection it's empty
        if($collection->count() <= 0){
            throw Mage::exception('Rafael_Itunes_Exception_NoResultsMagentoDatabase');
        }
        return $collection;
    }

    /**
     * Method that will create a data array to insert or
     * update data.
     *
     * @param $data
     * @return array
     */
    private function _buildData($data)
    {
        return array(
            'itunes_trackId' => $data['collectionId'],
            'itunes_artistname' => $data['artistName'],
            'itunes_currency' => $data['currency'],
            'itunes_albumname' => $data['collectionName'],
            'itunes_trackname' => $data['trackName'],
            'itunes_trackprice' => $data['trackPrice'],
            'itunes_image_60' => $data['artworkUrl60'],
            'itunes_image_100' => $data['artworkUrl100'],
        );
    }

    /**
     * Method that will persist a data into a Itunes Tracks table.
     *
     * @param $data
     */
    public function persistData($data)
    {
        try
        {
            $data = $this->_buildData($data);

            // searching for the id into magento system
            $trackObject = $this->load($data['itunes_trackId'], 'itunes_trackId');

            // checking if it will update or create a new record on it
            if($id = $trackObject->getId()){
                $this->load($id)->addData($data)->setId($id)->save();
            } else {
                $this->setData($data)->save();
            }

        } catch (Exception $exception) {

            Mage::log($exception->getMessage(), null. 'track-itunes-logs.log', true);

        }
    }

    /**
     * Method that it is being used to format the itunes_trackprice.
     *
     * @param array $arrAttributes
     * @return array
     */
    public function toArray(array $arrAttributes = array())
    {
        // loading the father to array
        $array = parent::toArray($arrAttributes);

        // formatting the track price
        $array['itunes_trackprice'] = Mage::helper('core')->currency($array['itunes_trackprice'], true, false);

        return $array;
    }

}