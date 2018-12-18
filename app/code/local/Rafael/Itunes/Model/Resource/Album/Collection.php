<?php
/**
 * Collection class for the table Itunes_Album.
 *
 * Class Rafael_Itunes_Model_Resource_Album_Collection
 */
class Rafael_Itunes_Model_Resource_Album_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/album');
    }

}