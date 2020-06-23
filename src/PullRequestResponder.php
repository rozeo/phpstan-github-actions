<?php


namespace Rozeo\PHPStanAction;


class PullRequestResponder
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $githubToken;
    /**
     * @var string
     */
    private $message;

    public function __construct(string $endpoint, string $githubToken, string $message)
    {
        $this->endpoint = $endpoint;
        $this->githubToken = $githubToken;
        $this->message = $message;
    }

    public function execute()
    {
        $data = json_encode(['body' => $this->message]);

        $stream = stream_context_create([
            'https' => array (
                'method' => 'POST',
                'header'=> "Content-type: application/json\r\n"
                    . "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data
            )
        ]);

        file_get_contents($this->endpoint, false, $stream);
    }
}