var menu = '<div id="Div_menu" onmouseover="menux(3,0);" onmouseout="menux(2,0);"> ';
    menu+=  '<div onclick="salirfacebook();">';
    menu+=  '<img src="images/logout.png" style="width:130%;cursor:pointer;"></div>';
    menu+=  '</div>';
fb.ready(function() {
    console.log("aca-"+fb.logged);
    if (fb.logged)
    {
        // Cambiamos el link de identificarse por el nombre y la foto del usuario.
        var html = createLoginFace(fb.user.picture, fb.user.name);
        document.getElementById("navright").innerHTML = html;
        $('#vote').show();
        getIdLogin(fb.user.id);
    } else {
        $('#menuRedesSociales').show();
    }
});
function goto(url){
    document.location.href=url;
}
// Funcion para logarse con Facebook.
function login() {
    fb.login(function() {
        if (fb.logged) {
            // Cambiamos el link de identificarse por el nombre y la foto del usuario.
            var html = createLoginFace(fb.user.picture, fb.user.name);
            document.getElementById("navright").innerHTML = html;
            $('#vote').show();
            getIdLogin(fb.user.id);
        } else {
            alert("No se pudo identificar al usuario");
        }
    });
}
;
/* FUNCIONES DE ACCESO A DATOS*/

/* FUCIONES BASICAS*/
var timeoutId;
function menux(modo, lista) {
    if (modo == 1) {
        clearTimeout(timeoutId);
        $('#Div_menu').fadeIn(100);

        $('#boton_aparece_menu').css("color", "#fff")
        $('#boton_aparece_menu').css("border", "0px")
    } else if (modo == 2) {
        timeoutId = setTimeout(function() {
            $('#Div_menu').fadeOut(100);
            $("#boton_aparece_menu").css("color", "");
            $("#boton_aparece_menu").css("border", "");
        }, 650);
    } else if (modo == 3) {
        clearTimeout(timeoutId);
    }

}
function salirfacebook() {
    fb.logout();
    idUser="";
    var saliendo = setTimeout("salirFaceNow()", 1500);
}
function salirFaceNow() {
    document.location.reload();
}
function redirige(link) {
    location.href = link;
}