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
#### Grobplanung:

Schritt|Erledigt
---|---
Smartphone APP entwickeln | <ul><li>- [ ] </li></ul>
Webservice konfiguriert | <ul><li>- [ ] </li></ul>
Datenbank konfiguriert | <ul><li>- [ ] </li></ul>
Schnittstelle zwischen APP und Server | <ul><li>- [ ] </li></ul>
Schnittstelle zwischen Server und Internet / API | <ul><li>- [ ] </li></ul>
Webseite erstellt | <ul><li>- [ ] </li></ul>
Schnittstelle zwischen Webservice und Datenbank | <ul><li>- [ ] </li></ul>

#### Feinplanung:
**Smartphone APP entwickeln**
Schritt|Erledigt
---|---
Android Studio installiert | <ul><li>- [ ] </li></ul>
Samsung Driver für das Testing auf einem Gerät | <ul><li>- [ ] </li></ul>
Layout für das APP erstellt | <ul><li>- [ ] </li></ul>
Barcode kann gescannt werden | <ul><li>- [ ] </li></ul>
Smartphone schickt ISBN per POST an einem Server | <ul><li>- [ ] </li></ul>

##### Benötigte Komponente:
* Android Studio
* Samsung Driver für ADB
* Server (In diesem Projekt Ubuntu Server 16.07)

**Webservice konfiguriert**
Schritt|Erledigt
---|---
NGINX installiern | <ul><li>- [ ] </li></ul>
NGINX konfigurieren | <ul><li>- [ ] </li></ul>
PHP7 installieren | <ul><li>- [ ] </li></ul>
PHP7 konfigurieren | <ul><li>- [ ] </li></ul>
Let's Encrypt installieren | <ul><li>- [ ] </li></ul>
Let's Encrypt konfigurieren | <ul><li>- [ ] </li></ul>

##### Benötigte Komponente:
* NGINX
* PHP7
* Let's Encrypt
* Server (In diesem Projekt Ubuntu Server 16.07)
* DNS (nitinankeel.ch)



### Realisierung

### Testing

### Fazit

### Sicherheitsaspekte

### Transfer in die Praxis

### Nützliche Links