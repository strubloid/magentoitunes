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
     * @return mixed
     */
    public function loadIndexTracks($request)
    {
        // loading the collection
        $collection = $this->getCollection();

        if($sort = $request->getParam('sort'))
        {
            $collection->setOrder(key($sort), $sort[key($sort)]);
        }

        // loading the collection
        return $collection->setPageSize(20)->setCurPage(1);
    }

}