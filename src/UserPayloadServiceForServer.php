<?php


namespace Core\CryptoInterface;


use Buonzz\Template\Forms\TransferDataForm;
use Buonzz\Template\Forms\TransferForm;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UserPayloadServiceForServer
{
    private $client;

    protected $url;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    private function getContent($response)
    {
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }

    public function getTrustedDevicePublicId(): array
    {
        $response = $this->client->request(
            'GET',
            "$this->url/cryptolib/server/getTrustedDevicePublicId",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-VERSION' => '0.0.3'
                ],
            ]
        );

        return $this->getContent($response);
    }

    public function onceEncryptedRequest(): array
    {
        $response = $this->client->request(
            'GET',
            "$this->url/cryptolib/server/onceEncryptedRequest",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-VERSION' => '0.0.3'
                ],
            ]
        );

        return $this->getContent($response);
    }

    public function handler(TransferForm $transfer): array
    {
        $response = $this->client->request(
            'POST',
            "$this->url/cryptolib/server/handler",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-VERSION' => '0.0.3'
                ],
                'json' => $transfer->toJSON(),
            ]
        );

        return $this->getContent($response);
    }

    public function twiceEncryptedRequest(TransferDataForm $transfer): array
    {
        $response = $this->client->request(
            'POST',
            "$this->url/cryptolib/server/twiceEncryptedRequest",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-VERSION' => '0.0.3'
                ],
                'json' => $transfer->toJSON(),
            ]
        );

        return $this->getContent($response);
    }

    public function twiceEncryptedPermission(TransferDataForm $transfer): array
    {
        $response = $this->client->request(
            'POST',
            "$this->url/cryptolib/server/twiceEncryptedPermission",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-VERSION' => '0.0.3'
                ],
                'json' => $transfer->toJSON(),
            ]
        );

        return $this->getContent($response);
    }

    public function dataRequest(TransferDataForm $transfer): array
    {
        $response = $this->client->request(
            'POST',
            "$this->url/cryptolib/server/dataRequest",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-VERSION' => '0.0.3'
                ],
                'json' => $transfer->toJSON(),
            ]
        );

        return $this->getContent($response);
    }


    public function encryptedDataRequest($trustedDeviceData, TransferDataForm $transfer): array
    {
        $response = $this->client->request(
            'GET',
            "$this->url/cryptolib/server/encryptedDataRequest/$trustedDeviceData",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-API-VERSION' => '0.0.3'
                ],
                'json' => $transfer->toJSON(),
            ]
        );

        return $this->getContent($response);
    }

}
