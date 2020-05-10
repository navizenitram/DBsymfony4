<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    public function homepage(): Response
    {
        return $this->render('article/homepage.html.twig');
    }

    public function show(string $slug): Response
    {
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        //dump($comments, $this);

        return $this->render('article/show.html.twig',
            [
                'title'    => ucwords(str_replace('-', ' ', $slug)),
                'comments' => $comments,
            ]);
    }
}