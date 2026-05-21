@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 30px 20px;">
<div style="margin-bottom: 40px;">
        <div class="row align-items-center">
            
            <div class="col-md-5 col-sm-12 text-center mb-4 mb-md-0">
                <img src="https://images.pexels.com/photos/3962287/pexels-photo-3962287.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Artesanía" style="width: 100%; height: 400px; object-fit: cover; border-radius: 5px;">
            </div>

            <div class="col-md-7 col-sm-12" style="padding-left: 30px;">
                @auth
                    @if(auth()->user()->isAdmin())
                        <h1 style="color: #5d4e37; font-size: 36px; margin-bottom: 20px; text-align: center;">¡Bienvenido jefe!</h1>
                        <p style="color: #666; font-size: 16px; line-height: 1.6; text-align: center;">Panel de administración de la tienda artesanal. Accede a tus herramientas desde el menú.</p>
                    @else
                        <h1 style="color: #5d4e37; font-size: 32px; margin-bottom: 20px;">¿Hola {{ auth()->user()->usuario }}, qué te apetece comprar hoy?</h1>
                        <div style="text-align: justify;">
                            <p style="color: #666; font-size: 16px; line-height: 1.6;">En un mundo dominado por la producción en serie, en <strong>Tienda Artesanal</strong> apostamos por lo eterno. Creemos que los objetos cotidianos no deben ser productos sin rostro, sino historias vivas que conectan el talento de los maestros artesanos mexicanos con tu hogar. Nuestra misión es ser el puente que dignifica este legado ancestral.</p>
                            <p style="color: #666; font-size: 16px; line-height: 1.6;">Cada pieza de nuestro catálogo ha sido moldeada, tejida o tallada a mano con una pasión y dedicación imposibles de replicar en una fábrica. Desde el barro modelado en Oaxaca hasta los vibrantes textiles chiapanecos, cada objeto es único. Al ser elaborados mediante procesos manuales, poseen esas pequeñas variaciones que son, en realidad, la firma del artista y la prueba de su autenticidad.</p>
                        </div>
                    @endif
                @else
                    <h1 style="color: #5d4e37; font-size: 36px; margin-bottom: 20px;">Bienvenido a ARTESANSHOP</h1>
                    <div style="text-align: justify;">
                        <p style="color: #666; font-size: 16px; line-height: 1.6;">En un mundo dominado por la producción en serie, en <strong>Tienda Artesanal</strong> apostamos por lo eterno. Creemos que los objetos cotidianos no deben ser productos sin rostro, sino historias vivas que conectan el talento de los maestros artesanos mexicanos con tu hogar. Nuestra misión es ser el puente que dignifica este legado ancestral.</p>
                        <p style="color: #666; font-size: 16px; line-height: 1.6;">Cada pieza de nuestro catálogo ha sido moldeada, tejida o tallada a mano con una pasión y dedicación imposibles de replicar en una fábrica. Desde el barro modelado en Oaxaca hasta los vibrantes textiles chiapanecos, cada objeto es único. Al ser elaborados mediante procesos manuales, poseen esas pequeñas variaciones que son, en realidad, la firma del artista y la prueba de su autenticidad.</p>
                    </div>
                @endauth
            </div>

        </div>
    </div>

    <div style="margin-top: 50px; text-align: center;">
        <h2 style="color: #5d4e37; margin-bottom: 20px;">Nuestras Colecciones</h2>
        <p style="color: #666; margin-bottom: 30px;">
            Explora nuestro catálogo completo de productos artesanales cuidadosamente seleccionados.
        </p>
        <a href="{{ route('catalogo') }}" style="display: inline-block; background-color: #a0826d; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">Ver Catálogo</a>
    </div>
</div>
@endsection
