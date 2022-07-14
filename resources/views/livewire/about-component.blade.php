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

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>PONTE EN CONTACTO CON NOSOTROS</span>
            <h2 class="font-bold">Visite nuestro local o póngase en contacto con nosotros hoy mismo</h2>
            <h3></h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>Plasoleta el Saman</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>inversiones.meka@hotmail.com</p>
                </li>
                {{-- <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>+1 (234) 456 5678</p>
                </li> --}}
                <li>
                    <i class="far fa-clock"></i>
                    <p>7:30 - 16:00, Lunes a Sabados</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1968.5266719289948!2d-69.11906613535056!3d9.328541215294532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e7dcdea9a3689f1%3A0x5e65e7be09ef1a6d!2sPanader%C3%ADa%20El%20Tigre!5e0!3m2!1ses!2sve!4v1652820874755!5m2!1ses!2sve" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form method="post">
            <span>ENVÍANOS UN MENSAJE</span>
            <h2 class="font-bold">Nos encanta saber de ti</h2>
            <input type="text" class="input" placeholder="Nombre y Apellido">
            <input type="text" class="input" placeholder="Correo Electrónico">
            <input type="text" class="input" placeholder="Asunto">
            <textarea name="" id="" class="textarea" cols="30" rows="10" placeholder="Mensaje..."></textarea>
            <button class="normal">Enviar</button>
        </form> 
        
        <div class="peoble">

        </div>
    </section>
</div>

@push('scripts')
    <script>
        $('#LiAbout').addClass("active");
    </script>
@endpush
