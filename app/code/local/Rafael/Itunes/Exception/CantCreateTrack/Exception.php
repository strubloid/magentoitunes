<?php
/**
 * Exception that will be thrown if something happens during the creation of a Track.
 *
 * Class Rafael_Itunes_Exception_CantCreateTrack_Exception
 */
class Rafael_Itunes_Exception_CantCreateTrack_Exception extends Mage_Core_Exception
{
    /**
     * Rewriting constructor to be able to set a message for this exception.
     *
     * Rafael_Itunes_Exception_MissingSearchParam_Exception constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setMessage("Couldn't create track {$message}");
    }


}