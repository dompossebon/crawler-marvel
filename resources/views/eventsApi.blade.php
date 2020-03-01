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
                @foreach($events as $event)

                    <article class="card">

                        <TABLE BORDER=0 class="table-comics">
                            <TR>
                                <TD>
                                    <a href=" {!!  '/eventApi/'.$event['id']  !!} ">
                                        <img
                                            src="{{ $event['thumbnail']['path'] }}//portrait_fantastic.jpg"
                                            alt="{{ $event['title'] }}">
                                    </a>
                                </TD>
                                <TD>
                                    <div class="comics">
                                        <br/>
                                        <p><span>Titulo:</span> {{ $event['title'] }}</p>
                                        <p><span>Descrição:</span> {{ Str::limit($event['description'], 160) }}</p>
                                        <p><span>Detalhe Específico:</span>
                                            <a href=" {!!  '/eventApi/'.$event['id']  !!} ">
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
