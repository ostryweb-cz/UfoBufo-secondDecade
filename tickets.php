<?php /* Template Name: Tickets */ ?>

<?php 

$zobrazTabulkuCen = true;
get_header(); ?>
<?php ufobufo_body_header(); ?>

<div class="block">
    <?php include( locate_template( 'template-parts/page-title.php' ) );?>
    <div class="block__inner">
     <?php if(pll_current_language() == 'en'){
      //echo '<p>Tickets for UFO BUFO 2026 will be available later this year.</p>';
      //echo '<p>Presale is paused, we are waiting for a bit more clear situation regarding organisation of bigger events. If you want to return the ticket, please write to <a href="mailto:tickets@ufobufo.eu" target="_blank">tickets@ufobufo.eu</a>. Thanks for understanding.</p>';
      echo '<p>The only official seller of tickets is <a href="https://www.book-tickets.cz/ufobufo2026" target="_blank">Book Tickets</a> service. Please keep that in mind if you get offer from any other source.</p>';
      echo '<p><b>Festival is cash only!</b> No signal = no card payment. We accept EUR but return in CZK. The nearest ATM is in Vítkov (8km).</p>';
          if ($zobrazTabulkuCen){
            echo '<p><b>🇨🇿 &gt;&gt; <a href="https://ufobufo.eu/cs/vstupenky/">Ceny vstupenek v Kč</a>.</p>';
 ?>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>Early birds</h3></div>
                <div class="ticketRow_Days"><p>wed - sun</p></div>
                <div class="ticketRow_Price"><p>83 &euro;<span>*</span></p></div>
                <div class="ticketRow_State">Sold Out</div>
            </div>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>1st wave</h3></div>
                <div class="ticketRow_Days"><p>wed - sun <br>fri - sun**</p></div>
                <div class="ticketRow_Price"><p>103 &euro;<span>*</span> <br>94 &euro;<span>*</span></p></div>
                <div class="ticketRow_State">Sold Out</div>
            </div>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>2nd wave</h3></div>
                <div class="ticketRow_Days"><p>wed - sun <br>fri - sun**</p></div>
              <?php
                echo '<div class="ticketRow_Price"><p>120 &euro;<span>*</span> <br>111 &euro;<span>*</span></p></div>';
                //echo '<div class="ticketRow_Price"><p>?? &euro;<span>*</span><br>?? &euro;<span>*</span></p></div>';
              ?>
                <div class="ticketRow_State">Sold Out</div>
            </div>
            <div class="ticketRow ticketRow">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>Christmas gift ticket</h3></div>
                <div class="ticketRow_Days"><p>wed - sun</p></div>
              <?php
                echo '<div class="ticketRow_Price"><p>128 &euro;<span>*</span></p></div>';
                //echo '<div class="ticketRow_Price"><p>?? &euro;<span>*</span></span></p></div>';
              ?>
                <div class="ticketRow_State"><a class="button" href="https://www.book-tickets.cz/index.php?page=bookticket&event=159&lang=en&currency=EUR" target="_blank" title="Buy ticket at book-tickets.cz">Buy the ticket</a></div>
            </div>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>3rd wave</h3></div>
                <div class="ticketRow_Days"><p>wed - sun <br>fri - sun**</p></div>
              <?php
                echo '<div class="ticketRow_Price"><p>141 &euro;<span>*</span><br>133 &euro;<span>*</span></p></div>';
                //echo '<div class="ticketRow_Price"><p>?? &euro;<span>*</span><br>?? &euro;<span>*</span></p></div>';
              ?>
                <div class="ticketRow_State">Not Available</div>
                <?php // <div class="ticketRow_State"><a class="button" href="https://www.book-tickets.cz/index.php?page=bookticket&event=136&lang=en&currency=EUR" target="_blank" title="Buy ticket at book-tickets.cz">Buy the ticket</a></div>
                ?>
            </div>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>final wave</h3></div>
                <div class="ticketRow_Days"><p>wed - sun <br>fri - sun**</p></div>
              <?php
                // echo '<div class="ticketRow_Price"><p>150 &euro;<span>*</span><br>141 &euro;<span>*</span></p></div>';
                echo '<div class="ticketRow_Price"><p>?? &euro;<span>*</span><br>?? &euro;<span>*</span></p></div>';
              ?>
                
                <div class="ticketRow_State">
                  <!--a class="button" href="https://www.book-tickets.cz/index.php?page=bookticket&event=136&lang=en&currency=EUR" target="_blank" title="Buy ticket at book-tickets.cz">Buy the ticket</a>
                  <div>Pre-sale until Sunday 15. 6. 2025</div-->
                  <!--Pre-sale finished-->
                  Not Available
                </div>
            </div>
 <?php /*    
            <div class="ticketRow ticketGate ticketRow">
                <div class="ticketRow_Wave"><h3>Festival gate</h3></div>
                <div class="ticketRow_Days"><p><b>full ticket:</b><br>&nbsp;wed - sun<br>&nbsp;thu - sun<br>&nbsp;fri - sun<br>&nbsp;sat - sun<br><b>one day ticket***:</b><br>&nbsp;wednesday<br>&nbsp;thursday<br>&nbsp;friday<br>&nbsp;saturday<br>&nbsp;sunday<br><br>
                  <b><a href="#parking">🅿️ parking</a>****</b></p></div>
                 <div class="ticketRow_Price"><p><br>150 &euro;<span> </span><br>145 &euro;<span>**</span><br>140 &euro;<span>**</span><br>115 &euro;<span>**</span><br><br>16 &euro;<span>***</span><br>70 &euro;<span>***</span><br>95 &euro;<span>***</span><br>see SAT&nbsp;-&nbsp;SUN<br>20 &euro;<span> </span><br><br></p></div>
                <div class="ticketRow_State">Available at the gate<br>from wednesday morning 18. 6. 2025<br>(cash only)</div>
            </div>
  */ ?>           
            <p class="legend">
              <br>* plus presale fee 0.4 &euro; per ticket
              <br>** the shorter tickets are valid from 10 am
              <?php 
                /* <br>*** the tickets for each day are valid from/to 10am. It is always necessary to buy the full ticket and in case you wish to leave the festival early, you shall announce such information. When leaving the festival return the wristband and get the price difference back. The days spent are added up - for example if you arrive on Wednesday and leave on Friday before 10 a.m., we count Wednesday + Thursday and you get the rest back upon leaving. */
              ?>
              <br><b>Kids up to 14 years of age: entry free</b>
              <br><b>🚫 Please leave your pets at home, you will NOT be allowed to enter with a pet.</b>
              <br id="parking">
              <br>**** 🅿️ PARKING:
              <?php /*
              
              <br><b>CAR PARKING (tent in the Tent Camp): 15 &euro;</b> (in cash at the gate)
              <br><b>VAN/CAMPER/CARAVAN, CAR (tent next to the car): 20 &euro;</b> (in cash at the gate, limited capacity)
              <br>
              
              */ ?>
              <br><b>TENT CAMPING:</b>
              
              <br>We will clarify the prices later, they will be similar to previous years.
            </p>
  <?php
          }
       } elseif(pll_current_language() == 'cs') {
            //echo '<p>Vstupenky na UFO BUFO 2026 budou k dispozici letos později.</p>';
            
            //echo '<p>Předprodej je aktuálně přerušen, vyčkáváme na jasnější situaci kolem organizace větších akcí. Pokud chcete vstupenku vrátit, napište nám na <a href="mailto:tickets@ufobufo.eu" target="_blank">tickets@ufobufo.eu</a>. Díky za pochopení.</p>';
            echo '<p>Jediným oficiálním zdrojem vstupenek je služba <a href="https://www.book-tickets.cz/ufobufo2026" target="_blank">Book Tickets</a>. Prosíme to mít na vědomí, pokud narazíte na nabídku z jiného zdroje.</p>';
            echo '<p><b>Na festivalu zaplatíte jen v hotovosti.</b> Žádný signál = žádná platba kartou. EUR přijímáme, ale vracíme v Kč. Nejbližší bankomat je ve Vítkově (8km).</p>';
          if ($zobrazTabulkuCen){
            ?>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>Early Bird</h3></div>
                <div class="ticketRow_Days"><p>st - ne</p></div>
                <div class="ticketRow_Price"><p>2000 Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p>83 &euro;<span>*</span></p></div>
                <div class="ticketRow_State">Vyprodáno</div>
            </div>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>1. vlna</h3></div>
                <div class="ticketRow_Days"><p>st - ne <br>pá - ne**</p></div>
              <div class="ticketRow_Price"><p>2400 Kč<span>*</span> <br>2200 Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p>103 &euro;<span>*</span><br>94 &euro;<span>*</span></p></div>
                <div class="ticketRow_State">Vyprodáno</div>
            </div>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>2. vlna</h3></div>
                <div class="ticketRow_Days"><p>st - ne <br>pá - ne**</p></div>
              <?php
                echo '<div class="ticketRow_Price"><p>2800 Kč<span>*</span> <br>2600 Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p>120 &euro;<span>*</span><br>111 &euro;<span>*</span></p></div>';
                
               // echo '<div class="ticketRow_Price"><p>?? Kč<span>*</span> <br>?? Kč<span>*</span></p></div>
               // <div class="ticketRow_Price"><p>?? &euro;<span>*</span><br>?? &euro;<span>*</span></p></div>';
              ?>
                <div class="ticketRow_State">Vyprodáno</div>
            </div>
            <div class="ticketRow ticketRow">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>Vánoční dárková vstupenka</h3></div>
                <div class="ticketRow_Days"><p>st - ne</p></div>
              <?php
                 echo '<div class="ticketRow_Price"><p>3000 Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p>128 &euro;<span>*</span></p></div>';
                                  
                //echo '<div class="ticketRow_Price"><p>?? Kč<span>*</span> <br>?? Kč<span>*</span></p></div>
                //<div class="ticketRow_Price"><p>?? &euro;<span>*</span><br>?? &euro;<span>*</span></p></div>';
              ?>
                <div class="ticketRow_State"><a class="button" href="https://www.book-tickets.cz/ufobufo2026" target="_blank" title="Koupit vstupenku na book-tickets.cz">Koupit vstupenku</a></div>
            </div>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>3. vlna</h3></div>
                <div class="ticketRow_Days"><p>st - ne <br>pá - ne**</p></div>
              <?php
                 echo '<div class="ticketRow_Price"><p>3300 Kč<span>*</span> <br>3100 Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p>141 &euro;<span>*</span> <br>133 &euro;<span>*</span></p></div>';
                                  
                //echo '<div class="ticketRow_Price"><p>?? Kč<span>*</span> <br>?? Kč<span>*</span></p></div>
               // <div class="ticketRow_Price"><p>?? &euro;<span>*</span><br>?? &euro;<span>*</span></p></div>';
              ?>
                <div class="ticketRow_State">Nejsou v prodeji.</div>
            </div>
            <div class="ticketRow ticketRow--inactive">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>poslední vlna</h3></div>
                <div class="ticketRow_Days"><p>st - ne <br>pá - ne**</p></div>
              <?php
                // echo '<div class="ticketRow_Price"><p>3500 Kč<span>*</span> <br>3300 Kč<span>*</span></p></div>
                //<div class="ticketRow_Price"><p>150 &euro;<span>*</span> <br>141 &euro;<span>*</span></p></div>';
                                  
                echo '<div class="ticketRow_Price"><p>?? Kč<span>*</span> <br>?? Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p>?? &euro;<span>*</span><br>?? &euro;<span>*</span></p></div>';
              ?>
                <div class="ticketRow_State">Nejsou v prodeji.
                  <br>Ceny budou zveřejněny postupně. 
                  <!--a class="button" href="https://www.book-tickets.cz/ufobufo2025" target="_blank" title="Koupit vstupenku na book-tickets.cz">Koupit vstupenku</a-->
                  <!--div>Předprodej do neděle 15. 6. 2025</div-->
                  <!--Předprodej ukončen-->
                </div>
            </div>
  <?php 
            /*
            <div class="ticketRow ticketGate ticketRow">
                <div class="ticketRow_Wave"><h3>Na místě</h3></div>
                <div class="ticketRow_Days"><p><b>celofestivalová:</b><br>&nbsp;st - ne<br>&nbsp;čt - ne<br>&nbsp;pá - ne<br>&nbsp;so - ne<br><b>jednodenní***:</b><br>&nbsp;středa<br>&nbsp;čtvrtek<br>&nbsp;pátek<br>&nbsp;sobota<br>&nbsp;neděle<br><br>
                  <b><a href="#parking">🅿️ parking</a>****</b></p></div>
                <div class="ticketRow_Price"><p><br>3700 Kč<span> </span><br>3600 Kč<span>**</span><br>3500 Kč<span>**</span><br>2800 Kč<span>** </span><br><br>400 Kč<span>***</span><br>1700 Kč<span>***</span><br>2300 Kč<span>***</span><br>viz SO&nbsp;-&nbsp;NE<br>500 Kč<span> </span><br><br></p></div>
                <div class="ticketRow_Price"><p><br>150 &euro;<span> </span><br>145 &euro;<span>**</span><br>140 &euro;<span>**</span><br>115 &euro;<span>**</span><br><br>16 &euro;<span>***</span><br>70 &euro;<span>***</span><br>95 &euro;<span>***</span><br><br>20 &euro;<span> </span><br><br></p></div>
                <div class="ticketRow_State">V prodeji na bráně<br>od středy 24. 6. 2026 ráno<br>(jen cash)
                      <br>Ceny budou zveřejněny později.></div>
                <?php // <div class="ticketRow_State">Nejsou k dispozici. Ceny budou zveřejněny postupně.</div> ?>
            </div>
 */ ?>
            <p class="legend">
                <br>* plus poplatek předprodeje 10 Kč / 0.4EUR za vstupenku
                <br>** platnost kratších vstupenek začíná v 10h dopoledne
                <?php 
                  /*
                  <br>*** platnost vstupenek na jednotlivé dny začíná a končí v 10h dopoledne. Zaplatíte celofestivalovou vstupenku a nahlásíte záměr festival opustit dříve. Poté při včasném odchodu odevzdáte pásku a rozdíl ceny dostanete zpět. Strávené dny se sčítají - pokud přijedete například ve středu a odjedete v pátek před 10h dopoledne, napočítáme vám středu + čtvrtek a zbytek dostáváte na odjezdu zpět.
                  */
                ?>
                <br><b>Děti do 14-ti let: vstup zdarma</b>
                <br><b>ZTP/P i ZTP</b>: vstupenka opravňuje ke vstupu držitele průkazu a jeho 1 doprovod. S touto výhodou nelze využít dřívější odjezd / "jednodenní" vstup, který je k dostání na bráně.
                <br><b>🚫 Domácí mazlíčky nechte doma, s ním NEBUDETE na festival vpuštěni.</b>
                <br id="parking">
                <br>**** 🅿️ PARKING:
<?php /*
                
                <br><b>PARKING OSOBNÍCH AUT (bez stanování u auta): 350kč | 15eur</b> (hotově na bráně)
                <br><b>KARAVAN KEMP: DODÁVKA / OBYTŇÁK / KARAVAN / OSOBÁK SE STANOVÁNÍM U AUTA: 500kč | 20eur</b> (hotově na bráně, omezená kapacita)
                <br>
*/ ?>                 
                <br><b>STANOVÁNÍ V KEMPU (bez parkování):</b>
                <br>Ceny ujasníme později, nebudou zásadně odlišné od předchozích let.
                <?php /*
                <br>Pro detaily k <a href="https://www.ufobufo.eu/pruvodce/prijezd-parkovani-kemp/" targe="_blank">parkování a kempu</a> mrkněte do našeho <a href="https://www.ufobufo.eu/pruvodce/" targe="_blank">Průvodce</a>.
                <br>
                */ ?>
              <br><br>Pokud vám zaměstnavatel nabízí <b>benefity</b>, které lze čerpat pro zaplacení kulturní akce <b>fakturou</b>, napište nám na <a href="mailto:tickets@ufobufo.eu">tickets@ufobufo.eu</a> a pošleme vám instrukce.
            </p>
        <?php
          }
        } ?>
    </div>
</div>




<?php get_footer(); ?>


