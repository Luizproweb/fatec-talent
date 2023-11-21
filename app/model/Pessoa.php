<?php

class Pessoa extends TRecord
{
    const TABLENAME  = 'pessoa';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    private $fk_system_user;
    private $pessoa_cadastro_status;

    private $fk_system_user_fatec;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('documento');
        parent::addAttribute('system_user');
        parent::addAttribute('fone');
        parent::addAttribute('celular');
        parent::addAttribute('email');
        parent::addAttribute('site');
        parent::addAttribute('observacao');
        parent::addAttribute('anexo_curriculo');
        parent::addAttribute('pessoa_cadastro_status_id');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('ativo');
    
    }

    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_fk_system_user(SystemUsers $object)
    {
        $this->fk_system_user = $object;
        $this->system_user = $object->id;
    }

    /**
     * Method get_fk_system_user
     * Sample of usage: $var->fk_system_user->attribute;
     * @returns SystemUsers instance
     */
    public function get_fk_system_user()
    {
        TTransaction::open('permission');
        // loads the associated object
        if (empty($this->fk_system_user))
            $this->fk_system_user = new SystemUsers($this->system_user);
        TTransaction::close();
        // returns the associated object
        return $this->fk_system_user;
    }
    /**
     * Method set_pessoa_cadastro_status
     * Sample of usage: $var->pessoa_cadastro_status = $object;
     * @param $object Instance of PessoaCadastroStatus
     */
    public function set_pessoa_cadastro_status(PessoaCadastroStatus $object)
    {
        $this->pessoa_cadastro_status = $object;
        $this->pessoa_cadastro_status_id = $object->id;
    }

    /**
     * Method get_pessoa_cadastro_status
     * Sample of usage: $var->pessoa_cadastro_status->attribute;
     * @returns PessoaCadastroStatus instance
     */
    public function get_pessoa_cadastro_status()
    {
    
        // loads the associated object
        if (empty($this->pessoa_cadastro_status))
            $this->pessoa_cadastro_status = new PessoaCadastroStatus($this->pessoa_cadastro_status_id);
    
        // returns the associated object
        return $this->pessoa_cadastro_status;
    }

    /**
     * Method getPessoaPapels
     */
    public function getPessoaPapels()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return PessoaPapel::getObjects( $criteria );
    }
    /**
     * Method getPessoaVagas
     */
    public function getPessoaVagas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return PessoaVaga::getObjects( $criteria );
    }
    /**
     * Method getVagas
     */
    public function getVagas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return Vaga::getObjects( $criteria );
    }
    /**
     * Method getEnderecos
     */
    public function getEnderecos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return Endereco::getObjects( $criteria );
    }
    /**
     * Method getRamoAtividades
     */
    public function getRamoAtividades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return RamoAtividade::getObjects( $criteria );
    }
    /**
     * Method getPreferenciaHabilidades
     */
    public function getPreferenciaHabilidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return PreferenciaHabilidade::getObjects( $criteria );
    }
    /**
     * Method getPessoaAreaAtuacaos
     */
    public function getPessoaAreaAtuacaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return PessoaAreaAtuacao::getObjects( $criteria );
    }

    public function set_pessoa_papel_pessoa_to_string($pessoa_papel_pessoa_to_string)
    {
        if(is_array($pessoa_papel_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $pessoa_papel_pessoa_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_papel_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_papel_pessoa_to_string = $pessoa_papel_pessoa_to_string;
        }

        $this->vdata['pessoa_papel_pessoa_to_string'] = $this->pessoa_papel_pessoa_to_string;
    }

    public function get_pessoa_papel_pessoa_to_string()
    {
        if(!empty($this->pessoa_papel_pessoa_to_string))
        {
            return $this->pessoa_papel_pessoa_to_string;
        }
    
        $values = PessoaPapel::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    public function set_pessoa_papel_papel_to_string($pessoa_papel_papel_to_string)
    {
        if(is_array($pessoa_papel_papel_to_string))
        {
            $values = Papel::where('id', 'in', $pessoa_papel_papel_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_papel_papel_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_papel_papel_to_string = $pessoa_papel_papel_to_string;
        }

        $this->vdata['pessoa_papel_papel_to_string'] = $this->pessoa_papel_papel_to_string;
    }

    public function get_pessoa_papel_papel_to_string()
    {
        if(!empty($this->pessoa_papel_papel_to_string))
        {
            return $this->pessoa_papel_papel_to_string;
        }
    
        $values = PessoaPapel::where('pessoa_id', '=', $this->id)->getIndexedArray('papel_id','{papel->id}');
        return implode(', ', $values);
    }

    public function set_pessoa_vaga_pessoa_to_string($pessoa_vaga_pessoa_to_string)
    {
        if(is_array($pessoa_vaga_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $pessoa_vaga_pessoa_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_vaga_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_vaga_pessoa_to_string = $pessoa_vaga_pessoa_to_string;
        }

        $this->vdata['pessoa_vaga_pessoa_to_string'] = $this->pessoa_vaga_pessoa_to_string;
    }

    public function get_pessoa_vaga_pessoa_to_string()
    {
        if(!empty($this->pessoa_vaga_pessoa_to_string))
        {
            return $this->pessoa_vaga_pessoa_to_string;
        }
    
        $values = PessoaVaga::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    public function set_pessoa_vaga_vaga_to_string($pessoa_vaga_vaga_to_string)
    {
        if(is_array($pessoa_vaga_vaga_to_string))
        {
            $values = Vaga::where('id', 'in', $pessoa_vaga_vaga_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_vaga_vaga_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_vaga_vaga_to_string = $pessoa_vaga_vaga_to_string;
        }

        $this->vdata['pessoa_vaga_vaga_to_string'] = $this->pessoa_vaga_vaga_to_string;
    }

    public function get_pessoa_vaga_vaga_to_string()
    {
        if(!empty($this->pessoa_vaga_vaga_to_string))
        {
            return $this->pessoa_vaga_vaga_to_string;
        }
    
        $values = PessoaVaga::where('pessoa_id', '=', $this->id)->getIndexedArray('vaga_id','{vaga->id}');
        return implode(', ', $values);
    }

    public function set_vaga_pessoa_to_string($vaga_pessoa_to_string)
    {
        if(is_array($vaga_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $vaga_pessoa_to_string)->getIndexedArray('id', 'id');
            $this->vaga_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->vaga_pessoa_to_string = $vaga_pessoa_to_string;
        }

        $this->vdata['vaga_pessoa_to_string'] = $this->vaga_pessoa_to_string;
    }

    public function get_vaga_pessoa_to_string()
    {
        if(!empty($this->vaga_pessoa_to_string))
        {
            return $this->vaga_pessoa_to_string;
        }
    
        $values = Vaga::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    public function set_vaga_regime_trabalho_to_string($vaga_regime_trabalho_to_string)
    {
        if(is_array($vaga_regime_trabalho_to_string))
        {
            $values = RegimeTrabalho::where('id', 'in', $vaga_regime_trabalho_to_string)->getIndexedArray('id', 'id');
            $this->vaga_regime_trabalho_to_string = implode(', ', $values);
        }
        else
        {
            $this->vaga_regime_trabalho_to_string = $vaga_regime_trabalho_to_string;
        }

        $this->vdata['vaga_regime_trabalho_to_string'] = $this->vaga_regime_trabalho_to_string;
    }

    public function get_vaga_regime_trabalho_to_string()
    {
        if(!empty($this->vaga_regime_trabalho_to_string))
        {
            return $this->vaga_regime_trabalho_to_string;
        }
    
        $values = Vaga::where('pessoa_id', '=', $this->id)->getIndexedArray('regime_trabalho_id','{regime_trabalho->id}');
        return implode(', ', $values);
    }

    public function set_vaga_modelo_trabalho_to_string($vaga_modelo_trabalho_to_string)
    {
        if(is_array($vaga_modelo_trabalho_to_string))
        {
            $values = ModeloTrabalho::where('id', 'in', $vaga_modelo_trabalho_to_string)->getIndexedArray('id', 'id');
            $this->vaga_modelo_trabalho_to_string = implode(', ', $values);
        }
        else
        {
            $this->vaga_modelo_trabalho_to_string = $vaga_modelo_trabalho_to_string;
        }

        $this->vdata['vaga_modelo_trabalho_to_string'] = $this->vaga_modelo_trabalho_to_string;
    }

    public function get_vaga_modelo_trabalho_to_string()
    {
        if(!empty($this->vaga_modelo_trabalho_to_string))
        {
            return $this->vaga_modelo_trabalho_to_string;
        }
    
        $values = Vaga::where('pessoa_id', '=', $this->id)->getIndexedArray('modelo_trabalho_id','{modelo_trabalho->id}');
        return implode(', ', $values);
    }

    public function set_vaga_curso_to_string($vaga_curso_to_string)
    {
        if(is_array($vaga_curso_to_string))
        {
            $values = Curso::where('id', 'in', $vaga_curso_to_string)->getIndexedArray('id', 'id');
            $this->vaga_curso_to_string = implode(', ', $values);
        }
        else
        {
            $this->vaga_curso_to_string = $vaga_curso_to_string;
        }

        $this->vdata['vaga_curso_to_string'] = $this->vaga_curso_to_string;
    }

    public function get_vaga_curso_to_string()
    {
        if(!empty($this->vaga_curso_to_string))
        {
            return $this->vaga_curso_to_string;
        }
    
        $values = Vaga::where('pessoa_id', '=', $this->id)->getIndexedArray('curso_id','{curso->id}');
        return implode(', ', $values);
    }

    public function set_endereco_tipo_endereco_to_string($endereco_tipo_endereco_to_string)
    {
        if(is_array($endereco_tipo_endereco_to_string))
        {
            $values = TipoEndereco::where('id', 'in', $endereco_tipo_endereco_to_string)->getIndexedArray('id', 'id');
            $this->endereco_tipo_endereco_to_string = implode(', ', $values);
        }
        else
        {
            $this->endereco_tipo_endereco_to_string = $endereco_tipo_endereco_to_string;
        }

        $this->vdata['endereco_tipo_endereco_to_string'] = $this->endereco_tipo_endereco_to_string;
    }

    public function get_endereco_tipo_endereco_to_string()
    {
        if(!empty($this->endereco_tipo_endereco_to_string))
        {
            return $this->endereco_tipo_endereco_to_string;
        }
    
        $values = Endereco::where('pessoa_id', '=', $this->id)->getIndexedArray('tipo_endereco_id','{tipo_endereco->id}');
        return implode(', ', $values);
    }

    public function set_endereco_cidade_to_string($endereco_cidade_to_string)
    {
        if(is_array($endereco_cidade_to_string))
        {
            $values = Cidade::where('id', 'in', $endereco_cidade_to_string)->getIndexedArray('id', 'id');
            $this->endereco_cidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->endereco_cidade_to_string = $endereco_cidade_to_string;
        }

        $this->vdata['endereco_cidade_to_string'] = $this->endereco_cidade_to_string;
    }

    public function get_endereco_cidade_to_string()
    {
        if(!empty($this->endereco_cidade_to_string))
        {
            return $this->endereco_cidade_to_string;
        }
    
        $values = Endereco::where('pessoa_id', '=', $this->id)->getIndexedArray('cidade_id','{cidade->id}');
        return implode(', ', $values);
    }

    public function set_endereco_pessoa_to_string($endereco_pessoa_to_string)
    {
        if(is_array($endereco_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $endereco_pessoa_to_string)->getIndexedArray('id', 'id');
            $this->endereco_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->endereco_pessoa_to_string = $endereco_pessoa_to_string;
        }

        $this->vdata['endereco_pessoa_to_string'] = $this->endereco_pessoa_to_string;
    }

    public function get_endereco_pessoa_to_string()
    {
        if(!empty($this->endereco_pessoa_to_string))
        {
            return $this->endereco_pessoa_to_string;
        }
    
        $values = Endereco::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    public function set_ramo_atividade_pessoa_to_string($ramo_atividade_pessoa_to_string)
    {
        if(is_array($ramo_atividade_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $ramo_atividade_pessoa_to_string)->getIndexedArray('id', 'id');
            $this->ramo_atividade_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->ramo_atividade_pessoa_to_string = $ramo_atividade_pessoa_to_string;
        }

        $this->vdata['ramo_atividade_pessoa_to_string'] = $this->ramo_atividade_pessoa_to_string;
    }

    public function get_ramo_atividade_pessoa_to_string()
    {
        if(!empty($this->ramo_atividade_pessoa_to_string))
        {
            return $this->ramo_atividade_pessoa_to_string;
        }
    
        $values = RamoAtividade::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    public function set_preferencia_habilidade_habilidade_to_string($preferencia_habilidade_habilidade_to_string)
    {
        if(is_array($preferencia_habilidade_habilidade_to_string))
        {
            $values = Habilidade::where('id', 'in', $preferencia_habilidade_habilidade_to_string)->getIndexedArray('id', 'id');
            $this->preferencia_habilidade_habilidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->preferencia_habilidade_habilidade_to_string = $preferencia_habilidade_habilidade_to_string;
        }

        $this->vdata['preferencia_habilidade_habilidade_to_string'] = $this->preferencia_habilidade_habilidade_to_string;
    }

    public function get_preferencia_habilidade_habilidade_to_string()
    {
        if(!empty($this->preferencia_habilidade_habilidade_to_string))
        {
            return $this->preferencia_habilidade_habilidade_to_string;
        }
    
        $values = PreferenciaHabilidade::where('pessoa_id', '=', $this->id)->getIndexedArray('habilidade_id','{habilidade->id}');
        return implode(', ', $values);
    }

    public function set_preferencia_habilidade_pessoa_to_string($preferencia_habilidade_pessoa_to_string)
    {
        if(is_array($preferencia_habilidade_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $preferencia_habilidade_pessoa_to_string)->getIndexedArray('id', 'id');
            $this->preferencia_habilidade_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->preferencia_habilidade_pessoa_to_string = $preferencia_habilidade_pessoa_to_string;
        }

        $this->vdata['preferencia_habilidade_pessoa_to_string'] = $this->preferencia_habilidade_pessoa_to_string;
    }

    public function get_preferencia_habilidade_pessoa_to_string()
    {
        if(!empty($this->preferencia_habilidade_pessoa_to_string))
        {
            return $this->preferencia_habilidade_pessoa_to_string;
        }
    
        $values = PreferenciaHabilidade::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    public function set_pessoa_area_atuacao_pessoa_to_string($pessoa_area_atuacao_pessoa_to_string)
    {
        if(is_array($pessoa_area_atuacao_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $pessoa_area_atuacao_pessoa_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_area_atuacao_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_area_atuacao_pessoa_to_string = $pessoa_area_atuacao_pessoa_to_string;
        }

        $this->vdata['pessoa_area_atuacao_pessoa_to_string'] = $this->pessoa_area_atuacao_pessoa_to_string;
    }

    public function get_pessoa_area_atuacao_pessoa_to_string()
    {
        if(!empty($this->pessoa_area_atuacao_pessoa_to_string))
        {
            return $this->pessoa_area_atuacao_pessoa_to_string;
        }
    
        $values = PessoaAreaAtuacao::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    public function set_pessoa_area_atuacao_area_atuacao_to_string($pessoa_area_atuacao_area_atuacao_to_string)
    {
        if(is_array($pessoa_area_atuacao_area_atuacao_to_string))
        {
            $values = AreaAtuacao::where('id', 'in', $pessoa_area_atuacao_area_atuacao_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_area_atuacao_area_atuacao_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_area_atuacao_area_atuacao_to_string = $pessoa_area_atuacao_area_atuacao_to_string;
        }

        $this->vdata['pessoa_area_atuacao_area_atuacao_to_string'] = $this->pessoa_area_atuacao_area_atuacao_to_string;
    }

    public function get_pessoa_area_atuacao_area_atuacao_to_string()
    {
        if(!empty($this->pessoa_area_atuacao_area_atuacao_to_string))
        {
            return $this->pessoa_area_atuacao_area_atuacao_to_string;
        }
    
        $values = PessoaAreaAtuacao::where('pessoa_id', '=', $this->id)->getIndexedArray('area_atuacao_id','{area_atuacao->id}');
        return implode(', ', $values);
    }

    public static function newFromDocumento($docto)
    {
        return Pessoa::where('trim(documento)','=',trim($docto))->first();
    }

    public function get_fk_system_user_fatec()
    {
        TTransaction::open('u316696823_fatec_talent');
        // loads the associated object
        if (empty($this->fk_system_user_fatec))
            $this->fk_system_user_fatec = new SystemUsers($this->system_user);
        TTransaction::close();
        // returns the associated object
        return $this->fk_system_user_fatec;
    }

        
}

