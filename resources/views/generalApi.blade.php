@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h2>
                        {{ $option }}
                    </h2>
                </div>
                @foreach($multiDatas as $multiData)

                    <article class="card">

                        <TABLE BORDER=0 class="table-comics">
                            <TR>
                                <TD width="300">
                                    @if(isset($multiData['thumbnail']))
                                    <a href=" {!!  '/detailOption/'.$multiData['id'].'/'.$option  !!} ">
                                        <img
                                            src="{{ $multiData['thumbnail']['path'] }}/portrait_fantastic.jpg">
                                    </a>
                                        @else
                                        <p>Título:</p>
                                        <a href=" {!!  '/detailOption/'.$multiData['id'].'/'.$option  !!} ">
                                            {{ $multiData['title'] }}
                                        </a>
                                        @endif
                                </TD>
                                <TD>
                                    <div class="comics">
                                        <br/>
                                        <p><span>Title:</span> {{ $multiData['title'] ?? $multiData['name'] }}</p>
                                        @if($multiData['description'] != null)
                                        <p><span>Description:</span> {{ Str::limit($multiData['description'], 160) }}</p>
                                        @else
                                            <p><span>Description: Does Not Existe</span>
                                        @endif
                                        <p><span>Details:</span>
                                            <a href=" {!!  '/detailOption/'.$multiData['id'].'/'.$option  !!} ">
                                                Click Here
                                            </a>
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
