<?php

require_once ('UrlCheckerService.php');
require_once ('HtmlParserService.php');

class Controller
{
    const VALID_URL_FILENAME = 'validUrl.txt';
    const INVALID_URL_FILENAME = 'invalidUrl.txt';
    const CHECKED_URL = 'http://52.136.215.164/broken-links/';

    public function start()
    {
        $urlCheckerService = new UrlCheckerService();
        $parser = new HtmlParserService();

        $htmlContent = $urlCheckerService->getHtmlContent(self::CHECKED_URL);
        $links = $parser->getAllUrlsFromHtml($htmlContent, self::CHECKED_URL);
        $validLinks = $urlCheckerService->sortLinksByStatusCode($links, self::VALID_URL_FILENAME, self::INVALID_URL_FILENAME, self::CHECKED_URL);

        function getLinkByDomain($link)
        {
            if (stristr($link, self::CHECKED_URL) === false) {
                return false;
            }
            return true;
        }

        $domianLinks = array_filter($validLinks, 'getLinkByDomain');
        $unvisitedLinks = $domianLinks;
        $visiedLinks = [];

        foreach ($unvisitedLinks as $link) {
            $htmlContent = $urlCheckerService->getHtmlContent($link);
            $links = $parser->getAllUrlsFromHtml($htmlContent, self::CHECKED_URL);
            $validLinks = $urlCheckerService->sortLinksByStatusCode($links, self::VALID_URL_FILENAME, self::INVALID_URL_FILENAME, $link);
            $validLinks = array_filter($validLinks, 'getLinkByDomain');
            foreach ($validLinks as $validLink) {
                if (in_array($validLink, $domianLinks)) {
                    continue;
                } else {
                    $unvisitedLinks[] = $validLink;
                    $domianLinks[] = $validLink;
                }
            }
            $visiedLinks [] = $link;
        }
        print_r($domianLinks);
    }
}