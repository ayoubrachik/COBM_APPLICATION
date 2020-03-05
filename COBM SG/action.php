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
	$sql1 = "SELECT * ,DATE_FORMAT(date_adhesion, '%d/%m/%Y') as date_adhesion2, DATE_FORMAT(date_fin, '%d/%m/%Y') as date_fin2 ,P.type_pack,Ab.type_Abonnement FROM
    adhesion A inner JOIN packs P on A.ID_pack=P.ID inner JOIN abonnement Ab on A.ID_abonnement=Ab.ID where ID_adhesion > 0  ";
    
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
	$sql1 .= " AND CURDATE() $x date_fin and CIN LIKE '%".$search."%' and ID_adhesion > 0 OR CURDATE() $x date_fin and  nom LIKE '%".$search."%' and ID_adhesion > 0 OR CURDATE() $x date_fin and prenom LIKE '%".$search."%' and ID_adhesion > 0";
}
else if($_POST["filter"]=="expire")
{
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$sql1 .= " AND CURDATE() $y date_fin and CIN LIKE '%".$search."%' and ID_adhesion > 0 OR CURDATE() $y date_fin and  nom LIKE '%".$search."%' and ID_adhesion > 0 OR CURDATE() $y date_fin and prenom LIKE '%".$search."%' and ID_adhesion > 0 ";
}
else if($_POST["filter"]=="tous" or empty($_POST["filter"]) )
{
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
	$sql1 .= "AND CIN LIKE '%".$search."%' and ID_adhesion > 0
	OR nom LIKE '%".$search."%'  and ID_adhesion > 0
    OR prenom LIKE '%".$search."%' and ID_adhesion > 0
    ";
}
 if($_POST["trier"]=="date")
{
    $sql1 .="ORDER by 1";
}
else if($_POST["trier"]=="alpha")
{
    $sql1 .="ORDER by nom";
}
/*if(isset($_POST["date_dd"]) && isset($_POST["date_dd"]))
{
    $date1 = str_replace('/', '-', $_POST["date_dd"]);
    $newDate1 = date("Y-m-d", strtotime($date1));

    $date2 = str_replace('/', '-', $_POST["date_ff"]);
    $newDate2 = date("Y-m-d", strtotime($date2)); 

    $sql1 .=" AND date_adhesion between '$date1' and '$date2' ";
}*/


else
{
	/*$sql1 = "SELECT * ,DATE_FORMAT(date_adhesion, '%d/%m/%Y') as date_adhesion2,DATE_FORMAT(date_fin, '%d/%m/%Y') as date_fin2,P.type_pack,Ab.type_Abonnement FROM
    adhesion A inner JOIN packs P on A.ID_pack=P.ID inner JOIN abonnement Ab on A.ID_abonnement=Ab.ID";*/
}
//echo $sql1;
$result1 = mysqli_query($connect, $sql1);
if(mysqli_num_rows($result1) > 0)
{
    
    $output .= '
    <table id="example1" class=" tab1  table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>CIN</th>
                  <th>Members	</th>
                  <th>Pack</th>
                  <th>Abonnement</th>
                  <th>Avance</th>
                  <th>Reste</th>
                  <th>Mode paiment</th>
                  <th>Date debut	</th>
                  <th>Date fin</th>
                  <th>Tele</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>';

                while($row1 = mysqli_fetch_array($result1))
                {
                    $output .= '
                        <tr>
                            <td>'.$row1["nom"].'</td>
                            <td>'.$row1["prenom"].'</td>
                            <td>'.$row1["CIN"].'</td>
                        
                    ';
                         $ID_adhesion=$row1["ID_adhesion"];
                        $sql2="SELECT *, DATE_FORMAT(date_naissance, '%d/%m/%Y') as date_naissance2
                            FROM `lien` where ID_adhesion='$ID_adhesion'";
                        $result2=mysqli_query($connect,$sql2);
                        $output .=' <td>
                        <table class="sec_table" > 
                            <thead> 
                                <tr> 
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Type</th>
                                <th>Date naissance</th>
                                </tr>
                            </thead>
                        <tbody>';
                        while($row2=mysqli_fetch_assoc($result2))
                          {
                            $output .= '<tr> <td>'.$row2["nom"].' </td><td>'.$row2["prenom"].'</td>'.'<td>'.$row2["type"].'</td><td>'.$row2["date_naissance2"].'</td> </tr>';
                          }

                          
                        $className;
                        if(date("Y-m-d")>$row1['date_fin'])
                        $className='date_fin_expire';
                        else
                        $className='date_fin_active';
                        $ID_del=$row1['ID_adhesion'];
                        $output .= ' </tbody> </table> </td> ';
                        $output .= "<td>".$row1["type_pack"]."</td><td>".$row1["type_Abonnement"]."</td><td>".$row1["montant_avance"]."</td><td>".$row1["montant_recete"]."</td><td>".$row1["mode_paiment"]."</td><td>".$row1["date_adhesion2"]."</td><td><span class='$className' >".$row1['date_fin2']."</span></td><td>".$row1["tele"]."</td>";
                        $output .= "<td><a  href='#'><i class='fas fa-print'></i></a>";
                        $output .= "<a href='"."Edit_Adhesion.php?Abonn=".$row1["ID_abonnement"]."&pack=".$row1["ID_pack"].'&nbenfant='.$row1['nbenfant']."&CIN_edit=".$row1['CIN']."'><i class='fas fa-pencil-alt'></i></a>";
                        $output .= "<a onclick='deleting(`$ID_del`)' href='#'><i class='fas fa-trash-alt'></i></a></td>";
                        $output .= "</tr>";
                    
                }
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>