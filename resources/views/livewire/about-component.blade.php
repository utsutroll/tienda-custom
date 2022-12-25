<div>
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for ($i = 0; $i < count($sliders); $i++)
            <li data-target="#carousel" data-slide-to="{{$i}}" @if ($i == 0) class="active" @endif></li>
            @endfor
        </ol>

        <div class="carousel-inner" role="listbox">
            @php $n=0 @endphp
            @foreach ($sliders as $s)
            <div @if ($n == 0) class="carousel-item active" @else class="carousel-item" @endif>
                @if ($s->link == '')
                    <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">
                @else
                <a href="{{$s->link}}" target="_blank">
                    <img loading="lazy" class="img-responsive" src="{{Storage::url($s->image->url)}}" alt="{{$s->title}}">   
                </a> 
                @endif
                
                <div class="carousel-caption d-none d-md-block">
                    <h3 style="font-size:2vw;">{{$s->title}}</h3>
                    <p class="m-auto text-gray-200" style="font-size:1vw;">{{$s->subtitle}}</p>
                </div>
            </div>
            @php $n++ @endphp
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>

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

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>PONTE EN CONTACTO CON NOSOTROS</span>
            <h2 class="font-bold">Visite nuestro local o póngase en contacto con nosotros hoy mismo</h2>
            <h3></h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>Plazoleta el Samán</p>
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
