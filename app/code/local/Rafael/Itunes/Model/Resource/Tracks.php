<?php
/**
 * Resource model class of Itunes Track.
 * User: strubloid
 */
class Rafael_Itunes_Model_Resource_Tracks extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/tracks', 'itunes_trackid');
    }

}