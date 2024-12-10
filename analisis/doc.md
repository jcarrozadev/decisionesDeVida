# Problemas encontrados 


## Hosting
### Distinción de mayúsculas y minúsculas

- Hemos tenido un error de conexión en el Despliegue de la aplicación y ha sido debido a que nuestro `config` de la base de datos, tenia puesto las letras DB en mayúsculas, y al ser Linux el servidor, distingue las mayúsculas de minúsculas. Nosotros, lo tenemos en los archivos con minúscula.

- Hemos cambiado `configDB.php` a `configdb.php` y ya tenemos el despliegue de la aplicación en funcionamiento.