SELECT setval('area_atuacao_id_seq', coalesce(max(id),0) + 1, false) FROM area_atuacao;
SELECT setval('area_atuacao_habilidade_id_seq', coalesce(max(id),0) + 1, false) FROM area_atuacao_habilidade;
SELECT setval('cidade_id_seq', coalesce(max(id),0) + 1, false) FROM cidade;
SELECT setval('curso_id_seq', coalesce(max(id),0) + 1, false) FROM curso;
SELECT setval('curso_area_atuacao_id_seq', coalesce(max(id),0) + 1, false) FROM curso_area_atuacao;
SELECT setval('endereco_id_seq', coalesce(max(id),0) + 1, false) FROM endereco;
SELECT setval('estado_id_seq', coalesce(max(id),0) + 1, false) FROM estado;
SELECT setval('habilidade_id_seq', coalesce(max(id),0) + 1, false) FROM habilidade;
SELECT setval('modelo_trabalho_id_seq', coalesce(max(id),0) + 1, false) FROM modelo_trabalho;
SELECT setval('pais_id_seq', coalesce(max(id),0) + 1, false) FROM pais;
SELECT setval('papel_id_seq', coalesce(max(id),0) + 1, false) FROM papel;
SELECT setval('pessoa_id_seq', coalesce(max(id),0) + 1, false) FROM pessoa;
SELECT setval('pessoa_area_atuacao_id_seq', coalesce(max(id),0) + 1, false) FROM pessoa_area_atuacao;
SELECT setval('pessoa_cadastro_status_id_seq', coalesce(max(id),0) + 1, false) FROM pessoa_cadastro_status;
SELECT setval('pessoa_papel_id_seq', coalesce(max(id),0) + 1, false) FROM pessoa_papel;
SELECT setval('pessoa_vaga_id_seq', coalesce(max(id),0) + 1, false) FROM pessoa_vaga;
SELECT setval('preferencia_habilidade_id_seq', coalesce(max(id),0) + 1, false) FROM preferencia_habilidade;
SELECT setval('ramo_atividade_id_seq', coalesce(max(id),0) + 1, false) FROM ramo_atividade;
SELECT setval('regime_trabalho_id_seq', coalesce(max(id),0) + 1, false) FROM regime_trabalho;
SELECT setval('tipo_endereco_id_seq', coalesce(max(id),0) + 1, false) FROM tipo_endereco;
SELECT setval('vaga_id_seq', coalesce(max(id),0) + 1, false) FROM vaga;
SELECT setval('vaga_habilidade_id_seq', coalesce(max(id),0) + 1, false) FROM vaga_habilidade;