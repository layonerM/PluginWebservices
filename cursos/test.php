<?php

require_once('../../config.php');

// Establecer el entorno de ejecución de Moodle.
define('CLI_SCRIPT', true);

// Incluir las librerías necesarias.
require_once($CFG->libdir.'/filelib.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/local/cursos/externallib.php');

// Inicializar la aplicación de Moodle.
$CFG->debug = (E_ALL | E_STRICT);
$CFG->debugdisplay = 1;
$CFG->perfdebug = 15;

// Inicializar la base de datos de Moodle.
$DB = new moodle_database();
mtrace("Database Connection: " . print_r($DB->get_dbh(), true));

// Obtener los parámetros de la solicitud, por ejemplo, desde un cliente externo.
$page = optional_param('page', 1, PARAM_INT);
$per_page = optional_param('per_page', 10, PARAM_INT);

// Llamar al webservice personalizado para obtener la lista paginada de cursos.
$params = array('page' => $page, 'per_page' => $per_page);
$course_data = local_cursos_external::get_courses($params['page'], $params['per_page']);

// Imprimir la respuesta en formato JSON.
echo json_encode($course_data);



// token:6c9a83906be6fb4d32135c460dc0426a
// &moodlewsrestformat=json
// $course_id = 8;
// http://localhost/webservice/rest/server.php?wstoken=6c9a83906be6fb4d32135c460dc0426a&wsfunction=local_cursos_get_courses&moodlewsrestformat=json
//Wsfuncion:local_cursos_get_courses

