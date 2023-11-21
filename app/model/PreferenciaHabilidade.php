<?php

class PreferenciaHabilidade extends TRecord
{
    const TABLENAME  = 'preferencia_habilidade';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    private $habilidade;
    private $pessoa;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('habilidade_id');
        parent::addAttribute('pessoa_id');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
            
    }

    /**
     * Method set_habilidade
     * Sample of usage: $var->habilidade = $object;
     * @param $object Instance of Habilidade
     */
    public function set_habilidade(Habilidade $object)
    {
        $this->habilidade = $object;
        $this->habilidade_id = $object->id;
    }

    /**
     * Method get_habilidade
     * Sample of usage: $var->habilidade->attribute;
     * @returns Habilidade instance
     */
    public function get_habilidade()
    {
    
        // loads the associated object
        if (empty($this->habilidade))
            $this->habilidade = new Habilidade($this->habilidade_id);
    
        // returns the associated object
        return $this->habilidade;
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

