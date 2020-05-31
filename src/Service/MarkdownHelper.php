<?php


namespace App\Service;


use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    private $markdown;
    private $cache;
    private $logger;
    private $isDebug;


    public function __construct(MarkdownInterface $markdown, AdapterInterface $cache, LoggerInterface
    $markdownLogger, string $isDebug)
    {

        $this->markdown = $markdown;
        $this->cache    = $cache;
        $this->logger   = $markdownLogger;
        $this->isDebug = $isDebug;
    }

    public function parse(string $source): string
    {

       // dump($this->isDebug); die;

        if (strpos($source, 'bacon') !== false) {
            $this->logger->info('They are talhing about bacon again!');
        }

        //Forma optima y rapida de gestionar la caché.
        $item = $this->cache->getItem('marckdown_' . md5($source));
        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }
        return $item->get();
    }
}