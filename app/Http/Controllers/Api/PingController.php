<?php


namespace App\Http\Controllers\Api;

use Api\Infrastructure\Service\ApiConnector\ApiConnector;
use Api\Infrastructure\Service\ApiConnector\ApiEndpoints;
use App\Http\Requests\PingRequest;
use Api\Application\Command\Ping\PingCommand;
use Api\Infrastructure\Bus\Contracts\CommandBusInterface;
use App\Http\Controllers\Controller;

class PingController extends Controller
{
    /**
     * @var CommandBusInterface
     */
    private CommandBusInterface $commandBus;

    /**
     * @var ApiConnector
     */
    private ApiConnector $internalApi;

    /**
     * PingController constructor.
     * @param CommandBusInterface $commandBus
     * @param ApiConnector $internalApi
     */
    public function __construct(CommandBusInterface $commandBus, ApiConnector $internalApi)
    {
        $this->commandBus = $commandBus;
        $this->internalApi = $internalApi;
    }

    /**
     * @param PingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ping(PingRequest $request)
    {
        $serilizedJson = $this->internalApi->getSerializedJson(
            ApiEndpoints::$ENDPOINT[ApiEndpoints::KEY_PING]
        );

        $deserializedJson = $this->internalApi->getDeserializedJson(
            ApiEndpoints::$ENDPOINT[ApiEndpoints::KEY_PING]
        );;

        $ping = $this->commandBus->execute(
            PingCommand::create(
                $apiRequest["message"]
            )
        );

        return response()->json($ping);
    }
}

