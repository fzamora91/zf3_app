<?php
namespace Usuarios\Model\Dao;
use Zend\Db\TableGateway\TableGateway;
use RuntimeException;
use Usuarios\Model\Entity\Usuario;
use Usuarios\Model\Dao\IUsuarioDao;

class UsuarioDao implements IUsuarioDao
{
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway)
      {
       $this->tableGateway = $tableGateway;
	}

	public function obtenerPorId($id)
	{
       $rowset = $this->tableGateway->select(['id'=>(int)$id]);
       $row = $rowset->current();
       if(!$row)
       {
         throw new RuntimeException("No se pudo encontrar el usuario");
       }
       return $row;
	}

	public function obtenerTodos()
	{
       $resultSet = $this->tableGateway->select();
       return $resultSet;
	}
}

interface IUsuarioDao
{
  public function obtenerPorId($id);
  public function obtenerTodos();
}

