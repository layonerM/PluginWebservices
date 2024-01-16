<?php 
defined('MOODLE_INTERNAL') || die();

$functions = array(
    'local_cursos_update_courses_lti' => array(
        'classname' => 'local_cursos_external',
        'methodname' => 'update_courses_lti',
        'classpath' => 'local/cursos/externallib.php',
        'description' => 'Update courses LTI to show in Gradebook',
        'type' => 'write',
        'ajax' => true,
    ),
    'local_cursos_update_courses_sections' => array(
        'classname' => 'local_cursos_external',
        'methodname' => 'update_courses_sections',
        'classpath' => 'local/cursos/externallib.php',
        'description' => 'Update courses sections title in DB',
        'type' => 'write',
        'ajax' => true,
    ),
    'local_cursos_unenrol_bulk_users' => array(
        'classname' => 'local_cursos_external',
        'methodname' => 'unenrol_bulk_users',
        'classpath' => 'local/cursos/externallib.php',
        'description' => 'Unenroll bulk users',
        'type' => 'write',
        'ajax' => true,
    ),
    'local_cursos_get_courses' => array(
        'classname' => 'local_cursos_external',
        'methodname' => 'get_courses',
        'classpath' => 'local/cursos/externallib.php',
        'description' => 'Get paginated courses list',
        'type' => 'read',
        'ajax' => true,
        'capabilities' => 'moodle/course:view',
    ),
);

$services = array(
    'Local Cursos Services' => array(
        'functions' => array(
            'local_cursos_update_courses_lti',
            'local_cursos_update_courses_sections',
            'local_cursos_unenrol_bulk_users',
            'local_cursos_get_courses',
        ),
        'restrictedusers' => 0,
        'enabled' => 1,
        'shortname' => 'Local_Cursos_Services',
    )
);
