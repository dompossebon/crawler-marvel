@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="total-coletado">Displaying a total of: {{$totalCollected}}</div>
                @foreach($generalTitle as $key => $v)
                    <div class="card-header">
                        <h2>
                            {{$generalTitle[$key]['generalTitle']}}
                        </h2>
                        <p>In this section we have a total of {{count($generalTitle[$key]['url'])}} Magazines</p>
                    </div>
                    <br/>
                    <TABLE BORDER=0 class="table-comics">
                        @for ($i = 0; $i < count($generalTitle[$key]['url']); $i++)
                            <TR>
                                <TD>
                                    <a href="{!!  '/detailOption/'.$generalTitle[$key]['id'][$i].'/'.'comics'  !!}">
                                        <img
                                            src="{!! asset($generalTitle[$key]['image'][$i]) !!}" width="130px"
                                            height="200px">
                                    </a>
                                </TD>
                                <TD>
                                    <div class="comics">
                                        <br />
                                        <p><span>{{ $i }}</span></p>
                                        <p><span>Title:</span> {{ $generalTitle[$key]['title'][$i] }}</p>
                                        <p><span>Image:</span> {{ $generalTitle[$key]['image'][$i] }}</p>
                                        <p><span>URL: </span><span class="url">{{ $generalTitle[$key]['url'][$i] }}</span></p>
                                        <p><span>Creators:</span> {!! $generalTitle[$key]['creators'][$i] !!}</p>
                                        <p><span>Details:</span>
                                            <a href="{!!  '/detailOption/'.$generalTitle[$key]['id'][$i].'/'.'comics'  !!}">
                                                Click Here
                                                <a/>

                                        </p>
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
