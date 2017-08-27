<footer style="text-align: center;">
    <a class="inverse" href="{{ route('contact') }}">contact</a>
     | 
    <a class="inverse" href="{{ route('mentionslegales') }}">mentions légales</a>
    <br>
    <small>© Lycée Moyo {{ \Carbon\Carbon::now()->format('Y') }}</small>
</footer>