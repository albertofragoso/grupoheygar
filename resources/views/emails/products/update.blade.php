@component('mail::message')
# ¡Hola, {{ $user }}!

Hemos avanzado en el proceso de entrega de tu producto.

@component('mail::button', ['url' => 'http://grupoheygar.mx/products/'.$product->id])
Revisa su status
@endcomponent

Gracias por trabajar con Grupo Heygar
@endcomponent
