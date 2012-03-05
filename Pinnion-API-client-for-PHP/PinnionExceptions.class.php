<?php
/**
 * Contains all of the exceptions for the Pinnion API Client
 */



/**
 * Used when invalid parameters are passed to the API 
 */
class PinnionInvalidParametersException extends Exception {
    // Redefine the exception so message isn't optional
    public function __construct( $RequiredParameters ) {
        // some code
        $message = "<p><b>A required parameter was not found.</b> Please view the list of parameters: " . implode(", ", $RequiredParameters) . "</p>";
        // make sure everything is assigned properly
        parent::__construct( $message, E_USER_ERROR, null );
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}

// 400 Bad request when there was a problem with the request
class PinnionBadRequestException extends Exception {
    // Redefine the exception so message isn't optional
    public function __construct($Url, $Response) {
        // some code
        $message = "<p><b>400 HTTP Error:</b> Error bad request to $Url<br/>Details: {$Response['details']}<br/>Problem: {$Response['problem']}</p>";

        // make sure everything is assigned properly
        parent::__construct($message, E_USER_ERROR, null);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}

// 401
class PinnionUnauthorizedRequestException extends Exception {
    // Redefine the exception so message isn't optional
    public function __construct() {
        // some code
        $message = "<p><b>401 HTTP Error:</b> Error not authorized. Please check your Pinnion API credentials</p>";

        // make sure everything is assigned properly
        parent::__construct($message, E_USER_ERROR, null);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}

// 500
class PinnionInternalServerErrorException extends Exception {
    // Redefine the exception so message isn't optional
    public function __construct() {
        // some code
        $message = "<p><b>500 HTTP Error:</b> Internal server error. The Pinnion servers are currently experiencing difficulty</p>";

        // make sure everything is assigned properly
        parent::__construct($message, E_USER_ERROR, null);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}