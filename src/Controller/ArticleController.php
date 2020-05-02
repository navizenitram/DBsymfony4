<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class ArticleController
{
    public function homepage(): Response
    {
        return new Response("OMG! My first response");
    }

    public function show($slug): Response
    {
        return new Response(sprintf(
            'Future page to show: %s',
            $slug
        ));
    }
}