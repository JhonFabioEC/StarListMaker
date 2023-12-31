PGDMP          	        	    {            StarListMaker_DB    16.0    16.0 �    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16758    StarListMaker_DB    DATABASE     �   CREATE DATABASE "StarListMaker_DB" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Mexico.1252';
 "   DROP DATABASE "StarListMaker_DB";
                postgres    false            �            1259    16759    account_status    TABLE     �   CREATE TABLE public.account_status (
    id smallint NOT NULL,
    name character varying(30) NOT NULL,
    color character varying(30) DEFAULT '#ffffff'::character varying NOT NULL
);
 "   DROP TABLE public.account_status;
       public         heap    postgres    false            �            1259    16763    account_status_id_seq    SEQUENCE     �   CREATE SEQUENCE public.account_status_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.account_status_id_seq;
       public          postgres    false    215            �           0    0    account_status_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.account_status_id_seq OWNED BY public.account_status.id;
          public          postgres    false    216            �            1259    16764    brand    TABLE     �  CREATE TABLE public.brand (
    id smallint NOT NULL,
    name character varying(60) NOT NULL,
    establishment_id bigint NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modification_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deletion_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    state_id smallint DEFAULT 2 NOT NULL,
    delete boolean DEFAULT false NOT NULL
);
    DROP TABLE public.brand;
       public         heap    postgres    false            �            1259    16772    brand_id_seq    SEQUENCE     �   CREATE SEQUENCE public.brand_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.brand_id_seq;
       public          postgres    false    217            �           0    0    brand_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.brand_id_seq OWNED BY public.brand.id;
          public          postgres    false    218            �            1259    16773    category    TABLE     �  CREATE TABLE public.category (
    id smallint NOT NULL,
    name character varying(60) NOT NULL,
    establishment_id bigint NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modification_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deletion_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    state_id smallint DEFAULT 2 NOT NULL,
    delete boolean DEFAULT false NOT NULL
);
    DROP TABLE public.category;
       public         heap    postgres    false            �            1259    16781    category_id_seq    SEQUENCE     �   CREATE SEQUENCE public.category_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.category_id_seq;
       public          postgres    false    219            �           0    0    category_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.category_id_seq OWNED BY public.category.id;
          public          postgres    false    220            �            1259    16782 
   department    TABLE     j   CREATE TABLE public.department (
    id character(3) NOT NULL,
    name character varying(30) NOT NULL
);
    DROP TABLE public.department;
       public         heap    postgres    false            �            1259    16785    document_type    TABLE     �  CREATE TABLE public.document_type (
    id smallint NOT NULL,
    name character varying(60) NOT NULL,
    state_id smallint DEFAULT 2 NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modification_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deletion_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    delete boolean DEFAULT false NOT NULL
);
 !   DROP TABLE public.document_type;
       public         heap    postgres    false            �            1259    16793    document_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.document_type_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.document_type_id_seq;
       public          postgres    false    222            �           0    0    document_type_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.document_type_id_seq OWNED BY public.document_type.id;
          public          postgres    false    223            �            1259    16794    establishment    TABLE     E  CREATE TABLE public.establishment (
    user_id bigint NOT NULL,
    name character varying(60) NOT NULL,
    municipality_id character(3) NOT NULL,
    zone_type_id smallint NOT NULL,
    address character varying(60) NOT NULL,
    phone_number character varying(10) NOT NULL,
    establishment_type_id smallint NOT NULL
);
 !   DROP TABLE public.establishment;
       public         heap    postgres    false            �            1259    16797    establishment_type    TABLE     �  CREATE TABLE public.establishment_type (
    id smallint NOT NULL,
    name character varying(30) NOT NULL,
    state_id smallint DEFAULT 2 NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modification_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deletion_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    delete boolean DEFAULT false NOT NULL
);
 &   DROP TABLE public.establishment_type;
       public         heap    postgres    false            �            1259    16805    establishment_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.establishment_type_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.establishment_type_id_seq;
       public          postgres    false    225            �           0    0    establishment_type_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.establishment_type_id_seq OWNED BY public.establishment_type.id;
          public          postgres    false    226            �            1259    16806    gender    TABLE     �  CREATE TABLE public.gender (
    id smallint NOT NULL,
    name character varying(30) NOT NULL,
    state_id smallint DEFAULT 2 NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modification_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deletion_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    delete boolean DEFAULT false NOT NULL
);
    DROP TABLE public.gender;
       public         heap    postgres    false            �            1259    16814    gender_id_seq    SEQUENCE     �   CREATE SEQUENCE public.gender_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.gender_id_seq;
       public          postgres    false    227            �           0    0    gender_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.gender_id_seq OWNED BY public.gender.id;
          public          postgres    false    228            �            1259    16815    municipality    TABLE     �   CREATE TABLE public.municipality (
    id character(3) NOT NULL,
    name character varying(30) NOT NULL,
    department_id character(3) NOT NULL
);
     DROP TABLE public.municipality;
       public         heap    postgres    false            �            1259    16818    person    TABLE     Y  CREATE TABLE public.person (
    user_id bigint NOT NULL,
    first_name character varying(60) NOT NULL,
    last_name character varying(60) NOT NULL,
    date_of_birth date NOT NULL,
    gender_id smallint NOT NULL,
    document_type_id smallint NOT NULL,
    document_number character varying(30) NOT NULL,
    phone_number character varying(10) NOT NULL,
    municipality_id character(3) NOT NULL,
    zone_type_id smallint NOT NULL,
    address character varying(60) NOT NULL,
    person_rating integer DEFAULT 0 NOT NULL,
    CONSTRAINT person_person_rating_check CHECK ((person_rating >= 0))
);
    DROP TABLE public.person;
       public         heap    postgres    false            �            1259    16823    product    TABLE     �  CREATE TABLE public.product (
    id bigint NOT NULL,
    name character varying(60) NOT NULL,
    brand_id bigint NOT NULL,
    price numeric(10,2) DEFAULT 0 NOT NULL,
    quantity integer DEFAULT 0 NOT NULL,
    barcode character varying(13) NOT NULL,
    category_id smallint NOT NULL,
    section character varying(60) NOT NULL,
    image character varying(250) DEFAULT 'default.svg'::character varying,
    establishment_id bigint NOT NULL,
    description text DEFAULT '-'::text NOT NULL,
    state_id smallint DEFAULT 2 NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modification_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deletion_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    delete boolean DEFAULT false NOT NULL,
    CONSTRAINT product_price_check CHECK ((price >= (0)::numeric)),
    CONSTRAINT product_quantity_check CHECK ((quantity >= 0))
);
    DROP TABLE public.product;
       public         heap    postgres    false            �            1259    16839    product_id_seq    SEQUENCE     w   CREATE SEQUENCE public.product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.product_id_seq;
       public          postgres    false    231            �           0    0    product_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;
          public          postgres    false    232            �            1259    16840 	   role_type    TABLE     �   CREATE TABLE public.role_type (
    id smallint NOT NULL,
    name character varying(30) NOT NULL,
    color character varying(30) DEFAULT '#ffffff'::character varying NOT NULL
);
    DROP TABLE public.role_type;
       public         heap    postgres    false            �            1259    16844    role_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.role_type_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.role_type_id_seq;
       public          postgres    false    233            �           0    0    role_type_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.role_type_id_seq OWNED BY public.role_type.id;
          public          postgres    false    234            �            1259    16845    state    TABLE     �   CREATE TABLE public.state (
    id smallint NOT NULL,
    name character varying(30) NOT NULL,
    color character varying(30) DEFAULT '#ffffff'::character varying NOT NULL
);
    DROP TABLE public.state;
       public         heap    postgres    false            �            1259    16849    state_id_seq    SEQUENCE     �   CREATE SEQUENCE public.state_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.state_id_seq;
       public          postgres    false    235            �           0    0    state_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.state_id_seq OWNED BY public.state.id;
          public          postgres    false    236            �            1259    16850    user    TABLE     �  CREATE TABLE public."user" (
    id bigint NOT NULL,
    image character varying(250) DEFAULT 'default.svg'::character varying,
    username character varying(30) NOT NULL,
    email_address character varying(30) NOT NULL,
    password character varying(200) NOT NULL,
    role_type_id smallint NOT NULL,
    account_status_id smallint DEFAULT 1 NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modification_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deletion_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    delete boolean DEFAULT false NOT NULL
);
    DROP TABLE public."user";
       public         heap    postgres    false            �            1259    16861    user_id_seq    SEQUENCE     t   CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public          postgres    false    237            �           0    0    user_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;
          public          postgres    false    238            �            1259    16862    vehicle    TABLE     �  CREATE TABLE public.vehicle (
    id smallint NOT NULL,
    name character varying(60) NOT NULL,
    state_id smallint DEFAULT 2 NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modification_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deletion_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    delete boolean DEFAULT false NOT NULL
);
    DROP TABLE public.vehicle;
       public         heap    postgres    false            �            1259    16870    vehicle_id_seq    SEQUENCE     �   CREATE SEQUENCE public.vehicle_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.vehicle_id_seq;
       public          postgres    false    239            �           0    0    vehicle_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.vehicle_id_seq OWNED BY public.vehicle.id;
          public          postgres    false    240            �            1259    16871    view_account_status    VIEW     z   CREATE VIEW public.view_account_status AS
 SELECT id,
    name,
    color
   FROM public.account_status ac
  ORDER BY id;
 &   DROP VIEW public.view_account_status;
       public          postgres    false    215    215    215            �            1259    16875    view_authentication_user    VIEW     �  CREATE VIEW public.view_authentication_user AS
 SELECT us.id AS user_id,
    us.image,
    us.username,
    us.email_address,
    us.password,
    rt.name AS role_type,
    ac.name AS account_status
   FROM ((public."user" us
     JOIN public.role_type rt ON ((rt.id = us.role_type_id)))
     JOIN public.account_status ac ON ((ac.id = us.account_status_id)))
  WHERE (us.delete = false)
  ORDER BY us.id;
 +   DROP VIEW public.view_authentication_user;
       public          postgres    false    215    237    237    233    233    215    237    237    237    237    237    237            �            1259    16880 
   view_brand    VIEW     J  CREATE VIEW public.view_brand AS
 SELECT bd.id,
    bd.name,
    bd.establishment_id AS establishment,
    st.name AS state,
    st.color AS state_color,
    (((bd.creation_date)::date || ' '::text) || to_char(bd.creation_date, 'HH24:MI'::text)) AS creation_date,
    (((bd.modification_date)::date || ' '::text) || to_char(bd.modification_date, 'HH24:MI'::text)) AS modification_date
   FROM ((public.brand bd
     JOIN public.state st ON ((st.id = bd.state_id)))
     JOIN public.establishment es ON ((es.user_id = bd.establishment_id)))
  WHERE (bd.delete = false)
  ORDER BY bd.id;
    DROP VIEW public.view_brand;
       public          postgres    false    217    224    217    217    235    235    217    235    217    217    217            �            1259    16885    view_category    VIEW     P  CREATE VIEW public.view_category AS
 SELECT cr.id,
    cr.name,
    cr.establishment_id AS establishment,
    st.name AS state,
    st.color AS state_color,
    (((cr.creation_date)::date || ' '::text) || to_char(cr.creation_date, 'HH24:MI'::text)) AS creation_date,
    (((cr.modification_date)::date || ' '::text) || to_char(cr.modification_date, 'HH24:MI'::text)) AS modification_date
   FROM ((public.category cr
     JOIN public.state st ON ((st.id = cr.state_id)))
     JOIN public.establishment es ON ((es.user_id = cr.establishment_id)))
  WHERE (cr.delete = false)
  ORDER BY cr.id;
     DROP VIEW public.view_category;
       public          postgres    false    219    235    224    219    219    219    219    219    219    235    235            �            1259    16890    view_department    VIEW     g   CREATE VIEW public.view_department AS
 SELECT id,
    name
   FROM public.department dp
  ORDER BY id;
 "   DROP VIEW public.view_department;
       public          postgres    false    221    221            �            1259    16894    view_document_type    VIEW     �   CREATE VIEW public.view_document_type AS
 SELECT id,
    name
   FROM public.document_type dt
  WHERE (delete = false)
  ORDER BY id;
 %   DROP VIEW public.view_document_type;
       public          postgres    false    222    222    222            �            1259    16898 	   zone_type    TABLE     e   CREATE TABLE public.zone_type (
    id smallint NOT NULL,
    name character varying(30) NOT NULL
);
    DROP TABLE public.zone_type;
       public         heap    postgres    false            �            1259    16901    view_establishment    VIEW     �  CREATE VIEW public.view_establishment AS
 SELECT es.user_id,
    us.image,
    es.name,
    et.name AS establishment_type,
    dp.name AS department,
    mt.name AS municipality,
    es.address,
    zt.name AS zone_type,
    es.phone_number,
    us.email_address,
    us.username,
    us.password
   FROM (((((public.establishment es
     JOIN public."user" us ON ((us.id = es.user_id)))
     JOIN public.establishment_type et ON ((et.id = es.establishment_type_id)))
     JOIN public.municipality mt ON ((mt.id = es.municipality_id)))
     JOIN public.department dp ON ((dp.id = mt.department_id)))
     JOIN public.zone_type zt ON ((zt.id = es.zone_type_id)))
  WHERE (us.delete = false)
  ORDER BY es.user_id;
 %   DROP VIEW public.view_establishment;
       public          postgres    false    247    247    237    237    237    237    237    237    229    229    229    225    225    224    224    224    224    224    224    224    221    221            �            1259    16906    view_establishment_type    VIEW     �  CREATE VIEW public.view_establishment_type AS
 SELECT et.id,
    et.name,
    st.name AS state,
    st.color AS state_color,
    (((et.creation_date)::date || ' '::text) || to_char(et.creation_date, 'HH24:MI'::text)) AS creation_date,
    (((et.modification_date)::date || ' '::text) || to_char(et.modification_date, 'HH24:MI'::text)) AS modification_date
   FROM (public.establishment_type et
     JOIN public.state st ON ((st.id = et.state_id)))
  WHERE (et.delete = false)
  ORDER BY et.id;
 *   DROP VIEW public.view_establishment_type;
       public          postgres    false    235    225    225    225    225    225    225    235    235            �            1259    16911    view_gender    VIEW     x   CREATE VIEW public.view_gender AS
 SELECT id,
    name
   FROM public.gender gd
  WHERE (delete = false)
  ORDER BY id;
    DROP VIEW public.view_gender;
       public          postgres    false    227    227    227            �            1259    16915    view_municipality    VIEW     �   CREATE VIEW public.view_municipality AS
 SELECT mt.id,
    mt.name,
    dp.name AS department
   FROM (public.municipality mt
     JOIN public.department dp ON ((dp.id = mt.department_id)))
  ORDER BY mt.department_id;
 $   DROP VIEW public.view_municipality;
       public          postgres    false    229    229    221    221    229            �            1259    16919    view_person    VIEW     �  CREATE VIEW public.view_person AS
 SELECT ps.user_id,
    us.image,
    ps.first_name,
    ps.last_name,
    ps.date_of_birth,
    date_part('year'::text, age((ps.date_of_birth)::timestamp with time zone)) AS age,
    gd.name AS gender,
    dt.name AS document_type,
    ps.document_number,
    dp.name AS department,
    mt.name AS municipality,
    ps.address,
    zt.name AS zone_type,
    ps.phone_number,
    us.email_address,
    us.username,
    us.password
   FROM ((((((public.person ps
     JOIN public."user" us ON ((us.id = ps.user_id)))
     JOIN public.document_type dt ON ((dt.id = ps.document_type_id)))
     JOIN public.gender gd ON ((gd.id = ps.gender_id)))
     JOIN public.municipality mt ON ((mt.id = ps.municipality_id)))
     JOIN public.department dp ON ((dp.id = mt.department_id)))
     JOIN public.zone_type zt ON ((zt.id = ps.zone_type_id)))
  WHERE (us.delete = false)
  ORDER BY ps.user_id;
    DROP VIEW public.view_person;
       public          postgres    false    230    230    230    227    229    229    230    230    230    230    237    237    237    237    237    237    247    247    229    221    221    230    230    230    222    222    227    230            �            1259    16924    view_product    VIEW     `  CREATE VIEW public.view_product AS
 SELECT pd.id,
    pd.image,
    pd.name,
    pd.barcode,
    pd.price,
    pd.quantity,
    pd.establishment_id AS establishment,
    cr.name AS category,
    bd.name AS brand,
    pd.section,
    pd.description,
    st.name AS state,
    st.color AS state_color,
    (((pd.creation_date)::date || ' '::text) || to_char(pd.creation_date, 'HH24:MI'::text)) AS creation_date,
    (((pd.modification_date)::date || ' '::text) || to_char(pd.modification_date, 'HH24:MI'::text)) AS modification_date
   FROM ((((public.product pd
     JOIN public.category cr ON ((cr.id = pd.category_id)))
     JOIN public.brand bd ON ((bd.id = pd.brand_id)))
     JOIN public.state st ON ((st.id = pd.state_id)))
     JOIN public.establishment es ON ((es.user_id = pd.establishment_id)))
  WHERE (pd.delete = false)
  ORDER BY pd.establishment_id;
    DROP VIEW public.view_product;
       public          postgres    false    231    217    217    219    219    224    231    231    231    231    231    231    231    231    231    231    231    231    231    231    235    235    235            �            1259    16929    view_product_card    VIEW     �  CREATE VIEW public.view_product_card AS
 SELECT pd.id,
    pd.image,
    pd.name,
    pd.price,
    pd.quantity,
    es.name AS establishment,
    cr.name AS category,
    bd.name AS brand,
    st.name AS state,
    us.delete
   FROM (((((public.product pd
     JOIN public.category cr ON ((cr.id = pd.category_id)))
     JOIN public.brand bd ON ((bd.id = pd.brand_id)))
     JOIN public.state st ON ((st.id = pd.state_id)))
     JOIN public.establishment es ON ((es.user_id = pd.establishment_id)))
     JOIN public."user" us ON ((es.user_id = us.id)))
  WHERE ((pd.delete = false) AND (upper((st.name)::text) = upper('Activado'::text)) AND (us.delete = false))
  ORDER BY pd.establishment_id;
 $   DROP VIEW public.view_product_card;
       public          postgres    false    237    231    231    231    235    235    237    217    217    219    219    231    224    224    231    231    231    231    231    231            �            1259    16934    view_role_type    VIEW     p   CREATE VIEW public.view_role_type AS
 SELECT id,
    name,
    color
   FROM public.role_type rt
  ORDER BY id;
 !   DROP VIEW public.view_role_type;
       public          postgres    false    233    233    233                        1259    16938 
   view_state    VIEW     h   CREATE VIEW public.view_state AS
 SELECT id,
    name,
    color
   FROM public.state st
  ORDER BY id;
    DROP VIEW public.view_state;
       public          postgres    false    235    235    235                       1259    16942 	   view_user    VIEW     +  CREATE VIEW public.view_user AS
 SELECT us.id AS user_id,
    us.image,
    us.username,
    us.email_address,
    rt.name AS role_type,
    rt.color AS role_type_color,
    ac.name AS account_status,
    ac.color AS account_status_color,
    (((us.creation_date)::date || ' '::text) || to_char(us.creation_date, 'HH24:MI'::text)) AS creation_date
   FROM ((public."user" us
     JOIN public.role_type rt ON ((rt.id = us.role_type_id)))
     JOIN public.account_status ac ON ((ac.id = us.account_status_id)))
  WHERE (us.delete = false)
  ORDER BY us.id;
    DROP VIEW public.view_user;
       public          postgres    false    237    237    237    237    233    233    237    233    237    237    237    215    215    215                       1259    16947    view_vehicle    VIEW     �  CREATE VIEW public.view_vehicle AS
 SELECT vh.id,
    vh.name,
    st.name AS state,
    st.color AS state_color,
    (((vh.creation_date)::date || ' '::text) || to_char(vh.creation_date, 'HH24:MI'::text)) AS creation_date,
    (((vh.modification_date)::date || ' '::text) || to_char(vh.modification_date, 'HH24:MI'::text)) AS modification_date
   FROM (public.vehicle vh
     JOIN public.state st ON ((st.id = vh.state_id)))
  WHERE (vh.delete = false)
  ORDER BY vh.id;
    DROP VIEW public.view_vehicle;
       public          postgres    false    235    239    239    239    235    235    239    239    239                       1259    16952    view_zone_type    VIEW     e   CREATE VIEW public.view_zone_type AS
 SELECT id,
    name
   FROM public.zone_type zt
  ORDER BY id;
 !   DROP VIEW public.view_zone_type;
       public          postgres    false    247    247                       1259    16956    zone_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.zone_type_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.zone_type_id_seq;
       public          postgres    false    247            �           0    0    zone_type_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.zone_type_id_seq OWNED BY public.zone_type.id;
          public          postgres    false    260            �           2604    16957    account_status id    DEFAULT     v   ALTER TABLE ONLY public.account_status ALTER COLUMN id SET DEFAULT nextval('public.account_status_id_seq'::regclass);
 @   ALTER TABLE public.account_status ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215            �           2604    16958    brand id    DEFAULT     d   ALTER TABLE ONLY public.brand ALTER COLUMN id SET DEFAULT nextval('public.brand_id_seq'::regclass);
 7   ALTER TABLE public.brand ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    217            �           2604    16959    category id    DEFAULT     j   ALTER TABLE ONLY public.category ALTER COLUMN id SET DEFAULT nextval('public.category_id_seq'::regclass);
 :   ALTER TABLE public.category ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219            �           2604    16960    document_type id    DEFAULT     t   ALTER TABLE ONLY public.document_type ALTER COLUMN id SET DEFAULT nextval('public.document_type_id_seq'::regclass);
 ?   ALTER TABLE public.document_type ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222            �           2604    16961    establishment_type id    DEFAULT     ~   ALTER TABLE ONLY public.establishment_type ALTER COLUMN id SET DEFAULT nextval('public.establishment_type_id_seq'::regclass);
 D   ALTER TABLE public.establishment_type ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    225            �           2604    16962 	   gender id    DEFAULT     f   ALTER TABLE ONLY public.gender ALTER COLUMN id SET DEFAULT nextval('public.gender_id_seq'::regclass);
 8   ALTER TABLE public.gender ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    228    227            �           2604    16963 
   product id    DEFAULT     h   ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);
 9   ALTER TABLE public.product ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    232    231            �           2604    16964    role_type id    DEFAULT     l   ALTER TABLE ONLY public.role_type ALTER COLUMN id SET DEFAULT nextval('public.role_type_id_seq'::regclass);
 ;   ALTER TABLE public.role_type ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    234    233            �           2604    16965    state id    DEFAULT     d   ALTER TABLE ONLY public.state ALTER COLUMN id SET DEFAULT nextval('public.state_id_seq'::regclass);
 7   ALTER TABLE public.state ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    236    235            �           2604    16966    user id    DEFAULT     d   ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    238    237            �           2604    16967 
   vehicle id    DEFAULT     h   ALTER TABLE ONLY public.vehicle ALTER COLUMN id SET DEFAULT nextval('public.vehicle_id_seq'::regclass);
 9   ALTER TABLE public.vehicle ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    240    239            �           2604    16968    zone_type id    DEFAULT     l   ALTER TABLE ONLY public.zone_type ALTER COLUMN id SET DEFAULT nextval('public.zone_type_id_seq'::regclass);
 ;   ALTER TABLE public.zone_type ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    260    247            �          0    16759    account_status 
   TABLE DATA           9   COPY public.account_status (id, name, color) FROM stdin;
    public          postgres    false    215   ��       �          0    16764    brand 
   TABLE DATA           ~   COPY public.brand (id, name, establishment_id, creation_date, modification_date, deletion_date, state_id, delete) FROM stdin;
    public          postgres    false    217   ��       �          0    16773    category 
   TABLE DATA           �   COPY public.category (id, name, establishment_id, creation_date, modification_date, deletion_date, state_id, delete) FROM stdin;
    public          postgres    false    219   ��       �          0    16782 
   department 
   TABLE DATA           .   COPY public.department (id, name) FROM stdin;
    public          postgres    false    221   I�       �          0    16785    document_type 
   TABLE DATA           t   COPY public.document_type (id, name, state_id, creation_date, modification_date, deletion_date, delete) FROM stdin;
    public          postgres    false    222   r�       �          0    16794    establishment 
   TABLE DATA           �   COPY public.establishment (user_id, name, municipality_id, zone_type_id, address, phone_number, establishment_type_id) FROM stdin;
    public          postgres    false    224   ��       �          0    16797    establishment_type 
   TABLE DATA           y   COPY public.establishment_type (id, name, state_id, creation_date, modification_date, deletion_date, delete) FROM stdin;
    public          postgres    false    225    �       �          0    16806    gender 
   TABLE DATA           m   COPY public.gender (id, name, state_id, creation_date, modification_date, deletion_date, delete) FROM stdin;
    public          postgres    false    227   �       �          0    16815    municipality 
   TABLE DATA           ?   COPY public.municipality (id, name, department_id) FROM stdin;
    public          postgres    false    229   ��       �          0    16818    person 
   TABLE DATA           �   COPY public.person (user_id, first_name, last_name, date_of_birth, gender_id, document_type_id, document_number, phone_number, municipality_id, zone_type_id, address, person_rating) FROM stdin;
    public          postgres    false    230   ��       �          0    16823    product 
   TABLE DATA           �   COPY public.product (id, name, brand_id, price, quantity, barcode, category_id, section, image, establishment_id, description, state_id, creation_date, modification_date, deletion_date, delete) FROM stdin;
    public          postgres    false    231   ��       �          0    16840 	   role_type 
   TABLE DATA           4   COPY public.role_type (id, name, color) FROM stdin;
    public          postgres    false    233   ��       �          0    16845    state 
   TABLE DATA           0   COPY public.state (id, name, color) FROM stdin;
    public          postgres    false    235   �       �          0    16850    user 
   TABLE DATA           �   COPY public."user" (id, image, username, email_address, password, role_type_id, account_status_id, creation_date, modification_date, deletion_date, delete) FROM stdin;
    public          postgres    false    237   Y�       �          0    16862    vehicle 
   TABLE DATA           n   COPY public.vehicle (id, name, state_id, creation_date, modification_date, deletion_date, delete) FROM stdin;
    public          postgres    false    239   4�       �          0    16898 	   zone_type 
   TABLE DATA           -   COPY public.zone_type (id, name) FROM stdin;
    public          postgres    false    247   ��       �           0    0    account_status_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.account_status_id_seq', 2, true);
          public          postgres    false    216            �           0    0    brand_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.brand_id_seq', 10, true);
          public          postgres    false    218            �           0    0    category_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.category_id_seq', 6, true);
          public          postgres    false    220            �           0    0    document_type_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.document_type_id_seq', 1, true);
          public          postgres    false    223            �           0    0    establishment_type_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.establishment_type_id_seq', 5, true);
          public          postgres    false    226            �           0    0    gender_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.gender_id_seq', 2, true);
          public          postgres    false    228            �           0    0    product_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.product_id_seq', 55, true);
          public          postgres    false    232            �           0    0    role_type_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.role_type_id_seq', 4, true);
          public          postgres    false    234            �           0    0    state_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.state_id_seq', 2, true);
          public          postgres    false    236            �           0    0    user_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.user_id_seq', 10, true);
          public          postgres    false    238            �           0    0    vehicle_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.vehicle_id_seq', 7, true);
          public          postgres    false    240            �           0    0    zone_type_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.zone_type_id_seq', 2, true);
          public          postgres    false    260            �           2606    16970 "   account_status account_status_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.account_status
    ADD CONSTRAINT account_status_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.account_status DROP CONSTRAINT account_status_pkey;
       public            postgres    false    215            �           2606    16972    brand brand_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.brand
    ADD CONSTRAINT brand_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.brand DROP CONSTRAINT brand_pkey;
       public            postgres    false    217            �           2606    16974    category category_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public            postgres    false    219            �           2606    16976    department department_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.department
    ADD CONSTRAINT department_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.department DROP CONSTRAINT department_pkey;
       public            postgres    false    221            �           2606    16978     document_type document_type_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.document_type
    ADD CONSTRAINT document_type_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.document_type DROP CONSTRAINT document_type_pkey;
       public            postgres    false    222            �           2606    16980     establishment establishment_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.establishment
    ADD CONSTRAINT establishment_pkey PRIMARY KEY (user_id);
 J   ALTER TABLE ONLY public.establishment DROP CONSTRAINT establishment_pkey;
       public            postgres    false    224            �           2606    16982 *   establishment_type establishment_type_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.establishment_type
    ADD CONSTRAINT establishment_type_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.establishment_type DROP CONSTRAINT establishment_type_pkey;
       public            postgres    false    225            �           2606    16984    gender gender_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.gender
    ADD CONSTRAINT gender_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.gender DROP CONSTRAINT gender_pkey;
       public            postgres    false    227            �           2606    16986    municipality municipality_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.municipality
    ADD CONSTRAINT municipality_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.municipality DROP CONSTRAINT municipality_pkey;
       public            postgres    false    229            �           2606    16988    person person_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_pkey PRIMARY KEY (user_id);
 <   ALTER TABLE ONLY public.person DROP CONSTRAINT person_pkey;
       public            postgres    false    230            �           2606    16990    product product_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    231                        2606    16992    role_type role_type_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.role_type
    ADD CONSTRAINT role_type_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.role_type DROP CONSTRAINT role_type_pkey;
       public            postgres    false    233                       2606    16994    state state_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.state
    ADD CONSTRAINT state_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.state DROP CONSTRAINT state_pkey;
       public            postgres    false    235                       2606    16996    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public            postgres    false    237                       2606    16998    vehicle vehicle_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.vehicle
    ADD CONSTRAINT vehicle_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.vehicle DROP CONSTRAINT vehicle_pkey;
       public            postgres    false    239                       2606    17000    zone_type zone_type_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.zone_type
    ADD CONSTRAINT zone_type_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.zone_type DROP CONSTRAINT zone_type_pkey;
       public            postgres    false    247            	           2606    17001 !   brand brand_establishment_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.brand
    ADD CONSTRAINT brand_establishment_id_fkey FOREIGN KEY (establishment_id) REFERENCES public.establishment(user_id);
 K   ALTER TABLE ONLY public.brand DROP CONSTRAINT brand_establishment_id_fkey;
       public          postgres    false    217    224    4852            
           2606    17006    brand brand_state_id_fkey    FK CONSTRAINT     y   ALTER TABLE ONLY public.brand
    ADD CONSTRAINT brand_state_id_fkey FOREIGN KEY (state_id) REFERENCES public.state(id);
 C   ALTER TABLE ONLY public.brand DROP CONSTRAINT brand_state_id_fkey;
       public          postgres    false    4866    217    235                       2606    17011 '   category category_establishment_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_establishment_id_fkey FOREIGN KEY (establishment_id) REFERENCES public.establishment(user_id);
 Q   ALTER TABLE ONLY public.category DROP CONSTRAINT category_establishment_id_fkey;
       public          postgres    false    4852    224    219                       2606    17016    category category_state_id_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_state_id_fkey FOREIGN KEY (state_id) REFERENCES public.state(id);
 I   ALTER TABLE ONLY public.category DROP CONSTRAINT category_state_id_fkey;
       public          postgres    false    219    4866    235                       2606    17021 )   document_type document_type_state_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.document_type
    ADD CONSTRAINT document_type_state_id_fkey FOREIGN KEY (state_id) REFERENCES public.state(id) ON DELETE CASCADE;
 S   ALTER TABLE ONLY public.document_type DROP CONSTRAINT document_type_state_id_fkey;
       public          postgres    false    4866    235    222                       2606    17026 6   establishment establishment_establishment_type_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.establishment
    ADD CONSTRAINT establishment_establishment_type_id_fkey FOREIGN KEY (establishment_type_id) REFERENCES public.establishment_type(id);
 `   ALTER TABLE ONLY public.establishment DROP CONSTRAINT establishment_establishment_type_id_fkey;
       public          postgres    false    225    4854    224                       2606    17031 0   establishment establishment_municipality_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.establishment
    ADD CONSTRAINT establishment_municipality_id_fkey FOREIGN KEY (municipality_id) REFERENCES public.municipality(id);
 Z   ALTER TABLE ONLY public.establishment DROP CONSTRAINT establishment_municipality_id_fkey;
       public          postgres    false    224    4858    229                       2606    17036 3   establishment_type establishment_type_state_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.establishment_type
    ADD CONSTRAINT establishment_type_state_id_fkey FOREIGN KEY (state_id) REFERENCES public.state(id);
 ]   ALTER TABLE ONLY public.establishment_type DROP CONSTRAINT establishment_type_state_id_fkey;
       public          postgres    false    225    4866    235                       2606    17041 (   establishment establishment_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.establishment
    ADD CONSTRAINT establishment_user_id_fkey FOREIGN KEY (user_id) REFERENCES public."user"(id) ON DELETE CASCADE;
 R   ALTER TABLE ONLY public.establishment DROP CONSTRAINT establishment_user_id_fkey;
       public          postgres    false    224    237    4868                       2606    17046 -   establishment establishment_zone_type_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.establishment
    ADD CONSTRAINT establishment_zone_type_id_fkey FOREIGN KEY (zone_type_id) REFERENCES public.zone_type(id);
 W   ALTER TABLE ONLY public.establishment DROP CONSTRAINT establishment_zone_type_id_fkey;
       public          postgres    false    224    4872    247                       2606    17051    gender gender_state_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.gender
    ADD CONSTRAINT gender_state_id_fkey FOREIGN KEY (state_id) REFERENCES public.state(id) ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.gender DROP CONSTRAINT gender_state_id_fkey;
       public          postgres    false    227    235    4866                       2606    17056 ,   municipality municipality_department_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.municipality
    ADD CONSTRAINT municipality_department_id_fkey FOREIGN KEY (department_id) REFERENCES public.department(id) ON DELETE CASCADE;
 V   ALTER TABLE ONLY public.municipality DROP CONSTRAINT municipality_department_id_fkey;
       public          postgres    false    229    221    4848                       2606    17061 #   person person_document_type_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_document_type_id_fkey FOREIGN KEY (document_type_id) REFERENCES public.document_type(id);
 M   ALTER TABLE ONLY public.person DROP CONSTRAINT person_document_type_id_fkey;
       public          postgres    false    222    4850    230                       2606    17066    person person_gender_id_fkey    FK CONSTRAINT     ~   ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_gender_id_fkey FOREIGN KEY (gender_id) REFERENCES public.gender(id);
 F   ALTER TABLE ONLY public.person DROP CONSTRAINT person_gender_id_fkey;
       public          postgres    false    4856    227    230                       2606    17071 "   person person_municipality_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_municipality_id_fkey FOREIGN KEY (municipality_id) REFERENCES public.municipality(id);
 L   ALTER TABLE ONLY public.person DROP CONSTRAINT person_municipality_id_fkey;
       public          postgres    false    230    229    4858                       2606    17076    person person_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_user_id_fkey FOREIGN KEY (user_id) REFERENCES public."user"(id) ON DELETE CASCADE;
 D   ALTER TABLE ONLY public.person DROP CONSTRAINT person_user_id_fkey;
       public          postgres    false    230    237    4868                       2606    17081    person person_zone_type_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.person
    ADD CONSTRAINT person_zone_type_id_fkey FOREIGN KEY (zone_type_id) REFERENCES public.zone_type(id);
 I   ALTER TABLE ONLY public.person DROP CONSTRAINT person_zone_type_id_fkey;
       public          postgres    false    230    247    4872                       2606    17086    product product_brand_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_brand_id_fkey FOREIGN KEY (brand_id) REFERENCES public.brand(id);
 G   ALTER TABLE ONLY public.product DROP CONSTRAINT product_brand_id_fkey;
       public          postgres    false    231    4844    217                       2606    17091     product product_category_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.category(id);
 J   ALTER TABLE ONLY public.product DROP CONSTRAINT product_category_id_fkey;
       public          postgres    false    231    4846    219                       2606    17096 %   product product_establishment_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_establishment_id_fkey FOREIGN KEY (establishment_id) REFERENCES public.establishment(user_id) ON DELETE CASCADE;
 O   ALTER TABLE ONLY public.product DROP CONSTRAINT product_establishment_id_fkey;
       public          postgres    false    231    4852    224                       2606    17101    product product_state_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_state_id_fkey FOREIGN KEY (state_id) REFERENCES public.state(id);
 G   ALTER TABLE ONLY public.product DROP CONSTRAINT product_state_id_fkey;
       public          postgres    false    231    4866    235                       2606    17106     user user_account_status_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_account_status_id_fkey FOREIGN KEY (account_status_id) REFERENCES public.account_status(id);
 L   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_account_status_id_fkey;
       public          postgres    false    237    4842    215                       2606    17111    user user_role_type_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_role_type_id_fkey FOREIGN KEY (role_type_id) REFERENCES public.role_type(id);
 G   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_role_type_id_fkey;
       public          postgres    false    233    4864    237                        2606    17116    vehicle vehicle_state_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.vehicle
    ADD CONSTRAINT vehicle_state_id_fkey FOREIGN KEY (state_id) REFERENCES public.state(id);
 G   ALTER TABLE ONLY public.vehicle DROP CONSTRAINT vehicle_state_id_fkey;
       public          postgres    false    235    239    4866            �   1   x�3�tL.�,��TN2H��L�2�t��/,MML��Y$%'�p��qqq  yL      �   �   x���M�0F��)����"[	���D7n�K2E�7���dֳxyo>%S豴|��L�u�*��&O�E���d�4\"uCֻ\�Ob�
�x�j[OA��B�DKGC���'�[©���W�^~����ĳk�	yw���#�Y~P��@8<�&<:O��V�H+��Daow^DQ��B��      �   �   x���1� ���q
.І-X65W,�i1P����b�	4&���K~�y�Ƙ�:���5p�E�T��2��Ԭ)+!����:�ay���Hw.�8�0�$`���wwC�tO&MeU�
�S��>��'<X���3���`��/�OB�Qi�e-�j�7�PB^]�t�      �      x�3RP��K,�<�1�+F��� +��      �   2   x�3�tv�4�4202�50�54R00�24�26�3�07�0'S*�+F��� L��      �   <   x�3��M-JNT��42Q�4�tN��IU(��K�,H�Q042�4&�f����\1z\\\ ��      �   o   x�3�.-H-�M-JNL��4�4202�50�54R00�24�21�3352�$W*�ˈӥ(?�4�(3�6s�����m0��&�!��y)Ļ(nlael�glhl`N��=... znP�      �   7   x�3���4�4202�50�54R00�24�25�3�0502'S*�ˈӍ6��qqq %�!�      �      x�32Q�)�ML��4RP������ 2&      �   �   x�3�tKL���t�/*I-�4����50"NC426153��4Bf�( �\sr��9��8�2��8]�oL�4200�50"TC���sz��*��f����sz��$���d��8&�q1z\\\ {�2�      �     x����r#����S�v
�h����O%���R�`�-U�ERN����|H喫^,�1 	Uq�>�]����-��K�	�I�I)����O��>���1"�U���w���W���%��~ ��r���|� �3��`.i�L<���8����	��#�c2�II�LCdj��i���LSg��[ZL�s����/d��Ͽ����&��N�C�K2=��s����`R|�� �P���p�Wb5�7���9�Nz'UM�ԁ�V���8s�dܥ'��h9����A�0��`N�sdA�����V�㨥5δ�)�Ͽ���%��P�W�J�A/dr�\g�i�5��)� ˕�Jq�w~@��`3)����i/q����Y
JO́-N�2)&Z`^|�{C�GA����dR�qFjEC����}gXr5�ҝ5^�ع�%�=�uH��h5H��_��^i���Iv.�K�5�%GXg��5������v��"��t�)�|&���v_�<"�EJ��b��՜8ۜ28�+P	T�֪�rI[>,�zr�?�ӹLj�q�`�x��+�HzP�oK<)>=n��DJ��k�ͤb�z�{���r�u^r7�6���SX�U*�p�ol@�L&5��Q��b�ǭJZP�K	�ğ��n�o��y�*�IM�5Y��ʠs�tZ:|�Ί۸Z�v���,�(~��˸��؜�����F��J��ɤd3������z����L{���~��ع�p>���3eS+����!n7�S��;��L*�������r�sT��<� ^��ZD��h$��yX�V�{�>�L*���!^˦$OgN�{l��l��O�[e&�h{�nm�i�V�z(����C�)������5��y}&�Г���@ަ�l��{v�;t >������Ե칓TpQ/4��k�8콑R�Q�F�x�\M݊6���Gj��8���|�^)jmYJ
6��\����&^5�Tp�4=�+�h�3�@ɏ�s��?~u���	5i��3�׿�w��I^�BRp�g�:�l4������z��0��a�VH���s#ρ��4w*7-�g������*&>ķ��sx��_SS_����b<�z���m�c���8hF�?~��]<n�"p�.�n-�i�F�MO����9��V�{�ń�fOv��S՛D`~���<�(��,�fr<���j>2�4��o��x�+���:�3�_ؒ�d&ۂ�m@7�x��И��;�� �;�D��P|�|x1\>|�˛L��q��9p�����!��/� �O������l�B�v$Ie/�L�~�ckQ<d�DU�����+��J�'���������Ljgj
<&7�a�Ey�6���3Ӧ�N�2��b2+�����v���(����a���h'}�i2��*�p���8J�gC���q<9�e;b>ڝ�sѠ]�&oҠ�6ea:^u����)1�b:�z �I��w�+X~�2��~����;�yӕUܩ�b�4����8�⇰��P�1����cT�طv����N��)�Eluk͵ƙM3{:�L�ο­�f�`բ��{�yS^T_��v��f�[X�5�������$#��Q��p�>�k�I���Ǭ��1�GW\��:<r�ϫ�_���^WkW7Չ?=#�F��MGB�$�0��l3pgN'�q��is�7�}��t��:�����6�š�n�7����F�(&��1]X�Ue Jq�K���#��]�Uf:�8򙜃�zζ��KA�� ˡ��S��q�a�ހׁ$�L�F�=������o��r&.����E�9f.�*2�Y����\�~ i�q�Sf'��V]xJP8����?��q���f�Q�04ƨ&�D&i�E�)��f�O��<[Hgr"����S�@r�������j�K��:՜�`v�s����I�Ӧ���5�l�%��&�m����/�P��0�4Rk�orjJ�^j�?/��nS,�,e�u�,�\0�q��t�K�.Mǆ�!S��n���7��0o��Tz�����he���b�k�a��������s�%�����A2��/ܭ�� K�i�R��Z���l6�?�I�{      �   ^   x�%ȱ
�  ���7�ì�Ơ>����2A��#z��aIn��P���a^쵑��K�[g�i���P�ob�H�[N�咿�a��_�      �   /   x�3�tL.�,KL��TN2H��L�2�tI-N���Y$%'�p��qqq ?O�      �   �   x���;n�0Eњ\E6`b>M��BҌ%��@YJ��A��*�A�7���T��*K?����yj��t����vM*��o�`KY A�F�}��!���x��@MP��%��ËI-�p����<��V��<-�(nΗ���7V�5�]��/&�~eU9v��u���GW'�}ڣI-����h>?ʈ���p�㚣)�j�x0�}w��Tk��      �   �   x���;
�@E�7��fx���2���aP���oi�b}���!8���,�'��I5U�r�:����:�8���/k�I�dR�cH�J����,?�!�D�E1�K,��:�c{���BS�\He[��so�V])      �      x�3�-JJ�K�2�*-J������ F��     