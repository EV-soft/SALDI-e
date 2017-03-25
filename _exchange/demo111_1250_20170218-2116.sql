-- PostgreSQL database dump
--

-- SET statement_timeout = 0;
-- SET client_encoding = 'UTF8';
-- SET standard_conforming_strings = off;
-- SET check_function_bodies = false;
-- SET client_min_messages = warning;
-- SET escape_string_warning = off;

-- SET search_path = public, pg_catalog;

-- SET default_tablespace = '';

-- SET default_with_oids = false;

--
-- Name: adresser; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE adresser (
    id integer NOT NULL,
    firmanavn text,
    addr1 text,
    addr2 text,
    postnr text,
    bynavn text,
    land text,
    kontakt text,
    tlf text,
    fax text,
    email text,
    web text,
    bank_navn text,
    bank_reg text,
    bank_konto text,
    bank_fi text,
    erh text,
    swift text,
    notes text,
    rabat numeric(15,3),
    momskonto integer,
    kreditmax numeric(15,3),
    betalingsbet text,
    betalingsdage integer DEFAULT 0,
    kontonr text,
    cvrnr text,
    ean text,
    institution text,
    art character varying(2),
    gruppe integer,
    rabatgruppe integer,
    kontoansvarlig integer,
    oprettet date,
    kontaktet date,
    kontaktes date,
    pbs character varying(2),
    pbs_nr text,
    pbs_date date,
    mailfakt character varying(2),
    udskriv_til character varying(10),
    felt_1 text,
    felt_2 text,
    felt_3 text,
    felt_4 text,
    felt_5 text,
    vis_lev_addr character varying(2),
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
    lukket character varying(2),
    kategori text,
    saldo numeric(15,3)
);


-- ALTER TABLE public.adresser OWNER TO postgres;

--
-- Name: adresser_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE adresser_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.adresser_id_seq OWNER TO postgres;

--
-- Name: adresser_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE adresser_id_seq OWNED BY adresser.id;


--
-- Name: adresser_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('adresser_id_seq', 1, true);


--
-- Name: ansatmappe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ansatmappe (
    id integer NOT NULL,
    beskrivelse text,
    ans_id integer,
    sort numeric(15,0)
);


ALTER TABLE public.ansatmappe OWNER TO postgres;

--
-- Name: ansatmappe_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ansatmappe_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ansatmappe_id_seq OWNER TO postgres;

--
-- Name: ansatmappe_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ansatmappe_id_seq OWNED BY ansatmappe.id;


--
-- Name: ansatmappe_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ansatmappe_id_seq', 1, false);


--
-- Name: ansatmappebilag; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ansatmappebilag (
    id integer NOT NULL,
    navn text,
    beskrivelse text,
    datotid text,
    hvem text,
    assign_to text,
    assign_id integer,
    filtype text,
    sort numeric(15,0)
);


ALTER TABLE public.ansatmappebilag OWNER TO postgres;

--
-- Name: ansatmappebilag_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ansatmappebilag_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ansatmappebilag_id_seq OWNER TO postgres;

--
-- Name: ansatmappebilag_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ansatmappebilag_id_seq OWNED BY ansatmappebilag.id;


--
-- Name: ansatmappebilag_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ansatmappebilag_id_seq', 1, false);


--
-- Name: ansatte; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ansatte (
    id integer NOT NULL,
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
    lukket character varying(2),
    bank text,
    startdate date,
    slutdate date,
    gruppe numeric(15,3),
    extraloen numeric(15,3),
    trainee text,
    password text,
    overtid numeric(1,0),
    sag_id integer
);


ALTER TABLE public.ansatte OWNER TO postgres;

--
-- Name: ansatte_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ansatte_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ansatte_id_seq OWNER TO postgres;

--
-- Name: ansatte_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ansatte_id_seq OWNED BY ansatte.id;


--
-- Name: ansatte_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ansatte_id_seq', 1, false);


--
-- Name: batch_kob; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE batch_kob (
    id integer NOT NULL,
    kobsdate date,
    fakturadate date,
    vare_id integer,
    linje_id integer,
    ordre_id integer,
    pris numeric(15,3),
    antal numeric(15,3),
    rest numeric(15,3),
    lager integer
);


ALTER TABLE public.batch_kob OWNER TO postgres;

--
-- Name: batch_kob_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE batch_kob_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.batch_kob_id_seq OWNER TO postgres;

--
-- Name: batch_kob_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE batch_kob_id_seq OWNED BY batch_kob.id;


--
-- Name: batch_kob_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('batch_kob_id_seq', 1, false);


--
-- Name: batch_salg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE batch_salg (
    id integer NOT NULL,
    salgsdate date,
    fakturadate date,
    batch_kob_id integer,
    vare_id integer,
    linje_id integer,
    ordre_id integer,
    pris numeric(15,3),
    antal numeric(15,3),
    lev_nr integer,
    lager integer
);


ALTER TABLE public.batch_salg OWNER TO postgres;

--
-- Name: batch_salg_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE batch_salg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.batch_salg_id_seq OWNER TO postgres;

--
-- Name: batch_salg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE batch_salg_id_seq OWNED BY batch_salg.id;


--
-- Name: batch_salg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('batch_salg_id_seq', 1, false);


--
-- Name: betalinger; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE betalinger (
    id integer NOT NULL,
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
    liste_id integer
);


ALTER TABLE public.betalinger OWNER TO postgres;

--
-- Name: betalinger_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE betalinger_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.betalinger_id_seq OWNER TO postgres;

--
-- Name: betalinger_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE betalinger_id_seq OWNED BY betalinger.id;


--
-- Name: betalinger_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('betalinger_id_seq', 1, false);


--
-- Name: betalingsliste; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE betalingsliste (
    id integer NOT NULL,
    listedate date,
    udskriftsdate date,
    listenote text,
    bogfort character varying(2),
    oprettet_af text,
    bogfort_af text,
    hvem text,
    tidspkt text
);


ALTER TABLE public.betalingsliste OWNER TO postgres;

--
-- Name: betalingsliste_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE betalingsliste_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.betalingsliste_id_seq OWNER TO postgres;

--
-- Name: betalingsliste_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE betalingsliste_id_seq OWNED BY betalingsliste.id;


--
-- Name: betalingsliste_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('betalingsliste_id_seq', 1, false);


--
-- Name: bilag; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bilag (
    id integer NOT NULL,
    navn text,
    beskrivelse text,
    datotid text,
    hvem text,
    assign_to text,
    assign_id integer,
    fase numeric(15,3),
    kategori text,
    filtype text,
    bilag_fase text
);


ALTER TABLE public.bilag OWNER TO postgres;

--
-- Name: bilag_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE bilag_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.bilag_id_seq OWNER TO postgres;

--
-- Name: bilag_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE bilag_id_seq OWNED BY bilag.id;


--
-- Name: bilag_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('bilag_id_seq', 1, false);


--
-- Name: brugere; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE brugere (
    id integer NOT NULL,
    brugernavn text,
    kode text,
    tmp_kode text,
    status boolean,
    regnskabsaar integer,
    rettigheder text,
    ansat_id integer,
    sprog_id integer
);


ALTER TABLE public.brugere OWNER TO postgres;

--
-- Name: brugere_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE brugere_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.brugere_id_seq OWNER TO postgres;

--
-- Name: brugere_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE brugere_id_seq OWNED BY brugere.id;


--
-- Name: brugere_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('brugere_id_seq', 1, true);


--
-- Name: budget; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE budget (
    id integer NOT NULL,
    regnaar integer,
    md integer,
    kontonr numeric(15,0),
    amount numeric(15,0)
);


ALTER TABLE public.budget OWNER TO postgres;

--
-- Name: budget_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE budget_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.budget_id_seq OWNER TO postgres;

--
-- Name: budget_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE budget_id_seq OWNED BY budget.id;


--
-- Name: budget_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('budget_id_seq', 1, false);


--
-- Name: crm; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE crm (
    id integer NOT NULL,
    konto_id integer,
    kontakt_id integer,
    ansat_id integer,
    notat text,
    notedate date,
    spor text
);


ALTER TABLE public.crm OWNER TO postgres;

--
-- Name: crm_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE crm_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.crm_id_seq OWNER TO postgres;

--
-- Name: crm_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE crm_id_seq OWNED BY crm.id;


--
-- Name: crm_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('crm_id_seq', 1, false);


--
-- Name: enheder; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE enheder (
    id integer NOT NULL,
    betegnelse text,
    beskrivelse text
);


ALTER TABLE public.enheder OWNER TO postgres;

--
-- Name: enheder_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE enheder_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.enheder_id_seq OWNER TO postgres;

--
-- Name: enheder_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE enheder_id_seq OWNED BY enheder.id;


--
-- Name: enheder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('enheder_id_seq', 1, true);


--
-- Name: formularer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE formularer (
    id integer NOT NULL,
    formular integer,
    art integer,
    beskrivelse text,
    justering text,
    xa numeric(15,3),
    ya numeric(15,3),
    xb numeric(15,3),
    yb numeric(15,3),
    str numeric(15,3),
    color integer,
    font text,
    fed character varying(2),
    kursiv character varying(2),
    side character varying(2),
    sprog text
);


ALTER TABLE public.formularer OWNER TO postgres;

--
-- Name: formularer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE formularer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.formularer_id_seq OWNER TO postgres;

--
-- Name: formularer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE formularer_id_seq OWNED BY formularer.id;


--
-- Name: formularer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('formularer_id_seq', 537, true);


--
-- Name: grupper; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE grupper (
    id integer NOT NULL,
    beskrivelse text,
    kode text,
    kodenr text,
    art text,
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
    box14 text
);


ALTER TABLE public.grupper OWNER TO postgres;

--
-- Name: grupper_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE grupper_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.grupper_id_seq OWNER TO postgres;

--
-- Name: grupper_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE grupper_id_seq OWNED BY grupper.id;


--
-- Name: grupper_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('grupper_id_seq', 30, true);


--
-- Name: historik; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE historik (
    id integer NOT NULL,
    konto_id integer,
    kontakt_id integer,
    ansat_id integer,
    notat text,
    notedate date,
    kontaktet date,
    kontaktes date,
    dokument text
);


ALTER TABLE public.historik OWNER TO postgres;

--
-- Name: historik_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE historik_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.historik_id_seq OWNER TO postgres;

--
-- Name: historik_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE historik_id_seq OWNED BY historik.id;


--
-- Name: historik_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('historik_id_seq', 1, false);


--
-- Name: jobkort; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE jobkort (
    id integer NOT NULL,
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
    felt_11 text
);


ALTER TABLE public.jobkort OWNER TO postgres;

--
-- Name: jobkort_felter; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE jobkort_felter (
    id integer NOT NULL,
    job_id integer,
    art text,
    feltnr integer,
    subnr integer,
    feltnavn text,
    indhold text
);


ALTER TABLE public.jobkort_felter OWNER TO postgres;

--
-- Name: jobkort_felter_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE jobkort_felter_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.jobkort_felter_id_seq OWNER TO postgres;

--
-- Name: jobkort_felter_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE jobkort_felter_id_seq OWNED BY jobkort_felter.id;


--
-- Name: jobkort_felter_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('jobkort_felter_id_seq', 1, false);


--
-- Name: jobkort_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE jobkort_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.jobkort_id_seq OWNER TO postgres;

--
-- Name: jobkort_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE jobkort_id_seq OWNED BY jobkort.id;


--
-- Name: jobkort_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('jobkort_id_seq', 1, false);


--
-- Name: kassekladde; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE kassekladde (
    id integer NOT NULL,
    bilag integer,
    transdate date,
    beskrivelse text,
    d_type character varying(1),
    debet numeric(15,0),
    k_type character varying(1),
    kredit numeric(15,0),
    faktura text,
    amount numeric(15,3),
    kladde_id integer,
    momsfri character varying(2),
    medarb integer,
    ansat text,
    afd integer,
    projekt text,
    valuta integer,
    valutakurs numeric(15,3),
    ordre_id integer,
    forfaldsdate date,
    betal_id text,
    dokument text
);


ALTER TABLE public.kassekladde OWNER TO postgres;

--
-- Name: kassekladde_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE kassekladde_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.kassekladde_id_seq OWNER TO postgres;

--
-- Name: kassekladde_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE kassekladde_id_seq OWNED BY kassekladde.id;


--
-- Name: kassekladde_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('kassekladde_id_seq', 1, false);


--
-- Name: kladdeliste; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE kladdeliste (
    id integer NOT NULL,
    kladdedate date,
    bogforingsdate date,
    kladdenote text,
    bogfort character varying(2),
    oprettet_af text,
    bogfort_af text,
    hvem text,
    tidspkt text
);


ALTER TABLE public.kladdeliste OWNER TO postgres;

--
-- Name: kladdeliste_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE kladdeliste_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.kladdeliste_id_seq OWNER TO postgres;

--
-- Name: kladdeliste_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE kladdeliste_id_seq OWNED BY kladdeliste.id;


--
-- Name: kladdeliste_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('kladdeliste_id_seq', 1, false);


--
-- Name: kontokort; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE kontokort (
    id integer NOT NULL,
    ref_id integer,
    faktnr integer,
    refnr integer,
    beskrivelse text,
    kredit numeric(15,0),
    debet numeric(15,0),
    transdate date
);


ALTER TABLE public.kontokort OWNER TO postgres;

--
-- Name: kontokort_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE kontokort_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.kontokort_id_seq OWNER TO postgres;

--
-- Name: kontokort_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE kontokort_id_seq OWNED BY kontokort.id;


--
-- Name: kontokort_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('kontokort_id_seq', 1, false);


--
-- Name: kontoplan; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE kontoplan (
    id integer NOT NULL,
    kontonr numeric(15,0),
    beskrivelse text,
    kontotype character varying(1),
    moms text,
    fra_kto numeric(15,0),
    til_kto numeric(15,0),
    lukket character varying(2),
    primo numeric(15,3),
    saldo numeric(15,3),
    regnskabsaar integer,
    genvej character varying(2),
    overfor_til numeric(15,0),
    anvendelse text,
    modkonto numeric(15,0),
    valuta integer,
    valutakurs numeric(15,4)
);


ALTER TABLE public.kontoplan OWNER TO postgres;

--
-- Name: kontoplan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE kontoplan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.kontoplan_id_seq OWNER TO postgres;

--
-- Name: kontoplan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE kontoplan_id_seq OWNED BY kontoplan.id;


--
-- Name: kontoplan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('kontoplan_id_seq', 223, true);


--
-- Name: kostpriser; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE kostpriser (
    id integer NOT NULL,
    vare_id integer,
    transdate date,
    kostpris numeric(15,3)
);


ALTER TABLE public.kostpriser OWNER TO postgres;

--
-- Name: kostpriser_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE kostpriser_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.kostpriser_id_seq OWNER TO postgres;

--
-- Name: kostpriser_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE kostpriser_id_seq OWNED BY kostpriser.id;


--
-- Name: kostpriser_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('kostpriser_id_seq', 1, false);


--
-- Name: lagerstatus; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE lagerstatus (
    id integer NOT NULL,
    lager integer,
    vare_id integer,
    beholdning numeric(15,3),
    lok1 text,
    lok2 text,
    lok3 text,
    lok4 text,
    lok5 text
);


ALTER TABLE public.lagerstatus OWNER TO postgres;

--
-- Name: lagerstatus_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE lagerstatus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.lagerstatus_id_seq OWNER TO postgres;

--
-- Name: lagerstatus_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE lagerstatus_id_seq OWNED BY lagerstatus.id;


--
-- Name: lagerstatus_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('lagerstatus_id_seq', 1, false);


--
-- Name: loen; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE loen (
    id integer NOT NULL,
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
    art text,
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
    ferietil text
);


ALTER TABLE public.loen OWNER TO postgres;

--
-- Name: loen_enheder; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE loen_enheder (
    id integer NOT NULL,
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
    varenr text
);


ALTER TABLE public.loen_enheder OWNER TO postgres;

--
-- Name: loen_enheder_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE loen_enheder_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.loen_enheder_id_seq OWNER TO postgres;

--
-- Name: loen_enheder_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE loen_enheder_id_seq OWNED BY loen_enheder.id;


--
-- Name: loen_enheder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('loen_enheder_id_seq', 1, false);


--
-- Name: loen_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE loen_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.loen_id_seq OWNER TO postgres;

--
-- Name: loen_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE loen_id_seq OWNED BY loen.id;


--
-- Name: loen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('loen_id_seq', 1, false);


--
-- Name: mappe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mappe (
    id integer NOT NULL,
    beskrivelse text,
    sort numeric(15,0)
);


ALTER TABLE public.mappe OWNER TO postgres;

--
-- Name: mappe_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mappe_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mappe_id_seq OWNER TO postgres;

--
-- Name: mappe_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mappe_id_seq OWNED BY mappe.id;


--
-- Name: mappe_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mappe_id_seq', 1, false);


--
-- Name: mappebilag; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mappebilag (
    id integer NOT NULL,
    navn text,
    beskrivelse text,
    datotid text,
    hvem text,
    assign_to text,
    assign_id integer,
    filtype text,
    sort numeric(15,0)
);


ALTER TABLE public.mappebilag OWNER TO postgres;

--
-- Name: mappebilag_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE mappebilag_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.mappebilag_id_seq OWNER TO postgres;

--
-- Name: mappebilag_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE mappebilag_id_seq OWNED BY mappebilag.id;


--
-- Name: mappebilag_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('mappebilag_id_seq', 1, false);


--
-- Name: materialer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE materialer (
    id integer NOT NULL,
    beskrivelse text,
    densitet numeric(15,3),
    materialenr text,
    tykkelse numeric(15,3),
    kgpris numeric(15,3),
    avance numeric(15,3),
    enhed text,
    opdat_date date,
    opdat_time time without time zone
);


ALTER TABLE public.materialer OWNER TO postgres;

--
-- Name: materialer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE materialer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.materialer_id_seq OWNER TO postgres;

--
-- Name: materialer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE materialer_id_seq OWNED BY materialer.id;


--
-- Name: materialer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('materialer_id_seq', 1, false);


--
-- Name: modtageliste; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE modtageliste (
    id integer NOT NULL,
    initdate date,
    modtagdate date,
    modtagnote text,
    modtaget text,
    init_af text,
    modtaget_af text,
    hvem text,
    tidspkt text
);


ALTER TABLE public.modtageliste OWNER TO postgres;

--
-- Name: modtageliste_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE modtageliste_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.modtageliste_id_seq OWNER TO postgres;

--
-- Name: modtageliste_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE modtageliste_id_seq OWNED BY modtageliste.id;


--
-- Name: modtageliste_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('modtageliste_id_seq', 1, false);


--
-- Name: modtagelser; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE modtagelser (
    id integer NOT NULL,
    varenr text,
    beskrivelse text,
    leveres numeric(15,3),
    liste_id integer,
    lager numeric(15,3),
    ordre_id integer,
    vare_id integer,
    antal numeric(15,3)
);


ALTER TABLE public.modtagelser OWNER TO postgres;

--
-- Name: modtagelser_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE modtagelser_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.modtagelser_id_seq OWNER TO postgres;

--
-- Name: modtagelser_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE modtagelser_id_seq OWNED BY modtagelser.id;


--
-- Name: modtagelser_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('modtagelser_id_seq', 1, false);


--
-- Name: navigator; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE navigator (
    bruger_id integer,
    session_id text,
    side text,
    returside text,
    konto_id integer,
    ordre_id integer,
    vare_id integer
);


ALTER TABLE public.navigator OWNER TO postgres;

--
-- Name: noter; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE noter (
    id integer NOT NULL,
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
    nr numeric(15,0)
);


ALTER TABLE public.noter OWNER TO postgres;

--
-- Name: noter_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE noter_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.noter_id_seq OWNER TO postgres;

--
-- Name: noter_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE noter_id_seq OWNED BY noter.id;


--
-- Name: noter_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('noter_id_seq', 1, false);


--
-- Name: openpost; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE openpost (
    id integer NOT NULL,
    konto_id integer,
    konto_nr text,
    faktnr text,
    amount numeric(15,3),
    refnr integer,
    beskrivelse text,
    udlignet character varying(2),
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
    betalings_id text
);


ALTER TABLE public.openpost OWNER TO postgres;

--
-- Name: openpost_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE openpost_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.openpost_id_seq OWNER TO postgres;

--
-- Name: openpost_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE openpost_id_seq OWNED BY openpost.id;


--
-- Name: openpost_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('openpost_id_seq', 1, false);


--
-- Name: opgaver; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE opgaver (
    id integer NOT NULL,
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
    opg_tilknyttil text
);


ALTER TABLE public.opgaver OWNER TO postgres;

--
-- Name: opgaver_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE opgaver_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.opgaver_id_seq OWNER TO postgres;

--
-- Name: opgaver_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE opgaver_id_seq OWNED BY opgaver.id;


--
-- Name: opgaver_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('opgaver_id_seq', 1, false);


--
-- Name: ordrelinjer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ordrelinjer (
    id integer NOT NULL,
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
    momsfri character varying(2),
    momssats numeric(15,3),
    kostpris numeric(15,3),
    samlevare character varying(2),
    projekt text,
    m_rabat numeric(15,3),
    rabatgruppe integer,
    folgevare integer,
    kdo character varying(2),
    rabatart character varying(10),
    variant_id text,
    procent numeric(15,3),
    omvbet character varying(2),
    saet integer,
    fast_db numeric(15,3),
    afd integer,
    lager integer,
    tilfravalg text
);


ALTER TABLE public.ordrelinjer OWNER TO postgres;

--
-- Name: ordrelinjer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ordrelinjer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ordrelinjer_id_seq OWNER TO postgres;

--
-- Name: ordrelinjer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ordrelinjer_id_seq OWNED BY ordrelinjer.id;


--
-- Name: ordrelinjer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ordrelinjer_id_seq', 1, false);


--
-- Name: ordrer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ordrer (
    id integer NOT NULL,
    konto_id integer,
    firmanavn text,
    addr1 text,
    addr2 text,
    postnr text,
    bynavn text,
    land text,
    kontakt text,
    email text,
    mail_fakt character varying(2),
    udskriv_til character varying(10),
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
    art character varying(2),
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
    betalt text,
    nextfakt date,
    pbs character varying(2),
    mail character varying(2),
    mail_cc text,
    mail_bcc text,
    mail_subj text,
    mail_text text,
    felt_1 text,
    felt_2 text,
    felt_3 text,
    felt_4 text,
    felt_5 text,
    vis_lev_addr character varying(2),
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
    mail_bilag character varying(2),
    omvbet character varying(2),
    afd integer,
    kontakt_tlf text
);


ALTER TABLE public.ordrer OWNER TO postgres;

--
-- Name: ordrer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ordrer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ordrer_id_seq OWNER TO postgres;

--
-- Name: ordrer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ordrer_id_seq OWNED BY ordrer.id;


--
-- Name: ordrer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ordrer_id_seq', 1, false);


--
-- Name: ordretekster; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ordretekster (
    id integer NOT NULL,
    tekst text,
    sort numeric(15,0)
);


ALTER TABLE public.ordretekster OWNER TO postgres;

--
-- Name: ordretekster_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ordretekster_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ordretekster_id_seq OWNER TO postgres;

--
-- Name: ordretekster_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ordretekster_id_seq OWNED BY ordretekster.id;


--
-- Name: ordretekster_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ordretekster_id_seq', 1, false);


--
-- Name: pbs_kunder; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pbs_kunder (
    id integer NOT NULL,
    konto_id integer,
    kontonr character varying(20),
    pbs_nr text
);


ALTER TABLE public.pbs_kunder OWNER TO postgres;

--
-- Name: pbs_kunder_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pbs_kunder_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pbs_kunder_id_seq OWNER TO postgres;

--
-- Name: pbs_kunder_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pbs_kunder_id_seq OWNED BY pbs_kunder.id;


--
-- Name: pbs_kunder_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pbs_kunder_id_seq', 1, false);


--
-- Name: pbs_linjer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pbs_linjer (
    id integer NOT NULL,
    liste_id integer,
    linje text
);


ALTER TABLE public.pbs_linjer OWNER TO postgres;

--
-- Name: pbs_linjer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pbs_linjer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pbs_linjer_id_seq OWNER TO postgres;

--
-- Name: pbs_linjer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pbs_linjer_id_seq OWNED BY pbs_linjer.id;


--
-- Name: pbs_linjer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pbs_linjer_id_seq', 1, false);


--
-- Name: pbs_liste; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pbs_liste (
    id integer NOT NULL,
    liste_date date,
    afsendt character varying(8)
);


ALTER TABLE public.pbs_liste OWNER TO postgres;

--
-- Name: pbs_liste_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pbs_liste_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pbs_liste_id_seq OWNER TO postgres;

--
-- Name: pbs_liste_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pbs_liste_id_seq OWNED BY pbs_liste.id;


--
-- Name: pbs_liste_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pbs_liste_id_seq', 1, false);


--
-- Name: pbs_ordrer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pbs_ordrer (
    id integer NOT NULL,
    liste_id integer,
    ordre_id integer
);


ALTER TABLE public.pbs_ordrer OWNER TO postgres;

--
-- Name: pbs_ordrer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pbs_ordrer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pbs_ordrer_id_seq OWNER TO postgres;

--
-- Name: pbs_ordrer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pbs_ordrer_id_seq OWNED BY pbs_ordrer.id;


--
-- Name: pbs_ordrer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pbs_ordrer_id_seq', 1, false);


--
-- Name: pos_betalinger; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pos_betalinger (
    id integer NOT NULL,
    ordre_id integer,
    betalingstype text,
    amount numeric(15,3),
    valuta character varying(3),
    valutakurs numeric(15,3)
);


ALTER TABLE public.pos_betalinger OWNER TO postgres;

--
-- Name: pos_betalinger_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pos_betalinger_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pos_betalinger_id_seq OWNER TO postgres;

--
-- Name: pos_betalinger_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pos_betalinger_id_seq OWNED BY pos_betalinger.id;


--
-- Name: pos_betalinger_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pos_betalinger_id_seq', 1, false);


--
-- Name: pos_buttons; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pos_buttons (
    id integer NOT NULL,
    menu_id integer,
    col numeric(2,0),
    "row" numeric(2,0),
    colspan numeric(1,0),
    rowspan numeric(1,0),
    beskrivelse text,
    vare_id numeric(10,0),
    funktion numeric(1,0),
    color character varying(6)
);


ALTER TABLE public.pos_buttons OWNER TO postgres;

--
-- Name: pos_buttons_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pos_buttons_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pos_buttons_id_seq OWNER TO postgres;

--
-- Name: pos_buttons_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pos_buttons_id_seq OWNED BY pos_buttons.id;


--
-- Name: pos_buttons_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pos_buttons_id_seq', 1, false);


--
-- Name: provision; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE provision (
    id integer NOT NULL,
    gruppe_id integer,
    ansat_id integer,
    provision numeric(15,3)
);


ALTER TABLE public.provision OWNER TO postgres;

--
-- Name: provision_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE provision_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.provision_id_seq OWNER TO postgres;

--
-- Name: provision_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE provision_id_seq OWNED BY provision.id;


--
-- Name: provision_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('provision_id_seq', 1, false);


--
-- Name: rabat; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rabat (
    id integer NOT NULL,
    rabat numeric(6,2),
    debitorart character varying(2),
    debitor integer,
    vareart character varying(2),
    vare integer,
    rabatart character varying(6)
);


ALTER TABLE public.rabat OWNER TO postgres;

--
-- Name: rabat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rabat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.rabat_id_seq OWNER TO postgres;

--
-- Name: rabat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rabat_id_seq OWNED BY rabat.id;


--
-- Name: rabat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rabat_id_seq', 1, false);


--
-- Name: regulering; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE regulering (
    id integer NOT NULL,
    vare_id integer,
    variant_id integer,
    lager integer,
    beholdning numeric(15,3),
    optalt numeric(15,3),
    tidspkt text,
    bogfort boolean,
    transdate date,
    logtime time without time zone,
    bogfort_af text
);


ALTER TABLE public.regulering OWNER TO postgres;

--
-- Name: regulering_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE regulering_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.regulering_id_seq OWNER TO postgres;

--
-- Name: regulering_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE regulering_id_seq OWNED BY regulering.id;


--
-- Name: regulering_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('regulering_id_seq', 1, false);


--
-- Name: reservation; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE reservation (
    linje_id integer,
    batch_kob_id integer,
    batch_salg_id integer,
    vare_id integer,
    antal numeric(15,3),
    lager integer
);


ALTER TABLE public.reservation OWNER TO postgres;

--
-- Name: sager; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sager (
    id integer NOT NULL,
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
    beregn_beskrivelse text
);


ALTER TABLE public.sager OWNER TO postgres;

--
-- Name: sager_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sager_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sager_id_seq OWNER TO postgres;

--
-- Name: sager_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sager_id_seq OWNED BY sager.id;


--
-- Name: sager_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sager_id_seq', 1, false);


--
-- Name: sagstekster; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sagstekster (
    id integer NOT NULL,
    tekstnr numeric(15,0),
    beskrivelse text,
    tekst text
);


ALTER TABLE public.sagstekster OWNER TO postgres;

--
-- Name: sagstekster_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sagstekster_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sagstekster_id_seq OWNER TO postgres;

--
-- Name: sagstekster_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sagstekster_id_seq OWNED BY sagstekster.id;


--
-- Name: sagstekster_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sagstekster_id_seq', 1, false);


--
-- Name: serienr; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE serienr (
    id integer NOT NULL,
    vare_id integer,
    kobslinje_id integer,
    salgslinje_id integer,
    batch_kob_id integer,
    batch_salg_id integer,
    serienr text
);


ALTER TABLE public.serienr OWNER TO postgres;

--
-- Name: serienr_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE serienr_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.serienr_id_seq OWNER TO postgres;

--
-- Name: serienr_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE serienr_id_seq OWNED BY serienr.id;


--
-- Name: serienr_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('serienr_id_seq', 1, false);


--
-- Name: shop_adresser; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE shop_adresser (
    id integer NOT NULL,
    saldi_id integer,
    shop_id integer
);


ALTER TABLE public.shop_adresser OWNER TO postgres;

--
-- Name: shop_adresser_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE shop_adresser_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.shop_adresser_id_seq OWNER TO postgres;

--
-- Name: shop_adresser_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE shop_adresser_id_seq OWNED BY shop_adresser.id;


--
-- Name: shop_adresser_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('shop_adresser_id_seq', 1, false);


--
-- Name: shop_ordrer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE shop_ordrer (
    id integer NOT NULL,
    saldi_id integer,
    shop_id integer
);


ALTER TABLE public.shop_ordrer OWNER TO postgres;

--
-- Name: shop_ordrer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE shop_ordrer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.shop_ordrer_id_seq OWNER TO postgres;

--
-- Name: shop_ordrer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE shop_ordrer_id_seq OWNED BY shop_ordrer.id;


--
-- Name: shop_ordrer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('shop_ordrer_id_seq', 1, false);


--
-- Name: shop_varer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE shop_varer (
    id integer NOT NULL,
    saldi_id integer,
    shop_id integer
);


ALTER TABLE public.shop_varer OWNER TO postgres;

--
-- Name: shop_varer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE shop_varer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.shop_varer_id_seq OWNER TO postgres;

--
-- Name: shop_varer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE shop_varer_id_seq OWNED BY shop_varer.id;


--
-- Name: shop_varer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('shop_varer_id_seq', 1, false);


--
-- Name: simulering; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE simulering (
    id integer NOT NULL,
    kontonr numeric(15,0),
    bilag numeric(15,0),
    transdate date,
    beskrivelse text,
    debet numeric(15,3),
    kredit numeric(15,3),
    faktura text,
    kladde_id integer,
    projekt text,
    ansat numeric(15,0),
    logdate date,
    logtime time without time zone,
    afd integer,
    ordre_id integer,
    valuta text,
    valutakurs numeric(15,3),
    moms numeric(15,3),
    adresser_id integer
);


ALTER TABLE public.simulering OWNER TO postgres;

--
-- Name: simulering_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE simulering_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.simulering_id_seq OWNER TO postgres;

--
-- Name: simulering_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE simulering_id_seq OWNED BY simulering.id;


--
-- Name: simulering_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('simulering_id_seq', 1, false);


--
-- Name: styklister; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE styklister (
    id integer NOT NULL,
    vare_id integer,
    indgaar_i integer,
    antal numeric(15,3),
    posnr integer
);


ALTER TABLE public.styklister OWNER TO postgres;

--
-- Name: styklister_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE styklister_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.styklister_id_seq OWNER TO postgres;

--
-- Name: styklister_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE styklister_id_seq OWNED BY styklister.id;


--
-- Name: styklister_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('styklister_id_seq', 1, false);


--
-- Name: tabeller; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tabeller (
    id integer NOT NULL,
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
    circ_time integer
);


ALTER TABLE public.tabeller OWNER TO postgres;

--
-- Name: tabeller_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tabeller_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tabeller_id_seq OWNER TO postgres;

--
-- Name: tabeller_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tabeller_id_seq OWNED BY tabeller.id;


--
-- Name: tabeller_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tabeller_id_seq', 1, false);


--
-- Name: tekster; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tekster (
    id integer NOT NULL,
    sprog_id integer,
    tekst_id integer,
    tekst text
);


ALTER TABLE public.tekster OWNER TO postgres;

--
-- Name: tekster_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tekster_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tekster_id_seq OWNER TO postgres;

--
-- Name: tekster_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tekster_id_seq OWNED BY tekster.id;


--
-- Name: tekster_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tekster_id_seq', 313, true);


--
-- Name: tidsreg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tidsreg (
    id integer NOT NULL,
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
    circ_time integer
);


ALTER TABLE public.tidsreg OWNER TO postgres;

--
-- Name: tidsreg_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tidsreg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tidsreg_id_seq OWNER TO postgres;

--
-- Name: tidsreg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tidsreg_id_seq OWNED BY tidsreg.id;


--
-- Name: tidsreg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tidsreg_id_seq', 1, false);


--
-- Name: tjekliste; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tjekliste (
    id integer NOT NULL,
    tjekpunkt text,
    fase numeric(15,3),
    assign_to text,
    assign_id integer,
    sagsnr text
);


ALTER TABLE public.tjekliste OWNER TO postgres;

--
-- Name: tjekliste_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tjekliste_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tjekliste_id_seq OWNER TO postgres;

--
-- Name: tjekliste_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tjekliste_id_seq OWNED BY tjekliste.id;


--
-- Name: tjekliste_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tjekliste_id_seq', 1, false);


--
-- Name: tjekpunkter; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tjekpunkter (
    id integer NOT NULL,
    tjekliste_id integer,
    assign_id integer,
    status integer,
    status_tekst text,
    tjekskema_id integer
);


ALTER TABLE public.tjekpunkter OWNER TO postgres;

--
-- Name: tjekpunkter_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tjekpunkter_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tjekpunkter_id_seq OWNER TO postgres;

--
-- Name: tjekpunkter_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tjekpunkter_id_seq OWNED BY tjekpunkter.id;


--
-- Name: tjekpunkter_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tjekpunkter_id_seq', 1, false);


--
-- Name: tjekskema; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tjekskema (
    id integer NOT NULL,
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
    sjakid text
);


ALTER TABLE public.tjekskema OWNER TO postgres;

--
-- Name: tjekskema_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tjekskema_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.tjekskema_id_seq OWNER TO postgres;

--
-- Name: tjekskema_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tjekskema_id_seq OWNED BY tjekskema.id;


--
-- Name: tjekskema_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tjekskema_id_seq', 1, false);


--
-- Name: tmpkassekl; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tmpkassekl (
    id integer,
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
    dokument text
);


ALTER TABLE public.tmpkassekl OWNER TO postgres;

--
-- Name: transaktioner; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE transaktioner (
    id integer NOT NULL,
    kontonr numeric(15,0),
    bilag numeric(15,0),
    transdate date,
    logtime time without time zone,
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
    adresser_id integer,
    kasse_nr numeric(15,0)
);


ALTER TABLE public.transaktioner OWNER TO postgres;

--
-- Name: transaktioner_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE transaktioner_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.transaktioner_id_seq OWNER TO postgres;

--
-- Name: transaktioner_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE transaktioner_id_seq OWNED BY transaktioner.id;


--
-- Name: transaktioner_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('transaktioner_id_seq', 1, false);


--
-- Name: valuta; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE valuta (
    id integer NOT NULL,
    gruppe integer,
    valdate date,
    kurs numeric(15,3)
);


ALTER TABLE public.valuta OWNER TO postgres;

--
-- Name: valuta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE valuta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.valuta_id_seq OWNER TO postgres;

--
-- Name: valuta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE valuta_id_seq OWNED BY valuta.id;


--
-- Name: valuta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('valuta_id_seq', 2, true);


--
-- Name: vare_lev; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE vare_lev (
    id integer NOT NULL,
    posnr integer,
    lev_id integer,
    vare_id integer,
    lev_varenr text,
    kostpris numeric(15,3)
);


ALTER TABLE public.vare_lev OWNER TO postgres;

--
-- Name: vare_lev_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE vare_lev_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.vare_lev_id_seq OWNER TO postgres;

--
-- Name: vare_lev_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE vare_lev_id_seq OWNED BY vare_lev.id;


--
-- Name: vare_lev_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('vare_lev_id_seq', 1, false);


--
-- Name: varer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE varer (
    id integer NOT NULL,
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
    provisionsfri character varying(2),
    notes text,
    lukket character varying(2),
    serienr text,
    beholdning numeric(15,3),
    samlevare character varying(2),
    delvare character varying(2),
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
    special_from_time time without time zone,
    special_to_time time without time zone,
    komplementaer text,
    circulate integer,
    operation integer,
    prisgruppe integer,
    tilbudgruppe integer,
    rabatgruppe integer,
    dvrg integer,
    m_type character varying(10),
    m_rabat text,
    m_antal text,
    folgevare text,
    kategori text,
    varianter text,
    publiceret character varying(2),
    fotonavn text,
    tilbudsdage text
);


ALTER TABLE public.varer OWNER TO postgres;

--
-- Name: varer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE varer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.varer_id_seq OWNER TO postgres;

--
-- Name: varer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE varer_id_seq OWNED BY varer.id;


--
-- Name: varer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('varer_id_seq', 1, true);


--
-- Name: varetekster; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE varetekster (
    id integer NOT NULL,
    sprog_id integer,
    vare_id integer,
    tekst text
);


ALTER TABLE public.varetekster OWNER TO postgres;

--
-- Name: varetekster_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE varetekster_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.varetekster_id_seq OWNER TO postgres;

--
-- Name: varetekster_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE varetekster_id_seq OWNED BY varetekster.id;


--
-- Name: varetekster_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('varetekster_id_seq', 1, false);


--
-- Name: varetilbud; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE varetilbud (
    id integer NOT NULL,
    vare_id integer,
    startdag numeric(15,0),
    slutdag numeric(15,0),
    starttid time without time zone,
    sluttid time without time zone,
    ugedag integer,
    salgspris numeric(15,2),
    kostpris numeric(15,2)
);


ALTER TABLE public.varetilbud OWNER TO postgres;

--
-- Name: varetilbud_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE varetilbud_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.varetilbud_id_seq OWNER TO postgres;

--
-- Name: varetilbud_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE varetilbud_id_seq OWNED BY varetilbud.id;


--
-- Name: varetilbud_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('varetilbud_id_seq', 1, false);


--
-- Name: variant_typer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE variant_typer (
    id integer NOT NULL,
    variant_id integer,
    shop_id integer,
    beskrivelse text
);


ALTER TABLE public.variant_typer OWNER TO postgres;

--
-- Name: variant_typer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE variant_typer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.variant_typer_id_seq OWNER TO postgres;

--
-- Name: variant_typer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE variant_typer_id_seq OWNED BY variant_typer.id;


--
-- Name: variant_typer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('variant_typer_id_seq', 1, false);


--
-- Name: variant_varer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE variant_varer (
    id integer NOT NULL,
    vare_id integer,
    variant_type text,
    variant_beholdning numeric(15,3),
    variant_stregkode text,
    lager integer
);


ALTER TABLE public.variant_varer OWNER TO postgres;

--
-- Name: variant_varer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE variant_varer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.variant_varer_id_seq OWNER TO postgres;

--
-- Name: variant_varer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE variant_varer_id_seq OWNED BY variant_varer.id;


--
-- Name: variant_varer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('variant_varer_id_seq', 1, false);


--
-- Name: varianter; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE varianter (
    id integer NOT NULL,
    beskrivelse text,
    shop_id integer
);


ALTER TABLE public.varianter OWNER TO postgres;

--
-- Name: varianter_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE varianter_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.varianter_id_seq OWNER TO postgres;

--
-- Name: varianter_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE varianter_id_seq OWNED BY varianter.id;


--
-- Name: varianter_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('varianter_id_seq', 1, false);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY adresser ALTER COLUMN id SET DEFAULT nextval('adresser_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ansatmappe ALTER COLUMN id SET DEFAULT nextval('ansatmappe_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ansatmappebilag ALTER COLUMN id SET DEFAULT nextval('ansatmappebilag_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ansatte ALTER COLUMN id SET DEFAULT nextval('ansatte_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY batch_kob ALTER COLUMN id SET DEFAULT nextval('batch_kob_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY batch_salg ALTER COLUMN id SET DEFAULT nextval('batch_salg_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY betalinger ALTER COLUMN id SET DEFAULT nextval('betalinger_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY betalingsliste ALTER COLUMN id SET DEFAULT nextval('betalingsliste_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bilag ALTER COLUMN id SET DEFAULT nextval('bilag_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY brugere ALTER COLUMN id SET DEFAULT nextval('brugere_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY budget ALTER COLUMN id SET DEFAULT nextval('budget_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY crm ALTER COLUMN id SET DEFAULT nextval('crm_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY enheder ALTER COLUMN id SET DEFAULT nextval('enheder_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY formularer ALTER COLUMN id SET DEFAULT nextval('formularer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupper ALTER COLUMN id SET DEFAULT nextval('grupper_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY historik ALTER COLUMN id SET DEFAULT nextval('historik_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY jobkort ALTER COLUMN id SET DEFAULT nextval('jobkort_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY jobkort_felter ALTER COLUMN id SET DEFAULT nextval('jobkort_felter_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY kassekladde ALTER COLUMN id SET DEFAULT nextval('kassekladde_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY kladdeliste ALTER COLUMN id SET DEFAULT nextval('kladdeliste_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY kontokort ALTER COLUMN id SET DEFAULT nextval('kontokort_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY kontoplan ALTER COLUMN id SET DEFAULT nextval('kontoplan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY kostpriser ALTER COLUMN id SET DEFAULT nextval('kostpriser_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lagerstatus ALTER COLUMN id SET DEFAULT nextval('lagerstatus_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY loen ALTER COLUMN id SET DEFAULT nextval('loen_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY loen_enheder ALTER COLUMN id SET DEFAULT nextval('loen_enheder_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mappe ALTER COLUMN id SET DEFAULT nextval('mappe_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mappebilag ALTER COLUMN id SET DEFAULT nextval('mappebilag_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY materialer ALTER COLUMN id SET DEFAULT nextval('materialer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY modtageliste ALTER COLUMN id SET DEFAULT nextval('modtageliste_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY modtagelser ALTER COLUMN id SET DEFAULT nextval('modtagelser_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noter ALTER COLUMN id SET DEFAULT nextval('noter_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY openpost ALTER COLUMN id SET DEFAULT nextval('openpost_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY opgaver ALTER COLUMN id SET DEFAULT nextval('opgaver_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ordrelinjer ALTER COLUMN id SET DEFAULT nextval('ordrelinjer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ordrer ALTER COLUMN id SET DEFAULT nextval('ordrer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ordretekster ALTER COLUMN id SET DEFAULT nextval('ordretekster_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pbs_kunder ALTER COLUMN id SET DEFAULT nextval('pbs_kunder_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pbs_linjer ALTER COLUMN id SET DEFAULT nextval('pbs_linjer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pbs_liste ALTER COLUMN id SET DEFAULT nextval('pbs_liste_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pbs_ordrer ALTER COLUMN id SET DEFAULT nextval('pbs_ordrer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pos_betalinger ALTER COLUMN id SET DEFAULT nextval('pos_betalinger_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pos_buttons ALTER COLUMN id SET DEFAULT nextval('pos_buttons_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY provision ALTER COLUMN id SET DEFAULT nextval('provision_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rabat ALTER COLUMN id SET DEFAULT nextval('rabat_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY regulering ALTER COLUMN id SET DEFAULT nextval('regulering_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sager ALTER COLUMN id SET DEFAULT nextval('sager_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sagstekster ALTER COLUMN id SET DEFAULT nextval('sagstekster_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY serienr ALTER COLUMN id SET DEFAULT nextval('serienr_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY shop_adresser ALTER COLUMN id SET DEFAULT nextval('shop_adresser_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY shop_ordrer ALTER COLUMN id SET DEFAULT nextval('shop_ordrer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY shop_varer ALTER COLUMN id SET DEFAULT nextval('shop_varer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY simulering ALTER COLUMN id SET DEFAULT nextval('simulering_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY styklister ALTER COLUMN id SET DEFAULT nextval('styklister_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tabeller ALTER COLUMN id SET DEFAULT nextval('tabeller_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tekster ALTER COLUMN id SET DEFAULT nextval('tekster_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tidsreg ALTER COLUMN id SET DEFAULT nextval('tidsreg_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tjekliste ALTER COLUMN id SET DEFAULT nextval('tjekliste_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tjekpunkter ALTER COLUMN id SET DEFAULT nextval('tjekpunkter_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tjekskema ALTER COLUMN id SET DEFAULT nextval('tjekskema_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transaktioner ALTER COLUMN id SET DEFAULT nextval('transaktioner_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY valuta ALTER COLUMN id SET DEFAULT nextval('valuta_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vare_lev ALTER COLUMN id SET DEFAULT nextval('vare_lev_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY varer ALTER COLUMN id SET DEFAULT nextval('varer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY varetekster ALTER COLUMN id SET DEFAULT nextval('varetekster_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY varetilbud ALTER COLUMN id SET DEFAULT nextval('varetilbud_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY variant_typer ALTER COLUMN id SET DEFAULT nextval('variant_typer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY variant_varer ALTER COLUMN id SET DEFAULT nextval('variant_varer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY varianter ALTER COLUMN id SET DEFAULT nextval('varianter_id_seq'::regclass);


--
-- Data for Name: adresser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY adresser (id, firmanavn, addr1, addr2, postnr, bynavn, land, kontakt, tlf, fax, email, web, bank_navn, bank_reg, bank_konto, bank_fi, erh, swift, notes, rabat, momskonto, kreditmax, betalingsbet, betalingsdage, kontonr, cvrnr, ean, institution, art, gruppe, rabatgruppe, kontoansvarlig, oprettet, kontaktet, kontaktes, pbs, pbs_nr, pbs_date, mailfakt, udskriv_til, felt_1, felt_2, felt_3, felt_4, felt_5, vis_lev_addr, kontotype, fornavn, efternavn, lev_firmanavn, lev_fornavn, lev_efternavn, lev_addr1, lev_addr2, lev_postnr, lev_bynavn, lev_land, lev_kontakt, lev_tlf, lev_email, status, lukket, kategori, saldo) FROM stdin;
1	ewqed		wewf			adfd										ERH351		sdf	\N	\N	0.000	Netto	8	222		\N	\N	K	1	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N						\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N		\N	\N
\.


--
-- Data for Name: ansatmappe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ansatmappe (id, beskrivelse, ans_id, sort) FROM stdin;
\.


--
-- Data for Name: ansatmappebilag; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ansatmappebilag (id, navn, beskrivelse, datotid, hvem, assign_to, assign_id, filtype, sort) FROM stdin;
\.


--
-- Data for Name: ansatte; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ansatte (id, konto_id, navn, addr1, addr2, postnr, bynavn, tlf, fax, mobil, privattlf, initialer, email, notes, cprnr, posnr, afd, provision, nummer, loen, hold, lukket, bank, startdate, slutdate, gruppe, extraloen, trainee, password, overtid, sag_id) FROM stdin;
\.


--
-- Data for Name: batch_kob; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY batch_kob (id, kobsdate, fakturadate, vare_id, linje_id, ordre_id, pris, antal, rest, lager) FROM stdin;
\.


--
-- Data for Name: batch_salg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY batch_salg (id, salgsdate, fakturadate, batch_kob_id, vare_id, linje_id, ordre_id, pris, antal, lev_nr, lager) FROM stdin;
\.


--
-- Data for Name: betalinger; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY betalinger (id, bet_type, fra_kto, egen_ref, til_kto, modt_navn, belob, betalingsdato, valuta, kort_ref, kvittering, ordre_id, bilag_id, liste_id) FROM stdin;
\.


--
-- Data for Name: betalingsliste; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY betalingsliste (id, listedate, udskriftsdate, listenote, bogfort, oprettet_af, bogfort_af, hvem, tidspkt) FROM stdin;
\.


--
-- Data for Name: bilag; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY bilag (id, navn, beskrivelse, datotid, hvem, assign_to, assign_id, fase, kategori, filtype, bilag_fase) FROM stdin;
\.


--
-- Data for Name: brugere; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY brugere (id, brugernavn, kode, tmp_kode, status, regnskabsaar, rettigheder, ansat_id, sprog_id) FROM stdin;
1	admin	61152c80d1514e22fba66002597d0104	\N	\N	1	11111111111111111111	\N	\N
\.


--
-- Data for Name: budget; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY budget (id, regnaar, md, kontonr, amount) FROM stdin;
\.


--
-- Data for Name: crm; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY crm (id, konto_id, kontakt_id, ansat_id, notat, notedate, spor) FROM stdin;
\.


--
-- Data for Name: enheder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY enheder (id, betegnelse, beskrivelse) FROM stdin;
1	stk	styk
\.


--
-- Data for Name: formularer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY formularer (id, formular, art, beskrivelse, justering, xa, ya, xb, yb, str, color, font, fed, kursiv, side, sprog) FROM stdin;
1	1	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
2	1	1			166.000	69.000	184.000	69.000	1.000	0					Dansk
3	1	1			23.000	190.000	23.000	76.000	1.000	0					Dansk
4	1	1			23.000	76.000	184.000	76.000	1.000	0					Dansk
5	1	1			23.000	190.000	184.000	190.000	1.000	0					Dansk
6	1	1			166.000	55.000	184.000	55.000	1.000	0					Dansk
7	1	1			166.000	190.000	166.000	55.000	1.000	0					Dansk
8	1	1			166.000	62.000	184.000	62.000	1.000	0					Dansk
9	1	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
10	1	1			184.000	190.000	184.000	55.000	1.000	0					Dansk
11	1	2	$egen_addr1	V	26.000	37.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
12	1	2	$egen_bank_navn	H	183.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
13	1	2	$egen_bank_reg $egen_bank_konto	H	183.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
480	14	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
14	1	2	$eget_firmanavn	V	26.000	41.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
15	1	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
16	1	2	$formular_ialt	H	183.000	56.000	0.000	0.000	10.000	0	Helvetica	on		S	Dansk
17	1	2	$formular_moms	H	183.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
18	1	2	$formular_side	V	160.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
19	1	2	$formular_sum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
20	1	2	$formular_transportsum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
21	1	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
22	1	2	$ordre_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
23	1	2	$ordre_fakturanr	V	160.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
24	1	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
25	1	2	$ordre_momssats;% moms	V	132.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
26	1	2	$ordre_ordredate;	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
27	1	2	$ordre_ordrenr	V	60.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
28	1	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
29	1	2	Antal	C	148.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
30	1	2	Beskrivelse	V	55.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
31	1	2	CVR nr: $eget_cvrnr	H	183.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
32	1	2	Danmark	V	26.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
33	1	2	Dato	V	120.000	234.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
34	1	2	Deres ordre nr	V	26.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
35	1	2	Deres ref:	V	26.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
36	1	2	DK-$eget_postnr $eget_bynavn	V	26.000	33.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
37	1	2	Fax: $egen_fax	V	26.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
38	1	2	I alt	V	132.000	56.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
39	1	2	Nettosum	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
40	1	2	Nummer	V	120.000	238.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
41	1	2	Pris	V	158.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
42	1	2	Side	V	120.000	230.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
43	1	2	Sum	V	175.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
44	1	2	Tilbud	V	120.000	244.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
45	1	2	Tlf:. $egen_tlf	V	26.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
46	1	2	Transport til side $formular_nextside	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
47	1	2	Varenr	V	26.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
48	1	3	antal	H	148.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
49	1	3	beskrivelse	V	56.000	0.000	52.000	0.000	10.000	0	Helvetica				Dansk
50	1	3	generelt		28.000	185.000	4.000	0.000	0.000	0					Dansk
51	1	3	linjesum	H	183.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
52	1	3	pris	H	165.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
53	1	3	varenr	V	26.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
54	2	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
55	2	1			166.000	62.000	184.000	62.000	1.000	0					Dansk
56	2	1			166.000	69.000	184.000	69.000	1.000	0					Dansk
57	2	1			23.000	190.000	23.000	76.000	1.000	0					Dansk
58	2	1			166.000	55.000	184.000	55.000	1.000	0					Dansk
59	2	1			184.000	190.000	184.000	55.000	1.000	0					Dansk
60	2	1			23.000	76.000	184.000	76.000	1.000	0					Dansk
61	2	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
62	2	1			23.000	190.000	184.000	190.000	1.000	0					Dansk
63	2	1			166.000	190.000	166.000	55.000	1.000	0					Dansk
64	2	2	$egen_addr1	V	26.000	37.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
65	2	2	$egen_bank_navn	H	183.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
66	2	2	$egen_bank_reg $egen_bank_konto	H	183.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
67	2	2	$eget_firmanavn	V	26.000	41.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
68	2	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
69	2	2	$formular_ialt	H	183.000	56.000	0.000	0.000	10.000	0	Helvetica	on		S	Dansk
70	2	2	$formular_moms	H	183.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
71	2	2	$formular_side	V	160.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
72	2	2	$formular_sum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
73	2	2	$formular_transportsum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
74	2	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
75	2	2	$ordre_betalingsbet $ordre_betalingsdage dage	V	160.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
76	2	2	$ordre_addr2	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
77	2	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
78	2	2	$ordre_kontakt;	V	60.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
79	2	2	$ordre_levdate;	V	160.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
80	2	2	$ordre_momssats;% moms	V	132.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
81	2	2	$ordre_ordredate;	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
82	2	2	$ordre_ordrenr	V	60.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
83	2	2	$ordre_ordrenr;	V	160.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
84	2	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
85	2	2	Beskrivelse	V	55.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
86	2	2	Betalingsbet	V	120.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
87	2	2	CVR nr: $eget_cvrnr	H	183.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
88	2	2	Danmark	V	26.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
89	2	2	Dato	V	120.000	234.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
90	2	2	Deres ordre nr	V	26.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
91	2	2	Deres ref	V	26.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
92	2	2	DK-$eget_postnr $eget_bynavn	V	26.000	33.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
93	2	2	Fax: $egen_fax	V	26.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
94	2	2	Forventet lev.	V	120.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
95	2	2	I alt	V	132.000	56.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
96	2	2	Nettosum	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
97	2	2	Nummer	V	120.000	238.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
98	2	2	Ordrebekræftelse	V	120.000	244.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
99	2	2	Pris	V	158.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
100	2	2	Side	V	120.000	230.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
101	2	2	Sum	V	175.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
102	2	2	Tlf:. $egen_tlf	V	26.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
103	2	2	Transport til side $formular_nextside	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
104	2	2	Varenr	V	26.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
105	2	3	antal	H	146.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
106	2	3	beskrivelse	V	56.000	0.000	52.000	0.000	10.000	0	Helvetica				Dansk
107	2	3	generelt		28.000	185.000	4.000	0.000	0.000	0					Dansk
108	2	3	linjesum	H	183.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
109	2	3	pris	H	165.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
110	2	3	varenr	V	26.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
111	3	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
112	3	1			23.000	190.000	23.000	76.000	1.000	0					Dansk
113	3	1			23.000	76.000	184.000	76.000	1.000	0					Dansk
114	3	1			23.000	190.000	184.000	190.000	1.000	0					Dansk
115	3	1			166.000	55.000	184.000	55.000	1.000	0					Dansk
116	3	1			166.000	190.000	166.000	55.000	1.000	0					Dansk
117	3	1			166.000	69.000	184.000	69.000	1.000	0					Dansk
118	3	1			166.000	62.000	184.000	62.000	1.000	0					Dansk
119	3	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
120	3	1			184.000	190.000	184.000	55.000	1.000	0					Dansk
121	3	2	$egen_addr1	V	26.000	37.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
122	3	2	$egen_bank_navn	H	183.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
123	3	2	$egen_bank_reg $egen_bank_konto	H	183.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
124	3	2	$eget_firmanavn	V	26.000	41.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
125	3	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
126	3	2	$formular_side	V	160.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
127	3	2	$levering_salgsdate;	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
128	3	2	$ordre_lev_addr1;	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
129	3	2	$ordre_lev_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
130	3	2	$ordre_lev_kontakt;	V	60.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
131	3	2	$ordre_lev_navn;	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
132	3	2	$ordre_lev_postnr $ordre_lev_bynavn;	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
133	3	2	$ordre_ordrenr	V	60.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
134	3	2	$ordre_ordrenr;-$formular_lev_nr;	V	160.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
135	3	2	Antal	V	158.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
136	3	2	Beskrivelse	V	55.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
137	3	2	CVR nr: $eget_cvrnr	H	183.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
138	3	2	Danmark	V	26.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
139	3	2	Dato	V	120.000	234.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
140	3	2	Deres ordre nr	V	26.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
141	3	2	Deres ref:	V	26.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
142	3	2	DK-$eget_postnr $eget_bynavn	V	26.000	33.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
143	3	2	Fax: $egen_fax	V	26.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
144	3	2	Følgeseddel	V	120.000	244.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
145	3	2	Nummer	V	120.000	238.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
146	3	2	Rest	V	175.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
147	3	2	Side	V	120.000	230.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
148	3	2	Tlf:. $egen_tlf	V	26.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
149	3	2	Varenr	V	26.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
150	3	3	beskrivelse	V	56.000	0.000	52.000	0.000	10.000	0	Helvetica				Dansk
151	3	3	generelt		28.000	185.000	4.000	0.000	0.000	0					Dansk
152	3	3	lev_antal	H	165.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
153	3	3	lev_rest	H	183.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
154	3	3	varenr	V	26.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
155	4	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
156	4	1			166.000	62.000	184.000	62.000	1.000	0					Dansk
157	4	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
158	4	1			166.000	69.000	184.000	69.000	1.000	0					Dansk
159	4	1			166.000	55.000	184.000	55.000	1.000	0					Dansk
160	4	1			23.000	76.000	184.000	76.000	1.000	0					Dansk
161	4	1			23.000	190.000	184.000	190.000	1.000	0					Dansk
162	4	1			166.000	190.000	166.000	55.000	1.000	0					Dansk
163	4	1			23.000	190.000	23.000	76.000	1.000	0					Dansk
164	4	1			184.000	190.000	184.000	55.000	1.000	0					Dansk
165	4	2	$egen_addr1	V	26.000	37.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
166	4	2	$egen_bank_navn	H	183.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
167	4	2	$egen_bank_reg $egen_bank_konto	H	183.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
168	4	2	$eget_firmanavn	V	26.000	41.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
169	4	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
170	4	2	$formular_forfaldsdato	V	160.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
171	4	2	$formular_ialt	H	183.000	56.000	0.000	0.000	10.000	0	Helvetica	on		S	Dansk
172	4	2	$formular_moms	H	183.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
173	4	2	$formular_side	V	160.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
174	4	2	$formular_sum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
175	4	2	$formular_transportsum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
176	4	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
177	4	2	$ordre_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
178	4	2	$ordre_betalingsbet $ordre_betalingsdage dage	V	160.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
179	4	2	$ordre_fakturadate	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
180	4	2	$ordre_fakturanr	V	160.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
181	4	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
182	4	2	$ordre_kundeordnr;	V	60.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
183	4	2	$ordre_momssats;% moms	V	132.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
184	4	2	$ordre_ordrenr	V	60.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
185	4	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
186	4	2	Antal	C	148.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
187	4	2	Att: $ordre_kontakt;	V	26.000	226.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
188	4	2	Beskrivelse	V	55.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
189	4	2	Betalingsbet	V	120.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
190	4	2	CVR nr: $eget_cvrnr	H	183.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
191	4	2	Danmark	V	26.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
192	4	2	Dato	V	120.000	234.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
193	4	2	Deres ref:	V	26.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
194	4	2	DK-$eget_postnr $eget_bynavn	V	26.000	33.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
195	4	2	Faktura	V	120.000	244.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
196	4	2	Fax: $egen_fax	V	26.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
197	4	2	Forfaldsdato	V	120.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
198	4	2	I alt	V	132.000	56.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
199	4	2	Nettosum	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
200	4	2	Nummer	V	120.000	238.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
201	4	2	Pris	V	158.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
202	4	2	Side	V	120.000	230.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
203	4	2	Sum	V	175.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
204	4	2	Tlf:. $egen_tlf	V	26.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
205	4	2	Transport til side $formular_nextside	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
206	4	2	Varenr	V	26.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
207	4	2	Vores ordre nr	V	26.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
208	4	3	antal	H	148.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
209	4	3	beskrivelse	V	56.000	0.000	48.000	0.000	10.000	0	Helvetica				Dansk
210	4	3	generelt		28.000	185.000	4.000	0.000	0.000	0					Dansk
211	4	3	linjesum	H	183.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
212	4	3	pris	H	165.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
213	4	3	varenr	V	26.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
214	5	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
215	5	1			166.000	55.000	184.000	55.000	1.000	0					Dansk
216	5	1			166.000	69.000	184.000	69.000	1.000	0					Dansk
217	5	1			166.000	62.000	184.000	62.000	1.000	0					Dansk
218	5	1			23.000	190.000	23.000	76.000	1.000	0					Dansk
219	5	1			166.000	190.000	166.000	55.000	1.000	0					Dansk
220	5	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
221	5	1			23.000	76.000	184.000	76.000	1.000	0					Dansk
222	5	1			23.000	190.000	184.000	190.000	1.000	0					Dansk
223	5	1			184.000	190.000	184.000	55.000	1.000	0					Dansk
224	5	2	$egen_addr1	V	26.000	37.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
225	5	2	$egen_bank_navn	H	183.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
226	5	2	$egen_bank_reg $egen_bank_konto	H	183.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
227	5	2	$eget_firmanavn	V	26.000	41.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
228	5	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
229	5	2	$formular_forfaldsdato	V	160.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
230	5	2	$formular_ialt	H	183.000	56.000	0.000	0.000	10.000	0	Helvetica	on		S	Dansk
231	5	2	$formular_moms	H	183.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
232	5	2	$formular_side	V	160.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
233	5	2	$formular_sum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
234	5	2	$formular_transportsum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
235	5	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
236	5	2	$ordre_betalingsbet $ordre_betalingsdage dage	V	160.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
237	5	2	$ordre_bynavn	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
238	5	2	$ordre_fakturadate	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
239	5	2	$ordre_fakturanr	V	160.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
240	5	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
241	5	2	$ordre_momssats;% moms	V	132.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
242	5	2	$ordre_ordrenr	V	60.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
243	5	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
244	5	2	Beskrivelse	V	55.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
245	5	2	Betalingsbet	V	120.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
246	5	2	CVR nr: $eget_cvrnr	H	183.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
247	5	2	Danmark	V	26.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
248	5	2	Dato	V	120.000	234.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
249	5	2	Deres ordre nr	V	26.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
250	5	2	Deres ref:	V	26.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
251	5	2	DK-$eget_postnr $eget_bynavn	V	26.000	33.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
252	5	2	Fax: $egen_fax	V	26.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
253	5	2	Forfaldsdato	V	120.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
254	5	2	I alt	V	132.000	56.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
255	5	2	Kreditnota	V	120.000	244.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
256	5	2	Nettosum	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
257	5	2	Nummer	V	120.000	238.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
258	5	2	Pris	V	158.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
259	5	2	Side	V	120.000	230.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
260	5	2	Sum	V	175.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
261	5	2	Tlf:. $egen_tlf	V	26.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
262	5	2	Transport til side $formular_nextside	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
263	5	2	Varenr	V	26.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
264	5	3	antal	H	146.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
265	5	3	beskrivelse	V	56.000	0.000	52.000	0.000	10.000	0	Helvetica				Dansk
266	5	3	generelt		28.000	185.000	4.000	0.000	0.000	0					Dansk
267	5	3	linjesum	H	183.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
268	5	3	pris	H	165.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
269	5	3	varenr	V	26.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
270	6	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
271	6	1			26.000	15.000	184.000	15.000	1.000	0					Dansk
272	6	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
273	6	2	$ordre_ordredate;	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
274	6	2	$egen_bank_navn;, kontonummer: $egen_bank_reg; $egen_bank_konto;	V	26.000	135.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
275	6	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
276	6	2	$eget_firmanavn;	V	26.000	100.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
277	6	2	$eget_firmanavn; * $egen_addr1; * $eget_postnr; * $eget_bynavn;	C	105.000	9.000	0.000	0.000	8.000	0	Helvetica			A	Dansk
278	6	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
279	6	2	$ordre_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
280	6	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
281	6	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
282	6	2	Cvr.: $eget_cvrnr; * Tlf: $egen_tlf; * Fax: $egen_fax; * $egen_bank_navn; $egen_bank_reg; $egen_bank_konto; 	C	105.000	5.000	0.000	0.000	8.000	0	Helvetica			A	Dansk
283	6	2	Dato	V	150.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
284	6	2	Gebyr for denne skrivelse udgør kr. $rykker_gebyr;.	V	26.000	145.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
285	6	2	I så fald beder vi Dem se bort fra dette brev.	V	26.000	150.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
286	6	2	Med venlig hilsen	V	26.000	105.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
287	6	2	Rykkerbrev	V	26.000	180.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
288	6	2	Såfremt beløbet er indbetalt inden for de seneste dage, kan indbetalingen have krydset dette brev.	V	26.000	155.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
289	6	2	Ved gennemgang af vores bogholderi, har vi konstateret et forfaldent tilgodehavende på kr. $forfalden_sum	V	26.000	160.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
290	6	2	Vores samlede tilgodehavende udgør herefter kr. $formular_ialt;, som bedes indbetalt inden 8 dage til	V	26.000	140.000	0.000	0.000	11.000	0	Helvetica			S	Dansk
291	6	3	generelt		34.000	185.000	4.000	0.000	0.000	0					Dansk
292	7	1			26.000	15.000	184.000	15.000	1.000	0					Dansk
293	7	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
294	7	2	$ordre_ordredate;	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
295	7	2	$egen_bank_navn;, kontonummer: $egen_bank_reg; $egen_bank_konto;	V	26.000	135.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
296	7	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
297	7	2	$eget_firmanavn;	V	26.000	100.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
298	7	2	$eget_firmanavn; * $egen_addr1; * $eget_postnr; * $eget_bynavn;	C	105.000	9.000	0.000	0.000	8.000	0	Helvetica			A	Dansk
299	7	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
300	7	2	$ordre_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
301	7	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
302	7	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
303	7	2	Cvr.: $eget_cvrnr; * Tlf: $egen_tlf; * Fax: $egen_fax; * $egen_bank_navn; $egen_bank_reg; $egen_bank_konto; 	C	105.000	5.000	0.000	0.000	8.000	0	Helvetica			A	Dansk
304	7	2	Dato	V	150.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
305	7	2	Gebyr for denne skrivelse udgør kr. $rykker_gebyr;.	V	26.000	145.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
306	7	2	I så fald beder vi Dem se bort fra dette brev.	V	26.000	150.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
307	7	2	Med venlig hilsen	V	26.000	105.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
308	7	2	2. Rykker	V	26.000	180.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
309	7	2	Såfremt beløbet er indbetalt inden for de seneste dage, kan indbetalingen have krydset dette brev.	V	26.000	155.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
310	7	2	Ved gennemgang af vores bogholderi, har vi konstateret et forfaldent tilgodehavende på kr. $forfalden_sum	V	26.000	160.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
311	7	2	Vores samlede tilgodehavende udgør herefter kr. $formular_ialt;, som bedes indbetalt inden 8 dage til	V	26.000	140.000	0.000	0.000	11.000	0	Helvetica			S	Dansk
312	7	3	generelt		34.000	185.000	4.000	0.000	0.000	0					Dansk
313	8	1			26.000	15.000	184.000	15.000	1.000	0					Dansk
314	8	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
315	8	2	$ordre_ordredate;	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
316	8	2	$egen_bank_navn;, kontonummer: $egen_bank_reg; $egen_bank_konto;	V	26.000	135.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
317	8	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
318	8	2	$eget_firmanavn;	V	26.000	100.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
319	8	2	$eget_firmanavn; * $egen_addr1; * $eget_postnr; * $eget_bynavn;	C	105.000	9.000	0.000	0.000	8.000	0	Helvetica			A	Dansk
320	8	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
321	8	2	$ordre_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
322	8	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
323	8	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
324	8	2	Cvr.: $eget_cvrnr; * Tlf: $egen_tlf; * Fax: $egen_fax; * $egen_bank_navn; $egen_bank_reg; $egen_bank_konto; 	C	105.000	5.000	0.000	0.000	8.000	0	Helvetica			A	Dansk
325	8	2	Dato	V	150.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
326	8	2	Gebyr for denne skrivelse udgør kr. $rykker_gebyr;.	V	26.000	145.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
327	8	2	I så fald beder vi Dem se bort fra dette brev.	V	26.000	150.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
328	8	2	Med venlig hilsen	V	26.000	105.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
329	8	2	3. Rykker	V	26.000	180.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
330	8	2	Såfremt beløbet er indbetalt inden for de seneste dage, kan indbetalingen have krydset dette brev.	V	26.000	155.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
331	8	2	Ved gennemgang af vores bogholderi, har vi konstateret et forfaldent tilgodehavende på kr. $forfalden_sum	V	26.000	160.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
332	8	2	Vores samlede tilgodehavende udgør herefter kr. $formular_ialt;, som bedes indbetalt inden 8 dage til	V	26.000	140.000	0.000	0.000	11.000	0	Helvetica			S	Dansk
333	8	3	generelt		34.000	185.000	4.000	0.000	0.000	0					Dansk
334	1	5	Tilbud		1.000	0.000	0.000	0.000	10.000	0					Dansk
335	1	5	Hermed fremsendes tilbud		2.000	0.000	0.000	0.000	10.000	0					Dansk
336	2	5	Ordrebekræftelse		1.000	0.000	0.000	0.000	10.000	0					Dansk
337	2	5	Hermed fremsendes ordrebekræftelse		2.000	0.000	0.000	0.000	10.000	0					Dansk
338	4	5	Faktura		1.000	0.000	0.000	0.000	10.000	0					Dansk
339	4	5	Hermed fremsendes faktura		2.000	0.000	0.000	0.000	10.000	0					Dansk
340	5	5	Kreditnota		1.000	0.000	0.000	0.000	10.000	0					Dansk
341	5	5	Hermed fremsendes kreditnota		2.000	0.000	0.000	0.000	10.000	0					Dansk
342	6	5	Rykker		1.000	0.000	0.000	0.000	10.000	0					Dansk
343	6	5	Hermed fremsendes rykker		2.000	0.000	0.000	0.000	10.000	0					Dansk
344	7	5	Rykker		1.000	0.000	0.000	0.000	10.000	0					Dansk
345	7	5	Hermed fremsendes rykker		2.000	0.000	0.000	0.000	10.000	0					Dansk
346	8	5	Rykker		1.000	0.000	0.000	0.000	10.000	0					Dansk
347	8	5	Hermed fremsendes rykker		2.000	0.000	0.000	0.000	10.000	0					Dansk
348	11	2	Kontoudtog		23.000	220.000	0.000	0.000	12.000	0	Helvetica	on		A	Dansk
349	11	2	$adresser_postnr; $adresser_bynavn		23.000	236.000	0.000	0.000	10.000	0	Helvetica			A	Dansk
350	11	2	Forfaldsdato	H	140.000	190.000	0.000	0.000	10.000	0	Helvetica	on		A	Dansk
351	11	2	Beskrivelse		70.000	190.000	0.000	0.000	10.000	0	Helvetica	on		A	Dansk
352	11	2	Faktura		45.000	190.000	0.000	0.000	10.000	0	Helvetica	on		A	Dansk
353	11	2	Dato		23.000	190.000	0.000	0.000	10.000	0	Helvetica	on		A	Dansk
354	11	2	Debet	H	160.000	190.000	0.000	0.000	10.000	0	Helvetica	on		A	Dansk
355	11	2	Kredit	H	180.000	190.000	0.000	0.000	10.000	0	Helvetica	on		A	Dansk
356	11	2	$adresser_firmanavn		23.000	248.000	0.000	0.000	10.000	0	Helvetica			A	Dansk
357	11	2	Saldo	H	200.000	190.000	0.000	0.000	10.000	0	Helvetica	on		A	Dansk
358	11	2	$adresser_addr1		23.000	244.000	0.000	0.000	10.000	0	Helvetica			A	Dansk
359	11	2	$adresser_addr2		23.000	240.000	0.000	0.000	10.000	0	Helvetica			A	Dansk
360	11	3	dato	V	22.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
361	11	3	beskrivelse	V	70.000	0.000	30.000	0.000	10.000	0	Helvetica				Dansk
362	11	3	debet	H	160.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
363	11	3	kredit	H	180.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
364	11	3	generelt		34.000	185.000	4.000	0.000	0.000	0					Dansk
365	11	3	forfaldsdato	H	140.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
366	11	3	saldo	H	200.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
367	11	3	faktnr	V	48.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
368	11	2	$eget_firmanavn; * $egen_addr1; * $eget_postnr; * $eget_bynavn;	C	105.000	9.000	0.000	0.000	8.000	0	Helvetica			A	Dansk
369	11	2	Tlf: $egen_tlf; * Cvr.nr: $eget_cvrnr * Bank: $egen_bank_navn; * Kontonummer: $egen_bank_reg; $egen_bank_konto;	C	105.000	6.000	0.000	0.000	8.000	0	Helvetica			A	Dansk
370	12	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
371	12	1			166.000	69.000	184.000	69.000	1.000	0					Dansk
372	12	1			23.000	190.000	23.000	76.000	1.000	0					Dansk
373	12	1			23.000	76.000	184.000	76.000	1.000	0					Dansk
374	12	1			23.000	190.000	184.000	190.000	1.000	0					Dansk
375	12	1			166.000	55.000	184.000	55.000	1.000	0					Dansk
376	12	1			166.000	190.000	166.000	55.000	1.000	0					Dansk
377	12	1			166.000	62.000	184.000	62.000	1.000	0					Dansk
378	12	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
379	12	1			184.000	190.000	184.000	55.000	1.000	0					Dansk
380	12	2	$egen_addr1	V	26.000	37.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
381	12	2	$egen_bank_navn	H	183.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
382	12	2	$egen_bank_reg $egen_bank_konto	H	183.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
383	12	2	$eget_firmanavn	V	26.000	41.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
384	12	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
385	12	2	$formular_ialt	H	183.000	56.000	0.000	0.000	10.000	0	Helvetica	on		S	Dansk
386	12	2	$formular_moms	H	183.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
387	12	2	$formular_side	V	160.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
388	12	2	$formular_sum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
389	12	2	$formular_transportsum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
390	12	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
391	12	2	$ordre_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
392	12	2	$ordre_ordrenr	V	160.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
393	12	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
394	12	2	$ordre_momssats;% moms	V	132.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
395	12	2	$ordre_ordredate;	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
396	12	2	$ordre_ordrenr	V	60.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
397	12	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
398	12	2	Antal	C	148.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
399	12	2	Beskrivelse	V	55.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
400	12	2	CVR nr: $eget_cvrnr	H	183.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
401	12	2	Danmark	V	26.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
402	12	2	Dato	V	120.000	234.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
403	12	2	Deres ordre nr	V	26.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
404	12	2	Deres ref:	V	26.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
405	12	2	DK-$eget_postnr $eget_bynavn	V	26.000	33.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
406	12	2	Fax: $egen_fax	V	26.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
407	12	2	I alt	V	132.000	56.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
408	12	2	Nettosum	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
409	12	2	Nummer	V	120.000	238.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
410	12	2	Pris	V	158.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
411	12	2	Side	V	120.000	230.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
412	12	2	Sum	V	175.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
413	12	2	Indkøbsforslag	V	120.000	244.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
414	12	2	Tlf:. $egen_tlf	V	26.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
415	12	2	Transport til side $formular_nextside	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
416	12	2	Varenr	V	26.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
417	12	3	antal	H	148.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
418	12	3	beskrivelse	V	56.000	0.000	52.000	0.000	10.000	0	Helvetica				Dansk
419	12	3	generelt		28.000	185.000	4.000	0.000	0.000	0					Dansk
420	12	3	linjesum	H	183.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
421	12	3	pris	H	165.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
422	13	1	LOGO		150.000	265.000	0.000	0.000	0.000	0					Dansk
423	13	1			166.000	62.000	184.000	62.000	1.000	0					Dansk
424	13	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
425	13	1			166.000	69.000	184.000	69.000	1.000	0					Dansk
426	13	1			166.000	55.000	184.000	55.000	1.000	0					Dansk
427	13	1			23.000	76.000	184.000	76.000	1.000	0					Dansk
428	13	1			23.000	190.000	184.000	190.000	1.000	0					Dansk
429	13	1			166.000	190.000	166.000	55.000	1.000	0					Dansk
430	13	1			23.000	190.000	23.000	76.000	1.000	0					Dansk
431	13	1			184.000	190.000	184.000	55.000	1.000	0					Dansk
432	13	2	$egen_addr1	V	26.000	37.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
433	13	2	$egen_bank_navn	H	183.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
434	13	2	$egen_bank_reg $egen_bank_konto	H	183.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
435	13	2	$eget_firmanavn	V	26.000	41.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
436	13	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
437	13	2	$formular_forfaldsdato	V	160.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
438	13	2	$formular_ialt	H	183.000	56.000	0.000	0.000	10.000	0	Helvetica	on		S	Dansk
439	13	2	$formular_moms	H	183.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
440	13	2	$formular_side	V	160.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
441	13	2	$formular_sum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
442	13	2	$formular_transportsum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
443	13	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
444	13	2	$ordre_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
445	13	2	$ordre_betalingsbet $ordre_betalingsdage dage	V	160.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
446	13	2	$ordre_ordredate	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
447	13	2	$ordre_fakturanr	V	160.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
448	13	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
449	13	2	$ordre_kundeordnr;	V	60.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
450	13	2	$ordre_momssats;% moms	V	132.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
451	13	2	$ordre_ordrenr	V	60.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
452	13	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
453	13	2	Antal	C	148.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
454	13	2	Att: $ordre_kontakt;	V	26.000	226.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
455	13	2	Beskrivelse	V	55.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
456	13	2	Betalingsbet	V	120.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
457	13	2	CVR nr: $eget_cvrnr	H	183.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
458	13	2	Danmark	V	26.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
459	13	2	Dato	V	120.000	234.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
460	13	2	Deres ref:	V	26.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
461	13	2	DK-$eget_postnr $eget_bynavn	V	26.000	33.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
462	13	2	Rekvisition	V	120.000	244.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
463	13	2	Fax: $egen_fax	V	26.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
464	13	2	I alt	V	132.000	56.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
465	13	2	Nettosum	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
466	13	2	Nummer	V	120.000	238.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
467	13	2	Pris	V	158.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
468	13	2	Side	V	120.000	230.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
469	13	2	Sum	V	175.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
470	13	2	Tlf:. $egen_tlf	V	26.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
471	13	2	Transport til side $formular_nextside	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
472	13	2	Varenr	V	26.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
473	13	2	Vores ordre nr	V	26.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
474	13	3	antal	H	148.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
475	13	3	beskrivelse	V	56.000	0.000	48.000	0.000	10.000	0	Helvetica				Dansk
476	13	3	generelt		28.000	185.000	4.000	0.000	0.000	0					Dansk
477	13	3	linjesum	H	183.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
478	13	3	pris	H	165.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
479	13	3	varenr	V	26.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
481	14	1			166.000	62.000	184.000	62.000	1.000	0					Dansk
482	14	1			26.000	255.000	184.000	255.000	1.000	0					Dansk
483	14	1			166.000	69.000	184.000	69.000	1.000	0					Dansk
484	14	1			166.000	55.000	184.000	55.000	1.000	0					Dansk
485	14	1			23.000	76.000	184.000	76.000	1.000	0					Dansk
486	14	1			23.000	190.000	184.000	190.000	1.000	0					Dansk
487	14	1			166.000	190.000	166.000	55.000	1.000	0					Dansk
488	14	1			23.000	190.000	23.000	76.000	1.000	0					Dansk
489	14	1			184.000	190.000	184.000	55.000	1.000	0					Dansk
490	14	2	$egen_addr1	V	26.000	37.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
491	14	2	$egen_bank_navn	H	183.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
492	14	2	$egen_bank_reg $egen_bank_konto	H	183.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
493	14	2	$eget_firmanavn	V	26.000	41.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
494	14	2	$eget_firmanavn     *     $egen_addr1     *     $eget_postnr $eget_bynavn     *     Danmark	V	26.000	258.000	0.000	0.000	12.000	0	Helvetica	on	on	A	Dansk
495	14	2	$formular_ialt	H	183.000	56.000	0.000	0.000	10.000	0	Helvetica	on		S	Dansk
496	14	2	$formular_moms	H	183.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
497	14	2	$formular_side	V	160.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
498	14	2	$formular_sum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
499	14	2	$formular_transportsum	H	183.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
500	14	2	$ordre_addr1	V	26.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
501	14	2	$ordre_addr2;	V	26.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
502	14	2	$ordre_betalingsbet $ordre_betalingsdage dage	V	160.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
503	14	2	$ordre_fakturadate	V	160.000	234.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
504	14	2	$ordre_fakturanr	V	160.000	238.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
505	14	2	$ordre_firmanavn	V	26.000	242.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
506	14	2	$ordre_kundeordnr;	V	60.000	214.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
507	14	2	$ordre_momssats;% moms	V	132.000	63.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
508	14	2	$ordre_ordrenr	V	60.000	210.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
509	14	2	$ordre_postnr $ordre_bynavn	V	26.000	230.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
510	14	2	Antal	C	148.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
511	14	2	Att: $ordre_kontakt;	V	26.000	226.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
512	14	2	Beskrivelse	V	55.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
513	14	2	Betalingsbet	V	120.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
514	14	2	CVR nr: $eget_cvrnr	H	183.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
515	14	2	Danmark	V	26.000	29.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
516	14	2	Dato	V	120.000	234.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
517	14	2	Deres ref:	V	26.000	214.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
518	14	2	DK-$eget_postnr $eget_bynavn	V	26.000	33.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
519	14	2	Købsfaktura	V	120.000	244.000	0.000	0.000	15.000	0	Helvetica	on		A	Dansk
520	14	2	Fax: $egen_fax	V	26.000	17.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
521	14	2	Forfaldsdato	V	120.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
522	14	2	I alt	V	132.000	56.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
523	14	2	Nettosum	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			S	Dansk
524	14	2	Nummer	V	120.000	238.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
525	14	2	Pris	V	158.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
526	14	2	Side	V	120.000	230.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
527	14	2	Sum	V	175.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
528	14	2	Tlf:. $egen_tlf	V	26.000	21.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
529	14	2	Transport til side $formular_nextside	V	132.000	70.000	0.000	0.000	10.000	0	Helvetica			!S	Dansk
530	14	2	Varenr	V	26.000	193.000	0.000	0.000	11.000	0	Helvetica			A	Dansk
531	14	2	Vores ordre nr	V	26.000	210.000	0.000	0.000	11.000	0	Helvetica	on		A	Dansk
532	14	3	antal	H	148.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
533	14	3	beskrivelse	V	56.000	0.000	48.000	0.000	10.000	0	Helvetica				Dansk
534	14	3	generelt		28.000	185.000	4.000	0.000	0.000	0					Dansk
535	14	3	linjesum	H	183.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
536	14	3	pris	H	165.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
537	14	3	varenr	V	26.000	0.000	0.000	0.000	10.000	0	Helvetica				Dansk
\.


--
-- Data for Name: grupper; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY grupper (id, beskrivelse, kode, kodenr, art, box1, box2, box3, box4, box5, box6, box7, box8, box9, box10, box11, box12, box13, box14) FROM stdin;
2	Div_valg	\N	2	DIV	\N	\N	\N			\N	\N	\N	\N	\N	\N	\N	\N	\N
3	Div_valg	\N	3	DIV				on	on	on					\N	\N	\N	\N
4	Dansk	DA	1	SPROG	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
5	Administratorer		0	brgrp		11111111	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
6	Salgsmoms 25%	S	1	SM	66100	25												
7	Købsmoms 25%	K	1	KM	66200	25												
8	Moms af varekøb m.v. i udlandet	E	1	EM	66150	25	66200											
9	Moms af ydelseskøb i udlandet	Y	1	YM	66155	25	66200											
10	Momsrapport	R	1	MR	66100	66200	2800	2700	1220	1200	1290							
11	Danske Debitorer	D	1	DG	S1	56100	DKK	Dansk	58000									
12	Danske Kreditorer	K	1	KG	K1	65100	DKK	Dansk	58000									
13	Ydelser		1	VG			2900	1000							2700	1200	2720	1250
14	Handelsvarer		2	VG	55100	55100	2100	1100	2600			on			2800	1220	2820	1270
15	Forbrugssvarer		3	VG			2100	1100							2800	1220	2820	1270
16	Fragt/porto		4	VG			2300	1300			on				2700	1200	2720	1250
22	Debitorrapportvisning	\N	1	KRV	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
23	Debitorrapportvisning	\N	1	DRV	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
19	Ordrelistevisning	ordrer	1	OLV		../index/menu.php	ordrenr,ordredate,levdate,kontonr,firmanavn,ref,sum	50,100,100,100,150,100,100	right,left,left,left,left,left,right	Ordrenr.,Ordredato,Levdato,Kontonr.,Firmanavn,S&aelig;lger,Ordresum	100		\n\n\n\n\n\n	\N	\N	\N	\N	\N
24	Kassekladde	1	1	KASKL	amount		\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
25	varevisning	\N	\N	VV	admin	on	on	on	100	\N	\N	\N	\N	\N	\N	\N	\N	\N
1	Version	\N	\N	VE	3.6.5	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
28	Pos valg		2	POS	0													
18	Usersettings	\N	1	USET	statusbar=0,menubar=0,titlebar=0,toolbar=0,scrollbars=1,resizable=1,dependent=1		on	#eeeef0		\N	\N	\N	\N	\N	\N	\N	\N	\N
27	Div DebitorInfo	\N	\N	DebInfo	\N	\N			\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
21	debitorlistevisning	historik	1	DLV	\N	\N	kontonr\tfirmanavn\taddr1\taddr2\tpostnr\tbynavn\tkontakt\ttlf\tkontoansvarlig	5\t35\t10\t10\t10\t10\t10\t10\t10	right\tleft\tleft\tleft\tleft\tleft\tleft\tleft\tleft	Kontonr\tFirmanavn\tAdresse\tAdresse 2\tPostnr\tBy\tKontakt\tTelefon\tS&aelig;lger	100	\N		\n\n\n\n\n\n\n\n	\N	\N	\N	\N
20	debitorlistevisning	debitor	1	DLV	\N	\N	kontonr\tfirmanavn\taddr1\temail\tpostnr\tbynavn\tkontakt\ttlf\tkontoansvarlig	5\t35\t20\t10\t10\t10\t10\t10\t10	right\tleft\tleft\tleft\tleft\tleft\tleft\tleft\tleft	Kontonr\tFirmanavn\tAdresse\tAdresse\tPostnr\tBy\tKontakt\tTelefon\tSælger	100	\t\t\t\t\t\t\t\t	kontoansvarlig	\n\n\n\n\n\n\n\n	\N	\N	\N	\N
26	Ordrelistevisning	faktura	1	OLV		../index/menu.php	ordrenr,ordredate,fakturanr,fakturadate,nextfakt,kontonr,firmanavn,ref,sum	50,100,100,100,100,150,100,100,100	right,left,right,left,left,left,left,left,right	Ordrenr.,Ordredato,Fakt.nr.,Fakt.dato,Genfakt.,Kontonr.,Firmanavn,S&aelig;lger,Fakturasum	100		\n\n\n\n\n\n\n\n	\N	\N	\N	\N	\N
29	dds	\N	1	VK	AED	122,00	7960	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
17	2016		1	RA	01	2016	12	2016	on	0	2016-12-06	11:20:30						
30	Debitorrabatgrupper	\N	1	DRG	Europæisk debitor	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
\.


--
-- Data for Name: historik; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY historik (id, konto_id, kontakt_id, ansat_id, notat, notedate, kontaktet, kontaktes, dokument) FROM stdin;
\.


--
-- Data for Name: jobkort; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY jobkort (id, konto_id, ordre_id, kontonr, firmanavn, addr1, addr2, postnr, bynavn, kontakt, tlf, initdate, oprettet_af, startdate, slutdate, hvem, tidspkt, felt_1, felt_2, felt_3, felt_4, felt_5, felt_6, felt_7, felt_8, felt_9, felt_10, felt_11) FROM stdin;
\.


--
-- Data for Name: jobkort_felter; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY jobkort_felter (id, job_id, art, feltnr, subnr, feltnavn, indhold) FROM stdin;
\.


--
-- Data for Name: kassekladde; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY kassekladde (id, bilag, transdate, beskrivelse, d_type, debet, k_type, kredit, faktura, amount, kladde_id, momsfri, medarb, ansat, afd, projekt, valuta, valutakurs, ordre_id, forfaldsdate, betal_id, dokument) FROM stdin;
\.


--
-- Data for Name: kladdeliste; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY kladdeliste (id, kladdedate, bogforingsdate, kladdenote, bogfort, oprettet_af, bogfort_af, hvem, tidspkt) FROM stdin;
1	2016-10-23	\N	Demo	-	admin	\N	admin	-3.642449 1485704621
\.


--
-- Data for Name: kontokort; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY kontokort (id, ref_id, faktnr, refnr, beskrivelse, kredit, debet, transdate) FROM stdin;
\.


--
-- Data for Name: kontoplan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY kontoplan (id, kontonr, beskrivelse, kontotype, moms, fra_kto, til_kto, lukket, primo, saldo, regnskabsaar, genvej, overfor_til, anvendelse, modkonto, valuta, valutakurs) FROM stdin;
89	6800	Erhvervsforsikringer	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
90	6900	Fragt & kørsel	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
92	7200	Porto & gebyrer	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
93	7400	Småanskaffelser	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
95	7640	Privat andel telefon mv.	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
96	7650	Internet og webhotel	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
79	6020	Ej fradragsberett. andel	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
83	6100	Advokat og revisor	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
84	6150	Bogføringsassistance	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
85	6200	Konsulentbistand	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
87	6400	Kontingenter m/moms	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
88	6450	Kontingenter u/moms	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
97	7700	Vedligehold driftsmidler	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
98	7750	Leje af driftsmidler	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
99	7800	Diverse inkl. moms	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
140	50800	Immaterielle anlægsaktiver primo	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
141	50810	Forbedringer i året	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
142	50820	Salg i året	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
143	50830	Tilgang i året	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
144	50840	Årets afskrivninger	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
148	50900	Driftmiddelsaldo primo	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
149	50910	Tilgang i året drift/inventar	S	K1	0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
150	50920	Afgang i året drift/inventar	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
151	50930	Årets afskrivninger	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
154	55100	Varebeholdning	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
157	56100	Debitorer, ubetalte fakturaer	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
158	56150	Efterposteringer	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
160	56300	Deposita	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
161	56500	Forudbetalte omkostninger	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
166	58100	Giro	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
167	58200	Kasse	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
19	2400	Leje driftsmidler	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
20	2500	Forbrug egne varer	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
22	2700	Køb af ydelser i EU	D	Y1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
94	7600	Telefoni	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
100	7900	Diverse ekskl. moms	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
111	8800	Privat andel autodrift	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
112	8950	Øvrig personbefordring	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
117	9100	Småanskaffelser	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
118	9200	Driftsmidler	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
125	9800	Bank & giro	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
126	9850	Renteindtægter diverse	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
129	9900	Bankrenter	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
130	9950	Leverandører m.v.	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
165	58000	Bank	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
9	1290	Salg af varer og ydelser udenfor EU	Z		1250	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
13	1950	OMSÆTNING I ALT	Z		1000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
26	2850	VAREFORBRUG I ALT	Z		2000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
29	3000	VAREFORBRUG OG FREMMEDE ARBEJDE	Z		2000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
30	3500	DÆKNINGSBIDRAG I	Z		1	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
35	4125	Bruttoløn	Z		4100	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
47	4249	LØNNINGER I ALT	Z		4000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
48	4250	DÆKNINGSBIDRAG II	Z		1	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
56	4950	PERSONALEOMK. I ALT	Z		4308	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
57	5000	LØN OG PERSONALE I ALT	Z		4100	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
67	5600	LOKALEOMKOSTNINGER I ALT	Z		5100	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
80	6030	REPRÆSENTATION I ALT	Z		5980	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
113	8960	KØRSEL I ALT	Z		8300	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
114	8980	Øvrige omkosninger i alt:	Z		4500	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
115	9000	RESULTAT FØR AFSKRIVNINGER	Z		1	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
122	9550	AFSKRIVNINGER I ALT	Z		9100	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
220	67000	KORTFRISTET GÆLD I ALT	Z		64100	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
221	72000	PASSIVER I ALT	Z		60500	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
223	99999	Balancekontrol	Z		50000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
38	4150	Personalegoder	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
63	5300	Varme	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
65	5400	Rengøring og dekoration	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
78	6010	Repræsentation, diverse	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
91	7000	Kontorartikler & tryksager	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
101	7940	Øredifferencer	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
102	7950	Reg. kassedifferencer	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
103	7960	Valutadifferencer	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
106	8300	Udbetalte kilometerpenge	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
107	8400	Brændstof	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
108	8500	Vedligeholdelse	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
109	8600	Vægtafgift & forsikringer	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
110	8700	Afskrivning	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
119	9250	Immaterielle anlægsaktiver	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
173	60500	Egenkapitalkonto primo	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
196	64165	Skyldig SP (særlig pension)	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
197	64170	Skyldig ATP	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
198	64190	Feriepenge hensat	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
124	9799	RENTEINDTÆGTER M.V.:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
128	9899	RENTEUDGIFTER M.V.:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
135	20000	------------------------------------------------------------	X		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
136	49996	STATUS	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
137	49997	AKTIVER:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
138	49998	IMMATERIELLE ANLÆGSAKTIVER	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
139	49999	(Patenter, rettigheder, goodwill, udviklingsprojekter under udførelse mv.)	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
146	50898	MATERIELLE ANLÆGSAKTIVER	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
147	50899	(Inventar, bygninger, maskiner mv.)	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
153	55099	OMSÆTNINGSAKTIVER:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
156	56099	TILGODEHAVENDER	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
164	57999	LIKVIDEBEHOLDNINGER	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
27	2899	FREMMED ARBEJDE	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
31	4099	LØNNINGER:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
49	4308	Øvrige omkostninger:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
50	4309	Øvrige personaleomkostninger:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
182	62400	Privat andel autodrift	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
183	62500	Privat andel telefon	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
184	62600	75% andel repræsentation	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
187	63000	Banklån 	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
192	64100	Nettoløn	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
193	64110	A conto-udbetaling af løn	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
218	66900	Momsafregning	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
222	99995	Ukendte poster	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
53	4330	Personaleforsikringer	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
54	4340	Uddannelsesudgifter	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
55	4350	Diverse udgifter	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
59	5100	Husleje	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
60	5200	El, varme m.v.	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
175	60900	Overført fra tidligere år 	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
176	62000	Mellemregning	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
177	62010	B-skat	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
178	62020	Restskat	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
179	62100	Hævet kontant i virksomheden	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
180	62200	Indskudt kontant i virksomheden	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
181	62300	Ikke fradragsberettigede udgift.	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
58	5099	LOKALEOMKOSTNINGER:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
68	5899	SALGSOMKOSTNINGER:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
75	5989	REPRÆSENTATION:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
1	10	RESULTATOPGØRELSE	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
3	1000	Udført arbejde	D	S1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
23	2720	Køb af ydelser udenfor EU	D	Y1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
194	64150	Skyldig A-skat, personale	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
195	64160	Skyldigt arbejdsmarkedsbidrag	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
199	64195	Feriepenge udbetalt	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
200	64200	Skyldig pension, gruppeliv	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
201	64210	Skyldig SH (søgne-/helligdage)	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
207	65200	Kreditor efterpostering	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
211	66100	Salgsmoms	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
212	66150	Moms af varekøb i udlandet	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
213	66155	Moms af ydelseskøb i udlandet med omvendt betalingspligt	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
214	66160	Olieafgift	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
215	66170	Elafgift	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
216	66180	Vandafgift	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
217	66200	Købsmoms	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
37	4140	Særlig indkomst	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
61	5250	Elafgift	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
62	5260	Privat andel el	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
120	9300	Lejede lokaler	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
121	9500	Indgået på tidligere afskrevne f	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
132	9990	Ikke-fradragsberettigede renter	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
204	65050	Forudbetalt fra kunder	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
206	65100	Kreditorer, ubetalte regninger	S		0	\N		\N	0.000	1	\N	\N	\N	\N	0	100.0000
81	6040	SALGSOMKOSTNINGER I ALT	Z		5900	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
104	8000	ADMINISTRATION I ALT	Z		6100	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
82	6099	ADMINISTRATION:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
25	2820	Varekøb udenfor EU	D	E1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
28	2900	Fremmed arbejde	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
32	4100	Løn, A-indkomst	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
33	4110	Medarbejder ATP	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
34	4120	Medarbejder pension	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
36	4130	Bidragsfri A-indkomst	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
2	100	OMSÆTNING:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
14	2000	VARIABLE OMKOSTNINGER:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
15	2001	VAREFORBRUG:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
4	1100	Varesalg DK	D	S1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
5	1200	Salg af ydelser indenfor EU	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
6	1220	Salg af varer indenfor EU	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
7	1250	Salg af ydelser udenfor EU	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
8	1270	Salg af varer udenfor EU	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
10	1300	Fragt ydet	D	S1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
11	1800	Igangværende arbejder	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
12	1900	Tab på debitorer	D	S1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
16	2050	Ydelseskøb i DK	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
17	2100	Varekøb i DK	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
18	2300	Fragt modtaget	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
21	2600	Lagerregulering	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
24	2800	Køb af varer i EU	D	E1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
77	6000	Repræsentation, gaver og blomst.	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
86	6300	Avishold	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
171	60498	PASSIVER	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
172	60499	EGENKAPITAL	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
186	62999	LANGFRISTET GÆLD (over 1 år)	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
189	64097	KORTFRISTET GÆLD (under 1 år)	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
190	64098	SKYLDIGE OMKOSTNINGER	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
191	64099	Løn	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
203	65000	Forudbetalinger	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
210	66099	SKYLDIG MOMS	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
105	8299	KØRSEL:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
116	9099	AFSKRIVNINGER:	H		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
39	4160	Tillæg 	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
40	4170	Optjent SH (søgne-/hellligdagsbetaling)	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
41	4200	Feriepenge brutto	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
42	4205	AM-indkomst	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
43	4210	Virksomhed ATP	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
44	4220	Virksomhed pension	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
45	4230	DA Barsel	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
46	4240	Refusion sygedagpenge	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
51	4310	Arbejdstøj	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
52	4320	AER/AES/ATP-fib	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
72	5940	Konferencer	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
73	5950	Messer	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
74	5960	Pakkeporto	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
76	5990	Repræsentation, restaurant	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
64	5360	Privat andel varme	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
66	5500	Reparation og vedligeholdelse	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
69	5900	Annoncer & reklame	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
70	5910	Dekoration	D	K1	0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
71	5930	Rejseudgifter	D		0	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
219	66950	Skyldig moms i alt	Z		66100	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
123	9600	RESULTAT FØR FINANSIERING	Z		1	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
127	9870	RENTEINDTÆGTER M.V. I ALT	Z		9800	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
131	9960	FRADRAGSBERETTIGEDE RENTEUDGIFTE	Z		9900	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
133	10000	RENTEUDGIFTER M.V. I ALT	Z		9900	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
134	11000	RESULTAT I ALT	Z		1	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
145	50850	IMMATERIELLE ANLÆGSAKTIVER I ALT	Z		50790	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
152	51995	Anlægsaktiver	Z		50000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
155	55995	Varebeholdning	Z		55000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
159	56295	Tilgode for salg	Z		56000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
162	56995	Andre tilgodehavender	Z		56300	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
163	56999	Tilgodehavender	Z		56000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
168	58998	Likvide beholdninger i alt	Z		58000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
169	58999	OMSÆTNINGSAKTIVER I ALT	Z		55099	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
170	59999	AKTIVER I ALT	Z		50000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
174	60800	Årets resultat	R		11000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
185	62995	Egenkapital	Z		60000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
188	63099	LANGFRISTET GÆLD I ALT	Z		63000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
202	64300	Løn ialt	Z		64000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
205	65095	Forudbetalinger i alt	Z		65000	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
208	65995	Kreditorer	Z		65100	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
209	65999	SKYLDIGE OMKOSTNINGER I ALT	Z		64098	\N		0.000	0.000	1	\N	\N	\N	\N	0	100.0000
\.


--
-- Data for Name: kostpriser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY kostpriser (id, vare_id, transdate, kostpris) FROM stdin;
\.


--
-- Data for Name: lagerstatus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY lagerstatus (id, lager, vare_id, beholdning, lok1, lok2, lok3, lok4, lok5) FROM stdin;
\.


--
-- Data for Name: loen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY loen (id, nummer, kategori, loendate, sag_id, sag_nr, tekst, ansatte, fordeling, timer, t50pct, t100pct, hvem, oprettet, afsluttet, godkendt, sum, oprettet_af, afsluttet_af, godkendt_af, master_id, loen, afvist, afvist_af, udbetalt, art, skur, datoer, afregnet, afregnet_af, korsel, opg_id, opg_nr, afvist_pga, sag_ref, feriefra, ferietil) FROM stdin;
\.


--
-- Data for Name: loen_enheder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY loen_enheder (id, loen_id, vare_id, op, ned, tekst, pris_op, pris_ned, op_25, ned_25, op_30m, ned_30m, op_40, ned_40, op_60, ned_60, op_tag, ned_tag, varenr) FROM stdin;
\.


--
-- Data for Name: mappe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mappe (id, beskrivelse, sort) FROM stdin;
\.


--
-- Data for Name: mappebilag; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY mappebilag (id, navn, beskrivelse, datotid, hvem, assign_to, assign_id, filtype, sort) FROM stdin;
\.


--
-- Data for Name: materialer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY materialer (id, beskrivelse, densitet, materialenr, tykkelse, kgpris, avance, enhed, opdat_date, opdat_time) FROM stdin;
\.


--
-- Data for Name: modtageliste; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY modtageliste (id, initdate, modtagdate, modtagnote, modtaget, init_af, modtaget_af, hvem, tidspkt) FROM stdin;
\.


--
-- Data for Name: modtagelser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY modtagelser (id, varenr, beskrivelse, leveres, liste_id, lager, ordre_id, vare_id, antal) FROM stdin;
\.


--
-- Data for Name: navigator; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY navigator (bruger_id, session_id, side, returside, konto_id, ordre_id, vare_id) FROM stdin;
\.


--
-- Data for Name: noter; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY noter (id, notat, beskrivelse, datotid, hvem, besked_til, assign_to, assign_id, status, fase, notat_fase, kategori, nr) FROM stdin;
\.


--
-- Data for Name: openpost; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY openpost (id, konto_id, konto_nr, faktnr, amount, refnr, beskrivelse, udlignet, transdate, uxtid, kladde_id, bilag_id, udlign_id, udlign_date, valuta, projekt, valutakurs, forfaldsdate, betal_id, betalings_id) FROM stdin;
\.


--
-- Data for Name: opgaver; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY opgaver (id, assign_id, assign_to, nr, beskrivelse, omfang, ref, status, tidspkt, hvem, oprettet_af, kunde_ref, opg_planfra, opg_plantil, opg_tilknyttil) FROM stdin;
\.


--
-- Data for Name: ordrelinjer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ordrelinjer (id, varenr, beskrivelse, enhed, posnr, pris, rabat, lev_varenr, ordre_id, serienr, vare_id, antal, leveres, leveret, bogf_konto, oprettet_af, bogfort_af, hvem, tidspkt, kred_linje_id, momsfri, momssats, kostpris, samlevare, projekt, m_rabat, rabatgruppe, folgevare, kdo, rabatart, variant_id, procent, omvbet, saet, fast_db, afd, lager, tilfravalg) FROM stdin;
\.


--
-- Data for Name: ordrer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ordrer (id, konto_id, firmanavn, addr1, addr2, postnr, bynavn, land, kontakt, email, mail_fakt, udskriv_til, kundeordnr, lev_navn, lev_addr1, lev_addr2, lev_postnr, lev_bynavn, lev_kontakt, ean, institution, betalingsbet, betalingsdage, kontonr, cvrnr, art, valuta, valutakurs, sprog, projekt, ordredate, levdate, fakturadate, notes, ordrenr, sum, momssats, status, ref, fakturanr, modtagelse, kred_ord_id, lev_adr, kostpris, moms, hvem, tidspkt, betalt, nextfakt, pbs, mail, mail_cc, mail_bcc, mail_subj, mail_text, felt_1, felt_2, felt_3, felt_4, felt_5, vis_lev_addr, restordre, betalings_id, sag_id, tilbudnr, datotid, nr, returside, sagsnr, dokument, procenttillag, mail_bilag, omvbet, afd, kontakt_tlf) FROM stdin;
\.


--
-- Data for Name: ordretekster; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ordretekster (id, tekst, sort) FROM stdin;
\.


--
-- Data for Name: pbs_kunder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pbs_kunder (id, konto_id, kontonr, pbs_nr) FROM stdin;
\.


--
-- Data for Name: pbs_linjer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pbs_linjer (id, liste_id, linje) FROM stdin;
\.


--
-- Data for Name: pbs_liste; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pbs_liste (id, liste_date, afsendt) FROM stdin;
\.


--
-- Data for Name: pbs_ordrer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pbs_ordrer (id, liste_id, ordre_id) FROM stdin;
\.


--
-- Data for Name: pos_betalinger; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pos_betalinger (id, ordre_id, betalingstype, amount, valuta, valutakurs) FROM stdin;
\.


--
-- Data for Name: pos_buttons; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pos_buttons (id, menu_id, col, "row", colspan, rowspan, beskrivelse, vare_id, funktion, color) FROM stdin;
\.


--
-- Data for Name: provision; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY provision (id, gruppe_id, ansat_id, provision) FROM stdin;
\.


--
-- Data for Name: rabat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rabat (id, rabat, debitorart, debitor, vareart, vare, rabatart) FROM stdin;
\.


--
-- Data for Name: regulering; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY regulering (id, vare_id, variant_id, lager, beholdning, optalt, tidspkt, bogfort, transdate, logtime, bogfort_af) FROM stdin;
\.


--
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY reservation (linje_id, batch_kob_id, batch_salg_id, vare_id, antal, lager) FROM stdin;
\.


--
-- Data for Name: sager; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sager (id, konto_id, firmanavn, addr1, addr2, postnr, bynavn, land, kontakt, email, beskrivelse, omfang, ref, udf_firmanavn, udf_addr1, udf_addr2, udf_postnr, udf_bynavn, udf_kontakt, status, tidspkt, hvem, oprettet_af, kunde_ref, planfraop, plantilop, planfraned, plantilned, beregn_opret, beregn_tilbud, beregner, beregn_beskrivelse) FROM stdin;
\.


--
-- Data for Name: sagstekster; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sagstekster (id, tekstnr, beskrivelse, tekst) FROM stdin;
\.


--
-- Data for Name: serienr; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY serienr (id, vare_id, kobslinje_id, salgslinje_id, batch_kob_id, batch_salg_id, serienr) FROM stdin;
\.


--
-- Data for Name: shop_adresser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY shop_adresser (id, saldi_id, shop_id) FROM stdin;
\.


--
-- Data for Name: shop_ordrer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY shop_ordrer (id, saldi_id, shop_id) FROM stdin;
\.


--
-- Data for Name: shop_varer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY shop_varer (id, saldi_id, shop_id) FROM stdin;
\.


--
-- Data for Name: simulering; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY simulering (id, kontonr, bilag, transdate, beskrivelse, debet, kredit, faktura, kladde_id, projekt, ansat, logdate, logtime, afd, ordre_id, valuta, valutakurs, moms, adresser_id) FROM stdin;
\.


--
-- Data for Name: styklister; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY styklister (id, vare_id, indgaar_i, antal, posnr) FROM stdin;
\.


--
-- Data for Name: tabeller; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tabeller (id, person, ordre, pnummer, operation, materiale, tykkelse, laengde, bredde, antal_plader, gaa_hjem, tid, forbrugt_tid, opsummeret_tid, beregnet, pause, antal, faerdig, circ_time) FROM stdin;
\.


--
-- Data for Name: tekster; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tekster (id, sprog_id, tekst_id, tekst) FROM stdin;
1	1	92	Vejledning
2	1	161	Klik her hvis du vil logge ud af SALDI
3	1	94	<big><big><big><b>= SALDI =</b></big></big></big>
4	1	91	Her finder du det, som vedrører selve regnskabet.
5	1	95	<b>FINANS</b>
6	1	96	Her finder du det, som vedrører dine kunder.
7	1	99	<b>DEBITOR</b>
8	1	97	Her finder du det, som vedrører dine leverandører.
9	1	100	<b>KREDITOR</b>
10	1	101	Her finder du det, som vedrører dine varer.
11	1	102	<b>LAGER</b>
12	1	103	Her foretager du opsætning af regnskabet.
13	1	104	<b>SYSTEMDATA</b>
14	1	98	Klik her når du skal bogføre eller ompostere.
15	1	105	Kassekladder
16	1	106	Klik her når du skal oprette salgsordrer eller fakturaer til kunder.
17	1	107	Ordrer
18	1	108	Klik her når du skal oprette indkøbsordrer eller modtage varer til videresalg.
19	1	109	Klik her når du skal oprette varer eller generere indkøbsforslag.
20	1	110	Varer
21	1	112	Klik her for at se eller rette i kontoplanen.
22	1	113	Kontoplan
23	1	114	Klik her for at se en månedsopdelt regnskabsoversigt.
24	1	115	Regnskab
25	1	116	Klik her for at komme til kundeliste, historik og jobkort.
26	1	117	Konti
27	1	118	Klik her for at komme til leverandørliste.
28	1	181	Klik her for at foretage modtagelse af varer som tidligere er bestilt.
29	1	182	Varemodtagelse
30	1	121	Klik her for at rette i forskellige indstillinger for moms, kunde-, leverandør- og varegrupper, afdelinger, stamdate, lagre, regnskabsår, formularer og diverse indstillinger.
31	1	122	Indstillinger
32	1	123	Klik her for momsrapport, resultatopgørelse, balance og kontokort. Her finder du også kontrolspor, hvor du kan søge på stort set alt, som er bogført.
33	1	124	Rapporter
34	1	125	Klik her for at se åbne poster og kontokort for dine kunder. Her kan du også skrive rykkere og få en oversigt over de 100 kunder med med største omsætning.
35	1	126	Klik her for at se åbne poster og kontokort for dine leverandører. Her kan du også lave betalingslister til banken.
36	1	127	Klik ker for at få overblik over dit vareflow og se beholdning for dit lager på et vilkårligt tidspunkt.
37	1	128	Her kan du gemme en sikkerhedskopi af hele dit regnskab, eller indlæse en tidligere gemt sikkerhedskopi.
38	1	450	Kreditorrapporter
39	1	437	Skriv en dato i formatet ddmmåå, f.eks 311210 for at se bevægelser inden danne dato<br>eller skriv et datointerval f.eks. 010110:311210.<br>Kontosaldi anvender kun slutdatoen.
40	1	438	Dato
41	1	439	Skriv et kundenummer eller et interval adskilt af kolon. Listen vil blive sorteret efter kundenummer<br>Der kan også skrives et kontonavn,<br>f.eks<br>Skrives DANOSOFT aps vises kun bevægelser for DANOSOFT aps<br>DANO* vil vise bevægelser for alle hvor navnet starter med DANO<br>*aps vil vise alle hvor navnet slutter på aps<br>*SOFT* viser alle hvor navnet indeholder soft
42	1	440	Konto
43	1	451	Afmærk her hvis din søgning skal huskes
44	1	452	Husk
45	1	441	Åbne poster
46	1	444	Viser en aldersfordelt liste over forfaldne/ubetalte udeståender på valgte konti pr. den angivne dato
47	1	442	Kontosaldo
48	1	445	Viser en liste over saldi på valgte konti pr. den angivne dato
49	1	443	Kontokort
50	1	446	Viser en specifikation af kontobevægelser på valgte konti i det angivne datointerval.
51	1	531	Betalingslister til bank, hvor betalingsID og dato er angivet ved bogføring
52	1	532	Betalingslister
53	1	449	Debitorrapporter
54	1	447	Liste over de 100 debitorer med den højeste omsætning de seneste 12 måneder.
55	1	448	Top 100
56	1	455	Kassespor
57	1	154	Dine ændringer er ikke blevet gemt! Tryk OK for at forlade siden uden at gemme.
58	1	509	Kontospecifikation alle valgte konti i valgt periode
59	1	515	Kontokort
60	1	510	Kontospecifikation fra valgte momsbelagte konti i valgt periode. Viser moms for posteringer hvor momsen er trukket automatisk.
61	1	516	Kontokort med moms
62	1	511	Saldo for statuskonti og summering af disse for valgte konti i valgt periode.
63	1	517	Balance
64	1	512	Saldo for driftkonti og summering af disse for valgte konti i valgt periode.
65	1	518	Resultat
66	1	513	Saldo for driftkonti + budgettal og summering af disse for valgte konti i valgt periode.
67	1	519	Resultat/budget
68	1	514	Saldo for momskonti og summering i valgt periode.
69	1	520	Momsangivelse
70	1	89	Vælg alle
71	1	198	Klik her for at skifte til forrige ordre på ordrelisten - husk at gemme eventuelle ændringer først.
72	1	199	Klik her for at skifte til næste ordre på ordrelisten - husk at gemme eventuelle ændringer først.
73	1	155	Vil du slette denne ordre?
74	1	156	Klik her for at slette hele ordren. Hvis du blot vil slette en ordrelinje skal du sætte - (minus) som pos.nr.
75	1	30	Luk
76	1	356	Debitorkort
77	1	39	Ny
78	1	354	Erhverv
79	1	353	Privat
80	1	355	Vis leveringsadresse
81	1	357	Kundenr.
82	1	360	Firmanavn
83	1	361	Adresse
84	1	362	Adresse2
85	1	363	Postnr./By
86	1	364	Land
87	1	365	E-mail / brug mail
88	1	366	Afm&aelig;rk her hvis modtageren skal modtage tilbud, ordrer, fakturaer & rykker pr. mail
89	1	367	Hjemmeside
90	1	368	Betalingsbetingelse
91	1	369	Forud
92	1	370	Kontant
93	1	371	Efterkrav
94	1	373	Lb. md.
95	1	374	Debitorgruppe
96	1	376	CVR-nr.
97	1	377	Telefon
98	1	378	Telefax
99	1	379	EAN-nr.
100	1	380	Institutionsnr.
101	1	381	Kreditmax
102	1	382	Bank reg.
103	1	383	Bank konto
104	1	385	PBS
105	1	386	Kundeansvarlig
106	1	496	Vælg "Ny Status" for at tilføje en ny status
107	1	494	Status.
108	1	495	Ny status
109	1	387	Lukket
110	1	502	Kontakt
111	1	388	Kategorier
112	1	390	For at oprette en ny kategori skrives navnet p&aring; kategorien her. For at oprette en underkategori skrives id på den overstående kategori foran navnet med | som adskillelse, f.eks 31|Herresokker. Id findes ved at holde musen over kategoriens navn.
113	1	343	Skriv evt. ny kategori her
114	1	391	Bem&aelig;rkning
115	1	392	Kontaktpersoner
116	1	130	Vis historik.
117	1	131	Historik
118	1	132	Vis Kontokort.
119	1	133	Kontokort
120	1	129	Vis fakturaliste.
121	1	134	Fakturaliste
122	1	38	Jobliste
123	1	255	Ekstrafelt 1
124	1	346	Navn skal angives
125	1	254	Ekstrafelter
126	1	260	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 255 & 260.
127	1	261	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 256 & 261.
128	1	256	Ekstrafelt 2
129	1	262	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 257 & 262.
130	1	257	Ekstrafelt 3
131	1	263	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 258 & 263.
132	1	258	Ekstrafelt 4
133	1	264	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 259 & 264.
134	1	259	Ekstrafelt 5
135	1	395	S&aelig;t flueben her for at knytte $firmanavn til denne kategori
136	1	396	Klik her for at omd&oslash;be denne kategori
137	1	397	Klik her for at slette denne kategori
138	1	90	Fravælg alle
139	1	215	Emne og tekst til brug ved udsendelse som e-mail
140	1	217	Skriv overskriften til den email som bruges, når der sendes pr. mail.
141	1	216	Emne
142	1	219	Skriv teksten til den email som bruges, når der sendes pr. mail. HTML koder accepteres.
143	1	218	Mailtekst
144	1	672	Skriv navn til vedhæftet bilag, når der sendes pr. mail.
145	1	671	Bilag
146	1	505	Klik her for at eksportere valgte transaktioner til CSV-fil for import i andet program, f.eks. regneark.
147	1	427	Prislister
148	1	170	Øredifferencer
149	1	200	Massefakturering
150	1	271	PoS-valg
151	1	507	Klik her for at oprette nyt regnskabsår.
152	1	508	Opret nyt regnskabsaar
153	1	265	Indstillinger for POS ordrer.
154	1	266	Skriv her hvor mange kasseapperater der er i alt i alle butikker.
155	1	267	Antal kasser.
156	1	279	Skriv her hvor mange forskellige kreditkort der modtages
157	1	280	Antal kreditkort
158	1	673	Skriv her hvor mange borde der skal registreres
159	1	674	Antal borde
160	1	453	Afmærk her for at finansbogføre hver handel separat. Hvis der ikke er afmærket, foretages bogføring samlet ved kasseoptælling.
161	1	454	Bogfør hver handel.
162	1	456	Afmærk her for at for at udskrive bon automatisk. Hvis der ikke er afmærket, skal bon udskrives manuelt efter hver handel.
163	1	457	Udskriv bon automatisk.
164	1	458	Afmærk her for at vise knappen [Kontant på beløb]. Kan bruges ved kassesalg hvor der ikke skal beregnes returbeløb.
165	1	459	Vis knap [Kontant på beløb]
166	1	460	Afmærk her for at vise knappen [Kontoopslag]. Bruges ved kassesalg til kontokunder
167	1	461	Vis knap [Kontoopslag]
168	1	464	Afmærk her for at vise knappen [Indbetaling]. Bruges til kontokunder som indbetaler til konto
169	1	465	Vis knap [Indbetaling]
170	1	734	Hvis dette felt er afmærket gives mulighed for at give en speciel pris på en gruppe af varer. Varene samles på bonnen uden pris på de enkelte varer og prisen vises som sætpris under varerne.
171	1	735	Vis knap [Sæt]
172	1	744	Varenr. for sæt
173	1	462	Antal sekunder siden med [Udskriv] og [Ny kunde] skal blive stående før der skifter til ny ordre. Hvis tallet er 0 skiftes aldrig.
174	1	463	Tidsfrist for udskrift
175	1	701	Skriv her hvor meget kassebeholdningen er ved dagens start. Hvis tallet er nul, tælles den aktuelle beholdning.
176	1	700	Kassebeholdning, morgen
177	1	703	Afmærk her, hvis kasseoptællingen skal assisteres med formular til antal af mønter & sedler.
178	1	702	Assistance til kasseoptælling
179	1	434	Her kan skrives en alternativ SMTP-server til brug for udsendelse af ordrer mm. Den angivne server skal tillade videresendelse af mails fra ssl.saldi.dk. Hvis serveren bruger anden port 25 skrives denne efter STMP navnet adskilt af ":". F.eks. smtp.gmail.com:465
180	1	435	Alternativ SMTP-server:port
181	1	749	Brugernavn til SMTP serveren, hvis dette kræves.
182	1	746	Brugernavn.
183	1	750	Adgangskode til SMTP serveren, hvis dette kræves.
184	1	747	Adgangskode.
185	1	751	Krypteringsmetode til SMTP serveren, hvis dette kræves.
186	1	748	Krypering.
187	1	436	Skift
188	1	418	R&oslash;d
189	1	419	Gr&oslash;n
190	1	420	Bl&aring;
191	1	421	Gul
192	1	422	Magenta (lyselilla)
193	1	423	Cyan (lysebl&aring;)
194	1	207	Hvis du afmærker dette felt, vil SALDI arbejde i popup-vinduer, hvilket gør at man kan have flere vinduer åbne samtidig.
195	1	208	Anvend popup-vinduer
196	1	525	Hvis dette felt afmærkes vil hverken fremkomme menu i toppen eller siden og hele siden kan anvendes som arbejdsområde.
197	1	524	Klassisk udseende
198	1	209	Her skriver du de parametrer, som passer bedst til din browsers popup-funktioner
199	1	210	Popup-indstillinger
200	1	318	Her skriver du hex-værdien for den ønskede baggrundsfarve eksempelvis ff9933 for orange. Se flere værdier på www.html.dk/dokumentation/farver
201	1	317	Baggrundsfarve
202	1	416	Fremh&aelig;ver eksempelvis ordre med den angivne farvenuance, hvor der mangler levering eller modtagelse
203	1	415	Fremh&aelig;vning
204	1	417	V&aelig;lg farvenuance til fremh&aelig;vning
205	1	197	Når dette felt er afmærket, vises priser på kundeordrer, fakturaudskrifter osv. inkl. moms.
206	1	196	Vis priser inkl. moms på kundeordrer
207	1	188	Hvis dette felt afmærkes, medtages kommentarlinjer fra tilbud/ordrer på følgesedler.
208	1	164	Medtag kommentarer på følgesedler
209	1	189	Hvis dette felt afmærkes, medtages kun de varer, som er med i den pågældende leverering på følgesedlen.
210	1	169	Medtag kun linjer med antal på følgeseddel
211	1	190	Hurtigfakturering anvendes, hvis man ikke har behov for at skrive tilbud/følgesedler, og hvor lagerttræk skal ske ved fakturering
212	1	165	Anvend hurtigfakturering (ingen tilbud & automatisk levering ved fakturering)
213	1	191	Hvis dette felt ikke er afmærket, skal købs- og salgsfakturaer bogføres gennem kassekladden med [Hent ordrer]-funktionen.
214	1	166	Omgående bogføring af købs- og salgsordrer
215	1	313	Hvis dette felt er afmærket styres lager efter FIFO (first in first out) princippet og kostprisen reguleres automatisk efter sidste varekøb.
216	1	314	Anvend FIFO på lagervarer
217	1	732	Vælg om kostpriser skal reguleres til gennemsnitspris, genanskaffelsespris eller ikke skal reguleres, ved varekøb
218	1	731	Aut. regulering af kostpriser
219	1	192	Afmærk dette felt for at tillade negativ lagerbeholdning.
220	1	183	Tillad negativ lagerbeholdning
221	1	743	Afmærkes dette felt bliver det muligt at ændre prisen på bundlinjen i en salgsordre og der bliver givet en samlet rabat, som ved bogføring fordeles på de enkelte varer.
222	1	742	Anvend samlet pris
223	1	680	Afmærkes dette felt vil der komme en advarsel, hvis der indsættes varer, som ikke kan leveres, på en kundeordre.
224	1	714	Advar ved for lav lagerbeholdning
225	1	682	Afmærkes her, kommer et ekstra felt på kundeordrer til procentfakturering af vareværdien. Bruges f.eks ved udlejning af materiel.
226	1	681	Anvend procentfakturering
227	1	684	Skrives en værdi her, vil den fremkomme et redigerbart felt på ordresiden med den angivne værdi. Procenttillægget er et tillæg til den samlede fakturasum før momsberegning.
228	1	683	Procenttillæg
229	1	686	Angiv her hvilken konto i kontoplanen procenttillægget skal konteres på.
230	1	685	Varenr. for procenttillæg
231	1	288	For at kunne give rabat på kontantsalg, skal dette felt udfyldes med varenummeret for den vare som bruges til formålet.
232	1	287	Varenr. for rabat
233	1	688	Angiv hvilken konto betalingen skal konteres på ved kontantsalg. Hvis feltet er tomt oprettes en åben post på beløbet på kundens konto.
234	1	687	Kontonummer for kontantsalg.
235	1	690	Angiv hvilken konto betalingen skal konteres på ved salg på kreditkort. Hvis feltet er tomt oprettes en åben post på beløbet på kundens konto.
236	1	689	Kontonummer for salg på kreditkort.
237	1	470	Varerelaterede valg
238	1	469	Hvis dette felt er udfyldt, vises salgspriser på varekort inkl. moms.
239	1	468	Momskode for salgspriser på varekort
240	1	471	Gem/opdat&eacute;r
241	1	472	Varianter
242	1	475	Variant
243	1	476	Værdi
244	1	485	Varianter for varer, f.eks Farve eller Størrelse.
245	1	474	Ny variant
246	1	695	Vælg her om du vil anvende Saldi's interne shop eller en ekstern via API.
247	1	697	Ingen webshop
248	1	698	Intern webshop
249	1	699	Ekstern webshop
250	1	428	Rabat
251	1	429	Varegruppe
252	1	430	Aktiv
253	1	431	Skriv den generelle rabat for varer fra $beskrivelse
254	1	432	V&aelig;lg den generelle varegruppe til varer fra $beskrivelse
255	1	224	Brugernavn for "rykkeransvarlig" - Når brugeren logger ind, adviseres denne, hvis der skal rykkes - Hvis navn ikke angives adviseres alle.
256	1	225	Brugernavn
257	1	226	Mailadresse for "rykkeransvarlig". Hvis angivet sendes email fra denne adresse, når der skal rykkes. (Når nogen logger ind - uanset hvem)
258	1	227	Mailadresse
259	1	232	Antal dage betalingsfrist skal være overskredet, før rykker 1 genereres.
260	1	233	Frist for rykker 1.
261	1	234	Antal dage betalingsfrist for rykker 1 skal være overskredet, før rykker 2 genereres.
262	1	235	Frist for rykker 2.
263	1	236	Antal dage betalingsfrist for rykker 2 skal være overskredet, før rykker 3 genereres.
264	1	237	Frist for rykker 3.
265	1	186	Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge debitorgruppe ved oprettelse af debitorer.
266	1	162	Tvungen valg af debitorgruppe på debitorkort
267	1	187	Hvis dette felt afmærkes, tvinges brugeren til aktivt at vælge kundeansvarlig ved oprettelse af debitorer.
268	1	163	Tvungen valg af kundeansvarlig på debitorkort
269	1	615	Ved at afmærke her får du op til 14 ekstra felter på ansattes stamkort, for egne ansattes.
270	1	616	Tilføj ekstra felter på ansatte
271	1	185	Betalingslister giver mulighed for at overføre betalinger til bank via ERH (bankernes erhvervesformater). Hvis dette felt er afmærket, vil der komme er ekstra felt på kassekladden til betalings-id ved bogføring af kreditorfakturaer, ligesom knappen [Betalingsliste] vil være synlig under kreditorrapporter.
272	1	184	Brug betalingslister
273	1	193	Docubizz er en aplikation til håndtering af indscannede dokumenter. Se mere om denne funktion på www.docubizz.dk
274	1	167	Integration med DocuBizz
275	1	194	Jobkort findes i debitorkonti. Her kan du definere opgavebeskrivelser til medarbejdere osv.
276	1	168	Brug jobkort
277	1	617	Afmærkes feltet anvendes HTML/CSS til formulargenerering.
278	1	618	Brug HTML/CSS til formulargenerering
279	1	709	Afmærk her for at undtrykke advarsel i kassekladden, hvis der anvendes samme bilagsnummer til flere bilag med forskellige datoer. (F.eks, hvis et kontoudtog fra bank bogføres som ét bilag).
280	1	708	Tillad forskellige datoer på samme bilagsnummer i kassekladde.
281	1	527	Afmærk her hvis du har en ftp-konto hos ebConnect og ønsker at kunne sende OIOUBL-fakturaer direkte til modtager.
282	1	526	Integration med ebConnect
283	1	720	Afmærk her hvis du har en google konto. Så vil du kunne se næsten alle dokumentformater. Eller kan du kun se de formater din browser understøtter.
284	1	719	Brug Google Docs viewer
285	1	171	Skriv det maksimale beløb for øredifferencer angivet i kroner, som må udlignes i åbne poster
286	1	172	Maksimalt beløb for øredifferencer (i kroner)
287	1	173	Skriv det kontonummer i kontoplanen som skal bruges til øredifferencer
288	1	174	Kontonummer for øredifferencer
289	1	202	Hvis du aktiverer massefakturering, har du mulighed for at fakturere alle godkendte salgsordrer i en arbejdsgang.
290	1	201	Aktiver massefakturering
291	1	204	Hvis du afmærker dette felt, vil ordrer, hvor ikke alt er på lager, blive delleveret/-faktureret.
292	1	203	Medtag delleverancer
293	1	206	Her angiver du, hvor mange dage gammel en ordre skal være, før der foretages en dellevering/-fakturering.
294	1	205	Frist for dellevering (dage)
295	1	1	Dansk
296	1	2	Vælg aktivt sprog
297	1	3	Gem
298	1	31	Nuværende tekst
299	1	33	Skriv nyt tekstforslag
300	1	32	Ny tekst
301	1	737	Her indsættes html kode til formatering af labelprint i varekort. Du kan finde eksempler på <a href=http://forum.saldi.dk/viewtopic.php?f=17&t=1159>Saldi forum</a> under tips og tricks.
302	1	736	Labelprint
303	1	503	Hvis der benyttes API til webshop skrives URL til shoppens funktionsmappe her.
304	1	301	Ekstrafelter
305	1	307	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 302 & 307.
306	1	302	Ekstrafelt 1
307	1	303	Ekstrafelt 2
308	1	309	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 304 & 309.
309	1	304	Ekstrafelt 3
310	1	310	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 305 & 310.
311	1	305	Ekstrafelt 4
312	1	311	Denne tekst kan rettes under <i>Indstillinger</i> -> <i>Diverse</i> -> <i>Sprog</i><br>Find Id 306 & 311.
313	1	306	Ekstrafelt 5
\.


--
-- Data for Name: tidsreg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tidsreg (id, person, ordre, pnummer, operation, materiale, tykkelse, laengde, bredde, antal_plader, gaa_hjem, tid, forbrugt_tid, opsummeret_tid, beregnet, pause, antal, faerdig, circ_time) FROM stdin;
\.


--
-- Data for Name: tjekliste; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tjekliste (id, tjekpunkt, fase, assign_to, assign_id, sagsnr) FROM stdin;
\.


--
-- Data for Name: tjekpunkter; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tjekpunkter (id, tjekliste_id, assign_id, status, status_tekst, tjekskema_id) FROM stdin;
\.


--
-- Data for Name: tjekskema; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tjekskema (id, tjekliste_id, datotid, opg_art, sjak, sag_id, hvem, man_trans, stillads_til, opg_navn, opg_beskrivelse, sjakid) FROM stdin;
\.


--
-- Data for Name: tmpkassekl; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tmpkassekl (id, lobenr, bilag, transdate, beskrivelse, d_type, debet, k_type, kredit, faktura, amount, kladde_id, momsfri, afd, projekt, ansat, valuta, valutakurs, forfaldsdate, betal_id, dokument) FROM stdin;
\.


--
-- Data for Name: transaktioner; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY transaktioner (id, kontonr, bilag, transdate, logtime, beskrivelse, debet, kredit, faktura, kladde_id, projekt, ansat, logdate, afd, ordre_id, valuta, valutakurs, moms, adresser_id, kasse_nr) FROM stdin;
\.


--
-- Data for Name: valuta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY valuta (id, gruppe, valdate, kurs) FROM stdin;
1	1	2016-12-06	112.000
2	1	2016-12-08	122.000
\.


--
-- Data for Name: vare_lev; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY vare_lev (id, posnr, lev_id, vare_id, lev_varenr, kostpris) FROM stdin;
\.


--
-- Data for Name: varer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY varer (id, varenr, stregkode, beskrivelse, enhed, enhed2, indhold, forhold, gruppe, salgspris, kostpris, provisionsfri, notes, lukket, serienr, beholdning, samlevare, delvare, min_lager, max_lager, trademark, location, retail_price, special_price, campaign_cost, tier_price, open_colli_price, colli, outer_colli, outer_colli_price, special_from_date, special_to_date, special_from_time, special_to_time, komplementaer, circulate, operation, prisgruppe, tilbudgruppe, rabatgruppe, dvrg, m_type, m_rabat, m_antal, folgevare, kategori, varianter, publiceret, fotonavn, tilbudsdage) FROM stdin;
1	12345	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
\.


--
-- Data for Name: varetekster; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY varetekster (id, sprog_id, vare_id, tekst) FROM stdin;
\.


--
-- Data for Name: varetilbud; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY varetilbud (id, vare_id, startdag, slutdag, starttid, sluttid, ugedag, salgspris, kostpris) FROM stdin;
\.


--
-- Data for Name: variant_typer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY variant_typer (id, variant_id, shop_id, beskrivelse) FROM stdin;
\.


--
-- Data for Name: variant_varer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY variant_varer (id, vare_id, variant_type, variant_beholdning, variant_stregkode, lager) FROM stdin;
\.


--
-- Data for Name: varianter; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY varianter (id, beskrivelse, shop_id) FROM stdin;
\.


--
-- Name: adresser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY adresser
    ADD CONSTRAINT adresser_pkey PRIMARY KEY (id);


--
-- Name: ansatmappe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ansatmappe
    ADD CONSTRAINT ansatmappe_pkey PRIMARY KEY (id);


--
-- Name: ansatmappebilag_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ansatmappebilag
    ADD CONSTRAINT ansatmappebilag_pkey PRIMARY KEY (id);


--
-- Name: ansatte_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ansatte
    ADD CONSTRAINT ansatte_pkey PRIMARY KEY (id);


--
-- Name: batch_kob_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY batch_kob
    ADD CONSTRAINT batch_kob_pkey PRIMARY KEY (id);


--
-- Name: batch_salg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY batch_salg
    ADD CONSTRAINT batch_salg_pkey PRIMARY KEY (id);


--
-- Name: betalinger_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY betalinger
    ADD CONSTRAINT betalinger_pkey PRIMARY KEY (id);


--
-- Name: betalingsliste_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY betalingsliste
    ADD CONSTRAINT betalingsliste_pkey PRIMARY KEY (id);


--
-- Name: bilag_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bilag
    ADD CONSTRAINT bilag_pkey PRIMARY KEY (id);


--
-- Name: brugere_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY brugere
    ADD CONSTRAINT brugere_pkey PRIMARY KEY (id);


--
-- Name: budget_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY budget
    ADD CONSTRAINT budget_pkey PRIMARY KEY (id);


--
-- Name: crm_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY crm
    ADD CONSTRAINT crm_pkey PRIMARY KEY (id);


--
-- Name: enheder_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY enheder
    ADD CONSTRAINT enheder_pkey PRIMARY KEY (id);


--
-- Name: formularer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY formularer
    ADD CONSTRAINT formularer_pkey PRIMARY KEY (id);


--
-- Name: grupper_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grupper
    ADD CONSTRAINT grupper_pkey PRIMARY KEY (id);


--
-- Name: historik_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY historik
    ADD CONSTRAINT historik_pkey PRIMARY KEY (id);


--
-- Name: jobkort_felter_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY jobkort_felter
    ADD CONSTRAINT jobkort_felter_pkey PRIMARY KEY (id);


--
-- Name: jobkort_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY jobkort
    ADD CONSTRAINT jobkort_pkey PRIMARY KEY (id);


--
-- Name: kassekladde_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY kassekladde
    ADD CONSTRAINT kassekladde_pkey PRIMARY KEY (id);


--
-- Name: kladdeliste_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY kladdeliste
    ADD CONSTRAINT kladdeliste_pkey PRIMARY KEY (id);


--
-- Name: kontokort_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY kontokort
    ADD CONSTRAINT kontokort_pkey PRIMARY KEY (id);


--
-- Name: kontoplan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY kontoplan
    ADD CONSTRAINT kontoplan_pkey PRIMARY KEY (id);


--
-- Name: kostpriser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY kostpriser
    ADD CONSTRAINT kostpriser_pkey PRIMARY KEY (id);


--
-- Name: lagerstatus_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY lagerstatus
    ADD CONSTRAINT lagerstatus_pkey PRIMARY KEY (id);


--
-- Name: loen_enheder_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY loen_enheder
    ADD CONSTRAINT loen_enheder_pkey PRIMARY KEY (id);


--
-- Name: loen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY loen
    ADD CONSTRAINT loen_pkey PRIMARY KEY (id);


--
-- Name: mappe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mappe
    ADD CONSTRAINT mappe_pkey PRIMARY KEY (id);


--
-- Name: mappebilag_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mappebilag
    ADD CONSTRAINT mappebilag_pkey PRIMARY KEY (id);


--
-- Name: materialer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY materialer
    ADD CONSTRAINT materialer_pkey PRIMARY KEY (id);


--
-- Name: modtageliste_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modtageliste
    ADD CONSTRAINT modtageliste_pkey PRIMARY KEY (id);


--
-- Name: modtagelser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modtagelser
    ADD CONSTRAINT modtagelser_pkey PRIMARY KEY (id);


--
-- Name: noter_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY noter
    ADD CONSTRAINT noter_pkey PRIMARY KEY (id);


--
-- Name: openpost_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY openpost
    ADD CONSTRAINT openpost_pkey PRIMARY KEY (id);


--
-- Name: opgaver_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY opgaver
    ADD CONSTRAINT opgaver_pkey PRIMARY KEY (id);


--
-- Name: ordrelinjer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ordrelinjer
    ADD CONSTRAINT ordrelinjer_pkey PRIMARY KEY (id);


--
-- Name: ordrer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ordrer
    ADD CONSTRAINT ordrer_pkey PRIMARY KEY (id);


--
-- Name: ordretekster_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ordretekster
    ADD CONSTRAINT ordretekster_pkey PRIMARY KEY (id);


--
-- Name: pbs_kunder_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pbs_kunder
    ADD CONSTRAINT pbs_kunder_pkey PRIMARY KEY (id);


--
-- Name: pbs_linjer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pbs_linjer
    ADD CONSTRAINT pbs_linjer_pkey PRIMARY KEY (id);


--
-- Name: pbs_liste_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pbs_liste
    ADD CONSTRAINT pbs_liste_pkey PRIMARY KEY (id);


--
-- Name: pbs_ordrer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pbs_ordrer
    ADD CONSTRAINT pbs_ordrer_pkey PRIMARY KEY (id);


--
-- Name: pos_betalinger_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pos_betalinger
    ADD CONSTRAINT pos_betalinger_pkey PRIMARY KEY (id);


--
-- Name: pos_buttons_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pos_buttons
    ADD CONSTRAINT pos_buttons_pkey PRIMARY KEY (id);


--
-- Name: provision_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY provision
    ADD CONSTRAINT provision_pkey PRIMARY KEY (id);


--
-- Name: rabat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rabat
    ADD CONSTRAINT rabat_pkey PRIMARY KEY (id);


--
-- Name: regulering_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY regulering
    ADD CONSTRAINT regulering_pkey PRIMARY KEY (id);


--
-- Name: sager_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sager
    ADD CONSTRAINT sager_pkey PRIMARY KEY (id);


--
-- Name: sagstekster_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sagstekster
    ADD CONSTRAINT sagstekster_pkey PRIMARY KEY (id);


--
-- Name: serienr_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY serienr
    ADD CONSTRAINT serienr_pkey PRIMARY KEY (id);


--
-- Name: shop_adresser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY shop_adresser
    ADD CONSTRAINT shop_adresser_pkey PRIMARY KEY (id);


--
-- Name: shop_ordrer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY shop_ordrer
    ADD CONSTRAINT shop_ordrer_pkey PRIMARY KEY (id);


--
-- Name: shop_varer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY shop_varer
    ADD CONSTRAINT shop_varer_pkey PRIMARY KEY (id);


--
-- Name: simulering_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY simulering
    ADD CONSTRAINT simulering_pkey PRIMARY KEY (id);


--
-- Name: styklister_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY styklister
    ADD CONSTRAINT styklister_pkey PRIMARY KEY (id);


--
-- Name: tabeller_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tabeller
    ADD CONSTRAINT tabeller_pkey PRIMARY KEY (id);


--
-- Name: tekster_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tekster
    ADD CONSTRAINT tekster_pkey PRIMARY KEY (id);


--
-- Name: tidsreg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tidsreg
    ADD CONSTRAINT tidsreg_pkey PRIMARY KEY (id);


--
-- Name: tjekliste_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tjekliste
    ADD CONSTRAINT tjekliste_pkey PRIMARY KEY (id);


--
-- Name: tjekpunkter_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tjekpunkter
    ADD CONSTRAINT tjekpunkter_pkey PRIMARY KEY (id);


--
-- Name: tjekskema_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tjekskema
    ADD CONSTRAINT tjekskema_pkey PRIMARY KEY (id);


--
-- Name: transaktioner_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY transaktioner
    ADD CONSTRAINT transaktioner_pkey PRIMARY KEY (id);


--
-- Name: valuta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY valuta
    ADD CONSTRAINT valuta_pkey PRIMARY KEY (id);


--
-- Name: vare_lev_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY vare_lev
    ADD CONSTRAINT vare_lev_pkey PRIMARY KEY (id);


--
-- Name: varer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY varer
    ADD CONSTRAINT varer_pkey PRIMARY KEY (id);


--
-- Name: varetekster_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY varetekster
    ADD CONSTRAINT varetekster_pkey PRIMARY KEY (id);


--
-- Name: varetilbud_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY varetilbud
    ADD CONSTRAINT varetilbud_pkey PRIMARY KEY (id);


--
-- Name: variant_typer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY variant_typer
    ADD CONSTRAINT variant_typer_pkey PRIMARY KEY (id);


--
-- Name: variant_varer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY variant_varer
    ADD CONSTRAINT variant_varer_pkey PRIMARY KEY (id);


--
-- Name: varianter_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY varianter
    ADD CONSTRAINT varianter_pkey PRIMARY KEY (id);


--
-- Name: batch_kob_antal_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_kob_antal_idx ON batch_kob USING btree (antal);


--
-- Name: batch_kob_fakturadate_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_kob_fakturadate_idx ON batch_kob USING btree (fakturadate);


--
-- Name: batch_kob_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_kob_id_idx ON batch_kob USING btree (id);


--
-- Name: batch_kob_kobsdate_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_kob_kobsdate_idx ON batch_kob USING btree (kobsdate);


--
-- Name: batch_kob_linje_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_kob_linje_id_idx ON batch_kob USING btree (linje_id);


--
-- Name: batch_kob_vare_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_kob_vare_id_idx ON batch_kob USING btree (vare_id);


--
-- Name: batch_salg_antal_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_salg_antal_idx ON batch_salg USING btree (antal);


--
-- Name: batch_salg_fakturadate_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_salg_fakturadate_idx ON batch_salg USING btree (fakturadate);


--
-- Name: batch_salg_salgsdate_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_salg_salgsdate_idx ON batch_salg USING btree (salgsdate);


--
-- Name: batch_salg_vare_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX batch_salg_vare_id_idx ON batch_salg USING btree (vare_id);


--
-- Name: openpost_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX openpost_id_idx ON openpost USING btree (id);


--
-- Name: openpost_konto_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX openpost_konto_id_idx ON openpost USING btree (konto_id);


--
-- Name: openpost_udlign_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX openpost_udlign_id_idx ON openpost USING btree (udlign_id);


--
-- Name: ordrelinjer_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ordrelinjer_id_idx ON ordrelinjer USING btree (id);


--
-- Name: ordrelinjer_ordreid_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ordrelinjer_ordreid_idx ON ordrelinjer USING btree (ordre_id);


--
-- Name: ordrelinjer_vare_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ordrelinjer_vare_id_idx ON ordrelinjer USING btree (vare_id);


--
-- Name: ordrer_art_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ordrer_art_idx ON ordrer USING btree (art);


--
-- Name: ordrer_betalt_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ordrer_betalt_idx ON ordrer USING btree (betalt);


--
-- Name: ordrer_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ordrer_id_idx ON ordrer USING btree (id);


--
-- Name: ordrer_ordrenr_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ordrer_ordrenr_idx ON ordrer USING btree (ordrenr);


--
-- Name: pos_betalinger_betalingstype_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pos_betalinger_betalingstype_idx ON pos_betalinger USING btree (betalingstype);


--
-- Name: pos_betalinger_ordre_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pos_betalinger_ordre_id_idx ON pos_betalinger USING btree (ordre_id);


--
-- Name: transaktioner_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX transaktioner_id_idx ON transaktioner USING btree (id);


--
-- Name: transaktioner_kontonr_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX transaktioner_kontonr_idx ON transaktioner USING btree (kontonr);


--
-- Name: transaktioner_transdate_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX transaktioner_transdate_idx ON transaktioner USING btree (transdate);


--
-- Name: varer_beskrivelse_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX varer_beskrivelse_idx ON varer USING btree (id);


--
-- Name: varer_id_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX varer_id_idx ON varer USING btree (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                 temp/backup.info                                                                                    0000644 0000060 0000060 00000000063 13052125655 013356  0                                                                                                    ustar   apache                          apache                                                                                                                                                                                                                 20170218-2116	demo_1250	3.6.5	demo111	UTF8	postgres                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             