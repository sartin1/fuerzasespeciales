<?php


class detalle_servicioi extends fs_model
{
   public $id;
   public $descripcion;
   public $idservicioi;
   public $fecha;
   public $nick;
   public $hora;
   
   public function __construct($s = FALSE)
   {
      parent::__construct('detalles_serviciosi', 'plugins/intevencion/');
      if($s)
      {
         $this->id = intval($s['id']);
         $this->descripcion = $s['descripcion'];
         $this->idservicioi = intval($s['idservicioi']);
         $this->fecha = date('d-m-Y', strtotime($s['fecha']));
         $this->nick = $s['nick'];
         $this->hora = date('H:i:s', strtotime($s['hora']));
      }
      else
      {
         $this->id = NULL;
         $this->descripcion = '';
         $this->idservicioi = NULL;
         $this->fecha = date('d-m-Y');
         $this->nick = NULL;
          $this->hora = Date('H:i:s');
      }
   }
   
   public function install()
   {
      return '';
   }
   
   public function get($id)
   {
      $data = $this->db->select("SELECT * FROM detalles_serviciosi WHERE id = ".$this->var2str($id).";");
      if($data)
      {
         return new detalle_servicioi($data[0]);
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
      {
         return $this->db->select("SELECT * FROM detalles_serviciosi WHERE id = ".$this->var2str($this->idservicioi).";");
      }
   }
   
   public function save()
   {
      $this->descripcion = $this->no_html($this->descripcion);
      
      if( $this->exists() )
      {
         $sql = "UPDATE detalles_serviciosi SET descripcion = ".$this->var2str($this->descripcion).
                 ", fecha = ".$this->var2str($this->fecha).
                 ", hora = ".$this->var2str($this->hora).
                 ", idservicioi = ".$this->var2str($this->idservicioi).
                 ", nick = ".$this->var2str($this->nick).
                 " WHERE id = ".$this->var2str($this->id).";";
         
         return $this->db->exec($sql);
      }
      else
      {
         $sql = "INSERT INTO detalles_serviciosi (descripcion,fecha,hora,idservicioi,nick) VALUES (".
                 $this->var2str($this->descripcion).",".
                 $this->var2str($this->fecha).",".
                 $this->var2str($this->hora).",".
                 $this->var2str($this->idservicioi).",".
                 $this->var2str($this->nick).");";
         
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
      return $this->db->exec("DELETE FROM detalles_serviciosi WHERE id = ".$this->var2str($this->id).";");
   }
   
   public function all()
   {
      $detalleslist = array();
      
      $sql = "SELECT d.id,d.descripcion,d.idservicioi,d.fecha,d.hora,d.nick FROM intercli s, detalles_serviciosi d".
              " WHERE d.idservicioi = s.idservicioi ORDER BY d.fecha ASC, d.id ASC;";
      $data = $this->db->select($sql);
      if($data)
      {
         foreach($data as $d)
            $detalleslist[] = new detalle_servicioi($d);
      }
      
      return $detalleslist;
   }
   
   public function all_from_servicio($idservicioi)
   {
      $detalleslist = array();
      
      $sql = "SELECT d.id,d.descripcion,d.idservicioi,d.fecha,d.hora,d.nick FROM intercli s, detalles_serviciosi d".
              " WHERE d.idservicioi = s.idservicioi AND d.idservicioi = ".$this->var2str($idservicioi)." ORDER BY d.fecha DESC, d.id DESC;";
      $data = $this->db->select($sql);
      if($data)
      {
         foreach($data as $d)
            $detalleslist[] = new detalle_servicioi
          ($d);
      }
      
      return $detalleslist;
   }
   
    public function show_hora_detalle($s = TRUE)
   {
      if ($s)
      {
         return Date('H:i:s', strtotime($this->hora));
      }
      else
         return Date('H:i', strtotime($this->hora));
   }
}