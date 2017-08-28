@extends ('layouts.front')
@section ('title', 'Contact')

@section ('content')
        <div class="container">
            <h2>Contact</h2>
        </div>
    <div class="container">
        <p>
            Utilisez ce formulaire pour contacter l'administrateur du site. Tous les champs sont obligatoires.
        </p>
        <form method="post" class="validate" novalidate>
            {{ csrf_field() }}
            <div class="grid-2 has-gutter">
            <div class="one-half field">
                <label for="name">
                    Votre nom
                </label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="one-half field">
                <label for="email">
                    Votre email
                </label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="full field">
                <label for="content">
                Votre message
                </label>
                <textarea name="content" id="content" rows="10" required></textarea>
            </div>
            </div>
            <div class="validation grid-2 has-gutter-l">
                <div class="g-recaptcha one-half" data-sitekey="{{ env('RECAPTCHA_PUBLIC') }}"></div>
                <div class="one-half align-right">
                    <button type="submit" class="submit">Envoyer le message</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section ('scripts')
    @parent
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ URL::asset('utils/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/frontValidate.js') }}"></script>
@endsection