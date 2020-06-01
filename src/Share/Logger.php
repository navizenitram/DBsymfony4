<?php


namespace App\Share;


use Psr\Log\LoggerInterface;

trait Logger
{

    /**
     * @var LoggerInterface|null
     */
    private $logger;
    /**
     *  Injeccion de dependencias por setter
     * @required
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function logInfo(string $message, array $context = [])
    {
        $this->logger->info($message, $context);
    }
}