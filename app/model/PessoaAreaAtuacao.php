<?php

class PessoaAreaAtuacao extends TRecord
{
    const TABLENAME  = 'pessoa_area_atuacao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $pessoa;
    private $area_atuacao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pessoa_id');
        parent::addAttribute('area_atuacao_id');
            
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
    /**
     * Method set_area_atuacao
     * Sample of usage: $var->area_atuacao = $object;
     * @param $object Instance of AreaAtuacao
     */
    public function set_area_atuacao(AreaAtuacao $object)
    {
        $this->area_atuacao = $object;
        $this->area_atuacao_id = $object->id;
    }

    /**
     * Method get_area_atuacao
     * Sample of usage: $var->area_atuacao->attribute;
     * @returns AreaAtuacao instance
     */
    public function get_area_atuacao()
    {
    
        // loads the associated object
        if (empty($this->area_atuacao))
            $this->area_atuacao = new AreaAtuacao($this->area_atuacao_id);
    
        // returns the associated object
        return $this->area_atuacao;
    }

    
}

