
    function mostraEscondeDiv(){
        len = menu.childElementCount;
        fechaTudo();
        for (j = 0; j < len; j++) {
            menu.children[j].onclick = function(){
                fechaTudo();
                geral.children[this.id].style.display = "block";
            }
        }

        function fechaTudo(){
            for (i = 0; i<geral.childElementCount;i++){
                geral.children[i].style.display = "none";
            }
        }
       	
    }
    mostraEscondeDiv();