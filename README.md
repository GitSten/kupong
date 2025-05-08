# Kupong

Discount rulesis tuleb panna settingutes
"Let both coupons and discount rules run together"
![Plugin UI](pix/pic2.png)


Mine menüüsse “Kupongi SKU välistus”.



Sisesta  SKU-d mille reeglid on tehtud Discount rulesiga , nt: 4500, 3211.
Kui soovid, et piirang kehtiks ainult sisseloginud kasutajatele, märgi linnuke kui mõlemale siis ei ole vaja märkida.
Hetkel peaks hinnagarantii reegli puhul kupongi kasutamine olema keelatud ainult sisseloginud kasutajatele, sest neile kehtib 40% soodustus. Sisselogimata kasutaja peaks saama kupongi kasutada, kuna neile kuvatakse toote täishind.
Kui toode on SKU-põhiselt piiratud, siis sellele tootele soodustust ei rakendu teistele toodetele, mis on täishinnaga, rakendub soodushind vastavalt kupongi seadistustele.


![Plugin UI](pix/pic1.png)


Plugina kood source kasutas.

# Note hetkel Ecoshi epoes kassas väga selgelt pole aru saada kas toode on soodushinnaga kuna ei ole hind läbi kriipsutatud võiks ostukorvis kuvada siis oleks kliendil arusaadavam miks kupong osadele toodetele soodustust ei rakendu, hetkel visuaalselt veits keeruline aru saaada kas on tootel soodushind või mitte pilt ostukorvist toodetest millel mõlemal soodushind:  

![Plugin UI](pix/ecosh.png)

Võiks kuvada nii:

![Plugin UI](pix/kriips.png)

