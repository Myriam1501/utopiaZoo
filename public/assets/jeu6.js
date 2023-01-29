function moves(img){
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

            if(arrayColonnes[j].innerHTML.length<60){
                let image=document.getElementById(img);
                let newImg="img"+count;
                let ne=document.getElementById(newImg);
                let action="moves('"+newImg+"')";
                $(ne).attr('src', image.src);
                $(ne).attr('onclick', action);
                $(image).attr('src',"");
                $(image).attr('onclick',"");
                arret="true";
                break;
            }
            count++;
        }
        if(arret==="true"){
            break;
        }
    }

    verif();

}

function verif(){
    let img1=document.getElementById("img1").getAttribute('src');
    let img2=document.getElementById("img2").getAttribute('src');
    let img3=document.getElementById("img3").getAttribute('src');
    let img4=document.getElementById("img4").getAttribute('src');
    let img5=document.getElementById("img5").getAttribute('src');
    let img6=document.getElementById("img6").getAttribute('src');
    let img7=document.getElementById("img7").getAttribute('src');
    let img8=document.getElementById("img8").getAttribute('src');
    let img9=document.getElementById("img9").getAttribute('src');
    if(img1==="http://utopiazoo.local/taquin/img1.jpg"){
        if(img2==="http://utopiazoo.local/taquin/img9.jpg"){
            if(img3==="http://utopiazoo.local/taquin/img2.jpg"){
                if(img4==="http://utopiazoo.local/taquin/img3.jpg"){
                    if(img5==="http://utopiazoo.local/taquin/img4.jpg"){
                        if(img6==="http://utopiazoo.local/taquin/img5.jpg"){
                            if(img7==="http://utopiazoo.local/taquin/img6.jpg"){
                                if(img8==="http://utopiazoo.local/taquin/img7.jpg"){
                                    if(img9===""){
                                        $("#img9").attr('src',"http://utopiazoo.local/taquin/img8.jpg");
                                        document.body.style.backgroundColor="green";
                                        let ding = new Audio('https://universal-soundbank.com/sounds/9669.mp3');
                                        ding.play();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}