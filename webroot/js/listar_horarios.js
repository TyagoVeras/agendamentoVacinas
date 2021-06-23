$(document).ready(function () {
    function locais() {
        //return window.location.protocol + "//" + window.location.host+"/cidades/listar_cidades_json";
        return "" + HOST_URL + "/people/listarLocais";
    }
    function horarios() {
        //return window.location.protocol + "//" + window.location.host+"/cidades/listar_cidades_json";
        return "" + HOST_URL + "/people/listarHorarios";
    }

    //quando a categoria ta com o input empty
    // if ($("#category-id").val().length != 0) {
    //     $.getJSON(
    //         locais(),
    //         {
    //             category: $("#category-id").val(),
    //         },
    //         function (categoria) {
    //             if (categoria != null)
    //                 popularLocais(categoria, $("#category-id").val());
    //         }
    //     );
    // }

    //quando ha uma mudança
    $("#category-id").on("change", function () {
        if ($(this).val().length != 0) {
            $.getJSON(
                locais(),
                {
                    category: $(this).val(),
                },
                function (categoria) {
                    popularLocais(categoria);
                }
            );
        }

        $.getJSON(
            horarios(),
            {
                category: '0',
                place:'0',
            },
            function (categoria) {
                popularHorarios(categoria);
            }
        );
    });
    //quando ha uma mudança
    $("#place-id").on("change", function () {
        if ($(this).val().length != 0) {
            $.getJSON(
                horarios(),
                {
                    category: $("#category-id").val(),
                    place: $(this).val(),
                },
                function (categoria) {
                    popularHorarios(categoria);
                }
            );
        }else{
            $.getJSON(
                horarios(),
                {
                    category: '0',
                    place: '0',
                },
                function (categoria) {
                    popularHorarios(categoria);
                }
            );
        }
    });
});

function popularLocais(categorias, idCategoria) {
    var options = '<option value=""> - ESCOLHA O LOCAL - </option>';
    $.each(categorias[0], function (index, local) {
        
        if (idCategoria == index)
            options +=
                '<option selected="selected" value="' +index +'">' +local +"</option>";
        else
            options +=
                '<option value="' + index + '">' + local + "</option>";
        
    });
    $("#place-id").html(options);
    if( options == '<option value=""> - ESCOLHA O LOCAL - </option>' ) {
        Swal.fire("Não existe horário disponivel para essa categoria!", "Qualquer dúvida ou sugestão entre em contato com a secretaria de saúde", "error");
    }
}

function popularHorarios(categorias, idCategoria) {
    var options = "";
    $.each(categorias[0], function (index, categoria) {
        if (idCategoria == index)
            options +=
                '<option selected="selected" value="' +
                index +
                '">' +
                categoria +
                "</option>";
        else
            options +=
                '<option value="' + index + '">' + categoria + "</option>";
    });
    $("#scheduling-id").html(options);
    
}
