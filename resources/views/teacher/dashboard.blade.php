@extends('layouts.back')

@section('title', 'Tableau de bord')

@section('content')
    <div class="section">
        <div class="row">

            <section class="col s12 l6">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header deep-orange-text text-darken-3"><i class="material-icons left">school</i>Questionnaires</div>
                        <div class="collapsible-body">
                            @forelse($questions as $question)
                                <span class="list-elem valign-wrapper">{{$question->title}}</span>
                                @if($loop->iteration === 5)
                                    @break
                                @endif
                            @empty
                                Aucun questionnaire
                            @endforelse
                        </div>
                    </li>
                </ul>

                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header active light-blue-text"><i class="material-icons left">description</i>Articles</div>
                        <div class="collapsible-body">
                            <b>Derniers articles</b>
                            @forelse($posts as $post)
                                <span class="list-elem valign-wrapper">{{$post->title}}</span>
                                @if($loop->iteration === 5)
                                    @break
                                @endif
                            @empty
                                Aucun article
                            @endforelse
                        </div>
                    </li>
                </ul>
            </section>

            <section class="col s12 l6">
                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header active blue-grey-text"><i class="material-icons left">poll</i>Statistiques</div>
                        <div class="collapsible-body">
                            <span class="stat-elem valign-wrapper"><i class="material-icons left light-blue-text">description</i>{{ $posts->count() }} article{{ plural_string($posts) }}</span>
                            <span class="stat-elem valign-wrapper"><i class="material-icons left deep-orange-text text-darken-3">school</i>{{ $questions->count() }} questionnaire{{ plural_string($questions) }}</span>
                            <span class="stat-elem valign-wrapper"><i class="material-icons left light-green-text">chat</i>{{ $comments->count() }} commentaire{{ plural_string($comments) }}</span>
                            <span class="stat-elem valign-wrapper"><i class="material-icons left brown-text">people</i>{{ $students }} élève{{ plural_string($students) }}</>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </div>
@endsection