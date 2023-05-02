## <nombre_proyecto>

Proyecto <nombre_proyecto> .
- Framework Laravel 6.7
- Pasarela de pagos usado es MercadoPago
- Base de datos MySQL

## Pasos para instalar



### 1. Descargar el proyecto desde [GitHub]
```
$ git clone <url_proyecto>
```


### 2. Instalar las dependencias
```
$ composer install
```
otra alternativa es :
```
$ composer update
```
#### Si no funciona, puede probar.
```
$ composer install --ignore-platform-reqs
```
otra alternativa es :
```
$ composer update --ignore-platform-reqs
```


### 3. Limpiar el proyecto
```
$ php artisan optimize:clear
```


### 4. Crear .env y Configurar
```
$ cp .env.example .env
```
-Nota: Configurar el .env con los datos de conexión a la base de datos y mercadopago


### 5. Generar key
```
$ php artisan key:generate
```


### 6. Iniciar migraciones
```
$ php artisan migrate
```


### 7. Plantar semillas
```
$ php artisan db:seed
```


### 8. Iniciar servidor
```
$ php artisan serve
```

## Pasos de configuración de Git
```
$ git checkout -b <new_branch>
$ git add .
$ git commit -m "Mensaje de commit"
$ git push origin <new_branch>
```
