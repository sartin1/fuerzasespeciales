<?php
   
require_model('agente.php');
require_model('direccion_agente.php');
require_model('domiciliosant_agente.php');
require_model('cursos_agente.php');
require_model('seminario_agente.php');
require_model('conferencia_agente.php');
require_model('jornadas_agente.php');
require_model('diser_agente.php');
require_model('academia_agente.php');
require_model('foto_agente.php');
require_model('ingreso_agente.php');
require_model('ingreso_agente1.php');
require_model('ingresogoe_agente.php');


class admin_agente extends fs_controller
{
   public $agente;

   public $allow_delete;

   /*
    * Esta página está en la carpeta admin, pero no se necesita ser admin para usarla.
    * Está en la carpeta admin porque su antecesora también lo está (y debe estarlo).
    */
   public function __construct()
   {
      parent::__construct(__CLASS__, 'Efectivo controlador', '');
   }
   
   protected function private_core()
   {
      
      $this->ppage = $this->page->get('admin_agentes');
      
      /// ¿El usuario tiene permiso para eliminar en esta página?
      $this->allow_delete = $this->user->allow_delete_on(__CLASS__);
      $this->agente = FALSE;
      if( isset($_GET['cod']) )
      {
         $agente = new agente();
         $this->agente = $agente->get($_GET['cod']);
      }

       if( isset($_POST['codconf']) ) /// añadir/modificar cursos
      {
         $dir = new conferencia_agente();
         if($_POST['codconf'] != '')
         {
            $dir = $dir->get($_POST['codconf']);
         }
         $dir->fecha = $_POST['fecha'];
         $dir->conferencia = $_POST['conferencia'];
         $dir->codagente = $this->agente->codagente;
         $dir->observaciones = $_POST['observaciones'];
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir4']) ) /// eliminar dirección
      {
         $dir = new conferencia_agente();
         $dir0 = $dir->get($_GET['delete_dir4']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }



      if( isset($_POST['conarm']) ) /// añadir/modificar cursos
      {
         $dir = new ingresogoe_agente();
         if($_POST['conarm'] != '')
         {
            $dir = $dir->get($_POST['conarm']);
         }
         $dir->codagente = $this->agente->codagente;
         $dir->observaciones = $_POST['observaciones'];
         $dir->arma = $_POST['arma'];
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir8']) ) /// eliminar dirección
      {
         $dir = new ingresogoe_agente();
         $dir0 = $dir->get($_GET['delete_dir8']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }

      if( isset($_POST['codjor']) ) /// añadir/modificar cursos
      {
         $dir = new jornadas_agente();
         if($_POST['codjor'] != '')
         {
            $dir = $dir->get($_POST['codjor']);
         }
         $dir->fecha = $_POST['fecha'];
         $dir->jornadas = $_POST['jornadas'];
         $dir->codagente = $this->agente->codagente;
         $dir->observaciones = $_POST['observaciones'];
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir5']) ) /// eliminar dirección
      {
         $dir = new jornadas_agente();
         $dir0 = $dir->get($_GET['delete_dir5']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }


      if( isset($_POST['codasc']) ) /// añadir/modificar cursos
      {
         $dir = new ingreso_agente1();
         if($_POST['codasc'] != '')
         {
            $dir = $dir->get($_POST['codasc']);
         }
         $dir->fecha = $_POST['fecha'];
         $dir->destino = $_POST['destino'];
         $dir->codagente = $this->agente->codagente;
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir10']) ) /// eliminar dirección
      {
         $dir = new ingreso_agente1();
         $dir0 = $dir->get($_GET['delete_dir10']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }

      if( isset($_POST['codasc1']) ) /// añadir/modificar cursos
      {
         $dir = new ingreso_agente();
         if($_POST['codasc1'] != '')
         {
            $dir = $dir->get($_POST['codasc1']);
         }
         $dir->fecha1 = $_POST['fecha1'];
         $dir->jerarquia = $_POST['jerarquia'];
         $dir->decreto1 = $_POST['decreto1'];
         $dir->codagente = $this->agente->codagente;
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir9']) ) /// eliminar dirección
      {
         $dir = new ingreso_agente();
         $dir0 = $dir->get($_GET['delete_dir9']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }

      if( isset($_POST['codaca']) ) /// añadir/modificar cursos
      {
         $dir = new academia_agente();
         if($_POST['codaca'] != '')
         {
            $dir = $dir->get($_POST['codaca']);
         }
         $dir->fecha = $_POST['fecha'];
         $dir->academias = $_POST['academias'];
         $dir->codagente = $this->agente->codagente;
         $dir->observaciones = $_POST['observaciones'];
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir7']) ) /// eliminar dirección
      {
         $dir = new academia_agente();
         $dir0 = $dir->get($_GET['delete_dir7']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }


      if( isset($_POST['coddis']) ) /// añadir/modificar cursos
      {
         $dir = new diser_agente();
         if($_POST['coddis'] != '')
         {
            $dir = $dir->get($_POST['coddis']);
         }
         $dir->fecha = $_POST['fecha'];
         $dir->disertaciones = $_POST['disertaciones'];
         $dir->codagente = $this->agente->codagente;
         $dir->observaciones = $_POST['observaciones'];
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir6']) ) /// eliminar dirección
      {
         $dir = new diser_agente();
         $dir0 = $dir->get($_GET['delete_dir6']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }


      if( isset($_POST['codsem']) ) /// añadir/modificar cursos
      {
         $dir = new seminario_agente();
         if($_POST['codsem'] != '')
         {
            $dir = $dir->get($_POST['codsem']);
         }
         $dir->fecha = $_POST['fecha'];
         $dir->seminario = $_POST['seminario'];
         $dir->codagente = $this->agente->codagente;
         $dir->observaciones = $_POST['observaciones'];
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir3']) ) /// eliminar dirección
      {
         $dir = new seminario_agente();
         $dir0 = $dir->get($_GET['delete_dir3']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }


      if( isset($_POST['codcur']) ) /// añadir/modificar cursos
      {
         $dir = new cursos_agente();
         if($_POST['codcur'] != '')
         {
            $dir = $dir->get($_POST['codcur']);
         }
         $dir->fecha = $_POST['fecha'];
         $dir->cursos = $_POST['cursos'];
         $dir->codagente = $this->agente->codagente;
         $dir->observaciones = $_POST['observaciones'];
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir2']) ) /// eliminar dirección
      {
         $dir = new cursos_agente();
         $dir0 = $dir->get($_GET['delete_dir2']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }

      if( isset($_POST['coddant']) ) /// añadir/modificar domicilios anteriores
      {
         $dir = new domiciliosant_agente();
         if($_POST['coddant'] != '')
         {
            $dir = $dir->get($_POST['coddant']);
         }
         $dir->fecha = $_POST['fecha'];
         $dir->direccion = $_POST['direccion'];
         $dir->codagente = $this->agente->codagente;
         $dir->ciudad = $_POST['ciudad'];
         $dir->telefono = $_POST['telefono'];
         if( $dir->save() )
         {
            $this->new_message("Datos guardados correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar!");
      }     
         if(isset($_GET['delete_dir1']) ) /// eliminar dirección
      {
         $dir = new domiciliosant_agente();
         $dir0 = $dir->get($_GET['delete_dir1']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Datos eliminados correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar.');
         }
         else
            $this->new_error_msg('Datos no encontrada.');
      }

      if( isset($_POST['coddir']) ) /// añadir/modificar dirección
      {
         $dir = new direccion_agente();
         if($_POST['coddir'] != '')
         {
            $dir = $dir->get($_POST['coddir']);
         }
         $dir->apartado = $_POST['apartado'];
         $dir->ciudad = $_POST['ciudad'];
         $dir->codagente = $this->agente->codagente;
         $dir->codpais = $_POST['pais'];
         $dir->descripcion = $_POST['descripcion'];
         $dir->direccion = $_POST['direccion'];
         $dir->domenvio = isset($_POST['direnvio']);
         $dir->domfacturacion = isset($_POST['dirfact']);
         $dir->provincia = $_POST['provincia'];
         if( $dir->save() )
         {
            $this->new_message("Dirección guardada correctamente.");
         }
         else
            $this->new_message("¡Imposible guardar la dirección!");
      }     
         if(isset($_GET['delete_dir']) ) /// eliminar dirección
      {
         $dir = new direccion_agente();
         $dir0 = $dir->get($_GET['delete_dir']);
         if($dir0)
         {
            if( $dir0->delete() )
            {
               $this->new_message('Dirección eliminada correctamente.');
            }
            else
               $this->new_error_msg('Imposible eliminar la dirección.');
         }
         else
            $this->new_error_msg('Dirección no encontrada.');
      }
      if($this->agente)
      {
         $this->page->title .= ' ' . $this->agente->codagente;
         
         if( isset($_POST['nombre']) )
         {
            if( $this->user_can_edit() )
            {
               $this->agente->nombre = $_POST['nombre'];
               $this->agente->apellidos = $_POST['apellidos'];
               $this->agente->tipodocumento = $_POST['tipodocumento'];
               $this->agente->estatura = $_POST['estatura'];
               $this->agente->contextfis = $_POST['contextfis'];
               $this->agente->cutis = $_POST['cutis'];
               $this->agente->cedulaid = $_POST['cedulaid'];
               $this->agente->cabellotipo = $_POST['cabellotipo'];
               $this->agente->cabellocolor = $_POST['cabellocolor'];
               $this->agente->ojostipo = $_POST['ojostipo'];
               $this->agente->ojoscolor = $_POST['ojoscolor'];
               $this->agente->exppor = $_POST['exppor'];
               $this->agente->prontuario = $_POST['prontuario'];
               $this->agente->pasaporte = $_POST['pasaporte'];
               $this->agente->estadocivil = $_POST['estadocivil'];
               $this->agente->fcasamiento = $_POST['fcasamiento'];
               $this->agente->serviciomilitar = $_POST['serviciomilitar'];
               $this->agente->lugarcumplimiento = $_POST['lugarcumplimiento'];
               $this->agente->estudios = $_POST['estudios'];
               $this->agente->oficios = $_POST['oficios'];
               $this->agente->dnicif = $_POST['dnicif'];
               $this->agente->telefono = $_POST['telefono'];
               $this->agente->email = $_POST['email'];
               $this->agente->cargo = $_POST['cargo'];
               $this->agente->provincia = $_POST['provincia'];
               $this->agente->ciudad = $_POST['ciudad'];
               $this->agente->direccion = $_POST['direccion'];
               $this->agente->fecha = $_POST['fecha'];
               $this->agente->decreto = $_POST['decreto'];
               $this->agente->nagente = $_POST['nagente'];
               $this->agente->credencial = $_POST['credencial'];
               $this->agente->obs = $_POST['obs'];
               $this->agente->obs1 = $_POST['obs1'];
               $this->agente->fechagoe = $_POST['fechagoe'];
               $this->agente->motivogoe = $_POST['motivogoe'];
               $this->agente->practicaart = $_POST['practicaart'];
               $this->agente->antpgoe = $_POST['antpgoe'];
               $this->agente->claustr = $_POST['claustr'];
               $this->agente->sufrvert = $_POST['sufrvert'];
               $this->agente->sabna = $_POST['sabna'];
               $this->agente->sabcon = $_POST['sabcon'];
               $this->agente->conpa = $_POST['conpa'];
               $this->agente->carasalt = $_POST['carasalt'];
               $this->agente->armpr = $_POST['armpr'];
               if($_POST['armpr'] != '')
               {
                  $this->agente->armpr = $_POST['armpr'];
               }
               $this->agente->otrasarmas = $_POST['otrasarmas'];
               
               
               $this->agente->f_nacimiento = NULL;
               if($_POST['f_nacimiento'] != '')
               {
                  $this->agente->f_nacimiento = $_POST['f_nacimiento'];
               }
               
               $this->agente->f_alta = NULL;
               if($_POST['f_alta'] != '')
               {
                  $this->agente->f_alta = $_POST['f_alta'];
               }
               
               $this->agente->f_baja = NULL;
               if($_POST['f_baja'] != '')
               {
                  $this->agente->f_baja = $_POST['f_baja'];
               }
               
               $this->agente->seg_social = $_POST['seg_social'];
               $this->agente->banco = $_POST['banco'];
               $this->agente->porcomision = floatval($_POST['porcomision']);
               
               if( $this->agente->save() )
               {
                  $this->new_message("Datos del Efectivo policial guardados correctamente.");
               }
               else
                  $this->new_error_msg("¡Imposible guardar los datos del Efectivo policial!");
            }
            else
               $this->new_error_msg('No tienes permiso para modificar estos datos.');
         }
      }
      else
         $this->new_error_msg("Efectivo policial no encontrado.");
   }
   
   private function user_can_edit()
   {
      if(FS_DEMO)
      {
         return ($this->user->codagente == $this->agente->codagente);
      }
      else
      {
         return TRUE;
      }
   }
   
   public function url()
   {
      if( !isset($this->agente) )
      {
         return parent::url();
      }
      else if($this->agente)
      {
         return $this->agente->url();
      }
      else
         return $this->page->url();
   }
}