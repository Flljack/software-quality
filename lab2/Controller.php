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
        $urlCheckerService = new UrlCheckerService(self::CHECKED_URL);
        $parser = new HtmlParserService();
        $htmlContent = $urlCheckerService->getHtmlContent();
        $links = $parser->getAllUrlsFromHtml($htmlContent, self::CHECKED_URL);
        $urlCheckerService->sortLinksByStatusCode($links, self::VALID_URL_FILENAME, self::INVALID_URL_FILENAME);
    }
}