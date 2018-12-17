<?php

abstract class Rafael_Itunes_Model_Api extends Mage_Core_Model_Abstract
{

    abstract function getAPiUrl();

    abstract function buildSearchParams($request);

    abstract function search($params);

}