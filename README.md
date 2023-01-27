# Aveonline Compras

sistema de órdenes de compra que permite que los clientes gestionen la cantidad de unidades a despachar por producto.

## Empezando

### Lanzar el proyecto inicial

_(Suponiendo que haya [instalado Laravel](https://laravel.com/docs/7.x))_
_(Suponiendo que haya [instalado Composer](https://getcomposer.org/download))_

Bifurque este repositorio, luego clone su bifurcación y ejecútelo en su directorio recién creado:

```bash
composer install
```

A continuación, debe hacer una copia del `.env.example` archivo y cambiarle el nombre `.env` dentro de la raíz de su proyecto.

```
cp .env.example .env
```

Ejecute el siguiente comando para generar su clave de aplicación:

```
php artisan key:generate
```

Luego inicie su servidor:

```
php artisan serve
```

A continuación, configure su base de datos y use:

```
php artisan migrate
```

Si desea insertar los datos de prueba en la base de datos utilice:

```
php artisan db:seed
```

_Si necesita más información sobre laravel sanctum puede leer la documentación([Laravel Sanctum]https://laravel.com/docs/7.x/sanctum#main-content))_

¡Tu proyecto inicial de Laravel ya está en marcha!

## Licencia

El marco de Laravel y este proyecto es un software de código abierto con licencia MIT.
