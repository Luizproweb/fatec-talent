<?php

class RamoAtividade extends TRecord
{
    const TABLENAME  = 'ramo_atividade';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    private $pessoa;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('nome_fantasia');
        parent::addAttribute('unidade');
        parent::addAttribute('situacao_cadastral');
        parent::addAttribute('dt_inicio_atividade');
        parent::addAttribute('atividade_principal');
        parent::addAttribute('atividade_secundaria');
        parent::addAttribute('inscricao_estadual');
        parent::addAttribute('inscricao_ativa');
        parent::addAttribute('regime_tributario');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('pessoa_id');
            
    }

    /**
     * Method set_pessoa
     * Sample of usage: $var->pessoa = $object;
     * @param $object Instance of Pessoa
     */
    public function set_pessoa(Pessoa $object)
    {
        $this->pessoa = $object;
        $this->pessoa_id = $object->id;
    }

    /**
     * Method get_pessoa
     * Sample of usage: $var->pessoa->attribute;
     * @returns Pessoa instance
     */
    public function get_pessoa()
    {
    
        // loads the associated object
        if (empty($this->pessoa))
            $this->pessoa = new Pessoa($this->pessoa_id);
    
        // returns the associated object
        return $this->pessoa;
    }

    
}

