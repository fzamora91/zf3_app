<?php
namespace Usuarios\Model\Entity;

class Usuario
{
	private $id;
	private $nombre;
	private $apellido;
	private $email;
	private $pwd;

	public function getId()
	{
      return $this->id;
	}

	public function setId($id)
	{
       $this->id=$id;
	}

	public function getNombre()
	{
       return $this->nombre;
	}

	public function setNombre($nombre)
	{
      $this->nombre=$nombre;
	}

	public function getApellido()
	{
      return $this->apellido;
	}

	public function setApellido($apellido)
	{
		$this->apellido=$apellido;
	}

	public function getEmail()
	{
       return $this->email;
	}

	public function setEmail($email)
	{
      $this->email=$email;
	}


	public function getPwd()
	{
       return $this->pwd;
	}

	public function setPwd($pwd)
	{
      $this->pwd=$pwd;
	}

	public function exchangeArray($data)
	{
       $this->id=(isset($data['id'])) ? $data['id'] : null;
       $this->nombre=(isset($data['nombre'])) ? $data['nombre'] : null;
       $this->apellido=(isset($data['apellido'])) ? $data['apellido'] : null;
       $this->email=(isset($data['email'])) ? $data['email'] : null;
       $this->pwd=(isset($data['pwd'])) ? $data['pwd'] : null;
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

}
