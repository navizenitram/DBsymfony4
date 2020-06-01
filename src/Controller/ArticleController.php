<?php


namespace App\Controller;


use App\Service\MarkdownHelper;
use App\Service\MessageClient;
use App\Service\SlackMessageClient;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{


    private $slack;

    public function __construct(SlackMessageClient $messageClient)
    {
        $this->slack = $messageClient;
    }

    public function homepage(): Response
    {
        return $this->render('article/homepage.html.twig');
    }

    public function show(string $slug, MarkdownHelper $markdownHelper): Response
    {

        $this->slack->send('Gato','Miau miauuuuuuu');
        //Así se puede acceder a cualquier parametrp de configuración
        //dump($this->getParameter('isDebug'));die;
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
**turkey** shank eu pork belly meatball non cupim.

Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.

Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat....
EOF;
        $articleContent = $markdownHelper->parse($articleContent);

        return $this->render('article/show.html.twig',
            [
                'title'          => ucwords(str_replace('-', ' ', $slug)),
                'comments'       => $comments,
                'articleContent' => $articleContent,
                'slug'           => $slug,
            ]);


    }

    public function toogleArticleHeart(string $slug, LoggerInterface $logger): response
    {
        //TODO

        $logger->info('toggle heart Clickeed');
        return new JsonResponse(['hearts' => rand(1, 100)]);
    }


}