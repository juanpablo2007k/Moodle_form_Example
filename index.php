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
    redirect($cancelado, 'Has cancelado la envío de datos', null, \core\output\notification::NOTIFY_WARNING);
} else if ($fromform = $mform->get_data()) {
    print_r($fromform);
    $date = new stdClass();
    $date->email = $fromform->email;
    $date->phone = $fromform->phone;
    $date->added_time = time();
    $date->added_by = $USER->id; // Esto asume que $USER->id contiene el ID del usuario actual, asegúrate de que esté configurado correctamente    
    $DB->insert_record('example', $date);

    // Redirigir antes de enviar cualquier contenido al navegador
    $redirigir = $CFG->wwwroot . "/test/index.php";
    redirect($redirigir, 'Se ha enviado la información correctamente', null, \core\output\notification::NOTIFY_SUCCESS);
} else {
    echo $OUTPUT->header();
    $mform->display();
    echo $OUTPUT->footer();
}
?>
