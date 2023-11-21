<?php

class Curso extends TRecord
{
    const TABLENAME  = 'curso';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('codigo');
        parent::addAttribute('descricao');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('ativo');
            
    }

    /**
     * Method getVagas
     */
    public function getVagas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('curso_id', '=', $this->id));
        return Vaga::getObjects( $criteria );
    }
    /**
     * Method getCursoAreaAtuacaos
     */
    public function getCursoAreaAtuacaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('curso_id', '=', $this->id));
        return CursoAreaAtuacao::getObjects( $criteria );
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
    
        $values = Vaga::where('curso_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
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
    
        $values = Vaga::where('curso_id', '=', $this->id)->getIndexedArray('regime_trabalho_id','{regime_trabalho->id}');
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
    
        $values = Vaga::where('curso_id', '=', $this->id)->getIndexedArray('modelo_trabalho_id','{modelo_trabalho->id}');
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
    
        $values = Vaga::where('curso_id', '=', $this->id)->getIndexedArray('curso_id','{curso->id}');
        return implode(', ', $values);
    }

    public function set_curso_area_atuacao_curso_to_string($curso_area_atuacao_curso_to_string)
    {
        if(is_array($curso_area_atuacao_curso_to_string))
        {
            $values = Curso::where('id', 'in', $curso_area_atuacao_curso_to_string)->getIndexedArray('id', 'id');
            $this->curso_area_atuacao_curso_to_string = implode(', ', $values);
        }
        else
        {
            $this->curso_area_atuacao_curso_to_string = $curso_area_atuacao_curso_to_string;
        }

        $this->vdata['curso_area_atuacao_curso_to_string'] = $this->curso_area_atuacao_curso_to_string;
    }

    public function get_curso_area_atuacao_curso_to_string()
    {
        if(!empty($this->curso_area_atuacao_curso_to_string))
        {
            return $this->curso_area_atuacao_curso_to_string;
        }
    
        $values = CursoAreaAtuacao::where('curso_id', '=', $this->id)->getIndexedArray('curso_id','{curso->id}');
        return implode(', ', $values);
    }

    public function set_curso_area_atuacao_area_atuacao_to_string($curso_area_atuacao_area_atuacao_to_string)
    {
        if(is_array($curso_area_atuacao_area_atuacao_to_string))
        {
            $values = AreaAtuacao::where('id', 'in', $curso_area_atuacao_area_atuacao_to_string)->getIndexedArray('id', 'id');
            $this->curso_area_atuacao_area_atuacao_to_string = implode(', ', $values);
        }
        else
        {
            $this->curso_area_atuacao_area_atuacao_to_string = $curso_area_atuacao_area_atuacao_to_string;
        }

        $this->vdata['curso_area_atuacao_area_atuacao_to_string'] = $this->curso_area_atuacao_area_atuacao_to_string;
    }

    public function get_curso_area_atuacao_area_atuacao_to_string()
    {
        if(!empty($this->curso_area_atuacao_area_atuacao_to_string))
        {
            return $this->curso_area_atuacao_area_atuacao_to_string;
        }
    
        $values = CursoAreaAtuacao::where('curso_id', '=', $this->id)->getIndexedArray('area_atuacao_id','{area_atuacao->id}');
        return implode(', ', $values);
    }

    
}

