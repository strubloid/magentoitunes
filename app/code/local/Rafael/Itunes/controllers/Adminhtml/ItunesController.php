<?php

/**
 * Class responsible for any request into Itunes menu.
 *
 * Class Rafael_Itunes_adminhtml_ItunesController
 */
class Rafael_Itunes_Adminhtml_ItunesController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Main action to load the index page.
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Method that will load the main tracks.
     *
     * @return mixed
     */
    public function loadTracksAction()
    {
        // loading the main collection
        $mainCollection = Mage::getModel('rafael_itunes/tracks')->loadIndexTracks($this->getRequest());

        $encode = Mage::helper('core')->jsonEncode($mainCollection);

        // setting a response for a ajax call
        $this->getResponse()->setBody($encode);
    }

}
