@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Histórias
                    </h2>
                </div>
                @foreach($stories as $storie)

                    <article class="card">

                        <TABLE BORDER=0 class="table-comics">
                            <TR>
                                <TD width="300">
                                    <p>Título:</p>
                                    <a href=" {!!  '/storieApi/'.$storie['id']  !!} ">
                                        {{ $storie['title'] }}
                                    </a>
                                </TD>
                                <TD>
                                    <div class="comics">
                                        <br/>
                                        <p><span>Edição original:</span> {{ $storie['originalIssue']['name'] }}</p>
                                        <p><span>Detalhe Específico:</span>
                                            <a href=" {!!  '/storieApi/'.$storie['id']  !!} ">
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
