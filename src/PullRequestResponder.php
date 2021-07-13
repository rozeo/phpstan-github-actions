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
     * @var mixed[]
     */
    private $reviews;

    /**
     * PullRequestResponder constructor.
     * @param string $endpoint
     * @param string $githubToken
     * @param mixed[] $reviews
     */
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
                'json' => $this->makeJson(),
            ]
        );
    }

    /**
     * @return mixed[]
     */
    protected function makeJson(): array
    {
        $count = count($this->reviews);

        return [
            'body' => "Found $count errors in inspection. check errors and fix it. (listing max 100 errors.)",
            'event' => 'REQUEST_CHANGES',
            'comments' => array_slice($this->reviews, 0, 100),
        ];
    }
}