<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
            'titel' => 'Hulp-vragen',
            'slug' => 'hulp-vragen',
            'omschrijving' => "<p>Als je een hulpvraag hebt, kunt je die hieronder zelf intypen.<br />
            Doe dit zonder je naam of huisnummer op te geven. Als iemand jou wil helpen, kan hij je<br />
            bereiken via het email systeem van de website.. Je kunt dan samen tot een afspraak komen om het verzoek mondeling toe te lichten.</p>
            
            <p><br />
            Deze aanvraag blijft maximaal 14 dagen op de site staan. Daarna wordt hij weggehaald. (Je kunt dan altijd weer je vraag herhalen.)<br />
            (Wil je dat er iemand bij is bij het eerste contact: vraag er dan om. Zie pagina: Contact)</p>",
            'informatie' => "<p>Voorbeeld 1:<br />
            Ik kan niet goed meer lopen. Ik heb wel een rolstoel. Ik zou het heel erg fijn vinden als er<br />
            iemand bereid zou zijn om eens per week met mij een wandelingetje te maken. Ik mis het zo<br />
            dat ik niet meer buiten kom.</p>
            
            <p><br />
            Voorbeeld 2:<br />
            Onze dochter zit op de HAVO en heeft erg veel moeite met wiskunde. Is er misschien iemand<br />
            die haar een tijdje bijles zou kunnen en willen geven?</p>"
            ],
            [
            'titel' => 'Hulp-aanbod',
            'slug' => 'hulp-aanbod',
            'omschrijving' => "<p>Op deze pagina kun je aangeven met welke manier van helpen jij een andere wijkbewoner zou<br />
            willen bijstaan. Bijvoorbeeld:</p>
            
            <p><em>Een klusje in huis doen? (Geef ev., als je die hebt, ook jouw specialiteit aan, bijv. elektrisch.)<br />
            De hond uitlaten?<br />
            Huiswerkhulp?<br />
            Bijles? (Geef aan waarin!)<br />
            Een boodschap voor iemand doen?<br />
            Een maaltijd brengen of laten afhalen? (Uiteraard voor de kostprijs!)<br />
            Computerhulp?<br />
            Hulp bij TV-problemen?<br />
            Verstelwerkzaamheden textiel?<br />
            Half uurtje poetsen?<br />
            Babysit?<br />
            Even chauffeur spelen?<br />
            Tuinwerkzaamheden?<br />
            Boek meebrengen uit de bieb?<br />
            Gezellig een praatje maken?<br />
            Samen een spelletje bijv. rummicub?</em></p>",
            'informatie' => "<p>Voorbeeld 1:<br />
            Ik heb zelf een klein tuintje en vind het een plezier om daar in te werken. Ik wil best wat lichte<br />
            tuinwerkjes doen bij iemand die ik daarmee kan helpen,. Bv. de heg knippen of schoffelen.</p>
            
            <p><br />
            Voorbeeld 2:<br />
            Ik wil best een keer per week een uurtje met iemand op pad gaan. Met de auto wat rijden<br />
            (terrasje?) Of eens naar de bioscoop. (Wel graag dan de onkosten vergoeden!)</p>"
            ],
            [
            'titel' => 'Ik zoek een maatje voor.....',
            'slug' => 'ik-zoek-een-maatje-voor',
            'omschrijving' => "<p>Misschien zoek je een wandelmaatje.</p>

            <p>Een fietsmaatje?</p>
            
            <p>Misschien iemand om samen mee naar de schouwburg te gaan?</p>
            
            <p>Of een concertmaatje?</p>
            
            <p>Een uit-eten-maatje?</p>
            
            <p>Een hobbymaatje?</p>
            
            <p>Laat het hieronder weten.</p>
            
            <p>Als je door iemand gemaild wordt, kun je iets gaan afspreken. Het moet natuurlijk wel duidelijk zijn dat jij en ook de ander zich weer moet kunnen terugtrekken als de klik er niet echt blijkt te zijn!</p>
            
            <p>&nbsp;</p>
            
            <p>Vertel hier even wat voor maatje je zoekt (direct de &quot;titel&quot; dus), en waarom je graag zo&#39;n maatje zou willen.</p>",
            'informatie' => "<p><em>Voorbeeld 1:</em></p>

            <p><em>Fotohobby.</em></p>
            
            <p><em>Ik maak graag foto&#39;s in de natuur. Ik zou het heel leuk vinden om dit samen te doen met iemand die dit ook leuk vindt (en het misschien wel beter kan dan ik!). Ik hoop dat iemand dit leest en dan denkt: dat wil ik wel! &nbsp;Bel me dan eens.</em></p>
            
            <p>&nbsp;</p>
            
            <p><em>Voorbeeld 2:</em></p>
            
            <p><em>Muziek maken.</em></p>
            
            <p><em>Ik speel heel behoorlijk piano. Graag zou ik samen met iemand anders muziek maken. Met iemand die zingt, of viool speelt of fluit. Welk instrument dan ook. </em></p>"
            ],
            [
            'titel' => 'Te leen',
            'slug' => 'te_leen',
            'omschrijving' => "<p>Zou jij kortdurend iets van iemand willen lenen?</p>

            <p>Vraag er hier dan om.</p>
            
            <p>&nbsp;</p>
            
            <p>Als je gemaild wordt: maak duidelijke afspraken en houd je daaraan!</p>
            
            <p>Kijk van tevoren het te lenen ding samen goed na. Als er iets kapot gaat, moet jij dat uiteraard ook weer in orde laten maken!</p>",
            'informatie' => "<p><em>Voorbeeld 1:</em></p>

            <p><em>Ik zoek voor een klusje van een dag of twee een goede kruiwagen. Zou ik die bij iemand kunnen lenen? Het is voor tuinwerkzaamheden. Geen puinvervoer dus. U krijgt hem weer netjes schoongemaakt terug.</em></p>
            
            <p>&nbsp;</p>
            
            <p><em>Voorbeeld 2:</em></p>
            
            <p><em>Ik wil mijn dakgoot zelf schoonmaken. Heeft er iemand een uitschuifladder voor mij te leen? Ik haal hem dan &#39;s morgens op en breng hem dezelfde dag weer terug.</em></p>"
            ],
            [
            'titel' => 'Ruilbeurs',
            'slug' => 'ruilbeurs',
            'omschrijving' => "<p>Heb je iets waar je op uitgekeken bent, maar dat nog prima in orde is?</p>

            <p>Of iets waar je al tijden niets meer mee doet?</p>
            
            <p>&nbsp;</p>
            
            <p>En zou je dat willen ruilen voor iets dat jij eigenlijk juist wel zou willen hebben?</p>
            
            <p>Dat kan ook iets algemeens zijn, zoals een speciale plant voor in de tuin, of een leuke puzzel, of een boek van een geliefde schrijver?</p>
            
            <p>&nbsp;</p>
            
            <p>Bied het hier dan aan en zeg wat je ervoor terug zou willen hebben.</p>
            
            <p>&nbsp;</p>
            
            <p>Belangrijk:</p>
            
            <p>Wil je, als deze oproep geleid heeft tot succes, in je verificatie mail de link: Opgelost willen aanklikken. De aanvraag wordt dan weggehaald.</p>",
            'informatie' => "<p><em>Voorbeeld 1:</em></p>

            <p><em>Vanuit een huis met tuin ben ik verhuisd naar een flat. Ik heb nog een elektrische heggenschaar die prima is. Die wil ik best ruilen. Doe maar een voorstel. Anders: een mooie hangplant voor op mijn balkon.</em></p>
            
            <p>&nbsp;</p>
            
            <p><em>Voorbeeld 2:</em></p>
            
            <p><em>Ik heb een heel mooie kinderstoel. Die wil ik best ruilen voor een CD met dixilandmuziek.</em></p>"
            ],
            [
            'titel' => 'Reacties',
            'slug' => 'reacties',
            'omschrijving' => "<p>Reacties van wijkgenoten moeten met naam en adres worden doorgegeven aan het contactadres van deze website. De reacties worden, mits beschaafd en fatsoenlijk gesteld, altijd op deze pagina geplaatst. Wel worden namen en adressen eruit gehaald!</p>",
            'informatie' => "<p><em>Bijvoorbeeld 1:</em></p>

            <p><em>Ik kom altijd pas laat thuis van mijn werk. Dan moest ik nog voor mezelf koken en dat kwam er meestal niet van. Nu rij ik na mijn werk bij iemand langs die drie straten verder woont en die elke dag een portie extra kookt. Voor mij!! Zonder deze site was dat nooit gelukt. Ik ben er super blij mee. En super dankbaar voor de hulp van deze &quot;buurvrouw&quot;!</em></p>
            
            <p>&nbsp;</p>
            
            <p><em>Voorbeeld 2:</em></p>
            
            <p><em>Een dierenvriend uit de wijk haalt elke morgen, als hij zijn eigen hond uitlaat, nu ook mijn hondje op. Daar ben ik heel erg blij mee. En ook omdat hij daarna soms gezellig met mij een kopje koffie drinkt. Ik vind dit zo fijn! Ik ben blij dat ik dit op deze site heb durven vragen.</em></p>"
            ],
        ]);
    }
}