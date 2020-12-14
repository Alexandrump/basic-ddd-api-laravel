<?php


namespace Api\Infrastructure\Repository\Eloquent;


use Api\Domain\Entity\Ping\Ping;
use Api\Domain\Repository\PingRepositoryInterface;
use App\Models\PingModel;

final class PingEloquentRepository implements PingRepositoryInterface
{
    /**
     * @var PingModel
     */
    private PingModel $model;

    /**
     * PingEloquentRepository constructor.
     * @param PingModel $model
     */
    public function __construct(PingModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return Ping
     */
    function findById(int $id): Ping
    {
        /** @var PingModel $pingModel */
        $pingModel = $this->model->newQuery()->where('id', $id);

        return $this->toPing($pingModel);
    }

    /**
     * @return Ping[]
     */
    function findAll(): array
    {
        /** @var PingModel[] $pingModels */
        $pingModels = $this->model::all();

        return array_map(function ($pingModel) {
            return $this->toPing($pingModel);
        } , $pingModels);
    }

    /**
     * @param Ping $ping
     * @return bool
     */
    function save(Ping $ping): bool
    {
        return $this->model->save([
            'message' => $ping->getMessage()
        ]);
    }

    /**
     * @param PingModel $pingModel
     * @return Ping
     */
    private function toPing(PingModel $pingModel): Ping
    {
        return new Ping($pingModel->message);
    }
}
