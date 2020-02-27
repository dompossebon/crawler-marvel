@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                @foreach($tituloGeral as $k => $v)
                    <div class="card-header">
                        <h2>
                            {{$tituloGeral[$k]['titulogeral']}}
                        </h2>
                    </div>
                    <br/>
                    <TABLE BORDER=0 class="table-comics">
                        @for ($i = 0; $i < count($tituloGeral[$k]['url']); $i++)
                            <TR>
                                <TD>
                                    <a href=" {!! $tituloGeral[$k]['url'][$i] !!} ">
                                        <img
                                            src="{!! asset($tituloGeral[$k]['imagem'][$i]) !!}" width="130px"
                                            height="200px">
                                    </a>
                                </TD>
                                <TD>
                                    <div class="comics">
                                        <br />
                                        <p><span>{{ $i }}</span></p>
                                        <p><span>Titulo:</span> {{ $tituloGeral[$k]['title'][$i] }}</p>
                                        <p><span>Imagem:</span> {{ $tituloGeral[$k]['imagem'][$i] }}</p>
                                        <p><span>URL: </span><span class="url">{{ $tituloGeral[$k]['url'][$i] }}</span></p>
                                        <p><span>Criador:</span> {!! $tituloGeral[$k]['criadores'][$i] !!}</p>
                                    </div>
                                </TD>
                            </TR>
                        @endfor
                    </TABLE>
                @endforeach
            </div>
        </div>
    </div>
@endsection
