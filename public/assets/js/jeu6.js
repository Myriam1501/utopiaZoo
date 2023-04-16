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
                $(ne).attr('src', image.getAttribute('src'));
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
    let img=document.getElementById("img1").getAttribute('src');
    let position=img.indexOf('.');
    let img1=img.substring(position-1,position);
    let img2=document.getElementById("img2").getAttribute('src').substring(position-1,position);
    let img3=document.getElementById("img3").getAttribute('src').substring(position-1,position);
    let img4=document.getElementById("img4").getAttribute('src').substring(position-1,position);
    let img5=document.getElementById("img5").getAttribute('src').substring(position-1,position);
    let img6=document.getElementById("img6").getAttribute('src').substring(position-1,position);
    let img7=document.getElementById("img7").getAttribute('src').substring(position-1,position);
    let img8=document.getElementById("img8").getAttribute('src').substring(position-1,position);
    let img9=document.getElementById("img9").getAttribute('src').substring(position-1,position);
    if(img1==="1"){
        if(img2==="9"){
            if(img3==="2"){
                if(img4==="3"){
                    if(img5==="4"){
                        if(img6==="5"){
                            if(img7==="6"){
                                if(img8==="7"){
                                    if(img9===""){
                                        img=img.substring(0,position-1)+'8.jpg';
                                        $("#img9").attr('src',img);
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

function retry(){
    location.reload();
}