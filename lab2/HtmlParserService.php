<?php


class HtmlParserService
{
    public function getAllUrlsFromHtml($htmlContentString, $baseUrl)
    {
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML($htmlContentString);
        $aElements = $document->getElementsByTagName("a");
        $links = [];
        foreach ($aElements as $aElement) {
            $links[] = $aElement->getAttribute('href');
        }
        $links = array_unique($links);

        foreach ($links as &$link) {
            $link = $this->fixUrlsToAbsolutePath($link, $baseUrl);
        }
        return $links;
    }

    private function fixUrlsToAbsolutePath($link, $baseUrl)
    {
        if (stristr($link, 'http://') !== false || stristr($link, 'https://') !== false) {
            return $link;
        }
        if (substr($link, 0, 3) == '../') {
            return 'http://52.136.215.164/' . substr($link, 3);
        }
        return $baseUrl . $link;
    }
}