<?php

namespace Dlx\Testing\Article\Controller;

use Daikon\MessageBus\MessageBusInterface;
use Dlx\Testing\Article\Domain\Command\CreateArticle;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class CollectionController
{
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function read(Request $request, Application $app)
    {
        return 'Article collection listing not yet implemented';
    }

    public function write(Request $request, Application $app)
    {
        $this->messageBus->publish(CreateArticle::fromNative([
            'aggregateId' => 'dlx.testing.article-123',
            'title' => 'hello world!',
            'content' => 'using cqrs+es to just output this message is over engineered, but it worx :D'
        ]), 'commands');

        return 'CreateArticle command was created and dispatched!';
    }
}
