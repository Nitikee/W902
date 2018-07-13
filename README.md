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

### Planung



### Realisierung

### Testing

### Fazit

### Sicherheitsaspekte

### Transfer in die Praxis

### Nützliche Links