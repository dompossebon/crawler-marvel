@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h2>
                        {{ $attributionText }}
                    </h2>
                    {{ $copyright }} - {{ $option }}
                </div>
                <div class="results">
                    <article>
                        @if(isset($comic['thumbnail']))
                        <img src="{{ $comic['thumbnail']['path'] }}/portrait_fantastic.jpg"
                             alt="{{ $comic['title'] ?? $comic['name']}}">
                        @else
                            <p>Does Not Exist Image</p>
                            <p>Does Not Exist Image</p>
                            <p>Does Not Exist Image</p>
                            @endif

                        <h2>{{ $comic['title'] ?? $comic['name'] }}</h2>
                        <p>
                            {!! $comic['description'] !!}
                        </p>

                        @if(isset($series))

                        <div id="series">series
                            <h2>{{ $series['title'] ?? ''}}</h2>
                            Description<p>
                                {!! $series['description'] ?? 'Does not exist' !!}
                            </p>
                            <div id="series">
                                <h3>From Series: {{ $series['title']}}</h3>
                                <div class="years">
                                    <span>Start year: {{ $series['startYear'] }}</span>
                                    <span>End year: {{ $series['endYear'] }}</span>
                                </div>
                                <div class="rating">
                                    Rating: {{ $series['rating'] }}
                                </div>
                                @if($series['creators']['available'] > 0)
                                    <div class="creators">
                                        <h4>Creators</h4>
                                        <ul>
                                            @foreach($series['creators']['items'] as $creator)
                                                <li>{{ $creator['name'] }} ({{ $creator['role'] }})</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($series['characters']['available'] > 0)
                                    <div class="characters">
                                        <h4>Characters</h4>
                                        <ul>
                                            @foreach($series['characters']['items'] as $character)
                                                <li>{{ $character['name'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($series['stories']['available'] > 0)
                                    <div class="stories">
                                        <h4>Stories</h4>
                                        <ul>
                                            @foreach($series['stories']['items'] as $story)
                                                <li>
                                                    {{ $story['name'] }} <br>
                                                    type: {{ $story['type'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                            @else
                            <div id="comic">series
                                <h2>{{ $comic['title'] ?? ''}}</h2>
                                Description<p>
                                    {!! $comic['description'] ?? 'Does not exist' !!}
                                </p>
                                <div id="series">
                                    <h3>From Series: {{ $comic['title']}}</h3>
                                    <div class="years">
                                        <span>Start year: {{ $comic['startYear'] }}</span>
                                        <span>End year: {{ $comic['endYear'] }}</span>
                                    </div>
                                    <div class="rating">
                                        Rating: {{ $comic['rating'] }}
                                    </div>
                                    @if($comic['creators']['available'] > 0)
                                        <div class="creators">
                                            <h4>Creators</h4>
                                            <ul>
                                                @foreach($comic['creators']['items'] as $creator)
                                                    <li>{{ $creator['name'] }} ({{ $creator['role'] }})</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if($comic['characters']['available'] > 0)
                                        <div class="characters">
                                            <h4>Characters</h4>
                                            <ul>
                                                @foreach($comic['characters']['items'] as $character)
                                                    <li>{{ $character['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if($comic['stories']['available'] > 0)
                                        <div class="stories">
                                            <h4>Stories</h4>
                                            <ul>
                                                @foreach($comic['stories']['items'] as $story)
                                                    <li>
                                                        {{ $story['name'] }} <br>
                                                        type: {{ $story['type'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </article>

                </div>
            </div>
        </div>
    </div>
@stop
