<?php
require_once("$CFG->libdir/formslib.php");

class simplehtml_form extends moodleform {
    // Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // No olvides el guión bajo.

        $mform->addElement('text', 'username', get_string('username'));
        $mform->setType('username', PARAM_NOTAGS);
        $mform->setDefault('username', '');

        $mform->addElement('text', 'email', get_string('email'));
        $mform->setType('email', PARAM_NOTAGS);
        $mform->setDefault('email', '');

        $mform->addElement('text', 'phone', get_string('phone'));
        $mform->setType('phone', PARAM_NOTAGS);
        $mform->setDefault('phone', '');

        $mform->addElement('text', 'firstname', get_string('firstname'));
        $mform->setType('firstname', PARAM_NOTAGS);
        $mform->setDefault('firstname', '');

        $mform->addElement('text', 'lastname', get_string('lastname'));
        $mform->setType('lastname', PARAM_NOTAGS);
        $mform->setDefault('lastname', '');

        $mform->addElement('text', 'city', get_string('city'));
        $mform->setType('city', PARAM_NOTAGS);
        $mform->setDefault('city', '');

        $mform->addElement('text', 'country', get_string('country'));
        $mform->setType('country', PARAM_NOTAGS);
        $mform->setDefault('country', '');

        $mform->addElement('textarea', 'descripcion', get_string('descripcion'));
        $mform->setType('descripcion', PARAM_TEXT);
        $mform->setDefault('descripcion', '');

$mform->addElement('text', 'user_id', 'ID del Usuario');
$mform->setType('user_id', PARAM_INT);
$mform->addElement('text', 'course_id', 'ID del Curso');
$mform->setType('course_id', PARAM_INT);


        $this->add_action_buttons();
    }

    // Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
?>
