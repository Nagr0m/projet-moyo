@extends('layouts.back')

@section('title', 'Créer un nouvel article')

@section('content')

    <div class="section">
        <div class="row">
            {{-- Front-end validation --}}
            <div class="col s12 frontErrors" style="display:none">
                <div class="panel col s12">
                    <div class="panel-content">
                        Certains champs comportent des erreurs.
                    </div>
                </div>
            </div>
            {{-- Back-end validation --}}
            @if(count($errors) > 0)
                <div class="col s12 backErrors">
                    <div class="panel col s12">
                        <div class="panel-content">
                            Le formulaire comporte des erreurs.
                        </div>
                    </div>
                </div>
            @endif

            <form method="post" action="{{ route('posts.store') }}" id="postForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <section class="col s12 m4 push-m8">
                    <div class="panel">
                        <div class="panel-content row">
                            <div class="col s12" id="thumbnailUpload">
                                <h6>Image principale <i class="material-icons red-text right btn-flat" id="imageClear" style="display:none">delete</i></h6>
                                <img class="materialboxed" src="">
                                <div class="file-field input-field @if($errors->has('thumbnail')) invalid @endif" data-error="{{ $errors->first('thumbnail') }}">
                                    <div class="btn green z-depth-0">
                                        <span>Importer</span>
                                        <input type="file" name="thumbnail">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <select name="published" id="published">
                                    <option value="1" {{ selected_fields('1', old('published'), 'selected') }}>Publié</option>
                                    <option value="0" selected>Non publié</option>
                                </select>
                                <label for="published">Statut (obligatoire)</label>
                            </div>
                            <div class="input-field col s12 center-align">
                                <button type="submit" class="btn green z-depth-0">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col s12 m8 pull-m4">
                    <div class="panel row">
                        <div class="panel-head col s12 light-blue-text">
                            <i class="material-icons left">description</i>Créer un nouvel article
                        </div>
                        <div class="divider"></div>
                        <div class="panel-content col s12">
                            <div class="row">
                                <div class="input-field col s12 @if($errors->has('title')) invalid @endif" data-error="{{$errors->first('title')}}">
                                    <input type="text" name="title" id="title" @if($errors->has('title')) class="invalid" @endif value="{{ old('title') }}">
                                    <label for="title">Titre de l'article (obligatoire)</label>
                                </div>
                                <div class="input-field col s12 @if($errors->has('content')) invalid @endif" data-error="{{$errors->first('content')}}">
                                    <textarea id="content" name="content" class="materialize-textarea @if($errors->has('content')) invalid @endif">{{ old('content') }}</textarea>
                                    <label for="content">Article (obligatoire)</label>
                                </div>
                                <div class="input-field col s12 @if($errors->has('abstract')) invalid @endif" data-error="{{$errors->first('abstract')}}">
                                    <input type="text" name="abstract" id="abstract" value="{{ old('abstract') }}">
                                    <label for="abstract">Extrait</label>
                                </div>
                                <p class="col s12">L'extrait est affiché sur l'accueil du site et la liste des articles. Laisser vide pour un extrait automatique.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </form>

        </div>
    </div>

@endsection

@section('scripts')
    @parent

    <script src="{{ URL::asset('js/formPosts.js') }}"></script>
@endsection