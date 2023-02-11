@component('mail::message')

# Hola, 

<br>

<p>Has recibido un nuevo mensaje desde el formulario de contacto de la tienda virtual de {{ config("app.name") }}</p>

<p>
    <strong>Nombre y Apellido:</strong> {{ $name }}
</p>

<p>
    <strong>Correo electrónico:</strong> {{ $email }} 
</p>

<p>
    <strong>Asunto:</strong> {{ $textSubject }}
</p>

<p>
    {{ $mensaje }}
</p>
    
@endcomponent