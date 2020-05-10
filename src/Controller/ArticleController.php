<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ArticleController extends AbstractController
{
    public function homepage(): Response
    {
        return $this->render('article/homepage.html.twig');
    }

    public function show(string $slug, Environment $twigEnvironment): Response
    {
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        //dump($comments, $this);

        //Probando servicios. No es la forma, pero es para ver como funciona. Es lo mismo
        //que $this->render
        $html = $twigEnvironment->render('article/show.html.twig',
            [
                'title'    => ucwords(str_replace('-', ' ', $slug)),
                'comments' => $comments,
                'slug'     => $slug,
            ]);

        return new Response($html);
    }

    public function toogleArticleHeart(string $slug, LoggerInterface $logger): response
    {
        //TODO
        $logger->info('toggle heart Clickeed');
        return new JsonResponse(['hearts' => rand(1, 100)]);
    }
}