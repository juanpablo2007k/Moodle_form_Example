<?php
require_once("$CFG->libdir/formslib.php");

class simplehtml_form extends moodleform {
    // Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; 

        $mform->addElement('text', 'username', get_string('username'));
        $mform->setType('username', PARAM_NOTAGS);
        $mform->setDefault('username', '');
        $mform->addRule('username', null, 'required', null, 'client');

        $mform->addElement('password', 'password', get_string('password'));
        $mform->setType('password', PARAM_NOTAGS);
        $mform->setDefault('password', '');
        $mform->addRule('password', null, 'required', null, 'client');

        $mform->addElement('text', 'email', get_string('email'));
        $mform->setType('email', PARAM_NOTAGS);
        $mform->setDefault('email', '');
        $mform->addRule('email', null, 'required', null, 'client');

        $mform->addElement('text', 'phone', get_string('phone'));
        $mform->setType('phone', PARAM_NOTAGS);
        $mform->setDefault('phone', '');

        $mform->addElement('text', 'firstname', get_string('firstname'));
        $mform->setType('firstname', PARAM_NOTAGS);
        $mform->setDefault('firstname', '');
        $mform->addRule('firstname', null, 'required', null, 'client');

        $mform->addElement('text', 'lastname', get_string('lastname'));
        $mform->setType('lastname', PARAM_NOTAGS);
        $mform->setDefault('lastname', '');
        $mform->addRule('lastname', null, 'required', null, 'client');

        $countries = array(
            'US' => 'United States',
            'CA' => 'Canada',
            'UK' => 'United Kingdom',
            'FR' => 'France',
            'DE' => 'Germany',
            'CO' => 'Colombia'
            
        );
      
        $mform->addElement('select', 'country', get_string('country'), $countries);
        $mform->setDefault('country', '');
        $mform->addRule('country', null, 'required', null, 'client');

        $mform->addElement('text', 'city', get_string('city'));
        $mform->setType('city', PARAM_TEXT);
        $mform->setDefault('city', '');

        $mform->addElement('textarea', 'description', get_string('description'));
        $mform->setType('description', PARAM_TEXT);
        $mform->setDefault('description', '');
        
        $mform->addElement('text', 'course_id', 'ID del Curso');
        $mform->setType('course_id', PARAM_INT);
        $mform->setDefault('course_id', '');
        $mform->addRule('course_id', null, 'required', null, 'client');

        $this->add_action_buttons();
    }

    // Custom validation should be added here
    function validation($data, $files) {
        $errors = parent::validation($data, $files);

        // Agregar validación personalizada aquí si es necesario.

        return $errors;
    }
}
?>
