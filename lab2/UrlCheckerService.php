<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;

class UrlCheckerService
{
    private $baseUrl;
    private $client;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->client = new Client();
    }

    public function getHtmlContent()
    {
        return (string) $this->client->request('GET', $this->baseUrl)->getBody();
    }

    public function sortLinksByStatusCode($links, $validFileName, $invalidFileName)
    {
        $handleVild = fopen($validFileName, 'w');
        $handleInvalid = fopen($invalidFileName, 'w');

        foreach ($links as $link) {
            if ($this->getStatusCodeLink($link) == 200) {
                fwrite($handleVild, "$link \n");
            } else {
                fwrite($handleInvalid, "$link \n");
            }
        }

        fclose($handleVild);
        fclose($handleInvalid);
    }

    private function getStatusCodeLink($link)
    {
        try {
         return (int) $this->client->request('GET', $link)->getStatusCode();
        } catch (Exception  $e) {
            return 404;
        }
    }
}