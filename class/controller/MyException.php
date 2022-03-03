<?php
class MyException extends Exception {
    public $codigo;
    /**
     * {@inheritDoc}
     * @see Exception::__construct()
     */
    public function __construct( $codigo, $message = null, $code = null, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->codigo=$codigo;
        // TODO Auto-generated method stub
        
    }

}

