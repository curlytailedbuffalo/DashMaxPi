<?php


function checkMovieCount(){
	$dbV = getDBConnectionV();
	$results = $dbV->query("SELECT COUNT(*) as total FROM movie");
	$data = $results->fetch_assoc();
	return $data["total"];
	
}
function checkTVCount(){
	$dbV = getDBConnectionV();
	$results = $dbV->query("SELECT COUNT(*) as total FROM tvshow");
	$data = $results->fetch_assoc();
	return $data["total"];
	
}
function getAllVideos(){

	$dbV = getDBConnectionV();
	$results = $dbV->query("SELECT c00, c14, c01, c08, c07 FROM movie");
	$x = 1;
	if($results){
		while($row = $results->fetch_assoc()) {
			$title[$x] = htmlspecialchars($row['c00'], ENT_QUOTES);
			$genre[$x] = htmlspecialchars($row['c14'], ENT_QUOTES);
			$description[$x] = htmlspecialchars($row['c01'], ENT_QUOTES);
			$releaseYear[$x] = $row['c07'];
			
			$poster[$x] = substr(htmlspecialchars($row['c08']), 50, 62);
			
			$checker = substr($poster[$x], -1, 1);
			//echo $checker;
			if($checker == "j"){
				$poster[$x] .= "pg";
			}elseif($checker == "p"){
				$poster[$x] .= "g";
			}elseif($checker == "."){
				$poster[$x] .= "jpg";
			}elseif(is_numeric($checker)){
				$poster[$x] .= ".jpg";
			}
			$x++;
			}
			
			$moviearray['title'] = $title;
			$moviearray['genre'] = $genre;
			$moviearray['description'] = $description;
			$moviearray['poster'] = $poster;
			$moviearray['releaseYear'] = $releaseYear;
		return $moviearray;
		}else{
			return false;
		}
}

function getAllTV(){

	$dbV = getDBConnectionV();
	$results = $dbV->query("SELECT * FROM tvshow");
	$x = 1;
	if($results){
		while($row = $results->fetch_assoc()) {
			$title[$x] = htmlspecialchars($row['c00'], ENT_QUOTES);
			$genre[$x] = htmlspecialchars($row['c08'], ENT_QUOTES);
			$description[$x] = htmlspecialchars($row['c01'], ENT_QUOTES);
			$poster[$x] = substr(htmlspecialchars($row['c06']), 39, 46);
			$checker = substr($poster[$x], -1, 1);
			if($checker == "j"){
				$poster[$x] .= "pg";
			}elseif($checker == "p"){
				$poster[$x] .= "g";
			}elseif($checker == "."){
				$poster[$x] .= "jpg";
			}elseif(is_numeric($checker)){
				$poster[$x] .= ".jpg";
			}
			//echo $poster[$x];
			$x++;
			}
			$tvarray['title'] = $title;
			$tvarray['genre'] = $genre;
			$tvarray['description'] = $description;
			$tvarray['poster'] = $poster;
		return $tvarray;
		}else{
			return false;
		}
}

function getAllMV(){

	$dbV = getDBConnectionV();
	$results = $dbV->query("SELECT * FROM musicvideo");
	$x = 1;
	if($results){
		while($row = $results->fetch_assoc()) {
			$title[$x] = $row['c00'];
			$genre[$x] = $row['c08'];
			$description[$x] = $row['c01'];
			
			$poster[$x] = substr(htmlspecialchars($row['c06']), 39, 46);
			$checker = substr($poster[$x], -1, 1);
			if($checker == "j"){
				$poster[$x] .= "pg";
			}elseif($checker == "p"){
				$poster[$x] .= "g";
			}elseif($checker == "."){
				$poster[$x] .= "jpg";
			}elseif(is_numeric($checker)){
				$poster[$x] .= ".jpg";
			}
			//echo $poster[$x];
			$x++;
			}
			$tvarray['title'] = $title;
			$tvarray['genre'] = $genre;
			$tvarray['description'] = $description;
			$tvarray['poster'] = $poster;
		return $tvarray;
		}else{
			return false;
		}
}

function getCountTV(){
	$dbV = getDBConnectionV();
	$sql = "SELECT c00 FROM tvshow";
	$result = $dbV->query($sql); 
	$count = $result->num_rows;
	return $count;
}

function getCountMovies(){
	$dbV = getDBConnectionV();
	$sql = "SELECT c00 FROM movie";
	$result = $dbV->query($sql); 
	$count = $result->num_rows;
	return $count;
}

function getCountMV(){
	$dbV = getDBConnectionV();
	$sql = "SELECT c00 FROM musicvideo";
	$result = $dbV->query($sql); 
	$count = $result->num_rows;
	return $count;
}

function getCountMusic(){
	$dbV = getDBConnectionM();
	$sql = "SELECT idSong FROM song";
	$result = $dbV->query($sql); 
	$count = $result->num_rows;
	return $count;
}

function getNewCount(){
	
	$t=date('d-m-Y');
$d = date_parse_from_format("Y-m-d", $t);
//echo $d["month"];
//$dayName = strtolower(date("D",strtotime($t)));
//$dayNum = strtolower(date("d",strtotime($t)));
//$dayNum = floor(($dayNum - 1) / 7) + 1


	$dbV = getDBConnectionV();
	$sql = "SELECT dateAdded FROM files";
	$result = $dbV->query($sql); 
	$count = 0;
	while($row = $result->fetch_assoc()) {
			$month = substr($row['dateAdded'], 5, 2);
			$day = substr($row['dateAdded'], 8, 2);
			if($d['month'] == $month){
				if($d['day'] - $day<= 7){
					$count++;
				}
			}
	}
	return $count;
}

?>