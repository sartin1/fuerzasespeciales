<?php
    
class agente extends fs_model
{
   /**
    * Clave primaria. Varchar (10).
    * @var type
    */
   public $codagente;
   
   /**
    * Identificador fiscal.
    * @var type 
    */
   public $dnicif;
   public $nombre;
   public $apellidos;
   public $apellidomat;
   public $tipodocumento;
   public $cedulaid;
   public $exppor;
   public $prontuario;
   public $pasaporte;
   public $estadocivil;
   public $fcasamiento;
   public $serviciomilitar;
   public $lugarcumplimiento;
   public $estudios;
   public $oficios;
   public $estatura;
   public $contextfis;
   public $cutis;
   public $cabellotipo;
   public $cabellocolor;
   public $ojostipo;
   public $ojoscolor;
   public $fecha;
   public $decreto;
   public $nagente;
   public $credencial;
   public $armpr;
   public $otrasarmas;
   public $obs;
   public $obs1;
   public $fechagoe;
   public $motivogoe;
   public $practicaart;
   public $antpgoe;
   public $claustr;
   public $sufrvert;
   public $sabna;
   public $sabcon;
   public $conpa;
   public $carasalt;

   
   
   /**
    * Todavía sin uso.
    * @var type 
    */
   public $coddepartamento;
   public $email;
   public $fax;
   public $telefono;
   public $codpostal;
   public $codpais;
   public $provincia;
   public $ciudad;
   public $direccion;
   
   public $seg_social;
   public $cargo;
   public $banco;
   public $f_nacimiento;
   public $f_alta;
   public $f_baja;

   /**
    * Porcentaje de comisión del agente. Se utiliza en presupuestos, pedidos, albaranes y facturas.
    * @var type 
    */
   public $porcomision;
   
   /**
    * Todavía sin uso.
    * @var type 
    */
   public $irpf;
   
   public function __construct($a=FALSE)
   {
      parent::__construct('agentes');
      if($a)
      {
         $this->codagente = $a['codagente'];
         $this->nombre = $a['nombre'];
         $this->apellidos = $a['apellidos'];
         $this->cargo = $a['cargo'];
         $this->tipodocumento = $a['tipodocumento'];
         $this->cedulaid = $a['cedulaid'];
         $this->fecha = $a['fecha'];
         $this->decreto = $a['decreto'];
         $this->nagente = $a['nagente'];
         $this->credencial = $a['credencial'];
         $this->otrasarmas = $a['otrasarmas'];
         $this->obs = $a['obs'];
         $this->obs1 = $a['obs1'];
         $this->fechagoe = $a['fechagoe'];
         $this->motivogoe = $a['motivogoe'];
         $this->practicaart = $a['practicaart'];
         $this->antpgoe = $a['antpgoe'];
         $this->claustr = $a['claustr'];
         $this->sufrvert = $a['sufrvert'];
         $this->sabna = $a['sabna'];
         $this->sabcon = $a['sabcon'];
         $this->conpa = $a['conpa'];
         $this->carasalt = $a['carasalt'];
         $this->obs1 = $a['obs1'];
         $this->armpr = $a['armpr'];
         $this->exppor = $a['exppor'];
         $this->prontuario = $a['prontuario'];
         $this->pasaporte = $a['pasaporte'];
         $this->estatura = $a['estatura'];
         $this->contextfis = $a['contextfis'];
         $this->cutis = $a['cutis'];
         $this->cabellotipo = $a['cabellotipo'];
         $this->cabellocolor = $a['cabellocolor'];
         $this->ojostipo = $a['ojostipo'];
         $this->ojoscolor = $a['ojoscolor'];
         $this->estadocivil = $a['estadocivil'];
         $this->serviciomilitar = $a['serviciomilitar'];
         $this->lugarcumplimiento = $a['lugarcumplimiento'];
         $this->estudios = $a['estudios'];
         $this->oficios = $a['oficios'];
         $this->dnicif = $a['dnicif'];
         $this->coddepartamento = $a['coddepartamento'];
         $this->email = $a['email'];
         $this->fax = $a['fax'];
         $this->telefono = $a['telefono'];
         $this->codpostal = $a['codpostal'];
         $this->codpais = $a['codpais'];
         $this->provincia = $a['provincia'];
         $this->ciudad = $a['ciudad'];
         $this->direccion = $a['direccion'];
         $this->porcomision = floatval($a['porcomision']);
         $this->irpf = floatval($a['irpf']);
         $this->seg_social = $a['seg_social'];
         $this->banco = $a['banco'];

         $this->f_alta = NULL;
         if($a['f_alta'] != '')
         {
            $this->f_alta = Date('d-m-Y', strtotime($a['f_alta']));
         }
         
         $this->f_baja = NULL;
         if($a['f_baja'] != '')
         {
            $this->f_baja = Date('d-m-Y', strtotime($a['f_baja']));
         }

         $this->fcasamiento = NULL;
         if($a['fcasamiento'] != '')
         {
            $this->fcasamiento = Date('d-m-Y', strtotime($a['fcasamiento']));
         }
         
         $this->f_nacimiento = NULL;
         if($a['f_nacimiento'] != '')
         {
            $this->f_nacimiento = Date('d-m-Y', strtotime($a['f_nacimiento']));
         }
      }
      else
      {
         $this->codagente = NULL;
         $this->nombre = '';
         $this->apellidos = '';
         $this->dnicif = '';
         $this->coddepartamento = NULL;
         $this->email = NULL;
         $this->fax = NULL;
         $this->telefono = NULL;
         $this->codpostal = NULL;
         $this->codpais = NULL;
         $this->provincia = NULL;
         $this->ciudad = NULL;
         $this->direccion = NULL;
         $this->porcomision = 0;
         $this->irpf = 0;
         $this->seg_social = NULL;
         $this->banco = NULL;
         $this->cargo = NULL;
         $this->f_alta = Date('d-m-Y');
         $this->fcasamiento = Date('d-m-Y');
         $this->f_baja = NULL;
         $this->f_nacimiento = Date('d-m-Y');   
         $this->tipodocumento = NULL;     
         $this->cedulaid = NULL;
         $this->exppor = NULL;
         $this->prontuario = NULL;
         $this->pasaporte = NULL;
         $this->estadocivil = NULL;
         $this->serviciomilitar = NULL;
         $this->lugarcumplimiento = NULL;
         $this->estudios = NULL;
         $this->oficios = NULL;
         $this->estatura = NULL;  
         $this->contextfis = NULL;
         $this->cutis = NULL;
         $this->cabellotipo = NULL;
         $this->cabellocolor = NULL;
         $this->fecha = NULL;
         $this->decreto = NULL;
         $this->nagente = NULL;
         $this->credencial = NULL;
         $this->armpr = NULL;
         $this->otrasarmas = NULL;
         $this->obs = NULL;
         $this->obs1 = NULL;
         $this->fechagoe = NULL;
         $this->motivogoe = NULL;
         $this->practicaart = NULL;
         $this->antpgoe = NULL;
         $this->claustr = NULL;
         $this->sufrvert = NULL;
         $this->sabna = NULL;
         $this->sabcon = NULL;
         $this->conpa = NULL;
         $this->carasalt = NULL;
         
      }
   }
   
   protected function install()
   {
      $this->clean_cache();
      return "INSERT INTO ".$this->table_name." (codagente,nombre,apellidos,dnicif)
         VALUES ('1','Paco','Pepe','00000014Z');";
   }
   
   public function get_fullname()
   {
      return $this->nombre." ".$this->apellidos;
   }
   
   public function get_new_codigo()
   {
      $sql = "SELECT MAX(".$this->db->sql_to_int('codagente').") as cod FROM ".$this->table_name.";";
      $cod = $this->db->select($sql);
      if($cod)
      {
         return 1 + intval($cod[0]['cod']);
      }
      else
         return 1;
   }
   
   public function url()
   {
      if( is_null($this->codagente) )
      {
         return "index.php?page=admin_agentes";
      }
      else
         return "index.php?page=admin_agente&cod=".$this->codagente;
   }
   
   public function get($cod)
   {
      $a = $this->db->select("SELECT * FROM ".$this->table_name." WHERE codagente = ".$this->var2str($cod).";");
      if($a)
      {
         return new agente($a[0]);
      }
      else
         return FALSE;
   }
   
   public function exists()
   {
      if( is_null($this->codagente) )
      {
         return FALSE;
      }
      else
         return $this->db->select("SELECT * FROM ".$this->table_name." WHERE codagente = ".$this->var2str($this->codagente).";");
   }
   
   public function test()
   {
      $status = FALSE;
      
      $this->codagente = trim($this->codagente);
      $this->nombre = $this->no_html($this->nombre);
      $this->apellidos = $this->no_html($this->apellidos);
      $this->dnicif = $this->no_html($this->dnicif);
      $this->telefono = $this->no_html($this->telefono);
      $this->email = $this->no_html($this->email);
      
      if( strlen($this->codagente) < 1 OR strlen($this->codagente) > 10 )
      {
         $this->new_error_msg("Código de agente no válido. Debe tener entre 1 y 10 caracteres.");
      }
      else if( strlen($this->nombre) < 1 OR strlen($this->nombre) > 50 )
      {
         $this->new_error_msg("El nombre de empleado no puede superar los 50 caracteres.");
      }
      else if( strlen($this->apellidos) < 1 OR strlen($this->apellidos) > 100 )
      {
         $this->new_error_msg("Los apellidos del empleado no pueden superar los 100 caracteres.");
      }
      else
         $status = TRUE;
      
      return $status;
   }
   
   public function save()
   {
      if( $this->test() )
      {
         $this->clean_cache();
         
         if( $this->exists() )
         {
            $sql = "UPDATE ".$this->table_name." SET nombre = ".$this->var2str($this->nombre).
                    ", apellidos = ".$this->var2str($this->apellidos).
                    ", dnicif = ".$this->var2str($this->dnicif).
                    ", telefono = ".$this->var2str($this->telefono).
                    ", email = ".$this->var2str($this->email).
                    ", cargo = ".$this->var2str($this->cargo).
                    ", provincia = ".$this->var2str($this->provincia).
                    ", ciudad = ".$this->var2str($this->ciudad).
                    ", direccion = ".$this->var2str($this->direccion).
                    ", f_nacimiento = ".$this->var2str($this->f_nacimiento).
                    ", f_alta = ".$this->var2str($this->f_alta).
                    ", f_baja = ".$this->var2str($this->f_baja).
                    ", seg_social = ".$this->var2str($this->seg_social).
                    ", tipodocumento = ".$this->var2str($this->tipodocumento).
                    ", cedulaid = ".$this->var2str($this->cedulaid).
                    ", exppor = ".$this->var2str($this->exppor).
                    ", prontuario = ".$this->var2str($this->prontuario).
                    ", pasaporte = ".$this->var2str($this->pasaporte).
                    ", estadocivil = ".$this->var2str($this->estadocivil).
                    ", fcasamiento = ".$this->var2str($this->fcasamiento).
                    ", serviciomilitar = ".$this->var2str($this->serviciomilitar).
                    ", lugarcumplimiento = ".$this->var2str($this->lugarcumplimiento).
                    ", estudios = ".$this->var2str($this->estudios).
                    ", oficios = ".$this->var2str($this->oficios).
                    ", estatura = ".$this->var2str($this->estatura).
                    ", contextfis = ".$this->var2str($this->contextfis).
                    ", cutis = ".$this->var2str($this->cutis).
                    ", cabellotipo = ".$this->var2str($this->cabellotipo).
                    ", cabellocolor = ".$this->var2str($this->cabellocolor).
                    ", ojostipo = ".$this->var2str($this->ojostipo).
                    ", ojoscolor = ".$this->var2str($this->ojoscolor).
                    ", banco = ".$this->var2str($this->banco).
                    ", porcomision = ".$this->var2str($this->porcomision).
                    ", fecha = ".$this->var2str($this->fecha).
                    ", decreto = ".$this->var2str($this->decreto).
                    ", nagente = ".$this->var2str($this->nagente).
                    ", credencial = ".$this->var2str($this->credencial).
                    ", armpr = ".$this->var2str($this->armpr).
                    ", otrasarmas = ".$this->var2str($this->otrasarmas).
                    ", obs = ".$this->var2str($this->obs).
                    ", obs1 = ".$this->var2str($this->obs1).
                    ", fechagoe = ".$this->var2str($this->fechagoe).
                    ", motivogoe = ".$this->var2str($this->motivogoe).
                    ", practicaart = ".$this->var2str($this->practicaart).
                    ", antpgoe = ".$this->var2str($this->antpgoe).
                    ", claustr = ".$this->var2str($this->claustr).
                    ", sufrvert = ".$this->var2str($this->sufrvert).
                    ", sabna = ".$this->var2str($this->sabna).
                    ", sabcon = ".$this->var2str($this->sabcon).
                    ", conpa = ".$this->var2str($this->conpa).
                    ", carasalt = ".$this->var2str($this->carasalt).
                    
                    "  WHERE codagente = ".$this->var2str($this->codagente).";";
         }
         else
         {
            $sql = "INSERT INTO ".$this->table_name." (codagente,nombre,apellidos,dnicif,telefono,
               email,cargo,provincia,ciudad,direccion,f_nacimiento,f_alta,f_baja,seg_social,banco,porcomision,fcasamiento,tipodocumento,cedulaid,exppor,prontuario,pasaporte,estadocivil,serviciomilitar,lugarcumplimiento,estudios,oficios,estatura,contextfis,cutis,cabellocolor,cabellotipo,ojostipo,ojoscolor,fecha,decreto,nagente,credencial,armpr,otrasarmas,obs,obs1,fechagoe,motivogoe,practicaart,antpgoe,claustr,sufrvert,sabna,sabcon,conpa,carasalt)
               VALUES (".$this->var2str($this->codagente).
                    ",".$this->var2str($this->nombre).
                    ",".$this->var2str($this->apellidos).
                    ",".$this->var2str($this->dnicif).
                    ",".$this->var2str($this->telefono).
                    ",".$this->var2str($this->email).
                    ",".$this->var2str($this->cargo).
                    ",".$this->var2str($this->provincia).
                    ",".$this->var2str($this->ciudad).
                    ",".$this->var2str($this->direccion).
                    ",".$this->var2str($this->f_nacimiento).
                    ",".$this->var2str($this->f_alta).
                    ",".$this->var2str($this->f_baja).
                    ",".$this->var2str($this->seg_social).
                    ",".$this->var2str($this->banco).
                    ",".$this->var2str($this->porcomision).
                    ",".$this->var2str($this->fcasamiento).
                    ",".$this->var2str($this->tipodocumento).
                    ",".$this->var2str($this->cedulaid).
                    ",".$this->var2str($this->exppor).
                    ",".$this->var2str($this->prontuario).
                    ",".$this->var2str($this->pasaporte).
                    ",".$this->var2str($this->estadocivil).
                    ",".$this->var2str($this->serviciomilitar).
                    ",".$this->var2str($this->lugarcumplimiento).
                    ",".$this->var2str($this->estudios).
                    ",".$this->var2str($this->oficios).
                    ",".$this->var2str($this->estatura).
                    ",".$this->var2str($this->contextfis).
                    ",".$this->var2str($this->cutis).
                    ",".$this->var2str($this->cabellocolor).
                    ",".$this->var2str($this->cabellotipo).
                    ",".$this->var2str($this->ojostipo).
                    ",".$this->var2str($this->ojoscolor).
                    ",".$this->var2str($this->fecha).
                    ",".$this->var2str($this->decreto).
                    ",".$this->var2str($this->nagente).
                    ",".$this->var2str($this->credencial).
                    ",".$this->var2str($this->armpr).
                    ",".$this->var2str($this->otrasarmas).
                    ",".$this->var2str($this->obs).
                    ",".$this->var2str($this->obs1).
                    ",".$this->var2str($this->fechagoe).
                    ",".$this->var2str($this->motivogoe).
                    ",".$this->var2str($this->practicaart).
                    ",".$this->var2str($this->antpgoe).
                    ",".$this->var2str($this->claustr).
                    ",".$this->var2str($this->sufrvert).
                    ",".$this->var2str($this->sabna).
                    ",".$this->var2str($this->sabcon).
                    ",".$this->var2str($this->conpa).
                    ",".$this->var2str($this->carasalt).");";
         }
         
         return $this->db->exec($sql);
      }
      else
         return FALSE;
   }
   
   public function delete()
   {
      $this->clean_cache();
      return $this->db->exec("DELETE FROM ".$this->table_name." WHERE codagente = ".$this->var2str($this->codagente).";");
   }
   
   private function clean_cache()
   {
      $this->cache->delete('m_agente_all');
   }
   
   public function all()
   {
      $listagentes = $this->cache->get_array('m_agente_all');
      if(!$listagentes)
      {
         $agentes = $this->db->select("SELECT * FROM ".$this->table_name." ORDER BY nombre ASC;");
         if($agentes)
         {
            foreach($agentes as $a)
               $listagentes[] = new agente($a);
         }
         $this->cache->set('m_agente_all', $listagentes);
      }
      
      return $listagentes;
   }
   
   public function get_direcciones()
   {
      $dir = new direccion_agente();
      return $dir->all_from_agente($this->codagente);
   }
   public function get_diser()
   {
      $dir = new diser_agente();
      return $dir->all_from_agente($this->codagente);
   }
   public function get_academias()
   {
      $dir = new academia_agente();
      return $dir->all_from_agente($this->codagente);
   }

   public function get_ingresogoe()
   {
      $dir = new ingresogoe_agente();
      return $dir->all_from_agente($this->codagente);
   }

   public function get_domiciliosant()
   {
      $dir = new domiciliosant_agente();
      return $dir->all_from_agente($this->codagente);
   }
   public function get_cursosagente()
   {
      $dir = new cursos_agente();
      return $dir->all_from_agente($this->codagente);
   }

   public function get_jornadasagente()
   {
      $dir = new jornadas_agente();
      return $dir->all_from_agente($this->codagente);
   }
   public function get_ascenso()
   {
      $dir = new ingreso_agente();
      return $dir->all_from_agente($this->codagente);
   }
   public function get_ascensoa()
   {
      $dir = new ingreso_agente1();
      return $dir->all_from_agente($this->codagente);
   }
   public function get_seminariosagente()
   {
      $dir = new seminario_agente();
      return $dir->all_from_agente($this->codagente);
   }
   public function get_conferenciaagente()
   {
      $dir = new conferencia_agente();
      return $dir->all_from_agente($this->codagente);
   }
   public function get_opera()
   {
      $dir = new agente_opera();
      return $dir->all_from_agente($this->idservicio);
   }
   
}
   