<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UrlCheckerService
{
    private $client;

    private $validLink = [];

    private $invalidLink = [];

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getHtmlContent($url)
    {
        return (string) $this->client->request('GET', $url)->getBody();
    }

    public function sortLinksByStatusCode($links, $urlFrom)
    {
        $validLinks = [];

        foreach ($links as $link) {
            $statusCode = $this->getStatusCodeLink($link);
            if ($statusCode == 200) {
                $this->validLink[] = $link;
                $validLinks[] = $link;
            } else {
                $this->invalidLink[] = "$link | $statusCode";
            }
        }

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

    public function saveResult($validFileName, $invalidFileName)
    {
        $handleValild = fopen($validFileName, 'w');
        $handleInvalid = fopen($invalidFileName, 'w');
        $links = array_unique($this->validLink);
        foreach ($links as $link) {
            fwrite($handleValild, "$link \n");
        }
        $date = new DateTime();
        fwrite($handleValild, "\nlinks: " . count($links) . ' ' . $date->format('Y-m-d H:i:s'));

        $links = array_unique($this->invalidLink);
        foreach ($links as $link) {
            fwrite($handleInvalid, "$link \n");
        }

        fwrite($handleInvalid, "\nlinks: " . count($links) . ' ' . $date->format('Y-m-d H:i:s'));

        fclose($handleValild);
        fclose($handleInvalid);
    }
}