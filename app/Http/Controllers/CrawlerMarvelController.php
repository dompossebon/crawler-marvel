<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class CrawlerMarvelController extends Controller
{
    //
    private $client;

    public function __construct()
    {
        $baseUrl = 'http://gateway.marvel.com/v1/public/';
        $public_key = '1747ef87891d75e5ff61d9f6d2fadcd7';
        $private_key = '3e49f306668367a1ee7ac0231b0009c3a69a2a19';
        $ts = time();
        $hash = md5($ts . $private_key . $public_key);
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'query' => [
                'apikey' => $public_key,
                'ts' => $ts,
                'hash' => $hash
            ]
        ]);
    }

    public function multiOption($option)
    {
        $response = $this->client->get($option);
        $response = json_decode($response->getBody(), true);
        $multiDatas = $response['data']['results'];
        return view('generalApi', ['multiDatas' => $multiDatas, 'option' => $option]);
    }

    function detailOption($id, $option)
    {
        $page_data = [];
        $response = $this->client->get($option . '/' . $id);
        $response = json_decode($response->getBody(), true);
        $page_data['copyright'] = $response['copyright'];
        $page_data['attributionText'] = $response['attributionText'];
        $page_data['option'] = $option;
        $multiDatas = $response['data']['results'][0];
        $page_data['comic'] = $multiDatas;
        if (isset($multiDatas['series'])) {
            $series_response = $this->client->get($multiDatas['series']['resourceURI'] ?? $multiDatas['series']['collectionURI']);
            $series_response = json_decode($series_response->getBody(), true);
            $page_data['series'] = $series_response['data']['results'][0];
        }
        return view('detailApi', $page_data);
    }

    public function comicsCrawler()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://www.marvel.com/comics?&options%5Boffset%5D=0&totalcount=12');
        $response = $response->getBody()->getContents();

        $pageStart = Str::after($response, '<section class="module JMMultiRow moduColor_Light no-stripes" id="onsale">');
        $closePage = Str::before($pageStart, 'footer');
        $keywords = preg_split('/\s+v|<div class="row-item comic-item">\s+/i', $closePage);
        $totalCollected = 0;
        $generalTitle = array();
        foreach ($keywords as $k => $v) {
            if (Str::contains($keywords[$k], '<h2 class="module-header">')) {
                $idTituloGeral = $k;
                $startGeneralTitle = Str::after($keywords[$k], '<h2 class="module-header">');
                $closeGeneralTitle = Str::before($startGeneralTitle, '<');
                $generalTitle[$k]['generalTitle'] = trim($closeGeneralTitle);
                $generalTitle[$k]['id'] = [];
                $generalTitle[$k]['url'] = [];
                $generalTitle[$k]['title'] = [];
                $generalTitle[$k]['image'] = [];
                $generalTitle[$k]['creators'] = [];

                foreach ($keywords as $k => $v) {
                    if (Str::contains($keywords[$k], '<div class="row-item-image">')) {
                        $startTitleComic = Str::after($keywords[$k], '<a href="   //');
                        $closeTitleComic = Str::before($startTitleComic, '" class="');
                        array_push($generalTitle[$idTituloGeral]['url'], trim('https://' . $closeTitleComic));
                        $totalCollected += 1;


                        $startTitleId = Str::after($closeTitleComic, '/issue/');
                        $closeTitleId = Str::before($startTitleId, '/');
                        array_push($generalTitle[$idTituloGeral]['id'], trim($closeTitleId));

                        if (Str::contains($keywords[$k], '<p class="meta-creators">')) {
                            $startCreatorsComic = Str::after($keywords[$k], '<p class="meta-creators">');
                            $closeCreatorsComic = Str::before($startCreatorsComic, '</p>');
                            array_push($generalTitle[$idTituloGeral]['creators'], trim($closeCreatorsComic));
                        } else {
                            array_push($generalTitle[$idTituloGeral]['creators'], 'Author Not Informed by Marvel');
                        }

                        if (Str::contains($keywords[$k], '<img src="https')) {
                            $startImageComic = Str::after($keywords[$k], '<img src="');
                            $closeImageComic = Str::before($startImageComic, '" alt="');
                            array_push($generalTitle[$idTituloGeral]['image'], trim($closeImageComic));
                        } else {
                            array_push($generalTitle[$idTituloGeral]['image'], 'Problem with Image - Comics');
                        }

                        if (Str::contains($keywords[$k], '" alt="')) {
                            $startTitleComic = Str::after($keywords[$k], '" alt="');
                            $closeTitleComic = Str::before($startTitleComic, '" title="');
                            array_push($generalTitle[$idTituloGeral]['title'], trim($closeTitleComic));
                        } else {
                            array_push($generalTitle[$idTituloGeral]['title'], 'Problema com Título - Comics');
                        }
                    }
                }
            }
        }
        return view('comicsCrawler', compact('generalTitle', 'totalCollected'));
    }
}
