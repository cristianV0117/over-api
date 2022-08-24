@component('mail::message')
    <h1><strong><center>OVER APP</center></strong></h1>
    <p>
        <center>
            Para recuperar contraseña por favor darle click al boton.
        </center>
    </p>
    @component('mail::button', ['url' => ''])
        Recuperar contraseña
    @endcomponent
@endcomponent
