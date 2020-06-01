<?php


namespace App\Service;


use App\Share\Logger;
use Exception;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;

class SlackMessageClient implements MessageClient
{

    use Logger;

    private $slack;


    public function __construct(Client $slack)
    {

        $this->slack = $slack;
    }

    public function send(string $from, string $message): bool
    {
        if ($this->logger) {
            $this->logger->info($from . '-' . $message, [
                'Fistro'=>'Duodeno'
            ]);
        }


        try {
            $slackMessage = $this->slack->createMessage()
                                        ->from($from)
                                        ->withIcon(':ghost:')
                                        ->setText($message);
            $this->slack->sendMessage($slackMessage);
            return true;
        } Catch (Exception $e) {
            return false;
        }

    }

}