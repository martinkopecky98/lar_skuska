{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/contact') }}">
            Contact
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav> --}}
<style>

.footer {
    width: 100%;
    background: #1a8cff;
    padding: 20px 0;
}
.footer-wrap {
    display: flex;
    flex-direction: row;
    width: 80%;
    margin: auto;
    justify-content: space-between;
    align-items: center;
}
.footer-wrap li {
    width: 45%;
    font-size: 1.5em;
    color: white;
}
.footer p {
    color: white;
    font-size: 1.2em;
}
.laravel {
    color: #ff0000;
    text-decoration: italic;
}
</style>

<div class="footer">
    <ul class="footer-wrap">
        <li>Autor: Martin Kopecký</li>
        <li>vytvorené 2020</li>
    </ul>
    <p>Powered by <span class="laravel">Laravel</span></p>
</div>
<div> 
    <img style="w-100" src="http://localhost:8080/lar_skuska/public/storage/images/Capture.JPG">
</div>