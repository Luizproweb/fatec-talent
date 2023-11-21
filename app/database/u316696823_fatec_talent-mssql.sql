CREATE TABLE area_atuacao( 
      id  INT IDENTITY    NOT NULL  , 
      codigo nvarchar(max)   , 
      descricao nvarchar(max)   , 
      ativo char  (1)     DEFAULT 'S', 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE area_atuacao_habilidade( 
      id  INT IDENTITY    NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      area_atuacao_id int   NOT NULL  , 
      habilidade_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cidade( 
      id  INT IDENTITY    NOT NULL  , 
      nome nvarchar(max)   , 
      codigo_ibge nvarchar(max)   , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
      estado_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE curso( 
      id  INT IDENTITY    NOT NULL  , 
      codigo varchar  (4)   NOT NULL  , 
      descricao nvarchar(max)   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE curso_area_atuacao( 
      id  INT IDENTITY    NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      curso_id int   NOT NULL  , 
      area_atuacao_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE endereco( 
      id  INT IDENTITY    NOT NULL  , 
      endereco nvarchar(max)   , 
      bairro nvarchar(max)   , 
      numero varchar  (10)   , 
      complemento nvarchar(max)   , 
      cep nvarchar(max)   , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      tipo_endereco_id int   NOT NULL  , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
      cidade_id int   NOT NULL  , 
      pessoa_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE estado( 
      id  INT IDENTITY    NOT NULL  , 
      nome nvarchar(max)   , 
      sigla varchar  (4)   , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
      pais_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE habilidade( 
      id  INT IDENTITY    NOT NULL  , 
      codigo varchar  (4)   NOT NULL  , 
      descricao nvarchar(max)   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE modelo_trabalho( 
      id  INT IDENTITY    NOT NULL  , 
      codigo varchar  (4)   NOT NULL  , 
      descricao nvarchar(max)   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE pais( 
      id  INT IDENTITY    NOT NULL  , 
      nome nvarchar(max)   , 
      sigla varchar  (4)   , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE papel( 
      id  INT IDENTITY    NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      descricao nvarchar(max)   NOT NULL  , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa( 
      id  INT IDENTITY    NOT NULL  , 
      nome nvarchar(max)   , 
      documento nvarchar(max)   NOT NULL  , 
      system_user int   NOT NULL  , 
      fone nvarchar(max)   , 
      celular nvarchar(max)   , 
      email nvarchar(max)   NOT NULL  , 
      site nvarchar(max)   , 
      observacao nvarchar(max)   , 
      anexo_curriculo nvarchar(max)   , 
      pessoa_cadastro_status_id int   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'Y', 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_area_atuacao( 
      id  INT IDENTITY    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      area_atuacao_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_cadastro_status( 
      id  INT IDENTITY    NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      descricao nvarchar(max)   NOT NULL  , 
      icone nvarchar(max)   , 
      cor nvarchar(max)   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_papel( 
      id  INT IDENTITY    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      papel_id int   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_vaga( 
      id  INT IDENTITY    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      vaga_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE preferencia_habilidade( 
      id  INT IDENTITY    NOT NULL  , 
      habilidade_id int   NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ramo_atividade( 
      id  INT IDENTITY    NOT NULL  , 
      nome nvarchar(max)   , 
      nome_fantasia nvarchar(max)   , 
      unidade nvarchar(max)   , 
      situacao_cadastral char  (1)   , 
      dt_inicio_atividade date   , 
      atividade_principal nvarchar(max)   , 
      atividade_secundaria nvarchar(max)   , 
      inscricao_estadual nvarchar(max)   , 
      inscricao_ativa nvarchar(max)   , 
      regime_tributario nvarchar(max)   , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      pessoa_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE regime_trabalho( 
      id  INT IDENTITY    NOT NULL  , 
      codigo varchar  (4)   NOT NULL  , 
      descricao nvarchar(max)   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      uuid varchar  (36)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      controller nvarchar(max)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      connection_name nvarchar(max)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id int   NOT NULL  , 
      name nvarchar(max)   NOT NULL  , 
      login nvarchar(max)   NOT NULL  , 
      password nvarchar(max)   NOT NULL  , 
      email nvarchar(max)   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
      accepted_term_policy_at nvarchar(max)   , 
      accepted_term_policy char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_endereco( 
      id  INT IDENTITY    NOT NULL  , 
      descricao nvarchar(max)   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE vaga( 
      id  INT IDENTITY    NOT NULL  , 
      email nvarchar(max)   NOT NULL  , 
      salario float   , 
      periodo_ini datetime2   NOT NULL  , 
      periodo_fim datetime2   NOT NULL  , 
      observacao nvarchar(max)   NOT NULL  , 
      created_at datetime2   NOT NULL  , 
      updated_at datetime2   , 
      ativo char  (1)   NOT NULL    DEFAULT 'Y', 
      pessoa_id int   NOT NULL  , 
      regime_trabalho_id int   NOT NULL  , 
      modelo_trabalho_id int   NOT NULL  , 
      curso_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE vaga_habilidade( 
      id  INT IDENTITY    NOT NULL  , 
      vaga_id int   NOT NULL  , 
      habilidade_id int   NOT NULL  , 
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
 
