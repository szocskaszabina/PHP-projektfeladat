PHP projektfeladat 


Egy ruhabolt raktárkészletét tartsuk nyilván egy alkalmazással.

Egyetlen ruha sémája:
{
name: string
price: int
size: string
color: string
discount: int
}

    • Készítsünk felhasználói felületet ruhák felvitelére
    • A felvitel során validáljuk az adatot
        ◦ Név maximum 200 karakter hosszú lehet
        ◦ Size kizárólag az xs, s, m, l, xl értékeket veheti fel
        ◦ Discount 0 és 1 közötti szám lehet
    • Készítsünk listázó oldalt, ahol lehetőség van
        ◦ Elemet törölni
        ◦ Tovább navigálni egyetlen elem szerkesztő oldalára
        ◦ Szűrni név, méret és ár-intervallum szerint
    • A listázó oldalon a termék nevét, színét, méretét, kedvezményes árát és amennyiben van, a kedvezmény mértékét tüntessük fel
    • Készítsünk egy összegző oldalt, ahol a felhasználó megkapja a raktárkészleten lévő termékek árainak összegét, a leértékeléseket is beleszámolva  
