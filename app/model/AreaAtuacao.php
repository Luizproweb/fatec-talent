<?php

class AreaAtuacao extends TRecord
{
    const TABLENAME  = 'area_atuacao';
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
        parent::addAttribute('ativo');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
            
    }

    /**
     * Method getCursoAreaAtuacaos
     */
    public function getCursoAreaAtuacaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('area_atuacao_id', '=', $this->id));
        return CursoAreaAtuacao::getObjects( $criteria );
    }
    /**
     * Method getAreaAtuacaoHabilidades
     */
    public function getAreaAtuacaoHabilidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('area_atuacao_id', '=', $this->id));
        return AreaAtuacaoHabilidade::getObjects( $criteria );
    }
    /**
     * Method getPessoaAreaAtuacaos
     */
    public function getPessoaAreaAtuacaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('area_atuacao_id', '=', $this->id));
        return PessoaAreaAtuacao::getObjects( $criteria );
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
    
        $values = CursoAreaAtuacao::where('area_atuacao_id', '=', $this->id)->getIndexedArray('curso_id','{curso->id}');
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
    
        $values = CursoAreaAtuacao::where('area_atuacao_id', '=', $this->id)->getIndexedArray('area_atuacao_id','{area_atuacao->id}');
        return implode(', ', $values);
    }

    public function set_area_atuacao_habilidade_area_atuacao_to_string($area_atuacao_habilidade_area_atuacao_to_string)
    {
        if(is_array($area_atuacao_habilidade_area_atuacao_to_string))
        {
            $values = AreaAtuacao::where('id', 'in', $area_atuacao_habilidade_area_atuacao_to_string)->getIndexedArray('id', 'id');
            $this->area_atuacao_habilidade_area_atuacao_to_string = implode(', ', $values);
        }
        else
        {
            $this->area_atuacao_habilidade_area_atuacao_to_string = $area_atuacao_habilidade_area_atuacao_to_string;
        }

        $this->vdata['area_atuacao_habilidade_area_atuacao_to_string'] = $this->area_atuacao_habilidade_area_atuacao_to_string;
    }

    public function get_area_atuacao_habilidade_area_atuacao_to_string()
    {
        if(!empty($this->area_atuacao_habilidade_area_atuacao_to_string))
        {
            return $this->area_atuacao_habilidade_area_atuacao_to_string;
        }
    
        $values = AreaAtuacaoHabilidade::where('area_atuacao_id', '=', $this->id)->getIndexedArray('area_atuacao_id','{area_atuacao->id}');
        return implode(', ', $values);
    }

    public function set_area_atuacao_habilidade_habilidade_to_string($area_atuacao_habilidade_habilidade_to_string)
    {
        if(is_array($area_atuacao_habilidade_habilidade_to_string))
        {
            $values = Habilidade::where('id', 'in', $area_atuacao_habilidade_habilidade_to_string)->getIndexedArray('id', 'id');
            $this->area_atuacao_habilidade_habilidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->area_atuacao_habilidade_habilidade_to_string = $area_atuacao_habilidade_habilidade_to_string;
        }

        $this->vdata['area_atuacao_habilidade_habilidade_to_string'] = $this->area_atuacao_habilidade_habilidade_to_string;
    }

    public function get_area_atuacao_habilidade_habilidade_to_string()
    {
        if(!empty($this->area_atuacao_habilidade_habilidade_to_string))
        {
            return $this->area_atuacao_habilidade_habilidade_to_string;
        }
    
        $values = AreaAtuacaoHabilidade::where('area_atuacao_id', '=', $this->id)->getIndexedArray('habilidade_id','{habilidade->id}');
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
    
        $values = PessoaAreaAtuacao::where('area_atuacao_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
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
    
        $values = PessoaAreaAtuacao::where('area_atuacao_id', '=', $this->id)->getIndexedArray('area_atuacao_id','{area_atuacao->id}');
        return implode(', ', $values);
    }

    
}

