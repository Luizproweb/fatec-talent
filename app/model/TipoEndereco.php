<?php

class TipoEndereco extends TRecord
{
    const TABLENAME  = 'tipo_endereco';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('descricao');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('ativo');
            
    }

    /**
     * Method getEnderecos
     */
    public function getEnderecos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_endereco_id', '=', $this->id));
        return Endereco::getObjects( $criteria );
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
    
        $values = Endereco::where('tipo_endereco_id', '=', $this->id)->getIndexedArray('tipo_endereco_id','{tipo_endereco->id}');
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
    
        $values = Endereco::where('tipo_endereco_id', '=', $this->id)->getIndexedArray('cidade_id','{cidade->id}');
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
    
        $values = Endereco::where('tipo_endereco_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    
}

