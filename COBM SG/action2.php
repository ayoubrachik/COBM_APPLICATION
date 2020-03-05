<?php
include("db_connect.php");
//
if(!isset($_POST["filter"]))
$_POST["filter"]="tous";

if(!isset($_POST["trier"]))
$_POST["trier"]="date";
$x='<';
$y='>';
    $search = mysqli_real_escape_string($connect, $_POST["query"]);


	$sql1 = "SELECT C.ID_cotisation as 'ID_cotisation', A.nom as 'nom_adh',A.prenom as 'prenom_adh', A.CIN as 'CIN_adh',P.type_pack as 'pack',AB.type_Abonnement as 'abonn',L.prenom as 'prenom_member' ,L.nom as 'nom_member',
    AC.type as 'type_act',AC.intitule as 'intitule_act',C.montant as 'montant',C.date_debut as 'date_debut',C.date_fin as 'date_fin',C.ID_adhesion as 'ID_adhesion',C.ID_lien as 'ID_lien'
    from cotisation C INNER JOIN adhesion A on C.ID_adhesion = A.ID_adhesion INNER join lien L on C.ID_lien=L.ID_lien INNER JOIN activite AC on C.ID_activite = AC.id_activite INNER JOIN
    packs P on A.ID_pack = P.ID INNER JOIN abonnement AB on A.ID_abonnement = AB.ID where 1=1";
    
//

$output = '';
/*echo"q: ".$_POST["query"]."<br>";
echo"f: ".$_POST["filter"]."<br>";
echo"t: ".$_POST["trier"]."<br>";
echo"dd: ".$_POST["date_dd"]."<br>";
echo"ff: ".$_POST["date_ff"]."<br>";*/

if($_POST["filter"]=="valable")
{
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
	$sql1 .= " AND CURDATE() $x C.date_fin and A.nom LIKE '%".$search."%' or CURDATE() $x C.date_fin and A.prenom LIKE '%".$search."%' 
    or CURDATE() $x C.date_fin and L.nom LIKE '%".$search."%' or CURDATE() $x C.date_fin and L.prenom LIKE '%".$search."%' ";
}

else if($_POST["filter"]=="expire")
{
    
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$sql1 .= " AND CURDATE() $y C.date_fin and A.nom LIKE '%".$search."%' or CURDATE() $y C.date_fin and A.prenom LIKE '%".$search."%' 
    or CURDATE() $y C.date_fin and L.nom LIKE '%".$search."%' or CURDATE() $y C.date_fin and L.prenom LIKE '%".$search."%' ";
}

else if($_POST["filter"]=="tous" or empty($_POST["filter"]) )
{
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
	$sql1 .= " AND A.nom LIKE '%".$search."%'
	OR A.prenom LIKE '%".$search."%' 
    OR L.prenom LIKE '%".$search."%'
    ";
}
if($_POST["trier"]=="date")
{
    $sql1 .="ORDER by C.ID_cotisation DESC";
}
else if($_POST["trier"]=="alpha")
{
    $sql1 .="ORDER by A.nom";
}
/*if(isset($_POST["date_dd"]) && isset($_POST["date_dd"]))
{
    $date1 = str_replace('/', '-', $_POST["date_dd"]);
    $newDate1 = date("Y-m-d", strtotime($date1));

    $date2 = str_replace('/', '-', $_POST["date_ff"]);
    $newDate2 = date("Y-m-d", strtotime($date2)); 

    $sql1 .=" AND date_adhesion between '$date1' and '$date2' ";
}*/


/*else
{
	$sql1 = "SELECT * ,DATE_FORMAT(date_adhesion, '%d/%m/%Y') as date_adhesion2,DATE_FORMAT(date_fin, '%d/%m/%Y') as date_fin2,P.type_pack,Ab.type_Abonnement FROM
    adhesion A inner JOIN packs P on A.ID_pack=P.ID inner JOIN abonnement Ab on A.ID_abonnement=Ab.ID";
}*/
//echo $sql1;
$result1 = mysqli_query($connect, $sql1);
if(mysqli_num_rows($result1) > 0)
{
    
    $output .= '
    <table id="example1" class=" table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>CIN</th>
                  <th>Pack</th>
                  <th>Abonnement</th>
                  <th>Members</th>
                  <th>Activite</th>
                  <th>montant</th>
                  <th>Date debut</th>
                  <th>Date fin</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>';

                while($row1 = mysqli_fetch_array($result1))
                {
                        $className;
                        if(date("Y-m-d")>$row1['date_fin'])
                        $className='date_fin_expire';
                        else
                        $className='date_fin_active';


                    $member="";
                    if($row1["ID_adhesion"]!=$row1["ID_lien"] )
                    $member=$row1["prenom_member"]." ".$row1["nom_member"];
                    else
                    $member="Chef";
                    $output .= '
                        <tr>
                            <td>'.$row1["nom_adh"].'</td>
                            <td>'.$row1["prenom_adh"].'</td>
                            <td>'.$row1["CIN_adh"].'</td>
                            <td>'.$row1["pack"].'</td>
                            <td>'.$row1["abonn"].'</td>
                            <td>'.$member.'</td>
                            <td>'.$row1["type_act"]."-".$row1["intitule_act"].'</td>
                            <td>'.$row1["montant"].'</td>
                            
                            <td>'.$row1["date_debut"].'</td>
                            <td>'.
                                '<span class="'.$className.'">'.    $row1["date_fin"].'</span>'.
                            '</td>
                            
                        
                    ';
                         
                        
                        

                         
                        
                        $ID_cotisation_del=$row1['ID_cotisation'];
                        
                        
                        $output .= "<td><a  href='#'><i class='fas fa-print'></i></a>";
                        $output .= "<a href='"."Edit_Adhesion.php?Abonn=".$row1["ID_abonnement"]."&pack=".$row1["ID_pack"].'&nbenfant='.$row1['nbenfant']."&CIN_edit=".$row1['CIN']."'><i class='fas fa-pencil-alt'></i></a>";
                        $output .= "<a onclick='deleting2(`$ID_cotisation_del`)' href='#'><i class='fas fa-trash-alt'></i></a></td>";
                        $output .= "</tr>";
                    
                }
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>