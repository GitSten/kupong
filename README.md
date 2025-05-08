

Praegune lahendus lükkab kogu ostukorvi ulatuses kupongi tagasi kui ostukorvis on vähemalt üks  toode mille reeglid on tehtud discount rulesiga
Discount Rules arvutab ja kuvab soodushinna, aga ei salvesta seda standardsete väljade ( sales_price) kaudu, mida kupongi plugin ootab.
Kupongi plugin aga eeldab, et kõik hinnamuutused tuleb tõendada sales_price väljal. Kui see on puudu, tõlgendab ta, et kupongi reegleid ei saa kombineerida juba kasutatud allahindlusega, ja blokeerib kupongi kogu ostukorvi ulatuses.

# lahendus
# Kupongi sku põhine välistus plugin

Discount rulesis tuleb panna settingutes
"Let both coupons and discount rules run together"
![Plugin UI](pix/pic2.png)


Mine menüüsse “Kupongi SKU välistus”.



Kui soovid, et piirang kehtiks ainult sisseloginud kasutajatele, märgi linnuke kui mõlemale siis ei ole vaja märkida.
Hinnagarantii reegli puhul peaks kupongi kasutamine olema keelatud ainult sisseloginud kasutajatele, kuna neile on juba antud 40% soodustus ning lisasoodustus ei tohiks rakenduda. Praegune lahendus keelab kupongi rakendamise kogu ostukorvile, kui ostukorvis on vähemalt üks reeglile vastav toode, mistõttu ei saa kupongi üldse kasutada.
Sisselogimata kasutajad saavad kupongi kasutada, kuna neile kuvatakse toote täishind.
Kui toode on SKU-põhiselt piiratud, ei rakendu soodustus sellele tootele; teistele täishinnaga toodetele rakendub soodustushind kupongi seadistuste kohaselt.


![Plugin UI](pix/pic1.png)


# Plugina kood "source" kasutas.

# Note hetkel Ecoshi epoes kassas väga selgelt pole aru saada kas toode on soodushinnaga kuna ei ole hind läbi kriipsutatud võiks ostukorvis kuvada siis oleks kliendil arusaadavam miks kupong osadele toodetele soodustust ei rakendu, hetkel visuaalselt veits keeruline aru saaada kas on tootel soodushind või mitte pilt ostukorvist toodetest millel mõlemal soodushind:  

![Plugin UI](pix/ecosh.png)

Võiks kuvada nii:

![Plugin UI](pix/kriips.png)

