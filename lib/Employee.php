<?php
class Employee {
	private $login;
	private $password;
	private $fname;
	private $surname;
	private $patronymic;
	public function __construct($data){
		$this->login = htmlspecialchars(trim($data['login']));
		$this->password = htmlspecialchars($data['password']);
		$this->fname = htmlspecialchars(trim($data['fname']));
		$this->surname = htmlspecialchars(trim($data['surname']));
		$this->patronymic = htmlspecialchars(trim($data['patronymic']));

	}
	protected function isValid ($word, $pattern, $warning = 'Недопустимые символы или длина') {
		if (empty($word)) return 'Строка не должна быть пустой';
		if (!preg_match($pattern, $word)) return $warning;
		return false;
	}
	public function getValidation () {
		$validation = [];
		$notvalid['login'] = $this->isValid($this->login,'/^[a-zA-Z0-9]{6,30}$/iu','Доллжен состоять из латинских букв и длинной 6-30'); 
		$notvalid['password'] = $this->isValid($this->password,'/^[a-zA-Z0-9]{6,20}$/iu','Должен состоять из латинских букв, чисел и длинной 6-20'); 
		$notvalid['fname'] = $this->isValid($this->fname,'/^[а-яА-ЯЁё]{2,30}$/iu','Должно состоять из русских букв и длинной 2-30'); 
		$notvalid['surname'] = $this->isValid($this->surname,'/^[а-яА-ЯЁё]{2,30}$/iu','Должно состоять из русских букв и длинной 2-30'); 
		$notvalid['patronymic'] = $this->isValid($this->patronymic,'/^[а-яА-ЯЁё]{2,30}$/iu','Должно стоять из русских букв и длинной 2-30');
		foreach ($notvalid as $key => $value) {
			if ($value) $validation[$key] = $value;
		}
		return $validation;

	}

	public function addEmployee ($db){
		$this->fname = ucfirst($this->fname);
		$this->surname = ucfirst($this->surname);
		$this->patronymic = ucfirst($this->patronymic);
		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		$res = $db->query("INSERT INTO employees
			(id, login, password, fname, surname, patronymic)
			VALUES (NULL, '$this->login','$this->password',
			'$this->fname','$this->surname','$this->patronymic')");
		if ($res) {
			return 1;
		}else{
			return $db->error;

		}
	}
}