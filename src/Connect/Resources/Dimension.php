<?php
namespace Syno\Cint\Connect\Resources;

use Syno\Cint\Connect\Client;

class Dimension
{
    /** @var Client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Returns all dimensions by provider
     *
     * @param string $provider
     *
     * @return array
     */
    public function all(string $provider): array
    {
        $valid = ['basicprofiling', 'globalquestions', 'useragent', 'custommetrics', 'matchdata'];
        if (!in_array(strtolower($provider), $valid)) {
            throw new \InvalidArgumentException(
                sprintf('Provider "%s" is invalid, must be one of "%s"', $provider, implode(', ', $valid))
            );
        }

        return $this->client->get(sprintf('/api/profiling/%s', $provider));
    }
}
