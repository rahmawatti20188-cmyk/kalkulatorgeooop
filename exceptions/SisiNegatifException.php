<?php
// exceptions/SisiNegatifException.php

class SisiNegatifException extends Exception {
    public function __construct($message = "Dimensi sisi tidak boleh nol atau negatif.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function getCustomErrorMessage() {
        return "Error Validasi Dimensi: " . $this->getMessage();
    }
}