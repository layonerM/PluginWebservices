
<?php

use core_completion\progress;
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/externallib.php');
require_once($CFG->dirroot.'/user/lib.php');
require_once($CFG->dirroot.'/course/lib.php');

class local_cursos_external extends external_api {

    public static function get_courses_parameters() {
        return new external_function_parameters(
            array(
                'page' => new external_value(PARAM_INT, 'Número de página que se desea obtener. Por defecto debe ser 1.', false, 1),
                'per_page' => new external_value(PARAM_INT, 'Cantidad de cursos por página. Por defecto debe ser 10.', false, 10)
            )
        );
    }

    public static function get_courses($page = 1, $per_page = 10) {
        global $DB;
    
        // Validación de parámetros
        $page = max(1, $page); // Asegurar que la página sea al menos 1
        $per_page = max(1, $per_page); // Asegurar que la cantidad por página sea al menos 1
    
        // Calcula el offset para paginación.
        $offset = ($page - 1) * $per_page;
    
        // Utiliza get_records con limit and offset
        $courses = $DB->get_records('course', array(), '', '*', $offset, $per_page);
    
        // Calcula el total de cursos.
        $total_courses = $DB->count_records('course');
    
        // Calcula el total de páginas disponibles.
        $total_pages = ceil($total_courses / $per_page);
    
        return array(
            'total' => $total_courses,
            'page' => $page,
            'per_page' => $per_page,
            'total_pages' => $total_pages,
            'data' => self::format_courses($courses)
        );
    }
    
    
    

    public static function get_courses_returns() {
        return new external_single_structure(
            array(
                'total' => new external_value(PARAM_INT, 'Total de cursos encontrados.'),
                'page' => new external_value(PARAM_INT, 'Número de página actual.'),
                'per_page' => new external_value(PARAM_INT, 'Cantidad de cursos por página.'),
                'total_pages' => new external_value(PARAM_INT, 'Total de páginas disponibles.'),
                'data' => new external_multiple_structure(
                    new external_single_structure(
                        array(
                            'id' => new external_value(PARAM_INT, 'Identificador del curso.'),
                            'fullname' => new external_value(PARAM_TEXT, 'Nombre completo del curso.'),
                            'shortname' => new external_value(PARAM_TEXT, 'Nombre corto del curso.'),
                            'summary' => new external_value(PARAM_TEXT, 'Resumen del curso.'),
                            'startdate' => new external_value(PARAM_INT, 'Fecha de inicio del curso.'),
                            'enddate' => new external_value(PARAM_INT, 'Fecha de finalización del curso.'),
                            'category' => new external_value(PARAM_TEXT, 'Categoría del curso.')
                        )
                    )
                )
            )
        );
    }

    public static function unenrol_bulk_users_parameters() {
        return new external_function_parameters(
            array(
                'categoryids' => new external_value(PARAM_TEXT, 'Category Ids'),
                'roleid' => new external_value(PARAM_TEXT, 'Role Ids')
            )
        );
    }

    public static function unenrol_bulk_users($categoryids, $roleid) {
        global $DB, $CFG;
      

        $response = [
            'message' => 'Success' 
        ];

        return $response;
    }

    public static function unenrol_bulk_users_returns() {
        return new external_single_structure(
            array(
                'message' => new external_value(PARAM_TEXT, 'success message')
            )
        );
    }

    public static function update_courses_lti_parameters() {
        return new external_function_parameters(
            array(
                'courseid' => new external_value(PARAM_INT, 'Course Id')
            )
        );
    }

    public static function update_courses_lti($courseid) {
        global $DB, $CFG;
        // la lógica necesaria para el método update_courses_lti
        // ...

        $response = [
            'id' => $courseid,
            'message' => 'Success',  // O cualquier otra respuesta que desees devolver
            'updated' => $count  // Ajusta esto según lo que necesites devolver
        ];

        return $response;
    }

    public static function update_courses_lti_returns() {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'course id'),
                'message' => new external_value(PARAM_TEXT, 'success message'),
                'updated' => new external_value(PARAM_INT, 'Items Updated')
            )
        );
    }

    public static function update_courses_sections_parameters() {
        return new external_function_parameters(
            array(
                'courseids' => new external_value(PARAM_TEXT, 'Course Ids')
            )
        );
    }

    public static function update_courses_sections($courseids) {
        global $DB, $CFG;
        //la lógica necesaria para el método update_courses_sections
        // ...

        $response = [
            'ids' => $courseids,
            'message' => 'Success',  // O cualquier otra respuesta que desees devolver
            'updated' => $count  // Ajusta esto según lo que necesites devolver
        ];

        return $response;
    }

    public static function update_courses_sections_returns() {
        return new external_single_structure(
            array(
                'ids' => new external_value(PARAM_TEXT, 'course ids'),
                'message' => new external_value(PARAM_TEXT, 'success message'),
                'updated' => new external_value(PARAM_INT, 'Items Updated')
            )
        );
    }

    // Función auxiliar para formatear la información de los cursos.
    private static function format_courses($courses) {
        $formatted_courses = array();
        foreach ($courses as $course) {
            $formatted_courses[] = array(
                'id' => $course->id,
                'fullname' => $course->fullname,
                'shortname' => $course->shortname,
                'summary' => $course->summary,
                'startdate' => $course->startdate,
                'enddate' => $course->enddate,
                'category' => $course->category
            );
        }
        return $formatted_courses;
    }

    // Nuevas funciones aquí...

    // Método adicional de ejemplo
    public static function example_function_parameters() {
        return new external_function_parameters(
            array(
                'param1' => new external_value(PARAM_TEXT, 'Parameter 1'),
                'param2' => new external_value(PARAM_INT, 'Parameter 2')
            )
        );
    }

    public static function example_function($param1, $param2) {
        // Implementación de la lógica de la nueva función...
        // ...

        $response = [
            'param1' => $param1,
            'param2' => $param2,
            'message' => 'Success'  // O cualquier otra respuesta que desees devolver
        ];

        return $response;
    }

    public static function example_function_returns() {
        return new external_single_structure(
            array(
                'param1' => new external_value(PARAM_TEXT, 'Parameter 1'),
                'param2' => new external_value(PARAM_INT, 'Parameter 2'),
                'message' => new external_value(PARAM_TEXT, 'success message')
            )
        );
    }

    // Fin de nuevas funciones
}
