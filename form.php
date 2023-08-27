<?php


require_once("$CFG->libdir/formslib.php");

class simplehtml_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 
        $mform->addElement('text', 'email', get_string('email')); // Add elements to your form.
        $mform->setType('email', PARAM_NOTAGS);                   // Set type of element.
        $mform->setDefault('email', '');        // Default value.

        $mform = $this->_form; // Don't forget the underscore! 
        $mform->addElement('text', 'phone', get_string('phone')); // Add elements to your form.
        $mform->setType('phone', PARAM_NOTAGS);                   // Set type of element.
        $mform->setDefault('phone', '');        // Default value.
        $this->add_action_buttons();
    }
    
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}

?>