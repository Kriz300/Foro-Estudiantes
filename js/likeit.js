$("button").on("click", function () {
    if (!$(this).attr("id")) {
        return null;
    }
    var id = ($(this).attr("id")).split(",");
    if ($(this).attr("value") === "comentario") {
        var texto = document.getElementById(id[0]+","+$(this).attr("data")).value;
        if (texto.split(" ")[0] === "") {
            alert("texto invalido a comienza con un espacio");
            return null;
        }
        var url = (window.location).toString();
        var id_hilo = url.split("=");
        var res = $(this).attr("data");
        if ($(this).attr("id").split(",")[0] === "hilo") {
            res = 0;
        }
        $.ajax({
            url: "sql/"+id[0]+$(this).attr("value")+".php",
            data: "cuerpo="+texto+"&hilo="+id_hilo[1]+"&res="+res,
            type: "POST",
            success: function(data){
                FullLoad();
            },
            error: function(){}
        });
        $.ajax({
            url: "sql/agregarnotificacion.php",
            data: "hilo="+id_hilo[1]+"&tipo=1",
            type: "POST",
            success: function(data){
                FullLoad();
            },
            error: function(){}
        });
    }
    else {
        $.ajax({
            url: "sql/"+id[0]+$(this).attr("value")+".php",
            data: "key="+id[1],
            type: "POST",
            success: function(data){
                FullLoad();
            },
            error: function(){}
        });
    }
});