<?php
/**
 * Exception that will be thrown if the user remove javascript and try to send a request
 * without param itunes-search from the request.
 *
 * Class Rafael_Itunes_Exception_MissingSearchParam_Exception
 */
class Rafael_Itunes_Exception_MissingSearchParam_Exception extends Mage_Core_Exception
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
        $this->setMessage('You must type something, dont forget about it!');
    }


}