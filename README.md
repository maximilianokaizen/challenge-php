# Challenge Coding&Company

El proyecto fue creado utilizando Laravel 10, usando sails, con docker en un OS Linux.
En el sitio oficial de laravel se encuentran las guías para el setup del mismo.

[Guía de Laravel 10 con Sail](https://laravel.com/docs/10.x#sail-on-linux)

## Setup

0. **Requisitos**: Tener Docker/Docker Desktop instalado.
1. **Clonar el repositorio**.
2. **Iniciar el entorno de desarrollo**: Ejecutar `./vendor/bin/sail up` en la terminal.
3. **Correr migraciones**: Ejecutar `./vendor/bin/sail artisan migrate`.
4. **Poblar la base de datos**: Ejecutar `./vendor/bin/sail artisan db:seed` para correr los seeders y poblar la base de datos.
5. **Refrescar la base de datos**: Para refrescar la base de datos con nuevas migraciones y seeders, ejecute `./vendor/bin/sail artisan db:refresh`. Este comando borrará todos los datos existentes y volverá a poblar la base de datos con datos de prueba.

## Warnings

Durante la instalación oficial puede haber problemas con los folders donde se cachea información y logs, por ejemplo `/var/www/html/storage/`. Para solucionar esto, ingrese a la terminal del container de Docker con `docker exec -it {container_id} /bin/bash` y ejecute:

chmod -R 775 /var/www/html/storage/
chmod -R 777 /var/www/html/storage/logs/
chmod -R 777 /var/www/html/storage/framework/

Para obtener más ayuda sobre el uso de Sail, puede ejecutar `./vendor/bin/sail -h` o revisar la [documentación oficial de Laravel Sail](https://laravel.com/docs/10.x/sail).

## Screenshots


![image](https://github.com/maximilianokaizen/challenge-php/assets/148482605/1e6e12ed-e016-4fdc-8dd0-0788fad7b416)

![image](https://github.com/maximilianokaizen/challenge-php/assets/148482605/286c4248-6454-443f-8f0f-1c81173a4e97)

# Challenge Coding&Company

El proyecto fue creado utilizando Laravel 10, usando sails, con docker en un OS Linux.
En el sitio oficial de laravel se encuentran las guías para el setup del mismo.

[Guía de Laravel 10 con Sail](https://laravel.com/docs/10.x#sail-on-linux)

## Setup

0. **Requisitos**: Tener Docker/Docker Desktop instalado.
1. **Clonar el repositorio**.
2. **Iniciar el entorno de desarrollo**: Ejecutar `./vendor/bin/sail up` en la terminal.
3. **Correr migraciones**: Ejecutar `./vendor/bin/sail artisan migrate`.
4. **Poblar la base de datos**: Ejecutar `./vendor/bin/sail artisan db:seed` para correr los seeders y poblar la base de datos.
5. **Refrescar la base de datos**: Para refrescar la base de datos con nuevas migraciones y seeders, ejecute `./vendor/bin/sail artisan db:refresh`. Este comando borrará todos los datos existentes y volverá a poblar la base de datos con datos de prueba.

## Warnings

Durante la instalación oficial puede haber problemas con los folders donde se cachea información y logs, por ejemplo `/var/www/html/storage/`. Para solucionar esto, ingrese a la terminal del container de Docker con `docker exec -it {container_id} /bin/bash` y ejecute:

chmod -R 775 /var/www/html/storage/
chmod -R 777 /var/www/html/storage/logs/
chmod -R 777 /var/www/html/storage/framework/

Para obtener más ayuda sobre el uso de Sail, puede ejecutar `./vendor/bin/sail -h` o revisar la [documentación oficial de Laravel Sail](https://laravel.com/docs/10.x/sail).

## Screenshots


![image](https://github.com/maximilianokaizen/challenge-php/assets/148482605/1e6e12ed-e016-4fdc-8dd0-0788fad7b416)

![image](https://github.com/maximilianokaizen/challenge-php/assets/148482605/286c4248-6454-443f-8f0f-1c81173a4e97)

![image](https://github.com/maximilianokaizen/challenge-php/assets/148482605/c2a210f2-0edc-441a-9039-2d5e42c7dcc0)
