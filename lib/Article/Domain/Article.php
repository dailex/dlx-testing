<?php

namespace Dlx\Testing\Article\Domain;

use Daikon\EventSourcing\Aggregate\AggregateAlias;
use Daikon\EventSourcing\Aggregate\AggregateRootInterface;
use Daikon\EventSourcing\Aggregate\AggregateRootTrait;
use Dlx\Testing\Article\Domain\Command\CreateArticle;
use Dlx\Testing\Article\Domain\Command\UpdateArticle;
use Dlx\Testing\Article\Domain\Entity\ArticleEntityType;
use Dlx\Testing\Article\Domain\Event\ArticleWasCreated;
use Dlx\Testing\Article\Domain\Event\ArticleWasUpdated;

final class Article implements AggregateRootInterface
{
    use AggregateRootTrait;

    private $articleState;

    public static function getAlias(): AggregateAlias
    {
        return AggregateAlias::fromNative('dlx.testing.article');
    }

    public static function create(CreateArticle $createArticle): self
    {
        return (new self($createArticle->getAggregateId()))
            ->reflectThat(ArticleWasCreated::viaCommand($createArticle));
    }

    public function update(UpdateArticle $updateArticle): self
    {
        return $this->reflectThat(ArticleWasUpdated::viaCommand($updateArticle));
    }

    protected function whenArticleWasCreated(ArticleWasCreated $articleWasCreated)
    {
        $this->articleState = (new ArticleEntityType)->makeEntity()
            ->withTitle($articleWasCreated->getTitle())
            ->withContent($articleWasCreated->getContent());
    }

    protected function whenArticleWasUpdated(ArticleWasUpdated $articleWasUpdated)
    {
        $this->articleState = $this->articleState
            ->withTitle($articleWasUpdated->getTitle())
            ->withContent($articleWasUpdated->getContent());
    }
}
