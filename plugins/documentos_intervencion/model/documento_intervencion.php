<?php

class documento_intervencion extends fs_model
{
   public $id;
   public $idservicioi;
   public $ruta;
   public $nombre;
   public $fecha;
   public $hora;
   public $tamano;
   public $usuario;
   
   private $file_exist;
   
   public function __construct($d = FALSE)
   {
      parent::__construct('documentosint');
      if($d)
      {
         $this->id = $this->intval($d['id']);
         $this->ruta = $d['ruta'];
         $this->nombre = $d['nombre'];
         $this->fecha = date('d-m-Y', strtotime($d['fecha']));
         $this->hora = date('h:i:s', strtotime($d['hora']));
         $this->tamano = intval($d['tamano']);
         $this->usuario = $d['usuario'];
         $this->idservicioi = $this->intval($d['idservicioi']);
      }
      else
      {
         $this->id = NULL;
         $this->ruta = NULL;
         $this->nombre = NULL;
         $this->fecha = date('d-m-Y');
         $this->hora = date('h:i:s');
         $this->tamano = 0;
         $this->usuario = NULL;
         $this->idservicioi = NULL;
      }
   }
   
   protected function install()
   {
      return '';
   }
   
   public function file_exists()
   {
      if( !isset($this->file_exist) )
      {
         $this->file_exist = file_exists($this->ruta);
      }
      
      return $this->file_exist;
   }
   
   public function tamano()
   {
      $bytes = $this->tamano;
      $decimals = 2;
      $sz = 'BKMGTP';
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$sz[$factor];
   }
   
   public function get($id)
   {
      $data = $this->db->select("SELECT * FROM documentosint WHERE id = ".$this->var2str($id).";");
      if($data)
      {
         return new documento_intervencion($data[0]);
      }
      else
         return FALSE;
   }
   
   public function exists()
   {
      if( is_null($this->id) )
      {
         return FALSE;
      }
      else
         return $this->db->select("SELECT * FROM documentosint WHERE id = ".$this->var2str($this->id).";");
   }
   
   public function save()
   {
      if( $this->exists() )
      {
         $sql = "UPDATE documentosint SET ruta = ".$this->var2str($this->ruta)
                 .", nombre = ".$this->var2str($this->nombre)
                 .", fecha = ".$this->var2str($this->fecha)
                 .", hora = ".$this->var2str($this->hora)
                 .", tamano = ".$this->var2str($this->tamano)
                 .", usuario = ".$this->var2str($this->usuario)
                 .", idservicioi = ".$this->var2str($this->idservicioi)
                 ." WHERE id = ".$this->var2str($this->id).";";
         
         return $this->db->exec($sql);
      }
      else
      {
         $sql = "INSERT INTO documentosint (ruta,nombre,fecha,hora,tamano,usuario,"
                 . "idservicioi"
                 . ") VALUES (".$this->var2str($this->ruta)
                 . ",".$this->var2str($this->nombre)
                 . ",".$this->var2str($this->fecha)
                 . ",".$this->var2str($this->hora)
                 . ",".$this->var2str($this->tamano)
                 . ",".$this->var2str($this->usuario)
                 . ",".$this->var2str($this->idservicioi).");";
         
         if( $this->db->exec($sql) )
         {
            $this->id = $this->db->lastval();
            return TRUE;
         }
         else
            return FALSE;
      }
   }
   
   public function delete()
   {
      return $this->db->exec("DELETE FROM documentosint WHERE id = ".$this->var2str($this->id).";");
   }
   
   /**
    * Devuelve todos los documentos relacionados.
    * @param type $tipo
    * @param type $id
    * @return \documento_intervencion
    */
   public function all_from($tipo, $id)
   {
      $lista = array();
      $sql = "SELECT * FROM documentosint WHERE ".$tipo." = ".$this->var2str($id).";";
      
      $data = $this->db->select($sql);
      if($data)
      {
         foreach($data as $d)
         {
            $lista[] = new documento_intervencion($d);
         }
      }
      
      return $lista;
   }
}
