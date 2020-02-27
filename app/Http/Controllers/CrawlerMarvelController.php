<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
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
        $exibe1 = Str::before($teste, 'footer');
        $keywords = preg_split('/\s+v|<div class="row-item comic-item">\s+/i', $exibe1);
//        $totalColetado = 0;
        $tituloGeral = array();
        foreach ($keywords as $k => $v) {

            if (Str::contains($keywords[$k], '<h2 class="module-header">')) {
                $idTituloGeral = $k;
                $limpaTituloGeral1 = Str::after($keywords[$k], '<h2 class="module-header">');
                $limpaTituloGeral11 = Str::before($limpaTituloGeral1, '<');
                $tituloGeral[$k]['titulogeral'] = trim($limpaTituloGeral11);
                $tituloGeral[$k]['url'] = [];
                $tituloGeral[$k]['title'] = [];
                $tituloGeral[$k]['imagem'] = [];
                $tituloGeral[$k]['criadores'] = [];

                foreach ($keywords as $k => $v) {

                    if (Str::contains($keywords[$k], '<div class="row-item-image">')) {
                        $limpaTituloComic1 = Str::after($keywords[$k], '<a href="   //');
                        $limpaTituloComic2 = Str::before($limpaTituloComic1, '" class="');
                        array_push($tituloGeral[$idTituloGeral]['url'], trim('https://' . $limpaTituloComic2));
//                        $totalColetado += 1;

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
        return view('comics', compact('tituloGeral'));
    }
}
