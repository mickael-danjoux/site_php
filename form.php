<?php
	class FormBuilder {

		private $_inputs = array();
		private $_action;

		const FORM_HTML = '<form action="%s" method="post">%s</form>';
		const INPUT_HTML = '<input type="%s" name="%s" placeholder="%s" value="%s" %s>';
		const SUBMIT_HTML = '<input type="submit" value="%s">';

		public function __construct($action, $submit = "Submit") {
			$this->_action = $action;
			$this->_submit = $submit;
		}

		public function addInput($name, $type = "text", $placeholder = null, $value = null, $required = false) {
			$this->_inputs[] = array(
				'name' => $name,
				'type' => $type,
				'placeholder' => $placeholder,
				'value' => $value,
				'required' => $required ? 'required' : ''
			);
		}

		public function build($echo = true) {
			$inputsHtml = "";
			foreach($this->_inputs as $input) {
				$inputsHtml .= sprintf(
					FormBuilder::INPUT_HTML,
					$input['type'],
					$input['name'],
					$input['placeholder'],
					$input['value'],
					$input['required']
				);
			}

			$submitHtml = sprintf(FormBuilder::SUBMIT_HTML, $this->_submit);

			$formBodyHtml = $inputsHtml . $submitHtml;

			$formHtml = sprintf(
				FormBuilder::FORM_HTML,
				$this->_action,
				$formBodyHtml
			);

			if ($echo) {
				echo $formHtml;
			} else {
				return $formHtml;
			}
		}
	}

	// Test class
	$form = new FormBuilder("myaction.php", "Validate this super form");
	$form->addInput("username", $type = "text", "Username", null, true);
	$form->addInput("password", $type = "password", "Password", null, true);
	$form->build();
?>