@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Events
                    </h2>
                </div>
                @foreach($series as $serie)

                    <article class="card">

                        <TABLE BORDER=0 class="table-comics">
                            <TR>
                                <TD>
                                    <a href=" {!!  '/serieApi/'.$serie['id']  !!} ">
                                        <img
                                            src="{{ $serie['thumbnail']['path'] }}//portrait_fantastic.jpg"
                                            alt="{{ $serie['title'] }}">
                                    </a>
                                </TD>
                                <TD>
                                    <div class="comics">
                                        <br/>
                                        <p><span>Titulo:</span> {{ $serie['title'] }}</p>
                                        <p><span>Descrição:</span> {{ Str::limit($serie['description'], 160) }}</p>
                                        <p><span>Detalhe Específico:</span>
                                            <a href=" {!!  '/serieApi/'.$serie['id']  !!} ">
                                                Clique Aqui
                                                <a/>
                                                </p>
                                    </div>
                                </TD>
                            </TR>
                        </TABLE>

                    </article>
                @endforeach
            </div>
        </div>
    </div>
@stop
