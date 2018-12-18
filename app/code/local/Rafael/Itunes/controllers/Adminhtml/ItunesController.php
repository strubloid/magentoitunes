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
        $this->_ajax = new Rafael_Itunes_Model_Ajax($this->getResponse());

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
        try
            {
                $tracksObj =  Mage::getModel('rafael_itunes/tracks');

                // loading tracks
                $tracksCollection = $tracksObj->loadTracks($this->getRequest());

                // setting a response for a ajax call
                $this->_ajax->successWithData($tracksCollection);

       } catch (Rafael_Itunes_Exception_NoResultsMagentoDatabase_Exception $exception) {

            $this->_ajax->failure($exception->getMessage());

        } catch (Exception $exception) {

            // log of the unexpected exception in the frontend
            $this->_ajax->failure('Check the log file itunes-logs.log');

            // saving the log error on itunes-logs.log
            Mage::log($exception->getMessage(), null. 'itunes-logs.log', true);
        }
    }

    /**
     * Method that will search for an artist into Itunes API.
     *
     */
    public function searchAction()
    {
        try
        {
            $artistModel = Mage::getModel('rafael_itunes/artist');
            $request = $this->getRequest();

            if($artist = $artistModel->find($request))
            {
                // searching for a track into Itunes API
                $trackCollection = Mage::getModel('rafael_itunes/api_itunes_track')->search($request, $artist->getData('artistId'));

                $processedTracks = 0;
                foreach($trackCollection['results'] as $track)
                {
                    try
                    {
                        $action = Mage::getModel('rafael_itunes/track')->persistData($track);
                        $processedTracks++;

                    } catch (Rafael_Itunes_Exception_CantCreateTrack_Exception $exception) {

                        Mage::log($exception->getMessage(), null . 'itunes_album.log', true);

                    }
                }

                $this->_ajax->success("Created/Updated {$processedTracks} Track(s)");

            } else { // search by itunes-search on Itunes API

                $albumCollection = Mage::getModel('rafael_itunes/api_itunes_album')->search($request);

                // creating a new artist by the album collection data
                Mage::getModel('rafael_itunes/artist')->createArtist($albumCollection);

                // creating all albums
                $processedAlbums = 0;
                foreach($albumCollection['results'] as $album)
                {
                    try
                    {

                        Mage::getModel('rafael_itunes/album')->createAlbum($album);
                        $processedAlbums++;

                    } catch (Rafael_Itunes_Exception_CantCreateAlbum_Exception $exception) {

                        Mage::log($exception->getMessage(), null. 'itunes_album.log', true);

                    }
                }

                $this->_ajax->success("Created {$processedAlbums} Album(s)");
            }

        } catch (Rafael_Itunes_Exception_NoResultsFromApi_Exception $exception) {

            $this->_ajax->failure($exception->getMessage());

        }catch (Rafael_Itunes_Exception_CantCreateArtist_Exception $exception) {

            $this->_ajax->failure($exception->getMessage());
            Mage::log($exception->getMessage(), null. 'itunes_artist.log', true);

        }  catch (Exception $exception) {

            // log of the unexpected exception in the frontend
            $this->_ajax->failure('Check the log file itunes-logs.log');

            // saving the log error on itunes-logs.log
            Mage::log($exception->getMessage(), null. 'itunes-logs.log', true);

        }

    }
}
