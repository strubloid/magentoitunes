<?php
/**
 * Resource model for the table Itunes_Track.
 *
 * Class Rafael_Itunes_Model_Resource_Track
 */
class Rafael_Itunes_Model_Resource_Track extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/track', 'id');
    }

}