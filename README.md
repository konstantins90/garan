# GARAN – Magento 2 Modul für EU-Garantielabel und Gewährleistungshinweis

**Magento 2 Modul für die harmonisierten EU-Kennzeichnungen nach Durchführungsverordnung (EU) 2025/1960 – gültig ab 27.09.2026.** Das Modul zeigt die amtliche Mitteilung über das gesetzliche Gewährleistungsrecht (Anhang I) und die GARAN-Kennzeichnung der gewerblichen Haltbarkeitsgarantie (Anhang II) auf der Produktseite, im Warenkorb und im Checkout – in 24 EU-Sprachen, mit QR-Codes, PDF-Downloads und vollständiger Backend-Konfiguration.

`Magento 2` · `EU 2025/1960` · `Garantielabel` · `Gewährleistung` · `GARAN` · `Compliance` · `September 2026`

---

## Inhalt

- [Deutsch: Beschreibung](#deutsch)
- [English: description](#english)
- [Kurzbeschreibung in allen EU-Sprachen](#kurzbeschreibung-in-allen-eu-sprachen--short-description-in-all-eu-languages)
- [Installation](#installation)
- [Konfiguration](#konfiguration)
- [Produktattribute](#produktattribute)
- [FAQ](#faq)

---

## Deutsch

### Worum es geht

Ab dem 27. September 2026 müssen Online-Shops in der EU vor dem Kauf zwei Informationen sichtbar machen: die harmonisierte Mitteilung über das **gesetzliche Gewährleistungsrecht** und – wenn der Hersteller eine kostenlose Haltbarkeitsgarantie von mehr als zwei Jahren gewährt – die harmonisierte **GARAN-Kennzeichnung**. Genau das erledigt dieses Modul für Magento 2, ohne Theme-Umbau und ohne externe Dienste.

### Funktionen

- **Zwei Kennzeichnungen, unabhängig schaltbar** – gesetzliche Gewährleistung und GARAN-Label lassen sich einzeln oder gemeinsam aktivieren.
- **Drei Flächen** – Produktseite, Warenkorb und Checkout, jede Fläche separat schaltbar.
- **Produktseite mit Panels** – aufklappbare Tabs mit der amtlichen Grafik nach Anhang I bzw. der vollständigen GARAN-Kennzeichnung.
- **Warenkorb und Checkout kompakt** – schlanke, klickbare Chips an der Position; der Klick öffnet die vollständige Kennzeichnung in einer Modalbox.
- **Checkout-Tab** – unter Zahlungsart und Gutscheincode erscheint die Gewährleistung zusätzlich als aufklappbares Panel.
- **24 EU-Sprachen** – amtliche Grafiken als PNG (farbig und schwarzweiß) und PDF-Downloads je Sprache, Sprache und Druckvariante pro Store View wählbar.
- **GARAN-Label als SVG** – maßstabsgetreu aus HTML, CSS und Inline-SVG erzeugt, druckscharf in jeder Größe, mit mehrsprachiger Fußzeile.
- **QR-Codes zur Laufzeit** – erzeugt mit `endroid/qr-code`, Ziel-URLs (Portal „Ihr Europa“) pro Store View konfigurierbar.
- **Produktattribute mit Fallback-Kette** – Garantiedauer, Hersteller/Marke und Modellkennung am Produkt, sonst gemapptes Attribut (`manufacturer`, `sku`, …), sonst Config-Wert.
- **Pro Produkt steuerbar** – jedes Produkt kann Gewährleistungshinweis und GARAN-Label einzeln erzwingen, abschalten oder der Konfiguration folgen.
- **Regel „eine Kennzeichnung pro Produkt“** – optional entfällt der Gewährleistungshinweis, wenn für das Produkt eine gewerbliche Garantie vorliegt.
- **Plausibilitätsprüfung** – das GARAN-Label erscheint nur, wenn die Dauer über zwei Jahren liegt und Marke sowie Modellkennung gefüllt sind.

### Warum es sich lohnt

Rechtssicherheit ohne Agenturprojekt: Die Kennzeichnungen sitzen an den Stellen, an denen Kundinnen und Kunden entscheiden – und die Garantie wird vom Pflichttext zum Verkaufsargument. Eine lange Haltbarkeitsgarantie sichtbar zu machen, senkt die Kaufhemmung und unterscheidet den Shop von Mitbewerbern, die nur das Minimum erfüllen.

---

## English

### What it does

From 27 September 2026, online shops in the EU must show two pieces of information before purchase: the harmonised notice on the **legal guarantee** and, where the producer offers a free durability guarantee of more than two years, the harmonised **GARAN label**. This Magento 2 module delivers both – no theme rewrite, no external service.

### Features

- **Two marks, switched independently** – legal guarantee notice and GARAN label can be enabled separately or together.
- **Three areas** – product page, cart and checkout, each with its own switch.
- **Product page panels** – collapsible tabs with the official artwork of Annex I and the full GARAN label of Annex II.
- **Compact in cart and checkout** – slim, clickable chips on the line item; a click opens the full mark in a modal box.
- **Checkout tab** – below payment method and coupon code the legal guarantee also appears as a collapsible panel.
- **24 EU languages** – official artwork as PNG (colour and black/white) plus per-language PDF downloads; language and print variant configurable per store view.
- **GARAN label as SVG** – built from HTML, CSS and inline SVG, sharp at any size, with the multilingual footer.
- **QR codes at runtime** – generated with `endroid/qr-code`, target URLs (Your Europe portal) configurable per store view.
- **Product attributes with fallback chain** – guarantee duration, producer/brand and model identifier on the product, else a mapped attribute (`manufacturer`, `sku`, …), else the configuration value.
- **Per product control** – every product can force, suppress or inherit each of the two marks.
- **Rule “one mark per product”** – optionally the legal guarantee notice is dropped where a commercial guarantee exists.
- **Sanity check** – the GARAN label only appears when the duration exceeds two years and brand and model identifier are filled.

### Why it pays off

Compliance without an agency project – and the guarantee turns from mandatory text into a sales argument. A visible long durability guarantee lowers the barrier to buy and sets the shop apart from competitors that only meet the minimum.

---

## Kurzbeschreibung in allen EU-Sprachen / Short description in all EU languages

| Sprache | Kurzbeschreibung |
| --- | --- |
| **BG** Български | Модул за Magento 2 за хармонизираните етикети на ЕС: показва съобщението за законовата гаранция (приложение I) и етикета GARAN за търговската гаранция за дълготрайност (приложение II) на продуктовата страница, в кошницата и при плащане – на 24 езика на ЕС, с QR кодове и PDF файлове. |
| **CS** Čeština | Modul pro Magento 2 pro harmonizované označení EU: zobrazuje sdělení o zákonné záruce (příloha I) a označení GARAN pro obchodní záruku trvanlivosti (příloha II) na stránce produktu, v košíku a v objednávce – ve 24 jazycích EU, s QR kódy a soubory PDF. |
| **DA** Dansk | Magento 2-modul til EU’s harmoniserede mærkning: viser meddelelsen om den lovpligtige garanti (bilag I) og GARAN-mærket for den kommercielle holdbarhedsgaranti (bilag II) på produktsiden, i kurven og i checkout – på 24 EU-sprog, med QR-koder og PDF-filer. |
| **DE** Deutsch | Magento-2-Modul für die harmonisierten EU-Kennzeichnungen: zeigt die Mitteilung über das gesetzliche Gewährleistungsrecht (Anhang I) und die GARAN-Kennzeichnung der gewerblichen Haltbarkeitsgarantie (Anhang II) auf der Produktseite, im Warenkorb und im Checkout – in 24 EU-Sprachen, mit QR-Codes und PDFs. |
| **EL** Ελληνικά | Πρόσθετο Magento 2 για την εναρμονισμένη σήμανση της ΕΕ: εμφανίζει την ανακοίνωση για τη νόμιμη εγγύηση (παράρτημα I) και τη σήμανση GARAN για την εμπορική εγγύηση ανθεκτικότητας (παράρτημα II) στη σελίδα προϊόντος, στο καλάθι και στο ταμείο – σε 24 γλώσσες της ΕΕ, με κωδικούς QR και PDF. |
| **EN** English | Magento 2 module for the harmonised EU marks: shows the legal guarantee notice (Annex I) and the GARAN label for the commercial guarantee of durability (Annex II) on the product page, in the cart and in the checkout – in 24 EU languages, with QR codes and PDFs. |
| **ES** Español | Módulo de Magento 2 para las etiquetas armonizadas de la UE: muestra el aviso sobre la garantía legal (anexo I) y la etiqueta GARAN de la garantía comercial de durabilidad (anexo II) en la página de producto, en el carrito y en el pago – en 24 idiomas de la UE, con códigos QR y PDF. |
| **ET** Eesti | Magento 2 moodul ELi ühtlustatud märgiste jaoks: kuvab seadusjärgse garantii teate (I lisa) ja kaubandusliku vastupidavusgarantii GARAN-märgise (II lisa) tootelehel, ostukorvis ja kassas – 24 ELi keeles, QR-koodide ja PDF-failidega. |
| **FI** Suomi | Magento 2 -moduuli EU:n yhdenmukaistettuihin merkintöihin: näyttää lakisääteisen takuun ilmoituksen (liite I) ja kaupallisen kestävyystakuun GARAN-merkinnän (liite II) tuotesivulla, ostoskorissa ja kassalla – 24 EU-kielellä, QR-koodeineen ja PDF-tiedostoineen. |
| **FR** Français | Module Magento 2 pour les marquages harmonisés de l’UE : affiche l’avis sur la garantie légale (annexe I) et le label GARAN de la garantie commerciale de durabilité (annexe II) sur la fiche produit, dans le panier et au paiement – en 24 langues de l’UE, avec QR codes et PDF. |
| **GA** Gaeilge | Modúl Magento 2 do na marcanna comhchuibhithe AE: taispeánann sé an fógra faoin ráthaíocht dhlíthiúil (Iarscríbhinn I) agus an lipéad GARAN don ráthaíocht tráchtála buanseasmhachta (Iarscríbhinn II) ar leathanach an táirge, sa chiseán agus ag an tseiceáil amach – i 24 teanga AE, le cóid QR agus PDF. |
| **HR** Hrvatski | Modul za Magento 2 za usklađene oznake EU-a: prikazuje obavijest o zakonskoj garanciji (Prilog I.) i oznaku GARAN za komercijalnu garanciju trajnosti (Prilog II.) na stranici proizvoda, u košarici i na naplati – na 24 jezika EU-a, s QR kodovima i PDF-ovima. |
| **HU** Magyar | Magento 2 modul az EU harmonizált jelöléseihez: megjeleníti a jogszabályi jótállásról szóló tájékoztatót (I. melléklet) és a kereskedelmi tartóssági garancia GARAN jelölését (II. melléklet) a termékoldalon, a kosárban és a fizetésnél – 24 EU-nyelven, QR-kódokkal és PDF-ekkel. |
| **IT** Italiano | Modulo Magento 2 per le marcature armonizzate dell’UE: mostra l’avviso sulla garanzia legale (allegato I) e l’etichetta GARAN della garanzia commerciale di durabilità (allegato II) nella pagina prodotto, nel carrello e al checkout – in 24 lingue dell’UE, con codici QR e PDF. |
| **LT** Lietuvių | Magento 2 modulis suderintiems ES ženklams: produkto puslapyje, krepšelyje ir apmokėjimo lange rodo pranešimą apie teisinę garantiją (I priedas) ir komercinės ilgaamžiškumo garantijos ženklą GARAN (II priedas) – 24 ES kalbomis, su QR kodais ir PDF failais. |
| **LV** Latviešu | Magento 2 modulis ES saskaņotajiem marķējumiem: produkta lapā, iepirkumu grozā un norēķinu solī rāda paziņojumu par tiesisko garantiju (I pielikums) un komerciālās izturības garantijas marķējumu GARAN (II pielikums) – 24 ES valodās, ar QR kodiem un PDF. |
| **MT** Malti | Modulu Magento 2 għall-immarkar armonizzat tal-UE: juri l-avviż dwar il-garanzija legali (Anness I) u l-tikketta GARAN għall-garanzija kummerċjali ta’ durabbiltà (Anness II) fil-paġna tal-prodott, fil-basket u fil-ħlas – fi 24 lingwa tal-UE, bil-kodiċi QR u PDF. |
| **NL** Nederlands | Magento 2-module voor de geharmoniseerde EU-markeringen: toont de mededeling over de wettelijke garantie (bijlage I) en het GARAN-label voor de commerciële duurzaamheidsgarantie (bijlage II) op de productpagina, in het winkelwagentje en in de checkout – in 24 EU-talen, met QR-codes en pdf’s. |
| **PL** Polski | Moduł Magento 2 do zharmonizowanych oznaczeń UE: pokazuje informację o gwarancji prawnej (załącznik I) oraz oznaczenie GARAN handlowej gwarancji trwałości (załącznik II) na stronie produktu, w koszyku i przy płatności – w 24 językach UE, z kodami QR i plikami PDF. |
| **PT** Português | Módulo Magento 2 para as marcações harmonizadas da UE: mostra o aviso sobre a garantia legal (anexo I) e o rótulo GARAN da garantia comercial de durabilidade (anexo II) na página do produto, no carrinho e na finalização da compra – em 24 línguas da UE, com códigos QR e PDF. |
| **RO** Română | Modul Magento 2 pentru marcajele armonizate ale UE: afișează notificarea privind garanția legală (anexa I) și eticheta GARAN pentru garanția comercială de durabilitate (anexa II) pe pagina produsului, în coș și la plată – în 24 de limbi ale UE, cu coduri QR și PDF-uri. |
| **SK** Slovenčina | Modul pre Magento 2 na harmonizované označenia EÚ: zobrazuje oznámenie o zákonnej záruke (príloha I) a označenie GARAN pre obchodnú záruku trvanlivosti (príloha II) na stránke produktu, v košíku a v objednávke – v 24 jazykoch EÚ, s QR kódmi a PDF. |
| **SL** Slovenščina | Modul za Magento 2 za usklajene oznake EU: na strani izdelka, v košarici in pri zaključku nakupa prikaže obvestilo o zakonski garanciji (Priloga I) in oznako GARAN za tržno garancijo trajnosti (Priloga II) – v 24 jezikih EU, s kodami QR in datotekami PDF. |
| **SV** Svenska | Magento 2-modul för EU:s harmoniserade märkning: visar meddelandet om den rättsliga garantin (bilaga I) och GARAN-märket för den kommersiella hållbarhetsgarantin (bilaga II) på produktsidan, i varukorgen och i kassan – på 24 EU-språk, med QR-koder och PDF-filer. |

---

## Installation

### Composer

```bash
composer require smetana/module-garant
php bin/magento module:enable Smetana_Garant
php bin/magento setup:upgrade
php bin/magento cache:flush
```

### app/code

```bash
git clone git@github.com:konstantins90/garan.git app/code/Smetana/Garant
composer require endroid/qr-code
php bin/magento module:enable Smetana_Garant
php bin/magento setup:upgrade
php bin/magento cache:flush
```

Getestet mit Magento Open Source 2.4.7 und PHP 8.3.

## Konfiguration

**Stores › Configuration › SMETANA Code › Garant (EU)**

| Gruppe | Einstellung |
| --- | --- |
| Allgemein | Modul aktivieren; Gewährleistung ausblenden, wenn Garantie vorhanden |
| Gesetzliche Gewährleistung | Aktivieren, Produktseite / Warenkorb / Checkout, Variante und Startzustand des Panels, Sprache und Druckvariante der Grafik, CMS-Seite, QR-URL, alle Texte |
| GARAN Haltbarkeitsgarantie | Aktivieren, Produktseite / Warenkorb / Checkout, Variante und Startzustand des Panels, QR-URL, Mindestdauer, Fallback-Marke, Attribut-Mapping |

Standard oder Kompakt lässt sich nur für die Produktseite wählen. Warenkorb und Checkout zeigen immer die kompakte Form an der Position; der Klick öffnet die vollständige Kennzeichnung in einer Modalbox.

## Produktattribute

Das Setup legt die Attributgruppe **EU-Garantie** an:

| Attribut | Bedeutung |
| --- | --- |
| `garant_duration` | Garantiedauer in Jahren (volle Jahre, bei Bedarf x,5, Minimum 2,5) |
| `garant_brand` | Hersteller / Marke |
| `garant_model_id` | Modellkennung (z. B. GTIN-13) |
| `garant_notice_enabled` | Gewährleistungshinweis: Ja / Nein / aus der Konfiguration |
| `garant_label_enabled` | GARAN-Label: Ja / Nein / aus der Konfiguration |

Leere Datenfelder fallen auf das gemappte Attribut zurück (`manufacturer`, `sku`, …) und zuletzt auf den Config-Fallback für die Marke. Das GARAN-Label erscheint nur, wenn die Dauer über zwei Jahren liegt und Marke sowie Modellkennung vorhanden sind.

## Mitteilungsgrafik und PDFs

Die amtlichen Vorlagen liegen als `notice-<code>.png` (plus `-bw` für Schwarzweiß) in `view/frontend/web/img` und als `notice-<code>.pdf` in `view/frontend/web/pdf`. Sprache und Druckvariante steuern die Grafik auf der Produktseite; im Warenkorb und Checkout verlinkt das Chip auf die PDF-Fassung und auf das Portal „Ihr Europa“.

## QR-Codes

Die Codes entstehen zur Laufzeit als SVG mit `endroid/qr-code`. Ziel-URLs je Store View:

- Gewährleistung: `smetana_garant/notice/qr_url`
- GARAN: `smetana_garant/label/qr_url`

## Schrift

Inter (Regular, SemiBold, ExtraBold) nach `view/frontend/web/fonts/inter/` legen. Bis dahin greift der Fallback-Stack.

## FAQ

**Ab wann gilt die Pflicht?** Die Durchführungsverordnung (EU) 2025/1960 gilt ab dem 27.09.2026.

**Brauche ich das GARAN-Label für jedes Produkt?** Nein. Es ist nur vorgesehen, wenn der Hersteller eine kostenlose Haltbarkeitsgarantie von mehr als zwei Jahren für die gesamte Ware gewährt. Ohne vollständige Daten bleibt das Label aus.

**Muss ich mein Theme anpassen?** Nein. Das Modul hängt an den Standard-Slots von Magento (`product.info.main`, `additional.product.info`, Checkout-UI-Komponenten).

**Funktioniert es mit mehreren Store Views?** Ja, alle Einstellungen inklusive Sprache der Grafik sind pro Store View überschreibbar.

**Wo finde ich Marketing-Material?** Blogbeitrag und Social-Media-Texte liegen unter [`docs/`](docs).

## Lizenz

MIT

---

Hinweis: Dieses Modul ist eine technische Umsetzungshilfe und ersetzt keine Rechtsberatung. Prüfe die Kennzeichnungen vor dem Livegang mit deiner Rechtsabteilung.
