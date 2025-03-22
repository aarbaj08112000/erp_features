SELECT DISTINCT shipping_address FROM `new_po` WHERE shipping_address like '%<br>%';

SELECT DISTINCT billing_address FROM `new_po` WHERE billing_address like '%<br>%';

UPDATE new_po
SET shipping_address = SUBSTRING_INDEX(shipping_address, '<br>', 1)
WHERE shipping_address LIKE '%<br>%';

UPDATE new_po
SET billing_address = SUBSTRING_INDEX(billing_address, '<br>', 1)
WHERE billing_address LIKE '%<br>%';

--------------------- AROM ---------------------------------
-- 50, First Floor, Spince City Mall, Spine Road, Moshi Pradhikaran, PCMC, Pune-412105<br>GSTIN: 27AIMPD5820D1ZJ
-- Atharva Park, Plot No 115/B2, Sector 16, Chikhali Pradhikaran, PCMC, Pune-411062<br>GSTIN: 27AIMPD5820D1ZJ
-- Default queries are run 

-- ---------------------- SIDHANT --------------------------- 

SELECT DISTINCT shipping_address FROM `new_po` WHERE shipping_address like '%<br>%';

UPDATE new_po
SET shipping_address = 'SHOP NO.02, JAYRATNA COMPLEX,INDRAYANI COMPLEX, MIDC BHOSARI,BHOSARI , PUNE- 411039'
WHERE shipping_address = 'SHOP NO.02, JAYRATNA COMPLEX,INDRAYANI COMPLEX, MIDC BHOSARI,BHOSARI , PUNE- 411039<br>GSTIN: 27AANCP6955B1Z4<br>STATE: MAHARASHTRA'
;


UPDATE new_po
SET shipping_address = 'SHOP NO.02, JAYRATNA COMPLEX,INDRAYANI COMPLEX, MIDC BHOSARI,BHOSARI , PUNE- 411039'
WHERE shipping_address = 'SHOP NO.02, JAYRATNA COMPLEX,INDRAYANI COMPLEX, MIDC BHOSARI,BHOSARI , PUNE- 411039<br>GSTIN: 27AANCP6955B1Z4<br>STATE: MAHARASHTRA'
;

UPDATE new_po
SET shipping_address = 'GROUND FLOOR, DAVANEMALA, GAT NO.118, AMBETHAN,SHAKSHI SUPER MARKET,DAVANEMALA, CHAKAN,PUNE- 410501'
WHERE shipping_address = 'GROUND FLOOR, DAVANEMALA,, GAT NO.118, AMBETHAN, 
 SHAKSHI SUPER MARKET,, DAVANEMALA, CHAKAN,, PUNE- 410501<br>GSTIN: 27ASBPG5610M1ZS<br>STATE: Maharashtra'
;


UPDATE new_po
SET shipping_address = 'SAMARTH CARINA COMMERCIAL COMPLEX, SHOP NO.-7&8, THERGAON ROAD,NEAR ADITYA BIRLA HOSPITAL,CHINCHWAD PUNE 411033'
WHERE shipping_address = 'SAMARTH CARINA COMMERCIAL COMPLEX,, SHOP NO.-7 & 8, THERGAON ROAD,,
  NEAR ADITYA BIRLA HOSPITAL, CHINCHWAD,, PUNE 411033<br>GSTIN: 27AQDPP2891F1ZN<br>STATE: Maharashtra'
;

 
 

UPDATE new_po
SET shipping_address = '24th Floor,Flat No.29 The Ruby Building,Senapati Bapat Marg Dadar West Mumbai, 400028'
WHERE shipping_address = '24th Floor,Flat No.29 The Ruby Building,Senapati Bapat Marg Dadar West Mumbai, 400028<br>GSTIN: 27AADCI6794B1ZG<br>STATE: MAHARASHTRA'
;

  

UPDATE new_po
SET shipping_address = 'HEAD OFFICE: A-9,NAND BHUVAN IND.ESTATE,MAHAKALI,CAVES ROAD,ANDHERI(E),MUMBAI,WORK:PLOT NO.A-31, MIDC,CHAKAN,TAL-KHED,DIST-PUNE,410501'
WHERE shipping_address = 'HEAD OFFICE: A-9, NAND BHUVAN IND. ESTATE,, MAHAKALI, CAVES ROAD,
  ANDHERI(E), MUMBAI, WORK : PLOT NO.A-31, MIDC, CHAKAN,, TAL-KHED, DIST-PUNE, 410501<br>GSTIN: 27AADCR3525R1ZV<br>STATE: Maharashtra'
;
  
  
UPDATE new_po
SET shipping_address = 'JUNNAR 10/1 CHHATRAPATI,, SHIVAJI NAGAR, PUNE -410502'
WHERE shipping_address = 'JUNNAR 10/1 CHHATRAPATI,, SHIVAJI NAGAR, PUNE -410502<br>GSTIN: 27CHAPD9513L1Z9<br>STATE: Maharashtra'
;

UPDATE new_po
SET shipping_address = 'B-6,MIDC, CHAKAN INDUSTRIAL AREA, MAHALUNGE, 410501'
WHERE shipping_address = 'B-6,MIDC, CHAKAN INDUSTRIAL AREA, MAHALUNGE, 410501<br>GSTIN: 27AAACM1152C1Z3<br>STATE: Maharashtra'
;
  
  

UPDATE new_po
SET shipping_address = 'SUNDARAM POLYMERS DIVISION,GROUND FLOOR,G.NO.47/1A, OPP.SHELL PETROL PUMP,PUNE-NASHIK ROAD,CHIMBALI PHATA,CHIMBALI'
WHERE shipping_address = 'SUNDARAM POLYMERS DIVISION,, GROUND FLOOR, G.NO. 47/1A,,
  OPP. SHELL PETROL PUMP,, PUNE-NASHIK ROAD, CHIMBALI PHATA, CHIMBALI<br>GSTIN: 27AAACB2533Q1ZI<br>STATE: Maharashtra'
;

  
UPDATE new_po
SET shipping_address = '9/2 104,BHARAT HOUSE,MUMBAI SAMACHR MARG,FORT MUM, BAI 400 001,KARIVALI CT 421302 BHIWANDI'
WHERE shipping_address = '9/2 104,BHARAT HOUSE,MUMBAI SAMACHR MARG,FORT MUM, BAI 400 001,
 KARIVALI CT 421302 BHIWANDI<br>GSTIN: 27AAAPM9275F1ZI<br>STATE: Maharashtra'
;

  
  
UPDATE new_po
SET shipping_address = 'SHOP NO. BF-7, KAVERI APTS.896,, NANA PETH, PUNE-411002,OFF PHONE NO.020 26347846'
WHERE shipping_address = 'SHOP NO. BF-7, KAVERI APTS.896,, NANA PETH, PUNE-411002, 
 OFF PHONE NO. 020 26347846,<br>GSTIN: 27AAJPL7656C1ZJ<br>STATE: Maharashtra'
;

 
UPDATE new_po
SET shipping_address = 'GAT NO.679/2/1, CHAKAN,, ALANDI ROAD, A/P KURULI, TEL-KHED,, DIST-PUNE. 410501'
WHERE shipping_address = 'GAT NO.679/2/1, CHAKAN,, ALANDI ROAD, A/P KURULI, TEL-KHED,, DIST-PUNE. 410501,<br>GSTIN: 27AAECT4411H1ZI<br>STATE: Maharashtra'
;


UPDATE new_po
SET shipping_address = 'GAT. NO. 427/5, CHAKAN-TALGAON ROAD MAHALUNGE - 410 501'
WHERE shipping_address = 'GAT. NO. 427/5, CHAKAN-TALGAON ROAD MAHALUNGE - 410 501<br>GSTIN: 27AAACM8583F1Z8<br>STATE: MAHARASHTRA'
;
 
 
UPDATE new_po
SET billing_address = 'PLOT NO.57, WMDC,KHARABWADI,CHAKAN TAL-KHED,DIST-PUNE-410501'
WHERE billing_address = 'PLOT NO.57, WMDC,KHARABWADI,CHAKAN TAL-KHED,DIST-PUNE-410501<br>GSTIN: 27ABVFS1144D1Z2';

-- ---------------------- SPERP -----------------------------
GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501Contact No:-9860526888 Email: super_polymers2011@yahoo.com<br>GSTIN: 27ABXFS5493D1ZG
GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501 Contact No:-9860526888 Email: super_polymers2011@yahoo.com<br>GSTIN: 27ABXFS5493D1ZG
GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501 Contact No:-9860526888<br>GSTIN: 27ABXFS5493D1ZG
GAT NO 768. BEHIND CHCIKHALI KATA KUDALWADI, CHIKHALI PUNE                       <br>GSTIN: 27AAHCT4641A1ZL<br>STATE: Maharashtra

UPDATE new_po
SET shipping_address = 'GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501Contact No:-9860526888 Email: super_polymers2011@yahoo.com'
WHERE shipping_address = 'GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501Contact No:-9860526888 Email: super_polymers2011@yahoo.com<br>GSTIN: 27ABXFS5493D1ZG';

UPDATE new_po
SET shipping_address = 'GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501 Contact No:-9860526888 Email: super_polymers2011@yahoo.com'
WHERE shipping_address = 'GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501 Contact No:-9860526888 Email: super_polymers2011@yahoo.com<br>GSTIN: 27ABXFS5493D1ZG';

UPDATE new_po
SET shipping_address = 'GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501 Contact No:-9860526888'
WHERE shipping_address = 'GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501 Contact No:-9860526888<br>GSTIN: 27ABXFS5493D1ZG';

UPDATE new_po
SET shipping_address = 'GAT NO 768. BEHIND CHCIKHALI KATA KUDALWADI, CHIKHALI PUNE'
WHERE shipping_address = 'GAT NO 768. BEHIND CHCIKHALI KATA KUDALWADI, CHIKHALI PUNE                       <br>GSTIN: 27AAHCT4641A1ZL<br>STATE: Maharashtra';


GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501Contact No:-9860526888 Email: super_polymers2011@yahoo.com<br>GSTIN: 27ABXFS5493D1ZG
GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501 Contact No:-9860526888 Email: super_polymers2011@yahoo.com<br>GSTIN: 27ABXFS5493D1ZG
GAT.NO.2036 MILKAT NO.3680, BIRDAWADI ROAD,CHAKAN PUNE 410501 Contact No:-9860526888<br>GSTIN: 27ABXFS5493D1ZG

UPDATE new_po
SET billing_address = SUBSTRING_INDEX(billing_address, '<br>', 1)
WHERE billing_address LIKE '%<br>%';


-- -------------------- JJTECH -------------------------------
S.No. 131/1/1, Near PCMC water tank, Whalekarwadi road, chinchwad goan, pune-411019 Email: jjtechnoplast@yahoo.com PH: 9890602108<br>GSTIN: 27BIZPB5715M1ZM
J. J. Technoplast Gat no.146/2, Hissa no. 33, near RMC plant Ambi- Golewadi Road, Ambi pune-410507<br>GSTIN: 27BIZPB5715M1ZM
Plot.No.4, Block no. 1462/1, Ozar Road, Tal- Kaparada, Dist- Valsad, Gujarat<br>GSTIN: 24AHSPB2062L1ZB<br>STATE: Gujarat

UPDATE new_po
SET shipping_address = 'S.No. 131/1/1, Near PCMC water tank, Whalekarwadi road, chinchwad goan, pune-411019 Email: jjtechnoplast@yahoo.com PH: 9890602108'
WHERE shipping_address = 'S.No. 131/1/1, Near PCMC water tank, Whalekarwadi road, chinchwad goan, pune-411019 Email: jjtechnoplast@yahoo.com PH: 9890602108<br>GSTIN: 27BIZPB5715M1ZM';


Plot.No.4, Block no. 1462/1, Ozar Road, Tal- Kaparada, Dist- Valsad, Gujarat<br>GSTIN: 24AHSPB2062L1ZB<br>STATE: Gujarat
J. J. Technoplast Gat no.146/2, Hissa no. 33, near RMC plant Ambi- Golewadi Road, Ambi pune-410507<br>GSTIN: 27BIZPB5715M1ZM

UPDATE new_po
SET shipping_address = 'Plot.No.4, Block no. 1462/1, Ozar Road, Tal- Kaparada, Dist- Valsad, Gujarat'
WHERE shipping_address = 'Plot.No.4, Block no. 1462/1, Ozar Road, Tal- Kaparada, Dist- Valsad, Gujarat<br>GSTIN: 24AHSPB2062L1ZB<br>STATE: Gujarat';

UPDATE new_po
SET shipping_address = 'J. J. Technoplast Gat no.146/2, Hissa no. 33, near RMC plant Ambi- Golewadi Road, Ambi pune-410507'
WHERE shipping_address = 'J. J. Technoplast Gat no.146/2, Hissa no. 33, near RMC plant Ambi- Golewadi Road, Ambi pune-410507<br>GSTIN: 27BIZPB5715M1ZM';


UPDATE new_po
SET shipping_address = 'J. J. Technoplast Gat no.146/2, Hissa no. 33, near RMC plant Ambi- Golewadi Road, Ambi pune-410507<br>GSTIN: 27BIZPB5715M1ZM'
WHERE shipping_address = 'J. J. Technoplast Gat no.146/2, Hissa no. 33, near RMC plant Ambi- Golewadi Road, Ambi pune-410507';


UPDATE new_po
SET shipping_address = 'Plot.No.4, Block no. 1462/1, Ozar Road, Tal- Kaparada, Dist- Valsad, Gujarat<br>GSTIN: 24AHSPB2062L1ZB<br>STATE: Gujarat'
WHERE shipping_address = 'Plot.No.4, Block no. 1462/1, Ozar Road, Tal- Kaparada, Dist- Valsad, Gujarat';

Survey No. 64, Opp. Ador Welding Ltd., Chinchwad, Pune - 411019.<br>GSTIN: 27BIZPB5715M1ZM
J. J. Technoplast Gat No.146/2, Hissa No. 33, Ambi , Talegaon MIDC Pune-410507<br>GSTIN: 27BIZPB5715M1ZM
Survey No.64 ,Near Dattmandap, Kalbhor Estate, Pimpri- Chinchwad ,Pune  Maharashtra 411035<br>GSTIN: 27BIZPB5715M1ZM

UPDATE new_po
SET billing_address = 'Survey No. 64, Opp. Ador Welding Ltd., Chinchwad, Pune - 411019.<br>GSTIN: 27BIZPB5715M1ZM'
WHERE billing_address = 'Survey No. 64, Opp. Ador Welding Ltd., Chinchwad, Pune - 411019.';

UPDATE new_po
SET billing_address = 'J. J. Technoplast Gat No.146/2, Hissa No. 33, Ambi , Talegaon MIDC Pune-410507<br>GSTIN: 27BIZPB5715M1ZM'
WHERE billing_address = 'J. J. Technoplast Gat No.146/2, Hissa No. 33, Ambi , Talegaon MIDC Pune-410507';

UPDATE new_po
SET billing_address = 'Survey No.64 ,Near Dattmandap, Kalbhor Estate, Pimpri- Chinchwad ,Pune  Maharashtra 411035<br>GSTIN: 27BIZPB5715M1ZM'
WHERE billing_address = 'Survey No.64 ,Near Dattmandap, Kalbhor Estate, Pimpri- Chinchwad ,Pune  Maharashtra 411035';


Survey No. 64, Opp. Ador Welding Ltd., Chinchwad, Pune - 411019.<br>GSTIN: 27BIZPB5715M1ZM
J. J. Technoplast Gat No.146/2, Hissa No. 33, Ambi , Talegaon MIDC Pune-410507<br>GSTIN: 27BIZPB5715M1ZM
Survey No.64 ,Near Dattmandap, Kalbhor Estate, Pimpri- Chinchwad ,Pune  Maharashtra 411035<br>GSTIN: 27BIZPB5715M1ZM

UPDATE new_po
SET billing_address = 'Survey No. 64, Opp. Ador Welding Ltd., Chinchwad, Pune - 411019.'
WHERE billing_address = 'Survey No. 64, Opp. Ador Welding Ltd., Chinchwad, Pune - 411019.<br>GSTIN: 27BIZPB5715M1ZM';

UPDATE new_po
SET billing_address = 'J. J. Technoplast Gat No.146/2, Hissa No. 33, Ambi , Talegaon MIDC Pune-410507'
WHERE billing_address = 'J. J. Technoplast Gat No.146/2, Hissa No. 33, Ambi , Talegaon MIDC Pune-410507<br>GSTIN: 27BIZPB5715M1ZM';

UPDATE new_po
SET billing_address = 'Survey No.64 ,Near Dattmandap, Kalbhor Estate, Pimpri- Chinchwad ,Pune  Maharashtra 411035'
WHERE billing_address = 'Survey No.64 ,Near Dattmandap, Kalbhor Estate, Pimpri- Chinchwad ,Pune  Maharashtra 411035<br>GSTIN: 27BIZPB5715M1ZM';


-------------- BSP UNIT 1 ----------------

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br> Contact: 9545512405 Email: pravinmali@bspmetatech.com <br>GST: 27AAFFL7327N1ZT

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405 Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405 Email: pravinmali@bspmetatech.com

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT

COMMIT;

UPDATE new_po
SET shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br> Contact: 9545512405'
WHERE shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br> Contact: 9545512405 Email: pravinmali@bspmetatech.com <br>GST: 27AAFFL7327N1ZT';


UPDATE new_po
SET shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405'
WHERE shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405 Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT';


UPDATE new_po
SET shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405'
WHERE shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405 Email: pravinmali@bspmetatech.com';

UPDATE new_po
SET shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405'
WHERE shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT';

COMMIT;

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br> Contact: 9545512405 Email: pravinmali@bspmetatech.com <br>GST: 27AAFFL7327N1ZT

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405 Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405 Email: pravinmali@bspmetatech.com

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT


UPDATE new_po
SET billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br> Contact: 9545512405'
WHERE billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br> Contact: 9545512405 Email: pravinmali@bspmetatech.com <br>GST: 27AAFFL7327N1ZT';

UPDATE new_po
SET billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405'
WHERE billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405 Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT';

UPDATE new_po
SET billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405'
WHERE billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 <br>Contact: 9545512405 Email: pravinmali@bspmetatech.com';

UPDATE new_po
SET billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405'
WHERE billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT';

COMMIT;


SELECT DISTINCT shipping_address FROM `new_po` WHERE shipping_address LIKE '%pravinmali@bspmetatech.com%';

SELECT DISTINCT billing_address FROM `new_po` WHERE billing_address LIKE '%pravinmali@bspmetatech.com%';

UPDATE new_po
SET shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405'
WHERE shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com';


UPDATE new_po
SET billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405'
WHERE billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com';

COMMIT;


-------------- BSP UNIT 2 ----------------

SELECT DISTINCT shipping_address FROM `new_po` WHERE shipping_address like '%<br>%';

SELECT DISTINCT billing_address FROM `new_po` WHERE billing_address like '%<br>%';

UPDATE new_po
SET shipping_address = SUBSTRING_INDEX(shipping_address, '<br>', 1)
WHERE shipping_address LIKE '%<br>%';


UPDATE new_po
SET billing_address = SUBSTRING_INDEX(billing_address, '<br>', 1)
WHERE billing_address LIKE '%<br>%';


Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com <br>GST: 27AAFFL7327N1ZT

Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com

Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT


UPDATE new_po
SET shipping_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405'
WHERE shipping_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com <br>GST: 27AAFFL7327N1ZT'
;

UPDATE new_po
SET shipping_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405'
WHERE shipping_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com'
;

UPDATE new_po
SET shipping_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405'
WHERE shipping_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT'
;

COMMIT;


Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com <br>GST: 27AAFFL7327N1ZT

Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com

Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT


UPDATE new_po
SET billing_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405'
WHERE billing_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com <br>GST: 27AAFFL7327N1ZT'
;

UPDATE new_po
SET billing_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405'
WHERE billing_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com'
;

UPDATE new_po
SET billing_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405'
WHERE billing_address = 'Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com<br>GSTIN: 27AAFFL7327N1ZT'
;

COMMIT;

SELECT DISTINCT shipping_address FROM `new_po` WHERE shipping_address LIKE '%pravinmali@bspmetatech.com%';

SELECT DISTINCT billing_address FROM `new_po` WHERE billing_address LIKE '%pravinmali@bspmetatech.com%';

UPDATE new_po
SET shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405'
WHERE shipping_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com';


UPDATE new_po
SET billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405'
WHERE billing_address = 'PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN, PUNE -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com';

COMMIT;


Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 Contact: 9545512405 Email: pravinmali@bspmetatech.com
Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com
Gat No. 177, Phase-III, Nighoje Village Chakan, Pune -410501 <br> Contact: 9545512405 <br>Email: pravinmali@bspmetatech.com

PLOT NO G-9/3/1, PHASE III, NEAR MERCEDES BENZE, MIDC CHAKAN

