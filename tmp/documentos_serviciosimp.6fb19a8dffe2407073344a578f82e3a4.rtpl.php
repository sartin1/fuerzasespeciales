<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header2") . ( substr("header2",-1,1) != "/" ? "/" : "" ) . basename("header2") );?>


<script type="text/javascript">
   function delete_documento(id,name)
   {
      if( confirm("¿Realmente desea eliminar "+name+"?") )
      {
         window.location.href = "<?php echo $fsc->url();?>&delete="+id;
      }
      
      return false;
   }
</script>
<center><h2>Fotografias</h2>
<div class="container-fluid" style="margin-top: 15px;">
   <div class="row">
    
         <div class="table-responsive">
            <table class="table">
              
               <?php $loop_var1=$fsc->documentos; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?><div class="col-sm-4"><IMG style="width: 450px" SRC="<?php echo $value1->ruta;?>"></IMG>
               <tr<?php if( !$value1->file_exists() ){ ?> class="danger"<?php } ?>>
               
                     <?php if( $value1->file_exists() ){ ?>

                      &nbsp;
                     <?php }else{ ?>

                     <span class="glyphicon glyphicon-remove" aria-hidden="true" title="No se encuentra el archivo"></span> &nbsp;
                     <?php } ?>

                     
                  </td>
                  
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="6">Sin imagenes que mostrar.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
  
      </div>
 
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer2") . ( substr("footer2",-1,1) != "/" ? "/" : "" ) . basename("footer2") );?>