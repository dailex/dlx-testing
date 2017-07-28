<?php

namespace Dlx\Testing\Article\Domain\Entity;

use Daikon\Entity\Entity\TypedEntityInterface;
use Daikon\Entity\EntityType\Attribute;
use Daikon\Entity\EntityType\EntityType;
use Daikon\Entity\ValueObject\Text;
use Daikon\Entity\ValueObject\Uuid;

class ArticleEntityType extends EntityType
{
    public static function getName(): string
    {
        return "Article";
    }

    public function __construct()
    {
        parent::__construct([
            Attribute::define("identity", Uuid::class, $this),
            Attribute::define("title", Text::class, $this),
            Attribute::define("content", Text::class, $this)
        ]);
    }

    public function makeEntity(array $articleState = [], TypedEntityInterface $parent = null): TypedEntityInterface
    {
        $articleState["@type"] = $this;
        $articleState["@parent"] = $parent;
        return ArticleEntity::fromNative($articleState);
    }
}
