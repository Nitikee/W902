<?php
$servername = "172.17.0.4";
$username = "root";
$password = "Qwerasdf23";
$dbname = "iotw910";
$isbn = $_POST['isbn'];
if(!empty($isbn)){
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM tbl_books";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	//output data of each row
	$isindb = array();
		while($row = $result->fetch_assoc()){
			if($isbn == $row["isbn"]){
				array_push($isindb,0);
			}				
			else{
				array_push($isindb,1);
			}
		}
		if(in_array("0",$isindb)){
			echo "Book is in database";
		}
		else{
			echo "getting book <br>";
			$curl = curl_init();
	        	curl_setopt_array($curl, array(
	                CURLOPT_RETURNTRANSFER => 1,
	                CURLOPT_URL => "https://www.googleapis.com/books/v1/volumes?q=isbn+$isbn&maxResults=1&fields=items(volumeInfo/title,volumeInfo/imageLinks/smallThumbnail,volumeInfo/publishedDate,volumeInfo/authors)",
	                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	        	));
	        	$resp = curl_exec($curl);
	        	curl_close($curl);
	        	$jsonarray = json_decode($resp,True);
	        	$jsonarray = $jsonarray['items']['0']['volumeInfo'];
	        	$booktitle = $jsonarray['title'];
	        	$bookthumbnail = $jsonarray['imageLinks']['smallThumbnail'];
	        	$bookpublish = $jsonarray['publishedDate'];
	        	$bookauthors = $jsonarray['authors']['0'];
			$id = $result->num_rows + 1; 
			$insertsql = "INSERT INTO tbl_books (id,bookname, img, releasedate, author, isbn)
				Values ($id, '$booktitle', '$bookthumbnail', '$bookpublish', '$bookauthors', '$isbn')";
			if ($conn->query($insertsql) === TRUE) {
	    			echo "New record created successfully";
			} else {
	    			echo "Error: " . $insertsql . "<br>" . $conn->error;
			}
		}
	}
	
	else {
		echo "0 results";
	}
	$conn->close();
	}
	else{
		echo "no ISBN fetched! <br> Nothing changed!";
	}
?>
