
function Valid(){
    let mer=document.getElementById("result").textContent;
    let rep=document.getElementById("rep");
    let str=new String();
    let word=new String(mer);
    for (let pas = 0; pas < mer.length; pas++) {
        str=str+"_ ";
    }
    rep.textContent=str;
    document.getElementById("entry").style.opacity = "0";
    document.getElementById("letter").style.opacity = "1";
    document.getElementById("verif").style.opacity = "1";
    document.getElementById("penduimg").style.opacity = "1";
    document.getElementById("lettreErr").style.opacity = "1";
    document.getElementById("count").style.opacity = "1";
    document.getElementById("rep").style.opacity = "1";
}


function Corec() {
    let mer=document.getElementById("result");
    let leter=document.getElementById("letter");
    let larep=document.getElementById("rep");

    let words = larep.textContent.split(' ');
    if(leter.value.length==1){
        let posi=0;
        posi=mer.textContent.indexOf(leter.value,posi);
        if(posi==-1){
            erreur(leter.value);
        }
        else{
            do{
                words[posi]=leter.value;
                posi=posi+1;
                posi=mer.textContent.indexOf(leter.value,posi);
            }while(posi!=-1);
        }
        larep.textContent=words.join(' ');

        if(larep.textContent.indexOf('_')==-1){
            let ding = new Audio('https://universal-soundbank.com/sounds/3672.mp3');
            ding.play();
            document.getElementById("letter").style.opacity = "0";
            document.getElementById("verif").style.opacity = "0";
            document.getElementById("retry").style.opacity = "1";
            document.body.style.backgroundColor="green";
        }
    }else{
        erreur(leter.value);
    }
}


function erreur(err){
    let ajout=document.getElementById("lettreErr");
    ajout.textContent=ajout.textContent+" "+err;
    let count=document.getElementById("count");
    let nbr=parseInt(count.textContent);
    nbr=nbr+1;
    count.textContent=new String(nbr);
    var source;
    if (nbr==1){
        source='IMG/pendu_1.JPG';
    }else if(nbr==2){
        source='IMG/pendu_2.JPG';
    }else if(nbr==3){
        source='IMG/pendu_3.JPG';
    }else if(nbr==4){
        source='IMG/pendu_4.JPG';
    }else if(nbr==5){
        source='IMG/pendu_5.JPG';
    }else if(nbr==6){
        source='IMG/pendu_6.JPG';

    }else if(nbr==7){
        source='IMG/pendu_7.JPG';

    }else if(nbr==8){
        source='IMG/pendu_8.JPG';

    }else if(nbr==9){
        source='IMG/pendu_9.JPG';

    }else if(nbr==10){
        source='IMG/pendu_10.JPG';
        let ding=new Audio("https://mp3gaga.com/wp-content/uploads/2021/04/Mariam-makebas-the-lion-sleeps-tonight.mp3");
        ding.play();
        document.getElementById("penduimg").style.animationName="clignoter";
        document.body.style.animationName="clignoter";
        document.body.style.backgroundColor="red";
        document.getElementById("letter").style.opacity = "0";
        document.getElementById("verif").style.opacity = "0";
        document.getElementById("retry").style.opacity = "1";
        let displayResult=document.getElementById("result");
        displayResult.textContent="La r??ponse ??tais :"+displayResult.textContent;
        document.getElementById("result").style.opacity="1";
    }
    $("#penduimg").attr('src', source);
}

function playAgain(){
    location.reload();
}
