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
        return view('generalApi', ['multiDatas' => $multiDatas]);
    }




    public function comicsApi()
    {
            $response = $this->client->get('comics');

            $response = json_decode($response->getBody(), true);

            $comics = $response['data']['results'];

        return view('comicsApi', ['comics' => $comics]);

    }

    function comicApi($id)
    {
        $page_data = [];

        $response = $this->client->get('comics/' . $id);
        $response = json_decode($response->getBody(), true);
        $page_data['copyright'] = $response['copyright'];
        $page_data['attributionText'] = $response['attributionText'];
        $comic = $response['data']['results'][0];
        $page_data['comic'] = $comic;

        if (!empty($comic['series'])) {
            $series_response = $this->client->get($comic['series']['resourceURI']);
            $series_response = json_decode($series_response->getBody(), true);
            $page_data['series'] = $series_response['data']['results'][0];
        }
        return view('comic', $page_data);
    }

    public function charactersApi()
    {
        $response = $this->client->get('characters');

        $response = json_decode($response->getBody(), true);

        $characters = $response['data']['results'];

        return view('charactersApi', ['characters' => $characters]);

    }

    function characterApi($id)
    {
        $page_data = [];

        $response = $this->client->get('characters/' . $id);
        $response = json_decode($response->getBody(), true);
        $page_data['copyright'] = $response['copyright'];
        $page_data['attributionText'] = $response['attributionText'];
        $characters = $response['data']['results'][0];
        $page_data['characters'] = $characters;
        if (!empty($characters['series'])) {
            $series_response = $this->client->get($characters['series']['collectionURI']);
            $series_response = json_decode($series_response->getBody(), true);
            $page_data['series'] = $series_response['data']['results'][0];
        }

        return view('character', $page_data);
    }




    public function eventsApi()
    {
        $response = $this->client->get('events');

        $response = json_decode($response->getBody(), true);
        $events = $response['data']['results'];
        return view('eventsApi', ['events' => $events]);
    }

    function eventApi($id)
    {
        $page_data = [];

        $response = $this->client->get('events/' . $id);
        $response = json_decode($response->getBody(), true);
        $page_data['copyright'] = $response['copyright'];
        $page_data['attributionText'] = $response['attributionText'];
        $events = $response['data']['results'][0];
        $page_data['events'] = $events;

        if (!empty($events['series'])) {
            $series_response = $this->client->get($events['series']['collectionURI']);
            $series_response = json_decode($series_response->getBody(), true);
            $page_data['series'] = $series_response['data']['results'][0];
        }

        return view('event', $page_data);
    }

    public function seriesApi()
    {
        $response = $this->client->get('series');

        $response = json_decode($response->getBody(), true);
        $series = $response['data']['results'];
        return view('seriesApi', ['series' => $series]);
    }

    function serieApi($id)
    {
        $page_data = [];

        $response = $this->client->get('series/' . $id);
        $response = json_decode($response->getBody(), true);
        $page_data['copyright'] = $response['copyright'];
        $page_data['attributionText'] = $response['attributionText'];
        $series = $response['data']['results'][0];
        $page_data['series'] = $series;

        if (!empty($series['series'])) {
            $series_response = $this->client->get($series['series']['collectionURI']);
            $series_response = json_decode($series_response->getBody(), true);
            $page_data['series'] = $series_response['data']['results'][0];
        }

        return view('serie', $page_data);
    }

    public function storiesApi()
    {
        $response = $this->client->get('stories');

        $response = json_decode($response->getBody(), true);
        $stories = $response['data']['results'];
        return view('storiesApi', ['stories' => $stories]);
    }

    function storieApi($id)
    {
        $page_data = [];

        $response = $this->client->get('stories/' . $id);
        $response = json_decode($response->getBody(), true);
        $page_data['copyright'] = $response['copyright'];
        $page_data['attributionText'] = $response['attributionText'];
        $series = $response['data']['results'][0];
        $page_data['series'] = $series;

        if (!empty($series['series'])) {
            $series_response = $this->client->get($series['series']['collectionURI']);
            $series_response = json_decode($series_response->getBody(), true);
            $page_data['series'] = $series_response['data']['results'][0];
        }

        return view('serie', $page_data);
    }

    public function comicsCrawler()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://www.marvel.com/comics?&options%5Boffset%5D=0&totalcount=12');
        $response = $response->getBody()->getContents();

        $teste = Str::after($response, '<section class="module JMMultiRow moduColor_Light no-stripes" id="onsale">');
        $exibe1 = Str::before($teste, 'footer');
        $keywords = preg_split('/\s+v|<div class="row-item comic-item">\s+/i', $exibe1);
        $totalColetado = 0;
        $tituloGeral = array();
        foreach ($keywords as $k => $v) {

            if (Str::contains($keywords[$k], '<h2 class="module-header">')) {
                $idTituloGeral = $k;
                $limpaTituloGeral1 = Str::after($keywords[$k], '<h2 class="module-header">');
                $limpaTituloGeral11 = Str::before($limpaTituloGeral1, '<');
                $tituloGeral[$k]['titulogeral'] = trim($limpaTituloGeral11);
                $tituloGeral[$k]['id'] = [];
                $tituloGeral[$k]['url'] = [];
                $tituloGeral[$k]['title'] = [];
                $tituloGeral[$k]['imagem'] = [];
                $tituloGeral[$k]['criadores'] = [];

                foreach ($keywords as $k => $v) {

                    if (Str::contains($keywords[$k], '<div class="row-item-image">')) {
                        $limpaTituloComic1 = Str::after($keywords[$k], '<a href="   //');
                        $limpaTituloComic2 = Str::before($limpaTituloComic1, '" class="');
                        array_push($tituloGeral[$idTituloGeral]['url'], trim('https://' . $limpaTituloComic2));
                        $totalColetado += 1;


                        $limpaTituloId1 = Str::after($limpaTituloComic2, '/issue/');
                        $limpaTituloId2 = Str::before($limpaTituloId1, '/');
                        array_push($tituloGeral[$idTituloGeral]['id'], trim($limpaTituloId2));

                        if (Str::contains($keywords[$k], '<p class="meta-creators">')) {
                            $limpaCreatorsComic1 = Str::after($keywords[$k], '<p class="meta-creators">');
                            $limpaCreatorsComic2 = Str::before($limpaCreatorsComic1, '</p>');
                            array_push($tituloGeral[$idTituloGeral]['criadores'], trim($limpaCreatorsComic2));
                        } else {
                            array_push($tituloGeral[$idTituloGeral]['criadores'], 'Author Not Informed by Marvel');
                        }

                        if (Str::contains($keywords[$k], '<img src="https')) {
                            $limpaImagemComic1 = Str::after($keywords[$k], '<img src="');
                            $limpaImagemComic2 = Str::before($limpaImagemComic1, '" alt="');
                            array_push($tituloGeral[$idTituloGeral]['imagem'], trim($limpaImagemComic2));
                        } else {
                            array_push($tituloGeral[$idTituloGeral]['imagem'], 'Problema com Imagem - Comics');
                        }

                        if (Str::contains($keywords[$k], '" alt="')) {
                            $limpaTitleComic1 = Str::after($keywords[$k], '" alt="');
                            $limpaTitleComic2 = Str::before($limpaTitleComic1, '" title="');
                            array_push($tituloGeral[$idTituloGeral]['title'], trim($limpaTitleComic2));
                        } else {
                            array_push($tituloGeral[$idTituloGeral]['title'], 'Problema com Título - Comics');
                        }
                    }
                }
            }
        }
        return view('comicsCrawler', compact('tituloGeral', 'totalColetado'));
    }


}
