@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Comics
                    </h2>
                </div>
                @foreach($comics as $com)

                    <article class="card">

                        <TABLE BORDER=0 class="table-comics">
                            <TR>
                                <TD>
                                    <a href=" {!!  '/comicApi/'.$com['id']  !!} ">
                                        <img
                                            src="{{ $com['thumbnail']['path'] }}/portrait_fantastic.jpg"
                                            alt="{{ $com['title'] }}">
                                    </a>
                                </TD>
                                <TD>
                                    <div class="comics">
                                        <br/>
                                        <p><span>Titulo:</span> {{ $com['title'] }}</p>
                                        <p><span>Descrição:</span> {{ Str::limit($com['description'], 160) }}</p>
                                        <p><span>Detalhe Específico:</span>
                                            <a href=" {!!  '/comicApi/'.$com['id']  !!} ">
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
