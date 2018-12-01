<?php

namespace Dlx\Testing\Article\Domain\Command;

use Daikon\Entity\ValueObject\Text;
use Daikon\EventSourcing\Aggregate\AggregateId;
use Daikon\EventSourcing\Aggregate\AggregateIdInterface;
use Daikon\EventSourcing\Aggregate\Command\Command;
use Daikon\MessageBus\MessageInterface;

final class CreateArticle extends Command
{
    private $title;

    private $content;

    /** @param array $payload */
    public static function fromNative(array $payload): MessageInterface
    {
        return new self(
            AggregateId::fromNative($payload['aggregateId']),
            Text::fromNative($payload['title']),
            Text::fromNative($payload['content'])
        );
    }

    public function getTitle(): Text
    {
        return $this->title;
    }

    public function getContent(): Text
    {
        return $this->content;
    }

    public function toNative(): array
    {
        return array_merge([
            'title' => $this->title->toNative(),
            'content' => $this->content->toNative()
        ], parent::toNative());
    }

    protected function __construct(AggregateIdInterface $aggregateId, Text $title, Text $content)
    {
        parent::__construct($aggregateId);
        $this->title = $title;
        $this->content = $content;
    }
}
