<?php

namespace Dlx\Testing\Article\Handler;

use Daikon\EventSourcing\Aggregate\CommandHandler;
use Daikon\MessageBus\Metadata\Metadata;
use Dlx\Testing\Article\Domain\Article;
use Dlx\Testing\Article\Domain\Command\CreateArticle;

final class CreateArticleHandler extends CommandHandler
{
    protected function handleCreateArticle(CreateArticle $createArticle, Metadata $metadata): array
    {
        return [Article::create($createArticle), $metadata];
    }
}
