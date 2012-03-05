# Pinnion API client for PHP
"Pinnion (http://pinnion.com) is a secure way to interact with your audience through Q&A-based communication featuring the most free questions and responses for your surveys, quizzes, and polls. You can send Pinnions out through email or Twitter and we’re the only provider that offers apps for iPhone/iPad, Android, and Windows Phone 7, along with a WordPress plug‐in.

Simply put, Pinnion is the only online provider that offers free surveys, free online polls, and audience response capabilities for WordPress, iPhone/iPad, and Android."
- From http://www.pinnion.com/what-is-pinnion/

This set of libraries allows developers to quickly and easily tap into the Pinnion API resources.



*NOTE:* This project currently only supports GET requests to the Pinnion API

## Supported endpoints


# Documentation
Full documentation can be found on the Github project wiki at https://github.com/blobaugh/Pinnion-API-client-for-PHP/wiki 

# How to setup the library
- Download the files from Github and place them in the PHP application directory
- * I.E. /var/www/myapp/Pinnion-API-client-for-PHP
- Include the Pinnion.php file in your application
- * I.E. In /var/www/myapp/index.php
- * Use require_once('Pinnion-API-client-for-PHP/Pinnion.php');
- Edit Pinnion.php and set your Pinnion API credentials 
- Begin using the new Pinnion functionality in your application!

# Using the pre-built endpoint classes
The Pinnion API client for PHP allows developers to make direct calls to the Pinnion API, however for convenience several helper classes have been created.
Each class corresponds directly to a grouping of endpoints from the Pinnion API documentation.

Example: Listing all Pinnions

$p = new PinnionPinnions( 'username', 'password' );
$pinnions = $p->listPinnions();

$pinnions will be in the form of an associative array


# Direct queries to the Pinnion API
The Pinnion API client for PHP supports direct API queries  if a helper class is not available.
Queries are sent to the PinnionApiRequest class and data recieved from the Pinnion API will be returned in the PinnionApiResponse class.
The PinnionApiResponse object will contain the HTTP code and API response. To use the PinnionApiReponse class a developer simply calls the query method with an endpoint and parameters.

Example: Accessing all Pinnions

$p = new PinnionApiRequest();
$pinnions = $p->get( PINNION_API_URL . PINNION_ENDPOINT_PINNION );

$pinnions will be a PinnionApiResponse object that can be access like an array (E.G. $pinnions['results']) or used in a loop to view each event entry (E.G. foreach( $pinnions AS $pinnion ) )
The HTTP response code can be checked with $pinnions->getHttpCode()

# Exceptions
Exceptions will usually occur when an invalid API request is recieved. The following is a list of all the Pinnion API client for PHP specific exceptions

- PinnionInvalidParametersException - Invalid or missing parameters passed to the API endpoint
- PinnionBadRequestException - Problem with the request
- PinnionUnauthorizedRequestException - Invalid API authorization
- PinnionInternalServerErrorException - Problem exists with the Pinnion API server

# Development Roadmap

- POST support
- support for more endpoints

If you would like to see specific new developments please feel free to contribute through code or financial incentives.

