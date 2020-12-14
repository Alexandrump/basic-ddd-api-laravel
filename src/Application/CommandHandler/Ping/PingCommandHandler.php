<?php


namespace Api\Application\CommandHandler\Ping;

use Api\Application\Contracts\CommandHandlerInterface;
use Api\Application\Contracts\CommandInterface;
use Api\Domain\Entity\Ping\InvalidPing;
use Api\Domain\Entity\Ping\Ping;
use Api\Domain\Repository\PingRepositoryInterface;

class PingCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PingRepositoryInterface
     */
    private PingRepositoryInterface $pingRepository;

    public function __construct(PingRepositoryInterface $pingRepository)
    {
        $this->pingRepository = $pingRepository;
    }

    /**
     * @param CommandInterface $command
     * @return InvalidPing|Ping|array|mixed
     */
    public function handle(CommandInterface $command)
    {
        //Create the Ping entity
        $ping = Ping::create(
            $command->getMessage()
        );

        //Guard clause if InvalidPing
        if ($ping instanceof InvalidPing) {
            //Build and return the Transformed Data
            return $ping->getNotification();
        }

        //Register ping into DataBase, or Log into a file, etc
        if(!$this->pingRepository->save($ping)) {
            //Build and return the Transformed Data
            return "It was impossible to persist the Ping into the database.";
        }

        //Build and return the Transformed Data
        return $ping;
    }
}
