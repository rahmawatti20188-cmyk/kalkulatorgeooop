<?php
// interfaces/ErrorHandler.php

interface ErrorHandler {
    public function handleError(Exception $e);
}