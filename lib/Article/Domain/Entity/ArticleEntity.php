<?php

namespace Dlx\Testing\Article\Domain\Entity;

use Daikon\Entity\Entity\Entity;
use Daikon\Entity\ValueObject\Text;
use Daikon\Entity\ValueObject\Uuid;
use Daikon\Entity\ValueObject\ValueObjectInterface;
use Daikon\EventSourcing\Aggregate\AggregateId;

class ArticleEntity extends Entity
{
    public function getIdentity(): ValueObjectInterface
    {
        return $this->get("identity");
    }

    public function withIdentity(Uuid $uuid): self
    {
        return $this->withValue("identity", $aggregateId);
    }

    public function getTitle(): Text
    {
        return $this->get("title");
    }

    public function withTitle(Text $title): self
    {
        return $this->withValue("title", $title);
    }

    public function getContent(): Text
    {
        return $this->get("content");
    }

    public function withContent(Text $content): self
    {
        return $this->withValue("content", $content);
    }
}
