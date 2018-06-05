<?php
	
	class Upload{

		private $_upload,
				$_dir,
				$_size,
				$_allowed,
				$_result = array();

		function __construct($upload = array(),$dir,$size,$allowed){
			$this->_upload = $upload;
			$this->_dir = $dir;
			$this->_size = $size;
			$this->_allowed = $allowed;

			$this->Upload();
		}

		private function Upload(){
			if (!empty($this->_upload) && (!empty($this->_dir)) && (!empty($this->_size)) && (!empty($this->_allowed))) {
				if ((is_array($this->_upload)) && (is_array($this->_allowed))) {
					$explode = explode(".", strtolower($this->_upload['name']));
					$key = count($explode) - 1;
					$extension = $explode[$key];
					if (in_array($extension, $this->_allowed)) {
						if ($this->_upload['size'] < $this->_size) {
							$filename = $this->_upload['name'];
							$tmpname = $this->_upload['tmp_name'];
							if (move_uploaded_file($tmpname, $this->_dir.$filename)) {
								$this->_result['type'] = "success";
								$this->_result['message'] = "File Has been uploaded";
								$this->_result['path'] = $this->_dir.$filename;
							}else{
								$this->_result['type'] = "error";
								$this->_result['message'] = "Error in uploading file";
								$this->_result['path'] = false;
							}
						}else{
							$this->_result['type'] = "error";
							$this->_result['message'] = "Fill should be less then {$this->_size} BYTES";
							$this->_result['path'] = false;
						}
					}else{
						$this->_result['type'] = "error";
						$this->_result['message'] = "Fill Type not allowed";
						$this->_result['path'] = false;
					}
				}else{
					$this->_result['type'] = "error";
					$this->_result['message'] = "Parameters 1st and 4th should be an array";
					$this->_result['path'] = false;
				}
			}else{
				$this->_result['type'] = "error";
				$this->_result['message'] = "Parameters can not be empty";
				$this->_result['path'] = false;
			}
		}

		public function GetResult(){
			return $this->_result;
		}
	}

?>