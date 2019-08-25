<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
 
<SCRIPT>
function multiplicar() {
m1 = document.getElementById("multiplicando").value;
m2 = document.getElementById("multiplicador").value;
r = m1*m2;
document.getElementById("resultado").value = r;
 
m1 = document.getElementById("multiplicando2").value;
m2 = document.getElementById("multiplicador2").value;
r2 = m1*m2;
document.getElementById("resultado2").value = r2;
 
m1 = document.getElementById("multiplicando3").value;
m2 = document.getElementById("multiplicador3").value;
r3 = m1*m2;
document.getElementById("resultado3").value = r3;
 
m1 = document.getElementById("multiplicando4").value;
m2 = document.getElementById("multiplicador4").value;
r4 = m1*m2;
document.getElementById("resultado4").value = r4;
 
}
 
function sumar() {
t1 = document.getElementById("resultado").value;
t2 = document.getElementById("resultado2").value;
t3 = document.getElementById("resultado3").value;
t4 = document.getElementById("resultado4").value;
 
rt = t1+t2+t3+t4;
document.getElementById("total").value = rt;
}
 
</SCRIPT>
 
</head>
 
<body>
 
<table align="center" border="0">
<form id="multiplicar" action="reg01.php" method="post">
 
<tr align="center" valign="middle">
  <td><strong>Pedido</strong></td>
  <td><strong>Nombre Producto</strong></td>
  <td><strong>Cantidad</strong></td>
  <td><strong>Vr Unit.</strong></td>
  <td>&nbsp;</td>
</tr>
 
 
<tr>
 
<td>Producto 1</td>
<td><input type="text" name="producto" size="60"></td>
<td><input type="text" name="cant" id="multiplicando" value=0 onchange="multiplicar();" size="4" /></td>
<td><input type="text" name="vunit" id="multiplicador" onchange="multiplicar();" value=0 size="16" /></td>
<td align="right"><input type="text" name="resultado" id="resultado" onchange="sumar();" value=0 size="20" /></td>
</tr>
 
<tr>
<td>Producto 2</td>
<td><input type="text" name="producto2" size="60" /></td>
<td><input type="text" name="cant2" id="multiplicando2" value=0 onchange="multiplicar();" size="4" /></td>
<td><input type="text" name="vunit2" id="multiplicador2" onchange="multiplicar();" value=0 size="16" /></td>
<td align="right"><input type="text" name="resultado2" id="resultado2" onchange="sumar();" value=0 size="20"/></td>
</tr>
 
<tr>
 <td>Producto 3</td>
 <td><input type="text" name="producto3" size="60" /></td>
<td><input type="text" name="cant3" id="multiplicando3" value=0 onchange="multiplicar();" size="4" /></td>
<td><input type="text" name="vunit3" id="multiplicador3" onchange="multiplicar();" value=0 size="16" /></td>
<td align="right"><input type="text" name="resultado3" id="resultado3" onchange="sumar();" value=0 size="20" /></td> 
</tr>
 
<tr>
<td>Producto 4</td>
<td><input type="text" name="producto4" size="60" /></td>
<td><input type="text" name="cant4" id="multiplicando4" value=0 onchange="multiplicar();" size="4" /></td>
<td><input type="text" name="vunit4" id="multiplicador4" onchange="multiplicar();" value=0 size="16" /></td>
<td align="right"><input type="text" name="resultado4" id="resultado4" onchange="sumar();" value=0 size="20"/></td> 
</tr>
 
<tr> 
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td align="right">Total</td>
<td align="right">
  <input type="text" name="total" id="total" size="20" />
 </td>
 </tr>
<tr>
  <td><input type="submit" name="enviar" id="enviar" value="Enviar" /></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right">&nbsp;</td>
</tr>
 
 
 
</form>
 
</table>
 
</body>
</html>