@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h2>Comics - TOTAL
                        de: {{ count($tituloGeral[0]['url'])+count($tituloGeral2[0]['url'])+count($tituloGeral4[2]['url']) }}</h2>
                </div>

                <div class="card-body">
                    <h2> {{ $tituloGeral[0]['titulogeral'] }} </h2>
                </div>
                <TABLE BORDER=0>
                    @for ($i = 0; $i < count($tituloGeral[0]['url']); $i++)

                        <TR>
                            <TD><a href=" {!! $tituloGeral[0]['url'][$i] !!} "><img src="{!! asset($tituloGeral[0]['imagem'][$i]) !!}" width="120px" height="180px"></a>
                            </TD>
                            <TD><br/>
                                <p>{{ $i }} - URL: {{ $tituloGeral[0]['url'][$i] }}</p>
                                <p><b>Titulo:</b> {{ $tituloGeral[0]['title'][$i] }}</p>
                                <p><b>Imagem:</b> {{ $tituloGeral[0]['imagem'][$i] }}
                                <p><b>Criador:</b> {!! $tituloGeral[0]['criadores'][$i] !!}</p>
                                <hr>
                            </TD>
                        </TR>

                    @endfor
                </TABLE>

                <div class="card-body">
                    <h2> {{ $tituloGeral2[0]['titulogeral'] }} </h2>
                </div>
                <TABLE BORDER=0>
                    @for ($i = 0; $i < count($tituloGeral2[0]['url']); $i++)

                        <TR>
                            <TD><a href=" {!! $tituloGeral2[0]['url'][$i] !!} "><img src="{!! asset($tituloGeral2[0]['imagem'][$i]) !!}" width="120px" height="180px"></a>
                            </TD>
                            <TD><br/>
                                <p>{{ $i }} - URL: {{ $tituloGeral2[0]['url'][$i] }}</p>
                                <p><b>Titulo:</b> {{ $tituloGeral2[0]['title'][$i] }}</p>
                                <p><b>Imagem:</b> {{ $tituloGeral2[0]['imagem'][$i] }}
                                <p><b>Criador:</b> {!! $tituloGeral2[0]['criadores'][$i] !!}</p>
                                <hr>
                            </TD>
                        </TR>

                    @endfor
                </TABLE>
                <div class="card-body">
                    <h2> {{ $tituloGeral4[2]['titulogeral'] }} </h2>
                </div>
                <TABLE BORDER=0>
                    @for ($i = 0; $i < count($tituloGeral4[2]['url']); $i++)

                        <TR>
                            <TD><a href=" {!! $tituloGeral4[2]['url'][$i] !!} "><img src="{!! asset($tituloGeral4[2]['imagem'][$i]) !!}" width="120px" height="180px"></a>
                            </TD>
                            <TD><br/>
                                <p>{{ $i }} - URL: {{ $tituloGeral4[2]['url'][$i] }}</p>
                                <p><b>Titulo:</b> {{ $tituloGeral4[2]['title'][$i] }}</p>
                                <p><b>Imagem:</b> {{ $tituloGeral4[2]['imagem'][$i] }}
                                <p><b>Criador:</b> {!! $tituloGeral4[2]['criadores'][$i] !!}</p>
                                <hr>
                            </TD>
                        </TR>

                    @endfor
                </TABLE>

            </div>
        </div>
    </div>
@endsection
