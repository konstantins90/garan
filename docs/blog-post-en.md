# EU guarantee labels from September 2026: how to get your Magento 2 shop ready

**Meta description:** From 27 September 2026 EU shops need the harmonised legal guarantee notice and the GARAN label. Here is how to implement both in Magento 2 – product page, cart, checkout, 24 languages and QR codes.

**Keywords:** EU guarantee label, Regulation (EU) 2025/1960, legal guarantee online shop, GARAN mark, Magento 2 module, commercial guarantee of durability, ecommerce compliance 2026

---

## The date every shop owner should note

On 27 September 2026 Implementing Regulation (EU) 2025/1960 takes effect. From that day European online shops must show **before the purchase** what rights consumers have: the harmonised notice on the legal guarantee. And where a producer voluntarily offers a free durability guarantee of more than two years, a second standardised mark joins it – the **GARAN label**.

Neither is a banner you can design freely. Layout, colours, symbols and wording are fixed in the annexes of the regulation. That is what makes the shop side tedious: a sentence in the product description is not enough.

## What exactly has to be shown

**Annex I – legal guarantee.** Official artwork with the EU emblem, the core statement “at least two years”, examples of non-conformity, the remedies (repair, replacement, price reduction, refund) and a QR code pointing to the Your Europe portal. The artwork exists in all 24 official languages, in colour and in black and white.

**Annex II – GARAN label.** The GARAN word mark with its tick, the EU shield, producer and model identifier, the guarantee period in years with a calendar symbol, a QR code and a footer listing “producer guarantee in years” in every EU language. There is a full and a nested (compact) format.

## The usual obstacles in Magento

1. **Pixel-accurate artwork.** A PNG scales badly and a hand-built layout drifts away from the template quickly. Inline SVG is the clean answer: sharp at any size, printable, no extra requests.
2. **Three areas, three techniques.** The product page is classic layout XML, the cart renders server side per line item, the checkout runs on Knockout UI components. Covering only the product page leaves the job half done.
3. **Space in the cart.** Two full marks per line item break every row. You need compact, clickable marks – with the full version in a modal box.
4. **Data quality.** The GARAN label may only appear when duration above two years, producer and model identifier are present. Without a fallback chain onto existing attributes such as `manufacturer` or `sku` you end up editing thousands of products by hand.
5. **Languages.** 24 images plus 24 PDFs, switchable per store view – that belongs in the configuration, not in the theme.

## The solution: the Smetana_Garant module

The open source module **GARAN for Magento 2** (`smetana/module-garant`) implements both marks out of the box:

- **Product page:** collapsible panels – the official Annex I artwork including the link to the Your Europe portal and PDF downloads in every language, and the GARAN label, compact in the tab and full size when expanded.
- **Cart and checkout:** slim chips on the line item. One click opens the full mark in a modal box. In the checkout the legal guarantee also appears as a tab below payment method and coupon code.
- **Configuration:** both marks switched independently, per area, with texts, QR targets, artwork language and print variant per store view.
- **Per product:** every product can force or suppress a mark – or inherit the configuration.
- **One rule for a tidy page:** optionally the legal guarantee notice is dropped where a commercial guarantee is already shown.
- **Data handling:** the attribute group “EU-Garantie” with guarantee duration, producer/brand and model identifier, plus mapping onto existing attributes and a configuration fallback for the brand.
- **QR codes:** generated at runtime as SVG with `endroid/qr-code`, target URL configurable.

## Installed in five minutes

```bash
composer require smetana/module-garant
php bin/magento module:enable Smetana_Garant
php bin/magento setup:upgrade
php bin/magento cache:flush
```

Then open **Stores › Configuration › SMETANA Code › Garant (EU)**, pick the artwork language, enable the areas and fill duration, brand and model identifier for the products that carry a producer guarantee. Done.

## Turn the obligation into a sales argument

The regulation forces transparency – and transparency sells. A visible five year guarantee answers the question “will this last?” before the item reaches the cart. Labelling durable products correctly now turns mandatory information into a quality promise that competitors with commodity goods cannot match.

## Next steps

1. Inventory: which products carry a producer guarantee of more than two years?
2. Data: add or map duration, brand and model identifier.
3. Technology: install the module, enable the areas, set the language per store view.
4. Review: check the rendered marks against the annexes with your legal team.

Code and documentation: **https://github.com/konstantins90/garan**

## No time? I can do it for you

If there is no Magento developer on the team – or September arrives faster than your capacity – I install and configure the module in your shop, map the attributes onto your existing product data, fill in the guarantee values and verify the marks on product page, cart and checkout. Just write to **smetana@betriko.de**.

## 🍺 And if it saved you a weekend

The module is free, the beer afterwards is not: **[paypal.me/ksmetana](https://www.paypal.com/paypalme/ksmetana)**

Do the maths: a weekend of reading annexes versus one beer – unbeatable exchange rate. Beer-driven development: bugs get fixed sober, features get built in a good mood. 🍻

---

*This article is a technical guide and does not constitute legal advice.*
