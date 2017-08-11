@extends('layouts.back')
@section('title', 'Tous les articles')

@section('content')
    <div class="section">
        <div class="row">
            <section class="col s12">
                <div class="panel">
                    <div class="panel-head">
                        <div class="light-blue-text">
                            <i class="material-icons left">description</i>Tous les articles 
                            <a href="{{ route('posts.create') }}" class="btn-flat z-depth-0"><i class="material-icons left">add</i>Ajouter</a>
                        </div>
                        <div class="resource-options valign-wrapper left-align">
                            <div class="input-field col s6 m3">
                                <select>
                                    <option value="" disabled selected>Action groupée</option>
                                    <option value="publish">Publier</option>
                                    <option value="unpublish">Brouillon</option>
                                    <option value="delete">Supprimer</option>
                                </select>
                            </div>
                            <div class="col s6 m3">
                                <button class="btn green z-depth-0">Appliquer</button>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content row">
                        <p class="col s12">
                            <input type="checkbox" class="filled-in" id="checkToggle">
                            <label for="checkToggle">Tout sélectioner</label>
                        </p>
                        <div class="divider"></div>
                        @forelse($posts as $post)
                        <p class="page-item col s12 l6">
                            <input type="checkbox" id="{{$post->id}}" class="filled-in" name="item-{{ $post->id }}" value="{{$post->id}}">
                            <label for="{{$post->id}}">
                                <a href="{{route('posts.edit', $post->id)}}"> {{ $post->title }}</a>
                                <br>Créé le {{ $post->created_at->format('d/m/Y') }} par {{ $post->user->username }}
                            </label>
                        </p>
                        @empty
                            Aucun post
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection