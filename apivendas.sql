--
-- PostgreSQL database dump
--

-- Dumped from database version 15.1
-- Dumped by pg_dump version 15.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: itens_venda; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.itens_venda (
    id integer NOT NULL,
    produto_id integer NOT NULL,
    venda_id integer NOT NULL,
    quantidade integer NOT NULL,
    preco_unitario numeric(10,2) NOT NULL,
    imposto_unitario numeric(5,2) NOT NULL
);


ALTER TABLE public.itens_venda OWNER TO postgres;

--
-- Name: itens_venda_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.itens_venda_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.itens_venda_id_seq OWNER TO postgres;

--
-- Name: itens_venda_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.itens_venda_id_seq OWNED BY public.itens_venda.id;


--
-- Name: produtos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produtos (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    descricao text,
    marca character varying(50),
    quantidade_estoque integer,
    preco numeric(10,2) NOT NULL,
    tipo_id integer NOT NULL
);


ALTER TABLE public.produtos OWNER TO postgres;

--
-- Name: produtos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produtos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produtos_id_seq OWNER TO postgres;

--
-- Name: produtos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produtos_id_seq OWNED BY public.produtos.id;


--
-- Name: tipos_produto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipos_produto (
    id integer NOT NULL,
    nome character varying(50) NOT NULL,
    imposto_percentual numeric(5,2)
);


ALTER TABLE public.tipos_produto OWNER TO postgres;

--
-- Name: tipos_produto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipos_produto_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_produto_id_seq OWNER TO postgres;

--
-- Name: tipos_produto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipos_produto_id_seq OWNED BY public.tipos_produto.id;


--
-- Name: vendas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendas (
    id integer NOT NULL,
    data_hora timestamp without time zone DEFAULT now() NOT NULL,
    valor_total numeric(10,2) NOT NULL,
    valor_impostos numeric(10,2) NOT NULL
);


ALTER TABLE public.vendas OWNER TO postgres;

--
-- Name: vendas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vendas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vendas_id_seq OWNER TO postgres;

--
-- Name: vendas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vendas_id_seq OWNED BY public.vendas.id;


--
-- Name: itens_venda id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itens_venda ALTER COLUMN id SET DEFAULT nextval('public.itens_venda_id_seq'::regclass);


--
-- Name: produtos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos ALTER COLUMN id SET DEFAULT nextval('public.produtos_id_seq'::regclass);


--
-- Name: tipos_produto id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_produto ALTER COLUMN id SET DEFAULT nextval('public.tipos_produto_id_seq'::regclass);


--
-- Name: vendas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas ALTER COLUMN id SET DEFAULT nextval('public.vendas_id_seq'::regclass);


--
-- Data for Name: itens_venda; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.itens_venda (id, produto_id, venda_id, quantidade, preco_unitario, imposto_unitario) FROM stdin;
1	2	1	1	3499.99	350.00
2	3	1	3	49.99	2.50
3	4	1	1	99.99	5.00
4	5	1	1	19.99	0.40
5	6	1	3	8.99	0.18
6	7	1	1	5.99	0.12
7	8	1	1	3.99	0.08
8	9	1	1	2.99	0.06
9	10	1	8	4.99	0.10
10	10	2	1	4.99	0.10
11	9	3	2	2.99	0.06
12	8	3	1	3.99	0.08
13	7	4	1	5.99	0.12
14	6	4	1	8.99	0.18
15	5	4	1	19.99	0.40
16	3	5	1	49.99	2.50
17	2	5	6	3499.99	350.00
18	9	6	2	2.99	0.06
19	8	6	1	3.99	0.08
20	7	6	1	5.99	0.12
21	6	6	1	8.99	0.18
22	5	6	1	19.99	0.40
23	4	6	1	99.99	5.00
24	10	7	1	4.99	0.10
25	9	7	8	2.99	0.06
26	2	8	1	3499.99	350.00
27	3	9	1	49.99	2.50
28	3	10	1	49.99	2.50
29	4	10	1	99.99	5.00
\.


--
-- Data for Name: produtos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produtos (id, nome, descricao, marca, quantidade_estoque, preco, tipo_id) FROM stdin;
1	Smartphone	Celular inteligente com tela de 6 polegadas e câmera de alta resolução	Samsung	50	1999.99	1
8	Leite Condensado	Leite condensado cremoso e saboroso	Itambé	47	3.99	3
7	Chocolate	Chocolate ao leite com pedaços de amêndoas	Nestlé	97	5.99	3
6	Feijão	Feijão carioca de primeira qualidade	Camil	145	8.99	3
5	Arroz	Arroz branco de qualidade superior	Tio João	197	19.99	3
10	Refrigerante	Refrigerante de cola com gás	Coca-Cola	90	4.99	3
9	Cerveja	Cerveja pilsen com sabor suave	Brahma	67	2.99	3
2	Notebook	Computador portátil com processador Intel Core i5 e tela de 14 polegadas	Dell	12	3499.99	1
3	Camiseta	Camiseta de algodão com estampa de flores	Adidas	94	49.99	2
4	Calça Jeans	Calça jeans com lavagem escura	Levi's	47	99.99	2
\.


--
-- Data for Name: tipos_produto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipos_produto (id, nome, imposto_percentual) FROM stdin;
1	Eletrônicos	10.00
2	Roupas	5.00
3	Alimentos	2.00
\.


--
-- Data for Name: vendas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendas (id, data_hora, valor_total, valor_impostos) FROM stdin;
1	2023-03-29 15:34:45.708814	4214.30	364.50
2	2023-03-29 15:34:48.911834	5.09	0.10
3	2023-03-29 15:34:52.528841	10.17	0.20
4	2023-03-29 15:34:57.011524	35.67	0.70
5	2023-03-29 15:35:01.966702	23152.43	2102.50
6	2023-03-29 15:35:07.538324	150.83	5.90
7	2023-03-29 15:35:12.78313	29.49	0.58
8	2023-03-29 15:35:15.725016	3849.99	350.00
9	2023-03-29 15:35:18.546178	52.49	2.50
10	2023-03-29 15:35:23.218855	157.48	7.50
\.


--
-- Name: itens_venda_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.itens_venda_id_seq', 29, true);


--
-- Name: produtos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produtos_id_seq', 10, true);


--
-- Name: tipos_produto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipos_produto_id_seq', 3, true);


--
-- Name: vendas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendas_id_seq', 10, true);


--
-- Name: itens_venda itens_venda_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itens_venda
    ADD CONSTRAINT itens_venda_pkey PRIMARY KEY (id);


--
-- Name: produtos produtos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT produtos_pkey PRIMARY KEY (id);


--
-- Name: tipos_produto tipos_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipos_produto
    ADD CONSTRAINT tipos_produto_pkey PRIMARY KEY (id);


--
-- Name: vendas vendas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas
    ADD CONSTRAINT vendas_pkey PRIMARY KEY (id);


--
-- Name: itens_venda itens_venda_produto_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itens_venda
    ADD CONSTRAINT itens_venda_produto_id_fkey FOREIGN KEY (produto_id) REFERENCES public.produtos(id);


--
-- Name: itens_venda itens_venda_venda_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itens_venda
    ADD CONSTRAINT itens_venda_venda_id_fkey FOREIGN KEY (venda_id) REFERENCES public.vendas(id);


--
-- Name: produtos produtos_tipo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT produtos_tipo_id_fkey FOREIGN KEY (tipo_id) REFERENCES public.tipos_produto(id);


--
-- PostgreSQL database dump complete
--

