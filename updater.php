<?php

if( !file_exists('config.php') )
{
   die('Archivo config.php no encontrado. No puedes actualizar sin instalar.');
}

require_once 'config.php';
require_once 'base/fs_cache.php';

class fs_updater
{
   public $btn_fin;
   public $errores;
   public $mensajes;
   public $plugins;
   public $tr_options;
   public $tr_updates;
   public $version;
   public $xid;
   
   private $cache;
   private $download_list2;
   private $plugin_updates;
   
   public function __construct()
   {
      $this->btn_fin = FALSE;
      $this->cache = new fs_cache();
      $this->errores = '';
      $this->mensajes = '';
      $this->plugins = array();
      $this->tr_options = '';
      $this->tr_updates = '';
      $this->version = '';
      $this->xid = '';
      
      if( isset($_COOKIE['user']) AND isset($_COOKIE['logkey']) )
      {
         /// ¿Están todos los permisos correctos?
         if( !isset($_GET['update']) AND ! isset($_GET['reinstall']) AND ! isset($_GET['plugin']) )
         {
            foreach($this->__areWritable($this->__getAllSubDirectories('.')) as $dir)
            {
               $this->errores .= 'No se puede escribir sobre el directorio ' . $dir . '<br/>';
            }
         }
         
         if($this->errores != '')
         {
            $this->errores .= 'Tienes que corregir estos errores antes de continuar.';
         }
         else if( isset($_GET['update']) OR isset($_GET['reinstall']) )
         {
            $this->actualizar_nucleo();
         }
         else if( isset($_GET['plugin']) )
         {
            $this->actualizar_plugin();
         }
         else if( isset($_GET['idplugin']) AND isset($_GET['name']) AND isset($_GET['key']) )
         {
            $this->actualizar_plugin_pago();
         }
         else if( isset($_GET['idplugin']) AND isset($_GET['name']) AND isset($_POST['key']) )
         {
            $private_key = $_POST['key'];
            if( file_put_contents('tmp/' . FS_TMP_NAME . 'private_keys/' . $_GET['idplugin'], $private_key) )
            {
               $this->mensajes = 'Clave añadida correctamente.';
            }
            else
               $this->errores = 'Error al guardar la clave.';
         }
         
         if($this->errores == '')
         {
            $version_actual = file_get_contents('VERSION');
            $this->version = $version_actual;
            $nueva_version = @$this->curl_get_contents('https://raw.githubusercontent.com/sartin1/fuerzasespeciales/master/VERSION');
            if( floatval($version_actual) < floatval($nueva_version) )
            {
               $this->tr_updates = '<tr>'
                       . '<td><b>Núcleo</b></td>'
                       . '<td>Núcleo de SARTIN.</td>'
                       . '<td class="text-right">'.$version_actual.'</td>'
                       . '<td class="text-right"><a href="" target="_blank">'.$nueva_version.'</a></td>'
                       . '<td class="text-right">
                           <a class="btn btn-sm btn-primary" href="updater.php?update=TRUE" role="button">
                              <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> &nbsp; Actualizar
                           </a>
                          </td>'
                       . '</tr>';
            }
            else
            {
               $this->tr_options = '<tr>'
                       . '<td><b>Núcleo</b></td>'
                       . '<td>Núcleo de SARTIN.</td>'
                       . '<td class="text-right">'.$version_actual.'</td>'
                       . '<td class="text-right"><a href="" target="_blank">'.$nueva_version.'</a></td>'
                       . '<td class="text-right">
                          <a class="btn btn-xs btn-default" href="updater.php?reinstall=TRUE" role="button">
                              <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> &nbsp; Reinstalar
                          </a></td>'
                       . '</tr>';
               
               /// comprobamos los plugins
              
               
               if($this->tr_updates == '')
               {
                  $this->tr_updates = '<tr class="success"><td colspan="5">El sistema está actualizado.'
                          . ' <a href="index.php?page=admin_home&updated=TRUE">Volver</a></td></tr>';
                  $this->btn_fin = TRUE;
               }
            }
            
            $e = $this->cache->get_array('empresa');
            if($e)
            {
               $this->xid = $e[0]['xid'];
            }
         }
         else
         {
            $this->tr_updates = '<tr class="warning"><td colspan="5">Aplazada la comprobación'
                    . ' de plugins hasta que resuelvas los problemas.</td></tr>';
         }
      }
      else
         $this->errores = '<a href="index.php">Debes iniciar sesi&oacute;n</a>';
   }
   
   private function actualizar_nucleo()
   {
      $urls = array(
          'https://github.com/sartin1/fuerzasespeciales/archive/master.zip',
          'https://codeload.github.com/sartin1/fuerzasespeciales/zip/master'
      );
      
      foreach($urls as $url)
      {
         if( @file_put_contents('update.zip', $this->curl_get_contents($url)) )
         {
            $zip = new ZipArchive();
            $zip_status = $zip->open('update.zip');
            
            if($zip_status === TRUE)
            {
               $zip->extractTo('.');
               $zip->close();
               unlink('update.zip');
               
               /// eliminamos archivos antiguos
               $this->delTree('base/');
               $this->delTree('controller/');
               $this->delTree('extras/');
               $this->delTree('model/');
               $this->delTree('raintpl/');
               $this->delTree('view/');
               
               /// ahora hay que copiar todos los archivos de facturascripts-master a . y borrar
               $this->recurse_copy('fuerzasespeciales-master/', '.');
               $this->delTree('fuerzasespeciales-master/');
               
               /// limpiamos la caché
               $this->clean_cache();
               
               $this->mensajes = 'Actualizado correctamente.';
               break;
            }
            else
               $this->errores = 'Ha habido un error con el archivo update.zip. Código: '.$zip_status;
         }
         else
            $this->errores = 'Error al descargar el archivo zip.';
      }
   }
   

   private function recurse_copy($src, $dst)
   {
      $dir = opendir($src);
      @mkdir($dst);
      while(false !== ( $file = readdir($dir)))
      {
         if(( $file != '.' ) && ( $file != '..' ))
         {
            if(is_dir($src . '/' . $file))
            {
               $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
            }
            else
            {
               copy($src . '/' . $file, $dst . '/' . $file);
            }
         }
      }
      closedir($dir);
   }

   private function delTree($dir)
   {
      $files = array_diff(scandir($dir), array('.', '..'));
      foreach($files as $file)
      {
         (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
      }
      return rmdir($dir);
   }

   private function __getAllSubDirectories($base_dir)
   {
      $directories = array();

      foreach(scandir($base_dir) as $file)
      {
         if($file == '.' || $file == '..')
         {
            continue;
         }

         $dir = $base_dir . DIRECTORY_SEPARATOR . $file;
         if( is_dir($dir) )
         {
            $directories[] = $dir;
            $directories = array_merge($directories, $this->__getAllSubDirectories($dir));
         }
      }

      return $directories;
   }

   private function __areWritable($dirlist)
   {
      $notwritable = array();

      foreach ($dirlist as $dir)
      {
         if( !is_writable($dir) )
         {
            $notwritable[] = $dir;
         }
      }

      return $notwritable;
   }

   /**
    * Descarga el contenido con curl o file_get_contents
    * @param type $url
    * @param type $timeout
    * @return type
    */
   private function curl_get_contents($url)
   {
      if( function_exists('curl_init') )
      {
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
         $data = curl_exec($ch);
         $info = curl_getinfo($ch);
         
         if($info['http_code'] == 301 OR $info['http_code'] == 302)
         {
            $redirs = 0;
            return $this->curl_redirect_exec($ch, $redirs);
         }
         else
         {
            curl_close($ch);
            return $data;
         }
      }
      else
         return file_get_contents($url);
   }
   
   /**
    * Función alternativa para cuando el followlocation falla.
    * @param type $ch
    * @param type $redirects
    * @param type $curlopt_header
    * @return type
    */
   private function curl_redirect_exec($ch, &$redirects, $curlopt_header = false)
   {
      curl_setopt($ch, CURLOPT_HEADER, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $data = curl_exec($ch);
      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      
      if($http_code == 301 || $http_code == 302)
      {
         list($header) = explode("\r\n\r\n", $data, 2);
         $matches = array();
         preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
         $url = trim(str_replace($matches[1], "", $matches[0]));
         $url_parsed = parse_url($url);
         if( isset($url_parsed) )
         {
            curl_setopt($ch, CURLOPT_URL, $url);
            $redirects++;
            return $this->curl_redirect_exec($ch, $redirects, $curlopt_header);
         }
      }
      
      if($curlopt_header)
      {
         curl_close($ch);
         return $data;
      }
      else
      {
         list(, $body) = explode("\r\n\r\n", $data, 2);
         curl_close($ch);
         return $body;
      }
   }
   
   
   private function download_list2()
   {
      if( !isset($this->download_list2) )
      {
         $cache = new fs_cache();
         
         /**
          * Download_list2 es la lista de plugins de la comunidad, se descarga de Internet.
          */
         $this->download_list2 = $cache->get('download_list');
         if(!$this->download_list2)
         {
            $json = @$this->curl_get_contents('https://www.facturascripts.com/comm3/index.php?page=community_plugins&json2=TRUE', 5);
            if($json)
            {
               $this->download_list2 = json_decode($json);
               $cache->set('download_list', $this->download_list2);
            }
            else
            {
               $this->download_list2 = array();
            }
         }
      }
      
      return $this->download_list2;
   }

   private function clean_cache()
   {
      $cache = new fs_cache();
      $cache->clean();

      /// borramos los archivos temporales del motor de plantillas
      foreach(scandir(getcwd() . '/tmp') as $f)
      {
         if(substr($f, -4) == '.php')
         {
            unlink('tmp/' . $f);
         }
      }
   }
}

$updater = new fs_updater();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" >
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Actualizador de Sartin</title>
      <meta name="description" content="Actualizador de Sartin" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="generator" content="FacturaScripts" />
      <link rel="shortcut icon" href="view/img/favicon.ico" />
      <link rel="stylesheet" href="view/css/bootstrap-yeti.min.css" />
      <script type="text/javascript" src="view/js/jquery.min.js"></script>
      <script type="text/javascript" src="view/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <div class="page-header">
                  <h1>
                     <a href="index.php?page=admin_home&updated=TRUE" class="btn btn-xs btn-default">
                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                     </a>
                     Actualizador de Sartin
                  </h1>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <?php
               if($updater->errores != '')
               {
                  echo '<div class="alert alert-danger">'.$updater->errores.'</div>';
               }
               else if($updater->mensajes != '')
               {
                  echo '<div class="alert alert-info">'.$updater->mensajes.'</div>';
                  
                  if($updater->btn_fin)
                  {
                     echo '<a href="index.php?page=admin_home&updated=TRUE" class="btn btn-sm btn-info">'
                             . '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp; Finalizar'
                           . '</a></br/></br/>';
                  }
               }
               ?>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <p class="help-block">
                  Este actualizador permite actualizar su sistema, es recomendable utilizarlo periodicamente para poder evitar fallos y ademas de algunas modificaciones solicitadas por usted. Saludos :)
               </p>
               <br/>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                     <a href="#actualizaciones" aria-controls="actualizaciones" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
                        <span class="hidden-xs">&nbsp; Actualizaciones</span>
                     </a>
                  </li>
               
               </ul>
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="actualizaciones">
                     <div class="table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th class="text-left">Nombre</th>
                                 <th class="text-left">Descripción</th>
                                 <th class="text-right">Versión</th>
                                 <th class="text-right">Nueva versión</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <?php echo $updater->tr_updates; ?>
                        </table>
                     </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="opciones">
                     <div class="table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th class="text-left">Opción</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <?php echo $updater->tr_options; ?>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
 
      <br/><br/>
      
      <div class="text-center">;-)</div>
      <?php
      if(!FS_DEMO)
      {
         $url = 'https://www.facturascripts.com/comm3/index.php?page=community_stats'
                 . '&add=TRUE&version='.$updater->version.'&plugins='.join(',', $updater->plugins);
         ?>
         <div style="display: none;">
            <iframe src="<?php echo $url; ?>" height="0"></iframe>
         </div>
         <?php
      }
      ?>
   </body>
</html>