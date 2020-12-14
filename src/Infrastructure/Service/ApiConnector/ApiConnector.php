<?php


namespace Api\Infrastructure\Service\ApiConnector;


use Api\Infrastructure\Service\ApiConnector\Exception\InternalServiceDownException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ApiConnector
{
    //Global Configuration
    /**
     * @var string
     */
    private static string $BASE_URL;

    /**
     * @var string
     */
    private static string $VERSION_ENDPOINT;

    /**
     * @var Http
     */
    private Http $http;

    public function __construct(Http $http)
    {
        self::$BASE_URL = env('API_BASE_URL', 'https://run.mocky.io');
        self::$VERSION_ENDPOINT = env('API_VERSION_ENDPOINT', 'v3');
        $this->http = $http;
    }

    /**
     * @param string $endpoint
     * @return ApiResponse
     * @throws InternalServiceDownException
     */
    public function getSerializedJson(string $endpoint): ApiResponse
    {
        $response = $this->http::get(
            $this->route($endpoint)
        );

        //Guard Clauses
        if($response->clientError()) {
            
        }

        if($response->serverError()) {

        }

        if($response->failed()){
            throw InternalServiceDownException::create(
                "No ha sido posible conectar con el servicio interno. Por favor contacte con los administradores"
            );
        }

        return ApiResponse::create();
    }

    public function getDeserializedJson() {

    }

    /**
     * @param string $endpoint
     * @return string
     */
    private function route(string $endpoint): string
    {
        return self::BASE_URL . "/" . self::VERSION_ENDPOINT . "/" . $endpoint;
    }
}
