<?php

class PessoaPapel extends TRecord
{
    const TABLENAME  = 'pessoa_papel';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    private $pessoa;
    private $papel;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pessoa_id');
        parent::addAttribute('papel_id');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
            
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
     * Method set_papel
     * Sample of usage: $var->papel = $object;
     * @param $object Instance of Papel
     */
    public function set_papel(Papel $object)
    {
        $this->papel = $object;
        $this->papel_id = $object->id;
    }

    /**
     * Method get_papel
     * Sample of usage: $var->papel->attribute;
     * @returns Papel instance
     */
    public function get_papel()
    {
    
        // loads the associated object
        if (empty($this->papel))
            $this->papel = new Papel($this->papel_id);
    
        // returns the associated object
        return $this->papel;
    }

    
}

