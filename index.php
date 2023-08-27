<?php
require_once('../config.php');
require_login();

global $CFG, $DB, $USER, $OUTPUT, $PAGE;

require_once($CFG->dirroot . "/test/form.php");
$PAGE->set_url(new moodle_url('/test/index.php'));
$PAGE->set_context(context_system::instance());

$PAGE->set_title('JUANPAS');
$PAGE->set_heading('JUANPA');

$mform = new simplehtml_form();

if ($mform->is_cancelled()) {
    $cancelado = $CFG->wwwroot . "/test/index.php";
    redirect($cancelado, 'Has cancelado el envío de datos', null, \core\output\notification::NOTIFY_WARNING);
} else {
    echo $OUTPUT->header();
    $mform->display();

    if ($fromform = $mform->get_data()) {
        // Crear un nuevo usuario en la base de datos de Moodle.
        $user = new stdClass();
        $user->auth = 'manual';
        $user->confirmed = 1;

        // Campos de usuario
        $user->username = $fromform->username; // Nombre de usuario
        $user->password = ''; // Debes manejar el cifrado y almacenamiento de la contraseña aquí.
        $user->firstname = $fromform->firstname; // Nombre
        $user->lastname = $fromform->lastname; // Apellido
        $user->email = $fromform->email; // Correo electrónico

        // Otras configuraciones de usuario aquí...

        // Insertar el usuario en la tabla de usuarios.
        $user_id = $DB->insert_record('user', $user);

        if ($user_id) {
            // Obtener el ID del curso desde el formulario.
            $course_id = $fromform->course_id;

            // Matricular al usuario en el curso.
            $enrol = $DB->get_record('enrol', ['courseid' => $course_id, 'enrol' => 'manual'], '*', MUST_EXIST);
            $enrolment = new stdClass();
            $enrolment->enrolid = $enrol->id;
            $enrolment->userid = $user_id;
            $enrolment->timecreated = time();
            $enrolment->timemodified = $enrolment->timecreated;
            $enrolment->modifierid = $USER->id;

            if ($DB->insert_record('user_enrolments', $enrolment)) {
                echo "El usuario ha sido matriculado en el curso con éxito.";
            } else {
                echo "Error al matricular al usuario en el curso.";
            }
        } else {
            echo "Error al insertar el usuario en la base de datos.";
        }

        // Redirigir antes de enviar cualquier contenido al navegador.
        $redirigir = $CFG->wwwroot . "/test/index.php";
        redirect($redirigir, 'Se ha enviado la información correctamente', null, \core\output\notification::NOTIFY_SUCCESS);
    }

    echo $OUTPUT->footer();
}
?>
