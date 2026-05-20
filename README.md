# Tienda online de productos artesanales
Plataforma web para la venta de productos artesanales únicos, con catálogo visual, gestión de inventario en tiempo real y flujo de pedidos. Incluye vista pública, área de usuario y panel de administración para stock, precios y pedidos, con control de cantidades, totales y descuentos.

El servidor se inicia de momento asi:
``` bash
touch database/database.sqlite && php artisan migrate --seed && php artisan serve
``` 

Para detenerlo simplemente hacer:
``` bash
Ctrl + C 
``` 

Queda pendiente (lo hago en un rato)
hacer las cosas adaptables a movil y solucionar buig de stock de carritos, solo me deja meter uno de cada uno.
