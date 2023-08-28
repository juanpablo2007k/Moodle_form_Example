<?php
require_once('../config.php');
require_login();

global $CFG, $DB, $USER, $OUTPUT, $PAGE;

require_once($CFG->dirroot . "/test/form.php");
$PAGE->set_url(new moodle_url('/test/index.php'));
$PAGE->set_context(context_system::instance());

$PAGE->set_title('Registro de usuarios y matriculación');
$PAGE->set_heading('Matricula usuarios como quieras');

$mform = new simplehtml_form();

if ($mform->is_cancelled()) {
    $cancelado = $CFG->wwwroot . "/test/index.php";
    redirect($cancelado, 'Has cancelado el envío de datos', null, \core\output\notification::NOTIFY_WARNING);
} else {
    if ($fromform = $mform->get_data()) {
        // Crear un nuevo usuario en la tabla mdl_user
        $user = new stdClass();
        $user->auth = 'manual';
        $user->confirmed = 1;
        $user->password = $fromform->password;
        $user->policyagreed = 0;
        $user->deleted = 0;
        $user->suspended = 0;
        $user->mnethostid = 0;
        $user->username = $fromform->username;
        $user->idnumber = '';
        $user->firstname = $fromform->firstname;
        $user->lastname = $fromform->lastname;
        $user->email = $fromform->email;
        $user->emailstop = 0;
        $user->phone1 = $fromform->phone;
        $user->phone2 = '';
        $user->institution = '';
        $user->department = '';
        $user->address = '';
        $user->city = $fromform->city;
        $user->country = $fromform->country;
        $user->lang = 'en';
        $user->calendartype = 'gregorian';
        $user->theme = '';
        $user->timezone = '99';
        $user->firstaccess = time();
        $user->lastaccess = 0;
        $user->lastlogin = 0;
        $user->currentlogin = 0;
        $user->lastip = '';
        $user->secret = '';
        $user->picture = 0;
        $user->description = $fromform->description;
        $user->descriptionformat = 1;
        $user->mailformat = 1;
        $user->maildigest = 0;
        $user->maildisplay = 2;
        $user->autosubscribe = 1;
        $user->trackforums = 0;
        $user->timecreated = time();
        $user->timemodified = time();
        $user->trustbitmask = 0;
        $user->imagealt = '';
        $user->lastnamephonetic = '';
        $user->firstnamephonetic = '';
        $user->middlename = '';
        $user->alternatename = '';
        $user->moodlenetprofile = '';

        $user_id = $DB->insert_record('user', $user);

        if ($user_id) {
            $course_id = $fromform->course_id;

            // Matriculando en un curso. Esto tiene que ver con la tabla mdl_enrol
            $enrol = $DB->get_record('enrol', ['courseid' => $course_id, 'enrol' => 'manual'], '*', MUST_EXIST);
            $enrolment = new stdClass();
            $enrolment->enrolid = $enrol->id;
            $enrolment->userid = $user_id;
            $enrolment->timecreated = time();
            $enrolment->timemodified = $enrolment->timecreated;
            $enrolment->modifierid = $USER->id;

            if ($DB->insert_record('user_enrolments', $enrolment)) {
                //me redirije despues de hacer la insercion de datos
                $redirigir = $CFG->wwwroot . "/test/index.php";
                redirect($redirigir, 'Se ha enviado la información correctamente', null, \core\output\notification::NOTIFY_SUCCESS);
            } else {
                echo "Error al matricular al usuario en el curso.";
            }
        } else {
            echo "Error al insertar el usuario en la base de datos.";
        }
    }

    echo $OUTPUT->header();
    $mform->display();
    echo $OUTPUT->footer();
}
?>
