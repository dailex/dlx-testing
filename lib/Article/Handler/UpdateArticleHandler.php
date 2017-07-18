<?php

namespace Dlx\Testing\Article\Handler;

use Daikon\EventSourcing\Aggregate\CommandHandler;
use Daikon\MessageBus\Metadata\Metadata;
use Dlx\Testing\Article\Domain\Command\UpdateArticle;

final class UpdateArticleHandler extends CommandHandler
{
    protected function handleUpdateArticle(UpdateArticle $updateArticle, Metadata $metadata): array
    {
        $article = $this->checkout($updateArticle->getAggregateId(), $updateArticle->getKnownAggregateRevision());
        return [$article->update($updateArticle), $metadata];
    }
}
