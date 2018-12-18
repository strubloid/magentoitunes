<?php
/**
 * Resource model for the table Itunes_Artist.
 *
 * Class Rafael_Itunes_Model_Resource_Artist
 */
class Rafael_Itunes_Model_Resource_Artist extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/artist', 'id');
    }

}