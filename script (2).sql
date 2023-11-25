create sequence departement_seq;
create sequence departement_user_seq;
create sequence fournisseur_seq;
create sequence achat_seq;
create sequence bdc_seq;
create sequence proforma_seq;

CREATE TABLE departement(
   id_departement VARCHAR(50) default 'departement'||nextval('departement_seq'),
   nom VARCHAR(50) ,
   PRIMARY KEY(id_departement)
);


CREATE TABLE departement_user(
   id_user VARCHAR(50) default 'user'||nextval('departement_user_seq') ,
   email VARCHAR(50)  NOT NULL,
   password VARCHAR(50) ,
   etat SMALLINT,
   fk_departement VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_user),
   FOREIGN KEY(fk_departement) REFERENCES departement(id_departement)
);


-- Insérer des départements
INSERT INTO departement (nom) VALUES ('Achat');
INSERT INTO departement (nom) VALUES ('Finance');
INSERT INTO departement (nom) VALUES ('Informatique');

-- Insérer des utilisateurs
INSERT INTO departement_user (email, password, etat, fk_departement) VALUES ('chefachat@example.com', 'chefachat', 1, 'departement1');
INSERT INTO departement_user (email, password, etat, fk_departement) VALUES ('cheffinance@example.com', 'cheffinance', 1, 'departement2');
INSERT INTO departement_user (email, password, etat, fk_departement) VALUES ('chefinfo@example.com', 'chefinfo', 1, 'departement3');
INSERT INTO departement_user (email, password, etat, fk_departement) VALUES ('info1@example.com', 'info1', 0, 'departement1');
INSERT INTO departement_user (email, password, etat, fk_departement) VALUES ('achat1@example.com', 'achat1', 0, 'departement1');
INSERT INTO departement_user (email, password, etat, fk_departement) VALUES ('finance1@example.com', 'finance1', 0, 'departement2');


-- Create a view to combine data from departement and departement_user
CREATE VIEW departement_user_view AS
SELECT
    du.id_user,
    du.email,
    du.password,
    du.etat,
    d.id_departement,
    d.nom AS nom_departement
FROM
    departement_user du
JOIN
    departement d ON du.fk_departement = d.id_departement;


create sequence categorie_seq;
create sequence article_seq;

CREATE TABLE categorie(
   id_categorie VARCHAR(50) default 'categorie'||nextval('categorie_seq'),
   nom VARCHAR(50) ,
   PRIMARY KEY(id_categorie)
);


CREATE TABLE article(
   id_article VARCHAR(50) default 'article'||nextval('article_seq'),
   nom VARCHAR(50) ,
   fk_categorie VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_article),
   FOREIGN KEY(fk_categorie) REFERENCES categorie(id_categorie)
);

-- Ajout de catégories
INSERT INTO categorie (nom) VALUES
    ('Electronique'),
    ('Vetements'),
    ('Maison et jardin'),
    ('Sports et loisirs');

-- Ajout d'articles
INSERT INTO article (nom, fk_categorie) VALUES
    ('Smartphone XYZ', 'categorie1'),
    ('Chemise elegante', 'categorie2'),
    ('Meuble TV en bois', 'categorie3'),
    ('Raquette de tennis','categorie4');
INSERT INTO article (nom, fk_categorie) VALUES
    ('Ordinateur de bureau', 'categorie1');


-- Création d'une vue reliant les tables categorie et article
CREATE VIEW categorie_article_view AS
SELECT
    a.id_article,
    a.nom AS nom_article,
    c.id_categorie,
    c.nom AS nom_categorie
FROM
    article a
JOIN
    categorie c ON a.fk_categorie = c.id_categorie;




create sequence dept_demande_seq;
create sequence dept_demande_detail_seq;

CREATE TABLE departement_demande(
   id_dept_demande VARCHAR(50) default 'dept_demande'||nextval('dept_demande_seq'),
   fk_departement VARCHAR(50)  NOT NULL,
   date_demande DATE default now(),
   etat SMALLINT,
   PRIMARY KEY(id_dept_demande),
   FOREIGN KEY(fk_departement) REFERENCES departement(id_departement)
);

CREATE TABLE departement_demande_detail(
   id_dept_demande_detail VARCHAR(50) default 'dept_demande_detail'||nextval('dept_demande_detail_seq'),
   fk_dept_demande VARCHAR(50)  NOT NULL,
   fk_article VARCHAR(50)  NOT NULL,
   quantite float ,
   PRIMARY KEY(id_dept_demande_detail),
   FOREIGN KEY(fk_dept_demande) REFERENCES departement_demande(id_dept_demande),
   FOREIGN KEY(fk_article) REFERENCES article(id_article)
);




delete from departement_demande_detail;
delete from departement_demande;
alter sequence dept_demande_seq restart with 1;
alter sequence dept_demande_detail_seq restart with 6;


SELECT
    EXTRACT(WEEK FROM date_demande) - EXTRACT(WEEK FROM DATE_TRUNC('MONTH', date_demande) + '1 day'::interval) + 1 AS semaine,
    EXTRACT(MONTH FROM date_demande) AS mois,
    EXTRACT(YEAR FROM date_demande) AS annee ,*
FROM departement_demande;

CREATE VIEW demande_detail AS
SELECT
    ddd.id_dept_demande_detail,
    ddd.fk_dept_demande,
    dd.etat AS etat,
    ddd.fk_article,
    a.nom AS nom_article,
    c.nom AS nom_categorie,
    ddd.quantite
FROM
    departement_demande_detail ddd
JOIN
    departement_demande dd ON ddd.fk_dept_demande = dd.id_dept_demande
JOIN
    article a ON ddd.fk_article = a.id_article
JOIN
    categorie c ON a.fk_categorie = c.id_categorie;



CREATE TABLE fournisseur(
   id_fournisseur VARCHAR(50) default 'fournisseur'||nextval('fournisseur_seq'),
   nom VARCHAR(50)  NOT NULL,
   email VARCHAR(50)  NOT NULL,
   telephone VARCHAR(50) ,
   adresse VARCHAR(50) ,
   PRIMARY KEY(id_fournisseur)
);

create table fournisseur_categorie(
    fk_fournisseur VARCHAR REFERENCES fournisseur(id_fournisseur),
    fk_categorie VARCHAR REFERENCES categorie(id_categorie)
);
create view fournisseur_categorie_article as
select fournisseur.*, fournisseur_categorie.fk_categorie,categorie.nom as nom_categorie, article.id_article, article.nom as nom_article
from fournisseur_categorie
join fournisseur on fournisseur.id_fournisseur = fournisseur_categorie.fk_fournisseur
join categorie on categorie.id_categorie = fournisseur_categorie.fk_categorie
join article on article.fk_categorie = categorie.id_categorie;

create sequence mode_de_payement_seq;
create table mode_de_payement(
    id_mode varchar default 'mode'||nextval('mode_de_payement_seq') PRIMARY KEY,
    nom_mode varchar not null
);

insert into mode_de_payement values
(default,'Airtel Money'),
(default,'Mvola'),
(default,'Banque');

create sequence seq_demande_proforma;
create table demande_proforma(
    id_proforma  varchar default 'd_proformat'||nextval('seq_demande_proforma') PRIMARY KEY,
    duree_livraison int,
    fk_payement varchar REFERENCES mode_de_payement(id_mode),
    date_demande date default now()
);

create table demande_proforma_fournisseur(
    fk_proforma varchar not null REFERENCES demande_proforma(id_proforma),
    fk_categorie varchar not null REFERENCES categorie(id_categorie),
    fk_fournisseur varchar not null REFERENCES fournisseur(id_fournisseur)
);

delete from demande_proforma_fournisseur;
--delete from demande_proforma;
--alter sequence proforma_seq restart with 1;
alter sequence seq_demande_proforma restart with 1;


create sequence seq_demande_proforma;
create table demande_proforma(
    id_proforma  varchar default 'd_proformat'||nextval('seq_demande_proforma') PRIMARY KEY,
    duree_livraison int,
    fk_payement varchar REFERENCES mode_de_payement(id_mode),
    date_demande date default now(),
    semaine int not null,
    mois int not null,
    annee int not null
);
create table demande_proforma_fournisseur(
    fk_proforma varchar not null REFERENCES demande_proforma(id_proforma),
    fk_categorie varchar not null REFERENCES categorie(id_categorie),
    fk_fournisseur varchar not null REFERENCES fournisseur(id_fournisseur), 
    etat int not null default 0
);




create sequence proforma_seq;
create sequence proforma_detail_seq;
CREATE TABLE proforma(
   id_proforma VARCHAR(50) default 'proforma'||nextval('proforma_seq'),
   fk_proforma VARCHAR(50),
   duree_livraison INTEGER,
   fk_payement VARCHAR(50),
   type_livraison INT NOT NULL,
   fk_fournisseur VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_proforma),
   FOREIGN KEY(fk_proforma) REFERENCES demande_proforma(id_proforma),
   FOREIGN KEY(fk_fournisseur) REFERENCES fournisseur(id_fournisseur),
   FOREIGN KEY(fk_payement) REFERENCES mode_de_payement(id_mode)
);

CREATE TABLE proforma_detail(
   id_proforma_detail VARCHAR(50) default 'proforma_detail'||nextval('proforma_seq'),
   fk_proforma VARCHAR(50),
   fk_article VARCHAR(50)  NOT NULL,
   prix_unitaire FLOAT ,
   quantite NUMERIC(15,2),
   FOREIGN KEY(fk_article) REFERENCES article(id_article),
   FOREIGN KEY(fk_proforma) REFERENCES proforma(id_proforma)
);









--VIEW

  create or replace view v_demande_par_semaine as
(SELECT
    EXTRACT(WEEK FROM date_demande) - EXTRACT(WEEK FROM DATE_TRUNC('MONTH', date_demande) + '1 day'::interval) + 1 AS semaine,
    EXTRACT(Month from date_demande) as mois,
    EXTRACT(YEAR from date_demande) as annee,
    departement_demande.id_dept_demande,
    fk_article,article.nom,departement.nom as nom_deparatement,
    departement.id_departement,
    quantite,
    etat,
    article.fk_categorie,
    categorie.nom as nom_categorie
FROM
    departement_demande_detail
JOIN
    departement_demande 
ON departement_demande.id_dept_demande = departement_demande_detail.fk_dept_demande
JOIN
    article
on article.id_article = departement_demande_detail.fk_article 
JOIN 
    categorie 
on categorie.id_categorie = article.fk_categorie
Join    
    departement
on departement.id_departement =departement_demande.fk_departement
);







--DATA

-- Insert test data into demande_proforma
INSERT INTO demande_proforma (duree_livraison, fk_payement, semaine, mois, annee)
VALUES
  (5, 'mode1', 4, 11, 2023),
  (7, 'mode2', 4, 11, 2023),
  (3, 'mode3', 4, 11, 2023);

-- Insert test data into demande_proforma_fournisseur
INSERT INTO demande_proforma_fournisseur (fk_proforma, fk_categorie, fk_fournisseur)
VALUES
  ('d_proformat1', 'categorie1', 'fournisseur1'),
  ('d_proformat2', 'categorie1', 'fournisseur2'),
  ('d_proformat3', 'categorie1', 'fournisseur3'),
  ('d_proformat1', 'categorie2', 'fournisseur1'),
  ('d_proformat2', 'categorie2', 'fournisseur2'),
  ('d_proformat3', 'categorie2', 'fournisseur4');

insert into fournisseur_categorie values
('fournisseur1','categorie1'),
('fournisseur1','categorie2'),
('fournisseur2','categorie3'),
('fournisseur2','categorie1'),
('fournisseur2','categorie2'),
('fournisseur3','categorie1'),
('fournisseur3','categorie2'),
('fournisseur4','categorie1'),
('fournisseur4','categorie2'),
('fournisseur4','categorie3'),
('fournisseur4','categorie4');

INSERT INTO fournisseur (nom, email, telephone, adresse) VALUES
('Shop Liantsoa', 'mirado.fitahiana03@gmail.com', '034 56 647 14', '123 Rue du Commerce'),
('Pc Upgrade', 'mirado.fitahiana03@gmail.com', '034 09 455 09', '456 Avenue des Affaires'),
('Shop U', 'mirado.fitahiana03@gmail.com', '034 43 909 43', '789 Boulevard de lIndustrie'),
('Supermaki', 'mirado.fitahiana03@gmail.com', '034 43 909 43', '789 Btsimbazaza');


--DELETING
delete from demande_proforma_fournisseur;
delete from demande_proforma;
alter sequence proforma_seq restart with 1;
alter sequence seq_demande_proforma restart with 1;

delete from proforma_detail;
delete from proforma;
alter sequence proforma_seq restart with 1;
alter sequence proforma_detail_seq restart with 1;






















