<?php

/**
 * Class responsible for any request into Itunes menu.
 *
 * Class Rafael_Itunes_adminhtml_ItunesController
 */
class Rafael_Itunes_Adminhtml_ItunesController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
