<?php
/**
 * Collection class for the table Itunes_Track.
 *
 * Class Rafael_Itunes_Model_Resource_Track_Collection
 */
class Rafael_Itunes_Model_Resource_Track_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/tracks');
    }

}