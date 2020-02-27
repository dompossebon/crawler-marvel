<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrawlerMarvelController extends Controller
{
    //
    public function comics()
    {

        $client = new Client();
        $response = $client->request('GET', 'https://www.marvel.com/comics?&options%5Boffset%5D=0&totalcount=12');
        $response = $response->getBody()->getContents();

        $teste = Str::after($response, '<section class="module JMMultiRow moduColor_Light no-stripes" id="onsale">');
        $exibe1 = Str::before($teste, '</section>');
        $keywords = preg_split('/\s+v|<div class="row-item comic-item">\s+/i', $exibe1);
        $tituloGeral = array();
        foreach ($keywords as $k => $v) {

            if (Str::contains($keywords[$k], '<h2 class="module-header">')) {
                $limpaTituloGeral1 = Str::after($keywords[$k], '<h2 class="module-header">');
                $limpaTituloGeral11 = Str::before($limpaTituloGeral1, '<');
                $tituloGeral[$k]['titulogeral'] = trim($limpaTituloGeral11);
                $tituloGeral[$k]['url'] = [];
                $tituloGeral[$k]['imagem'] = [];
                $tituloGeral[$k]['title'] = [];
                $tituloGeral[$k]['criadores'] = [];

                foreach ($keywords as $k => $v) {
                    if (Str::contains($keywords[$k], '<a href=" ')) {
                        $limpaTituloComic1 = Str::after($keywords[$k], '<a href="   //');
                        $limpaTituloComic2 = Str::before($limpaTituloComic1, '" class="');
                        array_push($tituloGeral[0]['url'], trim('https://'.$limpaTituloComic2));

                        if (Str::contains($keywords[$k], '<p class="meta-creators">')) {
                            $limpaCreatorsComic1 = Str::after($keywords[$k], '<p class="meta-creators">');
                            $limpaCreatorsComic2 = Str::before($limpaCreatorsComic1, '</p>');

                            array_push($tituloGeral[0]['criadores'], trim($limpaCreatorsComic2));
                        } else {
                            array_push($tituloGeral[0]['criadores'], 'Author Not Informed by Marvel');
                        }

                        if (Str::contains($keywords[$k], '<img src="https')) {
                            $limpaImagemComic1 = Str::after($keywords[$k], '<img src="');
                            $limpaImagemComic2 = Str::before($limpaImagemComic1, '" alt="');
                            array_push($tituloGeral[0]['imagem'], trim($limpaImagemComic2));
                        } else {
                            array_push($tituloGeral[0]['imagem'], 'Problema com Imagem - Comics');
                        }

                        if (Str::contains($keywords[$k], '" alt="')) {
                            $limpaTitleComic1 = Str::after($keywords[$k], '" alt="');
                            $limpaTitleComic2 = Str::before($limpaTitleComic1, '" title="');
                            array_push($tituloGeral[0]['title'], trim($limpaTitleComic2));
                        } else {
                            array_push($tituloGeral[0]['title'], 'Problema com Título - Comics');
                        }
                    }
                }
            }
        }

        $teste2 = Str::after($response, '<section class="module moduColor_Light  ">');
        $exibe2 = Str::before($teste2, '</section>');
        $keywordsExibe2 = preg_split('/\s+v|<div class="row-item comic-item">\s+/i', $exibe2);

        foreach ($keywordsExibe2 as $k2 => $v2) {

            if (Str::contains($keywordsExibe2[$k2], '<h2 class="module-header">')) {
                $limpaTituloGeral2 = Str::after($keywordsExibe2[$k2], '<h2 class="module-header">');
                $limpaTituloGeral22 = Str::before($limpaTituloGeral2, '<');
                $tituloGeral2[$k2]['titulogeral'] = trim($limpaTituloGeral22);
                $tituloGeral2[$k2]['url'] = [];
                $tituloGeral2[$k2]['imagem'] = [];
                $tituloGeral2[$k2]['title'] = [];
                $tituloGeral2[$k2]['criadores'] = [];

                foreach ($keywordsExibe2 as $k2 => $v2) {

                    if (Str::contains($keywordsExibe2[$k2], '<div class="row-item-image">')) {

                        $limpaTituloComic1 = Str::after($keywordsExibe2[$k2], '<a href="   //');

                        $limpaTituloComic2 = Str::before($limpaTituloComic1, '" class="');
//                        dd($limpaTituloComic2);
                        array_push($tituloGeral2[0]['url'], trim('https://'.$limpaTituloComic2));

                        if (Str::contains($keywordsExibe2[$k2], '<p class="meta-creators">')) {
                            $limpaCreatorsComic1 = Str::after($keywordsExibe2[$k2], '<p class="meta-creators">');
                            $limpaCreatorsComic2 = Str::before($limpaCreatorsComic1, '</p>');

                            array_push($tituloGeral2[0]['criadores'], trim($limpaCreatorsComic2));
                        } else {
                            array_push($tituloGeral2[0]['criadores'], 'Author Not Informed by Marvel');
                        }

                        if (Str::contains($keywordsExibe2[$k2], '<img src="https')) {
                            $limpaImagemComic1 = Str::after($keywordsExibe2[$k2], '<img src="');
                            $limpaImagemComic2 = Str::before($limpaImagemComic1, '" alt="');
                            array_push($tituloGeral2[0]['imagem'], trim($limpaImagemComic2));
                        } else {
                            array_push($tituloGeral2[0]['imagem'], 'Problema com Imagem - Comics');
                        }

                        if (Str::contains($keywordsExibe2[$k2], '" alt="')) {
                            $limpaTitleComic1 = Str::after($keywordsExibe2[$k2], '" alt="');
                            $limpaTitleComic2 = Str::before($limpaTitleComic1, '" title="');
                            array_push($tituloGeral2[0]['title'], trim($limpaTitleComic2));
                        } else {
                            array_push($tituloGeral2[0]['title'], 'Problema com Título - Comics');
                        }
                    }
                }
            }
        }

        $teste4 = Str::after($response, '<section id="divider-smart-ad-divider-most-purchased" class="collapsable-ad-divider">');
        $exibe4 = Str::before($teste4, 'footer');
        $keywordsExibe4 = preg_split('/\s+v|<div class="row-item comic-item">\s+/i', $exibe4);

        foreach ($keywordsExibe4 as $k4 => $v2) {
            if (Str::contains($keywordsExibe4[$k4], '<h2 class="module-header">')) {

                $limpaTituloGeral4 = Str::after($keywordsExibe4[$k4], '<h2 class="module-header">');
                $limpaTituloGeral44 = Str::before($limpaTituloGeral4, '<');
                $tituloGeral4[$k4]['titulogeral'] = trim($limpaTituloGeral44);
                $tituloGeral4[$k4]['url'] = [];
                $tituloGeral4[$k4]['imagem'] = [];
                $tituloGeral4[$k4]['title'] = [];
                $tituloGeral4[$k4]['criadores'] = [];

                foreach ($keywordsExibe4 as $k4 => $v4) {

                    if (Str::contains($keywordsExibe4[$k4], '<div class="row-item-image">')) {

                        $limpaTituloComic1 = Str::after($keywordsExibe4[$k4], '<a href="   //');

                        $limpaTituloComic2 = Str::before($limpaTituloComic1, '" class="');
                        array_push($tituloGeral4[2]['url'], trim('https://'.$limpaTituloComic2));

                        if (Str::contains($keywordsExibe4[$k4], '<p class="meta-creators">')) {
                            $limpaCreatorsComic1 = Str::after($keywordsExibe4[$k4], '<p class="meta-creators">');
                            $limpaCreatorsComic2 = Str::before($limpaCreatorsComic1, '</p>');

                            array_push($tituloGeral4[2]['criadores'], trim($limpaCreatorsComic2));
                        } else {
                            array_push($tituloGeral4[2]['criadores'], 'Author Not Informed by Marvel');
                        }

                        if (Str::contains($keywordsExibe4[$k4], '<img src="https')) {
                            $limpaImagemComic1 = Str::after($keywordsExibe4[$k4], '<img src="');
                            $limpaImagemComic2 = Str::before($limpaImagemComic1, '" alt="');
                            array_push($tituloGeral4[2]['imagem'], trim($limpaImagemComic2));
                        } else {
                            array_push($tituloGeral4[2]['imagem'], 'Problema com Imagem - Comics');
                        }

                        if (Str::contains($keywordsExibe4[$k4], '" alt="')) {
                            $limpaTitleComic1 = Str::after($keywordsExibe4[$k4], '" alt="');
                            $limpaTitleComic2 = Str::before($limpaTitleComic1, '" title="');
                            array_push($tituloGeral4[2]['title'], trim($limpaTitleComic2));
                        } else {
                            array_push($tituloGeral4[2]['title'], 'Problema com Título - Comics');
                        }
                    }
                }
            }
        }
//
//        $results = array_merge($tituloGeral, $tituloGeral2, $tituloGeral4);
//
//
        dd($results);


            return view('comics', compact('tituloGeral','tituloGeral2','tituloGeral4'));

        }

    public function videos()
    {

        $client = new Client();
        $response = $client->request('GET', 'https://www.marvel.com/watch/?&options%5Boffset%5D=0&totalcount=12');
        $response = $response->getBody()->getContents();

        dd($response);

    }


    }
