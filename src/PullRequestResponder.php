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
     * @var array
     */
    private $reviews;

    public function __construct(string $endpoint, string $githubToken, array $reviews)
    {
        $this->endpoint = $endpoint;
        $this->githubToken = $githubToken;
        $this->reviews = $reviews;
    }

    public function execute(): void
    {
        $client = new \GuzzleHttp\Client;

        $client->request(
            'POST',
            $this->endpoint,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->githubToken,
                ],
                'json' => [
                    'body' => json_encode($this->makeJson()),
                ],
            ]
        );
    }

    protected function makeJson()
    {
        return [
            // 'commit_id' => '', optional
            'body' => 'phpstan review has failed. check errors and fix it.',
            'event' => 'REQUEST_CHANGES',
            'comments' => $this->reviews,
        ];
    }
}