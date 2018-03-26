<?php   $DocFil= '../_base/_admin/ini_CreateDB.php';    $DocVer='5.0.0';   $DocRev='2018-02-00';    $DocIni='evs';  $ModulNr=101;
/* ## Purpose: 'Opret database og 1. regnskab for SALDI    - Efterfoelger for: /admin/opret.php';
 *             ___   _   _    ___  _         
 *            / __) / \ | |  |   \| |   ___ 
 *            \__ \/ ^ \| |__| |) | |__/ -_)
 *            (___/_/ \_|____|___/|_|  \___)
 *                                           
 * LICENS & Copyright (c) 2004-2018 Saldi.dk ApS      *** Se filen: ../LICENS_Copyright.txt
 *
 *
 * 
  Oprettet: 2017-08-00 evs - EV-soft
  Ændrings-Log:
      
 *
 */
 
### Kør denne fil kun 1 gang, ellers oprettes dubletter i DB!

@session_start();
$s_id= session_id();

##+ ini_set("display_errors","0");
    
global $Ødb_Encode, $Ødb_Type, $Øsqdb, $Øconnection, $Ødb_Link, $Ødb_Problem;
$Øsqdb= 'test';
$db= 'test';
$Ødb_Type= 'mysql';
$Ødb_Encode= 'UTF8';
$std_kto_plan= true;

if (phpversion()=='7.2.1') {
$sqhost= 'mysql46.unoeuro.com';
$squser= 'ev_soft_dk';
$sqpass= 'M4d73anU8j';
$Øsqdb = 'ev_soft_dk_db3';
}
/* 
if (!$_POST['regnskab']||!$_POST['brugernavn']||!$_POST['passwd']||!$_POST['passwd2']) {
//  include_once("../includes/online.php");
  if ($db != $Øsqdb) {
    echo '<BODY onLoad="javascript:alert(\'Hmm du har vist ikke noget at gøre her! Dit IP nummer, brugernavn og regnskab er registreret!\')">';
    echo '<meta http-equiv="refresh" content="1;URL=../index/logud.php">';
    exit;
  }
}
 */
include_once('../../_base/out_init.php');
include_once('../../_base/dbi_func.php');
include_once("../../_config/connect.php");   #+  Database tilkobling
if (!function_exists('transaktion')) { include_once('../../_base/fil_func.php'); }
if (!function_exists('dbi_connect')) { include_once('../../_base/dbi_func.php'); }

if (true) {  //  Køres kun manuelt, for at undgå dubletter!
  #+  transaktion("begin");
//  echo '<br>Opretter database...';           make_DataBase();
  echo '<br><b>Databasen gøres klar...</b><br>';
  echo '<br><b>Opretter tabeller...</b>';    make_Tables();
//  echo '<br><b>Opretter indekser...</b>';    make_Indexes();
  echo '<br><b>Der indlæses data i databasen...</b><br>';
  echo '<br><b>Opretter grunddata..</b>';    make_BaseData();
  TableImport('Varer','varer.v50.csv','tblA_product (varenr,enhed,beskrivelse,kostpris,salgspris,colli,notes,gruppe,min_lager,max_lager,fotonavn)');  //  vejl_pris ? lokation ?
  echo '<br><b>Opretter kontoplan..</b>';    make_Kontoplan($std_kto_plan);
  
#+  transaktion("commit");
}
echo '<br>DONE...';


// Her følger ovennævnte funktions erklæringer:

function make_DataBase () { global $brugernavn, $Ødb_Type, $Ødb_Link, $db, $Ødb_encode;
  if ($Ødb_Type=='mysql') {
    sql_creat('CREATE DATABASE '.$db, __FILE__, __LINE__);      //  db_modify("CREATE DATABASE $db",__FILE__ . " linje " . __LINE__);
    $Ødb_Link= dbi_connect($sqhost, $squser, $sqpass, $Øsqdb, $port);  // $mysqli = mysqli_connect('localhost', 'user', 'pass', $db); //  mysql_select_db($db);    if (!$db_encode=="UTF8") $db_encode="UTF8"; else $db_encode="LATIN1";
    sql_creat('SET character_set_client = "UTF8"', __FILE__, __LINE__);  //  db_modify("SET character_set_client = 'UTF8'", __FILE__, __LINE__);    else db_modify("SET character_set_client = 'LATIN1'", __FILE__, __LINE__);
  } else { // "postgres"
    if ($Ødb_Encode=="UTF8") 
         sql_creat('CREATE DATABASE $db with encoding = "UTF8"',  __FILE__, __LINE__);
    else sql_creat('CREATE DATABASE $db with encoding = "LATIN9"',__FILE__, __LINE__);
    dbi_DBclose($connection);                                                
    $connection = dbi_connect ($sqhost,$squser,$sqpass,$db,$port='',__FILE__, __LINE__);
  }
};

// PLAN: For at kunne udtynde de felter, som ikke er i brug, tilføjes COMMENT til alle de felter, som ER i brug!
function make_Tables () {
  $if= ' IF NOT EXISTS ';
  $ch= '';  //  'CHARACTER SET = utf8 COLLATE utf8_danish_ci';
  // tblA_adress ('id','firmanavn','addr1','addr2','postnr','bynavn','land','kontakt','tlf','fax','email','web','bank_navn','bank_reg','bank_konto','bank_fi','erh','swift','notes','rabat','momskonto','kreditmax','betalingsbet','betalingsdage','kontonr','cvrnr','ean','institution','adr_art','gruppe','rabatgruppe','kontoansvarlig','oprettet','kontaktet','kontaktes','pbs','pbs_nr','pbs_date','mailfakt','udskriv_til','felt_1','felt_2','felt_3','felt_4','felt_5','vis_lev_addr','kontotype','fornavn','efternavn','lev_firmanavn','lev_fornavn','lev_efternavn','lev_addr1','lev_addr2','lev_postnr','lev_bynavn','lev_land','lev_kontakt','lev_tlf','lev_email','status','lukket','kategori','saldo')
  sql_creat('CREATE TABLE'.$if.' tblA_adress  '.$ch.'    
          ( id serial NOT NULL, ## Ver 3.x: adresser ##
            firmanavn text                    COMMENT "Adressat", 
            addr1 text                        COMMENT "Vejnavn og husnr", 
            addr2 text                        COMMENT "Steds benævnelse", 
            postnr text,                      COMMENT "Postnummer",
            bynavn text,                      COMMENT "Bynavn",
            land text,                        COMMENT "Land",
            kontakt text,                     COMMENT "Kontakt",
            tlf text,                         COMMENT "Telefon",
            fax text,                         COMMENT "Fax",
            email text,                       COMMENT "Email",
            web text, 
            bank_navn text, 
            bank_reg text, 
            bank_konto text, 
            bank_fi text, 
            erh text, 
            swift text, 
            notes text, 
            rabat numeric(15, 3),
            momskonto integer, 
            kreditmax numeric(15, 3),
            betalingsbet text, 
            betalingsdage integer DEFAULT 0, 
            kontonr text, 
            cvrnr text                        COMMENT "Nummer i det Centrale Virksomhedsregister", 
            ean text                          COMMENT "European Article Number",  
            institution text, 
            adr_art varchar(2),
            gruppe integer, 
            rabatgruppe integer, 
            kontoansvarlig integer, 
            oprettet date, 
            kontaktet date, 
            kontaktes date, 
            pbs varchar(2), 
            pbs_nr text, 
            pbs_date date, 
            mailfakt varchar(2),
            udskriv_til varchar(10),
            felt_1 text, 
            felt_2 text, 
            felt_3 text, 
            felt_4 text, 
            felt_5 text, 
            vis_lev_addr varchar(2),
            kontotype text, 
            fornavn text, 
            efternavn text, 
            lev_firmanavn text, 
            lev_fornavn text, 
            lev_efternavn text, 
            lev_addr1 text, 
            lev_addr2 text, 
            lev_postnr text, 
            lev_bynavn text, 
            lev_land text, 
            lev_kontakt text, 
            lev_tlf text, 
            lev_email text, 
            status text, 
            lukket varchar(2),
            kategori text, 
            saldo numeric(15,3),                                  
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_employed    '.$ch.'  (id serial NOT NULL, ## Ver 3.x: ansatte ##
            konto_id integer, 
            navn text, 
            addr1 text, 
            addr2 text, 
            postnr text, 
            bynavn text, 
            tlf text, 
            fax text, 
            mobil text, 
            privattlf text, 
            initialer text, 
            email text, 
            notes text, 
            cprnr text, 
            posnr integer, 
            afd integer, 
            provision numeric(15,3), 
            nummer integer, 
            loen numeric(15,3), 
            hold integer, 
            lukket varchar(2), 
            bank text, 
            startdate date, 
            slutdate date, 
            gruppe numeric(15,3), 
            extraloen numeric(15,3), 
            trainee text, 
            password text, 
            overtid numeric(1,0), 
            sag_id integer,  
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_crm  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: crm ##
            konto_id int, 
            kontakt_id int, 
            ansat_id int, 
            notat text, 
            notedate date, 
            spor text,                             
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_users  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: brugere ##
            brugernavn text, 
            kode text, 
            tmp_kode text, 
            status boolean, 
            regnskabsaar integer, 
            rettigheder text, 
            ansat_id integer, 
            sprog_id integer, 
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_groups           (id serial NOT NULL, ## Ver 3.x: grupper ##
            beskrivelse text, 
            kode text, 
            kodenr text, 
            grp_art text, 
            box1 text, 
            box2 text, 
            box3 text, 
            box4 text, 
            box5 text, 
            box6 text, 
            box7 text, 
            box8 text, 
            box9 text, 
            box10 text, 
            box11 text, 
            box12 text, 
            box13 text, 
            box14 text,       
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_journal_entry  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: kassekladde ##
            bilag integer,
            transdate date,
            beskrivelse text,
            d_type varchar(1),
            debet numeric(15,0),
            k_type varchar(1),
            kredit numeric(15,0),
            faktura text,
            amount numeric(15,3),
            kladde_id integer,
            momsfri varchar(2),
            medarb integer,
            ansat text,
            afd integer,
            projekt text,
            valuta integer,
            valutakurs numeric(15,3),
            ordre_id integer,
            forfaldsdate date,
            betal_id text,
            dokument text,        
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_tmp_journal_Entry  '.$ch.'  (id integer,       ## Ver 3.x:  tmpkassekl ##
            lobenr integer,
            bilag text,
            transdate text,
            beskrivelse text,
            d_type text,
            debet text,
            k_type text,
            kredit text,
            faktura text,
            amount text,
            kladde_id integer,
            momsfri text,
            afd text,
            projekt text,
            ansat text,
            valuta text,
            valutakurs text,
            forfaldsdate text,
            betal_id text,
            dokument text)'                       , __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_draft_list  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: kladdeliste ##
            kladdedate date,
            bogforingsdate date,
            kladdenote text,
            bogfort varchar(2),
            oprettet_af text,
            bogfort_af text,
            hvem text,
            tidspkt text,               
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_account_plan  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: kontoplan ##
            kontonr numeric(15,0),
            beskrivelse text,
            kontotype varchar(1),
            moms text,
            fra_kto numeric(15,0),
            til_kto numeric(15,0),
            lukket varchar(2),
            primo numeric(15,3),
            saldo numeric(15,3),
            regnskabsaar integer,
            genvej varchar(2),
            overfor_til numeric(15,0),
            anvendelse text,
            modkonto numeric(15,0),
            valuta integer,
            valutakurs numeric(15,4),              
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_charge_cards  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: kontokort ##
            ref_id integer,
            faktnr integer,
            refnr integer,
            beskrivelse text,
            kredit numeric(15,0),
            debet numeric(15,0),
            transdate date,
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_orders  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: ordrer ##
            konto_id integer,
            firmanavn text,
            addr1 text,
            addr2 text,
            postnr text,
            bynavn text,
            land text,
            kontakt text,
            email text,
            mail_fakt varchar(2),
            udskriv_til varchar(10),
            kundeordnr text,
            lev_navn text,
            lev_addr1 text, 
            lev_addr2 text,
            lev_postnr text,
            lev_bynavn text,
            lev_kontakt text,
            ean text,
            institution text,
            betalingsbet text,
            betalingsdage integer,
            kontonr text,
            cvrnr text,
            ord_art varchar(2),
            valuta text,
            valutakurs numeric(15,3),
            sprog text,
            projekt text,
            ordredate date,
            levdate date,
            fakturadate date,
            notes text,
            ordrenr integer,
            sum numeric(15,3),
            momssats numeric(15,3),
            status integer,
            ref text,
            fakturanr text,
            modtagelse integer,
            kred_ord_id integer,
            lev_adr text,
            kostpris numeric(15,3),
            moms numeric(15,3),
            hvem text,
            tidspkt text,
            betalt varchar(12),
            nextfakt date,
            pbs varchar(2),
            mail varchar(2),
            mail_cc text,
            mail_bcc text,
            mail_subj text,
            mail_text text,
            felt_1 text,
            felt_2 text,
            felt_3 text,
            felt_4 text,
            felt_5 text,
            vis_lev_addr varchar(2),
            restordre numeric(2,0),
            betalings_id text,
            sag_id integer,
            tilbudnr numeric(15,0),
            datotid text,
            nr numeric(15,0),
            returside text,
            sagsnr numeric(15,0),
            dokument text,
            procenttillag numeric(15,3),
            mail_bilag varchar(2),
            omvbet varchar(2),
            afd integer,
            kontakt_tlf text,       
            PRIMARY KEY (id))', __FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_ordrer_art                   ON tblA_orders         (ord_art)'      ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_ordrer_betalt                ON tblA_orders         (betalt)'       ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_ordrer_id                    ON tblA_orders         (id)'           ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_ordrer_ordrenr               ON tblA_orders         (ordrenr)'      ,__FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_order_lines  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: ordrelinjer ##
            varenr text,
            beskrivelse text,
            enhed text,
            posnr integer,
            pris numeric(15,3),
            rabat numeric(15,3),
            lev_varenr text,
            ordre_id integer,
            serienr text,
            vare_id integer,
            antal numeric(15,3),
            leveres numeric(15,3),
            leveret numeric(15,3),
            bogf_konto integer,
            oprettet_af text,
            bogfort_af text,
            hvem text,
            tidspkt text,
            kred_linje_id integer,
            momsfri varchar(2),
            momssats numeric(15,3),
            kostpris numeric(15,3),
            samlevare varchar(2),
            projekt text,
            m_rabat numeric(15,3),
            rabatgruppe integer,
            folgevare integer,
            kdo varchar(2),
            rabatart varchar(10),
            variant_id text,
            procent numeric(15,3),
            omvbet varchar(2),
            saet integer,
            fast_db numeric(15,3),
            afd integer,
            lager integer,
            tilfravalg text,            
            PRIMARY KEY (id))', __FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_ordrelinjer_id               ON tblA_order_lines    (id)'           ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_ordrelinjer_ordre_id         ON tblA_order_lines    (ordre_id)'     ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_ordrelinjer_vare_id          ON tblA_order_lines    (vare_id)'      ,__FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_order_texts  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: ordretekster ##
            tekst text,
            sort numeric(15,0),
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_open_post  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: openpost ##
            konto_id integer,
            konto_nr text,
            faktnr text,
            amount numeric(15,3),
            refnr integer,
            beskrivelse text,
            udlignet varchar(2),
            transdate date,
            uxtid text,
            kladde_id integer,
            bilag_id integer,
            udlign_id integer,
            udlign_date date,
            valuta text,
            projekt text,
            valutakurs numeric(15,3),
            forfaldsdate date,
            betal_id text,
            betalings_id text,                      
            PRIMARY KEY (id))', __FILE__, __LINE__);
  //    sql_creat('CREATE INDEX ix_openpost_id                  ON tblA_open_post      (id)'           ,__FILE__, __LINE__);
  //    sql_creat('CREATE INDEX ix_openpost_konto_id            ON tblA_open_post      (konto_id)'     ,__FILE__, __LINE__);
  //    sql_creat('CREATE INDEX ix_openpost_udlign_id           ON tblA_open_post      (udlign_id)'    ,__FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_transactions  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: transaktioner ##
            kontonr numeric(15,0),
            bilag numeric(15,0),
            transdate date,
            logtime time,
            beskrivelse text,
            debet numeric(15,3),
            kredit numeric(15,3),
            faktura text,
            kladde_id integer,
            projekt text,
            ansat numeric(15,0),
            logdate date,
            afd integer,
            ordre_id integer,
            valuta text,
            valutakurs numeric(15,3),
            moms numeric(15,3),
            adresser_id int4,
            kasse_nr numeric(15,0),              
            PRIMARY KEY (id))', __FILE__, __LINE__);
  //    sql_creat('CREATE INDEX' ix_transaktioner_id             ON tblA_transactions   (id)'           ,__FILE__, __LINE__);
  //    sql_creat('CREATE INDEX' ix_transaktioner_transdate      ON tblA_transactions   (transdate)'    ,__FILE__, __LINE__);
  //    sql_creat('CREATE INDEX' ix_transaktioner_kontonr        ON tblA_transactions   (kontonr)'      ,__FILE__, __LINE__);
  
  sql_creat('CREATE TABLE'.$if.' tblA_simulation  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: simulering ##
            kontonr numeric(15,0),
            bilag numeric(15,0),
            transdate date,
            beskrivelse text,
            debet numeric(15,3),
            kredit numeric(15,3),
            faktura text,
            kladde_id int4,
            projekt text,
            ansat numeric(15,0),
            logdate date,
            logtime time,
            afd int4,
            ordre_id int4,
            valuta text,
            valutakurs numeric(15,3),
            moms numeric(15,3),
            adresser_id int4,                  
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_product  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: varer ##
            varenr text,
            stregkode text,
            beskrivelse text,
            enhed text,
            enhed2 text,
            indhold numeric(15,3),
            forhold numeric(15,3),
            gruppe text,
            salgspris numeric(15,3),
            kostpris numeric(15,3),
            provisionsfri varchar(2),
            notes text,
            lukket varchar(2),
            serienr text,
            beholdning numeric(15,3),
            samlevare varchar(2),
            delvare varchar(2),
            min_lager numeric(15,3),
            max_lager numeric(15,3), 
            trademark text,
            location text,
            retail_price numeric(15,3),
            special_price numeric(15,3),
            campaign_cost numeric(15,3),
            tier_price numeric(15,3),
            open_colli_price numeric(15,3),
            colli numeric(15,3),
            outer_colli numeric(15,3),
            outer_colli_price numeric(15,3),
            special_from_date date,
            special_to_date date,
            special_from_time time,
            special_to_time time,
            komplementaer text,
            circulate integer,
            operation integer,
            prisgruppe integer,
            tilbudgruppe integer,
            rabatgruppe integer,
            dvrg integer,
            m_type varchar(10),
            m_rabat text,
            m_antal text,
            folgevare text,
            kategori text,
            varianter text,
            publiceret varchar(2),
            montage numeric(15,3),
            demontage numeric(15,3),
            fotonavn text,
            tilbudsdage text,                       
            PRIMARY KEY (id))', __FILE__, __LINE__);
   //     sql_creat('CREATE INDEX ix_varer_beskrivelse            ON tblA_product        (id)'           ,__FILE__, __LINE__);
   //     sql_creat('CREATE INDEX ix_varer_id                     ON tblA_product        (id)'           ,__FILE__, __LINE__);

  sql_creat('CREATE TABLE'.$if.' tblA_stock_status  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: lagerstatus ##
            lager integer,
            vare_id integer,
            beholdning numeric(15,3),
            lok1 text,
            lok2 text,
            lok3 text,
            lok4 text,
            lok5 text,    
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_batch_purchase  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: batch_kob ##
            kobsdate date,
            fakturadate date,
            vare_id integer,
            linje_id integer,
            ordre_id integer,
            pris numeric(15,3),
            antal numeric(15,3),
            rest numeric(15,3),
            lager integer,                                        
            PRIMARY KEY (id))', __FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_kob_antal              ON tblA_batch_purchase (antal)'        ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_kob_fakturadate        ON tblA_batch_purchase (fakturadate)'  ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_kob_id                 ON tblA_batch_purchase (id)'           ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_kob_kobsdate           ON tblA_batch_purchase (kobsdate)'     ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_kob_linje_id           ON tblA_batch_purchase (linje_id)'     ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_kob_vare_id            ON tblA_batch_purchase (vare_id)'      ,__FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_batch_sale  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: batch_salg ##
            salgsdate date,
            fakturadate date,
            batch_kob_id integer,
            vare_id integer,
            linje_id integer,
            ordre_id integer,
            pris numeric(15,3),
            antal numeric(15,3),
            lev_nr integer,
            lager integer,                                        
            PRIMARY KEY (id))', __FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_salg_antal             ON tblA_batch_sale     (antal)'        ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_salg_fakturadate       ON tblA_batch_sale     (fakturadate)'  ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_salg_salgsdate         ON tblA_batch_sale     (salgsdate)'    ,__FILE__, __LINE__);
  //      sql_creat('CREATE INDEX ix_batch_salg_vare_id           ON tblA_batch_sale     (vare_id)'      ,__FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_Serial  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: serienr ##
            vare_id integer,
            kobslinje_id integer,
            salgslinje_id integer,
            batch_kob_id integer,
            batch_salg_id integer,
            serienr text,                                         
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_parts_lists  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: styklister ##
            vare_id integer,
            indgaar_i integer,
            antal numeric(15,3),
            posnr integer,                    
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_units  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: enheder ##
            betegnelse text,beskrivelse text,                     
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_materials  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: materialer ##
            beskrivelse text,
            densitet numeric(15,3),
            materialenr text,
            tykkelse numeric(15,3),
            kgpris numeric(15,3),
            avance numeric(15,3),
            enhed text,
            opdat_date date,
            opdat_time time,                      
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_product_deliver  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: vare_lev ##
            posnr integer,
            lev_id integer,
            vare_id integer,
            lev_varenr text,
            kostpris numeric(15,3),               
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_booking  '.$ch.'  (linje_id integer,   ## Ver 3.x: reservation ##
            batch_kob_id integer,
            batch_salg_id integer,
            vare_id integer,
            antal numeric(15,3),lager integer)', __FILE__, __LINE__);
  // tblA_forms  ('id','form','frm_art','side','besk','just','x0','y0','dx','dy','dim','colr','font','style','imglnk','lngkey','note')
  sql_creat('CREATE TABLE'.$if.' tblA_forms  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: formularer ##
            form integer,         
            frm_art integer,      
            side varchar(2),    
            besk VARCHAR(300),    
            just VARCHAR(30),        
            x0 numeric(15,3),     
            y0 numeric(15,3),     
            dx numeric(15,3),   
            dy numeric(15,3),   
            dim numeric(15,3),    
            colr VARCHAR(30),     
            font VARCHAR(99),   
            style VARCHAR(99),                   
            imglnk VARCHAR(99),   
            lngkey VARCHAR(300),  
            note VARCHAR(99), 
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_commission  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: provision ##
            gruppe_id integer,
            ansat_id integer,
            provision numeric(15,3),                             
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_history  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: historik ##
            konto_id int,
            kontakt_id int,
            ansat_id int,notat text,
            notedate date,
            kontaktet date,
            kontaktes date,
            dokument text,          
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_currency  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: valuta ##
            gruppe integer,
            valdate date,
            kurs numeric(15,3),                                   
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_payment_list  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: betalingsliste ##
            listedate date,
            udskriftsdate date,
            listenote text,
            bogfort varchar(2),
            oprettet_af text,
            bogfort_af text,
            hvem text,
            tidspkt text,                                         
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_payments  '.$ch.'  (id serial NOT NULL, ## Ver 3.x: betalinger ##
            bet_type text,
            fra_kto text,
            egen_ref text,
            til_kto text,
            modt_navn text,
            belob text,
            betalingsdato text,
            valuta text,
            kort_ref text,
            kvittering text,
            ordre_id integer,
            bilag_id integer,
            liste_id integer,                    
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_timesheet        (id serial NOT NULL, ## Ver 3.x: tidsreg ##
            person integer,
            ordre integer,
            pnummer integer,
            operation integer,
            materiale integer,
            tykkelse numeric(15,3),
            laengde numeric(15,3),
            bredde numeric(15,3),
            antal_plader numeric(15,3), 
            gaa_hjem integer,
            tid integer,
            forbrugt_tid integer,
            opsummeret_tid integer,
            beregnet integer,
            pause integer,
            antal numeric(15,3), 
            faerdig integer,
            circ_time integer,                                    
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_tables           (id serial NOT NULL, ## Ver 3.x: tabeller ##
            person integer,
            ordre integer,
            pnummer integer,
            operation integer,
            materiale integer,
            tykkelse numeric(15,3),
            laengde numeric(15,3),
            bredde numeric(15,3),
            antal_plader numeric(15,3), 
            gaa_hjem integer,
            tid integer,
            forbrugt_tid integer,
            opsummeret_tid integer,
            beregnet integer,
            pause integer,
            antal numeric(15,3), 
            faerdig integer,
            circ_time integer,                                    
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_texts            (id serial NOT NULL, ## Ver 3.x: tekster ##
            sprog_id integer,
            tekst_id integer,
            tekst text,         
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_product_texts    (id serial NOT NULL, ## Ver 3.x: varetekster ##
            sprog_id integer,
            vare_id integer,
            tekst text,          
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_jobcard          (id serial NOT NULL, ## Ver 3.x: jobkort ##
            konto_id integer,
            ordre_id integer,
            kontonr text,
            firmanavn text,
            addr1 text,
            addr2 text,
            postnr text,
            bynavn text,
            kontakt text,
            tlf text,
            initdate date,
            oprettet_af text,
            startdate date,
            slutdate date,
            hvem text,
            tidspkt text,
            felt_1 text,
            felt_2 text,
            felt_3 text,
            felt_4 text,
            felt_5 text,
            felt_6 text,
            felt_7 text,
            felt_8 text,
            felt_9 text,
            felt_10 text,
            felt_11 text,                                         
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_jobcard_felds    (id serial NOT NULL, ## Ver 3.x: jobkort_felter ##
            job_id integer,
            job_art text,
            feltnr integer,
            subnr integer,
            feltnavn text,
            indhold text,                           
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_receiving_list   (id serial NOT NULL, ## Ver 3.x: modtageliste ##
            initdate date,
            modtagdate date,
            modtagnote text,
            modtaget text,
            init_af text,
            modtaget_af text,
            hvem text,
            tidspkt text, 
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_arrivals         (id serial NOT NULL, ## Ver 3.x: modtagelser ##
            varenr text,
            beskrivelse text,
            leveres numeric(15,3),
            liste_id integer,
            lager numeric(15,3),
            ordre_id integer,
            vare_id integer,
            antal numeric(15,3),                                  
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_pbs_customers    (id serial NOT NULL, ## Ver 3.x: pbs_kunder ##
            konto_id integer,
            kontonr varchar(20),
            pbs_nr text,     
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_pbs_list         (id serial NOT NULL, ## Ver 3.x: pbs_liste ##
            liste_date date,
            afsendt varchar(8),                   
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_pbs_orders       (id serial NOT NULL, ## Ver 3.x: pbs_ordrer ##
            liste_id integer,
            ordre_id integer,                    
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_pos_payments     (id serial NOT NULL, ## Ver 3.x: pos_betalinger ##
            ordre_id integer,
            betalingstype varchar(40),
            amount numeric(15,3),
            valuta varchar(3),
            valutakurs numeric(15,3),                             
            PRIMARY KEY (id))', __FILE__, __LINE__);
  //    sql_creat('CREATE INDEX ix_pos_betalinger_ordre_id      ON tblA_pos_payments   (ordre_id)'     ,__FILE__, __LINE__);
  //    sql_creat('CREATE INDEX ix_pos_betalinger_betalingstype ON tblA_pos_payments   (betalingstype)',__FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_pbs_lines        (id serial NOT NULL, ## Ver 3.x: pbs_linjer ##
            liste_id integer,
            linje text,                          
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_budget           (id serial NOT NULL, ## Ver 3.x: budget ##
            regnaar integer,
            md integer, 
            kontonr numeric(15,0),
            amount numeric(15,0),           
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_discount         (id serial NOT NULL, ## Ver 3.x: rabat ##
            rabat numeric(6,2),
            debitorart varchar(2),
            debitor int,
            vareart varchar(2),
            vare int,
            rabatart varchar(6),      
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_pos_buttons      (id serial NOT NULL, ## Ver 3.x: pos_buttons ##
            menu_id integer,
            col numeric(2,0),
            row numeric(2,0),
            colspan numeric(1,0),
            rowspan numeric(1,0),
            beskrivelse text,
            vare_id numeric(10,0),
            funktion numeric(1,0),
            color varchar(6),                                     
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_regulation       (id serial NOT NULL, ## Ver 3.x: regulering ##
            vare_id integer, 
            variant_id integer,
            lager integer,
            beholdning numeric(15,3),
            optalt numeric(15,3),
            tidspkt text,
            bogfort bool,
            transdate date,
            logtime time,
            bogfort_af text,                                      
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_navigator        (bruger_id integer,session_id text,side text,returside text,
            konto_id integer,
            ordre_id integer,
            vare_id integer)', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_cost_prices      (id serial NOT NULL, ## Ver 3.x: kostpriser ##
            vare_id integer,
            transdate date,
            kostpris numeric(15,3),                               
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_cases            (id serial NOT NULL, ## Ver 3.x: sager ##
            konto_id integer,
            firmanavn text,
            addr1 text,
            addr2 text,
            postnr text,
            bynavn text,
            land text,
            kontakt text,
            email text,
            beskrivelse text,
            omfang text,
            ref text,
            udf_firmanavn text,
            udf_addr1 text,
            udf_addr2 text,
            udf_postnr text,
            udf_bynavn text,
            udf_kontakt text,
            status text,
            tidspkt text,
            hvem text,
            oprettet_af text,
            kunde_ref text,
            planfraop text,
            plantilop text,
            planfraned text,
            plantilned text,
            beregn_opret text,
            beregn_tilbud text,
            beregner text,
            beregn_beskrivelse text,                              
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_appendix         (id serial NOT NULL, ## Ver 3.x: bilag ##
            navn text,
            beskrivelse text,
            datotid text,
            hvem text,
            assign_to text,
            assign_id int,
            fase numeric(15,3),
            kategori text,
            filtype text,
            bilag_fase text,                                      
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_notes            (id serial NOT NULL, ## Ver 3.x: noter ##
            notat text,
            beskrivelse text,
            datotid text,
            hvem text,
            besked_til text,
            assign_to text,
            assign_id integer,
            status integer,
            fase numeric(15,3),
            notat_fase text,
            kategori text,
            nr numeric(15,0),                       
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_check_list       (id serial NOT NULL, ## Ver 3.x: tjekliste ##
            tjekpunkt text,
            fase numeric(15,3),
            assign_to text,
            assign_id integer,
            sagsnr text,                        
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_check_lists      (id serial NOT NULL, ## Ver 3.x: tjekpunkter ##
            tjekliste_id integer,
            assign_id integer,
            status integer,
            status_tekst text,
            tjekskema_id integer,               
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_case_texts       (id serial NOT NULL, ## Ver 3.x: sagstekster ##
            tekstnr numeric(15,0),
            beskrivelse text, 
            tekst text,   
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_salary           (id serial NOT NULL, ## Ver 3.x: loen ##
            nummer numeric(15,0),
            kategori integer,
            loendate date,
            sag_id integer, 
            sag_nr numeric(15,0),
            tekst text,
            ansatte text,
            fordeling text,
            timer text,
            t50pct text,
            t100pct text,
            hvem text,
            oprettet text,
            afsluttet text,
            godkendt text,
            sum numeric(15,3),
            oprettet_af text,
            afsluttet_af text,
            godkendt_af text,
            master_id integer,
            loen text,
            afvist text,
            afvist_af text,
            udbetalt text,
            sly_art text,
            skur text,
            datoer text,
            afregnet text,
            afregnet_af text,
            korsel text,
            opg_id integer,
            opg_nr integer,
            afvist_pga text,
            sag_ref text,
            feriefra text,
            ferietil text,             
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_salary_units     (id serial NOT NULL, ## Ver 3.x: loen_enheder ##
            loen_id integer,
            vare_id integer,
            op numeric(15,3),
            ned numeric(15,3),
            tekst text,
            pris_op numeric(15,3),
            pris_ned numeric(15,3),
            op_25 numeric(15,3),
            ned_25 numeric(15,3),
            op_30m numeric(15,3),
            ned_30m numeric(15,3),
            op_40 numeric(15,3),
            ned_40 numeric(15,3),
            op_60 numeric(15,3),
            ned_60 numeric(15,3),
            op_tag numeric(15,3),
            ned_tag numeric(15,3),
            varenr text,                    
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_tasks            (id serial NOT NULL, ## Ver 3.x: opgaver ##
            assign_id integer,
            assign_to text, 
            nr numeric(15,0),
            beskrivelse text,
            omfang text,
            ref text,
            status text,
            tidspkt text,
            hvem text,
            oprettet_af text,
            kunde_ref text,
            opg_planfra text,
            opg_plantil text,
            opg_tilknyttil text,                 
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_check_scheme     (id serial NOT NULL, ## Ver 3.x: tjekskema ##
            tjekliste_id integer,
            datotid text,
            opg_art text,
            sjak text,
            sag_id integer,
            hvem text,
            man_trans text,
            stillads_til text,
            opg_navn text,
            opg_beskrivelse text,
            sjakid text,                     
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_folder           (id serial NOT NULL, ## Ver 3.x: mappe ##
            beskrivelse text,
            sort numeric(15,0),                  
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_folder_annex     (id serial NOT NULL, ## Ver 3.x: mappebilag ##
            navn text,
            beskrivelse text,
            datotid text,
            hvem text,
            assign_to text,
            assign_id int4,
            filtype text,
            sort numeric(15,0),                      
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_employ_folder    (id serial NOT NULL, ## Ver 3.x: ansatmappe ##
            beskrivelse text,
            ans_id int,
            sort numeric(15,0),       
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_employ_appendix  (id serial NOT NULL, ## Ver 3.x: ansatmappebilag ##
            navn text,
            beskrivelse text,
            datotid text,
            hvem text,
            assign_to text,
            assign_id int4,
            filtype text,
            sort numeric(15,0),                      
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_shop_adresses    (id serial NOT NULL, ## Ver 3.x: shop_adresser ##
            saldi_id integer,
            shop_id integer,                     
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_shop_product     (id serial NOT NULL, ## Ver 3.x: shop_varer ##
            saldi_id integer,
            shop_id integer,                     
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_shop_orders      (id serial NOT NULL, ## Ver 3.x: shop_ordrer ##
            saldi_id integer,
            shop_id integer,                     
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_variants         (id serial NOT NULL, ## Ver 3.x: varianter ##
            beskrivelse text,
            shop_id integer,                     
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_variant_typer    (id serial NOT NULL, ## Ver 3.x: variant_typer ##
            variant_id integer,
            shop_id integer,
            beskrivelse text,  
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_variant_products (id serial NOT NULL, ## Ver 3.x: variant_varer ##
            vare_id integer,
            variant_type text,
            variant_beholdning numeric(15,3),
            variant_stregkode text,
            lager integer,                 
            PRIMARY KEY (id))', __FILE__, __LINE__);
  sql_creat('CREATE TABLE'.$if.' tblA_product_offer    (id serial NOT NULL, ## Ver 3.x: varetilbud ##
            vare_id integer,
            startdag numeric(15,0),
            slutdag numeric(15,0),
            starttid time,sluttid time,
            ugedag integer,
            salgspris numeric(15,2),
            kostpris numeric(15,2),       
            PRIMARY KEY (id))', __FILE__, __LINE__);

# sql_creat('CREATE TABLE osc_adresser (id serial NOT NULL,saldi_id integer,osc_id integer,PRIMARY KEY (id))', __FILE__, __LINE__);
# sql_creat('CREATE TABLE osc_ordrer (id serial NOT NULL,saldi_id integer,osc_id integer,PRIMARY KEY (id))', __FILE__, __LINE__);
# sql_creat('CREATE TABLE osc_varer (id serial NOT NULL,saldi_id integer,osc_id integer,PRIMARY KEY (id))', __FILE__, __LINE__);
};


function make_Indexes () {
  $if= '';   //  $if= ' IF NOT EXISTS ';  // ikke understøttet i ældre versioner a MySQL
  $or= '';   //  $or= ' OR REPLACE ';     // ikke understøttet i ældre versioner a MySQL
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_kob_antal              ON tblA_batch_purchase (antal)'        ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_kob_fakturadate        ON tblA_batch_purchase (fakturadate)'  ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_kob_id                 ON tblA_batch_purchase (id)'           ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_kob_kobsdate           ON tblA_batch_purchase (kobsdate)'     ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_kob_linje_id           ON tblA_batch_purchase (linje_id)'     ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_kob_vare_id            ON tblA_batch_purchase (vare_id)'      ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_salg_antal             ON tblA_batch_sale     (antal)'        ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_salg_fakturadate       ON tblA_batch_sale     (fakturadate)'  ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_salg_salgsdate         ON tblA_batch_sale     (salgsdate)'    ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_batch_salg_vare_id           ON tblA_batch_sale     (vare_id)'      ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_openpost_id                  ON tblA_open_post      (id)'           ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_openpost_konto_id            ON tblA_open_post      (konto_id)'     ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_openpost_udlign_id           ON tblA_open_post      (udlign_id)'    ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_ordrelinjer_id               ON tblA_order_lines    (id)'           ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_ordrelinjer_ordre_id         ON tblA_order_lines    (ordre_id)'     ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_ordrelinjer_vare_id          ON tblA_order_lines    (vare_id)'      ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_ordrer_art                   ON tblA_orders         (ord_art)'      ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_ordrer_betalt                ON tblA_orders         (betalt)'       ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_ordrer_id                    ON tblA_orders         (id)'           ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_ordrer_ordrenr               ON tblA_orders         (ordrenr)'      ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_pos_betalinger_ordre_id      ON tblA_pos_payments   (ordre_id)'     ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_pos_betalinger_betalingstype ON tblA_pos_payments   (betalingstype)',__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_transaktioner_id             ON tblA_transactions   (id)'           ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_transaktioner_transdate      ON tblA_transactions   (transdate)'    ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_transaktioner_kontonr        ON tblA_transactions   (kontonr)'      ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_varer_beskrivelse            ON tblA_product        (id)'           ,__FILE__, __LINE__);
  sql_creat('CREATE'.$or.' INDEX'.$if.' ix_varer_id                     ON tblA_product        (id)'           ,__FILE__, __LINE__);
};



function make_BaseData () { global $adm_username, $Ødb_Type, $db, $source, $Ødb_encode, $Øsqdb;

### Opret 1. BRUGER (=system-adm):
  // ?: $brugernavn,  $passwd, saldikrypt, $version
#+  sql_creat('INSERT INTO tblA_users (brugernavn,rettigheder,regnskabsaar)     VALUES ("'.$brugernavn.'","11111111111111111111",1)', __FILE__, __LINE__);
#+  $r= sql_readB('SELECT id FROM tblA_users WHERE brugernavn="'.$brugernavn.'"', __FILE__, __LINE__); //  $r=db_fetch_array(db_select("select id from users where brugernavn='$brugernavn'",__FILE__ . " linje " . __LINE__));
#+  $pw=saldikrypt($r[id],$passwd);
#+  sql_creat('UPDATE tblA_users SET kode ='.$pw.' WHERE id="'.$r[id].'"', __FILE__, __LINE__);
  
$adm_username= 'SaldiAdm';
$adm_password= 'SaldiPas';
$adm_passhash= password_hash($adm_password,PASSWORD_BCRYPT ); 

  echo ' Bruger m.v... ';
  sql_creat('INSERT INTO tblA_users  (brugernavn,kode,rettigheder,regnskabsaar)   VALUES ("'.$adm_username.'","'.$adm_passhash.'","11111111111111111111",1)', __FILE__, __LINE__);
  sql_creat('INSERT INTO tblA_groups (beskrivelse,grp_art,box1)                   VALUES ("Version","VE","$version")',   __FILE__, __LINE__);
  sql_creat('INSERT INTO tblA_groups (beskrivelse,kodenr,grp_art,box4,box5)       VALUES ("Div_valg","2","DIV","","")',  __FILE__, __LINE__);
  sql_creat('INSERT INTO tblA_groups (beskrivelse,kodenr,grp_art,box1,box2,box3,box4,box5,box6,box7,box8,box9,box10) 
                                                                                  VALUES ("Div_valg","3","DIV","","","","on","on","on","","","","")', __FILE__, __LINE__);
  sql_creat('INSERT INTO tblA_groups (beskrivelse,kode,kodenr,grp_art)            VALUES ("Dansk","DA","1","SPROG")',    __FILE__, __LINE__);
  sql_creat('INSERT INTO tblA_units  (betegnelse,beskrivelse)                     VALUES ("stk","styk")',                __FILE__, __LINE__);
  sql_creat('INSERT INTO tblA_groups (beskrivelse,kode,kodenr,grp_art,box1,box2)  VALUES ("Administratorer","","0","brgrp","","11111111")', __FILE__, __LINE__);

  $source= '../../_exchange/';
  
### Indlæs/Opret VAREGRUPPER:
    echo ' Varegrupper... ';
    if (file_exists($source."egne_grupper.csv")) 
         $fp= fopen($source."egne_grupper.csv","r");
    else $fp= fopen($source."_standard/grupper.csv","r");
    if ($fp) {
      while (!feof($fp)) { $linje=utf8_encode(fgets($fp));
        if ($linje && substr($linje,0,1)!='#') {
          if ($Ødb_encode!="UTF8") $linje= utf8_decode(trim($linje));
          sql_creat('INSERT INTO tblA_groups (beskrivelse,kode,kodenr,grp_art,box1,box2,box3,box4,box5,box6,box7,box8,box9,box10,box11,box12,box13,box14) '.
                    'VALUES ('.$linje.')', __FILE__, __LINE__);
        }
      }
      fclose($fp);
      if ($Øsqdb=='rotary') {  //  Forskudt regnskabsår: FIXIT: gøres alment!
        $startmd='07';        $slutmd='06';
        (date('m')>=7)?$startaar=date("Y"):$startaar=date("Y")-1;
        $slutaar=$startaar+1;
        $ra_besk=$startaar.'/'.$slutaar;
      } else {
        $startmd='01';        $slutmd='12';
        $startaar=date("Y");  $slutaar=date("Y");
        $ra_besk=$startaar;
      }
      sql_creat('INSERT INTO tblA_groups (beskrivelse,kode,kodenr,grp_art,box1,box2,box3,box4,box5,box6,box7,box8,box9,box10,box11,box12,box13,box14) '.
                'VALUES ("'.$ra_besk.'","'.'","1","RA","'.$startmd.'","'.$startaar.'","'.$slutmd.'","'.$slutaar.'","on","0","","","","","","","","")', __FILE__, __LINE__);
      //  db_modify("insert into grupper (beskrivelse,kode,kodenr,art,box1,box2,box3,box4,box5,box6,box7,box8,box9,box10,box11,box12,box13,box14) values ('$ra_besk','','1','RA','$startmd','$startaar','$slutmd','$slutaar','on','0','','','','','','','','')",__FILE__ . " linje " . __LINE__);
    } else echo ' Mislykket import af Grupper! ';

### Indlæs/Opret VARER:
    echo ' Varer... ';
    if (file_exists($source."egne_varer.txt")) {
      $fp= fopen($source."egne_varer.txt","r");
      if ($fp) {
        while (!feof($fp)) { $linje=fgets($fp);
          if ($linje && substr($linje,0,1)!="#") {
            if ($Ødb_encode!="UTF8") $linje= utf8_decode(trim($linje));
            sql_creat('INSERT INTO tblA_product (varenr,beskrivelse,gruppe,salgspris,kostpris,lukket) VALUES ('.$linje.')', __FILE__, __LINE__);
          }
        }
        fclose($fp);
      }
    }
    else echo ' Mislykket import af egne Varer! ';
    
### Indlæs/Opret FORMULARER:
   echo ' Formularer... ';
   $fp= fopen(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab','r');
   if ($fp) {
     while (!feof($fp)) { $linje= utf8_encode(fgets($fp));
        if ($linje && substr($linje,0,1)!="#") {
            if ($Ødb_encode!="UTF8") $linje= utf8_decode(trim($linje));
            $row= "'".str_replace(chr(9),"','",$linje)."'";   //  Indeholder tekster tegnet:' fejler rutinen!
            sql_creat('INSERT INTO tblA_forms (form, frm_art, side, besk, just, x0, y0, dx, dy, dim, colr, font, style, imglnk, lngkey, note) VALUES ( '.$row.')', __FILE__, __LINE__);
        }
     }
     fclose($fp);
   }
   else {echo ' Mislykket import af Formularer! ';}
   // $filDATA= ImportTabFile(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab');
   // foreach ($filDATA as $rec) {sql_creat('INSERT INTO tblA_forms '.$rec, __FILE__, __LINE__);}
   // sql_creat('LOAD DATA INFILE "'.realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/_standard/formularer.v50.tab'.'" INTO TABLE tblA_forms IGNORE 1 LINES', __FILE__, __LINE__);
    //  include_once("../../_base/spc_func.php"); //  formularimport()        formularimport($source."_standard/formularer.v50.tab");
    //  sql_creat('UPDATE tblA_forms SET sprog = "Dansk"', __FILE__, __LINE__);
    if ($fra_formular=false) {  // fra_formular ??
      sql_creat('INSERT INTO tblA_adress (firmanavn,addr1,addr2,postnr,bynavn,kontakt,tlf,email,cvrnr,adr_art)'.
                'VALUES("'.$firmanavn.'","'.$addr1.'","'.$addr2.'","'.$postnr.'","'.$bynavn.'","'.$kontakt.'","'.$tlf.'","'.$email.'","'.$cvrnr.'","S")', __FILE__, __LINE__);
    }
    // else ?
}
function TableImport($what='',$fn='',$qt='') {global $Ødb_encode;    //  $fn._standard/
 echo ' '.$what.'... ';
   $fp= fopen(realpath($_SERVER["DOCUMENT_ROOT"]). '/saldi-e/_exchange/'.$fn.'','r');
   if ($fp) {
     while (!feof($fp)) { $line= utf8_encode(fgets($fp));   //  HUSK at tal skal være i engelsk format: 123,456.78
        if ($line && substr($line,0,1)!="#") {              //  og tegnsæt skal være UTF8 - Linier startende med: # er kommentarer!
            if ($Ødb_encode!="UTF8") $line= (trim($line));  //  ? utf8_decode
            //  if (strpos('"'.chr(9),$line)) 
              { $line= str_replace('"'.chr(9),chr(9),$line); $line= str_replace(chr(9).'"',chr(9),$line); $line= trim($line,'"'); }  //  Fjern evt. feltafgrænser: "
            $row= "'".str_replace(chr(9),"','",$line)."'";   //  Indeholder tekster tegnet:' fejler rutinen!
            sql_creat('INSERT INTO '.$qt.'VALUES ( '.$row.')', __FILE__, __LINE__);
    } } fclose($fp);  }
   else {echo ' Mislykket import af '.$what.'! ';}
}

function make_Kontoplan ($std_kto_plan) { global $brugernavn, $Ødb_Type, $db, $source, $Ødb_encode;
### Indlæs/Opret KONTOPLAN:
  echo ' Kontoplan... ';
  $customFile= $source."egen_kontoplan.tab";
  $stdardFile= $source."_standard/kontoplan.tab";
  if ($std_kto_plan) {
    if (file_exists($customFile)) 
         { $fp= fopen($customFile,"r"); $source= $customFile;}
    else { $fp= fopen($stdardFile,"r"); $source= $stdardFile;}
    
    if ($fp) { $x=0;
      while (!feof($fp))   { $x++;  
        list($kontonr[$x], $beskrivelse[$x], $kontotype[$x], $moms[$x], $fra_kto[$x], $valuta[$x], $valutakurs[$x]) = explode(chr(9),utf8_encode(fgets($fp)));
        if (!$kontonr[$x]) { $x--;}
        if ($output= false) echo '<br>'.$kontonr[$x].' - '. $beskrivelse[$x];
      }
      $kontoantal= $x;
      for ($x=1; $x<=$kontoantal; $x++) {
        $beskrivelse[$x]= dbi_escape_string(trim(str_replace('"','',$beskrivelse[$x])));
        //  if ($Ødb_encode=="UTF8") $beskrivelse[$x]= utf8_encode($beskrivelse[$x]);
        $kontotype[$x]= trim(str_replace('"','',$kontotype[$x]));
        $moms[$x]=      trim(str_replace('"','',$moms[$x]));
        $fra_kto[$x]= $fra_kto[$x]*1;
        if (!$valuta[$x]) $valuta[$x]= '0';
        if (!$valutakurs[$x]) $valutakurs[$x]= '100';
        
        sql_creat('INSERT INTO tblA_account_plan (kontonr,beskrivelse,kontotype,fra_kto,moms,regnskabsaar,lukket,valuta,valutakurs) VALUES ("'.
                  $kontonr[$x].'","'.$beskrivelse[$x].'","'.$kontotype[$x].'","'.$fra_kto[$x].'","'.$moms[$x].'","1","","'.$valuta[$x].'","'.$valutakurs[$x].'")',  __FILE__, __LINE__);
      }
      fclose($fp);
      // Kontoplan oprettet på grundlag af $source
    }  // else 'Hverken '.$customFile.' eller '.$stdardFile.' kunne findes, hvorfor der ikke blev oprettet en kontoplan!'
  };  // else $std_kto_plan
};


?>
