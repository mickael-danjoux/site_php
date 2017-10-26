<?php
	class form{
		private $form;

		public function __construct($_name,$_action,$_method,$_enctype){
			$this->form = "<form name='".$_name."' action='".$_action."' method='".$_method."'";

			//On regarde si on a un 'enctype'
			if($_enctype == ""){
				$this->form .=">";
			}
			else{
				$this->form .= " enctype='".$_enctype."'>";
			}
		}

		public function setinput($_type,$_name,$_placeholder,$_required){
			$this->form .= "<input type='".$_type."'";

			if($_name != ""){
				$this->form .= " name='".$_name."'";
			}

			if($_placeholder != ""){
				$this->form .= " placeholder='".$_placeholder."'";
			}

			if($_required){
				$this->form .= " required";
			}

			$this->form .= ">";
		}

		public function setsubmit($_name,$_value){
			$this->form .= "<input type='submit' name='".$_name."' value='".$_value."'>";
		}

		public function getform(){
			$this->form .= "</form>";
			echo $this->form;
		}

	}
?>