<?php
// exceptions/DimensiTidakLengkapException.php

class DimensiTidakLengkapException extends Exception {
    public function __construct($message = "Input dimensi tidak lengkap untuk bangun ini.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Metode kustom untuk pesan error yang lebih spesifik.
     * @return string
     */
    public function getCustomErrorMessage() {
        return "Error Dimensi Input: " . $this->getMessage();
    }
}