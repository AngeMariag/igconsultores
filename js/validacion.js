function vl_numeros(event){
    //alert(key);  //  MUESTRA EL NRO DE PULSACION
    key = event.keyCode || event.which;
    if(key>=48&&key<=57){   //NUMEROS
        return true;
    }
    return false; 
}//Solo numeros

function solo_letras(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
function vl_nletra_simbolos(event){
    key=event.keyCode || event.which;
    //alert(key);  //  MUESTRA EL NRO DE PULSACION
    if(key>=65&&key<=90 || key==209){   //MAYUSCULAS
        return true;
    }
    if(key>=97&&key<=122 || key==241){      //MINUSCULAS
        return true;
    }
    if(key>=48&&key<=57){   //NUMEROS
        return true;
    }
    if(key==32){    //ESPACIO
        return true;
    }
    if(key>=44&&key<=47){   //SIMBOLOS
        return true;
    }
    if(key==58){
        return true;
    }
     if(key>=40&&key<=41){   //SIMBOLOS
        return true;
    }

    return false;  
}
function formatoFecha(objName,escribo,e,objOtro){
    evt = e ? e : event;
    tecla = (window.Event) ? evt.which : evt.keyCode;
    // tecla = (document.all) ? e.keyCode : e.which;
    vValue=objName.value;
    tam=vValue.length;
    nextObj(objOtro, e);
    // alert(tecla);
    if(escribo){
        if(tecla==47)
            return false;   
        if(tam>=0 && !(tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 || tecla==8 || tecla==9 || tecla==13 || tecla==46 || (tecla>=35 && tecla<=40)))
            return false;
            // objOtro.value+='.';
        if(tecla!=8)
        if(tam==2 || tam==5 && tecla!=8)
            objName.value+='/';         
    }
}
function fecha (fecha){

if ('fecha_inicio >= fecha_fin') {
    f1=''
    alert ("la fecha de Inicio no debe ser mayor a la Fecha Fin")

};
 fecha_entrada= '10/01/12';
 fecha_salida = '10/01/05';
    f1 = new Date(fecha_inicio);
    f2 = new Date(fecha_fin);
    if (f1 < f2)
    alert("f1 es menor que f2")
}