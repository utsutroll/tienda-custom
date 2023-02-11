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
        <img class="w-full" src="{{ ('dist/new/img/about/a1.jpeg') }}">
        <div>
            <h2 class="text-4xl mb-4 text-gray-900 font-sans font-bold leading-10">Somos INVERSIONES MEKA C.A</h2>
            <p>
                Todo en Papeleria y Tecnología al alcance de tu mano. Podrás encontrarnos en la Av. Ricardo Pérez Zambrano, frente a la plazoleta el Samán al lado de la Panadería El Tigre, Edif. Hermanos Nimer. Acá encontrarás todo lo relacionado con Tecnología, Aseo Personal, productos para el hogar y mucho más. 
            </p><br>

            <p>
                Contamos con una sucursal donde encontraras todo en papelería para el Colegio y oficina, además, podrás realizar tus creaciones o manualidades con todo lo que tenemos para ti, y para la temporada navideña ofrecemos todo en adornos, y luces de navidad. La sucursal se encuentra ubicada en la Avenida Ricardo Pérez Zambrano, diagonal a nuestro antiguo local.
            </p><br>

            <p>
                No dejes de visitarnos y conocer la gran variedad de productos que tenemos para ti, te hacemos la vida más  fácil, hermosa y colorida.
            </p>

            <br><br><br>

            <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">No dejes de visitarnos y conocer la gran variedad de productos que tenemos para ti, te hacemos la vida más  fácil, hermosa y colorida.</marquee>
        </div>
    </section>

    <section id="about-app" class="section-p1">
        <h1 class="mb-4 text-5xl text-gray-900 font-sans font-bold leading-10">Nuestra Tienda Física</h1>
        <div class="bg-gray-800 rounded-t-3xl flex justify-center">
            <div class="gallery my-4">
                <img src="{{ asset('dist/new/img/about/a2.jpeg') }}">
                <img src="{{ asset('dist/new/img/about/a3.jpeg') }}">
                <img src="{{ asset('dist/new/img/about/a4.jpeg') }}">
                <img src="{{ asset('dist/new/img/about/a5.jpeg') }}">
            </div>
        </div>

        <div class="video bg-gray-800 rounded-b-3xl flex justify-center mb-4">
            <video autoplay loop src="{{ asset('dist/new/img/video/tienda.mp4') }}"></video>
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
                    <p class="txt-base text-gray-800 font-semibold">Edif. Hermanos Nimer, Av. Ricardo Pérez Zambrano, frente a la plazoleta el Samán Al lado de la Panadería El Tigre, Villa Buzual Tureén, Portuguesa</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p class="txt-base text-gray-800 font-semibold">inversiones.meka@hotmail.com</p>
                </li>
                {{-- <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>+1 (234) 456 5678</p>
                </li> --}}
                <li>
                    <i class="far fa-clock"></i>
                    <p class="txt-base text-gray-800 font-semibold">7:30 Am - 06:00 Pm, Lunes a Sábados</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15748.100995584076!2d-69.1149122!3d9.3310299!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e7dcd2d360df489%3A0xc5ada589aa5c80aa!2sInversiones%20Meka%20C.A!5e0!3m2!1ses-419!2sve!4v1675388045596!5m2!1ses-419!2sve" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        
        <form wire:submit.prevent="ContactForm">
            <span>ENVÍANOS UN MENSAJE</span>
            <h2 class="font-bold">Nos encanta saber de ti</h2>

            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
            <input type="text" wire:model.defer='name' class="input" placeholder="Nombre y Apellido">
            <input type="text" wire:model.defer='email' class="input" placeholder="Correo Electrónico">
            <input type="text" wire:model.defer='subject' class="input" placeholder="Asunto">
            <textarea wire:model.defer='mensaje' class="textarea" cols="30" rows="10" placeholder="Mensaje..."></textarea>
            <button type="submit" class="normal">Enviar</button>
        </form> 
        
        <div class="peoble">

        </div>
    </section>
</div>

@push('css')
    <style>
        #about-app .video video {
            width: 40%;
            height: 40%;
            /* border-radius: 20px; */
        }

        .gallery {
            display: flex;
            width: 600px;
            height: 430px;
        }

        .gallery img{
            width: 0px;
            flex-grow: 1;
            object-fit: cover;
            opacity: .8;
            transition: .5s ease;
        }

        .gallery img:hover{
            cursor: crosshair;
            width: 300px;
            opacity: 1;
            filter: contrast(120%);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('#LiAbout').addClass("active");
    </script>
@endpush
