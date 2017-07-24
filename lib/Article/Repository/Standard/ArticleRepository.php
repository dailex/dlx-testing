<?php

namespace Dlx\Testing\Article\Repository\Standard;

use Daikon\ReadModel\Projection\ProjectionInterface;
use Daikon\ReadModel\Projection\ProjectionMap;
use Daikon\ReadModel\Query\QueryInterface;
use Daikon\ReadModel\Repository\RepositoryInterface;
use Daikon\ReadModel\Storage\StorageAdapterInterface;

final class ArticleRepository implements RepositoryInterface
{
    private $storageAdapter;

    public function __construct(StorageAdapterInterface $storageAdapter)
    {
        $this->storageAdapter = $storageAdapter;
    }

    public function findById(string $identifier): ProjectionInterface
    {
        return $this->storageAdapter->read($identifier);
    }

    public function findByIds(array $identifiers): ProjectionMap
    {
    }

    public function search(QueryInterface $query, $from, $size): ProjectionMap
    {
        return $this->storageAdapter->search($query, $from, $size);
    }

    public function persist(ProjectionInterface $projection): bool
    {
        return $this->storageAdapter->write($projection->getAggregateId(), $projection->toArray());
    }

    public function makeProjection(): ProjectionInterface
    {
        return Article::fromArray([
            '@type' => Article::class,
            '@parent' => null
        ]);
    }
}
