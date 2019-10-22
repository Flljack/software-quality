<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UrlCheckerService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getHtmlContent($url)
    {
        return (string) $this->client->request('GET', $url)->getBody();
    }

    public function sortLinksByStatusCode($links, $validFileName, $invalidFileName, $urlFrom)
    {
        $validLinks = [];
        $handleVild = fopen($validFileName, 'a');
        $handleInvalid = fopen($invalidFileName, 'a');

        foreach ($links as $link) {
            $statusCode = $this->getStatusCodeLink($link);
            if ($statusCode == 200) {
                fwrite($handleVild, "$link \n");
                $validLinks[] = $link;
            } else {
                fwrite($handleInvalid, "$link | $statusCode | $urlFrom \n");
            }
        }

        fclose($handleVild);
        fclose($handleInvalid);

        return $validLinks;
    }

    private function getStatusCodeLink($link)
    {
        try {
            return $this->client->request('GET', $link)->getStatusCode();
        } catch (RequestException $e) {
            return $e->getResponse()->getStatusCode();
        }
    }
}