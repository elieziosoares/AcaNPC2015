function onDocumentLoad(){
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="Sim"){
            $("#medicamentoLabel").show();
            $("#medicamentoInput").show();
        }
        if($(this).attr("value")=="Nao"){
            $("#medicamentoLabel").hide();
            $("#medicamentoInput").hide();
        }
    });
    $("#inscricao").click(function(){
        $("#inscricao").hide();
        $("#forminscricao").show();
    });
    $("#inscricao").click(function (event) {
        event.preventDefault();
        var idElemento = $(this).attr("href");
        var deslocamento = $(idElemento).offset().top;
        $('html, body').animate({ scrollTop: deslocamento }, 'slow');
    });
    $("#telresponsavel").mask("(00) 0000-00009");
    $("#telacampante").mask("(00) 0000-00009");
    $("#dtnascimento").mask("99/99/9999");
}

function onPagamentoLoad(){
    $("#modoPagamento").click(function(){
        var valor = document.getElementById("modoPagamento").value;
        
        if(valor=="À Vista (R$ 230,00)"){
            $("#pagamentoAvista").show();
            $("#pagamentoParcelado").hide();
            $("#instrucaoParcelamento").hide();
        }
        else if(valor=="Parcelado (R$ 240,00)"){
            $("#pagamentoAvista").hide();
            $("#pagamentoParcelado").show();
            $("#instrucaoParcelamento").show();
        }

        event.preventDefault();
        var deslocamento = $("#modoPagamento").offset().top;
        $('html, body').animate({ scrollTop: deslocamento }, 'slow');
    });
}