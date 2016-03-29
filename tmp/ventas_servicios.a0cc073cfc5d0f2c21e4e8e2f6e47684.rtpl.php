<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function buscar_lineas()
   {
      if(document.f_buscar_lineas.buscar_lineas.value == '')
      {
         $('#search_results').html('');
      }
      else
      {
         $.ajax({
            type: 'POST',
            url: '<?php echo $fsc->url();?>',
            dataType: 'html',
            data: $('form[name=f_buscar_lineas]').serialize(),
            success: function(datos) {
               var re = /<!--(.*?)-->/g;
               var m = re.exec( datos );
               if( m[1] == document.f_buscar_lineas.buscar_lineas.value )
               {
                  $('#search_results').html(datos);
               }
            }
         });
      }
   }
   function mas_resultados(num)
   {
      document.f_buscar_lineas.offset.value = parseInt(document.f_buscar_lineas.offset.value) + parseInt(num);
      
      if(document.f_buscar_lineas.offset.value < 0)
      {
         document.f_buscar_lineas.offset.value = 0;
      }
      
      buscar_lineas();
   }
   function clean_cliente()
   {
      document.f_custom_search.ac_cliente.value='';
      document.f_custom_search.codcliente.value='';
      document.f_custom_search.ac_cliente.focus();
      document.f_custom_search.submit();
   }    
   $(document).ready(function() {
      $('#b_buscar_lineas').click(function(event) {
         event.preventDefault();
         $('#modal_buscar_lineas').modal('show');
         document.f_buscar_lineas.buscar_lineas.focus();
      });
      $('#f_buscar_lineas').keyup(function() {
         buscar_lineas();
      });
      $('#f_buscar_lineas').submit(function(event) {
         event.preventDefault();
         buscar_lineas();
      });
      $("#ac_cliente").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_cliente',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.f_custom_search.codcliente.value != suggestion.data && suggestion.data != '')
               {
                  document.f_custom_search.codcliente.value = suggestion.data;
                  document.f_custom_search.submit();
               }
            }
         }
      });
   });
</script>

<div class="container-fluid" style="margin-top: 10px; margin-bottom: 10px;">
   <div class="row">
      <div class="col-xs-12 text-center visible-xs">
         <h2 style="margin-top: 0px;"><?php echo $fsc->page->title;?></h2>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-8 col-xs-6">
        <div class="btn-group hidden-xs">
            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
               <span class="glyphicon glyphicon-refresh"></span>
            </a>
            <?php if( $fsc->page->is_default() ){ ?>

            <a class="btn btn-sm btn-default active" href="<?php echo $fsc->url();?>&amp;default_page=FALSE" title="desmarcar como página de inicio">
               <span class="glyphicon glyphicon-home"></span>
            </a>
            <?php }else{ ?>

            <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&amp;default_page=TRUE" title="marcar como página de inicio">
               <span class="glyphicon glyphicon-home"></span>
            </a>
            <?php } ?>

         </div>
         <div class="btn-group">
            <a class="btn btn-sm btn-success" href="index.php?page=nuevo_servicio">
               <span class="glyphicon glyphicon-plus"></span>
               <span class="hidden-xs">&nbsp; Nuevo</span>
            </a>
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?><a class="btn btn-sm btn-default" href="index.php?page=ventas_serviciosimprimir">
               <span class="glyphicon glyphicon-print"></span>
               <span class="hidden-xs">&nbsp; Imprimir lista personalizada</span>
            </a>
            
         </div>
      </div>
      <div class="col-sm-4 col-xs-6 text-right">
         
         <div class="btn-group">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
               <li>
                  <a href="<?php echo $fsc->url();?>&order=fecha_desc">
                     <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                     &nbsp; Fecha &nbsp;
                     <?php if( $fsc->order=='fecha DESC' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                  </a>
               </li>
               <li>
                  <a href="<?php echo $fsc->url();?>&order=fecha_asc">
                     <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                     &nbsp; Fecha &nbsp;
                     <?php if( $fsc->order=='fecha ASC' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                  </a>
               </li>
               <li>
                  <a href="<?php echo $fsc->url();?>&order=codigo_desc">
                     <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                     &nbsp; Código &nbsp;
                     <?php if( $fsc->order=='codigo DESC' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                  </a>
               </li>
               <li>
                  <a href="<?php echo $fsc->url();?>&order=codigo_asc">
                     <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                     &nbsp; Código &nbsp;
                     <?php if( $fsc->order=='codigo ASC' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                  </a>
               </li>
               <li>
                  <a href="<?php echo $fsc->url();?>&order=prioridad_desc">
                     <span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span>
                     &nbsp; Prioridad &nbsp;
                     <?php if( $fsc->order=='prioridad DESC' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                  </a>
               </li>
               <li>
                  <a href="<?php echo $fsc->url();?>&order=prioridad_desc">
                     <span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span>
                     &nbsp; Prioridad &nbsp;
                     <?php if( $fsc->order=='prioridad ASC' ){ ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?>

                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<?php if( $fsc->avisosat=='1' ){ ?>

<div class="well">
   <div class="page-header" style="margin-top: 0px;">
      <h1>Tienes SAT instalado</h1>
   </div>
   <p>
      Si lo deseas, puedes importar tus registros de SAT con sus detalles a Servicios. Una vez realizado esto deberás borrar o desactivar el plugin SAT para evitar
      confusiones.
   </p>
   <a href="<?php echo $fsc->url();?>&importar=TRUE" class="btn btn-sm btn-info">
      <span class="glyphicon glyphicon-import"></span>
      &nbsp; Importar
   </a>
</div>
<?php }elseif( $fsc->avisosat=='2' ){ ?>

<div class="well">
   <div class="page-header" style="margin-top: 0px;">
      <h1>Desactivar SAT</h1>
   </div>
   <p>
      Desactiva SAT para evitar problemas
   </p>
   <a href="index.php?page=admin_home&disable=SAT#plugins" class="btn btn-sm btn-danger">
      <span class="glyphicon glyphicon-lock"></span>
      &nbsp; Desactivar
   </a>
</div>
<?php } ?>

<ul class="nav nav-tabs" role="tablist"> 
   <li  class="active">
      <a href="#" title="Buscar">
         <span class="glyphicon glyphicon-search"></span>
         <span class="hidden-xs">&nbsp; Brechas</span>
         <span class="hidden-xs badge"><?php echo $fsc->num_resultados;?></span>
      </a>
   </li>
</ul>
<br/>
<form name="f_custom_search" action="<?php echo $fsc->url();?>" method="post" class="form">
   <?php if( $fsc->cliente ){ ?>

   <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
   <?php }else{ ?>

   <input type="hidden" name="codcliente"/>
   <?php } ?>

   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-2">
            <div class="form-group">
               Buscar
               <div class="input-group">
                  <input class="form-control" type="text" name="query" value="<?php echo $fsc->query;?>" autocomplete="off">
                  <span class="input-group-btn">
                     <button class="btn btn-primary hidden-sm" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                     </button> 
                  </span>
               </div>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Estado
               <select name="estado" class="form-control" onchange="this.form.submit()">
                  <option value="">   </option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->estados->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->id==$fsc->estado ){ ?>

                     <option value="<?php echo $value1->id;?>" selected=""><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
               <div class="checkbox" style="display: none">
                  <label>
                     <input type="checkbox" name="editable"<?php if( $fsc->editable ){ ?> checked="checked"<?php } ?> value="TRUE" onchange="this.form.submit()"/>
                     <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Pendiente Albarán
                  </label>
               </div>
            </div>
         </div>
         <div class="col-sm-1" style="display: none">
            <div class="form-group">
               Serie
               <select class="form-control" name="codserie" onchange="this.form.submit()">
                  <option value="">    </option>
                  <option value="">-----</option>
                  <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codserie==$fsc->codserie ){ ?>

                     <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            Objetivo
            <div class="form-group">
               <div class="input-group">
                  <?php if( $fsc->cliente ){ ?>

                  <input class="form-control" type="text" name="ac_cliente" value="<?php echo $fsc->cliente->nombre;?>" id="ac_cliente" placeholder="Cualquier objetivo " autocomplete="off"/>
                  <?php }else{ ?>

                  <input class="form-control" type="text" name="ac_cliente" id="ac_cliente" placeholder="Cualquier objetivo" autocomplete="off"/>
                  <?php } ?>

                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button" onclick="clean_cliente()">
                        <span class="glyphicon glyphicon-remove"></span>
                     </button>
                  </span>
               </div>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Desde
               <input type="text" name="desde" value="<?php echo $fsc->desde;?>" class="form-control datepicker" autocomplete="off" onchange="this.form.submit()"/>

            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Hasta
               <input type="text" name="hasta" value="<?php echo $fsc->hasta;?>" class="form-control datepicker"  autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2 ">
            <div class="form-group">
               Efectivo policial.
               <select name="codagente" class="form-control" onchange="this.form.submit()">
                  <option value="">      </option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->codagente==$fsc->codagente ){ ?>

                     <option value="<?php echo $value1->codagente;?>" selected=""><?php echo $value1->get_fullname();?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codagente;?>"><?php echo $value1->get_fullname();?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
      </div>
   </div>
</form>
<div class="table-responsive" id="paraImprimir">
  <table class="table table-hover">
      <thead>
         <tr>
            <th class="text-left">Código</th>
            <th class="text-left">Lugar</th>
            <th class="text-left">Fecha / Hora</th>           
            <th class="text-left">Solicito</th>              
            <th class="text-left">Brechero 1°</th>
            <th class="text-left">Brechero Aux</th>           
            <th class="text-left">Manual</th>              
            <th class="text-left">Mecánica</th>
            <th class="text-left">Balística</th>           
            <th class="text-left">Explosiva</th>              
            <th class="text-left">Funcionó</th>
         </tr>
      </thead>
      <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      <tr class="clickableRow" href="<?php echo $value1->url();?>" style="background-color: #<?php echo $value1->color_estado();?>">
         <td><?php echo $value1->codigo;?> <?php echo $value1->numero2;?></td>
         <td><?php echo $value1->direccion;?>, (<?php echo $value1->ciudad;?>)</td>
         <td>
            <?php echo $value1->fechainicio;?>

         </td>
         <td><?php echo $value1->solucion;?></td>
         <?php if( $fsc->servicios_setup['servicios_mostrar_material'] ){ ?>

         <td><?php echo $value1->brprincipal;?></td>
         <?php } ?>

         <?php if( $fsc->servicios_setup['usar_direccion'] ){ ?>

         <td><?php echo $value1->braux;?></td>
         <?php } ?>

         <td class="text-left"><?php echo $value1->manual;?></td>
         <td class="text-left">
           <?php echo $value1->mecanica;?> 
         </td>
       <td class="text-left">
           <?php echo $value1->balistica;?> 
         </td>
         <td class="text-left">
           <?php echo $value1->explosiva;?> 
         </td>
         <td class="text-left">
           <?php echo $value1->repconf;?> 
         </td>
      </tr>
      <?php }else{ ?>

      <tr class="warning">
         <td></td>
         <td colspan="9">Ningún <?php  echo FS_SERVICIO;?> encontrado. Pulsa el botón <b>Nuevo</b> para crear uno.</td>
      </tr>
      <?php } ?>

      <?php if( $fsc->total_resultados!=='' ){ ?>

      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <?php if( $fsc->servicios_setup['servicios_mostrar_material'] ){ ?>

         <td></td>
         <?php } ?>


         <td></td>
         <?php if( $fsc->servicios_setup['servicios_mostrar_fechainicio'] ){ ?>

         <td></td>
         <?php } ?>

         <?php if( $fsc->servicios_setup['servicios_mostrar_fechafin'] ){ ?>

         <td></td>
         <?php } ?>

      </tr>
      <?php } ?>

   </table>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 text-center">
         <ul class="pagination">
            <?php $loop_var1=$fsc->paginas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <li<?php if( $value1['actual'] ){ ?> class="active"<?php } ?>>
               <a href="<?php echo $value1['url'];?>"><?php echo $value1['num'];?></a>
            </li>
            <?php } ?>

         </ul>
      </div>
   </div>
</div>

<?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

   <?php if( $value1->type=='minicron' ){ ?>

   <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" style="display: none;"></iframe>
   <?php } ?>

<?php } ?>


<form class="form" role="form" id="f_buscar_lineas" name="f_buscar_lineas" action="<?php echo $fsc->url();?>" method="post">
   <input type="hidden" name="offset" value="0"/>
   <div class="modal" id="modal_buscar_lineas">
      <div class="modal-dialog" style="width: 99%; max-width: 950px;">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Buscar en las líneas</h4>
               <?php if( $fsc->cliente ){ ?>

               <p class="help-block">
                  Estas buscando en las líneas de los <?php  echo FS_ALBARANES;?> de <?php echo $fsc->cliente->nombre;?>.
               </p>
               <?php }else{ ?>

               <p class="help-block">Si quieres, puede <a href="<?php echo $fsc->url();?>&mostrar=buscar">filtrar por cliente</a>.</p>
               <?php } ?>

            </div>
            <div class="modal-body">
               <?php if( $fsc->cliente ){ ?>

               <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente->codcliente;?>"/>
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="input-group">
                           <input class="form-control" type="text" name="buscar_lineas" placeholder="Referencia" autocomplete="off"/>
                           <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit">
                                 <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                           <input class="form-control" type="text" name="buscar_lineas_o" placeholder="Observaciones" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
               </div>
               <?php }else{ ?>

               <div class="input-group">
                  <input class="form-control" type="text" name="buscar_lineas" placeholder="Referencia" autocomplete="off"/>
                  <span class="input-group-btn">
                     <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                  </span>
               </div>
               <?php } ?>

            </div>
            <div id="search_results" class="table-responsive"></div>
         </div>
      </div>
   </div>
</form>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>