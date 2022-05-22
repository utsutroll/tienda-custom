<div>
    <section id="page-header" class="about-header">
        <h2>#KnowUs</h2>
        
        <p>Lorem ipsum dolor sit amet consectetur.</p>
    </section>

    <section id="about-head" class="section-p1">
        <img src="{{ ('dist/new/img/about/a6.jpg') }}">
        <div>
            <h2>Who we Are?</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio possimus officiis labore, molestiae dignissimos hic, dolore voluptates quasi est eaque porro incidunt quidem. Eligendi amet atque debitis ipsam harum iure.</p>

            <abbr title="">Create stunning images wth as much or as little control as you like thanks to a choice of Basic and Creative modes.</abbr>

            <br><br>

            <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">Create stunning images wth as much or as little control as you like thanks to a choice of Basic and Creative modes.</marquee>
        </div>
    </section>

    <section id="about-app" class="section-p1">
        <h1>Download Our <a href="#">App</a></h1>
        <div class="video">
            <video autoplay muted loop src="{{ url('dist/new/img/about/1.mp4') }}"></video>
        </div>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f1.png') }}" alt="">
            <h6>Envío gratuito</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f2.png') }}" alt="">
            <h6>Pedido en línea</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f3.png') }}" alt="">
            <h6>Ahorre dinero</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f4.png') }}" alt="">
            <h6>Promociones</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f5.png') }}" alt="">
            <h6>Venta segura</h6>
        </div>
    
        <div class="fe-box">
            <img src="{{ url('dist/new/img/features/f6.png') }}" alt="">
            <h6>Soporte 24/7</h6>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        $('#LiAbout').addClass("active");
    </script>
@endpush
