
//SCRIPT QU EJECUTA BUSQUED EN MI TABLA 
            // When document is ready: this gets fired before body onload <img src="http://blogs.digitss.com/wp-includes/images/smilies/simple-smile.png" alt=":)" class="wp-smiley" style="height: 1em; max-height: 1em;" />
        $(document).ready(function () {
            // Write on keyup event of keyword input element
            $("#buscar").keyup(function () {
                // When value of the input is not blank
                if ($(this).val() != "")
                {
                    // Show only matching TR, hide rest of them
                    $("#tabacreedor tr").hide();

                    $("#tabacreedor td:contains-ci('" + $(this).val() + "')").parent("tr").show();
                    // $("$boton").show();
                   
                }
                else
                {
                    // When there is no input or clean again, show everything back
                    $("#tabacreedor tbody>tr").show();

                }
            });
        });
        // jQuery expression for case-insensitive filter
        $.extend($.expr[":"],
                {
                    "contains-ci": function (elem, i, match, array)
                    {
                        return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });
        //SCRIPT QU EJECUTA BUSQUED EN MI TABLA 
            // When document is ready: this gets fired before body onload <img src="http://blogs.digitss.com/wp-includes/images/smilies/simple-smile.png" alt=":)" class="wp-smiley" style="height: 1em; max-height: 1em;" />
        $(document).ready(function () {
            // Write on keyup event of keyword input element
            $("#buscar").keyup(function () {
                // When value of the input is not blank
                if ($(this).val() != "")
                {
                    // Show only matching TR, hide rest of them
                    $("#tabacreedor tr").hide();

                    $("#tabacreedor td:contains-ci('" + $(this).val() + "')").parent("tr").show();
                    // $("$boton").show();
                   
                }
                else
                {
                    // When there is no input or clean again, show everything back
                    $("#verproyectos tbody>tr").show();

                }
            });
        });
        // jQuery expression for case-insensitive filter
        $.extend($.expr[":"],
                {
                    "contains-ci": function (elem, i, match, array)
                    {
                        return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });