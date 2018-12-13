<?php
/**
 * Created by PhpStorm.
 * User: strubloid
 * Date: 13/12/18
 * Time: 20:39
 */ 
class Rafael_Itunes_Model_Resource_Tracks_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/tracks');
    }

}