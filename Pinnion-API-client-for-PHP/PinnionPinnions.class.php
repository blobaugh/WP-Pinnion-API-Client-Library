<?php

/**
 * Client for the 'pinnions' grouping of the Pinnion API
 *
 * @link eventually this will link to docs
 */
class PinnionPinnions extends PinnionApiRequest {
    
    
    /**
     * Retrieves a listing of all pinnions belonging to a user
     * 
     * @todo Implement filter as a parameter
     * @return Array 
     */
    public function listPinnions() {
        $response = $this->get( PINNION_API_URL . PINNION_ENDPOINT_PINNION);
        return $response->getResponse();
    }
} // end class