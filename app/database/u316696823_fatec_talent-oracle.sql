CREATE TABLE area_atuacao( 
      id number(10)    NOT NULL , 
      codigo varchar(3000)   , 
      descricao varchar(3000)   , 
      ativo char  (1)    DEFAULT 'S' , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE area_atuacao_habilidade( 
      id number(10)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      area_atuacao_id number(10)    NOT NULL , 
      habilidade_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cidade( 
      id number(10)    NOT NULL , 
      nome varchar(3000)   , 
      codigo_ibge varchar(3000)   , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
      estado_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE curso( 
      id number(10)    NOT NULL , 
      codigo varchar  (4)    NOT NULL , 
      descricao varchar(3000)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE curso_area_atuacao( 
      id number(10)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      curso_id number(10)    NOT NULL , 
      area_atuacao_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE endereco( 
      id number(10)    NOT NULL , 
      endereco varchar(3000)   , 
      bairro varchar(3000)   , 
      numero varchar  (10)   , 
      complemento varchar(3000)   , 
      cep varchar(3000)   , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      tipo_endereco_id number(10)    NOT NULL , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
      cidade_id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE estado( 
      id number(10)    NOT NULL , 
      nome varchar(3000)   , 
      sigla varchar  (4)   , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
      pais_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE habilidade( 
      id number(10)    NOT NULL , 
      codigo varchar  (4)    NOT NULL , 
      descricao varchar(3000)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE modelo_trabalho( 
      id number(10)    NOT NULL , 
      codigo varchar  (4)    NOT NULL , 
      descricao varchar(3000)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pais( 
      id number(10)    NOT NULL , 
      nome varchar(3000)   , 
      sigla varchar  (4)   , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE papel( 
      id number(10)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      descricao varchar(3000)    NOT NULL , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa( 
      id number(10)    NOT NULL , 
      nome varchar(3000)   , 
      documento varchar(3000)    NOT NULL , 
      system_user number(10)    NOT NULL , 
      fone varchar(3000)   , 
      celular varchar(3000)   , 
      email varchar(3000)    NOT NULL , 
      site varchar(3000)   , 
      observacao varchar(3000)   , 
      anexo_curriculo varchar(3000)   , 
      pessoa_cadastro_status_id number(10)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'Y'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_area_atuacao( 
      id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      area_atuacao_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_cadastro_status( 
      id number(10)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      descricao varchar(3000)    NOT NULL , 
      icone varchar(3000)   , 
      cor varchar(3000)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_papel( 
      id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      papel_id number(10)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_vaga( 
      id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      vaga_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE preferencia_habilidade( 
      id number(10)    NOT NULL , 
      habilidade_id number(10)    NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ramo_atividade( 
      id number(10)    NOT NULL , 
      nome varchar(3000)   , 
      nome_fantasia varchar(3000)   , 
      unidade varchar(3000)   , 
      situacao_cadastral char  (1)   , 
      dt_inicio_atividade date   , 
      atividade_principal varchar(3000)   , 
      atividade_secundaria varchar(3000)   , 
      inscricao_estadual varchar(3000)   , 
      inscricao_ativa varchar(3000)   , 
      regime_tributario varchar(3000)   , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      pessoa_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE regime_trabalho( 
      id number(10)    NOT NULL , 
      codigo varchar  (4)    NOT NULL , 
      descricao varchar(3000)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      uuid varchar  (36)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)    NOT NULL , 
      preference varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      controller varchar(3000)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      connection_name varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id number(10)    NOT NULL , 
      name varchar(3000)    NOT NULL , 
      login varchar(3000)    NOT NULL , 
      password varchar(3000)    NOT NULL , 
      email varchar(3000)   , 
      frontpage_id number(10)   , 
      system_unit_id number(10)   , 
      active char  (1)   , 
      accepted_term_policy_at varchar(3000)   , 
      accepted_term_policy char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_unit_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_endereco( 
      id number(10)    NOT NULL , 
      descricao varchar(3000)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'S'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE vaga( 
      id number(10)    NOT NULL , 
      email varchar(3000)    NOT NULL , 
      salario binary_double   , 
      periodo_ini timestamp(0)    NOT NULL , 
      periodo_fim timestamp(0)    NOT NULL , 
      observacao varchar(3000)    NOT NULL , 
      created_at timestamp(0)    NOT NULL , 
      updated_at timestamp(0)   , 
      ativo char  (1)    DEFAULT 'Y'  NOT NULL , 
      pessoa_id number(10)    NOT NULL , 
      regime_trabalho_id number(10)    NOT NULL , 
      modelo_trabalho_id number(10)    NOT NULL , 
      curso_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE vaga_habilidade( 
      id number(10)    NOT NULL , 
      vaga_id number(10)    NOT NULL , 
      habilidade_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE area_atuacao_habilidade ADD CONSTRAINT fk_curso_area_atuacao_2 FOREIGN KEY (habilidade_id) references habilidade(id); 
ALTER TABLE area_atuacao_habilidade ADD CONSTRAINT fk_area_atuacao_habilidades_2 FOREIGN KEY (area_atuacao_id) references area_atuacao(id); 
ALTER TABLE cidade ADD CONSTRAINT fk_cidade_1 FOREIGN KEY (estado_id) references estado(id); 
ALTER TABLE curso_area_atuacao ADD CONSTRAINT fk_curso_area_atuacao_1 FOREIGN KEY (curso_id) references curso(id); 
ALTER TABLE curso_area_atuacao ADD CONSTRAINT fk_curso_area_atuacao_2 FOREIGN KEY (area_atuacao_id) references area_atuacao(id); 
ALTER TABLE endereco ADD CONSTRAINT fk_endereco_1 FOREIGN KEY (tipo_endereco_id) references tipo_endereco(id); 
ALTER TABLE endereco ADD CONSTRAINT fk_endereco_2 FOREIGN KEY (cidade_id) references cidade(id); 
ALTER TABLE endereco ADD CONSTRAINT fk_endereco_3 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE estado ADD CONSTRAINT fk_estado_1 FOREIGN KEY (pais_id) references pais(id); 
ALTER TABLE pessoa ADD CONSTRAINT fk_pessoa_1 FOREIGN KEY (pessoa_cadastro_status_id) references pessoa_cadastro_status(id); 
ALTER TABLE pessoa_area_atuacao ADD CONSTRAINT fk_pessoa_area_atuacao_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_area_atuacao ADD CONSTRAINT fk_pessoa_area_atuacao_2 FOREIGN KEY (area_atuacao_id) references area_atuacao(id); 
ALTER TABLE pessoa_papel ADD CONSTRAINT fk_pessoa_papel_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_papel ADD CONSTRAINT fk_pessoa_papel_2 FOREIGN KEY (papel_id) references papel(id); 
ALTER TABLE pessoa_vaga ADD CONSTRAINT fk_pessoa_vaga_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_vaga ADD CONSTRAINT fk_pessoa_vaga_2 FOREIGN KEY (vaga_id) references vaga(id); 
ALTER TABLE preferencia_habilidade ADD CONSTRAINT fk_preferencia_habilidade_1 FOREIGN KEY (habilidade_id) references habilidade(id); 
ALTER TABLE preferencia_habilidade ADD CONSTRAINT fk_preferencia_habilidade_2 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE ramo_atividade ADD CONSTRAINT fk_ramo_atividade_pessoa_id FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_2 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_1 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_1 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_2 FOREIGN KEY (frontpage_id) references system_program(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_2 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE vaga ADD CONSTRAINT fk_vaga_2 FOREIGN KEY (regime_trabalho_id) references regime_trabalho(id); 
ALTER TABLE vaga ADD CONSTRAINT fk_vaga_3 FOREIGN KEY (modelo_trabalho_id) references modelo_trabalho(id); 
ALTER TABLE vaga ADD CONSTRAINT fk_vaga_4 FOREIGN KEY (curso_id) references curso(id); 
ALTER TABLE vaga ADD CONSTRAINT vaga_pessoa_id_fkey FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE vaga_habilidade ADD CONSTRAINT fk_vaga_area_atuacao_1 FOREIGN KEY (vaga_id) references vaga(id); 
ALTER TABLE vaga_habilidade ADD CONSTRAINT fk_vaga_area_atuacao_2 FOREIGN KEY (habilidade_id) references habilidade(id); 
 CREATE SEQUENCE area_atuacao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER area_atuacao_id_seq_tr 

BEFORE INSERT ON area_atuacao FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT area_atuacao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE area_atuacao_habilidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER area_atuacao_habilidade_id_seq_tr 

BEFORE INSERT ON area_atuacao_habilidade FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT area_atuacao_habilidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cidade_id_seq_tr 

BEFORE INSERT ON cidade FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT cidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE curso_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER curso_id_seq_tr 

BEFORE INSERT ON curso FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT curso_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE curso_area_atuacao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER curso_area_atuacao_id_seq_tr 

BEFORE INSERT ON curso_area_atuacao FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT curso_area_atuacao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE endereco_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER endereco_id_seq_tr 

BEFORE INSERT ON endereco FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT endereco_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE estado_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER estado_id_seq_tr 

BEFORE INSERT ON estado FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT estado_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE habilidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER habilidade_id_seq_tr 

BEFORE INSERT ON habilidade FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT habilidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE modelo_trabalho_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER modelo_trabalho_id_seq_tr 

BEFORE INSERT ON modelo_trabalho FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT modelo_trabalho_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pais_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pais_id_seq_tr 

BEFORE INSERT ON pais FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pais_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE papel_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER papel_id_seq_tr 

BEFORE INSERT ON papel FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT papel_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_id_seq_tr 

BEFORE INSERT ON pessoa FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_area_atuacao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_area_atuacao_id_seq_tr 

BEFORE INSERT ON pessoa_area_atuacao FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_area_atuacao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_cadastro_status_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_cadastro_status_id_seq_tr 

BEFORE INSERT ON pessoa_cadastro_status FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_cadastro_status_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_papel_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_papel_id_seq_tr 

BEFORE INSERT ON pessoa_papel FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_papel_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pessoa_vaga_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pessoa_vaga_id_seq_tr 

BEFORE INSERT ON pessoa_vaga FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT pessoa_vaga_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE preferencia_habilidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER preferencia_habilidade_id_seq_tr 

BEFORE INSERT ON preferencia_habilidade FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT preferencia_habilidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ramo_atividade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ramo_atividade_id_seq_tr 

BEFORE INSERT ON ramo_atividade FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT ramo_atividade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE regime_trabalho_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER regime_trabalho_id_seq_tr 

BEFORE INSERT ON regime_trabalho FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT regime_trabalho_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_endereco_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_endereco_id_seq_tr 

BEFORE INSERT ON tipo_endereco FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT tipo_endereco_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE vaga_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER vaga_id_seq_tr 

BEFORE INSERT ON vaga FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT vaga_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE vaga_habilidade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER vaga_habilidade_id_seq_tr 

BEFORE INSERT ON vaga_habilidade FOR EACH ROW 

    WHEN 

        (NEW.id IS NULL) 

    BEGIN 

        SELECT vaga_habilidade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
 CREATE VIEW fat_pessoa_area_atuacao_habilidade AS SELECT DISTINCT
    vpaah.pessoa_ai as pessoa_ai ,
    vpaah.pessoa_nome as pessoa_nome,
    vpaah.pessoa_fone as pessoa_fone,
    vpaah.pessoa_celular as pessoa_celular,
    vpaah.pessoa_email as pessoa_email,
    vpaah.pessoa_curriculo as pessoa_curriculo
from view_pessoa_area_atuacao_habilidade vpaah ;; 

CREATE VIEW view_pessoa_area_atuacao_habilidade AS SELECT 
    p.id as pessoa_ai,
    su.name as pessoa_nome,
    p.fone as pessoa_fone,
    p.celular as pessoa_celular,
    p.email as pessoa_email,
    p.anexo_curriculo as pessoa_curriculo,
    aa.id as area_atuacao_id,
    null as habilidade_id
  FROM pessoa p
    inner join system_users su on su.id = p.system_user
    inner join pessoa_area_atuacao paa on paa.pessoa_id = p.id
    inner join area_atuacao aa on aa.id = paa.area_atuacao_id
union all
SELECT 
    p.id as pessoa_ai,
    su.name as pessoa_nome,
    p.fone as pessoa_fone,
    p.celular as pessoa_celular,
    p.email as pessoa_email,
    p.anexo_curriculo as pessoa_curriculo,
    null as area_atuacao_id,
    h.id as habilidade_id
  FROM pessoa p
    inner join system_users su on su.id = p.system_user
    inner join preferencia_habilidade ph on ph.pessoa_id = p.id
    inner join habilidade h on h.id = ph.habilidade_id ;; 
 
