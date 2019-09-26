<?php

CLASS RMP
	{
		public function __construct()
			{
			$this->CONFIG = new CONFIG();
			$this->RMP_CONFIG = new RMP_CONFIG();
			$this->RMP_MODULES = new RMP_MODULES();
			}

		public function rmp_modules($params)
			{
			$this->load->module = $this->RMP_MODULES->load($params);
			return $this;
			}

		public function help()
			{
			$result = get_class_methods($this);
			return $result;
			}
	} 
$RMP = new RMP();

?>
