<?php
require_once __DIR__ . '/tools/mailTools.php';

?>
<?php
ob_start();
?>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/assets/imagenes/logochifa.png" type="image/x-icon">
  <title>Comprobante</title>
</head>

<body>

  <div style='margin:0;
            padding:0;
            font-weight:600;
            font-family: Courier New, Courier, monospace'>
    <div class=' background-page marginZero' style='padding:0;margin:0;'>
      <div class='background-comprobante' style='background-color: #ffffff;
                                              width: 500px;
                                              margin: 20px auto;
                                             box-shadow: 0 0 5px #6e6e6e;
                                             border:1px solid #000;
                                              border-radius: 10px;
                                              padding: 30px;
                                              min-height: calc(100vh - 100px);
                                              padding:6px'>
        <div class='content-comprobante' style='margin: 10px auto;width: 90%;'>
          <div class='name-empresa' style='padding:6px;text-align:center;font-size:24px;color:#000;'>
            Palacio Chino Premium
          </div>
          <div class='location align fz1' style='padding:6px;
                                              text-align:center;
                                              font-size:18px;
                                              color:#000;'>
            Uruguay 908, Huancayo
          </div>
          <hr style='border: 1px dashed #000;'>
          <div class='ruc-empresa align fz2' style='padding:6px;
                                                  font-size:18px;
                                                  text-align:center;
                                                  color:#000;'>
            RUC: 10424068786
          </div>
          <hr style='border: 1px dashed #000;'>
          <div class='number-boleta align fz2' style='padding:6px;
        font-size:18px;
        text-align:center;'>
            <?php if ($idComprobante == 1) : ?>
              Boleta De Venta Electronica
            <?php elseif ($idComprobante == 2) : ?>
              Factura Electr??nica
            <?php endif; ?>
            <div class='numero-comprobante' style='padding:6px'>
              N?? <?php echo $idVenta; ?>
            </div>
          </div>
          <hr style='border: 1px dashed #000;'>
          <div class='marginTop10px' style='padding:6px;color:#000;'>
            Fecha de emisi??n:
            <div class='fecha-emision-comprobante inline' style='padding:6px;
                                                         display:inline-block;
                                                         color:#000;'>
              <?php echo $fecha; ?>
            </div>
          </div>
          <div class='hora marginTop10px' style='padding:6px'>
            Hora:
            <div class='hora-emision-comprobante' style='padding:6px;display:inline-block;'>
              <?php echo $hora; ?>
            </div>
          </div>
          <div class='usuario marginTop10px' style='padding:6px;color:#000;'>
            Se??or(a):
            <div class='nombre-usuario inline' style='padding:6px;display:inline-block;color:#000;'>
              <?php echo ucwords($cliente->nombres) . '???' . ucwords($cliente->apellidos); ?>
            </div>
          </div>
          <div class='documento marginTop10px' style='padding:6px;color:#000;'>
            <?php if ($idComprobante == 1) : ?>
              DNI:
            <?php elseif ($idComprobante == 2) : ?>
              RUC:
            <?php endif; ?>
            <div class='dni inline' style='padding:6px;display:inline-block;color:#000;'>
              <?php echo $numeroDocumento; ?>
            </div>
          </div>
          <div class='direction marginTop10px' style='padding:6px;color:#000;'>
            Direcci??n:
            <div class='direction-client inline' style='padding:6px;display:inline-block;color:#000;'>
              <?php foreach ($direccionListar as $direccion) : ?>
                <?php echo $direccion->direccion; ?>
              <?php endforeach; ?>
            </div>
          </div>
          <hr style='border: 1px dashed #000;'>
          <div style='display: flex;
                      padding:6px;
                      justify-content:space-around'>

            <div class='inline' style='width:100px;text-align:center'>Cant.</div>
            <div class='inline' style='width:150px'>Descripci??n</div>
            <div class='inline' style='width:100px;text-align:center'>Precio</div>
            <div class='inline' style='width:100px;text-align:center'>Total</d>
            </div>
          </div>
          <hr style='border: 1px dashed #000;'>
          <!-- DIV CONTENIDO CANTIDAD DESCRIPCION PRECIO PLATO -->
          <div class='compra-content'>
            <table>
              <?php foreach ($carrito as $item) : ?>
                <tr>
                  <td style='width:100px;text-align:center'>
                    <?php echo $item['cantidad']; ?>
                  </td>
                  <td style='width:150px'>
                    <?php echo $item['producto']->nombrePlato; ?>
                  </td>
                  <td style='width:100px;text-align:center'>
                    S/ <?php echo $item['producto']->precioPlato; ?>
                  </td>
                  <td style='width:100px;text-align:center'>
                    S/ <?php echo $item['producto']->precioPlato * $item['cantidad']; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
          <!-- FIN CONTENIDO CANTIDAD DESCRIPCION PRECIO PLATO -->
          <hr style='border: 1px dashed #000;'>
          <div style='padding:6px; display:flex; justify-content:space-between;'>
            <div style='width:80%'>TOTAL IGV</div>
            <div>
              <?php
              $subtotal = 0;
              foreach ($carrito as $item) {
                $precio = $item['producto']->precioPlato;
                $cantidad = $item['cantidad'];
                $costo = $precio * $cantidad;
                $subtotal = $subtotal + $costo;
                $igv = $subtotal * 0.18;
              }
              echo "S/" . $igv;
              ?>
            </div>
          </div>
          <div class='importe-venta marginTop10px' style='padding:6px; display:flex;justify-content:space-between;'>
            <div style='width:80%'>IMPORTE TOTAL DE VENTA
            </div>
            <div>
              <?php
              $subtotal = 0;
              $total = 0;
              foreach ($carrito as $item) {
                $precio = $item['producto']->precioPlato;
                $cantidad = $item['cantidad'];
                $costo = $precio * $cantidad;
                $subtotal = $subtotal + $costo;
                $igv = $subtotal * 0.18;
                $total = $subtotal + $igv;
              }
              echo "S/" . $total;
              ?>
            </div>
          </div>
        </div>
        <div style='padding:6px;text-align:center'>
          MUCHAS GRACIAS POR SU COMPRA
        </div>

      </div>
    </div>
    <a href=javascript:window.print()>Imprimir Comprobante</a>
  </div>
</body>

</html>
<?php
$comprobante = ob_get_clean();
echo $comprobante;
?>