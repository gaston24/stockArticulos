<?php require_once 'Vista/head_1.php'; ?>
<title>Stock Articulos</title>
<?php require_once 'Vista/head_2.php'; ?>
<?php require_once '../Controlador/dsn_central.php'; ?>
<div class="container-fluid">
  
  <nav>
    <form action="index.php">
      <div class="row mt-1">
        <div class="col-1">Codigo:</div> 
        <div class="col-2"><input class="form-control form-control-sm" type="text" name="codArticu" id=""></div> 
        <div class="col-1"><input class="btn btn-primary btn-sm" type="submit" name="tipo" value="Central"></div> 
        <div class="col-1"><input class="btn btn-primary btn-sm" type="submit" name="tipo" value="Locales"></div> 
        <div class="col-1"><input class="btn btn-primary btn-sm" type="submit" name="tipo" value="Todos"></div> 
      </div>
    </form>
  </nav>

  <?php 
    if(isset($_GET['codArticu']) && $_GET['codArticu']!= ''){
      $cod_articu = strtoupper($_GET['codArticu']);
      $tipo = $_GET['tipo'];
      switch ($tipo) {
        case 'Central':
          $sql = "EXEC SJ_SP_CONSULTAR_STOCK_CENTRAL '$cod_articu'";
          break;
        case 'Locales':
          $sql = "EXEC SJ_SP_CONSULTAR_STOCK_LOCALES '$cod_articu'";
          break;  
        case 'Todos':
          $sql = "EXEC SJ_SP_CONSULTAR_STOCK '$cod_articu'";
          break; 
      }
      $result=odbc_exec($cid, $sql) or die(exit("Error en odbc_exec"));
  ?>
    <table class="table table-hover  table-sm mt-2">
  <thead>
    <tr >
      <th >UBICACION</th>
      <th >CODIGO</th>
      <th >DESCRIPCION</th>
      <th >DEPO</th>
      <th >STOCK</th>
      <th >COMPROMETIDO</th>
      <th >DISPONIBLE</th>
      <th >PRECIO</th>
      <th >DESTINO</th>
      <th >FAMILIA</th>
      <th >TEMPORADA</th>

    </tr>
  </thead>
  <tbody>
    <?php while($v=odbc_fetch_array($result)){ ?>
    <tr >

      <td><?php echo $v['UBICACION']; ?></td>
      <td><?php echo $v['COD_ARTICU']; ?></td>
      <td><?php echo $v['DESCRIPCIO']; ?></td>
      <td><?php echo $v['COD_DEPOSI']; ?></td>
      <td><?php echo (int)$v['CANT_STOCK']; ?></td>
      <td><?php echo (int)$v['CANT_COMP']; ?></td>
      <td><?php echo (int)$v['CANT_DISP']; ?></td>
      <td><?php echo (float)$v['PRECIO']; ?></td>
      <td><?php echo $v['DESTINO']; ?></td>
      <td><?php echo $v['FAMILIA']; ?></td>
      <td><?php echo $v['TEMPORADA']; ?></td>
      
    </tr>
    <?php } ?>

  </tbody>
</table>
  <?php    
    }
  ?>

</div>
<?php require_once 'Vista/footer.php'; ?>