PRAGMA foreign_keys=OFF; 

CREATE TABLE area_atuacao( 
      id  INTEGER    NOT NULL  , 
      codigo text   , 
      descricao text   , 
      ativo char  (1)     DEFAULT 'S', 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE area_atuacao_habilidade( 
      id  INTEGER    NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      area_atuacao_id int   NOT NULL  , 
      habilidade_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(habilidade_id) REFERENCES habilidade(id),
FOREIGN KEY(area_atuacao_id) REFERENCES area_atuacao(id)) ; 

CREATE TABLE cidade( 
      id  INTEGER    NOT NULL  , 
      nome text   , 
      codigo_ibge text   , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
      estado_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(estado_id) REFERENCES estado(id)) ; 

CREATE TABLE curso( 
      id  INTEGER    NOT NULL  , 
      codigo varchar  (4)   NOT NULL  , 
      descricao text   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE curso_area_atuacao( 
      id  INTEGER    NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      curso_id int   NOT NULL  , 
      area_atuacao_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(curso_id) REFERENCES curso(id),
FOREIGN KEY(area_atuacao_id) REFERENCES area_atuacao(id)) ; 

CREATE TABLE endereco( 
      id  INTEGER    NOT NULL  , 
      endereco text   , 
      bairro text   , 
      numero varchar  (10)   , 
      complemento text   , 
      cep text   , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      tipo_endereco_id int   NOT NULL  , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
      cidade_id int   NOT NULL  , 
      pessoa_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_endereco_id) REFERENCES tipo_endereco(id),
FOREIGN KEY(cidade_id) REFERENCES cidade(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE estado( 
      id  INTEGER    NOT NULL  , 
      nome text   , 
      sigla varchar  (4)   , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
      pais_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(pais_id) REFERENCES pais(id)) ; 

CREATE TABLE habilidade( 
      id  INTEGER    NOT NULL  , 
      codigo varchar  (4)   NOT NULL  , 
      descricao text   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE modelo_trabalho( 
      id  INTEGER    NOT NULL  , 
      codigo varchar  (4)   NOT NULL  , 
      descricao text   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE pais( 
      id  INTEGER    NOT NULL  , 
      nome text   , 
      sigla varchar  (4)   , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE papel( 
      id  INTEGER    NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      descricao text   NOT NULL  , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa( 
      id  INTEGER    NOT NULL  , 
      nome text   , 
      documento text   NOT NULL  , 
      system_user int   NOT NULL  , 
      fone text   , 
      celular text   , 
      email text   NOT NULL  , 
      site text   , 
      observacao text   , 
      anexo_curriculo text   , 
      pessoa_cadastro_status_id int   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'Y', 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_cadastro_status_id) REFERENCES pessoa_cadastro_status(id)) ; 

CREATE TABLE pessoa_area_atuacao( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      area_atuacao_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id),
FOREIGN KEY(area_atuacao_id) REFERENCES area_atuacao(id)) ; 

CREATE TABLE pessoa_cadastro_status( 
      id  INTEGER    NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      descricao text   NOT NULL  , 
      icone text   , 
      cor text   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE pessoa_papel( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      papel_id int   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id),
FOREIGN KEY(papel_id) REFERENCES papel(id)) ; 

CREATE TABLE pessoa_vaga( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      vaga_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id),
FOREIGN KEY(vaga_id) REFERENCES vaga(id)) ; 

CREATE TABLE preferencia_habilidade( 
      id  INTEGER    NOT NULL  , 
      habilidade_id int   NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(habilidade_id) REFERENCES habilidade(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE ramo_atividade( 
      id  INTEGER    NOT NULL  , 
      nome text   , 
      nome_fantasia text   , 
      unidade text   , 
      situacao_cadastral char  (1)   , 
      dt_inicio_atividade date   , 
      atividade_principal text   , 
      atividade_secundaria text   , 
      inscricao_estadual text   , 
      inscricao_ativa text   , 
      regime_tributario text   , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      pessoa_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE regime_trabalho( 
      id  INTEGER    NOT NULL  , 
      codigo varchar  (4)   NOT NULL  , 
      descricao text   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      uuid varchar  (36)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      connection_name text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_user_program( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_users( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
      accepted_term_policy_at text   , 
      accepted_term_policy char  (1)   , 
 PRIMARY KEY (id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id),
FOREIGN KEY(frontpage_id) REFERENCES system_program(id)) ; 

CREATE TABLE system_user_unit( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id)) ; 

CREATE TABLE tipo_endereco( 
      id  INTEGER    NOT NULL  , 
      descricao text   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'S', 
 PRIMARY KEY (id)) ; 

CREATE TABLE vaga( 
      id  INTEGER    NOT NULL  , 
      email text   NOT NULL  , 
      salario double   , 
      periodo_ini datetime   NOT NULL  , 
      periodo_fim datetime   NOT NULL  , 
      observacao text   NOT NULL  , 
      created_at datetime   NOT NULL  , 
      updated_at datetime   , 
      ativo char  (1)   NOT NULL    DEFAULT 'Y', 
      pessoa_id int   NOT NULL  , 
      regime_trabalho_id int   NOT NULL  , 
      modelo_trabalho_id int   NOT NULL  , 
      curso_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(regime_trabalho_id) REFERENCES regime_trabalho(id),
FOREIGN KEY(modelo_trabalho_id) REFERENCES modelo_trabalho(id),
FOREIGN KEY(curso_id) REFERENCES curso(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE vaga_habilidade( 
      id  INTEGER    NOT NULL  , 
      vaga_id int   NOT NULL  , 
      habilidade_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(vaga_id) REFERENCES vaga(id),
FOREIGN KEY(habilidade_id) REFERENCES habilidade(id)) ; 

 
 
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
 
