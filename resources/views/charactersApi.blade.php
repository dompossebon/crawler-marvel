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
                @foreach($characters as $character)

                    <article class="card">

                        <TABLE BORDER=0 class="table-comics">
                            <TR>
                                <TD>
                                    <a href=" {!!  '/characterApi/'.$character['id']  !!} ">
                                        <img
                                            src="{{ $character['thumbnail']['path'] }}/portrait_incredible.jpg"
                                            alt="{{ $character['name'] }}"
                                            width="130px"
                                            height="200px">
                                    </a>
                                </TD>
                                <TD>
                                    <div class="comics">
                                        <br/>
                                        <p><span>Nome do Personagem:</span> {{ $character['name'] }}</p>
                                        <p><span>Descrição:</span> {{ Str::limit($character['description'], 160) }}</p>
                                        <p><span>Detalhe Específico:</span>
                                            <a href=" {!!  '/characterApi/'.$character['id']  !!} ">
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
