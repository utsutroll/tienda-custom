<div>
    <section id="page-header" class="about-header">
        <h2>#Let's_talk</h2>
        
        <p>LEAVE A MESSAGE, We love to hear from you!</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>56 Glassford Street Glasgow G1 1UL New York</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>contact@example.com</p>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>+1 (234) 456 5678</p>
                </li>
                <li>
                    <i class="far fa-clock"></i>
                    <p>Monday to Saturday 9:00 to 16:00</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1968.5266719289948!2d-69.11906613535056!3d9.328541215294532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e7dcdea9a3689f1%3A0x5e65e7be09ef1a6d!2sPanader%C3%ADa%20El%20Tigre!5e0!3m2!1ses!2sve!4v1652820874755!5m2!1ses!2sve" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form method="post">
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you</h2>
            <input type="text" class="input" placeholder="Your Name">
            <input type="text" class="input" placeholder="E-mail">
            <input type="text" class="input" placeholder="Subject">
            <textarea name="" id="" class="textarea" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button class="normal">Submit</button>
        </form> 
        
        <div class="peoble">
            <div>
                <img src="{{ url('dist/new/img/people/1.png') }}" alt="">
                <p><span>John Doe</span> Senior Marketing Manager <br>Phone: +1 (123) 456 7890 <br> Email: contact@example.com</p>
            </div>
            <div>
                <img src="{{ url('dist/new/img/people/2.png') }}" alt="">
                <p><span>William Smith</span> Senior Marketing Manager <br>Phone: +1 (123) 456 7890 <br> Email: contact@example.com</p>
            </div>
            <div>
                <img src="{{ url('dist/new/img/people/3.png') }}" alt="">
                <p><span>Emma Stone</span> Senior Marketing Manager <br>Phone: +1 (123) 456 7890 <br> Email: contact@example.com</p>
            </div>

        </div>
    </section>
</div>
@push('scripts')
    <script>
        $('#LiContact').addClass("active");
    </script>
@endpush