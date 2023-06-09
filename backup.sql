PGDMP             
            {           elective    11.4    11.2 5    M           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            N           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            O           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            P           1262    154243    elective    DATABASE     �   CREATE DATABASE elective WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE elective;
             postgres    false            �            1259    162596    claus_internal    TABLE     8  CREATE TABLE public.claus_internal (
    claus_internal_id bigint NOT NULL,
    claus_internal_mitarbeiter character varying,
    claus_internal_ehm_nutzer character varying,
    claus_internal_modell character varying,
    claus_internal_seriennummer character varying,
    claus_internal_sichtschutzfolie character varying,
    claus_internal_sonstiges character varying,
    claus_internal_details text,
    claus_internal_date_added character varying,
    record_hide character varying,
    claus_internal_date_updated timestamp without time zone DEFAULT now()
);
 "   DROP TABLE public.claus_internal;
       public         postgres    false            �            1259    162599 $   claus_internal_claus_internal_id_seq    SEQUENCE     �   CREATE SEQUENCE public.claus_internal_claus_internal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.claus_internal_claus_internal_id_seq;
       public       postgres    false    206            Q           0    0 $   claus_internal_claus_internal_id_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.claus_internal_claus_internal_id_seq OWNED BY public.claus_internal.claus_internal_id;
            public       postgres    false    207            �            1259    162611    claus_vw    TABLE     �  CREATE TABLE public.claus_vw (
    claus_vw_id bigint NOT NULL,
    claus_vw_mitarbeiter character varying,
    claus_vw_computername character varying,
    claus_vw_ehm_nutzer character varying,
    claus_vw_modell character varying,
    claus_vw_seriennummer character varying,
    claus_vw_sichtschutzfolie character varying,
    claus_vw_sonstiges character varying,
    claus_vw_vorl_maschinenummer character varying,
    claus_vw_leasing_ende character varying,
    claus_vw_details text,
    claus_vw_date_added character varying,
    record_hide character varying,
    claus_vw_date_updated timestamp without time zone DEFAULT now()
);
    DROP TABLE public.claus_vw;
       public         postgres    false            �            1259    162614    claus_vw_claus_vw_id_seq    SEQUENCE     �   CREATE SEQUENCE public.claus_vw_claus_vw_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.claus_vw_claus_vw_id_seq;
       public       postgres    false    208            R           0    0    claus_vw_claus_vw_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.claus_vw_claus_vw_id_seq OWNED BY public.claus_vw.claus_vw_id;
            public       postgres    false    209            �            1259    154381    departments    TABLE     7  CREATE TABLE public.departments (
    department_id bigint NOT NULL,
    department_name character varying,
    department_details text,
    department_date_added character varying,
    department_date_updated timestamp without time zone DEFAULT now(),
    user_id integer,
    record_hide character varying
);
    DROP TABLE public.departments;
       public         postgres    false            �            1259    154384    departments_department_id_seq    SEQUENCE     �   CREATE SEQUENCE public.departments_department_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.departments_department_id_seq;
       public       postgres    false    204            S           0    0    departments_department_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.departments_department_id_seq OWNED BY public.departments.department_id;
            public       postgres    false    205            �            1259    154266    modules    TABLE     #  CREATE TABLE public.modules (
    pages_id bigint NOT NULL,
    pages_name character varying,
    pages_url character varying,
    page_file_name character varying,
    added character varying,
    record_hide character varying,
    last_updated timestamp without time zone DEFAULT now()
);
    DROP TABLE public.modules;
       public         postgres    false            �            1259    154273    modules_group    TABLE        CREATE TABLE public.modules_group (
    pages_group_id bigint NOT NULL,
    pages_group_name character varying,
    pages_id text,
    added character varying,
    record_hide character varying,
    last_updated timestamp without time zone DEFAULT now(),
    pages_id_permissions text
);
 !   DROP TABLE public.modules_group;
       public         postgres    false            �            1259    154280    pages_group_pages_group_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pages_group_pages_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.pages_group_pages_group_id_seq;
       public       postgres    false    197            T           0    0    pages_group_pages_group_id_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.pages_group_pages_group_id_seq OWNED BY public.modules_group.pages_group_id;
            public       postgres    false    198            �            1259    154282    pages_pages_id_seq    SEQUENCE     {   CREATE SEQUENCE public.pages_pages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.pages_pages_id_seq;
       public       postgres    false    196            U           0    0    pages_pages_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.pages_pages_id_seq OWNED BY public.modules.pages_id;
            public       postgres    false    199            �            1259    154371 	   pc_widget    TABLE     ]  CREATE TABLE public.pc_widget (
    pc_widget_id bigint NOT NULL,
    pc_widget_mitarbeiter character varying NOT NULL,
    pc_widget_kuerzel character varying,
    pc_widget_vw_rechner character varying,
    pc_widget_hostname character varying,
    pc_widget_model character varying,
    pc_widget_seriennummer character varying,
    pc_widget_wlan_mac character varying,
    pc_widget_lan_mac character varying,
    pc_widget_bitlocker_pin character varying,
    pc_widget_office2016_schluessel character varying,
    pc_widget_office2019_schluessel character varying,
    pc_widget_windows10_key character varying,
    pc_widget_bios_pwd character varying,
    pc_widget_details text,
    pc_widget_date_added character varying,
    pc_widget_date_updated timestamp without time zone DEFAULT now(),
    user_id integer,
    record_hide character varying
);
    DROP TABLE public.pc_widget;
       public         postgres    false            �            1259    154369    pc_widget_pc_widget_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pc_widget_pc_widget_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.pc_widget_pc_widget_id_seq;
       public       postgres    false    203            V           0    0    pc_widget_pc_widget_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.pc_widget_pc_widget_id_seq OWNED BY public.pc_widget.pc_widget_id;
            public       postgres    false    202            �            1259    154311    users    TABLE     �  CREATE TABLE public.users (
    user_id bigint NOT NULL,
    user_name character varying,
    user_password character varying,
    user_password_reset character varying,
    user_group_id integer,
    user_account_status character varying,
    user_login_status character varying,
    record_hide character varying,
    last_updated date DEFAULT now(),
    user_department_id integer
);
    DROP TABLE public.users;
       public         postgres    false            �            1259    154318    users_user_id_seq    SEQUENCE     z   CREATE SEQUENCE public.users_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.users_user_id_seq;
       public       postgres    false    200            W           0    0    users_user_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;
            public       postgres    false    201            �
           2604    162601     claus_internal claus_internal_id    DEFAULT     �   ALTER TABLE ONLY public.claus_internal ALTER COLUMN claus_internal_id SET DEFAULT nextval('public.claus_internal_claus_internal_id_seq'::regclass);
 O   ALTER TABLE public.claus_internal ALTER COLUMN claus_internal_id DROP DEFAULT;
       public       postgres    false    207    206            �
           2604    162616    claus_vw claus_vw_id    DEFAULT     |   ALTER TABLE ONLY public.claus_vw ALTER COLUMN claus_vw_id SET DEFAULT nextval('public.claus_vw_claus_vw_id_seq'::regclass);
 C   ALTER TABLE public.claus_vw ALTER COLUMN claus_vw_id DROP DEFAULT;
       public       postgres    false    209    208            �
           2604    154386    departments department_id    DEFAULT     �   ALTER TABLE ONLY public.departments ALTER COLUMN department_id SET DEFAULT nextval('public.departments_department_id_seq'::regclass);
 H   ALTER TABLE public.departments ALTER COLUMN department_id DROP DEFAULT;
       public       postgres    false    205    204            �
           2604    154340    modules pages_id    DEFAULT     r   ALTER TABLE ONLY public.modules ALTER COLUMN pages_id SET DEFAULT nextval('public.pages_pages_id_seq'::regclass);
 ?   ALTER TABLE public.modules ALTER COLUMN pages_id DROP DEFAULT;
       public       postgres    false    199    196            �
           2604    154341    modules_group pages_group_id    DEFAULT     �   ALTER TABLE ONLY public.modules_group ALTER COLUMN pages_group_id SET DEFAULT nextval('public.pages_group_pages_group_id_seq'::regclass);
 K   ALTER TABLE public.modules_group ALTER COLUMN pages_group_id DROP DEFAULT;
       public       postgres    false    198    197            �
           2604    154374    pc_widget pc_widget_id    DEFAULT     �   ALTER TABLE ONLY public.pc_widget ALTER COLUMN pc_widget_id SET DEFAULT nextval('public.pc_widget_pc_widget_id_seq'::regclass);
 E   ALTER TABLE public.pc_widget ALTER COLUMN pc_widget_id DROP DEFAULT;
       public       postgres    false    202    203    203            �
           2604    154345    users user_id    DEFAULT     n   ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);
 <   ALTER TABLE public.users ALTER COLUMN user_id DROP DEFAULT;
       public       postgres    false    201    200            G          0    162596    claus_internal 
   TABLE DATA               >  COPY public.claus_internal (claus_internal_id, claus_internal_mitarbeiter, claus_internal_ehm_nutzer, claus_internal_modell, claus_internal_seriennummer, claus_internal_sichtschutzfolie, claus_internal_sonstiges, claus_internal_details, claus_internal_date_added, record_hide, claus_internal_date_updated) FROM stdin;
    public       postgres    false    206   <G       I          0    162611    claus_vw 
   TABLE DATA               H  COPY public.claus_vw (claus_vw_id, claus_vw_mitarbeiter, claus_vw_computername, claus_vw_ehm_nutzer, claus_vw_modell, claus_vw_seriennummer, claus_vw_sichtschutzfolie, claus_vw_sonstiges, claus_vw_vorl_maschinenummer, claus_vw_leasing_ende, claus_vw_details, claus_vw_date_added, record_hide, claus_vw_date_updated) FROM stdin;
    public       postgres    false    208   �G       E          0    154381    departments 
   TABLE DATA               �   COPY public.departments (department_id, department_name, department_details, department_date_added, department_date_updated, user_id, record_hide) FROM stdin;
    public       postgres    false    204   �H       =          0    154266    modules 
   TABLE DATA               t   COPY public.modules (pages_id, pages_name, pages_url, page_file_name, added, record_hide, last_updated) FROM stdin;
    public       postgres    false    196   �H       >          0    154273    modules_group 
   TABLE DATA               �   COPY public.modules_group (pages_group_id, pages_group_name, pages_id, added, record_hide, last_updated, pages_id_permissions) FROM stdin;
    public       postgres    false    197   xJ       D          0    154371 	   pc_widget 
   TABLE DATA               �  COPY public.pc_widget (pc_widget_id, pc_widget_mitarbeiter, pc_widget_kuerzel, pc_widget_vw_rechner, pc_widget_hostname, pc_widget_model, pc_widget_seriennummer, pc_widget_wlan_mac, pc_widget_lan_mac, pc_widget_bitlocker_pin, pc_widget_office2016_schluessel, pc_widget_office2019_schluessel, pc_widget_windows10_key, pc_widget_bios_pwd, pc_widget_details, pc_widget_date_added, pc_widget_date_updated, user_id, record_hide) FROM stdin;
    public       postgres    false    203   �K       A          0    154311    users 
   TABLE DATA               �   COPY public.users (user_id, user_name, user_password, user_password_reset, user_group_id, user_account_status, user_login_status, record_hide, last_updated, user_department_id) FROM stdin;
    public       postgres    false    200   �M       X           0    0 $   claus_internal_claus_internal_id_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public.claus_internal_claus_internal_id_seq', 2, true);
            public       postgres    false    207            Y           0    0    claus_vw_claus_vw_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.claus_vw_claus_vw_id_seq', 2, true);
            public       postgres    false    209            Z           0    0    departments_department_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.departments_department_id_seq', 3, true);
            public       postgres    false    205            [           0    0    pages_group_pages_group_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.pages_group_pages_group_id_seq', 13, true);
            public       postgres    false    198            \           0    0    pages_pages_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.pages_pages_id_seq', 15, true);
            public       postgres    false    199            ]           0    0    pc_widget_pc_widget_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.pc_widget_pc_widget_id_seq', 14, true);
            public       postgres    false    202            ^           0    0    users_user_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.users_user_id_seq', 13, true);
            public       postgres    false    201            �
           2606    162606     claus_internal claus_internal_id 
   CONSTRAINT     m   ALTER TABLE ONLY public.claus_internal
    ADD CONSTRAINT claus_internal_id PRIMARY KEY (claus_internal_id);
 J   ALTER TABLE ONLY public.claus_internal DROP CONSTRAINT claus_internal_id;
       public         postgres    false    206            �
           2606    162621    claus_vw claus_vw_id 
   CONSTRAINT     [   ALTER TABLE ONLY public.claus_vw
    ADD CONSTRAINT claus_vw_id PRIMARY KEY (claus_vw_id);
 >   ALTER TABLE ONLY public.claus_vw DROP CONSTRAINT claus_vw_id;
       public         postgres    false    208            �
           2606    154391    departments department_id 
   CONSTRAINT     b   ALTER TABLE ONLY public.departments
    ADD CONSTRAINT department_id PRIMARY KEY (department_id);
 C   ALTER TABLE ONLY public.departments DROP CONSTRAINT department_id;
       public         postgres    false    204            �
           2606    154353    modules_group pages_group_id 
   CONSTRAINT     f   ALTER TABLE ONLY public.modules_group
    ADD CONSTRAINT pages_group_id PRIMARY KEY (pages_group_id);
 F   ALTER TABLE ONLY public.modules_group DROP CONSTRAINT pages_group_id;
       public         postgres    false    197            �
           2606    154355    modules pages_id 
   CONSTRAINT     T   ALTER TABLE ONLY public.modules
    ADD CONSTRAINT pages_id PRIMARY KEY (pages_id);
 :   ALTER TABLE ONLY public.modules DROP CONSTRAINT pages_id;
       public         postgres    false    196            �
           2606    154379    pc_widget pc_widget_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.pc_widget
    ADD CONSTRAINT pc_widget_pkey PRIMARY KEY (pc_widget_id);
 B   ALTER TABLE ONLY public.pc_widget DROP CONSTRAINT pc_widget_pkey;
       public         postgres    false    203            �
           2606    154365    users user_id 
   CONSTRAINT     P   ALTER TABLE ONLY public.users
    ADD CONSTRAINT user_id PRIMARY KEY (user_id);
 7   ALTER TABLE ONLY public.users DROP CONSTRAINT user_id;
       public         postgres    false    200            G   �   x�3�tvI,n@�@H0����v�pX��Ф$C�-5��4��R���Ș3�5���50�54Q04�22�24ֳ�4210�2�4261*I,NIK,O,.OqJ22���$#U�� %�$�2��a�?����>2�31�002����� �X�      I   �   x�Տ1�0E���@#ۍU��#\�%4- QUJ`��$afe����%��ތH��),>�bs	"��勪i�Ԥ�&u@��|�O_� ����C�cH�`��$���i���e������� � ��0����򤥔o��pK      E   @   x�3�L,NI�Ɔ�%
^�y��E�
FFƜ1~���~�\F���E9�y�x�sz�������� ��+      =   �  x����j�0���8�>��e%�q�cc�����fP�XN�\GH2�o_�	i�)���7��?��AN�W���/��~J�)�75�a��dR��ZV7��c.T[�'ǩJ@%��]ݔu��Y]@n�h���l<�g���ȷ� gl��X�m'�D4b0eH3�%� ���!PLB�0�̃����.7�^pQ��1������;刬nH���T�����c&���rrۈΘ���i��Z�[��������k�_򺝃	2��o�Y;~���%�_4E��y�G�/#����~�1r$Np^�#�S��a�)O��rWv��^�e?�/_Սt�;Do��o�,�Y����<E@�'a��1�"��w���3���+a�����������X��?$![p���A�\�e�      >   r  x��AK�0���9���K�6���A�^��HK��"]琱�n��M,]W�� �/4!���/	Jv喼v��
T�L ��!�ƿ��g(�'~��j�U�����k�� ������X'2"[9�YQ<�u)�r/����X<Y�v:
7u;��|��`?l�:��a�@����@I[3��g!�����r���Դ��H�?
cJ��>�n^�=��o
�)�F�lcIK��g��_f�G~΁,�E�G�cH䀛�x�(�&8�G�R��=U��Y�C��N"n`��p�mlC��X�X�c��91����Y�y?��4[��fo���^[�8EM�tw��O��&�<	�n��=)<��*Ϸ��$я��wqEo�f�      D   �  x��TM��0=O~�.=Fhf$�֩�6[���@/��(J�@�-a��J��f�)�m�f�Ff��<!#û������r��~���������|n��N�J;9�͕J9�����4����5�7����o��c봖��-ٞۂ�B,)���:+&GFgPjUa5��o�Ȇ}O�3����E~��p���}^���cH��������9�Hʴuh%��V�y���`�q����b��]������Ivl���*YS��Dht�A�z����t2��\��1=�v�H"[[���>���#�-d�=�izwO�rTe�g��kY%�+��j��i���r�TU9fi��zPU��ݶ\�g'�9dɍ���i n�P��	8C1ki��p>-߼]�J�3���#%M�-/Di�[�"��2�<_��lv<�i      A   �   x��ͻ�0 ������V|��DԆE"���b�|������}l�v��Hv��1��Ѵ8����� �@���]�$i�j�x��ƃm%)p^��)�0����#��uW_��Կj�zsh�w�c�4��aN����{�B�~�ѳ�MW����Q�Ĳ�/�/9�     