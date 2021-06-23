/* begin: multiply elements in scheudls */
function addFormElements() {
    var i = $(".agendamentosarray").length;
    var newschedules = $(".agendamentosarray")
        .eq(i - 1)
        .clone();
    newschedules.find(".schedulesinput").each(function () {
        var nameinput = this.name.split(/^[0-9]/);
        this.name = this.name.replace(i - 1 + nameinput[1], +i + nameinput[1]);
        this.id = this.name.replace(i - 1 + nameinput[1], +i + nameinput[1]);
    });

    //ACRESCENTAR A OS MINUTOS
    // newschedules.find(".inputtime").each(function () {
    //     var time = $("#"+(i-1)+"-hora").val();
    //     console.log(time);
    //     var newMinute = moment.utc(time,'HH:mm:ss').add(30,'minutes').format('HH:mm:ss');
    //     $("#"+(i+1)+"-hora").val(newMinute);
    //     console.log(newMinute)
    // });
    $(".agendamentosreply").append(newschedules);
    $(".qntdAgendamentos").html(i + 1);
}

function removeFormElements() {
    var i = $(".agendamentosarray").length;

    if (i == 1) {
        Swal.fire("Precisa ter no minimo um agendamento!", "", "error");
        return;
    }
    $(this).parents(".agendamentosarray").remove();
    $(".qntdAgendamentos").html(i - 1);
}

$(document).on("click", ".add-btn", addFormElements);
$(document).on("click", ".remove-btn", removeFormElements);

/* end: multiply elements in scheudls */

/* begin: mask's */
$(document).ready(function () {
    $(function () {
        $("#vacinado").on("change", function () {
            //se foi vacinado entra no 1
            if (this.value == "1") {
                $(".estaimunizado").show(); //pergunta se esta totalmente imuzado
                $("#person-imunizado").prop('required',true);
                $("#person-imunizado").on("change", function () {
                    if (this.value == "null") { //se nao estiver imunzado mostra o proximo agendamento e coloca a hora como required
                        $(".novoAgendamentoCheckin").show();
                        $("#novo-hora").prop('required',true);
                    } else {
                        $(".novoAgendamentoCheckin").hide();
                        $("#novo-hora").prop('required',false);
                    }
                });
            } else {
                $(".estaimunizado").hide(); 
                $(".novoAgendamentoCheckin").hide();
                $("#novo-hora").prop('required',false);
                $("#person-imunizado").prop('required',false);
            }
        });
       
    });

    $(".dateM").mask("00/00/0000");
    $(".cpfM").mask("000.000.000-00");
    $(".timeM").mask("00:00:00");
    $(".cel").mask("(00)00000-0000");
    $(".cnsM").mask("000 0000 0000 0000");
    $(".date_time").mask("00/00/0000 00:00:00");
    $("#cep").mask("00000-000");
    $(".phone").mask("0000-0000");
    $(".phone_with_ddd").mask("(00) 0000-0000");
    $(".phone_us").mask("(000) 000-0000");
    $(".mixed").mask("AAA 000-S0S");
    $(".cpf").mask("000.000.000-00", { reverse: true });
    $(".cnpj").mask("00.000.000/0000-00", { reverse: true });
    $(".money").mask("000.000.000.000.000,00", { reverse: true });
    $(".money2").mask("#.##0,00", { reverse: true });
    $(".ip_address").mask("0ZZ.0ZZ.0ZZ.0ZZ", {
        translation: {
            Z: {
                pattern: /[0-9]/,
                optional: true,
            },
        },
    });
    $(".ip_address").mask("099.099.099.099");
    $(".percent").mask("##0,00%", { reverse: true });
    $(".clear-if-not-match").mask("00/00/0000", { clearIfNotMatch: true });
    $(".placeholder").mask("00/00/0000", { placeholder: "__/__/____" });
    $(".fallback").mask("00r00r0000", {
        translation: {
            r: {
                pattern: /[\/]/,
                fallback: "/",
            },
            placeholder: "__/__/____",
        },
    });
    $(".selectonfocus").mask("00/00/0000", { selectOnFocus: true });
    /* end: mask's */

    /* begin: verify cpf */
    function TestaCPF(strCPF) {
        strCPF = strCPF.replace(/([^\d])+/gim, "");
        var Soma;
        var Resto;
        Soma = 0;
        if (strCPF == "00000000000") return false;

        for (i = 1; i <= 9; i++)
            Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if (Resto == 10 || Resto == 11) Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10))) return false;

        Soma = 0;
        for (i = 1; i <= 10; i++)
            Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if (Resto == 10 || Resto == 11) Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11))) return false;
        return true;
    }
    $("#cpf").blur(function (cpf) {
        var strCPF = $("#cpf").val();
        if (TestaCPF(strCPF)) {
            $(':input[type="submit"]').prop("disabled", false);
        } else {
            Swal.fire("ERRO!", "CPF INVÁLIDO", "error");
            $(':input[type="submit"]').prop("disabled", true);
        }
    });
    /* end: verify cpf */

    /* begin: busca de cep */
    function limpaFormularioCep() {
        // Limpa valores do formulÃ¡rio de cep.
        $("#cep").val("");
        $("#endereco").val("");
        $("#cidade").val("");
        $("#estado").val("");
        $("#bairro").val("");
        // $('#cidade').prop('readonly', false);
        // $('#estado').prop('readonly', false);
    }

    function idade(ano_aniversario, mes_aniversario, dia_aniversario) {
        var d = new Date(),
            ano_atual = d.getFullYear(),
            mes_atual = d.getMonth() + 1,
            dia_atual = d.getDate(),
            ano_aniversario = +ano_aniversario,
            mes_aniversario = +mes_aniversario,
            dia_aniversario = +dia_aniversario,
            quantos_anos = ano_atual - ano_aniversario;

        if (
            mes_atual < mes_aniversario ||
            (mes_atual == mes_aniversario && dia_atual < dia_aniversario)
        ) {
            quantos_anos--;
        }

        return quantos_anos < 0 ? 0 : quantos_anos;
    }

    $("#datanascimento").blur(function () {
        var datafull = $("#datanascimento").val();
        var data = datafull.split("-");

        $("#idade").val(idade(data[0], data[1], data[2]));
    });

    //Quando o campo cep perde o foco.
    $("#cep").blur(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: "center",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        const ToastSemTime = Swal.mixin({
            toast: true,
            position: "center",
            showConfirmButton: false,
            timerProgressBar: false,
            onOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        //Nova variÃ¡vel "cep" somente com dÃ­gitos.
        var cep = $(this).val().replace(/\D/g, "");

        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //ExpressÃ£o regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                //$("#rua").val("...");
                //$("#bairro").val("...");
                //$("#cidade").val("...");
                //$("#uf").val("...");
                //$("#ibge").val("...");
                ToastSemTime.fire({
                    icon: "warning",
                    title: "Procurando CEP",
                });

                //Consulta o webservice viacep.com.br/
                $.getJSON(
                    "https://viacep.com.br/ws/" + cep + "/json/?callback=?",
                    function (dados) {
                        if (!("erro" in dados)) {
                            Toast.fire({
                                icon: "success",
                                title: "CEP VÁLIDO!",
                                text: "TERMINE O PREENCHIMENTO",
                            });
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);

                            $("#cidade").val(dados.localidade);
                            $("#cidade").prop("readonly", true);

                            $("#estado").val(dados.uf);
                            $("#estado").prop("readonly", true);

                            $("#bairro").val(dados.bairro);
                        } //end if.
                        else {
                            //CEP pesquisado nÃ£o foi encontrado.
                            limpaFormularioCep();
                            Toast.fire({
                                icon: "error",
                                text: "CEP NÃO É VÁLIDO",
                            });
                        }
                    }
                );
            } //end if.
            else {
                //cep Ã© invÃ¡lido.
                limpaFormularioCep();
                Toast.fire({
                    icon: "error",
                    title: "CEP inválido",
                });
            }
        } //end if.
        else {
            //cep sem valor, limpa formulÃ¡rio.
            limpaFormularioCep();
        }
    });
    /* end: busca de cep */

    //disabled buttons form
    $(function () {
        $("form").submit(function (event) {
            $(this).find(".btnpre").prop("disabled", true);
            $(".btnpre").html(
                `<span style="display: inline-block;
                    width: 2rem;
                    cursor: not-allowed;
                    height: 2rem;
                    vertical-align: text-bottom;
                    border: .25em solid currentColor;
                    border-right-color: transparent;
                    border-radius: 50%;
                    -webkit-animation: spinner-border .75s linear infinite;
                    animation: spinner-border .75s linear infinite;width: 1rem;
                    height: 1rem;
                    border-width: .2em;
      "class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Aguarde...`
            );
        });
    });
});
