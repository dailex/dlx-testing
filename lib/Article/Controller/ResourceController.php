<?php

namespace Dlx\Testing\Article\Controller;

use Daikon\MessageBus\MessageBusInterface;
use Daikon\ReadModel\Repository\RepositoryMap;
use Dlx\Testing\Article\Domain\Command\UpdateArticle;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ResourceController
{
    private $repositoryMap;

    private $messageBus;

    public function __construct(RepositoryMap $repositoryMap, MessageBusInterface $messageBus)
    {
        $this->repositoryMap = $repositoryMap;
        $this->messageBus = $messageBus;
    }

    public function read(Request $request, Application $app)
    {
        $repository = $this->repositoryMap->get('dlx.testing.article.standard');
        $article = $repository->findById($request->attributes->get('articleId'));
        var_dump($article->toArray());
        return 'Article loaded';
    }

    public function write(Request $request, Application $app)
    {
        $this->messageBus->publish(UpdateArticle::fromNative([
            'aggregateId' => $request->attributes->get('articleId'),
            'title' => 'not the same',
            'content' => 'this looks like it updated'
        ]), 'commands');

        return 'UpdateArticle command was created and dispatched!';
    }
}
