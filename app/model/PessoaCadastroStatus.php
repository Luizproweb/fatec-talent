<?php

class PessoaCadastroStatus extends TRecord
{
    const TABLENAME  = 'pessoa_cadastro_status';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    const EM_ANALISE = 1;
    const APROVADO = 2;
    const REPROVADO = 3;

    const STATUS_PESSOA = [
        //self::EM_ANALISE =>'Em análise',
        self::APROVADO => 'Aprovado',
        self::REPROVADO => 'Reprovado'
    ];
    
    const STATUS_PESSOA_MOTIVO = [
        self::APROVADO => 'Aprovar',
        self::REPROVADO => 'Reprovar'
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
        parent::addAttribute('icone');
        parent::addAttribute('cor');
        parent::addAttribute('ativo');
    
    }

    /**
     * Method getPessoas
     */
    public function getPessoas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_cadastro_status_id', '=', $this->id));
        return Pessoa::getObjects( $criteria );
    }

    public function set_pessoa_pessoa_cadastro_status_to_string($pessoa_pessoa_cadastro_status_to_string)
    {
        if(is_array($pessoa_pessoa_cadastro_status_to_string))
        {
            $values = PessoaCadastroStatus::where('id', 'in', $pessoa_pessoa_cadastro_status_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_pessoa_cadastro_status_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_pessoa_cadastro_status_to_string = $pessoa_pessoa_cadastro_status_to_string;
        }

        $this->vdata['pessoa_pessoa_cadastro_status_to_string'] = $this->pessoa_pessoa_cadastro_status_to_string;
    }

    public function get_pessoa_pessoa_cadastro_status_to_string()
    {
        if(!empty($this->pessoa_pessoa_cadastro_status_to_string))
        {
            return $this->pessoa_pessoa_cadastro_status_to_string;
        }
    
        $values = Pessoa::where('pessoa_cadastro_status_id', '=', $this->id)->getIndexedArray('pessoa_cadastro_status_id','{pessoa_cadastro_status->id}');
        return implode(', ', $values);
    }

}

