<?php
/**
 * Resource model for the table Itunes_Album.
 *
 * Class Rafael_Itunes_Model_Resource_Album
 */
class Rafael_Itunes_Model_Resource_Album extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/album', 'collectionId');
    }

}