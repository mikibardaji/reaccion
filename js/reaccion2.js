/*$(document).ready(function() {
    $("form").submit(function(e) {
        e.preventDefault(); // Prevenir envío del formulario
        var buttonValue = $(this).find("input[type='submit']").val();
        $.ajax({
            type: "POST",
            url: "php/consulta.php",
            data: { buttonValue: buttonValue },
            success: function(response) {
                $("#resultados").html(response);
            }
        });
    });
});*/

$(document).ready(function() {
    $("form").submit(function(e) {
        e.preventDefault(); // Prevenir envío del formulario
        var buttonClicked = $(this).find("input[type='submit']:focus").attr('name');

        if (buttonClicked === 'consulta1') {
            // Realizar la consulta 1
            $.ajax({
                type: "POST",
                url: "php/consulta.php",
                data: { consulta1: true },
                success: function(response) {
                    $("#resultados").html(response);
                }
            });
        } else if (buttonClicked === 'consulta2') {
            // Realizar la consulta 2
            $.ajax({
                type: "POST",
                url: "php/consulta.php",
                data: { consulta2: true, buscar: $("input[name='buscar']").val() },
                success: function(response) {
                    $("#resultados").html(response);
                }
            });
        }
    });
});
