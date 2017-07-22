<?php

use Dlx\Testing\Article\Controller\CollectionController;
use Dlx\Testing\Article\Controller\ResourceController;

$cratePrefix = 'dlx.testing';
$mount = $configProvider->get('crates.'.$cratePrefix.'.mount', '/dlx/testing');

$app->mount($mount, function ($blog) use ($cratePrefix) {
    $blog->get('/articles', [CollectionController::class, 'write'])->bind($cratePrefix.'.articles');
    $blog->get('/articles/{articleId}', [ResourceController::class, 'read'])->bind($cratePrefix.'.articles.resource');
    $blog->get('/articles/{articleId}/update', [ResourceController::class, 'write']);
});
