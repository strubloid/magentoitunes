<?php
/**
 * Block class responsible for the tracks screen.
 * User: strubloid
 */
class Rafael_Itunes_Block_Adminhtml_Tracks extends Mage_Core_Block_Template
{
    /**
     * Method that will load the admin session object and return who is
     * the logged user in the backend.
     *
     * @return mixed
     */
    public function getAdminUsername()
    {
        return Mage::getSingleton('admin/session')->getUser()->getUsername();
    }

    /**
     * Method that will check what is the main phrase for the text filed of the tracks.
     */
    public function getMainPhrase()
    {
        return Mage::getStoreConfig('rafael/configurations/main_text');
    }

}