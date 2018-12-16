<?php

/**
 * Class responsible for any request into Itunes menu.
 *
 * Class Rafael_Itunes_adminhtml_ItunesController
 */
class Rafael_Itunes_Adminhtml_ItunesController extends Mage_Adminhtml_Controller_Action
{
    protected $_ajax = null;

    /**
     * Overriding to build a few important things for this class.
     *
     * @return $this|Mage_Adminhtml_Controller_Action
     */
    public function preDispatch()
    {
        // loading things from the parent class
        parent::preDispatch();

        // loading the ajax object for each type or ajax response.
        $this->_ajax = Mage::getModel('rafael_itunes/ajax');

        return $this;
    }


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

        // this will build the ajax success call for the tracks load
        $reponse = $this->_ajax->returnSuccessAjax($mainCollection->toArray());

        // setting a response for a ajax call
        $this->getResponse()->setBody($reponse);
    }

    public function searchArtistAction()
    {
        try
        {

            // loading the api object
            $apiItunes = Mage::getModel('rafael_itunes/api_itunes');


            $searchParams = $apiItunes->buildSearchParams($this->getRequest());

            // searching for the artist data on the Itunes API
            $results = $apiItunes->search($searchParams);


            // add search result data


            $a =1;




        } catch (Rafael_Itunes_Exception_MissingSearchParam_Exception $exception) {

            $reponse = $this->_ajax->returnFailureAjax($exception->getMessage());

            $this->getResponse()->setBody($reponse);

            $a =1;

        } catch (Exception $exception) {

            Mage::log($exception->getMessage(), null. 'itunes-logs.log', true);

        }

    }


}
