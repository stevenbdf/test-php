<?php
class Usuarios extends Validator
{
	//Declaración de propiedades
	private $id = null;
	private $correo = null;
	private $clave = null;


	//Métodos para sobrecarga de propiedades
	public function setId($value)
	{
		if ($this->validateId($value)) {
			$this->id = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function setCorreo($value)
	{
		if ($this->validateEmail($value)) {
			$this->correo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCorreo()
	{
		return $this->correo;
    }
    
	public function setClave($value)
	{
		if ($this->validatePassword($value)) {
			$this->clave = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getClave()
	{
		return $this->clave;
	}


	//Metodos para manejar el CRUD
	public function readUsuarios()
	{
		$sql = 'SELECT * FROM usuarios';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function createUsuario()
	{
		$sql = 'INSERT INTO usuarios(correo, contraseña) VALUES(?, ?)';
		$params = array($this->correo, $this->clave);
		return Database::executeRow($sql, $params);
	}

	public function updateUsuario()
	{
		$sql = 'UPDATE usuarios SET correo = ?, contraseña = ? WHERE idUsuario = ?';
		$params = array($this->correo, $this->clave, $this->id);
		return Database::executeRow($sql, $params);
	}

}
?>
