
function Toupper(id) {
    var x = document.getElementById(id);
    x.value = x.value.toUpperCase();
  }
  function ToupperENF() {
    var x = document.getElementsByClassName('prenom_enf');
      for(var i=0; i<x.length;i++)
      {
        x[i].value = x[i].value.toUpperCase();
      }
    
    
  }
function valide()
{
    var packS = document.getElementById("pack");
    var pack = packS.options[packS.selectedIndex].value;
    var AbonnS = document.getElementById("Abonn");
    var abonn= AbonnS.options[AbonnS.selectedIndex].value;
    var CIN= document.getElementById('CIN');
    var nom = document.getElementById("nom");
    var prenom = document.getElementById("prenom");
    var date_Adhesion = document.getElementById("Date_Adhesion");
    var tele = document.getElementById("Tele");
    var email = document.getElementById("Email");
    var nom_epou = document.getElementById("nom_epou");
    var prenom_epou = document.getElementById("Prenom_epou");
    var prenom_enf = document.getElementsByClassName("prenom_enf");
    var dates = document.getElementsByClassName("dates");
    //regx
    var rgCIN=/^[A-Z0-9]{1,20}$/;
    var rgnom = /^[A-Z ]{1,20}$/;
    var rgdate=/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/;
    var rgtele =/^[0-9+()-]{1,20}$/g;
    //
    if(pack==0)
    {
        alert("pack err");
        return false;
    }
    if(abonn==0)
    {
        alert("abonn err");
        return false; 
    }
    if(rgCIN.test(CIN.value)==false)
    {
        alert("CIN err");
        return false; 
    }
    if(rgnom.test(nom.value)==false)
    {
        alert("nom err");
        return false; 
    }
    if(rgnom.test(prenom.value)==false)
    {
        alert("prenom err");
        return false; 
    }
    if(rgtele.test(tele.value)==false)
    {
        alert("tele err");
        return false; 
    }
    
    if(rgdate.test(date_Adhesion.value)==false)
    {
        alert("date add err");
        return false;
    }
    if(rgnom.test(nom_epou.value)==false)
    {
        alert("nom conj err");
        return false;
    }
    if(rgnom.test(prenom_epou.value)==false)
    {
        alert("prenom conj err");
        return false;
    }
    
    for(var i=0;i<prenom_enf.length;i++)
    {
        if(rgnom.test(prenom_enf[i].value)==false)
        {
            alert("prenom enf err");
                return false;
        }
    }
    for(var j=0;j<dates.length;j++)
    {
        if(rgdate.test(dates[j].value)==false)
        {
            alert("dates enf err");
                return false;
        }
    }
    
    
}
function check()
{
    var div = document.getElementById("Conjoit1");
    var check = document.getElementById("check2");
    if(check.checked==false)
        div.style.display="none";
    else
        div.style.display="";
}
function change_sexe()
{
  var nom_epou = document.getElementById("nom_epou2");
  var prenom_epou= document.getElementById("prenom_epou");
  var Conjoints = document.getElementById("Conjoint");
  var Conjoint = Conjoints.options[Conjoints.selectedIndex].text;
    
    nom_epou.innerText= "Nom "+Conjoint+"(*)";
    prenom_epou.innerText="Prenom "+Conjoint+"(*)";
 
}

function get_age(enf_age)
{
        var date=enf_age;
        var arraydate= date.split('/');
        var DOB =arraydate[1]+'/'+arraydate[0]+'/'+arraydate[2];
        var millisecondsBetweenDOBAnd1970 = Date.parse(DOB);
        var millisecondsBetweenNowAnd1970 = Date.now();
        var ageInMilliseconds = millisecondsBetweenNowAnd1970-millisecondsBetweenDOBAnd1970;
        //--We will leverage Date.parse and now method to calculate age in milliseconds refer here https://www.w3schools.com/jsref/jsref_parse.asp

        var milliseconds = ageInMilliseconds;
        var second = 1000;
        var minute = second*60;
        var hour = minute*60;
        var day = hour*24;
        var month = day*30; 
        /*using 30 as base as months can have 28, 29, 30 or 31 days depending a month in a year it itself is a different piece of comuptation*/
        var year = day*365;

        //let the age conversion begin
        var years = Math.round(milliseconds/year);
        return years;
        
}

function tarif()
{
    
    var dates = document.getElementsByClassName("dates");
    var Certificat = document.getElementsByClassName("Certificat");
    var Avance = document.getElementById("Avance");
    var details="";
    var tarif=0;
    var Details_div= document.getElementById("Details");
    //pack
    var Type_Adhesion = document.getElementById("pack");
    var pack = Type_Adhesion.options[Type_Adhesion.selectedIndex].value;
    //abonnement
    var Type_Abonn = document.getElementById("Abonn");
    var Abonn = Type_Abonn.options[Type_Abonn.selectedIndex].value;
    //nombre enfant
    var nbe= document.getElementById("nbenfant");
    var nbenfant = nbe.options[nbe.selectedIndex].value;
    //montant
    var Montant = document.getElementById("Montant");
    var i;
    var j;
    //single
    if(pack==1 && Abonn==1)
    {
        tarif+=3500;
        details+="Type Abonnement : Abonnement Annuelle  <br>";
        details+="Pack Particulier-Single:3500 Dh  <br>";
    }
    if(pack==1 && Abonn==2)
    {
        tarif+=2000;
        details+="Type Abonnement : Abonnement Semestrielle  <br>";
        details+="Pack Particulier-Single:2000 Dh <br>";
    }
    if(pack==1 && Abonn==3)
    {
        tarif+=1300;
        details+="Type Abonnement : Abonnement Trimestrielle  <br>";
        details+="Pack Particulier-Single:1300 Dh  <br>";
    }
    //couple
    if(pack==2 && Abonn==1)
    {
        tarif+=4000;
        details+="Type Abonnement : Abonnement Annuelle  <br>";
        details+="Pack Particulier-Couple:4000 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=6)
            {
                tarif+=500;
                details+="Enfant entre 6 ans et 18 ans: 500 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18)
            {
                tarif+=1000;
                details+="Enfant plus 18 ans: 1000 DH  <br>";
            }
            if(get_age(dates[i].value)<6)
            {
                details+="Enfant mois 6 ans: 0 DH  <br>";
            }
        }
    }
    if(pack==2 && Abonn==2)
    {
        tarif+=2200;
        details+="Type Abonnement : Abonnement Semestrielle  <br>";
        details+="Pack Particulier-Couple:2200 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=6)
            {
                tarif+=300;
                details+="Enfant entre 6 ans et 18 ans: 300 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18)
            {
                tarif+=600;
                details+="Enfant plus 18 ans: 600 DH  <br>";
            }
            if(get_age(dates[i].value)<6)
            {
                details+="Enfant mois 6 ans: 0 DH  <br>";
            }
        }
    }
    if(pack==2 && Abonn==3)
    {
        tarif+=1400;
        details+="Type Abonnement : Abonnement Trimestrielle  <br>";
        details+="Pack Particulier-Couple:1400 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=6)
            {
                tarif+=200;
                details+="Enfant entre 6 ans et 18 ans: 200 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18)
            {
                tarif+=300;
                details+="Enfant plus 18 ans: 300 DH  <br>";
            }
            if(get_age(dates[i].value)<6)
            {
                details+="Enfant mois 6 ans: 0 DH  <br>";
            }
        }
    }
    //single with kids
    if(pack==3 && Abonn==1)
    {
        tarif+=3500;
        details+="Type Abonnement : Abonnement Annuelle  <br>";
        details+="Pack Single avec enfants:3500 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=6)
            {
                tarif+=500;
                details+="Enfant entre 6 ans et 18 ans: 500 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18)
            {
                tarif+=1000;
                details+="Enfant plus 18 ans: 1000 DH  <br>";
            }
            if(get_age(dates[i].value)<6)
            {
                details+="Enfant mois 6 ans: 0 DH  <br>";
            }
        }
    }
    if(pack==3 && Abonn==2)
    {
        tarif+=2000;
        details+="Type Abonnement : Abonnement Semestrielle  <br>";
        details+="Pack Single avec enfants:2000 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=6)
            {
                tarif+=300;
                details+="Enfant entre 6 ans et 18 ans: 300 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18)
            {
                tarif+=600;
                details+="Enfant plus 18 ans: 600 DH  <br>";
            }
            if(get_age(dates[i].value)<6)
            {
                details+="Enfant mois 6 ans: 0 DH  <br>";
            }
        }
    }
    if(pack==3 && Abonn==3)
    {
        tarif+=1300;
        details+="Type Abonnement : Abonnement Trimestrielle  <br>";
        details+="Pack Single avec enfants:1300 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=6)
            {
                tarif+=200;
                details+="Enfant entre 6 ans et 18 ans: 200 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18)
            {
                tarif+=300;
                details+="Enfant plus 18 ans: 300 DH  <br>";
            }
            if(get_age(dates[i].value)<6)
            {
                details+="Enfant mois 6 ans: 0 DH  <br>";
            }
        }
    }
    if(pack==4)
    {
        tarif+=0;
        details+="Type Abonnement : Abonnement Annuelle  <br>";
        details+="Pack Adherent honneur :0 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=6)
            {
                tarif+=0;
                details+="Enfant entre 6 ans et 18 ans: 0 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18)
            {
                tarif+=0;
                details+="Enfant plus 18 ans: 0 DH  <br>";
            }
            if(get_age(dates[i].value)<6)
            {
                details+="Enfant mois 6 ans: 0 DH  <br>";
            }
        }
    }
    //fonctionaire
    if(pack==5)
    {
        tarif+=1000;
        details+="Type Abonnement : Abonnement Annuelle  <br>";
        details+="Pack A (Fonctionnaire):1000 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=0)
            {
                tarif+=0;
                details+="Enfant entre 0 ans et 18 ans: 0 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18 && get_age(dates[i].value)<=21 && Certificat[i].value=="oui" )
            {
                
                tarif+=0;
                details+="Enfant entre 18 et 21 avec Certificat : 0 DH  <br>";
            }
            else if(get_age(dates[i].value)>18 && get_age(dates[i].value)<=21 && Certificat[i].value=="non" )
            {
                
                tarif+=500;
                details+="Jeune entre 18 et 21 avec sans Certificat : 500 DH  <br>";
            }
            if(get_age(dates[i].value)>21)
            {
                tarif+=500;
                details+="Jeune plus 21 ans: 500 DH  <br>";
            }
        }
    }

    //magistrat
    if(pack==6)
    {
        tarif+=2500;
        details+="Type Abonnement : Abonnement Annuelle  <br>";
        details+="Pack B (Magistrat):2500 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=0)
            {
                tarif+=0;
                details+="Enfant entre 0 ans et 18 ans: 0 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18 && get_age(dates[i].value)<=21 && Certificat[i].value=="oui" )
            {
                
                tarif+=0;
                details+="Enfant entre 18 et 21 avec Certificat : 0 DH  <br>";
            }
            else if(get_age(dates[i].value)>18 && get_age(dates[i].value)<=21 && Certificat[i].value=="non" )
            {
                
                tarif+=500;
                details+="Jeune entre 18 et 21 avec sans Certificat : 500 DH  <br>";
            }
            if(get_age(dates[i].value)>21)
            {
                tarif+=500;
                details+="Jeune plus 21 ans: 500 DH  <br>";
            }
        }
    }
    if(pack==7)
    {
        tarif+=1000;
        details+="Type Abonnement : Abonnement Annuelle  <br>";
        details+="Pack C (Agent autorité):1000 Dh  <br>";
        for(i=0;i<nbenfant;i++)
        {
            if(get_age(dates[i].value)<=18 && get_age(dates[i].value)>=0)
            {
                tarif+=0;
                details+="Enfant entre 0 ans et 18 ans: 0 DH  <br>";
            }
            
            if(get_age(dates[i].value)>18 && get_age(dates[i].value)<=21 && Certificat[i].value=="oui" )
            {
                
                tarif+=0;
                details+="Enfant entre 18 et 21 avec Certificat : 0 DH  <br>";
            }
            else if(get_age(dates[i].value)>18 && get_age(dates[i].value)<=21 && Certificat[i].value=="non" )
            {
                
                tarif+=500;
                details+="Jeune entre 18 et 21 avec sans Certificat : 500 DH  <br>";
            }
            if(get_age(dates[i].value)>21)
            {
                tarif+=500;
                details+="Jeune plus 21 ans: 500 DH  <br>";
            }
        }
    }
    
    Avance.value=tarif;
    Montant.value=tarif;
    Details_div.innerHTML=details;

















   /*var date1  = document.getElementById("op1").value;
    
    var Montant = document.getElementById("Montant");
    if(date1=="aa")
    Montant.value="black";*/
}