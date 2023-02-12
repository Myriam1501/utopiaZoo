function flip(image){
    let im=document.getElementById(image);
    if(im.getAttribute('src')!=="http://utopiazoo.local/taquin/IMG_2525.jpg"){
    if(image==="img7" || image==="img15"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m9.jpg");
    }else if(image==="img1" || image==="img18"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m1.jpg");
    }else if(image==="img2" || image==="img17"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m2.jpg");
    }else if(image==="img3" || image==="img16"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m3.jpg");
    }else if(image==="img4" || image==="img12"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m4.jpg");
    }else if(image==="img5" || image==="img11"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m5.jpg");
    }else if(image==="img6" || image==="img10"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m6.jpg");
    }else if(image==="img8" || image==="img14"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m7.jpg");
    }else if(image==="img9" || image==="img13"){
        $(im).attr('src',"http://utopiazoo.local/IMG/m8.jpg");
    }
        let know=document.getElementById("cnt");
        know.textContent=parseInt(know.textContent)+1+"";
        if(know.textContent==="2"){
            isSameCards(image);
        }else if(know.textContent==="3"){
            know.textContent=1+"";
            returnCards(image);
        }
    }
}

function isSameCards(image){
    let lignes=document.getElementById("table").rows;
    let len=lignes.length;
    let count=1;
    let arret="false";
    for(let i=0; i<len; i++)//on peut directement définir la variable i dans la boucle
    {
        let arrayColonnes = lignes[i].cells;//on récupère les cellules de la ligne
        let largeur = arrayColonnes.length;

        for(let j=0; j<largeur; j++)
        {
            let id="img"+count;
            if(id!==image){
                let p1=document.getElementById(id);
                let p2=document.getElementById(image);
                if(p1.getAttribute('src')===p2.getAttribute('src')){
                    let val=document.getElementById("nbrPaire");
                    val.textContent=parseInt(val.textContent)+1+"";
                    $(p1).attr('src',"http://utopiazoo.local/taquin/IMG_2525.jpg");
                    $(p2).attr('src',"http://utopiazoo.local/taquin/IMG_2525.jpg");
                    arret="true";
                    if(val.textContent==="9"){
                        document.body.style.backgroundColor="green";
                        let ding = new Audio('http://utopiazoo.local/taquin/win.mp3');
                        ding.play();
                    }
                    break;
                }
            }
            count++;
        }
        if(arret==="true"){
            break;
        }
    }

}

function returnCards(image){
    let lignes=document.getElementById("table").rows;
    let len=lignes.length;
    let count=1;
    for(let i=0; i<len; i++)//on peut directement définir la variable i dans la boucle
    {
        let arrayColonnes = lignes[i].cells;//on récupère les cellules de la ligne
        let largeur = arrayColonnes.length;

        for(let j=0; j<largeur; j++) {
            let id="img"+count;
            if(id!==image){
                let p1=document.getElementById(id);
                if(p1.getAttribute('src')!=="http://utopiazoo.local/taquin/cardBack.jpg"){
                    if(p1.getAttribute('src')!=="http://utopiazoo.local/taquin/IMG_2525.jpg"){
                        $(p1).attr('src',"http://utopiazoo.local/taquin/cardBack.jpg");
                    }
                }

            }
            count++;
        }

    }
}

function retry(){
    location.reload();
}