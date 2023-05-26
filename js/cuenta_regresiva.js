var tiempoRestante = 60;
var intervalo;
let parar_seguir=true;

function iniciarCuentaRegresiva() {
  carga_blanco();
  
  if (parar_seguir)
    {
      //document.getElementById("contador").textContent = document.getElementById("tiempo");
      var contador = document.getElementById("contador");
      intervalo = setInterval(function() {
        tiempoRestante--;
        contador.innerHTML = "Tiempo restante: " + tiempoRestante + " segundos";
        if (tiempoRestante == 0) {
          clearInterval(intervalo);
          contador.innerHTML = "¡Cuenta regresiva terminada!";
        }
      }, 1000);
    
      fetch("php/random2.php?accion=palabraAleatoria")
      .then(respuesta => respuesta.json())
      .then(data => {
        // Actualizar el elemento HTML con la palabra obtenida
        document.getElementById("palabra").textContent = data.palabra;
      }); 
      parar_seguir = !parar_seguir;  
      const boto = document.getElementById("btnIniciar");
      
      boto.innerHTML = "Pausar temps";
      boto.style.backgroundColor = "red";
      document.getElementById("btnPausar").disabled = true;
    }
    else
    {
      clearInterval(intervalo);
      parar_seguir = !parar_seguir;
      const boto = document.getElementById("btnIniciar");
      
      boto.innerHTML = "Rependre temps";
      boto.style.backgroundColor = "blue";
      document.getElementById("btnPausar").disabled = false;
    }
  //document.getElementById("btnIniciar").disabled = true;
  //document.getElementById("btnPausar").disabled = false;
}

function pausarCuentaRegresiva() {
  tiempoRestante=60;
  parar_seguir=true;
  clearInterval(intervalo);
  var contador = document.getElementById("contador");
  contador.innerHTML = "Tiempo restablecido a " + tiempoRestante + " segundos";
  document.getElementById("aciertos").textContent = 0;
  //document.getElementById("btnIniciar").disabled = false;
  //document.getElementById("btnPausar").disabled = true;

}

function cargar() {
  document.getElementById("btnIniciar").disabled = false;
  document.getElementById("btnPausar").disabled = true;

  // Insertar en la base de datos
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };
  xhttp.open("GET", "php/cargar.php", true);
  xhttp.send();
  var carga = document.getElementById("carga");
  carga.innerHTML = "¡Cargadas!";
}

var contador = 0;

function sumar() {
  contador++;
  document.getElementById("aciertos").textContent = contador;
}

function restar() {
  contador--;
  document.getElementById("aciertos").textContent = contador;
}

function carga_blanco()
{
  var carga = document.getElementById("carga");
  carga.innerHTML = "";
}