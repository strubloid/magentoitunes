<?php
/**
 * Collection class of Itunes Track.
 * User: strubloid
 */
class Rafael_Itunes_Model_Resource_Tracks_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/tracks');
    }

    /**
     * Reqrite of the toArray function to work with jquery.bootgrid.js
     *
     * @param array $arrRequiredFields
     * @return array
     */
    public function toArray($arrRequiredFields = array())
    {
        $arrItems = array();
        $arrItems['total'] = $this->getSize();

        $arrItems['rows'] = array();
        foreach ($this as $item) {
            $arrItems['rows'][] = $item->toArray($arrRequiredFields);
        }
        return $arrItems;
    }

}