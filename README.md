# W902
IOT W902
Manga Inventory System
Hasicic, Keel

## Übersicht
* Aufgabenstellung
* Idee
* Planung
* Realisierung
* Testing
* Fazit
* Sicherheitsaspekte
* Transfer in die Praxis

### Aufgabenstellung
Eigenes IOT Projekt planen und realisieren.

#### Rahmenbedingungen
* Dauer: 5 - 8 x 4 Lektionen + 4 Lektionen Präsentation
* Partnerarbeit (eine Einzelarbeit bei ungerader Schüleranzahl)

#### Ziel
* Grundsätzlich ist eine funktionierende IoT-Anwendung zu erstellen
* Es ist eine Eigenleistung im Bereich Entwicklung und Umsetzung gefordert
* Im Netz gefundenen Anleitungen können und sollen als Ressourcen verwendet werden, wobei Anpassungen, Erweiterungen und Zusammenführungen als Eigenleistung anerkannt wird.
* Bestehende Frameworks und Clouddienste können und sollen eingebunden werden (NODE-RED, IFTTT, MQTT, ...)
* Präsentation des Projektes
* Dokumentation

### Idee
#### Projektidee
Manga Inventory System:
1. ISBN eines Mangas scannen
2. Informationen des Buches mittels ISBN suchen
3. Informationen des Buches darstellen
4. Server erkennt neue Kapitel / Bücher der Serie und benachrichtigt den User (Falls die Zeit reicht) 

#### Realisierungsidee
##### Lösung 1:
Der Raspberry steht neben einem Bücherregal und scannt neue Bücher ein, sobald man diese ins Regal stellt. Der Raspberry ist mit Raspbian aufgesetzt. Am Raspberry angeschlossen, ist eine Webcam. Diese nimmt das Bild auf und leitet es an einem Programm weiter. Das Programm erkennt die ISBN, schickt es an einem Server, der Server speichert die ISBN in eine Datenbank und sucht gleichzeitig nach mehr Informationen (Titel, Cover Bild, Release Date und Author). Die Daten werden ebenfalls in die Datenbank gespeichert. Eine HTML Webseite zeigt alle Bücher mit deren Zusatzinformationen, die in der Datenbank vorhanden sind, an.

##### Lösung 2:
Der Scann wird mit einem Smartphone / App ausgeführt. Die App schickt nach dem Scann die ISBN an einem Server weiter. Dieser Server sucht weitere Informationen über das Buch mithilfe der ISBN. Anschliessend speichert der Server diese Daten in eine Datenbank und stellt es auf einer Webseite dar.  

##### Entscheidung
Wir hatten uns zuerst für die erste Lösung entschieden. Jedoch stellten wir schnell fest, dass der Raspberry den Barcode nicht gut erkennen kann. Das Problem lag an der Webcam. Die Webcam hat keinen Autofokus, weshalb die neu ins Regal gestellten Bücher, nicht erkannt werden.

Deshalb entschieden wir uns für die 2. Lösung.

### Planung

##### Benötigte Komponente:
* Android Studio
* Samsung Driver für ADB
* Server (In diesem Projekt Ubuntu Server 16.04)
* NGINX
* PHP7
* Let's Encrypt
* DNS (nitinankeel.ch)
* Docker
* MySQL Docker Container
* Samsung S8
* Google API
* Bücher für Testing
* HeidiSQL


#### Grobplanung:

Schritt|Erledigt
---|---
Smartphone APP entwickeln | <ul><li>- [ ] </li></ul>
Webservice | <ul><li>- [ ] </li></ul>
Datenbank | <ul><li>- [ ] </li></ul>
Schnittstellen | <ul><li>- [ ] </li></ul>
Webseite zur Darstellung der Informationen | <ul><li>- [ ] </li></ul>

#### Feinplanung:
**Smartphone APP entwickeln**

Schritt|Erledigt
---|---
Android Studio installiert | <ul><li>- [ ] </li></ul>
Samsung Driver für das Testing auf einem Gerät | <ul><li>- [ ] </li></ul>
Layout für das APP erstellt | <ul><li>- [ ] </li></ul>
Barcode kann gescannt werden | <ul><li>- [ ] </li></ul>

**Webservice**

Schritt|Erledigt
---|---
NGINX installieren | <ul><li>- [ ] </li></ul>
NGINX konfigurieren | <ul><li>- [ ] </li></ul>
PHP7 installieren | <ul><li>- [ ] </li></ul>
PHP7 konfigurieren | <ul><li>- [ ] </li></ul>
Let's Encrypt installieren | <ul><li>- [ ] </li></ul>
Let's Encrypt konfigurieren | <ul><li>- [ ] </li></ul>

**Datenbank**

Schritt|Erledigt
---|---
Docker installieren | <ul><li>- [ ] </li></ul>
MySQL 5.7 installieren | <ul><li>- [ ] </li></ul>
Datenbak erstellen | <ul><li>- [ ] </li></ul>
Tabelle erstellen | <ul><li>- [ ] </li></ul>

**Schnittstellen**

Schritt|Erledigt
---|---
Smartphone schickt ISBN per POST Request an <br> powershell.nitinankeel.ch/index.php | <ul><li>- [ ] </li></ul>
index.php nimmt die Anfrage an | <ul><li>- [ ] </li></ul>
index.php überprüft, ob die ISBN in der Datenbank schon vorhanden ist | <ul><li>- [ ] </li></ul>
Falls ISBN nicht vorhanden ist, nimmt index.php <br> Verbindung mit google API auf und sucht nach weitere Informationen über das Buch | <ul><li>- [ ] </li></ul>
Neue Informationen werden über PHP / index.php in die MySQL Datenbank gespeichert | <ul><li>- [ ] </li></ul>

**Webseite**

Schritt|Erledigt
---|---
powershell.nitiankeel.ch/view.php greift auf die Datenbank zu | <ul><li>- [ ] </li></ul>
powershell.nitiankeel.ch/view.php zeigt Daten in einer dynamischen Tabelle an | <ul><li>- [ ] </li></ul>

### Realisierung
#### Android Studio installieren
https://developer.android.com/studio/

#### Samsung Driver installieren
https://developer.samsung.com/galaxy/others/android-usb-driver-for-windows

#### Smartphone APP

Siehe Ordner "barcode".
Wichtigsten Files:
* /barcode/app/java/HomeActivity.java
* /barcode/gradle/app
* /barcode/manifests/AndroidManifests.xml
* /barcode/res/layout/activity_home.xml

**HomeActivity.java**
```JAVA
...
...

public void onActivityResult(int requestCode, int resultCode, Intent intent) {
        IntentResult scanningResult = IntentIntegrator.parseActivityResult(requestCode, resultCode, intent);
        if (scanningResult != null) {

            # Holt sich ISBN des Scannes
            codeContent = scanningResult.getContents(); 

            txtShowTextResult = (TextView) findViewById(R.id.txtDisplay);

            # Neue Requestqueue über Volley
            RequestQueue requestQueue = Volley.newRequestQueue(this);

            # URL für die Datenübertragung
            final String url = "https://powershell.nitinankeel.ch";

            # Erstellt POST Request und packt ISBN ins Body als Argument
            StringRequest postRequest  = new StringRequest
                    (Request.Method.POST, url, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            txtShowTextResult.setText("Response: " + response);
                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            txtShowTextResult.setText("An Error occured while making the request");
                        }
                    }){
                @Override
                protected Map<String, String> getParams()
                {
                    Map<String, String>  params = new HashMap<String, String>();
                    params.put("isbn", codeContent);

                    return params;
                }
            };

            # Schickt den Request
            requestQueue.add(postRequest);
        }else{
            Toast toast = Toast.makeText(getApplicationContext(),"No scan data received!", Toast.LENGTH_SHORT);
            toast.show();
        }
    }
...
...
```

**app**
```JAVA
...
...

dependencies {
    implementation fileTree(dir: 'libs', include: ['*.jar'])
    implementation 'com.android.support:appcompat-v7:21.0.3'
    implementation 'com.journeyapps:zxing-android-embedded:2.0.1@aar'
    implementation 'com.journeyapps:zxing-android-legacy:2.0.1@aar'
    implementation 'com.journeyapps:zxing-android-integration:2.0.1@aar'
    implementation 'com.google.zxing:core:3.0.1'
    implementation 'com.android.volley:volley:1.0.0'
}
```

**AndroidManifests.xml**
```XML
...
...
    # Permissions setzten!
    <uses-permission android:name="android.permission.CAMERA" />
    <uses-permission android:name="android.permission.INTERNET"/>
...
...
```

#### Webservice

##### NIGNX
**Installation**
https://www.digitalocean.com/community/tutorials/how-to-install-nginx-on-ubuntu-16-04

**Konfiguration**
1. Neue Subdomain erstellen
```bash
vim /etc/nginx/sites-available/powershell.nitinankeel.ch
```
```vi
server {
        root /var/www/powershell;
        index index.php index.html index.htm;
        server_name powershell.nitinankeel.ch;
        location ~ \.php$ {
                #If a file isn’t found, 404
                try_files $uri =404;
                #Include Nginx’s fastcgi configuration
                include /etc/nginx/fastcgi.conf;
                #Look for the FastCGI Process Manager at this location
                fastcgi_pass unix:/run/php/php7.0-fpm.sock;
        }
}
```
2. Ordner für Subdomain anlegen
```bash
mkdir /var/www/powershell
```

##### PHP7

**Installation und Konfiguration**
https://thishosting.rocks/install-php-on-ubuntu/

##### Let's Encrypt
**Installation**
https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-16-04

**Zertifikat erstellen**
```bash
certbot --nginx -d powershell.nitinankeel.ch
```

#### Docker Service mit MySQL

**Docker installieren**
https://docs.docker.com/install/linux/docker-ce/ubuntu/

**MySQL installieren**
```bash
docker run --name iotw902 -e MYSQL_ROOT_PASSWORD=YOUR-PASSWORD -d mysql:5.7 --port 3306:3306
```
**Datenbank erstellen und Tabelle anlegen**
Mithilfe dem "create_database.sql" File die Datenbank erstellen.

#### Schnittstellen und Webseite
Die Webseite und alle Schnittstellen werden über 2 PHP Scritps gesteuert.
Beide PHP Scripts müssen in den Ordner /var/www/powershell/ eingefügt werden.

**index.php**
```PHP
<?php
//Serveradresse
$servername = "172.17.0.4";

//Benutzername der SQL Datenbank
$username = "root";

//Password des Benutzers
$password = "YOUR-PASSWORD";

//Datenbank Name
$dbname = "iotw910";

//Holt sich das Argument 'isbn' in einer POST request
$isbn = $_POST['isbn'];

//Falls keine Daten im POST vorhanden ist, gib eine Fehlermeldung
if(!empty($isbn)){

        // Erstelle Verbindung mit MySQL-Datenbank
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Falls keien Verbindung zustande kommt gib eine Fehlermeldung 
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }

        // Holt sich Daten von der Tablle "tbl_books"
        $sql = "SELECT * FROM tbl_books";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        
        // Vergleicht, ob die ISBN in der Datenbank schon vorhanden ist
        $isindb = array();
                while($row = $result->fetch_assoc()){
                        if($isbn == $row["isbn"]){
                                array_push($isindb,0);
                        }
                        else{
                                array_push($isindb,1);
                        }
                }

                // Falls ISBN schon vorhanden ist, gibt es eine Meldung
                if(in_array("0",$isindb)){
                        echo "Book is in database";
                }

                // Falls nicht holt es sich alle Infos von der Google API 
                else{
                        echo "getting book <br>";
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        
                        // Der Link zur Google API. Variable ist $isbn.
                        CURLOPT_URL => "https://www.googleapis.com/books/v1/volumes?q=isbn+$isbn&maxResults=1&fields=items(volumeInfo/title,volumeInfo/imageLinks/smallThumbnail,volumeInfo/publishedDate,volumeInfo/authors)",
                        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
                        ));
                        $resp = curl_exec($curl);
                        curl_close($curl);

                        // Formatiert die Daten in JSON und speichert es als Variable ab
                        $jsonarray = json_decode($resp,True);
                        $jsonarray = $jsonarray['items']['0']['volumeInfo'];
                        $booktitle = $jsonarray['title'];
                        $bookthumbnail = $jsonarray['imageLinks']['smallThumbnail'];
                        $bookpublish = $jsonarray['publishedDate'];
                        $bookauthors = $jsonarray['authors']['0'];
                        $id = $result->num_rows + 1;

                        // Speichert die Variablen in die Datenbank
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
```

**view.php**
```PHP
<?php
//Serveradresse
$db_host = '172.17.0.4';

//Benutzername der SQL Datenbank
$db_user = 'root';

//Password des Benutzers
$db_pass = 'YOUR-PASSWORD';

//Datenbank Name
$db_name = 'iotw910';

// Verbinde zur MySQL Datenbank
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

// Holt sich Daten von der Tablle "tbl_books"
$sql = 'SELECT * 
		FROM tbl_books';

// Speichert die Verbindung als Variable
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
```
````HTML
<html>
<head>
	<title>IOTW910</title>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}

        <code>...        
        ...
        <code>...

		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>

    <!-- Aktualisiert die Seite jede Minuti -->
	<meta http-equiv="refresh" content="60" >
</head>
<body>
	<h1>My Inventory</h1>
	<table class="data-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Cover</th>
				<th>Release Date</th>
				<th>Author</th>
				<th>ISBN</th>
			</tr>
		</thead>
		<tbody>

		<?php
        <!-- Holt sich alle Daten der Tablle und zeitgt es als Tabelle an -->
		while ($row = mysqli_fetch_array($query))
		{
			echo '<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['bookname'].'</td>

                    <!-- Holt sich das Bild per Link -->
					<td><img src='.$row['img'].'></td>
                    
					<td>'.$row['releasedate'].'</td>
					<td>'.$row['author'].'</td>
					<td>'.$row['isbn'].'</td>
				</tr>';
		}?>

		</tbody>
	</table>
</body>
</html>
```

### Testing

### Fazit

### Sicherheitsaspekte

### Transfer in die Praxis

### Nützliche Links