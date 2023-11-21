<?php

class Habilidade extends TRecord
{
    const TABLENAME  = 'habilidade';
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
     * Method getVagaHabilidades
     */
    public function getVagaHabilidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('habilidade_id', '=', $this->id));
        return VagaHabilidade::getObjects( $criteria );
    }
    /**
     * Method getAreaAtuacaoHabilidades
     */
    public function getAreaAtuacaoHabilidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('habilidade_id', '=', $this->id));
        return AreaAtuacaoHabilidade::getObjects( $criteria );
    }
    /**
     * Method getPreferenciaHabilidades
     */
    public function getPreferenciaHabilidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('habilidade_id', '=', $this->id));
        return PreferenciaHabilidade::getObjects( $criteria );
    }

    public function set_vaga_habilidade_vaga_to_string($vaga_habilidade_vaga_to_string)
    {
        if(is_array($vaga_habilidade_vaga_to_string))
        {
            $values = Vaga::where('id', 'in', $vaga_habilidade_vaga_to_string)->getIndexedArray('id', 'id');
            $this->vaga_habilidade_vaga_to_string = implode(', ', $values);
        }
        else
        {
            $this->vaga_habilidade_vaga_to_string = $vaga_habilidade_vaga_to_string;
        }

        $this->vdata['vaga_habilidade_vaga_to_string'] = $this->vaga_habilidade_vaga_to_string;
    }

    public function get_vaga_habilidade_vaga_to_string()
    {
        if(!empty($this->vaga_habilidade_vaga_to_string))
        {
            return $this->vaga_habilidade_vaga_to_string;
        }
    
        $values = VagaHabilidade::where('habilidade_id', '=', $this->id)->getIndexedArray('vaga_id','{vaga->id}');
        return implode(', ', $values);
    }

    public function set_vaga_habilidade_habilidade_to_string($vaga_habilidade_habilidade_to_string)
    {
        if(is_array($vaga_habilidade_habilidade_to_string))
        {
            $values = Habilidade::where('id', 'in', $vaga_habilidade_habilidade_to_string)->getIndexedArray('id', 'id');
            $this->vaga_habilidade_habilidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->vaga_habilidade_habilidade_to_string = $vaga_habilidade_habilidade_to_string;
        }

        $this->vdata['vaga_habilidade_habilidade_to_string'] = $this->vaga_habilidade_habilidade_to_string;
    }

    public function get_vaga_habilidade_habilidade_to_string()
    {
        if(!empty($this->vaga_habilidade_habilidade_to_string))
        {
            return $this->vaga_habilidade_habilidade_to_string;
        }
    
        $values = VagaHabilidade::where('habilidade_id', '=', $this->id)->getIndexedArray('habilidade_id','{habilidade->id}');
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
    
        $values = AreaAtuacaoHabilidade::where('habilidade_id', '=', $this->id)->getIndexedArray('area_atuacao_id','{area_atuacao->id}');
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
    
        $values = AreaAtuacaoHabilidade::where('habilidade_id', '=', $this->id)->getIndexedArray('habilidade_id','{habilidade->id}');
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
    
        $values = PreferenciaHabilidade::where('habilidade_id', '=', $this->id)->getIndexedArray('habilidade_id','{habilidade->id}');
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
    
        $values = PreferenciaHabilidade::where('habilidade_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    
}

