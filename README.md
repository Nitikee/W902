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
MySQL 5.7 konfigurieren | <ul><li>- [ ] </li></ul>
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
**Installation und Konfiguration**
https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-16-04

### Testing

### Fazit

### Sicherheitsaspekte

### Transfer in die Praxis

### Nützliche Links