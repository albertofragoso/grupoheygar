@component('mail::message')
# ¡Hola, {{ $user }}!

Hemos iniciado el trabajo de tu producto.

@component('mail::button', ['url' => 'http://grupoheygar.mx/products/'.$product->id])
Revisa su status
@endcomponent

Gracias por trabajar con Grupo Heygar
@endcomponent
