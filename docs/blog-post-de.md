# EU-Garantielabel ab September 2026: So rüstest du deinen Magento-2-Shop nach

**Meta-Beschreibung:** Ab 27.09.2026 brauchen EU-Shops die harmonisierte Gewährleistungsmitteilung und das GARAN-Garantielabel. Wie du beides in Magento 2 umsetzt – mit Produktseite, Warenkorb, Checkout, 24 Sprachen und QR-Codes.

**Keywords:** EU Garantielabel, Verordnung (EU) 2025/1960, gesetzliche Gewährleistung Onlineshop, GARAN Kennzeichnung, Magento 2 Modul, Haltbarkeitsgarantie, E-Commerce Compliance 2026

---

## Das Datum, das sich jeder Shopbetreiber notieren sollte

Am 27. September 2026 wird die Durchführungsverordnung (EU) 2025/1960 wirksam. Ab dann muss in europäischen Onlineshops **vor dem Kauf** sichtbar sein, welche Rechte Verbraucherinnen und Verbraucher haben: die harmonisierte Mitteilung über das gesetzliche Gewährleistungsrecht. Und wenn ein Hersteller freiwillig eine kostenlose Haltbarkeitsgarantie von mehr als zwei Jahren gewährt, kommt eine zweite, genormte Kennzeichnung hinzu – das **GARAN-Label**.

Beides ist kein frei gestaltbares Banner. Layout, Farben, Symbole und Texte sind in den Anhängen der Verordnung festgelegt. Genau das macht die Umsetzung im Shop so mühsam: Es reicht nicht, einen Satz in die Produktbeschreibung zu schreiben.

## Was genau gezeigt werden muss

**Anhang I – gesetzliche Gewährleistung.** Eine amtliche Grafik mit EU-Emblem, der Kernaussage „mindestens zwei Jahre“, Beispielen für Vertragswidrigkeit, den Abhilfen (Nachbesserung, Ersatz, Preisminderung, Erstattung) und einem QR-Code zum Portal „Ihr Europa“. Die Grafik existiert in allen 24 Amtssprachen, farbig und schwarzweiß.

**Anhang II – GARAN-Kennzeichnung.** Das Wortzeichen GARAN mit Haken, das EU-Schild, Hersteller und Modellkennung, die Garantiedauer in Jahren mit Kalendersymbol, ein QR-Code und eine Fußzeile, die den Begriff „Herstellergarantie in Jahren“ in allen EU-Sprachen auflistet. Es gibt eine vollständige und eine kompakte (geschachtelte) Form.

## Die typischen Stolpersteine in Magento

1. **Pixelgenaue Grafik.** Ein PNG skaliert schlecht, ein selbst gebautes Layout weicht schnell vom Muster ab. Sauber ist Inline-SVG: in jeder Größe scharf, druckbar, ohne zusätzliche Requests.
2. **Drei Flächen, unterschiedliche Technik.** Produktseite ist klassisches Layout-XML, der Warenkorb rendert serverseitig pro Position, der Checkout läuft über Knockout-UI-Komponenten. Wer nur die Produktseite bedient, ist nicht fertig.
3. **Platz im Warenkorb.** Zwei vollständige Kennzeichnungen pro Position sprengen jede Zeile. Es braucht kompakte, klickbare Marken – und die vollständige Fassung in einer Modalbox.
4. **Datenqualität.** Das GARAN-Label darf nur erscheinen, wenn Dauer über zwei Jahren, Hersteller und Modellkennung vorliegen. Ohne Fallback-Kette auf bestehende Attribute wie `manufacturer` oder `sku` pflegt man tausende Produkte von Hand.
5. **Sprachen.** 24 Grafiken plus 24 PDFs, je Store View umschaltbar – das gehört in die Konfiguration, nicht ins Theme.

## Die Lösung: das Modul Smetana_Garant

Das Open-Source-Modul **GARAN für Magento 2** (`smetana/module-garant`) setzt beide Kennzeichnungen fertig um:

- **Produktseite:** aufklappbare Panels – einmal die amtliche Grafik nach Anhang I inklusive Link zum Portal „Ihr Europa“ und PDF-Downloads in allen Sprachen, einmal die GARAN-Kennzeichnung, kompakt im Tab und in voller Größe beim Aufklappen.
- **Warenkorb und Checkout:** schlanke Chips an der Position. Ein Klick öffnet die vollständige Kennzeichnung in einer Modalbox. Im Checkout steht die Gewährleistung zusätzlich als Tab unter Zahlungsart und Gutscheincode.
- **Konfiguration:** beide Kennzeichnungen unabhängig aktivierbar, je Fläche schaltbar, Texte, QR-Ziele, Grafiksprache und Druckvariante pro Store View.
- **Pro Produkt:** jedes Produkt kann eine Kennzeichnung erzwingen oder abschalten – oder der Konfiguration folgen.
- **Eine Regel für Ordnung:** Auf Wunsch entfällt der Gewährleistungshinweis dort, wo bereits eine gewerbliche Garantie ausgewiesen ist.
- **Datenpflege:** die Attributgruppe „EU-Garantie“ mit Garantiedauer, Hersteller/Marke und Modellkennung, dazu Mapping auf bestehende Attribute und ein Config-Fallback für die Marke.
- **QR-Codes:** zur Laufzeit als SVG mit `endroid/qr-code` erzeugt, Ziel-URL konfigurierbar.

## In fünf Minuten installiert

```bash
composer require smetana/module-garant
php bin/magento module:enable Smetana_Garant
php bin/magento setup:upgrade
php bin/magento cache:flush
```

Danach im Backend unter **Stores › Configuration › SMETANA Code › Garant (EU)** die Sprache der Grafik wählen, Flächen aktivieren und bei den Produkten mit Herstellergarantie Dauer, Marke und Modellkennung pflegen. Fertig.

## Aus der Pflicht ein Verkaufsargument machen

Die Verordnung zwingt zur Transparenz – aber Transparenz verkauft. Eine sichtbare Garantie über fünf Jahre beantwortet die Frage „hält das lange genug?“ noch vor dem Warenkorb. Wer seine langlebigen Produkte jetzt korrekt kennzeichnet, nimmt die Pflichtinformation und macht daraus ein Qualitätsversprechen, das die Konkurrenz mit Standardware nicht liefern kann.

## Nächste Schritte

1. Inventur: Für welche Produkte gibt es eine Herstellergarantie über zwei Jahren?
2. Daten: Dauer, Marke und Modellkennung in den Produktdaten ergänzen oder mappen.
3. Technik: Modul installieren, Flächen aktivieren, Sprache je Store View setzen.
4. Prüfung: Kennzeichnungen mit der Rechtsabteilung gegen die Anhänge abgleichen.

Code und Dokumentation: **https://github.com/konstantins90/garan**

---

*Dieser Beitrag ist eine technische Anleitung und ersetzt keine Rechtsberatung.*
