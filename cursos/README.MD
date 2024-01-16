# Plugin Moodle Cursos

Este plugin proporciona un webservice personalizado para obtener una lista paginada de cursos en Moodle.

## Instalación

1. Descarga el código fuente del plugin y colócalo en la carpeta `local/cursos` de tu instalación de Moodle.

2. Accede al entorno de administración de Moodle y sigue a `Administración del sitio -> Notificaciones`.

3. Moodle detectará la presencia del nuevo plugin y te guiará a través del proceso de instalación. Sigue las instrucciones en pantalla.

4. Después de la instalación, verifica que el servicio web esté habilitado. Accede a `Administración del sitio -> Plugins -> Servicios web -> Gestión de servicios web`.

5. Asegúrate de que el servicio web "Local Cursos Services" esté habilitado.

## Uso del Webservice

Para obtener una lista paginada de cursos, utiliza el siguiente endpoint:

// token:6c9a83906be6fb4d32135c460dc0426a
// &moodlewsrestformat=json
// $course_id = 8;
// http://localhost/webservice/rest/server.php?wstoken=6c9a83906be6fb4d32135c460dc0426a&wsfunction=local_cursos_get_courses&moodlewsrestformat=json
//Wsfuncion:local_cursos_get_courses



Ajusta `TU_TOKEN` al token de tu usuario con los permisos necesarios.

## Parámetros

- `page`: Número de página que se desea obtener. Por defecto, es 1.
- `per_page`: Cantidad de cursos por página. Por defecto, es 10.

## Respuesta

El webservice retornará una respuesta estructurada con la información solicitada.

Ejemplo:

```json
{
  "total": 12,
  "page": 1,
  "per_page": 2,
  "total_pages": 7,
  "data": [
    {
      "id": 1,
      "fullname": "Introducción a la programación",
      "shortname": "Prog-101",
      "summary": "Curso introductorio a la programación en Python",
      "startdate": "2022-02-01",
      "enddate": "2022-05-31",
      "category": "Informática"
    },
  

}
