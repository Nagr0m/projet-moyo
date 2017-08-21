@extends('layouts.back')
@section('title', 'Tous les articles')

@section('content')
    <div class="section">
        <div class="row">

            <div class="col s12 frontErrors" style="display:none">
                <div class="panel col s12">
                    <div class="panel-content">
                        {{-- Error message --}}
                    </div>
                </div>
            </div>

            <section class="col s12">
                <div class="panel">
                    <div class="panel-head">
                        <div class="light-blue-text">
                            <i class="material-icons left">description</i>Tous les articles 
                            <a href="{{ route('posts.create') }}" class="btn-flat z-depth-0"><i class="material-icons left">add</i>Ajouter</a>
                        </div>
                        @if (count($posts) > 0)
                            <form method="post" action="{{ route('posts.multiple') }}" id="massForm">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" name="resource" value="ces articles">
                                <div class="resource-options valign-wrapper left-align">
                                    <div class="input-field col s6 m3">
                                        <select name="operation">
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
                        @endif
                        </div>
                        <div class="divider"></div>
                        <div class="panel-content row">
                            <p class="col s12">

                            </p>
                            <div class="divider"></div>
                            @if(count($posts) > 0)
                                <table class="bordered responsive-resources">
                                    <thead>
                                        <th class="center-align">
                                            <input type="checkbox" class="filled-in" id="checkToggle">
                                            <label for="checkToggle">&nbsp;</label>
                                        </th>
                                        <th>Titre</th>
                                        <th>Infos</th>
                                        <th>Commentaires</th>
                                        <th>Publié</th>
                                    </thead>
                                    <tbody>
                            @endif
                            @forelse($posts as $post)
                                <tr id="{{$post->id}}">
                                    <td>
                                        <input type="checkbox" id="check{{$post->id}}" class="filled-in" name="items[]" value="{{$post->id}}">
                                        <label for="check{{$post->id}}">&nbsp;</label>
                                    </td>
                                    <td>
                                        <a href="{{ route('posts.edit', $post->id) }}">{{$post->title}}</a>
                                    </td>
                                    <td>
                                        Le <b>{{ $post->created_at->format('d/m/Y') }}</b> par <b>{{ $post->user->username }}</b>
                                    </td>
                                    <td>
                                        {{ count($post->comments) }}
                                    </td>
                                    <td>
                                        @if($post->published) Publié @else Non publié @endif
                                    </td>
                                </tr>
                            @empty
                                Aucun post
                            @endforelse

                        @if(count($posts) > 0)
                                </tbody>
                            </table>
                        </form>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/massOperations.js') }}"></script>
@endsection