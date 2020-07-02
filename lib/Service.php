<?php
class Service {

	private $name;
	private $letter;
	public function __construct($data){
		$this->name = trim($data['name']);
		$this->letter = trim($data['letter']);
	}
	protected function isValid ($word, $pattern, $warning = 'Недопустимые символы или длина') {
		if (empty($word)) return 'Строка не должна быть пустой';
		if (!preg_match($pattern, $word)) return $warning;
		return false;
	}
	public function getValidation () {
		$validation = [];
		$notvalid['service'] = $this->isValid($this->name,'/^[а-яА-ЯЁё\s]{10,255}$/iu','Должно состоять из русских букв, не меньше 10'); 
		$notvalid['letter'] = $this->isValid($this->letter,'/^[а-яА-ЯЁё]{1}$/iu','1 символ из русских букв'); 
		foreach ($notvalid as $key => $value) {
			if ($value) $validation[$key] = $value;
		}
		return $validation;

	}
	public function addService ($db){
		$this->name = ucfirst($this->name);
		$this->letter = ucfirst($this->letter);
		$res = $db->query("INSERT INTO services
			(id, name, letter)
			VALUES (NULL, '$this->name','$this->letter')");
		if ($res) {
			return 1;
		}else{
			return $db->error;

		}
	}
}