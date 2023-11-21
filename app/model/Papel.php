<?php

class Papel extends TRecord
{
    const TABLENAME  = 'papel';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    const CANDIDATO = '1';
    const EMPRESA = '2';
    const ORIENTADOR = '3';

    const PAPEIS_CADASTRO = [
        self::CANDIDATO => 'Candidato',
        self::EMPRESA => 'Empresa'
    ];

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('descricao');
        parent::addAttribute('ativo');
    
    }

    /**
     * Method getPessoaPapels
     */
    public function getPessoaPapels()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('papel_id', '=', $this->id));
        return PessoaPapel::getObjects( $criteria );
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
    
        $values = PessoaPapel::where('papel_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
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
    
        $values = PessoaPapel::where('papel_id', '=', $this->id)->getIndexedArray('papel_id','{papel->id}');
        return implode(', ', $values);
    }

}

